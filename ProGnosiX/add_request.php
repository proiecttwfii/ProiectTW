<?php

// Escape all $_POST variables to protect against SQL injections
$nume_user = $mysqli->escape_string($_POST['nume_contact']);
$prenume_user = $mysqli->escape_string($_POST['prenume_contact']);
$email_user = $mysqli->escape_string($_POST['email_contact']);
$an_user = $mysqli->escape_string($_POST['an_contact']);
$grupa_user = $mysqli->escape_string($_POST['grupa_contact']);

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM inbox WHERE email='$email_user'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    $message = "Exista deja un student cu acest email.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
}
else { // Email doesn't already exist in a database, proceed...
  $date = date('Y/m/d');
    $sql = "INSERT INTO inbox (nume, prenume, an, grupa, email, data_mesaj) "
            . "VALUES ('$nume_user','$prenume_user', '$an_user', '$grupa_user','$email_user', '$date')";

    // Add user to the database
    if ( $mysqli->query($sql) ){
        header("location: contact.php");
    }
    else {
        $message = "Nu s-a putut adauga in inbox!";
        echo "<script type='text/javascript'>alert('$message'); </script>";
        echo "<script type='text/javascript'>alert('$nume_user'); </script>";
        echo "<script type='text/javascript'>alert('$prenume_user'); </script>";
        echo "<script type='text/javascript'>alert('$an_user'); </script>";
        echo "<script type='text/javascript'>alert('$grupa_user'); </script>";
        echo "<script type='text/javascript'>alert('$email_user'); </script>";
        echo "<script type='text/javascript'>alert('$date'); </script>";


    }
}
