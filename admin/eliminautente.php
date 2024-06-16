<?php

if(isset($_POST['elimina'])) {
    
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];

    include '../conn/connessione.php';
    $sql = "DELETE FROM utente WHERE nome='$nome' AND cognome='$cognome' ";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='paginaadmin.php' </script>";
    } else {
        echo "Errore durante l'eliminazione del record: " . $conn->error;
    }
        $conn->close();
}
