<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 9/25/2017
 * Time: 7:47 AM
 */
session_start();
$websiteName = "Casey's Site"
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
  <title>
    <?php
    if ($title != "") {
      echo $websiteName . ": " . $title;
    } else {
      echo $websiteName;
    }
    ?>
  </title>
  <meta name="description"
        content="Capture is a free bootstrap v3.3.2 app landing page perfect to present you IOS, android or windows application in an elegant way."/>
  <meta charset="utf-8">
  <meta name="author" content="pixelhint.com">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="/css/owl.transitions.css"/>
  <link rel="stylesheet" type="text/css" href="/css/owl.carousel.css"/>
  <link rel="stylesheet" type="text/css" href="/css/animate.css"/>
  <link rel="stylesheet" type="text/css" href="/css/main.css"/>
</head>
<body>
<div id="header">
  <header>
    <div class="container">
      <div class="logo pull-left animated wow fadeInLeft">
        <img src="../img/logo.png" alt="" title="">
      </div>
      <?php
      include 'nav.php';
      ?>
      <div class="social pull-right">
        <ul class="list-unstyled">
          <li class="animated wow fadeInRight" data-wow-delay=".2s"><a href="#"><img src="../img/facebook.png" alt=""
                                                                                     title=""></a></li>
          <li class="animated wow fadeInRight" data-wow-delay=".1s"><a href="#"><img src="../img/twitter.png" alt=""
                                                                                     title=""></a></li>
          <li class="animated wow fadeInRight" data-wow-delay="0s"><a href="#"><img src="../img/google.png" alt=""
                                                                                    title=""></a></li>
        </ul>
      </div>
    </div>
  </header>
</div>
<main class="hero" id="hero">
  <div class="container">
    <div class="caption">
      <?php if (isset($_SESSION['name'])) {
        echo "<h2>Welcome: {$_SESSION['name']}</h2>";
      }
      ?>
