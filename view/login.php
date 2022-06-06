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
            <form method="GET" action="thankyou.html">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
                <div class="intro">
                    <h1>Login</h1>
                </div>
                <label for="email-login">Email<input id="email-login" type="email" value="<?php echo $clientEmail ?>"
                        placeholder="Email" name="email" tabindex="3" required /></label>
                <label for="password-login">Password<input id="password-login" type="password"
                        value="<?php echo $clientPassword ?>" placeholder="Password" name="business-title" tabindex="2"
                        required /></label>

                <input type="submit" value="Submit" tabindex="6" />
                <p class="no-account-link">No account?<a
                        href="/phpmotors/accounts/index.php?action=sign_up">&nbsp;&nbsp;Sign
                        up</a></p>
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