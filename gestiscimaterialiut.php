<!DOCTYPE html>
<html lang="en">
<head>
<title> MATERIALI </title>
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<style>
/* Stili per la tabella */
table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  padding: 8px;
  text-align: left;
}

/* Stili per le righe pari ed dispari */
tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Stili per l'intestazione della tabella */
th {
  background-color: #4CAF50;
  color: white;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px 2px;
    cursor: pointer;
}
</style>

</head>
<body>
<script src="js/materiali.js">
</script> 
<div class="topnav">
    <a class="active" href="index.html">Home</a>
    <a href="storia.html">STORIA</a>    
    <?php
    session_start(); 
    if (isset($_SESSION['nome'])) {
        $nome_maiuscolo = strtoupper($_SESSION['nome']);
        echo "<a href='logout.php'>LOGOUT $nome_maiuscolo</a>"; 
    }
    ?>
    <a href="paginautente.php">PRENOTAZIONI</a>    
</div>

<h1>Modifica Dati Materiale</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantità</th>
                <th>Prezzo</th>
                <th>Prezzo Totale</th>
                <th>Quantità acquistata</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_carro";

                // Connessione al database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica della connessione
                if ($conn->connect_error) {
                    echo "Connessione fallita: " . $conn->connect_error;
                }
                
                // Se è stato inviato un modulo
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Assicurati che i dati siano stati inviati correttamente
                    if(isset($_POST["nome"], $_POST["quantita"], $_POST["prezzo"], $_POST["prezzo_totale"])) {
                        // Prendi i dati dal modulo
                        $nome = $_POST["nome"];
                        $quantita = $_POST["quantita"];
                        $prezzo = $_POST["prezzo"];
                        $prezzo_totale = $_POST["prezzo_totale"];
                        $quantità = $_POST["quantity"];
                        $_SESSION['prezzo_totale'] = $prezzo_totale;
                        $_SESSION['quantity'] = $quantity;
                        for($i = 0; $i < count($nome); $i++) {
                            $sql = "UPDATE materiali SET quantità = '{$quantita[$i]}' WHERE nome = '{$nome[$i]}'";
                            if ($conn->query($sql) !== TRUE) {
                                echo "Errore nell'aggiornamento dei dati: " . $conn->error;
                            }
                        }
                        // Reindirizza alla stessa pagina dopo l'aggiornamento
                        header("Location: " . $_SERVER['PHP_SELF']);
                    } else {
                        echo "Assicurati di compilare tutti i campi.";
                    }
                }
                $sql_select = "SELECT * FROM materiali";
                $result = $conn->query($sql_select);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='text' name='nome[]' value='" . $row["nome"] . "' readonly></td>";
                        echo "<td><input type='number' name='quantita[]' value='" . $row["quantità"] . "' max='" . $row["quantità"] . "' onchange='calculateTotal(this.parentNode.parentNode)'></td>";
                        echo "<td><input type='number' name='prezzo[]' value='" . $row["prezzo_materiale"] . "' readonly></td>";
                        echo "<td><input type='number' name='prezzo_totale[]' value='0' readonly></td>";
                        echo "<td><input type='number' name='quantità[]' value='0' readonly></td>";
                        echo "<td><input type='submit' value='Modifica'></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nessun materiale trovato.</td></tr>";
                }
                // Chiudi la connessione al database
                $conn->close();
            ?>
        </tbody>
    </table>
</form>

</body>
</html>
