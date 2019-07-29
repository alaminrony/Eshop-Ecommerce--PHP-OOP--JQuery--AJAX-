<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Product.php';?>
<?php include_once '../helpers/Format.php';?>

<?php 
$pd=new Product();
$fm=new Format();

if(isset($_GET['delproduct'])){

      	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delproduct']);
      	 $delproduct   =$pd->delProductById($id);
      }

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
        		<?php 
        		     if (isset($delproduct)) {
        		      echo $delproduct;
        		     }

        		 ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Pro Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Price</th>
					<th>Color</th>
					<th>Size</th>
					<th>Details</th>
					<th>Image</th>
					<th>F Iteam</th>
					<th>Stock</th>
					<th>Condition</th>
					<th>Description</th>
					<th>Keyword</th>
					<th>date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$getProduct  = $pd->getAllProduct();
					if ($getProduct) {
						$i=0;
						while ($result = $getProduct->fetch_assoc()) {
							$i++;
							
					?>

				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['product_name'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo $result['price'];?></td>
					<td><?php echo $result['color'];?></td>
					<td><?php echo $result['size'];?></td>
					<td><?php echo $fm->textShorten($result['details'], 40);?></td>
					<td><img src="<?php echo $result['image'];?>"  height="40px" width="60px"/></td>			
					<td>
						<?php
						  if ($result['feature_item'] == 0) {
						  	echo "Latest";					 
						  }

						  else{
						  	echo "Featured";
						  }

						  ?>
					  	
					 </td>

					

					 <td>
						<?php
						  if ($result['stock'] == 0) {
						  	echo "In Stock";					 
						  }

						  else{
						  	echo "Not Available";
						  }

						  ?>
					  	
					 </td>

					 <td>
						<?php echo $result['product_condition'];?>
					  	
					 </td>
					  <td>
						<?php echo $fm->textShorten($result['description'],10);?>
					  	
					 </td>
					  <td>
						<?php echo $fm->textShorten($result['keywords'],10);?>
					  	
					 </td>
                     <td><?php echo $fm->formatDate($result['created_at']) ;?></td> 

					<td>
					<a class="btn btn-success" href="productview.php?proid=<?php echo $result['product_id'];?>"><i class="fa fa-eye"></i></a>
					 <a class="btn btn-info" href="product-edit.php?proid=<?php echo $result['product_id'];?>"><i class="fa fa-edit"></i></a> 

					 <a class="btn btn-danger" onclick="return confirm('Are you sure to Delete !')" href="?delproduct=<?php echo $result['product_id'];?>"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php }}?>

			</tbody>
		</table>

       </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
