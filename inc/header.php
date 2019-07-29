<?php 
include 'lib/Session.php';
    Session::init();
    include 'lib/Database.php';
    include 'helpers/Format.php';
     

    spl_autoload_register(function($class){
      include_once 'classess/'.$class.'.php';

    });

    $db = new Database();
    $fm = new Format();
    $pd = new Product();
    $cat= new Category();
    $ct = new Cart();
    $cmr= new Customer();
    $cont= new Contact();
    $pg  = new Page();
    $sl  = new Slider();
    
?>


<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en">
   <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <?php 
               $path = $_SERVER['SCRIPT_FILENAME'];
              $currentPage = basename($path, '.php');

      ?>
          <?php 
        if (isset($_GET['pageid'])) {
          $id = $_GET['pageid'];
          $pageTitleById  =$pg->getPageById($id);
          if ($pageTitleById) {
            while ($result = $pageTitleById->fetch_assoc()) { ?>
            <title><?php echo $result['page_name'];?> | <?php echo TITLE;?></title>
            <meta name="description" content="<?php if(isset($result['description'])){echo $result['description'];}?>">
            <meta name="keywords" content="<?php if(isset($result['keywords'])){echo $result['keywords'];}?>">
          
        <?php }}}

            else if (isset($_GET['catId'])) {
          $id = $_GET['catId'];
          $getSubCatById  =$cat->getCatById($id);
          if ($getSubCatById) {
            while ($result = $getSubCatById->fetch_assoc()) { ?>

            <title><?php echo $result['catName'];?> | <?php echo TITLE;?></title>
          
        <?php }}}

         else if (isset($_GET['proid'])) {
          $id = $_GET['proid'];
          $getProductById  =$pd->getProductById($id);
          if ($getProductById) {
            while ($result = $getProductById->fetch_assoc()) { ?>

            <title><?php echo $result['product_name'];?> | <?php echo TITLE;?></title>
            <meta name="description" content="<?php if(isset($result['description'])){echo $result['description'];}?>">
            <meta name="keywords" content="<?php if(isset($result['keywords'])){echo $result['keywords'];}?>">
        <?php }}}

       

        else if($currentPage == 'contact'){ ?>
              <title><?php echo $fm->title();?> | <?php echo TITLE;?></title>
              <meta name="description" content="<?php echo CDESCRIPTION;?>">
               <meta name="keywords" content="<?php echo CKEYWORDS;?>">

       <?php }
       
        
         else{?>

               <title><?php echo $fm->title();?> | <?php echo TITLE;?></title>
               <meta name="description" content="<?php echo DESCRIPTION;?>">
               <meta name="keywords" content="<?php echo KEYWORDS;?>">

       <?php }?>

      
      <!-- Google font -->
      <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
      <!-- Bootstrap -->
      <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- Slick -->

      <link type="text/css" rel="stylesheet" href="css/slick.css" />
      <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
      <!-- nouislider -->
      <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
      <!-- Font Awesome Icon -->
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <!-- Custom stlylesheet -->
      <link type="text/css" rel="stylesheet" href="css/style.css" />

      <link href = "css/jquery-ui.css" rel = "stylesheet">

      <style>
      .popover
      {
          width: 100%;
          max-width: 800px;
      }

   /* #loading
    {
   text-align:center; 
   background: url('loader.gif') no-repeat center; 
   height: 150px;
    }*/

    #loading{
  position: fixed;
  width: 100%;
  height: 100vh;
  background: #fff
  url('images/25.gif')
   no-repeat center center; 
  z-index: 99999;
}
    
   </style>
  
   </head>
   <body onload="myFunction()">
    <div id="loading"></div>
      <!-- HEADER -->
      <header>
         <!-- header -->
         <div id="header">
            <div class="container">
               <div class="pull-left">
                  <!-- Logo -->
                  <div class="header-logo">
                     <a class="logo" href="index.php">
                     <img src="./img/logo.png" alt="">
                     </a>
                  </div>
                  <!-- /Logo -->
                  <!-- Search -->
                   <?php
                    $path = $_SERVER['SCRIPT_FILENAME'];
                     $currentPage = basename($path, '.php');
                 ?> 
              
                 <?php 
                    if($currentPage == 'products'){ ?>
                      <div class="header-search">
                     <form>
                        <input class="input search-input" type="text" id="livesearch" placeholder="Enter your keyword">
                        <select class="input search-categories">
                           <option value="0">All Categories</option>
                        </select>
                        <button class="search-btn" disabled><i class="fa fa-search"></i></button>
                     </form>
                  </div> 

                  <?php }else{?>

                     <div class="header-search">
                     <form action="search.php" method="GET">
                        <input class="input search-input" type="text" name="search" placeholder="Enter your keyword">
                        <select class="input search-categories">
                           <option value="0">All Categories</option>
                        </select>
                        <button class="search-btn" type="submit" name="submit"><i class="fa fa-search"></i></button>
                     </form>
                  </div> 

                  <?php }?>
    
                  
                  <!-- /Search -->
               </div>
               <div class="pull-right">
                  <ul class="header-btns">
                     <!-- Account -->
                     <li class="header-account dropdown default-dropdown">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                           <div class="header-btns-icon">
                              <i class="fa fa-user-o"></i>
                           </div>
                           <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                        </div>

                        <?php
                        $login = Session::get("cmrLogin");
                            if ($login == false) {?>
                             <a href="login.php" class="text-uppercase">Login</a>
                              / <a href="login.php" class="text-uppercase">Join</a>
                                
                            <?php }
                             else{?>
                               <a href="?cmrId=<?php Session::get('cmrId');?>" class="text-uppercase"></i> Logout</a>
                        <?php }?>

                         


                       
                        <ul class="custom-menu">
                           <li><a href="my-account.php"><i class="fa fa-user-o"></i> My Account</a></li>
                           <li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>
                           <li><a href="order-details.php"><i class="fa fa-eye"></i> Order Details</a></li>
                            <?php
                           if (isset($_GET['cmrId'])) {
                              $deldata =$ct->delCustomerData();
                              Session::destroy();
                            }
                         ?>     
                        
                       <?php
                        $login = Session::get("cmrLogin");
                            if ($login == false) {?>
                             <li><a href="login.php"><i class="fa fa-unlock-alt"></i> Login</a></li>
                                
                            <?php }
                             else{?>
                               <li><a href="?cmrId=<?php Session::get('cmrId');?>"><i class="fa fa-unlock-alt"></i> Logout</a></li>
                        <?php }?>

                         <?php
                         $login = Session::get("cmrLogin");
                         if($login == false){?>
                          <li><a href="login.php"><i class="fa fa-user-plus"></i> Create An Account</a></li>
                         <?php }?>

     
                          
                           
                        </ul>
                     </li>
                     <!-- /Account -->
                     <!-- Cart -->
                     <li class="header-cart dropdown default-dropdown">
                        
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" id="cart-popover"  data-placement="bottom" title="Shopping Cart">

                           <div class="header-btns-icon">
                              <i class="fa fa-shopping-cart"></i>
                              <span class="qty badge"></span>
                           </div>

                           <strong class="text-uppercase">My Cart:</strong>
                           <br>
                           <span class="total_price">$ 0.00</span>
                        </a>
                     </li>
                     <!-- /Cart -->
                     <!-- Mobile nav toggle-->
                     <li class="nav-toggle">
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                     </li>
                     <!-- / Mobile nav toggle -->
                  </ul>
               </div>
            </div>
            <!-- header -->
         </div>
         <!-- container -->
      </header>
      <!-- /HEADER -->
      <!-- NAVIGATION --> 
         
         <div id="popover_content_wrapper" style="display: none">
            <span id="cart_details"></span>
            <div align="right">
               <div class="shopping-cart-btns">
                     <a class="primary-btn" href="checkout.php"><i class="fa fa-shopping-cart"></i> Checkout</a>
                     <button class="main-btn" id="clear_cart"><i class="fa fa-trash"></i> Clear</button>
                  </div>
            </div>
         </div>



      <div id="navigation">
         <!-- container -->
         <div class="container">
            <div id="responsive-nav">
               <!-- category nav -->
                
                 <?php 
                 if ($currentPage == 'index'){ ?>
                  <div class="category-nav">
                <?php } else{?>
                  <div class="category-nav show-on-click ">

                <?php }?>
               
                  <span class="category-header">Categories <i class="fa fa-list"></i></span>
                  <ul class="category-list">
                      <?php 
                         $getCat = $cat->getAllCat();
                         if($getCat){
                           while($result =$getCat->fetch_assoc()){
                      ?>

                     <li><a href="category-product.php?catid=<?php echo $result['catId'];?>"><?php echo $result['catName']?></a></li>

                     <?php }}?>
                  </ul>
               </div>
               <!-- /category nav -->
               <!-- menu nav -->
               <div class="menu-nav">
                  <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                  <ul class="menu-list">
                     <li><a href="index.php">Home</a></li>
                     <li><a href="products.php">Products</a></li>
                     <li><a href="contact.php">Contact</a></li>
                  </ul>
               </div>
               <!-- menu nav -->
            </div>
         </div>
         <!-- /container -->
      </div>
      <!-- /NAVIGATION -->