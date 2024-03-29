<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
//check to see if the user is authorize to see the page
//the function is from the functions module
checkAuthorization();


if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
}

if (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/site/logo.png">
    <title>PHP Motors</title>
    <link type="text/css" media="screen" rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <?php
        //HEADER SNIPPET
        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
        ?>

        <nav>
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php';

            //NAV SNIPPET
            // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';

            echo $dynamicNavBar;

            ?>
        </nav>
    </header>
    <main>
        <h1>Add Classification or Vehicle</h1>

        <ul>
            <li><a href="/phpmotors/vehicles/index.php?action=classification">Add Classification</a></li>
            <li><a href="/phpmotors/vehicles/index.php?action=vehicle">Add Vehicle</a></li>
        </ul>

        <?php
        if (isset($message)) {
            echo $message;
        }

        if (isset($classificationList)) {
            echo '<h2>Vehicles By Classification</h2>';
            echo '<p>Choose a classification to see those vehicles</p>';

            echo $classificationList;
        }
        ?>
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>

        <hr>

    </main>


    <!--FOOTER SNIPPET-->
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'

    ?>


    <script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['success_message']); ?>
<?php unset($_SESSION['error_message']); ?>