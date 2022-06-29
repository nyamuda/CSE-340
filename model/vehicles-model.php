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


function getInvItemsByClassificationId($id)
{
    $sql = "SELECT * FROM inventory WHERE classificationId = :id";


    $conn = phpmotorsConnect();
    //prepare
    $stmt = $conn->prepare($sql);

    //bind data
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    //execute
    $stmt->execute();

    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;

    return $inventory;
}

function getInvItemInfo($invId)
{
    $sql = "SELECT * FROM inventory WHERE invId=:invId";
    $conn = phpmotorsConnect();
    //prepare
    $stmt = $conn->prepare($sql);

    //bind
    $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);

    //execute

    $stmt->execute();

    $inventory = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = null;

    return $inventory;
}


function updateVehicle(
    $invId,
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
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';


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
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}



function deleteVehicle($invId)
{
    $sql = $sql = 'DELETE FROM inventory WHERE invId = :invId';

    //PREPARE
    $conn = phpmotorsConnect();
    $stmt = $conn->prepare($sql);

    //BIND THE DATA

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    //EXECUTE
    $stmt->execute();
    $rowsAffected = $stmt->rowCount();
    $stmt = null;
    return $rowsAffected;
}


//fetching vehicles based on their classification

function getVehiclesByClassification($classificationName)
{
    $sql = "SELECT invId ,
    invMake,
    invModel ,
    invDescription,
    invImage ,
    invThumbnail ,
    CONCAT('$',FORMAT(invPrice,0,'en_US')) AS invPrice,
    invStock,
    invColor, classificationId FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)";

    //PREPARE
    $conn = phpmotorsConnect();
    $stmt = $conn->prepare($sql);

    //BIND THE DATA

    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    //EXECUTE
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $vehicles;
}


function getVehicleById($vehicleId)
{
    $sql = "SELECT invId ,
    invMake,
    invModel ,
    invDescription,
    invImage ,
    invThumbnail ,
    CONCAT('$',FORMAT(invPrice,0,'en_US')) AS invPrice,
    invStock,
    invColor ,
    classificationId FROM inventory WHERE invId=:vehicleId";


    $conn = phpmotorsConnect();
    //prepare
    $stmt = $conn->prepare($sql);

    //bind
    $stmt->bindValue(":vehicleId", $vehicleId, PDO::PARAM_INT);

    //execute
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $vehicle;
}