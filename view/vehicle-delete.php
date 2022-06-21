<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
//check to see if the user is authorize to see the page
//the function is from the functions module
checkAuthorization();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/site/logo.png">
    <title>
        <?php if (isset($invInfo['invMake'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        } ?> | PHP Motors</title>
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

        <div class="section-form">

            <form method="POST" action="/phpmotors/vehicles/index.php">
                <div class="intro">
                    <h1>
                        <?php if (isset($invInfo['invMake'])) {
                            echo "Delete $invInfo[invMake] $invInfo[invModel]";
                        } ?></h1>
                    <?php if (isset($error_message)) {
                        echo $error_message;
                    } ?>
                    <p>Confirm Vehicle Deletion. The delete is permanent.</p>
                </div>


                <label for="invMake">Make<input read id="inMake" type="text" placeholder="Make" name="invMake"
                        tabindex="1"
                        <?php
                                                                                                                            if (isset($invInfo['invMake'])) {
                                                                                                                                echo "value='$invInfo[invMake]'";
                                                                                                                            } ?> /></label>

                <label for="invModel">Model<input required id="invModel" type="text" placeholder="Model" name="invModel"
                        tabindex="1"
                        <?php
                                                                                                                                        if (isset($invInfo['invModel'])) {
                                                                                                                                            echo "value='$invInfo[invModel]'";
                                                                                                                                        } ?> /></label>

                <label for="invDescription">Description<input required id="invDescription" type="text"
                        placeholder="Description" name="invDescription" tabindex="3"
                        value="  <?php
                                                                                                                                                                                if (isset($invInfo['invDescription'])) {
                                                                                                                                                                                    echo $invInfo['invDescription'];
                                                                                                                                                                                }
                                                                                                                                                                                ?>" /></label>



                <input type="submit" value="Delete Vehicle" tabindex="6" />
                <input type="hidden" name="action" value="delete-vehicle">
                <input type="hidden" name="invId" value="
                <?php if (isset($invInfo['invId'])) {
                    echo $invInfo['invId'];
                } ?>">
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
<?php unset($error_message) ?>