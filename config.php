<?php

// connect To google Api
require_once ('google-api/vendor/autoload.php');

    $gClient = new Google_client();
    
    $gClient->setClientId("915409733777-cqsnk4armaup7cgi61n09tesdp3shqjp.apps.googleusercontent.com");
    $gClient->setClientSecret("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");
    $gClient->setApplicationName("medcare login");
    $gClient->setRedirectUri("http://localhost/medcare/profile.php");
    $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
    
    // login URL
    $login_url = $gClient->createAuthUrl();

?>
