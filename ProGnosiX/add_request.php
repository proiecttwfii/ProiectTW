<?php
// Procesul de trimitere a unei cereri de inregistrare
// real_escape_string pentru protejarea impotriva SQL injection
$nume_user = $mysqli->real_escape_string($_POST['nume_contact']);
$prenume_user = $mysqli->real_escape_string($_POST['prenume_contact']);
$email_user = $mysqli->real_escape_string($_POST['email_contact']);
$an_user = (int)$mysqli->real_escape_string($_POST['an_contact']);
$grupa_user = $mysqli->real_escape_string($_POST['grupa_contact']);

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
