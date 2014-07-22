<!doctype html>
<html>
<head>
<title>Twitter Lab > Get Tweets From A User</title>
</head>
<body>
<?php
    // In loving memory of Gregory Woods' brain after realizing it was a XAMPP issue. And for the initial suffering and code shell.
    // require_once('banana.php'); // debug
    require_once('oauth/twitteroauth/twitteroauth.php'); // https://github.com/abraham/twitteroauth
    $userName = $_GET['userString']; // get the searched for user name
    // don't be a dick by stealing my keys
    // We'll define the key values in case we need to share them across functions in the future
    define('CONSUMER_KEY', 'aqEWrdsZtvnWskYXZe0Ui1dAs');
    define('CONSUMER_SECRET', 'VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt');
    define('ACCESS_TOKEN', '16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg');
    define('ACCESS_TOKEN_SECRET', 'F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO');
    

    // get the user's tweets
    function getTweets($userName) { 
        $returnedTweetsLimit = 20; // limit the number of returned tweets since JSON will hit a limit eventually anyway
        // don't be a dick by stealing my keys
        // disabled now that they are defined but left as a just-in-case fallback
        // $consumerkey = "aqEWrdsZtvnWskYXZe0Ui1dAs";
        // $consumersecret = "VCtIhC9mUrAOlljEIhPJ98msypf5WgNofTxt0F7COFYohUiFZt";
        // $accesstoken = "16427456-US1fjrhTqtBu3gj6Yg4H3u7gSYLFKVPxX0SVherWg";
        // $accesstokensecret = "F72MrewmUhSlU9SkWY1dzEkkiB7sl47KrRDX4PMk91DhO";
          
        // function connectToTwitter($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
        function connectToTwitter() {
          $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET); // connect to Twitter via OAuth
          return $connection; // return the connection so we can use it
        }
           
        // $connection = connectToTwitter($consumerkey, $consumersecret, $accesstoken, $accesstokensecret); // call Twitter connection function
        $connection = connectToTwitter();
        // hopefully connection worked
        $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$userName."&count=".$returnedTweetsLimit); // get the tweets for the specified user
         
        return ($tweets);
    }


// This was an attempt to handle users that don't exist. It doesn't work.
//     function find_users(array $users)
//     {
//         $foundUser = array();

//         $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

//     // Up to 100 users per request.
//         $userAry = array_slice($users, 0, 100);

//     // Init with "not found" for all users.
//         foreach ($userAry as $user) {
//             $foundUser[$user] = false;
//         }

//     // Find existing users by "screen_name".
//         $userObjs= $toa->post('users/lookup', array('screen_name' => implode(',', $userAry)));

//     // Set "found" for existing users.
//         foreach ($userObjs as $userObj) {
//             $foundUser[$userObj->screen_name] = true;
//         }

// if (count(array_unique($foundUser)) === 1 && $foundUser[0] === 'false') {
//     echo 'User does not exist.';

// }

//         return $foundUser;
//     }
//     $users = array($userName);
//     $foundUser = find_users($users);
//     var_dump($foundUser);
    
    echo "<p><a href=\"home.html\"><- Return home</a></p>";
    echo "<p>Tweets by <a href=\"http://twitter.com/".$userName."\">@" . $userName . "</a></p>";
    echo "<p><strong>Note:</strong> If you see the message 'Notice: Trying to get property of non-object in...' you are probably looking for a user that doesn't exist. Please try again.</p>";
    $tweets = getTweets($userName); // call the function to fetch user tweets
    foreach ($tweets as $line) { // step through each returned tweet
        $status = $line->text; // strip the Tweet from the JSON
        $tweetTime =  $line->created_at; // strip creation time from the JSON
        $tweetId = $line->id_str; // strip the tweet ID so we can link back to the source tweet
        $outputTweet = '<li>'.$status.'</span> <a style="font-size:85%" href="http://twitter.com/'.$userName.'/statuses/'.$tweetId.'">'. $tweetTime .'</a></li>'; // Render our beautiful new tweet
        echo $outputTweet; // echo the tweet
    }

    

    // DEBUG
    // get_bananas();
    // echo '<p>Anything below this line is for debug purposes. Nothing to see here.</p><br />';
    // echo '<br /><img src="test.gif">'; // if this line returns an image, PHP is writing properly AND permisions are OK. Probabaly.
?>
</body>
</html>