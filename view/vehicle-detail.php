<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/site/logo.png">
    <title><?php echo $vehicleName; ?> Details| PHP Motors, Inc.</title>
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
            //NAV SNIPPET
            // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';

            echo $dynamicNavBar;

            ?>
        </nav>
    </header>
    <main>
        <h1><?php echo $vehicleName; ?></h1>

        <?php if (isset($message)) {
            echo $message;
        }
        ?>

        <div id="vehicle-data">
            <?php if (isset($builtThumbnails)) {
                echo  $builtThumbnails;
            } ?>


            <?php if (isset($vehicleInfo)) {
                echo $vehicleInfo;
            } ?>

        </div>
        <hr>

        <h2>Customer Reviews</h2>
        <?php
        if (isset($_SESSION['loggedin'])) {
            $clientId = $_SESSION['clientData']['clientId'];
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            $clientLastname = $_SESSION['clientData']['clientLastname'];
            $clientScreenName = substr($clientFirstname, 0, 1) . substr($clientLastname, 0);

            if (isset($error_message)) {
                echo $error_message;
            }
            if (isset($_SESSION['success_message'])) {
                echo $_SESSION['success_message'];
            }
            $form = "<div class='section-form'>
            <form method='POST' action='/phpmotors/reviews/'>
              
        <div class='intro'>
            <h3>Review</h3>
        </div>
        <label for='name'>Screen Name<input readonly id='name' type='input' value='<?php echo $clientScreenName ?>'
        name='screenName' tabindex='3' /></label>
        <label for='review'>Password<input id='review' type='text' value='<?php echo $reviewText ?>'
                placeholder='Review' name='reviewText' tabindex='2' required /></label>

        <input type='submit' value='Submit' tabindex='6' />

        <input type='hidden' name='action' value='add-review'>
        <input type='hidden' name='clientId' value='<?php echo $clientId ?>'>
        <input type='hidden' name='invId' value='<?php echo $vehicleId ?>'>

        </form>
        </div>";

        echo $form;
        } else {
        $link = "<p>You must <a href='/phpmotors/accounts'>login</a> to write a review.</p>";
        echo $link;
        }

        ?>

        <?php

        echo showAllVehicleReviews();

        ?>

        <hr>

    </main>


    <!--FOOTER SNIPPET-->
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'

    ?>


</body>

</html>