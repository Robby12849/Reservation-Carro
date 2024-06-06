<!DOCTYPE html>
<html>
<head>
<title>CONTABILITA</title>
<link rel="stylesheet" href="css/navbar.css" type="text/css">
<style>
h1 { 
    text-align: center;
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
}
</style>
</head>
<body>
<div class="topnav">
    <a class="active" href="index.html">Home</a>
    <a href="admin.html">CONTATTI</a>
    <a href="storia.html">STORIA</a>
    <a href="gestiscimaterialiadm.php">MATERIALI</a> 
    <a href="paginaadmin.php">QUOTE</a>    
    <?php
    session_start(); 
    if (isset($_SESSION['nome'])) {
        $nome_maiuscolo = strtoupper($_SESSION['nome']);
        echo "<a href='logout.php'>LOGOUT $nome_maiuscolo</a>"; 
    }
    ?>
</div>
<h1>ECCO LA CONTABILITA DEL CARRO</h1>
<div class="container">
    <div class="balance">
        <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_carro";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            echo "Connessione fallita: " . $conn->connect_error;
        }

        
        $row_sum_earnings = ['guadagni' => 0];
        $row_sum = ['spese_totali' => 0];

        
        $sql_sum = "SELECT COALESCE(SUM(costo_totale), 0) AS spese_totali FROM acquisti";
        $result_sum = $conn->query($sql_sum);

        if ($result_sum->num_rows > 0) {
            $row_sum = $result_sum->fetch_assoc();
        }

        
        $sql_sum_earnings = "SELECT COALESCE(SUM(quota_versata), 0) AS guadagni FROM prenotazione";
        $result_sum_earnings = $conn->query($sql_sum_earnings);

        if ($result_sum_earnings->num_rows > 0) {
            $row_sum_earnings = $result_sum_earnings->fetch_assoc();
        }

        
        $bil = $row_sum_earnings['guadagni'] - $row_sum['spese_totali'];

        
        if ($bil >= 0) {
            echo "<h2>Bilancio: €" . $bil . "</h2>";
        } else {
            echo "<h2 style='color: red;'>Bilancio negativo: €" . $bil . "</h2>";
        }

        
        $conn->close();
        ?>
    </div>

    <div class="table-container">
        <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_carro";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

     
        if ($conn->connect_error) {
            echo"Connessione fallita: " . $conn->connect_error;
        }

        
        $sql_acquisti = "
        SELECT 
            acquisti.ID_materiale, 
            acquisti.data AS acquisti_data,  
            acquisti.costo_totale, 
            acquisti.quantità AS acquisti_quantità, 
            utente.nome, 
            utente.cognome, 
            materiali.nome AS materiale_nome
        FROM acquisti 
        INNER JOIN utente ON acquisti.ID_utente = utente.ID_utente 
        INNER JOIN materiali ON acquisti.ID_materiale = materiali.ID_materiale;
        ";

        $result_acquisti = $conn->query($sql_acquisti);

        
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

        $result_prenotazioni = $conn->query($sql_prenotazioni);

        
        if ($result_acquisti->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Nome Utente Acquisto</th>
                        <th>Cognome Utente Acquisto</th>
                        <th>Nome Materiale</th>
                        <th>Data Acquisto</th>
                        <th>Costo Totale</th>
                        <th>Quantità Acquisto</th>
                    </tr>";
            while ($row = $result_acquisti->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>{$row['cognome']}</td>
                        <td>{$row['materiale_nome']}</td>
                        <td>{$row['acquisti_data']}</td>
                        <td>{$row['costo_totale']}</td>
                        <td>{$row['acquisti_quantità']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<table><tr><td>Non ci sono acquisti</td></tr></table>";
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
                        <td>{$row['prenotazione_nome']}</td>
                        <td>{$row['prenotazione_cognome']}</td>
                        <td>{$row['quota_versata']}</td>
                        <td>{$row['data']}</td>
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
