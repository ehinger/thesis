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

var_dump($db);

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

<nav>
	<ul>
		<li><a href="" id="selected">page 1</a></li>
		<li><a href="" id="selected">page 2</a></li>
	</ul>
	<div id="navButton">

	</div>
</nav>

<!-- /************************************************************************************

Content Page

************************************************************************************/ -->

<!-- <div class="hackSelectionFrame1">
	<img src="http://i.imgur.com/FYOZjkA.jpg">
	<h1>Thing</h1>
	<p>This is a thing</p>
	<div class="hackSelectionButton">
		<h1>Enter</h1>
	</div>
</div> -->

<div class="hackSelectionFrame1">

</div> <!-- hackSelectionFrame1 -->

<div id="instructions">

</div>

<script src="thesis.js" type="text/javascript" ></script>
</body>
</html>