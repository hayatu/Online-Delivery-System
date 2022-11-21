<?php require_once("authenticate.php");?>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?> 
	<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<main class="pl-1 pt-1">
	<div class="container">
		<!--Section: Main panel-->
		<section class="mb-3">	
		 <?php include("employee-status-form.php"); ?>		
         <!--Card-->
			<div class="card card-cascade narrower">         
				<!--Section: Table-->
				<section class="text-dark">
				
					<!--Top Table UI-->
					<div class="table-ui p-0 mb-0 mx-0 mb-0">
						<!--Grid row-->						
							<h6 class="font-weight-bold pl-2 pt-1">Employee Dashboard  (<?php echo $_SESSION["first_name"]; ?> <?php echo $_SESSION["last_name"];?>)</h6>
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
		<!--Section: Cascading panels-->
		<section class="mb-3">	
			<!--Grid row-->
			<div class="row">				
				
				
				<!--Grid column-->	
                	
				<!--Grid column-->	
                 <div class="col-lg-12 col-md-4 mb-4">					
					<!--Panel-->
					<div class="card">
						<div class="card-header white-text primary-color font-weight-bold">
							Package  Section
						</div>
						<!--/.Card-->
						<div class="card-body pt-0 px-1">							
							<!--Card content-->
							<div class="card-body text-center">								
								<div class="list-group list-panel">									
									<a href="available_package-list.php" class="list-group-item d-flex justify-content-between text-info">View Available Packages
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>
							<div class="card-body text-center">								
								<div class="list-group list-panel">									
									<a href="assigned-package-list.php" class="list-group-item d-flex justify-content-between text-info">View Assigned Package List
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>
							
							<div class="card-body text-center">								
								<div class="list-group list-panel">									
									<a href="picked-package-list.php" class="list-group-item d-flex justify-content-between text-info">View Picked Package List
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>
							<!--/.Card content-->							
						</div>
						<!--/.Card-->						
					</div>
					<!--Panel-->					
				</div>
				<!--Grid column-->	
				<!--Grid column-->	
                 <!--<div class="col-lg-6 col-md-4 mb-4">				
					<div class="card">
						<div class="card-header white-text primary-color">
							Customer Section
						</div>					
						<div class="card-body pt-0 px-1">							
							
							<div class="card-body text-center">								
								<div class="list-group list-panel">									
									<a href="families-list.php" class="list-group-item d-flex justify-content-between text-info">View assigned Customers
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>														
						</div>											
					</div>									
				</div>-->
				<!--Grid column-->	
					
			</div>	
			</section>
			<!--Section: Cascading panels-->		
	</div>
</main>
<!--Main layout-->

<!--/ Main layout -->
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->