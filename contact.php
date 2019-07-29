<?php include 'inc/header.php'?>
<style>
	#button{
		padding-bottom: 20px !important;
		
	}
	#contact{padding: 20px;}
	.btn{background:#F8694A !important;color:#fff;}
   .line{
  width: 60px;
  height: 3px;
  background: #30323A;
  margin-right: auto;
  margin-left: auto;}
  .row #contact-down-header{
    padding-top: 10px;
    font-size: 18px;

  }


</style>


<?php
  
   if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){ 
   	
         $name   =$fm->validation($_POST['name']);
         $name   =mysqli_real_escape_string($db->link,$name);

    	 $email    =$fm->validation($_POST['email']);
    	 $email    =mysqli_real_escape_string($db->link,$email);

    	 $phone       =$fm->validation($_POST['phone']);
    	 $phone       =mysqli_real_escape_string($db->link,$phone);

     	 $message        =$fm->validation($_POST['message']);
	     $message        =mysqli_real_escape_string($db->link,$message);
	 	
	
    
	   if (empty($name)) {
	 	$error['name']= "Name is required";
	   }

	   elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $error['name'] = "Only letters and white space allowed"; 
    }
      
	  if (empty($email)) {
	 	$error['email']= "Email is required";
	 }
	  
	  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error['email'] = "Invalid email format"; 
    }

     if (empty($phone)) {
	 	$error['phone']= "Phone Number is required";
	 }

	 if (empty($message)) {
	 	$error['message']= "Message  is required";
	 }


	  else {
	  	$query= "INSERT INTO tbl_contact(name,email,phone,message) 
		    	VALUES('$name','$email','$phone','$message')";

        	    $inserted_row =$db->insert($query);
        	               if($inserted_row){
        		           $msg ="Message send successfully !!";
        		           
        	               }

        	               else {
                          $msg=  "Message not successfully!";                         

		                    }

	                   }

	                }   

?>
<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="section-heading">Contact</h1>
      <div class="line"></div>
        <p class="text-light font-italic" id="contact-down-header">Have a question or any Query to know about product?</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 ">
        <form action="" method="POST">
          <div class="row">
            <div id="error_message" class="text-success text-center col-md-12">
            	          <?php
					          if (isset($msg)) {
					   	        echo "<div class='alert alert-success' role='alert'>$msg</div>";
					         }
					        ?></div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control form-control-lg" name="name" type="text" placeholder="Your Name *">
                <p class="text-danger" id="error_name">
                	      <?php
					          if (isset($error['name'])) {
					   	        echo $error['name'];
					         }
					        ?></p>
              </div>
              <div class="form-group " >
                <input class="form-control form-control-lg" name="email" type="email" placeholder="Your Email *">
                <p class="text-danger" id="error_email">
                	<?php
					          if (isset($error['email'])) {
					   	        echo $error['email'];
					         }
					        ?>
                </p>
              </div>
              <div class="form-group">
                <input class="form-control form-control-lg" name="phone" type="tel" placeholder="Your Phone *">
                <p class="text-danger" id="error_phone">
                	<?php
					          if (isset($error['phone'])) {
					   	        echo $error['phone'];
					         }
					        ?>
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" >
                <textarea rows="6"  class="form-control form-control-lg pb-3" name="message" placeholder="Your Message *"></textarea>
                <p class="text-danger" id="error_message">
                	      <?php
					          if (isset($error['message'])) {
					   	        echo $error['message'];
					         }
					        ?>
                </p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 text-center mb-5" id="button">
              <div id="success"></div>
              <button  class="btn btn-default btn-md text-uppercase" type="submit" name="submit">Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/slick.min.js"></script>
   <script src="js/nouislider.min.js"></script>
   <script src="js/jquery.zoom.min.js"></script>
   <script src="js/main.js"></script>
   <script src="js/jquery-ui.js"></script>
   
<?php include 'inc/footer.php'?>