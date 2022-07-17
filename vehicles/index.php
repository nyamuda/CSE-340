<?php
// Create or access a Session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/uploads-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';



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
        } elseif (isset($invInfo['classificationId'])) {

            if ($selectedId = $id) {
                $classificationList .= "<option selected value=$id>$name</option>";
            }
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

function getInvItems()
{
    //get the classification id
    //sanitize the data
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //get inventory items by Id from the database
    $inventoryArray = getInvItemsByClassificationId($classificationId);

    echo json_encode($inventoryArray);
}

function getInventoryToUpdate()
{
    //get the inventory id
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //fetch the inventory the database using the Id
    $invInfo = getInvItemInfo($invId);


    //to make the select tag sticky lets get the classification Id of the fetched inventory
    if (isset($invInfo["classificationId"])) {
        $classificationId = $invInfo["classificationId"];
    }


    if (count($invInfo) < 1) {
        $message = 'Sorry, no vehicle information could be found.';
    }

    include '../view/vehicle-update.php';
    exit;
}


function getInventoryToDelete()
{
    //get the inventory id
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    //fetch the inventory the database using the Id
    $invInfo = getInvItemInfo($invId);




    if (count($invInfo) < 1) {
        $error_message = 'Sorry, no vehicle information could be found.';
    }

    include '../view/vehicle-delete.php';
    exit;
}



//UPDATE VEHICLE INFO
function changeVehicleInfo()
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

    //get the id of the vehicle being updated
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);



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

    //finally update the car
    //using the updateVehicle function from the vehicles-model
    $updateResult = updateVehicle(
        $invId,
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

    //if the car was updated successfully
    if ($updateResult == 1) {
        //no error message
        // $error_message = "";
        $success_message = "<p class='success-message'>The vehicle was successfully updated.</p>";


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

        //save success message to the session

        $_SESSION['success_message'] = "<p class='success-message'>The vehicle was successfully updated.</p>";


        header('location: /phpmotors/vehicles/');

        exit;
    }
    //if the car was not added successfully
    else {
        $error_message = "<p class='error-message'>Sorry, $invModel was not updated. Please try again.</p>";

        include '../view/vehicle-update.php';
        exit;
    }
}





//DELETE VEHICLE 
function removeVehicleInfo()
{

    //get data from the user
    //AND Sanitize the data
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    //get the id of the vehicle being updated
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);



    //finally delete the car
    //using the deleteVehicle function from the vehicles-model
    $deleteResult = deleteVehicle($invId);

    //if the car was added successfully
    if ($deleteResult == 1) {
        //no error message
        // $error_message = "";
        $success_message = "<p class='success-message'>The vehicle was successfully deleted</p>";


        //save success message to the session

        $_SESSION['success_message'] = $success_message;


        header('location: /phpmotors/vehicles/');

        exit;
    }
    //if the car was not deleted successfully
    else {
        $error_message = "<p class='error-message'>Error: $invMake $invModel was not
        deleted.</p>";

        $_SESSION['error_message'] = $error_message;
        header('location: /phpmotors/vehicles/');
        exit;
    }
}


//show vehicles based on their classification
function showCarsByClassification()
{

    //make navBar accessible inside this function
    global $dynamicNavBar;

    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //get vehicles by the classification from the database
    //getVehiclesByClassification() function is in the vehicles model
    $vehicles = getVehiclesByClassification($classificationName);
    if (!count($vehicles)) {
        $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
    } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    include '../view/classification.php';
}


//display vehicle information based on id

function showVehicleInfo()
{
    //make navBar accessible inside this function
    global $dynamicNavBar;

    $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //getting the vehicle
    $vehicle = getVehicleById($vehicleId);

    //getting all the thumbnails for the vehicle
    $thumbnails = getThumbnailsByVehicleId($vehicleId);


    //build the thumbnails

    $builtThumbnails = buildVehicleThumbnails($thumbnails);

    $vehicleName = $vehicle['invMake'] . " " . $vehicle['invModel'];

    if (count($vehicle) < 1) {
        $message = "Sorry,vehicle information not found.";
    } else {
        $vehicleInfo = buildVehicleInfo($vehicle);
    }


    include '../view/vehicle-detail.php';
}



//FETCH ALL REVIEWS FOR A PARTICULAR VEHICLE
//AND SHOW THE REVIEWS
function showAllVehicleReviews()
{
    $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $reviews = getAllVehicleReviews($invId);

    if (count($reviews) >= 1) {

        //building the HTML to show all the reviews
        //the  buildAllVehicleReviews function is in the functions module
        return buildAllVehicleReviews($reviews);
    } else {
        return "<p>Be the first to write a review.</p>";
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

    case 'getInventoryItems':
        getInvItems();
        break;

    case 'mod':
        getInventoryToUpdate();
        break;

    case 'update-vehicle':
        changeVehicleInfo();
        break;

    case 'del':
        getInventoryToDelete();
        break;

    case 'delete-vehicle':
        removeVehicleInfo();
        break;

    case 'show-vehicles-by-classification':
        showCarsByClassification();
        break;

    case 'vehicle-info':
        showVehicleInfo();
        break;


    default:
        $classifications = getClassifications();
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-management.php';
        break;
}