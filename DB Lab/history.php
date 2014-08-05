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
echo "<a href=\"liveSearch.php?userString=".$searchString."\">View the latest tweets about ".$searchString."</a><br />";

// show results
echo "<strong><p>Historical tweets about ".$searchString.":</p></strong><br />"; // render header
echo "<ul>"; // start list formating
while($row = mysqli_fetch_array($result)) {
  echo "<li>"; // begin new list item
  echo "<strong>@".$row['user_name'] . " </strong>tweeted "; // get who tweeted
	echo $row['tweet_text']; // get what they tweeted
  echo " on ";
  echo $row['tweet_time']; // get when they tweeted
	echo "<br>";
  echo "</li>"; // end list item
}
echo "</ul>"; // end list

// close SQL connection
mysqli_close($connection);

?>
</body>
</html>