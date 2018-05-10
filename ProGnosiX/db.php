<?php
/*Database conection settings*/
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prognosix';

$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
?>
