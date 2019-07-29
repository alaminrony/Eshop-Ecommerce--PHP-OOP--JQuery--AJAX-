<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style>
    .styledel{
    border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 18px;
    padding: 2px 10px;
    background: #DDDDDD;
    margin-left: 5px;

    }
</style>

<?php 
   if(!isset($_GET['pageid']) || $_GET['pageid']== NULL) {
       echo "<script> window.location='index.php.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['pageid']);

       }



    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
     $UpdatePage = $pg->PageUpdate($_POST,$id);
  }

?>



        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Page</h2>
                <div class="block">  

                <?php
                  if(isset($UpdatePage)){
                    echo $UpdatePage;
                  }
                ?>


            <?php 
                   $getPageById = $pg->getPageById($id);
                    if ($getPageById) {
                     while($result=$getPageById->fetch_assoc()) {

             ?>     

                       
                 <form action="" method="post">                    
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Page Name</label>
                            </td>
                            <td>
                                <input type="text" name="page_name" value="<?php echo $result['page_name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="page_content"><?php echo $result['page_content'];?></textarea>
                            </td>
                        </tr>

						               

                        <tr>
                            <td>
                                <label>Description</label>
                            </td>
                            <td>
                                <input type="text" name="description" value="<?php echo $result['description'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Keywords</label>
                            </td>
                            <td>
                                <input type="text" name="keywords" value="<?php echo $result['keywords'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="styledel"> <a onclick="return confirm('Are you sure to Delete !')" href="deletepage.php?delpage=<?php echo $result['id'];?>">Delete</a></span>
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



 




