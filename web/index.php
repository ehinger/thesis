<!DOCTYPE html>

<html>
<head>
    <meta charset='utf-8'/>
    <title>hacks</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type='text/css' href='thesis.css'>
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
    $results6 = $db->query('select * from userAbility');
    $results7 = $db->query('select * from userAnswersOne');
    $results8 = $db->query('select * from userQuestions');
    $results9 = $db->query('select * from userFollowing');
    $results10 = $db->query('select * from hackTips');

} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$hacks1 = $results1->fetchAll(PDO::FETCH_ASSOC);
$hacks2 = $results2->fetchAll(PDO::FETCH_ASSOC);
$hacks3 = $results3->fetchAll(PDO::FETCH_ASSOC);
$hacks4 = $results4->fetchAll(PDO::FETCH_ASSOC);
$hacks5 = $results5->fetchAll(PDO::FETCH_ASSOC);
$hacks6 = $results6->fetchAll(PDO::FETCH_ASSOC);
$hacks7 = $results7->fetchAll(PDO::FETCH_ASSOC);
$hacks8 = $results8->fetchAll(PDO::FETCH_ASSOC);
$hacks9 = $results9->fetchAll(PDO::FETCH_ASSOC);
$hacks10 = $results10->fetchAll(PDO::FETCH_ASSOC);

$hacksGeneral = array("k" => $hacks1);
$hacksTags = array("k" => $hacks2);
$hacksSupplies = array("k" => $hacks3);
$hacksInstructions = array("k" => $hacks4);
$userProfile = array("k" => $hacks5);
$userAbility = array("k" => $hacks6);
$userAnswers = array("k" => $hacks7);
$userQuestions = array("k" => $hacks8);
$userFollowing = array("k" => $hacks9);
$hackTips = array("k" => $hacks10);

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

?>


<body>

<!-- /************************************************************************************

Navigation Bar

************************************************************************************/ -->

<div class='navbutton'>
    <h1 class='navText'>Start browsing</h1>
</div>

<div class='menuBarYourHacks'>
    <h1 class='menuBarYourHacksText'>DIY</h1>
</div>
<div class='menuBarProfile'>
    <h1 class='menuBarProfileText'>Profile</h1>
</div>
<div class='menuBarSettings'>
    <h1 class='menuBarSettingsText'>Settings</h1>
</div>
<nav>
    <div class="logInPage">
    <h1 class="welcome">Welcome!</h1> 
    <p class="intro">This website can help you with all your assistive diy needs. You either can start by logging in here...</p>
        <form id='login' action='' method='post'>

            <label>Username:</label>
            <input name="username" type="text">

            <label>Password:</label>
            <input name="password" type="password">

            <!--         <input type="checkbox" name="remainLoggedIn" value="remainLoggedIn"> Stay logged in?<br> -->

            <input type="submit" value="login" name="login">

        </form>

        <div class="lineL"></div>
        <p class="or">Or</p>
        <div class="lineR"></div>

        <div class="startRegistration">
            <p class="startResgisterText">Create an account</p>
        </div>

        <div class="lineL"></div>
        <p class="or">Or</p>
        <div class="lineR"></div>
            <input type="submit" value="login" name="login">


    </div>

    <div class="loggedInPage">

        <?php 
        for ($i = 0; $i < count($userProfile['k']); $i++) {
            if ($userProfile['k'][$i]['userid'] == $_COOKIE["userId"]) {
            echo "<img class='hackHeroImage' src='".$userProfile['k'][$i]['propicurl']."'>";
            echo '<div class="profilePage">';
            echo '<h1 class="proName">'.$userProfile['k'][$i]['firstn'].' '.$userProfile['k'][$i]['lastn'].'</h1>';
            echo '</div>';
            echo '<form id="logout" action="" method="post">';
            echo '<input type="submit" value="logout" name="logout">';
            echo '</form> ';
        }
        }
        ?>

        

            

        
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

    <div class="hacksLogIn">
    <p class="intro">You need to log in or create an account to use this page.</p>
        <form id='login' action='' method='post'>

            <label>Username:</label>
            <input name="username" type="text">

            <label>Password:</label>
            <input name="password" type="password">

            <!--         <input type="checkbox" name="remainLoggedIn" value="remainLoggedIn"> Stay logged in?<br> -->

            <input type="submit" value="login" name="login">

        </form>

        <div class="lineL"></div>
        <p class="or">Or</p>
        <div class="lineR"></div>

        <div class="startRegistration">
            <p class="startResgisterText">Create account</p>
        </div>
    </div>

    <div class="yourHacksPage">
        <div class="yourHacksButtons">
            <div class="yourHacksYourHacks">
                <p class="yourHacksYourHacksText">Your DIY</p>
            </div>
            <div class="yourHacksFollowedHacks">
                <p class="yourHacksFollowedHacksText">Bookmarked DIY</p>
            </div>
            <div class="yourHacksCreateHacks">
                <p class="yourHacksCreateHacksText">Create DIY</p>
            </div>
        </div>

        <div class="yourHacksMade">
            <?php
            for ($i = 0; $i < count($hacksGeneral['k']); $i++) {
                if ($hacksGeneral['k'][$i]['userid'] == $_COOKIE["userId"]) {
                    echo "<div class='hackSelectionFrameYourHacks' id='".$hacksGeneral['k'][$i]['hackid']."YourHacks'>";
                    echo "<img class='hackHeroImageYourHacks' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";
                    echo '<div class="infoWrapperYourHacks"></div>';
                    echo '<h1 class="hackTitle">'.$hacksGeneral['k'][$i]['title'].'</h1>';
                    echo "<div class='hackUnderline'></div>";
                    echo "<p class='hackShortDesc'>".$hacksGeneral['k'][$i]['description']."</p>";
                    echo "<div class='hackSelectionButtonYourHacks'>";
                    echo "<h1 class='hackButtonText'>Enter</h1>";
                    echo "<div class='hackArrowOther'></div>";
                    echo "</div>";
                    echo '<div class="closeYourHacks">';
                    echo "<h1 class='menuBarProfileText'>Close</h1>";
                    echo '</div>';
                    echo '<div class="insframeYourHacks">';

                        echo "<h1 class='subtitle'>This is what you'll need:</h1>";
                        echo "<div class='hackTextUnderline'></div>";
                        for ($in = 0; $in < count($hacksSupplies['k']); $in++) {
                            if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                                echo "<p class='hackSupplies'>".$hacksSupplies['k'][$in]['supplyno']." X    ".$hacksSupplies['k'][$in]['item']."</p>";
                                echo "<p class='hackSuppliesAlt'>Alternative: ".$hacksSupplies['k'][$in]['altingredient']."</p>";
                            }
                        }

                        echo "<div class='hackTextUnderline'></div>";
                        echo "<h1 class='subtitle'>Here are some tips:</h1>";
                        echo "<div class='hackTextUnderline'></div>";
                        for ($in = 0; $in < count($hackTips['k']); $in++) {
                            if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                                echo "<p class='hackSupplies'>- ".$hackTips['k'][$in]['tip']."</p>";
                            }
                        }

                    for ($ni = 0; $ni < count($hacksInstructions['k']); $ni++) {
                        if ($hacksInstructions['k'][$ni]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                            echo "<div class='hackTextUnderline'></div>";
                            echo "<h1 class='stepNumber'>Step ".$hacksInstructions['k'][$ni]['stepnumber']."</h1>";
                            echo "<img class='hackStepImage' src='".$hacksInstructions['k'][$ni]['stage']."'>";
                            echo "<p class='hackInstructions'>".$hacksInstructions['k'][$ni]['instructions']."</p>";
                        }
                    }

                    echo "<div class='hackTextUnderline'></div>";
                    echo "<h1 class='subtitle'>Here's what it should look like:</h1>";
                    echo "<img class='hackStepImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";

                    echo "<div class='hackTextUnderline'></div>";
                    for ($ui = 0; $ui < count($userProfile['k']); $ui++) {
                        if ($userProfile['k'][$ui]['userid'] == $hacksGeneral['k'][$i]['userid']) {
                            echo "<img class='proPichack' src='".$userProfile['k'][$ui]['propicurl']."'>";
                            echo "<p class='usernameHack'>".$userProfile['k'][$ui]['username']."</p>";
                        }
                    }
                    echo "<form class='follow' action='form.php' method='post'>";       
                    echo "<input type='submit' value='delete' name='del'>";       
                    echo "</form>";  
                    echo '</div>';
                    echo "</div>";
                }
                
            }
            ?>
        </div>

         <div class="followedHacks">
        <?php
        for ($im = 0; $im < count($userFollowing['k']); $im++) { 
            if ($userFollowing['k'][$im]['userid'] == $_COOKIE["userId"]) {
                for ($i = 0; $i < count($hacksGeneral['k']); $i++) {
                    if ($userFollowing['k'][$im]['following'] == $hacksGeneral['k'][$i]['hackid']) {
                        echo "<div class='hackSelectionFrameFollowedHacks' id='".$hacksGeneral['k'][$i]['hackid']."FollowedHacks'>";
                        echo "<img class='hackHeroImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";
                        echo '<div class="infoWrapperFollowedHacks"></div>';
                        echo '<h1 class="hackTitle">'.$hacksGeneral['k'][$i]['title'].'</h1>';
                        echo "<div class='hackUnderline'></div>";
                        echo "<p class='hackShortDesc'>".$hacksGeneral['k'][$i]['description']."</p>";
                        echo "<div class='hackSelectionButtonFollowedHacks'>";
                        echo "<h1 class='hackButtonText'>Enter</h1>";
                        echo "<div class='hackArrowOther'></div>";
                        echo "</div>";
                        echo '<div class="closeFollowedHacks">';
                        echo "<h1 class='menuBarProfileText'>Close</h1>";
                        echo '</div>';
                        echo '<div class="insframeFollowedHacks">';


                        echo "<h1 class='subtitle'>This is what you'll need:</h1>";
                        echo "<div class='hackTextUnderline'></div>";
                        for ($in = 0; $in < count($hacksSupplies['k']); $in++) {
                            if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                                echo "<p class='hackSupplies'>".$hacksSupplies['k'][$in]['supplyno']." X    ".$hacksSupplies['k'][$in]['item']."</p>";
                                echo "<p class='hackSuppliesAlt'>Alternative: ".$hacksSupplies['k'][$in]['altingredient']."</p>";
                            }
                        }

                        echo "<div class='hackTextUnderline'></div>";
                        echo "<h1 class='subtitle'>Here are some tips:</h1>";
                        echo "<div class='hackTextUnderline'></div>";
                        for ($in = 0; $in < count($hackTips['k']); $in++) {
                            if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                                echo "<p class='hackSupplies'>- ".$hackTips['k'][$in]['tip']."</p>";
                            }
                        }

                        for ($ni = 0; $ni < count($hacksInstructions['k']); $ni++) {
                            if ($hacksInstructions['k'][$ni]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
                                echo "<div class='hackTextUnderline'></div>";
                                echo "<h1 class='stepNumber'>Step ".$hacksInstructions['k'][$ni]['stepnumber']."</h1>";
                                echo "<img class='hackStepImage' src='".$hacksInstructions['k'][$ni]['stage']."'>";
                                echo "<p class='hackInstructions'>".$hacksInstructions['k'][$ni]['instructions']."</p>";
                            }
                        }

                        echo "<div class='hackTextUnderline'></div>";
                        echo "<h1 class='subtitle'>Here's what it should look like:</h1>";
                        echo "<img class='hackStepImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";

                        echo "<div class='hackTextUnderline'></div>";
                        for ($ui = 0; $ui < count($userProfile['k']); $ui++) {
                            if ($userProfile['k'][$ui]['userid'] == $hacksGeneral['k'][$i]['userid']) {
                                echo "<img class='proPichack' src='".$userProfile['k'][$ui]['propicurl']."'>";
                                echo "<p class='usernameHack'>".$userProfile['k'][$ui]['username']."</p>";
                            }
                        }
                        echo '</div>';
                        echo "</div>";
                    
                    }
                }
            }
        }
            ?>
    </div>
    </div>

    <div class="yourSettingsPage">
        <label> Font size:</label>
        <input class="textSize" type="range" name="textSize" min="6" max="14" onchange="textSize(this.value)"></input>
    </div>
</nav>

<!-- /************************************************************************************

Post a hack

************************************************************************************/ -->

<div class='newHackFrame'>

    <h1 class='createText'>Create</h1>;

    <div class='newHackClose'>
        <h1 class='menuBarProfileText'>Close</h1>;
    </div>

    <h1 class="hackInsTitle">This is where you create a hack.</h1>

    <form enctype="multipart/form-data" id='recipeCreator' action="form.php" method="post">

        <label>What's your hack called?</label>
        <input name="hackTitle" type='text'>
        <label>Briefly describe it for me.</label>
        <textarea name="hackDesc" rows="4" cols="50">
        </textarea>

        <div class="ingredient">        
            <label>What things do you need to make it?</label>
            <p class="ingTitle">Amount:</p>
            <input type="number" name="ingredientsQuantity[]" min="1">
            <p class="ingTitle" class="ingTitle">Resource:</p>
            <input name="hackIngredients[]" type='text'>
            <p class="ingTitle">Alternatives:</p>
            <input name="hackIngredientsAlt[]" type='text'>
        </div>

        <input type="button" onclick="ingredientSelection()" value="Add another resource">
 
        <h1>How do you make it?</h1>

        <div class="stepsMake">  
            <h1>step 1</h1>;
            <input name='userfile[]' type='file'>;
            <label>Step description:</label>;
            <textarea name='hackIns[]' rows='10' cols='30'></textarea>;   
        </div>
        
        <input type="button" onclick="hackStepsMake()" value="Add new step">

        <div class="tips">        
            <label>What are some things you need to look out for while your making this?</label>
            <input name="hackTips[]" type='text'>
        </div>

        <input type="button" onclick="tipAdd()" value="Add another tip">

        <label>What does it look like finished?</label>
        <input name="userfile[]" type="file">

        <h1 class="hackInsTitle">All done?</h1>

        <input type="submit" value="Submit" name="push">

    </form>

</div>


<!-- /************************************************************************************

Content Page

************************************************************************************/ -->

<div id="wrapper">
<?php 
for ($i = 0; $i < count($hacksGeneral['k']); $i++) {
    echo "<div class='hackSelectionFrame' id='".$hacksGeneral['k'][$i]['hackid']."'>";
    echo "<img class='hackHeroImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";
    echo '<div class="infoWrapper"></div>';
    echo '<h1 class="hackTitle">'.$hacksGeneral['k'][$i]['title'].'</h1>';
    echo "<div class='hackUnderline'></div>";
    echo "<p class='hackShortDesc'>".$hacksGeneral['k'][$i]['description']."</p>";
    echo "<div class='hackSelectionButton'>";
    echo "<h1 class='hackButtonText'>Enter</h1>";
    echo "<div class='hackArrow'></div>";
    echo "</div>";
    echo '<div class="close">';
    echo "<h1 class='menuBarProfileText'>Close</h1>";
    echo '</div>';
    echo '<div class="insframe">';

    echo "<h1 class='subtitle'>This is what you'll need:</h1>";
    echo "<div class='hackTextUnderline'></div>";
    for ($in = 0; $in < count($hacksSupplies['k']); $in++) {
        if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
            echo "<p class='hackSupplies'>".$hacksSupplies['k'][$in]['supplyno']." X    ".$hacksSupplies['k'][$in]['item']."</p>";
            echo "<p class='hackSuppliesAlt'>Alternative: ".$hacksSupplies['k'][$in]['altingredient']."</p>";
        }
    }

    echo "<div class='hackTextUnderline'></div>";
    echo "<h1 class='subtitle'>Here are some tips:</h1>";
    echo "<div class='hackTextUnderline'></div>";
    for ($in = 0; $in < count($hackTips['k']); $in++) {
        if ($hacksSupplies['k'][$in]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
            echo "<p class='hackSupplies'>- ".$hackTips['k'][$in]['tip']."</p>";
        }
    }

    for ($ni = 0; $ni < count($hacksInstructions['k']); $ni++) {
        if ($hacksInstructions['k'][$ni]['hackid'] == $hacksGeneral['k'][$i]['hackid']) {
            echo "<div class='hackTextUnderline'></div>";
            echo "<h1 class='stepNumber'>Step ".$hacksInstructions['k'][$ni]['stepnumber']."</h1>";
            echo "<img class='hackStepImage' src='".$hacksInstructions['k'][$ni]['stage']."'>";
            echo "<p class='hackInstructions'>".$hacksInstructions['k'][$ni]['instructions']."</p>";
        }
    }

    echo "<div class='hackTextUnderline'></div>";
    echo "<h1 class='subtitle'>Here's what it should look like:</h1>";
    echo "<img class='hackStepImage' src='".$hacksGeneral['k'][$i]['heroimageurl']."'>";

    echo "<div class='hackTextUnderline'></div>";
    for ($ui = 0; $ui < count($userProfile['k']); $ui++) {
        if ($userProfile['k'][$ui]['userid'] == $hacksGeneral['k'][$i]['userid']) {
            echo "<img class='proPichack' src='".$userProfile['k'][$ui]['propicurl']."'>";
            echo "<p class='usernameHack'>".$userProfile['k'][$ui]['username']."</p>";
        }
    }

    for ($ci = 0; $ci < count($userProfile['k']); $ci++) {
        if ($userProfile['k'][$ci]['userid'] == $_COOKIE["userId"]) {
            echo "<form class='follow' action='form.php' method='post'>";       
            echo "<input type='submit' value='Bookmark' name='follow'>";       
            echo "</form>";
        }
    }

    echo '</div>';
    echo "</div>";
}
?>

</div>
<!-- /************************************************************************************

Instructions

************************************************************************************/ -->

<script src='thesis.js' type='text/javascript' ></script>
</body>
</html>