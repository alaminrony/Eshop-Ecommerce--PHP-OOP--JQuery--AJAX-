(function(){
	$("#cartForm").click(function(e){
		e.preventDefault();
		var form = $(this);
		var id = $(this).data("id");
		var quantity = $("#quantity").val();
		$.ajax({

			url:"../classess/addToCart.php",
			method:"POST",
			dataType:"HTML",
			data:{id:id,quantity:quantity},
			success: function(data){
				console.log(data);


			}
		});



	});

});