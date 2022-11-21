<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
?>
<?php 
include_once($CommonAssets ."/delivery/top-header-section.php"); 
include_once($CommonAssets ."/delivery/main-top-header.php"); 
?> 
<!-- Navigation -->
<main class="pl-0 pt-0">
	<div class="container pt-5">
		<!-- Default form login -->		
		<div class="row">
			<div class="col-md-12">					
				<form class="text-center p-2 border border-light rounded mb-0" method="GET" action="tarack-pacage.php?track_num">	
					<h4 class="font-weight-bold pt-4 text-left">Online Delivery System Track Package </h4>
					<hr class="light-blue lighten-1 title-hr mb-3">   
					<!-- Tracking -->
					<input name="track_num" type="text" id="track_num" class="form-control mb-4" placeholder="Enter Track Number" required>		
					<!-- Track in button -->
					<button class="btn btn-info btn-block my-4" type="submit">Track Package Status</button> 
														
				</form>			
			</div>
			
		</div>
	</div>	
</main>
<!--/ Main layout -->
<!-- Footer -->
<?php  include("footer.php"); ?>
<!-- Footer -->
<!-- Default form login -->



