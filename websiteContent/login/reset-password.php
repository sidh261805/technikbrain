<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	
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
  	<h2>Reset your password</h2>
	<p>An e-mail will be send to you with instruction on how to reset your password.</p>
  </div>
  <form action="reset-request.inc.php" method="post">
		<input type="text" name="email" placeholder="Enter your e-mail address...">
		<button type="submit" name="reset-request-submit">Receive new password by e-mail</button>
  </form>
  <?php
	if (isset($_GET["reset"])) {
		if ($_GET["reset"] == "success") {
			echo '<p class="signupsuccess">Check your e-mail!</p>';
		}
	}
  ?>
</body>
</html>
