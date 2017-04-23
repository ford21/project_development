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
$mail->Password = 'ur_password'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                          // TCP port to connect to

$mail->setFrom('bookingnoreply90@gmail.com', 'NITM');
//$mail->addAddress('no-reply@cs14nitm.ml');   // Add a recipient
if(!isset($_SESSION['email'])){
	$_SESSION['email'] = "bookingnoreply90@gmail.com";
}

$mail->isHTML(true);  // Set email format to HTML
$mail->addAddress($_SESSION['email']);
$mail->Subject = 'Verify your email';
$mail->Body = $_SESSION['BodyContent'];
if($mail->send()) {
	?><script> alert("Verification link has been send to your email."); </script><?php
}else{
	?><script> alert("not able to send Verification link, please try again!"); </script><?php
}
//$name = $_SESSION['name'];
echo $_SESSION['BodyContent'];
?>
<script>window.location.href="../loginform.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script>
