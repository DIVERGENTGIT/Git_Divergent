<?php
class ftp_campaign_model extends CI_Model {
public $db2;
	function __construct()
	{
	
		parent::__construct();
					$this->db2 = $this->load->database('backupdb', TRUE);
	}

	function get_ftp_campaigns_report($user_id, $from_date, $to_date)
	{
	$st="select sum(sms_count) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald ,count(status=0) as processcnt from ftp_campaign  where user_id=$user_id and date(created_date_time)>='$from_date' and date(created_date_time)<='$to_date' and created_date_time >= DATE_SUB(NOW(),INTERVAL 6 MONTH) order by created_date_time desc ";
		$query =$this->db->query($st);
return   $row = $query->result_array(); 

	}     
	
	function getAllFTPCampaigns1($user_id, $sender,$from_date,$to_date,$off_set=NULL,$limit=NULL)
	{
		//echo $off_set;
		//echo $to_date;
		//echo $user_id;
		//echo $sender;
		//echo "<br>";
		$this->db->select()
			->from('ftp_campaign')
			->where('user_id',$user_id)
			//->where('status !=','3')
			    ->where('created_date_time >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');
		if($from_date) {
			$this->db->where('date(created_date_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_date_time)<=',"$to_date");
		}			
		if($sender) {
			//echo "RRR".$sender;
			$this->db->where('sender_id',"$sender");
		}	
	
	
		$this->db->order_by('created_date_time','desc')
			->limit($limit, $off_set);
		$rs = $this->db->get();
		//echo $this->db->last_query();
		//echo "<br>";  
		//echo '<pre>',print_r($rs->result(),1),'</pre>';
		
		return $rs->result();			
	}
	
	function get_ftp_campaigns_count1($user_id,$sender,$status_,$from_date, $to_date,$offset = NULL, $limit = NULL)
	{
		$this->db->where('user_id',$user_id)
		//	->where('status !=','3')
		->where('created_date_time >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		if($from_date) {
			$this->db->where('date(created_date_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_date_time)<=',"$to_date");
		}
		if($sender) {
			$this->db->where('sender_id',"$sender");
		}
		if($status_) {
			if($status_=="delivered_count")
				$this->db->where('delivered_count >=',1);
			if($status_=="expired_count")
				$this->db->where('expired_count >=',1);
			if($status_=="dnd_count")
				$this->db->where('dnd_count >=',1);
			if($status_=="invalid_count")
				$this->db->where('invalid_count >=',1);
			if($status_=="pending_dlrs_count")
				$this->db->where('pending_dlrs_count >=',1);
		}
		$this->db->order_by('created_date_time','desc')
			->limit($limit, $offset);
	  $this->db->last_query();  
	//echo "<br>";
	//print_r($this->db->count_all_results('campaigns'));
		return $this->db->count_all_results('ftp_campaign');	   	
	}  
	
	function get_ftp_campaigns_report_default($user_id)  
	{
	 $stmnt="select sum(sms_count) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald,count(status=0) as processcnt from ftp_campaign where user_id=$user_id and created_date_time >= DATE_SUB(NOW(),INTERVAL 6 MONTH) order by created_date_time desc ";
		$query =$this->db->query($stmnt);
		return $query->result_array(); 
	}   
	
	function get_ftp_campaign_details($campaign_id, $user_id)
	{
		$this->db->select()
			->from('ftp_campaign')
			->where('campaign_id',$campaign_id)
			->where('user_id',$user_id)
		->where('created_date_time >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		$rs = $this->db->get();  
//echo	$this->db->last_query();
		return $rs->result();
	}
	
		public function get_all_ftp_smsreports_basedoncampaign($campaign_id,$days_diff,$campaigndate)
	{
		$condition = "";
		$delivered_count = 0;  
		$expired_count = 0;
		$dnd_count = 0;
		$pending_dlr_count= 0;
		$invalid_count = 0;

			if($days_diff <= 1) {  

		$query = "SELECT
		(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
		count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
		count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
		(count(CASE WHEN dlr_status=3 THEN to_mobile_no END) + count(CASE WHEN dlr_status =16 and error_text='DND number' THEN to_mobile_no END)) as dnd_count,
		count(CASE WHEN dlr_status=16 and error_text!='DND number' THEN to_mobile_no END) as invalid_count
		FROM ftp_campaigns_to WHERE campaign_id='$campaign_id'";
		$rs = $this->db->query($query);       
		$val = $rs->result_array();
		return $val;

		}  
		else{
		
$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count FROM ftp_campaign where campaign_id=$campaign_id";
			$campaigns = $this->db->query($sql);
			$campaigns_value = $campaigns->result_array();  
			return $campaigns_value;
			
		}
	}
	function getTotalNumbersCount($campaign_id, $days_diff, $campaign_ondate)
	{
		if($days_diff <= 1) {  
			$table_name = "sms.ftp_campaigns_to";
				$this->db->where('campaign_id',$campaign_id);
$this->db->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		return $this->db->count_all_results($table_name);
		} else {  
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.ftp_campaigns_to_".$month.$year;
				$this->db2->where('campaign_id',$campaign_id);
$this->db2->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		return $this->db2->count_all_results($table_name);
		}     
	
	}  
	
	
	function getFTPCampaignNumbers($campaign_id, $mobile_no, $days_diff, $campaign_ondate, $offset = NULL, $limit = NULL)
	{
		if($days_diff <= 1) {
			$table_name = "sms.ftp_campaigns_to";
			$this->db->select('acccount_num,to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
			->from($table_name)
			->where('campaign_id', $campaign_id);
			$this->db->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		if($mobile_no)
		{
			$this->db->where('to_mobile_no',$mobile_no);
		}				
		$this->db->order_by('sent_on','asc')
			->limit($limit, $offset);    
			
		$rs = $this->db->get();  
		return $rs->result();
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.ftp_campaigns_to_".$month.$year;
			$this->db2->select('acccount_num,to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
			->from($table_name)
			->where('campaign_id', $campaign_id);
			$this->db2->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		if($mobile_no)
		{
			$this->db2->where('to_mobile_no',$mobile_no);
		}				
		$this->db2->order_by('sent_on','asc')
			->limit($limit, $offset);    
			
		$rs = $this->db2->get();  
		return $rs->result();
		}

		
	}
	
	function get_ftp_campaign_numbers($campaign_id, $days_diff, $campaign_ondate)
	{
		if($days_diff <= 1) {
			$table_name = "sms.ftp_campaigns_to";
				$this->db->select('acccount_num,to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on,sms_text,sms_count')
			->from($table_name)
			->where('campaign_id', $campaign_id)
		//->where('YEAR(sent_on)=YEAR(CURDATE())')
		//->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)')


			->order_by('sent_on','desc');
			
		$rs = $this->db->get();
		// $this->db->last_query();
		 if($rs->num_rows() > 0) {  
		 		return $rs->result();
		 }else{
			 return array();
		 } 
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.ftp_campaigns_to_".$month.$year;
				$this->db2->select('acccount_num,to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on,sms_text,sms_count')
			->from($table_name)
			->where('campaign_id', $campaign_id)
		//->where('YEAR(sent_on)=YEAR(CURDATE())')
		//->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)')


			->order_by('sent_on','desc');
			
		$rs = $this->db2->get();
		  $this->db2->last_query();
		 if($rs->num_rows() > 0) {
		 		return $rs->result();
		 }else{
			 return array();
		 } 
		}
	
	} 
	
	
	
	function get_ftp_campaign_count($campaign_id, $days_diff, $campaign_ondate)
	{
		if($days_diff <= 1) {
			$table_name = "sms.ftp_campaigns_to";
				$sql = $this->db->select("count(to_mobile_no) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status=0 THEN to_mobile_no END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count, 
			count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count")
				->from($table_name) 
				->where('campaign_id', $campaign_id)
				->order_by('sent_on','desc');
			$rs = $this->db->get(); 
		$array = array(
				'total_count' => $rs->row('total_count'),
				'pending_dlr_count' => $rs->row('pending_dlr_count'),
				'delivered_count' => $rs->row('delivered_count'),
				'expired_count' => $rs->row('expired_count'),
				'invalid_count' => $rs->row('invalid_count'),
		    
		);	
		$invalid_nos_count = $this->db->query("SELECT count(*) as invalid_nos_count FROM $table_name WHERE (dlr_status = 16 OR dlr_status = 2)  AND ( error_code IN (1080,1081,001,005,015) OR error_code = NULL OR error_code = '' OR error_text = 'Invalid Number' ) AND campaign_id = '".$campaign_id."' ");     
		$array['invalid_nos_count'] = $invalid_nos_count->row('invalid_nos_count');
		
		$multiple_submit_count = $this->db->query("SELECT count(*) as multiple_submit_count FROM $table_name WHERE dlr_status = 16 AND (error_code = 1077 OR error_text = 'Duplicate Msg' ) AND campaign_id = '".$campaign_id."'");     
		$array['multiple_submit_count'] = $multiple_submit_count->row('multiple_submit_count');
		
		$invalid_number_length_count = $this->db->query("SELECT count(*) as invalid_number_length_count FROM $table_name WHERE dlr_status = 16 AND (error_code = '0x00000404' OR error_text = 'Invalid destination number')  AND campaign_id = '".$campaign_id."'");     
		$array['invalid_number_length_count'] = $invalid_number_length_count->row('invalid_number_length_count');
		
		 $misc_error_count = $this->db->query("SELECT count(*) as misc_error_count FROM $table_name WHERE dlr_status = 16 AND (error_code IN ('0x00000450',1077,100,020,019,410,409, 205,202,200,195,193,178,176,166,164,162,160,145,036,034,031,011, 090,109,252,124,102,037,021,032,035,144,146,161,163,165,167,177,192,194,196,201,204,404) OR error_text = 'Spam Error' OR error_text = 'Black-listed number' ) AND campaign_id = '".$campaign_id."'");       
		$array['misc_error_count'] = $misc_error_count->row('misc_error_count');
		    
		$invalid_sender_ids_count = $this->db->query("SELECT count(*) as invalid_sender_ids_count FROM $table_name WHERE dlr_status = 16 AND (error_code = '0x00000455' OR error_text = 'Sender ID not found') AND campaign_id = '".$campaign_id."'");     
		$array['invalid_sender_ids_count'] = $invalid_sender_ids_count->row('invalid_sender_ids_count');  
		
		$dnd_count = $this->db->query("SELECT count(*) as dnd_count FROM $table_name WHERE (dlr_status = 16 OR dlr_status = 3 ) AND (error_code IN ('0x00000481' ,1078,478,'0x00000436',1032) OR error_text = 'DND number') AND campaign_id = '".$campaign_id."'");     
		$array['dnd_count'] = $dnd_count->row('dnd_count');
		
		$pending_dlrs_count = $this->db->query("SELECT count(*) as pending_dlrs_count FROM $table_name WHERE dlr_status = 0 OR dlr_status = ''  AND campaign_id = '".$campaign_id."'");     
		$array['pending_dlrs_count'] = $pending_dlrs_count->row('pending_dlrs_count');
		
		$out_of_range_count = $this->db->query("SELECT count(*) as out_of_range_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (002,027,203,010,016) AND campaign_id = '".$campaign_id."'");     
		$array['out_of_range_count'] = $out_of_range_count->row('out_of_range_count');  
		
		$memory_capacity_exceeded_count = $this->db->query("SELECT count(*) as memory_capacity_exceeded_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (003,013,412,009) AND campaign_id = '".$campaign_id."'");     
		$array['memory_capacity_exceeded_count'] = $memory_capacity_exceeded_count->row('memory_capacity_exceeded_count');
		
		$mobile_equipment_error_count = $this->db->query("SELECT count(*) as mobile_equipment_error_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (004,012,007) AND campaign_id = '".$campaign_id."' ");     
		$array['mobile_equipment_error_count'] = $mobile_equipment_error_count->row('mobile_equipment_error_count');
		
		$network_error_count = $this->db->query("SELECT count(*) as network_error_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (005,008,161,034,033,017) AND campaign_id = '".$campaign_id."'");     
		$array['network_error_count'] = $network_error_count->row('network_error_count');
		
		$barring_count = $this->db->query("SELECT count(*) as barring_count FROM $table_name WHERE dlr_status = 2  AND error_code  = 006  AND campaign_id = '".$campaign_id."'");     
		$array['barring_count'] = $barring_count->row('barring_count');
		
		$promo_blocked_count = $this->db->query("SELECT count(*) as promo_blocked_count FROM $table_name WHERE dlr_status = 2  AND error_code = 044 AND campaign_id = '".$campaign_id."'");     
		$array['promo_blocked_count'] = $promo_blocked_count->row('promo_blocked_count');
		return $array;  
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.ftp_campaigns_to_".$month.$year;
	 

		
		
		$sql = $this->db2->select("count(to_mobile_no) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status=0 THEN to_mobile_no END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count, 
			count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count")
				->from($table_name) 
				->where('campaign_id', $campaign_id)
				->order_by('sent_on','desc');
			$rs = $this->db2->get(); 
		$array = array(
				'total_count' => $rs->row('total_count'),
				'pending_dlr_count' => $rs->row('pending_dlr_count'),
				'delivered_count' => $rs->row('delivered_count'),
				'expired_count' => $rs->row('expired_count'),
				'invalid_count' => $rs->row('invalid_count'),
		    
		);	
		$invalid_nos_count = $this->db2->query("SELECT count(*) as invalid_nos_count FROM $table_name WHERE (dlr_status = 16 OR dlr_status = 2)  AND ( error_code IN (1080,1081,001,005,015) OR error_code = NULL OR error_code = '' OR error_text = 'Invalid Number' ) AND campaign_id = '".$campaign_id."' ");     
		$array['invalid_nos_count'] = $invalid_nos_count->row('invalid_nos_count');
		
		$multiple_submit_count = $this->db2->query("SELECT count(*) as multiple_submit_count FROM $table_name WHERE dlr_status = 16 AND (error_code = 1077 OR error_text = 'Duplicate Msg' ) AND campaign_id = '".$campaign_id."'");     
		$array['multiple_submit_count'] = $multiple_submit_count->row('multiple_submit_count');
		
		$invalid_number_length_count = $this->db2->query("SELECT count(*) as invalid_number_length_count FROM $table_name WHERE dlr_status = 16 AND (error_code = '0x00000404' OR error_text = 'Invalid destination number')  AND campaign_id = '".$campaign_id."'");     
		$array['invalid_number_length_count'] = $invalid_number_length_count->row('invalid_number_length_count');
		
		 $misc_error_count = $this->db2->query("SELECT count(*) as misc_error_count FROM $table_name WHERE dlr_status = 16 AND (error_code IN ('0x00000450',1077,100,020,019,410,409, 205,202,200,195,193,178,176,166,164,162,160,145,036,034,031,011, 090,109,252,124,102,037,021,032,035,144,146,161,163,165,167,177,192,194,196,201,204,404) OR error_text = 'Spam Error' OR error_text = 'Black-listed number' ) AND campaign_id = '".$campaign_id."'");       
		$array['misc_error_count'] = $misc_error_count->row('misc_error_count');
		    
		$invalid_sender_ids_count = $this->db2->query("SELECT count(*) as invalid_sender_ids_count FROM $table_name WHERE dlr_status = 16 AND (error_code = '0x00000455' OR error_text = 'Sender ID not found') AND campaign_id = '".$campaign_id."'");     
		$array['invalid_sender_ids_count'] = $invalid_sender_ids_count->row('invalid_sender_ids_count');  
		
		$dnd_count = $this->db2->query("SELECT count(*) as dnd_count FROM $table_name WHERE (dlr_status = 16 OR dlr_status = 3 ) AND (error_code IN ('0x00000481' ,1078,478,'0x00000436',1032) OR error_text = 'DND number') AND campaign_id = '".$campaign_id."'");     
		$array['dnd_count'] = $dnd_count->row('dnd_count');
		
		$pending_dlrs_count = $this->db2->query("SELECT count(*) as pending_dlrs_count FROM $table_name WHERE dlr_status = 0 OR dlr_status = ''  AND campaign_id = '".$campaign_id."'");     
		$array['pending_dlrs_count'] = $pending_dlrs_count->row('pending_dlrs_count');
		
		$out_of_range_count = $this->db2->query("SELECT count(*) as out_of_range_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (002,027,203,010,016) AND campaign_id = '".$campaign_id."'");     
		$array['out_of_range_count'] = $out_of_range_count->row('out_of_range_count');  
		
		$memory_capacity_exceeded_count = $this->db2->query("SELECT count(*) as memory_capacity_exceeded_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (003,013,412,009) AND campaign_id = '".$campaign_id."'");     
		$array['memory_capacity_exceeded_count'] = $memory_capacity_exceeded_count->row('memory_capacity_exceeded_count');
		
		$mobile_equipment_error_count = $this->db2->query("SELECT count(*) as mobile_equipment_error_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (004,012,007) AND campaign_id = '".$campaign_id."' ");     
		$array['mobile_equipment_error_count'] = $mobile_equipment_error_count->row('mobile_equipment_error_count');
		
		$network_error_count = $this->db2->query("SELECT count(*) as network_error_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (005,008,161,034,033,017) AND campaign_id = '".$campaign_id."'");     
		$array['network_error_count'] = $network_error_count->row('network_error_count');
		
		$barring_count = $this->db2->query("SELECT count(*) as barring_count FROM $table_name WHERE dlr_status = 2  AND error_code  = 006  AND campaign_id = '".$campaign_id."'");     
		$array['barring_count'] = $barring_count->row('barring_count');
		
		$promo_blocked_count = $this->db2->query("SELECT count(*) as promo_blocked_count FROM $table_name WHERE dlr_status = 2  AND error_code = 044 AND campaign_id = '".$campaign_id."'");     
		$array['promo_blocked_count'] = $promo_blocked_count->row('promo_blocked_count');
		return $array; 
		}     
	}
	  
	
	public function getAllFTPCampaignsSearchValues($limit, $off_set, $user_id, $sn, $from_date, $to_date)
	{

		$this->db->select()
			->from('ftp_campaign')
			->where('user_id',$user_id)
			//->where('campaign_status !=','3')
			    ->where('created_date_time >= DATE_SUB(NOW(),INTERVAL 1 YEAR)');
		if($from_date) {
			$this->db->where('date(created_date_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_date_time)<=',"$to_date");
		}			
		if($sn) {
			//echo "RRR".$sender;  
			$this->db->where('sender_id', $sn);
		}	
			$this->db->order_by('created_date_time','desc')
			->limit($limit, $off_set);
		$rs = $this->db->get();
			//echo $this->db->last_query();
			return $rs->result();

	
	}
	
	
	
public function get_aftersearch_ftp_campaigns_report($user_id, $sender_name, $fd, $td)
	{
		
		$this->db->select('sum(no_of_messages) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald,count(status=0) as processcnt')
			->from('ftp_campaign')
			->where('user_id',$user_id)
			->where('created_date_time >= DATE_SUB(NOW(),INTERVAL 1 YEAR)');
			if($fd) {
			$this->db->where('date(created_date_time)>=',"$fd");
			}
			if($td) {
			$this->db->where('date(created_date_time)<=',"$td");
			}			
			if($sender_name) {
			$this->db->where('sender_id', $sender_name);
			}	
			$this->db->order_by('created_date_time','desc');
			$rs = $this->db->get();
			//echo $this->db->last_query();
			return $rs->result_array();



	}
	
	
	public function get_all_users($user_id)
	{
		$users_list = "SELECT user_id,username AS users FROM users WHERE reseller_id ='$user_id'";	
		$rs = $this->db->query($users_list);
		return $rs->result();
	}
	
	public function get_all_smsreports($user_id,$from_date,$to_date)
	{
		$condition = "";
		if($from_date!='' && $to_date!='')
		{
			$condition = " AND date(created_date_time) >= '$from_date' AND date(created_date_time) <= '$to_date'";
		}
		
		$delivered_count = 0;
		$expired_count = 0;
		$dnd_count = 0;
		$pending_dlr_count= 0;
		$invalid_count = 0;
			
		//$users_list = mysql_query("SELECT group_concat(user_id) AS users FROM users WHERE reseller_id ='$user_id'");
		//$res = mysql_fetch_array($users_list);
		$users_list = $this->db->query("SELECT group_concat(user_id) AS users FROM users WHERE reseller_id ='$user_id'");
		$res = $users_list->row('users');
		$users = $res;
		
		if($users != NULL)
		{
			$users = $res.','.$user_id;
		}
		else
		{
			$users = $user_id;
		}
		
		if($from_date!='' && $to_date!='')
		{	
			$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 0 AND user_id in($users) $condition";
		}
		else
		{
			$campaigns_query = "select campaign_id,user_id from ftp_campaign where is_scheduled = 0 and date(created_date_time) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id in($users)";
		}
		$campaigns_rs = $this->db->query($campaigns_query);
		
		if($campaigns_rs->num_rows() > 0) 
		{
			$result_array = $campaigns_rs->result_array();
 
			foreach($result_array as $response)
			{
				$campaign_id = $response['campaign_id']."<br>";
			       
				//counts
				$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
				    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
				    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
				    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
				    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count
				    from ftp_campaigns_to WHERE campaign_id='$campaign_id'";
			       
				$rs = $this->db->query($query);       
				$val = $rs->result_array();  
				 //Array ( [0] => Array ( [pending_dlr_count] => 0 [delivered_count] => 0 [expired_count] => 0 [dnd_count] => 0 [invalid_count] => 0 ) )
				$delivered_count = $delivered_count + $val[0]['delivered_count'];
				$expired_count = $expired_count + $val[0]['expired_count'];
				$dnd_count = $dnd_count + $val[0]['dnd_count'];
				$pending_dlr_count = $pending_dlr_count + $val[0]['pending_dlr_count'];
				$invalid_count = $invalid_count + $val[0]['invalid_count'];
			}
		}  
		
		$sql = "SELECT sum(sms_count*pending_dlrs_count) AS pending_dlrs_count,sum(sms_count*delivered_count) AS delivered_count,sum(sms_count*expired_count) AS expired_count,sum(sms_count*dnd_count) AS dnd_count,sum(sms_count*invalid_count) AS invalid_count from ftp_campaign where user_id in($users) $condition";
		$campaigns = $this->db->query($sql);
		
		if($campaigns->num_rows() > 0) 
		{
			$campaigns_res = $campaigns->result_array();
			foreach($campaigns_res as $campaigns_value) 
			{
				$delivered_count = $delivered_count + $campaigns_value['delivered_count'];
				$expired_count = $expired_count + $campaigns_value['expired_count'];
				$dnd_count = $dnd_count + $campaigns_value['dnd_count'];
				$pending_dlr_count = $pending_dlr_count + $campaigns_value['pending_dlrs_count'];
				$invalid_count = $invalid_count + $campaigns_value['invalid_count'];
			}
		}
		$total_rows = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count;
		$valu = explode(",",$total_rows);
		return $valu;
		  
		  }
	
	  public function get_username_download($user_id)
	{
		$this->db->select('username')
			->from('sms.users')
			->where('user_id',$user_id);
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();	 		
	}
	
public function get_usersms_download($user_id,$from_date,$to_date)
	{
		$xy = 0;
		$condition = "";
		if($from_date!='' && $to_date!='')
		{
			$condition = " AND date(created_date_time) >= '$from_date' AND date(created_date_time) <= '$to_date'";
		}
		
		$delivered_count = 0;
		$expired_count = 0;
		$dnd_count = 0;
		$pending_dlr_count= 0;
		$invalid_count = 0;
		if($this->session->userdata('agent_id')  == "")	
		{
			$total13 = array();
			$total12 = array();
			//$users_list = mysql_query("SELECT user_id AS users FROM users WHERE reseller_id ='$user_id'");
			
			$users_list = "SELECT user_id AS users FROM users WHERE reseller_id ='$user_id'";
			$result = $this->db->query($users_list); 
			
			//if(mysql_num_rows($users_list) > 0)
			if($result->num_rows()>0)
			{
				//while($res = mysql_fetch_array($users_list))
				foreach($result->result_array() AS $res)
				{
					$users = $res['users'];
			
					if($from_date!='' && $to_date!='')
					{	
						$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 0 AND user_id in($users) $condition";
					}
					else
					{
						$campaigns_query = "select campaign_id,user_id from ftp_campaign where is_scheduled = 0 and date(created_date_time) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id in($users)";
					}
					//$campaigns_rs = mysql_query($campaigns_query);
					$campaigns_rs = $this->db->query($campaigns_query); 
					$j = 0;
					//if(mysql_num_rows($campaigns_rs) > 0) 
					if($campaigns_rs->num_rows()>0)
					{
						//while($campaigns_val = mysql_fetch_array($campaigns_rs)) 
						foreach($campaigns_rs->result_array() AS $campaigns_val)
						{
							$campaign_id = $campaigns_val['campaign_id'];
						       
							//counts
							$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
							    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
							    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
							    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
							    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on 
							    from ftp_campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
						       
							//$rs = mysql_query($query);   
							  $rs = $this->db->query($query);   
							//$val = mysql_fetch_array($rs);
							$val = $rs->result_array();
							//print_r($val);
							
							$delivered_count = $val['delivered_count'];
							$expired_count = $val['expired_count'];
							$dnd_count = $val['dnd_count'];
							$pending_dlr_count = $val['pending_dlr_count'];
							$invalid_count = $val['invalid_count'];
							$sent_date = $val['sent_on'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total13[$j] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
					$j++;
						}
					}
		
					$sql = "SELECT sum(sms_count*pending_dlrs_count) AS pending_dlrs_count,sum(sms_count*delivered_count) AS delivered_count,sum(sms_count*expired_count) AS expired_count,sum(sms_count*dnd_count) AS dnd_count,sum(sms_count*invalid_count) AS invalid_count,created_date_time from ftp_campaign where user_id in($users) $condition group by date(created_date_time)";
					//$campaigns = mysql_query($sql);
					$campaigns =$this->db->query($sql);
					$i = 0;
					//if(mysql_num_rows($campaigns) > 0) 
					if($campaigns->num_rows()>0)
					{
						//while($campaigns_value = mysql_fetch_array($campaigns)) 
						foreach($campaigns->result_array() AS $campaigns_value)
						{
							$delivered_count = $campaigns_value['delivered_count'];
							$expired_count = $campaigns_value['expired_count'];
							$dnd_count = $campaigns_value['dnd_count'];
							$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
							$invalid_count = $campaigns_value['invalid_count'];
							
							$date = $campaigns_value['created_date_time'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total12[$i] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
					$i++;
						}
					}
					$total_rows123 = array_merge($total13,$total12);
				}
		
				$total_rows = array();
				$total_rows1 = array();	
				if($from_date!='' && $to_date!='')
				{	
					$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 0 AND user_id in($user_id) $condition";
				}
				else
				{
					  $campaigns_query = "select campaign_id,user_id from ftp_campaign where is_scheduled = 0 and date(created_date_time) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id in($user_id)";
				}
				//$campaigns_rs = mysql_query($campaigns_query);
				$campaigns_rs=$this->db->query($campaigns_query);
				//print_r($campaigns_rs);exit;
				$k = 0;
				//if(mysql_num_rows($campaigns_rs) > 0) 
				if($campaigns_rs->num_rows()>0)
				{
					//while($campaigns_val = mysql_fetch_array($campaigns_rs)) 
					foreach($campaigns_rs->result_array() AS $campaigns_val)
					{
						$campaign_id = $campaigns_val['campaign_id'];
					       
						//counts
						 $query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
						    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
						    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
						    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
						    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on
						    from ftp_campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
					       
						//$rs = mysql_query($query);
						    $rs = $this->db->query($query);       
						//$val = mysql_fetch_array($rs);
						$val = $rs->result_array();
							//print_r($val);exit;
						@$delivered_count = $val['delivered_count'];
						@$expired_count = $val['expired_count'];
						@$dnd_count = $val['dnd_count'];
						@$pending_dlr_count = $val['pending_dlr_count'];
						@$invalid_count = $val['invalid_count'];
					
						@$sent_date = $val['sent_on'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;		
					$total_rows[$k] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
					$k++;
					}
				}
	
				$sql = "SELECT sum(sms_count*pending_dlrs_count) AS pending_dlrs_count,sum(sms_count*delivered_count) AS delivered_count,sum(sms_count*expired_count) AS expired_count,sum(sms_count*dnd_count) AS dnd_count,sum(sms_count*invalid_count) AS invalid_count,created_date_time from ftp_campaign where user_id in($user_id) $condition group by date(created_date_time)";
				//$campaigns = mysql_query($sql);
				$campaigns =$this->db->query($sql);
				$m = 0;
				//if(mysql_num_rows($campaigns) > 0)
				 if($campaigns->num_rows()>0)
				{
					//while($campaigns_value = mysql_fetch_array($campaigns))
					 foreach($campaigns->result_array() AS $campaigns_value)
					{
						$delivered_count = $campaigns_value['delivered_count'];
						$expired_count = $campaigns_value['expired_count'];
						$dnd_count = $campaigns_value['dnd_count'];
						$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
						$invalid_count = $campaigns_value['invalid_count'];
						
						$date = $campaigns_value['created_date_time'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total_rows1[$m] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
					$m++;
					}
				}
				$totalrows = array_merge($total_rows,$total_rows1);
				
				$rows_total = array_merge($total_rows123,$totalrows);
				return $rows_total;
			}
			else
			{
			
				$total_rows12 = array();
				$total_rows13 = array();
				if($from_date!='' && $to_date!='')
				{	
					$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 0 AND user_id = '$user_id' $condition";
				}
				else
				{
					$campaigns_query = "select campaign_id,user_id from ftp_campaign where is_scheduled = 0 and date(created_date_time) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id = '$user_id'";
				}
				//$campaigns_rs = mysql_query($campaigns_query);
				$campaigns_rs = $this->db->query($campaigns_query);
				$y = 0;
				//if(mysql_num_rows($campaigns_rs) > 0) 
				if($campaigns_rs->num_rows() > 0) 
				{
					
					//while($campaigns_val = mysql_fetch_array($campaigns_rs)) 
					
					 foreach($campaigns_rs->result_array() AS $campaigns_val) 
					{
						$campaign_id = $campaigns_val['campaign_id'];
					       
						//counts
						$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
						    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
						    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
						    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
						    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on
						    from ftp_campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
					       
						//$rs = mysql_query($query);   
						    $rs = $this->db->query($query);   
						//$val = mysql_fetch_array($rs);
						$val = $rs->result_array();
						//print_r($val);exit;
						break; // break the process
						$delivered_count = $val['delivered_count'];
						$expired_count = $val['expired_count'];
						$dnd_count = $val['dnd_count'];
						$pending_dlr_count = $val['pending_dlr_count'];
						$invalid_count = $val['invalid_count'];
						$sent_date = $val['sent_on'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
						$total_rows13[$y] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
						$y++;
					}
				}
	
				$sql = "SELECT sum(sms_count*pending_dlrs_count) AS pending_dlrs_count,sum(sms_count*delivered_count) AS delivered_count,sum(sms_count*expired_count) AS expired_count,sum(sms_count*dnd_count) AS dnd_count,sum(sms_count*invalid_count) AS invalid_count,created_date_time from ftp_campaign where user_id = '$user_id' $condition group by date(created_date_time)";
				//$campaigns = mysql_query($sql);
				 $campaigns = $this->db->query($sql);   
				$z = 0;
				//if(mysql_num_rows($campaigns) > 0) 
				if($campaigns->num_rows() > 0) 
				{
					//while($campaigns_value = mysql_fetch_array($campaigns)) 
					foreach($campaigns->result_array() AS $campaigns_value) 
					{
						$delivered_count = $campaigns_value['delivered_count'];
						$expired_count = $campaigns_value['expired_count'];
						$dnd_count = $campaigns_value['dnd_count'];
						$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
						$invalid_count = $campaigns_value['invalid_count'];
						$date = $campaigns_value['created_date_time'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
						$total_rows12[$z] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
						$z++;
					}
				}
				$rows = array_merge($total_rows13,$total_rows12);
				return $rows;
			}
		}
		else
		{
		
			$total_rows12 = array();
			$total_rows13 = array();
			if($from_date!='' && $to_date!='')
			{	
				$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 0 AND user_id = '$user_id' $condition";
			}
			else
			{
				$campaigns_query = "select campaign_id,user_id from ftp_campaign where is_scheduled = 0 and date(created_date_time) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id = '$user_id'";
			}
			//$campaigns_rs = mysql_query($campaigns_query);
			$campaigns_rs = $this->db->query($campaigns_query);   
			$y = 0;
			//if(mysql_num_rows($campaigns_rs) > 0) 
			if($campaigns_rs->num_rows() > 0) 
			{
				//while($campaigns_val = mysql_fetch_array($campaigns_rs)) 
				 foreach($campaigns_rs->result_array() AS $campaigns_val) 
				{
					$campaign_id = $campaigns_val['campaign_id'];
				       
					//counts
					$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
					    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
					    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
					    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
					    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on
					    from ftp_campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
				       
					//$rs = mysql_query($query);  
					    $rs = $this->db->query($query); 
					//$val = mysql_fetch_array($rs);
					$val = $rs->result_array();
					//print_r($val);exit;
					$delivered_count = $val[0]['delivered_count'];
					$expired_count = $val[0]['expired_count'];
					$dnd_count = $val[0]['dnd_count'];
					$pending_dlr_count = $val[0]['pending_dlr_count'];
					$invalid_count = $val[0]['invalid_count'];
					$sent_date = $val[0]['sent_on'];
					$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total_rows13[$y] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
					$y++;
				}
			}
	
			$sql = "SELECT sum(sms_count*pending_dlrs_count) AS pending_dlrs_count,sum(sms_count*delivered_count) AS delivered_count,sum(sms_count*expired_count) AS expired_count,sum(sms_count*dnd_count) AS dnd_count,sum(sms_count*invalid_count) AS invalid_count,created_date_time from ftp_campaign where user_id = '$user_id' $condition group by date(created_date_time)";
			//$campaigns = mysql_query($sql);
			 $campaigns = $this->db->query($sql);   
			$z = 0;
			//if(mysql_num_rows($campaigns) > 0) 
			if($campaigns->num_rows() > 0) 
			{
				//while($campaigns_value = mysql_fetch_array($campaigns)) 
				foreach($campaigns->result_array() AS $campaigns_value) 
				{
					$delivered_count = $campaigns_value['delivered_count'];
					$expired_count = $campaigns_value['expired_count'];
					$dnd_count = $campaigns_value['dnd_count'];
					$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
					$invalid_count = $campaigns_value['invalid_count'];
					$date = $campaigns_value['created_date_time'];
					$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total_rows12[$z] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
					$z++;
				}
			}
			$rows = array_merge($total_rows13,$total_rows12);
			return $rows;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}	
?>
