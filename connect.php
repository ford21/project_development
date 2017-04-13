<?php
$HOST = 'localhost:3306';
$DBUSER = 'root';
$PASS = '';
$DB = 'userdata';
 
$conn = mysqli_connect($HOST, $DBUSER, $PASS);
if (!$conn){
    die('Could not connect !<br />Please contact the site\'s administrator.');
}
mysqli_select_db($conn,$DB);
/*
if (!$db){
    die('Could not connect to database !<br />Please contact the site\'s administrator.');
}
*/
?>