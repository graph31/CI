<?php
class Option extends CI_Controller
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
		$config["base_url"]=base_url()."/master/option/index/$order";
		$config['uri_segment'] = 5;
		$config["per_page"]=50;
		$c=$this->option_m->countAllOption($this->session->userdata("mysess_username"),$this->session->userdata("mysess_level"),$this->session->userdata("mysess_team"),$this->session->userdata("mysess_branch"))->row_array();
		
		$config["total_rows"]=$c['countrow'];
		$config['full_tag_open']="<span class='pagination'> &nbsp;&nbsp; Page :";
		$config['full_tag_close']="</span>";
		
		$this->pagination->initialize($config);
		
		//$data['option_branch']=$this->common_m->getBranch()->get()->result_array();
		$data['rs'] = $this->option_m->getOption($config['per_page'],$this->uri->segment(5),$this->session->userdata("mysess_userid"),$this->session->userdata("mysess_level"))->result_array();

		$data['option_name']=$this->option_m->getOptionType()->get()->result_array();
		
			//print_r($data['rsclass']);
		$this->load->view("admin/master/option/list",$data);
				
	}
	
	public function search()
	{
		
		$data['rs'] = $this->option_m->getOptionSearch($this->session->userdata("mysess_userid"),$this->session->userdata("mysess_level"))->result_array();
		
		foreach ($data['rs'] as $r){
			$data['rsstaff'][$r['id']] = $this->option_m->getOptionReply($r['id'])->result_array();
		}
		
		//print_r($data['rsclass']);
		$this->load->view("admin/master/option/list",$data);
	
	}
	
	public function member($optionId)
	{
		$data['rs'] = $this->option_m->getMemberByOptionId($optionId)->result_array();
		$data['option']=$this->option_m->getOptionById($optionId)->row_array();
		
		$this->load->view("admin/master/option/member",$data);
	
	}
	
	
	public function add()
	{
			
		
		
		if($this->input->post("btsave")!=null)
		{
	
			$maxid=$this->option_m->addOption();
			
			
			redirect("admin/master/option/edit/".$maxid."/success","refresh");
			
			
			exit();
		}
		if($this->input->post("btcancel")!=null)
		{
			redirect("admin/master/option","refresh");
			exit();
		}

		$data['option_name']=$this->option_m->getOptionType()->get()->result_array();
			
		$this->load->view("admin/master/option/detail",$data);
	
	
	}
	
	public function edit($id)
	{
	
		if($this->input->post("btsave")!=null)
		{
			$this->option_m->editOption($id);

			
			redirect("admin/master/option/edit/".$id."/success","refresh");
			
			exit();
		}
			
			
			
		if($this->option_m->getOptionById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->option_m->getOptionById($id)->row_array();
		}

		$data['option_name']=$this->option_m->getOptionType()->get()->result_array();		
			
		$this->load->view("admin/master/option/detail",$data);
	
	
	}
	
	
	
	
	
	public function del($id,$pic=null)
	{
	
		$this->option_m->deleteOption($id,$pic);
		redirect("admin/master/option","refresh");
		exit();
	}
	
	
	
	
	
	
	
	
	
	
}
?>