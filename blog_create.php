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
    $sql = "INSERT INTO `blogs` (`id`, `title`, `author`, `date_posted`, `blog_text`) VALUES (NULL, '$title', '$author', '$date_posted', '$blog_text')";
    $result = $db->query($sql);
    ob_clean();
    $blogId = $db->insert_id;

    $sql = "SELECT * FROM users WHERE newsletter=1";
    $result = $db->query($sql);
    while (list($user_id, $email, $name, $password, $newsletter, $admin) = $result->fetch_row()) {
      $message = <<< END_OF_MESSAGE
New Blog For: $name
This blog was just posted!
Title: $title
By: $author
$blog_text
END_OF_MESSAGE;
      $to = $email;
      $subject = $title;
      $headers = "From: playaround@caseyjohnson1989.com\r\n";
      $headers .= "BCC: dave.jones@scc.spokane.edu\r\n";
      $sent = mail($to, $subject, $message, $headers);
    }
    header("Location: /blog_all.php?id=$blogId");
  }
}
include 'templates/blog_form_create.php';
include 'templates/footer.php';
ob_end_flush();
?>
