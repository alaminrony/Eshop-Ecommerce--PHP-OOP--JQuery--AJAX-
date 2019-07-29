<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
     $addSlider = $sl->addSlider($_POST, $_FILES);
  }

?>



        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add Slider</h2>
                <div class="block copyblock">  

                <?php
                  if(isset($addSlider)){
                    echo $addSlider;

                  }


                ?>               
                 <form action=" " method="post" enctype="multipart/form-data" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter slider Title..." name="title" class="medium"  />
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



 




