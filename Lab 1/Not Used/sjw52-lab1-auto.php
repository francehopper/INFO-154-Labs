<!doctype html>
<html>
<head>
	<title>Lab 1</title>
</head>
<body>
	<?php

	function activate_auto() {
		if(isset($_GET['auto_mode']))
		{
			auto_test();
		}
	}

function auto_test() {
	$tests = array(
    "123",
    "0123456789",
    "-1",
    "-2",
    "1-",
    "1+",
    "123A",
    "X040",
    "$123",
    "12+34",
    "12-34",
    "+12+",
    "+-123",
    "+",
    "123.45",
    ".34",
    "-.34",
    ".-4"

);
}

	getString(); // call the getString function to begin processing via PHP
	function getString() {
		if ( ! empty($_GET['userString'])) {
			$userString = $_GET['userString']; // if a string was input, get the string
			isItANumber($userString); // check if the string is a number
		}
} // end getString function

function isItANumber($userString) { // this function checks if the string is a number
	$stripComma = str_replace( ',', '', $userString ); // strip comma to accept numbers with a comma
	if (is_numeric($stripComma)) { // use PHP5's built-in number checker
	echo "'{$userString}' is a valid number.", PHP_EOL;
}
	else { // the string is not a valid number, so check if it is a valid alpha string
		isItAlpha($userString); // check if the string is alpha
	}
} // end isItANumber function

function isItAlpha($userString) { // this function checks if the string contains only characters of the alphabet
	if (ctype_alpha($userString)) { // use PHP's built-in alpha check
	echo "'{$userString}' contains only alpabetic characters.", PHP_EOL;
	isSecret($userString);
}
	else { // the string is neither alpha nor numeric
		echo "The string is neither only numbers nor only alpabetic.";
		// isSecret($userString);
		// function to check for mixed in the fucture?
	}
} // end isItAlpha function

function isSecret($userString) { // it's a secret to everyone
if ($userString=="upupdowndownleftrightleftrightbaselectstart") {
	echo "<br />Cheater!<br />You got thirty lives!";
}
} // end isSecret function

?>
<!-- All PHP should be done at this point! -->

<!-- Build a form -->
<form action="sjw52-lab1.php" method="get">
	Enter a string to check: <input type="text" name="userString"><br>
	<input type="submit">
</form>
<form method="get">
	Automate testing: <input type="hidden" name="auto_mode"><br>
	<input type="submit">
</form>
<p><a href="http://totoro.hppr.co/info154/sjw52-lab1.php">RESET</a></p>
<p><a href="http://totoro.hppr.co/info154/sjw52-lab1-auto.php">Automate testing</a></p>
</body>
</html>