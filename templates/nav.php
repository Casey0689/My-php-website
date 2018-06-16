<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 8:17 AM
 */
?>
<nav class="pull-left" id="nav">
  <ul class="list-unstyled">
    <li class="animated wow fadeInLeft" data-wow-delay=".0s"><a href="/contactus.php">Contact Us</a></li>
    <li class="animated wow fadeInLeft" data-wow-delay=".1s"><a href="/products.php">Products</a></li>
    <li class="animated wow fadeInLeft" data-wow-delay=".2s"><a href="/articles.php">Articles</a></li>
    <li class="animated wow fadeInLeft" data-wow-delay=".3s"><a href="/blog.php">Blog</a></li>
    <li class="animated wow fadeInLeft" data-wow-delay=".4s"><a href="/calendar.php">Calendar</a></li>
    <?php if (isset($_SESSION['email'])) {
      echo "<li class=\"animated wow fadeInLeft\" data-wow-delay=\".5s\"><a href=\"/preferences.php\">Preferences</a></li>";
      echo "<li class='animated wow fadeInLeft' data-wow-delay='.6s'><a href='/logout.php'>Logout</a></li>";
    } else {
      echo "<li class='animated wow fadeInLeft' data-wow-delay='.6s'><a href='/login.php'>Login</a></li>";
    }
    ?>
    <li class="animated wow fadeInLeft" data-wow-delay=".5s"><a href="/register.php">Register</a></li>
  </ul>
</nav>
<span class="burger_icon">menu</span>