<?php
ob_start();
session_start();
include 'templates/header.php';
include 'templates/functions.php';
$db = db_connect();

$id = mysqli_real_escape_string($db, $_GET["id"]);

$sql = "SELECT * FROM products WHERE id=$id";
$result = $db->query($sql);
list($id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags) = $result->fetch_row();
echo "$id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags <br>";

$sql = "SELECT * FROM users WHERE newsletter=1";
$result = $db->query($sql);
list($user_id, $user_email, $user_name, $password, $newsletter) = $result->fetch_row();
echo "$user_id, $user_email, $user_name, $password, $newsletter <br>";

while (list($user_id, $user_email, $user_name, $password, $newsletter) = $result->fetch_row()) {
  $message = <<< END_OF_MESSAGE
Hello, $user_name
Here is the latest product.

$name:
Location: located at $location
Price Range: $priceRangeLow - $priceRangeHigh
END_OF_MESSAGE;
  echo $message;

  $to = $user_email;
  $subject = "New Product: $name";
  $headers = "From: playaround@caseyjohnson1989.com\r\n";
  $headers .= "BCC: dave.jones@scc.spokane.edu\r\n";
  $sent = mail($to, $subject, $message, $headers);
  echo "Got Here";
}
//ob_end_clean();
//header("Location: /product.php?id=$id");