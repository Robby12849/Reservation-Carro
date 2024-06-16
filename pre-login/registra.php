<?php      
include '../conn/connessione.php';
$cognome = $_POST["cognome"];  
$nome = $_POST["nome"];  
$email = strtolower($_POST["email"]);  
$telefono = $_POST["numtel"];  
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "INSERT INTO utente (cognome, nome, email, telefono, password) ";  
$sql .= "VALUES ('$cognome', '$nome', '$email', '$telefono', '$password')";  
if ($conn->query($sql)) {         
    echo "<script>alert('Utente registrato correttamente'); window.location.href = '../index.html';</script>";
} else {         
    echo "<script>alert('Utente non registrato ');</script>";    
}
$conn->close();   

