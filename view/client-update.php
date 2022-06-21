<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
    exit;
}

if (isset($_SESSION['clientData'])) {
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    $clientId = $_SESSION['clientData']['clientId'];
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

        <div class="section-form">
            <?php if (isset($error_message)) {
                echo $error_message;
            } ?>
            <form method="POST" action="/phpmotors/accounts/index.php">
                <div class="intro">
                    <h2>Update Account</h2>
                </div>

                <label for="firstName-register">First Name<input required id="firstName-register" type="text"
                        value="<?php echo $clientFirstname ?>" placeholder="First Name" name="clientFirstname"
                        tabindex="1" /></label>

                <label for="lastName-register">Last Name<input required id="lastName-register" type="text"
                        value="<?php echo $clientLastname ?>" placeholder="Last Name" name="clientLastname"
                        tabindex="1" /></label>

                <label for="email-register">Email<input required id="email-register" type="email"
                        value="<?php echo $clientEmail ?>" placeholder="Email" name="clientEmail"
                        tabindex="3" /></label>


                <input type="submit" value="Update" tabindex="6" />
                <input type="hidden" name="action" value="update-account">
                <input type="hidden" name="clientId" value="<?php echo $clientId ?>">
            </form>
        </div>






        <div class="section-form">
            <?php if (isset($password_error_message)) {
                echo $password_error_message;
            } ?>
            <form method="POST" action="/phpmotors/accounts/index.php">
                <div class="intro">
                    <h2>Change password</h2>
                </div>
                <label for="password-register">Password </label>
                <p class="small-message">Passwords must be at least 8
                    characters and contain at least 1 number, 1 capital letter and 1 special character</p>
                <input required id="password-register" type="password" placeholder="Password" name="clientPassword"
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" tabindex="2" />
                <input type="submit" value="Change Password" tabindex="6" />
                <input type="hidden" name="action" value="change-password">
                <input type="hidden" name="clientId" value="<?php echo $clientId ?>">
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
unset($error_message);
unset($password_error_message);
?>