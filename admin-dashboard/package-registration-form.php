<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>
<?php // given min and max range 
$random = rand(1000,9999); 
?>		
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	 $query2 = sprintf("select zone_id, zone_name from tbl_zone_info order by zone_name");
	$n2 = db_select_query($conn, $query2, $rs_zone);
	
	 $query2 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n2 = db_select_query($conn, $query2, $rs_country);

	$query1 = sprintf("select MAX(vehicle_id) from tbl_vehicle_info");
	$n1 = db_select_query($conn, $query1, $rs_vehicle);
   //$first_name = array_key_exists('first_name', $_POST) ? $_POST['first_name'] : "";
     $query3 = sprintf("select ci.customer_id,ci.c_first_name, ci.c_last_name, ci.c_email,ci.c_mobile, ci.c_address,ci.c_country_id,
	 tble_countries.country_name "
	."from tbl_customer_info  ci "
	."left join tble_countries on ci.c_country_id = tble_countries.country_id "	
	."where ci.customer_id = %s and ci.deleteflag = 0" ,
	GetSQLValueString($_REQUEST["customer-id"], "int"));

	$n3 = db_select_query($conn, $query3, $rs_customer);
	
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
        <form name="form1" action="package-insert.php" method="post" enctype="multipart/form-data">
		  <input name="customer_id" type="hidden" value="<?php echo $rs_customer[0]["customer_id"]; ?>"> 
            <p class="h5 text-center mb-0">Package Registration Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
			<!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-list-ol prefix grey-text"></i>  
                        <label for="track_num" class="active">Track Number </label>
                        <input name="track_num" type="text" id="track_num" class="form-control" value="<?php echo $random;?>" readonly>
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-archive prefix grey-text"></i>  
                        <label for="weight" class="active">Package Weight </label>
                        <input name="weight" type="text" id="weight" class="form-control" placeholder="Package Weight" required>
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-cube prefix grey-text"></i> 
                        <label for="criteria" class="active">Criteria </label> 
                        <input name="criteria" type="text" id="criteria" class="form-control" placeholder="Criteria" required>
                    </div>
                </div>
                <!--Grid column-->
				
				 <!--Grid column-->
                <div class="col-md-4 mb-3">
                    <div>
                        <i class="fas fa-box-open prefix grey-text"></i> 
                        <label for="quantity" class="active">Quantity </label> 
                        <input name="quantity" type="text" id="quantity" class="form-control" placeholder="Quantity" required>
                    </div>
                </div>
                <!--Grid column-->
				                             		           
				
                <!--Grid column-->
                <div class="col-md-4 mb-3">
                    <div>
                        <i class="fas fa-audio-description prefix grey-text"></i>
                        <label for="description" class="active">Description</label>
                        <textarea name="description" type="text" class="form-control md-textarea" id="description" placeholder="description" required rows="3"></textarea>
                    </div>
                </div>
                <!--Grid column-->
				
				  <!--Grid column-->
                <div class="col-md-4 mb-3">
                    <div>
                        <i class="fas fa-dollar-sign prefix grey-text"></i> 
                        <label for="pickupprice" class="active">Pickup Price</label> 
                        <input name="pickupprice" type="text" id="pickupprice" class="form-control" placeholder="Pickup Price" required>
                    </div>
                </div>
                <!--Grid column-->
				
				<!--Grid column-->
            <div class="col-md-4 mb-3">
			 <i class="fas fa-people-carry prefix grey-text"></i>
			 <label for="address" class="active">Is fragile</label>
              <div>	
               
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_fragile" type="radio" class="custom-control-input" id="is_fragile" value="Yes">
							<label class="custom-control-label" for="is_fragile">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_fragile" type="radio" class="custom-control-input" id="isfragile" value="No">
							<label class="custom-control-label" for="isfragile">No</label>
						</div>
              </div>
            </div>
            <!--Grid column-->
			<!--Grid column-->
				<div class="col-md-4 mb-4">
				<div>
				<i class="fas fa-search-location prefix grey-text"></i>
				<script type="text/javascript">
					function ShowHideDiv() {
					var ddlZoneName = document.getElementById("ddlZoneName");
					var dvPassport = document.getElementById("dvPassport");
					dvPassport.style.display = ddlZoneName.value == "East" || ddlZoneName.value == "West"  || ddlZoneName.value == "North"  
					|| ddlZoneName.value == "South" || ddlZoneName.value == "NorthEast" || ddlZoneName.value == "SouthEast"
					|| ddlZoneName.value == "SouthWest" || ddlZoneName.value == "NorthWest"	? "block" : "none";
					}
				</script>
			<span>Destination Zone</span>
			<select name="zone_name" id="ddlZoneName" onchange="ShowHideDiv()">
				<option value="N">Select Zone</option>
				<option value="East">East</option>
				<option value="West">West</option>
				<option value="North">North</option>
				<option value="South">South</option>
				<option value="NorthEast">North East</option>
				<option value="SouthEast">South East</option>
				<option value="SouthWest">South West</option>
				<option value="NorthWest">North West</option>
			</select>
			<hr />
	
    <div id="dvPassport" style="display: none">
	<i class="fas fa-city prefix grey-text"></i>
        City Name:
        <input name="city_name" type="text" id="txtPassportNumber" class="form-control" placeholder="City Name" required />
    </div>
				</div>
				</div>
                <!--Grid column-->
            </div>
			<span>Sender Details</span>
				  <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
			 <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="first_name" class="active">Frist Name</label>
                        <input name="first_name" type="text" id="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="last_name" class="active">Last Name</label>
                        <input name="last_name" type="text" id="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="email" class="active">Email</label>
                        <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required>
                    </div>
                </div>              
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="mobile" class="active">Cell Phone</label>
                        <input name="mobile" type="text" id="mobile" class="form-control" placeholder="Phone Number" required>
                    </div>
                </div>
                <!--Grid column-->
				
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="address" class="active">Address</label>
                        <textarea name="address" type="text" class="form-control md-textarea" id="address" placeholder="Address" required rows="3"></textarea>
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
							for($i=0; $i<$n2; $i++){
							?>
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"><?php echo $rs_country[$i]["country_name"]; ?></option>
							<?php 
							} 
							?>
						</select>
                    </div>
                </div>
                
			</div>
            <!--Grid row-->
			<span>Customer/Reciever Details</span>
				  <hr class="light-blue lighten-1 title-hr">
				   <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_first_name" class="active">Frist Name</label>
                        <input name="c_first_name" type="text" id="c_first_name" class="form-control"  value="<?php echo $rs_customer[0]["c_first_name"]; ?>" required>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_last_name" class="active">Last Name</label>
                        <input name="c_last_name" type="text" id="c_last_name" class="form-control" value="<?php echo $rs_customer[0]["c_last_name"]; ?>" required>
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="c_email" class="active">Email</label>
                        <input name="c_email" type="email" id="c_email" class="form-control" value="<?php echo $rs_customer[0]["c_email"]; ?>" required>
                    </div>
                </div>               
			
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="c_mobile" class="active">Cell Phone</label>
                        <input name="c_mobile" type="text" id="c_mobile" class="form-control" value="<?php echo $rs_customer[0]["c_mobile"]; ?>" required>
                    </div>
                </div>
                <!--Grid column-->
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="c_address " class="active">Address</label>
                        <textarea name="c_address" type="text" class="form-control md-textarea" id="c_address" required rows="3"><?php echo $rs_customer[0]["c_address"]; ?></textarea>
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
							for($i=0; $i<$n2; $i++){
							?>
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"<?php if($rs_country[$i]["country_id"] == $rs_customer[0]["c_country_id"]) echo " selected"; ?>><?php echo $rs_country[$i]["country_name"]; ?></option>
							
							
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
						 <textarea name="current_loc" type="text" class="form-control md-textarea" id="current_loc" placeholder="Current Location" required rows="3"></textarea>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-search-location prefix grey-text"></i>
                        <label for="destination" class="active">Destination</label>
						 <textarea name="destination" type="text" class="form-control md-textarea" id="destination" placeholder="Destination" required rows="3"></textarea>
                    </div>
                </div>
                <!--Grid column-->
				 <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-clock prefix grey-text"></i>
                         <label for="departure_time" class="active">Departure Time</label>
						 <input name="departure_time" type="text" class="form-control departure_time" placeholder="Departure Time" required>
                        
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <div class="text-center mt-4">
                <button class="btn btn-primary" type="submit">Submit</button>
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