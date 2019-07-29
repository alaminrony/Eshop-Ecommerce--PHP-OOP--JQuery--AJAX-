<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            <img src="./img/logo.png" alt="">
		          </a>
						</div>
						<!-- /footer logo -->

						<p><i class="fa fa-phone"> +8801912168339</i><br><i class="fa fa-home"> 60/40/7 Uttor jatrabari,Dhaka-1204</i><br><i class="fa fa-envelope"> shojib@gmail.com</i><br></p>

						 <?php
                          $getAllSocialMedia = $pg->socialmedia();
                           if ($getAllSocialMedia) {
                              while ($result = $getAllSocialMedia->fetch_assoc()) {

                           ?>    

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="<?php echo urldecode($result['facebook']);?>"><i class="fa fa-facebook"></i></a></li>
							<li><a href="<?php echo urldecode($result['twitter']);?>"><i class="fa fa-twitter"></i></a></li>
							<li><a href="<?php echo urldecode($result['linkdin']);?>"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="<?php echo urldecode($result['google']);?>"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="<?php echo urldecode($result['youtube']);?>"><i class="fa fa-youtube"></i></a></li>
							<li><a href="<?php echo urldecode($result['pinterest']);?>"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="<?php echo urldecode($result['instagram']);?>"><i class="fa fa-instagram"></i></a></li>
							<li><a href="<?php echo urldecode($result['tumblr']);?>"><i class="fa fa-tumblr"></i></a></li>
							<li><a href="<?php echo urldecode($result['reddit']);?>"><i class="fa fa-reddit"></i></a></li>
							<li><a href="<?php echo urldecode($result['flickr']);?>"><i class="fa fa-flickr"></i></a></li>
							<li><a href="<?php echo urldecode($result['quora']);?>"><i class="fa fa-quora"></i></a></li>
							<li><a href="<?php echo urldecode($result['whatsapp']);?>"><i class="fa fa-whatsapp"></i></a></li>
							<li><a href="<?php echo urldecode($result['weibo']);?>"><i class="fa fa-weibo"></i></a></li>
							<li><a href="<?php echo urldecode($result['qzone']);?>"><i class="fa fa-qq"></i></a></li>
						</ul>

					<?php }}?>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">My Account</h3>
						<ul class="list-links">
							<li><a href="my-account.php">My Account</a></li>
							<li><a href="checkout.php">Checkout</a></li>
							<li><a href="order-details.php">Order Details</a></li>
							<li><a href="login.php">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Customer Service</h3>
						<ul class="list-links">
							<?php 
                                   $getPage =$pg->getPage();
                                   if ($getPage) {
                                       while ($result =$getPage->fetch_assoc()) {
                                    
                                ?>
                                <li><a href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['page_name'];?></a></li>
							
							<?php }}?>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Stay Connected</h3>
						<p>Stay up to date with news and promotions by Subscribe for our weekly newsletter..</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Enter Email Address">
							</div>
							<button class="primary-btn">Join Newslatter</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> E-shop Allinone, All rights reserved | Developed by <i class="fa fa-heart-o" aria-hidden="true"></i> alamin rony <a href="#" target="_blank"></a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->

<script>
		var preloader = document.getElementById("loading");
		function myFunction(){
			preloader.style.display = 'none';
		};
	</script>
<script>
	$(document).ready(function(){
		load_cart_data();
	function load_cart_data()
	{
		$.ajax({
			url:"fetch_cart_ajax.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
					$('#cart_details').html(data.cart_details);
				    $('.total_price').text(data.total_price);
				   $('.badge').text(data.total_item);
			
				
			},
		});
	}

	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});

	$(document).on('click', '.add-to-cart', function(){
		var product_id = $(this).attr("id");
		var product_name = $('#name'+product_id+'').val();
		var product_price = $('#price'+product_id+'').val();
		var product_image = $('#image'+product_id+'').val();
		var product_color = $('#color'+product_id+'').val();
		var product_size = $('#size'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id).val();
		var action = "add";
		if(product_quantity > 0)
		{
			if(confirm("Item has been Added into Cart")){


			$.ajax({
				url:"addToCart.php",
				method:"POST",
				data:{product_id:product_id, product_name:product_name, product_price:product_price,product_image:product_image,product_color:product_color,product_size:product_size, product_quantity:product_quantity, action:action},
				success:function(data)
				{
					load_cart_data();
					// alert("Item has been Added into Cart");
					

				},
			});
		}
	}
		else
		{
			alert("lease Enter Number of Quantity");
		}
	});
     
   
	$(document).on('click', '.delete', function(){
		var cartId = $(this).attr("id");
		var action = 'remove';
		if(confirm("Are you sure you want to remove this product?"))
		{
			$.ajax({
				url:"deleteCartProduct.php",
				method:"POST",
				data:{cartId:cartId, action:action},
				success:function()
				{
					load_cart_data();
					$('#cart-popover').popover('hide');
				}
			})

			setInterval(function(){
		   $("#refresh").load("getCartRefresh.php");
	       },100);
			
		}
		else
		{
			return false;
		}
	});

	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		if(confirm("Are you sure you want to clear your Cart?"))
		{
			$.ajax({
			url:"deleteAllCartProduct.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				alert("Your Cart has been clear");
			}
		});
			setInterval(function(){
		   $("#refresh").load("getCartRefresh.php");
	       },100);

		}else
		{
			return false;
		}
		
	});

	});
	   
</script>
</body>
</html>

	
