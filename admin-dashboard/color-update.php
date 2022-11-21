<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
      
				
	   echo  $query3 = sprintf("update tbl_employee_info set bgcolor = %swhere vehicle_id = %s",						
						            GetSQLValueString($_REQUEST["bgcolor"], "text"),
						           GetSQLValueString($_REQUEST["emp-id"], "int"));
	$n3 = db_other_query($conn, $query3);	
			
	db_close($conn);	
	header("Location: assigned-package-list.php");
	?>

