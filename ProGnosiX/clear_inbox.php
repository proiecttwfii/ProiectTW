<?php

// Escape all $_POST variables to protect against SQL injections

$sql = $mysqli->query("TRUNCATE TABLE inbox");

if (!$sql)
{
  $message = "Inboxul nu a putut fi curatat.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
