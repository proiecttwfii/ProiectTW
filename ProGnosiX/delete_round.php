<?php

// Escape all $_POST variables to protect against SQL injections
$round_id = $mysqli->escape_string($_POST['delete_round_id']);

$sql = $mysqli->query("DELETE FROM runde WHERE id_runda='$round_id'");

if($sql){
    echo "Deleted";
}