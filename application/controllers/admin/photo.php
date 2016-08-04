<?php
class Photo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('My_PHPMailer');
		$this->load->library('dbhelper');
	}
	public function index()
	{
		
		
	}
	
	public function coatList()
	{
		
		
		$data['rs'] = $this->photo_m->getPhotoCoatAdmin()->result_array();
		
			//print_r($data['rsclass']);
		$this->load->view("admin/photo/coat/list",$data);
				
	}
	
	
	public function addCoat()
	{
			
		
		if($this->input->post("btsave")!=null)
		{
	
			$maxid=$this->photo_m->addProduct();
			
			if($_FILES['photo']['error'] == 0)
			{
					
				//$this->uploadImage1($maxid);
				//$this->crop($maxid);
			}
			
			redirect("admin/photo/editCoat/".$maxid."/success","refresh");
			
			
			exit();
		}
		if($this->input->post("btcancel")!=null)
		{
			redirect("admin/photo","refresh");
			exit();
		}
			
		$this->load->view("admin/photo/coat/detail");
	
	
	}
	
	public function editCoat($id)
	{
	
		if($this->input->post("btsave")!=null)
		{
			$this->photo_m->editPhotoCoat($id);

			if($_FILES['photo']['error'] == 0)
				{
					
					//$this->uploadImage1($id);
					//$this->crop($id);
				}
			
			redirect("admin/photo/editCoat/".$id."/success","refresh");
			
			exit();
		}
			
			
			
		if($this->photo_m->getPhotoCoatById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->photo_m->getPhotoCoatById($id)->row_array();
		}

			
			
		$this->load->view("admin/photo/coat/detail",$data);
	
	
	}


	public function sizeList()
	{
		
		
		$data['rs'] = $this->photo_m->getPhotoSizeAdmin()->result_array();
		
			//print_r($data['rsclass']);
		$this->load->view("admin/photo/size/list",$data);
				
	}
	
	
	public function addSize()
	{
			
		
		
		if($this->input->post("btsave")!=null)
		{
	
			$maxid=$this->photo_m->addSize();
			
			if($_FILES['photo']['error'] == 0)
			{
					
				$this->uploadImage1($maxid);
				$this->crop($maxid);
			}
			
			redirect("admin/photo/editSize/".$maxid."/success","refresh");
			
			
			exit();
		}
		if($this->input->post("btcancel")!=null)
		{
			redirect("admin/photo/sizeList","refresh");
			exit();
		}
		
		$data['pc'] = $this->photo_m->getPhotoCoatAdmin()->result_array();
		$this->load->view("admin/photo/size/detail");
	
	
	}
	
	public function editSize($id)
	{
	
		if($this->input->post("btsave")!=null)
		{
			$this->photo_m->editPhotoSize($id);

			if($_FILES['photo']['error'] == 0)
				{
					
					//$this->uploadImage1($id);
					//$this->crop($id);
				}
			
			redirect("admin/photo/editSize/".$id."/success","refresh");
			
			exit();
		}
			
		if($this->photo_m->getPhotoSizeById($id)->num_rows()==0)
		{
			$data['rs']=array();
		}
		else
		{
			$data['rs']=$this->photo_m->getPhotoSizeById($id)->row_array();
		}

		$data['pc'] = $this->photo_m->getPhotoCoatAdmin()->result_array();

		$this->load->view("admin/photo/Size/detail",$data);
	
	
	}
	
	public function crop($id)
	{
		$img_path = './images/photo_coat/'.$id.'.jpg';
		$img_thumb = './images/photo_coat/'.$id.'_thumb.jpg';
	
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
	
		$img = imagecreatefromjpeg($img_path);
		$_width = imagesx($img);
		$_height = imagesy($img);
	
		$img_type = '';
		$thumb_w = 1234;
		$thumb_h = 800;
	
		if ($_width > $_height)
		{
			// wide image
			$config['width'] = intval(($_width / $_height) * $thumb_h);
			if ($config['width'] % 2 != 0)
			{
				$config['width']++;
			}
			$config['height'] = $thumb_h;
			$img_type = 'wide';
		}
		else if ($_width < $_height)
		{
			// landscape image
			$config['width'] = $thumb_w;
			$config['height'] = intval(($_height / $_width) * $thumb_w);
			if ($config['height'] % 2 != 0)
			{
				$config['height']++;
			}
			$img_type = 'landscape';
		}
		else
		{
			// square image
			$config['width'] = $thumb_w;
			$config['height'] = $thumb_h;
			$img_type = 'square';
		}
	
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	
		// reconfigure the image lib for cropping
		$conf_new = array(
				'image_library' => 'gd2',
				'source_image' => $img_thumb,
				'create_thumb' => false,
				'maintain_ratio' => false,
				'width' => $thumb_w,
				'height' => $thumb_h
		);
	
		if ($img_type == 'wide')
		{
			$conf_new['x_axis'] = ($config['width'] - $thumb_w) / 2 ;
			$conf_new['y_axis'] = 0;
		}
		else if($img_type == 'landscape')
		{
			$conf_new['x_axis'] = 0;
			$conf_new['y_axis'] = ($config['height'] - $thumb_h) / 2;
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
			$config1['file_name'] = $id;
			$config1['upload_path'] = './images/photo_coat/'; // Location to save the image
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
					//redirect("user/profile/".$username); // redirect  page if the resize fails.
				}
	
	
	
				$this->photo_m->updateImage1($id);
	
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	public function del($id,$pic=null)
	{
	
		$this->photo_m->deleteProduct($id,$pic);
		redirect("admin/photo","refresh");
		exit();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>