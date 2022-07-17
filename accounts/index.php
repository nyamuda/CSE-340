<?php
//ACCOUNTS CONTROLLER

// Create or access a Session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';



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

    //if its not a valid email
    if (!$clientEmail) {
        $error_message = "<p class='error-message'>Please enter a valid email address</p>";
        include '../view/login.php';
        exit;
    }


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
    $clientData = getClientByEmail($clientEmail);


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

    //get the the first name of the client if they are logged in
    //the function in the the 'functions' module
    $sessionFirstName = getSessionClientName();

    // Send them to the admin view
    include '../view/admin.php';
    exit;
}


function logoutClient()
{
    unset($_SESSION['clientData']);

    session_destroy();

    header('Location: /phpmotors/');
}




//UPDATE ACCOUNT INFO
function changeAccountInfo()
{
    //make navBar accessible inside this function
    global $dynamicNavBar;

    //Sanitize Input
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname'), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    //get the id of the client being updated
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);


    //Validate email
    $clientEmail = checkEmail($clientEmail);


    if (!$clientEmail) {
        $error_message = "<p class='error-message'>Please enter a valid email address</p>";
        include '../view/client-update.php';
        exit;
    }

    //check to see if the new email is different from the one in the session
    //and if its different, we check to see if there isn't any client who already 
    //has that email
    if ($_SESSION['clientData']['clientEmail'] != $clientEmail) {


        //checking if the email already exists

        $existEmail = checkEmailExist($clientEmail);

        if ($existEmail) {

            $error_message = "<p class='error-message'>That email address already exists.</p>";

            include '../view/client-update.php';
            exit;
        }
    }



    //Check if the rest of the rest of the data is as expected.
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
        $error_message = "<p class='error-message'>Please provide information for all empty form fields.</p>";
        include '../view/client-update.php';
        exit;
    }

    //finally update the client
    //using the updateClient function from the accounts-model
    $updateResult = updateClient(
        $clientId,
        $clientFirstname,
        $clientLastname,
        $clientEmail
    );

    //if the client was updated successfully
    if ($updateResult == 1) {

        //we update clientData in the session since the client data has be updated;
        //so lets get the client's updated infomation from the database
        //we use the getClientById function from the model 
        $clientData = getClientById($clientId);


        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        $success_message = "<p class='success-message'>The client was successfully updated.</p>";


        //save success message to the session

        $_SESSION['success_message'] = $success_message;


        header('location: /phpmotors/accounts/');

        exit;
    }
    //if the password was not added successfully
    else {
        $error_message = "<p class='error-message'>Sorry, account was not updated. Please try again.</p>";

        include '../view/client-update.php';
        exit;
    }
}


function changeAccountPassword()
{
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    //get the id of the client being updated
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    //validate the password
    $checkPassword = checkPassword($clientPassword);

    if (empty($checkPassword)) {
        $password_error_message = "<p class='error-message'>Please provide a valid password.</p>";
        include '../view/client-update.php';
        exit;
    }

    $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

    //store the new password to the database
    //updateClientPassword is in the accounts-model
    $updateResult = updateClientPassword($clientId, $hashedPassword);

    //if the password was updated successfully
    if ($updateResult == 1) {


        $success_message = "<p class='success-message'>The password was successfully updated.</p>";

        //save success message to the session

        $_SESSION['success_message'] = $success_message;


        header('location: /phpmotors/accounts/');

        exit;
    }
    //if the password was not added successfully
    else {
        $error_message = "<p class='error-message'>Sorry, the password was not updated. Please try again.</p>";

        include '../view/client-update.php';
        exit;
    }
}


//FETCH ALL REVIEWS FOR A PARTICULAR CLIENT
//AND SHOW THE REVIEWS
function showAllClientReviews()
{
    $clientId = $_SESSION['clientData']['clientId'];

    // getAllClientReviews function is inside th reviews-model file
    $reviews = getAllClientReviews($clientId);



    if (count($reviews) >= 1) {

        //building the HTML to show all the reviews
        //the  buildAllClientReviews function is in the functions module
        return buildAllClientReviews($reviews);
    } else {
        return "<p>You haven't reviewed any vehicles yet.</p>";
    }
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
        break;

    case 'register':
        addClient();
        break;

    case 'logout':
        logoutClient();
        break;

    case 'mod':
        include '../view/client-update.php';
        break;

    case 'update-account':
        changeAccountInfo();
        break;

    case 'change-password':
        changeAccountPassword();
        break;
    default:
        include '../view/admin.php';
        break;
}