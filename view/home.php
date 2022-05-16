<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/site/logo.png">
    <link type="text/css" media="screen" rel="stylesheet" href="css/styles.css">
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

            echo $navList;

            ?>
        </nav>
    </header>
    <main>
        <h1>Welcome to PHP Motors</h1>

        <div class="dole-feautures">
            <p>DMC Dolerean</p>
            <p>3 Cup holders</p>
            <p>Superman doors</p>
            <p>Fuzzy dice</p>
        </div>
        <button class="dole-btn" id="home-desk-btn">Own Today</button>
        <div class="car-container">
            <button class="dole-btn">Own Today</button>
            <div class="dole-img">
                <img src="images/delorean.jpg" alt="DMC Dolerean">
            </div>

        </div>


        <div class="reviews-photos">
            <div class="dole-reviews">
                <p>DMC Dolerean Reviews</p>
                <ul>
                    <li>"So fast its almost like travelling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80s livin and I love it!" (5/5)</li>
                </ul>
            </div>
            <div class="dole-upgrades-container">
                <p>DMC Dolerean Upgrades</p>
                <div class="dole-parts">
                    <figure>
                        <img src="images/upgrades/flux-cap.png" alt="Flex Capacitor">
                        <figcaption><a href="/">Flex Capacitor</a></figcaption>
                    </figure>
                    <figure>
                        <img src="images/upgrades/flame.jpg" alt="Flame Decals">
                        <figcaption><a href="/">Flame Decals</a></figcaption>
                    </figure>
                    <figure>
                        <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                        <figcaption><a href="/">Bumper Stickers</a></figcaption>
                    </figure>
                    <figure>
                        <img src="images/upgrades/hub-cap.jpg" alt="Hub Caps">
                        <figcaption><a href="/">Hub Caps</a></figcaption>
                    </figure>
                </div>
            </div>
        </div>

        <hr>

    </main>


    <!--FOOTER SNIPPET-->
    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'

    ?>

    <!-- JAVACRIPT -->
    <script type="text/javascript" src="./js/home.js"></script>


</body>

</html>