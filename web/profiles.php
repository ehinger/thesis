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

try {
    $results1 = $db->query('select * from hacksGeneral');
    $results2 = $db->query('select * from hacksTags');
    $results3 = $db->query('select * from hacksSupplies');
    $results4 = $db->query('select * from hackInstructions');
    $results5 = $db->query('select * from userProfile');
    // echo '<pre>';
    // var_dump($results->fetchAll());
    // echo '</pre>';
    // die();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$hacks1 = $results1->fetchAll(PDO::FETCH_ASSOC);
$hacks2 = $results2->fetchAll(PDO::FETCH_ASSOC);
$hacks3 = $results3->fetchAll(PDO::FETCH_ASSOC);
$hacks4 = $results4->fetchAll(PDO::FETCH_ASSOC);
$hacks5 = $results5->fetchAll(PDO::FETCH_ASSOC);

$hacksGeneral = array("k" => $hacks1);
$hacksTags = array("k" => $hacks2);
$hacksSupplies = array("k" => $hacks3);
$hacksInstructions = array("k" => $hacks4);

?>
<script type="text/javascript">

var n = 4;
function abilityProfileStageTwo() {
	$(".abilityProfileStageTwoButton").hide();
	questions += <?php for ($i = 0; $i < count($hacksGeneral["k"]); $i++) {?>;
	questions += <?php echo "<p>On a scale of not at all to not a problem:</p>"?>; 
	questions += <?php echo "<label>".$hacksGeneral['k'][$i]['hackid']."</label>"?>;
	questions += <?php }?>;
	questions += <?php echo '<input class="q1" type="range" name="q1" min="0" max="10">'?>;
	questions += <?php echo '<label></label>'?>;
	questions += <?php echo '<input class="q2" type="range" name="q2" min="0" max="10">'?>;
	questions += <?php echo '<label></label>'?>;
	questions += <?php echo '<input class="q3" type="range" name="q3" min="0" max="10">'?>;
	questions += <?php echo '<input class="nextThreeQuestions" type="button" onclick="abilityProfileNextThreeQuestions()" value="Next">'?>;
	questions += <?php echo '<input type="submit" value="abilityRegister" name="abilityRegister">'?>;
	$('#abilityRegister').append(questions);
}

// var questionsNew = "";

// function abilityProfileNextThreeQuestions() { 
// 	questionsNew = "";
// 	questionsNew += '<label></label>';
// 	questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
// 	questionsNew += '<label></label>';
// 	questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
// 	questionsNew += '<label></label>';
// 	questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
// 	$('.nextThreeQuestions').before(questionsNew);
// 	// console.log(n++, n++, n++);
// }
</script>

