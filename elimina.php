<?php
// Verifica se il pulsante di eliminazione è stato premuto
if(isset($_POST['elimina'])) {
    // Ottieni i valori passati dal modulo
    $data = $_POST['data'];
    $quota_versata = $_POST['quota_versata'];

    // Connessione al database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_carro";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Query per eliminare il record corrispondente
    $sql = "DELETE FROM prenotazione WHERE data='$data' AND quota_versata='$quota_versata'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='paginaadmin.php' </script>";
    } else {
        echo "Errore durante l'eliminazione del record: " . $conn->error;
    }
        $conn->close();
}
?>
