<?php 
	/**
	* 
	*/
	class news_m extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
        	date_default_timezone_set('Asia/Bangkok');
		}

		public function getListNews()
		{
			$sql = "SELECT n.* FROM tbl_news n ";

			return $this->db->query($sql);
		}
	}
 ?>