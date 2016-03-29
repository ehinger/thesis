<?php

require_once "dbconn.php";

class profiles {

	function register ($un, $pwd, $pwd1) {
		global $db;
		$un_register = pg_escape_string($un);
		$pwd_register = pg_escape_string($pwd);
		$pwd_check = pg_escape_string($pwd1);
		if ($pwd_register == $pwd_check) {
			$identification = '';
			for ($i = 0; $i<7; $i++) 
			{
			    $identification .= mt_rand(0,9);
			}
			$query_register = "INSERT INTO userProfile (userID, username, password) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $pwd_register . "')";
			$db->exec($query_register);
			header('Location: index.php');
		} else {
			echo "passwords don't match";
			die();
		}
	}

	function verify_username_password ($un, $pwd) {
		global $db;

		$query = "SELECT FROM userProfile WHERE username = '" . $un . "' AND password = '" . $pwd . "' LIMIT 1";

		$stmt = $db->prepare($query); 
		$stmt->execute();

			if ($stmt->fetch()) {
				$stmt->close();
			}
	}

	function validate_user($un, $pwd, $id) {

		$un_ = pg_escape_string($un);
		$pwd_ = pg_escape_string($pwd);

		$ensure_credentials = $this->verify_username_password($un_, $pwd_);

		if ($ensure_credentials == true) {
			// $_SESSION['status'] = 'authorised';
			// return true;
			// for ($i = 0; $i < count($id['k']); $i++) {
			// 	if ($un == $id['k'][$i]['username']) {
			// 		$uId = $id['k'][$i]['userID'];
			// 	}
			// }
			// setcookie("userId", $uId);
				echo "match";
				die();

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