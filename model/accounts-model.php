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


//checking for an existing email address
function checkEmailExist($email)
{
    $sql = "SELECT * FROM clients WHERE clientEmail= :email";

    //prapare
    $object = phpmotorsConnect();
    $stmt = $object->prepare($sql);

    //bind
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    //execute
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt = null;
    if (empty($result)) {
        return 0;
    }
    return 1;
}


// Get client data based on an email address
function getClientByEmail($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $clientData;
}


function updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail)
{
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
	WHERE clientId = :clientId';


    //PREPARE
    $conn = phpmotorsConnect();
    $stmt = $conn->prepare($sql);

    //BIND THE DATA
    $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindParam(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindParam(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindParam(':clientEmail', $clientEmail, PDO::PARAM_STR);



    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}


function getClientById($clientId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';

    //prepare
    $stmt = $db->prepare($sql);

    //bind
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    //execute
    $stmt->execute();

    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $clientData;
}


function updateClientPassword($clientId, $clientPassword)
{
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword
	WHERE clientId = :clientId';

    //prepare
    $stmt = $db->prepare($sql);

    //bind
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    //execute
    $stmt->execute();

    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}