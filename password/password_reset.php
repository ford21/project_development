<?php
session_start();
$HOST = 'localhost:3306';
$DBUSER = 'root';
$PASS = '';
$DB = 'userdata';
 
$conn = mysqli_connect($HOST, $DBUSER, $PASS);
if (!$conn){
    die('Please contact the site\'s administrator.');
}
mysqli_select_db($conn,$DB);
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link rel="stylesheet" href="../css/style_login.css">
  <script>
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
$reset = 0;
$KEY1 = NULL;
$KEY2 = NULL;
$KEY = NULL;

	if(!isset($_GET['key'])){
		$_GET['key'] = NULL;
	}else{
		$reset = 1;
		$KEY1 = $_GET['key'];
		$KEY = $_GET['key'];
	}
	if(!isset($_GET['key_id'])){
		$_GET['key_id'] = NULL;
	}else{
		$KEY1 = NULL;
		$KEY2 = $_GET['key_id'];
	}
?>
	<div class="login-wrap">
	<div class="login-html">
		<div class="login-form">
				<div class="group">
<?php
	if($KEY1 != NULL){
		$query = sprintf("SELECT user_id,password_reset,link FROM user_details where password_reset='$reset' and link='$KEY1';");
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		$_SESSION['useridreset'] = $row['user_id'];
		$_SESSION['password_reset'] = $row['password_reset'];
		$_SESSION['link'] = $row['link'];
		if(mysqli_affected_rows($conn) == 1){
			echo "
			<form method='post'  onsubmit='return check()'; action='password_reset.php?key=".$_SESSION['link']."&key_id=202cb962ac59075b964b07152d234b70' enctype='multipart/form-data'>
				<label class='label' align='center'>Enter new password</label>
				<label for='password' class='label'>New Password</label>
				<input value='' id='password1' name='password1' type='password' autocomplete=off class='input' placeholder='password' required/>
				<label for='password' class='label'>Re-Type Password</label>
				<input value='' id='password2' name='password2' type='password' autocomplete=off class='input' placeholder='password' required/>
				<HR>
				<input type='submit' class='button' name ='change' value='change'>
				</form>
				";
		}else{
			echo "Please Request for a new link";
		}
	}else if ($KEY == $_SESSION['link'] && isset($_POST['change'])){
		$password = md5($_POST['password1']);
		$query = sprintf("UPDATE user_details SET password='$password',password_reset='0',link='0' WHERE user_is ='%s';",$_SESSION['useridreset']);
		$result = mysqli_query($conn,$query);
		if(mysqli_affected_rows($conn) == 1){
			echo "You have successfully reset your password";								
		}else{
			echo "Please Request for a new link";
		}
	}else{
		echo "Your link has expired! or invalid!</br> Please Request for a new link";
	}
	?>
	</div>
	</div>
</div>
</div>
</body>
</html>