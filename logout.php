<?php 
session_start();    
// elimina le variabili di sessione impostate    
$_SESSION = array();    
// elimina la sessione    
session_destroy();    
echo "Disconnessione riuscita, arrivederci!" ;
echo "<form action='login.html' method='POST'>";
echo "<input type='submit' name='Failogin' value='Torna al login'>";
echo "</form>";  
