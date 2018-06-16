<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/23/2017
 * Time: 7:49 AM
 */
session_start();
include 'templates/header.php';
include 'templates/functions.php';
?>
  <h4>Product Info</h4>

<?php
$db = db_connect();
$id = mysqli_real_escape_string($db, $_GET["id"]);

$sql = "SELECT AVG(rating) FROM reviews WHERE productIDFK=$id";
$result = $db->query($sql);
$avg_rating = 0;
if ($result) {
  $avg_rating = $result->fetch_row()[0];
}
$stars = str_repeat('<img src="/img/star.png" height="25" width="25" />', $avg_rating);


$sql = "SELECT * FROM products WHERE id=$id";
$result = $db->query($sql);
list($id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt, $image, $thumb_image) = $result->fetch_row();

$detail = <<<END_OF_DETAL
<a href="/products.php">Back to Products</a>
<p>Average Rating: $stars</p>
<h2>$name</h2>
Located at: <h4>$location</h4>
Low Price Ranges Around: <h4>$$priceRangeLow</h4>
High Price Ranges Around: <h4>$$priceRangeHigh</h4>
Special Tags: <h4>$tags</h4>
Modified: <h4>$modifiedAt</h4>
Created: <h4>$createdAt</h4>
<p><img src="/img/$image"</p><br>

END_OF_DETAL;
echo $detail;
if (isset($_SESSION['admin'])) {
  echo "<h5><a href=\"product_edit.php?id=$id\">Edit this Product</a></h5>";
}

$sql = "SELECT * FROM reviews WHERE productIDFK=$id";
$result = $db->query($sql);
while (list($product_id, $author, $review, $rating, $created_at, $productIDFK) = $result->fetch_row()) {
  $stars = str_repeat('<img src="img/star.png" height="25" width="25" />', $rating);
  echo $stars . "<br>";
  echo time_elapsed_string($created_at);
  $review_text = <<< END_OF_REVIEW
<div>
  $author says: <p> $review </p> 
</div>
<hr>
END_OF_REVIEW;
  echo $review_text;
}

$review_form = <<< END_OF_FORM
<form method="post" action="products_new_review.php">
Author: <br><input type="text" name="author"><br>
Review: <br><textarea name="review_text" placeholder="Enter your Review..."></textarea><br>
Rating: <br><input type="number" name="rating" max="5" min="1"><br>
<input type="hidden" name="productIDFK" value="$id"><br>

<input type="submit" name="submit" value="Post Review">
</form>
END_OF_FORM;
echo $review_form;

if (isset($_SESSION['admin'])) {
  echo "<a href='/emailproduct.php?id=$id'>Email Details</a>";
}
include 'templates/footer.php';
?>