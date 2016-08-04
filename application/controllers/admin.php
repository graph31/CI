<?php
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_m','',TRUE);
	}
	
	public  function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('Admin/login');
	}

	public function newsList()
	{
		$data['rs'] = $this->news_m->getListNews()->result_array();
		$this->load->view('admin/news/list',$data);
	}
		
		
	
}

?>