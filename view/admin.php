<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/site/logo.png">
    <link type="text/css" media="screen" rel="stylesheet" href="../css/styles.css">
    <title>PHP Motors</title>

</head>

<body>
    <header>
        <?php
        //HEADER SNIPPET
        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
        ?>

        <nav>
            <?php
            //NAV SNIPPET
            // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';

            echo $dynamicNavBar;

            ?>
        </nav>
    </header>
    <main>
        <h1>
            <?php
            $fullName = $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
            echo $fullName;
            ?>
        </h1>




        <?php
        //A List of the client details
        $data = $_SESSION['clientData'];

        $firstName = $data['clientFirstname'];
        $lastName = $data['clientLastname'];
        $email = $data['clientEmail'];
        $level = $data['clientLevel'];

        $list = "<ul>";

        $list .= "<li>First Name: $firstName</li>";
        $list .= "<li>Last Name: $lastName</li>";
        $list .= "<li>Email: $email</li>";

        $list .= "</ul>";
        echo $list;



        if ($level > 1) {
            $paragraph = "<p><a href='/phpmotors/vehicles/'>Vehicle</a></p>";
            echo $paragraph;
        }

        ?>



        <hr>

    </main>


    <!--FOOTER SNIPPET-->
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'

    ?>


</body>

</html>