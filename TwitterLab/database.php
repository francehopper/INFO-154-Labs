<!doctype html>
<html>
<head>
    <title>Twitter Lab > Database</title>
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
$connection = mysqli_connect("localhost", "infousr", "D1oASa1", "info154.tweets") or die(mysqli_connect_error());
// check that connection was OK
// if (mysqli_connect_errno()) {
// 	echo "Uh oh. Something went wrong while connecting to the database: " . mysqli_connect_error();
// }
// if ($connection->connect_errno) {
//   printf("Connect failed: %s\n", $connection->connect_error);
// exit();
// }
// else {
// 	echo "mySQL connection OK.";
// }

// query the table
$result = mysqli_query($connection,"SELECT * FROM 'info154.tweets'");

// show results
while($row = mysqli_fetch_array($result)) {
	echo $row['text'];
	echo "<br>";
}

// INSERT INTO `info154`.`tweets` (`id`, `date`, `from_user_id`, `from_user_name`, `to_user_id`, `to_user_name`, `geo`, `profile_image_url`, `text`) VALUES ('1', '2014-08-04 00:00:00', '1234', 'foobar', '4321', 'barfoo', NULL, NULL, 'TESTING');

// close SQL connection
mysqli_close($connection);

// inserttweets();

?>
</body>
</html>