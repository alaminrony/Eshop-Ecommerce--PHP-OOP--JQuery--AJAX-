<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classess/Product.php');

  $pd = new Product();

   if($_SERVER["REQUEST_METHOD"]=="POST"){
   	$search = $_POST['search'];

   	$pd->liveSearch($search);
   }

  
?>