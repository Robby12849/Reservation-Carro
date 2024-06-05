<html>
<head>
<title>
    CONTABILITA
</title>
<style>
h1 { 
    text-align: center;
}
</style>
</head>
<body>
<h1 > ECCO LA CONTABILITA DEL CARRO </h1>
<?php
// Dettagli connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_carro";

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Esegui la query
$sql = "
SELECT 
    acquisti.ID_acquisto, 
    acquisti.ID_utente AS acquisti_ID_utente, 
    acquisti.ID_materiale, 
    acquisti.`guad/perd`, 
    acquisti.data AS acquisti_data, 
    acquisti.ID_prenotazione, 
    acquisti.costo_totale, 
    acquisti.quantità AS acquisti_quantità, 
    utente.nome, 
    utente.cognome, 
    utente.email, 
    utente.password, 
    utente.telefono, 
    utente.ruolo, 
    prenotazione.data AS prenotazione_data, 
    prenotazione.quota_versata, 
    materiali.nome AS materiale_nome, 
    materiali.quantità AS materiale_quantità, 
    materiali.prezzo_materiale 
FROM acquisti 
INNER JOIN utente ON acquisti.ID_utente = utente.ID_utente 
INNER JOIN prenotazione ON acquisti.ID_prenotazione = prenotazione.ID_prenotazione 
INNER JOIN materiali ON acquisti.ID_materiale = materiali.ID_materiale;
";

$result = $conn->query($sql);

// Controlla se ci sono risultati
if ($result->num_rows > 0) {
    // Inizia la tabella HTML
    echo "<table border='1'>
            <tr>
                <th>ID Acquisto</th>
                <th>ID Utente</th>
                <th>Nome Utente</th>
                <th>Cognome Utente</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Ruolo</th>
                <th>ID Materiale</th>
                <th>Nome Materiale</th>
                <th>Quantità Materiale</th>
                <th>Prezzo Materiale</th>
                <th>Guad/Perd</th>
                <th>Data Acquisto</th>
                <th>ID Prenotazione</th>
                <th>Data Prenotazione</th>
                <th>Quota Versata</th>
                <th>Costo Totale</th>
                <th>Quantità Acquisto</th>
            </tr>";

    // Output dei dati di ogni riga
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID_acquisto']}</td>
                <td>{$row['acquisti_ID_utente']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['cognome']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telefono']}</td>
                <td>{$row['ruolo']}</td>
                <td>{$row['ID_materiale']}</td>
                <td>{$row['materiale_nome']}</td>
                <td>{$row['materiale_quantità']}</td>
                <td>{$row['prezzo_materiale']}</td>
                <td>{$row['guad/perd']}</td>
                <td>{$row['acquisti_data']}</td>
                <td>{$row['ID_prenotazione']}</td>
                <td>{$row['prenotazione_data']}</td>
                <td>{$row['quota_versata']}</td>
                <td>{$row['costo_totale']}</td>
                <td>{$row['acquisti_quantità']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 risultati";
}

// Chiudi la connessione
$conn->close();
?>



</body>
</html>