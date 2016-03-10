<?php

// require_once "dbconn.php";

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

class profiles {

	function register ($un, $pwd, $pwd1) {
		$un_register = pg_escape_string($un);
		$pwd_register = pg_escape_string($pwd);
		$pwd_check = pg_escape_string($pwd1);

		if ($pwd_register == $pwd_check) {
			$identification = '';
			for ($i = 0; $i<7; $i++) 
			{
			    $identification .= mt_rand(0,9);
			}

			$query_register = "INSERT INTO userProfile (userID, username, password) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $$pwd_register . "')";

			$db->exec($query_register);
		} else {
			echo "passwords don't match";
		}
	}

	function verify_username_password ($un, $pwd) {
		$query = "SELECT FROM userProfile WHERE username = '$un' AND password = '$pwd' LIMIT 1";

		if ($stmt = $db->prepare($query)) {
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->execute();

			if ($stmt->fetch()) {
				$stmt->close();
				return true;
			}
		}
	}

	function validate_user($un, $pwd) {

		$ensure_credentials = verify_username_password($un, $pwd);

		if ($ensure_credentials) {
			$_SESSION['status'] = 'authorised';
			return true;
		} else return "not right";
	}

	function log_user_out () {
		if (isset($_SESSION['status'])) {
			unset($_SESSION['status']);

			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 10000);
				session_destroy();
			}
		}
	}
}

?>