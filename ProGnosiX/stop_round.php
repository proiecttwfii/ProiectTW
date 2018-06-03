<?php

// Escape all $_POST variables to protect against SQL injections
$round_id = $mysqli->escape_string($_POST['stop_round_id']);

$sql = $mysqli->query("UPDATE runde SET runda_activa='0' WHERE id_runda='$round_id'");

if (!$sql)
{
  $message = "Runda nu poate fi stearsa.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
