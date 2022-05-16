<?php
//ACCOUNTS CONTROLLER
//Checking for external variable from GET and POST requests

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';


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



$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {
    case 'account':
        include '../view/login.php';
        break;
    case 'sign_up':
        include '../view/register.php';
        break;

    default:
        # code...
        break;
}