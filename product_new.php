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

$submit = $_POST["submit"];
$db = db_connect();

if (!empty($submit)) {
  $name = mysqli_real_escape_string($db, $_POST["name"]);
  $location = mysqli_real_escape_string($db, $_POST["location"]);
  $priceRangeLow = mysqli_real_escape_string($db, $_POST["priceRangeLow"]);
  $priceRangeHigh = mysqli_real_escape_string($db, $_POST["priceRangeHigh"]);
  $tags = mysqli_real_escape_string($db, $_POST["tags"]);

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
    $sql = "INSERT INTO `products` (`id`, `name`, `location`, `priceRangeLow`, `priceRangeHigh`, `tags`, `modifiedAt`, `createdAt`) VALUES (NULL, '$name', '$location', '$priceRangeLow', '$priceRangeHigh', '$tags', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    echo "$sql";
    $result = $db->query($sql);
    ob_clean();
    $prodId = $db->insert_id;
    header("Location: /product.php?id=$prodId");
  }
}
echo "<a href='/products.php'>BACK TO PRODUCTS</a>";
$form = <<<END_OF_FORM
<H2>ENTER A NEW PRODUCT</H2>
<form method="POST" action="/product_new.php">
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
