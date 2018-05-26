<?php
// Set session variables to be used on user.php page
$_SESSION['nota_propusa'] = $_POST['nota_propusa'];
$email = $_SESSION['email'];
$id_runda = $_REQUEST["hiddencontainer"];

// Escape all $_POST variables to protect against SQL injections
$nota = $mysqli->escape_string($_POST['nota_propusa']);

$res = $mysqli->query("SELECT * FROM accounts WHERE email='$email'");
$user = $res->fetch_assoc();
$id_student = $user['id'];

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM prognoze WHERE id_runda='$id_runda' and id_student = '$id_student'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    $message = "Ati participat deja la aceasta runda.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
}
else { // Email doesn't already exist in a database, proceed...
  $date = date('Y/m/d');

    $sql = "INSERT INTO prognoze (id_runda, id_student, prognoza_student, data_prognoza) "
            . "VALUES ('$id_runda','$id_student','$nota', '$date')";

    if ( $mysqli->query($sql) ){
        header("location: user.php");
    }
    else {
        $message = "Nu s-a putut adauga prognoza in baza de date!";
        echo "<script type='text/javascript'>alert('$message'); </script>";
    }
}
