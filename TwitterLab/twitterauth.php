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

// require_once('TwitterAPIExchange.php');

// // Configure API tokens
// $settings = array(
//     'oauth_access_token' => "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg",
//     'oauth_access_token_secret' => "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO",
//     'consumer_key' => "aqEWrdsZtvnWskYXZe0Ui1dAs",
//     'consumer_secret' => "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt"
// );

// // Test if we can get a list of followers
// $url = 'https://api.twitter.com/1.1/followers/list.json';
// $getfield = '?username=francehopper&skip_status=1';
// $requestMethod = 'GET';
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest();  

# Load Twitter class
require_once('twitteroauth-master/twitteroauth/TwitterOAuth.php');

# Define constants
define('TWEET_LIMIT', 5);
define('TWITTER_USERNAME', 'francehopper');
define('CONSUMER_KEY', 'aqEWrdsZtvnWskYXZe0Ui1dAs');
define('CONSUMER_SECRET', 'VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt');
define('ACCESS_TOKEN', '16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg');
define('ACCESS_TOKEN_SECRET', 'F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO');

# Create the connection
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

# Migrate over to SSL/TLS
$twitter->ssl_verifypeer = true;

# Load the Tweets
$tweets = $twitter->get('statuses/user_timeline', array('screen_name' => TWITTER_USERNAME, 'exclude_replies' => 'true', 'include_rts' => 'false', 'count' => TWEET_LIMIT));

# Example output
if(!empty($tweets)) {
    foreach($tweets as $tweet) {

        # Access as an object
        $tweetText = $tweet['text'];

        # Make links active
        $tweetText = preg_replace("#(http://|(www.))(([^s<]{4,68})[^s<]*)#", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $tweetText);

        # Linkify user mentions
        $tweetText = preg_replace("/@(w+)/", '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $tweetText);

        # Linkify tags
        $tweetText = preg_replace("/#(w+)/", '<a href="http://search.twitter.com/search?q=$1" target="_blank">#$1</a>', $tweetText);

        # Output
        echo $tweetText;

    }
}

?>
</body>
</html>