<?php     
$host = "localhost";  
$username = "root";  
$password = "";  
$db_nome = "db_carro";  
$tab_nome = "utente";  

// Connessione al server  
$conn = new mysqli($host, $username, $password, $db_nome);     

if ($conn->connect_errno) {        
    echo "Impossibile connettersi al server: " . $conn->connect_error . "\n";        
    exit;     
}  

// Acquisizione dati dal form HTML  
$email = strtolower($_POST["email"]);  
$password = $_POST["password"];   

// Lettura della tabella utenti  
$controllo = false;  
$sql = "SELECT * FROM $tab_nome WHERE username='$email'";  
$result = $conn->query($sql);  
$conta = $result->num_rows;     

if ($conta == 1) {  
    $row = $result->fetch_assoc(); 
    $passc = $row['password'];  
    $ruolo = $row['ruolo'];  
    if ($password == $passc) {  
        $controllo = true;        
    }     
}     

if ($controllo) {         
    session_start();  
    $_SESSION['email'] = $email;  
    $_SESSION['password'] = $passc;  
    $_SESSION['ruolo'] = $ruolo;
    if ($ruolo == 'admin') {
        header("Location: paginaadmin.php");
    } else {
        header("Location: paginautente.php"); 
    }
} else {        
    echo '<script>alert("Credenziali Errate"); window.location = "index.html";</script>';
}
?>
