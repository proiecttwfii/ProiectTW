<?php
// Procesul de logare al studentului, verifica daca email-ul si parola sunt corecte
// real_escape_string pentru protejarea impotriva SQL injection
$email = $mysqli->real_escape_string($_POST['email']);
$parola = $mysqli->real_escape_string($_POST['parola']);
// Folosim prepare pentru a proteja importiva SQL injection
if ($stmt = $mysqli->prepare("SELECT * FROM accounts WHERE email=? and parola = ?")) {
  // Legam variabilele ca parametru pentru string s
  $stmt->bind_param("ss", $email, $parola);
  $stmt->execute(); // Executa interogarea
  $result = $stmt->get_result(); // Luam rezultatul
  $stmt->close(); // Inchidem interogarea
}

// Se verifica daca studentul exista in BD
if ( $result->num_rows == 0 ){
  $message = "Email-ul si/sau parola sunt incorecte.\\nInceara din nou.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
// Studentul exista in BD
else {
  $user = $result->fetch_assoc();
  if (password_verify($parola, password_hash($user['parola'], PASSWORD_BCRYPT)) ) {
    $_SESSION['email'] = $user['email'];
    // Setam ca studentul / adminul este logat
    $_SESSION['logged_in'] = 1;
    // Verificam daca studentul sau adminul este logat
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
    $message = "Email-ul si/sau parola sunt incorecte.\\nInceara din nou.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
  }
}
?>
