<?php
// real_escape_string pentru protejarea impotriva SQL injection
$nume_user = $mysqli->real_escape_string($_POST['nume_user']);
$prenume_user = $mysqli->real_escape_string($_POST['prenume_user']);
$email_user = $mysqli->real_escape_string($_POST['email_user']);
$an_user = $mysqli->real_escape_string($_POST['an_user']);
$grupa_user = $mysqli->real_escape_string($_POST['grupa_user']);
$parola_user = $mysqli->real_escape_string($_POST['parola_user']);

// Verificam daca email-ul exista deja
$result = $mysqli->query("SELECT * FROM accounts WHERE email = '$email_user'") or die($mysqli->error());
// Daca numarul de linii rezultate e 1 inseamna ca userul exista in BD
if ( $result->num_rows > 0 ) {
    $message = "Exista deja un student cu acest email.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
}
// Daca studentul nu exista in BD atunci il inseram
else {
  $sql = "INSERT INTO accounts (email, parola, nume, prenume, an, semestru, grupa, admin) "
         . "VALUES ('$email_user','$parola_user','$nume_user','$prenume_user', '$an_user','2','$grupa_user','0')";
  // Inseram studentul in BD
  if ( $mysqli->query($sql) ){
    header("location: admin.php");
  }
  else {
    $message = "Nu s-a putut adauga studentul in baza de date!";
    echo "<script type='text/javascript'>alert('$message'); </script>";
  }
}
