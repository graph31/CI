<?php
class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('dbhelper');
		$this->load->library("mpdf/mpdf");
		$this->load->library('My_PHPMailer');
	}
	public function index()
	{
		$this->load->library("pagination");
		$config["base_url"]=base_url()."admin/member/index";
		$config['uri_segment'] = 4;
		$config["per_page"]=100;
		$c=$this->member_m->countAllMember()->row_array();
		
		$config["total_rows"]=$c['countrow'];
		$config['full_tag_open']="<span class='pagination'> &nbsp;&nbsp; Page :";
		$config['full_tag_close']="</span>";
		$this->pagination->initialize($config);
		
		$data['rs'] = $this->member_m->getMember($config['per_page'],$this->uri->segment(4))->result_array();

		$data['rsquery'] = $this->member_m->getMemberQuery($config['per_page'],$this->uri->segment(4));
		
		$this->load->view("admin/member/list",$data);
				
	}
	
	public function search()
	{
		
		$this->load->library("pagination");
		$config["base_url"]=base_url()."admin/member/search";
		$config['uri_segment'] = 4;
		$config["per_page"]=50;
		$c=$this->member_m->countAllMemberSearch()->row_array();
		
		$config["total_rows"]=$c['countrow'];
		$config['full_tag_open']="<span class='pagination'> &nbsp;&nbsp; Page :";
		$config['full_tag_close']="</span>";
		$this->pagination->initialize($config);
		
		$data['rs'] = $this->member_m->getMemberSearch($config['per_page'],$this->uri->segment(4))->result_array();

		$data['rsquery'] = $this->member_m->getMemberSearchQuery($config['per_page'],$this->uri->segment(4));
		
		$this->load->view("admin/member/search",$data);
	
	}
	
	public function add()
	{
			
	
		if($this->input->post("btsave")!=null)
		{
	
			$maxid=$this->member_m->addMember();
			
			if($_FILES['photo']['error'] == 0)
			{
				
				$this->uploadImage1($maxid);
				$this->crop($maxid);
			}
	
			redirect("admin/member/edit/".$maxid."/success","refresh");
			exit();
		}
		if($this->input->post("btcancel")!=null)
		{
			redirect("admin/member","refresh");
			exit();
		}
			
		
		$this->load->view("admin/member/detail");
	
	
	
	}
	
	public function edit($id)
	{
	
		if($this->input->post("btsave")!=null)
		{
			$this->member_m->editMember($id);
			
			if($_FILES['photo']['error'] == 0)
			{
				
				$this->uploadImage1($id);
				$this->crop($id);
			}
			
			redirect("admin/member/edit/".$id."/success","refresh");
			exit();
		}
			
			
			
		if($this->member_m->getMemberById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->member_m->getMemberById($id)->row_array();
		}

		$this->load->view("admin/member/detail",$data);
	
	
	}
	
	public function del($id,$pic=null)
	{
	
		$this->member_m->deleteMember($id,$pic);
		redirect("admin/member","refresh");
		exit();
	}
	
	public function crop($id)
	{
		$img_path = './images/member/'.$id.'-250.jpg';
		$img_thumb = './images/member/'.$id.'_thumb.jpg';
	
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
	
		$img = imagecreatefromjpeg($img_path);
		$_width = imagesx($img);
		$_height = imagesy($img);
	
		$img_type = '';
		$thumb_size = 250;
	
		if ($_width > $_height)
		{
			// wide image
			$config['width'] = intval(($_width / $_height) * $thumb_size);
			if ($config['width'] % 2 != 0)
			{
				$config['width']++;
			}
			$config['height'] = $thumb_size;
			$img_type = 'wide';
		}
		else if ($_width < $_height)
		{
			// landscape image
			$config['width'] = $thumb_size;
			$config['height'] = intval(($_height / $_width) * $thumb_size);
			if ($config['height'] % 2 != 0)
			{
				$config['height']++;
			}
			$img_type = 'landscape';
		}
		else
		{
			// square image
			$config['width'] = $thumb_size;
			$config['height'] = $thumb_size;
			$img_type = 'square';
		}
	
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	
		// reconfigure the image lib for cropping
		$conf_new = array(
				'image_library' => 'gd2',
				'source_image' => $img_thumb,
				'create_thumb' => FALSE,
				'maintain_ratio' => FALSE,
				'width' => $thumb_size,
				'height' => $thumb_size
		);
	
		if ($img_type == 'wide')
		{
			$conf_new['x_axis'] = ($config['width'] - $thumb_size) / 2 ;
			$conf_new['y_axis'] = 0;
		}
		else if($img_type == 'landscape')
		{
			$conf_new['x_axis'] = 0;
			$conf_new['y_axis'] = ($config['height'] - $thumb_size) / 2;
		}
		else
		{
			$conf_new['x_axis'] = 0;
			$conf_new['y_axis'] = 0;
		}
	
		$this->image_lib->initialize($conf_new);
	
		$this->image_lib->crop();
	}
	
	public function uploadImage1($id){
		//show($_FILES);
		if($_FILES['photo']['error'] == 0){
			//upload and update the file
			$config1['file_name'] = $id."-250";
			$config1['upload_path'] = './images/member/'; // Location to save the image
			$config1['allowed_types'] = 'jpg|JPG';
			$config1['overwrite'] = true;
			$config1['remove_spaces'] = true;
			//$config['max_size']   = '100';// in KB // if required, remove the comment and give the size
	
			$this->load->library('upload', $config1); //codeigniter default function
	
			if ( $this->upload->do_upload('photo')){
				//Image Resizing
	
				$config1['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config1['maintain_ratio'] = TRUE;
				
	
				$this->load->library('image_lib', $config1); //codeigniter default function
	
				if ( ! $this->image_lib->resize()){
					//redirect("admin/member/profile/".$membername); // redirect  page if the resize fails.
				}
				
				
	
				$this->member_m->updateImage1($id);
	
			}
		}
	}


	public function memberExcel()
	{
		
		$data['rs'] = $this->member_m->getMemberExcel($this->input->post("queryExport"))->result_array();
	
		$this->load->view("admin/member/genexcel",$data);
	
	}

	
	public function job($memberId)
	{
		
		
		$data['rinfo'] = $this->member_m->getMemberInfoById($memberId)->row_array();
		$data['rs'] = $this->member_m->getJobMonthly($memberId)->result_array();
	
		
		$this->load->view("admin/member/job_list",$data);
				
	}

	public function joblist($year,$month,$memberId)
	{


		$data['rinfo'] = $this->member_m->getMemberInfoById($memberId)->row_array();
		
		
		$data['rs'] = $this->member_m->getJobListMonthly($year,$month,$memberId)->result_array();
	
		
		$this->load->view("admin/member/job_listdetail",$data);
				
	}
	

	public function jobMonthlyPaymentExcel($year,$month,$memberId)
	{


		$data['rinfo'] = $this->member_m->getMemberInfoById($memberId)->row_array();
		
		
		$data['rs'] = $this->member_m->getJobListMonthly($year,$month,$memberId)->result_array();
	
		
		$this->load->view("admin/member/job_listdetailExcel",$data);
				
	}

	public function notice($year,$month,$memberId,$payment)
	{
	
			$maxid=$this->member_m->addNotice($year,$month,$memberId,$payment);
		
			$this->sendNoticeMail($year,$month,$memberId,$payment);
		

			redirect("admin/member/job/".$memberId."/success","refresh");
			exit();
		
	
	}
	

	public function sendNoticeMail($year,$month,$memberId,$payment)
	{
		$data['rs'] = $this->member_m->getMemberInfoById($memberId)->row_array();
			
		$month1 = array("","1","2","3","4","5","6","7","8","9","10","11","12");
		$monthtxt   = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

		$amonth = str_replace($month1, $monthtxt, $month);

		$subject = "แจ้งบิลเกินกำหนด";

		$strMessage = "";
			
		$strMessage .= "เรียน คุณ ".$data['rs']['fname']."<br><br>";
		$strMessage .= "เนื่องจากท่านมียอดค้างชำระ ของเดือน ".$amonth." ".$year."  กรุณาชำระภายใน 7 วัน จึงเรียนมาเพื่อทราบ<br>";
		$strMessage .= "หากท่านได้ชำระไปแล้ว ต้องขออภัยมา ณ ที่นี้ด้วย";
		$strMessage .= "<br><br>";
		$strMessage .= "ขอแสดงความนับถือ<br>";
		$strMessage .= "ทีมงาน Premier Album";
			


		$mail = new PHPMailer();
	
		$mail->SMTPDebug  = 0;    
		
		$mail->CharSet = "utf-8";
		$mail->IsHTML(true);
		$mail->IsSMTP();
		              
		$mail->SMTPAuth   = true;               
		$mail->SMTPSecure = "ssl";    

		$mail->Host = "smtp.gmail.com"; 
		$mail->Port = 465; 
		$mail->Username = "premieralbum2013@gmail.com";  
		$mail->Password = "samaporn";   
	
		$mail->SetFrom('premieralbum2013@gmail.com','Premier Album');
		$mail->AddReplyTo('premieralbum2013@gmail.com','admin');
		$mail->Subject = $subject;
	
		$mail->MsgHTML($strMessage);
	
		//$mail->AddAddress('supleman@hotmail.com');
		$mail->AddAddress($data['rs']['email']);
		
		
		$mail->Send();

		//redirect("member/registersubmit","refresh");

			
	}
	
	
	
	
}
?>