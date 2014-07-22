<!doctype html>
<html>
<head>
    <title>Twitter Lab > Search for Tweets</title>
</head>
<body>
<?php
    require_once('oauth/twitteroauth/twitteroauth.php'); // https://github.com/abraham/twitteroauth
    $searchString = $_GET['userString']; // hardcoded for now because it's easier. Deal with it.

    // don't be a dick by stealing my keys
    define('CONSUMER_KEY', 'aqEWrdsZtvnWskYXZe0Ui1dAs');
    define('CONSUMER_SECRET', 'VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt');
    define('ACCESS_TOKEN', '16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg');
    define('ACCESS_TOKEN_SECRET', 'F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO');

    function runSearch(array $query)
    {
      $conectionToTwitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET); // connect to Twitter API
      return $conectionToTwitter->get('search/tweets', $query); // run our search query
  }

      $query = array(
      "q" => "$searchString", // build the search query
      );

    $tweets = runSearch($query); // fetch tweets from our search


    foreach ($tweets->statuses as $line) { // step through each returned tweet
        $status = $line->text; // strip the Tweet from the JSON
        // $tweetTime =  $line->created_at; // strip creation time from the JSON
        // $tweetId = $line->id_str; // strip the tweet ID so we can link back to the source tweet
        $outputTweet = '<li>'.$status.'</span>'; // to be rebuilt. Maybe.
         // <a style="font-size:85%" href="http://twitter.com/'.$userName.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
        echo $outputTweet; // echo the tweet
    }

    // DEBUG
    echo '<p>Anything below this line is for debug purposes. Nothing to see here.</p><br />';
    echo '<br /><img src="test.gif">'; // if this line returns an image, PHP is writing properly AND permisions are OK. Probabaly.
?>
</body>
</html>