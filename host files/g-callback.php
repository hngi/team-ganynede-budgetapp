<?php
    require_once "config.php";
    /*
    $token = $client->setAccessType("offline");
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));

    if ($client->isAccessTokenExpired()) {
    $token = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    }   
    */
    if (isset($_SESSION['access_token'])) {
        $gClient->setAccessToken($_SESSION['access_token']);
    }

    else if (isset($_GET['code'])) {
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['access_token'] = $token;

    } else {
        header ('Location: login.php');
        exit();
    }

    
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();

    $_SESSION['id'] = $userData['id'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['gender'] = $userData['gender'];
    $_SESSION['familyName'] = $userData['familyName'];
    $_SESSION['givenName'] = $userData['givenName'];

    header('Location: userpage.php');
        exit();
?>