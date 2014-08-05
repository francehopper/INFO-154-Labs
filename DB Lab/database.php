<!doctype html>
<html>
<head>
    <title>Database Lab > Database.php</title>
</head>
<body>
<?php

/*class Database{
  var $db;

  function  _construct($dbname){
    $dsn='mysql:host=localhost:3306;dbname=' .$dbname;
    $username='root';
    $password='info154';

    try{
      $this->db= new PDO($dsn, $username, $password);
    }catch (PDOexception $e){
      echo '<br>The<b>' .$dbname. '</b> database does not exist. Creating it now...<b>';
      try{
        $this->db = new PDO('mysql:host=localhost:3306', $username, $password);
        $sql = "create schema info154;
                use info154;
                CREATE TABLE `info154`.`tweets` (
			  `id` VARCHAR(30) NOT NULL,
			  `date` DATETIME NOT NULL,
			  `from_user_id` INT NOT NULL,
			  `from_user_name` VARCHAR(45) NULL,
			  `to_user_id` INT NULL,
			  `to_user_name` VARCHAR(45) NULL,
			  `geo` VARCHAR(45) NULL,
			  `profile_image_url` VARCHAR(200) NULL,
			  `text` VARCHAR(150) NULL,
			  PRIMARY KEY (`id`, `date`, `from_user_id`));";
        $this->db->exec($sql);
        echo 'Done!<br>';
      }catch(PDOException $e){
        echo $e->getMessage();
        exit();
      }
    }
  }
db();*/

//  //Create connection
// $con=mysqli_connect("localhost:3306","infousr","D1oASa1","tweets");

// // Check connection
// if (mysqli_connect_errno()) {
// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
// 		echo "IT WORKS";
// };

//  function insertTweets($tweets){
//   $sql="INSERT INTO tweets
//         (username, date, text) VALUES (:text, :screen_name, :created_at)";

//         try{
//           $x=$this->db->prepare($sql);
//           foreach($tweets as $t){
//             $parameters = array(
//               ':text'=>$t->text,
//               ':screen_name'=>$t->username,
//               ':created_at'=>date('Y-m-d H:i:s',strotime($t->date)),
//               );
//             $x->execute($parameters);
//           }
          
//         }catch(PDOexception $e){
//            die('insert attempt failed' . $e->getMessage());
//           }

// }
// }

// Greg's stuff ^
// Stephen's stuff v

// connect to mySQL
$connection = mysqli_connect('totoro.hppr.co:3308', 'infousr', 'D1oASa1', 'info154') or die(mysqli_connect_error());

// DEBUG
// query the table
$result = mysqli_query($connection, "SELECT * FROM tweets"); // change to fetch historical search results later

// show results
echo "Historical tweets about Otakon <br />"; // to be updated?
while($row = mysqli_fetch_array($result)) {
  echo $row['user_name'] . " tweeted ";
	echo $row['tweet_text'];
  echo " on ";
  echo $row['tweet_time'];
	echo "<br>";
}
// END DEBUG

require_once('oauth/twitteroauth/twitteroauth.php'); // https://github.com/abraham/twitteroauth
// $searchString = $_GET['userString']; // search for the provide string
$searchString = "Otakon"; // temp; DEBUG

// don't be a dick by stealing my keys
define('CONSUMER_KEY', 'aqEWrdsZtvnWskYXZe0Ui1dAs');
define('CONSUMER_SECRET', 'VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt');
define('ACCESS_TOKEN', '16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg');
define('ACCESS_TOKEN_SECRET', 'F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO');

function runSearch(array $query) {
$conectionToTwitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET); // connect to Twitter API
return $conectionToTwitter->get('search/tweets', $query); // run our search query
}

$query = array (
"q" => "$searchString", // build the search query
);

echo "<p><a href=\"home.html\"><- Return home</a></p>";
echo "<p>Latest tweets about " . $searchString . "</p>";
$tweets = runSearch($query); // fetch tweets from our searchs

foreach ($tweets->statuses as $line) { // step through each returned tweet
  $status = $line->text; // strip the Tweet from the JSON
  $handle = $line->user->screen_name; // get the Twitter handle of the person that sent the tweet
  $tweetTime =  $line->created_at; // strip creation time from the JSON
  $tweetId = $line->id_str; // strip the tweet ID so we can link back to the source tweet
  $outputTweet = '<li><strong><a href="http://twitter.com/' . $handle .'">@' . $handle . "</a></strong>: " . $status .'</span> <a style="font-size:85%" href="http://twitter.com/'.$handle.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
  echo $outputTweet; // echo the tweet
  // write tweet to database
  mysqli_query($connection, "INSERT INTO tweets (tweet_id, tweet_text, user_name, tweet_time) VALUES ('','$status','$handle','$tweetTime')") or die (mysqli_error($connection));
  // Note: SQL is configured to enforce unique tweet IDs, so duplicates should never occur
}




// close SQL connection
mysqli_close($connection);

?>
</body>
</html>