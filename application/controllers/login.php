<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		// parent::__construct();
		// $this->load->library("session");
		// $this->load->helper('security');
	}
	
	public  function index()
	{
		$this->load->view('home/index');
	}

	public function login()
	{
		$this->load->view("admin/login");
	}
		
	
}

?>