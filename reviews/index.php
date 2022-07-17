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



//The client screen name
function clientScreenName()
{
    if (isset($_SESSION['loggedin'])) {
        $clientId = $_SESSION['clientData']['clientId'];
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientScreenName = substr($clientFirstname, 0, 1) . substr($clientLastname, 0);

        return $clientScreenName;
    }
}


//ADD A REVIEW TO THE DATABASE
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
    $rowsChanged = insertClientReview($invId, $clientId, $reviewText);

    if ($rowsChanged == 1) {
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

//GET REVIEW INFO BY ID
function getReviewInfo()
{
    $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $review = getReviewById($reviewId);
    return $review;
}


//DELETE A PARTICULAR REVIEW
function deleteClientReview()
{
    $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $rowsChanged = deleteReviewById($reviewId);
    if ($rowsChanged == 1) {
        $error_message = "";
        $success_message = "<p class='success-message'>The review was successfully deleted.</p>";
        $_SESSION['success_message'] = $success_message;
        header('location: /phpmotors/accounts/');
        exit;
    } else {
        $error_message = "<p class='error-message'>Sorry,the review was not deleted. Please try again.</p>";
        include "../view/admi.php";
        exit;
    }
}

//UPDATE A PARTICULAR REVIEW
function updateClientReview()
{
    $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


    if (empty($reviewText)) {
        $error_message = "<p class='error-message'>Please provide information for the form field.</p>";
        include "../view/review-vehicle.php";
        exit;
    }

    //the updateReviewById function is fromthe review-model file
    $rowsChanged = updateReviewById($reviewId, $reviewText);

    if ($rowsChanged == 1) {
        $error_message = "";
        $success_message = "<p class='success-message'>The review was successfully updated.</p>";
        $_SESSION['success_message'] = $success_message;
        header('location: /phpmotors/accounts/');
        exit;
    } else {
        $error_message = "<p class='error-message'>Sorry,the review was not updated. Please try again.</p>";
        include "../view/review-update.php";
        exit;
    }
}



switch ($action) {
    case 'add-review':
        addReview();
        break;

    case 'edit':
        $review = getReviewInfo();
        include '../view/review-update.php';

    case 'Edit':
        updateClientReview();
        break;

    case 'delete':
        $review = getReviewInfo();
        include '../view/review-update.php';
        break;

    case 'Delete':
        deleteClientReview();
        break;

    default:
        break;
}