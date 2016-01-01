<?php
	require "connect.php";
	$table=$_POST['table'];
	$operation=$_POST['operation'];
	if($operation=="edit")	{
		$id=$_POST['id'];
		$oldValue=$_POST['oldValue'];
		$newValue=$_POST['newValue'];
		$name=$_POST['name'];
		if($conn->query("UPDATE `$table` SET `$name`='$newValue' WHERE `id`='$id'")){
			echo "Value Has been Changed from ".$oldValue." to ".$newValue;
		}	
		else{
			echo $conn->error;
		}
	}		
?>