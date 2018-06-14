<!DOCTYPE html>
<?php
  require 'db.php';
  session_start();
  if ( $_SESSION['logged_in'] != 1 ) {
  header("location:index.php");
  die();
}
else if ($_SESSION['logged_in'] && $_SESSION['admin']) {
  header("location:admin.php");
}
else {
    $email = $_SESSION['email'];
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="ProGnosiX - Autoevaluare">
	  <meta name="keywords" content="fii, info iasi, game">
  	<meta name="author" content="Acasandrei Beatrice, Simion Cosmin">
    <title>ProGnosiX | Profil</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['add_prognosix']))
  {
    require 'add_prognosix.php';
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
                echo "<li class=\"\"><a href=\"grades.php\">Rezultate</a></li>";
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 0)  {
                  echo "<li class=\"\"><a href=\"contact.php\">Contact</a></li>";
                }
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1)  {
                  echo "<li class=\"current\"><a href=\"user.php\">Profil</a></li>
                  <li><a href=\"logout.php\">Logout</a></li>";
                }
            ?>
          </ul>
        </nav>
      </div>
    </header>

    <div id="w">
      <div id="content" >
        <h1>Profil student</h1>

        <nav id="profiletabs">
          <ul id="list">
            <li><a href="#settings" id="li0" class="sel">Informații</a></li>
            <li><a href="#activity" id="li1">Activitate</a></li>
            <li><a href="#subjects" id="li2">Runde disponibile</a></li>
          </ul>
        </nav>

      <?php
      $result_info = $mysqli->query("SELECT * FROM accounts WHERE email='$email'") or die($mysqli->error());
      $user = $result_info->fetch_assoc();
      $nume =$user['nume'];
      $prenume = $user['prenume'];
      $an = $user['an'];
      $semestru = $user['semestru'];
      $grupa = $user['grupa'];
      $id = $user['id'];
      ?>
        <section id="settings">
          <p class="setting"><span>Nume</span><?= $nume?></p>

          <p class="setting"><span>Prenume</span><?=$prenume?></p>

          <p class="setting"><span>E-mail </span><?= $email ?></p>

          <p class="setting"><span>Anul</span> <?= $an ?></p>

          <p class="setting"><span>Semestrul </span> <?= $semestru?></p>

          <p class="setting"><span>Grupa </span> <?= $grupa ?></p>

        </section>

        <section id="activity" class="hidden">
          <?php
          $result_activity = $mysqli->query("SELECT * FROM prognoze INNER JOIN accounts ON accounts.id = prognoze.id_student WHERE email = '$email'") or die($mysqli->error());
           while ($row = $result_activity->fetch_assoc()) {
             $runde = $mysqli->query("SELECT * FROM runde where id_runda = ".$row["id_runda"]." ");
             $runda = $runde->fetch_assoc();
             $materii = $mysqli->query("SELECT * FROM materie where id_materie = ".$runda["id_materie"]." ");
             $materie = $materii->fetch_assoc();
             echo "<p class=\"activity\"> ".$row["data_prognoza"]." - ".$materie["nume_materie"]." - ".$runda["nume_runda"]." - Prognoză: ".$row["prognoza_student"]."</p>";
          }
          ?>
        </section>

        <section id="subjects" class="hidden">
          <?php

          $result_runde = $mysqli->query("SELECT * FROM runde INNER JOIN materie ON runde.id_materie = materie.id_materie WHERE materie.an = '$an' and materie.semestru = '$semestru'") or die($mysqli->error());

          $i = 0;
          while ($row = $result_runde->fetch_assoc()) {
            $result = $mysqli->query("SELECT * FROM prognoze WHERE id_runda = ".$row["id_runda"]." and id_student = '$id'") or die($mysqli->error());
            if ( $result->num_rows == 0 ) {
               $i++;
               $materii = $mysqli->query("SELECT * FROM materie where id_materie = ".$row["id_materie"]." ");
               $materie = $materii->fetch_assoc();
               echo "<p id=\"".$i."\" class=\"subjects\" >".$materie["nume_materie"]." - ".$row["nume_runda"]."</p>";
               $vec[$i] = array($materie["nume_materie"], $row["nume_runda"], $row["id_runda"]);
            }
          }
          ?>
        </section>
      </div>
    </div>

      <div id="simpleModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h2 id="nume_materie"></h2>
          </div>
          <div class="modal-body">
            <p>Autoevaluare</p>
            <p id="nume_runda">Autoevaluare</p>
            <form action="user.php" method="post" autocomplete="on">
            <input type="text" name="nota_propusa" required>
            <input type="hidden" id="hiddencontainer" name="hiddencontainer"/>
            <button type="submit" class="button_2" name="add_prognosix">Trimite</button>
          </form>

          </div>
        </div>
      </div>

      <script>
        var items = document.querySelectorAll("#list li"),
        tab = [], index;
        var subjects = document.getElementById("subjects");
        var settings = document.getElementById("settings");
        var activity = document.getElementById("activity");
        var li0 = document.getElementById("li0");
        var li1 = document.getElementById("li1");
        var li2 = document.getElementById("li2");
          // add values to the array
          tab = [], index;
          for(var i = 0; i < items.length; i++){
             tab.push(items[i].innerHTML);
           }
          // get selected element index
          for(var i = 0; i < items.length; i++)
          {
              items[i].onclick = function(){
                 index = tab.indexOf(this.innerHTML);
                  console.log(this.innerHTML + " Index = " + index);
                  var aux = index;
                    if (aux == 1)
                  {
                    li0.classList.remove("sel");
                    li1.classList.add("sel");
                    li2.classList.remove("sel");
                    settings.classList.add("hidden");
                    activity.classList.remove("hidden");
                    subjects.classList.add("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
                  else if (aux == 0)
                  {
                    li0.classList.add("sel");
                    li1.classList.remove("sel");
                    li2.classList.remove("sel");
                    settings.classList.remove("hidden");
                    activity.classList.add("hidden");
                    subjects.classList.add("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
                  else if (aux == 2)
                  {
                    li0.classList.remove("sel");
                    li1.classList.remove("sel");
                    li2.classList.add("sel");
                    settings.classList.add("hidden");
                    activity.classList.add("hidden");
                    subjects.classList.remove("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
              };
          }
        </script>

        <script type="text/javascript">
        // Get modal element
        var modal = document.getElementById('simpleModal');

        var count = <?php echo $i;?>;
              while (count > 0) {
                // Get open modal button
                document.getElementById(count).addEventListener('click', openModal);
                count --;
              }

        // Get close button
        var closeBtn = document.getElementsByClassName('closeBtn')[0];
        // Listen for close click
        closeBtn.addEventListener('click', closeModal);
        // Listen for outside click
        window.addEventListener('click', outsideClick);

        // Function to open modal
        function openModal(){
          var content = <?php echo json_encode($vec); ?>;
          document.getElementById("nume_materie").innerHTML = content[this.id][0];
          document.getElementById("nume_runda").innerHTML = content[this.id][1];
          var myhidden = document.getElementById("hiddencontainer");
          myhidden.value=content[this.id][2];
          modal.style.display = 'block';
        }

        // Function to close modal
        function closeModal(){
          modal.style.display = 'none';
        }
        // Function to close modal if outside click
        function outsideClick(e){
          if(e.target == modal){
            modal.style.display = 'none';
          }
        }
        </script>

    <footer>
      <p>The ProGnosiX Game, Copyright &copy; 2018</p>
    </footer>

  </body>
</html>
