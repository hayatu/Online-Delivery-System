<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	$query = sprintf("select * from tbl_package_info where package_id = %s", GetSQLValueString($_REQUEST["package-id"], "int") );
	$n = db_select_query($conn, $query, $rs_package);
	
	 $query2 = sprintf("select * from tbl_customer_info where customer_id = %s", GetSQLValueString($_REQUEST["customer-id"], "int") );
	$n2 = db_select_query($conn, $query2, $rs_customer);
	
	 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);
	db_close($conn);
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
        <form name="form1" action="package-update.php" method="post" enctype="multipart/form-data">
		<input name="package-id" type="hidden" id="package-id" value="<?php echo $rs_package[0]["package_id"]; ?>">
		<input name="customer-id" type="hidden" id="customer-id" value="<?php echo $rs_customer[0]["customer_id"]; ?>">
            <p class="h5 text-center mb-0">Package Update Form</p>
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
                        <input name="weight" type="text" id="weight" class="form-control" value="<?php echo  $rs_package[0]["weight"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
						
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-cube prefix grey-text"></i>
                        <label for="criteria" class="active">Criteria</label>
                        <input name="criteria" type="text" id="criteria" class="form-control" value="<?php echo  $rs_package[0]["criteria"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-box-open prefix grey-text"></i>
                        <label for="quantity" class="active">Quantity</label>
                        <input name="quantity" type="text" id="quantity" class="form-control" value="<?php echo  $rs_package[0]["quantity"]; ?>">
                    </div>
                </div>
                <!--Grid column-->				
				                             
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-audio-description prefix grey-text"></i>
                        <label for="description" class="active">Description</label>
                        <textarea name="description" type="text" class="form-control md-textarea" id="description"> <?php echo  $rs_package[0]["description"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column-->
				<!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-box-open prefix grey-text"></i>
                        <label for="pickupprice" class="active">Pickup Price</label>
                        <input name="pickupprice" type="text" id="pickupprice" class="form-control" value="<?php echo  $rs_package[0]["pickupprice"]; ?>">
                    </div>
                </div>
                <!--Grid column-->		
							
				<!--Grid column-->
            <div class="col-md-3 mb-4 p-4">
			 <i class="fas fa-people-carry prefix grey-text"></i>
			 <label for="address" class="active">Is fragile</label>
              <div>	
               
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_fragile" type="radio" class="custom-control-input" id="is_fragile" value="Yes" <?php if($rs_package[0]["is_fragile"] == 'Yes') echo " checked"; ?>>
							<label class="custom-control-label" for="is_fragile">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_fragile" type="radio" class="custom-control-input" id="isfragile" value="No" <?php if($rs_package[0]["is_fragile"] == 'No') echo " checked"; ?>>
							<label class="custom-control-label" for="isfragile">No</label>
						</div>
              </div>
            </div>
            <!--Grid column-->
			<!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-search-location prefix grey-text"></i>
                        <label for="zone_name" class="active">Zone</label>
                        <input name="zone_name" type="text" id="zone_name" class="form-control" value="<?php echo  $rs_package[0]["zone_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				<!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-city prefix grey-text"></i>
                        <label for="city_name" class="active">City</label>
                        <input name="city_name" type="text" id="city_name" class="form-control" value="<?php echo  $rs_package[0]["city_name"]; ?>">
                    </div>
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
                        <input name="first_name" type="text" id="first_name" class="form-control" value="<?php echo  $rs_package[0]["first_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="last_name" class="active">Last Name</label>
                        <input name="last_name" type="text" id="last_name" class="form-control" value="<?php echo  $rs_package[0]["last_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				 
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="email" class="active">Email</label>
                        <input name="email" type="email" id="email" class="form-control" value="<?php echo  $rs_package[0]["email"]; ?>">
                    </div>
                </div>
                <!--Grid column-->				
               
			  
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="mobile" class="active">Cell Phone</label>
                        <input name="mobile" type="text" id="mobile" class="form-control" value="<?php echo  $rs_package[0]["mobile"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				   <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="address" class="active">Address</label>
                        <textarea name="address" type="text" class="form-control md-textarea" id="address"> <?php echo  $rs_package[0]["address"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column--> 				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-globe prefix grey-text"></i>
                        <label for="country_id" class="active">Country</label>
                        <select name="country_id" class=" form-control" required>
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
			 <span>Reciever/Customer Details</span>
				  <hr class="light-blue lighten-1 title-hr">
				  <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_first_name" class="active">Frist Name</label>
                        <input name="c_first_name" type="text" id="c_first_name" class="form-control" value="<?php echo  $rs_package[0]["c_first_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_last_name" class="active">Last Name</label>
                        <input name="c_last_name" type="text" id="c_last_name" class="form-control" value="<?php echo  $rs_package[0]["c_last_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="c_email" class="active">Email</label>
                        <input name="c_email" type="email" id="c_email" class="form-control" value="<?php echo  $rs_package[0]["c_email"]; ?>">
                    </div>
                </div>
                <!--Grid column-->				
				              			
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="c_mobile" class="active">Cell Phone</label>
                        <input name="c_mobile" type="text" id="c_mobile" class="form-control" value="<?php echo  $rs_package[0]["c_mobile"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="c_address" class="active">Address</label>
                        <textarea name="c_address" type="text" class="form-control md-textarea" id="c_address"> <?php echo  $rs_package[0]["c_address"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column-->				
           
				 			
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-globe prefix grey-text"></i>
                        <label for="c_country_id" class="active">Country</label>
                        <select name="c_country_id" class=" form-control" required>
							<option value="" selected >Select Country</option>
							<?php 
							for($i=0; $i<$n1; $i++){
							?>
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"<?php if($rs_country[$i]["country_id"] == $rs_package[0]["c_country_id"]) echo " selected"; ?>><?php echo $rs_country[$i]["country_name"]; ?></option>
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
           <!--Grid row-->
            <div class="row">
			 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-search-location prefix grey-text"></i>
                        <label for="current_loc" class="active">Current Location</label>
                        <textarea name="current_loc" type="text" class="form-control md-textarea" id="current_loc"> <?php echo  $rs_package[0]["current_loc"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column-->	
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-search-location prefix grey-text"></i>
                        <label for="destination" class="active">Destination</label>
                        <textarea name="destination" type="text" class="form-control md-textarea" id="destination"> <?php echo  $rs_package[0]["destination"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column-->
              <!--Grid column-->
				 <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-clock prefix grey-text"></i>
                         <label for="departure_time" class="active">Departure Time</label>
						 <input name="departure_time" type="text" class="form-control departure_time" value="<?php echo  $rs_package[0]["departure_time"]; ?>">
                        
                    </div>
                </div>				
			</div>
            <!--Grid row-->
            <div class="text-center mt-4">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
        <!-- Register form -->
   
        <!--Grid column-->
    </div>
</main>
<!--Main layout-->
<script>
   $(document).ready(function() {
        
        $('.departure_time').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
           format: 'h:mm:ss A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
           icons: {
               time: "fa fa-clock-o",
               date: "fa fa-calendar",
               up: "fa fa-chevron-up",
               down: "fa fa-chevron-down",
               previous: 'fa fa-chevron-left',
               next: 'fa fa-chevron-right',
               today: 'fa fa-screenshot',
               clear: 'fa fa-trash',
               close: 'fa fa-remove'

           }
        });
});
</script>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->