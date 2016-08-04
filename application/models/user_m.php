<?php
class User_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
	}
	public function getAllUser()
	{
		$sql = "select a.* from tbl_user a where a.status=1";
		return $this->db->query($sql);
	}
	public function getUser($perpage,$startpage,$role)
	{
		if($startpage=='') $startpage=0;
		$sql = "select a.*, b.name  level_name from tbl_user a left outer join tbl_level b on (a.level=b.level)".
				"order by a.user_realname,a.user_name ".
				"limit $startpage,$perpage";
		
		return $this->db->query($sql);
		
	}
	
	public function getUserSearch($role)
	{
		$sname=$this->input->post("sname");
		
		$sql = "select a.*, b.name  level_name from tbl_user a left outer join tbl_level b on (a.level=b.level)".
				"where a.user_role = $role ".
				"and ( a.fname like '%$sname%' ".
				"or a.lname like '%$sname%' ".
				"or a.user_name like '%$sname%' ".
				"or concat(a.fname,' ',a.lname) like '%$sname%'  )".
				"order by a.fname,a.nname ";
	
		return $this->db->query($sql);
	
	}
	
	public function countAllUser()
	{
		return $this->db->count_all("tbl_user");
	}
	
	
	public function getUserClassroom($userId)
	{
		
		$sql = "select a.name from tbl_classroom a,tbl_classroom_user b ".
				"where b.user_id = $userId and a.id=b.classroom_id order by a.level,a.name ";
	
		return $this->db->query($sql);
	
	}


	public function getClassroomCheck($userId)
	{
		$sql="select a.*,b.classroom_id check_classroom from tbl_classroom a
		left outer join tbl_classroom_user b on (a.id=b.classroom_id and b.user_id='$userId') order by a.level,a.name";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	
	
	

	
	public function addUser()
	{
		$ar=array(
				
					"user_name"=>$this->input->post("user_name"),
					"user_realname"=>$this->input->post("user_realname"),
					"user_password"=>$this->input->post("user_password"),
					"age"=>$this->input->post("age"),
					"level"=>$this->input->post("level"),
					"phone"=>$this->input->post("phone"),
					"email"=>$this->input->post("email"),
					"age"=>$this->input->post("age"),
					"mod_date"=>date('Y-m-d H:i:s', now()),
					"create_date"=>date('Y-m-d H:i:s', now())
					);
		$this->db->insert("tbl_user",$ar);
		$maxid=$this->db->insert_id();
		return $maxid;
		
		
		
	}
	
	
	public function getUserById($id)
		{	
			$sql="select a.*  from tbl_user a where a.id='$id'";
			$rs=$this->db->query($sql);
			return $rs;
		}
		
		
	public function editUser($id)
	{
		$ar=array(
				"user_name"=>$this->input->post("user_name"),
				"user_realname"=>$this->input->post("user_realname"),
				"user_password"=>$this->input->post("user_password"),
				"age"=>$this->input->post("age"),
				"level"=>$this->input->post("level"),
				"status"=>$this->input->post("status"),
				"phone"=>$this->input->post("phone"),
				"email"=>$this->input->post("email"),
				"age"=>$this->input->post("age"),
				"mod_date"=>date('Y-m-d H:i:s', now())
		);
		$this->db->where("user_name",$id);
		$this->db->update("tbl_user",$ar);
		
		
	}
	
	public function updateImage1($id){
	
		$img['photo'] = $id.'-250.jpg';
	
		$this->db->where('id', $id);
		$this->db->update('tbl_user', $img);
			
		
	}
	
	
	public function deleteUser($id)
	{
		$this->db->delete("tbl_user",array("id"=>$id));
	
		
	}
	
	
	
		
}
?>