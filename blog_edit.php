<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 11/17/2017
 * Time: 10:33 AM
 */
ob_start();
include 'templates/header.php';
include 'templates/functions.php';
$db = db_connect();
$id = mysqli_real_escape_string($db, $_GET["id"]);
$submit = mysqli_real_escape_string($db, $_POST["submit"]);

if (empty($submit)) {
  $sql = "SELECT * FROM blogs WHERE id=$id";
  $result = $db->query($sql);
  list($id, $title, $author, $date_posted, $blog_text) = $result->fetch_row();
} else {
  $title = mysqli_real_escape_string($db, $_POST["title"]);
  $author = mysqli_real_escape_string($db, $_POST["author"]);
  $date_posted = mysqli_real_escape_string($db, $_POST["date_posted"]);
  $blog_text = mysqli_real_escape_string($db, $_POST["blog_text"]);

  $found_error = false;
  if (empty($title)) {
    $title_error = "Title required";
    $found_error = true;
  }
  if (empty($author)) {
    $author_error = "Author is required";
    $found_error = true;
  }
  if (empty($date_posted)) {
    $date_posted_error = "Specify a Date to Post";
    $found_error = true;
  }
  if (empty($blog_text)) {
    $text_error = "Enter your Blog";
    $found_error = true;
  }
  if (!$found_error) {
    $sql = "UPDATE blogs SET title='$title', author='$author', date_posted='$date_posted', blog_text='$blog_text' WHERE id='$id'";
    $result = $db->query($sql);
    ob_clean();
    header("Location: /blog_all.php");
  }
}
include 'templates/blog_form_edit.php';
include 'templates/footer.php';
ob_end_flush();