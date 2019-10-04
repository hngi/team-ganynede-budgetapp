<?php
    session_start();
    require_once "GoogleAPI/vendor/autoload.php";
    $gClient = new Google_Client();
    $gClient->setClientId("642502300188-obhvg8j1svctqcbtpv8cemmesq8nledj.apps.googleusercontent.com");
    $gClient->setClientSecret("MDOGZ2sukgTvCRuT_XcHCTMw");
    $gClient->setApplicationName("SPENDLESS Login");
    $gClient->setRedirectUri("http://localhost/budget/g-callback.php");
    $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>