<?php

// Escape all $_POST variables to protect against SQL injections
$user_id = $mysqli->escape_string($_POST['delete_user_id']);

$sql = $mysqli->query("DELETE FROM accounts WHERE id='$user_id'");

if($sql){
    echo "Deleted";
}
