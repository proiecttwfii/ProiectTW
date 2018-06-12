<?php
// real_escape_string pentru protejarea impotriva SQL injection
$message_id = (int)$mysqli->real_escape_string($_POST['delete_message_id']);
$sql = $mysqli->query("DELETE FROM inbox WHERE id_mesaj='$message_id'");
if ( $sql ){
  //header("location: admin.php");
}
else {
  $message = "Nu s-a putut sterge mesajul din baza de date!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
