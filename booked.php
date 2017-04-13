<?Php
session_start();
require("connect.php");
$flag1 = False;
$flag2 = True;
$room_id = 0;
$o_name = NULL;
$o_email = NULL;
$_SESSION['bodyContent']=NULL;
$_SESSION['over_bodyContent']=NULL;
if(isset($_GET['flag'])){
	$flag = false;
}else{
	$flag = true;
}

if(isset($_SESSION['designation']))
	$_SESSION['designation'];
else
	$_SESSION['designation']=NULL;

if(isset($_SESSION['name']))
	$name = $_SESSION['name'];
else{
	$_SESSION['name']=NULL;
}

if(isset($_SESSION['email']))
	$email = $_SESSION['email'];
else{
	$_SESSION['email']=NULL;
}

if(isset($_POST['room_select'])){
	$_SESSION['room_select']=$_POST['room_select'];
	$r_name = $_POST['room_select'];
}else{
	$_POST['room_select']=NULL;
}
	
if(isset($_POST['datepicker'])){
	$_SESSION['datepicker']=$_POST['datepicker'];
	$date = $_POST['datepicker'];
}else{
	$_POST['datepicker']=NULL;
}

if(isset($_POST['start_time'])){
	$_SESSION['start_time']=$_POST['start_time'];
	$start_time = $_POST['start_time'];
}else{
	$_POST['start_time']=NULL;
}

if(isset($_POST['end_time'])){
	$_SESSION['end_time']=$_POST['end_time'];
	$end_time = $_POST['end_time'];
}else{
	$_POST['end_time']=NULL;
}

if(isset($_POST['event'])){
	$_SESSION['event']=$_POST['event'];
	$event = $_POST['event'];
}else{
	$_POST['event']=NULL;
}

if(isset($_SESSION['room_select'])){
	$r_name = $_SESSION['room_select'];
}else{
	$_SESSION['room_select']=NULL;
}

if(isset($_SESSION['datepicker'])){
	$date = $_SESSION['datepicker'];
}else{
	$_SESSION['datepicker']=NULL;
}

if(isset($_SESSION['start_time'])){
	$start_time = $_SESSION['start_time'];
}else{
	$_SESSION['start_time']=NULL;
}

if(isset($_SESSION['end_time'])){
	$end_time = $_SESSION['end_time'];
}else{
	$_SESSION['end_time']=NULL;
}

if(isset($_SESSION['event'])){
	$event = $_SESSION['event'];
}else{
	$_SESSION['event']=NULL;
}

 ?>
<script>
var flg = false;
</script>
<?php
if(strcmp($r_name,"-select room-") == 0){
	?><script>alert("please select a room!");</script><?PHP
	?>
	<script> window.location.href="home.php"; </script>
	<?php
}else{
	$query = sprintf("SELECT room_id FROM rooms where room_name = '$r_name';");
	$result=mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		$room_id = $row['room_id'];
	if($start_time >= $end_time){
		echo $start_time,"  ",$end_time;
		?><script> alert("please check the time!"); window.location.href="home.php"; </script><?PHP
	}else{
		if(isset($_SESSION['priority'])){
			$priority = $_SESSION['priority'];
		}else{
			$_SESSION['priority'] = NULL;
			$priority = 999;
		}
		$query = sprintf("SELECT * from user_details WHERE full_name = '$name' and email_id = '$email'; ");
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		$department = $row['department'];
		$query = sprintf("SELECT * FROM booked_rooms WHERE room_id = '$room_id' and date = '$date' and start_time='$start_time';");
		$result = mysqli_query($conn,$query);
		//if($result > 0){
		if(mysqli_num_rows($result) == 1){
			$flag1 = 0;
			$row = mysqli_fetch_array($result);
			$booked_name = $row['b_name'];
			$_SESSION['o_email'] = $row['email_id'];
			$_SESSION['o_name'] = $booked_name;
			if($booked_name == $name)
				$you= "you";
			else{
				$you = $booked_name;
			}
			$qury = sprintf("SELECT * FROM booked_rooms WHERE room_id = '$room_id' and b_name='$booked_name';");
			$res = mysqli_query($conn,$qury);
			$row = mysqli_fetch_array($res);
			$prior = $row['priority'];
			if($priority < $prior){
				?><script>
				
				var bname = "<?php echo $you; ?>";
				if(<?php echo $flag; ?>){
					var cnfrm = confirm("Room already booked! by "+bname+" do you want to override ?");
					if(cnfrm){
						window.location.href="booked.php?flag=b326b5062b2f0e69046810717534cb09";
					}else{
						alert("override was unsuccessful!");
						window.location.href="home.php";
					}
				}
				</script><?PHP
				//$flag2 = "<script> document.write(flg); </script>";
				echo $flag2;
			}else{
				?><script>
				var bname = "<?php echo $you; ?>";
					if(<?php echo $flag; ?>){
					alert("Room already booked! by "+bname);
					window.location.href="home.php";
				}
				</script><?PHP
			}
			//header("refresh:0; url= home.php");
		}else{
			$query = sprintf("SELECT * FROM booked_rooms WHERE room_id = '$room_id' and date = '$date' and start_time<'$start_time' and end_time>'$start_time';");
			$result = mysqli_query($conn,$query);
			if(mysqli_num_rows($result) == 1){
				$query = sprintf("SELECT end_time FROM booked_rooms WHERE room_id = '$room_id';");
				$result = mysqli_query($conn,$query);
				$row = mysqli_fetch_array($result);
				$end_t = $row['end_time'];
				$flag1= false;
				?>	<script> 
						var e_time = "<?php echo $end_t; ?>"; 
						alert("Sorry Room is not free! till "+e_time);
						window.location.href="home.php"; 
					</script>
				<?PHP			
					//header("refresh:0; url= home.php");
			}else{
				$flag1 = true;
			}
		}
		if($flag1){
			$query = "INSERT INTO booked_rooms VALUES ('$room_id','$priority','$department','$r_name','$name','$email','$date','$start_time','$end_time','$event',now());";
			$result = mysqli_query($conn,$query);
			if ($result > 0){
				$_SESSION['booked_email']=$email;
				$_SESSION['bodyContent'] = '<p>Dear <b>'.strtoupper($name).'</b></br></br></p>  <p>You have booked a room in '.$r_name.' from '.$start_time.' to '.$end_time.' on '.$date.' for '.strtoupper($event).'</p></br><p> thank you</br></br>';
				?><script>
					alert("Room Booked successful!");
					window.location.href="./email/sendingmail.php"; 
				</script>
				<?PHP
			}else{
				?><script>
				alert("Room Booked was unsuccessful!");
				window.location.href="home.php";
				</script><?PHP
			}
			$flag1= false;
		}
		if(isset($_GET['flag'])){
			if($_GET['flag'] == "b326b5062b2f0e69046810717534cb09"){
				echo $flag2;
				$query = sprintf("UPDATE booked_rooms SET room_id ='$room_id',priority='$priority',department='$department',room_name='$r_name',b_name='$name',email_id='$email',date='$date',start_time='$start_time',end_time='$end_time',event='$event',book_on=now() WHERE room_id = '$room_id' and date = '$date' and start_time='$start_time';");
				mysqli_query($conn,$query);
				if(mysqli_affected_rows($conn) == 1){
				?><script>
					alert("you have successfully override!"); 
				</script><?PHP
				}else{
					?><script>
					alert("override was unsuccessful!");
					window.location.href="home.php";
					</script><?PHP
				}
				$name = $_SESSION['o_name'];
				$designation = $_SESSION['designation'];
				$_SESSION['over_bodyContent'] = '<p>Dear <b>'.strtoupper($name).'</b></br></br></p>  <p>Your room in '.$r_name.' from '.$start_time.' to '.$end_time.' on '.$date.' have been override by '.strtoupper($designation).'</p></br><p> thank you</br>kpk solutions</p>';
				?>
				<script> window.location.href="./email/sendingmail.php"; </script><?php
				$flag2 = false;
			}else{
				?><script>
				alert("Fail to perform!");
				window.location.href="home.php";
				</script><?PHP
			}
		}
	}	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>booking page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
</script>
</head>
<body>

</body>
</html>