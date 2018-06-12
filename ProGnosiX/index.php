<!DOCTYPE html>
<?php
require 'db.php';
session_start();
$_SESSION['logged_in'] = 0;
if ( $_SESSION['logged_in'] == 1 ) {
  die();
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="ProGnosiX - Autoevaluare">
  <meta name="keywords" content="fii, info iasi, game">
  <meta name="author" content="Acasandrei Beatrice, Simion Cosmin">
  <title>ProGnosiX | Welcome</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="alternate" type="application/rss+xml"
  href="./rss_feed.php" title="Rss Feed">
</head>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['login']))
  {
    require 'login.php';
  }
}
?>
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
            echo "<li class=\"current\"><a href=\"index.php\">Acasă</a></li>";
          }
          echo "<li class=\"\"><a href=\"grades.php\">Rezultate</a></li>";
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

  <section id="showcase">
    <div class="container">
      <h1>ProGnosiX for FII students</h1>
      <p>Platforma destinată studenților de la FII. Aceasta îți dă ocazia să te autoevaluezi și să obții bonusuri pe baza corectitudinii evaluării. </p>
      <p>Crezi că știi cum te-ai descurcat la ultimul examen? Cum mereu este loc de mai bine, testeazăți intuiția și mărește-ți punctajul.</p>
      <p>Dacă dorești să îți încerci norocul logheză-te cu adresa ta de WebMail.</p>
    </div>
  </section>

  <section id="logging">
    <div class="container">
      <h1>Logare</h1>
      <form action="index.php" method="post" autocomplete="on">
        <input type="email"  name="email" placeholder="Introduceți email-ul" required>
        <input type="password" required autocomplete="off" name="parola" placeholder="Introduceți parola" required>
        <button class="button_1" name = "login">Intră în cont</button>
      </form>
    </div>
  </section>

  <footer>
    <p>The ProGnosiX Game, Copyright &copy; 2018</p>
  </footer>

</body>
</html>
<?p
