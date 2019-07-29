<?php include 'inc/header.php'?>
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        echo "<script>window.location='login.php'</script>";
    }

?>

<?php 
     if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
        $cmrId = Session::get("cmrId");
        $insertOrder= $ct->orderProduct($cmrId);
        $deldata =$ct->delCustomerData();
        echo "<script>window.location='success.php'</script>";
     }

?>

<?php
    $id = Session::get("cmrId");
    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['updateProfile'])){
    $cmrProfileUpdate = $cmr->cmrProfileUpdate($_POST,$id);
    }
?>




	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				
					<div class="col-md-6">
						<?php
                          $id= Session::get("cmrId");
                          $getData = $cmr->getCustomerData($id);
                          if ($getData ) {
                          while ($result = $getData->fetch_assoc()){ 
                       ?>

						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">My Account</h3>
							</div>

							<?php 
								 if(isset($cmrProfileUpdate)){
								 	echo "<div class='alert alert-success' role='alert'>$cmrProfileUpdate</div>";}
								?>
							

							<form id="checkout-form" class="clearfix" method="POST" action="">
								<table>
							<div class="form-group">
								<input class="input" type="text" name="first_name"  value="<?php echo $result['first_name'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last_name"  value="<?php echo $result['last_name'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email"  value="<?php echo $result['email'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address"  value="<?php echo $result['address'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city"  value="<?php echo $result['city'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country"  value="<?php echo $result['country'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip_code"  value="<?php echo $result['zip_code'];?>">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="mobile"  value="<?php echo $result['mobile'];?>">
							</div>
							<div class="form-group">
								<div class="pull-right">
								<button type="submit" name="updateProfile" class="primary-btn">Update</button> 
							</div>
							</div>
						</table>
						</form>

						<?php }}?>
						</div>
					</div>

<?php
    $id = Session::get("cmrId");
    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['updatePassword'])){
    $updatePassword = $cmr->updatePassword($id,$_POST);
    }
?>					

					<div class="col-md-6">
						<div class="payments-methods">

							<div class="section-title">
								<h4 class="title">Change Password</h4>
							</div>

								<?php 
								 if(isset($updatePassword)){
								 	echo "<div class='alert alert-success' role='alert'>$updatePassword</div>";}
								?>

							<form action="" method="POST">
							<div class="form-group">
								<input class="input" type="password" name="old_password" placeholder="Enter Current Password">
							</div>

							<div class="form-group">
								<input class="input" type="password" name="password"  placeholder="Enter New Password">
							</div>

							
							<div class="form-group">
								<div class="pull-right">
								<button type="submit" name="updatePassword" class="primary-btn">Change Password</button> 
							</div>
							</div>
							</form>

							
							
						</div>
					</div>




					
				<!-- </form> -->
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