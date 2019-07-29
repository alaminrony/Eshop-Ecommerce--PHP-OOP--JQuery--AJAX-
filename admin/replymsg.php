<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
       if(!isset($_GET['msgid']) || $_GET['msgid']== NULL) {
       echo "<script> window.location='inbox.php';</script>";
       }
 else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['msgid']);
        $GetMessageById = $cont->getMessageById($id);
         
       }
      

 
  if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
    $from     = $fm->validation($_POST['fromEmail']);
    $to       = $fm->validation($_POST['toEmail']);
    $subject  = $fm->validation($_POST['Subject']);
    $message  = $fm->validation($_POST['Message']);
    $sendmail = mail($to, $subject, $message,$from);
    if ($sendmail) {
        $msg= "<span>Message sent Successfully</span>";
        
    }
    else{
         $msg= "<span>Message Not sent</span>";
    }
     
  }

?>



        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Replay Message</h2>
                <div class="block"> 
                <?php
                  if (isset($msg)) {
                   echo $msg;
                  }
                ?> 

                           
                 <form action=" " method="post" >
                    <?php 
                           if ($GetMessageById) {
                              while ($result =$GetMessageById->fetch_assoc()) {
                                 
                        ?>
                    <table class="form"> 
                       <tr>
                            <td>
                                <label>From Email</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail"  />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>To Email</label>
                            </td>
                            <td>
                                <input type="text" name="toEmail"  value="<?php echo $result['email']?>"  />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="Subject" /> 
                            </td>
                        </tr>

                        

                         <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="Message">
                                    
                                </textarea>
                            </td>
                        </tr>

                      
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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



 




