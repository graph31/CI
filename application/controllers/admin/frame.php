<?php
class frame extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('dbhelper');
	}

	public function index()
	{
		
		
	}

	public function coatList()
	{
		$data['rs'] = $this->frame_m->getFrameCoatAdmin()->result_array();
			//print_r($data['rsclass']);
		$this->load->view("admin/frame/coat/list",$data);	
	}

	public function typeDetail()
	{
		$data['rs'] = $this->frame_m->getFrameTypeAdmin()->result_array();		
	}

	public function addCoat()
	{
		if($this->input->post("btsave")!=null)
		{
			$maxid=$this->frame_m->addFrameCoat();	
			
			redirect("admin/frame/editCoat/".$maxid."/success","refresh");
			
			exit();
		}

		if($this->input->post("btcancel")!=null)
		{
			redirect("admin/frame","refresh");
			exit();
		}
			
		$data['cv'] = $this->frame_m->getFrameTypeAdmin()->result_array();

		$this->load->view("admin/frame/coat/detail",$data);
	

	}
	

	public function editCoat($id)
	{
		if($this->input->post("btsave")!=null)
		{
			$this->frame_m->editFrameCoat($id);
			
			redirect("admin/frame/editCoat/".$id."/success","refresh");
			
			exit();
		}
			
		
		if($this->frame_m->getFrameCoatById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->frame_m->getFrameCoatById($id)->row_array();
		}


		$data['cv'] = $this->frame_m->getFrameTypeAdmin()->result_array();
			
		$this->load->view("admin/frame/coat/detail",$data);
	
	
	}

	public function sizeList()
	{
		$data['rs'] = $this->frame_m->getFrameSizeAdmin()->result_array();
		
			//print_r($data['rsclass']);
		$this->load->view("admin/frame/size/list",$data);		
	}
	
	
	public function addSize()
	{
		
		if($this->input->post("btsave")!=null)
		{
	
			$maxid=$this->frame_m->addFrameSize();
			
			
			redirect("admin/frame/editSize/".$maxid."/success","refresh");
			
			
			exit();
		}

		if($this->input->post("btcancel")!=null)
		{
			redirect("admin/frame/sizeList","refresh");
			exit();
		}
		$data['cv'] = $this->frame_m->getFrameCoatAdmin()->result_array();
		$this->load->view("admin/frame/size/detail",$data);
	
	
	}
	
	public function editSize($id)
	{
	

		if($this->input->post("btsave")!=null)
		{
			$this->frame_m->editFrameSize($id);

			// print_r($this->frame_m->editframeSize($id));
			// print_r($id);
			
			redirect("admin/frame/editSize/".$id."/success","refresh");
			
			exit();
		}
			
		if($this->frame_m->getFrameSizeById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->frame_m->getFrameSizeById($id)->row_array();
		}

		$data['cv'] = $this->frame_m->getFrameCoatAdmin()->result_array();
		$this->load->view("admin/frame/size/detail",$data);
	
	}
	
	
}
?>