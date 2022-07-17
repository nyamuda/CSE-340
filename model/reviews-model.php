<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';


//ADD A USER REVIEW TO THE DATABASE
function insertClientReview($invId, $clientId, $reviewText)
{
    $object = phpmotorsConnect();
    $sql = 'INSERT INTO clients (reviewText,invId,clientId)
    VALUES (:reviewText, :invId, :clientId)';
    $stmt = $object->prepare($sql);
    $stmt->bindParam(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rollsChanged = $stmt->rowCount();
    $stmt = null;
    return $rollsChanged;
}


//FETCH ALL REVIEWS
//FOR A PARTICULAR VEHICLE
function getAllVehicleReviews($invId)
{
    $sql = "SELECT reviewText, reviewDate, clientFirstname, clientLastname 
    FROM reviews JOIN clients c USING(clientId) JOIN inventory inv USING(invId) WHERE inv.id=:invId";

    //prapare
    $object = phpmotorsConnect();
    $stmt = $object->prepare($sql);

    //bind
    $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);


    //execute
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;

    return $result;
}