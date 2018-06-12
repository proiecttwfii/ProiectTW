<?php
// real_escape_string pentru protejarea impotriva SQL injection
$deleteround_id = (int)$mysqli->real_escape_string($_POST['delete_round_id']);
$sql = $mysqli->query("DELETE FROM runde WHERE id_runda='$deleteround_id'");
if ( $sql ){
  //header("location: admin.php");
}
else {
  $message = "Nu s-a putut sterge runda din baza de date!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
