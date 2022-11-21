<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();	
	
       $query1 = sprintf("select pack.package_id, pack.emp_id, pack.track_num, pack.weight,pack.quantity,pack.is_fragile, pack.current_loc,
                    pack.destination,pack.status_id, pack.pickupprice,pack.pickedby, pack.zone_name,
					pack.first_name as fname,pack.last_name as lname,pack.mobile as sender_phone,pack.address,
					pack.commnts, pack.city_name, pack.createdate,pack.modifieddate,pack.vehicle_id, pack.c_first_name, pack.c_last_name,pack.c_mobile, COUNT(*) as totalp,
					tbl_employee_info.first_name as em_fn, tbl_employee_info.mobile,
					tbl_employee_info.last_name as em_ln,tbl_employee_info.dgcolor as bgcolor,tbl_status_info.status, 
					tbl_vehicle_info.plat_number,tbl_vehicle_info.made_model  "
	."from tbl_package_info pack "
	."left join tbl_employee_info on pack.emp_id = tbl_employee_info.emp_id "
	."left join tbl_status_info on pack.status_id = tbl_status_info.status_id "	
	."left join tbl_vehicle_info on pack.vehicle_id = tbl_vehicle_info.vehicle_id "
	."where pack.deleteflag = 0 and assign_status = 1 and pack.status_id != 2 and pickedby = 0  group by pack.emp_id order by pack.weight, tbl_employee_info.first_name ASC");	  
	$n = db_select_query($conn, $query1, $rs_package);	
		db_close($conn);
function checkdecisiontime($effectiveDate) {
	$decisiondate = date('Y-m-d', strtotime("+1 day", strtotime($effectiveDate)));
	$today = date('Y-m-d');
	$result = "";
	if ($decisiondate > $today) $colorTd = '<span style="color:green;">';
	else $colorTd = '<span style="color:black;">';

	$diff = abs(strtotime($today) - strtotime($effectiveDate));
     $months = "0";
	$days = floor(($diff - $months*30*60*60*24)/ (60*60*24));
	return $colorTd.$days. ' day(s) passed</span>';
}	


function getDistance($addressFrom, $addressTo, $unit = ''){
    // Google API key
    $apiKey = 'AIzaSyACkXvku_HiUuYO4yT1r-CTLczabr-CnIE';
    
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
    // Geocoding API request with start address
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    
    // Convert unit and return distance
    $unit = strtoupper($unit);
    if($unit == "K"){
        return round($miles * 1.609344, 2).' km';
    }elseif($unit == "M"){
        return round($miles * 1609.344, 2).' meters';
    }else{
        return round($miles, 2).' miles';
    }
}


// Get distance in km
//$distance = getDistance($addressFrom, $addressTo, "K");
	
?>
<!-- Navbar -->

<!-- /.Navbar -->
<!-- Main layout -->
<main class="pl-1 pt-1">
	<div class="container">
			
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
		
		
			<thead>
				<tr>
				<th class="th-sm">Truck Number
					</th>
					<th class="th-sm">Weight
					</th>
					<th class="th-sm">Quantity 
					</th>	
					<th class="th-sm">Assigned To 
					</th>						
					<th class="th-sm">Status
					</th>	
					<th class="th-sm">Pickup Price
					</th>
					<th class="th-sm">PickedBy
					</th>
                  <th class="th-sm">Empl. Phone
					</th>
                     <th class="th-sm">Vehicle Model
					</th>					
						<th class="th-sm">Plate Number
					</th>	
                    <th class="th-sm">Is fragile
					</th>                  						
                   <th class="th-sm">Zone
					</th>	
					<th class="th-sm">City
                     </th>
					<th class="th-sm">Sender Full Name
					</th>
					<th class="th-sm">Sender Phone
					</th>
                     <th class="th-sm">Reciever Full Name
					</th>	
                    <th class="th-sm">Reciever Phone
					</th>
                    <th class="th-sm">Current Location
					</th>
                     <th class="th-sm">Destination
					</th>
					<th class="th-sm">Total Distance
					</th>	
					<th class="th-sm">Total Packages
					</th>
                     <th class="th-sm">Registration Date
					</th>
					
					<th class="th-sm">Days Passed
					</th>					
                    	<th class="th-sm">Comment
					</th>
					
					<th class="th-sm">Update
					</th>
					<th class="th-sm">Detaisl
					</th>
					<th class="th-sm">Delete
					</th>             					
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr style= "background-color:<?php echo $rs_package[$i]["bgcolor"]; ?>">	
					    <td><?php echo $rs_package[$i]["track_num"]; ?></td>
						<td><?php echo $rs_package[$i]["weight"]; ?></td>	
						<td><?php echo $rs_package[$i]["quantity"]; ?></td>							
						<td><?php echo $rs_package[$i]["em_fn"]." ".$rs_package[$i]["em_ln"]; ?></td>						
						<td><?php echo $rs_package[$i]["status"]; ?></td>	
						<td><?php echo $rs_package[$i]["pickupprice"]."$"; ?></td>												
						<td><?php if($rs_package[$i]["pickedby"]=='0') {echo $rs_package[$i]["em_fn"]." ".$rs_package[$i]["em_ln"]; }else {echo $rs_package[$i]["pickedby"]; }?></td>						
						<td><?php echo $rs_package[$i]["mobile"]; ?></td>
						<td><?php echo $rs_package[$i]["made_model"]; ?></td>
						<td><?php echo $rs_package[$i]["plat_number"]; ?></td>
						<td><?php echo $rs_package[$i]["is_fragile"]; ?></td>
						<td><?php echo $rs_package[$i]["zone_name"]; ?></td>
						<td><?php echo $rs_package[$i]["city_name"]; ?></td>
						<td><?php echo $rs_package[$i]["fname"]." ".$rs_package[$i]["lname"]; ?></td> 
                        <td><?php echo $rs_package[$i]["sender_phone"]; ?></td>						
						<td><?php echo $rs_package[$i]["c_first_name"]." ".$rs_package[$i]["c_last_name"]; ?></td> 
						<td><?php echo $rs_package[$i]["c_mobile"]; ?></td> 
						<td><?php echo $rs_package[$i]["current_loc"]; ?></td>	
						<td><?php echo $rs_package[$i]["destination"]; ?></td>
						<td><?php 
					  echo getDistance($rs_package[$i]["current_loc"], $rs_package[$i]["destination"], "K"); ?></td>						
						<td><?php echo $rs_package[$i]["totalp"]; ?></td>
						<td><?php echo $rs_package[$i]["createdate"]; ?></td>
						
						<td><?php  $time_original = date("Y-m-d", strtotime( $rs_package[$i]["modifieddate"]));
                 		     echo  checkdecisiontime($time_original);  ?></td>						
						<td><?php echo $rs_package[$i]["commnts"]; ?></td>							
                       <td><a href="assigned-package-update-form.php?package-id=<?php echo $rs_package[$i]["package_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	
					   <td><a href="assigned-package-list-details.php?emp-id=<?php echo $rs_package[$i]["emp_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-info-circle"></i></a></td>

						<td>						
						<!-- Delete trigger modal-->
							<a href="assigned_package_info_delete.php?package-id=<?php echo $rs_package[$i]["package_id"]; ?>" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this record')"><i class="fas fa-trash-alt"></i></a>
						<!--Modal: modalConfirmDelete-->		
						</td>
						
					</tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
				<th>Truck Number
				</th>
					<th>Weight
					</th>
					<th>Quantity 
					</th>	
					<th>Assigned To 
					</th>						
					<th>Status
					</th>	
					<th>Pickup Price
					</th>
					<th>PickedBy
					</th>
                  <th>Empl. Phone
					</th>
                     <th>Vehicle Model
					</th>					
						<th>Plate Number
					</th>	
                    <th>Is fragile
					</th>
                   <th>Zone
					</th>	
                    <th>City
					</th>	
                   	<th>Sender Full Name
					</th>	
                     <th>Sender Phone
					</th>					
					<th>Reciever Full Name
					</th>	
					<th>Reciever Phone
					</th>
					<th>Current Location
					</th>
					<th>Destination
					</th>
                   <th>Total Distance
					</th>						
					<th>Total Packages
					</th>
					<th>Registration Date
					</th>
										
					<th>Days Passed
					</th>
					<th>Comment
					</th>						
					<th>Update
					</th>
					<th>Details
					</th>
					<th>Delete
					</th>					
				</tr>
			</tfoot>
		</table>
	</div>
	
	<script>
		$(document).ready(function () {
			$('#dtBasicExample').DataTable();
			$('.dataTables_length').addClass('bs-select');
		});
	</script>	
</div>
</main>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
