<?php
//ACCOUNTS CONTROLLER

// Create or access a Session
session_start();

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


    //checking if the email already exists

    $existEmail = checkEmailExist($clientEmail);

    if ($existEmail) {
        //removing the success registration session variable
        unset($_SESSION["success_message"]);

        $error_message = "<p class='error-message'>That email address already exists. Do you want to login instead?</p>";

        include '../view/login.php';
        exit;
    }


    //Check if the rest of the rest of the data is as expected.
    if (empty($clientFirstName) || empty($clientLastName) || empty($checkPassword) || empty($clientEmail)) {
        $error_message = "<p class='error-message'>Please provide information for all empty form fields.</p>";
        //removing the success registration session variable
        unset($_SESSION["success_message"]);
        include '../view/register.php';
        exit;
    }

    $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

    //add client to the database
    $regOutcome = regClient($clientFirstName, $clientLastName, $clientEmail, $hashedPassword);

    //if the client is added successfully
    // we take the user to the login page
    if ($regOutcome == 1) {
        setcookie('firstName', $clientFirstName, time() + 604800 * 52, '/');
        $error_message = "";
        $_SESSION['success_message'] = "<p class='success-message'>Thanks for registering $clientFirstName. Please use your email and password to login.</p>";
        header('Location: /phpmotors/accounts/?action=account');
        exit;
    }
    //if its a failure
    else {
        $error_message = "<p class='error-message'>Sorry $clientFirstName, but the registration failed. Please try again.</p>";
        include '../view/register.php';
        exit;
    }
}

function loginClient()
{
    //make navBar accessible inside this function
    global $dynamicNavBar;
    //removing the success registration session variable
    unset($_SESSION["success_message"]);


    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $passwordCheck = checkPassword($clientPassword);


    // Run basic checks, return if errors
    if (empty($clientEmail) || empty($passwordCheck)) {
        $error_message = '<p class="error-message">Please provide a valid email address and password.</p>';

        include '../view/login.php';
        exit;
    }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);


    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($passwordCheck, $clientData['clientPassword']);

    // If the hashes don't match create an error
    // and return to the login view
    if (!$hashCheck) {
        $error_message = '<p class="error-message">Please check your password and try again.</p>';

        include '../view/login.php';
        exit;
    }

    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;

    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;
}


switch ($action) {
    case 'account':
        include '../view/login.php';
        break;
    case 'sign_up':
        include '../view/register.php';
        break;
    case 'login':
        loginClient();

    case 'register':
        addClient();
        break;

    default:
        include '../view/admin.php';
        break;
}