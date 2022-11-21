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
      $query1 = sprintf("select sup.customer_id, sup.c_first_name, sup.c_last_name, sup.c_email,sup.c_mobile,sup.c_address, sup.createdate, tble_countries.country_name "
	."from tbl_customer_info sup "
	."left join tble_countries on sup.c_country_id = tble_countries.country_id "
	."where sup.deleteflag = 0 order by sup.createdate DESC");
	$n = db_select_query($conn, $query1, $rs_customer);	
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->
	
<main class="pl-1 pt-1">

	<div class="container">

			<div class="row p-1">
			<div class="col-md-4">
				<a href="customer-registration-form.php" class="btn btn-primary btn-block font-weight-bold" role="button"> Add (<i class="fas fa-plus"></i>) Customer info</a>
			</div>	
			<div class="col-md-4">
				<a href="search-customer-form.php" class="btn btn-primary btn-block font-weight-bold" role="button">  <i class="fas fa-search"></i> Search Customer</a>
			</div>	
					
			</div>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
		
			<thead>
				
				<tr>
					<th class="th-sm">Firs Name
					</th>
					<th class="th-sm">Last Name
					</th>
					<th class="th-sm">Email Address
					</th>					
					
					<th class="th-sm">Mobile
					</th>					
					<th class="th-sm">Country
					</th>						
									
					<th class="th-sm">Address
					</th>
					<th class="th-sm">Registration Date
					</th>
					<th class="th-sm">Add package
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
						
						<td><?php echo $rs_customer[$i]["c_first_name"]; ?></td>				
						<td><?php echo $rs_customer[$i]["c_last_name"]; ?></td>
							<td><?php echo $rs_customer[$i]["c_email"]; ?></td>
						<td><?php echo $rs_customer[$i]["c_mobile"]; ?></td>
					   <td><?php echo $rs_customer[$i]["c_address"]; ?></td>	
						<td><?php echo $rs_customer[$i]["country_name"]; ?></td>						
						<td><?php echo $rs_customer[$i]["createdate"]; ?></td>
						<td><a href="package-registration-form.php?customer-id=<?php echo $rs_customer[$i]["customer_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-plus"></i></a></td>							
						<td><a href="customer-update-form.php?customer-id=<?php echo $rs_customer[$i]["customer_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>												

						<td>						
						<!-- Delete trigger modal-->
							<a href="customer_info_delete.php?customer-id=<?php echo $rs_customer[$i]["customer_id"]; ?>" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this record')"><i class="fas fa-trash-alt"></i></a>
						<!--Modal: modalConfirmDelete-->		
						</td>
						
					</tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
					<th>Firs Name
					</th>
					<th>Last Name
					</th>
					<th>Email Address
					</th>		
					<th>Mobile
					</th>					
					<th>Country				
					</th>
					
					<th>Address
					</th>
					<th>Registration Date
					</th>
					<th>Add package
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
	
	$(document).ready(function() {
    $('#dtBasicExample').dataTable( {
        'aaSorting': [[2,'desc']]
    });
	$('.dataTables_length').addClass('bs-select');
});
	</script>	
</div>
</main>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
