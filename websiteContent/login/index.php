<?php include('server.php');
	if(empty($_SESSION['username'])){
		header('location: login.php');
	}
	session_start();
	
	function resize_image($file, $w, $h, $crop=FALSE) {
	    list($width, $height) = getimagesize($file);
	    $r = $width / $height;
	    if ($crop) {
		if ($width > $height) {
		    $width = ceil($width-($width*abs($r-$w/$h)));
		} else {
		    $height = ceil($height-($height*abs($r-$w/$h)));
		}
		$newwidth = $w;
		$newheight = $h;
	    } else {
		if ($w/$h > $r) {
		    $newwidth = $h*$r;
		    $newheight = $h;
		} else {
		    $newheight = $w/$r;
		    $newwidth = $w;
		}
	    }
	    $src = imagecreatefromjpeg($file);
	    $dst = imagecreatetruecolor($newwidth, $newheight);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	    return $dst;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>User registration system using PHP and MySQL</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
		<div class="content">
			<!-- notification message -->
			<?php if (isset($_SESSION['success'])) : ?>
			  <div class="error success" >
				<h3>
				  <?php 
					echo $_SESSION['success']; 
					unset($_SESSION['success']);
				  ?>
				</h3>
			  </div>
			<?php endif ?>

			<!-- logged in user information -->
			<?php  if (isset($_SESSION["username"])) : ?>
				<p>Welcome <strong><?php echo $_SESSION['username'];?></strong></p>
			<?php  
			include_once 'upload/dbh.php';
			$username = $_SESSION['username'];
			$query1 ="SELECT * FROM profileimg WHERE userid='$username'";
			$result = mysqli_query($conn, $query1);
			if ($row = mysqli_fetch_assoc($result))
			{
				$db_status = $row['status'];
				if($db_status == 1){
					$query1 ="SELECT * FROM profileimg WHERE userid='$username'";
					$result = mysqli_query($conn, $query1);
					if ($row = mysqli_fetch_assoc($result))
						{
							$imagename1 = $row['imagename'];
							$image = resize_image('upload/".imagename1."', 200, 200);
							echo "<img src='$image'><br>";
						}		
				} else {
					 echo "<img src='../../images/default.png'><br>";
				}
			}else {
					 echo "<img src='../../images/default.png'><br>";
				}	

			$query1 ="SELECT * FROM mobilenumber WHERE username='$username'";
			$result = mysqli_query($conn, $query1);
			if ($row = mysqli_fetch_assoc($result))
			{
				$mobile_number = $row['mobnum'];
				$db_status = $row['status'];
				if($db_status == 1){				
					echo "<strong> Your registered number is : ".$mobile_number."</strong><br>";
					}					
			}		
	
			?>
						<h3>Current Temp is !!!</h3>
						<p id="getdata"><br>°C</br></p>
						<form action="upload/upload.php" method="POST" enctype="multipart/form-data">
						<span class="glyphicon glyphicon-folder-open"></span><input type = "file" name="file"><br>
						<span class="glyphicon glyphicon-floppy-saved"><button type="submit" id="submit" name="submit">UPLOAD</button>
						<span class="glyphicon glyphicon-floppy-remove"><button type="remove" id="remove" name="remove">REMOVE</button><br><br>

				<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p><br>
				<a href="verify_mobile/register_mobile.php">Register mobile number</a><br>
			<?php endif ?>
				<script type="text/javascript">
				function display_temp()
				{
					xmlhttp = new XMLHttpRequest();
					xmlhttp.open("GET","sensor/temperature.php",false);
					xmlhttp.send(null);
					document.getElementById("getdata").innerHTML=xmlhttp.responseText;
				}
				display_temp(); //work first time page load
				setInterval(function(){
					display_temp();  //work after 
				},2000);
				
				</script>
		</div>
</body>
</html>
