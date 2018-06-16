<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/23/2017
 * Time: 7:49 AM
 */
include 'templates/header.php';
include 'templates/functions.php';
?>
  <h1>All Articles</h1>
<?php

$db = db_connect();
$sql = "SELECT * FROM articles";
$result = $db->query($sql);

$msg = mysqli_real_escape_string($db, $_GET['msg']);
if (isset($_SESSION['admin'])) {
  echo "<h3><a href='articles_create.php'>WRITE A NEW ARTICLE</a></h3>";
}
$table = <<<END_OF_TABLE
<p>$msg</p>
<table class="articles">
  <tr>
  <th>Title</th>
  <th>Author</th>
  <th>Publish Date</th>
  </tr>
END_OF_TABLE;
echo $table;
while (list($id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row()) {
  echo "<tr>
          <td><a href='/articles_show.php?id=$id'>$title</a></td><td>$author</td><td>$published_date</td>";
  if (isset($_SESSION['admin'])) {
    echo "<td><a href='/articles_edit.php?id=$id'>Edit</a>/<a href='/articles_delete.php?id=$id'>Delete</a></td>";
  }
  echo "</tr>";

}
echo "</table>";
include 'templates/footer.php';
?>