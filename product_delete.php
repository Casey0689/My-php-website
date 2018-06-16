<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/23/2017
 * Time: 7:49 AM
 */

include 'templates/functions.php';
$db = db_connect();
$id = mysqli_real_escape_string($db, $_GET["id"]);

$sql = "DELETE FROM products WHERE id=$id";

if (isset($_SESSION['admin'])) {
  $result = $db->query($sql);
  if ($result) {
    header("Location: /products.php?msg=Product $id successfully deleted");
  } else {
    header("Location: /products.php?msg=Error deleting Product id:$id");
  }
}

include 'templates/footer.php';
?>