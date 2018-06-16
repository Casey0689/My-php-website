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
  <h2>Article Info</h2>
<?php
$db = db_connect();
$id = mysqli_real_escape_string($db, $_GET["id"]);
$sql = "SELECT * FROM articles WHERE id=$id";
$result = $db->query($sql);
list($id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row();

$detail = <<<END_OF_DETAL
<a href="/articles_all.php">See All Articles</a>
<h1>$title</h1>
<h2>Written By: $author</h2>
<h3>$article_text</h3>
<h4>Published on: $published_date</h4>
END_OF_DETAL;
echo $detail;
if (isset($_SESSION['admin'])) {
  echo "<h5><a href='articles_edit.php?id=$id'>Edit this Article</a></h5>";
}
?>

<?php
include 'templates/footer.php';
?>