<!DOCTYPE html>
<html>
<head>
<title>CONTABILITA</title>
<link rel="stylesheet" href="css/navbar.css" type="text/css">
<style>
h1 { 
    text-align: center;
}
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
}
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
}
.balance {
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}
</style>
</head>
<body>
<div class="topnav">
    <a class="active" href="index.html">Home</a>
    <a href="admin.html">CONTATTI</a>
    <a href="storia.html">STORIA</a>
    <a href="gestiscimaterialiadm.php">MATERIALI</a> 
    <a href="paginaadmin.php">QUOTE</a>    
    <?php
    session_start(); 
    if (isset($_SESSION['nome'])) {
        $nome_maiuscolo = strtoupper($_SESSION['nome']);
        echo "<a href='logout.php'>LOGOUT $nome_maiuscolo</a>"; 
    }
    ?>
</div>
<h1>ECCO LA CONTABILITA DEL CARRO</h1>
<div class="container">
    <div class="balance">
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

        // Inizializza le variabili per il bilancio
        $row_sum_earnings = ['guadagni' => 0];
        $row_sum = ['spese_totali' => 0];

        // Query per ottenere i dati degli acquisti
        $sql_sum = "SELECT COALESCE(SUM(costo_totale), 0) AS spese_totali FROM acquisti";
        $result_sum = $conn->query($sql_sum);

        if ($result_sum->num_rows > 0) {
            $row_sum = $result_sum->fetch_assoc();
        }

        // Query per ottenere i dati delle prenotazioni
        $sql_sum_earnings = "SELECT COALESCE(SUM(quota_versata), 0) AS guadagni FROM prenotazione";
        $result_sum_earnings = $conn->query($sql_sum_earnings);

        if ($result_sum_earnings->num_rows > 0) {
            $row_sum_earnings = $result_sum_earnings->fetch_assoc();
        }

        // Calcola il bilancio
        $bil = $row_sum_earnings['guadagni'] - $row_sum['spese_totali'];

        // Mostra il bilancio
        if ($bil >= 0) {
            echo "<h2>Bilancio: €" . $bil . "</h2>";
        } else {
            echo "<h2 style='color: red;'>Bilancio negativo: €" . $bil . "</h2>";
        }

        // Chiudi la connessione
        $conn->close();
        ?>
    </div>

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

    // Query per ottenere i dati degli acquisti
    $sql_acquisti = "
    SELECT 
        acquisti.ID_materiale, 
        acquisti.data AS acquisti_data,  
        acquisti.costo_totale, 
        acquisti.quantità AS acquisti_quantità, 
        utente.nome, 
        utente.cognome, 
        materiali.nome AS materiale_nome
    FROM acquisti 
    INNER JOIN utente ON acquisti.ID_utente = utente.ID_utente 
    INNER JOIN materiali ON acquisti.ID_materiale = materiali.ID_materiale;
    ";

    $result_acquisti = $conn->query($sql_acquisti);

    // Query per ottenere i dati delle prenotazioni
    $sql_prenotazioni = "
    SELECT 
        prenotazione.data, 
        prenotazione.quota_versata, 
        utente.nome AS prenotazione_nome, 
        utente.cognome AS prenotazione_cognome, 
        utente.ID_utente
    FROM prenotazione
    INNER JOIN utente ON prenotazione.ID_utente = utente.ID_utente
    ";

    $result_prenotazioni = $conn->query($sql_prenotazioni);

    $records = [];

    // Fetch all acquisti
    if ($result_acquisti->num_rows > 0) {
        while ($row = $result_acquisti->fetch_assoc()) {
            $records[] = array_merge($row, ['type' => 'acquisto']);
        }
    }
        // Fetch all prenotazioni
        if ($result_prenotazioni->num_rows > 0) {
            while ($row = $result_prenotazioni->fetch_assoc()) {
                $records[] = array_merge($row, ['type' => 'prenotazione']);
            }
        }

        // Sort records by date for consistency
        usort($records, function($a, $b) {
            return strtotime($a['acquisti_data'] ?? $a['data']) - strtotime($b['acquisti_data'] ?? $b['data']);
        });

        // Controlla se ci sono risultati
        if (!empty($records)) {
            // Inizia la tabella HTML
            echo "<table>
                    <tr>
                        <th>Nome Utente Acquisto</th>
                        <th>Cognome Utente Acquisto</th>
                        <th>Nome Materiale</th>
                        <th>Data Acquisto</th>
                        <th>Costo Totale</th>
                        <th>Quantità Acquisto</th>
                        <th>Nome  Creditore</th>
                        <th>Cognome  Creditore </th>
                        <th>Quota Versata</th>
                        <th>Data Prenotazione</th>
                    </tr>";

            // Output dei dati di ogni riga
            foreach ($records as $record) {
                echo "<tr>";
                if ($record['type'] === 'acquisto') {
                    echo "<td>{$record['nome']}</td>
                          <td>{$record['cognome']}</td>
                          <td>{$record['materiale_nome']}</td>
                          <td>{$record['acquisti_data']}</td>
                          <td>{$record['costo_totale']}</td>
                          <td>{$record['acquisti_quantità']}</td>
                          <td colspan='4'></td>";
                } else {
                    echo "<td colspan='6'></td>
                          <td>{$record['prenotazione_nome']}</td>
                          <td>{$record['prenotazione_cognome']}</td>
                          <td>{$record['quota_versata']}</td>
                          <td>{$record['data']}</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Non ci sono spese o guadagni";
        }
        // Chiudi la connessione
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>


