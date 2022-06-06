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

                <label for="firstName-register">First Name<input required id="firstName-register" type="text"
                        value="<?php echo $clientFirstName ?>" placeholder="First Name" name="clientFirstName"
                        tabindex="1" /></label>

                <label for="lastName-register">Last Name<input required id="lastName-register" type="text"
                        value="<?php echo $clientLastName ?>" placeholder="Last Name" name="clientLastName"
                        tabindex="1" /></label>

                <label for="email-register">Email<input required id="email-register" type="email"
                        value="<?php echo $clientEmail ?>" placeholder="Email" name="clientEmail"
                        tabindex="3" /></label>


                <label for="password-register">Password <p class="small-message">Passwords must be at least 8
                        characters and contain at least 1 number, 1 capital letter and 1 special character</p>
                    <input required id="password-register" type="password" placeholder="Password" name="clientPassword"
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" tabindex="2" /></label>

                <input type="submit" value="Register" tabindex="6" />
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