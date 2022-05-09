<?php
$server = 'mysql';
$username = 'dbuser';
$password = 'dbpass';
$dbname = "phpmotors";
try {
    $dbh = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
} catch (PDOException $er) {

    header("Location:/phpmotors/view/500.php");
}