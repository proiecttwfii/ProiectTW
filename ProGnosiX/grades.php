<!DOCTYPE html>
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
            <li><a href="index.php">Acasă</a></li>
            <li class="current"><a href="grades.php">Punctaje</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
      </div>
    </header>


    <section id="logging">
      <div class="container">
        <h1>Logare</h1>
        <form>
          <input type="email" id="username" placeholder="Introduceți email-ul">
          <input type="password" placeholder="Introduceți parola">
          <button type="submit" id="login" class="button_1">Intră în cont</button>
        </form>
      </div>
    </section>

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

    <script type="text/javascript">
      document.getElementById("login").onclick = function() {
        var username = document.getElementById("username").value;
        if(username == "user")
          setTimeout('window.location.href="user.php"', 0);
        else if(username == "admin")
          setTimeout('window.location.href="admin.php"', 0);
      };
    </script>

    <footer>
      <p>The ProGnosiX Game, Copyright &copy; 2018</p>
    </footer>
  </body>
</html>
