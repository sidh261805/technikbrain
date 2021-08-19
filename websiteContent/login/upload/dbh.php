<?php
//to connect database server
include '../../../../passwords/db_access.php';
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
