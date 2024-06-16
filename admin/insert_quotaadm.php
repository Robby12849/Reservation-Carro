<?php
session_start();
include '../conn/connessione.php';

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
