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


/* * ********************************
*  Functions for working with images
* ********************************* */


// Adds "-tn" designation to file name
function makeThumbnailName($image)
{
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray)
{
    $id = '<ul class="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img class='items-list__img' src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}


// Build the vehicles select list
function buildVehiclesSelect($vehicles)
{
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}


// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}



// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the swith

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function


//building all the thumbnails for a vehicle
function buildVehicleThumbnails($thumbnails)
{
    $container = "<div>";
    $block = "<div id='thumbnail-block'>";
    $title = "<h3 id='thumbnail-mobile-title'>Vehicle Thumbnails</h3>";
    $container .= $title;

    foreach ($thumbnails as $thumbnail) {
        $url = $thumbnail['invThumbnail'];
        $text = "thumbnail image for " . $thumbnail['invMake'] . ' ' . $thumbnail['invModel'];
        $img = "<img src=$url alt='$text'>";

        $block .= $img;
    }

    $block .= "</div>";

    $container .= $block;

    $container .= "</div>";


    return $container;
}