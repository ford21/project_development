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
if(!isset($_SESSION['booked_email'])){
	$_SESSION['booked_email'] = "bookingnoreply90@gmail.com";
}

$mail->isHTML(true);  // Set email format to HTML
if(isset($_SESSION['over_bodyContent'])){
	if(!isset($_SESSION['o_email']))
		$_SESSION['o_email']= NULL;
	$mail->addAddress($_SESSION['o_email']);
	$mail->Subject = 'Override Conference Boooking room';
	$mail->Body    = $_SESSION['over_bodyContent'];
	$mail->send();
}

$mail->addAddress($_SESSION['booked_email']);
$mail->Subject = 'Conference Boooking room';
$mail->Body = $_SESSION['bodyContent'];
if($mail->send()) {
	?><script>alert("Message has been sent to your email.")</script><?php
}
?>
<script>window.location.href="../home.php";</script>