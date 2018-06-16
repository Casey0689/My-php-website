<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 4:14 PM
 */
$title = "Blog";
include 'templates/header.php';
include 'templates/functions.php';
?>
<h1 class="animated wow fadeInLeft">Blogs</h1>
<?php

$db = db_connect();
$sql = "SELECT * FROM blogs ORDER BY date_posted DESC LIMIT 1";
$result = $db->query($sql);
list($id, $title, $author, $date_posted, $blog_text) = $result->fetch_row();

$detail = <<<END_OF_DETAL
<a href="/blog_all.php">See All Blogs</a>
<h1>$title</h1>
<h2>Written By: $author</h2>
<h3>Posted on: $date_posted</h3>
<h4>$blog_text</h4>
END_OF_DETAL;
echo $detail;
if (isset($_SESSION['admin'])) {
  echo "<h3><a href='blog_create.php'>Create a New Blog</a></h3>";
}

include 'templates/footer.php';
?>
