<?php
if (!!isset($_SESSION['loggein'])) {
    header('Location: /phpmotors/accounts');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/site/logo.png">
    <link type="text/css" media="screen" rel="stylesheet" href="css/styles.css">
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
            $fullName = $_SESSION['clientData']['clientFirstName'] . " " . $_SESSION['clientData']['clientLastName'];
            echo $fullName;
            ?>
        </h1>

        <ul>
            <?php
            $data = $_SESSION['clientData'];

            echo "<li>" . "First Name: " . $data['clientFirstName'] . '</li?';
            echo  "<li>" . "Last Name: " . $data['clientLastName'] . '</li?';
            echo  "<li>" . "Email: " . $data['clientEmail'] . '</li?';

            ?>
        </ul>


        <hr>

    </main>


    <!--FOOTER SNIPPET-->
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'

    ?>


</body>

</html>