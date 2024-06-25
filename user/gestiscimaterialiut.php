<!DOCTYPE html>
<html lang="en">
<head>
    <title> MATERIALI </title>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">

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
    <script src="../js/materiali.js">
    </script>
</head>
<body>
<div class="topnav">
    <a class="active" href="paginautente.php">PRENOTAZIONI</a>
    <a href="gestiscimaterialiut.php">MATERIALI</a>
    <?php
    session_start();
    if (isset($_SESSION['nome'])) {
        $nome_maiuscolo = strtoupper($_SESSION['nome']);
        echo "<a href='../pre-login/logout.php'>LOGOUT $nome_maiuscolo</a>";
    }
    ?>
</div>
<h1>Modifica Dati Materiale</h1>

<?php
include '../conn/connessione.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"], $_POST["quantita"])) {
        $nome = $_POST["nome"];
        $quantita = $_POST["quantita"];
        for ($i = 0; $i < count($nome); $i++) {
            $sql = "UPDATE materiale SET quantità = '{$quantita[$i]}' WHERE nome = '{$nome[$i]}'";
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
            $sql = "INSERT INTO acquisto (costo_totale, quantità, ID_utente, ID_materiale) 
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
        $sql_select = "SELECT * FROM materiale";
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
      <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Sito contribuito da</h3>
                <p>Disegnato da <a href="#" target="_blank">ROBERTO DE BARI</a></p>
                <p>Sviluppato da <a href="#" target="_blank">ROBERTO DE BARI</a></p>
            </div>
            <div class="footer-column">
                <h3>Contatti</h3>
                <ul>
                    <li>EMAIL: <a href="mailto:robydebari2005@gmail.com">robydebari2005@gmail.com</a></li>
                    <li>TELEFONO: <a href="tel:3383004741">3383004741</a></li>
                    <li><a href="wa.link/rk88lz" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Seguimi su </h3>
                <ul class="social-links">
                    <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="https://github.com/Robby12849" target="_blank"><i class="fab fa-github"></i> GitHub</a></li>
                    <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Your Company. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
