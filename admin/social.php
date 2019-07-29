<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $UpdateSocialMedia = $pg->Updatesocialmedia($_POST);
    }

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block"> 
            <?php
               if(isset($UpdateSocialMedia)){
                echo $UpdateSocialMedia;
               }
            ?>
              <?php 
                   
                   $getAllSocialMedia = $pg->socialmedia();
                   if ($getAllSocialMedia) {
                       while ($result = $getAllSocialMedia->fetch_assoc()) {

               ?>              
         <form action=" " method="POST" enctype="multipart/form-data">
            <table class="form">                    
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo urldecode($result['facebook']);?>"  class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo urldecode($result['twitter']);?>" class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkdin" value="<?php echo urldecode($result['linkdin']);?>" class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="google" value="<?php echo urldecode($result['google']);?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Youtube</label>
                    </td>
                    <td>
                        <input type="text" name="youtube" value="<?php echo urldecode($result['youtube']);?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Pinterest</label>
                    </td>
                    <td>
                        <input type="text" name="pinterest" value="<?php echo urldecode($result['pinterest']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Instagram</label>
                    </td>
                    <td>
                        <input type="text" name="instagram" value="<?php echo urldecode($result['instagram']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tumblr</label>
                    </td>
                    <td>
                        <input type="text" name="tumblr" value="<?php echo urldecode($result['tumblr']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Reddit</label>
                    </td>
                    <td>
                        <input type="text" name="reddit" value="<?php echo urldecode($result['reddit']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Flickr</label>
                    </td>
                    <td>
                        <input type="text" name="flickr" value="<?php echo urldecode($result['flickr']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Quora</label>
                    </td>
                    <td>
                        <input type="text" name="quora" value="<?php echo urldecode($result['quora']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Whatsapp</label>
                    </td>
                    <td>
                        <input type="text" name="whatsapp" value="<?php echo urldecode($result['whatsapp']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Weibo</label>
                    </td>
                    <td>
                        <input type="text" name="weibo" value="<?php echo urldecode($result['weibo']);?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Qzone</label>
                    </td>
                    <td>
                        <input type="text" name="qzone" value="<?php echo urldecode($result['qzone']);?>" class="medium" />
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
<?php include 'inc/footer.php';?>