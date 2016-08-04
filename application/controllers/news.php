<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
	/**
	* 
	*/
	class News extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			$this->load->library('dbhelper');
			// $this->load->model('news_m','',TRUE)or die("Not Load Model error"); 
		}

		public function index()
		{
			
		}
		
		public function newsList()
		{
			
			// $data['rs'] = $this->news_m->getListNews()->result_array();
			
				//print_r($data['rsclass']);
			$this->load->view("admin/news/list");

					
		}
	}
 ?>