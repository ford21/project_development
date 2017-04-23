<?php session_start(); require("connect.php"); 
	if(isset($_POST['username']))
		$full_name = $_POST['username'];
	else
		$_POST['username']=NULL;
	if(isset($_GET['getfrm'])){
		$_SESSION['display'] = $_GET['getfrm'];
	}else{
		$_SESSION['display'];
	}
?>
<!DOCTYPE html>
<script>
function validate(){
	var counter = 0;
	var depart = document.getElementById("department");
	var desig = document.getElementById("designation");
	var pass = document.getElementById("pass");
	var pass_len = pass.value.length;
	if(depart.value == "Department"){
		alert("Please select you department!");
		counter--;
	}else{
		counter++;
	}
	if(desig.value == "Designation" & counter == 1){
		alert("Please select you designation!");
		counter--;
	}else{
		counter++;
	}
	if(pass_len <= 6 & counter == 2){
		alert("Password minimum 6 character.");
		counter--;
	}else{
		counter++;
	}
	if(counter == 3)
		return true;
	else
		return false;
}
</script>
<?PHP 
	if($_SESSION['display'] == "d56b699830e77ba53855679cb1d252da"){
		echo "
		<html >
			<head>
			  <meta charset='UTF-8'>
			  <title>login</title>
			  <link rel='stylesheet' href='css/style_reg.css'>
			</head>
			<body>
		";
		if (isset($_POST['username'])){
    if (isset($_POST['cmdlogin'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query = sprintf("SELECT * FROM user_details WHERE username = '%s' AND password = '%s';",mysqli_real_escape_string($conn,$username), mysqli_real_escape_string($conn,$password));
		$result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_array($result);
			$query = sprintf("SELECT name,email FROM user_details WHERE username = '%s' AND password = '%s';",mysql_real_escape_string($username), mysql_real_escape_string($password));
			$result = mysqli_query($conn,$query);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['priority'] = $row['priority'];
			$_SESSION['name'] = $row['full_name'];
			$_SESSION['designation']=$row['designation']; 
			$_SESSION['email'] =$row['email_id'];
			$verify = $row['verify'];
			if($verify == 1){
				?><script> alert("please verify your mail first"); window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da"; </script><?php
			}else{
				?><script>window.location.href="home.php";</script><?php
			}
        }else{
			?><script>window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script><?php
			$_SESSION['error_message'] = "<font color ='red'>Wrong username or password!</font>";
        }
    }else{
		?><script>window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script><?php
		$_SESSION['error_message'] = "<font color ='red'>Please login first</font>";
		 
    }
	}else{
		?><script>window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script><?php
		 //header('Location: loginform.php');
		 $_SESSION['error_message'] = "<font color ='red'>Please enter your username</font>";
	}

	}else if($_SESSION['display'] == "4777645ba84e63ea9f65a4a57710e3f8"){	//else part
		
	if(isset($_POST['full_name']) && isset($_POST['cmdlogin'])){
		$full_name = $_POST['full_name'];
		$query = sprintf("SELECT * FROM faculty where faculty_name='$full_name';");
		$result = mysqli_query($conn,$query);
		if(mysqli_num_rows($result) == 1){
			$query1 = sprintf("SELECT * FROM department;");
			$result1 = mysqli_query($conn,$query1);
			$query2 = sprintf("SELECT * FROM designation;");
			$result2 = mysqli_query($conn,$query2);
			
			//if(isset($_SESSION['fn']) and isset($_SESSION['dp']) and isset($_SESSION['ds']) and isset($_SESSION['un']) and isset($_SESSION['p']) and isset($_SESSION['e']) ){
				//$fn=$_SESSION['fn']; unset($_SESSION['fn']);
				//$dp=$_SESSION['dp'];unset($_SESSION['dp']);
				//$ds=$_SESSION['ds'];unset($_SESSION['ds']);
				//$un=$_SESSION['un'];unset($_SESSION['un']);
				//$p=NULL;
				//$e=$_SESSION['e'];unset($_SESSION['e']);
			//}else{
				$fn=NULL;
				$dp=NULL;
				$ds=NULL;
				$un=NULL;
				$p=NULL;
				$e=NULL;
			//}
			
		echo "
			<html >
			<head>
			  <meta charset='UTF-8'>
			  <title>Registration Form</title>
			  <link rel='stylesheet' href='css/style_reg.css'>
			</head>
			<body>
			<div class='login-wrap'>
			<form method='post' class='login-html' onsubmit='return validate();' action='login.php?getfrm=dbb2ccec89938bc0f168df1509738a93' enctype='multipart/form-data'>
				<div class='login-form'>
					<div class='group'>
							<label for='name' class='label'>Fullname</label>
							<input id='name' type='text' class='input' value='$fn' name='fullname' placeholder='Fullname' required/>
						</div>
						<div class='group'>
							<label class='label'>Department: </label>
							<select id ='department' name='department' value='$dp' class='input'>
								<option selected disabled hidden>Department</option>";
									$row = mysqli_fetch_array($result1);
									while($row){
										$department_name = $row['department_name'];
								
								echo "<option>",strtoupper($department_name),"</option>"; 
										$row = mysqli_fetch_array($result1);
									} 
								
								echo "
							</select>
							<label class='label'>Designation: </label>
							<select id ='designation'  name='designation' value='$ds' class='input'>
								<option selected disabled hidden>Designation</option> ";
									$row = mysqli_fetch_array($result2);
									while($row){
										$designation_name = $row['designation_name'];
										
								echo "<option>",strtoupper($designation_name),"</option>";
										$row = mysqli_fetch_array($result2);
									} 
							echo "
							</select>
						</div>
						<div class='group'>
							<label for='pass' class='label'>Email Id</label>
							<input id='name' type='text' class='input' value='$e' name='email' placeholder='email id' required/>
						</div>
						<div class='group'>
							<label for='user' class='label'>Username</label>
							<input id='user' type='text' class='input' name='username' value='$un' placeholder='username' required/>
						</div>
						<div class='group'>
							<label for='pass' class='label'>Password</label>
							<input id='pass' type='password' class='input' data-type='password' value='$p' name='password' placeholder='password' required/>
						</div>

						<div class='group'>
							<input type='submit' name ='cmdlogin' class='button' value='Sign Up'/></br>
							<input type='reset' class='button' value='Reset'/>
						</div>
					</div>
				</form>
			</div>
			";	
		}else{
			echo "<center><font color='green'>Sorry your name cannot be detected in the databse, Please contact the Administrator.</font></center>";
		}
	}else{
		?><script>window.location.href="login.php?getfrm=4777645ba84e63ea9f65a4a57710e3f8";</script><?php
	}
	
	}else if($_SESSION['display'] == "dbb2ccec89938bc0f168df1509738a93"){
		$flg = 0;
		if(isset($_POST['fullname'])){
			$flg += 1;
			$fullname = $_POST['fullname'];
			$_SESSION['fn'] = $_POST['fullname'];
		}
		if(isset($_POST['department'])){
			$flg += 1;
			$department = $_POST['department'];
			$_SESSION['dp'] = $_POST['department'];
		}
		if(isset($_POST['designation'])){
			$flg += 1;
			$designation = $_POST['designation'];
			$_SESSION['ds'] = $_POST['designation'];
			/*
			if(strtoupper($_POST['designation']) == "DIRECTOR"){
				$query = sprintf("SELECT * FROM user_details;");
				$result = mysqli_query($conn,$query);
				$row = mysqli_fetch_array($result);
				$desig = $row['designation'];
				while($row != NULL){
					if(strtoupper($_POST['designation']) == strtoupper($desig)){
						?><script> alert("There can be only one "+"<?php echo $_POST['designation']; ?>"); 
						window.location.href="login.php?getfrm=4777645ba84e63ea9f65a4a57710e3f8";</script><?php
					}
					$row = mysqli_fetch_array($result);
					$desig = $row['designation'];
				}
				$flg = 99;
			}
			*/
			
		}
		if(isset($_POST['username'])){
			$flg += 1;
			$username = $_POST['username'];
			$_SESSION['un'] = $_POST['username'];
		}
		if(isset($_POST['password'])){
			$flg += 1;
			$password = md5($_POST['password']);
			$_SESSION['p'] = $_POST['password'];
		}
		if(isset($_POST['email'])){
			$flg += 1;
			$email = $_POST['email'];
			$_SESSION['e'] = $_POST['email'];
		}
		
		if($flg == 6){
			$query = sprintf("SELECT * FROM user_details ORDER BY user_id DESC LIMIT 1;");
			$result = mysqli_query($conn,$query);
			$row = mysqli_fetch_array($result);
			$last_row = $row['user_id'];
			$last_row = $last_row + 1;
			$verify = 1;
			$password_reset = 0;
			$link = md5(rand(100000,999999));
			$priority = 99;
			$query = sprintf("SELECT * FROM designation WHERE designation_name = '$designation';");
			$result = mysqli_query($conn,$query);
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
				$priority = $row['priority'];
			}else{
				$priority = 99;
			}
			$query =sprintf("INSERT INTO user_details VALUES ('$last_row','$priority','$fullname','$designation','$department','$email','$username','$password','$verify','$password_reset','$link');");
			$result = mysqli_query($conn,$query);
			if( mysqli_affected_rows($conn) == 1){
				
				$_SESSION['BodyContent'] = "<p>Dear <b>$fullname</b>,</p><p>Please Verify your mail with the link provided below. Your can click the link below or copy the url and paste it in your browser.</p>localhost/project/php2/verification.php?verify_key=".$link."</BR><p>If already verify please ignore it.</p><p>thank you.</p>";
				?><script>alert ("You have successfully registered!"); window.location.href="./email/verifymail.php";</script><?php
			}else{
				?><script>alert ("register was unsuccessfully!"); window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script><?php
			}
		}else{
			?><script> alert ("some field were empty!"); window.location.href="login.php?getfrm=4777645ba84e63ea9f65a4a57710e3f8";</script><?php
		}

	}else{
		?><script>window.location.href="loginform.php?getfrm=d56b699830e77ba53855679cb1d252da";</script><?php
	}
?>
</body>
</html>
