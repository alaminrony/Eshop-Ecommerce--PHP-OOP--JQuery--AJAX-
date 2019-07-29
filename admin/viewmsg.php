<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
       if(!isset($_GET['msgid']) || $_GET['msgid']== NULL) {
       echo "<script> window.location='contactinbox.php';</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['msgid']);
         $GetMessageById = $cont->getMessageById($id);
       }
      

 
  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
    echo "<script> window.location='contactinbox.php';</script>";
     
  }

?>



        <div class="grid_10">		
            <div class="box round first grid">
                <h2>View Message</h2>
                <div class="block">  

                           
                 <form action=" " method="post" >
                    <?php 
                           if ($GetMessageById) {
                              while ($result =$GetMessageById->fetch_assoc()) {
                                 
                        ?>
                    <table class="form">               
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']?>"  />
                            </td>
                        </tr>
                     
                       <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email'];?>"  />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Phone</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['phone'];?>"  />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->formatDate($result['created_at']);?>"  />
                            </td>
                        </tr>

                        

                         <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce">
                                    <?php echo $result['message'];?>
                                </textarea>
                            </td>
                        </tr>

                      
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    
                    </table>
                    <?php }}?>
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



 




