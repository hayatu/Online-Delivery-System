<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);
	
	 $query2 = sprintf("select vehicle_id, plat_number from tbl_vehicle_info order by plat_number ");
	$n2 = db_select_query($conn, $query2, $rs_vehicle);
	
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
        <form name="form1" action="employee-vehicle-insert.php" method="post" enctype="multipart/form-data">
            <p class="h5 text-center mb-0">Vehicle Registration Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-car-side prefix grey-text"></i>  
                        <label for="made_model" class="active">Vehicle Model</label>
                        <input name="made_model" type="text" id="made_model" class="form-control" placeholder="Vehicle Model" required>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-list-ol prefix grey-text"></i>
                        <label for="plat_number" class="active">Plate Number </label> 
                        <input name="plat_number" type="text" id="plat_number" class="form-control" placeholder="Plate Number" required>
                    </div>
                </div>
                <!--Grid column-->
				   <!--Grid column-->
            <div class="col-md-3 mb-3">
			 <i class="fas fa-car-side prefix grey-text"></i>
			 <label for="viecles" class="active">Is Vehicle Available?</label>
              <div>	
               
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_available" type="radio" class="custom-control-input" id="is_available" value="Yes" checked="checked">
							<label class="custom-control-label" for="is_available">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_available" type="radio" class="custom-control-input" id="isfragile" value="No">
							<label class="custom-control-label" for="isfragile">No</label>
						</div>
              </div>
            </div>
            <!--Grid column-->                          		           
				<!--Grid column-->
            <div class="col-md-3 mb-3">
			 <i class="fas fa-car-side prefix grey-text"></i>
			 <label for="viecles" class="active">Is Vehicle Owned by Employee?</label>
              <div>	
							  
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_owned_by_emp" type="radio" class="custom-control-input" id="is_owned_by_emp" value="Yes" checked="checked">
							<label class="custom-control-label" for="is_owned_by_emp">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_owned_by_emp" type="radio" class="custom-control-input" id="isowned_by_emp" value="No">
							<label class="custom-control-label" for="isowned_by_emp">No</label>
						</div>
              </div>
            </div>
            <!--Grid column-->      
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-map-marker-alt prefix grey-text"></i>
                        <label for="location" class="active">location</label>
                        <textarea name="location" type="text" class="form-control md-textarea" id="location" placeholder="location" required rows="3"></textarea>
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
                        <i class="fas fa-calendar-week prefix grey-text"></i>
                        <label for="mobile" class="active">Date of Birth</label>
                        <input name="date_birth" type="text" id="datepicker" placeholder="Date of Birth" class="form-control" required>  
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
							for($i=0; $i<$n1; $i++){
							?>
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"><?php echo $rs_country[$i]["country_name"]; ?></option>
							<?php 
							} 
							?>
						</select>
                    </div>
                </div>
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-palette prefix grey-text"></i>
                        <label for="mobile" class="active">Background Color</label>
                        <input name="bgcolor" type="text" id="color" value="#269faf" class="form-control" required>  
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
				<!--Grid column-->
				<!--<div class="col-md-4 mb-4">
				<div>
				<i class="fas fa-truck prefix grey-text"></i>
				
				<script type="text/javascript">
				function ShowHideDiv() {
				var ddlVehicle = document.getElementById("ddlVehicle");
				var dvVehicle = document.getElementById("dvVehicle");
				dvVehicle.style.display = ddlVehicle.value == "Y" ? "block" : "none";
				}
				</script>
				<span>Does Employee has a vehicle?</span>
				<select id="ddlVehicle" onchange="ShowHideDiv()">
				<option value="No">No</option>
				<option value="Y">Yes</option>
				</select>
				<hr />
				<div id="dvVehicle" style="display: none">
				<i class="fas fa-truck prefix grey-text"></i>
				<label for="mobile" class="active">Cell Phone</label>
                <input name="mobile" type="text" id="mobile" class="form-control" placeholder="Phone Number" required>
				</div>
				</div>
				</div>-->
                <!--Grid column-->
			</div>
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