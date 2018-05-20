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
    if (password_verify($_POST['parola'], password_hash($user['parola'], PASSWORD_BCRYPT)) ) {
        $_SESSION['email'] = $user['email'];
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = 1;
        if ($user["admin"] == 0) {
          $_SESSION['admin'] = 0;
          header("location: user.php");
        }
        else if ($user["admin"] == 1){
           $_SESSION['admin'] = 1;
           header("location: admin.php");
         }
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: index.php");
    }
}
?>
