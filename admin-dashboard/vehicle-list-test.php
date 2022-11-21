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
function checkdecisiontime($effectiveDate) {
	$decisiondate = date('Y-m-d', strtotime("+1 day", strtotime($effectiveDate)));
	$today = date('Y-m-d');
	$result = "";
	if ($decisiondate > $today) $colorTd = '<span style="color:green;">';
	else $colorTd = '<span style="color:red;">';

	$diff = abs(strtotime($today) - strtotime($effectiveDate));
     $months = "0";
	$days = floor(($diff - $months*30*60*60*24)/ (60*60*24));
	return $colorTd.$days. ' days passed</span>';
}
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->
<main class="pl-1 pt-1">
	<div class="container">
					
		<div class="row p-1">
			<div class="col-md-4">
				<a href="vehicle-registration-form.php" class="btn btn-primary btn-block font-weight-bold p-2" role="button"> Add (<i class="fas fa-plus"></i>) Vehicle info</a>
			</div>	
			<div class="col-md-4">
				<div class="alert alert-success p-1 text-center" role="alert">
				<a href="available-vehicle-list.php"><span class="font-weight-bold">Available Vehicles</span></a>					
				</div>
			</div>
			<div class="col-md-4">
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
					<th class="th-sm">Days passed
					</th>				
					<th class="th-sm">Update
					</th>
					<th class="th-sm">Delete
					</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					
					<tr>	
						<td><?php echo $rs_vehicle[$i]["made_model"]; ?></td>				
						<td><?php echo $rs_vehicle[$i]["plat_number"]; ?></td>
						<td><?php echo $rs_vehicle[$i]["is_available"]; ?></td>	
						<td><?php echo $rs_vehicle[$i]["is_owned_by_emp"]; ?></td>
						<td><?php echo $rs_vehicle[$i]["location"]; ?></td>			
						<td><?php $time_original = date("Y-m-d", strtotime( $rs_vehicle[$i]["createdate"]));
                 		     echo  checkdecisiontime($time_original); ?></td> 
						<td><a href="vehicle-update-form.php?vehicle-id=<?php echo $rs_vehicle[$i]["vehicle_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	
						<td><a href="vehicle-update-form.php?vehicle-id=<?php echo $rs_vehicle[$i]["vehicle_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	

						<td>						
						<!-- Delete trigger modal-->
							<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header pl-5">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
										</div>
										<div class="modal-body">
											<p>You are about to delete one track, this procedure is irreversible.</p>
											<p>Do you want to proceed?</p>
											<p class="debug-url"></p>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											<a class="btn btn-danger btn-ok">Yes</a>
										</div>
									</div>
								</div>
							</div>

							<a href="#" data-href="vehicle_info_delete.php?vehicle-id=<?php echo $rs_vehicle[$i]["vehicle_id"]; ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>  

						<script>
						$('#confirm-delete').on('show.bs.modal', function(e) {
						$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

						 $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
						});
						</script>
						<!--Modal: modalConfirmDelete-->		
						</td>
						
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
					<th>Days passed
					</th>					
					<th>Update
					</th>
					<th>Delete
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
