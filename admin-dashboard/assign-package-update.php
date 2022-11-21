<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();

 $query1 = sprintf("select vehicle_id from tbl_employee_info where emp_id = %s",
GetSQLValueString($_REQUEST["emp_id"], "int"));
	$n = db_select_query($conn, $query1, $rs_package);	
	$modified_date = date("y-m-d H:i:s");
$vehicleid= $rs_package[0]["vehicle_id"];

	     $query2 = sprintf("update tbl_package_info set weight = %s, criteria = %s, quantity= %s ,description = %s,pickupprice = %s, is_fragile = %s, accept_decline = Null, zone_name = %s , city_name = %s, departure_time= %s, delivery_time = %s, emp_id = %s,status_id = %s,current_loc = %s,destination = %s, vehicle_id = %s, assign_status= %s,modifieddate= '$modified_date' where package_id = %s",						
			GetSQLValueString($_REQUEST["weight"], "text"),
			GetSQLValueString($_REQUEST["criteria"], "text"),							
			GetSQLValueString($_REQUEST["quantity"], "text"),									
			GetSQLValueString($_REQUEST["description"], "text"),
			GetSQLValueString($_REQUEST["pickupprice"], "text"),
			GetSQLValueString($_REQUEST["is_fragile"], "text"),
			GetSQLValueString($_REQUEST["zone_name"], "text"),
			GetSQLValueString($_REQUEST["city_name"], "text"),
			GetSQLValueString($_REQUEST["departure_time"], "text"),
			GetSQLValueString($_REQUEST["delivery_time"], "text"),								
			GetSQLValueString($_REQUEST["emp_id"], "int"),	
			GetSQLValueString($_REQUEST["status_id"], "int"),
			GetSQLValueString($_REQUEST["current_loc"], "text"),
			GetSQLValueString($_REQUEST["destination"], "text"),
			GetSQLValueString($vehicleid, "int"),
			GetSQLValueString($_REQUEST["assign_status"], "int"),
		   GetSQLValueString($_REQUEST["package-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	db_close($conn);	
	header("Location: package-list.php");
	?>

