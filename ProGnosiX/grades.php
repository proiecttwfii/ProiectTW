<!DOCTYPE html>
<?php
require 'db.php';
session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="ProGnosiX - Autoevaluare">
	  <meta name="keywords" content="fii, info iasi, game">
  	<meta name="author" content="Acasandrei Beatrice, Simion Cosmin">
    <title>ProGnosiX | Punctaje</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1>The <span class="highlight">ProGnosiX</span> game</h1>
        </div>
        <nav>
          <ul>
            <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 0)  {
                  echo "<li class=\"\"><a href=\"index.php\">Acasă</a></li>";
                }
                echo "<li class=\"current\"><a href=\"grades.php\">Rezultate</a></li>";
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 0)  {
                  echo "<li class=\"\"><a href=\"contact.php\">Contact</a></li>";
                }
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1)  {
                  echo "<li class=\"\"><a href=\"user.php\">Profil</a></li>
                  <li><a href=\"logout.php\">Logout</a></li>";
                }
            ?>
          </ul>
        </nav>
      </div>
    </header>

<!--
    <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 0) {
      echo " <section id=\"logging\">
            <div class=\"container\">
              <h1>Logare</h1>
              <form action=\"index.php\" method=\"post\" autocomplete=\"on\">
                <input type=\"email\"  name=\"email\" placeholder=\"Introduceți email-ul\">
                <input type=\"password\" required autocomplete=\"off\" name=\"parola\" placeholder=\"Introduceți parola\">
                <button class=\"button_1\" name = \"login\">Intră în cont</button>
              </form>
            </div>
          </section>";
    }
    ?> -->
    
    <section id="main">
      <div class="container">
        <article id="main-col-grades">
            <h1 class="page-title">Rezultate</h1>
            <ul id="services-grades">
              <li>
                <h3> <a href="date1.pdf" download="rezultate_sgbd">Rezultate SGBD Test 1</a></h3>
              </li>
              <li>
                <h3> <a href="date1.pdf" download="rezultate_en">Rezultate Limba engleza Test 1</a></h3>
              </li>
              <li>
                <h3> <a href="date1.pdf" download="rezultate_java1">Rezultate Java Tema 1</a></h3>
              </li>
              <li>
                <h3> <a href="date1.pdf" download="rezultate_java2">Rezultate Java Tema 2</a></h3>
              </li>
            </ul>
        </article>
      </div>
    </section>

    <footer>
      <p>The ProGnosiX Game, Copyright &copy; 2018</p>
    </footer>
  </body>
</html>
