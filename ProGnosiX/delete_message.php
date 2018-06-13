<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prognosix';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
// real_escape_string pentru protejarea impotriva SQL injection
$message_id = (int)$mysqli->real_escape_string($_GET['delete_message_id']);
$sql = $mysqli->query("DELETE FROM inbox WHERE id_mesaj='$message_id'");
if ( $sql ){
  //header("location: admin.php");
  echo "<table class=\"adminTable\">
    <tr>
    <th>Email</th>
    <th>Nume</th>

    <th>An</th>
    <th>Grupa</th>
    <th>Data</th>
    <th></th>
  </tr>";

  $results = $mysqli->query("SELECT * FROM inbox ORDER BY data_mesaj desc") or die($mysqli->error());
  while ($row = $results->fetch_assoc()) {
    echo "<tr\><td>".$row["email"]."</td><td>".$row["nume"]." ".$row["prenume"]."</td><td>".$row["an"]."</td><td>".$row["grupa"]."</td><td>".$row["data_mesaj"]."</td><td id=\"".$row["id_mesaj"]."\" onclick=\"deleteMessage(this)\"></td></tr>";
  }
  echo "</table>
  <button type=\"button\" class=\"addUserBtn\" disabled>
  </button>";

}
else {
  $message = "Nu s-a putut sterge mesajul din baza de date!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
