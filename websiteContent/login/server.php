<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
// connect to the database
$db = mysqli_connect('localhost', 'technikbrain', 'Alkasidd.25', 'u591380594_technikbrain');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
// use PHPMailer\PHPMailer\PHPMailer;
// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  $query ="SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result)>0){
	  array_push($errors, "Username alredy exists!");
  }
  
  $query ="SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result)>0){
	  array_push($errors, "email ID alredy register!");
  }
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
	$length = '10';
	$token = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  	$query = "INSERT INTO users (username, email, password, isEmailConfirmed, token) 
  			  VALUES('$username', '$email', '$password', false, '$token')";
  	mysqli_query($db, $query);
	
	$message = 
	"
	Confirm Your Email
	Click the link below to verify your account
	http://technikbrain.com/websiteContent/login/redirect.php?username=$username&token=$token
	
	From
	admin@technikbrain.com
	";
	mail($email,"Technikbrain Confirm Email",$message,"From: admin@technikbrain.com");
	echo "Registration Complete! Please confirm your email ID!";
	exit();
  }
}
// LOGIN USER
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  	
  if (count($errors) == 0) {
  	$password = md5($password);
	
	$query1 ="SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($db, $query1);
	if ($row = mysqli_fetch_assoc($result))
	{
		$db_emailconfirm = $row['isEmailConfirmed'];
		echo $db_emailconfirm;
		if ($db_emailconfirm == 0)
		{
			array_push($errors, "Please verify your email!");
		}
		else 
		{
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1) 
				{
				 $_SESSION['username'] = $username;
				 $_SESSION['success'] = "You are now logged in";
				 header('location: index.php');
				} 
				else 
				{
				array_push($errors, "Wrong register username found");
				}
		}
	}
	else
	{
		array_push($errors, "No username/password combination");
	}
  }
}

if(isset($_GET['logout'])){
	session_unset();
	session_destroy();
	unset($_SESSION['username']);
	header('location: login.php');
}

?>
