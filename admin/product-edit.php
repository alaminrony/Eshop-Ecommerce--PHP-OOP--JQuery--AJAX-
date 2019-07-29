<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Category.php';?>
<?php include '../classess/Brand.php';?>
<?php include '../classess/Product.php';?>


<?php

if(!isset($_GET['proid']) || $_GET['proid']== NULL) {
       echo "<script> window.location='productlist.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);

       }


  $pd=new Product();
  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
     $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
  }

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">   

                <?php
                  if(isset($updateProduct)){
                    echo $updateProduct;

                  }
                ?>   

               <?php
                    $getproduct  = $pd->getProductById($id);
                    if($getproduct ){
                      while ($value= $getproduct->fetch_assoc()) {

                 ?>        
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
              <tr>
                <td>
                  <label>Name</label>
                </td>
                <td>
                  <input type="text" name="product_name" value="<?php echo $value['product_name'];?>" class="medium" />
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

                          <option
                          <?php
                          if ($value['catId'] == $result['catId']) {   ?>
                            selected = "selected"

                            <?php  } ?>  value="<?php echo $result['catId'];?>"><?php echo $result['catName'];?></option>

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
                          <option
                          <?php
                          if ($value['brandId'] == $result['brandId']) {   ?>
                            selected = "selected"

                          <?php  } ?>  value="<?php echo $result['brandId'];?>"><?php echo $result['brandName'];?>

                        </option>

                      <?php }}?>

                    </select>
                  </td>
                </tr>

                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" class="medium"  name="price" value="<?php echo $value['price'];?>"/>
                    </td>
                </tr>

               <tr>
                  <td>
                    <label>Select Color</label>
                    <label> {<?php echo $value['color'];?>}</label>
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
                    <label> {<?php echo $value['size'];?>}</label>
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
                    <textarea class="tinymce" name="details">
                      <?php echo $value['details'];?>

                    </textarea>
                  </td>
                </tr>

                
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image'];?>"  height="80px" width="200px"/><br/>
                        <input type="file" name="image" />
                    </td>
                </tr>

                 <tr>
                  <td>
                    <label>Featured Item</label>
                  </td>
                  <td>
                    <select id="select" name="feature_item">
                      <option>Select Item</option>
                      <?php if ($value['feature_item'] == 0) { ?>
                        <option selected = "selected" value="0">Leatest</option>
                        <option value="1">Featured</option>

                      <?php } else{ ?>

                        <option selected = "selected" value="1">Featured</option>
                        <option value="0">Leatest</option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>

                 
        
                <tr>
                  <td>
                    <label>Stock</label>
                  </td>
                  <td>
                    <select id="select" name="stock">
                      <option>Select Type</option>
                      <?php if ($value['stock'] == 0) { ?>
                        <option selected = "selected" value="0">Available</option>
                        <option value="1">Not Available</option>

                      <?php } else{ ?>

                        <option selected = "selected" value="1">Not Available</option>
                        <option value="0">Available</option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>
                    <label>Condition</label>
                  </td>
                  <td>
                    <select id="select" name="product_condition">
                      <option>Select Type</option>
                      <?php if ($value['product_condition'] == "New") { ?>
                        <option selected = "selected" value="New">New</option>
                        <option value="Used">Used</option>

                      <?php } else{ ?>

                        <option selected = "selected" value="Used">Used</option>
                        <option value="New">New</option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>

                <tr>
                <td>
                  <label>Description</label>
                </td>
                <td>
                  <input type="text" name="description" value="<?php echo $value['description'];?>" class="medium" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Keywords</label>
                </td>
                <td>
                  <input type="text" name="keywords" value="<?php echo $value['keywords'];?>" class="medium" />
                </td>
              </tr>

                 <tr>
                <td>
                  <label>Created on</label>
                </td>
                <td>
                  <input type="text" name="created_at" value="<?php echo $value['created_at'];?>" class="medium" />
                </td>
              </tr>


                <tr>
                  <td></td>
                  <td>
                    <input type="submit" name="submit" Value="Update" />
                  </td>
                </tr>
            </table>
            </form>

                     <?php }}?>
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


