<?php
session_start();
include_once '../upload/dbh.php';
// $otp = rand(10,50);
// $query = "INSERT INTO sensordata (username , temperature, button1) 
  			  // VALUES('$username', '24.8', '')";
// mysqli_query($conn, $query);

$username = $_SESSION['username'];
$query1 ="SELECT * FROM sensordata WHERE username='$username'";
$result = mysqli_query($conn, $query1);
if ($row = mysqli_fetch_assoc($result))
	{
		echo $row['temperature'];
	}
