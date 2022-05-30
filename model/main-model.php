<?php
//Main PHP Motors Model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

function getClassifications()
{
    $connect = phpmotorsConnect();
    $the_statement = $connect->prepare("SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC");
    $the_statement->execute();
    $classifications = $the_statement->fetchAll();
    $the_statement = null;
    return $classifications;
}