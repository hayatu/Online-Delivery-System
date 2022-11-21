<?php
namespace Dompdf;
require_once("authenticate.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	$query = sprintf("select * from tbl_package_info where package_id = %s", GetSQLValueString($_REQUEST["package-id"], "int") );
	$n = db_select_query($conn, $query, $rs_package);
	
	  $query1 = sprintf("select pack.country_id, 	 
	tble_countries.country_name "
	."from tbl_package_info pack "
	."left join tble_countries on pack.country_id = tble_countries.country_id "
	."where package_id = %s",
	GetSQLValueString($_REQUEST["package-id"], "int"));	  
	$n = db_select_query($conn, $query1, $rs_country);	
	
	  $query1 = sprintf("select pack.c_country_id, 	 
	tble_countries.country_name "
	."from tbl_package_info pack "
	."left join tble_countries on pack.c_country_id = tble_countries.country_id "
	."where package_id = %s",
	GetSQLValueString($_REQUEST["package-id"], "int"));	  
	$n = db_select_query($conn, $query1, $rs_c_country);	

require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf(); 
$dompdf->loadHtml('
  <p style="text-align:center; font-size:20px;">Package Information</p>
 <div style="border-top: 1px solid; padding:15px; ">
                       
                        <strong>Truck Number:</strong>
                       '.$rs_package[0]['track_num'].'
					    <strong>weight:</strong>
					    '.$rs_package[0]["weight"].' 
                         <strong>Criteria:</strong>
					    '.$rs_package[0]["criteria"].'  
                        <strong>Quantity:</strong>
					    '.$rs_package[0]["quantity"].' 
                        <strong>Description:</strong>
					    '.$rs_package[0]["description"].'	
                           <strong>Pickup Price:</strong>
					    '.$rs_package[0]["pickupprice"].'	
                          <strong>Is fragile:</strong>
						'.$rs_package[0]["is_fragile"].'
					   	 <strong>Zone:</strong>
						'.$rs_package[0]["zone_name"].'	
						<strong>City:</strong>
						'.$rs_package[0]["city_name"].'							
					
                </div>
				
				<p style="text-align:center; font-size:20px;">Sender Details</p>
 <div style="border-top: 1px solid; padding:15px; ">
                       
                        <strong>Frist Name:</strong>
                       '.$rs_package[0]['first_name'].'
					    <strong>Last Name:</strong>
					    '.$rs_package[0]["last_name"].' 
                         <strong>Email:</strong>
					    '.$rs_package[0]["email"].'  
                        <strong>Cell Phone:</strong>
					    '.$rs_package[0]["mobile"].' 
                        <strong>Address:</strong>
					    '.$rs_package[0]["address"].'	
                           <strong>Country:</strong>
					    '.$rs_country[0]["country_name"].'	                       					
					
                </div>
				<p style="text-align:center; font-size:20px;">Reciever/Customer Details</p>
 <div style="border-top: 1px solid; padding:15px; ">
                       
                        <strong>Frist Name:</strong>
                       '.$rs_package[0]['c_first_name'].'
					    <strong>Last Name:</strong>
					    '.$rs_package[0]["c_last_name"].' 
                         <strong>Email:</strong>
					    '.$rs_package[0]["c_email"].'  
                        <strong>Cell Phone:</strong>
					    '.$rs_package[0]["c_mobile"].' 
                        <strong>Address:</strong>
					    '.$rs_package[0]["c_address"].'	
                           <strong>Country:</strong>
					    '.$rs_c_country[0]["country_name"].'	                       					
					
                </div>
				');

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("",array("Attachment" => false));
db_close($conn);
exit(0);
?>


