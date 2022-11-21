<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	
	 $query = sprintf("select * from tbl_vehicle_info where vehicle_id = %s", GetSQLValueString($_REQUEST["vehicle-id"], "int") );
	$n = db_select_query($conn, $query, $rs_vehicle);
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
        <form name="form1" action="vehicle-update.php" method="post" enctype="multipart/form-data">
		<input name="vehicle-id" type="hidden" id="vehicle-id" value="<?php echo $rs_vehicle[0]["vehicle_id"]; ?>">
            <p class="h5 text-center mb-0">Vehicle Update Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="made_model" class="active">vehicle Model</label>
                        <input name="made_model" type="text" id="made_model" class="form-control" value="<?php echo  $rs_vehicle[0]["made_model"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="plat_number" class="active">Plate Number</label>
                        <input name="plat_number" type="text" id="plat_number" class="form-control" value="<?php echo  $rs_vehicle[0]["plat_number"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				<!--Grid column-->
            <div class="col-md-3 mb-4 p-4">
			 <i class="fas fa-car-side prefix grey-text"></i>
			 <label for="vehicle" class="active">Is Vehicle Available?</label>
              <div>              
					  
                <!-- Default inline 1-->
						 
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_available" type="radio" class="custom-control-input" id="is_available" value="Yes" <?php if($rs_vehicle[0]["is_available"] == 'Yes') echo " checked"; ?>>
							<label class="custom-control-label" for="is_available">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_available" type="radio" class="custom-control-input" id="isfragile" value="No" <?php if($rs_vehicle[0]["is_available"] == 'No') echo " checked"; ?>>
							<label class="custom-control-label" for="isfragile">No</label>
						</div>
              </div>
            </div>
		<!--Grid column-->
		
		 <!--Grid column-->
            <div class="col-md-3 mb-4 p-4">
			 <i class="fas fa-car-side prefix grey-text"></i>
			 <label for="vehicle" class="active">Is Vehicle Owned by Employee?</label>
              <div>              
					  
                <!-- Default inline 1-->
						 
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_owned_by_emp" type="radio" class="custom-control-input" id="is_owned_by_emp" value="Yes" <?php if($rs_vehicle[0]["is_owned_by_emp"] == 'Yes') echo " checked"; ?>>
							<label class="custom-control-label" for="is_owned_by_emp">Yes</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_owned_by_emp" type="radio" class="custom-control-input" id="isowned_by_emp" value="No" <?php if($rs_vehicle[0]["is_owned_by_emp"] == 'No') echo " checked"; ?>>
							<label class="custom-control-label" for="isowned_by_emp">No</label>
						</div>
              </div>
            </div>
		<!--Grid column-->
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-location prefix grey-text"></i>
                        <label for="location" class="active">Current Location </label>
                        <textarea name="location" type="text" class="form-control md-textarea" id="location"> <?php echo  $rs_vehicle[0]["location"]; ?></textarea>
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

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->