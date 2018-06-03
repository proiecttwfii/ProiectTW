<?php
// Escape all $_POST variables to protect against SQL injections
$nume_materie = $mysqli->escape_string($_POST['materie_creare_runda']);
$nume_runda = $mysqli->escape_string($_POST['nume_runda']);


$materii = $mysqli->query("SELECT * FROM materie WHERE nume_materie='$nume_materie'") or die($mysqli->error());
$materie = $materii->fetch_assoc();
$id = $materie['id_materie'];

$result = $mysqli->query("SELECT * FROM runde WHERE nume_runda='$nume_runda' and id_materie = '$id'") or die($mysqli->error());


if ( $result->num_rows > 0 ) {
    $_SESSION['message'] = 'Round with this name already exists!';
    $message = "Exista deja o runda cu acest nume. Incercati din nou.";
    echo "<script type='text/javascript'>alert('$message'); </script>";
}
else {

    $target_dir = "files/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        echo "<script type='text/javascript'>alert('$message'); </script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $message =  "Sorry, your file is too large.";
        echo "<script type='text/javascript'>alert('$message'); </script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($fileType != "csv" && $fileType != "xml" && $fileType != "json") {
        $message = "Doar fisiere de tip csv, xml si json.";
        echo "<script type='text/javascript'>alert('$message'); </script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        echo "<script type='text/javascript'>alert('$message'); </script>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            echo "<script type='text/javascript'>alert('$message'); </script>";
        } else {
            $message = "Sorry, there was an error uploading your file.";
            echo "<script type='text/javascript'>alert('$message'); </script>";
        }
    }

    $state_csv = false;

    function importCSV($csvFile, $mysqli, $id_set_note)
    {
      $file = fopen($csvFile,"r");
      $i = 0;
      while (!feof($file) )  {
        $line_of_text[] = fgetcsv($file);
          print "<pre>";
          print_r($line_of_text);
          print"</pre>";
            $value = "'". implode("','", (array)$line_of_text[$i]) ."'";
            echo $value;
            $r = $mysqli->query("INSERT INTO seturi_note (id_set_note, email_student, valoare_nota) "."VALUES ('$id_set_note',". $value .")");
            if($r) { $state_csv = true; }
            else { $state_csv = false; }
            $i++;
        }
        if (!$state_csv) {
          $message = "Insert csv failed!";
          echo "<script type='text/javascript'>alert('$message'); </script>";
        }
    }

    function importJSON($jsonFile, $mysqli, $id_set_note)
    {
        $data = file_get_contents($jsonFile);
        $array = json_decode($data, true); // true - associative array
        foreach ($array as $row) {
          $result = $mysqli->query("INSERT INTO seturi_note (id_set_note, email_student, valoare_nota) " . "VALUES ('$id_set_note','".$row["email_student"]."','".$row["valoare_nota"]."')");
        }
    }

    function importXML($xmlFile, $mysqli,$id_set_note)
    {
        $xmldoc = new DOMDocument();
        $xmldoc->load($xmlFile);
        $xmldata = $xmldoc->getElementsByTagName('ROW');
        $xmlcount = $xmldata->length;
        for ($i=0; $i < $xmlcount; $i++) {
            $email_student = $xmldata->item($i)->getElementsByTagName('email_student')->item(0)->childNodes->item(0)->nodeValue;
            $valoare_nota = $xmldata->item($i)->getElementsByTagName('valoare_nota')->item(0)->childNodes->item(0)->nodeValue;
            //echo $email_student;
            $result = $mysqli->query("INSERT INTO seturi_note (id_set_note, email_student, valoare_nota) " . "VALUES ('$id_set_note','$email_student','$valoare_nota')");
        }
    }

    $id_seturi = $mysqli->query("SELECT MAX(id_set_note) as maxid FROM seturi_note");
    $id_set = $id_seturi->fetch_assoc();
    $id_set_note = $id_set["maxid"];
    $id_set_note = $id_set_note + 1;
    if ( $id_seturi->num_rows == 0 ) {
        $id_set_note = 1;
    }

    if($uploadOk == 1)
    {
      if($fileType == "csv")
      {
          $csv = importCSV($target_file, $mysqli,$id_set_note);
      }
      else if($fileType == "json")
      {
          $json = importJSON($target_file, $mysqli,$id_set_note);
      }
      else if($fileType == "xml")
      {
          $xml = importXML($target_file, $mysqli, $id_set_note);
      }

      $sql = "INSERT INTO runde (id_materie, nume_runda, id_set_note) "
              . "VALUES ('$id','$nume_runda','7')";

      if ( $mysqli->query($sql) ){
          $_SESSION['logged_in'] = true; // So we know the admin has logged in
          header("location: admin.php");
      }
      else {
          $message = "Inserarea rundei a esuat!";
          echo "<script type='text/javascript'>alert('$message'); </script>";
      }
    }
}

?>
