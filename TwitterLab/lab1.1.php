<!doctype html>
<html>
<head>


</head>
<body>
<?php

//The code below checks to see if the variable is set for the form word.

$userWord = "";

 if (isset($_GET['word'])) {
       $userWord =$_GET['word'];
     } else {
        $userWord = "";
     }

//The code below checks to see if the variable is set for the form num.

$userNum = "";

  if (isset($_GET['num'])) {
       $userNum =$_GET['num'];
     } else {
        $userNum = "";
     }

//The code below checks to see if the variable is set for the form mix.

$userMix = "";

  if (isset($_GET['mix'])) {
       $userMix =$_GET['mix'];
     } else {
        $userMix = "";
     }

//The following fucntion checks to see it the input from form word
//is all letters.

   function word($x) {

          $message = "";
          //The str_replace below here is to replace all punctuation with nothing.
          //This will allow full sentences to be entered. 
          $x = str_replace(array("?", "!", ",", ".", " "), "" , $x);
          
          //The following IF statement checks to see if the string is made up of all letters.
          //It will then prompt if all letters, or not all letters. 

          if(ctype_alpha($x)) {
          $message = "All letters";

          }else{

            $message = "Not all letters";

          }
          return $message;
        }

//The following functiong check to see if the input from form num
//is all numbers. 

    function num($y) {

          $message = "";

        //The following string deletes math symbols.

          $y = str_replace(array("+", "=", "-", "/", "*", "$", "%", ",", ".", " "), "" , $y);


          //The following IF statement checks the string to see if it is all numbers.
          //If the string is all numbers, it will message all numbers.

          if(ctype_digit($y)) {

          $message = "all numbers";

          } else {

            $message = "Not all numbers";

          }
          return $message;
        }

//The following function checks to see if the string is a mix of numbers and digits.


      function mix($z) {
        
        $message = "";
        
        //The following string checks the input for punctuation and math symbols and replaces it with nothing.

         $z = str_replace(array("?", "!", ",", ".", " ", "+", "=", "-", "/", "*", "$", "%"), "" , $z);
        
        //The following set of IF statements check to see if the input string 
        //Is a mix of numbers and letters. 

        if(ctype_alpha($z)) {

          $message = "not mix";
        
        }else{
          
          if(ctype_digit($z)) {
            
            $message = "not mix";
          
          }else{
            
            $message = "mix";
          }
        }
        
        return $message;
      }

    function get_bananas() {
    $i; //declare $i variable
        echo "<pre>
//\
V  \
 \  \_
  \,'.`-.
   |\ `. `.
   ( \  `. `-.                        _,.-:\
    \ \   `.  `-._             __..--' ,-';/
     \ `.   `-.   `-..___..---'   _.--' ,'/
      `. `.    `-._        __..--'    ,' /
        `. `-_     ``--..''       _.-' ,'
          `-_ `-.___        __,--'   ,'
             `-.__  `----\"\"\" __.-'
hh                `--..____..--' <pre> ";

}

get_bananas();
   ?>


      <form action="#" method="GET">
      word: <input type="text" value="<?php echo $userWord ?>" name="word">
      <?php echo word($userWord); ?>
      </form>

      <form action="#" method="GET">
      num: <input type="text" value="<?php echo $userNum ?>" name="num">
      <?php echo num($userNum); ?>
      </form>

       <form action="#" method="GET">
      mix: <input type="text" value="<?php echo $userMix ?>" name="mix">
      <?php echo mix($userMix); ?>
      </form>



</body>
</html>