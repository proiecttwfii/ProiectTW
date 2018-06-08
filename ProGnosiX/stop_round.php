<?php

// Escape all $_POST variables to protect against SQL injections
$round_id = $mysqli->escape_string($_POST['stop_round_id']);

$date = date('Y/m/d');

$sql = $mysqli->query("UPDATE runde SET runda_activa='0', data_stop_runda = '$date' WHERE id_runda='$round_id'");

if (!$sql)
{
  $message = "Runda nu poate fi stearsa.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
