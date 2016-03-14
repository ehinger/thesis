<?php

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
    global $db = new PDO('pgsql:host=ec2-54-204-41-175.compute-1.amazonaws.com;port=5432;dbname=d6jmmjm506o0h9;user=ggamcflhqstetx;password=1jc95h0WehE3P8hvgnrQrx9rBT');  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

?>