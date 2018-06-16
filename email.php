<?php
/**
 * Created by PhpStorm.
 * User: wolfs
 * Date: 11/15/2017
 * Time: 7:52 AM
 */
$to = 'wolfspirit100@gmail.com';
$subject = 'Test email from PHP';
$message = 'Hello Me, I would like to say how wonderful you are, and how you are amazing in every way. I love you me.';
$headers = "From: playaround@caseyjohnson1989.com\r\n";
$headers .= "BCC: dave.jones@scc.spokane.edu\r\n";

$sent = mail($to, $subject, $message, $headers);
echo "mail was sent: $sent";