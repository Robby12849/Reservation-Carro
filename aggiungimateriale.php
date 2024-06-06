<?php
// Verifica se sono stati inviati dati tramite POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assicurati che tutti i campi siano stati inviati
    if (isset($_POST["prezzo_totale"], $_POST["quantita_acquistata"], $_POST["id_utente"], $_POST["id_materiale"])) {
        // Recupera i valori dal modulo
        $prezzo_totale = $_POST["prezzo_totale"];
        $quantita_acquistata = $_POST["quantita_acquistata"];
        $id_utente = $_POST["id_utente"];
        $id_materiale = $_POST["id_materiale"];
        // Connessione al database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_carro"; // Inserisci il nome del tuo database
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Verifica la connessione
        if ($conn->connect_error) {
            echo "Connessione fallita: " . $conn->connect_error;
        }
        // Prepara e esegui l'inserimento dei dati nella tabella
        $sql = "INSERT INTO acquisti (costo_totale, quantità, ID_utente, ID_materiale) 
                VALUES ('$prezzo_totale', '$quantita_acquistata', '$id_utente', '$id_materiale')";
        if ($conn->query($sql) === TRUE) {
            echo "Dati inseriti correttamente nella tabella.";
        } else {
            echo "Errore nell'inserimento dei dati: " . $conn->error;
        }
        // Chiudi la connessione
        $conn->close();
    } else {
        echo "Assicurati di compilare tutti i campi.";
    }
}

