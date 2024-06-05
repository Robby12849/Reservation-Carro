<!DOCTYPE html>
<html lang="it">
<head> 
    <meta charset="UTF-8">
    <title>ADMIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
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
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        button{
            background-color: green;
            font-weight: bold;
            padding: 10px;
            font-size: 20px;

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
    <a href="gestiscimaterialiadm.php"> MATERIALI </a> 
    <a onclick="openForm()">AGGIUNGI QUOTA</a>
</div>
<div class="form-popup" id="myForm">
    <form action="insert_quota.php" method="post" class="form-container">
        <h1>QUOTE</h1>
        <label for="prezzo"><b>INSERISCI QUOTA PAGATA</b></label>
        <input type="number" placeholder="INSERISCI QUOTA" name="prezzo" min="15" value="15" required>
        <button type="submit" class="btn">AGGIUNGI QUOTA</button>
        <button type="button" class="btn cancel" onclick="closeForm()">CHIUDI</button>
    </form>
</div>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>EMAIL</th>
                <th>NUMERO DI TELEFONO</th>
                <th>AZIONI</th>
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
            echo "Connessione fallita: " . $conn->connect_error;
        }

        // Query per la prima tabella
        $sql1 = "SELECT ID_utente, nome, cognome, email, telefono FROM utente WHERE ruolo = 'partecipante'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row1["nome"] . "</td>";
                echo "<td>" . $row1["cognome"] . "</td>";
                echo "<td><a href='mailto:" . $row1["email"] . "'>" . $row1["email"] . "</a></td>";
                echo "<td><a href='tel:" . $row1["telefono"] . "'>" . $row1["telefono"] . "</a></td>";
                echo "<td>
                <form method='post' action='eliminautente.php'>
                    <input type='hidden' name='nome' value='" . $row1["nome"] . "'>
                    <input type='hidden' name='cognome' value='" . $row1["cognome"] . "'>
                    <button type='submit' name='elimina'>Elimina</button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nessun utente trovato.</td></tr>";
        }
        ?>
        </tbody>
    </table>

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
                 INNER JOIN utente ON prenotazione.ID_utente = utente.ID_utente";
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

<script src="js/popup.js"></script>
</body>
</html>
