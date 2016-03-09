<!DOCTYPE html>

<html>
<head>
    <meta charset='utf-8'/>
    <title>hacks</title>
    <link rel='stylesheet' type='text/css' href='thesis.css'>
    <script type='text/javascript' src='jquery-2.2.0.min.js'></script>
    
</head>

<?php
// remove before flight
ini_set('display_errors', 'On');

require('../vendor/autoload.php');

use Aws\S3\S3Client;

$options = [
    'region'            => 'ap-southeast-2',
    'version'           => 'latest'
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
    $results1 = $db->query('select * from hacksdesc');
    $results2 = $db->query('select * from hacksingredients');
    $results3 = $db->query('select * from hackssteps ');
    $results4 = $db->query('select * from hackstags');
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

// $identification = '';
// for ($i = 0; $i<7; $i++) 
// {
//     $identification .= mt_rand(0,9);
// }

// if (isset($_GET['hackI'])) {
//     $hackI = pg_escape_string($_GET['hackI']);
//     echo "<script>console.log('id is ');</script>";
// }

// if (isset($_POST['hackID'])) {
//     echo "<script>console.log('yay for stuff');</script>";
    // foreach ($hacks as $hack) {
    //  switch ($_POST['action']) {
    //         case $hack["id"]:
    //             echo "<script>console.log('yay for stuff');</script>";
    //             break;
    //         }
 //    }
// }

?>

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

<?php

?>

<div class='newHackFrame'>

    <div class='newHackClose'></div>

    <form enctype="multipart/form-data" id='recipeCreator' action="form.php" method="post">

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

        <input name="userfile" type="file">

<!--         <input type="submit" value="Upload"> -->
        
       <input type="button" onclick="hackSteps()" value="Add new step">

        <input type="submit" value="Submit" name="push">

    </form>

</div>

<!-- /************************************************************************************

Content Page

************************************************************************************/ -->

<?php 
    foreach ($hacks1 as $hack) {
        // echo "<div class='hackSelectionFrame' id=".$hack['id'].">";
        //     echo "<img class='hackHeroImage' src='".$hack["type"]."'>";
        //     echo '<div class="infoWrapper"></div>';
        //     echo '<h1 class="hackTitle">'.$hack["title"].'</h1>';
        //     echo "<p class='hackShortDesc'>This hack can be used by people with a ".$hack["ability"]." ability level for ".$hack["type"]."</p>";
        //     echo "<div class='hackSelectionButton'>";
        //         echo "<h1 class='hackButtonText'>Enter</h1>";
        //     echo "</div>";
        // echo "</div>";
        // echo '<div class="close">';
        // echo '</div>';
        // echo '<div class="insframe">';
        //     echo '<p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>';
        // echo '</div>';
        echo '<div class="hackSelectionFrame" id='.$hack["id"].'>';
            echo '<img class="hackHeroImage" src='.$hack["type"].'>';
            echo '<div class="infoWrapper"></div>';
            echo '<h1 class="hackTitle">'.$hack["title"].'</h1>';
            echo '<p class="hackShortDesc">This hack can be used by people with a '.$hack["ability"].' ability level for '.$hack["type"].'</p>';
            echo '<div class="hackSelectionButton">';
               echo  '<h1 class="hackButtonText">Enter</h1>';
            echo '</div>';
            echo '<div class="close">';
            echo '</div>';
            echo '<div class="insframe">';
                echo '<p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>';
            echo '</div>';
        echo '</div>';
    }
?>

<!-- /************************************************************************************

Instructions

************************************************************************************/ -->

<!--     // foreach ($hacks2 as $hack) {
    //     echo "<div id='instructions'>"
    //         echo "<div class='close'>"
    //         echo "</div>"
    //         echo "<div class='insframe'>"
    //             echo "<p></p>"
    //         echo "</div>"
    //     echo "</div>"
    // } -->

<!-- <div id="instructions">
    <div class="close">
    </div>
    <div class="insframe">
        <p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>
    </div>
</div> -->

<script src='thesis.js' type='text/javascript' ></script>
</body>
</html>

<!-- heroku-postgres-dd0c9417::BLACK=> create table hacksGeneral (hackID text, heroImageURL text, title text, type text, description text, userID text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hacksTags (hackID text, tags text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hacksSupplies (hackID text, number integer, item text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hackInstructions (hackID text, stage text, stepNumber integer, instructions text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table hackInstructionsImages (hackID text, stage text, stepNumber integer, imageURL text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=> create table user (userID text, username text, password text);
ERROR:  syntax error at or near "user"
LINE 1: create table user (userID text, username text, password text...
                     ^
heroku-postgres-dd0c9417::BLACK=> create table userProfile (userID text, username text, password text);
CREATE TABLE
heroku-postgres-dd0c9417::BLACK=>  -->