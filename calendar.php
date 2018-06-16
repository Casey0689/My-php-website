<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 8:13 AM
 */
$title = "Calendar";
include 'templates/header.php';
include 'templates/functions.php';
?>
  <h1 class="animated wow fadeInLeft">Calendar</h1>
  <div>
    <h4 style="font-weight: bold">
      <?php echo "Today is " . date("l, F jS Y") . "<br>" ?>
    </h4>
    <?php echo mini_calendar($month, $year) ?>
  </div>
<?php
include 'templates/footer.php';
?>