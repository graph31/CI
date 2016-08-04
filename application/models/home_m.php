<?php
class Home_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
	}
	
	public function registerMember($sid)
	{
		$ar=array(
				"user_name"=>$this->input->post("user_name"),
				"user_password"=>$this->input->post("user_password1"),
				"sid"=>$sid,
				"prefix"=>$this->input->post("prefix"),
				"prefix_other"=>$this->input->post("prefix_other"),
				"fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"nname"=>$this->input->post("nname"),
				"email"=>$this->input->post("email"),
				"phone"=>$this->input->post("phone"),
				"company_name"=>$this->input->post("company_name"),
				"address"=>$this->input->post("address"),
				"province_id"=>$this->input->post("province_id"),
				"district_id"=>$this->input->post("district_id"),
				"subdistrict_id"=>$this->input->post("subdistrict_id"),
				"postcode"=>$this->input->post("postcode"),
				"mod_date"=>date('Y-m-d H:i:s', now()),
				"create_date"=>date('Y-m-d H:i:s', now())
		);
		$this->db->insert("tbl_member",$ar);
		$maxid=$this->db->insert_id();
		return $maxid;
	
	
	}
	
	
	
	
	public function editMember($id)
	{
		$ar=array(
				
				
				"user_password"=>$this->input->post("user_password1"),
				"fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"nname"=>$this->input->post("nname"),
				"email"=>$this->input->post("email"),
				"phone"=>$this->input->post("phone"),
				"facebook"=>$this->input->post("facebook"),
				"address"=>$this->input->post("address"),
				"city"=>$this->input->post("city"),
				"age"=>$this->input->post("age"),
				"level"=>$this->input->post("level"),
					"status"=>$this->input->post("status"),
				"user_role"=>'3',
				"mod_date"=>date('Y-m-d H:i:s', now())
		);
		$this->db->where("id",$id);
		$this->db->update("tbl_member",$ar);
		
		
	}

	public function editMemberInfo($id)
	{
		if($this->input->post("user_newpassword1")<>'') {
			$ar=array(
				"user_password"=>$this->input->post("user_newpassword1"),
				"fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"company_name"=>$this->input->post("company_name"),
				"job"=>$this->input->post("job"),
				"mod_date"=>date('Y-m-d H:i:s', now())
				);

		} 
		else 
		{

			$ar=array(
				"fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"company_name"=>$this->input->post("company_name"),
				"job"=>$this->input->post("job"),
				"mod_date"=>date('Y-m-d H:i:s', now())
				);

		}
		
		$this->db->where("id",$id);
		$this->db->update("tbl_member",$ar);
		
		
	}
	
	public function updateImage1($id){
	
		$img['photo'] = $id.'-250.jpg';
	
		$this->db->where('id', $id);
		$this->db->update('tbl_member', $img);
			
		
	}
	
	
	public function deleteMember($id,$pic)
	{
		$this->db->delete("tbl_member",array("id"=>$id));
	
		if($this->db->affected_rows() >= 1)
		{
	
			if(isset($pic))
			{
				$path='images/member/'.$pic;
				if (file_exists($path)) {
					unlink($path) or die('failed deleting: ' . $path);
						
					
				}
			}
				
				
				
		}
	}

		
}
?>