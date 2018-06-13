<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prognosix';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
// real_escape_string pentru protejarea impotriva SQL injection
$deleteround_id = (int)$mysqli->real_escape_string($_GET['delete_round_id']);
$sql = $mysqli->query("DELETE FROM runde WHERE id_runda='$deleteround_id'");
if ( $sql ){
  echo "  <table class=\"adminTable\">
      <tr>
        <th>Materie</th>
        <th>Nota la</th>
        <th>An</th>
        <th>Nr. total participanti</th>
        <th></th>
      </tr>";

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

      echo "</table>
      <button type=\"button\" class=\"addUserBtn\" disabled>
      </button>";
}
else {
  $message = "Nu s-a putut sterge runda din baza de date!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
