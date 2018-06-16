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
  $sql = "SELECT * FROM articles WHERE id=$id";
  $result = $db->query($sql);
  list($id, $title, $author, $article_text, $published_date, $modified_at, $created_at) = $result->fetch_row();
} else {
  $title = mysqli_real_escape_string($db, $_POST["title"]);
  $author = mysqli_real_escape_string($db, $_POST["author"]);
  $published_date = mysqli_real_escape_string($db, $_POST["published_date"]);
  $article_text = mysqli_real_escape_string($db, $_POST["article_text"]);

  $found_error = false;
  if (empty($title)) {
    $title_error = "Title required";
    $found_error = true;
  }
  if (empty($author)) {
    $author_error = "Author name is required";
    $found_error = true;
  }
  if (empty($published_date)) {
    $published_error = "Specify a date to Publish";
    $found_error = true;
  }
  if (empty($article_text)) {
    $text_error = "Enter some Article Content";
    $found_error = true;
  }
  if (!$found_error) {
    $modified_at = date_create()->format("Y-m-d H:i:s");
    $sql = "UPDATE articles SET title='$title', author='$author', article_text='$article_text', published_date='$published_date', modified_at='$modified_at' WHERE id='$id'";
    $result = $db->query($sql);
    ob_clean();
    header("Location: /articles_all.php");
  }
}
include 'templates/article_form_edit.php';
include 'templates/footer.php';
ob_end_flush();
?>
