<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
    exit;
}

if (isset($_SESSION['clientData'])) {
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    $clientId = $_SESSION['clientData']['clientId'];
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

        <div class='section-form review-form'>
            <form method='POST' action='/phpmotors/reviews/'>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
                <div class='intro'>
                    <?php
                    $make = $review['invMake'];
                    $model = $review['invModel'];
                    $heading = "<h3>Update $make $model</h3>";
                    echo $heading;
                    ?>
                </div>

                <label for='review'>Review<textarea id='review' rows='5' type='text' placeholder='Write your review...'
                        name='reviewText' tabindex='2' required /><?php echo $review['reviewText'] ?></textarea></label>

                <input type='submit' value='Update' tabindex='6' />

                <input type='hidden' name='action' value='edit'>
                <input type='hidden' name='reviewId' value="<?php echo $review['reviewId'] ?>">


            </form>
        </div>

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