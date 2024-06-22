<?php
include '../conn/connessione.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['qta']) && isset($_POST['costo'])) {
    $nome = $_POST['nome'];
    $qta = $_POST['qta'];
    $costo = $_POST['costo'];
    $sql = "INSERT INTO materiale (nome, quantità, prezzo_materiale) VALUES ('$nome', '$qta', '$costo')";
    
    if ($conn->query($sql) === TRUE) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }
}
$conn->close();
