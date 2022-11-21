<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
      
	    $query2 = sprintf("update tbl_customer_info set c_first_name = %s, c_last_name = %s, c_email= %s, c_mobile = %s, c_address = %s, c_country_id = %s   where customer_id = %s",						
						            GetSQLValueString($_REQUEST["c_first_name"], "text"),
									GetSQLValueString($_REQUEST["c_last_name"], "text"),
									GetSQLValueString($_REQUEST["c_email"], "text"),
									GetSQLValueString($_REQUEST["c_mobile"], "text"),					GetSQLValueString($_REQUEST["c_address"], "text"),	
									GetSQLValueString($_REQUEST["c_country_id"], "int"),
						           GetSQLValueString($_REQUEST["customer-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	db_close($conn);	
	header("Location: customer-list.php");
	?>

