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
                    $heading = "<h3>Delete $make $model</h3>";
                    echo $heading;
                    ?>
                    <p>Deletes cannot be undone. Are you use sure you want to delete this review ?</p>
                </div>

                <div>
                    <h4>Review Text</h4>
                    <p><?php echo $review['reviewText'] ?></p>
                </div>

                <input type='submit' value='Delete' tabindex='6' />

                <input type='hidden' name='action' value='delete'>
                <input type='hidden' name='reviewId' value='<?php echo $review['reviewId'] ?>'>


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