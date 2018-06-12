<?php
$id_runda = (int)$mysqli->real_escape_string($_POST['generate_id']);

header('Content-Type: text/csv; charset=utf-8');

$result = $mysqli->query("SELECT * FROM runde WHERE id_runda = '$id_runda'") or die($mysqli->error());
$row = $result->fetch_assoc();
$nume_runda = $row["nume_runda"];
$materii = $mysqli->query("SELECT * FROM materie where id_materie = ".$row["id_materie"]." ");
$materie = $materii->fetch_assoc();
$nume_materie = $materie["nume_materie"];

// Dam nume csv-ului care va fi descarcat
$filename = "Rezultate_" . $nume_runda . "_" . $nume_materie . ".csv";
header('Content-Disposition: attachment; filename="' . $filename . '";');

$output = fopen("php://output", "w");
ob_end_clean();
fputcsv($output, array('Grupa', 'Nume, Prenume', 'Nota initiala', 'Prognoza', 'Nota finala'));

$id_set_note = $row["id_set_note"];
$result = $mysqli->query("SELECT * FROM prognoze WHERE id_runda = '$id_runda'") or die($mysqli->error());
while ($row = $result->fetch_assoc()) {
  $id_student = $row['id_student'];
  $prognoza_student = $row['prognoza_student'];

  $studenti = $mysqli->query("SELECT * FROM accounts where id = '$id_student'");
  $student = $studenti->fetch_assoc();

  $grupa = $student['grupa'];
  $nume = $student['nume'];
  $prenume = $student['prenume'];
  $email = $student['email'];

  $note = $mysqli->query("SELECT * FROM seturi_note where email_student = '$email' and id_set_note = '$id_set_note'") or die($mysqli->error());
  $nota = $note->fetch_assoc();
  $nota_initiala = $nota['valoare_nota'];

  // Calcularea notei finale
  if ($nota_initiala == $prognoza_student || abs($nota_initiala - $prognoza_student) <= 0.20) {
    $nota_finala = $nota_initiala + 0.05 * $nota_initiala;
  }
  else {
    $nota_finala = (int)$nota_initiala - 0.05 * (int)$nota_initiala;
  }

  // Cream un array care va contine toate campurile dorite pentru a completa tabelul
  $lineData = array($grupa, $nume. ' ' .$prenume, $nota_initiala, $prognoza_student, $nota_finala);
  fputcsv($output, $lineData);
}
exit;
fclose($output);
?>
