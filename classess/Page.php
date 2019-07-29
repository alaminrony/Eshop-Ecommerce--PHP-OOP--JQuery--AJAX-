<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Page{
	 	private $db;
	 	private $fm;
	
		public function __construct(){
			$this->db=new Database();
			$this->fm=new Format();
	}



	    public function PageInsert($data){

		$page_name         =$this->fm->validation($data['page_name']);
		$page_content      =$this->fm->validation($data['page_content']);		
		
		$page_name         =mysqli_real_escape_string($this->db->link, $data['page_name']);
		$page_content      =mysqli_real_escape_string($this->db->link, $data['page_content']);	

		    if($page_name == '' || $page_content == ''){
		    	$msg = "<span class='error'>Fields must not be empty !! </span>";
        	    return $msg;

		    }
		    else{
		    	
		    	$query= "INSERT INTO tbl_page(page_name,page_content ) 
		    	VALUES('$page_name','$page_content')";

        	    $inserted_row =$this->db->insert($query);
        	               if($inserted_row){
        		           $msg ="<span class='success'>Page insert successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Page Not Inserted !</span>";
				    }
				}
				        	
			}


		public function getPage(){
			$query = "SELECT * FROM tbl_page";
			$result = $this->db->select($query);
			return $result;
		}

		public function getPageById($id){
			$query = "SELECT * FROM tbl_page where id='$id'";
			$result = $this->db->select($query);
			return $result;
		}


		 public function PageUpdate($data,$id){
		
		$page_name         =mysqli_real_escape_string($this->db->link, $data['page_name']);
		$page_content      =mysqli_real_escape_string($this->db->link, $data['page_content']);
		$description      =mysqli_real_escape_string($this->db->link, $data['description']);
		$keywords      =mysqli_real_escape_string($this->db->link, $data['keywords']);
      	   $query= "UPDATE tbl_page
		    	          SET 
		    	          page_name     = '$page_name',
		    	          page_content     = '$page_content',
		    	          description     ='$description',
		    	          keywords ='$keywords'
		    	          
		    	         WHERE id ='$id'  ";


        	    $update_row =$this->db->update($query);
        	               if($update_row){
        		           $msg ="<span class='success'>Page Update successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Page Not Update !</span>";
				    }

      }

         // Call to deletepage.php
      public function deletePageById($delPageId){		 
        
		         $delquery ="DELETE from tbl_page where id='$delPageId'";
		         $delData  =$this->db->delete($delquery);

		         if($delData){
		               echo "<script> alert('Data Delete succressfully');</script>";
                   echo "<script> window.location='index.php';</script>";
                    
		            }
		            else{
		               echo "<script>alert('Page Not Delete successfully');</script>";
                   echo "<script> window.location='index.php';</script>";
                    
		            } 
      
	}


	       public function getTitleSlogan(){
       	       $query = "SELECT * FROM title_slogan where id='1'";
               $result= $this->db->select($query);
               return $result;
       }


	    public function updateTitleSlogan($data, $file){
    	$title         =$this->fm->validation($data['title']);
		$slogan         =$this->fm->validation($data['slogan']);		
		
		$title         =mysqli_real_escape_string($this->db->link, $data['title']);
		$slogan         =mysqli_real_escape_string($this->db->link, $data['slogan']);		
		
		
       
		    $permited  = array('png');
		    $file_name = $file['logo']['name'];
		    $file_size = $file['logo']['size'];
		    $file_temp = $file['logo']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $same_image ='Logo'.'.'.$file_ext;
		    $uploaded_image = "uploads/".$same_image;

		  if($title == '' || $slogan == '' ){
		    	$msg = "<span class='error'> fields must not be empty !! </span>";
        	    return $msg;

		    }
		      else{
					if (!empty($file_name)) {
					      	 	
					      	 

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

					    	$query= "UPDATE title_slogan
					    	         SET 
					    	        
					    	         title     = '$title',
					    	         slogan    = '$slogan',					    	       
					    	         logo     = '$uploaded_image'
					    	        
					    	         WHERE id ='1' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'>Data Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Data Not Update !</span>";
							          }
				        	
				        	}
				    
				    } 
				       
				       else{

					    						    	
					    	$query= "UPDATE title_slogan
					    	         SET 
					    	          title     = '$title',
					    	         slogan    = '$slogan'
					    	         WHERE id ='1'  ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'> Data Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Data Not Update !</span>";
							    }

				    }
				 
         
            }
    }


      public function socialmedia(){
      	$query = "SELECT * FROM tbl_social WHERE id='1' ";
      	$result = $this->db->select($query);
      	return $result;

      }

      public function Updatesocialmedia($data){

      	$facebook          =mysqli_real_escape_string($this->db->link, $data['facebook']);
		$twitter           =mysqli_real_escape_string($this->db->link, $data['twitter']);
		$linkdin           =mysqli_real_escape_string($this->db->link, $data['linkdin']);
		$google            =mysqli_real_escape_string($this->db->link, $data['google']);
		$youtube           =mysqli_real_escape_string($this->db->link, $data['youtube']);
		$pinterest         =mysqli_real_escape_string($this->db->link, $data['pinterest']);
		$instagram         =mysqli_real_escape_string($this->db->link, $data['instagram']);
		$tumblr            =mysqli_real_escape_string($this->db->link, $data['tumblr']);
		$reddit            =mysqli_real_escape_string($this->db->link, $data['reddit']);
		$flickr            =mysqli_real_escape_string($this->db->link, $data['flickr']);
		$quora             =mysqli_real_escape_string($this->db->link, $data['quora']);
		$whatsapp          =mysqli_real_escape_string($this->db->link, $data['whatsapp']);
		$weibo             =mysqli_real_escape_string($this->db->link, $data['weibo']);
		$qzone             =mysqli_real_escape_string($this->db->link, $data['qzone']);

      	$facebook      =urlencode($data['facebook']);
		$twitter       =urlencode($data['twitter']);		
		$linkdin       =urlencode($data['linkdin']);	
		$google        =urlencode($data['google']);
		$youtube       =urlencode($data['youtube']);
		$pinterest     =urlencode($data['pinterest']);
		$instagram     =urlencode($data['instagram']);
		$tumblr        =urlencode($data['tumblr']);
		$reddit        =urlencode($data['reddit']);
		$flickr        =urlencode($data['flickr']);
		$quora         =urlencode($data['quora']);
		$whatsapp      =urlencode($data['whatsapp']);
		$weibo         =urlencode($data['weibo']);
		$qzone         =urlencode($data['qzone']);

		
		
             $query= "UPDATE tbl_social
		    	          SET 
		    	          facebook     = '$facebook',
		    	          twitter      = '$twitter',
		    	          linkdin      = '$linkdin',
		    	          google       = '$google',
		    	          youtube      = '$youtube',
		    	          pinterest    = '$pinterest',
		    	          instagram    = '$instagram',
		    	          tumblr       = '$tumblr',
		    	          reddit       = '$reddit',
		    	          flickr       = '$flickr',
		    	          quora        = '$quora',
		    	          whatsapp     = '$whatsapp',
		    	          weibo        = '$weibo',
		    	          qzone        = '$qzone'
		    	         WHERE id ='1'  ";


        	    $update_row =$this->db->update($query);
        	               if($update_row){
        		           $msg ="<span class='success'> Data Update successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Data Not Update !</span>";
				    }

      }


      public function Copyright(){
      		$query = "SELECT * FROM tbl_copyright WHERE id='1' ";
      	    $result = $this->db->select($query);
      	    return $result;
      }

      public function UpdateCopyright($copyright){
      	   $query= "UPDATE tbl_copyright
		    	          SET 
		    	          copyright     = '$copyright'
		    	          
		    	         WHERE id ='1'  ";


        	    $update_row =$this->db->update($query);
        	               if($update_row){
        		           $msg ="<span class='success'> Data Update successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Data Not Update !</span>";
				    }

      }
	    



}
?>
