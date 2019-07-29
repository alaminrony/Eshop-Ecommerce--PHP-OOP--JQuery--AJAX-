<?php
session_start();
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/Cart.php');
   $ct = new Cart();

	if($_SERVER["REQUEST_METHOD"]=="POST"){
   	$ct->getAllCartData();
   }

  
?>