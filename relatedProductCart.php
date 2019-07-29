<?php
session_start();
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/Cart.php');

  $ct = new Cart();
  if(isset($_POST['submit'])){
        $quantity =$_POST['quantity'];
        $product_id       =$_POST['product_id'];
        if ($quantity > 0){
        	$addRelatedCart = $ct->addCartRelatedProduct($product_id,$quantity);
        }
        else{
        	echo "<script>alert('lease Enter Number of Quantity');</script>";
        }
        
}

?>
