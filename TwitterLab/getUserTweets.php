<!doctype html>
<html>
<head>
<title>Twitter Lab > Get Tweets From A User</title>


</head>
<body>
<?php


// loop in the brilliant Twitter API PHP (https://github.com/J7mbo/twitter-api-php)
require_once('TwitterAPIExchange.php'); // this must be in the same directory as this file!
$userName = "francehopper"; // hardcoded for now because it's easier. Deal with it.

// // Configure API tokens
// // thank you for not being an ass and stealing mine
// $settings = array(
//     'oauth_access_token' => "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg",
//     'oauth_access_token_secret' => "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO",
//     'consumer_key' => "aqEWrdsZtvnWskYXZe0Ui1dAs",
//     'consumer_secret' => "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt"
// );

// // Try to get latest tweets
// $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json'; // define JSON URL hook
// $getfield = '?screen_name=francehopper'; // define paramater
// $requestMethod = 'GET'; // define request method

// $twitter = new TwitterAPIExchange($settings); // spawn new request instance
// $response = $twitter->setGetfield($getfield) // get lookup item
//     ->buildOauth($url, $requestMethod) // get URL hook and method
//     ->performRequest(); // send request to Twitter
// var_dump(json_decode($response)); // dump the JSON responce
// // Note: on XAMPP, this will return NULL if your CURL is not up to date
// // see http://stackoverflow.com/questions/18574055/twitter-api-returns-null-on-xampp for fix
// // make sure you give read access to the cert!




// new function-based code (aka untested shit)
function fetchTweets($userName) {
    // since JSON will eventually hit a limit, let's limit our results to 20 tweets
    $fetchLimit = 20;
    // don't be a dick and steal my API keys. I will find you.
    $settings = array(
        'oauth_access_token' => "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg",
        'oauth_access_token_secret' => "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO",
        'consumer_key' => "aqEWrdsZtvnWskYXZe0Ui1dAs",
        'consumer_secret' => "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt"
    );
    // function connectToTwitter($settings) {
    //     $twitterConnection = new TwitterAPIExchange($settings);
    //     return $twitterConnection;
    // }

    // // $twitterConnection = connectToTwitter($settings);
    // $twitterConnection = new TwitterAPIExchange($settings);
    // $userTweets = $twitterConnection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$userName."&count=".$notweets);

    // define what we're going to fetch
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json'; // define JSON URL hook
    $getfield = '?screen_name=".$userName."&count=".$fetchLimit'; // define what we want to get from Twitter
    $requestMethod = 'GET'; // define request method

    // talk to Twitter
    $twitter = new TwitterAPIExchange($settings); // establish connection to Twitter with our API key
    $response = $twitter->setGetfield($getfield) // get lookup item
        ->buildOauth($url, $requestMethod) // get URL hook and request method
        ->performRequest(); // send request to Twitter
    // hope it works

    return ($response);
}




// function getTweets($twitteruser) { 
//     $notweets = 20;
//     $consumerkey = "insertkey";
//     $consumersecret = "insertsecret";
//     $accesstoken = "inserttoken";
//     $accesstokensecret = "inserttokensecret";
      
//     function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
//       $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
//       return $connection;
//     }
       
//     $connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
//     $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

//     return ($tweets);
// }

$tweets = fetchTweets($userName);
foreach ($tweets as $line){
    $status = $line->text;
    $tweetTime =  $line->created_at;
    $tweetId = $line->id_str;
    $outputTweet = '<li>'.$status.'</span> <a style="font-size:85%" href="http://twitter.com/'.$userName.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>';
    echo $outputTweet;    
}





// debug JSON errors

// // to disable JSON error debug, comment from this line...
// // define JSON errors
// $constants = get_defined_constants(true);
// $json_errors = array();
// foreach ($constants["json"] as $name => $value) {
//     if (!strncmp($name, "JSON_ERROR_", 11)) {
//         $json_errors[$value] = $name;
//     }
// }
// // Show the errors for different depths.
// foreach (range(4, 3, -1) as $depth) {
//     var_dump(json_decode($response, true, $depth));
//     echo '<br />Last error: ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
// }
// // ...comment UNTIL this line to disable JSON error debug

echo '<br /><img src="test.gif">'; // if this line returns an image, PHP is writing properly AND permisions are OK. Probabaly.
?>
</body>
</html>