<?php include('server.php');

	// if(empty($_SESSION['username'])){
		// header('location: login.php');
	// }
	
	function redirect() {
		header('location: register.php');
		exit();
	}
	if(!isset($_GET['username']) || !isset($_GET['token'])) {
		echo 'not found umane and token';
		redirect();
	} else {
		$con = mysqli_connect('localhost', 'u591380594_technikbrain', 'Alkasidd.25', 'u591380594_technikbrain');
		$username = $con->real_escape_string($_GET['username']);
		$token = $con->real_escape_string($_GET['token']);
		
		$sql = $con->query("SELECT usersId FROM users WHERE username='$username' AND token='$token' AND isEmailConfirmed=0");
		
		if ($sql->num_rows > 0){
			$con->query("UPDATE users SET isEmailConfirmed=1, token='' WHERE username='$username'");
			echo 'Your username has been verified! You can log in now!';
		} else {
			echo 'end';
			redirect();
		}
		
	}
	

?>
