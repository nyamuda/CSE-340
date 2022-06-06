<?php

//VALIDATE EMAIL
function checkEmail($clientEmail)
{
    $email = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $email;
}


function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}