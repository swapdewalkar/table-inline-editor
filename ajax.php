<?php
/*
Athor: Swapnil Ashok Dewalkar
Email: swapdewalkar@gmail.com
*/
	require "connect.php";
	$json=file_get_contents('php://input');
	$data=json_decode($json);
	$table=$data->table;
	$operation=$data->operation;
	
	if($operation=="edit")	{
		$id=$data->id;
		$oldValue=$data->oldValue;
		$newValue=$data->newValue;
		$name=$data->name;
		if($oldValue!=$newValue){
			$returnData= new stdClass();
			if($conn->query("UPDATE `$table` SET `$name`='$newValue' WHERE `id`='$id'")){
				$returnData->msg="Value Has been Changed from ".$oldValue." to ".$newValue;
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