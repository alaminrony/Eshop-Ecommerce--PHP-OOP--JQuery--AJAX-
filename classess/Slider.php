<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Slider{
	 	private $db;
	 	private $fm;
	
		public function __construct(){
			$this->db=new Database();
			$this->fm=new Format();
	}

// start to codeing for slider  // start to codeing for slider
    

	public function addSlider($data,$file){
		$title         =$this->fm->validation($data['title']);
		$title         =mysqli_real_escape_string($this->db->link, $data['title']);
		
		
       
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if($title == '' ){
		    	$msg = "<span class='error'> fields must not be empty !! </span>";
        	    return $msg;

		    }elseif(empty($file_name)){
		    	$msg = "<span class='error'>Image fields must not be empty !! </span>";
        	    return $msg;
		    }
		    else{
					if ($file_size >1048567) {
						     $msg= "<span class='error'>Image Size should be less then 1MB! </span>";
						     return $msg;
						    } 

						 elseif (in_array($file_ext, $permited) === false) {
						     $msg= "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						     return $msg;

						    }

					    
					    else{
					    	move_uploaded_file($file_temp, $uploaded_image);

					    	$query= "INSERT INTO tbl_slider(title,image) VALUES('$title','$uploaded_image') ";
					    	        
			        	    $inserted_row =$this->db->insert($query);
			        	               if($inserted_row){
			        		           $msg ="<span class='success'>Slider image insert successfully. </span>";
			        		           return $msg;
			        	            }

			        	               else {
			                          $msg= "<span class='error'>Slider image Not insert !</span>";
			                          return $msg;
							            }
				        	
				        	}
				  }
		    
            } 


    public function ALLSlider(){
    	$query ="SELECT * FROM tbl_slider";
    	$result= $this->db->select($query);
    	return $result;
    }

     public function ALLSliderFont(){
    	$query ="SELECT * FROM tbl_slider ORDER BY id ASC LIMIT 4";
    	$result= $this->db->select($query);
    	return $result;
    }

   

    public function GetSliderByID($sliderid){
    	$query ="SELECT * FROM tbl_slider where id='$sliderid' ";
    	$result= $this->db->select($query);
    	return $result;
    }


    
    public function sliderUpdate($data, $file, $sliderid){
    	$title      =$this->fm->validation($data['title']);
		$title     =mysqli_real_escape_string($this->db->link, $data['title']);
       
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		  if(empty($title)){
		    	$msg = "<span class='error'>fields must not be empty !! </span>";
        	    return $msg;

        	}
		      else{
					if (!empty($file_name)) {

					     if ($file_size >1048567) {
						     echo "<span class='error'>Image Size should be less then 1MB! </span>";
						    } 

						 elseif (in_array($file_ext, $permited) === false) {
						     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						    }

					    
					    else{
						$delImageQuery = "SELECT * FROM  tbl_slider WHERE id='$sliderid'";
		          	    $getData = $this->db->select($delImageQuery);

		          	    if ($getData) {
		          	    	while ($delImg =$getData->fetch_assoc()) {
		          	    	 $delLink =	$delImg['image'];
		          	    	 unlink($delLink);
		          	    	}
		          	    }

		          	    
					    	move_uploaded_file($file_temp, $uploaded_image);

					    	$query= "UPDATE tbl_slider
					    	         SET 
					    	         title = '$title',
					    	         image        ='$uploaded_image'
					    	         WHERE id ='$sliderid' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'> Slider Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Slider Not Update !</span>";
							          }
				        	
				        	}
				    
				    } 
				       
				       else{

					    						    	
					    	$query= "UPDATE tbl_slider
					    	         SET 
					    	         title = '$title'
					    	          WHERE id ='$sliderid' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'>Slider Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Slider Not Update !</span>";
							    }

				    }
				 
         
            }
    }



      public function deleteSlider($delSid){

    	    $query = "SELECT * FROM tbl_slider WHERE id='$delSid' ";
    	    $getData = $this->db->select($query);

    	    if ($getData) {
    	    	while ($delImg =$getData->fetch_assoc()) {
    	    	 $delLink =	$delImg['image'];
    	    	 unlink($delLink);

    	    		
    	    	}
    	    }

	         $delquery ="DELETE from tbl_slider where id='$delSid'";
	         $delData  =$this->db->delete($delquery);

	         if($delData){
	                $msg ="<span class='success'>Slider Deleted successfully. </span>";
	                return $msg;
	            }
	            else{
	                $msg ="<span class='error'>Slider Not Deleted . </span>";
	                return $msg;
	            }   

	    }



}

