<?php

    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/Cart.php');
     $ct = New Cart();
     if($_SERVER['REQUEST_METHOD']== "POST"){

     	$cartId =$_POST['cartId'];
     	$ct->deleteCartProduct($cartId);
     }
?>