<?php
require_once "dbconn.php";
class profiles {
	function register ($un, $pwd, $pwd1, $fN, $lN, $pPic, $pPicN, $pPicTN) {

		global $db;
		global $bucket;
		global $s3;

		$uImg = $pPic;
		$uImgN = $pPicN;
		$uImgTN = $pPicTN;

		if (isset($uImg)) {

			$upload = $s3->upload($bucket, $uImgN, "l", 'public-read');
			$pro_pic = htmlspecialchars($upload->get('ObjectURL'));

		}
		
		$strUn = strtolower($un);
		$un_register = pg_escape_string($strUn);

		$strpwd = strtolower($pwd);
		$pwd_register = pg_escape_string($strpwd);

		$strpwd1 = strtolower($pwd1);
		$pwd_check = pg_escape_string($strpwd1);

		$strfN = strtolower($fN);
		$f_name = pg_escape_string($strfN);

		$strlN = strtolower($lN);
		$l_name = pg_escape_string($strlN);

		if ($pwd_register == $pwd_check && isset($un) && isset($fN) && isset($lN) && isset($uImg)) {

			$identification = '';

			for ($i = 0; $i<7; $i++) {

			    $identification .= mt_rand(0,9);

			}

			$query_register = "INSERT INTO userProfile (userID, username, password, firstN, lastN, proPicURL) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "', '" . $f_name . "', '" . $l_name . "', '" . $pro_pic . "')";

			$db->exec($query_register);

			setcookie("userId", $un_register . $identification);

		} else {

			echo "Field left empty" . $un . $fN . $lN;
			die();

		}
	}
	function verify_username_password ($un, $pwd, $id) {

		global $db;

		$strUn = strtolower($un);
		$un_ = pg_escape_string($un);

		$strpwd = strtolower($pwd);
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


