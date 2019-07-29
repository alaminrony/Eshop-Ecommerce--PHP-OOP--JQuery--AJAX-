<?php include 'inc/header.php'?>
<?php
    $login = Session::get("cmrLogin");
    if ($login == false) {
        header("Location:login.php");
    }

?>

             <?php
                 $cmrId = Session::get("cmrId");
                 $Amount = $ct->PayableAmount($cmrId);

                 if ( $Amount) {
                    $sum = 0;
                    
                    while ($result = $Amount->fetch_assoc()) {
                        $price = $result['price'];
                        $sum = $sum + $price;
                    }
                 }
                   ?>
<div class="container">
	<div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#0fad00">Success</h2>
        <h3 class="text-capitalize">Dear, <?php echo Session::get('cmrName');?></h3>
        <p style="font-size:20px;color:#5C5C5C;">
            <?php if(isset($sum)){echo "Total Payable Amount: $ ".$sum. "<br/>Thanks For Purchase. Receive your Order Successfully. We will contact With you as soon as possible with delivery Details.";} else {echo "You have already ordered. Please review your order.";}?><br/>
                   
        </p>
        <a href="order-details.php" class="btn btn-success">Order Riview</a>

    <br><br>
        </div>
        
	</div>
</div>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/slick.min.js"></script>
   <script src="js/nouislider.min.js"></script>
   <script src="js/jquery.zoom.min.js"></script>
   <script src="js/main.js"></script>
   <script src="js/jquery-ui.js"></script>
<?php include 'inc/footer.php'?>