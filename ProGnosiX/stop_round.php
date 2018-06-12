<?php
// real_escape_string pentru protejarea impotriva SQL injection
$round_id = $mysqli->real_escape_string($_POST['stop_round_id']);
$date = date('Y/m/d');
$sql = $mysqli->query("UPDATE runde SET runda_activa = '0', data_stop_runda = '$date' WHERE id_runda='$round_id'");
if ( $sql ){
  //header("location: admin.php");
}
else {
  $message = "Runda nu a putut fi incheiata!";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
