<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Contact{
	 	private $db;
	 	private $fm;
	
		public function __construct(){
			$this->db=new Database();
			$this->fm=new Format();
	}

     
  public function getALLMessage(){
    $query ="SELECT * FROM tbl_contact where status='0' ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function getMessageById($id){
    $query ="SELECT * FROM tbl_contact WHERE id='$id'";
    $result = $this->db->select($query);
    return $result;
  }


  public function sentToSeenBox($SeenMsgId){
     $query= "UPDATE tbl_contact
                    SET 
                    status     = '1'                    
                   WHERE id ='$SeenMsgId'  ";

              $update_row =$this->db->update($query);
                         if($update_row){
                       $msg ="<span class='success'>Message Sent to SeenBox successfully. </span>";
                       return $msg;
                         }

                         else {
                          echo "<span class='error'>Message Not Sent to SeenBox !</span>";
            }
    
    $result = $this->db->select($query);
    return $result;
  }

  public function getALLSeenMessage(){
    $query ="SELECT * FROM tbl_contact where status='1' ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
  }


   public function deleteMessage($delid){    
        
             $delquery ="DELETE from tbl_contact where id='$delid'";
             $delData  =$this->db->delete($delquery);

             if($delData){
                 $msg ="<span class='success'>Message Delete successfully. </span>";
                       return $msg;
                         }
                else{
                  $msg ="<span class='success'>Message Not Delete. </span>";
                       return $msg;
                         
                } 
      
  }

}
?>