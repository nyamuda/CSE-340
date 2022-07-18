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
        <!--SHOW REVIEW FORM IF THE USER IS LOGGED IN-->
        <!--OR ELSE SHOW THEM THE LINK TO THE LOG IN PAGE-->
        <?php
        if (isset($_SESSION['loggedin'])) {
            $clientId = $_SESSION['clientData']['clientId'];
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            $clientLastname = $_SESSION['clientData']['clientLastname'];
            $clientScreenName = $clientScreenName = strtoupper(substr($clientFirstname, 0, 1)) . strtoupper(substr($clientLastname, 0, 1)) . substr($clientLastname, 1);


            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            $form = "<div class='section-form review-form'>
            <form method='POST' action='/phpmotors/reviews/'>
              
        <div class='intro'>
            <h3>Review $vehicleName </h3>
        </div>
        <label for='name'>Screen Name<input readonly id='name' type='text' value='$clientScreenName' name='screenName'
                tabindex='3' /></label>
        <label for='review'>Review<textarea id='review' rows='5'
                placeholder='Write your review...' name='reviewText' tabindex='2' required>$reviewText</textarea></label>

        <input type='submit' value='Submit' tabindex='6' />

        <input type='hidden' name='action' value='add-review'>
        <input type='hidden' name='clientId' value='$clientId'>
        <input type='hidden' name='invId' value='$vehicleId'>

        </form>
        </div>";
            echo $form;
        } else {

            $link = "<p>You must <a href='/phpmotors/accounts/index.php?action=account' class='link-to-review'>login</a> to write a review.</p>";
            echo $link;
        }

        ?>
        <!--SHOW ALL REVIEWS OF THE VEHICLE-->
        <!--THE FOLLOWING FUNCTION IS INSIDE THE VEHICLE CONTROLLER-->
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
<?php
unset($_SESSION['message']);
?>