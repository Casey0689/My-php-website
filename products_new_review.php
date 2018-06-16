<?php

include 'templates/functions.php';

$db = db_connect();
$submit = mysqli_real_escape_string($db, $_POST['submit']);
$productIDFK = mysqli_real_escape_string($db, $_POST["productIDFK"]);

$author = mysqli_real_escape_string($db, $_POST['author']);
$review_text = mysqli_real_escape_string($db, $_POST['review_text']);
$rating = mysqli_real_escape_string($db, $_POST['rating']);
if ($rating < 1) {
  $rating = 1;
}
if ($rating > 5) {
  $rating = 5;
}

$sql = "INSERT INTO reviews (id, author, review, rating, created_at, productIDFK) 
          VALUES (NULL, '$author', '$review_text', '$rating', NOW(), '$productIDFK')";
$result = $db->query($sql);
#echo $sql;

header("Location: /product.php?id=$productIDFK");

?>