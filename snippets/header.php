<div>
    <img src="/phpmotors/images/site/logo.png" alt="logo">
    <?php
    if (isset($_SESSION['loggedin'])) {
        //get the the first name of the client if they are logged in
        //the function is in the 'functions' module
        $sessionFirstName = getSessionClientName();

        if (isset($sessionFirstName)) {
            echo  "<a href='/phpmotors/accounts/'>Hi, $sessionFirstName</a>";
        }

        $logout_link = "<p><a href='/phpmotors/accounts/index.php?action=logout' id='account-link'>Logout</a> </p>";
        
        echo $logout_link;
    } else {
        $account_link = "<p><a href='/phpmotors/accounts/index.php?action=account' id='account-link'>My Account</a> </p>";
        echo $account_link;
    }
    ?>




</div>