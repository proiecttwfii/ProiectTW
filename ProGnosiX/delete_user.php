<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prognosix';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
// real_escape_string pentru protejarea impotriva SQL injection
$delete_user_id = (int)$mysqli->real_escape_string($_GET['delete_user_id']);
$sql = $mysqli->query("DELETE FROM accounts WHERE id='$delete_user_id'");
if ( $sql ){
  echo "  <table class=\"adminTable\">
  <tr>
  <th>Nume</th>
  <th>An</th>
  <th>Grupa</th>
  <th>Email</th>
  <th></th>
  </tr>";

  $results = $mysqli->query("SELECT * FROM accounts WHERE admin != 1") or die($mysqli->error());
  while ($row = $results->fetch_assoc()) {
    echo "<tr\><td>".$row["nume"]." ".$row["prenume"]."</td><td>".$row["an"]."</td><td>".$row["grupa"]."</td><td>".$row["email"]."</td><td id=\"".$row["id"]."\" onclick=\"deleteStudent(this)\"></td></tr>";
  }

  echo "</table><button type=\"button\" class=\"addUserBtn\" onclick=\"addUser()\">Adaugare student</button>";
}
else {
  $message = "Nu s-a putut sterge runda din baza de date!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
