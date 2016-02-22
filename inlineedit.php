<!--
Athor: Swapnil Ashok Dewalkar
Email: swapdewalkar@gmail.com
-->
<?php
	$host="localhost";
	$database="etendering";
	$user="root";
	$password="";
	$table="users";	
	if(isset($_GET['host']) && !empty($_GET['host']))
		$host=$_GET['host'];	
	else
		echo "Specify Host Name";
	if(isset($_GET['database']) && !empty($_GET['database']))
		$database=$_GET['database'];	
	else
		echo "Specify Database Name";
	if(isset($_GET['user']) && !empty($_GET['user']))
		$user=$_GET['user'];	
	else
		echo "Specify User Name";
	if(isset($_GET['password']) && !empty($_GET['password']))
		$password=$_GET['password'];	
	else
		echo "Specify Password Name";
	if(isset($_GET['table']) && !empty($_GET['table']))
		$table=$_GET['table'];
	else
		echo "Specify Table Name";
	require "connect.php";
	
	$result=$conn->query("SELECT * FROM $table");	
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<div id="status">
</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<b><?= strtoupper($table); ?></b>
				</div>
				<div class="panel-body">
					<?php
							$flag=0;
							$addRow="<tr><td><span class='fa fa-plus' id='addNewButton'></span></td>";
							$tableHead="<th></th>";
							foreach ($fields as $field){
								if($flag==0){
									$flag=1;
									$tableHead.="<script>primary='$field->name';</script>";
								}
								else{
									$tableHead.="<th>".$field->name."</th>";
									$addRow.="<td class='addRowInput' ><input type='text' name='$field->name' id='add-id-$field->name' placeholder='Enter $field->name' class='addRowInput' /></td>
									<script>
										fields.push('$field->name');
									</script>	
									";	
								}
							}
							$addRow.="</tr>";
						?>
					<table class="table table-hover">
						<thead>
						</thead>
						<tbody>
						<?php echo $addRow; ?>
						</tbody>
					</table>						

					<table class="table table-hover" id="dt">
						<thead>
							<?php echo $tableHead; ?>
						</thead>
						<tbody>
							<?php
								foreach ($data as $row){
									$flag=0;
									$rowIndex=$row[0];
									echo "<tr id='row-$rowIndex' value='$rowIndex'>
											<td>
												<span class='fa fa-trash deleteButton' name='".$fields[0]->name."' id='del-$rowIndex'>
												</span>
											</td>";
									foreach ($fields as $field){
										if($flag==0){
											$flag=1;
											$dataIndex=1;
										}
										else
											echo "<td>
													<input type='text' value='".$row[$dataIndex++]."' name='".$field->name."' id='".$field->name."-".$rowIndex."' >
												  </td>";
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
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>
	var host="<?= $host; ?>";
	var database="<?= $database; ?>";
	var user="<?= $user; ?>";
	var password="<?= $password; ?>";
	var table="<?= $table; ?>";
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script>
	var dataTable=$('#dt').DataTable();
</script>
<script src="https://cdn.datatables.net/plug-ins/1.10.11/api/fnAddTr.js"></script>
<script src="js/script.js"></script>

