<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/site/logo.png">
    <link type="text/css" media="screen" rel="stylesheet" href="../css/styles.css">
    <title>PHP Motors</title>
    <style>
    input[type=submit] {
        width: 100%;
        cursor: pointer;
        margin: 0;
        padding: .5em 2em;
        background: #636363;
        border: none;
        color: #fff;
        font-size: 1em;
        font-weight: 400;
    }
    </style>
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

        <div class="section-form">
            <?php if (isset($message)) {
                echo $message;
            } ?>
            <form method="POST" action="/phpmotors/accounts/index.php">
                <div class="intro">
                    <h1>Register</h1>
                </div>

                <label for="firstName-register">First Name<input id="firstName-register" type="text"
                        value="<?php echo $clientFirstName ?>" placeholder="First Name" name="clientFirstName"
                        tabindex="1" /></label>

                <label for="lastName-register">Last Name<input id="lastName-register" type="text"
                        value="<?php echo $clientLastName ?>" placeholder="Last Name" name="clientLastName"
                        tabindex="1" /></label>

                <label for="email-register">Email<input id="email-register" type="text"
                        value="<?php echo $clientEmail ?>" placeholder="Email" name="clientEmail"
                        tabindex="3" /></label>


                <label for="password-register">Password<input id="password-register" type="password"
                        placeholder="Password" name="clientPassword" tabindex="2" /></label>

                <input id="reg-btn" type="submit" value="Register" tabindex="6" />
                <input type="hidden" name="action" value="register">
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