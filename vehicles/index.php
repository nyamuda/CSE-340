<?php
// Create or access a Session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';


//Dynamic Nav Bar
//the navBar() function returns the dynamic nav bar
$dynamicNavBar = navBar();




$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if ($action == null) {
    $action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}



//Creating a dynamic select tag
function createSelectTag($selectedId = "")
{
    //getting all classifications from the database
    $classifications = getClassifications();
    $classificationList = "<select name='classificationId'>";
    //default option
    $classificationList .= "<option value=''>-- Select Car Classification --</option>";
    foreach ($classifications as $classification) {
        $name = $classification['classificationName'];
        $id = $classification['classificationId'];
        //if a user has already selected a value (an id)
        //we want that selected option to be sticky
        if ($selectedId == $id) {
            //so we add a 'selected' attribute to the option with that id
            $classificationList .= "<option selected value=$id>$name</option>";
        } else {
            $classificationList .= "<option value=$id>$name</option>";
        }
    }
    return $classificationList .= '</select>';
}


//default image path
$defaultImage = '/phpmotors/images/no-image.png';

//This function saves a vehicle to the database
function saveVehicle()
{
    //make $navBar, $classificationList and defaultImage accessible inside this function
    global $dynamicNavBar;
    global $classificationList;
    global $defaultImage;

    //get data from the user
    //AND Sanitize the data
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_NUMBER_FLOAT));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));



    //if there are any empty fields
    if (
        empty($invMake) ||
        empty($invModel) ||
        empty($invDescription) ||
        empty($invImage) ||
        empty($invThumbnail) ||
        empty($invPrice) ||
        empty($invStock) ||
        empty($invColor) ||
        empty($classificationId)
    ) {

        $error_message = "<p class='error-message'>Please provide information for all empty form fields.</p>";
        include '../view/add-vehicle.php';
        exit;
    }

    //finally save the car to the database
    //using the addVehicle function from the vehicles-model
    $rowsAffected = addVehicle(
        $invMake,
        $invModel,
        $invDescription,
        $invImage,
        $invThumbnail,
        $invPrice,
        $invStock,
        $invColor,
        $classificationId
    );

    //if the car was added successfully
    if ($rowsAffected == 1) {
        //no error message
        $error_message = "";
        $success_message = "<p class='success-message'>The vehicle was successfully added.</p>";


        //clearing all input fields
        $invMake = "";
        $invModel = "";
        $invDescription = "";
        $invImage = "";
        $invThumbnail = "";
        $invPrice = "";
        $invStock = "";
        $invColor = "";
        $classificationId = "";


        include '../view/add-vehicle.php';

        exit;
    }
    //if the car was not added successfully
    else {
        $error_message = "<p class='error-message'>Sorry,$invModel was not added. Please try again.</p>";
        $success_message = "";
        include '../view/add-vehicle.php';
        exit;
    }
}


function saveClassification()
{
    //make $navBar accessible inside this function
    global $dynamicNavBar;

    //sanitize the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    //validate the data
    //Using the checkClassification() function from the "functions" module
    $classificationName = checkClassification($classificationName);

    if (empty($classificationName)) {
        $error_message = "<p class='error-message'>Please provide information for the form field.</p>";
        include "../view/add-classification.php";
        exit;
    }



    $rowsAffected = addClassification($classificationName);
    if ($rowsAffected == 1) {
        $error_message = "";
        header('Location:/phpmotors/vehicles');
        exit;
    } else {
        $error_message = "<p class='error-message'>Sorry,the classification name was not added. Please try again.</p>";
        include '../view/add-vehicle.php';
        exit;
    }
}




switch ($action) {
    case 'classification':
        include '../view/add-classification.php';
        break;

    case 'vehicle':
        include '../view/add-vehicle.php';
        break;

    case 'add-classification':
        saveClassification();
        break;

    case 'add-vehicle':
        saveVehicle();
        break;

    default:
        include '../view/vehicle-management.php';
        break;
}