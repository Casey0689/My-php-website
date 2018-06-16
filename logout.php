<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 11/15/2017
 * Time: 7:43 AM
 */
session_start();
session_destroy();
header("location: /login.php");
?>