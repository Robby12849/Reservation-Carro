<?php
session_start();
include '../conn/connessione.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['contenuto']) && isset($_POST['data']) && isset($_POST['titolo']) ) {
        $contenuto = $_POST['contenuto'];
        $data = $_POST['data'];
        $titolo = $_POST['titolo'];

        $data_invertita = date("Y-m-d", strtotime($data));
        $titolo_maiuscolo = strtoupper($titolo);
        $contenuto_sanitized = $conn->real_escape_string($contenuto);
        $data_sanitized = $conn->real_escape_string($data_invertita);
        $sql = "INSERT INTO notizia (notizia, titolo,data_di_riferimento) VALUES ('$contenuto_sanitized','$titolo_maiuscolo' ,'$data_sanitized')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Nuova notizia aggiunta con successo');window.location.href='aggiunginotizie.php';</script>";
        } else {
            echo "<script>alert('Errore durante l'inserimento della notizia: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Per favore, compila tutti i campi.');</script>";
    }
}

$conn->close();
?>
