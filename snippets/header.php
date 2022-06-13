<div>
    <img src="/phpmotors/images/site/logo.png" alt="logo">
    <?php
    if (isset($sessionFirstName)) {
        echo  "<span>Hi, $sessionFirstName</span>";
    }
    ?>
    <p>
        <a href="/phpmotors/accounts/index.php?action=account" id="account-link">My Account</a>

    </p>
</div>