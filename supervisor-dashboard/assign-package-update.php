<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/mailer_func.php");
$conn = db_connect();
	 
    $query1 = sprintf("select first_name,last_name,mobile,vehicle_id from tbl_employee_info where emp_id = %s",
   GetSQLValueString($_REQUEST["emp_id"], "int"));
	$n1 = db_select_query($conn, $query1, $rs_employee);
	$emp_fullname = $rs_employee[0]["first_name"]." ".$rs_employee[0]["last_name"];
	$emp_phone = $rs_employee[0]["mobile"];
	$emp_vehicle_id = $rs_employee[0]["vehicle_id"];
	
if(isset($_POST['submit']))
{
	$n=count($_POST["package_id"]);
	
for($i=0;$i<$n;$i++){
	$package_id = $_POST['package_id'][$i];
	$current_loc = $_POST['current_loc'][$i];
	$destination = $_POST['destination'][$i];
	$delivery_time = $_POST['delivery_time'][$i];
	$status_id = $_POST['status_id'][$i];
	
 if($current_loc !='' && $destination !='' && $departure_time != '' && $delivery_time != '' ){
   $query2 = sprintf("update tbl_package_info set emp_id = %s, current_loc = %s, destination = %s, delivery_time = %s, status_id= %s, assign_status = %s,  pickedby = %s, vehicle_id = %s WHERE package_id = %s",	
					GetSQLValueString($_REQUEST["emp_id"], "int"),
					GetSQLValueString($current_loc, "text"), 
					GetSQLValueString($destination, "text"),					
					GetSQLValueString($delivery_time, "text"),
					GetSQLValueString($status_id, "int"),
					GetSQLValueString($_REQUEST["assign_status"], "text"), 
					GetSQLValueString($_REQUEST["pickedby"], "text"),
					GetSQLValueString($emp_vehicle_id, "int"),
					GetSQLValueString($package_id, "int"));
			//GetSQLValueString($_REQUEST["emp_id"], "int"),		
	      $n2 = db_other_query($conn, $query2);
	}	
}
    $query = sprintf("select * , COUNT(*) as total from tbl_package_info where zone_name = %s and emp_id != 'NULL' ", GetSQLValueString($_REQUEST["zone-name"], "text"));
	 $n = db_select_query($conn, $query, $rs_package);
		$total_packages = $rs_package[0]["total"];
		$detination_zone  = $rs_package[0]["zone_name"];
		//$total_packages;
       //Admin Mailer starts	
		
		$mail             = new PHPMailer(); // defaults to using php "mail()"
		$body             = $mail->getFile('user-email.html');
		$body= preg_replace('{[\{]}', '',$body);
		$body = preg_replace("#employee#",  $emp_fullname, $body);
		//$body = preg_replace("#tracknumber#", $_REQUEST["track_num"], $body);
		//$body = preg_replace("#pweight#", $_REQUEST["weight"], $body);
		//$body = preg_replace("#pickup_price#", $_REQUEST["pickupprice"], $body);
		$body = preg_replace("#pdestination#", $detination_zone, $body);
		$body = preg_replace("#emp_phone#", $emp_phone, $body);		
		$body = preg_replace("#total_packages#", $total_packages, $body);	
		
		 $mail->From       = "info@hasskay.com";
		 $mail->FromName   = "Package Selection Notifications";

		$mail->Subject    = "Shipment Notifications";

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($body);

		$mail->AddAddress("kamaal_bd@yahoo.com"); 	
		//$mail->AddBCC("abdirazakkaynan@gmail.com");
		

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		}
	db_close($conn);	
	//header("Location: assign-package-form.php?zone-name=".$_REQUEST["zone-name"]);
		}	
	?>

