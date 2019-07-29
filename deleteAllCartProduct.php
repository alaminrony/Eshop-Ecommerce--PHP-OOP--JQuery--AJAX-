<?php
session_start();
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/Cart.php');
     $ct = New Cart();
     if(isset($_POST["action"])){
     	if($_POST["action"]=="empty"){
     		$ct->deleteAllCartProduct();
     	}
     }
?>