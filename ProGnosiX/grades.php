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
    <link rel="alternate" type="application/rss+xml"
    href="./rss_feed.php" title="Rss Feed">
  </head>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['generate_pdf']))
    {
      require 'generate_pdf.php';
    }
    else if(isset($_POST['generate_csv']))
      {
        require 'generate_csv.php';
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
          <h1 class="page-title"><a href="./rss_feed.php"><img src="./img/RSS.png" alt="Rss icon" style="width:100px;height:100px;"> </a> </h1>
            <h1 class="page-title">Rezultate</h1>
            <ul id="services-grades">
              <form action="" method="post">
                <input type="hidden" name="generate_id" id="generate_id" value="">

              <?php
              $result = $mysqli->query("SELECT * FROM runde WHERE runda_activa = 0 order by data_stop_runda desc") or die($mysqli->error());
              while ($row = $result->fetch_assoc()) {
                $id_runda = $row['id_runda'];
                 $materii = $mysqli->query("SELECT * FROM materie where id_materie = ".$row["id_materie"]." ");
                 $materie = $materii->fetch_assoc();
                 echo "<li><h1><p>Rezultate ".$materie["nume_materie"]." - ".$row["nume_runda"]."</p>
                 <button class=\"button_1\" name = \"generate_pdf\" type = \"submit\" id=\"$id_runda\" onclick=\"generare_pdf(this)\" >PDF</button>
                 <button class=\"button_1\" name = \"generate_csv\" type = \"submit\" id=\"$id_runda\" onclick=\"generare_csv(this)\" >CSV</button>
                 </h1></li>";
              }
              ?>
              </form>
            </ul>
        </article>
      </div>
    </section>

    <script type="text/javascript">
        function generare_pdf(elem)
        {
            var hiddenElement = document.getElementById("generate_id");
            hiddenElement.value = elem.id;
            hiddenElement.form.submit();
        }
        function generare_csv(elem)
        {
            var hiddenElement = document.getElementById("generate_id");
            hiddenElement.value = elem.id;
            hiddenElement.form.submit();
        }
    </script>

    <footer>
      <p>The ProGnosiX Game, Copyright &copy; 2018</p>
    </footer>
  </body>
</html>
