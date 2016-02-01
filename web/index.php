<?php
// remove before flight
ini_set('display_errors', 'On');

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

try {
    $results = $db->query('select * from test_table');
    if (isset($_POST['push'])){
        $test = pg_escape_string($_POST['hackTitle']); 
        $sql = "INSERT INTO test_table (id, name) VALUES ('2', '" . $test . "')";
        // use exec() because no results are returned
        $db->exec($sql);
    }
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

<!--     <div class='newHackClose'></div>

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

<!--        <input type="button" onclick="ingredientSelection()" value="Add another"> -->

<!--         <div class="steps">     
        </div>

        <input type='file' name='pic'> -->
        
<!--        <input type="button" onclick="hackSteps()" value="Add new step"> -->

<!--         <input type="submit" value="Submit" name="push"> -->
<!-- 
    </form>  -->

</div>

<!-- /************************************************************************************

Content Page

************************************************************************************/ -->
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>


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