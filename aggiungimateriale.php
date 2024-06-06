<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["prezzo_totale"], $_POST["quantita_acquistata"], $_POST["id_utente"], $_POST["id_materiale"])) {
        
        $prezzo_totale = $_POST["prezzo_totale"];
        $quantita_acquistata = $_POST["quantita_acquistata"];
        $id_utente = $_POST["id_utente"];
        $id_materiale = $_POST["id_materiale"];
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_carro"; 
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            echo "Connessione fallita: " . $conn->connect_error;
        }
        
        $sql = "INSERT INTO acquisti (costo_totale, quantità, ID_utente, ID_materiale) 
                VALUES ('$prezzo_totale', '$quantita_acquistata', '$id_utente', '$id_materiale')";
        if ($conn->query($sql) === TRUE) {
            echo "Dati inseriti correttamente nella tabella.";
        } else {
            echo "Errore nell'inserimento dei dati: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "Assicurati di compilare tutti i campi.";
    }
}

