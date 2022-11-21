<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
  
			// insert 
			 $query1 = sprintf("insert into tbl_package_info(track_num,weight, criteria,quantity,description,pickupprice,is_fragile,zone_name,city_name,first_name, last_name,email, mobile, 
			 address,country_id,c_first_name,c_last_name,c_email,c_mobile,c_address,c_country_id,current_loc,destination,departure_time) values(%s, %s, %s,%s, %s,%s,%s,%s,%s,%s, %s, %s, %s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)", 
			GetSQLValueString($_REQUEST["track_num"], "int"),
			GetSQLValueString($_REQUEST["weight"], "text"),
			GetSQLValueString($_REQUEST["criteria"], "text"),							
			GetSQLValueString($_REQUEST["quantity"], "text"),
			GetSQLValueString($_REQUEST["description"], "text"),	
			GetSQLValueString($_REQUEST["pickupprice"], "text"),
			GetSQLValueString($_REQUEST["is_fragile"], "text"),
			GetSQLValueString($_REQUEST["zone_name"], "text"),
			GetSQLValueString($_REQUEST["city_name"], "text"),
			GetSQLValueString($_REQUEST["first_name"], "text"),
			GetSQLValueString($_REQUEST["last_name"], "text"),							
			GetSQLValueString($_REQUEST["email"], "text"),							
			GetSQLValueString($_REQUEST["mobile"], "text"),					
			GetSQLValueString($_REQUEST["address"], "text"),									
			GetSQLValueString($_REQUEST["country_id"], "int"),
			GetSQLValueString($_REQUEST["c_first_name"], "text"),
			GetSQLValueString($_REQUEST["c_last_name"], "text"),							
			GetSQLValueString($_REQUEST["c_email"], "text"),									
			GetSQLValueString($_REQUEST["c_mobile"], "text"),
            GetSQLValueString($_REQUEST["c_address"], "text"),			
			GetSQLValueString($_REQUEST["c_country_id"], "int"),
			GetSQLValueString($_REQUEST["current_loc"], "text"),
			GetSQLValueString($_REQUEST["destination"], "text"),
			GetSQLValueString($_REQUEST["departure_time"], "text"));
			$n1 = db_other_query($conn, $query1);		
	        db_close($conn);	 
	     header("Location: package-list.php");	
	?>

