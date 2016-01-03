<?php
	$host="localhost";
	$database="etendering";
	$user="root";
	$password="";
	$table="users";	
	$conn = new mysqli($host, $user, $password, $database);
 
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
			
?>