<?php
// real_escape_string pentru protejarea impotriva SQL injection
$user_id = (int)$mysqli->escape_string($_POST['delete_user_id']);
$sql = $mysqli->query("DELETE FROM accounts WHERE id='$user_id'");
if ( $sql ){
  //header("location: admin.php");
}
else {
  $message = "Nu s-a putut sterge studentul din baza de date!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
