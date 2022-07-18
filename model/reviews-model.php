<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';


//ADD A USER REVIEW TO THE DATABASE
function insertClientReview($invId, $clientId, $reviewText)
{

    $object = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText,invId,clientId)
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
    $sql = "SELECT reviewText, DATE_FORMAT(reviewDate, '%d %M, %Y') AS reviewDate, clientFirstname, clientLastname 
    FROM reviews rv JOIN clients c USING(clientId) 
    JOIN inventory inv USING(invId) WHERE inv.invId=:invId ORDER BY rv.reviewDate DESC";

    //prapare
    $object = phpmotorsConnect();
    $stmt = $object->prepare($sql);

    //bind
    $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);


    //execute
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;

    return $result;
}


//FETCH ALL REVIEWS
//FOR A PARTICULAR CLIENT
function getAllClientReviews($clientId)
{
    $sql = "SELECT reviewId, reviewText, DATE_FORMAT(reviewDate, '%d %M, %Y') AS reviewDate, invId, invMake, invModel
    FROM reviews rv JOIN clients c USING(clientId) 
    JOIN inventory inv USING(invId) WHERE c.clientId=:clientId ORDER BY rv.reviewDate DESC";

    //prapare
    $object = phpmotorsConnect();
    $stmt = $object->prepare($sql);

    //bind
    $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);


    //execute
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = null;

    return $result;
}


//DELETE A PARTICULAR REVIEW

function deleteReviewById($reviewId)
{
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';

    //PREPARE
    $conn = phpmotorsConnect();
    $stmt = $conn->prepare($sql);

    //BIND THE DATA
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}



//GET REVIEW BY ID

function  getReviewById($reviewId)
{
    $sql = "SELECT reviewId, reviewText, 
    DATE_FORMAT(reviewDate, '%d %M, %Y') AS reviewDate, invMake, invModel 
    FROM reviews JOIN inventory USING (invId) WHERE reviewId=:reviewId";


    $conn = phpmotorsConnect();
    //prepare
    $stmt = $conn->prepare($sql);

    //bind
    $stmt->bindValue(":reviewId", $reviewId, PDO::PARAM_INT);

    //execute
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $vehicle;
}


//UPDATE A CLIENT REVIEW
function updateReviewById($reviewId, $reviewText)
{
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';


    //PREPARE
    $conn = phpmotorsConnect();
    $stmt = $conn->prepare($sql);

    //BIND THE DATA

    $stmt->bindParam(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);

    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}