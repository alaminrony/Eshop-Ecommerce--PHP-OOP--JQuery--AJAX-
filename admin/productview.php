<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Category.php';?>
<?php include '../classess/Brand.php';?>
<?php include '../classess/Product.php';?>
<?php $fm= new Format();?>
<?php
       if(!isset($_GET['proid']) || $_GET['proid']== NULL) {
       echo "<script> window.location='404.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);

       }

?>

<?php

 $pd =new Product();
  if(isset($_POST['submit'])){
    echo "<script> window.location='productlist.php';</script>";
  }

?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>View Product</h2>
        <div class="block">   

                <?php
                  if(isset($insertProduct)){
                    echo $insertProduct;

                  }
                ?>  
               <?php
				$pd = new Product();
				$getProductDetails =$pd->getProductById($id);
				if ($getProductDetails ) {
					while ( $result = $getProductDetails->fetch_assoc()) {

				?>		     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['product_name'];?>" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['catName'];?>" />
                    </td>
                </tr>


                 <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['brandName'];?>" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" class="medium" readonly value="<?php echo $result['price'];?>"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Color</label>
                    </td>
                    <td>
                        <input type="text" class="medium" readonly value="<?php echo $result['color'];?>"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Size</label>
                    </td>
                    <td>
                        <input type="text" class="medium" readonly value="<?php echo $result['size'];?>"/>
                    </td>
                </tr>

               <tr>
                  <td>
                    <label>Description</label>
                  </td>
                  <td>
                    <textarea class="tinymce">
                        <?php echo $result['details'];?>

                    </textarea>
                  </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                     <td>
                    <img src="<?php echo $result['image'];?>"  height="80px" width="200px"/><br/>
                  </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Featured Iteam</label>
                    </td>
                    <td>
                    	<input type="text" class="medium" readonly value="<?php
						  if ($result['feature_item'] == 0) {
						  	echo "Latest";					 
						  }

						  else{
						  	echo "Featured";
						  }

						  ?>"/>
					  	
					 </td>
                </tr>

                

                <tr>
                  <td>
                    <label>Product Stock</label>
                  </td>
                  <td>
                   <input type="text" class="medium" readonly value="<?php
                   if ($result['stock'] == 0) {
                     echo "Available";					 
                   }

                   else{
                     echo "Not Available";
                   }

                   ?>"/>


                 </td>
               </tr>

               <tr>
                  <td>
                    <label>Product Contition</label>
                  </td>
                  <td>
                   <input type="text" class="medium" readonly value="<?php
                   if ($result['product_condition'] == 0) {
                     echo "New";           
                   }

                   else{
                     echo "Used";
                   }

                   ?>"/>
                   
                   
                 </td>
               </tr>

               <tr>
                    <td>
                        <label>Description</label>
                    </td>
                    <td>
                        <input type="text" class="medium" value="<?php echo $result['description'] ;?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Keywords</label>
                    </td>
                    <td>
                        <input type="text" class="medium" value="<?php echo $result['keywords'] ;?>" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Created on</label>
                    </td>
                    <td>
                        <input type="text" class="medium" value="<?php echo $fm->formatDate($result['created_at']) ;?>" />
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="OK" />
                    </td>
                </tr>
            </table>
            </form>
        <?php  }}?>
        </div>
    </div>
</div>


<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->

<?php include 'inc/footer.php';?>

