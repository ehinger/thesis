<?php
require_once "dbconn.php";
// class profiles {
// 	function register ($un, $pwd, $pwd1, $fN, $lN, $pPic, $pPicN, $pPicTN) {
if (isset($_POST['register'])) {
		global $db;
		global $bucket;
		global $s3;

		// $uImg = $pPic;
		// $uImgN = $pPicN;
		// $uImgTN = $pPicTN;

		if (isset($_POST['lName'])) {

			$upload = $s3->upload($bucket, $_FILES['proPic']['name'], "l", 'public-read');
			$pro_pic = htmlspecialchars($upload->get('ObjectURL'));

		}
		
		// $strUn = strtolower($un);
		$un_register = pg_escape_string($_POST['usernameR']);

		// $strpwd = strtolower($pwd);
		$pwd_register = pg_escape_string($_POST['passwordR']);

		// $strpwd1 = strtolower($pwd1);
		$pwd_check = pg_escape_string($_POST['password1R']);

		// $strfN = strtolower($fN);
		$f_name = pg_escape_string($_POST['fName']);

		// $strlN = strtolower($lN);
		$l_name = pg_escape_string($_POST['lName']);

		if ($pwd_register == $pwd_check && isset($_POST['usernameR']) && isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['lName'])) {

			$identification = '';

			for ($i = 0; $i<7; $i++) {

			    $identification .= mt_rand(0,9);

			}

			$query_register = "INSERT INTO userProfile (userID, username, password, firstN, lastN, proPicURL) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "', '" . $f_name . "', '" . $l_name . "', '" . $pro_pic . "')";

			$db->exec($query_register);

			setcookie("userId", $un_register . $identification);

			header('Location: index.php');


		} else {

			echo "Field left empty" . $_POST['usernameR'] . $_POST['fName'] . $_POST['lName'];
			die();
			header('Location: index.php');

		}
// }
		// global $db;
		// global $bucket;
		// global $s3;

		// $uImg = $pPic;
		// $uImgN = $pPicN;
		// $uImgTN = $pPicTN;

		// if (isset($uImg)) {

		// 	$upload = $s3->upload($bucket, $uImgN, "l", 'public-read');
		// 	$pro_pic = htmlspecialchars($upload->get('ObjectURL'));

		// }
		
		// $strUn = strtolower($un);
		// $un_register = pg_escape_string($strUn);

		// $strpwd = strtolower($pwd);
		// $pwd_register = pg_escape_string($strpwd);

		// $strpwd1 = strtolower($pwd1);
		// $pwd_check = pg_escape_string($strpwd1);

		// $strfN = strtolower($fN);
		// $f_name = pg_escape_string($strfN);

		// $strlN = strtolower($lN);
		// $l_name = pg_escape_string($strlN);

		// if ($pwd_register == $pwd_check && isset($un) && isset($fN) && isset($lN) && isset($uImg)) {

		// 	$identification = '';

		// 	for ($i = 0; $i<7; $i++) {

		// 	    $identification .= mt_rand(0,9);

		// 	}

		// 	$query_register = "INSERT INTO userProfile (userID, username, password, firstN, lastN, proPicURL) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "', '" . $f_name . "', '" . $l_name . "', '" . $pro_pic . "')";

		// 	$db->exec($query_register);

		// 	setcookie("userId", $un_register . $identification);


		// } else {

		// 	echo "Field left empty" . $un . $fN . $lN;
		// 	die();

		// }
	}


    $results5 = $db->query('select * from userProfile');
	$hacks5 = $results5->fetchAll(PDO::FETCH_ASSOC);
	$hackId = array("k" => $hacks5);

	// function verify_username_password ($un, $pwd, $id) {
	if (isset($_POST['login'])) {
		global $db;

		// $strUn = strtolower($un);
		$un_ = pg_escape_string($_POST['username']);

		// $strpwd = strtolower($pwd);
		$pwd_ = pg_escape_string($_POST['password']);

		$stmt = $db->query("SELECT * FROM userProfile WHERE username = '" . $un_ . "' AND password = '" . $pwd_ . "'"); 
		$stmt->execute();

		if ($stmt->fetch()) {
			for ($i = 0; $i < count($hackId['k']); $i++) {
					if ($un == $hackId['k'][$i]['username']) {

						$uId = $hackId['k'][$i]['userid'];

					}
				}

				setcookie("userId", $uId);


			} else {

				echo $un_, $pwd_;
				die();

			}
	}

	// function log_user_out () {
	if (isset($_POST['logout'])) {
		if (isset($_COOKIE["userId"])) {

				setcookie("userId", '', time() - 10000);


		}
	}
// }

?>


