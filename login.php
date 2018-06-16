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

$email = mysqli_real_escape_string($db, $_POST['email']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$submit = mysqli_real_escape_string($db, $_POST['submit']);

if (!empty($submit)) {
  $sql = "SELECT * FROM users WHERE email='$email'";  // AND password='$password'";
  $result = $db->query($sql);
  list($id, $email, $name, $encrypted_password, $newsletter, $admin) = $result->fetch_row();

  if (password_verify($password, $encrypted_password)) {
    set_login($email, $name);
    if ($admin == 1) {
      $_SESSION['admin'] = "Administrator";
      ob_clean();
      header("Location: /");
    } else {
      ob_clean();
      header("Location: /");
    }
  } else {
    $_SESSION['email'] = "";
    $error_msg = "Unknown Credentials - Please Try Again.";
  }
}
//echo "$id: $email, $name, $password " . "<br>";
//echo password_hash("424242", PASSWORD_DEFAULT) . "<br>";

$login_form = <<< END_OF_FORM
  <h1 class="animated wow fadeInLeft">Login/Logout Page for users</h1>
  <p class="error">$error_msg</p>
  <form method="post" action="login.php">
    <label for="email">Please Enter Your Email: </label>
    <input type="email" name="email" value=$email><br>
    <label for="password">Please Enter Your Password: </label>
    <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Login">
  </form>
END_OF_FORM;
echo $login_form;

include 'templates/footer.php';
ob_end_flush();
?>