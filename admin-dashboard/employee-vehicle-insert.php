<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
  
 if($_REQUEST["plat_number"] != ""){
 
 $plat_number = $_REQUEST['plat_number'];
 	$email = $_REQUEST['email'];
		$query = sprintf("SELECT plat_number FROM tbl_vehicle_info where plat_number = %s ", GetSQLValueString($_REQUEST["plat_number"], "text"));
		$n = db_select_query($conn, $query, $rs_vehicle);
		
		$query = sprintf("SELECT email FROM tbl_employee_info where email = %s ", GetSQLValueString($_REQUEST["email"], "text"));
		$n = db_select_query($conn, $query, $rs_users);

		if($n > 0){
		// do not insert
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 The Plate Number or Email already exists!.
				 <button class='btn btn-primary btn-sm btn-link'><a href='employee-vehicle-registration-form.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit();
		} else {
			// insert 
			  $query1 = sprintf("insert into tbl_vehicle_info(made_model, plat_number,is_available,is_owned_by_emp,location) values(%s, %s, %s,%s,%s)", 
			GetSQLValueString($_REQUEST["made_model"], "text"),
			GetSQLValueString($_REQUEST["plat_number"], "text"),
			GetSQLValueString($_REQUEST["is_available"], "text"),	
            GetSQLValueString($_REQUEST["is_owned_by_emp"], "text"),			
			GetSQLValueString($_REQUEST["location"], "text"));
			$n1 = db_other_query($conn, $query1);
			$n2 =db_insert_id($conn);
			$vehice_id =db_insert_id($conn);
			
			  $query2 = sprintf("insert into tbl_employee_info(first_name, last_name,email, mobile,date_birth, vehicle_id, address,bgcolor,country_id) values(%s, %s, %s, %s, %s,%s,%s,%s,%s)", 
									GetSQLValueString($_REQUEST["first_name"], "text"),
									GetSQLValueString($_REQUEST["last_name"], "text"),
									GetSQLValueString($_REQUEST["email"], "text"),
									GetSQLValueString($_REQUEST["mobile"], "text"),
									GetSQLValueString($_REQUEST["date_birth"], "text"),
									GetSQLValueString($vehice_id, "int"),
									GetSQLValueString($_REQUEST["address"], "text"),
									GetSQLValueString($_REQUEST["bgcolor"], "text"),
									GetSQLValueString($_REQUEST["country_id"], "int"));
			$n2 = db_other_query($conn, $query2);
		} 	
	 db_close($conn);	 
	//header("Location: employee-list.php");	
	} 
	?>

