<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 4:17 PM
 */
ob_start();
session_start();
$title = "Login Page";
include 'templates/header.php';
include 'templates/functions.php';
$db = db_connect();
$submit = mysqli_real_escape_string($db, $_POST['submit']);

if (!empty($submit)) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $passwordConfirm = mysqli_real_escape_string($db, $_POST['passwordConfirm']);
  $newsletter = mysqli_real_escape_string($db, $_POST['newsletter']);

  $found_error = false;
  if (empty($name)) {
    $name_error = "Name required";
    $found_error = true;
  }
  if (empty($email)) {
    $email_error = "Email is required";
    $found_error = true;
  }
  if (empty($password)) {
    $password_error = "Password Required";
    $found_error = true;
  }
  if (empty($passwordConfirm)) {
    $passwordConfirm_error = "Password Confirmation Required";
    $found_error = true;
  }
  if (!$found_error) {
    if ($newsletter == "on") {
      $newsletter = 1;
    }
    if ($password == $passwordConfirm) {
      $sql = "SELECT email FROM users WHERE email=$email";
      $result = $db->query($sql);
      if ($result->num_rows == 0) {
        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (id, email, name, password, newsletter)
                            VALUES(NULL, '$email', '$name', '$encryptedPassword', '$newsletter')";
        $result = $db->query($sql);
        set_login($email, $name);
        ob_clean();
        header('Location: /');
      } else {
        $error_msg = "Username already exists. . try again!";
      }
    } else {
      $error_msg .= "<br>Passwords Do Not Match";
    }
  }
}

$reg_form = <<< END_OF_FORM
  <h1 class="animated wow fadeInLeft">Register</h1>
  <p class="error">$error_msg</p>
  <form method="post" action="register.php">
    <label for="name">Please Enter Your Name: </label>
    <input type="text" name="name" value=$name><span class="error">$name_error</span><br>
    <label for="email">Please Enter Your Email: </label>
    <input type="email" name="email" value=$email><span class="error">$email_error</span><br>
    <label for="password">Please Enter Your Password: </label>
    <input type="password" name="password"><span class="error">$password_error</span><br>
    <label for="password">Please Enter Your Password Again: </label>
    <input type="password" name="passwordConfirm"><span class="error">$passwordConfirm_error</span><br>
    <label for="newsletter">Subscribe to Newsletter? </label>
    <input type="checkbox" name="newsletter"><br>
    
    <input type="submit" name="submit" value="Register">
  </form>
END_OF_FORM;
echo $reg_form;

include 'templates/footer.php';
ob_end_flush();
?>