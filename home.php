<?php 	
	session_start(); 
	require("connect.php");
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  
  <link rel="stylesheet" href="css/bootstrap_timer.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style_timer.css" rel="stylesheet">
  <link rel="stylesheet" href="css/timepicki_timer.css" rel="stylesheet">
  
  <link rel="stylesheet" href="css/style_home.css">
  <link rel="stylesheet" href="css/datepicker.css">
</head>
<script>
function confirmation(){
	var flag = false;
	var counter = 0;
	var time = false;
	var end_t = document.getElementById("timepicker2");
	var start_t = document.getElementById("timepicker1");
	var event = document.getElementById("event");
	var room = document.getElementById("room");
	var calen = document.getElementById("mytarget");
	
	if(room.value == "room"){
		alert("Please select a room!");
		flag = false;
		counter--;
	}else{
		counter++;
	}
	if((start_t.value >= end_t.value) & counter == 1){
		if((start_t.value == "" || end_t.value == "") ){
			alert("Please set the time!");
			flag = false;
			counter--;
		}else{
			
			alert("Please check the time!");
			flag = false;
			counter--;
		}
		
	}else{
		counter++;
	}

	if(calen.value == "Select Date" & counter == 2){
		alert("Please Select a Date!");
		flag = false;
		counter--;
	}else{
		counter++;
	}
	if(event.value == "" & counter == 3){
		alert("Please enter event for the room you want to book!");
		flag = false;
		counter--;
	}else{
		evt = true;
		counter++;
	}
	
	if(counter == 4 & counter > 0){
		var flag = confirm("do you want to book now!");
	}
	return flag;
}
</script>
<body>
	<?Php
	//$name = "Reifford nongbri";
		if(isset($_SESSION['name'])){
			$name = $_SESSION['name'];
		}else{
			$name = NULL;
			$_SESSION['name']=NULL;
		}
		if ($name == NULL){
			?><script> window.location.href='index.php'; </script><?php
		}else{
			$query = sprintf("SELECT * FROM rooms;");
			$result = mysqli_query($conn,$query);
			$row = mysqli_fetch_array($result);
			$minus = " to ";
		echo "
<nav class='menu_bar'>
	<p align='right'><font color='black' size='5px'><b>",strtoupper($name),"</b></font> |  <a href='logout.php'><font size='4px' color = 'green'>Log out</font></a></p>
</nav>
<nav class='social'>
    <ul>
		<li><a href='home.php'>Home</a></li>
        <li><a href='profile.php'>Profile</a></li>
        <li><a href='status.php'>Status</a></li>              
    </ul>
</nav>
</br></br>
<form action='booked.php' onsubmit='return confirmation();' method='post' enctype=multipart/form-data'>
	<div>
		<select id='room' name='room_select' class='mycl'>
			<option selected disabled hidden>room</option>"; 
			while($row){
				$room_name = $row['room_name'];
				echo "<option>",strtoupper($room_name),"</option>"; 
				$row = mysqli_fetch_array($result);
			}
			echo "
		</select>
	</div></br>
	<div class='indexpicker'>
		<div class='lead'>
			<input class='mycl' id='timepicker1' value = '' type='text' name='start_time'/> ".$minus." 
			<input class='mycl' id='timepicker2' value = '' type='text' name='end_time'/>
		</div>
    </div>
	<div  style='position:relative;display:inline-block; width:250px;'>
		<input class='mycl' type='text' id='mytarget' value='Select Date' name='datepicker' />
		<div class='monthly' style='position:relative;' id='mycalendar'></div>
	</div>
	<script type='text/javascript' src='js/jquery.min.js'></script>
    <script type='text/javascript' src='js/timepicki.js'></script>
    <script>
		$('#timepicker1').timepicki();
		$('#timepicker2').timepicki();
    </script>
    <script type='text/javascript' src='js/bootstrap.min.js'></script>
</br></br>
	<div>
	<textarea id='event' class='textarea' name='event' rows='3' cols='40'></textarea>
	</div></br>
	<div class='archive__row'>
		<input type='submit' class='btn btn-lg btn-success' value='Book Now' name='cmdlogin'/><pre></pre><input type='reset' class='btn btn-lg btn-success' value='Reset' name='Reset'/>
	</div>
	
</form>
	<br>
	<script type='text/javascript' src='js/date/jquery_dp.js'></script>
	<script type='text/javascript' src='js/date/datepicker.js'></script>
	<script type='text/javascript'>
		$(window).load( function() {
			$('#mycalendar').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});
		});
	</script>

	";
	} 
	?>
</body>
</html>
