<?php session_start();?>
<html>
<head>
<title>Logout</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php

if(isset($_SESSION['username'])) {
	unset($_SESSION['username']);
	unset($_SESSION['cmdlogin']);
}else {
   unset($_SESSION['username']);
   unset($_SESSION['cmdlogin']);
}
$_SESSION['error_message']="<font color ='green'>you have successfully log out</font>";
$_SESSION['cmdlogin']=NULL;
$_SESSION['name']=NULL;
$_SESSION['index']="index";
?><script>window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script>
</body>
</html>