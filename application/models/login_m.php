<?php
class Login_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
	}
	
	public function login($username,$password)
	{
		$this->db->select('user_id,username,password');
		$this->db->from('tbl_user');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		// $sql="select a.* from tbl_user a where a.user_name='$username' and a.user_password ='$password' ";
		
		// $rs=$this->db->query($sql);
		
		$query = $this->db->get();

		if ($query->num_rows() == 1) {

			$client_ip = $_SERVER['REMOTE_ADDR'];
			$datetime = date('Y-m-d H:i:s'); 
			$ar = array('user_id' => 1 ,
					'timestamp'=>$datetime ,
					'ip'=> $client_ip);
			$this->db->insert("tbl_login",$ar);

			return $query->result();
		}else{
			return false;
		}
	}
	
	// public function getLoginByUser($username,$id)
	// {
	// 	//$sql="select a.*  from tbl_login a where a.user_name='$username'";
	// 	//$rs=$this->db->query($sql);
	// 	$this->db->where('user_name', $username);
	// 	$this->db->where('id', $id);
	// 	$this->db->from('tbl_login');
	// 	$rs= $this->db->count_all_results();
	// 	return $rs;
	// }
	
	// public function getMaxIdLogin()
	// {
	// 	$query = $this->db->query(" SHOW TABLE STATUS LIKE 'tbl_login' ");
	
	// 	foreach ($query->result() as $row)
	// 	{
	// 		return $row->Auto_increment-1;
	// 	}
	// }
	
	// public function getUserInfoByUser($user)
	// {
	// 	//return $this->db->select("*")->from("tbl_prospect")->where("TIMESTAMPDIFF(MONTH,mod_date,current_date()) <=",1)->order_by("mod_date", "desc");
	
	// 	$sql =  "select b.user_realname,b.level
	// 	from tbl_user b
	// 	where b.user_name= '$user'  ";
	
	
	// 	return $this->db->query($sql);
	
	// }
	
}
?>