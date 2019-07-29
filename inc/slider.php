<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<?php
					   $allslider=  $sl->ALLSliderFont(); 
					    if($allslider){
					    	while($result = $allslider->fetch_assoc()){


					?>
					<div class="banner banner-1">
						<img src="admin/<?php echo $result['image']?>" alt="">
						<div class="banner-caption text-center">
							<h1 class="primary-color"><?php echo $result['title']?></h1>
							<a href="products.php" class="primary-btn">Shop Now</a>
						</div>
					</div>
				<?php }}?>
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->
