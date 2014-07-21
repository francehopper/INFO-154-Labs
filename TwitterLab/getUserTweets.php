<!doctype html>
<html>
<head>
<title>Twitter Lab > Get Tweets From A User</title>


</head>
<body>
<?php
require_once('lab1.1.php');
require_once('oauth/twitteroauth/twitteroauth.php'); // https://github.com/abraham/twitteroauth
$userName = "francehopper"; // hardcoded for now because it's easier. Deal with it.

// new function-based code to fetch tweets
function getTweets($userName) { 
    $returnedTweetsLimit = 20; // limit the number of returned tweets since JSON will hit a limit eventually anyway
    // don't be a dick by stealing my keys
    $consumerkey = "aqEWrdsZtvnWskYXZe0Ui1dAs";
    $consumersecret = "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt";
    $accesstoken = "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg";
    $accesstokensecret = "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO";
      
    function connectToTwitter($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
      $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret); // connect to Twitter via OAuth
      return $connection; // return the connection so we can use it
    }
       
    $connection = connectToTwitter($consumerkey, $consumersecret, $accesstoken, $accesstokensecret); // call Twitter connection function
    // hopefully connection worked
    $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$userName."&count=".$returnedTweetsLimit); // get the tweets for the specified user
     
    return ($tweets);
}

$tweets = getTweets($userName); // call the function to fetch user tweets
foreach ($tweets as $line) { // step through each returned tweet
    $status = $line->text; // strip the Tweet from the JSON
    $tweetTime =  $line->created_at; // strip creation time from the JSON
    $tweetId = $line->id_str; // strip the tweet ID so we can link back to the source tweet
    $outputTweet = '<li>'.$status.'</span> <a style="font-size:85%" href="http://twitter.com/'.$userName.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
    echo $outputTweet; // echo the tweet
}

get_bananas();

// DEBUG
echo '<br /><img src="test.gif">'; // if this line returns an image, PHP is writing properly AND permisions are OK. Probabaly.
?>
</body>
</html>