<?php
// Verifica se il pulsante di eliminazione è stato premuto
if(isset($_POST['elimina'])) {
    // Ottieni i valori passati dal modulo
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];

    // Connessione al database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_carro";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connessione fallita: " . $conn->connect_error;
    }

    // Query per eliminare il record corrispondente
    $sql = "DELETE FROM utente WHERE data='$data' AND quota_versata='$quota_versata'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='paginaadmin.php' </script>";
    } else {
        echo "Errore durante l'eliminazione del record: " . $conn->error;
    }
        $conn->close();
}
