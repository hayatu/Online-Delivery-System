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
		 
	$query = sprintf("select * from tbl_customer_info where customer_id = %s", GetSQLValueString($_REQUEST["customer-id"], "int") );
	$n = db_select_query($conn, $query, $rs_customer);
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
        <form name="form1" action="customer-update.php" method="post" enctype="multipart/form-data">
		<input name="customer-id" type="hidden" id="customer-id" value="<?php echo $rs_customer[0]["customer_id"]; ?>">
            <p class="h5 text-center mb-0">Customer Update Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_first_name" class="active">Frist Name</label>
                        <input name="c_first_name" type="text" id="c_first_name" class="form-control" value="<?php echo  $rs_customer[0]["c_first_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="c_last_name" class="active">Last Name</label>
                        <input name="c_last_name" type="text" id="c_last_name" class="form-control" value="<?php echo  $rs_customer[0]["c_last_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="c_email" class="active">Email</label>
                        <input name="c_email" type="email" id="c_email" class="form-control" value="<?php echo  $rs_customer[0]["c_email"]; ?>">
                    </div>
                </div>
                <!--Grid column-->				
				              			
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="c_mobile" class="active">Cell Phone</label>
                        <input name="c_mobile" type="text" id="c_mobile" class="form-control" value="<?php echo  $rs_customer[0]["c_mobile"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="c_address" class="active">Address</label>
                        <textarea name="c_address" type="text" class="form-control md-textarea" id="c_address"> <?php echo  $rs_customer[0]["c_address"]; ?></textarea>
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