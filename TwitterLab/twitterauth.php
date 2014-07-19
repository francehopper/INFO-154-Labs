<!doctype html>
<html>
<head>


</head>
<body>
<?php
/** Set access tokens here - see: https://dev.twitter.com/apps/ 

This code here works perfect for authentication. Please use your own auth codes! 

DONT FORGET TO CHANGE AUTH CODES!

Done by Gregory Woods

**/
$settings = array(
    'oauth_access_token' => "20539114-kTJyC2sNuOpoRnC2E0ee4CaAWhpPniaeUtb11vXGQ",
    'oauth_access_token_secret' => "wyE7FqUpjILa9UdGmXyFyHH6LwctjTmTh8dm4eUNoq4Q2",
    'consumer_key' => "LtCr1ALGAj0fFZ7m3tGBM6XMw",
    'consumer_secret' => "vvwD8DnfdYzxj2FPxRrfhh1i2Nw96AGlXoD6OaaVgBuOschQxP",
);

/** Note: Set the GET field BEFORE calling buildOauth(); 

Currently not working code, The json request here for some reason wont go out and fetch the requested data for reasons.

Done by Gregory Woods
**/
$url = 'https://api.twitter.com/1.1/statuses/GregoryWoods_timeline.json';
$getfield = '?username=GregoryWoods';
echo $settings->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(); 

?>
</body>
</html>