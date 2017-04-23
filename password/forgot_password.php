<?php session_start(); ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../css/style_login.css">
</head>
<body>
	<div class="login-wrap">
	<form method="post" class="login-html" onsubmit='return check()'; action="get_password_reset.php?frgt_pass=67169d9b10aaafa2c4cd3f16f3e30454" enctype="multipart/form-data">
		<div class="login-form">
				<div class="group">
				<p class="group" align="center">
					<?php 
						if(isset($_SESSION['error_message']))
							echo $_SESSION['error_message']; 
						else
							$_SESSION['error_message']=NULL; 
						$_SESSION['error_message']=NULL; 
					?>
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
				</div>
			</div>
	</form>
</div>
</body>
</html>
