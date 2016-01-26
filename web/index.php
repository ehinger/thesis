<?php
// remove before flight
ini_set('display_errors', 'On');

try {
    $db = new PDO('pgsql:host=ec2-54-204-41-175.compute-1.amazonaws.com;port=5432;dbname=d6jmmjm506o0h9;user=ggamcflhqstetx;password=1jc95h0WehE3P8hvgnrQrx9rBT');  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$test = pg_escape_string($_POST['rT']); 

try {
	$results = $db->query('select * from test_table');
	$sql = "INSERT INTO test_table (id, name) VALUES ('2', '" . $test . "')";
    // use exec() because no results are returned
    $db->exec($sql);
	// echo '<pre>';
	// var_dump($results->fetchAll());
	// echo '</pre>';
	// die();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$hacks = $results->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html>
<head>
	<meta charset='utf-8'/>
	<title>hacks</title>
	<link rel='stylesheet' type='text/css' href='thesis.css'>
	<script type='text/javascript' src='jquery-2.1.4.min.js'></script>
	<script>
		$(document).bind('mobileinit',function(){
		    $.mobile.changePage.defaults.changeHash = false;
		    $.mobile.hashListeningEnabled = false;
		    $.mobile.pushStateEnabled = false;
		});
	</script>
	<script type='text/javascript' src='jquery.mobile-1.4.5.min.js'></script>
	
</head>
<body>

<!-- /************************************************************************************

Navigation Bar

************************************************************************************/ -->

<div class='navbutton'></div>
<div class='menuBar'></div>
<nav>

</nav>

<!-- /************************************************************************************

Post a hack

************************************************************************************/ -->

<div class='newHackFrame'>

	<div class='newHackClose'></div>

	<form class='recipeCreator' action="index.php" method="post">
		<label for='rT'>title:</label>
		<input name="rT" type='text'>
		<input type='submit' value='enter'>
	</form>

</div>

<!-- /************************************************************************************

Content Page

************************************************************************************/ -->
<?php 
	foreach ($hacks as $hack) {
		echo "<div class='hackSelectionFrame'>";
			echo "<img class='hackHeroImage' src='http://fillmurray.com/425/640'>";
			echo '<h1 class="hackTitle">'.$hack["name"].'</h1>';
			echo "<p class='hackShortDesc'>This is a thing</p>";
			echo "<div class='hackSelectionButton'>";
				echo "<h1 class='hackButtonText'>Enter</h1>";
			echo "</div>";
		echo "</div>";
	}
?>
<div class='hackSelectionFrame'>
	<img class='hackHeroImage' src='http://fillmurray.com/425/640'>
	<h1 class='hackTitle'>Thing</h1>
	<p class='hackShortDesc'>This is a thing</p>
	<div class='hackSelectionButton'>
		<h1 class='hackButtonText'>Enter</h1>
	</div>
</div>

<!-- /************************************************************************************

Instructions

************************************************************************************/ -->

<div id='instructions'>
	<div class='close'>
	</div>
	<div class='insframe'>
		<p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>
	</div>
</div>


<script src='thesis.js' type='text/javascript' ></script>
</body>
</html>