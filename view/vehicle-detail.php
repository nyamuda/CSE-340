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
        <!-- 
        <div class="item">
            <div class="item__block1">
                <p>Title</p>
                <img src="" alt="">
                <p>Price:</p>
            </div>

            <div class="item__block2">
                <p>Vehicle Details</p>
                <p>Description</p>
                <p>Color:</p>
                <p>No. in stock: </p>
            </div>
        </div> -->

    </main>


    <!--FOOTER SNIPPET-->
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'

    ?>


</body>

</html>