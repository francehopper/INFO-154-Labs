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
require_once('TwitterAPIExchange.php'); // this must be in the same directory as this file!

// Configure API tokens
// thank you for not being an ass and stealing mine
$settings = array(
    'oauth_access_token' => "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg",
    'oauth_access_token_secret' => "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO",
    'consumer_key' => "aqEWrdsZtvnWskYXZe0Ui1dAs",
    'consumer_secret' => "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt"
);

// Try to get latest tweets
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json'; // define JSON URL hook
$getfield = '?screen_name=francehopper'; // define paramater
$requestMethod = 'GET'; // define request method

$twitter = new TwitterAPIExchange($settings); // spawn new request instance
$response = $twitter->setGetfield($getfield) // get lookup item
    ->buildOauth($url, $requestMethod) // get URL hook and method
    ->performRequest(); // send request to Twitter
var_dump(json_decode($response)); // dump the JSON responce
// Note: on XAMPP, this will return NULL if your CURL is not up to date
// see http://stackoverflow.com/questions/18574055/twitter-api-returns-null-on-xampp for fix
// make sure you give read access to the cert!

// debug JSON errors

// to disable JSON error debug, comment from this line...
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
    echo '<br />Last error: ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
}
// ...comment UNTIL this line to disable JSON error debug

echo '<br /><img src="test.gif">'; // if this line returns an images, PHP is writing properly AND permisions are OK. Probabaly.
?>
</body>
</html>