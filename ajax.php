<?php
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
			if($conn->query("UPDATE `$table` SET `$name`='$newValue' WHERE `id`='$id'")){
				echo "Value Has been Changed from ".$oldValue." to ".$newValue;
			}	
			else{
				echo $conn->error;
			}
		}
		else{
			echo "";
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

		if($flag==1){
			if($conn->query("INSERT INTO `$table` ($keys) VALUES($values)")){
				echo "Inserted Successfully";
			}	
			else{
				echo $conn->error;
			}
		}
		else{
			echo "Enter Something";
		}


	}

?>