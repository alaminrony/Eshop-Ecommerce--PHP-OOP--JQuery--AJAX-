<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    
       if(isset($_GET['delsliderid'])) { 
     
        $delSid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delsliderid']);
        $delSlider = $sl->deleteSlider($delSid);

       }  

?>





<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block"> 
                <?php 
        		     if (isset($delSlider)) {
        		      echo $delSlider;
        		     }

        		 ?> 
             <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL NO</th>
					<th>slider Title</th>				
					<th>Image</th>					
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				    $GetSlider = $sl->ALLSlider();
				    if ($GetSlider){
				             $i=0; 
				    	while($result = $GetSlider->fetch_assoc()) {
				    		$i++;
				   
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['title'];?></td>			
					<td><img src="<?php echo $result['image'];?>"  height="90px" width="120px"/></td>				
					<td>

					 <a href="slideredit.php?sliderid=<?php echo $result['id'];?>">Edit</a> 
					 || <a onclick="return confirm('Are you sure to Delete !')" href="?delsliderid=<?php echo $result['id'];?>">Delete</a>

					</td>
					
				</tr>

			<?php } } ?> 

			


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

