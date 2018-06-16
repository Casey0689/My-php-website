<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/23/2017
 * Time: 8:12 AM
 */
ob_start();
include 'templates/header.php';
include 'templates/functions.php';
$db = db_connect();
$id = mysqli_real_escape_string($db, $_GET["id"]);
$submit = mysqli_real_escape_string($db, $_POST["submit"]);


if (empty($submit)) {
  $sql = "SELECT * FROM products WHERE id=$id";
  //echo $sql . "<br>";
  $result = $db->query($sql);
  list($id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt) = $result->fetch_row();
} else {
  $name = mysqli_real_escape_string($db, $_POST["name"]);
  $location = mysqli_real_escape_string($db, $_POST["location"]);
  $priceRangeLow = mysqli_real_escape_string($db, $_POST["priceRangeLow"]);
  $priceRangeHigh = mysqli_real_escape_string($db, $_POST["priceRangeHigh"]);
  $tags = mysqli_real_escape_string($db, $_POST["tags"]);
  // CHECK FOR ERRORS
  $found_error = false;
  if (empty($name)) {
    $name_error = "Name is required";
    $found_error = true;
  }
  if (empty($location)) {
    $location_error = "Location is required";
    $found_error = true;
  }
  if (!$found_error) {
    $modifiedAt = date_create()->format("Y-m-d H:i:s");
    $sql = "UPDATE products SET name='$name', location='$location', priceRangeLow='$priceRangeLow', priceRangeHigh='$priceRangeHigh', tags='$tags', modifiedAt='$modifiedAt' WHERE id='$id'";
    $result = $db->query($sql);
    ob_clean();
    header("Location: /product.php?id=$id");
  }
}
echo "<a href='/products.php'>BACK TO PRODUCTS</a>";
$form = <<<END_OF_FORM
<H2>Edit Product</H2>
<form method="POST" action="/product_edit.php?id=$id">
<label for="name">Name</label>
<input type="text" name="name" value="$name"><span class="error">$name_error</span><br/>
<label for="location">Location</label>
<input type="text" name="location" value="$location"><span class="error">$location_error</span><br/>
<label for="priceRangeLow">Low Price Range</label>
<input type="text" name="priceRangeLow" value="$priceRangeLow"><br/>
<label for="priceRangeHigh">High Price Range</label>
<input type="text" name="priceRangeHigh" value="$priceRangeHigh"><br/>
<label for="tags">Tags</label>
<input type="text" name="tags" value="$tags"><br/>

<input type="submit" name="submit" value="Save">
</form>

END_OF_FORM;
if (isset($_SESSION['admin'])) {
  echo $form;
}

include 'templates/footer.php';
ob_end_flush();
?>
