<?php include'inc/header.php'?>

<?php
       if(!isset($_GET['proid']) || $_GET['proid']== NULL) {
       echo "<script> window.location='404.php';</script>";
       }

       else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
       }

       if($_SERVER['REQUEST_METHOD']=='POST'){
        $quantity =$_POST['quantity'];
        if ($quantity >0){
        		$addCart = $ct->addCartSingleProduct($id,$quantity);
        }
        else{
        	echo "<script>alert('lease Enter Number of Quantity');</script>";
        }
        
  }
  ?> 

  
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
		
				  <?php
				$getSproduct =$pd->getProductById($id);
				if ($getSproduct) {
					while ( $result = $getSproduct->fetch_assoc()) {

				?>	
				<div class="product product-details clearfix">

					<div class="col-md-6">
						<div id="product-main-view">
							<div class="product-view">
								<img src="admin/<?php echo $result['image']; ?>" alt="">
							</div>
						</div>
					</div>
				
					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span class="sale"><?php echo $result['product_condition']?></span>
								<!-- <span class="sale">-20%</span> -->
							</div>
							<h2 class="product-name"><?php echo $result['product_name'];?></h2>
							<h3 class="product-price">$ <?php echo $result['price'];?></h3>
							
							<p><strong>Availability: </strong><?php if($result['stock']==0){echo "In Stock";}else{echo "Not Available";}?></p>
							<p><strong>Brand:</strong> <?php echo $result['brandName']?></p>
							<p><?php echo $result['details'];?></p>
							<div class="product-options">
								<ul class="size-option">
									<?php 
									if(!empty($result['size'])){ ?>
										<li><span class="text-uppercase">Size:</span></li>

										<?php
                                        if($result['size']=='S'){ ?>
                                       <li><a href="#"><?php echo "S";?></a></li>
                                       <?php }?>

                                       <?php
                                        if($result['size']=='M'){ ?>
                                       <li><a href="#"><?php echo "M";?></a></li>
                                       <?php }?>

                                       <?php
                                        if($result['size']=='L'){ ?>
                                       <li><a href="#"><?php echo "L";?></a></li>
                                       <?php }?>

                                       <?php
                                        if($result['size']=='XL'){ ?>
                                       <li><a href="#"><?php echo "XL";?></a></li>
                                       <?php }?>
									
									<?php }?>

									
								</ul>
								<ul class="color-option">
									<?php if(!empty($result['color'])){ ?>
										<li><span class="text-uppercase">Color:</span></li>

										<?php
                                        if($result['color']=='Black'){ ?>
                                       <li><a href="#" style="background-color:#000;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='White'){ ?>
                                       <li><a href="#" style="background-color:#fff;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Green'){ ?>
                                       <li><a href="#" style="background-color:#006400;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Silver'){ ?>
                                       <li><a href="#" style="background-color:#C0C0C0;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Golden'){ ?>
                                       <li><a href="#" style="background-color:#CFB53B;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Red'){ ?>
                                       <li><a href="#" style="background-color:#FF0000;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Yellow'){ ?>
                                       <li><a href="#" style="background-color:#FFFF00;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Blue'){ ?>
                                       <li><a href="#" style="background-color:#0000ff;"></a></li>
                                       <?php }?>

                                        <?php
                                        if($result['color']=='Orange'){ ?>
                                       <li><a href="#" style="background-color:#FFA500;"></a></li>
                                       <?php }?>

									<?php }?>
								</ul>
							</div>

							<div class="product-btns">
								
								<form method="post" >
								<div class="qty-input">
									<span class="text-uppercase">QTY: </span>
									<input class="input" type="number" name="quantity" value="1" >
									
								</div>
									<button  class="primary-btn" onclick="return confirm('Item has been Added into Cart')"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
								</form>
									
							</div>
						</div>
					</div>

                   <?php }}?>


			
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->




	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Related Product</h2>
					</div>
				</div>
				<!-- section title -->
			
				    <?php
				          $relatedProduct = $pd->relatedProductByProductId($id);
				         if (isset($relatedProduct)) {
				          while ($relatedresult = $relatedProduct->fetch_assoc()) {
			    
			        ?>
				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
				  	<div class="product product-single">
				  		<div class="product-thumb">
				  			<div class="product-label">
				  				<span class="sale"><?php echo $relatedresult['product_condition'];?></span>
				  			</div>
				  			<a class="main-btn quick-view" href="product-page.php?proid=<?php echo $relatedresult['product_id'];?>"><i class="fa fa-search-plus"></i><span>Quick view</span></a>
				  			<img src="admin/<?php echo $relatedresult['image'];?>" alt="">
				  		</div>

				  		<div class="product-body text-center">
				  			<h3 class="product-price"><?php echo $relatedresult['price'];?></h3>

				  			<h2 class="product-name"><a href="product-page.php?proid=<?php echo $relatedresult['product_id'];?>"><?php echo $relatedresult['product_name']?></a></h2>

				  			<div class="product-btns text-center">
				  				<form method="post" action="relatedProductCart.php">
				  				<div style="width:30%;display:inline-block;">
				  					<input class="input" type="number" name="quantity"  value="1" >
				  					<input class="input" type="hidden"   name="product_id"  value="<?php echo $relatedresult['product_id'];?>" >
				  				</div>
				  				<button class="primary-btn" type="submit" name="submit" onclick="return confirm('Item has been Added into Cart')"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
				  				</form>
				  			</div>
				  		</div>
				  	</div>
				  </div>
				<?php }} else{ 
				 echo "<span style='color: red; font-size: 18px;'>Related Product are not available! </span>";
				}?>
				<!-- /Product Single -->
				
							
					</div>

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


	