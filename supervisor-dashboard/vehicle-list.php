<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);		
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();	
       $query1 = sprintf("select * from tbl_vehicle_info where deleteflag = 0 order by made_model");
	$n = db_select_query($conn, $query1, $rs_vehicle);	
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->
<main class="pl-1 pt-1">
	<div class="container">
					
		<div class="row p-1">
			
			<div class="col-md-6">
				<div class="alert alert-success p-1 text-center" role="alert">
				<a href="available-vehicle-list.php"><span class="font-weight-bold">Available Vehicles</span></a>					
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert alert-danger p-1 text-center" role="alert">
				<a href="unavailable-vehicle-list.php"><span class="font-weight-bold">Unavailable Vehicles</span></a>					
				</div>
			</div>			
			</div>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<thead>
				
				<tr>
					<th class="th-sm">Vehicle Model
					</th>
					<th class="th-sm">Plate Number 
					</th>
                    <th class="th-sm">Vehicle Available? 
					</th>	
					<th class="th-sm">Vehicle Owned by Employee? 
					</th>						
					<th class="th-sm">Location 
					</th>						
					<th class="th-sm">Registration Date
					</th>				
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr <?php if(($rs_vehicle[$i]["is_available"]=='Yes')){ echo "class='alert alert-success' role='alert';"; }								
						else{ echo "class='alert alert-danger';"; }?>>	
						<td><?php echo $rs_vehicle[$i]["made_model"]; ?></td>				
						<td><?php echo $rs_vehicle[$i]["plat_number"]; ?></td>
						<td><?php echo $rs_vehicle[$i]["is_available"]; ?></td>	
						<td><?php echo $rs_vehicle[$i]["is_owned_by_emp"]; ?></td>
						<td><?php echo $rs_vehicle[$i]["location"]; ?></td>			
						<td><?php echo $rs_vehicle[$i]["createdate"]; ?></td> 
					</tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
					<th>Vehicle ModelVehicle  
					</th>
					<th>Plate Number
					</th>	
					<th>Vehicle Available?
					</th>	
					 <th>Vehicle Owned by Employee?
					</th>
					<th>Location
					</th>						
					<th>Registration Date
					</th>					
				</tr>
			</tfoot>
		</table>
	</div>
	
	<script>
		$(document).ready(function () {
			$('#dtBasicExample').DataTable();
			$('.dataTables_length').addClass('bs-select');
		});
	</script>	
</div>
</main>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
