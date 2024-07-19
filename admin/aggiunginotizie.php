<html>
<head>
    <title> AGGIUNGI NOTIZIE </title>
    <link rel="stylesheet" href="../css/navbar.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/notizie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
</head>
<body>
<div class="topnav" id="top">
        <a class="active" href="paginaadmin.php">HOME ADMIN</a>
        <a href="gestiscimaterialiadm.php">MATERIALI</a> 
        <a href="contabilita.php">BILANCIO</a>
        <a href="aggihnginotizie.php">NOTIZIE</a>
        <?php
        session_start(); 
        if (isset($_SESSION['nome'])) {
            $nome_maiuscolo = strtoupper(htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'));
            echo "<a href='../pre-login/logout.php'>LOGOUT $nome_maiuscolo</a>"; 
        }
        ?>
</div>  
<div class="supercontainer" >
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
</div>

<footer class="site-footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Sito </h3>
                <p>Disegnato da <a href="#top" target="_blank">ROBERTO DE BARI</a></p>
                <p>Sviluppato da <a href="#top" target="_blank">ROBERTO DE BARI</a></p>
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
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>