<!doctype html>
<html>
<head>
    <title>Twitter Lab > Search for Tweets</title>
</head>
<body>
<?php
// Create connection
$con=mysqli_connect("localhost:3306","root","info154","tweets");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
	echo "IT WORKS";
};



?>
</body>
</html>