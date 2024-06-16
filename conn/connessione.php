<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_carro"; 
    $conn = new mysqli($servername, $username, $password, $dbname);    
    if ($conn->connect_error) {
        echo "Connessione fallita: " . $conn->connect_error;
    }