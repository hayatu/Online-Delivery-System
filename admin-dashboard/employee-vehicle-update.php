<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
      
	  $query2 = sprintf("update tbl_vehicle_info set made_model = %s, plat_number = %s,is_available = %s, is_owned_by_emp = %s, location= %s where vehicle_id = %s",						
						            GetSQLValueString($_REQUEST["made_model"], "text"),
									GetSQLValueString($_REQUEST["plat_number"], "text"),
									GetSQLValueString($_REQUEST["is_available"], "text"),	
                                    GetSQLValueString($_REQUEST["is_owned_by_emp"], "text"),
									GetSQLValueString($_REQUEST["location"], "text"),
									GetSQLValueString($_REQUEST["emp-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	   echo  $query3 = sprintf("update tbl_employee_info set first_name = %s, last_name = %s,date_birth = %s, email= %s, mobile = %s, address = %s, country_id = %s, bgcolor = %s, is_enabled = %s where vehicle_id = %s",						
						            GetSQLValueString($_REQUEST["first_name"], "text"),
									GetSQLValueString($_REQUEST["last_name"], "text"),
									GetSQLValueString($_REQUEST["date_birth"], "text"),									
									GetSQLValueString($_REQUEST["email"], "text"),							
									GetSQLValueString($_REQUEST["mobile"], "text"),
									GetSQLValueString($_REQUEST["address"], "text"),
									GetSQLValueString($_REQUEST["country_id"], "int"),					GetSQLValueString($_REQUEST["bgcolor"], "text"),				
									GetSQLValueString($_REQUEST["is_enabled"], "text"),
						           GetSQLValueString($_REQUEST["emp-id"], "int"));
	$n3 = db_other_query($conn, $query3);	
			
	db_close($conn);	
	header("Location: employee-list.php");
	?>

