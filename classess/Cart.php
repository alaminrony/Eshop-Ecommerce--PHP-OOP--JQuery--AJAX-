<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>


<?php

class Cart{

    private $db;
    private $fm;

    public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}



    public function addToCartAjax($product_id,$product_name,$product_price,$product_image,$product_color,$product_size,$product_quantity){
         $product_id      =$this->fm->validation($product_id);
         $product_name    =$this->fm->validation($product_name);
         $product_price   =$this->fm->validation($product_price);
         $product_image   =$this->fm->validation($product_image);
         $product_color   =$this->fm->validation($product_color);
         $product_size    =$this->fm->validation($product_size);
         $product_quantity=$this->fm->validation($product_quantity);

         $product_id       =mysqli_real_escape_string($this->db->link, $product_id);
         $product_name     =mysqli_real_escape_string($this->db->link, $product_name);
         $product_price    =mysqli_real_escape_string($this->db->link, $product_price);
         $product_image    =mysqli_real_escape_string($this->db->link, $product_image);
         $product_color    =mysqli_real_escape_string($this->db->link, $product_color);
         $product_size     =mysqli_real_escape_string($this->db->link, $product_size);
         $product_quantity =mysqli_real_escape_string($this->db->link, $product_quantity);

          $sId  = session_id();
               $query= "INSERT INTO tbl_cart(sId, productId, productName, price, image, color, size, quantity) 
                VALUES('$sId','$product_id', '$product_name','$product_price','$product_image','$product_color','$product_size','$product_quantity')";
                $inserted_row =$this->db->insert($query);
        

    }


    public function getAllCartData(){

         $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId' ORDER BY created_at DESC";
        $getCartData = $this->db->select($query);
            $total_price = 0;
            $total_item = 0;
        $output = '';
       
        if($getCartData){
              $output.='

        <div class="table-responsive" id="order_table">
            <table class="table table-bordered table-striped">
                <tr>  
                    <th width="20%">Product Name</th> 
                    <th width="15%">Image</th>
                    <th width="10%">Color</th>
                    <th width="10%">Size</th>
                    <th width="10%">Quantity</th>  
                    <th width="15%">Price</th>  
                    <th width="15%">Total</th>  
                    <th width="5%">Action</th>  
                </tr>
               ';


            While($result = $getCartData->fetch_assoc()){

        $output .= '
        <tr>
            <td>'.$result["productName"].'</td> 
            <td align="center"><img height="50" width="50" src="admin/'.$result['image'].'"/></td>
            <td>'.$result["color"].'</td>
            <td>'.$result["size"].'</td>
            <td>'.$result["quantity"].'</td>
            <td align="right">$ '.$result["price"].'</td>
            <td align="right">$ '.number_format($result["quantity"] * $result["price"], 2).'</td>
            <td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $result["cartId"].'">Remove</button></td>
        </tr>
        ';
        $total_price = $total_price + ($result["quantity"] * $result["price"]);
        $total_item = $total_item + 1;
    }
    $output .= '
    <tr>  
        <td colspan="6" align="right">Grand Total</td>  
        <td align="right">$ '.number_format($total_price, 2).'</td>  
        <td></td>  
    </tr>
    ';
}
else
{
    $output .= '
      
    <tr>
        <td colspan="8" align="center">
            Your Cart is Empty!
        </td>
    </tr>
    ';
}
$output .= '</table></div>';
$data = array(
    'cart_details'      =>  $output,
    'total_price'       =>  '$' . number_format($total_price, 2),
    'total_item'        =>  $total_item
);  

echo json_encode($data);
    
}


  public function addCartSingleProduct($id,$quantity){
          $sId = session_id();
             $checkquery = "SELECT * FROM tbl_product WHERE product_id='$id'";
         $getProduct = $this->db->select($checkquery);
        if ($getProduct) {
              while ($result = $getProduct->fetch_assoc()) {
                $productId =$result['product_id'];
                $productName =$result['product_name'];               
                $price =$result['price'];
                $image =$result['image'];
                $color =$result['color'];
                $size =$result['size'];

                 $query = "INSERT INTO tbl_cart(sId,productId,productName,price,image,color,size,quantity) 
                 VALUES('$sId','$productId','$productName','$price','$image','$color','$size','$quantity')";

              $inserted_row =$this->db->insert($query);
              if($inserted_row){
                echo "success";

              }

          }
      }

         
  }

   public function addCartRelatedProduct($product_id,$quantity){
          $sId = session_id();
             $checkquery = "SELECT * FROM tbl_product WHERE product_id='$product_id'";
         $getProduct = $this->db->select($checkquery);
        if ($getProduct) {
              while ($result = $getProduct->fetch_assoc()) {
                $productId =$result['product_id'];
                $productName =$result['product_name'];               
                $price =$result['price'];
                $image =$result['image'];
                $color =$result['color'];
                $size =$result['size'];

                 $query= "INSERT INTO tbl_cart(sId, productId, productName, price,image,color,size,quantity) 
                 VALUES('$sId','$productId', '$productName','$price','$image','$color','$size','$quantity')";

              $inserted_row =$this->db->insert($query);
              if($inserted_row){
                header("Location:product-page.php?proid=$product_id");

              }

          }
      }

         
  }
 


      public function getCartProduct(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId' ORDER BY created_at DESC";
        $result = $this->db->select($query);
        return $result;

      } 

       public function getRefreshCartProduct(){
       echo "<meta http-equiv='refresh' content='0; URL=checkout.php' />";

      }   

      public function deleteCartProduct($cartId){
        $cartId      =$this->fm->validation($cartId);
        $cartId      =mysqli_real_escape_string($this->db->link,$cartId);

       $query ="DELETE from tbl_cart where cartId='$cartId'";
         $delData  =$this->db->delete($query);
           
            
      } 
      
      // call index.php in cart operation quantity
      public function deleteAllCartProduct(){
         $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId='$sId'";
        $this->db->delete($query);
      }
      
      // call checkout.php for update cart quantity
       public function updateCartQuantity($cartId, $quantity){
        $cartId      =$this->fm->validation($cartId);
        $quantity    =$this->fm->validation($quantity);
        $cartId      =mysqli_real_escape_string($this->db->link,$cartId);
        $quantity    =mysqli_real_escape_string($this->db->link,$quantity);

        
       $query ="UPDATE  tbl_cart 
                     SET quantity= '$quantity' 
                     where cartId='$cartId'";
                     $update_row = $this->db->update($query);

              if($update_row){
             $msg="<span>Cart Quantity Updated</span>";
              return $msg;
            }
            else{
                $msg ="<span class='error'> Quantity Not updated . </span>";
                return $msg;
            }                

      }  


      public function chackCartTable(){
         $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $result = $this->db->select($query);
        return $result;
      } 

      public function delCustomerData(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId='$sId'";
        $this->db->delete($query);

      }  


      public function delSingleCartData($cartId){
         $cartId      =$this->fm->validation($cartId);
        $cartId      =mysqli_real_escape_string($this->db->link,$cartId);

       $query ="DELETE from tbl_cart where cartId='$cartId'";
         $delData  =$this->db->delete($query);
         if($delData){
            $msg ="<span class='error'>Cart Product deleted. </span>";
                return $msg;
            }
            else{
                 $msg ="<span class='error'> Cart Product not deleted. </span>";
                return $msg;

            }

      }  


       
         

      //Data insert using rettrive from cart table into order table.

      public function orderProduct($cmrId){
         $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
        $getProduct = $this->db->select($query);
        if ($getProduct) {
              while ($result = $getProduct->fetch_assoc()) {
                $productId =$result['productId'];
                $productName =$result['productName']; 
                $Price =$result['price']* $result['quantity'];; 
                $image =$result['image'];
                $color =$result['color']; 
                $size =$result['size'];              
                $quantity =$result['quantity'];
                

                 $query= "INSERT INTO tbl_order(cmrId, productId, productName,price,image,color,size,quantity) 
                 VALUES('$cmrId','$productId', '$productName','$Price','$image','$color','$size','$quantity')";
                $inserted_row =$this->db->insert($query);
              }
        }
      }
    
    // for success page
     public function PayableAmount($cmrId){
       $query = "SELECT price from tbl_order WHERE cmrId='$cmrId' AND created_at = now()";
        $result = $this->db->select($query);
        return $result;
        
     }

     // for Order details by specific customar orderdetails.php 30 number line

     public function getOrderProduct($cmrId){
       $query = "SELECT * from tbl_order WHERE cmrId='$cmrId' Order by created_at DESC";
        $result = $this->db->select($query);
        return $result;

     }

     public function chackOrder($cmrId){
        $query = "SELECT * FROM tbl_order WHERE cmrId='$cmrId'";
        $result = $this->db->select($query);
        return $result;
     }

     public function getOrderDetails(){
       $query = "SELECT * FROM tbl_order Order By created_at DESC";
        $result = $this->db->select($query);
        return $result;
     }

     public function productShifted($id, $price, $date){
         $id      =$this->fm->validation($id);
         $price   =$this->fm->validation($price);
         $date    =$this->fm->validation($date);

        $id       =mysqli_real_escape_string($this->db->link,$id);
        $price    =mysqli_real_escape_string($this->db->link,$price);
        $date     =mysqli_real_escape_string($this->db->link,$date);

     $query ="UPDATE  tbl_order 
                     SET 
                     status ='1'
                     where cmrId='$id' AND price='$price' AND created_at='$date' ";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'> Update successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'> Not updated . </span>";
                return $msg;
            }       
     }


    public function productDeleted($id, $price, $date){
         $id      =$this->fm->validation($id);
         $price   =$this->fm->validation($price);
         $date    =$this->fm->validation($date);

        $id       =mysqli_real_escape_string($this->db->link,$id);
        $price    =mysqli_real_escape_string($this->db->link,$price);
        $date     =mysqli_real_escape_string($this->db->link,$date);

        $query ="DELETE from tbl_order where cmrId='$id' AND price='$price' AND created_at='$date' ";
         $delData  =$this->db->delete($query);

         if($delData){
                $msg ="<span class='success'>DELETE successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'>Not Deleted . </span>";
                return $msg;
            }   
    }


    public function OrderConfirm($id, $price, $date){
       $id=$this->fm->validation($id);
    $id=mysqli_real_escape_string($this->db->link,$id);

    $price=$this->fm->validation($price);
    $price=mysqli_real_escape_string($this->db->link,$price);

    $date=$this->fm->validation($date);
    $date=mysqli_real_escape_string($this->db->link,$date);

     $query ="UPDATE  tbl_order 
                     SET 
                     status ='2'
                     where cmrId='$id' AND price='$price' AND created_at ='$date' ";
                     $update_row = $this->db->update($query);

              if($update_row){
                $msg ="<span class='success'> Confirm successfully. </span>";
                return $msg;
            }
            else{
                $msg ="<span class='error'> Not Confirm successfully . </span>";
                return $msg;
            }      

    }




}
?>
