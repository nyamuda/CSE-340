<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
//ACCOUNTS MODEL


//Function that registers clients

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
    $object = phpmotorsConnect();
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    $stmt = $object->prepare($sql);
    $stmt->bindParam(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindParam(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindParam(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindParam(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->execute();
    $rollsChanged = $stmt->rowCount();
    $stmt = null;
    return $rollsChanged;
}