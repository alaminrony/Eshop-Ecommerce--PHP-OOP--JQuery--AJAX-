<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $adminId = Session::get("adminId");
    if($_SERVER['REQUEST_METHOD'] =='POST'){
    $updatePassword = $cmr->updateAdminPassword($adminId,$_POST);
    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block"> 
        <?php
        if(isset($updatePassword)){
            echo $updatePassword;

        }
        ?>              
         <form  action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="old_password" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="adminPass" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>