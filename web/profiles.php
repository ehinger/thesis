<?php

require_once "dbconn.php";

if (isset($_POST['register'])) {
    $un_register = pg_escape_string($_POST['usernameR']);
		$pwd_register = pg_escape_string($_POST['passwordR']);
		$pwd_check = pg_escape_string($_POST['password1R']);
		
		if ($pwd_register == $pwd_check) {
			$identification = '';
			for ($i = 0; $i<7; $i++) 
			{
			    $identification .= mt_rand(0,9);
			}

			$query_register = "INSERT INTO userProfile (userID, username, password) VALUES ('" . $un_register . $identification . "', '" . $un_register . "', '" . $$pwd_register . "')";

			$db->exec($query_register);

			echo "passwords do match";
			die();

		} else {
			echo "passwords don't match";
			die();
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

?>