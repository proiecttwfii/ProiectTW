<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="ProGnosiX - Autoevaluare">
	  <meta name="keywords" content="fii, info iasi, game">
  	<meta name="author" content="Acasandrei Beatrice, Simion Cosmin">
    <title>ProGnosiX | Contact</title>
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
            <li><a href="grades.php">Punctaje</a></li>
            <li class="current"><a href="contact.php">Contact</a></li>
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
                <h3>Contactați-ne</h3>
                <form class="contact">
                  <div>
                    <label>Nume</label><br>
                    <input type="text" placeholder="Nume">
                  </div>
                  <div>
                    <label>Prenume</label><br>
                    <input type="text" placeholder="Prenume">
                  </div>
                  <div>
                    <label>An, Grupa</label><br>
                    <input type="text" placeholder="An, Grupa">
                  </div>
                  <div>
                    <label>Email</label><br>
                    <input type="email" placeholder="Adresa de email">
                  </div>
                  <div>
                    <label>Mesaj</label><br>
                    <textarea placeholder="Mesaj"></textarea>
                  </div>
                  <button class="button_1" type="submit">Send</button>
              </form>
              </div>
            </aside>
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