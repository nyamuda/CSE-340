<?php
//ACCOUNTS CONTROLLER
//Checking for external variable from GET and POST requests

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';


//Dynamic Nav Bar
//the navBar() function returns the dynamic nav bar
$dynamicNavBar = navBar();



$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if ($action == null) {
    $action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}

//The function below filters input register data
//stores the data into variables
//checks if the data is as expected

function addClient()
{
    //make navBar accessible inside this function
    global $dynamicNavBar;

    //Sanitize Input
    $clientFirstName = trim(filter_input(INPUT_POST, 'clientFirstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastName = trim(filter_input(INPUT_POST, 'clientLastName'), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


    //Validate Input
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);




    //Check if the rest of the rest of the data is as expected.
    if (empty($clientFirstName) || empty($clientLastName) || empty($checkPassword) || empty($clientEmail)) {
        $error_message = "<p class='error-message'>Please provide information for all empty form fields.</p>";
        $success_message = "";
        include '../view/register.php';
        exit;
    }

    $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

    //add client to the database
    $regOutcome = regClient($clientFirstName, $clientLastName, $clientEmail, $hashedPassword);

    //if the client is added successfully
    // we take the user to the login page
    if ($regOutcome == 1) {
        $error_message = "";
        $success_message = "<p class='success-message'>Thanks for registering $clientFirstName. Please use your email and password to login.</p>";
        include '../view/login.php';
        exit;
    }
    //if its a failure
    else {
        $error_message = "<p class='error-message'>Sorry $clientFirstName, but the registration failed. Please try again.</p>";
        include '../view/register.php';
        exit;
    }
}


switch ($action) {
    case 'account':
        include '../view/login.php';
        break;
    case 'sign_up':
        include '../view/register.php';
        break;
    case 'register':
        addClient();
        break;

    default:
        # code...
        break;
}