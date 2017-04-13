<?php 
	session_start();
	
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>LogIn Page</title>
  <link rel="stylesheet" href="css/style_login.css">
</head>
<body>

	<div class="login-wrap">
	<form method="post" class="login-html" action="login.php" enctype="multipart/form-data">
		<div class="login-form">
				<div class="group">
				<p class="group" align="center">
				<?php 
				if(isset($_SESSION['error_message'])){
					echo $_SESSION['error_message']; 
				}else{
					$_SESSION['error_message']=NULL; 
				}
				if(!isset($_SESSION['name'])){
					$_SESSION['name']=NULL;
				}
				$_SESSION['error_message']=NULL;
				if(isset($_GET['getfrm'])){
					$_SESSION['display'] = $_GET['getfrm'];
				}
				if(!isset($_SESSION['display'])){
					$_SESSION['display']= "d56b699830e77ba53855679cb1d252da";
				}
				if(isset($_SESSION['index'])){
					if($_SESSION['index'] == "index"){
						?><script> window.setTimeout("window.location.href='index.php';",10000); </script><?php
					}
				}
				if($_SESSION['display'] == "d56b699830e77ba53855679cb1d252da"){ ?>
					</p>
					<label for="user" class="label">Username</label>
					<input value="" id="username" name="username" type="text" autocomplete=off class="input" required/>
					<label for="pass" class="label">Password</label>
					<input value="" id="password" name="password" type="password" class="input" data-type="password" required/>
					</BR>
					<input type="submit" class="button" name ="cmdlogin" value="Log In">
				</div>
				<HR>
				<div class="foot-lnk">
					<a href="./password/forgot_password.php?frgt=5d5508cfacc996627d6d0c96e88943bc"><u>Forgot Password?</u></a>
				</div>
		</div><div align="right"><a href="loginform.php?getfrm=4777645ba84e63ea9f65a4a57710e3f8"><font color="green" size="5px"><u>Register</u></font></a></div>
				<?php } else if ($_SESSION['display'] == "4777645ba84e63ea9f65a4a57710e3f8"){ ?>
						<div class="login-form">
							<div class="group">
								<label for="fullname" class="label" align="center">Fullname</label>
								<input value="" id="full_name" name="full_name" type="text" autocomplete=off class="input" placeholder="fullname" required/>
								<HR>
								<input type="submit" class="button" name ="cmdlogin" value="LogIn">
								</div>
						</div><div align="right"><a href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da"><font color="green" size="5px"><u>Go Back</u></font></a></div>
						<?php } else {$_SESSION['display']= "d56b699830e77ba53855679cb1d252da";}?>
	</form>
</div>
</body>
</html>
