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
        <form name="form1" action="vehicle-insert.php" method="post" enctype="multipart/form-data">
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
                        <label for="location" class="active">Current location</label>
                        <textarea name="location" type="text" class="form-control md-textarea" id="location" placeholder="location" required rows="3"></textarea>
                    </div>
                </div>
                <!--Grid column-->
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

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->