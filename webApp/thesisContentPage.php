<!DOCTYPE html>
<html>
<head>
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

<div class="hackSelectionFrame1">
	<img src="http://i.imgur.com/FYOZjkA.jpg">
	<h1>Thing</h1>
	<p>This is a thing</p>
	<div class="hackSelectionButton">
		<h1>Enter</h1>
	</div>
</div>

<div class="hackSelectionFrame1">
	<img src="http://i.imgur.com/Y3nI6Nx.jpg">
	<h1>Thing</h1>
	<p>This is a thingThis is a thingThis is a thing</p>
	<div class="hackSelectionButton">
		<h1>Enter</h1>
	</div>
</div>

<div class="hackSelectionFrame1">
	<img src="https://s-media-cache-ak0.pinimg.com/736x/ca/97/c3/ca97c3a011fa5a5a94f9279c789d466a.jpg">
	<h1>Thing</h1>
	<p>This is a thingThis is a thing</p>
	<div class="hackSelectionButton">
		<h1>Enter</h1>
	</div>
</div>

<div class="instructions">
<div class="insframe">
	<p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>
	</div>
	<div class="close">
	</div>
</div>

<script src="thesis.js" type="text/javascript" ></script>
</body>
</html>