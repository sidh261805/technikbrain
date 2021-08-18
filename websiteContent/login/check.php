<?php

$db = mysqli_connect('localhost', 'users', 'users', 'registration');
if(isset($_POST["user_name"]))
{
	$username = mysqli_real_escape_string($db, $_POST["user_name"]);
	$query ="SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($db, $query); 
	echo mysqli_num_rows($result); //count number of row
}
?>