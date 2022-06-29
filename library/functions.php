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
    $rootUrl = "/phpmotors/";
    $navList = "<ul>";
    $navList .= "<li><a href='$rootUrl' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $name = $classification['classificationName'];
        $encodedName = urlencode($name);
        $fullLink = $rootUrl . 'vehicles?action=show-vehicles-by-classification&amp;classificationName=' . "$encodedName";
        $navList .= "<li><a href='$fullLink' title='View our $name product line'>$name</a></li>";
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

//Create a classification select element

function buildClassificationList($classifications)
{

    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}



//Building a display of vehicles

function buildVehiclesDisplay($vehicles)
{
    $dv = "<ul class='items-list'>";
    foreach ($vehicles as $vehicle) {

        //wrapping the <li></li> tag inside an <a></a> tag
        $vehicleId = $vehicle['invId'];
        $fullLink = "/phpmotors/vehicles/?action=vehicle-info&vehicleId=$vehicleId";
        $anchorTag = "<a class='items-list__link' href=$fullLink>";

        $dv .= $anchorTag;

        $dv .= "<li class='items-list__vehicle'>";
        $dv .= "<img class='items-list__img' src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<div class='items-list__text'>";
        $dv .= "<h2 class='items-list-title'>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span class='items-list__price'>$vehicle[invPrice]</span>";
        $dv .= "</div>";
        $dv .= '</li>';

        $dv .= "</a>";
    }
    $dv .= '</ul>';
    return $dv;
}


//build html display of a vehicle

function buildVehicleInfo($vehicle)

{
    $vehicleName = $vehicle['invMake'] . " " . $vehicle['invModel'];
    $vehicleDescription = $vehicle['invDescription'];
    $vehicleImage = $vehicle['invImage'];
    $vehiclePrice = $vehicle['invPrice'];
    $vehicleStock = $vehicle['invStock'];
    $vehicleColor = $vehicle['invColor'];


    $item = " <div class='item'>";

    $itemBlock1 = " <div class='item__block1'>";
    $itemBlock1 .= "<img class='item__img' src='$vehicleImage' alt='image of $vehicleName'><p>Price: $vehiclePrice</p>";
    $itemBlock1 .= '</div>';

    $itemBlock2 = " <div class='item__block2'>";
    $itemBlock2 .= "<h2>Vehicle Details</h2><p>$vehicleDescription</p><p>Color: $vehicleColor</p><p>No. in stock: $vehicleStock</p>";
    $itemBlock2 .= '</div>';

    $item .= $itemBlock1;
    $item .= $itemBlock2;

    $item .= '</div>';

    return $item;
}