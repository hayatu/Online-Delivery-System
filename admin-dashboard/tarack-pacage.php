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
  
 if($_GET["track_num"] != ""){
 
		$query = sprintf("SELECT track_num FROM tbl_package_info where track_num = %s ", GetSQLValueString($_REQUEST["track_num"], "text"));
		$n = db_select_query($conn, $query, $rs_tracknumber);
$track_num = $rs_tracknumber[0]["track_num"];

		if( $_GET["track_num"]!= $track_num){
		// do not insert
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 The Track Number Does not exist!.
				 <button class='btn btn-primary btn-sm btn-link'><a href='index.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit();
		} else {
			// insert 
			    
	$query = sprintf("select * from tbl_package_info where track_num = %s", GetSQLValueString($_REQUEST["track_num"], "int") );
	$n = db_select_query($conn, $query, $rs_package);
	
	 $query1 = sprintf("select emp_id, first_name,last_name from tbl_employee_info  order by first_name ");
	$n1 = db_select_query($conn, $query1, $rs_employee);
	
	$query2 = sprintf("select status_id, status from tbl_status_info order by status_id ");
	$n2 = db_select_query($conn, $query2, $rs_status);
	
	$query3 = sprintf("select customer_id, first_name,last_name from tbl_customer_info order by first_name ");
	$n3 = db_select_query($conn, $query3, $rs_custpmer);
		
		} 	
	}	
 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);	
	 db_close($conn);	 
	//header("Location: customer-list.php");	
	?>
	<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<main class="pl-1 pt-1">
<div class="container">
<!--Section: Main panel-->
<section class="mb-3">
<!--Card-->
<div class="card card-cascade narrower">
	<!--Section: Table-->
	<section class="text-dark">
		<!--Top Table UI-->
		<div class="table-ui p-0 mb-0 mx-0 mb-0">
			<!--Grid row-->
			<h6 class="font-weight-bold pl-2 pt-1">Admin Dashboard</h6>
			<hr class="light-blue lighten-1 title-hr">
			<!--Grid row-->
		</div>
		<!--Top Table UI-->
	</section>
	<!--Section: Table-->
</div>
<!--/.Card-->
</section>
<!--Section: Main panel-->   

<!-- Register form -->
<form name="form1" action="assigned-package-update.php" method="post" enctype="multipart/form-data">
<input name="package-id" type="hidden" id="package-id" value="<?php echo $rs_package[0]["package_id"]; ?>">
<input name="assign_status" type="hidden" id="assign_status" value="1">
<p class="h5 text-center mb-0">Package Info</p>
<hr class="light-blue lighten-1 title-hr">
<!--Grid row-->
<div class="row">
	  <!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-archive prefix grey-text"></i>
			<label for="track_num" class="active">Truck Number</label>
			<input name="track_num" type="text" id="track_num" class="form-control" value="<?php echo  $rs_package[0]["track_num"]; ?>" readonly>
		</div>
	</div>
	<!--Grid column-->
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-archive prefix grey-text"></i>
			<label for="weight" class="active">Package Weight</label>
			<input name="weight" type="text" id="weight" class="form-control" value="<?php echo  $rs_package[0]["weight"]; ?>" readonly>
		</div>
	</div>
	<!--Grid column-->
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-cube prefix grey-text"></i>
			<label for="criteria" class="active">Criteria</label>
			<input name="criteria" type="text" id="criteria" class="form-control" value="<?php echo  $rs_package[0]["criteria"]; ?>" readonly>
		</div>
	</div>
	<!--Grid column-->
	
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-box-open prefix grey-text"></i>
			<label for="quantity" class="active">Quantity</label>
			<input name="quantity" type="quantity" id="quantity" class="form-control" value="<?php echo  $rs_package[0]["quantity"]; ?>" readonly>
		</div>
	</div>
	<!--Grid column-->				
								 
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-audio-description prefix grey-text"></i>
			<label for="description" class="active">Description</label>
			<textarea name="description" type="text" class="form-control md-textarea" id="description" readonly> <?php echo  $rs_package[0]["description"]; ?></textarea>
		</div>
	</div>
	<!--Grid column-->
	
	<!--Grid column-->
<div class="col-md-4 mb-4 p-4">
 <i class="fas fa-people-carry prefix grey-text"></i>
 <label for="address" class="active">Is fragile</label>
  <div>	
   
				  
	<!-- Default inline 1-->
			<i class="far fa-check-circle prefix grey-text"></i>
			<div class="custom-control custom-radio custom-control-inline" > 
				<input name="is_fragile" type="radio" class="custom-control-input" id="is_fragile" value="Yes" disabled <?php if($rs_package[0]["is_fragile"] == 'Yes') echo " checked"; ?>>
				<label class="custom-control-label" for="is_fragile">Yes</label>
			</div>
			
			<!-- Default inline 2-->
			<i class="far fa-times-circle"></i>
			<div class="custom-control custom-radio custom-control-inline">
				<input name="is_fragile" type="radio" class="custom-control-input" id="isfragile" disabled value="No" <?php if($rs_package[0]["is_fragile"] == 'No') echo " checked"; ?>>
				<label class="custom-control-label" for="isfragile">No</label>
			</div>
  </div>
</div>
<!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-search-location prefix grey-text"></i>
                        <label for="zone_name" class="active">Zone</label>
                        <input name="zone_name" type="text" id="zone_name" class="form-control" value="<?php echo  $rs_package[0]["zone_name"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
				<!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-city prefix grey-text"></i>
                        <label for="city_name" class="active">City</label>
                        <input name="city_name" type="text" id="city_name" class="form-control" value="<?php echo  $rs_package[0]["city_name"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
            </div>
<!--Grid column-->
	 </div>
	 <!--Grid row-->
			 <span>Sender Details</span>
				  <hr class="light-blue lighten-1 title-hr">			  
			<!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="first_name" class="active">Frist Name</label>
                        <input name="first_name" type="text" id="first_name" class="form-control" value="<?php echo  $rs_package[0]["first_name"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="last_name" class="active">Last Name</label>
                        <input name="last_name" type="text" id="last_name" class="form-control" value="<?php echo  $rs_package[0]["last_name"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
				 
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="email" class="active">Email</label>
                        <input name="email" type="email" id="email" class="form-control" value="<?php echo  $rs_package[0]["email"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->				
               
			  
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="mobile" class="active">Cell Phone</label>
                        <input name="mobile" type="text" id="mobile" class="form-control" value="<?php echo  $rs_package[0]["mobile"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
				   <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="address" class="active">Address</label>
                        <textarea name="address" type="text" class="form-control md-textarea" id="address" readonly> <?php echo  $rs_package[0]["address"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column--> 				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-globe prefix grey-text"></i>
                        <label for="country_id" class="active">Country</label>
                        <select name="country_id" class=" form-control" disabled>
							<option value="" selected >Select Country</option>
							<?php 
							for($i=0; $i<$n1; $i++){
							?>
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"<?php if($rs_country[$i]["country_id"] == $rs_package[0]["country_id"]) echo " selected"; ?>><?php echo $rs_country[$i]["country_name"]; ?></option>
							<?php 
							} 
							?>
						</select>
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
	 <span>Shipment Details</span>
	  <hr class="light-blue lighten-1 title-hr">
	<div class="row">
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-truck prefix grey-text"></i>
			<label for="emp_id" class="active">Assigned Employee</label>
			<select name="emp_id" class=" form-control" disabled>
				<option value="" selected >Select Employee Name</option>
				<?php 
				for($i=0; $i<$n1; $i++){
				?>
				<option value="<?php echo $rs_employee[$i]["emp_id"]; ?>"<?php if($rs_employee[$i]["emp_id"] == $rs_package[0]["emp_id"]) echo " selected"; ?>><?php echo $rs_employee[$i]["first_name"]."".$rs_employee[$i]["last_name"]; ?></option>
				<?php 
				} 
				?>
			</select>
		</div>
	</div>
	<!--Grid column-->
	
	        <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_first_name" class="active">Receiver/Customer First Name</label>
                        <input name="c_first_name" type="text" id="c_first_name" class="form-control" value="<?php echo  $rs_package[0]["c_first_name"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
				
	           <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_last_name" class="active">Receiver/Customer Last Name</label>
                        <input name="c_last_name" type="text" id="c_last_name" class="form-control" value="<?php echo  $rs_package[0]["c_last_name"]; ?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
	
	
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-truck prefix grey-text"></i>
			<label for="status_id" class="active">Status</label>
			<select name="status_id" class=" form-control" disabled>
				<option value="" selected >Select Status</option>
				<?php 
				for($i=0; $i<$n2; $i++){
				?>
				<option value="<?php echo $rs_status[$i]["status_id"]; ?>"<?php if($rs_status[$i]["status_id"] == $rs_package[0]["status_id"]) echo " selected"; ?>><?php echo $rs_status[$i]["status"]; ?></option>
				<?php 
				} 
				?>
			</select>
		</div>
	</div>
   
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-map-marker-alt prefix grey-text"></i>
			<label for="current_loc" class="active">Current location</label>
			<textarea name="current_loc" type="text" class="form-control md-textarea" id="current_loc" readonly><?php echo  $rs_package[0]["current_loc"]; ?></textarea>
		</div>
	</div>
	<!--Grid column-->
	<!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-map-marker-alt prefix grey-text"></i>
			<label for="destination" class="active">Destination</label>
			<textarea name="destination" type="text" class="form-control md-textarea" id="destination" readonly><?php echo  $rs_package[0]["destination"]; ?> </textarea>
		</div>
	</div>
	<!--Grid column-->
	 <!--Grid column-->
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-clock prefix grey-text"></i>
			<label for="departure_time" class="active">Departure Time</label>
			 <input name="departure_time" type="text" class="form-control departure_time" value="<?php echo  $rs_package[0]["departure_time"]; ?>" readonly>
			
		</div>
	</div>
	
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-clock prefix grey-text"></i>
			<label for="delivery_time" class="active">Estimated Delivery Time</label>
			 <input name="delivery_time" type="text" class="form-control delivery_time" value="<?php echo  $rs_package[0]["delivery_time"]; ?>" readonly>
			
		</div>
	</div>
	
	<div class="col-md-4 mb-4">
		<div>
			<i class="fas fa-clock prefix grey-text"></i>
			<label for="arrival_time" class="active">Arrival Time</label>
			 <input name="arrival_time" type="text" class="form-control arrival_time" value="<?php echo  $rs_package[0]["arrival_time"]; ?>" readonly>
		 </div>
	</div>               
</div>

</form>
<!-- Register form -->

<!--Grid column-->
</div>
</main>
<!--Main layout-->

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
