<?php
class Common extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
public  function index()
	{
		
	}
	
	public function DateTimeThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear $strHour:$strMinute";
	}
	
	public function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear ";
	}
	
	public function getProvince()
	{
		return $this->db->select("*")->from("tbl_province")->order_by("province_name", "asc");
	}
	public function getAmphurByParentId($id)
	{
		return $this->db->select("*")->from("tbl_district")->where("province_id",$id)->order_by("district_name", "asc");
	}
	public function getDistrictByParentId($id)
	{
		return $this->db->select("*")->from("tbl_subdistrict")->where("district_id",$id)->order_by("subdistrict_name", "asc");
	}
	
	public function getAmphur($id)
	{
		$rs3=$this->db->get_where("tbl_district",array('province_id' => $id))->result_array();
		echo json_encode($rs3);
	}
	
	public function getDistrict($id)
	{
		$rs3=$this->db->get_where("tbl_subdistrict",array('district_id' => $id))->result_array();
		echo json_encode($rs3);
	}
	
	public function getDiscountCode($code)
	{
		$rs3=$this->common_m->getDiscountCode($code)->result_array();
		echo json_encode($rs3);
	}
	
	public function getEventPrice($eventId)
	{
		$rs3=$this->common_m->getEventPrice($eventId)->result_array();
		echo json_encode($rs3);
	}
	
	public function getEventByCourseId($id)
	{
		$rs3=$this->db->get_where("tbl_event",array('course_id' => $id))->result_array();
		echo json_encode($rs3);
	}


	public function getInfoByRegisterCode($code)
	{
		$sql="select a.register_code, b . * 
		FROM tbl_register_event a 
		LEFT OUTER JOIN tbl_member b ON ( a.customer_email = b.email ) 
		WHERE a.register_code='$code' ";
		$rs=$this->db->query($sql)->result_array();
		echo json_encode($rs);

		
	}

	
	public function getPrefixName()
	{
		return $this->db->select("*")->from("tbl_prefix_name")->order_by("name", "asc");
	}
	
	
}
?>