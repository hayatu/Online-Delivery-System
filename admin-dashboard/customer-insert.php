<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
  
 if($_REQUEST["c_email"] != ""){
 
 $email = $_REQUEST['c_email'];
		$query = sprintf("SELECT c_email FROM tbl_customer_info where c_email = %s ", GetSQLValueString($_REQUEST["c_email"], "text"));
		$n = db_select_query($conn, $query, $rs_users);

		if($n > 0){
		// do not insert
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 The email address already exists!.
				 <button class='btn btn-primary btn-sm btn-link'><a href='customer-registration-form.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit();
		} else {
			// insert 
			     $query1 = sprintf("insert into tbl_customer_info(c_first_name, c_last_name,c_email, c_mobile, c_address, c_country_id) values(%s, %s, %s, %s, %s,%s)", 
									GetSQLValueString($_REQUEST["c_first_name"], "text"),
									GetSQLValueString($_REQUEST["c_last_name"], "text"),							
									GetSQLValueString($_REQUEST["c_email"], "text"),									
									GetSQLValueString($_REQUEST["c_mobile"], "text"),			GetSQLValueString($_REQUEST["c_address"], "text"),
									GetSQLValueString($_REQUEST["c_country_id"], "int"));
			$n1 = db_other_query($conn, $query1);
			
		} 	
	}		
	 db_close($conn);	 
	header("Location: customer-list.php");	
	?>

