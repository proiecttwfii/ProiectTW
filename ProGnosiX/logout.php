<?php
/* Log out process, unsets and destroys session variables */
session_start();
$_SESSION['logged_in'] == 0;
session_unset();
session_destroy();
header("location: index.php");
die();
?>
