<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
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
