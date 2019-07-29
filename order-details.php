<?php include 'inc/header.php'?>
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        echo "<script>window.location='login.php'</script>";
    }

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			 <table class="shopping-cart-table table" id="refresh">
								<thead>
									<tr>
										<th>Product</th>
										<th>Product Name</th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Date</th>
										<th class="text-center">Order Status</th>
										
									</tr>
								</thead>
								<tbody>
									<?php 
                               $cmrId = Session::get("cmrId");
                               $getOrderProduct = $ct->getOrderProduct($cmrId);
                               if ($getOrderProduct) {
                                $i=0;
                                
                                  while ($result = $getOrderProduct->fetch_assoc()) {
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

										<td class="text-center"> 
											<strong><?php if(isset($result['quantity'])){echo $result['quantity'];}?></strong>
										</td>

										<td class="text-center"> 
											<strong><?php if(isset($result['created_at'])){echo $fm->formatDate($result['created_at']);}?></strong>
										</td>

										<td class="text-center">
											<strong>
												 <?php
                                    if ($result['status'] == 0) {
                                        echo "Pending";
                                     
                                    }elseif($result['status'] == 1) { 
                                      echo "Shifted";

                                     } else{ 
                                      echo "OK";

                                    }    ?>
											</strong>
                                       </td>
									
										
									</tr>
								<?php }}?>
								</tbody>
								
							</table>
			
		</div>
	</div>
	
</div>



   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/slick.min.js"></script>
   <script src="js/nouislider.min.js"></script>
   <script src="js/jquery.zoom.min.js"></script>
   <script src="js/main.js"></script>
   <script src="js/jquery-ui.js"></script>

<?php include 'inc/footer.php'?>