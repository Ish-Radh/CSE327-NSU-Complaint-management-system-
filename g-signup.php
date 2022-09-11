
<?php
require_once 'vendor/autoload.php';
$clientID ='469963347373-sdhl45nos504d2crpmo46b7psbmm0f5b.apps.googleusercontent.com';
$clientSecret ='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';
$redirectUrl = 'http://localhost/ComplaintMgSystem-PHP/g-signup';
// Creating client request to google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret ($clientSecret);
$client->setRedirecturi($redirectUrl);
$client->addScope( 'profile');
$client->addScope('email');
if(isset ($_GET['code'])){
    $token=$client->fetchAccessToken($_GET['code']);
    $client->setAccessToken($token);

    //Getting user profile
    $gauth = new Google_Service_Oauth($client);
    $google_info = $google_info->email;
    $name = $google_info->name;

    echo "Welcome ".$name."You are registered using email".$email;
}

else{
    echo "<a href-'" .$client->createAuthUrl()."Login with Google</a>";
    }


