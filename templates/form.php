<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 10/2/2017
 * Time: 7:39 AM
 */

$name = $_POST['name'];
$name_Error = "";
$email = $_POST['email'];
$email_Error = "";
$phone = $_POST["phone"];
$question = $_POST['question'];
$newsletter = $_POST['newsletter'];
$new_product = $_POST['new_product'];
$contact = $_POST['contact'];
$product = $_POST['product'];
$products = array("Snow Board", "Snow Skis", "Boots", "Gloves", "Goggles");
$submit = $_POST["submit"];
if (empty($name)) {
  $name_Error = "Name is Required!<br/>";
}
if (empty($email)) {
  $email_Error = "Please enter your Email!<br/>";
}
$subscribed = '';
if ($newsletter == "subscribed") {
  $subscribed = 'checked="checked"';
}
$new_product_Subscribed = '';
if ($new_product == "subscribed") {
  $new_product_Subscribed = 'checked="checked"';
}
?>
<div class="animated wow fadeInLeft">
  <form action="/contactus.php" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $name ?>"><br/>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $email ?>"><br/>

    <label for="phone">Phone Number:</label>
    <input type="tel" name="phone" id="phone" value="<?php echo $phone ?>"><br/>

    <label for="question">Question:</label><br/>
    <textarea name="question" value="<?php echo $question ?>"><?php echo $question ?></textarea><br/>

    <label for="newsletter">Subscribe to Newsletter:</label>
    <input type="checkbox" name="newsletter" value="subscribed" <?php echo $subscribed ?>><br/>

    <label for="new_product">Notify when products are added:</label>
    <input type="checkbox" name="new_product" value="subscribed" <?php echo $new_product_Subscribed ?>><br/>

    <label for="contact">Contact me by Phone:</label>
    <input type="radio" name="contact" value="phone"><br/>

    <label for="contact">Contact me by Email:</label>
    <input type="radio" name="contact" value="email"><br/>

    <?php
    CreateSelectBox($products, $product, "product");
    ?><br/>

    <input type="submit" name="submit" id="submit" value="Submit"><br/>
  </form>
  <?php
  if (!empty($submit)) {
    if (empty($name)) {
      echo "<h4 style='color: red;'>$name_Error</h4>";
    }
    if (empty($email)) {
      echo "<h4 style='color: red;'>$email_Error</h4>";
    }
    if (!empty($name) && !empty($email)) {
      # Send Out Thank You Email
      $to = $email;
      $subject = 'Thank You For Contacing Us';
      $message = 'Hello ' . $name . ', Thanks for Reaching out and Contacting us (Test).';
      $headers = "From: playaround@caseyjohnson1989.com\r\n";
      $headers .= "BCC: dave.jones@scc.spokane.edu\r\n";

      $sent = mail($to, $subject, $message, $headers);
    }
  }
  if (!empty($submit) && !empty($name)) {
    echo "Name: $name<br/>";
  }
  if (!empty($submit) && !empty($email)) {
    echo "Email: $email<br/>";
  }
  if (!empty($submit) && !empty($phone)) {
    echo "Phone #: $phone<br/>";
  }
  if (!empty($submit) && !empty($question)) {
    echo "Question: $question<br/>";
    if (!empty($name) && !empty($email)) {
      $to = 'wolfspirit100@gmail.com';
      $subject = $product;
      $message = $question;
      $headers = "From: " . $email . "\r\n";
      $sent = mail($to, $subject, $message, $headers);
    }
  }
  if (!empty($submit) && !empty($newsletter)) {
    echo "Newsletter: $newsletter<br/>";
  }
  if (!empty($submit) && !empty($new_product)) {
    echo "New Products: $new_product<br/>";
  }
  if (!empty($submit) && !empty($contact)) {
    echo "Contact: $contact<br/>";
  }
  if (!empty($submit) && !empty($product)) {
    echo "Product Choice: $product<br/>";
  }

  ?>
</div>
<!--<a href="contactus.php?num1=2&num2=4">Add 2 + 4</a>-->