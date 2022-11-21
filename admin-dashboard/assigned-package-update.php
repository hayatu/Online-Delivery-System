<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
$modified_date = date("y-m-d H:i:s");
if(isset($_REQUEST["accept_decline"])) 
 {
        $query2 = sprintf("update tbl_package_info set weight = %s, criteria = %s, quantity= %s ,description = %s, pickupprice = %s, is_fragile = %s, accept_decline = %s,zone_name = %s , city_name = %s,  emp_id = %s,status_id = %s, current_loc = %s,destination = %s, departure_time= %s, delivery_time = %s, commnts = %s,modifieddate= '$modified_date',emp_id = Null,pickedby = '0', assign_status = '0'  where package_id = %s",						
						            GetSQLValueString($_REQUEST["weight"], "text"),
									GetSQLValueString($_REQUEST["criteria"], "text"),
									GetSQLValueString($_REQUEST["quantity"], "text"),
									GetSQLValueString($_REQUEST["description"], "text"),
									GetSQLValueString($_REQUEST["pickupprice"], "text"),
									GetSQLValueString($_REQUEST["is_fragile"], "text"),
									GetSQLValueString($_REQUEST["accept_decline"], "text"),
									GetSQLValueString($_REQUEST["zone_name"], "text"),
									GetSQLValueString($_REQUEST["city_name"], "text"),
									GetSQLValueString($_REQUEST["emp_id"], "int"),
									GetSQLValueString($_REQUEST["status_id"], "int"),
									GetSQLValueString($_REQUEST["current_loc"], "text"),
							        GetSQLValueString($_REQUEST["destination"], "text"),
									GetSQLValueString($_REQUEST["departure_time"], "text"),
									GetSQLValueString($_REQUEST["delivery_time"], "text"),
									GetSQLValueString($_REQUEST["commnts"], "text"),
						           GetSQLValueString($_REQUEST["package-id"], "int"));
	$n2 = db_other_query($conn, $query2);
 }
 else 
 {
	  $query3 = sprintf("update tbl_package_info set weight = %s, criteria = %s, quantity= %s ,description = %s, pickupprice = %s, is_fragile = %s, zone_name = %s , city_name = %s,  emp_id = %s,status_id = %s, current_loc = %s,destination = %s, departure_time= %s, delivery_time = %s, commnts = %s,modifieddate= '$modified_date'  where package_id = %s",						
						            GetSQLValueString($_REQUEST["weight"], "text"),
									GetSQLValueString($_REQUEST["criteria"], "text"),
									GetSQLValueString($_REQUEST["quantity"], "text"),
									GetSQLValueString($_REQUEST["description"], "text"),
									GetSQLValueString($_REQUEST["pickupprice"], "text"),
									GetSQLValueString($_REQUEST["is_fragile"], "text"),
									GetSQLValueString($_REQUEST["zone_name"], "text"),
									GetSQLValueString($_REQUEST["city_name"], "text"),
									GetSQLValueString($_REQUEST["emp_id"], "int"),
									GetSQLValueString($_REQUEST["status_id"], "int"),
									GetSQLValueString($_REQUEST["current_loc"], "text"),
							        GetSQLValueString($_REQUEST["destination"], "text"),
									GetSQLValueString($_REQUEST["departure_time"], "text"),
									GetSQLValueString($_REQUEST["delivery_time"], "text"),
									GetSQLValueString($_REQUEST["commnts"], "text"),
						           GetSQLValueString($_REQUEST["package-id"], "int"));
								    $n3 = db_other_query($conn, $query3);
	 
 }

 $query1 = sprintf("select pickedby from tbl_package_info where package_id = %s ",
	 GetSQLValueString($_REQUEST["package-id"], "int"));
	$n1 = db_select_query($conn, $query1, $rs_package);	 
    if ($rs_package[0]["pickedby"]==1){
		header("Location: picked-package-list.php");		
	}
	else {
		header("Location: assigned-package-list.php");
	}	
	db_close($conn);	

	?>

