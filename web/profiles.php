<?php

require_once "dbconn.php";

class profiles {

	function register ($un, $pwd, $pwd1, $fN, $lN, $pPic) {
		global $db;

		if (isset($_POST['proPic'])) {
			$upload = $s3->upload($bucket, $_FILES['proPic']['name'], fopen($_FILES['proPic']['tmp_name'], "rb"), 'public-read');
			$pro_pic = htmlspecialchars($upload->get('ObjectURL'));
		}
		
		$un_register = pg_escape_string($un);
		$pwd_register = pg_escape_string($pwd);
		$pwd_check = pg_escape_string($pwd1);
		$f_name = pg_escape_string($fN);
		$l_name = pg_escape_string($lN);
		if ($pwd_register == $pwd_check && isset($_POST["usernameR"]) && isset($_POST["fName"]) && isset($_POST["lName"]) && isset($_POST['proPic'])) {
			$identification = '';
			for ($i = 0; $i<7; $i++) 
			{
			    $identification .= mt_rand(0,9);
			}
			$query_register = "INSERT INTO userProfile (userID, username, password, firstN, lastN, proPicURL) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "', '" . $f_name . "', '" . $l_name . "', '" . $pro_pic . "')";
			$db->exec($query_register);
			setcookie("userId", $un_register . $identification);
			header('Location: index.php');
		} else {
			echo "Field left empty";
			die();
		}
	}

	function verify_username_password ($un, $pwd, $id) {
		global $db;

		$un_ = pg_escape_string($un);
		$pwd_ = pg_escape_string($pwd);

		$stmt = $db->query("SELECT * FROM userProfile WHERE username = '" . $un_ . "' AND password = '" . $pwd_ . "'"); 
		$stmt->execute();

		if ($stmt->fetch()) {
			for ($i = 0; $i < count($id['k']); $i++) {
					if ($un == $id['k'][$i]['username']) {
						$uId = $id['k'][$i]['userid'];
					}
				}
				setcookie("userId", $uId);
			} else {
				echo $un_, $pwd_;
				die();
			}
	}

	function log_user_out () {
		if (isset($_COOKIE["userId"])) {
				setcookie("userId", '', time() - 10000);
		}
	}
}
?>