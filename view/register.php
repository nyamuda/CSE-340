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
                <div class="intro">
                    <h1>Register</h1>
                </div>

                <label for="firstName-register">First Name<input id="firstName-register" type="text" value=""
                        placeholder="First Name" name="first-name" tabindex="1" required /></label>

                <label for="lastName-register">Last Name<input id="lastName-register" type="text" value=""
                        placeholder="Last Name" name="last-name" tabindex="1" required /></label>

                <label for="email-register">Email<input id="email-register" type="email" value="" placeholder="Email"
                        name="email" tabindex="3" required /></label>


                <label for="password-register">Password<input id="password-register" type="password" value=""
                        placeholder="Password" name="business-title" tabindex="2" required /></label>

                <input type="button" value="Submit" tabindex="6" />
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