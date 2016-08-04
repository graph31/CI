<?php
class Common_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getProvince()
	{
		return $this->db->select("*")->from("tbl_province")->order_by("province_name", "asc");
	}
	public function getDistrictByParentId($id)
	{
		return $this->db->select("*")->from("tbl_district")->where("province_id",$id)->order_by("district_name", "asc");
	}
	public function getSubDistrictByParentId($id)
	{
		return $this->db->select("*")->from("tbl_subdistrict")->where("district_id",$id)->order_by("subdistrict_name", "asc");
	}
	
	
	public function getCarModelByParentId($id)
	{
		return $this->db->select("*")->from("tbl_model")->where("type",$id)->order_by("name", "asc");
	}
	public function getCarSubModelByParentId($id)
	{
		return $this->db->select("*")->from("tbl_submodel")->where("model_code",$id)->order_by("name", "asc");
	}
	
	public function getBranch()
	{
		return $this->db->select("*")->from("tbl_branch")->order_by("name", "asc");
	}
	
	public function getBranchById($id)
	{
		return $this->db->select("*")->from("tbl_branch")->where("id",$id)->order_by("name", "asc");
	}
	
	public function getTeamById($id)
	{
		return $this->db->select("*")->from("tbl_team")->where("id",$id)->order_by("name", "asc");
	}
	
	public function getTeamByBranchId($id)
	{
		return $this->db->select("*")->from("tbl_team")->where("branch_id",$id)->order_by("name", "asc");
	}
	
	public function getTeamByParentId($id)
	{
		return $this->db->select("*")->from("tbl_team")->where("branch_id",$id)->order_by("name", "asc");
	}
	
	public function getBranchByTeamId($team)
	{
		
		$sql = 	"	select a.* from tbl_branch a,tbl_team b ".
				"	where a.id=b.branch_id and b.id='$team' ".
				" 	order by a.name ";
		return $this->db->query($sql);
	}
	
	public function getTeamAll($id)
	{
		$sql="select a.*  from tbl_team a where a.branch_id='$id'";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	public function getYear()
	{
		$sql="	select distinct year(a.ndate) nyear
				from tbl_date a where a.ndate<=current_date()
				order by year(a.ndate) desc
				limit 0,20";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	public function getMonth()
	{
		$sql="select distinct a.nmonth,a.nmonthname 
				from tbl_date a 
				order by a.nmonth asc";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	public function getWeekYearByMonthYear($year,$month)
	{
		$sql="	SELECT ndateminweek minweek, ndatemaxweek maxweek, YEARWEEK( a.ndate ) weekyear, ndatelabel datelebel
				FROM tbl_date a
				WHERE a.ndate <= CURRENT_DATE( ) 
				AND a.nyear =  '$year'
				AND a.nmonth =  '$month'
				GROUP BY ndateminweek, ndatemaxweek, YEARWEEK( a.ndate ) 
				ORDER BY WEEK( a.ndate ) DESC 
				limit 0,20";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	public function getWeekYear()
	{
		$sql="	select yearweek(a.ndate) yearweek,year(a.ndate) nyear,week(a.ndate) weekyear ,ndatelabel datelebel 
				from tbl_date a where a.ndate<=current_date()
				group by yearweek(a.ndate),year(a.ndate) ,week(a.ndate)
				order by yearweek(a.ndate) desc,year(a.ndate) desc,week(a.ndate) desc
				limit 0,20";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	public function getMonthYear()
	{
		$sql="	select EXTRACT(YEAR_MONTH FROM a.ndate) yearmonth,year(a.ndate) nyear,month(a.ndate) nmonth
				from tbl_date a where a.ndate<=current_date()
				group by EXTRACT(YEAR_MONTH FROM a.ndate)
				order by EXTRACT(YEAR_MONTH FROM a.ndate) desc
				limit 0,20";
		$rs=$this->db->query($sql);
		return $rs;
	}
	
	public function getSaleUnderByUser($user,$level,$team,$branch)
	{
		//return $this->db->select("*")->from("tbl_prospect")->where("TIMESTAMPDIFF(MONTH,mod_date,current_date()) <=",1)->order_by("mod_date", "desc");
	
		$sql =  "select b.user_name,b.user_realname,b.level
				from tbl_user b
				where (b.user_name= '$user' ) or (b.team_id='$team' and '$level'=2 and b.level < '$level')
				or (b.branch_id='$branch' and '$level'=3 and b.level < '$level') or '$level'>3 
				order by b.user_realname asc";
	
	
		return $this->db->query($sql);
	
	}
	
	public function getQuotationUnderByUser($user,$level,$team,$branch)
	{
		//return $this->db->select("*")->from("tbl_prospect")->where("TIMESTAMPDIFF(MONTH,mod_date,current_date()) <=",1)->order_by("mod_date", "desc");
	
		$sql =  "select a.id,a.quotation_no
		from tbl_user b,tbl_quotation a
		where a.sale_id=b.user_name and ((b.user_name= '$user' ) or (b.team_id='$team' and '$level'=2 and b.level < '$level')
		or (b.branch_id='$branch' and '$level'=3 and b.level < '$level') or '$level'>3)
		order by a.quotation_no desc";
	
	
		return $this->db->query($sql);
	
	}
	
	public function getQuotationUnderByUserProspect($user,$prospectId,$level,$team,$branch)
	{
		//return $this->db->select("*")->from("tbl_prospect")->where("TIMESTAMPDIFF(MONTH,mod_date,current_date()) <=",1)->order_by("mod_date", "desc");
	
		$sql =  "select a.id,a.quotation_no
		from tbl_user b,tbl_quotation a,tbl_prospect c
		where a.prospect_id=c.id and a.prospect_id='$prospectId' and a.sale_id=b.user_name and ((b.user_name= '$user' ) or (b.team_id='$team' and '$level'=2 and b.level < '$level')
		or (b.branch_id='$branch' and '$level'=3 and b.level < '$level') or '$level'>3)
		order by a.quotation_no desc";
	
	
		return $this->db->query($sql);
	
	}
	
	
	public function getMinDateOfWeek($date)
	{
		$this->db->select('*');
		$this->db->from('tbl_date');
		$this->db->where('ndateminweek <=', $date);
		$this->db->where('ndatemaxweek >=', $date);
		$query = $this->db->get();
		return $query;
		//return $this->db->select("*")->from("tbl_date")->where("id",$id)->order_by("name", "asc");
	}
	
	public function getLostProspectType()
	{
		return $this->db->select("*")->from("tbl_lost_prospect_type")->order_by("description", "asc");
	}
	public function getLostProspectBrand()
	{
		return $this->db->select("*")->from("tbl_lost_prospect_brand")->order_by("name", "asc");
	}
	public function getLostProspectModel()
	{
		return $this->db->select("*")->from("tbl_lost_prospect_model")->order_by("name", "asc");
	}
	public function getColor()
	{
		return $this->db->select("*")->from("tbl_color")->order_by("name", "asc");
	}
	
	
	//////newwww
	
	public function getProductCompany()
	{
		return $this->db->select("*")->from("tbl_company")->order_by("id", "asc");
	}
	public function getProductCategoryByProductType($id)
	{
		return $this->db->select("*")->from("tbl_product_category")->where("product_type_id",$id)->order_by("name", "asc");
	}
	public function getProductByProductCategory($id)
	{
		return $this->db->select("*")->from("tbl_product")->where("product_category_id",$id)->order_by("name", "asc");
	}
	
	public function getLostBrand()
	{
		return $this->db->select("*")->from("tbl_lost_brand")->order_by("name", "asc");
	}
	public function getLostCompetitor()
	{
		return $this->db->select("*")->from("tbl_lost_competitor")->order_by("name", "asc");
	}
	
	public function getProductOrigin()
	{
		return $this->db->select("*")->from("tbl_origin")->order_by("name", "asc");
	}
	public function getProductSource()
	{
		return $this->db->select("*")->from("tbl_source")->order_by("name", "asc");
	}
	
	public function getSaleUnderByUserQuotation($user,$level,$team,$branch)
	{
		//return $this->db->select("*")->from("tbl_prospect")->where("TIMESTAMPDIFF(MONTH,mod_date,current_date()) <=",1)->order_by("mod_date", "desc");
	
		$sql =  "select b.user_name,b.user_realname,b.level
		from tbl_user b
		where (b.user_name= '$user' ) or (b.team_id='$team' and '$level'=2 and b.level < '$level')
		or (b.branch_id='$branch' and '$level'=3 and b.level < '$level') or '$level'>3
		order by b.user_realname asc";
	
	
		return $this->db->query($sql);
	
	}
	
	public function getQuotationUnderByUserQuotation($user,$level,$team,$branch)
	{
		//return $this->db->select("*")->from("tbl_prospect")->where("TIMESTAMPDIFF(MONTH,mod_date,current_date()) <=",1)->order_by("mod_date", "desc");
	
		$sql =  "select a.id,a.quotation_no
		from tbl_user b,tbl_quotation a
		where a.sale_id=b.user_name and ((b.user_name= '$user' ) or (b.team_id='$team' and '$level'=2 and b.level < '$level')
		or (b.branch_id='$branch' and '$level'=3 and b.level < '$level') or '$level'>3)
		order by a.quotation_no desc";
	
	
		return $this->db->query($sql);
	
	}
	
	public function getProductSourceById($id)
	{
			$sql =  "select p.id,s.*
		from tbl_product p left outer join tbl_source s on (p.source_id=s.id )
		where  p.id='$id' 
		order by s.name";
	
	
		return $this->db->query($sql);
	
	}
	
	public function getProductOriginById($id)
	{
		$sql =  "select p.id,s.*
		from tbl_product p left outer join tbl_origin s on (p.origin_id=s.id )
		where  p.id='$id' 
		order by s.name";
	
	
		return $this->db->query($sql);
	
	}
	
	public function getFileType()
	{
		return $this->db->select("*")->from("tbl_type")->order_by("name", "asc");
	}
	
	public function getFileTypeByFolder($folderId)
	{
		$sql =  "select a.*
		from tbl_type a,tbl_folder_type b 
		where  a.id = b.type_id and b.folder_id ='$folderId'
		order by a.name";
	
	
		return $this->db->query($sql);
	}

	public function getFileTypeByFolderCheckbox($folderId)
	{
		$sql =  "select a.*,b.folder_id
		from tbl_type a left outer join tbl_folder_type b on (a.id = b.type_id and b.folder_id ='$folderId') 
		order by a.name";
	
	
		return $this->db->query($sql);
	}
	
	public function getFileInTypeFolder($folderId,$typeId)
	{
		$sql =  "select a.*
		from tbl_file a 
		where  a.type = '$typeId' and a.folder_id ='$folderId'
		order by a.name";
	
	
		return $this->db->query($sql);
	}


	public function getPrefixName()
	{
		return $this->db->select("*")->from("tbl_prefix_name")->order_by("name", "asc");
	}

	public function getPrefixCompanyName()
	{
		return $this->db->select("*")->from("tbl_prefix_company_name")->order_by("name", "asc");
	}

	public function getCompanyType()
	{
		return $this->db->select("*")->from("tbl_company_type")->order_by("name", "asc");
	}
	
	
	
}

?>