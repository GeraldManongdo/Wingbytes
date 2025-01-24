<?php 
	// session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'wingbytes');

?>