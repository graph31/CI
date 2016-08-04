<?php
class Type extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('My_PHPMailer');
		$this->load->library('dbhelper');
	}
	public function index($order=null)
	{
		$this->load->library("pagination");
		$config["base_url"]=base_url()."/master/type/index/$order";
		$config['uri_segment'] = 5;
		$config["per_page"]=50;
		$c=$this->type_m->countAllType($this->session->userdata("mysess_username"),$this->session->userdata("mysess_level"),$this->session->userdata("mysess_team"),$this->session->userdata("mysess_branch"))->row_array();
		
		$config["total_rows"]=$c['countrow'];
		$config['full_tag_open']="<span class='pagination'> &nbsp;&nbsp; Page :";
		$config['full_tag_close']="</span>";
		
		$this->pagination->initialize($config);
		
		//$data['option_branch']=$this->common_m->getBranch()->get()->result_array();
		$data['rs'] = $this->type_m->getType($config['per_page'],$this->uri->segment(5),$this->session->userdata("mysess_userid"),$this->session->userdata("mysess_level"))->result_array();
		
			//print_r($data['rsclass']);
		$this->load->view("master/type/list",$data);
				
	}
	
	public function search()
	{
		
		$data['rs'] = $this->type_m->getTypeSearch($this->session->userdata("mysess_userid"),$this->session->userdata("mysess_level"))->result_array();
		
		foreach ($data['rs'] as $r){
			$data['rsstaff'][$r['id']] = $this->type_m->getTypeReply($r['id'])->result_array();
		}
		
		//print_r($data['rsclass']);
		$this->load->view("master/type/list",$data);
	
	}
	
	public function member($typeId)
	{
		$data['rs'] = $this->type_m->getMemberByTypeId($typeId)->result_array();
		$data['type']=$this->type_m->getTypeById($typeId)->row_array();
		
		$this->load->view("master/type/member",$data);
	
	}
	
	
	public function add()
	{
			
		
		
		if($this->input->post("btsave")!=null)
		{
	
			$maxid=$this->type_m->addType();
			
			
			redirect("master/type/edit/".$maxid."/success","refresh");
			
			
			exit();
		}
		if($this->input->post("btcancel")!=null)
		{
			redirect("master/type","refresh");
			exit();
		}
			
		$this->load->view("master/type/detail");
	
	
	}
	
	public function edit($id)
	{
	
		if($this->input->post("btsave")!=null)
		{
			$this->type_m->editType($id);

			
			redirect("master/type/edit/".$id."/success","refresh");
			
			exit();
		}
			
			
			
		if($this->type_m->getTypeById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->type_m->getTypeById($id)->row_array();
		}

				
			
		$this->load->view("master/type/detail",$data);
	
	
	}
	
	
	
	
	
	public function del($id,$pic=null)
	{
	
		$this->type_m->deleteType($id,$pic);
		redirect("master/type","refresh");
		exit();
	}
	
	
	
	
	
	
	
	
	
	
}
?>