<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

  if(!isset($_GET['sliderid']) || $_GET['sliderid']== NULL) {
       echo "<script> window.location='sliderlist.php';</script>";
       }

       else{
        //$sliderid= $fm->decrypt($_GET['sliderid'],1);
        $sliderid = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['sliderid']);
        

       }

  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
     $updateSlider = $sl->sliderUpdate($_POST, $_FILES,$sliderid);
  }

?>





        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Update slider</h2>
                <div class="block">  

                <?php
                  if(isset($updateSlider)){
                    echo $updateSlider;

                  }


                ?>  

                               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                    <?php
                    $GetSliderByID  = $sl->GetSliderByID($sliderid);
                    if($GetSliderByID ){
                      while ($result = $GetSliderByID->fetch_assoc()) {
                    
                    ?> 
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text"  name="title" value="<?php echo $result['title'];?>" class="medium" />
                            </td>
                        </tr>
                     
                       
        
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $result['image'];?>"  height="80px" width="200px"/><br/>
                                <input type="file" name="image" />
                                
                            </td>
                        </tr>

                       
						             <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                        <?php }}?>
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






