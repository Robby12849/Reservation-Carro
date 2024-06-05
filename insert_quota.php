<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_carro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo"Connessione fallita: " . $conn->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prezzo = $_POST['prezzo'];
    $utente_id = $_SESSION['ID_utente']; 

    $sql = "INSERT INTO prenotazione (ID_utente, quota_versata) VALUES ($utente_id, $prezzo)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nuova quota aggiunta con successo');window.location.href='paginaadmin.php';</script>";
    } else {
        echo "<script>alert('Errore durante l'inserimento della quota');</script>";
    }
}
$conn->close();
