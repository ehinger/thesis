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

    // foreach ($_FILES['userfile'] as $k => $v) {

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

    //Check file size
    // if ($target_file > 5000000000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    
    //Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
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
        $heroImageURL = htmlspecialchars($s3->getObjectUrl("thesis-tom-creagh", $_FILES['userfile']['name'][0])); 
        $userID = pg_escape_string($_COOKIE["userId"]);

        $db->exec("INSERT INTO hacksGeneral (hackId, heroImageURL, title, type, description, userID) VALUES ('" . $string . $identification . "', '" . $heroImageURL . "', '" . $title . "', '" . $type . "', '" . $description . "', '" . $userID . "')");

        foreach ($_POST['hackTags'] as $k => $v) {

            $tags = $_POST['hackTags'][$k];

            $db->exec("INSERT INTO hacksTags (hackId, tags) VALUES ('" . $string . $identification . "', '" . $tags . "')");
        }

        foreach ($_POST['ingredientsQuantity'] as $k => $v) {

            $ingredientsQuantity = $_POST['ingredientsQuantity'][$k];
            $hackIngredients = $_POST['hackIngredients'][$k];

            $db->exec("INSERT INTO hacksSupplies (hackID, supplyNo, item) VALUES ('" . $string . $identification . "', '" . $ingredientsQuantity . "', '" . $hackIngredients . "')");
        }

        $stepNo = 0;

        foreach ($_POST['hackIns'] as $k => $v) {

            $stepNo++;
            $stepImageURL = htmlspecialchars($s3->getObjectUrl("thesis-tom-creagh", $_FILES['userfile']['name'][$stepNo])); 
            $hackDesc = $_POST['hackIns'][$k];

            $db->exec("INSERT INTO hackInstructions (hackID, stage, stepNumber, instructions) VALUES ('" . $string . $identification . "', '" . $stepImageURL . "', '" . $stepNo . "', '" . $hackDesc . "')");
        }

        $stepNoU = 0;

        foreach ($_POST['hackUse'] as $k => $v) {

            $stepNo++;
            $stepNoU++;
            $stepImageURLU = htmlspecialchars($s3->getObjectUrl("thesis-tom-creagh", $_FILES['userfile']['name'][$stepNoU])); 
            $hackDescU = $_POST['hackUse'][$k];

            $db->exec("INSERT INTO hackUse (hackID, stage, stepNumber, instructions) VALUES ('" . $string . $identification . "', '" . $stepImageURLU . "', '" . $stepNoU; . "', '" . $hackDescU . "')");
        }

        // for ($i = 1; $i < count($_FILES['userfile']['name']); $i++) { 

            
        //     $db->exec("INSERT INTO hackImages (hackID, stepNumber, instructions) VALUES ('" . $string . $identification . "', '" . $hackDesc . "', '" . $stepNo . "', '" . $hackDesc . "')");

        // }


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

header('Location: index.php');