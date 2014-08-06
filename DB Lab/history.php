<!doctype html>
<html>
<head>
    <title>Database Lab > Historical Tweets</title>
</head>
<body>
<?php
$searchString = $_GET['userString']; // search for the provided string
// connect to mySQL
$connection = mysqli_connect('totoro.hppr.co:3308', 'infousr', 'D1oASa1', 'info154') or die(mysqli_connect_error());

// query the table
$theQuery = 'select * from tweets where tweet_text like \'%'.$searchString.'%\''; // build SQL table query
$result = mysqli_query($connection, $theQuery) or die(mysqli_error($connection)); // perform query

// render navigation
echo "<a href=\"home.html\"><- Return home</a>";
echo " | ";
echo "<a href=\"liveSearch.php?userString=$searchString\">View the latest tweets about $searchString</a><br />";

// show results
echo '<strong><p>Historical tweets about '.$searchString.':</p></strong>'; // render header
echo '<ul>'; // start list formating
while($row = mysqli_fetch_array($result)) {
  // display saved tweets
  echo '<li><strong><a href="http://twitter.com/'.$row['user_name'].'">@'.$row['user_name'].'</a></strong> tweeted '.$row['tweet_text'].' on '.$row['tweet_time'].'</li>';
}
echo '</ul>'; // end list


// $outputTweet = '<li><strong><a href="http://twitter.com/' . $handle .'">@' . $handle . "</a></strong>: " . $status .'</span> <a style="font-size:85%" href="http://twitter.com/'.$handle.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
// close SQL connection
mysqli_close($connection);

?>
</body>
</html>