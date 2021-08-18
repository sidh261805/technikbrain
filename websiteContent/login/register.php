<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
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
  	<h2>Register</h2>
  </div>
  
  <form method="post" action="register.php">
  <?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Username</label>
  	  <span class="glyphicon glyphicon-user"></span><input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <span class="glyphicon glyphicon-envelope"><input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <span class="glyphicon glyphicon-lock"><input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <span class="glyphicon glyphicon-lock"><input type="password" name="password_2">
  	</div>
	<div class="input-group">
  	  <button type="submit" class="btn" name="register"><span class="glyphicon glyphicon-menu-right">Register</button>
  	</div>
	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>

