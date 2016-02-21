<?php
ini_set('display_errors', 'On');

require('../vendor/autoload.php');

use Aws\S3\S3Client;

$options = [
    'region'            => 'ap-southeast-2',
    'version'           => 'latest'
];

$s3 = new S3Client($options);

$bucket = getenv('S3_BUCKET')?:
die('No "S3_BUCKET" config var in found in env!');

try {
    $db = new PDO('pgsql:host=ec2-54-204-41-175.compute-1.amazonaws.com;port=5432;dbname=d6jmmjm506o0h9;user=ggamcflhqstetx;password=1jc95h0WehE3P8hvgnrQrx9rBT');  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$target_file = basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["userfile"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
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
    $title = pg_escape_string($_POST['hackTitle']); 
    $ability = pg_escape_string($_POST['hackAbility']); 
    $type = htmlspecialchars($upload->get('ObjectURL')); 

    $sql = "INSERT INTO hacksdesc (id, title, ability, type) VALUES ('" . $title . $identification . "', '" . $title . "', '" . $ability . "', '" . $type . "')";
    // use exec() because no results are returned
    $db->exec($sql);
} 

header('Location: index.php');
?>