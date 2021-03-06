<?php
// ----------------------------------------------------------------------------------------------------
// - Display Errors
// ----------------------------------------------------------------------------------------------------
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

// ----------------------------------------------------------------------------------------------------
// - Error Reporting
// ----------------------------------------------------------------------------------------------------
error_reporting(-1);

// ----------------------------------------------------------------------------------------------------
// - Shutdown Handler
// ----------------------------------------------------------------------------------------------------
function ShutdownHandler()
{
    if(@is_array($error = @error_get_last()))
    {
        return(@call_user_func_array('ErrorHandler', $error));
    };

    return(TRUE);
};

register_shutdown_function('ShutdownHandler');

// ----------------------------------------------------------------------------------------------------
// - Error Handler
// ----------------------------------------------------------------------------------------------------
function ErrorHandler($type, $message, $file, $line)
{
    $_ERRORS = Array(
        0x0001 => 'E_ERROR',
        0x0002 => 'E_WARNING',
        0x0004 => 'E_PARSE',
        0x0008 => 'E_NOTICE',
        0x0010 => 'E_CORE_ERROR',
        0x0020 => 'E_CORE_WARNING',
        0x0040 => 'E_COMPILE_ERROR',
        0x0080 => 'E_COMPILE_WARNING',
        0x0100 => 'E_USER_ERROR',
        0x0200 => 'E_USER_WARNING',
        0x0400 => 'E_USER_NOTICE',
        0x0800 => 'E_STRICT',
        0x1000 => 'E_RECOVERABLE_ERROR',
        0x2000 => 'E_DEPRECATED',
        0x4000 => 'E_USER_DEPRECATED'
    );

    if(!@is_string($name = @array_search($type, @array_flip($_ERRORS))))
    {
        $name = 'E_UNKNOWN';
    };

    return(print(@sprintf("%s Error in file \xBB%s\xAB at line %d: %s\n", $name, @basename($file), $line, $message)));
};

$old_error_handler = set_error_handler("ErrorHandler");


require_once "dbconn.php";

if (isset($_POST['push'])){

    for ($i = 0; $i < count($_FILES['userfile']['name']); $i++) {

    $check = getimagesize($_FILES["userfile"]["tmp_name"][$i]);
    $target_file = basename($_FILES["userfile"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    //Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check file size
    // if ($target_file > 5000000000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            die();
        } else {
            try {
                $upload = $s3->upload($bucket, $_FILES['userfile']['name'][$i], fopen($_FILES['userfile']['tmp_name'][$i], 'rb'), 'public-read');
            } catch(Exception $e) { 
                echo $e->getMessage();
                die();
            } 
        }
    }

    try {
        $db->beginTransaction();

        $identification = '';
        for ($i = 0; $i<7; $i++) 
        {
            $identification .= mt_rand(0,9);
        }
        $title = pg_escape_string($_POST['hackTitle']); 
        $string = preg_replace('/\s+/', '', $title);
        $type = pg_escape_string($_POST['hackType']); 
        $description = pg_escape_string($_POST['hackDesc']); 
        $lastEl = array_pop((array_slice($_FILES['userfile']['name'], -1)));
        $heroImageURL = htmlspecialchars($s3->getObjectUrl("thesis-tom-creagh", $lastEl)); 
        $userID = pg_escape_string($_COOKIE["userId"]);

        $db->exec("INSERT INTO hacksGeneral (hackId, heroImageURL, title, type, description, userID) VALUES ('" . $string . $identification . "', '" . $heroImageURL . "', '" . $title . "', 'm', '" . $description . "', '" . $userID . "')");

        foreach ($_POST['ingredientsQuantity'] as $k => $v) {

            $ingredientsQuantity = $_POST['ingredientsQuantity'][$k];
            $hackIngredients = $_POST['hackIngredients'][$k];
            $hackIngredientsAlt = $_POST['hackIngredientsAlt'][$k];

            $db->exec("INSERT INTO hacksSupplies (hackID, supplyNo, item, altIngredient) VALUES ('" . $string . $identification . "', '" . $ingredientsQuantity . "', '" . $hackIngredients . "', '" . $hackIngredientsAlt . "')");
        }

        foreach ($_POST['hackTips'] as $k => $v) {

            $hackTips = $_POST['hackTips'][$k];

            $db->exec("INSERT INTO hackTips (hackID, tip) VALUES ('" . $string . $identification . "', '" . $hackTips . "')");
        }

        $stepNo = 0;

        foreach ($_POST['hackIns'] as $k => $v) {

            $stepImageURL = htmlspecialchars($s3->getObjectUrl("thesis-tom-creagh", $_FILES['userfile']['name'][$stepNo]));
            $stepNo++; 
            $hackDesc = $_POST['hackIns'][$k];

            $db->exec("INSERT INTO hackInstructions (hackID, stage, stepNumber, instructions) VALUES ('" . $string . $identification . "', '" . $stepImageURL . "', '" . $stepNo . "', '" . $hackDesc . "')");
        }

        $db->commit();
    }
    catch(PDOException $e)
    {
        $db->rollback();
        echo $e->getMessage();
        die();
    }
} 

if (isset($_POST['follow'])) {

    $followId = pg_escape_string($_COOKIE["followId"]);
    $userID = pg_escape_string($_COOKIE["userId"]);

    try {
        $db->exec("INSERT INTO userFollowing (userID, following) VALUES ('" . $userID . "', '" . $followId . "')");  
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
}

if (isset($_POST['del'])) {

    $hackId = pg_escape_string($_COOKIE["followId"]);
    $userID = pg_escape_string($_COOKIE["userId"]);

    try {

        $db->beginTransaction();

            $db->exec("DELETE FROM hacksGeneral WHERE hackId='" . $hackId . "'");

            $db->exec("DELETE FROM hacksSupplies WHERE hackID='" . $hackId . "'");

            $db->exec("DELETE FROM hackTips WHERE hackID='" . $hackId . "'");

            $db->exec("DELETE FROM hackInstructions WHERE hackID='" . $hackId . "'");

            $db->exec("DELETE FROM userFollowing WHERE following='" . $hackId . "'");

        $db->commit();

    } catch (Exception $e) {
        $db->rollback();
        echo $e->getMessage();
        die();
    }
}

header('Location: index.php');