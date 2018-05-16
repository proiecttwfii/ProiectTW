<?php
// Escape all $_POST variables to protect against SQL injections
$nume_materie = $_POST['materie_creare_runda'];
$nume_runda = $_POST['nume_runda'];

$result = $mysqli->query("SELECT * FROM runde WHERE nume_runda='$nume_runda'") or die($mysqli->error());

$materii = $mysqli->query("SELECT * FROM materie WHERE nume_materie='$nume_materie'") or die($mysqli->error());
$materie = $materii->fetch_assoc();
$id = $materie['id_materie'];
//$id e gol idk why
if ( $result->num_rows > 0 ) {
    $_SESSION['message'] = 'Round with this name already exists!';
    header("location: error.php");
}
else {

    $target_dir = "files/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($fileType != "csv" && $fileType != "xml" && $fileType != "json") {
        echo "Sorry, only csv, xml, json files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $sql = "INSERT INTO runde (id_materie, nume_runda, id_set_note) "
            . "VALUES ('$id','$nume_runda','7')";

    if ( $mysqli->query($sql) ){
        $_SESSION['logged_in'] = true; // So we know the admin has logged in
        header("location: admin.php");
    }
    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }
}
?>
