<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';



$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
}


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


$classificationList = "<select name='classificationId'>";
$classificationList .= "<option value=''>-- Select Car Classification --</option>";
foreach ($classifications as $classification) {
    $name = $classification['classificationName'];
    $id = $classification['classificationId'];
    $classificationList .= "<option value=$id>$name</option>";
}
$classificationList .= '</select>';



//default image path
$defaultImage = '/phpmotors/images/no-image.png';

//This function saves a vehicle to the database
function saveVehicle()
{
    //make $navList, $classificationList and defaultImage accessible inside this function
    global $navList;
    global $classificationList;
    global $defaultImage;

    //get data from the user
    $invMake = filter_input(INPUT_POST, 'invMake');
    $invModel = filter_input(INPUT_POST, 'invModel');
    $invDescription = filter_input(INPUT_POST, 'invDescription');
    $invImage = filter_input(INPUT_POST, 'invImage');
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
    $invPrice = filter_input(INPUT_POST, 'invPrice');
    $invStock = filter_input(INPUT_POST, 'invStock');
    $invColor = filter_input(INPUT_POST, 'invColor');
    $classificationId = filter_input(INPUT_POST, 'classificationId');

    //if no PATH for the image or thumbnail is provided

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

        $message = "<p>Please provide information for all empty form fields.</p>";
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
        $message = "<p>The vehicle was successfully added.</p>";


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
        $message = "<p>Sorry,$invModel was not added. Please try again.</p>";
        include '../view/add-vehicle.php';
        exit;
    }
}


function saveClassification()
{
    //make $navList accessible inside this function
    global $navList;

    $classificationName = filter_input(INPUT_POST, 'classificationName');

    if (empty($classificationName)) {
        $message = "<p>Please provide information for the form field.</p>";
        include "../view/add-classification.php";
        exit;
    }

    $rowsAffected = addClassification($classificationName);
    if ($rowsAffected == 1) {
        header('Location:/phpmotors/vehicles');
        exit;
    } else {
        $message = "<p>Sorry,the classification name was not added. Please try again.</p>";
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