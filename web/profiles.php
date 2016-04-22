<?php

require_once "dbconn.php";

if (isset($_POST['login'])) {
		global $db;
		global $bucket;
		global $s3;

		$uImg = $pPic;
		$uImgN = $pPicN;
		$uImgTN = $pPicTN;

		// if (isset($uImg)) {
		// 	$upload = $s3->upload($bucket, $uImgN, fopen($uImgTN, "rb"), 'public-read');, $pPicTN && isset($uImg)
		// 	$pro_pic = htmlspecialchars($upload->get('ObjectURL'));
		// }
		
		$un_register = pg_escape_string($un);
		$pwd_register = pg_escape_string($pwd);
		$pwd_check = pg_escape_string($pwd1);
		$f_name = pg_escape_string($fN);
		$l_name = pg_escape_string($lN);
		if ($pwd_register == $pwd_check && isset($un) && isset($fN) && isset($lN)) {
			$identification = '';
			for ($i = 0; $i<7; $i++) 
			{
			    $identification .= mt_rand(0,9);
			}
			$query_register = "INSERT INTO userProfile (userID, username, password, firstN, lastN, proPicURL) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "', '" . $f_name . "', '" . $l_name . "', 'https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/608e1c34259817.56ca53c657e24.png')";
			$db->exec($query_register);
			setcookie("userId", $un_register . $identification);
			header('Location: index.php');
		} else {
			echo "Field left empty";
			die();
		}
}
		
if (isset($_POST['register'])) {
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

if (isset($_POST['logout'])) {
		if (isset($_COOKIE["userId"])) {
				setcookie("userId", '', time() - 10000);
		}
	}

	header('Location: index.php');
?>