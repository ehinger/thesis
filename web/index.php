<?php
// remove before flight
ini_set('display_errors', 'On');

require('../vendor/autoload.php');

use Aws\S3\S3Client;

$options = [
    'region'            => 'ap-southeast-2',
    'version'           => 'latest',
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

try {
    $results = $db->query('select * from test_table');
    if (isset($_POST['push'])){
        $test = pg_escape_string($_POST['hackTitle']); 
        $sql = "INSERT INTO test_table (id, name) VALUES ('2', '" . $test . "')";
        // use exec() because no results are returned
        $db->exec($sql);

     //    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['pic']['tmp_name'])) {
        //     // FIXME: add more validation, e.g. using ext/fileinfo
        //     try {
        //         // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        //         $upload = $s3->upload($bucket, $_FILES['pic']['name'], fopen($_FILES['pic']['tmp_name'], 'rb'), 'public-read');
        //     } catch (Exception $e) {
        //      echo $e->getMessage();
        //      die();
        //  }
        // }    
    }
    // echo '<pre>';
    // var_dump($results->fetchAll());
    // echo '</pre>';
    // die();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}



$hacks = $results->fetchAll(PDO::FETCH_ASSOC);


?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>
