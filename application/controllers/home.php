<?php
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->helper('security');
	}
	
	public  function index()
	{
		
		$this->load->view('home/index');
	}


	
		
	
}

?>