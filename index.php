<?php
$title = "Home";
include 'templates/functions.php';
include 'templates/header.php';
$msg = $_GET['msg'];
?>
<h1 class="text-uppercase  animated wow fadeInLeft"><?php echo $msg ?></h1>
<p class="text-lowercase  animated wow fadeInLeft">With only your iphone and capture app you can take
  stunning image like a professional Photographer.<br/><?php echo "This is PHP in HTML" ?></p>
<a href="http://pixelhint.com/capture-free-responsive-bootstrap-app-landing-page-theme"
   class="app_store_btn text-uppercase animated wow fadeInLeft">
  <i class="iphone_icon"></i>
  <span>Iphone App</span>
</a>
<a href="http://pixelhint.com/capture-free-responsive-bootstrap-app-landing-page-theme"
   class="app_store_btn text-uppercase animated wow fadeInLeft">
  <i class="android_icon"></i>
  <span>Android App</span>
</a>
<?php
include 'templates/footer.php';
?>

