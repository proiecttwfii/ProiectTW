<!DOCTYPE html>
<?php
require 'db.php';
session_start();
if(!$_SESSION['logged_in'] or ($_SESSION['logged_in'] && !$_SESSION['admin'])) {
  header("location:index.php");
  die();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ProGnosiX | Admin</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/main.js"></script>
  </head>

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['add_user']))
      {
        require 'add_user.php';
      }
      elseif (isset($_POST['creare_runda']))
      {
        require 'insert_round.php';
      }
      elseif (isset($_POST["delete_user_id"]))
      {
        require 'delete_user.php';
      }
      elseif (isset($_POST["delete_round_id"]))
      {
        require 'delete_round.php';
      }
      elseif (isset($_POST["stop_round_id"]))
      {
        require 'stop_round.php';
      }
      elseif (isset($_POST["delete_message_id"]))
      {
        require 'delete_message.php';
      }
      elseif(isset($_POST["clearInbox"]))
      {
        require 'clear_inbox.php';
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
            <li><a href="logout.php">LOGOUT</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <div id="w">
      <div id="content" class="clearfix">
        <h1>Admin page</h1>

        <nav id="profiletabs">
          <ul id = "admlist">
            <li><a href="#users"  id="adm0" class="sel" >Studenti</a></li>
            <li><a href="#rounds" id="adm1" >Runde</a></li>
            <li><a href="#istoric"id="adm2" >Istoric</a></li>
            <li><a href="#inbox"  id="adm3" >Inbox</a></li>
          </ul>
          </ul>
        </nav>

        <section id="users">
          <div style="overflow-x:auto;">
            <table class="adminTable">
              <tr>
                <th>Nume</th>
                <th>An</th>
                <th>Grupa</th>
                <th>Email</th>
                <th></th>
              </tr>
              <?php
              // $results = $mysqli->query("SELECT distinct id_student as smt FROM prognoze") or die($mysqli->error());
              $results = $mysqli->query("SELECT * FROM accounts WHERE admin != 1") or die($mysqli->error());
               while ($row = $results->fetch_assoc()) {
                echo "<tr\><td>".$row["nume"]." ".$row["prenume"]."</td><td>".$row["an"]."</td><td>".$row["grupa"]."</td><td>".$row["email"]."</td><td id=\"".$row["id"]."\" onclick=\"deleteStudent(this)\"></td></tr>";
              }
              ?>

            </table>
            <button type="button" class="addUserBtn" onclick="addUser()">Adaugare student</button>
          </div>
        </section>

        <section id="rounds" class="hidden">
          <div style="overflow-x:auto;">
            <table class="adminTable" id="roundsTable">
              <tr>
                <th>Materie</th>
                <th>Nota la</th>
                <th>An</th>
                <th>Nr. total participanti</th>
                <th></th>
              </tr>
              <?php
              $results = $mysqli->query("SELECT * FROM runde where runda_activa = 1") or die($mysqli->error());
               while ($row = $results->fetch_assoc()) {
                 $id = $row["id_materie"];
                 $id_runda = $row["id_runda"];
                 $materii = $mysqli->query("SELECT * FROM materie where id_materie = '$id'");
                 $materie = $materii->fetch_assoc();
                 $prognoze_runde = $mysqli->query("SELECT COUNT(id_prognoza) as total FROM prognoze where id_runda = '$id_runda' ");
                 $count_particip = $prognoze_runde->fetch_assoc();
                echo "<tr\><td>".$materie["nume_materie"]."</td><td>".$row["nume_runda"]." </td><td>".$materie["an"]."</td><td>".$count_particip["total"]."</td><td id=\"".$row["id_runda"]."\" onclick=\"stopRound(this)\"></td></tr>";
              }
              ?>
            </table>
            <button type="button" class="addUserBtn" onclick="addRound()">Adaugare runda
            </button>
          </div>
        </section>

        <section id="history" class="hidden">
          <div style="overflow-x:auto;">
            <table class="adminTable">
              <tr>
                <th>Materie</th>
                <th>Nota la</th>
                <th>An</th>
                <th>Nr. total participanti</th>
                <th></th>
              </tr>
              <?php
              $results = $mysqli->query("SELECT * FROM runde where runda_activa = 0") or die($mysqli->error());
               while ($row = $results->fetch_assoc()) {
                 $id = $row["id_materie"];
                 $id_runda = $row["id_runda"];
                 $materii = $mysqli->query("SELECT * FROM materie where id_materie = '$id'");
                 $materie = $materii->fetch_assoc();
                 $prognoze_runde = $mysqli->query("SELECT COUNT(id_prognoza) as total FROM prognoze where id_runda = '$id_runda' ");
                 $count_particip = $prognoze_runde->fetch_assoc();
                echo "<tr\><td>".$materie["nume_materie"]."</td><td>".$row["nume_runda"]." </td><td>".$materie["an"]."</td><td>".$count_particip["total"]."</td><td id=\"".$row["id_runda"]."\" onclick=\"deleteRound(this)\"></td></tr>";
              }
              ?>
            </table>
            <button type="button" class="addUserBtn" disabled>
            </button>
          </div>
        </section>

        <section id="inbox" class="hidden">
          <div style="overflow-x:auto;">
            <table class="adminTable">
              <tr>
                <th>Email</th>
                <th>Nume</th>

                <th>An</th>
                <th>Grupa</th>
                <th>Data</th>
                <th></th>
              </tr>
              <?php
              $results = $mysqli->query("SELECT * FROM inbox") or die($mysqli->error());
              while ($row = $results->fetch_assoc()) {
                echo "<tr\><td>".$row["email"]."</td><td>".$row["nume"]." ".$row["prenume"]."</td><td>".$row["an"]."</td><td>".$row["grupa"]."</td><td>".$row["data_mesaj"]."</td><td id=\"".$row["id_mesaj"]."\" onclick=\"deleteMessage(this)\"></td></tr>";
              }
              ?>
            </table>
            <button type="submit" class="addUserBtn" disable>
            </button>
          </div>
        </section>
      </div>
    </div>

    <div id="addRoundDialog" class="modal">
      <div class="modal-content">
        <div class="modal-header">
            <span onclick="document.getElementById('addRoundDialog').style.display='none'" class="modalButton">&times;</span>
            <h2>Adauga o runda noua</h2>
        </div>
        <div class="modal-body">
            <p>Completati specificatiile rundei</p>
            <form action="admin.php" method="post" autocomplete="on" enctype="multipart/form-data">
            <p>
            Materie:<select name="materie_creare_runda">
              <?php
              $results = $mysqli->query("SELECT * FROM materie") or die($mysqli->error());
              while ($row = $results->fetch_assoc()) {
                echo "<option>".$row["nume_materie"]."</option>";
              }
              ?>
              </select>
              </p>
              <p>
                Nota la: <input type="text" name="nume_runda" required>
              </p>
              <p>
                Incarca notele originale: <input type="file" name="fileToUpload" id="fileToUpload" required>
              </p>
          <button type="submit" class="button_2" name="creare_runda">Creare</button>
        </form>
        </div>
      </div>
    </div>

    <div id="addUserDialog" class="modal">
      <div class="modal-content">
        <div class="modal-header">
            <span onclick="document.getElementById('addUserDialog').style.display='none'" class="modalButton">&times;</span>
            <h2>Adauga utilizator nou</h2>
        </div>
        <div class="modal-body">
          <p>Completati datele utilizatorului</p>
          <form action="admin.php" method="post" autocomplete="on">

          <p>Nume:</p>
          <p><input type="text" name="nume_user" required></p>
          <p>Prenume:</p>
          <p><input type="text" name="prenume_user" required></p>
          <p>An:</p>
          <p><select name="an_user">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
            </p>
            <p>Grupa:</p>
            <p><select name="grupa_user">
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="A4">A4</option>
                    <option value="A5">A5</option>
                    <option value="A6">A6</option>
                    <option value="A7">A7</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="B3">B3</option>
                    <option value="B4">B4</option>
                    <option value="B5">B5</option>
                    <option value="B6">B6</option>
                    <option value="B7">B7</option>
                    <option value="E">E</option>
                    </select>
              </p>
            <p>E-mail:</p>
            <p><input type="email" name="email_user" required></p>
            <p>Parola:</p>
            <p><input type="text" name="parola_user" required></p>

          <button class="button_2" name = "add_user">Trimite</button>
        </form>

        </div>

      </div>
      <div>
        <form id="hiddenFormUser" name="hiddenForm" method="post" action="admin.php">
        <input type="hidden" name="delete_user_id" id="delete_user_id" value="">
        </form>
      </div>
      <div>
        <form id="hiddenFormRound" name="hiddenForm" method="post" action="admin.php">
        <input type="hidden" name="stop_round_id" id="stop_round_id" value="">
        </form>
      </div>
      <div>
        <form id="hiddenFormRound" name="hiddenForm" method="post" action="admin.php">
        <input type="hidden" name="delete_round_id" id="delete_round_id" value="">
        </form>
      </div>
      <div>
        <form id="hiddenFormMessage" name="hiddenForm" method="post" action="admin.php">
        <input type="hidden" name="delete_message_id" id="delete_message_id" value="">
        </form>
      </div>
    </div>
        <script>

        function deleteStudent(elem)
        {
          if (confirm("Are you sure you want to delete this student?"))
          {
            var hiddenElement = document.getElementById("delete_user_id");
            hiddenElement.value = elem.id;
            hiddenElement.form.submit();
          }
        }

        function deleteRound(elem)
        {
          if (confirm("Are you sure you want to delete this round?"))
          {
            var hiddenElement = document.getElementById("delete_round_id");
            console.log(elem.id);
            hiddenElement.value = elem.id;
            hiddenElement.form.submit();
          }
        }

        function stopRound(elem)
        {
          if (confirm("Are you sure you want to stop this round?"))
          {
            var hiddenElement = document.getElementById("stop_round_id");
            console.log(elem.id);
            hiddenElement.value = elem.id;
            hiddenElement.form.submit();
          }
        }

        function deleteMessage(elem)
        {
          if (confirm("Are you sure you want to delete this message?"))
          {
            var hiddenElement = document.getElementById("delete_message_id");
            console.log(elem.id);
            hiddenElement.value = elem.id;
            hiddenElement.form.submit();
          }
        }


        function addRound(){
          document.getElementById('addRoundDialog').style.display='block';
        }
        function addUser(){
          document.getElementById('addUserDialog').style.display='block';
        }

        var items = document.querySelectorAll("#admlist li"),
        tab = [], index;
        var users = document.getElementById("users");
        var rounds = document.getElementById("rounds");
        var istoric = document.getElementById("history");
        var inbox = document.getElementById("inbox");
        var li0 = document.getElementById("adm0");
        var li1 = document.getElementById("adm1");
        var li2 = document.getElementById("adm2");
        var li3 = document.getElementById("adm3");
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
                  if (aux == 0)
                  {
                    li0.classList.add("sel");
                    li1.classList.remove("sel");
                    li2.classList.remove("sel");
                    li3.classList.remove("sel");
                    users.classList.remove("hidden");
                    rounds.classList.add("hidden");
                    istoric.classList.add("hidden");
					          inbox.classList.add("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
                   else if (aux == 1)
                  {
                    li0.classList.remove("sel");
                    li1.classList.add("sel");
                    li2.classList.remove("sel");
                    li3.classList.remove("sel");
                    users.classList.add("hidden");
                    rounds.classList.remove("hidden");
                    istoric.classList.add("hidden");
                    inbox.classList.add("hidden");
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
                    li3.classList.remove("sel");
                    users.classList.add("hidden");
                    rounds.classList.add("hidden");
                    istoric.classList.remove("hidden");
                    inbox.classList.add("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
                   else if (aux == 3)
                  {
                    li0.classList.remove("sel");
                    li1.classList.remove("sel");
                    li2.classList.remove("sel");
                    li3.classList.add("sel");
                    users.classList.add("hidden");
                    rounds.classList.add("hidden");
                    istoric.classList.add("hidden");
                    inbox.classList.remove("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
              };
          }

          var addRoundModal = document.getElementById('addRoundDialog');
          var addUserModal = document.getElementById('addUserDialog');
          window.addEventListener('click', outsideClick);
          // Function to close modal if outside click
          function outsideClick(e){
            if(e.target == addRoundModal){
              addRoundModal.style.display = 'none';
            }
          else  if(e.target == addUserModal){
              addUserModal.style.display = 'none';
            }
          }

        </script>

    <footer>
      <p>The ProGnosiX Game, Copyright &copy; 2018</p>
    </footer>

  </body>
</html>
