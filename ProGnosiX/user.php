<!DOCTYPE html>
<?php
  require 'db.php';
  session_start();
  if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  //header("location: error.php");
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
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1>The <span class="highlight">ProGnosiX</span> game</h1>
        </div>
        <nav>
          <ul>
            <li><a href="index.php">Acasă</a></li>
            <li><a href="grades.php">Rezultate</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="current"><a href="user.php">Profil</a></li>
            <li><a href="logout.php">Logout</a></li>
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
             echo "<p class=\"activity\"> ".$row["data_prognoza"]." - Prognoză - ".$materie["nume_materie"]." - ".$runda["nume_runda"]." - Punctaj final: ".$row["prognoza_student"]."</p>";
          }
          ?>

        </section>

        <section id="subjects" class="hidden">
          <?php
          $result_runde = $mysqli->query("SELECT * FROM runde INNER JOIN materie ON runde.id_materie = materie.id_materie WHERE materie.an = '$an' and materie.semestru = '$semestru'") or die($mysqli->error());
          $i = 0;
          while ($row = $result_runde->fetch_assoc()) {
            $i++;
             $materii = $mysqli->query("SELECT * FROM materie where id_materie = ".$row["id_materie"]." ");
             $materie = $materii->fetch_assoc();
             echo "<p id=\"".$i."\" class=\"subjects\" >".$materie["nume_materie"]." - ".$row["nume_runda"]."</p>";
          }
          ?>
        </section>
      </div>
    </div>

      <div id="simpleModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h2>Practică SGBD</h2>
          </div>
          <div class="modal-body">
            <p>Autoevaluare Test 1</p>
            <input type="text">
            <button type="submit" class="button_2">Trimite</button>
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


      //while (<?php $i!=0;?>) {
        // Get open modal button
        var modalBtn<?php echo $i;?> = document.getElementById('<?php echo $i;?>');
        // Listen for open click
        modalBtn<?php echo $i;?>.addEventListener('click', openModal);
        <?php $i--;?>
      //}


        // Get close button
        var closeBtn = document.getElementsByClassName('closeBtn')[0];
        // Listen for close click
        closeBtn.addEventListener('click', closeModal);
        // Listen for outside click
        window.addEventListener('click', outsideClick);

        // Function to open modal
        function openModal(){
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
