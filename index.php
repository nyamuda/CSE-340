<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

//Getting all classifications and use them to make a Nav bar
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

//Checking for action values -- in a POST OR GET REQUEST

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'value':
        # code...
        break;

    default:
        include 'view/home.php';
        break;
}