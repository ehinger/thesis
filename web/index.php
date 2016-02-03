<?php
// remove before flight
ini_set('display_errors', 'On');

// $domFile = new simple_html_dom();
// $domFile->load_file('https://thesis-tom.herokuapp.com/');

// $idCheck = $domFile->find('div[id='.$hack["id"].']',0);

require('../vendor/autoload.php');

use Aws\S3\S3Client;

$options = [
    'region'            => 'ap-southeast-2',
    'version'           => 'latest',
];

$s3 = new S3Client($options);

$bucket = getenv('S3_BUCKET')?: 
die('No "S3_BUCKET" config var in found in env!');

try {
    $db = new PDO('pgsql:host=ec2-54-204-41-175.compute-1.amazonaws.com;port=5432;dbname=d6jmmjm506o0h9;user=ggamcflhqstetx;password=1jc95h0WehE3P8hvgnrQrx9rBT');  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$identification = '';
for ($i = 0; $i<7; $i++) 
{
    $identification .= mt_rand(0,9);
}

try {
    $results1 = $db->query('select * from hacksdesc');
    $results2 = $db->query('select * from hacksingredients');
    $results3 = $db->query('select * from hackssteps ');
    $results4 = $db->query('select * from hackstags');
    if (isset($_POST['push'])){
        $title = pg_escape_string($_POST['hackTitle']); 
        $ability = pg_escape_string($_POST['hackAbility']); 
        $type = pg_escape_string($_POST['hackType']); 
        $sql = "INSERT INTO hacksdesc (id, title, ability, type) VALUES ('" . $title . $identification . "', '" . $title . "', '" . $ability . "', '" . $type . "')";
        // use exec() because no results are returned
        $db->exec($sql);

  //       echo '$(".newHackClose").on("click", function(event) {';
		// echo 	'$(".newHackFrame").removeClass( "offset5" );';
		// echo 	'$(".newHackFrame *").removeClass( "offset6" );';
		// echo 	'$("body").removeClass( "offset4" );';
		// echo '}';
	});
    }
    // echo '<pre>';
    // var_dump($results->fetchAll());
    // echo '</pre>';
    // die();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}



$hacks = $results1->fetchAll(PDO::FETCH_ASSOC);

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


	<?php
	    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['pic']['tmp_name'])) {
	                // FIXME: add more validation, e.g. using ext/fileinfo
	                try {
	                    // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
	                    $upload = $s3->upload($bucket, $_FILES['pic']['name'], fopen($_FILES['pic']['tmp_name'], 'rb'), 'public-read');
	                } catch (Exception $e) {
	                    echo $e->getMessage();
	                    die();
	                }
	            }  
	?> 

    <div class='newHackClose'></div>

    <form enctype="multipart/form-data" id='recipeCreator' action="<?=$_SERVER['PHP_SELF']?>" method="post">

        <label>Title:</label>
        <input name="hackTitle" type='text'>

        <label>Ability:</label>
        <input name="hackAbility" type='text'>

        <label>Type:</label>
        <select name="hackType">
            <option value="nutrition">Nutrition</option>
            <option value="fitness">Fitness</option>
            <option value="personalCare">Personal Care</option>
            <option value="communication">Communication</option>
        </select>

        <label>Tags:</label>
        <textarea name="hackDesc" rows="10" cols="30">
        </textarea>

        <div class="ingredient">        
            <label>Ingredients:</label>
            <input type="number" name="ingredientsQuantity" min="1">
            <input name="hackIngredients" type='text'>  
        </div>

       <input type="button" onclick="ingredientSelection()" value="Add another">

        <div class="steps">     
        </div>

        <input type='file' name='pic'>

        <input type="submit" value="Upload">
        
       <input type="button" onclick="hackSteps()" value="Add new step">

        <input type="submit" value="Submit" name="push">

    </form>

</div>

<!-- /************************************************************************************

Content Page

************************************************************************************/ -->

<?php 
    foreach ($hacks as $hack) {
        echo "<div class='hackSelectionFrame'>";
            echo "<img class='hackHeroImage' src='http://fillmurray.com/425/640'>";
            echo '<h1 class="hackTitle">'.$hack["title"].'</h1>';
            echo "<p class='hackShortDesc'>This hack can be used by people with a ".$hack["ability"]." ability level for ".$hack["type"]."</p>";
            echo "<div class='hackSelectionButton ".$hack["id"]."'>";
                echo "<h1 class='hackButtonText'>Enter</h1>";
            echo "</div>";
        echo "</div>";
    }
?>

<!-- /************************************************************************************

Instructions

************************************************************************************/ -->

<div id='instructions'>
    <div class='close'>
    </div>
    <div class='insframe'>
        <p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing
        This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing
        This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing
        This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing
        This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing
        This is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>
    </div>
</div>


<script src='thesis.js' type='text/javascript' ></script>
</body>
</html>

<!-- heroku-postgres-dd0c9417::BLACK=> create table hacksDesc (id text, title text, ability text, type text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hacks tags (id text, tag1 text);
ERROR:  syntax error at or near "tags"
LINE 1: create table hacks tags (id text, tag1 text);
                           ^
heroku-postgres-dd0c9417::BLACK=> create table hackstags (id text, tag1 text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hacksingredients (id text, quantity1 integer, ingredient1 text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hackssteps (id text, stepno integer, desc text);
ERROR:  syntax error at or near "desc"
LINE 1: create table hackssteps (id text, stepno integer, desc text)...
                                                          ^
heroku-postgres-dd0c9417::BLACK=> create table hackssteps (id text, stepno integer, desc text);
ERROR:  syntax error at or near "desc"
LINE 1: create table hackssteps (id text, stepno integer, desc text)...
                                                          ^
heroku-postgres-dd0c9417::BLACK=> create table hackssteps (id text, stepno integer, descrption text);
CREATE TABLE -->
