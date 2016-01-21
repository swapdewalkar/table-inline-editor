<!--
Athor: Swapnil Ashok Dewalkar
Email: swapdewalkar@gmail.com
-->
<?php

	require "connect.php";
	
	$result=$conn->query("SELECT * FROM users");	
	$rows = $result->num_rows;
	$data = $result->fetch_all(MYSQLI_NUM);

	$fields=$result->fetch_fields();
?>	

<link rel="stylesheet" href="css/bootstrap.min.css" >
<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css" >
<script type="text/javascript">
	var fields=[];
</script>
<div id="status">
</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<b><?= strtoupper($table); ?></b>
				</div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>

<?php
	$flag=0;
	$addRow="<tr>";
	foreach ($fields as $field){
		if($flag==0){
			$flag=1;
			echo "<script>primary='$field->name';</script>";
		}
		else{
			echo "<th>".$field->name."</th>";
			$addRow.="<td class='addRowInput' ><input type='text' name='$field->name' id='add-id-$field->name' placeholder='Enter $field->name' class='addRowInput' /></td>
			<script>
				fields.push('$field->name');
			</script>	
			";	
		}
	}
		echo "<th></th>";
	$addRow.="<td><span class='fa fa-plus' id='addNewButton'></span></td></tr>";
?>
						</thead>
						<tbody>
<?php
	echo $addRow;
	foreach ($data as $row){
		$flag=0;
		$rowIndex=$row[0];
		echo "<tr id='row-$rowIndex'>";
		foreach ($fields as $field){
			if($flag==0){
				$flag=1;
				$dataIndex=1;
			}
			else
				echo "<td><input type='text' value='".$row[$dataIndex++]."' name='".$field->name."' id='".$rowIndex."' ></td>";
		}	

			echo "<td><span class='fa fa-trash deleteButton' name='".$fields[0]->name."' id='$rowIndex'></span></td></tr>";

	}
?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>		
	</div>	
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>
	var table="users";
</script>
<script src="js/script.js"></script>

