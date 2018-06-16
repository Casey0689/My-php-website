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
$submit = mysqli_real_escape_string($db, $_POST["submit"]);

if (!empty($submit)) {
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
    $sql = "INSERT INTO `articles` (`id`, `title`, `author`, `article_text`, `published_date`, `modified_at`, `created_at`) VALUES (NULL, '$title', '$author', '$article_text', '$published_date', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    echo "$sql";
    $result = $db->query($sql);
    ob_clean();
    $articleId = $db->insert_id;
    header("Location: /articles_all.php?id=$articleId");
  }
}
include 'templates/article_form_create.php';
include 'templates/footer.php';
ob_end_flush();
?>
