<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/23/2017
 * Time: 7:49 AM
 */
include 'templates/header.php';
include 'templates/functions.php';
echo "<hr>";
$db = db_connect();
$id = mysqli_real_escape_string($db, $_GET["id"]);

$sql = "SELECT AVG(rating) FROM comments WHERE blogIDFK=$id";
$result = $db->query($sql);
$avg_rating = 0;
if ($result) {
  $avg_rating = $result->fetch_row()[0];
}
$stars = str_repeat('<img src="/img/star.png" height="25" width="25" />', $avg_rating);

$sql = "SELECT * FROM blogs WHERE id=$id";
$result = $db->query($sql);
list($id, $title, $author, $date_posted, $blog_text) = $result->fetch_row();

$detail = <<<END_OF_DETAL
<a href="/blog_all.php">See All Blogs</a>
<p>Average Rating: $stars</p>
<h1>$title</h1>
<h2>Written By: $author</h2>
<h3>Posted On: $date_posted</h3>
<h4>$blog_text</h4>
END_OF_DETAL;
echo $detail;
if (isset($_SESSION['admin'])) {
  echo "<h5><a href=\"blog_edit.php?id=$id\">Edit this Blog</a></h5>";
}
echo "<hr>";

$sql = "SELECT * FROM comments WHERE blogIDFK=$id";
$result = $db->query($sql);
while (list($commentId, $author, $comment_text, $rating, $blogIDFK, $created_at) = $result->fetch_row()) {
  $stars = str_repeat('<img src="img/star.png" height="25" width="25" />', $rating);
  echo $stars . "<br>";
  echo time_elapsed_string($created_at);
  $review_text = <<< END_OF_REVIEW
<div>
  <br>$author says: <p> $comment_text </p> 
</div>
<hr>
END_OF_REVIEW;
  echo $review_text;
}


$review_form = <<< END_OF_FORM
<form method="post" action="blog_new_review.php">
Author: <br><input type="text" name="author"><br>
Comment: <br><textarea name="comment_text" placeholder="Enter Your Comments..."></textarea><br>
Rating: <br><input type="number" name="rating"><br>
<input type="hidden" name="blogIDFK" value="$id"><br>

<input type="submit" name="submit" value="Post Comment">
</form>
END_OF_FORM;
if (isset($_SESSION['admin'])) {
  echo $review_form;
}
include 'templates/footer.php';
?>