<?php
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->library("pagination");
		$config["base_url"]=base_url()."admin/user/list";
		$config["per_page"]=50;
		$config["total_rows"]=$this->user_m->countAllUser();
		
		$config['full_tag_open']="<div class='pagination'>";
		$config['full_tag_close']="</div>";
		
		$this->pagination->initialize($config);
		
		$data['rs'] = $this->user_m->getUser($config['per_page'],$this->uri->segment(3),3)->result_array();
		
		$this->load->view("admin/user/list",$data);
				
	}
	
	public function search()
	{
		
		$data['rs'] = $this->user_m->getUserSearch(3)->result_array();
		foreach ($data['rs'] as $r){
			$data['rsclass'][$r['id']] = $this->user_m->getUserClassroom($r['id'])->result_array();
		}
		//print_r($data['rsclass']);
		$this->load->view("admin/user/list",$data);
	
	}
	
public function add()
	{
			
		
			if($this->input->post("btsave")!=null)
			{
				
				$maxid=$this->user_m->addUser();
				redirect("admin/user/edit/".$maxid,"refresh");
				exit();
			}
			if($this->input->post("btcancel")!=null)
			{
				redirect("admin/user","refresh");
				exit();
			}
			
				
				
			$this->load->view("admin/user/detail");
		
		
		
	}
	
	public function edit($id)
	{
	
		if($this->input->post("btsave")!=null)
			{
				$this->user_m->editUser($id);
				redirect("admin/user/edit/".$id,"refresh");
				exit();
			}
			
			
			
			if($this->user_m->getUserById($id)->num_rows()==0)
			{
				$data['rs']=array();
			}
			else
			{
				$data['rs']=$this->user_m->getUserById($id)->row_array();
				//$data['rs']=$this->user_m->getUserPart1ById($id)->row_array();
			}
			
			$this->load->view("admin/user/detail",$data);
	
	
	}
	
	public function del($id)
	{
	
		$this->user_m->deleteUser($id);
		redirect("admin/user","refresh");
		exit();
	}
	
	
	
	
	
	
	
}
?>