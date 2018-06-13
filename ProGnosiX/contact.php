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
  <title>ProGnosiX | Contact</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="alternate" type="application/rss+xml"
  href="./rss_feed.php" title="Rss Feed">
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
          echo "<li class=\"\"><a href=\"grades.php\">Rezultate</a></li>";
          if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 0)  {
            echo "<li class=\"current\"><a href=\"contact.php\">Contact</a></li>";
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

  <!-- <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['add_request']))
    require 'add_request.php';
  }
  ?> -->

  <!-- <section id="logging">
  <div class="container">
  <h1>Logare</h1>
  <form action="index.php" method="post" autocomplete="on">
  <input type="email"  name="email" placeholder="Introduceți email-ul">
  <input type="password" required autocomplete="off" name="parola" placeholder="Introduceți parola">
  <button class="button_1" name = "login">Intră în cont</button>
</form>
</div>
</section> -->

<script language = "javascript" type = "text/javascript">
   <!--
      //Browser Support Code
      function ajaxFunction(){
         var ajaxRequest;  // The variable that makes Ajax possible!

         try {
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
         }catch (e) {
            // Internet Explorer Browsers
            try {
               ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }catch (e) {
               try{
                  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
               }catch (e){
                  // Something went wrong
                  alert("Your browser broke!");
                  return false;
               }
            }
         }

         // Create a function that will receive data
         // sent from the server and will update
         // div section in the same page.

         ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
               var ajaxDisplay = document.getElementById('ajaxDiv');
               ajaxDisplay.innerHTML = ajaxRequest.responseText;
            }
         }

         // Now get the value from user and pass it to
         // server script.

         var nume_contact = document.getElementById('nume_contact').value;
         var prenume_contact = document.getElementById('prenume_contact').value;
         var an_contact = document.getElementById('an_contact').value;
         var grupa_contact = document.getElementById('grupa_contact').value;
         var email_contact = document.getElementById('email_contact').value;

         var queryString = "?nume_contact=" + nume_contact ;

         queryString +=  "&prenume_contact=" + prenume_contact + "&an_contact=" + an_contact;
         queryString +=  "&grupa_contact=" + grupa_contact + "&email_contact=" + email_contact;

         ajaxRequest.open("GET", "add_request.php" + queryString, true);
         ajaxRequest.send(null);
      }
   //-->
</script>

<section id="main">
  <div class="container">
    <article id="main-col">
      <h1 class="page-title">Contact</h1>
      <ul id="services">
        <li>
          <h3>Întâmpinați probleme?</h3>
          <p>În cazul în care sunteți student la FII și nu vă puteți accesa contul, vă rugăm să lăsati un mesaj.</p>
          <p>Înainte de a vă loga trebuie să vă știți parola de WebMail, cât și username-ul dumneavoastră.</p>
        </li>
      </ul>
    </article>
    <aside id="sidebar">
      <div class="dark">
        <h3>Cerere de înscriere</h3>
        <form class="contact" method="post" autocomplete="on">
          <div>
            <label>Nume</label><br>
            <input type="text" placeholder="Nume" id="nume_contact" required>
          </div>
          <div>
            <label>Prenume</label><br>
            <input type="text" placeholder="Prenume" id="prenume_contact" required>
          </div>
          <div>
            <label>An</label><br>
            <input type="text" placeholder="An" id="an_contact" required>
          </div>
          <div>
            <label>Grupa</label><br>
            <input type="text" placeholder="Grupa" id="grupa_contact" required>
          </div>
          <div>
            <label>Email</label><br>
            <input type="email" placeholder="Adresa de email" id="email_contact" required>
          </div>
          <div>
            <label></label><br>
          </div>

          <button class="button_1"  onclick = 'ajaxFunction()'>Trimite</button>
        </form>
      </div>
    </aside>
  </div>
</section>

<footer>
  <p>The ProGnosiX Game, Copyright &copy; 2018</p>
</footer>
</body>
</html>
