<?php
session_start();
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/Cart.php');

  $ct = new Cart();

   if($_SERVER["REQUEST_METHOD"]=="POST"){
   	$product_id =$_POST['product_id'];
   	$product_name =$_POST['product_name'];
   	$product_price =$_POST['product_price'];
   	$product_image =$_POST['product_image'];
   	$product_color =$_POST['product_color'];
   	$product_size =$_POST['product_size'];
   	$product_quantity=$_POST['product_quantity'];
   	
    $ct->addToCartAjax($product_id,$product_name,$product_price,$product_image,$product_color,$product_size,$product_quantity);
   }

  
?>