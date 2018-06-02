<?php

// Escape all $_POST variables to protect against SQL injections
$user_id = $mysqli->escape_string($_POST['hiddenInput']);

$sql = $mysqli->query("DELETE FROM accounts WHERE id='$user_id'");

if($sql){
    echo "Deleted";
}
