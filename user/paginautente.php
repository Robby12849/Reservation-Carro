<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>INSERISCI PRENOTAZIONE</title>
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">

<style>
  h2{
    text-align: center;
  }
.table-container {
  margin-top: 20px;
}
.table-container table {
  width: 100%;
  border-collapse: collapse;
}
.table-container th, .table-container td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.table-container th {
  background-color: #f2f2f2;
}

.container {
  width: 80%;
  text-align: center;
}

.input-field {
  width: 250px;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  font-size: 16px;
}

.input-field:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.button {
  margin-top: 10px;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.button:hover {
  background-color: #0056b3;
}
</style>
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
<div class="container">
Inserisci quota versata<br>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="number" class="input-field" name="quota_versata" value="15"  min="15" placeholder="Inserisci quota versata"><br>
    <button type="submit" class="button">INSERISCI</button>
  </form>
</div>
<div class="table-container">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../conn/connessione.php';
    $id_utente = $_SESSION['ID_utente'];
    $_SESSION['ID_utente'] = $id_utente;
    $quota_versata = $_POST['quota_versata'];
    $sql_insert = "INSERT INTO prenotazione (ID_utente, quota_versata) VALUES ($id_utente, $quota_versata)";
    if ($conn->query($sql_insert) === TRUE) {
        $id_prenotazione = $conn->insert_id;
        $_SESSION['ID_prenotazione'] = $id_prenotazione; 
        $_SESSION['insert_success'] = true; 
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Errore nell'inserimento dei dati: " . $conn->error;
    }
    $conn->close();
}
if (isset($_SESSION['insert_success']) && $_SESSION['insert_success'] === true) {
    echo "<script>alert('Pagamento  inserito con successo');</script>";
    unset($_SESSION['insert_success']);
}
if (isset($_SESSION['ID_utente'])) {
  include '../conn/connessione.php';
    $id_utente = $_SESSION['ID_utente'];
    $sql_select = "SELECT quota_versata, data FROM prenotazione WHERE ID_utente = $id_utente";
    $result = $conn->query($sql_select);
    if ($result->num_rows > 0) {
        echo "<h2>QUOTE VERSATE</h2>";
        echo "<table>";
        echo "<tr><th>Quota versata</th><th>Data</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["quota_versata"] . "</td>";
            echo "<td>" . $row["data"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun pagamento effettuato</p>";
    }
    $conn->close();
}
?>
</div>
<footer class="site-footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Sito contribuito da</h3>
                <p>Disegnato da <a href="#" target="_blank">ROBERTO DE BARI</a></p>
                <p>Sviluppato da <a href="#" target="_blank">ROBERTO DE BARI </a></p>
            </div>
            <div class="footer-column">
                <h3>Contatti</h3>
                <ul>
                    <li>Email: <a href="mailto:robydebari2005@gmail.com">robydebari2005@gmail.com</a></li>
                    <li>Telefono: <a href="tell:3383004741">3383004741</a></li>
                    <li>Indirizzo: Via Falcone 1, Palo del colle, Bari</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Seguici</h3>
                <ul class="social-links">
                    <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
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
