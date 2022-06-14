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

        <div class="section-form">

            <form method="POST" action="/phpmotors/vehicles/index.php">
                <div class="intro">
                    <h1>Add Vehicle</h1>
                    <?php if (isset($error_message)) {
                        echo $error_message;
                    } ?>
                    <?php if (isset($success_message)) {
                        echo $success_message;
                    } ?>
                    <p>*Note all fields are required</p>
                </div>
                <!--Adding a dynamic select element from the vehicles controller-->
                <!--It allows the user to select a classification from a list of options-->
                <?php
                //running the function that will create a dynamic select tag
                if (isset($classificationId)) {
                    echo createSelectTag($classificationId);
                } else {
                    echo createSelectTag();
                }

                ?>


                <label for="invMake">Make<input required id="inMake" type="text" value="<?php echo $invMake ?>"
                        placeholder="Make" name="invMake" tabindex="1" /></label>

                <label for="invModel">Model<input required id="invModel" type="text" value="<?php echo $invModel ?>"
                        placeholder="Model" name="invModel" tabindex="1" /></label>

                <label for="invDescription">Description<input required id="invDescription" type="text"
                        value="<?php echo $invDescription ?>" placeholder="Description" name="invDescription"
                        tabindex="3" /></label>


                <label for="invImage">Image Path<input required id="invImage" type="text" placeholder="Image Path"
                        value="<?php echo $defaultImage ?>" name="invImage" tabindex="2" /></label>

                <label for="invThumbnail">Thumbnail Path<input required id="invThumbnail" type="text"
                        placeholder="Thumbnail Path" value="<?php echo $defaultImage; ?>" name="invThumbnail"
                        tabindex="2" /></label>

                <label for="invPrice">Price<input required id="invPrice" type="text" placeholder="Price"
                        value="<?php echo $invPrice; ?>" name="invPrice" tabindex="2" /></label>

                <label for="invStock">Number In Stock<input required id="invStock" type="text" placeholder="Stock"
                        value="<?php echo $invStock; ?>" name="invStock" tabindex="2" /></label>

                <label for="invColor">Color<input required id="invColor" type="text" placeholder="Color"
                        value="<?php echo $invColor; ?>" name="invColor" tabindex="2" /></label>


                <input type="submit" value="Submit" tabindex="6" />
                <input type="hidden" name="action" value="add-vehicle">
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