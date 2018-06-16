<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/23/2017
 * Time: 7:49 AM
 */
$title = 'Articles';
include 'templates/header.php';
include 'templates/functions.php';
?>
  <h2>Articles</h2>
<?php
$db = db_connect();
$sql = "SELECT * FROM articles ORDER BY published_date DESC LIMIT 1";
$result = $db->query($sql);
list($id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row();

$detail = <<<END_OF_DETAL
<a href="/articles_all.php">See All Articles</a>
<h1>$title</h1>
<h2>Written By: $author</h2>
<h3>$article_text</h3>
<h4>Published on: $published_date</h4>
END_OF_DETAL;
if(isset($_SESSION['admin'])){
  echo "<h3><a href='articles_create.php'>WRITE A NEW ARTICLE</a></h3>";
}
echo $detail;

include 'templates/footer.php';
?>