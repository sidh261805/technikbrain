<?php include('server.php');

	// if(empty($_SESSION['username'])){
		// header('location: login.php');
	// }
	
	function redirect() {
		header('location: register.php');
		exit();
	}
	if(!isset($_GET['username']) || !isset($_GET['token'])) {
		redirect();
	} else {
		$con = mysqli_connect('localhost', 'users', 'users', 'registration');
		$username = $con->real_escape_string($_GET['username']);
		$token = $con->real_escape_string($_GET['token']);
		
		$sql = $con->query("SELECT id FROM users WHERE username='$username' AND token='$token' AND isEmailConfirmed=0");
		
		if ($sql->num_rows > 0){
			$con->query("UPDATE users SET isEmailConfirmed=1, token='' WHERE username='$username'");
			echo 'Your username has been verified! You can log in now!';
		}else
			redirect();
		
	}
	

?>