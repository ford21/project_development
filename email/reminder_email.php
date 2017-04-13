<?php
session_start();
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';
require 'class.smtp.php';
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'bookingnoreply90@gmail.com';          // SMTP username
$mail->Password = 'bookingtest'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                          // TCP port to connect to

$mail->setFrom('bookingnoreply90@gmail.com', 'NITM');
//$mail->addAddress('no-reply@cs14nitm.ml');   // Add a recipient
if(!isset($_SESSION['email'])){
	$_SESSION['email'] = "bookingnoreply90@gmail.com";
}

$mail->isHTML(true);  // Set email format to HTML

$mail->addAddress($_SESSION['email']);
$mail->Subject = 'Reminder Conference Boooking room';
$mail->Body = $_SESSION['bodyContent'];
echo $_SESSION['bodyContent'];
if($mail->send()) {
	?><script>alert("Message has been sent to your email.")</script><?php
}
?>
<script> windows.location.href = ".././testing/remainder.php"); </script>