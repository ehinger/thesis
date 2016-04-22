<?php

require_once "dbconn.php";

if (isset($_POST['register'])) {

		$uImg = $pPic;
		$uImgN = $pPicN;
		$uImgTN = $pPicTN;

		if (isset($_FILES['proPic'])) {
			$upload = $s3->upload($bucket, $_FILES['proPic']['name'], fopen($_FILES['proPic']['tmp_name'], "rb"), 'public-read');
			$pro_pic = htmlspecialchars($upload->get('ObjectURL'));
		}
		
		$un_register = pg_escape_string($_POST['usernameR']);
		$pwd_register = pg_escape_string($_POST['passwordR']);
		$pwd_check = pg_escape_string($_POST['password1R']);
		$f_name = pg_escape_string($_POST['fName']);
		$l_name = pg_escape_string($_POST['lName']);
		if ($pwd_register == $pwd_check && isset($un_register) && isset($f_name) && isset($l_name) && isset($uImg)) {
			$identification = '';
			for ($i = 0; $i<7; $i++) 
			{
			    $identification .= mt_rand(0,9);
			}
			$query_register = "INSERT INTO userProfile (userID, username, password, firstN, lastN, proPicURL) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "', '" . $f_name . "', '" . $l_name . "', '" . $pro_pic . "')";
			$db->exec($query_register);
			setcookie("userId", $un_register . $identification);
		} else {
			echo "Field left empty";
			die();
		}
			header('Location: index.php');
}
		
if (isset($_POST['login'])) {
		global $db;

		$un_ = pg_escape_string($_POST['username']);
		$pwd_ = pg_escape_string($_POST['password']);

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
				header('Location: index.php');
		}

if (isset($_POST['logout'])) {
		if (isset($_COOKIE["userId"])) {
				setcookie("userId", '', time() - 10000);
		}
				header('Location: index.php');
	}

?>