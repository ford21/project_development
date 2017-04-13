<?php session_start(); require("../connect.php"); ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../css/style_login.css">
  <script>
function message_display(){
	alert("please note that this page will redirect in 60 seconds!");
}

function check(){
	
	var value1 = document.getElementById("password1");
	var value2 = document.getElementById("password2");
	if (value1.value === value2.value) {
		return true;
	}else{
		alert("password does not match");
		return false;
	}
}
</script>
</head>
<body>
<?php
	if(isset($_POST['cmdlogin'])){
		$value = "67169d9b10aaafa2c4cd3f16f3e30454";
	}else{
		$value = "242d68b34c8747a826a6d2e15659413f";
	}
?>
	<div class="login-wrap">
	<form method="post" class="login-html" onsubmit='return check()'; action="forgot_password.php?frgt=<?php echo $value; ?>" enctype="multipart/form-data">
		<div class="login-form">
				<div class="group">
				<p class="group" align="center">
					<?php 
						if(isset($_SESSION['error_message']))
							echo $_SESSION['error_message']; 
						else
							$_SESSION['error_message']=NULL; 
						$_SESSION['error_message']=NULL; 
						if(isset($_GET['frgt']))
							$_SESSION['frgt_pass'] = $_GET['frgt'];
				if($_SESSION['frgt_pass'] == "5d5508cfacc996627d6d0c96e88943bc"){ ?>
					
				</p>
					<label for="username" class="label" align="center">Username</label>
					<input value="" id="username" name="username" type="text" autocomplete=off class="input" placeholder="username" required/>
					<label for="email" class="label" align="center">Email id</label>
					<input value="" id="email" name="email" type="text" autocomplete=off class="input" placeholder="email id" required/>
					<HR>
					<input type="submit" class="button" name ="cmdlogin" value="Submit">
			<div align="right" style="padding-top: 50%;">
				<a href="../loginform.php?getfrm=d56b699830e77ba53855679cb1d252da"><font color="green" size="5px"><u>Go Back</u></font></a>
			</div>
			
				<?php } else if ($_SESSION['frgt_pass'] == "242d68b34c8747a826a6d2e15659413f"){
						$_SESSION['u'] = $_POST['username'];
						$_SESSION['e'] = $_POST['email'];
						unset($_POST['username']);
						unset($_POST['email']);
					if((isset($_SESSION['u']) && isset($_SESSION['e']))){
						if(isset($_POST['cmdlogin'])){
						$username = $_SESSION['u'];
						$email = $_SESSION['e'];
						session_destroy();
						session_start();
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email ;
						$_POST['cmdlogin']=NULL;
						$_POST['cmdlogin']=FALSE;
						$query = sprintf("SELECT email_id,username FROM user_details where email_id='$email' and username='$username';");
						$result = mysqli_query($conn,$query);
						if(mysqli_affected_rows($conn) == 1){
						
						$_POST['cmdlogin']=NULL;
						$_POST['cmdlogin']=FALSE;
							?><script> message_display();</script><?php
								echo "
										<label class='label' align='center'>Enter new password</label>
										<label for='password' class='label'>New Password</label>
										<input value='' id='password1' name='password1' type='password' autocomplete=off class='input' placeholder='password' required/>
										<label for='password' class='label'>Re-Type Password</label>
										<input value='' id='password2' name='password2' type='password' autocomplete=off class='input' placeholder='password' required/>
										<HR>
										<input type='submit' class='button' name ='change' value='change'>
								";
							$_POST['username'] = NULL;
							$_POST['email'] = NULL;
							unset($_POST['username']);
							unset($_POST['email']);
								?>
								<script> window.setTimeout("window.location.href='../loginform.php?getfrm=d56b699830e77ba53855679cb1d252da';",60000); </script><?php								
						}else{
							$_SESSION['error_message'] = "<font color='red'>username and email does not match!</font>";
							?>
							<script>
								windows.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";
							</script>
							<?php
						}
						}else{
							?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
						}
					}else{
						?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
					}
				 } else if ($_SESSION['frgt_pass'] == "67169d9b10aaafa2c4cd3f16f3e30454"){
						if(isset($_SESSION['username']) and isset($_SESSION['email'])){
							if((isset($_POST['password1']) and isset($_POST['password2']) and isset($_POST['change']))){
								$username = $_SESSION['username'];
								$email = $_SESSION['email'];
								$password = md5($_POST['password1']);
								$query = sprintf("UPDATE user_details SET password='$password' WHERE username='$username' and email_id='$email';");
								$result = mysqli_query($conn,$query);
								if($result == 1){
									?><script> alert("Password change successful!");
									window.location.href="../loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script><?php
								}else{
									?><script> alert("Password not able to change!");
									window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
									}
							}else{
								?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
								}
						}else{
								?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
								}
					}else{
					?><script>window.location.href="forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc";</script><?php
					} ?>
				</div>
			</div>
	</form>
</div>
</body>
</html>
