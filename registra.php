<?php      
$host = "localhost";  
$username = "root";  
$password = "";  
$db_nome = "db_carro";  
$conn = new mysqli($host, $username, $password, $db_nome);      
if ($conn->connect_errno) {          
    echo "Impossibile connettersi al server:  " . $conn->connect_error."\n";         
    exit;       
}  
// acquisizione dati dal form HTML  
$cognome = $_POST["cognome"];  
$nome = $_POST["nome"];  
$email = strtolower($_POST["email"]);  
$telefono = $_POST["numtel"];  
$password = $_POST["password"] ;
// comando SQL  
$sql = "INSERT INTO utente (cognome, nome, username, telefono, password) ";  
$sql .= "VALUES ('$cognome', '$nome', '$email', '$telefono', '$password')";  
if ($conn->query($sql)) {         
    // Utente registrato correttamente, mostra un alert
    echo "<script>alert('Utente registrato correttamente'); window.location.href = 'index.html';</script>";
} else {         
    echo "<script>alert('Utente non registrato ');</script>";    
}
$conn->close();   

