<?php include 'inc/header.php'?>
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="10" />
                    <input type="hidden" id="hidden_maximum_price" value="10000" />
                    <p id="price_show">10 - 10000 $</p>
                    <div id="price_range"></div>
                </div>
                				
                <div class="list-group">
					<h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    	 <?php 
                                $brand=new Brand();
                                 $getBrand = $brand->getAllBrand();
                                 if($getBrand){
                                $i=0;
                                while ( $result=$getBrand->fetch_assoc()) {
                                    $i++;
                            ?>
					
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $result['brandName'];?>"><?php echo $result['brandName'];?></label>
                    </div>

                     <?php }}?>
                    </div>
                </div>

                     

				<div class="list-group">
					<h3>Color</h3>
					 <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector color" value="Black">Black</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector color" value="White">White</label>
                    </div>
                    <div class="list-group-item checkbox">
                       <label><input type="checkbox" class="common_selector color" value="Green">Green</label>
                    </div>
                    <div class="list-group-item checkbox">
                       <label><input type="checkbox" class="common_selector color" value="Silver">Silver</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector color" value="Golden">Golden</label>
                    </div>
                    <div class="list-group-item checkbox">
                       <label><input type="checkbox" class="common_selector color" value="Red">Red</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector color" value="Yellow">Yellow</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector color" value="Blue">Blue</label>
                    </div>
                     <div class="list-group-item checkbox">
                         <label><input type="checkbox" class="common_selector color" value="Orange">Orange</label>
                    </div>
               </div>
               </div>  
				
				<div class="list-group">
					<h3>Size</h3>
					<div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector size" value="S">Small</label>
                    </div>
                     <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector size" value="M">Medium</label>
                    </div>
                     <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector size" value="L">Large</label>
                    </div>
                     <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector size" value="XL">Extra Large</label>
                    </div>
                   </div>	
                </div>
            </div>

				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					<!-- STORE -->

						<!-- row -->
						<div class="row">
							<!-- Product Single -->
							<div id="display_item">

							


			               </div>
							<!-- /Product Single -->
							<div class="clearfix visible-sm visible-xs"></div>
						</div>
						<!-- /row -->


				</div>
				<!-- /MAIN -->
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


      load_product();  
      function load_product(page)  
      {  
           $.ajax({  
                url:"fetch_item.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#display_item').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_product(page);  
      });  

    



	$(document).on("keyup","#livesearch",function(){
		var live = $(this).val();
		if(live != ''){
			$.ajax({
				url:"liveSearch.php",
				method:"POST",
				data:{search:live},
				dataType:"HTML",
				success:function(data){
					$("#display_item").html(data);
				}
			});

		}else{
			return load_product();
		}

	});



	//Advance Search
    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var color = get_filter('color');
        var size = get_filter('size');
        if(minimum_price >10|| maximum_price <10000 ||color != '' || brand != '' || size !=''){
          $.ajax({
            url:"advanceSearch.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand,color:color,size:size },
            success:function(data){
                $('#display_item').html(data);
            }
        });
        }else{
          return load_product();
        }
        	 
    }



    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:10,
        max:10000,
        values:[10, 10000],
        step:10,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });


});
</script>
<?php include'inc/footer.php'?>


	
