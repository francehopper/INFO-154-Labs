<!doctype html>
<html>
<head>
    <title>Twitter Lab > Search for Tweets</title>
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
        $sql = "create database twitter;
                use twitter;
                create table tweets2 (
                id VARCHAR(30)NOT NULL, 
                date DateTime,
                from_user_id INT,
                from_user_name VARCHAR(30),
                to_user_id INT,
                to_user_name VARCHAR(30),
                geo VARCHAR(30),
                profile_image_url VARCHAR(200),
                text VARCHAR(150),
                PRIMARY KEY(id, date, from_user_id);
                )";
        $this->db->exec($sql);
        echo 'Done!<br>';
      }catch(PDOException $e){
        echo $e->getMessage();
        exit();
      }
    }
  }
db();*/
 //Create connection
$con=mysqli_connect("localhost:3306","root","info154","tweets");

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "IT WORKS";
};

 function insertTweets($tweets){
  $sql="INSERT INTO tweets2
        (username, date, text) VALUES (:text, :screen_name, :created_at)";

        try{
          $x=$this->db->prepare($sql);
          foreach($tweets as $t){
            $parameters = array(
              ':text'=>$t->text,
              ':screen_name'=>$t->username,
              ':created_at'=>date('Y-m-d H:i:s',strotime($t->date)),
              );
            $x->execute($parameters);
          }
          
        }catch(PDOexception $e){
           die('insert attempt failed' . $e->getMessage());
          }

}
}

inserttweets();

?>
</body>
</html>