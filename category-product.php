<?php include 'inc/header.php'?>

<?php
 if(!isset($_GET['catid']) || $_GET['catid']== NULL) {
       echo "<script> window.location='404.php';</script>";
       }
       else{
        $catid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
        $getAllSubCatProduct=$pd->productByCat($catid);
        $getAllSubCatById   =$cat->getCatById($catid);

       }
?>

<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
        $quantity =$_POST['quantity'];
        $id       =$_POST['product_id'];
        if ($quantity > 0){
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
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<?php 
						if($getAllSubCatById){
							while ($result = $getAllSubCatById->fetch_assoc()) {
						?>
						<h2 class="title"> Products in <?php echo $result['catName']?></h2>
					<?php }}?>
					</div>
				</div>
				  <!-- Product Single -->
				  	<?php 
				  if($getAllSubCatProduct){
				  	while($result =$getAllSubCatProduct->fetch_assoc()){

				  ?>
				 
				  <div class="col-md-3 col-sm-6 col-xs-6">
				  	<div class="product product-single">
				  		<div class="product-thumb">
				  			<div class="product-label">
				  				<span class="sale"><?php echo $result['product_condition'];?></span>
				  			</div>
				  			<a class="main-btn quick-view" href="product-page.php?proid=<?php echo $result['product_id'];?>"><i class="fa fa-search-plus"></i><span>Quick view</span></a>
				  			<img src="admin/<?php echo $result['image'];?>" alt="">
				  		</div>

				  		<div class="product-body text-center">
				  			<h3 class="product-price">$ <?php echo $result['price'];?></h3>

				  			<h2 class="product-name"><a href="product-page.php?proid=<?php echo $result['product_id'];?>"><?php echo $result['product_name']?></a></h2>

				  			<div class="product-btns text-center">
				  				<form method="post">
				  				<div style="width:30%;display:inline-block;">
				  					<input class="input" type="number" name="quantity"  value="1" >
				  					<input class="input" type="hidden"   name="product_id"  value="<?php echo $result['product_id'];?>" >
				  				</div>
				  				<button class="primary-btn" type="submit" onclick="return confirm('Item has been Added into Cart')"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
				  				</form>
				  			</div>
				  		</div>
				  	</div>
				  </div>
				<?php }} else{ 
					
					echo "<span style='color: red; font-size: 18px;'>Product of this category are not available! </span>";

				 }?>
                    <!-- /Product Single -->
					<div class="clearfix visible-sm visible-xs"></div>
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