<?php
    ob_start();
    require './fpdf/fpdf.php';
    $id_runda = $mysqli->escape_string($_POST['generate_id']);

    class PDF extends FPDF {

      function Header(){
          $this->SetFont('Arial','B',15);

          $title = 'Rezultate';
          $this->Cell(100,10, $title,0,1);

          //dummy cell to give line spacing
          //$this->Cell(0,5,'',0,1);
          //is equivalent to:
          $this->Ln(5);

          $this->SetFont('Arial','B',11);

          $this->SetFillColor(0,180,255);
          $this->SetDrawColor(0,0,0);
          $this->Cell(30,5,'Grupa',1,0,'',true);
          $this->Cell(70,5,'Nume, Prenume',1,0,'',true);
          $this->Cell(30,5,'Nota initiala',1,0,'',true);
          $this->Cell(30,5,'Prognoza',1,0,'',true);
          $this->Cell(30,5,'Nota finala',1,1,'',true);
      }

      function Footer(){
          //add table's bottom line
          $this->Cell(190,0,'','T',1,'',true);

          //Go to 1.5 cm from bottom
          $this->SetY(-15);

          $this->SetFont('Arial','',8);

          //width = 0 means the cell is extended up to the right margin
          $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
      }
    }


    //A4 width : 219mm
    //default margin : 10mm each side
    //writable horizontal : 219-(10*2)=189mm
    $pdf = new PDF('P','mm','A4'); //use new class

    //define new alias for total page numbers
    $pdf->AliasNbPages('{pages}');

    $pdf->SetAutoPageBreak(true,15);
    $pdf->AddPage();

    $pdf->SetFont('Arial','',9);
    $pdf->SetDrawColor(0,0,0);
    // 
    // $pdf->Cell(30,5,$id_runda,1,0);
    // $pdf->Cell(70,5,$id_runda,1,0);
    // $pdf->Cell(30,5,'sdsf',1,0);
    // $pdf->Cell(30,5,'dsfs',1,0);
    // $pdf->Cell(30,5,'fsdfds',1,1);

    $result = $mysqli->query("SELECT * FROM runde WHERE id_runda = '$id_runda'") or die($mysqli->error());
    $row = $result->fetch_assoc();
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

       $pdf->Cell(30,5,$grupa,1,0);
       $pdf->Cell(70,5,$nume . ' ' . $prenume,1,0);
       $pdf->Cell(30,5,$nota_initiala,1,0);
       $pdf->Cell(30,5,$prognoza_student,1,0);
       $pdf->Cell(30,5,$nota_initiala + 1, 1,1);

       // $pdf->Cell(30,5,'hello','LR',0);
       // $pdf->Cell(70,5,'hell0121','LR',0);
       // $pdf->Cell(30,5,'sdsf','LR',0);
       // $pdf->Cell(30,5,'dsfs','LR',0);
       // $pdf->Cell(30,5,'fsdfds', 'LR',1);
     }

    // $query=mysqli_query($con,"select * from clients");
    // while($data=mysqli_fetch_array($query)){
    // 	$pdf->Cell(40,5,$data['name'],'LR',0);
    // 	$pdf->Cell(25,5,$data['phone'],'LR',0);
    //
    // 	if($pdf->GetStringWidth($data['email']) > 65){
    // 		$pdf->SetFont('Arial','',7);
    // 		$pdf->Cell(65,5,$data['email'],'LR',0);
    // 		$pdf->SetFont('Arial','',9);
    // 	}else{
    // 		$pdf->Cell(65,5,$data['email'],'LR',0);
    // 	}
    // 	$pdf->Cell(60,5,$data['address'],'LR',1);
    // }

    $pdf->Output();

    ob_end_flush();
?>
