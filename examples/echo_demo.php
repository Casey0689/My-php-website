<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/27/2017
 * Time: 7:54 PM
 */
$age = 30;
echo "<h1>Hello</h1>";
$days_old = ( $age * 365 ) . " days old";
echo $days_old . "<br/>";

if ($age < 21){
  echo $age * 365;
} else {
  echo "Your age is: $age<br/>";
  echo "Your age is: " . $age . "<br/>";
}
$count = 0;
while($count < 10){
  echo $count;
  echo "<br>";
  $count += 1;
}
?>