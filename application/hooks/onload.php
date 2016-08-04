<?php 
/**
* 
*/
class onload
{
	private $ci;
	public function __construct()
	{
		$this->ci=&get_instance();
	}

	public function check_login()
	{
		$controller = $this->ci->router->class;

		exit();
		
		if ($this->ci->session->userdata("user_id") == null)
		{
			redirect("admin/login","refresh");
			exit();
		}
	}
}
 ?>