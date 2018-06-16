<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 11/17/2017
 * Time: 10:13 AM
 */
include 'templates/header.php';
include 'templates/functions.php';
?>
  <h1>All Blogs</h1>
<?php
$db = db_connect();
$sql = "SELECT * FROM blogs";
$result = $db->query($sql);

$msg = mysqli_real_escape_string($db, $_GET['msg']);
if (isset($_SESSION['admin'])) {
  echo "<h4><a href='blog_create.php'>CREATE A NEW BLOG</a></h4>";
}
$table = <<<END_OF_TABLE
<p>$msg</p>
<table class="articles">
  <tr>
  <th>Title</th>
  <th>Author</th>
  <th>Date</th>
  </tr>
END_OF_TABLE;
echo $table;
while (list($id, $title, $author, $date_posted, $blog_text) = $result->fetch_row()) {
  echo "<tr>
          <td><a href='/blog_show.php?id=$id'>$title</a></td><td>$author</td><td>$date_posted</td>";
  if (isset($_SESSION['admin'])) {
    echo "<td><a href='/blog_edit.php?id=$id'>Edit</a>/<a href='/blog_delete.php?id=$id'>Delete</a>/
            <a href='email_blog.php?id=$id'>Email</a></td>";
  }
  echo "</tr>";
}
echo "</table>";
include 'templates/footer.php';
?>