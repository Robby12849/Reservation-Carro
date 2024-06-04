<!DOCTYPE html>
<html lang="it">
<head> 
    <meta charset="UTF-8">
    <title>ADMIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <style>
        .table-container {
            display: flex;
            justify-content: space-between;
        }
        table {
            
            border-collapse: collapse;
            margin-top: 10px;
            display: inline-block;
            vertical-align: top;   
        }
        thead {
            background-color: #800000;
            height: 40px; 
            line-height: 40px; 

        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;   
        }
    </style>
</head>
<body>
<div class="topnav">
    <a class="active" href="index.html">Home</a>
    <a href="storia.html">STORIA</a>    
    <?php
    session_start(); 
    if (isset($_SESSION['nome'])) {
        $nome_maiuscolo = strtoupper($_SESSION['nome']);
        echo "<a href='logout.php'>LOGOUT $nome_maiuscolo</a>"; 
    }
    ?>
</div>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>EMAIL</th>
                <th>NUMERO DI TELEFONO</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Connessione al database e recupero dei dati per la prima tabella
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_carro";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // Query per la prima tabella
        $sql1 = "SELECT ID_utente, nome, cognome, email, telefono FROM utente WHERE ruolo = 'partecipante'";
        $result1 = $conn->query($sql1);

        //$utenti = [];
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
          //      $utenti[$row1['ID_utente']] = $row1;
                echo "<tr>";
                echo "<td>" . $row1["nome"] . "</td>";
                echo "<td>" . $row1["cognome"] . "</td>";
                echo "<td><a href='mailto:" . $row1["email"] . "'>" . $row1["email"] . "</a></td>";
                echo "<td><a href='tel:" . $row1["telefono"] . "'>" . $row1["telefono"] . "</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nessun utente trovato.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Seconda tabella -->
    <table>
        <thead>
            <tr>
                <th>DATA</th>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>QUOTA VERSATA</th>
                <th>ELIMINA VERSAMENTO</th>
            </tr>
        </thead> 
        <tbody>
        <?php
        // Query per la seconda tabella
        $sql2 = "SELECT prenotazione.data, prenotazione.quota_versata, utente.nome, utente.cognome, utente.ID_utente
                 FROM prenotazione
                 INNER JOIN utente ON prenotazione.ID_utente = utente.ID_utente
                 WHERE utente.ruolo = 'partecipante'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row2["data"] . "</td>";
                echo "<td>" . $row2["nome"] . "</td>";
                echo "<td>" . $row2["cognome"] . "</td>";
                echo "<td>" . $row2["quota_versata"] . "</td>";
                echo "<td>
                    <form method='post' action='elimina.php'>
                        <input type='hidden' name='data' value='" . $row2["data"] . "'>
                        <input type='hidden' name='quota_versata' value='" . $row2["quota_versata"] . "'>
                        <button type='submit' name='elimina'>Elimina</button>
                    </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nessun versamento trovato.</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
