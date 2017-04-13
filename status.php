<?php session_start(); require("connect.php"); 
if(isset($_GET['confrm'])){
	$_SESSION['flag'] = $_GET['confrm'];
}else{
	$_SESSION['flag'] = 0;
}
 ?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
	<title>Status</title>
	<meta name='description' content=''>
	<link rel='stylesheet' href='css/style_home.css'>
	<link rel='stylesheet' href='css/style_status.css'>
</head>
<body>
<script>
function confirmation(){
	var flag = confirm("are you sure you want to clear all?");
	return flag;
}
</script>
		<?Php
		if(isset($_SESSION['name'])){
			$name = $_SESSION['name'];
		}else{
			$name = NULL;
			$_SESSION['name']=NULL;
		}
		try{
			if ($name == NULL){
			?><script> window.location.href="index.php"; </script><?php
		}else{
			$query = sprintf("SELECT * FROM booked_rooms WHERE b_name = '$name';");
			$result = mysqli_query($conn,$query);
			$no_rows = mysqli_affected_rows($conn);
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
				if($no_rows == 0 || $no_rows < 0 ){
					echo "<div align = 'center'>You have not booked any room.</div>";
				}else{
					echo "
					<table class='rwd-table'>
					  <tr>
						<th>Date</th>
						<th>Event</th>
						<th>From</th>
						<th>To</th>
						<th>Room</th>
					  </tr>";
					  while($no_rows){
						$row = mysqli_fetch_array($result);
						$room_name = $row['room_name'];
						$date = $row['date'];
						$start_time = $row['start_time'];
						$end_time = $row['end_time'];
						$event = $row['event'];
					  echo"
					  <tr>
						<td data-th='Date'>",$date,"</td>
						<td data-th='Event'>",$event,"</td>
						<td data-th='From'>",$start_time,"</td>
						<td data-th='To'>",$end_time,"</td>
						<td data-th='Room'>",$room_name,"</td>
					  </tr>
					  ";
					  $no_rows--;
					  }
					  echo "
					</table>
					";
					echo "<a href='status.php?confrm=6512bd43d9caa6e02c990b0a82652dca'><input onclick='return confirmation();'type='submit' name='clear' value='clear all'/></a>";
				}
			echo "</body></html>";
		}
	}catch(Exception $error){
		echo "Error",$error->getMessage(),"\n";
		?><script>window.location.href="index.php";</script><?php
	}
	if($_SESSION['flag'] == "6512bd43d9caa6e02c990b0a82652dca" ){
		if(isset($_SESSION['name'])){
			$name = $_SESSION['name'];
		}else{
			$_SESSION['name'] = NULL;
		}
		if($_SESSION['name'] != NULL){
			$query = sprintf("SELECT * FROM booked_rooms WHERE b_name = '$name';");
			$result = mysqli_query($conn,$query);
			$no_rows = mysqli_affected_rows($conn);
			if($no_rows >= 1 ){
				$query = sprintf("DELETE FROM booked_rooms WHERE b_name = '$name';");
				$result = mysqli_query($conn,$query);
				$no_rows = mysqli_affected_rows($conn);
				if($no_rows > 0){
					?><script>alert("successfully deleted "+<?php echo $no_rows ?>+" rows")</script><?php
				}else{
					?><script>alert("unsuccessful")</script><?php
				}
				?><script>window.location.href="status.php";</script><?php
				//header('refresh:0; url = status.php');
			}else{
				?><script>window.location.href="status.php";</script><?php
				//header('Location: status.php');
			}
		}else{
			?><script>window.location.href="status.php";</script><?php
			//header('Location: status.php');
		}
	}
?>
