<?php
class Logout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	
	public  function index()
	{
		$this->session->sess_destroy();
		redirect("admin/login","refresh");
	}
		
	
}

?>