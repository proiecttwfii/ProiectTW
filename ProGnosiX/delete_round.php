<?php

// Escape all $_POST variables to protect against SQL injections
$deleteround_id = $mysqli->escape_string($_POST['delete_round_id']);

$sql = $mysqli->query("DELETE FROM runde WHERE id_runda='$deleteround_id'");

if (!$sql)
{
  $message = "Mesajul a fost sters.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
