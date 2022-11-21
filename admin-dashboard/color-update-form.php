<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	
	  $query1 = sprintf("select *, tble_countries.country_name,
	 tbl_vehicle_info.plat_number,tbl_vehicle_info.made_model, tbl_vehicle_info.is_owned_by_emp,tbl_vehicle_info.is_available as v_available,tbl_vehicle_info.location "
	."from tbl_employee_info sup "
	."left join tble_countries on sup.country_id = tble_countries.country_id "
	."left join tbl_vehicle_info on sup.vehicle_id = tbl_vehicle_info.vehicle_id "
	."where sup.vehicle_id = %s and sup.deleteflag = 0 order by sup.first_name, tble_countries.country_name" ,
	GetSQLValueString($_REQUEST["emp-id"], "int"));
	$n = db_select_query($conn, $query1, $rs_employee);	
	
	
	 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);
	 	
	//$query = sprintf("select * from tbl_employee_info where emp_id = %s", GetSQLValueString($_REQUEST["emp-id"], "int") );
	//$n = db_select_query($conn, $query, $rs_employee);
	db_close($conn);
?>

<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<script type="text/javascript" src="js/date-picker.min.js"></script>
<style type="text/css">
   #main {
        height:100px;
        }
            #color {
        margin-left: 10%;
        width:50%;
        }
  </style> 
   
    <script src="bgcolor/popper.min.js"></script>
    <script src="bgcolor/bootstrap.min.js"></script>
    <link href="bgcolor/bootstrap-colorpicker.css" rel="stylesheet">
    <script src="bgcolor/bootstrap-colorpicker.js"></script>
<main class="pl-1 pt-1">
    <div class="container">
        <!--Section: Main panel-->
        <section class="mb-3">
            <!--Card-->
            <div class="card card-cascade narrower">
                <!--Section: Table-->
                <section class="text-dark">
                    <!--Top Table UI-->
                    <div class="table-ui p-0 mb-0 mx-0 mb-0">
                        <!--Grid row-->
                        <h6 class="font-weight-bold pl-2 pt-1">Admin Dashboard</h6>
                        <hr class="light-blue lighten-1 title-hr">
                        <!--Grid row-->
                    </div>
                    <!--Top Table UI-->
                </section>
                <!--Section: Table-->
            </div>
            <!--/.Card-->
        </section>
        <!--Section: Main panel-->   
    
        <!-- Register form -->
        <form name="form1" action="color-update.php" method="post" enctype="multipart/form-data">
		<input name="emp-id" type="hidden" id="emp-id" value="<?php echo $rs_employee[0]["vehicle_id"]; ?>">
            <p class="h5 text-center mb-0">Color Update Form</p>
            <hr class="light-blue lighten-1 title-hr">
			<!--Grid row-->
	
            <div class="row pl-5">
              
				 <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-palette prefix grey-text"></i>
                        <label for="bgcolor" class="active">Background Color</label>
                        <input name="bgcolor" type="text" id="color" value="<?php echo  $rs_employee[0]["bgcolor"]; ?>" class="form-control" required>  
                    </div>
                </div>
               
			
				
            </div>
            <!--Grid row-->
            <div class="text-center mt-4">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
        <!-- Register form -->
   
        <!--Grid column-->
    </div>
</main>
<!--Main layout-->
<script>	
$('#datepicker').datepicker(
{		
autoclose: true,
format: 'yyyy/mm/dd',
todayHighlight: true,
});  		
</script>
<script type="text/javascript">
      $(function () {
        $('#color')
        .colorpicker({})
        .on('colorpickerChange', function (e) { //change the bacground color of the main when the color changes  
            new_color = e.color.toString()
            $('#main').css('background-color', new_color)
        })     
    });
</script>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->