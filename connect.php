<?php
/*
Athor: Swapnil Ashok Dewalkar
Email: swapdewalkar@gmail.com
*/
	$conn = new mysqli($host, $user, $password, $database);
 
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
			
?>