
<?php
/*
Athor: Swapnil Ashok Dewalkar
Email: swapdewalkar@gmail.com
*/
	$json=file_get_contents('php://input');
	$data=json_decode($json);
	$operation=$data->operation;
	$table=$data->table;
	$host=$data->host;
	$database=$data->database;
	$user=$data->user;
	$password=$data->password;
	$table="users";	
	
	require "connect.php";
	
	if($operation=="edit")	{
		$inputId=$data->inputId;
		$rowId=$data->rowId;
		$oldValue=$data->oldValue;
		$newValue=$data->newValue;
		$name=$data->name;
		if($oldValue!=$newValue){
			$returnData= new stdClass();
			if($conn->query("UPDATE `$table` SET `$name`='$newValue' WHERE `id`='$rowId'")){
				$returnData->msg="Value Has been Changed from ".$oldValue." to ".$newValue;
				$returnData->newValue=$newValue;
				$returnData->inputId=$inputId;
			}	
			else{
				$returnData->error=100;
				$returnData->msg=$conn->error;
			}
			echo json_encode($returnData);
		}
	}
	if($operation=="add")	{
		$dataSet=$data->values;
		$keys=$values="";
		$flag=0;
		foreach($dataSet as $key => $value){
			$keys.="`$key`,";
			$values.="'$value',";
			if($value!=""){
				$flag=1;
			}
		}
		$keys=substr($keys,0,-1);
		$values=substr($values,0,-1);
		$returnData= new stdClass();
		if($flag==1){
			if($conn->query("INSERT INTO `$table` ($keys) VALUES($values)")){
				$returnData->values=$dataSet;
				$returnData->rowIndex=$conn->insert_id;
				$returnData->msg="Inserted Successfully";
			}	
			else{
				$returnData->error=101;
				$returnData->msg=$conn->error;
			}
		}
		else{
			$returnData->msg="Enter Something";
		}
		echo json_encode($returnData);
	}
	if($operation=="delete")	{
		$nameId=$data->name;
		$deleteId=$data->value;
		$returnData= new stdClass();
		if($conn->query("DELETE FROM `$table` WHERE `$nameId`='$deleteId'")){
			$returnData->operation="delete";
			$returnData->value=$deleteId;
			$returnData->msg="Delete Successfully";
			$returnData->error=0;
		}	
		else{
			$returnData->error=103;
			$returnData->msg="Error In Connection";
		}
			echo json_encode($returnData);
	}


?>