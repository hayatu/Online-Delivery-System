<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	
	  $query1 = sprintf("select *, tble_countries.country_name,
	 tbl_vehicle_info.plat_number,tbl_vehicle_info.made_model, tbl_vehicle_info.is_owned_by_emp,tbl_vehicle_info.is_available as v_available,tbl_vehicle_info.location "
	."from tbl_employee_info sup "
	."left join tble_countries on sup.country_id = tble_countries.country_id "
	."left join tbl_vehicle_info on sup.vehicle_id = tbl_vehicle_info.vehicle_id "
	."where sup.vehicle_id = %s and sup.deleteflag = 0 order by sup.first_name, tble_countries.country_name" ,
	GetSQLValueString($_REQUEST["emp-id"], "int"));
	$n = db_select_query($conn, $query1, $rs_employee);	
	
	
	 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);
	 	
	//$query = sprintf("select * from tbl_employee_info where emp_id = %s", GetSQLValueString($_REQUEST["emp-id"], "int") );
	//$n = db_select_query($conn, $query, $rs_employee);
	db_close($conn);
?>

<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<script type="text/javascript" src="js/date-picker.min.js"></script>
<style type="text/css">
   #main {
        height:100px;
        }
            #color {
        margin-left: 10%;
        width:50%;
        }
  </style> 
   
    <script src="bgcolor/popper.min.js"></script>
    <script src="bgcolor/bootstrap.min.js"></script>
    <link href="bgcolor/bootstrap-colorpicker.css" rel="stylesheet">
    <script src="bgcolor/bootstrap-colorpicker.js"></script>
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
        <form name="form1" action="employee-vehicle-update.php" method="post" enctype="multipart/form-data">
		<input name="emp-id" type="hidden" id="emp-id" value="<?php echo $rs_employee[0]["vehicle_id"]; ?>">
            <p class="h5 text-center mb-0">Employee Update Form</p>
            <hr class="light-blue lighten-1 title-hr">
			<!--Grid row-->
            <div class="row">
			<!--Grid column-->
			<div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="plat_number" class="active">Plate Number</label>
                        <input name="plat_number" type="text" id="plat_number" class="form-control" value="<?php echo  $rs_employee[0]["plat_number"]; ?>">
                    </div>
                </div>
				<!--Grid column-->
				
				<!--Grid column-->
			  <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="made_model" class="active">Vehicle Model</label>
                        <input name="made_model" type="text" id="made_model" class="form-control" value="<?php echo  $rs_employee[0]["made_model"]; ?>">
                    </div>
                </div>
				<!--Grid column-->
				
				 <!--Grid column-->
            <div class="col-md-3 mb-4 p-4">
			 <i class="fas fa-car-side prefix grey-text"></i>
                        <label for="made_model" class="active"> Is Vehicle Available?</label>
              <div>	
               
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_available" type="radio" class="custom-control-input" id="v_available" value="Yes" <?php if($rs_employee[0]["v_available"] == 'Yes') echo " checked"; ?>>
							<label class="custom-control-label" for="v_available">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_available" type="radio" class="custom-control-input" id="vavailable" value="No" <?php if($rs_employee[0]["v_available"] == 'No') echo " checked"; ?>>
							<label class="custom-control-label" for="vavailable">No</label>
						</div>
              </div>
            </div>
            <!--Grid column-->
			<!--Grid column-->
            <div class="col-md-3 mb-4 p-4">
			 <i class="fas fa-car-side prefix grey-text"></i>
                        <label for="made_model" class="active">Is Vehicle Owned by Employee?</label>
              <div>	
               
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_owned_by_emp" type="radio" class="custom-control-input" id="is_owned_by_emp" value="Yes" <?php if($rs_employee[0]["is_owned_by_emp"] == 'Yes') echo " checked"; ?>>
							<label class="custom-control-label" for="is_owned_by_emp">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_owned_by_emp" type="radio" class="custom-control-input" id="isowned_by_emp" value="No" <?php if($rs_employee[0]["is_owned_by_emp"] == 'No') echo " checked"; ?>>
							<label class="custom-control-label" for="isowned_by_emp">No</label>
						</div>
              </div>
            </div>
            <!--Grid column-->
				<!--Grid column-->
			  <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-map-marker-alt prefix grey-text"></i>
                        <label for="location " class="active">Location</label>
                        <input name="location" type="text" id="location" class="form-control" value="<?php echo  $rs_employee[0]["location"]; ?>">
                    </div>
                </div>
				<!--Grid column-->
			  </div>
			<span>Employee Details</span>
				  <hr class="light-blue lighten-1 title-hr">			  
			<!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="first_name" class="active">Frist Name</label>
                        <input name="first_name" type="text" id="first_name" class="form-control" value="<?php echo  $rs_employee[0]["first_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="last_name" class="active">Last Name</label>
                        <input name="last_name" type="text" id="last_name" class="form-control" value="<?php echo  $rs_employee[0]["last_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-calendar-week prefix grey-text"></i>
                        <label for="date_birth" class="active">Date of Birth</label>
                        <input name="date_birth" type="text" id="datepicker" class="form-control" value="<?php echo  $rs_employee[0]["date_birth"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="email" class="active">Email</label>
                        <input name="email" type="email" id="email" class="form-control" value="<?php echo  $rs_employee[0]["email"]; ?>">
                    </div>
                </div>
                <!--Grid column-->				
               
			  
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="mobile" class="active">Cell Phone</label>
                        <input name="mobile" type="text" id="mobile" class="form-control" value="<?php echo  $rs_employee[0]["mobile"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
			 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="address" class="active">Address</label>
                        <textarea name="address" type="text" class="form-control md-textarea" id="address"> <?php echo  $rs_employee[0]["address"]; ?></textarea>
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
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"<?php if($rs_country[$i]["country_id"] == $rs_employee[0]["country_id"]) echo " selected"; ?>><?php echo $rs_country[$i]["country_name"]; ?></option>
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
                        <i class="fas fa-palette prefix grey-text"></i>
                        <label for="bgcolor" class="active">Background Color</label>
                        <input name="bgcolor" type="text" id="color" value="<?php echo  $rs_employee[0]["bgcolor"]; ?>" class="form-control" required>  
                    </div>
                </div>
               
			
				<!--Grid column-->
            <div class="col-md-4 mb-4 p-4">
			 <i class="fas fa-user-cog prefix grey-text"></i>
			 <label for="address" class="active">Enable/Disable</label>
              <div>	
               
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_enabled" type="radio" class="custom-control-input" id="Enabled" value="1" <?php if($rs_employee[0]["is_enabled"] == 1) echo " checked"; ?>>
							<label class="custom-control-label" for="Enabled">Enable</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_enabled" type="radio" class="custom-control-input" id="Disable" value="0" <?php if($rs_employee[0]["is_enabled"] == 0) echo " checked"; ?>>
							<label class="custom-control-label" for="Disable">Disable</label>
						</div>
              </div>
            </div>
            <!--Grid column-->
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
$('#datepicker').datepicker(
{		
autoclose: true,
format: 'yyyy/mm/dd',
todayHighlight: true,
});  		
</script>
<script type="text/javascript">
      $(function () {
        $('#color')
        .colorpicker({})
        .on('colorpickerChange', function (e) { //change the bacground color of the main when the color changes  
            new_color = e.color.toString()
            $('#main').css('background-color', new_color)
        })     
    });
</script>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->