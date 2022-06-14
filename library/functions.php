<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
//Validating the email
function checkEmail($clientEmail)
{
    $email = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $email;
}

//Validating the password
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}


//creating a dynamic nav bar
function navBar()
{
    $classifications = getClassifications();
    $rootUrl = "/phpmotors/index.html";
    $navList = "<ul>";
    $navList .= "<li><a href='$rootUrl' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $name = $classification['classificationName'];
        $encodedName = urlencode($name);
        $navList .= "<li><a href='$rootUrl?action=$encodedName' title= 'View our $name product line'>$name</a></li>";
    }
    $navList .= "</ul>";

    return $navList;
}


//Validation the classification name
function checkClassification($classificationName)
{
    //length of the name must be greater than 1 and less than/equal to 30 
    $length = strlen($classificationName);
    if ($length > 0 && $length <= 30) {
        return $classificationName;
    } else {
        return false;
    }
}

//Getting the first name of the client if their logged in
function getSessionClientName()
{
    if (isset($_SESSION['clientData']['clientFirstname'])) {
        $sessionFirstName = $_SESSION['clientData']['clientFirstname'];
        //sanitize the data
        $sessionFirstName = filter_var($sessionFirstName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //return the name
        return $sessionFirstName;
    }
}


//check to see if the user is authorize to see the page
function checkAuthorization()
{
    //1st we check to see if the user data has be saved to the session
    //if its not saved, then we don't know this user
    //so we take them to the home page
    if (!isset($_SESSION['clientData']['clientLevel'])) {
        header('Location: /phpmotors/');
        exit;
    }

    //lets get the client level of the user
    $clientLevel = $_SESSION['clientData']['clientLevel'];


    //lastly, let's check if the user is not logged in 
    //or if they have a client level equal to 1
    if (!isset($_SESSION['loggedin']) || $clientLevel == 1) {
        header('Location: /phpmotors/');
        exit;
    }
}