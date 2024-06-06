<?php

if(isset($_POST['elimina'])) {
    
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_carro";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connessione fallita: " . $conn->connect_error;
    }

    $sql = "DELETE FROM utente WHERE nome='$nome' AND cognome='$cognome' ";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='paginaadmin.php' </script>";
    } else {
        echo "Errore durante l'eliminazione del record: " . $conn->error;
    }
        $conn->close();
}
