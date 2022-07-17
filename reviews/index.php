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
    global $dynamicNavBar;

    $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $screenName = trim(filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if (empty($reviewText)) {
        $message = "<p class='error-message'>Please provide information for the form field.</p>";
        $_SESSION['message'] = $message;
        header("location: /phpmotors/vehicles/index.php?action=vehicle-info&vehicleId=$invId");
        exit;
    }

    //
    $rowsChanged = insertClientReview($invId, $clientId, $reviewText);

    if ($rowsChanged == 1) {

        $message = "<p class='success-message'>Thank you for leaving a comment. The review was added successfully.</p>";
        $_SESSION['message'] = $message;
        header("location: /phpmotors/vehicles/index.php?action=vehicle-info&vehicleId=$invId");
        exit;
    } else {
        $message = "<p class='error-message'>Sorry,the review was not added. Please try again.</p>";
        $_SESSION['message'] = $message;
        header("location: /phpmotors/vehicles/index.php?action=vehicle-info&vehicleId=$invId");
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
    $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


    //the deleteReviewById function is inside the reviews-model file
    $rowsChanged = deleteReviewById($reviewId);
    if ($rowsChanged == 1) {
        $message = "<p class='success-message'>The review was successfully deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/accounts/');
        exit;
    } else {
        $message = "<p class='error-message'>Sorry, the review was not deleted. Please try again.</p>";
        $_SESSION['message'] = $message;
        header("location: /phpmotors/reviews/index.php?action=show-delete&reviewId=$reviewId");
        exit;
    }
}

//UPDATE A PARTICULAR REVIEW
function updateClientReview()
{
    $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));



    if (empty($reviewText)) {
        $message = "<p class='error-message'>Please provide information for the form field.</p>";
        $_SESSION['message'] = $message;
        header("location: /phpmotors/reviews/index.php?action=show-edit&reviewId=$reviewId");
        exit;
    }

    //the updateReviewById function is fromthe review-model file
    $rowsChanged = updateReviewById($reviewId, $reviewText);

    if ($rowsChanged == 1) {
        $message = "<p class='success-message'>The review was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/accounts/');
        exit;
    } else {
        $message = "<p class='error-message'>Sorry, the review was not updated. Please try again.</p>";
        $_SESSION['message'] = $message;
        header("location: /phpmotors/reviews/index.php?action=show-edit&reviewId=$reviewId");
        exit;
    }
}



switch ($action) {
    case 'add-review':
        addReview();
        break;

    case 'show-edit':
        $review = getReviewInfo();
        include '../view/review-update.php';
        break;

    case 'edit':
        updateClientReview();
        break;

    case 'show-delete':
        $review = getReviewInfo();
        include '../view/review-delete.php';
        break;

    case 'delete':
        deleteClientReview();
        break;

    default:
        break;
}