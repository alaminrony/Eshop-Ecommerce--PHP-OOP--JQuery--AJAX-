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
								<h3 class="title">Billing Details</h3>
							</div>

							   <?php 
								 if(isset($cmrProfileUpdate)){
								 	echo "<div class='alert alert-success' role='alert'>$cmrProfileUpdate</div>";}
								?>

							<form id="checkout-form" class="clearfix" method="POST" action="">
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
						</form>

						<?php }}?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="payments-methods">
							<div class="section-title">
								<h4 class="title">Payments Methods</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-1" checked>
								<label for="payments-1">Cash On Delivery</label>
								<div class="caption">
									<p>Only Cash on delivery available now.
										<p>
								</div>
							</div>
							
							
						</div>
					</div>

<?php
   if (isset($_GET['delId'])) {
   	 $cartId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delId']);
   	 $delproduct = $ct->delSingleCartData($cartId);
   }

?>



<?php

  if(isset($_POST['updateCart'])){
  	$cartId =$_POST['cartId'];
    $quantity =$_POST['quantity'];
    $updateCart = $ct->updateCartQuantity($cartId, $quantity);
    if ($quantity <= 0) {
    	$delproduct = $ct->delSingleCartData($cartId);
    	
    }
  }

?>


					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
								<?php 
								 if(isset($updateCart)){
								 	echo "<div class='alert alert-success' role='alert'>$updateCart</div>";}

								?>
								<?php 
								 if(isset($delproduct)){
								 	echo "<div class='alert alert-success' role='alert'>$delproduct</div>";}
								 	
								?>
							</div>


							<table class="shopping-cart-table table" id="refresh">
								<thead>
									<tr>
										<th>Product</th>
										<th>Product Name</th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									 <?php 
			                               $getCartProduct = $ct->getCartProduct();
			                               if ($getCartProduct) {
			                                $i=0;
			                                $sum =0;
			                                $qty =0;
			                                  while ($result = $getCartProduct->fetch_assoc()) {
			                                    $i++;
                                    ?>
									<tr>
										<td class="thumb"><img src="admin/<?php if(isset($result['image'])){echo $result['image'];} ?>" alt=""></td>
										<td class="details">
											<a href="product-page.php?proid=<?php echo $result['productId'];?>"><?php echo $result['productName'];?></a>
											<ul>
												<?php 
												   if(!empty($result['size'])){ ?>
												   	<li><span>Size: <?php echo $result['size'];?></span></li>

												 <?php }?>

												 <?php 
												   if(!empty($result['size'])){ ?>
												   	<li><span>Color: <?php echo $result['color'];?></span></li>

												 <?php }?>
												
												
											</ul>
										</td>
										<td class="price text-center"><strong>$ <?php if(isset($result['price'])){echo $result['price'];}?></strong><br></td>

                                        <form action="" method="POST">
										<td class="qty text-center"><input class="input" type="number" name="quantity" value="<?php echo $result['quantity'];?>">
											<input class="input" type="hidden"   name="cartId"  value="<?php echo $result['cartId'];?>">
											<button  class="primary-btn" name="updateCart"><i class="fa fa-edit"></i></button>

										</td>
										</form>

										<td class="total text-center"><strong class="primary-color">$
											<?php 
                                             $total = $result['price'] * $result['quantity'];
                                              echo $total;?>

										</strong></td>
										<td class="text-right"><a onclick="return confirm('Are you sure you to delete !')" href="?delId=<?php echo $result['cartId'];?>" class="main-btn icon-btn"><i class="fa fa-close"></i></a></td>
									</tr>

									<?php
                                       $qty = $qty + $result['quantity'];
                                       $sum = $sum + $total;
                                    ?>

								<?php }}?>
									
									
								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>QUANTITY</th>
										<th colspan="2" class="sub-total"><?php if(isset($qty)){echo $qty;}else{echo 0;}?></th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total">$ <?php if(isset($sum)){ echo $sum;}else{echo 0;}?></th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">Free Shipping</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total">$ <?php if(isset($sum)){echo $sum;} else{echo 0;}?></th>
									</tr>
								</tfoot>
							</table>
							<div class="pull-right">
								<a class="primary-btn" href="?orderid=order">Place Order</a>
							</div>
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