<?php include 'inc/header.php'?>
<?php
    $login = Session::get("cmrLogin");
    if ($login == true) {
        echo "<script>window.location='index.php'</script>";
    }

?>


<?php
    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['register'])){
     $customerReg = $cmr->customerRegistration($_POST);
 }
?>




	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				
					<div class="col-md-6">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Register New Account</h3>
								<p class="text-danger">
									<?php
									if (isset($customerReg)) {
										echo $customerReg;
									}

									?>
									
								</p>

							</div>
							<form id="checkout-form" class="clearfix" action="" method="POST">
							<div class="form-group">
								<input class="input" type="text" name="first_name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last_name" placeholder="Last Name">
								
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
								
							</div>
							<div class="form-group">
								<input class="input" type="password" name="password" placeholder="Enter Your Password">
								
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
								
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
								
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
								
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip_code" placeholder="ZIP Code">
								
							</div>
							<div class="form-group">
								<input class="input" type="text" name="mobile" placeholder="Mobile Number">
								
							</div>
							
							<button  type="submit" name="register" class="primary-btn"><i class="fa fa-user-plus"></i> Create Account</button>
							</form>

						</div>
						
					</div>
				
	


       <?php
             if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['login'])){
		     $customerLogin = $cmr->customerLogin($_POST);
		   }

		?>

					
					<div class="col-md-6">
						
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Existing Customers Sign in</h3>
								<p class="text-danger">
									<?php
									if (isset($customerLogin)) {
										echo $customerLogin;
									}

									?>
									
								</p>
							</div>

							<form id="checkout-form" class="clearfix" method="POST" action="" >
							<div class="form-group">
								<input class="input" type="text" name="email" placeholder="Enter Your Email">
							</div>
							<div class="form-group">
								<input class="input" type="password" name="password" placeholder="Enter Your Password">
							</div>
							
							<button type="submit" name="login" class="primary-btn"><i class="fa fa-unlock-alt"></i> Sign in</button>
						</div>
						</form> 
						
					</div>
				


            </div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/slick.min.js"></script>
   <script src="js/nouislider.min.js"></script>
   <script src="js/jquery.zoom.min.js"></script>
   <script src="js/main.js"></script>
   <script src="js/jquery-ui.js"></script>
<?php include'inc/footer.php'?>