<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>



<?php
class Product{
	 private $db;
	 private $fm;
	
	 public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}


	public function productInsert($data, $file){

		$product_name      =$this->fm->validation($data['product_name']);
		$catId             =$this->fm->validation($data['catId']);
		$brandId           =$this->fm->validation($data['brandId']);
		$price             =$this->fm->validation($data['price']);
		$details           =$this->fm->validation($data['details']);
		$feature_item      =$this->fm->validation($data['feature_item']);
		$stock             =$this->fm->validation($data['stock']);
		$product_condition =$this->fm->validation($data['product_condition']);
		$description       =$this->fm->validation($data['description']);
		$keywords          =$this->fm->validation($data['keywords']);
		$color             =$this->fm->validation($data['color']);
		$size              =$this->fm->validation($data['size']);

		$product_name     =mysqli_real_escape_string($this->db->link, $data['product_name']);
		$catId            =mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId          =mysqli_real_escape_string($this->db->link, $data['brandId']);
		$price            =mysqli_real_escape_string($this->db->link, $data['price']);
		$details          =mysqli_real_escape_string($this->db->link, $data['details']);
		$feature_item     =mysqli_real_escape_string($this->db->link, $data['feature_item']);
		$stock            =mysqli_real_escape_string($this->db->link, $data['stock'] );
		$product_condition=mysqli_real_escape_string($this->db->link, $data['product_condition']);
		$description      =mysqli_real_escape_string($this->db->link, $data['description']);
		$keywords         =mysqli_real_escape_string($this->db->link, $data['keywords'] );
		$color            =mysqli_real_escape_string($this->db->link, $data['color'] );
		$size             =mysqli_real_escape_string($this->db->link, $data['size'] );
		
		
		if(empty($color)){
              $color = '';
		}else{
			$color = $color;
		}

		if(empty($size)){
              $size = '';
		}else{
			$size = $size;
		}

       
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if($product_name == '' || $catId == '' || $brandId  == '' ||$price== '' || 
		    	$details  == ''|| $feature_item  == ''||$stock  == ''||$file_name  == ''|| $product_condition=='' || $description ==''|| $keywords ==''){
		    	$msg = "<span class='error'> fields must not be empty !! </span>";
        	    return $msg;

		    }
		     elseif ($file_size >1048567) {
			     echo "<span class='error'>Image Size should be less then 1MB! </span>";
			    } 

			 elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			    }

		    
		    else{
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query= "INSERT INTO tbl_product(product_name, catId,brandId,price, color, size,details,image,feature_item,stock,product_condition, description, keywords) 
		    	VALUES('$product_name','$catId','$brandId','$price','$color','$size','$details','$uploaded_image','$feature_item','$stock','$product_condition','$description','$keywords')";

        	    $inserted_row =$this->db->insert($query);
        	               if($inserted_row){
        		           $msg ="<span class='success'> product insert successfully. </span>";
        		           return $msg;
        	               }

        	               else {
                          echo "<span class='error'>Image Not Inserted !</span>";
				    }
				        	
				 }
			}



	public function getAllProduct(){
		      /*  JOIN BY ARRIES JOIN  */

		   $query = "SELECT p.*, c.catName,b.brandName
		             FROM tbl_product as p, tbl_category as c, tbl_brand as b
		             WHERE p.catId = c.catId AND p.brandId= b.brandId 
		             ORDER BY p.product_id DESC  "; 


		    
		    /*  JOIN BY INNER JOIN  */
        
		/*	$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
			          FROM tbl_product
			          INNER JOIN tbl_category
			          ON tbl_product.catId =  tbl_category.catId

			          
			          INNER JOIN tbl_brand
			          ON tbl_product.brandId =  tbl_brand.brandId
			          ORDER BY tbl_product.productId DESC "; */

         
          $result = $this->db->select($query);
        return $result;
        

	}


	public function getAllProductAjax(){
		      /*  JOIN BY ARRIES JOIN  */

		       $record_per_page = 9;  
              $page = '';  
               $output = '';  
              if(isset($_POST["page"]))  
      {  
               $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ($page - 1)*$record_per_page; 


		   $query ="SELECT * FROM tbl_product ORDER BY product_id DESC  LIMIT $start_from, $record_per_page";

          $getProduct = $this->db->select($query);
          $output = '';
          if($getProduct){
          	while($result = $getProduct->fetch_assoc()){
          		$output .='

          		<div class="col-md-4 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" id="display_item">
										<div class="product-label">
											<span class="sale">'.$result['product_condition'].'</span>
										</div>

										<a class="main-btn quick-view"  href="product-page.php?proid='.$result['product_id'].'"><i class="fa fa-search-plus"></i><span> Quick view</span></a>
										<img src="admin/'.$result['image'].'" alt="">
									</div>

									<div class="product-body text-center">
										<h3 class="product-price">$ '.$result['price'].' </h3>
										
										<h2 class="product-name"><a href="product-page.php?proid='.$result['product_id'].'">'.$result['product_name'].'</a></h2>
										
										<div class="product-btns text-center">
										   <div style="width:30%;display:inline-block;">
											   <input class="input" type="number" name="quantity" id="quantity'.$result['product_id'].'" value="1" >
										   </div>
										   <input type="hidden" name="hidden_name" id="name'.$result["product_id"].'" value="'.$result["product_name"].'" />
            	                           <input type="hidden" name="hidden_price" id="price'.$result["product_id"].'" value="'.$result["price"].'" />
            	                           <input type="hidden" name="hidden_image" id="image'.$result["product_id"].'" value="'.$result["image"].'" />
            	                           <input type="hidden" name="hidden_color" id="color'.$result["product_id"].'" value="'.$result["color"].'" />
            	                           <input type="hidden" name="hidden_size" id="size'.$result["product_id"].'" value="'.$result["size"].'" />
											
											<button class="primary-btn add-to-cart" id="'.$result["product_id"].'"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>

          		';
          	}
          	$output .= '<div align="center">';  
 $page_query = "SELECT * FROM tbl_product ORDER BY product_id DESC";  
 $page_result = $this->db->select($page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page); 
 $output .="  
                    <div class='row'>
                      <div class='col-md-12'>
                      <div align='center'>
							<ul class='store-pages'>
								<li><span class='text-uppercase' style='color:#F8694A'>Page:</span></li>"; 
 for($i=1; $i<=$total_pages; $i++)

 {  
     
             $output .= "<li class='pagination_link' style='cursor:pointer;font-size:20px; padding:6px;margin:2px; border:1px solid #F8694A;' id='".$i."'>".$i."</li>";
    
 }  
 $output .="</ul>
      </div>
 </div>
</div>";
          	 echo $output;
          }

	}


	 public function getProductById($id){
        $query = "SELECT p.*, c.catName ,b.brandName
		             FROM tbl_product as p, tbl_category as c,tbl_brand as b 
		             WHERE p.catId = c.catId AND p.brandId= b.brandId 
		             AND p.product_id='$id' ";
             $result = $this->db->select($query);
        return $result;

    }


   


    public function productUpdate($data, $file, $id){
    	$product_name      =$this->fm->validation($data['product_name']);
		$catId             =$this->fm->validation($data['catId']);
		$brandId           =$this->fm->validation($data['brandId']);
		$price             =$this->fm->validation($data['price']);
		$details           =$this->fm->validation($data['details']);
		$feature_item      =$this->fm->validation($data['feature_item']);
		$stock             =$this->fm->validation($data['stock']);
		$product_condition =$this->fm->validation($data['product_condition']);
		$description       =$this->fm->validation($data['description']);
		$keywords          =$this->fm->validation($data['keywords']);
		$color             =$this->fm->validation($data['color']);
		$size              =$this->fm->validation($data['size']);

		$product_name     =mysqli_real_escape_string($this->db->link, $data['product_name']);
		$catId            =mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId          =mysqli_real_escape_string($this->db->link, $data['brandId']);
		$price            =mysqli_real_escape_string($this->db->link, $data['price']);
		$details          =mysqli_real_escape_string($this->db->link, $data['details']);
		$feature_item     =mysqli_real_escape_string($this->db->link, $data['feature_item']);
		$stock            =mysqli_real_escape_string($this->db->link, $data['stock'] );
		$product_condition=mysqli_real_escape_string($this->db->link, $data['product_condition']);
		$description      =mysqli_real_escape_string($this->db->link, $data['description']);
		$keywords         =mysqli_real_escape_string($this->db->link, $data['keywords'] );
		$color            =mysqli_real_escape_string($this->db->link, $data['color'] );
		$size             =mysqli_real_escape_string($this->db->link, $data['size'] );
		
		
		if(empty($color)){
              $color = '';
		}else{
			$color = $color;
		}

		if(empty($size)){
              $size = '';
		}else{
			$size = $size;
		}
       
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		  if($product_name == '' || $catId == '' || $brandId  == '' ||$price== '' || 
		    	$details  == ''|| $feature_item  == ''||$stock  == '' || $product_condition  == '' ||$description==''|| $keywords==''){
		    	$msg = "<span class='error'> fields must not be empty !! </span>";
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
						$delImageQuery = "SELECT * FROM tbl_product WHERE product_id='$id'";
		          	    $getData = $this->db->select($delImageQuery);

		          	    if ($getData) {
		          	    	while ($delImg =$getData->fetch_assoc()) {
		          	    	 $delLink =	$delImg['image'];
		          	    	 unlink($delLink);
		          	    	}
		          	    }

		          	    
					    	move_uploaded_file($file_temp, $uploaded_image);

					    	$query= "UPDATE tbl_product
					    	         SET 
					    	         product_name = '$product_name',
					    	         catId       = '$catId',
					    	         brandId       = '$brandId',
					    	         price        = '$price',
					    	         color        = '$color',
					    	         size        = '$size',
					    	         details       = '$details',
					    	         feature_item        = '$feature_item',
					    	         stock        = '$stock',
					    	         product_condition= '$product_condition',
					    	         image        ='$uploaded_image',
					    	         description  ='$description',
					    	         keywords     ='$keywords',
					    	         created_at   =Now()
					    	         WHERE product_id ='$id' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'> product Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Product Not Update !</span>";
							          }
				        	
				        	}
				    
				    } 
				       
				       else{

					    						    	
					    	$query= "UPDATE tbl_product
					    	         SET 
					    	         product_name = '$product_name',
					    	         catId       = '$catId',
					    	         brandId       = '$brandId',
					    	         price        = '$price',
					    	         color        = '$color',
					    	         size        = '$size',
					    	         details       = '$details',
					    	         feature_item   = '$feature_item',
					    	         stock        = '$stock',
					    	         product_condition= '$product_condition',
					    	         description  ='$description',
					    	         keywords     ='$keywords',
					    	         created_at   =NOW()
					    	         WHERE product_id ='$id' ";


			        	    $update_row =$this->db->update($query);
			        	               if($update_row){
			        		           $msg ="<span class='success'> product Update successfully. </span>";
			        		           return $msg;
			        	               }

			        	               else {
			                          echo "<span class='error'>Product Not Update !</span>";
							    }

				    }
				 
         
            }
    }

         
         // use Admin panel
        public function delProductById($id){

        	    $query = "SELECT * FROM tbl_product WHERE product_id='$id'";
        	    $getData = $this->db->select($query);

        	    if ($getData) {
        	    	while ($delImg =$getData->fetch_assoc()) {
        	    	 $delLink =	$delImg['image'];
        	    	 unlink($delLink);

        	    		
        	    	}
        	    }
        
		         $delquery ="DELETE from tbl_product where product_id='$id'";
		         $delData  =$this->db->delete($delquery);

		         if($delData){
		                $msg ="<span class='success'> Product Deleted successfully. </span>";
		                return $msg;
		            }
		            else{
		                $msg ="<span class='error'> Product Not Deleted . </span>";
		                return $msg;
		            }   

		    }

	
	// use Font end
	public function getFeaturedProduct(){

		 $query =  "SELECT * FROM tbl_product WHERE feature_item = '1' ORDER BY product_id DESC LIMIT 4";
         $getProduct = $this->db->select($query);
          $output = '';
          if($getProduct){
          	while($result = $getProduct->fetch_assoc()){
          		$output .='
          		     <div class="col-md-3 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" id="display_item">
										<div class="product-label">
											<span class="sale">'.$result['product_condition'].'</span>
										</div>
										<a class="main-btn quick-view" href="product-page.php?proid='.$result['product_id'].'"><i class="fa fa-search-plus"></i><span>Quick view</span></a>
										<img src="admin/'.$result['image'].'" alt="">
									</div>

									<div class="product-body text-center">
										<h3 class="product-price">$ '.$result['price'].' </h3>
										
										<h2 class="product-name"><a href="product-page.php?proid='.$result['product_id'].'">'.$result['product_name'].'</a></h2>
										
										<div class="product-btns text-center">
										   <div style="width:30%;display:inline-block;">
											   <input class="input" type="number" name="quantity" id="quantity'.$result['product_id'].'" value="1" >
										   </div>
										  <input type="hidden" name="hidden_name" id="name'.$result["product_id"].'" value="'.$result["product_name"].'" />
            	                           <input type="hidden" name="hidden_price" id="price'.$result["product_id"].'" value="'.$result["price"].'" />
            	                           <input type="hidden" name="hidden_image" id="image'.$result["product_id"].'" value="'.$result["image"].'" />
            	                           <input type="hidden" name="hidden_color" id="color'.$result["product_id"].'" value="'.$result["color"].'" />
            	                           <input type="hidden" name="hidden_size" id="size'.$result["product_id"].'" value="'.$result["size"].'" />
											
											<button class="primary-btn add-to-cart" id="'.$result["product_id"].'"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>
          		
          		';
          	}
          	 echo $output;
          }

	}

     // use Font end
	public function getLatestProduct(){
		 $query =  "SELECT * FROM tbl_product WHERE feature_item='0' ORDER BY product_id DESC LIMIT 4";
        $getProduct = $this->db->select($query);
          $output = '';
          if($getProduct){
          	while($result = $getProduct->fetch_assoc()){
          		$output .='


          		<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" id="display_item">
										<div class="product-label">
											<span class="sale">'.$result['product_condition'].'</span>
										</div>
										<a class="main-btn quick-view" href="product-page.php?proid='.$result['product_id'].'"><i class="fa fa-search-plus"></i><span>Quick view</span></a>
										<img src="admin/'.$result['image'].'" alt="">
									</div>

									<div class="product-body text-center">
										<h3 class="product-price">$ '.$result['price'].' </h3>
										
										<h2 class="product-name"><a href="product-page.php?proid='.$result['product_id'].'">'.$result['product_name'].'</a></h2>
										
										<div class="product-btns text-center">
										   <div style="width:30%;display:inline-block;">
											   <input class="input" type="number" name="quantity" id="quantity'.$result['product_id'].'" value="1" >
										   </div>
										   <input type="hidden" name="hidden_name" id="name'.$result["product_id"].'" value="'.$result["product_name"].'" />
            	                           <input type="hidden" name="hidden_price" id="price'.$result["product_id"].'" value="'.$result["price"].'" />
            	                           <input type="hidden" name="hidden_image" id="image'.$result["product_id"].'" value="'.$result["image"].'" />
            	                           <input type="hidden" name="hidden_color" id="color'.$result["product_id"].'" value="'.$result["color"].'" />
            	                           <input type="hidden" name="hidden_size" id="size'.$result["product_id"].'" value="'.$result["size"].'" />
											
											<button class="primary-btn add-to-cart" id="'.$result["product_id"].'"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>
					

          		';
          	}
          	 echo $output;
          }

	}


	public function getSingleProduct($id){
		 $query = "SELECT p.*, c.catName , b.brandName
		             FROM tbl_product as p, tbl_category as c, tbl_brand as b
		             WHERE p.catId = c.catId AND p.brandId= b.brandId AND p.productId ='$id' "; 
		   $result = $this->db->select($query);
           return $result;

	}


	public function liveSearch($search){
		    	$search=$this->fm->validation($search);
    	        $search=mysqli_real_escape_string($this->db->link,$search);
		$query = "SELECT p.*, c.catName ,b.brandName
		             FROM tbl_product as p, tbl_category as c, tbl_brand as b
		             WHERE (p.catId = c.catId  AND p.brandId= b.brandId AND p.product_name LIKE '%$search%') 
		             OR(p.catId = c.catId AND  p.brandId= b.brandId AND p.details LIKE '%$search%')
		             OR(p.catId = c.catId AND  p.brandId= b.brandId AND b.brandName LIKE '%$search%')
		             OR(p.catId = c.catId AND  p.brandId= b.brandId AND c.catName LIKE '%$search%')
		             "; 
   	    
   	    $getProduct = $this->db->select($query);
          $output = '';
          if($getProduct){
          	while($result = $getProduct->fetch_assoc()){
          		$output .='

          		<div class="col-md-4 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" id="display_item">
										<div class="product-label">
											<span class="sale">'.$result['product_condition'].'</span>
										</div>

										<a class="main-btn quick-view"  href="product-page.php?proid='.$result['product_id'].'"><i class="fa fa-search-plus"></i><span> Quick view</span></a>
										<img src="admin/'.$result['image'].'" alt="">
									</div>

									<div class="product-body text-center">
										<h3 class="product-price">$ '.$result['price'].' </h3>
										
										<h2 class="product-name"><a href="product-page.php?proid='.$result['product_id'].'">'.$result['product_name'].'</a></h2>
										
										<div class="product-btns text-center">
										   <div style="width:30%;display:inline-block;">
											   <input class="input" type="number" name="quantity" id="quantity'.$result['product_id'].'" value="1" >
										   </div>
										   <input type="hidden" name="hidden_name" id="name'.$result["product_id"].'" value="'.$result["product_name"].'" />
            	                           <input type="hidden" name="hidden_price" id="price'.$result["product_id"].'" value="'.$result["price"].'" />
            	                           <input type="hidden" name="hidden_image" id="image'.$result["product_id"].'" value="'.$result["image"].'" />
            	                           <input type="hidden" name="hidden_color" id="color'.$result["product_id"].'" value="'.$result["color"].'" />
            	                           <input type="hidden" name="hidden_size" id="size'.$result["product_id"].'" value="'.$result["size"].'" />
											
											<button class="primary-btn add-to-cart" id="'.$result["product_id"].'"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>

          		';
          	}
          	 echo $output;
          }
          else{
          	echo  '<h3>Product Not Found</h3>';
          }

	}


	public function productByCat($catId){
		$catId=$this->fm->validation($catId);
		$catId=mysqli_real_escape_string($this->db->link,$catId);

		$query =  "SELECT * FROM tbl_product where catId='$catId'";
        $result = $this->db->select($query);
        return $result;
	}


	public function relatedProductByProductId($id){
		$sub_query ="SELECT catId FROM tbl_product WHERE product_id='$id'";
	    $Category = $this->db->select($sub_query);
	    if($Category){
	    	while($value = $Category->fetch_assoc()){
	    		$catId = $value['catId'];
	    
	    	}
	    }
	     $related_query = "SELECT * FROM tbl_product where catId='$catId' AND product_id !='$id'  order by rand() LIMIT 4";
	    $result =$this->db->select($related_query);
	    if($result){
           return $result;
	    }
	   
	}

	
    public function SearchProduct($search){
    	$search=$this->fm->validation($search);
    	$search=mysqli_real_escape_string($this->db->link,$search);

		$query = "SELECT p.*, c.catName, b.brandName
		             FROM tbl_product as p, tbl_category as c,tbl_brand as b
		             WHERE (p.catId = c.catId AND p.brandId= b.brandId AND p.product_name LIKE '%$search%') 
		             OR(p.catId = c.catId AND p.brandId= b.brandId AND p.details LIKE '%$search%')
		             OR(p.catId = c.catId AND p.brandId= b.brandId AND b.brandName LIKE '%$search%')
		             OR(p.catId = c.catId AND p.brandId= b.brandId AND c.catName LIKE '%$search%')
		              
		             "; 
	    $result=$this->db->select($query);
		return $result;
		
	}


	public function advanceSearch(){
		if(isset($_POST["action"]))
{

		$query = "SELECT p.*, c.catName , b.brandName
		             FROM tbl_product as p, tbl_category as c,tbl_brand as b
		             WHERE p.catId = c.catId AND p.brandId= b.brandId
		              
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND p.price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND b.brandName IN('".$brand_filter."')
		";
	}
	if(isset($_POST["color"]))
	{
		$color_filter = implode("','", $_POST["color"]);
		$query .= "
		 AND p.color IN('".$color_filter."')
		";
	}
	if(isset($_POST["size"]))
	{
		$size_filter = implode("','", $_POST["size"]);
		$query .= "
		 AND p.size IN('".$size_filter."')
		";
	}
	$query.="ORDER BY product_id";

	    $getProduct = $this->db->select($query);
          $output = '';
          if($getProduct){
          	while($row = $getProduct->fetch_assoc()){
			$output .= '
			<div class="col-md-4 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb" id="display_item">
										<div class="product-label">
											<span class="sale">'.$row['product_condition'].'</span>
										</div>

										<a class="main-btn quick-view"  href="product-page.php?proid='.$row['product_id'].'"><i class="fa fa-search-plus"></i><span> Quick view</span></a>
										<img src="admin/'.$row['image'].'" alt="">
									</div>

									<div class="product-body text-center">
										<h3 class="product-price">$ '.$row['price'].' </h3>
										
										<h2 class="product-name"><a href="product-page.php?proid='.$row['product_id'].'">'.$row['product_name'].'</a></h2>
										
										<div class="product-btns text-center">
										   <div style="width:30%;display:inline-block;">
											   <input class="input" type="number" name="quantity" id="quantity'.$row['product_id'].'" value="1" >
										   </div>
										   <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_name"].'" />
            	                           <input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["price"].'" />
            	                           <input type="hidden" name="hidden_image" id="image'.$row["product_id"].'" value="'.$row["image"].'" />
            	                           <input type="hidden" name="hidden_color" id="color'.$row["product_id"].'" value="'.$row["color"].'" />
            	                           <input type="hidden" name="hidden_size" id="size'.$row["product_id"].'" value="'.$row["size"].'" />
											
											<button class="primary-btn add-to-cart" id="'.$row["product_id"].'"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</div>
								</div>
							</div>

			';
		}
	}
	else
	{
		$output = '<h3>Product Not Found</h3>';
	}
	echo $output;
}
	}


	 





}
?>

