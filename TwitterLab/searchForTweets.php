<!doctype html>
<html>
<head>
<title>Twitter Lab > Search for Tweets</title>


</head>
<body>
<?php
require_once('oauth/twitteroauth/twitteroauth.php'); // https://github.com/abraham/twitteroauth
$searchString = "bananas"; // hardcoded for now because it's easier. Deal with it.

// new function-based code to fetch tweets
// function getTweets($userName) { 
    $returnedTweetsLimit = 20; // limit the number of returned tweets since JSON will hit a limit eventually anyway
    // don't be a dick by stealing my keys
    define('CONSUMER_KEY', 'aqEWrdsZtvnWskYXZe0Ui1dAs');
    define('CONSUMER_SECRET', 'VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt');
    define('ACCESS_TOKEN', '16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg');
    define('ACCESS_TOKEN_SECRET', 'F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO');
      
    function runSearch(array $query)
    {
      $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
      return $toa->get('search/tweets', $query);
    }

    $query = array(
      "q" => "$searchString",
    );

    $results = search($query);
  
    foreach ($results->statuses as $result) {
    echo $result->user->screen_name . ": " . $result->text . "\n";
       
    // $connection = connectToTwitter($consumerkey, $consumersecret, $accesstoken, $accesstokensecret); // call Twitter connection function
    // // hopefully connection worked
    // $tweets = $connection->get('search/tweets', $userSearch); // get the tweets for the specified user
     
    // return ($tweets);
// }

// $tweets = getTweets($userName); // call the function to fetch user tweets
// foreach ($tweets as $line) { // step through each returned tweet
//     $status = $line->text; // strip the Tweet from the JSON
//     $tweetTime =  $line->created_at; // strip creation time from the JSON
//     $tweetId = $line->id_str; // strip the tweet ID so we can link back to the source tweet
//     $outputTweet = '<li>'.$status.'</span> <a style="font-size:85%" href="http://twitter.com/'.$userName.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
//     echo $outputTweet; // echo the tweet
// }

// DEBUG
echo '<br /><img src="test.gif">'; // if this line returns an image, PHP is writing properly AND permisions are OK. Probabaly.
?>
</body>
</html>