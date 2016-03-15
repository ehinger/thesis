<?php
ini_set('display_errors', 'On');

require_once "dbconn.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    $target_file = basename($_FILES["userfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    // if ($target_file > 5000000000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        die();
    // if everything is ok, try to upload file
    } else {
        try {
            // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
            $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
        } catch(Exception $e) { 
            echo $e->getMessage();
            die();
        } 
    }
} 

if (isset($_POST['push'])){
    $identification = '';
    for ($i = 0; $i<7; $i++) 
        {
            $identification .= mt_rand(0,9);
        }
    $title = pg_escape_string($_POST['hackTitle']); 
    $type = pg_escape_string($_POST['hackType']); 
    $heroImageURL = htmlspecialchars($upload->get('ObjectURL')); 
    $description = pg_escape_string($_POST['hackDesc']); 
    $userID = "";
    $tags = pg_escape_string($_POST['hackTags']);
    $tags1 = pg_escape_string($_POST['hackTags1']);

    $sql = "INSERT INTO hacksGeneral (hackId, heroImageURL, title, type, description, userID) VALUES ('" . $title . $identification . "', '" . $heroImageURL . "', '" . $title . "', '" . $type . "', '" . $description . "', '" . $userID . "')";
    $sql .= "INSERT INTO hacksTags (hackId, tags) VALUES ('" . $title . $identification . "', '" . $tags . "')";
    $sql .= "INSERT INTO hacksTags (hackId, tags) VALUES ('" . $title . $identification . "', '" . $tags1 . "')";
    // use exec() because no results are returned
    $db->query($sql);
} 

header('Location: index.php');