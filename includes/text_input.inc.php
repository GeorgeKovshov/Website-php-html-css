<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
 $description = $_POST["game_description"];
 $filename = 'myfile.txt';
  if(!file_put_contents($filename, $description)){
   // overwriting the file failed (permission problem maybe), debug or log here
  }
  //$pdo = null;
}
header("Location: ../test_text.php");
die();



?>