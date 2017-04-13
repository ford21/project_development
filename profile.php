<?php session_start(); ?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
	<title>Profile</title>
	<meta name='description' content=''>
	<link rel='stylesheet' href='css/style_home.css'>
</head>
<body>

		<?Php
		
		if(isset($_SESSION['name'])){
			$name = $_SESSION['name'];
		}else{
			$name = NULL;
			$_SESSION['name']=NULL;
		}
	if ($name == NULL){
		?><script> window.location.href="index.php"; </script><?php
	}else{
    echo "
			<nav class='menu_bar'>
				<p align='right'><font color='black' size='5px'><b>",strtoupper($name),"</b></font> |  <a href='logout.php'><font size='4px' color = 'green'>Log out</font></a></p>
			</nav></br>
			<nav class='social'>
				<ul>
					<li><a href='home.php'>Home</a></li>
					<li><a href='profile.php'>Profile</a></li>
					<li><a href='status.php'>Status</a></li>              
				</ul>
			</nav>
			</br></br>";
	}
?>
</body>
</html>