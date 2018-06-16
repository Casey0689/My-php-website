<?php

include 'templates/functions.php';

$db = db_connect();
$submit = mysqli_real_escape_string($db, $_POST['submit']);
$blogIDFK = mysqli_real_escape_string($db, $_POST["blogIDFK"]);

$author = mysqli_real_escape_string($db, $_POST['author']);
$comment_text = mysqli_real_escape_string($db, $_POST['comment_text']);
$rating = mysqli_real_escape_string($db, $_POST['rating']);
if ($rating < 1) {
  $rating = 1;
}
if ($rating > 5) {
  $rating = 5;
}

$sql = "INSERT INTO comments (id, author, comment_text, rating, blogIDFK, created_at) 
          VALUES (NULL, '$author', '$comment_text', '$rating', '$blogIDFK', NOW())";
$result = $db->query($sql);

header("Location: /blog_show.php?id=$blogIDFK");

?>