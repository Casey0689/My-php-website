<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 4:17 PM
 */
ob_start();
$title = "Preferences";
include 'templates/header.php';
include 'templates/functions.php';
?>
<h1 class="animated wow fadeInLeft">Preferences</h1>
<h3>Fill out the form below to subscribe for a Newsletter!</h3>
<?php
$db = db_connect();
$submit = mysqli_real_escape_string($db, $_POST['submit']);
$user_name = mysqli_real_escape_string($db, $_POST['user_name']);
$user_email = mysqli_real_escape_string($db, $_POST['user_email']);
$user_newsletter = mysqli_real_escape_string($db, $_POST['user_newsletter']);
if ($user_newsletter == "on") {
  $user_newsletter = 1;
} else {
  $user_newsletter = 0;
}
if (!empty($submit)) {
  if ($user_email == $_SESSION['email'] && $user_name == $_SESSION['name']) {
    $sql = "SELECT * FROM users WHERE email='$user_email'";
    $result = $db->query($sql);
    list($id, $email, $name, $password, $newsletter, $admin) = $result->fetch_row();
    $sql = "UPDATE users SET newsletter='$user_newsletter' WHERE id='$id'";
    $result = $db->query($sql);
    ob_clean();
    header("Location: /index.php?msg=Your Preferences Have Been Updated!");
  } else {
    echo "<span class='error'>Invalid Credentials, Try Again...</span>";
  }
}

$subscribeForm = <<< END_OF_FORM
<form method="post" action="/preferences.php"
<label for="name">Name: </label>
<input type="text" name="user_name" value="$user_name"><br>
<label for="email">Email: </label>
<input type="email" name="user_email" value="$user_email"><br>
<label for="newsletter">Subscribe for Newsletter?</label>
<input type="checkbox" name="user_newsletter"><br>
<input type="submit" name="submit" value="Save Changes">
</form>
END_OF_FORM;
echo $subscribeForm;

include 'templates/footer.php';
ob_end_flush();
?>
