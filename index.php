<?php include 'inc/header.php'?>
<?php include 'inc/slider.php'?>
	
	
<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Featured Products</h2>
					</div>
				</div>
				<!-- section title -->
                      <div id="display_featured_product">
					
				    </div>

				<!-- Product Single -->
				   
							<!-- /Product Single -->
					<div class="clearfix visible-sm visible-xs"></div>
			</div>
			<!-- /row -->
			
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->
                      <div id="display_latest_product">
					
				    </div>

				<!-- Product Single -->
				   
							<!-- /Product Single -->
					<div class="clearfix visible-sm visible-xs"></div>
			</div>
			<!-- /row -->
			
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
	<script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/slick.min.js"></script>
   <script src="js/nouislider.min.js"></script>
   <script src="js/jquery.zoom.min.js"></script>
   <script src="js/main.js"></script>
   <script src="js/jquery-ui.js"></script>
   <script>
   	$(document).ready(function(){
   		load_featured_product();

	function load_featured_product()
	{
		$.ajax({
			url:"fetch_featured_item.php",
			method:"POST",
			success:function(data)
			{
				
				$('#display_featured_product').html(data);
			}
		});
	}

    load_latest_product();

	function load_latest_product()
	{
		$.ajax({
			url:"fetch_latest_item.php",
			method:"POST",
			success:function(data)
			{
				
				$('#display_latest_product').html(data);
			}
		});
	}

   	});
   	


   </script>

<?php include'inc/footer.php'?>