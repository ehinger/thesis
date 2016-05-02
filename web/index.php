<!DOCTYPE html>

<html>
<head>
    <meta charset='utf-8'/>
    <title>hacks</title>
    <link rel='stylesheet' type='text/css' href='thesis.css'>
    <script type='text/javascript' src='jquery-2.2.0.min.js'></script>
    <script type='text/javascript' src='jquery-2.2.0.min.js'></script>
    <script src="/js-cookie-2.1.0/src/js.cookie.js"></script>
</head>

<?php
// remove before flight
ini_set('display_errors', 'On');

require_once "dbconn.php";
require_once "profiles.php";

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

$profiles = new profiles;

$hackId = array("k" => $hacks5);

if (isset($_POST['login'])) {
    $profiles->verify_username_password($_POST['username'], $_POST['password'], $hackId);
}

if (isset($_POST['register'])) {
    $profiles->register($_POST['usernameR'], $_POST['passwordR'], $_POST['password1R'], $_POST['fName'], $_POST['lName'], $_FILES['proPic'], $_FILES['proPic']['name'], $_FILES['proPic']['tmp_name']);
}

if (isset($_POST['logout'])) {
    $profiles->log_user_out();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setcookie("u", $_POST['follow']);
}

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

<script type="text/javascript">


var n = 4;
function abilityProfileStageTwo() {
    $("#abilityProfileStageTwoButton").hide();
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
//  questionsNew = "";
//  questionsNew += '<label></label>';
//  questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
//  questionsNew += '<label></label>';
//  questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
//  questionsNew += '<label></label>';
//  questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
//  $('.nextThreeQuestions').before(questionsNew);
//  // console.log(n++, n++, n++);
// }
document.getElementById("abilityProfileStageTwoButton").addEventListener("click", abilityProfileStageTwo);
</script>

<!-- /************************************************************************************

Navigation Bar

************************************************************************************/ -->

<div class='navbutton'></div>
<div class='menuBarYourHacks'>
    <h1 class='menuBarYourHacksText'>Hacks</h1>
</div>
<div class='menuBarProfile'>
    <h1 class='menuBarProfileText'>Profile</h1>
</div>
<div class='menuBarSettings'>
    <h1 class='menuBarSettingsText'>Settings</h1>
</div>
<nav>
<div class="logInPage">
    <form id='login' action='' method='post'>

        <label>Username:</label>
        <input name="username" type="text">

        <label>Password:</label>
        <input name="password" type="password">

<!--         <input type="checkbox" name="remainLoggedIn" value="remainLoggedIn"> Stay logged in?<br> -->

        <input type="submit" value="login" name="login">

    </form>

    <div class="startRegistration"></div>

</div>

<div class="loggedInPage">
    <form id='logout' action='' method='post'>

        <input type="submit" value="logout" name="logout">

    </form>   
</div>

<div class="registerPage">
    <form enctype="multipart/form-data" id='register' action='' method='post'>

        <label>Username:</label>
        <input name="usernameR" type="text">

        <label>Password:</label>
        <input name="passwordR" type="password">

        <label>Confirm password:</label>
        <input name="password1R" type="password">

        <label>First name:</label>
        <input name="fName" type="text">

        <label>Last name:</label>
        <input name="lName" type="text">

        <label>Profile pic:</label>
        <input name="proPic" type="file">

        <input type="submit" value="register" name="register">

    </form>
</div>

<div class="abilityProfilePage">
    <form enctype="multipart/form-data" id='abilityRegister' action='' method='post'>

        <label>Upper or Lower body:</label>
        <select name="upOrLow">
            <option value="upper">Upper</option>
            <option value="lower">Lower</option>
        </select>

        <label>Left or Right side:</label>
        <select class="leftOrRight" name="leftOrRight">
            <option value="left">Left</option>
            <option value="right">Right</option>
        </select>

        <input id="abilityProfileStageTwoButton" type="button" value="Next">

    </form>
</div>

<div class="yourHacksPage">
    <?php
        for ($i = 0; $i < count($hacksGeneral['k']); $i++) {
            if ($hacksGeneral['k'][$i]['userid'] == $_COOKIE["userId"]) {
                echo "<div class='hackSelectionFrame' id='".$hacksGeneral['k'][$i]['hackid']."'>";
                echo "<img class='hackHeroImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";
                echo '<div class="infoWrapper"></div>';
                echo '<h1 class="hackTitle">'.$hacksGeneral['k'][$i]['title'].'</h1>';
                echo "<p class='hackShortDesc'>This hack can be used by people with a ability level for ".$hacksGeneral['k'][$i]['type']."</p>";

                for ($n = 0; $n < count($hacksTags['k']); $n++) {
                    if ($hacksTags['k'][$n]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                        echo "<p class='hackTags'>".$hacksTags['k'][$n]['tags'].",</p>";
                    }  
                }

                echo "<div class='hackSelectionButton'>";
                echo "<h1 class='hackButtonText'>Enter</h1>";
                echo "</div>";
                echo '<div class="close">';
                echo '</div>';
                echo '<div class="insframe">';

                echo "<p class='hackShortDesc'>".$hacksGeneral['k'][$i]['description']."</p>";

                for ($in = 0; $in < count($hacksSupplies['k']); $in++) {
                    if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                        echo "<p class='hackSupplies'>".$hacksSupplies['k'][$in]['supplyno']." X    ".$hacksSupplies['k'][$in]['item']."</p>";
                    }
                }

                for ($ni = 0; $ni < count($hacksInstructions['k']); $ni++) {
                    if ($hacksInstructions['k'][$ni]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                        echo "<h1 class='stepNumber'>Step ".$hacksInstructions['k'][$ni]['stepnumber']."</h1>";
                        echo "<p class='hackInstructions'>".$hacksInstructions['k'][$ni]['instructions']."</p>";
                    }
                }
                // echo "<div class='follow' id='".$hacksGeneral['k'][$i]['hackid']."'>";       
                // echo "<h1>Follow</h1>";       
                // echo "</div>";   
                echo '</div>';
                echo "</div>";
            }
            
        }
    ?>
</div>

<div class="yourSettingsPage">
    <label> Font size:</label>
    <input class="textSize" type="range" name="textSize" min="12" max="36" onchange="textSize(this.value)"></input>
</div>
</nav>

<!-- /************************************************************************************

Post a hack

************************************************************************************/ -->

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

        <label>Description:</label>
        <textarea name="hackDesc" rows="4" cols="50">
        </textarea>

        <div class="ingredient">        
            <label>Resources:</label>
            <input type="number" name="ingredientsQuantity[]" min="1">
            <input name="hackIngredients[]" type='text'>  
        </div>

        <input type="button" onclick="ingredientSelection()" value="Add another resource">

        <label>Tags:</label>
        <input name="hackTags[]" type='text'>
        <input name="hackTags[]" type='text'>
        <input name="hackTags[]" type='text'>

        <label>Title image:</label>
        <input name="userfile[]" type="file">
        
        <div class="steps">     
        </div>

        <!--         <input type="submit" value="Upload"> -->
        
        <input type="button" onclick="hackSteps()" value="Add new step">

        <input type="submit" value="Submit" name="push">

    </form>

</div>


<!-- /************************************************************************************

Content Page

************************************************************************************/ -->

<?php 
for ($i = 0; $i < count($hacksGeneral['k']); $i++) {
    echo "<div class='hackSelectionFrame' id='".$hacksGeneral['k'][$i]['hackid']."'>";
    echo "<img class='hackHeroImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";
    echo '<div class="infoWrapper"></div>';
    echo '<h1 class="hackTitle">'.$hacksGeneral['k'][$i]['title'].'</h1>';
    echo "<p class='hackShortDesc'>This hack can be used by people with a ability level for ".$hacksGeneral['k'][$i]['type']."</p>";

    for ($n = 0; $n < count($hacksTags['k']); $n++) {
        if ($hacksTags['k'][$n]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
            echo "<p class='hackTags'>".$hacksTags['k'][$n]['tags'].",</p>";
        }  
    }

    echo "<div class='hackSelectionButton'>";
    echo "<h1 class='hackButtonText'>Enter</h1>";
    echo "</div>";
    echo '<div class="close">';
    echo '</div>';
    echo '<div class="insframe">';

    echo "<p class='hackShortDesc'>".$hacksGeneral['k'][$i]['description']."</p>";

    for ($in = 0; $in < count($hacksSupplies['k']); $in++) {
        if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
            echo "<p class='hackSupplies'>".$hacksSupplies['k'][$in]['supplyno']." X    ".$hacksSupplies['k'][$in]['item']."</p>";
        }
    }

    for ($ni = 0; $ni < count($hacksInstructions['k']); $ni++) {
        if ($hacksInstructions['k'][$ni]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
            echo "<h1 class='stepNumber'>Step ".$hacksInstructions['k'][$ni]['stepnumber']."</h1>";
            echo "<p class='hackInstructions'>".$hacksInstructions['k'][$ni]['instructions']."</p>";
        }
    }
    // echo "<div class='follow' id='".$hacksGeneral['k'][$i]['hackid']."'>";       
    // echo "<h1>Follow</h1>";       
    // echo "</div>";   
    echo '</div>';
    echo "</div>";
}
?>

<form enctype="multipart/form-data" id='followForm' action="form.php" method="post">
</form>

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