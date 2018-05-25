<?php
// Set session variables to be used on user.php page
$_SESSION['email_user'] = $_POST['email_user'];
$_SESSION['nume_user'] = $_POST['nume_user'];
$_SESSION['prenume_user'] = $_POST['prenume_user'];

// Escape all $_POST variables to protect against SQL injections
$nume_user = $mysqli->escape_string($_POST['nume_user']);
$prenume_user = $mysqli->escape_string($_POST['prenume_user']);
$email_user = $mysqli->escape_string($_POST['email_user']);
$an_user = $mysqli->escape_string($_POST['an_user']);
$grupa_user = $mysqli->escape_string($_POST['grupa_user']);
$parola_user = $mysqli->escape_string($_POST['parola_user']);

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM accounts WHERE email='$email_user'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    $_SESSION['message'] = 'User with this email already exists!';
    $message = "Exista deja un student cu acest email.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
}
else { // Email doesn't already exist in a database, proceed...
    $sql = "INSERT INTO accounts (email, parola, nume, prenume,an,semestru,grupa,admin) "
            . "VALUES ('$email_user','$parola_user','$nume_user','$prenume_user', '$an_user', '2','$grupa_user','0')";

    // Add user to the database
    if ( $mysqli->query($sql) ){
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        header("location: admin.php");
    }
    else {
        $_SESSION['message'] = 'Registration failed!';
        $message = "Nu s-a putut adauga studentul in baza de date!";
        echo "<script type='text/javascript'>alert('$message'); </script>";
    }
}
