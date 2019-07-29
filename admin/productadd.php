<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Category.php';?>
<?php include '../classess/Brand.php';?>
<?php include '../classess/Product.php';?>

<?php

 $pd =new Product();
  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
     $insertProduct = $pd->productInsert($_POST, $_FILES);
  }

?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">   

                <?php
                  if(isset($insertProduct)){
                    echo $insertProduct;

                  }


                ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="product_name" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                                       
                                   <?php
                                          $cat      = new Category();
                                          $getCat   =$cat->getAllCat();
                                          if ($getCat) {
                                            while ($result =$getCat->fetch_assoc()) {
                                                ?>
                                                
                                           <option value="<?php echo $result['catId'];?>"><?php echo $result['catName'];?></option>

                                  <?php } }?>
                            
                        </select>
                    </td>
                </tr>


                <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>

                            <?php 
                                $brand=new Brand();
                                 $getBrand = $brand->getAllBrand();
                                 if($getBrand){
                                $i=0;
                                while ( $result=$getBrand->fetch_assoc()) {
                                    $i++;


                            ?>
                            <option value="<?php echo $result['brandId'];?>"><?php echo $result['brandName'];?></option>

                            <?php }}?>
                            
                        </select>
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>

                 <tr>
                  <td>
                    <label>Select Color</label>
                  </td>
                  <td>
                    <select id="select" name="color">
                      <option></option>
                        <option  value="Black">Black</option>
                        <option value="White">White</option>
                        <option value="Green">Green</option>
                        <option value="Silver">Silver</option>
                        <option value="Golden">Golden</option>
                        <option value="Red">Red</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Blue">Blue</option>
                        <option value="Orange">Orange</option>
                    </select>
                  </td>
                </tr>

                  <tr>
                  <td>
                    <label>Select Size</label>
                  </td>
                  <td>
                    <select id="select" name="size">
                        <option></option>
                        <option  value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                        <option value="XL">Extra large</option>
                    </select>
                  </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>

                        <textarea class="tinymce" name="details"></textarea>
                    </td>
                </tr>
               
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Featured Iteam</label>
                    </td>
                    <td>
                        <select id="select" name="feature_item">
                            <option>Select Iteam</option>
                            <option value="0">Latest</option>
                            <option value="1">Featured</option>
                        </select>
                    </td>
                </tr>

                <!--  <tr>
                    <td>
                        <label>Product Status</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>Select status</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </td>
                </tr> -->

                 <tr>
                    <td>
                        <label>Product Stock</label>
                    </td>
                    <td>
                        <select id="select" name="stock">
                            <option>Select stock</option>
                            <option value="0">In Stock</option>
                            <option value="1">Not available</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Product Condition</label>
                    </td>
                    <td>
                        <select id="select" name="product_condition">
                            <option value="New">Select Condition</option>
                            <option value="New">New</option>
                            <option value="Used">Used</option>
                        </select>
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Description</label>
                    </td>
                    <td>
                        <input type="text" name="description" placeholder="Enter description..." class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>keywords</label>
                    </td>
                    <td>
                        <input type="text" name="keywords" placeholder="Enter keywords..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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

