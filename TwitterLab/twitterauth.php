<!doctype html>
<html>
<head>
<title>Twitter Lab</title>


</head>
<body>
<?php
/** Set access tokens here - see: https://dev.twitter.com/apps/ 

This code here works perfect for authentication. Please use your own auth codes! 

DONT FORGET TO CHANGE AUTH CODES!

Done by Gregory Woods

**/
// $settings = array(
//     'oauth_access_token' => "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg",
//     'oauth_access_token_secret' => "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO",
//     'consumer_key' => "aqEWrdsZtvnWskYXZe0Ui1dAs",
//     'consumer_secret' => "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt",
// );

/** Note: Set the GET field BEFORE calling buildOauth(); 

Currently not working code, The json request here for some reason wont go out and fetch the requested data for reasons.

Done by Gregory Woods
**/
// $url = 'https://api.twitter.com/1.1/statuses/FranceHopper_timeline.json';
// $getfield = '?username=FranceHopper';
// echo $settings->setGetfield($getfield)
             // ->buildOauth($url, $requestMethod)
             // ->performRequest(); 

// loop in the brilliant Twitter API PHP (https://github.com/J7mbo/twitter-api-php)
require_once('TwitterAPIExchange.php');

// Configure API tokens
$settings = array(
    'oauth_access_token' => "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg",
    'oauth_access_token_secret' => "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO",
    'consumer_key' => "aqEWrdsZtvnWskYXZe0Ui1dAs",
    'consumer_secret' => "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt"
);

// Try to get latest tweets
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=francehopper';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
var_dump(json_decode($response));

// debug JSON errors
// define JSON errors
$constants = get_defined_constants(true);
$json_errors = array();
foreach ($constants["json"] as $name => $value) {
    if (!strncmp($name, "JSON_ERROR_", 11)) {
        $json_errors[$value] = $name;
    }
}
// Show the errors for different depths.
foreach (range(4, 3, -1) as $depth) {
    var_dump(json_decode($response, true, $depth));
    echo 'Last error: ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
}

?>
</body>
</html>