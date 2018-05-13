<!DOCTYPE html>
<?php
require 'db.php';
session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ProGnosiX | Admin</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/main.js"></script>
  </head>
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
            <li><a href="#users"  id="adm0" class="sel" >Users</a></li>
            <li><a href="#rounds" id="adm1" >Rounds</a></li>
            <li><a href="#inbox"  id="adm2" >Inbox</a></li>
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
                <th>Punctaj</th>
                <th></th>
              </tr>
              <?php
              $results = $mysqli->query("SELECT * FROM prognoze") or die($mysqli->error());
               while ($row = $results->fetch_assoc()) {
                 $id = $row["id_student"];
                 $users = $mysqli->query("SELECT * FROM accounts where id = '$id'");
                 $user = $users->fetch_assoc();
                echo "<tr\><td>".$user["nume"]." ".$user["prenume"]."</td><td>".$user["an"]."</td><td>".$user["grupa"]."</td><td>+3</td><td></td></tr>";
              }
              ?>

            </table>
            <button type="button" class="addUserBtn" onclick="addUser()">Add user</button>
          </div>
        </section>

        <section id="rounds" class="hidden">
          <div style="overflow-x:auto;">
            <table class="adminTable">
              <tr>
                <th>Materie</th>
                <th>Nota la</th>
                <th>An</th>
                <th>Nr. total participanti</th>
                <th></th>
              </tr>
              <tr>
                <td>IP</td>
                <td>Tema3</td>
                <td>1</td>
                <td>45</td>
                <td></td>
              </tr>

            </table>
            <button type="button" class="addUserBtn" onclick="addRound()">Create new round
            </button>
          </div>
        </section>

        <section id="inbox" class="hidden">
          <div style="overflow-x:auto;">
            <table class="adminTable">
              <tr>
                <th>Sender</th>
                <th>Date</th>
                <th>Content</th>
                <th></th>
              </tr>
              <tr>
                <td>IoneSCU@gmail.com</td>
                <td>23/12/2017</td>
                <td>In legatura cu ultima runda...</td>
                <td></td>
              </tr>


            </table>
            <button type="button" class="addUserBtn" onclick="clearInbox()">Clear inbox
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
            <p>
            Materie:<select>
                      <option value="TW">TW</option>
                      <option value="IP">IP</option>
                      <option value="PA">PA</option>
                      <option value="PSGBD">PSGBD</option>
                    </select>
              </p>
              <p>
                Nota la: <input type="text" name="denumire">
              </p>
              <p>
                Incarca notele originale: <input type="file" id="myFile" multiple size="50" onchange="myFunction()">
              </p>

          <button type="submit" class="button_2">Create</button>
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
          <p>Completati dateleutilizatorului</p>
          <p>Nume:</p>
          <p><input type="text" name="denumire"></p>
          <p>Prenume:</p>
          <p><input type="text" name="denumire"></p>
          <p>An:</p>
          <p><select>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="Cursant">Cursant</option>
                  </select>
            </p>
            <p>Grupa:</p>
            <p><select>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="A4">A4</option>
                    <option value="A5">A5</option>
                    <option value="A6">A6</option>
                    <option value="A7">A7</option>
                    <option value="B1">B1</option>
                    <option value="B2">B1</option>
                    <option value="B3">B1</option>
                    <option value="B4">B1</option>
                    <option value="B5">B1</option>
                    <option value="B6">B1</option>
                    <option value="B7">B1</option>
                    <option value="E">E</option>
                    </select>
              </p>
            <p>E-mail:</p>
            <p><input type="email" name="email"></p>
            <p>Parola:</p>
            <p><input type="text" name="psw"></p>

          <button type="submit" class="button_2">Trimite</button>
        </div>
      </div>
    </div>



        <script>

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
        var inbox = document.getElementById("inbox");
        var li0 = document.getElementById("adm0");
        var li1 = document.getElementById("adm1");
        var li2 = document.getElementById("adm2");
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
                    users.classList.remove("hidden");
                    rounds.classList.add("hidden");
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
                    users.classList.add("hidden");
                    rounds.classList.remove("hidden");
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
                    users.classList.add("hidden");
                    rounds.classList.add("hidden");
                    inbox.classList.remove("hidden");
                    tab = [], index;
                    for(var i = 0; i < items.length; i++){
                       tab.push(items[i].innerHTML);
                       console.log(items[i].innerHTML);
                     }
                  }
              };
          }

        $('.adminTable td').each(function(){
            var num = parseFloat($(this).text());
            if (num > 0) {
                $(this).css('color','Green');
            } else if (num < 0) {
                $(this).css('color','Red');
            }
        });





        </script>


    <footer>
      <p>The ProGnosiX Game, Copyright &copy; 2018</p>
    </footer>

  </body>
</html>
