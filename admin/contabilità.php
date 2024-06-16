<!DOCTYPE html>
<html>
<head>
    <title>CONTABILITA</title>
    <link rel="stylesheet" href="../css/navbar.css" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 { 
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 45%;
            border-collapse: collapse;
            margin: 0 2.5%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .balance {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .table-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <a class="active" href="../index.html">Home</a>
        <a href="../html/admin.html">CONTATTI</a>
        <a href="../html/storia.html">STORIA</a>
        <a href="gestiscimaterialiadm.php">MATERIALI</a> 
        <a href="paginaadmin.php">QUOTE</a>    
        <?php
        session_start(); 
        if (isset($_SESSION['nome'])) {
            $nome_maiuscolo = strtoupper(htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'));
            echo "<a href='../pre-login/logout.php'>LOGOUT $nome_maiuscolo</a>"; 
        }
        ?>
    </div>
    <h1>ECCO LA CONTABILITA DEL CARRO</h1>
    <div class="container">
        <div class="balance">
            <?php
        include '../conn/connessione.php';
            
            // Query to get total expenses
            $sql_sum = "SELECT COALESCE(SUM(costo_totale), 0) AS spese_totali FROM acquisto";
            $result_sum = $conn->query($sql_sum);
            
            // Check if query was successful
            if ($result_sum === false) {
                echo"Errore nella query delle spese: " . $conn->error;
            }
            
            $row_sum = $result_sum->fetch_assoc();
            
            // Query to get total earnings
            $sql_sum_earnings = "SELECT COALESCE(SUM(quota_versata), 0) AS guadagni FROM prenotazione";
            $result_sum_earnings = $conn->query($sql_sum_earnings);
            
            // Check if query was successful
            if ($result_sum_earnings === false) {
                echo"Errore nella query dei guadagni: " . $conn->error;
            }
            
            $row_sum_earnings = $result_sum_earnings->fetch_assoc();
            
            // Calculate balance
            $bil = $row_sum_earnings['guadagni'] - $row_sum['spese_totali'];
            
            // Display balance
            if ($bil >= 0) {
                echo "<h2>Bilancio: €" . number_format($bil, 2, ',', '.') . "</h2>";
            } else {
                echo "<h2 style='color: red;'>Bilancio negativo: €" . number_format($bil, 2, ',', '.') . "</h2>";
            }
            
            $conn->close();
            ?>
        </div>

        <div class="table-container">
            <?php
        include '../conn/connessione.php';

            // Query to get purchases
            $sql_acquisti = "
            SELECT 
                acquisti.ID_materiale, 
                acquisti.data AS acquisti_data,  
                acquisti.costo_totale, 
                acquisti.quantità AS acquisti_quantità, 
                utente.nome, 
                utente.cognome, 
                materiali.nome AS materiale_nome
            FROM acquisto
            INNER JOIN utente ON acquisto.ID_utente = utente.ID_utente 
            INNER JOIN materiale ON acquisto.ID_materiale = materiale.ID_materiale;
            ";

            // Execute and display purchases
            $result_acquisti = $conn->query($sql_acquisti);
            
            // Check if query was successful
            if ($result_acquisti === false) {
                echo"Errore nella query degli acquisti: " . $conn->error;
            }
            
            if ($result_acquisti->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Nome Utente Acquisto</th>
                            <th>Cognome Utente Acquisto</th>
                            <th>Data Acquisto</th>
                            <th>Costo Totale</th>
                            <th>Quantità Acquisto</th>
                        </tr>";
                while ($row = $result_acquisti->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($row['cognome'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($row['acquisti_data'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>€" . number_format($row['costo_totale'], 2, ',', '.') . "</td>
                            <td>" . htmlspecialchars($row['acquisti_quantità'], ENT_QUOTES, 'UTF-8') . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<table><tr><td>Non ci sono acquisti</td></tr></table>";
            }

            // Query to get bookings
            $sql_prenotazioni = "
            SELECT 
                prenotazione.data, 
                prenotazione.quota_versata, 
                utente.nome AS prenotazione_nome, 
                utente.cognome AS prenotazione_cognome, 
                utente.ID_utente
            FROM prenotazione
            INNER JOIN utente ON prenotazione.ID_utente = utente.ID_utente
            ";

            // Execute and display bookings
            $result_prenotazioni = $conn->query($sql_prenotazioni);
            
            // Check if query was successful
            if ($result_prenotazioni === false) {
                echo"Errore nella query delle prenotazioni: " . $conn->error;
            }
            
            if ($result_prenotazioni->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Nome Creditore</th>
                            <th>Cognome Creditore</th>
                            <th>Quota Versata</th>
                            <th>Data Prenotazione</th>
                        </tr>";
                while ($row = $result_prenotazioni->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['prenotazione_nome'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>" . htmlspecialchars($row['prenotazione_cognome'], ENT_QUOTES, 'UTF-8') . "</td>
                            <td>€" . number_format($row['quota_versata'], 2, ',', '.') . "</td>
                            <td>" . htmlspecialchars($row['data'], ENT_QUOTES, 'UTF-8') . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<table><tr><td>Non ci sono prenotazioni</td></tr></table>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
