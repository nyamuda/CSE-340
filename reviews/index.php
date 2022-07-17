<?php

// Create or access a Session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';


//Dynamic Nav Bar
//the navBar() function returns the dynamic nav bar
$dynamicNavBar = navBar();



$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

if ($action == null) {
    $action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}

function addReview()
{
    $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $screenName = trim(filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if (empty($reviewText)) {
        $error_message = "<p class='error-message'>Please provide information for the form field.</p>";
        include "../view/vehicle-detail.php";
        exit;
    }

    //
    $rowsReturned = insertClientReview($invId, $clientId, $reviewText);

    if ($rowsReturned == 1) {
        if ($rowsReturned == 1) {
            $error_message = "";
            $success_message = "<p class='success-message'>The review was successfully added.</p>";
            $_SESSION['success_message'] = $success_message;
            include "../view/vehicle-detail.php";
            exit;
        } else {
            $error_message = "<p class='error-message'>Sorry,the review was not added. Please try again.</p>";
            include "../view/vehicle-detail.php";
            exit;
        }
    }
}






switch ($action) {
    case 'add-review':
        addReview();
        break;

    default:
        break;
}