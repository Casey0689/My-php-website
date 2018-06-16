<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 4:14 PM
 */
session_start();
$title = "Products";
include 'templates/header.php';
include 'templates/functions.php';
?>
  <h1 class="animated wow fadeInLeft">Products Page</h1>
  <div id='product_table'>
    <?php
    $db = db_connect();
    $msg = mysqli_real_escape_string($db, $_GET["msg"]);

    $page = empty($_GET['page']) ? 1 : mysqli_real_escape_string($db, $_GET['page']);
    $perPage = empty($_GET['perPage']) ? 3 : mysqli_real_escape_string($db, $_GET['perPage']);
    $startRecord = ($page - 1) * $perPage;

    $sql = "SELECT count(*) FROM products";
    $result = $db->query($sql);
    $numRecords = $result->fetch_row()[0];

    $sql = "SELECT * FROM products LIMIT $perPage OFFSET $startRecord";
    // echo $sql . "<br/>"; // ONLY FOR DEBUGGING PURPOSES
    $result = $db->query($sql);

    $prevPage = $page - 1;
    if ($prevPage <= 0) {
      $prevPage = 1;
    }
    $nextPage = $page + 1;
    if ($nextPage >= ($numRecords / $perPage) + 1) {
      $nextPage = $page;
    }
    if (isset($_SESSION['admin'])) {
      echo "<h4><a href='product_new.php'>CREATE NEW PRODUCT</a></h4>";
    }

    $prevLink = "<a href='/products.php?perPage=$perPage&page=$prevPage'>Prev</a>";
    echo "<span>" . $prevLink . "</span>";

    $nextLink = "<a href='/products.php?perPage=$perPage&page=$nextPage'>Next</a>";
    echo "<span>" . $nextLink . "</span>";

    // HEREDOC
    $table = <<<END_OF_TABLE
<table class="products">
<p>$msg</p>
  <tr>
  <th>Photo</th>
  <th>Name</th>
  <th>Location</th>
  <th>Price Range Low</th>
  <th>Price Range High</th>
  <th>Tags</th>
  <th>Modified At</th>
  <th>Created At</th>
  </tr>
END_OF_TABLE;
    echo $table;
    while (list($id, $name, $location, $priceRangeLow, $priceRangeHigh, $tags, $modifiedAt, $createdAt, $image, $thumb_image) = $result->fetch_row()) {
      echo "<tr>
          <td><img src='/img/$thumb_image'</td><td><a href='/product.php?id=$id'>$name</a></td><td>$location</td><td>$$priceRangeLow</td>
          <td>$$priceRangeHigh</td><td>$tags</td><td>$modifiedAt</td><td>$createdAt</td>";
      if (isset($_SESSION['admin'])) {
        echo "<td><a href='/product_edit.php?id=$id'>Edit</a>/
          <a href='/product_delete.php?id=$id'>Delete</a>/<a href='/emailproduct.php?id=$id'>Email Details</a></td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    ?>
  </div>

<?php
include 'templates/footer.php';
?>