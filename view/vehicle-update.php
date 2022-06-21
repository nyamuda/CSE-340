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
        <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
        } ?>
        |PHP Motors</title>
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
                        <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                            echo "Modify $invInfo[invMake] $invInfo[invModel]";
                        } elseif (isset($invMake) && isset($invModel)) {
                            echo "Modify $invMake $invModel";
                        } ?>
                        Modify Vehicle</h1>
                    <?php if (isset($error_message)) {
                        echo $error_message;
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


                <label for="invMake">Make<input required id="inMake" type="text" value="<?php if (isset($invMake)) {
                                                                                            echo $invMake;
                                                                                        } elseif (isset($invInfo['invMake'])) {
                                                                                            echo $invInfo['invMake'];
                                                                                        } ?>" placeholder="Make"
                        name="invMake" tabindex="1" /></label>

                <label for="invModel">Model<input required id="invModel" type="text" value="<?php if (isset($invModel)) {
                                                                                                echo $invModel;
                                                                                            } elseif (isset($invInfo['invModel'])) {
                                                                                                echo $invInfo['invModel'];
                                                                                            } ?>" placeholder="Model"
                        name="invModel" tabindex="1" /></label>

                <label for="invDescription">Description<input required id="invDescription" type="text" value="<?php if (isset($invDescription)) {
                                                                                                                    echo $invDescription;
                                                                                                                } elseif (isset($invInfo['invDescription'])) {
                                                                                                                    echo $invInfo['invDescription'];
                                                                                                                } ?>"
                        placeholder="Description" name="invDescription" tabindex="3" /></label>


                <label for="invImage">Image Path<input required id="invImage" type="text" placeholder="Image Path"
                        value="<?php if (isset($invImage)) {
                                                                                                                                echo $invImage;
                                                                                                                            } elseif (isset($invInfo['invImage'])) {
                                                                                                                                echo $invInfo['invImage'];
                                                                                                                            } ?>"
                        name="invImage" tabindex="2" /></label>

                <label for="invThumbnail">Thumbnail Path<input required id="invThumbnail" type="text"
                        placeholder="Thumbnail Path"
                        value="<?php if (isset($invThumbnail)) {
                                                                                                                                                echo $invThumbnail;
                                                                                                                                            } elseif (isset($invInfo['invThumbnail'])) {
                                                                                                                                                echo $invInfo['invThumbnail'];
                                                                                                                                            } ?>"
                        name="invThumbnail" tabindex="2" /></label>

                <label for="invPrice">Price<input required id="invPrice" type="text" placeholder="Price" value="<?php if (isset($invPrice)) {
                                                                                                                    echo $invPrice;
                                                                                                                } elseif (isset($invInfo['invPrice'])) {
                                                                                                                    echo $invInfo['invPrice'];
                                                                                                                } ?>"
                        name="invPrice" tabindex="2" /></label>

                <label for="invStock">Number In Stock<input required id="invStock" type="text" placeholder="Stock"
                        value="<?php if (isset($invStock)) {
                                                                                                                                echo $invStock;
                                                                                                                            } elseif (isset($invInfo['invStock'])) {
                                                                                                                                echo $invInfo['invStock'];
                                                                                                                            } ?>"
                        name="invStock" tabindex="2" /></label>

                <label for="invColor">Color<input required id="invColor" type="text" placeholder="Color" value="<?php if (isset($invColor)) {
                                                                                                                    echo $invColor;
                                                                                                                } elseif (isset($invInfo['invColor'])) {
                                                                                                                    echo $invInfo['invColor'];
                                                                                                                }  ?>"
                        name="invColor" tabindex="2" /></label>


                <input type="submit" value="Update Vehicle" tabindex="6" />
                <input type="hidden" name="action" value="update-vehicle">
                <input type="hidden" name="invId" value="
<?php if (isset($invInfo['invId'])) {
    echo $invInfo['invId'];
} elseif (isset($invId)) {
    echo $invId;
} ?>
">
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