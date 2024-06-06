<!DOCTYPE html>
<html lang="en">
<head>
    <title> MATERIALI </title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <style>
        /* Stili per la tabella */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        /* Stili per le righe pari ed dispari */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Stili per l'intestazione della tabella */
        th {
            background-color: #4CAF50;
            color: white;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
        }
    </style>
    <script src="js/materiali.js">
    </script>
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
    <a href="paginautente.php">PRENOTAZIONI</a>
</div>
<h1>Modifica Dati Materiale</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_carro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connessione fallita: " . $conn->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"], $_POST["quantita"])) {
        $nome = $_POST["nome"];
        $quantita = $_POST["quantita"];
        for ($i = 0; $i < count($nome); $i++) {
            $sql = "UPDATE materiali SET quantità = '{$quantita[$i]}' WHERE nome = '{$nome[$i]}'";
            if ($conn->query($sql) !== TRUE) {
                echo "Errore nell'aggiornamento dei dati: " . $conn->error;
            }
        }
    }

    if (isset($_POST["prezzo_totale"], $_POST["quantita_acquistata"], $_POST["id_utente"], $_POST["id_materiale"])) {
        $prezzo_totale = $_POST["prezzo_totale"];
        $quantita_acquistata = $_POST["quantita_acquistata"];
        $id_utente = $_POST["id_utente"];
        $id_materiale = $_POST["id_materiale"];

        for ($i = 0; $i < count($prezzo_totale); $i++) {
            $sql = "INSERT INTO acquisti (costo_totale, quantità, ID_utente, ID_materiale) 
                    VALUES ('{$prezzo_totale[$i]}', '{$quantita_acquistata[$i]}', '$id_utente', '$id_materiale')";
            if ($conn->query($sql) !== TRUE) {
                echo "Errore nell'inserimento dei dati: " . $conn->error;
            }
        }
        echo "<script>alert('Acquisto Effettuato con successo')</script>";
    }
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Quantità</th>
            <th>Prezzo</th>
            <th>Prezzo Totale</th>
            <th>Quantità acquistata</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql_select = "SELECT * FROM materiali";
        $result = $conn->query($sql_select);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='text' name='nome[]' value='" . $row["nome"] . "' readonly></td>";
                echo "<td><input type='number' name='quantita[]' value='" . $row["quantità"] . "' max='" . $row["quantità"] . "' min='0' onchange='calculateTotal(this.parentNode.parentNode); setQuantitaAcquistata(this.parentNode.parentNode)'></td>";
                echo "<td><input type='number' name='prezzo[]' value='" . $row["prezzo_materiale"] . "' readonly></td>";
                echo "<td><input type='number' name='prezzo_totale[]' value='0' readonly></td>";
                echo "<td><input type='number' name='quantita_acquistata[]' value='0' readonly></td>";
                echo "<td><input type='hidden' name='id_utente' value='" . $_SESSION['ID_utente'] . "'>";
                echo "<input type='hidden' name='id_materiale' value='" . $row["ID_materiale"] . "'>";
                echo "<input type='submit' value='Modifica'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nessun materiale trovato.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</form>

<?php
$conn->close();
?>
</body>
</html>
