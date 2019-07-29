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
     $updateProduct = $pd->productColorAdd($_POST);
  }

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Product Color</h2>
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
              <input type="hidden" name="product_id" Value="<?php echo $value['product_id']?>" />

                 <tr>
                  <td>
                    <label>Select Color</label>
                  </td>
                  <td>
                    <select id="select" name="color">
                      <option  ></option>
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
                  <td></td>
                  <td>
                    <input type="submit" name="submit" Value="Save" />
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


