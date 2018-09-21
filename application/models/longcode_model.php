<?php
class longcode_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	public function getlongcode_numbers($servicetype)
	{
		$this->db->select()
				 ->from('longcode_subscription')
				 ->where('service_type',$servicetype);
		$query=$this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return false;
	}
	public function getnoofsms_packages()
	{
		$this->db->select()
				 ->from('longcode_packages')
				 ->group_by('no_of_sms')
				 ->order_by('package_id','asc');
		$query=$this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return false;
	}
	
	public function getsubscription_packages()
	{
		$this->db->select()
				 ->from('longcode_packages')
				 ->group_by('subscription_duration')
				 ->order_by('package_id','asc');
		$query=$this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return false;
	}
	
	
	public function getPackages($user_id,$from_date,$to_date,$longcode_number,$servicetype,$limit,$offset)
	{
	
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and longcode_number='$longcode_number'";
	}
	if($servicetype!='')
	{
		$condition4=" and service_type='$servicetype'";
	}
	
	
	$sql3="select * from longcode_subscription where user_id=$user_id  $condition1 $condition2 $condition3 $condition4
		 group by longcode_number order by longcode_id desc limit $offset,$limit";
		 
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return array();
	}
	
	
	public function getPackagescount($user_id,$from_date,$to_date,$longcode_number,$servicetype)
	{
	
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and longcode_number='$longcode_number'";
	}
	if($servicetype!='')
	{
		$condition4=" and service_type='$servicetype'";
	}
	
		$sql3="select * from longcode_subscription where user_id=$user_id  $condition1 $condition2 
		$condition3 $condition4 
		 group by longcode_number order by longcode_id desc ";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
		
			return $query->num_rows();
		}
		return 0;
	}
	
	public function getReports($user_id,$from_date,$to_date,$longcode_number,$servicetype,$limit,$offset)
	{
	
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and service_number='$longcode_number'";
	}
	if($servicetype!='')
	{
		$condition4=" and service_type='$servicetype'";
	}
	
	
	 $sql3="select * from longcode_smsmessages where user_id=$user_id  $condition1 $condition2 $condition3 $condition4
		 group by service_number order by id desc limit $offset,$limit";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return array();
	}
	
	
	public function getReportscount($user_id,$from_date,$to_date,$longcode_number,$servicetype)
	{
	
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and service_number='$longcode_number'";
	}
	if($servicetype!='')
	{
		$condition4=" and service_type='$servicetype'";
	}
	
		$sql3="select * from longcode_smsmessages where user_id=$user_id  $condition1 $condition2 
		$condition3 $condition4 
		 group by service_number order by id desc ";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
		
			return $query->num_rows();
		}
		return 0;
	}
	
	
	
	public function getViewReports($user_id,$from_date,$to_date,$longcode_number,$longcode_mobile,
	$longcode_keyword,$servicetype,$limit,$offset)
	{
	
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	$condition5="";
	$condition6="";
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and service_number='$longcode_number'";
	}
	
	if($longcode_mobile!='')
	{
		$condition4=" and message_from='$longcode_mobile'";
	}
	if($longcode_keyword!='')
	{
		$condition5=" and keyword='$longcode_keyword'";
	}
	if($servicetype!='')
	{
		$condition6=" and service_type='$servicetype'";
	}
	
	$sql3="select * from longcode_smsmessages where user_id=$user_id  $condition1 $condition2 
	$condition3 $condition4 $condition5 $condition6
		 order by id desc limit $offset,$limit";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return array();
	}
	
	
	
	public function getViewReportscount($user_id,$from_date,$to_date,$longcode_number,$longcode_mobile,$longcode_keyword,$servicetype)
	{
	
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	$condition5="";
	$condition6="";
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and service_number='$longcode_number'";
	}
	
	if($longcode_mobile!='')
	{
		$condition4=" and message_from='$longcode_mobile'";
	}
	if($longcode_keyword!='')
	{
		$condition5=" and keyword='$longcode_keyword'";
	}
	if($servicetype!='')
	{
		$condition6=" and service_type='$servicetype'";
	}
	
	
		$sql3="select * from longcode_smsmessages where user_id=$user_id  $condition1 $condition2
		 $condition3 $condition4  $condition5 $condition6
		 order by id desc ";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
		
			return $query->num_rows();
		}
		return 0;
	}
	
	
	
	public function getViewReportsDownload($user_id,$from_date,$to_date,$longcode_number,$longcode_mobile,$longcode_keyword,$servicetype)
	{
	$condition1="";
	$condition2="";
	$condition3="";
	$condition4="";
	$condition5="";
	$condition6="";
	if($from_date!='')
	{
		$condition1=" and date(created_on)>='$from_date'";
	}
	if($to_date!='')
	{
		$condition2=" and date(created_on)<='$to_date'";
	}
	if($longcode_number!='')
	{
		$condition3=" and service_number='$longcode_number'";
	}
	
	if($longcode_mobile!='')
	{
		$condition4=" and message_from='$longcode_mobile'";
	}
	if($longcode_keyword!='')
	{
		$condition5=" and keyword='$longcode_keyword'";
	}
	if($servicetype!='')
	{
		$condition6=" and service_type='$servicetype'";
	}
	
	
		$sql3="select service_number,message_from as mobile,service_type,message,sender_id,keyword,message_time,status
		 from longcode_smsmessages where user_id=$user_id  $condition1 $condition2
		 $condition3 $condition4  $condition5 $condition6
		 order by id desc ";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
		
			return $query->result();
		}
		return array();
	}
	
	
	
	public function getlongcode_config($user_id,$servicetype,$limit,$offset)
	{
	
	$sql3="select * from longcode_config where user_id=$user_id AND status=1 and service_type='$servicetype'
	  order by longcode_id desc limit $offset,$limit";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return array();
	}
	
	public function countlongcode_config($user_id,$servicetype)
	{
	
	 $sql3="select * from longcode_config where user_id=$user_id AND status=1 and service_type='$servicetype'
	  order by longcode_id desc ";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->num_rows();
		}
		return 0;
	}
	
	
	
	

}
