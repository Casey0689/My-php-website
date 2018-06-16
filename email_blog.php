<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 11/27/2017
 * Time: 2:47 PM
 */
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
  include 'templates/header.php';
  include 'templates/functions.php';
  $db = db_connect();
  $id = mysqli_real_escape_string($db, $_GET["id"]);

  $sql = "SELECT * FROM blogs WHERE id=$id";
  $result = $db->query($sql);
  list($blog_id, $title, $author, $date_posted, $blog_text) = $result->fetch_row();

  $sql = "SELECT * FROM users";
  $result = $db->query($sql);
  while (list($user_id, $email, $name, $password, $newsletter, $admin) = $result->fetch_row()) {
    $message = <<< END_OF_MESSAGE
Hello, $name
Here is the latest Blog.
Title: $title 
By: $author 
$blog_text
END_OF_MESSAGE;
    echo $message;

    $to = $email;
    $subject = "Latest Blog: $title";
    $headers = "From: playaround@caseyjohnson1989.com\r\n";
    $headers .= "BCC: dave.jones@scc.spokane.edu\r\n";
    $sent = mail($to, $subject, $message, $headers);
    ob_end_clean();
    header("Location: /blog_all.php?");
  }

  include 'templates/footer.php';
  ob_end_flush();
}

?>