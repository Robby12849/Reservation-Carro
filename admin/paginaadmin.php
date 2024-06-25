<!DOCTYPE html>
<html lang="it">
<head> 
    <meta charset="UTF-8">
    <title>ADMIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/popup.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">

    <style>
        .table-container {
            display: flex;
            justify-content: space-between;
        }
        table {
            border-collapse: collapse;
            margin-top: 10px;
            display: inline-block;
            vertical-align: top;   
        }
        thead {
            background-color: #800000;
            height: 40px; 
            line-height: 40px; 
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;   
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        button{
            background-color: green;
            font-weight: bold;
            padding: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="topnav">
        <a class="active" href="paginaadmin.php">HOME ADMIN</a>
        <a href="gestiscimaterialiadm.php">MATERIALI</a> 
        <a href="contabilita.php">BILANCIO</a>
        <a onclick="openForm()">AGGIUNGI QUOTA</a>
        <?php
        session_start(); 
        if (isset($_SESSION['nome'])) {
            $nome_maiuscolo = strtoupper(htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'));
            echo "<a href='../pre-login/logout.php'>LOGOUT $nome_maiuscolo</a>"; 
        }
        ?>
    </div>


<div class="form-popup" id="myForm">
    <form action="insert_quotaadm.php" method="post" class="form-container">
        <h1>QUOTE</h1>
        <label for="prezzo"><b>INSERISCI QUOTA PAGATA</b></label>
        <input type="number" placeholder="INSERISCI QUOTA" name="prezzo" min="15" value="15" required>
        <button type="submit" class="btn">AGGIUNGI QUOTA</button>
        <button type="button" class="btn cancel" onclick="closeForm()">CHIUDI</button>
    </form>
</div>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>EMAIL</th>
                <th>NUMERO DI TELEFONO</th>
                <th>AZIONI</th>
            </tr>
        </thead>
        <tbody>
        <?php

include '../conn/connessione.php';

        $sql1 = "SELECT ID_utente, nome, cognome, email, telefono FROM utente WHERE ruolo = 'partecipante'";
        $result1 = $conn->query($sql1);

        $utenti = [];
    
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $utenti[$row1['ID_utente']] = $row1;
                echo "<tr>";
                echo "<td>" . $row1["nome"] . "</td>";
                echo "<td>" . $row1["cognome"] . "</td>";
                echo "<td><a href='mailto:" . $row1["email"] . "'>" . $row1["email"] . "</a></td>";
                echo "<td><a href='tel:" . $row1["telefono"] . "'>" . $row1["telefono"] . "</a></td>";
                echo "<td>
                <form method='post' action='eliminautente.php'>
                    <input type='hidden' name='nome' value='" . $row1["nome"] . "'>
                    <input type='hidden' name='cognome' value='" . $row1["cognome"] . "'>
                    <button type='submit' name='elimina'>Elimina</button>
                </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nessun utente trovato.</td></tr>";
        }
        ?>
        
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>DATA</th>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>QUOTA VERSATA</th>
                <th>ELIMINA VERSAMENTO</th>
            </tr>
        </thead> 
        <tbody>
        <?php
include '../conn/connessione.php';

        $sql2 = "SELECT prenotazione.data, prenotazione.quota_versata, utente.nome, utente.cognome, utente.ID_utente
                 FROM prenotazione
                 INNER JOIN utente ON prenotazione.ID_utente = utente.ID_utente";
        
                     $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row2["data"] . "</td>";
                echo "<td>" . $row2["nome"] . "</td>";
                echo "<td>" . $row2["cognome"] . "</td>";
                echo "<td>" . $row2["quota_versata"] . "</td>";
                echo "<td>
                    <form method='post' action='elimina.php'>
                        <input type='hidden' name='data' value='" . $row2["data"] . "'>
                        <input type='hidden' name='quota_versata' value='" . $row2["quota_versata"] . "'>
                        <button type='submit' name='elimina'>Elimina</button>
                    </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nessun versamento trovato.</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>
</div>
<footer class="site-footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Sito </h3>
                <p>Disegnato da <a href="#" target="_blank">ROBERTO DE BARI</a></p>
                <p>Sviluppato da <a href="#" target="_blank">ROBERTO DE BARI</a></p>
            </div>
            <div class="footer-column">
                <h3>Contatti</h3>
                <ul>
                    <li>EMAIL: <a href="mailto:robydebari2005@gmail.com">robydebari2005@gmail.com</a></li>
                    <li>TELEFONO: <a href="tel:3383004741">3383004741</a></li>
                    <li><a href="https://wa.me/3383004741" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Seguimi su </h3>
                <ul class="social-links">
                    <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="https://github.com/Robby12849" target="_blank"><i class="fab fa-github"></i> GitHub</a></li>
                    <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Your Company. All Rights Reserved.</p>
        </div>
    </footer>
<script src="../js/popup.js"></script>
</body>
</html>
