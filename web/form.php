<?php
ini_set('display_errors', 'On');

require_once "dbconn.php";

// if(isset($_POST['push'])) {
   
// // }
// } 

if (isset($_POST['push'])){
    try {
        $db->beginTransaction();

        $identification = '';
        for ($i = 0; $i<7; $i++) 
            {
                $identification .= mt_rand(0,9);
            }
        $title = pg_escape_string($_POST['hackTitle']); 
        $string = preg_replace('/\s+/', '', $title);
        $type = pg_escape_string($_POST['hackType']); 
        // $heroImageURL = htmlspecialchars($upload->get('ObjectURL')); 
        $description = pg_escape_string($_POST['hackDesc']); 
        $userID = pg_escape_string($_COOKIE["userId"]);

        $db->exec("INSERT INTO hacksGeneral (hackId, heroImageURL, title, type, description, userID) VALUES ('" . $string . $identification . "', '" . $heroImageURL . "', '" . $title . "', '" . $type . "', '" . $description . "', '" . $userID . "')");

        foreach ($_POST['hackTags'] as $k => $v) {

            $tags = $_POST['hackTags'][$k];
            // use exec() because no results are returned
        
            $db->exec("INSERT INTO hacksTags (hackId, tags) VALUES ('" . $string . $identification . "', '" . $tags . "')");
        }

        foreach ($_POST['ingredientsQuantity'] as $k => $v) {

            $ingredientsQuantity = $_POST['ingredientsQuantity'][$k];
            $hackIngredients = $_POST['hackIngredients'][$k];
            // use exec() because no results are returned
        
            $db->exec("INSERT INTO hacksSupplies (hackID, supplyNo, item) VALUES ('" . $string . $identification . "', '" . $ingredientsQuantity . "', '" . $hackIngredients . "')");
        }

        foreach ($_POST['hackIns'] as $k => $v) {

            $stepNo = 1;
            $stepNo++;
            $hackDesc = $_POST['hackIns'][$k];
            // use exec() because no results are returned
        
            $db->exec("INSERT INTO hackInstructions (hackID, stage, stepNumber, instructions) VALUES ('" . $string . $identification . "', '" . $hackDesc . "', '" . $stepNo . "', '" . $hackDesc . "')");
        }

            $db->commit();
        }
    catch(PDOException $e)
        {
        // roll back the transaction if something failed
            $db->rollback();
            echo $e->getMessage();
            die();
        }

         // FIXME: add more validation, e.g. using ext/fileinfo
    
    // $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    // $target_file = basename($_FILES["userfile"]["name"]);
    $uploadOk = 1;
    // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }

    // Check file size
    // if ($target_file > 5000000000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // && $imageFileType != "gif" ) {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }
    // foreach ($_FILES['userfile'] as $k => $v) {

    for ($i = 0; $i < count($_FILES['userfile']['name']); $i++) {

    $nm = $_FILES['userfile']['name'];
    $tmpnm = $_FILES['userfile']['tmp_name'];

    // for ($i = 0; $i < count($_FILES['userfile']['name']); $i++) {

    //     echo "string";
    //     die();

    // }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        die();
    // if everything is ok, try to upload file
    } else {
        try {
            // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
            $upload = $s3->upload($bucket, $_FILES['userfile']['name'][$i], $_FILES['userfile']['tmp_name'][$i], 'public-read');
            // echo ($_FILES['userfile']['name'][$i]);
        } catch(Exception $e) { 
            echo $e->getMessage();
            die();
        } 
    }
}
    die();
} 

if (isset($_POST['followButton'])) {
    try {
        echo "yayish";
        die();   
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
}

// header('Location: index.php');