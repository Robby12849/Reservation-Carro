<?php

if(isset($_POST['elimina'])) {
    
    $data = $_POST['data'];
    $quota_versata = $_POST['quota_versata'];

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_carro";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo"Connessione fallita: " . $conn->connect_error;
    }

    
    $sql = "DELETE FROM prenotazione WHERE data='$data' AND quota_versata='$quota_versata'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='paginaadmin.php' </script>";
    } else {
        echo "Errore durante l'eliminazione del record: " . $conn->error;
    }
        $conn->close();
}
?>
