<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_carro"; 
    $port = 3307;
    $conn = new mysqli($servername, $username, $password, $dbname, $port);    
    if ($conn->connect_error) {
        echo "Connessione fallita: " . $conn->connect_error;
    }