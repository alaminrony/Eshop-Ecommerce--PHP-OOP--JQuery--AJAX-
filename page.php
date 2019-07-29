<?php include 'inc/header.php'?>
<style>
 .line{
  width: 60px;
  height: 3px;
  background: #30323A;
  margin-right: auto;
  margin-left: auto;
}

  .content{
    margin-top: 10px;

  }
  .paragraph{
    padding: 20px;
    font-size:18px;

  }


</style>
<?php 
   if(!isset($_GET['pageid']) || $_GET['pageid']== NULL) {
       echo "<script>window.location='404.php'</script>";
       }

       else{
         
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['pageid']);

       }

?>

        
             <div class="container">
               <div class="row">
                 <div class="col-md-12">
                      <?php 
                   $getPageById = $pg->getPageById($id);
                    if ($getPageById) {
                     while($result=$getPageById->fetch_assoc()) {

                   ?>  
                       <div class="content">
                         <div class="header">
                          <h1 class="text-center"><?php echo $result['page_name'];?></h1>
                         </div>
                         <div class="line"></div>

                         <div class="paragraph">
                           <p><?php echo $result['page_content'];?></p>
                         </div>
                 

               <?php  } } else{ echo "<script>window.location='404.php'</script>"; }?>
                  
                    </div>
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