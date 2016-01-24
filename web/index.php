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

try {
	$results = $db->query('select * from test_table');
	echo "<pre>";
	var_dump($results->fetchAll());
	echo "</pre>";
	die();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$hacks = $results->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8"/>
	<title>hacks</title>
	<link rel="stylesheet" type="text/css" href="thesis.css">
	<script type="text/javascript" src="jquery-2.1.4.min.js"></script>
	<script>
		$(document).bind('mobileinit',function(){
		    $.mobile.changePage.defaults.changeHash = false;
		    $.mobile.hashListeningEnabled = false;
		    $.mobile.pushStateEnabled = false;
		});
	</script>
	<script type="text/javascript" src="jquery.mobile-1.4.5.min.js"></script>
	
</head>
<body>

<!-- /************************************************************************************

Navigation Bar

************************************************************************************/ -->

<div class="navbutton"></div>
<div class="menuBar"></div>
<nav>

</nav>

<!-- /************************************************************************************

Post a hack

************************************************************************************/ -->

<div class="newHackFrame">
	<div class="newHackClose"></div>
	<form class="recipeCreator">
		<label for="rT">title:</label>
		<input id="rT" type="text">
		<label for="rC">caption:</label>
		<input id="rC" type="text">
		<label for="rI">ingredients:</label>
		<input id="rI" type="text">
		<label for="rR">instructions:</label>
		<textarea id="rR"></textarea>
		<input type="submit" value="enter">
	</form>
</div>

<!-- /************************************************************************************

Content Page

************************************************************************************/ -->

<div class="hackSelectionFrame">
	<img class="hackHeroImage" src="http://fillmurray.com/425/640">
	<?php echo "<h1 class='hackTitle'>".$hacks['name']."</h1>"?>
	<p class="hackShortDesc">This is a thing</p>
	<div class="hackSelectionButton">
		<h1 class="hackButtonText">Enter</h1>
	</div>
</div>

<div class="hackSelectionFrame">
	<img class="hackHeroImage" src="http://fillmurray.com/425/640">
	<h1 class="hackTitle">Thing</h1>
	<p class="hackShortDesc">This is a thing</p>
	<div class="hackSelectionButton">
		<h1 class="hackButtonText">Enter</h1>
	</div>
</div>

<div class="hackSelectionFrame">
	<img class="hackHeroImage" src="http://fillmurray.com/425/640">
	<h1 class="hackTitle">Thing</h1>
	<p class="hackShortDesc">This is a thing</p>
	<div class="hackSelectionButton">
		<h1 class="hackButtonText">Enter</h1>
	</div>
</div>

<div class="hackSelectionFrame">
	<img class="hackHeroImage" src="http://fillmurray.com/425/640">
	<h1 class="hackTitle">Thing</h1>
	<p class="hackShortDesc">This is a thing</p>
	<div class="hackSelectionButton">
		<h1 class="hackButtonText">Enter</h1>
	</div>
</div>

<!-- /************************************************************************************

Instructions

************************************************************************************/ -->

<div id="instructions">
	<div class="close">
	</div>
	<div class="insframe">
		<p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>
	</div>
</div>


<script src="thesis.js" type="text/javascript" ></script>
</body>
</html>