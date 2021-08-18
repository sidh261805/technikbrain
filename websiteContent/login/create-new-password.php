<!DOCTYPE html>
<html>
<head>
  <title>Create new Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
  <?php
	$selector = $_GET["selector"];
	$validator = $_GET["validator"];
	if (empty($selector) || empty($validator)){
		echo "Could not validate your request!";
	} else {
		if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
			?>
			<form action="reset-password.inc.php" method="post">
					<input type="hidden" name="selector" value="<?php echo $selector ?>">
					<input type="hidden" name="validator" value="<?php echo $validator ?>">
					<input type="password" name="pwd" placeholder="Enter a new password...">
					<input type="password" name="pwd-repeat" placeholder="Repeat new password...">		
					<button type="submit" name="reset-password-submit">Reset password</button>
			 </form>
			<?php
		}
		
	}
  ?>
   <?php
	if (isset($_GET["newpwd"])) {
		if ($_GET["newpwd"] == "empty") {
			echo '<p class="signupfailed">Check your Password!</p>';
		}
		if ($_GET["newpwd"] == "pwdnotsame") {
			echo '<p class="signupfailed">Entered password is not same please enter same password!</p>';
		}
	}
  ?>
</body>
</html>
