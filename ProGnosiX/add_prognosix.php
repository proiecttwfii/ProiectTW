<?php
$email = $_SESSION['email'];
$id_runda = $_REQUEST["hiddencontainer"];

// real_escape_string pentru protejarea impotriva SQL injection
$nota = (int)$mysqli->real_escape_string($_POST['nota_propusa']);

// Email-ul a fost verificat la login
$result = $mysqli->query("SELECT * FROM accounts WHERE email='$email'");
$user = $result->fetch_assoc();
$id_student = $user['id'];
$date = date('Y/m/d');

$status = false;
if ($stmt = $mysqli->prepare("INSERT INTO prognoze (id_runda, id_student, prognoza_student, data_prognoza) VALUES (?, ?, ?, ?)"))
{
  // Legam variabilele ca parametru pentru tipurile corespunzatoare lor, string sau int
  $stmt->bind_param("iiis", $id_runda, $id_student, $nota, $date);
  $status = $stmt->execute(); // Executam interogarea
  $stmt->close(); // Inchidem interogarea
}
// Inserarea a fost facuta
if ($status) {
  header("location: user.php");
}
// Inserarea a esuat
else {
  $message = "A intervenit o eroare! Va rugam sa incercati mai tarziu.";
  echo "<script type='text/javascript'>alert('$message'); </script>";
}
