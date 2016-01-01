
<?php
	require "connect.php";
	
	$result=$conn->query("SELECT * FROM users");	
	$rows = $result->num_rows;
	$data = $result->fetch_all(MYSQLI_NUM);

	$fields=$result->fetch_fields();
?>	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>
	var table="users";
</script>
<script src="js/script.js"></script>
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
	foreach ($fields as $field_name){
		if($flag==0)
			$flag=1;
		else
			echo "<th>".$field_name->name."</th>";
	}
?>
						</thead>
						<tbody>
<?php
	foreach ($data as $row){
			echo "<tr>";
		$flag=0;
		$rowIndex="";
		foreach ($fields as $field_name){
			///*
			if($flag==0){
				$flag=1;
				$rowIndex=$row[0];
				$dataIndex=1;
			}
			else
				echo "<td><input type='text' value='".$row[$dataIndex++]."' name='".$field_name->name."' id='".$rowIndex."' ></td>";
			//*/
				//echo $field_name;
		}	

			echo "</tr>";

	}
?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>		
	</div>	