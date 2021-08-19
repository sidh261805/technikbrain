<?php 
include('server.php'); 
include ('../../passwords/db_access.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>User registration system</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

 <meta http-equiv="content-type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
/* Style the navigation bar */
.navbar {
  width: 100%;
  background-color: #555;
  overflow: auto;
}

/* Navbar links */
.navbar a {
  float: left;
  text-align: center;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

/* Navbar links on mouse-over */
.navbar a:hover {
  background-color: #000;
}

/* Current/active navbar link */
.active {
  background-color: #4CAF50;
}

/* Add responsiveness - will automatically display the navbar vertically instead of horizontally on screens less than 500 pixels */
@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
</style>   
  
 </head>

<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="navbar">
  <a href="../../home.html"></i> Home</a> 
  <a href="../about.html"></i> About</a> 
  <a href="../index.php"></i> Contact</a> 
  <a class ="active" href="register.php"></i> Login</a>
</div>

  <div class="header">
  	<h2>Login</h2>
  </div>
  
  <form id="loginform" method="post" action="login.php">
  <?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Username</label>
  	  <span class="glyphicon glyphicon-user"></span><input type="text" name="username" id="username" >
	   <span id="availability"></span>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <span class="glyphicon glyphicon-lock"></span><input type="password" name="password" id="password">
  	</div>
	<div class="input-group">
  	  <button type="submit" class="btn" name="login" id="register"><span class="glyphicon glyphicon-menu-right"></span>Login</button>
  	</div>
	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
	<a href="reset-password.php">Forgot your password?</a>
  </form>
  
   <?php
	if (isset($_GET["newpwd"])) {
		if ($_GET["newpwd"] == "passwordupdated") {
			echo '<p class="signupsuccess">Password Updated!</p>';
		}
	}
  ?>
</body>
</html>
<script>
	$(document).ready(function() {
		$('#username').blur(function() {
			var username = $(this).val();
			
			$.ajax({
				url:'check.php' ,
				method:"POST",
				data:{user_name:username},
				success:function(data)
				{	
					if(data != '0'){
						$('#availability').html('<label class="text-success"><span class="glyphicon glyphicon-ok">user found</span></label>');
						$('#register').attr("disable", false);
					}
					else
					{
						$('#availability').html('<label class="text-danger"><span class="glyphicon glyphicon-remove">user not found</span></label>');
						$('#register').attr("disable", true);
					}
				}
				
			});						
		});		
			
	});	
</script>
