<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM accounts WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
  echo "user not found";
    $_SESSION['message'] = "User with that email doesn't exist!";
    //header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();
    echo $_POST['parola'];
    echo $user['parola'];

    if ( password_verify($_POST['parola'], password_hash($user['parola'], PASSWORD_BCRYPT)) ) {

        $_SESSION['email'] = $user['email'];


        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: user.php");
    }
    else {
        //$_SESSION['message'] = "You have entered wrong password, try again!";
        echo $_POST['parola'];
        echo $user['parola'];

        header("location: error.php");
    }
}
