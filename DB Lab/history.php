<!doctype html>
<html>
<head>
    <title>Database Lab > Database.php</title>
</head>
<body>
<?php
$searchString = $_GET['userString']; // search for the provide string
// connect to mySQL
$connection = mysqli_connect('totoro.hppr.co:3308', 'infousr', 'D1oASa1', 'info154') or die(mysqli_connect_error());

// query the table
$theQuery = 'select from tweets where tweet_text like '.$searchString // build SQL table query
$result = mysqli_query($connection, $theQuery); // perform query

// render navigation
echo "<p><a href=\"home.html\"><- Return home</a></p>";
echo " | ";
echo "<a href=\"liveSearch.php?userString=".$searchString."\">View the latest tweets about ".$searchString."</a>";

// show results
echo "Historical tweets about ".$searchString."<br />"; // render header
while($row = mysqli_fetch_array($result)) {
  echo $row['user_name'] . " tweeted ";
	echo $row['tweet_text'];
  echo " on ";
  echo $row['tweet_time'];
	echo "<br>";
}
// END DEBUG

// require_once('oauth/twitteroauth/twitteroauth.php'); // https://github.com/abraham/twitteroauth

// $searchString = "Otakon"; // temp; DEBUG

// // don't be a dick by stealing my keys
// define('CONSUMER_KEY', 'aqEWrdsZtvnWskYXZe0Ui1dAs');
// define('CONSUMER_SECRET', 'VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt');
// define('ACCESS_TOKEN', '16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg');
// define('ACCESS_TOKEN_SECRET', 'F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO');

// function runSearch(array $query) {
// $conectionToTwitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET); // connect to Twitter API
// return $conectionToTwitter->get('search/tweets', $query); // run our search query
// }

// $query = array (
// "q" => "$searchString", // build the search query
// );


// $tweets = runSearch($query); // fetch tweets from our searchs

// foreach ($tweets->statuses as $line) { // step through each returned tweet
//   $status = $line->text; // strip the Tweet from the JSON
//   $handle = $line->user->screen_name; // get the Twitter handle of the person that sent the tweet
//   $tweetTime =  $line->created_at; // strip creation time from the JSON
//   $tweetId = $line->id_str; // strip the tweet ID so we can link back to the source tweet
//   $outputTweet = '<li><strong><a href="http://twitter.com/' . $handle .'">@' . $handle . "</a></strong>: " . $status .'</span> <a style="font-size:85%" href="http://twitter.com/'.$handle.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
//   echo $outputTweet; // echo the tweet
//   // write tweet to database
//   $thequery = 'insert into tweets (tweet_text, user_name, tweet_time) values ("'.$status.'","'.$handle.'","'.$tweetTime.'")';
//   // mysqli_query($connection, "INSERT INTO tweets (tweet_text, user_name, tweet_time) VALUES ($status,$handle,$tweetTime)") or die (mysqli_error($connection));
//   mysqli_query($connection, $thequery) or die (mysqli_error($connection));
// }




// close SQL connection
mysqli_close($connection);

?>
</body>
</html>