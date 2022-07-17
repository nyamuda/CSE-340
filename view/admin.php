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


        <p>You're logged in.</p>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
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

        ?>

        <h2>Account Management</h2>
        <p>Use the link to update account information.</p>
        <p><a href="/phpmotors/accounts/index.php?action=mod">Update account information</a></p>



        <?php


        if ($level > 1) {
            $paragraph = "<p><a href='/phpmotors/vehicles/'>Vehicle</a></p>";
            $description = "<p>Use this link to manage the inventory.</p>";
            $heading = "<h2>Inventory Management</h2>";

            echo $heading;
            echo $description;
            echo $paragraph;
        }

        ?>


        <h2>Manage your Product Reviews</h2>
        <?php

        //FUNCTION FROM THE USERS CONTROLLER
        echo showAllClientReviews();
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