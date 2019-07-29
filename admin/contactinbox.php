<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
     if (isset($_GET['seenmsgid'])) {
     	$SeenMsgId =$_GET['seenmsgid'];
     	$sentToSeenBox=$cont->sentToSeenBox($SeenMsgId);     	
     }

?>

<?php
    
      if(isset($_GET['delid'])){

      	$delid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
      	 $delMessage   =$cont->deleteMessage($delid);
      }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                 <?php
                   if (isset($sentToSeenBox)) {
                   	echo $sentToSeenBox;
                   }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$getALLMessage=$cont->getALLMessage();
						if ($getALLMessage) {
							$i=0;
							while ($result =$getALLMessage->fetch_assoc()) {
							$i++;

						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $result['phone'];?></td>
							<td><?php echo $fm->textShorten($result['message'],30);?></td>
							<td><?php echo $fm->formatDate($result['created_at']);?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> ||
							    <a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a>||
							    <a onclick="return confirm('Are you sure to Move in Seen Box')" href="?seenmsgid=<?php echo $result['id'];?>">Seen</a>
							</td>
						</tr>
					<?php }}?>
						
						
						
					</tbody>
				</table>
               </div>
            </div>

                   <div class="box round first grid">
                <h2>Seen Message</h2>
                <?php
                 if (isset($delMessage)) {
                  	echo $delMessage;
                  } 

                ?>
               
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$getALLSeenMessage=$cont->getALLSeenMessage();
						if ($getALLSeenMessage) {
							$i=0;
							while ($result =$getALLSeenMessage->fetch_assoc()) {
							$i++;

						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $result['phone'];?></td>
							<td><?php echo $fm->validation($result['message']);?></td>
							<td><?php echo $fm->formatDate($result['created_at']);?></td>
							<td> 
								<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> ||
							 <a onclick="return confirm('Are You Sure to Delete!')"  href="?delid=<?php echo $result['id'];?>">Delete</a></td>
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


