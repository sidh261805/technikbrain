<?php
//to connect database server
 $conn = mysqli_connect('localhost', 'users', 'users', 'registration');
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}