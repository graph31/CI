<?php
class Photo_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
	}
	
	public function getPhotoCoatAdmin()
	{

		$sql = "select a.*  from tbl_photo_coat a";
		
		return $this->db->query($sql);
		
	}

	public function getPhotoCoatById($id)
	{	
		$sql="select a.*  from tbl_photo_coat a where a.id='$id'";
		$rs=$this->db->query($sql);
		return $rs;
	}

	public function addPhotoCoat()
	{
		$ar=array(
				
					"name"=>$this->input->post("name"),
					"status"=>$this->input->post("status")
					);
		$this->db->insert("tbl_photo_coat",$ar);
		$maxid=$this->db->insert_id();
		return $maxid;
		
	}
	
		
	public function editPhotoCoat($id)
	{
		$ar=array(
				"name"=>$this->input->post("name"),
				"status"=>$this->input->post("status")
		);
		$this->db->where("id",$id);
		$this->db->update("tbl_photo_coat",$ar);
		
		
	}

	//  Size

	public function getPhotoSizeAdmin()
	{
		$sql = "select a.*,b.name coat_name  from tbl_photo_size_price a,tbl_photo_coat b where a.coat_id=b.id";
		
		return $this->db->query($sql);
		
	}

	public function getPhotoSizeById($id)
	{	
		$sql="select a.*  from tbl_photo_size_price a where a.id='$id'";
		$rs=$this->db->query($sql);
		return $rs;
	}

	public function addPhotoSize()
	{
		$ar=array(
				
					"name"=>$this->input->post("name"),
					"status"=>$this->input->post("status"),
					"coat_id" =>$this->input->post("coat_id"),
					"price" =>$this->input->post("price")
					);
		$this->db->insert("tbl_photo_size_price",$ar);
		$maxid=$this->db->insert_id();
		return $maxid;
		
	}
	
		
	public function editPhotoSize($id)
	{
		$ar=array(
				"name"=>$this->input->post("name"),
					"status"=>$this->input->post("status"),
					"coat_id" =>$this->input->post("coat_id"),
					"price" =>$this->input->post("price")
		);
		$this->db->where("id",$id);
		$this->db->update("tbl_photo_size_price",$ar);
		
		
	}

	
	public function updateImage1($id){
	
		$img['photo'] = $id.'-250.jpg';
	
		$this->db->where('id', $id);
		$this->db->update('tbl_photo_coat', $img);
			
		
	}
	
	
	public function deletePhotoCoat($id)
	{
		$this->db->delete("tbl_photo_coat",array("id"=>$id));
	
		
	}
	
	
	
		
}
?>