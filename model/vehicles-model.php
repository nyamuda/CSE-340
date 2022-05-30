<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/connections.php";

//Function that add a new vehicle

function addVehicle(
    $invMake,
    $invModel,
    $invDescription,
    $invImage,
    $invThumbnail,
    $invPrice,
    $invStock,
    $invColor,
    $classificationId
) {
    $sql = "INSERT INTO inventory 
    (invMake,invModel,invDescription,invImage,invThumbnail,invPrice,invStock,invColor,classificationId)
    VALUES (:invMake,:invModel,:invDescription,:invImage,:invThumbnail,:invPrice,:invStock,:invColor,:classificationId)";


    //PREPARE
    $conn = phpmotorsConnect();
    $stmt = $conn->prepare($sql);

    //BIND THE DATA

    $stmt->bindParam(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindParam(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindParam(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindParam(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindParam(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindParam(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindParam(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindParam(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindParam(':classificationId', $classificationId, PDO::PARAM_INT);

    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}



function addClassification($classificationName)
{
    $sql = "INSERT INTO carclassification (classificationName) VALUES (:classificationName)";
    $conn = phpmotorsConnect();
    //PREPARE
    $stmt = $conn->prepare($sql);

    //BIND
    $stmt->bindParam(':classificationName', $classificationName, PDO::PARAM_STR);

    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}