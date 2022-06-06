<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';


//Dynamic Nav Bar
//the navBar() function returns the dynamic nav bar
$dynamicNavBar = navBar();

//Checking for action values -- in a POST OR GET REQUEST

$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if ($action == null) {
    $action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}

switch ($action) {
    case 'value':
        # code...
        break;

    default:
        include 'view/home.php';
        break;
}