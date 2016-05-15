<?php
ini_set('display_errors', 'On');

require_once "dbconn.php";

if (isset($_POST['push'])){
    try {
        $q1 = pg_escape_string($_POST['q1']);
        $q2 = pg_escape_string($_POST['q2']);
        $q3 = pg_escape_string($_POST['q3']);
        $q4 = pg_escape_string($_POST['q4']);
        $q5 = pg_escape_string($_POST['q5']);
        $q6 = pg_escape_string($_POST['q6']);    
        $q7 = pg_escape_string($_POST['q7']);
        $q8 = pg_escape_string($_POST['q8']);
        $q9 = pg_escape_string($_POST['q9']);
        $userID = pg_escape_string($_COOKIE["userId"]);

        $db->beginTransaction();

        if ($_COOKIE["abilityUOrL"] == "upper") {
            
            $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'upperSet1', '" . $q1 . "', '" . $q2 . "', '" . $q3 . "')");

            if ($_COOKIE["abilityFocusPost"] == "lvl2Upper") {
                
                $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'upperSet2', '" . $q4 . "', '" . $q5 . "', '" . $q6 . "')");

            } else if ($_COOKIE["abilityFocusPost"] == "lvl3Upper") {
                
                $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'upperSet2', '" . $q4 . "', '" . $q5 . "', '" . $q6 . "')");

                $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'upperSet3', '" . $q7 . "', '" . $q8 . "', '" . $q9 . "')");

            }

        }

        if ($_COOKIE["abilityUOrL"] == "lower") {
            
            $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'lowerSet1', '" . $q1 . "', '" . $q2 . "', '" . $q3 . "')");

            if ($_COOKIE["abilityFocusPost"] == "lvl2Upper") {
                
                $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'lowerSet2', '" . $q4 . "', '" . $q5 . "', '" . $q6 . "')");

            } else if ($_COOKIE["abilityFocusPost"] == "lvl3Upper") {
                
                $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'lowerSet2', '" . $q4 . "', '" . $q5 . "', '" . $q6 . "')");

                $db->exec("INSERT INTO userAnswersOne (userID, qSetId, ansOne, ansTwo, ansThree) VALUES ('" . $userID . "', 'lowerSet3', '" . $q7 . "', '" . $q8 . "', '" . $q9 . "')");

            }

        }

        $db->commit();

    } catch (Exception $e) {
        $db->rollback();
        echo $e->getMessage();
        die();
    }
}

header('Location: index.php');