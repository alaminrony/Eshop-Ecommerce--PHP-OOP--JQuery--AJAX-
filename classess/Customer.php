<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Customer{

    private $db;
    private $fm;

    public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

   public function customerRegistration($data){
           $first_name            =$this->fm->validation($data['first_name']);
           $last_name         =$this->fm->validation($data['last_name']);
           $email            =$this->fm->validation($data['email']);
           $password         =$this->fm->validation($data['password']);
           $address             =$this->fm->validation($data['address']);
           $city           =$this->fm->validation($data['city']);
           $country           =$this->fm->validation($data['country']);
           $zip_code            =$this->fm->validation($data['zip_code']);
           $mobile            =$this->fm->validation($data['mobile']);

           
           $last_name         =mysqli_real_escape_string($this->db->link, $data['last_name']);
           $email            =mysqli_real_escape_string($this->db->link, $data['email']);
           $password            =mysqli_real_escape_string($this->db->link, md5($data['password']));
           $address         =mysqli_real_escape_string($this->db->link, $data['address']);
           $city           =mysqli_real_escape_string($this->db->link, $data['city']);
           $country           =mysqli_real_escape_string($this->db->link, $data['country']);
           $zip_code           =mysqli_real_escape_string($this->db->link, $data['zip_code']);
           $mobile           =mysqli_real_escape_string($this->db->link, $data['mobile']);
           


     if($first_name == '' || $last_name == '' || $email  == '' || $password  == '' || 
          $address  == ''|| $city  == '' ||$country == ''|| $zip_code  == '' || $mobile  == ''){
          $msg = "<span class='error'> Fields must not be empty !! </span>";
              return $msg;

        }

        $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
        $mailchack = $this->db->select($mailquery);
        if ($mailchack !=false) {
          $msg = "<span class='error'> Email already exist !! </span>";
              return $msg;
          
        }

        else{
          
          $query= "INSERT INTO tbl_customer(first_name, last_name, email, password,address,city,country,zip_code,mobile ) 
          VALUES('$first_name','$last_name', '$email','$password','$address','$city','$country','$zip_code','$mobile')";

              $inserted_row =$this->db->insert($query);
                         if($inserted_row){
                       $msg ="<span class='success'> Registration Complete successfully. </span>";
                       return $msg;
                         }

                         else {
                          echo "<span class='error'>Registration Not Completed !</span>";
                        }
               }

          }

          public function customerLogin($data){
            $email           =$this->fm->validation($data['email']);
            $password            =$this->fm->validation($data['password']);
            $email           =mysqli_real_escape_string($this->db->link, $data['email']);
            $password            =mysqli_real_escape_string($this->db->link, md5($data['password']));

            if($email  == '' || $password  == ''){
          $msg = "<span class='error'> Fields must not be empty !! </span>";
              return $msg;

        }

            $query ="SELECT *FROM tbl_customer WHERE email='$email' AND password='$password'";
            $result = $this->db->select($query );
            if ($result != false) {
              $value = $result->fetch_assoc();
              Session::set("cmrLogin",true);
              Session::set("cmrId",$value['id']);
              Session::set("cmrName",$value['first_name']);

             $sId = session_id();
             $Cartquery = "SELECT * FROM tbl_cart WHERE sId='$sId'";
             $cartData = $this->db->select($Cartquery);
             if($cartData > 0){
                echo "<script>window.location='checkout.php'</script>";
             }
             else{
                  echo "<script>window.location='index.php'</script>";
             }
             
              
            }else{
              $msg = "<span class='error'> Email or Password didn't Match !! </span>";
              return $msg;

            }

          }

          public function getCustomerData($id){
            $query ="SELECT * FROM tbl_customer WHERE id='$id'";
            $result = $this->db->select($query);
            return $result;
          }

          public function cmrProfileUpdate($data,$id){
           $first_name            =$this->fm->validation($data['first_name']);
           $last_name         =$this->fm->validation($data['last_name']);
           $email            =$this->fm->validation($data['email']);
           $address             =$this->fm->validation($data['address']);
           $city           =$this->fm->validation($data['city']);
           $country           =$this->fm->validation($data['country']);
           $zip_code            =$this->fm->validation($data['zip_code']);
           $mobile            =$this->fm->validation($data['mobile']);

           
           $last_name         =mysqli_real_escape_string($this->db->link, $data['last_name']);
           $email            =mysqli_real_escape_string($this->db->link, $data['email']);
           $address         =mysqli_real_escape_string($this->db->link, $data['address']);
           $city           =mysqli_real_escape_string($this->db->link, $data['city']);
           $country           =mysqli_real_escape_string($this->db->link, $data['country']);
           $zip_code           =mysqli_real_escape_string($this->db->link, $data['zip_code']);
           $mobile           =mysqli_real_escape_string($this->db->link, $data['mobile']);
           


     if($first_name == '' || $last_name == '' || $email  == '' || $address  == ''|| $city  == '' ||$country == ''|| $zip_code  == '' || $mobile  == ''){
          $msg = "<span class='error'> Fields must not be empty !! </span>";
              return $msg;

        }

              
        else{
            $query ="UPDATE  tbl_customer 
                     SET
                       first_name= '$first_name',
                      last_name= '$last_name', 
                      email= '$email' ,
                      address= '$address', 
                      city= '$city', 
                      country= '$country', 
                      zip_code= '$zip_code',
                      mobile= '$mobile'  
                     where id='$id'";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'>Update successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'>Not Update successfully </span>";
                return $msg;
            } 

        }  
  }


  public function updatePassword($id,$data){
    $old_password = $this->fm->validation($data['old_password']);
    $old_password =mysqli_real_escape_string($this->db->link, $data['old_password']);

    $new_password = $this->fm->validation($data['password']);
    $new_password =mysqli_real_escape_string($this->db->link, $data['password']);

    if($old_password  == '' || $new_password  == ''){
          $msg = "<span class='error'> Fields must not be empty !! </span>";
              return $msg;
        }

        $check_password = $this->check_password($id,$old_password);
        if($check_password == false){
          $msg = "<span class='error'>Old Password dosen't exists !! </span>";
              return $msg;
        }

        $new_password = md5($new_password);
        $query ="UPDATE  tbl_customer 
                     SET
                      password= '$new_password'  
                     where id='$id'";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'>Password successfully Updated. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'>Password Not Updated</span>";
                return $msg;
            } 



  }

  public function check_password($id,$old_password){
    $password = md5($old_password);

    $query ="SELECT password FROM tbl_customer WHERE id='$id' AND password='$password'";
            $exist_password = $this->db->select($query);
            if($exist_password){
              return true;

            }else{
              return false;
            }

  }



  public function updateAdminPassword($adminId,$data){
    $old_password = $this->fm->validation($data['old_password']);
    $old_password =mysqli_real_escape_string($this->db->link, $data['old_password']);

    $new_password = $this->fm->validation($data['adminPass']);
    $new_password =mysqli_real_escape_string($this->db->link, $data['adminPass']);

    if($old_password  == '' || $new_password  == ''){
          $msg = "<span class='error'> Fields must not be empty !! </span>";
              return $msg;
        }

        $check_password = $this->check_admin_password($adminId,$old_password);
        if($check_password == false){
          $msg = "<span class='error'>Old Password dosen't exists !! </span>";
              return $msg;
        }

        $new_password = md5($new_password);
        $query ="UPDATE  tbl_admin 
                     SET
                      adminPass= '$new_password'  
                     where adminId='$adminId'";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'>Password successfully Updated. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'>Password Not Updated</span>";
                return $msg;
            } 



  }

  public function check_admin_password($adminId,$old_password){
    $password = md5($old_password);

    $query ="SELECT adminPass FROM tbl_admin WHERE adminId='$adminId' AND adminPass='$password'";
            $exist_password = $this->db->select($query);
            if($exist_password){
              return true;

            }else{
              return false;
            }

  }

        
}
?>