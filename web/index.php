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

class profiles {

    function register ($un, $pwd, $pwd1) {
        $un_register = pg_escape_string($un);
        $pwd_register = pg_escape_string($pwd);
        $pwd_check = pg_escape_string($pwd1);

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
}

$profiles = new profiles;

// if (isset($_POST['login'])) {
//     $profiles->validate_user($_POST['username'], $_POST['password']);
// }

if (isset($_POST['register'])) {
    $profiles->register($_POST['usernameR'], $_POST['passwordR'], $_POST['password1R']);
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
<form id='login' action='' method='post'>

    <label>Username:</label>
    <input name="username" type="text">

    <label>Password:</label>
    <input name="password" type="text">

    <input type="checkbox" name="remainLoggedIn" value="remainLoggedIn"> Stay logged in?<br>

    <input type="submit" value="login" name="login">

</form>

<form id='register' action='' method='post'>

    <label>Username:</label>
    <input name="usernameR" type="text">

    <label>Password:</label>
    <input name="passwordR" type="text">

    <label>Confirm password:</label>
    <input name="password1R" type="text">

    <input type="submit" value="register" name="l">

</form>
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

        <label>description:</label>
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
    // foreach ($hacks1 as $hack) {
    //     echo "<div class='hackSelectionFrame' id=".$hack['id'].">";
    //         echo "<img class='hackHeroImage' src='".$hack["type"]."'>";
    //         echo '<div class="infoWrapper"></div>';
    //         echo '<h1 class="hackTitle">'.$hack["title"].'</h1>';
    //         echo "<p class='hackShortDesc'>This hack can be used by people with a ".$hack["ability"]." ability level for ".$hack["type"]."</p>";
    //         echo "<div class='hackSelectionButton'>";
    //             echo "<h1 class='hackButtonText'>Enter</h1>";
    //         echo "</div>";
    //     echo "</div>";
    //     echo '<div class="close">';
    //     echo '</div>';
    //     echo '<div class="insframe">';
    //         echo '<p>This is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thingThis is a thing</p>';
    //     echo '</div>';
    // }
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