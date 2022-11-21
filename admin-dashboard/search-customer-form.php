<?php require_once("authenticate.php");?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>
<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	
		ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);		
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();	
	
	
	  $query1 = sprintf("select customer_id, first_name, last_name from tbl_customer_info");
	$n1 = db_select_query($conn, $query1, $rs_customer);
		
	
	  $query3 = sprintf("select emp_id, first_name, last_name from tbl_employee_info");
	$n3 = db_select_query($conn, $query3, $rs_employee);
 
?>	
	<!-- Navbar -->

<!-- /.Navbar -->
<main class="pl-1 pt-1">
	<div class="container">
	<!-- Track form -->
	<form name="form1" action="package-registration-form.php" method="POST" enctype="multipart/form-data">
	
	 <!--Grid row-->
            <div class="row">
			<div class="col-md-4 pt-1 p-0">
			<select name="first_name" class=" form-control">
				<option value="0" selected >Customer First Name</option>
				<?php 
				for($i=0; $i<$n1; $i++){
				?>
				<option value="<?php echo $rs_customer[$i]["first_name"]; ?>"><?php echo $rs_customer[$i]["first_name"]; ?></option>

				<?php 
				} 
				?>
				</select>
				</div>
				 <!--Grid column-->
				 <div class="col-md-4 pt-1 p-0">
			<select name="last_name" class=" form-control">
				<option value="0" selected >Customer Last Name</option>
				<?php 
				for($i=0; $i<$n1; $i++){
				?>
				<option value="<?php echo $rs_customer[$i]["last_name"]; ?>"><?php echo $rs_customer[$i]["last_name"]; ?></option>

				<?php 
				} 
				?>
				</select>
				</div>
				 
			   	
				<div class="col-md-4 p-0">
		<button class="btn btn-primary btn-md" type="submit">Search Customer</button>
		</div>
		</div>
		<!--Grid row-->
	</form>
	<!-- Track form -->

</div>
</main>
<!-- Footer -->


<!-- Footer -->