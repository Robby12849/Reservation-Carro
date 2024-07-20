<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGGIUNGI NOTIZIE</title>
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
    <a href="aggiunginotizie.php">NOTIZIE</a>
    <?php
    session_start();
    if (isset($_SESSION['nome'])) {
        $nome_maiuscolo = strtoupper(htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'));
        echo "<a href='../pre-login/logout.php'>LOGOUT $nome_maiuscolo</a>";
    }
    ?>
</div>
<div class="supercontainer">
    <button onclick="document.getElementById('id01').style.display='block'" class="notiziebtn">AGGIUNGI NOTIZIA</button>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="aggiunginotiziascript.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="../assets/img/notizia.jpg" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="titolo"><b>TITOLO</b></label> <br>
                <input type="text" placeholder="Inserisci il titolo" name="titolo" id="titolo" required><br>
                <label for="contenuto"><b>CONTENUTO</b></label> <br>
                <input type="text" placeholder="Inserisci il contenuto" name="contenuto" id="contenuto" required><br>
                <label for="data"><b>DATA DI RIFERIMENTO</b></label><br>
                <input type="date" placeholder="Inserisci la data da quando il contenuto è valido" id="data" name="data"><br>
                <button type="submit">Inserisci</button>
            </div>
        </form>
    </div>
    <div class="news-container"></div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function fetchNewsFromServer() {
                return fetch('prendinews.php')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); 
                        return data;
                    });
            }

            function displayNews(newsItems) {
                const newsContainer = document.querySelector('.news-container');
                let newsRow;

                newsItems.forEach((item, index) => {
                    if (index % 4 === 0) {
                        newsRow = document.createElement('div');
                        newsRow.classList.add('news-row');
                        newsContainer.appendChild(newsRow);
                    }

                    const newsItem = document.createElement('div');
                    newsItem.classList.add('news-item');
                    newsItem.innerHTML = `<h2>${item.titolo}</h2><p>${item.data_di_riferimento}</p><p>${item.notizia}</p>`;
                    newsRow.appendChild(newsItem);
                });
            }

            fetchNewsFromServer().then(newsItems => {
                displayNews(newsItems);
            }).catch(error => {
                console.error('Error fetching news:', error);
            });
        });
    </script>
</div>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>Sito</h3>
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
            <h3>Seguimi su</h3>
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
var modal = document.getElementById('id01');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>
