<?php

function phpmotorsConnect()
{
    $server = 'mysql';
    $username = 'dbuser';
    $password = 'dbpass';
    $dbname = "phpmotors";

    try {
        $dbh = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
        return $dbh;
    } catch (PDOException $er) {

        header("Location:/phpmotors/view/500.php");
    }
}