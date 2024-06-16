<?php
session_start();
session_destroy(); 
echo '<script>alert("Disconnessione riuscita, arrivederci!"); window.location = "../index.html";</script>';

