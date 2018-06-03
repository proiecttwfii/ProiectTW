<?php

// Escape all $_POST variables to protect against SQL injections
$message_id = $mysqli->escape_string($_POST['delete_message_id']);

$sql = $mysqli->query("DELETE FROM inbox WHERE id_mesaj='$message_id'");

if (!$sql)
{
  $message = "Mesajul a fost sters.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
