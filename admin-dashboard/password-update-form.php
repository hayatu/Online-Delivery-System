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
if(array_key_exists("password",$_REQUEST)){
	
	$newpassword =$_REQUEST["password"];
	if(strlen($newpassword)>10||strlen($newpassword)<6 || !preg_match("#[A-Z]+#",$newpassword)) {
    echo "<div class='container pt-3'>
	<div class='alert alert-danger' role='alert'>
	The Password lenght must be between at least 6 & 10 Characters and mus Contain at Least 1 Capital Letter!
	</div>
	</div>";
}
else {
        $query2 = sprintf("update tbl_admin_info set password = %s where admin_id = %s",						
						            GetSQLValueString(MD5($_REQUEST["password"]), "text"),
									GetSQLValueString($_REQUEST["admin-id"], "int"));
	  $n2 = db_other_query($conn, $query2);

	if($n2 > 0){
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-success' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 Your Password has been updated!.
			</div>
		</div>";
		
	}
	
	else{
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 Your Password has not been updated please try again!.
				  <button class='btn btn-primary btn-sm btn-link'><a href='password-update-form.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit;
	}	
	db_close($conn);	
	}
	}
?>

<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->

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
        <form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET" enctype="multipart/form-data">
		<input name="admin-id" type="hidden" id="admin-id" value="<?php echo $_SESSION["admin_id"]; ?>">
            <p class="h5 text-center mb-0">Password update</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-12 mb-4">
                    <div>
                        <i class="fas fa-key prefix grey-text"></i>
                        <label for="password" class="active">Enter the new password</label>
                        <input name="password" type="password" id="password" class="form-control" required>
                    </div>
                </div>
                <!--Grid column-->
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

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->