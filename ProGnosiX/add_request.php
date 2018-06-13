<?php
// Procesul de trimitere a unei cereri de inregistrare
// real_escape_string pentru protejarea impotriva SQL injection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prognosix';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);

$nume_user = $_GET['nume_contact'];
$prenume_user = $_GET['prenume_contact'];
$email_user = $_GET['email_contact'];
$an_user = $_GET['an_contact'];
$grupa_user = $_GET['grupa_contact'];

$nume_user = $mysqli->real_escape_string($nume_user);
$prenume_user =  $mysqli->real_escape_string($prenume_user);
$email_user =  $mysqli->real_escape_string($email_user);
$an_user = (int)$mysqli->real_escape_string($an_user);
$grupa_user =  $mysqli->real_escape_string($grupa_user);

// Folosim prepare pentru a proteja importiva SQL injection
if ($stmt = $mysqli->prepare("SELECT * FROM inbox WHERE email=?")) {
  //Legam variabilele ca parametru pentru string s
  $stmt->bind_param("s", $email_user);
  $stmt->execute(); // Executam interogarea
  $result = $stmt->get_result(); // Luam rezultatul
  $stmt->close(); // Inchidem interogarea
}

// Verificam daca mai avem un mesaj cu acest email
if ( $result->num_rows > 0 ) {

}
else { // Nu exista nici un mesaj cu acest email_contact
  $date = date('Y/m/d');
  $status = false;
  // Adaugam mesajul in baza de date
  // Folosim prepare pentru a proteja importiva SQL injection
  if ($stmt = $mysqli->prepare("INSERT INTO inbox (nume, prenume, an, grupa, email, data_mesaj) VALUES (?, ?, ?, ?, ?, ?)"))
  {
    // Legam variabilele ca parametru pentru tipurile corespunzatoare lor, string sau int
    $stmt->bind_param("ssisss", $nume_user, $prenume_user,$an_user, $grupa_user, $email_user, $date);
    $status = $stmt->execute(); // Executam interogarea
    $stmt->close(); // Inchidem interogarea
  }
  // Inserarea a fost facuta
  if ($status) {
    //header("location: contact.php");
  }
  // Inserarea a esuat
  else {
    $message = "A intervenit o eroare! Va rogam sa incercati mai tarziu.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
  }
}
