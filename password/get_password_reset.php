<?php session_start(); 
require("../connect.php"); 

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../css/style_login.css">
</head>
<body>
<?php
	if(isset($_GET['frgt_pass'])){
		$_SESSION['frgt_pass'] = $_GET['frgt_pass'];
	}else{
		$_SESSION['frgt_pass'] = NULL;
	}
	
	if(isset($_GET['otp'])){
		$enc_otp = $_GET['otp'];
	}else{
		$enc_otp = 111;
	}
?>
	<div class="login-wrap">
	<div class="login-html">
		<div class="login-form">
				<div class="group">
				<p class="group" align="center">
<?php
				if ($_SESSION['frgt_pass'] == "67169d9b10aaafa2c4cd3f16f3e30454"){
						$_SESSION['u'] = $_POST['username'];
						$_SESSION['e'] = $_POST['email'];
						unset($_POST['username']);
						unset($_POST['email']);
					if((isset($_SESSION['u']) && isset($_SESSION['e']))){
						if(isset($_POST['cmdlogin'])){
						$username = $_SESSION['u'];
						$email = $_SESSION['e'];
						session_destroy(); session_start();
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email ;
						$_POST['cmdlogin']=NULL; $_POST['cmdlogin']=FALSE;
						$query = sprintf("SELECT * FROM user_details where email_id='$email' and username='$username';");
						$result = mysqli_query($conn,$query);
						$row = mysqli_fetch_array($result);
						$_SESSION['name'] = $row['full_name']; 
						if(mysqli_affected_rows($conn) == 1){
							$otp = md5(rand(100000,999999));
							$reset = 1;
							$query = sprintf("UPDATE user_details SET password_reset = '$reset',link = '%s' WHERE email_id='$email' and username='$username';",$otp);
							$result = mysqli_query($conn,$query);
							if(mysqli_affected_rows($conn) == 1){
								$_SESSION['BodyContent'] = "<p>Dear <b>".$_SESSION['name'].",</b></p><p>You have request a reset password. please click the link the below or copy the url in your browser.</p>localhost/project/php2/password/password_reset.php?key=".$otp."<p> if you did not request, please ignore it.</p></BR><p>thank you</p>";
									//echo "localhost/project/php2/password/password_reset.php?key=".$otp;
									?><script>  
										window.location.href=".././email/sendpasswordlink.php";
									</script><?php
							}else{
								echo "cannot match";
							}
							
						$_POST['cmdlogin']=NULL; $_POST['cmdlogin']=FALSE;
						}else{
							$_SESSION['error_message'] = "<font color='red'>username or email does not match!</font>";
							?>
							<script>
								window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";
							</script>
							<?php
						}
						}else{
							?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
						}
					}else{
						?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
					}
				 }	?>
				 
				 </div>
			</div>
	</div>
</div>
</body>
</html>