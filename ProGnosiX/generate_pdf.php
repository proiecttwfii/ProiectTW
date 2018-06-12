<?php
ob_start();
require './fpdf/fpdf.php';
// real_escape_string pentru protejarea impotriva SQL injection
$id_runda = $mysqli->real_escape_string($_POST['generate_id']);
/* Cream o clasa PDF care extinde FPDF si are urmatoarele caracteristici,
   care se aplica pt toate paginile */
class PDF extends FPDF {
  function Header(){
    $this->SetFont('Arial','B',15); // Font titlu
    $title = 'Rezultate';
    $this->Cell(100,10, $title,0,1);
    // Spatiere de linii
    $this->Ln(5);
    $this->SetFont('Arial','B',11); // Font cap de tabel
    $this->SetFillColor(0,180,255); // Albastru
    $this->SetDrawColor(0,0,0); // Linii negre
    $this->Cell(30,5,'Grupa',1,0,'',true);
    $this->Cell(70,5,'Nume, Prenume',1,0,'',true);
    $this->Cell(30,5,'Nota initiala',1,0,'',true);
    $this->Cell(30,5,'Prognoza',1,0,'',true);
    $this->Cell(30,5,'Nota finala',1,1,'',true);
  }
  function Footer(){
    // Adaugam linia de jos a tabelului
    $this->Cell(190,0,'','T',1,'',true);
    // 1.5 cm de jos
    $this->SetY(-15);
    $this->SetFont('Arial','',8);
    //width = 0  celula e extinsa pana la marginea dreapta
    $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
  }
}
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

// Folosim noua clasa
$pdf = new PDF('P','mm','A4');

// Definim un nou alias pentru numarul total de linii
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(0,0,0); // Linii negre

// Mai intai selectam toate informatiile de care avem nevoie pentru a umple tabelul
$result = $mysqli->query("SELECT * FROM runde WHERE id_runda = '$id_runda'") or die($mysqli->error());
$row = $result->fetch_assoc();
$id_set_note = $row["id_set_note"];
$nume_runda = $row["nume_runda"];
$id_materie = $row["id_materie"];
$result = $mysqli->query("SELECT * FROM materie WHERE id_materie = '$id_materie'") or die($mysqli->error());
$r = $result->fetch_assoc();
$nume_materie = $r["nume_materie"];

$pdf->SetTitle($nume_materie . ' ' . $nume_runda);


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

  // Calculam nota finala comform unei formule alese de noi
  if ($nota_initiala == $prognoza_student || abs($nota_initiala - $prognoza_student) <= 0.20) {
    $nota_finala = $nota_initiala + 0.05 * $nota_initiala;
  }
  else {
    $nota_finala = (int)$nota_initiala - 0.05 * (int)$nota_initiala;
  }

  // Umplem celulele din tabel
  $pdf->Cell(30,5,$grupa,1,0);
  $pdf->Cell(70,5,$nume . ' ' . $prenume,1,0);
  $pdf->Cell(30,5,$nota_initiala,1,0);
  $pdf->Cell(30,5,$prognoza_student,1,0);
  $pdf->Cell(30,5,$nota_finala, 1,1);
}
$pdf->Output();
ob_end_flush();
?>
