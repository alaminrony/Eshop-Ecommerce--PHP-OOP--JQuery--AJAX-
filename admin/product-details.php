<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../classess/Product.php');
    include_once ($filepath.'/../classess/Category.php');
    include_once ($filepath.'/../classess/Brand.php');
   
    
?>

<?php
       if(!isset($_GET['productId']) || $_GET['productId']== NULL) {
       echo "<script> window.location='404.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productId']);

       }

       if($_SERVER['REQUEST_METHOD']=='POST'){
     echo "<script> window.location='inbox.php';</script>";
  }

?>
    
      

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Product Details</h2>
               <div class="block copyblock">
               	 <form action="" method="POST">

              
				<?php
				$pd = new Product();
				$getProductDetails =$pd->getProductById($id);
				if ($getProductDetails ) {
					while ( $result = $getProductDetails->fetch_assoc()) {


				?>	
					<div>
						<img style="height: 200px;width: 200px;" src="../admin/<?php echo $result['image'];?>" alt="" />
					</div>

				<div>
					<h2><?php echo $result['product_name'];?> </h2>
				</div>
				
			<div class="product-desc">
			     <h2>Product Details</h2>
			      <?php echo $result['details'];?>
	       </div>
             

                   <div>
						<input type="submit" name="submit" Value="Ok" />
					</div>
	                
                        </form>
	    <?php }}?>
				
	
 	   </div>
            </div>
        
	<?php include 'inc/footer.php';?>