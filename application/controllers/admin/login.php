<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->helper('security');
	}
	
	public  function index()
	{
		if($this->input->post("bt")!=null)
		{						
			$rs = $this->user_m->getAllUser()->result_array();
			foreach ($rs as $r)
			{
				if($this->input->post("username")==$r['user_name'] && $this->input->post("password")==$r['user_password'])
				{
					
					$rsL=$this->login_m->addLogin($this->input->post("username"))->row_array();
					
					$ar=array(
							"mysess_username"=>$this->input->post("username"),
							"mysess_realname"=>$r['user_realname'],
							"mysess_role"=>$r['user_role'],
							"mysess_email"=>$r['email'],
							"mysess_level"=>$r['level'],
							"mysess_userid"=>$r['id'],
							"mysess_id"=>$rsL['id']
							);
					$this->session->set_userdata($ar);
					redirect("admin/job","refresh");
				}			
			}					
		}
		
		$data['rinfo'] = $this->login_m->getUserInfoByUser($this->session->userdata("mysess_username"))->row_array();
		$this->load->view('admin/login',$data);
	}
	
	
	
		
	
}

?>