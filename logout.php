<?php
session_start();
session_destroy(); // Chiude la sessione
// Reindirizza l'utente a index.html con un messaggio di avviso tramite JavaScript
echo '<script>alert("Disconnessione riuscita, arrivederci!"); window.location = "index.html";</script>';

