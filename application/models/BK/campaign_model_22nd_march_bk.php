
<?php
class campaign_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
		function getSenderNames($user_id)
	{
		$this->db->select()
			->from('sender_names')
			->where('user_id',$user_id);
		$rs = $this->db->get();
		return $rs->result();	 		
	}
	//function getTemplates($user_id)
	//{
		//$this->db->select()
		//	->from('templates')
		//	->where('user_id',$user_id);
		//$rs1 = $this->db->get();
		//return $rs1->result();	 		
	//}	
	
	function createCampaign($userId,$sms_type,$sms_text,$sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name)
	{
		// calculate SMS length
		if(strlen($sms_text)>160)
			$sms_length_tmp=ceil(strlen($sms_text)/153);
		else
			$sms_length_tmp=ceil(strlen($sms_text)/160);
		
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length = ceil(strlen($sms_text)/160);
		
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender,
			'sms_text' => $sms_text,
			'sms_count' => $sms_length,
			'no_of_messages' => $total_no_of_sms,
			'campaign_type' => $sms_type,
			'campaign_name' => $campaign_name,
			'port_no' => $sms_port
		);
		if($is_schedule == 1) {
			$values['is_scheduled'] = $is_schedule;
			$values['scheduled_on'] = $scheduled_date;
		}
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('campaigns', $values)) {
			return $this->db->insert_id();
		}
//		echo	$this->db->last_query();
//exit;
	
		return false;
	}
		
	
	function createLargeCampaignActivity($userId,$campaign_id,$original_file,$total_no_of_sms,$mobile_column,$sms_text,$is_schedule,$from_row,$to_row)
	{
		$values = array(
			'user_id' => $userId,
			'campaign_id' => $campaign_id,
			'file_path' => $original_file,
			'no_of_sms' => $total_no_of_sms,
			'status' => '0',
			'mobile_no_column' => $mobile_column,
			'sms_text' => $sms_text,
			'is_schedule' => $is_schedule,
			'from_row' => $from_row,
			'to_row' => $to_row
		);
		
		$this->db->set('start_time', 'NOW()', FALSE);
		if($this->db->insert('large_campaign_activities', $values)) {
				//     return	$this->db->last_query();
			return $this->db->insert_id();
		}
	     	//$this->db->last_query();
		return false;
	}
	
		function createLargeCampaignActivity_New($userId,$campaign_id,$original_file,$total_no_of_sms,$mobile_column,$sms_text,$is_schedule,$from_row,$to_row)
	{
		$values = array(
			'user_id' => $userId,
			'campaign_id' => $campaign_id,
			'file_path' => $original_file,
			'no_of_sms' => $total_no_of_sms,
			'status' => '0',
			'mobile_no_column' => $mobile_column,
			'sms_text' => $sms_text,
			'is_schedule' => $is_schedule,
			'from_row' => $from_row,
			'to_row' => $to_row
		);
		
		$this->db->set('start_time', 'NOW()', FALSE);
		if($this->db->insert('large_campaign_activities_new', $values)) {
			return $this->db->insert_id();
		}
	//echo	$this->db->last_query();
		return false;
	}
	
	function createUnicodeCampaign($userId,$sms_type,$is_unicode_sms,$sms_text,$sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name)
	{
		// calculate SMS length
		if(mb_strlen($sms_text)>70)
			$sms_length_tmp=ceil(mb_strlen($sms_text)/63);
		else
			$sms_length_tmp=ceil(mb_strlen($sms_text)/70);
		
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length = ceil(strlen($sms_text)/160);
		
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender,
			'sms_text' => $sms_text,
			'is_unicode_sms' => $is_unicode_sms,
			'sms_count' => $sms_length,
			'no_of_messages' => $total_no_of_sms,
			'campaign_type' => $sms_type,
			'campaign_name' => $campaign_name,
			'port_no' => $sms_port
		);
		if($is_schedule == 1) {
			$values['is_scheduled'] = $is_schedule;
			$values['scheduled_on'] = $scheduled_date;
		}
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('campaigns', $values)) {
			return $this->db->insert_id();
		}
		return false;
	}
	
	
	function getCampaignsLast($user_id)
	{
		
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id);
$this->db->where('created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		$this->db->order_by('created_on','desc')
			->limit(10);
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();			
	}
		function getCampaignsLast_from_To($user_id,$from_date,$to_date)
	{
		
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id);
			$this->db->where('created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}			
	$this->db->order_by('created_on','desc');
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();			
	}
	
	function campaignTo($campaign_id,$sms_length,$mobile_no, $message = null, $port_no = null,$dlr = null, $error_text = null)
	{
		$values = array(
		'campaign_id' => $campaign_id,
		'to_mobile_no' => $mobile_no,
		'port_no' => $port_no,
		'sms_text' => $message,
		'dlr_status' => $dlr,
		'error_text' => $error_text
		);

		$this->db->set('sent_on', 'NOW()', FALSE);
		$this->db->insert('campaigns_to', $values);
	}
	/*
	function campaignTo($campaign_id,$sms_length,$mobile_no, $message = null, $dlr = null, $error_text = null)
	{
		$values = array(
			'campaign_id' => $campaign_id,
			'to_mobile_no' => $mobile_no,
            'sms_text' => $message,
            'dlr_status' => $dlr,
            'error_text' => $error_text
		);

		$this->db->set('sent_on', 'NOW()', FALSE);  
		$this->db->insert('campaigns_to', $values);
	}*/
	
	function scheduledCampaignTo($campaign_id,$sms_text,$mobile_no)
	{
		$values = array(
			'campaign_id' => $campaign_id,
			'sms_text' => $sms_text,
			'to_mobile_no' => $mobile_no
		);
		$this->db->set('created_on', 'NOW()', FALSE);
		$this->db->insert('schedule_campaigns_to', $values);
	}
	
	function scheduledCampaignTo1($data)
	{
		
		//print_r($data); 
		//$unique_msg_id = $this->get_unique();
		//$data['unique_msg_id'] = $unique_msg_id;
		$this->db->insert_batch('schedule_campaigns_to', $data); 
		//echo $this->db->last_query();
		//exit;
		
		
		
	}
	
	function deductSMSCredits($userId, $sms_length)
	{
		$this->db->query("update users set available_credits = available_credits - $sms_length where user_id='$userId'");
		
		
		$curdate = date('Y-m-d H:i:s');	
$query_text="update users set available_credits = available_credits - $sms_length where user_id='$userId'";
$errorlog_balancecheck="/var/www/vhosts/www.smsstriker.com/htdocs/balance_logs/deducted_log/balance_deduction_".date("Ymd").".log";
//error_log("| Query : $query_text date & time : $curdate |"."\n",3,$errorlog_balancecheck);
		
		
	}
	
	function checkCountry($to_mobile,$AllowedCountry){
		$validNos[] = array();
		// AllowedCountry format |countrycode1|countrycode2|countrycode3|.....n so on
	    for($i=0; $i<count($to_mobile); $i++) 
		 {
			 $tmp_number = trim($to_mobile[$i]);
			 if((strlen($tmp_number) >= 6 and strlen($tmp_number)<=16)) {
				 if(strcmp($AllowedCountry,"*")==0){
					 $validNos[]=$tmp_number;
				 }
				else{
					$str1 = "|".substr($tmp_number, 0, 4)."|";
					$str2 = "|".substr($tmp_number, 0, 3)."|";
					$str3 = "|".substr($tmp_number, 0, 2)."|";
					$str4 = "|".substr($tmp_number, 0, 1)."|";
					
					$pos1 = strpos($AllowedCountry,$str1);
					$pos2 = strpos($AllowedCountry,$str2);
					$pos3 = strpos($AllowedCountry,$str3);
					$pos4 = strpos($AllowedCountry,$str4);

					if($pos1 || $pos2 || $pos3 || $pos4){
						$validNos[]=$tmp_number;
					}
				}
			 }
		 }
 
         return $validNos;	
	}
	
	function IsCountry($mobile,$AllowedCountry){
	     if(!(strlen($mobile) >= 6 and strlen($mobile)<=17))  return true;
		 if(strcmp($AllowedCountry,"*")==0) return false; //AllowedCountry * means all countries are allowed
		 // AllowedCountry format |countrycode1|countrycode2|countrycode3|.....n so o
			$str1 = "|".substr($mobile, 0, 4)."|";
			$str2 = "|".substr($mobile, 0, 3)."|";
			$str3 = "|".substr($mobile, 0, 2)."|";
			$str4 = "|".substr($mobile, 0, 1)."|";
					
			$pos1 = strpos($AllowedCountry,$str1);
			$pos2 = strpos($AllowedCountry,$str2);
			$pos3 = strpos($AllowedCountry,$str3);
			$pos4 = strpos($AllowedCountry,$str4);

			if($pos1 || $pos2 || $pos3 || $pos4){
				return false;
			}
		return true;
	}
	function Validnumbers($to_mobile)
    {
         //$validNos[] = array();
         for($i=0; $i<count($to_mobile); $i++) 
		 {
		     $tmp_number = trim($to_mobile[$i]);
		     if(strlen($tmp_number) == 10)	
			 	 $validNos[]=$tmp_number;
		 }
 
         return $validNos;
    }
	function duplicate($username,$sms_text,$sender,$mobile_no)
    {
		$count = 0;
		for($i=0; $i<count($mobile_no); $i++) 
		 {
		 	$text1 = '';	
		 	$textmd5 = '';
			$text1=$username.$sms_text.$sender.$mobile_no[$i];
			$textmd5=md5($text1);
			//$this->db->where('md5text',$textmd5);
			$this->db->select()
			->from('duplicatecheck')
			->where('md5text',$textmd5);
		    if($this->db->count_all_results()){
				$count++;
			}
		}
		return $count;
			//return $this->db->count_all_results('duplicatecheck');
		   // echo $this->db->count_all_results('duplicatecheck');
	} 
	
    function Nonduplicate($username,$sms_text,$sender,$mobile_no)
    {
		$count = 0;
		for($i=0; $i<count($mobile_no); $i++) 
		 {
		 	$text1 = '';	
		 	$textmd5 = '';
			$text1=$username.$sms_text.$sender.$mobile_no[$i];
			$textmd5=md5($text1);
			//$this->db->where('md5text',$textmd5);
			$this->db->select()
			->from('duplicatecheck')
			->where('md5text',$textmd5);
		    if($this->db->count_all_results()){
				$count++;
			}
		}
		return $count;
			//return $this->db->count_all_results('duplicatecheck');
		    //echo $this->db->count_all_results('duplicatecheck');
	}
    function isValidNo($mobile_no)
    {
    	$validNoCount=1;
    	$tmp_number = trim($mobile_no);
		if(strlen($tmp_number) > 7 and strlen($tmp_number)<=10 )
		{
			if($tmp_number[0]=='7' or $tmp_number[0]=='8' or $tmp_number[0]=='9' )
			{
				
			}
			 $validNoCount=0;
			//echo  $tmp_number."-valid";	
		}	
		
		
			 
			 	 
       return $validNoCount; 
    }
    
	function addSMSCredits($userId, $no_of_sms)
	{
		$this->db->query("update users set available_credits = available_credits + $no_of_sms where user_id='$userId'");
		
		
$curdate = date('Y-m-d H:i:s');	
$query_text="update users set available_credits = available_credits + $no_of_sms where user_id='$userId'";
$errorlog_balancecheck="/var/www/vhosts/www.smsstriker.com/htdocs/balance_logs/added_log/balance_added_".date("Ymd").".log";
error_log("| Query : $query_text date & time : $curdate |"."\n",3,$errorlog_balancecheck);

	}
	
	
	function getAllCampaigns($user_id, $from_date, $to_date, $offset = NULL, $limit = NULL)
	{
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id)
			->where('campaign_status !=','3')
			->where('created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');
		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}			
			
		$this->db->order_by('created_on','desc')
			->limit($limit, $offset);
		$rs = $this->db->get();
		return $rs->result();			
	}
	
	
	function get_campaigns_count1($user_id,$sender,$status_,$from_date, $to_date,$offset = NULL, $limit = NULL)
	{
		$this->db->where('user_id',$user_id)
			->where('campaign_status !=','3')
		->where('created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}
		if($sender) {
			$this->db->where('sender_name',"$sender");
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
$this->db->order_by('created_on','desc')
			->limit($limit, $offset);
	//echo $this->db->last_query();
	//echo "<br>";
	//print_r($this->db->count_all_results('campaigns'));
		return $this->db->count_all_results('campaigns');		
	}
	
	function getAllCampaigns1($user_id, $sender,$from_date,$to_date,$off_set=NULL,$limit=NULL)
	{
		//echo $off_set;
		//echo $to_date;
		//echo $user_id;
		//echo $sender;
		//echo "<br>";
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id)
			->where('campaign_status !=','3')
			    ->where('created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');
		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}			
		if($sender) {
			//echo "RRR".$sender;
			$this->db->where('sender_name',"$sender");
		}	
	
	
		$this->db->order_by('created_on','desc')
			->limit($limit, $off_set);
		$rs = $this->db->get();
		//echo $this->db->last_query();
		//echo "<br>";
		//echo '<pre>',print_r($rs->result(),1),'</pre>';
		
		return $rs->result();			
	}
	
	

	
	
	
	function get_campaigns_report($user_id, $from_date, $to_date)
	{
		$query =$this->db->query("select sum(no_of_messages) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald ,count(campaign_status=0) as processcnt from campaigns where user_id=$user_id and date(created_on)>='$from_date' and date(created_on)<='$to_date' and created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH) order by created_on desc ");
return   $row = $query->result_array(); 

	}
	function get_campaigns_report_default($user_id)
	{
		$query =$this->db->query("select sum(no_of_messages) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald,count(campaign_status=0) as processcnt from campaigns where user_id=$user_id and created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH) order by created_on desc ");
		return   $row = $query->result_array(); 
	}
	

	function get_scheduled_campaigns_count($user_id, $from_date, $to_date)
	{
		$this->db->where('user_id',$user_id)
			->where('is_scheduled','1')
			->where('campaign_status','1');
		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}
		return $this->db->count_all_results('campaigns');		
	}
	
	function get_scheduled_campaigns($user_id, $from_date, $to_date, $offset = NULL, $limit = NULL)
	{
		$this->db->select()
			->from('campaigns')
			->where('user_id', $user_id)
			->where('is_scheduled','1')
			->where('campaign_status','1');
		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}
		
		$this->db->order_by('created_on','asc')
			->limit($limit, $offset);
		$rs = $this->db->get();
		return $rs->result();
			
	}
	
	function update_campaign_status($campaign_id, $status)
	{
		$data = array('campaign_status' => $status);
		$this->db->where('campaign_id', $campaign_id);
		$this->db->update('campaigns',$data);
	}
	
	function update_campaign_sample_text($campaign_id, $sms_text_sample)
	{
		$data = array('sms_text_sample' => $sms_text_sample);
		$this->db->where('campaign_id', $campaign_id);
		$this->db->update('campaigns',$data);
	}
	
	function get_campaign_details($campaign_id, $user_id)
	{
		$this->db->select()
			->from('campaigns')
			->where('campaign_id',$campaign_id)
			->where('user_id',$user_id);
		//->where('created_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		$rs = $this->db->get();
		return $rs->result();
	}
	
	function getSendingPort()
	{
		$this->db->select('sending_port_no')
			->from('sms_queue')
			->where('application_priority','FP2')
			->order_by('queued','asc')
			->limit(1);
		$rs = $this->db->get();
		foreach ($rs->result() as $row)
		{
    		$sending_port = $row->sending_port_no;
		}

		return $sending_port;
	}
	
	function getFirstPriorityPort($port_type)
	{
		$sending_port = 0; 
		$this->db->select('sending_port_no')
			->from('sms_queue')
			->where('application_priority',$port_type)
			->order_by('queued','asc')
			->limit(1);	
			
		$rs = $this->db->get();
		//return $this->db->last_query();
		foreach ($rs->result() as $row)
		{
    		$sending_port = $row->sending_port_no;
		}
		return $sending_port;
	}
	
	function get_campaign_numbers($campaign_id, $days_diff, $campaign_ondate)
	{
		if($days_diff <= 1) {
			$table_name = "sms.campaigns_to";
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.campaigns_to_".$month.$year;
		}

		$this->db->select('sms_text,to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
			->from($table_name)
			->where('campaign_id', $campaign_id)
		//->where('YEAR(sent_on)=YEAR(CURDATE())')
		//->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)')


			->order_by('sent_on','desc');
			
		$rs = $this->db->get();
		 $this->db->last_query();
		return $rs->result();
	}
	
	
	function get_total_sms_api_count($user_id, $from_date, $to_date)
	{
		$query = "select distinct date(ondate) as ondate,sum(noofmessages) as noofmsg from sms_api_messages where user_id='$user_id' and ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		
		
		if($from_date) {
			$query .= " and date(ondate) >= '$from_date'";
		}
		if($to_date) {
			$query .= " and date(ondate) <= '$to_date'";
		}
		$query .= " group by date(ondate) order by date(ondate) desc";
		$rs = $this->db->query($query);
		return count($rs->result());		
	}
	
	/************************* sms api mobile number search *******************************/
          function get_sms_api_mobileno_search($campaignapidate,$user_id,$days_diff,$mobileno)
	{
        if($days_diff <= 1){
            $table_name = "sms.sms_api_messages";
        } else {
            $year = substr($campaignapidate,0,4);
            $month = substr($campaignapidate,5,2);
            $table_name = "campaigns_backup.sms_api_messages_".$month.$year;
        }
$this->db->select('ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text')
			->from($table_name)
			->where('user_id',$user_id)
                        ->where('to_mobileno',$mobileno)
			->where('date(ondate)',$campaignapidate);
			$this->db->order_by('ondate','desc');
		$rs = $this->db->get();
      // echo $this->db->last_query();
		return $rs->result();
	}

  

	function get_SMS_API_Reports($user_id,$from_date,$to_date)
	{
		$query = "select distinct date(ondate) as ondate,sum(noofmessages) as noofmsg from sms_api_messages where user_id='$user_id' and ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		
		
		if($from_date) {
			$query .= " and date(ondate) >= '$from_date'";
		}
		if($to_date) {
			$query .= " and date(ondate) <= '$to_date'";
		}
		$query .= " group by date(ondate) order by date(ondate) desc";
		$rs = $this->db->query($query);
		//return $this->db->last_query();
		return $rs->result();
	}
	
	function get_sms_api_details($ondate,$user_id,$days_diff)
	{
		if($days_diff <= 1){
		    $table_name = "sms.sms_api_messages";
		} else {
		    $year = substr($ondate,0,4);
		    $month = substr($ondate,5,2);
		    $table_name = "campaigns_backup.sms_api_messages_".$month.$year;
		}
		$this->db->select('ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text')
			->from($table_name)
			->where('user_id',$user_id)
			->where('date(ondate)',$ondate);
			$this->db->order_by('ondate','desc');
		$rs = $this->db->get();
		  //return $this->db->last_query();
		return $rs->result();
	}
	
	function get_counts_api($ondate,$user_id,$days_diff)
	{
        if($days_diff <= 1){
            $table_name = "sms.sms_api_messages";
        } else {
            $year = substr($ondate,0,4);
            $month = substr($ondate,5,2);
            $table_name = "campaigns_backup.sms_api_messages_".$month.$year;
        }
		$this->db->select('ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text')
			->from($table_name)
			->where('user_id',$user_id)
			->where('date(ondate)',$ondate);
		$rs = $this->db->get();

		return $this->db->count_all_results($table_name);
	}
	function getTotalNumbersCount($campaign_id, $days_diff, $campaign_ondate)
	{
		if($days_diff <= 1) {
			$table_name = "sms.campaigns_to";
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.campaigns_to_".$month.$year;
		}
		$this->db->where('campaign_id',$campaign_id);
$this->db->where('sent_on >= DATE_SUB(NOW(),INTERVAL 6 MONTH)');

		return $this->db->count_all_results($table_name);
	}
	
	function getCampaignNumbers($campaign_id, $mobile_no, $days_diff, $campaign_ondate, $offset = NULL, $limit = NULL)
	{
		if($days_diff <= 1) {
			$table_name = "sms.campaigns_to";
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.campaigns_to_".$month.$year;
		}

		$this->db->select('to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
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
	}
	
	function get_total_sms_api_days($user_id,$from_date,$to_date)
	{
		$query = "select on_date,sms_count from sms_api_daily_count where user_id='$user_id' and on_date >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		
		
		if($from_date) {
			$query .= " and on_date >= '$from_date'";
		}
		if($to_date) {
			$query .= " and on_date <= '$to_date'";
		}
		$query .= " order by on_date desc";
		$rs = $this->db->query($query);
		return count($rs->result());
	}
	 
	 
	function get_sms_api_days($user_id,$from_date,$to_date,$offset,$limit)
	{
		

		$query = "select * from sms_api_daily_count where user_id='$user_id' and on_date >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		if($from_date) {
			$query .= " and on_date >='$from_date'";
		}
		if($to_date) {
			$query .= " and on_date <='$to_date'";
		}
			
		
		$query .= " order by on_date desc limit $offset,$limit";
		$rs = $this->db->query($query);
	     //return $this->db->last_query();

		return $rs->result();
	}

    function get_templates($user_id)
    {
        $this->db->select('template')
            ->from('templates')
            ->where('status', 2)    
            ->where('user_id', $user_id);

        $rs = $this->db->get();
        return $rs->result();         
    }

    function checkIsDND($mobile_no)
    {
	// Updated on 2017-02-5
	$num_series = substr($mobile_no,0,1);  
	$table_name = 'dnd_db.'.$num_series.'_series';
        $table_check = $num_series.'_series';
 	// Updated on 2017-02-09
	$check_table_exists_query = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dnd_db' AND TABLE_NAME = '".$table_check."'"); 
 	$rs = '';
 	if($check_table_exists_query->num_rows() > 0)  { 
		$this->db->where('dnc_number', $mobile_no); 
		//$rs=  $this->db->count_all_results('dnd_db.ndnc_data');
		$rs =  $this->db->count_all_results($table_name);
	}

	return $rs;  

    }

    function isBlockListed($mobile_no)
    {
        $this->db->where('mobile_no', $mobile_no);
        return $this->db->count_all_results('block_listed_numbers');
    }
    function checkduplicate($username,$sms_text,$sender,$mobile_no)
    {
		$text1=$username.$sms_text.$sender.$mobile_no;
		$textmd5=md5($text1);
		$this->db->where('md5text',$textmd5);
		$rs = $this->db->count_all_results('duplicatecheck');
		if($rs){
			return true;
		}else{
			$this->db->set('datetime', 'NOW()', FALSE);
			$data=array('md5text'=>$textmd5);
			$this->db->insert('duplicatecheck',$data);
			return false;
		}
	}
    
	function get_scheduled_campaign_details($campaign_id)
	{
		$this->db->select()
			->from('campaigns')
			->where('campaign_id',$campaign_id);
				$rs = $this->db->get();
		return $rs->result();
	}
	
	function UpdateScheduleCampaign($campaign_id,$on_date)
	{
		$this->db->query("update campaigns set scheduled_on = '$on_date' where campaign_id='$campaign_id'");
	}
	function get_operator_areadetails($mobile_number)
	{
		$this->db->select()
			->from('series_wise')
			->where('Number_Starts_With',$mobile_number);
				$rs = $this->db->get();
		return $rs->result();
	}
	
	function get_search_results($user_id, $from_date,$to_date, $campaign_ids,$status_,$mobile_no_)
	{
		
		$months_tmp = $this->get_months($from_date,$to_date);
		//print_r($months_tmp);
		$union_query='';
		//$query_='where 1 ';
		$query_groupby='';
		$query_select='';
		for($i=0; $i<sizeof($months_tmp); $i++) 
		{
			$query_='';
			//echo $months_tmp[$i];
			$tableName="campaigns_backup.campaigns_to_".$months_tmp[$i];
			
			if($campaign_ids!="")
				$query_.=" and campaign_id in ( $campaign_ids ) ";
			else
				$query_.=" and campaign_id in (0) ";
			
			/*if($status_!="all")
				$query_.="  and error_code='".$status_."' ";*/
			
			if($mobile_no_)
			{
				$query_select="SELECT count(*) as cnt,error_text, error_code,dlr_status from ";
				$query_.="  and to_mobile_no='".$mobile_no_."' ";
				$query_groupby=' group by  error_code ,error_text';
			}
			else
			{
				$query_select="SELECT count(*) as cnt,error_text, error_code,dlr_status from ";
				$query_groupby=' group by  error_code ,error_text';
			}
			
			$tmp_query=$query_select.$tableName." where 1 ".$query_.$query_groupby;
			
			if($i==0)
				$union_query=$union_query.$tmp_query;
			else
				$union_query=$union_query." UNION ALL ".$tmp_query;
	
		}
		//echo $union_query;
		$rs = $this->db->query($union_query);
		return $rs->result(); 
	}
	
	function get_search_results_download($user_id, $from_date,$to_date, $campaign_ids,$status_,$mobile_no_)
	{
		
		$months_tmp = $this->get_months($from_date,$to_date);
		//print_r($months_tmp);
		$union_query='';
		//$query_='where 1 ';
		$query_groupby='';
		$query_select='';
		for($i=0; $i<sizeof($months_tmp); $i++) 
		{
			$query_='';
			//echo $months_tmp[$i];
			$tableName="campaigns_backup.campaigns_to_".$months_tmp[$i];
			
			if($campaign_ids!="")
				$query_.=" and campaign_id in ( $campaign_ids ) ";
			else
				$query_.=" and campaign_id in (0) ";
			
			
			
			if($mobile_no_)
			{
				$query_select="SELECT campaign_id ,to_mobile_no,sms_text,sent_on,dlr_status,error_code,error_text,delivered_on from ";
				$query_.="  and to_mobile_no='".$mobile_no_."' ";
				//$query_groupby=' group by  error_code ,error_text';
			}
			else
			{
				$query_select="SELECT campaign_id ,to_mobile_no,sms_text,sent_on,dlr_status,error_code,error_text,delivered_on from ";
				//$query_groupby=' group by  error_code ,error_text';
			}
			
			$tmp_query=$query_select.$tableName." where 1 ".$query_.$query_groupby;
			
			if($i==0)
				$union_query=$union_query.$tmp_query;
			else
				$union_query=$union_query." UNION ALL ".$tmp_query;
	
		}
//		echo "UNION QUERY : ".$union_query;
		$rs = $this->db->query($union_query);
		return $rs->result();
	}
	
	
	function get_months($date1, $date2) 
	{  
	  $time1  = strtotime($date1);  
      $time2  = strtotime($date2);  
      $my     = date('n-Y', $time2);  
      $mesi = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
    
	   //$months = array(date('F', $time1));  
	   $months = array();  
	   $f      = '';  
	
	   while($time1 < $time2) {  
		  if(date('n-Y', $time1) != $f) {  
			 $f = date('n-Y', $time1);  
			 if(date('n-Y', $time1) != $my && ($time1 < $time2)) { 
				 $str_mese=$mesi[(date('n', $time1)-1)]; 
				$months[] = $str_mese."".date('Y', $time1);  
			 } 
		  }  
		  $time1 = strtotime((date('Y-n-d', $time1).' +15days'));  
	   }  
	
	   $str_mese=$mesi[(date('n', $time2)-1)]; 
	   $months[] = $str_mese."".date('Y', $time2);  
	   return $months;
		}  

	
	function array_sum_combine($arr1)
	{

	  $return = array();
	  $args = func_get_args();
	  foreach ($args as $arr)
	  {
		foreach ($arr as $k => $v)
		{
			
		  if (!array_key_exists($k, $return))
		  {
			$return[$k] = 0;
		  }
		  $return[$k] += $v;
		}
	  }
	  return $return;
	}
	
	public function getAllCampaignsSearchValues($limit, $off_set, $user_id, $sn, $from_date, $to_date)
	{
		
		$this->db->select() 
			->from('campaigns')
			->where('user_id',$user_id)
			->where('campaign_status !=','3');
			    //->where('created_on >= DATE_SUB(NOW(),INTERVAL 1 YEAR)');
		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}			
		if($sn) {
			//echo "RRR".$sender;
			//$this->db->where('sender_name', $sn);
			$this->db->where('sender', $sn);
		}	
			$this->db->order_by('created_on','desc')
			->limit($limit, $off_set);
		$rs = $this->db->get();
			//return $this->db->last_query();
			return $rs->result();





	
	}

public function get_aftersearch_campaigns_report($user_id, $sender_name, $fd, $td)
	{
		
		$this->db->select('sum(no_of_messages) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald,count(campaign_status=0) as processcnt')
			->from('campaigns')
			->where('user_id',$user_id)
			->where('created_on >= DATE_SUB(NOW(),INTERVAL 1 YEAR)');
			if($fd) {
			$this->db->where('date(created_on)>=',"$fd");
			}
			if($td) {
			$this->db->where('date(created_on)<=',"$td");
			}			
			if($sender_name) {
			$this->db->where('sender_name', $sender_name);
			}	
			$this->db->order_by('created_on','desc');
			$rs = $this->db->get();
			//echo $this->db->last_query();
			return $rs->result_array();



	}



	public function get_all_smsreports_basedoncampaign($campaign_id,$days_diff,$campaigndate)
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
		FROM campaigns_to WHERE campaign_id='$campaign_id'";
		$rs = mysql_query($query);       
		$val = mysql_fetch_array($rs);
		return $val;

		}
		else{
		
$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count FROM campaigns where campaign_id=$campaign_id";
			$campaigns = mysql_query($sql);
			$campaigns_value = mysql_fetch_array($campaigns);
			return $campaigns_value;
			
		}
	}

	public function get_all_smsreports($user_id,$from_date,$to_date)
	{
		$condition = "";
		if($from_date!='' && $to_date!='')
		{
			$condition = " AND date(created_on) >= '$from_date' AND date(created_on) <= '$to_date'";
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
			$campaigns_query = "select campaign_id from campaigns where is_scheduled = 0 AND user_id in($users) $condition";
		}
		else
		{
			$campaigns_query = "select campaign_id,user_id from campaigns where is_scheduled = 0 and date(created_on) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id in($users)";
		}
		$campaigns_rs = $this->db->query($campaigns_query);

		if($campaigns_rs->num_rows() > 0) 
		{
			$result_array = $campaigns_val->result_array();
			//while($campaigns_val = mysql_fetch_array($campaigns_rs)) 
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
				    FROM campaigns_to WHERE campaign_id='$campaign_id'";
			       
				$rs = $this->db->query($query);       
				$val = $rs->result_array();
				
				$delivered_count = $delivered_count + $val['delivered_count'];
				$expired_count = $expired_count + $val['expired_count'];
				$dnd_count = $dnd_count + $val['dnd_count'];
				$pending_dlr_count = $pending_dlr_count + $val['pending_dlr_count'];
				$invalid_count = $invalid_count + $val['invalid_count'];
			}
		}
		
		$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count FROM campaigns where user_id in($users) $condition";
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
	
	public function get_all_users($user_id)
	{
		$users_list = "SELECT user_id,username AS users FROM users WHERE reseller_id ='$user_id'";	
		$rs = $this->db->query($users_list);
		return $rs->result();
	}
	
	public function get_usersms_download($user_id,$from_date,$to_date)
	{

		 $xy = 0;
		$condition = "";
		if($from_date!='' && $to_date!='')
		{
			$condition = " AND date(created_on) >= '$from_date' AND date(created_on) <= '$to_date'";
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
			$users_list = $this->db->query("SELECT user_id AS users FROM users WHERE reseller_id ='$user_id'");
			if($users_list->num_rows()  > 0)
			{
				$user_lst = $users_list->result_array();
				foreach($user_lst as $res)
				{
					$users = $res['users'];
			
					if($from_date!='' && $to_date!='')
					{	
						$campaigns_query = "select campaign_id from campaigns where is_scheduled = 0 AND user_id in($users) $condition";
					}
					else
					{
						$campaigns_query = "select campaign_id,user_id from campaigns where is_scheduled = 0 and date(created_on) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id in($users)";
					}
					$campaigns_rs = $this->db->query($campaigns_query);
					$j = 0;
					if($campaigns_rs->num_rows() > 0) 
					{
						$campaign_value = $campaigns_rs->result_array();
						foreach($campaign_value as $campaigns_val) 
						{
							$campaign_id = $campaigns_val['campaign_id'];
						       
							//counts
							$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
							    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
							    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
							    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
							    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on 
							    FROM campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
						       
							$rs = $this->db->query($query);       
							$val = $rs->result_array();
				
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
					
					$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,created_on FROM campaigns where user_id in($users) $condition group by date(created_on)";
					$campaigns = $this->db->query($sql);
					$i = 0;
					if($campaigns->num_rows() > 0) 
					{
						$campaign_val = $campaigns->result_array();
						foreach($campaign_val as $campaigns_value ) 
						{
							$delivered_count = $campaigns_value['delivered_count'];
							$expired_count = $campaigns_value['expired_count'];
							$dnd_count = $campaigns_value['dnd_count'];
							$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
							$invalid_count = $campaigns_value['invalid_count'];
							
							$date = $campaigns_value['created_on'];
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
					$campaigns_query = "select campaign_id from campaigns where is_scheduled = 0 AND user_id in($user_id) $condition";
				}
				else
				{
					$campaigns_query = "select campaign_id,user_id from campaigns where is_scheduled = 0 and date(created_on) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id in($user_id)";
				}
				$campaigns_rs = $this->db->query($campaigns_query);
				$k = 0;
				if($campaigns_rs->num_rows() > 0) 
				{
					$campaigns_value = $campaigns_rs->result_array();
					foreach($campaigns_value as $campaigns_val) 
					{
						$campaign_id = $campaigns_val['campaign_id'];
					       
						//counts
						$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
						    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
						    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
						    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
						    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on
						    FROM campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
					       
						$rs = $this->db->query($query);       
						$val = $rs->result_array();
			
						$delivered_count = $val['delivered_count'];
						$expired_count = $val['expired_count'];
						$dnd_count = $val['dnd_count'];
						$pending_dlr_count = $val['pending_dlr_count'];
						$invalid_count = $val['invalid_count'];
						
						$sent_date = $val['sent_on'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total_rows[$k] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
					$k++;
					}
				}
	
				$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,created_on FROM campaigns where user_id in($user_id) $condition group by date(created_on)";
				$campaigns = $this->db->query($sql);
				$m = 0;
				if($campaigns->num_rows() > 0) 
				{
					$campaigns_val = $campaigns->result_array();
					foreach($campaigns_val as $campaigns_value) 
					{
						$delivered_count = $campaigns_value['delivered_count'];
						$expired_count = $campaigns_value['expired_count'];
						$dnd_count = $campaigns_value['dnd_count'];
						$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
						$invalid_count = $campaigns_value['invalid_count'];
						
						$date = $campaigns_value['created_on'];
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
					$campaigns_query = "select campaign_id from campaigns where is_scheduled = 0 AND user_id = '$user_id' $condition";
				}
				else
				{
					$campaigns_query = "select campaign_id,user_id from campaigns where is_scheduled = 0 and date(created_on) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id = '$user_id'";
				}
				$campaigns_rs = $this->db->query($campaigns_query);

				$y = 0;
				if($campaigns_rs->num_rows() > 0) 
				{
					$campaigns_res = $campaigns_rs->result_array();
					foreach($campaigns_res as $campaigns_val) 
					{
						$campaign_id = $campaigns_val['campaign_id'];
					       
						//counts
						$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
						    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
						    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
						    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
						    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on
						    FROM campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
					       
						$rs = $this->db->query($query);       
						$val = $rs->result_array();
			
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
	
				$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,created_on FROM campaigns where user_id = '$user_id' $condition group by date(created_on)";
				$campaigns = $this->db->query($sql);
				$z = 0;
				if($campaigns->num_rows() > 0) 
				{
					$campaigns_val = $campaigns->result_array();
					foreach($campaigns_val as $campaigns_value) 
					{
						$delivered_count = $campaigns_value['delivered_count'];
						$expired_count = $campaigns_value['expired_count'];
						$dnd_count = $campaigns_value['dnd_count'];
						$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
						$invalid_count = $campaigns_value['invalid_count'];
						$date = $campaigns_value['created_on'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
						$total_rows12[$z] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
						$z++;
					}
				}
				$rows = array_merge($total_rows13,$total_rows12);
				return $rows;
			}
		}else
		{
 
			$total_rows12 = array();
			$total_rows13 = array();
			if($from_date!='' && $to_date!='')
			{	
				$campaigns_query = "select campaign_id from campaigns where is_scheduled = 0 AND user_id = '$user_id' $condition";
			}
			else
			{
				$campaigns_query = "select campaign_id,user_id from campaigns where is_scheduled = 0 and date(created_on) >= ( CURDATE() - INTERVAL 1 DAY ) AND user_id = '$user_id'";
			}
			$campaigns_rs = $this->db->query($campaigns_query);

			$y = 0;
			if($campaigns_rs->num_rows() > 0) 
			{
				$campaigns_res = $campaigns_rs->result_array();
				foreach($campaigns_res as $campaigns_val) 
				{
					$campaign_id = $campaigns_val['campaign_id'];
				       
					//counts
					$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status =0 THEN to_mobile_no END)) as pending_dlr_count,
					    count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
					    count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
					    count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
					    count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count,sent_on
					    FROM campaigns_to WHERE campaign_id='$campaign_id' group by date(sent_on)";
				       
					$rs = $this->db->query($query);       
					$val = $rs->result_array();
			
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
	
			$sql = "SELECT sum(pending_dlrs_count) AS pending_dlrs_count,sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,created_on FROM campaigns where user_id = '$user_id' $condition group by date(created_on)";
			$campaigns = $this->db->query($sql);
			$z = 0;
			if($campaigns->num_rows() > 0) 
			{
				$campaigns_val = $campaigns->result_array();
				foreach($campaigns_val as $campaigns_value) 
				{
					$delivered_count = $campaigns_value['delivered_count'];
					$expired_count = $campaigns_value['expired_count'];
					$dnd_count = $campaigns_value['dnd_count'];
					$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
					$invalid_count = $campaigns_value['invalid_count'];
					$date = $campaigns_value['created_on'];
					$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
					
					$total_rows12[$z] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
					$z++;
				}
			}
			$rows = array_merge($total_rows13,$total_rows12);
			return $rows;
		}
 
	}
	
	function get_username_download($user_id)
	{
		$this->db->select('username')
			->from('sms.users')
			->where('user_id',$user_id);
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();	 		
	}
	
	
//	================= model funtions API MIS Report start==============
		
		
	public function get_all_api_smsreports($user_id,$from_date,$to_date)
	{
		//date_default_timezone_set('asia/kolkata');
		//$today_date = date("Y-m-d");
		//$last_date = date('Y-m-d',strtotime("-2 days"));
		
		$condition = "";
		$condition1 = "";
		if($from_date!='' && $to_date!='')
		{
			$condition = " AND date(on_date) >= '$from_date' AND date(on_date) <= '$to_date'";
			$condition1 = " AND date(ondate) >= '$from_date' AND date(ondate) <= '$to_date'";
		}
		
		
		$delivered_count = 0;
		$expired_count = 0;
		$dnd_count = 0;
		$pending_dlr_count = 0;
		$invalid_count = 0;
		
		$delivered_count1 = 0;
		$expired_count1 = 0;
		$dnd_count1 = 0;
		$pending_dlr_count1 = 0;
		$invalid_count1 = 0;
		$total_sms = 0;
			
		$users_list = mysql_query("SELECT group_concat(user_id) AS users FROM users WHERE reseller_id ='$user_id'");
		$res = mysql_fetch_array($users_list);
		$users = $res['users'];
		
		if($users != NULL)
		{
			$users = $res['users'].','.$user_id;
		}
		else
		{
			$users = $user_id;
		}
			
		if($from_date!='' && $to_date!='')
		{
			//counts
			$query = "SELECT
			    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
			    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
			    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,

			    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
			    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count
			    FROM sms_api_messages WHERE user_id in($users) $condition1";
		       
			$rs = mysql_query($query);       
			$val = mysql_fetch_array($rs);
		
			$delivered_count = $delivered_count + $val['delivered_count'];
			$expired_count = $expired_count + $val['expired_count'];
			$dnd_count = $dnd_count + $val['dnd_count'];
			$pending_dlr_count = $pending_dlr_count + $val['pending_dlr_count'];
			$invalid_count = $invalid_count + $val['invalid_count'];
		}	
		else
		{
			//counts
			$query = "SELECT
			    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
			    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
			    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,

			    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
			    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count
			    FROM sms_api_messages WHERE user_id in($users) AND date(ondate) >= ( CURDATE() - INTERVAL 1 DAY )";
		       
			$rs = mysql_query($query);       
			$val = mysql_fetch_array($rs);
		
			$delivered_count = $delivered_count + $val['delivered_count'];
			$expired_count = $expired_count + $val['expired_count'];
			$dnd_count = $dnd_count + $val['dnd_count'];
			$pending_dlr_count = $pending_dlr_count + $val['pending_dlr_count'];
			$invalid_count = $invalid_count + $val['invalid_count'];
		}
		
		$sql = "SELECT sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,sum(sms_count) AS total_sms FROM sms_api_daily_count where user_id in($users) $condition";
		$campaigns = mysql_query($sql);
		
		if(mysql_num_rows($campaigns) > 0) 
		{
			while($campaigns_value = mysql_fetch_array($campaigns)) 
			{
				$delivered_count = $delivered_count + $campaigns_value['delivered_count'];
				$expired_count = $expired_count + $campaigns_value['expired_count'];
				$dnd_count = $dnd_count + $campaigns_value['dnd_count'];
				$total_sms = $total_sms + $campaigns_value['total_sms'];
				//$pending_dlr_count = $pending_dlr_count + $campaigns_value['pending_dlrs_count'];
				$invalid_count = $invalid_count + $campaigns_value['invalid_count'];
				
				$delivered_count1 = $delivered_count1 + $campaigns_value['delivered_count'];
				$expired_count1 = $expired_count1 + $campaigns_value['expired_count'];
				$dnd_count1 = $dnd_count1 + $campaigns_value['dnd_count'];
				$invalid_count1 = $invalid_count1 + $campaigns_value['invalid_count'];
			}
		}
		$pending_dlr = $delivered_count1 + $expired_count1 + $dnd_count1 + $invalid_count1;
		$pending_dlr_count1 = ($total_sms - $pending_dlr) + $pending_dlr_count;
		
		$total_rows = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count1.",".$invalid_count;

		$valu = explode(",",$total_rows);
		return $valu;
	}
	
	
	
	
	
public function get_userapi_download($user_id,$from_date,$to_date)
	{
		$xy = 0;
		$condition = "";
		$condition1 = "";
		if($from_date!='' && $to_date!='')
		{
			$condition = " AND date(on_date) >= '$from_date' AND date(on_date) <= '$to_date'";
			$condition1 = " AND date(ondate) >= '$from_date' AND date(ondate) <= '$to_date'";
		}
		
		$delivered_count = 0;
		$expired_count = 0;
		$dnd_count = 0;
		$pending_dlr_count = 0;
		$invalid_count = 0;
		
		$delivered_count1 = 0;
		$expired_count1 = 0;
		$dnd_count1 = 0;
		$pending_dlr_count1 = 0;
		$invalid_count1 = 0;
		$total_sms = 0;
		
		if($this->session->userdata('agent_id')  == "")	
		{
			$total13 = array();
			$total12 = array();
			$users_list = mysql_query("SELECT user_id AS users FROM users WHERE reseller_id ='$user_id'");
			if(mysql_num_rows($users_list) > 0)
			{
				while($res = mysql_fetch_array($users_list))
				{
					$users = $res['users'];
					if($from_date!='' && $to_date!='')
					{
						//counts
						$query = "SELECT (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
						    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
						    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
						    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
						    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate 
						    FROM sms_api_messages WHERE user_id in($users) $condition1 group by date(ondate)";
					       	    
						$rs = mysql_query($query);       
						//$val = mysql_fetch_array($rs);
						if(mysql_num_rows($rs) > 0)
						{
							while($val = mysql_fetch_array($rs))
							{
								$delivered_count = $val['delivered_count'];
								$expired_count = $val['expired_count'];
								$dnd_count = $val['dnd_count'];
								$pending_dlr_count = $val['pending_dlr_count'];
								$invalid_count = $val['invalid_count'];
								$sent_date = $val['ondate'];
								$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
			
								$total13[$j] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
								$j++;
							}
						}
					}
					else
					{
						//counts
						$query = "SELECT (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
						    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
						    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
						    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
						    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate 
						    FROM sms_api_messages WHERE user_id in($users) AND date(ondate) >= ( CURDATE() - INTERVAL 1 DAY ) group by date(ondate)";
					       	    
						$rs = mysql_query($query);       
						//$val = mysql_fetch_array($rs);
						if(mysql_num_rows($rs) > 0)
						{
							while($val = mysql_fetch_array($rs))
							{
								$delivered_count = $val['delivered_count'];
								$expired_count = $val['expired_count'];
								$dnd_count = $val['dnd_count'];
								$pending_dlr_count = $val['pending_dlr_count'];
								$invalid_count = $val['invalid_count'];
								$sent_date = $val['ondate'];
								$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
			
								$total13[$j] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
								$j++;
							}
						}
					}
		
					$sql = "SELECT sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,sum(sms_count) AS total_sms,on_date FROM sms_api_daily_count where user_id in($users) $condition group by date(on_date)";
					$campaigns = mysql_query($sql);
					$i = 0;
					if(mysql_num_rows($campaigns) > 0) 
					{
						while($campaigns_value = mysql_fetch_array($campaigns)) 
						{
							$delivered_count = $campaigns_value['delivered_count'];
							$expired_count = $campaigns_value['expired_count'];
							$dnd_count = $campaigns_value['dnd_count'];
							$total_sms = $total_sms + $campaigns_value['total_sms'];
							//$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
							$invalid_count = $campaigns_value['invalid_count'];
							
							$delivered_count1 = $delivered_count1 + $campaigns_value['delivered_count'];
							$expired_count1 = $expired_count1 + $campaigns_value['expired_count'];
							$dnd_count1 = $dnd_count1 + $campaigns_value['dnd_count'];
							$invalid_count1 = $invalid_count1 + $campaigns_value['invalid_count'];
							
							$pending_dlr = $delivered_count1 + $expired_count1 + $dnd_count1 + $invalid_count1;
							$pending_dlr_count1 = ($total_sms - $pending_dlr);
							
							$date = $campaigns_value['on_date'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count1 + $invalid_count;
					
					$total12[$i] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
					$i++;
						}
					}
					$total_rows123 = array_merge($total13,$total12);
				}
		
				$total_rows = array();
				$total_rows1 = array();	
				$k = 0;
				if($from_date!='' && $to_date!='')
				{
					//counts
					$query = "SELECT
					    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
					    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
					    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
					    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
					    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate
					    FROM sms_api_messages WHERE user_id in($user_id) $condition1 group by date(ondate)";
				       
					$rs = mysql_query($query);       
					//$val = mysql_fetch_array($rs);
					if(mysql_num_rows($rs) > 0)
					{
						while($val = mysql_fetch_array($rs))
						{
							$delivered_count = $val['delivered_count'];
							$expired_count = $val['expired_count'];
							$dnd_count = $val['dnd_count'];
							$pending_dlr_count = $val['pending_dlr_count'];
							$invalid_count = $val['invalid_count'];
						
							$sent_date = $val['ondate'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
				
							$total_rows[$k] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
							$k++;
						}
					}
				}
				else
				{
					//counts
					$query = "SELECT
					    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
					    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
					    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
					    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
					    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate
					    FROM sms_api_messages WHERE user_id in($user_id) AND date(ondate) >= ( CURDATE() - INTERVAL 1 DAY ) group by date(ondate)";
				       
					$rs = mysql_query($query);       
					//$val = mysql_fetch_array($rs);
					if(mysql_num_rows($rs) > 0)
					{
						while($val = mysql_fetch_array($rs))
						{
							$delivered_count = $val['delivered_count'];
							$expired_count = $val['expired_count'];
							$dnd_count = $val['dnd_count'];
							$pending_dlr_count = $val['pending_dlr_count'];
							$invalid_count = $val['invalid_count'];
						
							$sent_date = $val['ondate'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
				
							$total_rows[$k] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
							$k++;
						}
					}
				}
	
				$sql = "SELECT sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,sum(sms_count) AS total_sms,on_date FROM sms_api_daily_count where user_id in($user_id) $condition group by date(on_date)";
				$campaigns = mysql_query($sql);
				$m = 0;
				if(mysql_num_rows($campaigns) > 0) 
				{
					while($campaigns_value = mysql_fetch_array($campaigns)) 
					{
						$delivered_count = $campaigns_value['delivered_count'];
						$expired_count = $campaigns_value['expired_count'];
						$dnd_count = $campaigns_value['dnd_count'];
						$total_sms = $total_sms + $campaigns_value['total_sms'];
						//$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
						$invalid_count = $campaigns_value['invalid_count'];
						
						$delivered_count1 = $delivered_count1 + $campaigns_value['delivered_count'];
						$expired_count1 = $expired_count1 + $campaigns_value['expired_count'];
						$dnd_count1 = $dnd_count1 + $campaigns_value['dnd_count'];
						$invalid_count1 = $invalid_count1 + $campaigns_value['invalid_count'];
					
						$pending_dlr = $delivered_count1 + $expired_count1 + $dnd_count1 + $invalid_count1;
						$pending_dlr_count1 = ($total_sms - $pending_dlr);
						
						$date = $campaigns_value['on_date'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count1 + $invalid_count;
					
					$total_rows1[$m] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count1.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
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
				$y = 0;
				if($from_date!='' && $to_date!='')
				{
					//counts
					$query = "SELECT
					    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
					    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
					    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
					    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
					    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate
					    FROM sms_api_messages WHERE user_id='$user_id' $condition1 group by date(ondate)";
				       
					$rs = mysql_query($query);       
					//$val = mysql_fetch_array($rs);
					if(mysql_num_rows($rs) > 0)
					{
						while($val = mysql_fetch_array($rs))
						{
							$delivered_count = $val['delivered_count'];
							$expired_count = $val['expired_count'];
							$dnd_count = $val['dnd_count'];
							$pending_dlr_count = $val['pending_dlr_count'];
							$invalid_count = $val['invalid_count'];
							$sent_date = $val['ondate'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
				
							$total_rows13[$y] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
							$y++;
						}
					}
				}
				else
				{
					//counts
					$query = "SELECT
					    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
					    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
					    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
					    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
					    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate
					    FROM sms_api_messages WHERE user_id='$user_id' AND date(ondate) >= ( CURDATE() - INTERVAL 1 DAY ) group by date(ondate)";
				       
					$rs = mysql_query($query);       
					//$val = mysql_fetch_array($rs);
					if(mysql_num_rows($rs) > 0)
					{
						while($val = mysql_fetch_array($rs))
						{
							$delivered_count = $val['delivered_count'];
							$expired_count = $val['expired_count'];
							$dnd_count = $val['dnd_count'];
							$pending_dlr_count = $val['pending_dlr_count'];
							$invalid_count = $val['invalid_count'];
							$sent_date = $val['ondate'];
							$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
				
							$total_rows13[$y] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
							$y++;
						}
					}
				}
	
				$sql = "SELECT sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,sum(sms_count) AS total_sms,on_date FROM sms_api_daily_count where user_id = '$user_id' $condition group by date(on_date)";
				$campaigns = mysql_query($sql);
				$z = 0;
				if(mysql_num_rows($campaigns) > 0) 
				{
					while($campaigns_value = mysql_fetch_array($campaigns)) 
					{
						$delivered_count = $campaigns_value['delivered_count'];
						$expired_count = $campaigns_value['expired_count'];
						$dnd_count = $campaigns_value['dnd_count'];
						$total_sms = $total_sms + $campaigns_value['total_sms'];
						//$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
						$invalid_count = $campaigns_value['invalid_count'];
						
						$delivered_count1 = $delivered_count1 + $campaigns_value['delivered_count'];
						$expired_count1 = $expired_count1 + $campaigns_value['expired_count'];
						$dnd_count1 = $dnd_count1 + $campaigns_value['dnd_count'];
						$invalid_count1 = $invalid_count1 + $campaigns_value['invalid_count'];
					
						$pending_dlr = $delivered_count1 + $expired_count1 + $dnd_count1 + $invalid_count1;
						$pending_dlr_count1 = ($total_sms - $pending_dlr);
						
						$date = $campaigns_value['on_date'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count1 + $invalid_count;
					
						$total_rows12[$z] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count1.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
						$z++;
					}
				}
				$rows = array_merge($total_rows13,$total_rows12);
				return $rows;
			}
		}
		else
		{
			$yz = 0;
			$total_rows12 = array();
			$total_rows13 = array();
				
			if($from_date!='' && $to_date!='')
			{
				//counts
				$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
				    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
				    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
				    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
				    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate
			            FROM sms_api_messages WHERE user_id='$user_id' $condition1 group by date(ondate)";
			       
				$rs = mysql_query($query);       
				//$val = mysql_fetch_array($rs);
				if(mysql_num_rows($rs) > 0)
				{
					while($val = mysql_fetch_array($rs))
					{
						$delivered_count = $val['delivered_count'];
						$expired_count = $val['expired_count'];
						$dnd_count = $val['dnd_count'];
						$pending_dlr_count = $val['pending_dlr_count'];
						$invalid_count = $val['invalid_count'];
						$sent_date = $val['ondate'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
				
						$total_rows13[$yz] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
						$yz++;
					}
				}	
			}
			else
			{
				//counts
				$query = "SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
				    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
				    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,
				    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
				    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count,ondate
			            FROM sms_api_messages WHERE user_id='$user_id' AND date(ondate) >= ( CURDATE() - INTERVAL 1 DAY ) group by date(ondate)";
			       
				$rs = mysql_query($query);       
				//$val = mysql_fetch_array($rs);
				if(mysql_num_rows($rs) > 0)
				{
					while($val = mysql_fetch_array($rs))
					{
						$delivered_count = $val['delivered_count'];
						$expired_count = $val['expired_count'];
						$dnd_count = $val['dnd_count'];
						$pending_dlr_count = $val['pending_dlr_count'];
						$invalid_count = $val['invalid_count'];
					
						$sent_date = $val['ondate'];
						$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count + $invalid_count;
				
						$total_rows13[$yz] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count.",".$invalid_count.",".$user_id.",".$sent_date.",".$date_total;
						$yz++;
					}
				}
			}
	
			$sql = "SELECT sum(delivered_count) AS delivered_count,sum(expired_count) AS expired_count,sum(dnd_count) AS dnd_count,sum(invalid_count) AS invalid_count,sum(sms_count) AS total_sms,on_date FROM sms_api_daily_count where user_id = '$user_id' $condition group by date(on_date)";
			$campaigns = mysql_query($sql);
			$z = 0;
			if(mysql_num_rows($campaigns) > 0) 
			{
				while($campaigns_value = mysql_fetch_array($campaigns)) 
				{
					$delivered_count = $campaigns_value['delivered_count'];
					$expired_count = $campaigns_value['expired_count'];
					$dnd_count = $campaigns_value['dnd_count'];
					$total_sms = $total_sms + $campaigns_value['total_sms'];
					//$pending_dlr_count = $campaigns_value['pending_dlrs_count'];
					$invalid_count = $campaigns_value['invalid_count'];
					
					$delivered_count1 = $delivered_count1 + $campaigns_value['delivered_count'];
					$expired_count1 = $expired_count1 + $campaigns_value['expired_count'];
					$dnd_count1 = $dnd_count1 + $campaigns_value['dnd_count'];
					$invalid_count1 = $invalid_count1 + $campaigns_value['invalid_count'];
					
					$pending_dlr = $delivered_count1 + $expired_count1 + $dnd_count1 + $invalid_count1;
					$pending_dlr_count1 = ($total_sms - $pending_dlr);
					
					$date = $campaigns_value['on_date'];
					$date_total = $delivered_count + $expired_count + $dnd_count + $pending_dlr_count1 + $invalid_count;
					
					$total_rows12[$z] = $delivered_count.",".$dnd_count.",".$expired_count.",".$pending_dlr_count1.",".$invalid_count.",".$user_id.",".$date.",".$date_total;
					$z++;
				}
			}
			$rows = array_merge($total_rows13,$total_rows12);
			return $rows;
		}
	}
	

	
	//	================= model funtions API MIS Report end==============
	
	
	
//	=== get credit history start=======



function get_credits_logs($userId,$from_date,$to_date,$offset,$limit)
	{
		$condition1='';
		$condition2='';
	
		if($from_date!='')
		{
		 	$condition1 =" AND date(date)>='$from_date'";
		}
		if($to_date!='')
		{
		  	$condition2 =" AND date(date)<='$to_date'";
		}
	
		$query = "select * from user_credits_logs where user_id='$userId' $condition1 $condition2 limit $offset,$limit";
		$res = $this->db->query($query);
		return $res->result();
	}
	
	function get_credits_logs_count($userId,$from_date,$to_date)
	{
		$condition1='';
		$condition2='';
	
		if($from_date!='')
		{
		 	$condition1 = " AND date(date)>='$from_date'";
		}
		if($to_date!='')
		{
		  	$condition2 = " AND date(date)<='$to_date'";
		}
	
		$query = "select * from user_credits_logs where user_id='$userId' $condition1 $condition2";
		$res = $this->db->query($query);
		return $res->result();
	}

function get_SMSCredits($userId)
	{
		$query = "select available_credits from users where user_id='$userId'";
		return $this->db->query($query)->row()->available_credits;
	}
	
	function insert_SMSCredits_logs($userId, $total_numbers_ex_invalidno,$current_balance,$campaign_id)
	{
		$balance = $current_balance - $total_numbers_ex_invalidno;
		$job_id = 0;
		$this->db->query("insert into user_credits_logs(before_campaign_credits,after_campaign_credits,current_campaign_credits,
		user_id,campaign_id,job_id) values('$current_balance','$balance','$total_numbers_ex_invalidno','$userId','$campaign_id',$job_id)");
	}
	
	//	=== get credit history end =======
	
	   
	
	
	/**  Added on 2017-01-23  **/
	
	
	
	
	
	/*public function get_dynamic_forms($user_id)
	{
		$query = "select form_name from dynamic_fields where user_id = '$user_id' group by form_name";
		$result = $this->db->query($query);
		if($result->num_rows() > 0)
		{
			return $result->result();
		}
		else
		{
			return array();
		}
	} 
	


	function campaignToshorturl($campaign_id,$sendShorturl,$sms_length,$mobile_no, $message = null, $dlr = null, $error_text = null)
	{
		$values = array(
		'campaign_id' => $campaign_id,
		'to_mobile_no' => $mobile_no,
		'sms_text' => $message,
		'dlr_status' => $dlr,
		'error_text' => $error_text,
		'short_url' => $sendShorturl
		);


		$this->db->set('sent_on', 'NOW()', FALSE);
		$this->db->insert('campaigns_to', $values);
		echo $this->db->last_query();

	}
	
	
	
	*/
	
	public function getLastCampaignSmsText($user_id)
	{
		$sql="SELECT sms_text, long_url,shorturl_text FROM sms.campaigns WHERE user_id =$user_id ORDER BY created_on DESC LIMIT 1";

		$result = $this->db->query($sql); 
	  
		if($result->num_rows()>0)
		{

			return $result->result();
		}
		else
		{
			return array();
		}

	}


	public function shorturl_dropdown_reports($user_id)
	{
		//date_default_timezone_set('Asia/Calcutta');

		// $query = "SELECT su.long_url FROM shorturl_db.short_urls su INNER JOIN ( SELECT device_type, ip_address, operating_system, build_by, browser_type, short_url, MAX( created_on ) created_on FROM shorturl_db.shorturl_table_info GROUP BY short_url order by id desc )sui ON sui.short_url = su.short_code left join sms.users u on u.user_id=su.user_id WHERE su.user_id =$user_id ";
		
		//$query = "SELECT su.long_url FROM shorturl_db.short_urls su WHERE su.user_id =$user_id ";

		$query = "SELECT long_url FROM campaigns WHERE long_url != '' AND user_id =$user_id ";
		
		/*$query = "SELECT su.long_url
		FROM shorturl_db.short_urls su
		INNER JOIN  shorturl_db.shorturl_table_info   
		  sui ON sui.short_url = su.short_code
		left join sms.users u on u.user_id=su.user_id WHERE su.user_id =$user_id ";*/
		$result = $this->db->query($query);  
		$re = array();
		$x = 0;  

		//print_r($result->result_array());
		foreach($result->result() AS $res)
		{
			$re[$x] = $res->long_url;
			$x++;
		}
		//print_r($re);
		return $re;
	}


	
	public function shorturl_total_rows($user_id,$from_date,$to_date,$longurl)
	{
		//date_default_timezone_set('Asia/Calcutta');
	
		$condition1='';
		$condition3='';

		$fromdate = date("Y-m-d",strtotime($from_date));
		$todate = date("Y-m-d",strtotime($to_date));

		if($from_date!='' && $to_date!='')
		{
			$condition1= " AND date(su.date_created)>='$fromdate' AND date(su.date_created)<='$todate'";
		}

		if($longurl!='')
		{
			$condition3= " AND su.long_url='$longurl'";
		}	
	
		 	/* $query = "SELECT su.long_url FROM shorturl_db.short_urls su INNER JOIN ( SELECT device_type, ip_address, operating_system, build_by, browser_type, short_url, MAX( created_on ) created_on FROM shorturl_db.shorturl_table_info GROUP BY short_url order by id desc )sui ON sui.short_url = su.short_code left join sms.users u on u.user_id=su.user_id WHERE su.user_id =$user_id $condition1 $condition3";
	 $result = $this->db->query($query);
		$re = array();
		$x = 0;
	
		//print_r($result->result_array());
		foreach($result->result() AS $res)
		{
			$re[$x] = $res->long_url;
			$x++;
		}
	
		return $re;  */
		 $query = "SELECT count(*) as count FROM shorturl_db.short_urls su  INNER JOIN  shorturl_db.shorturl_table_info  sui ON sui.short_url = su.short_code left join sms.users u on u.user_id=su.user_id WHERE su.user_id =$user_id $condition1 $condition3";
		  $result = $this->db->query($query); 
		//return $this->db->last_query();
		  return $result->row('count');
	}
	
	

	public function shorturl_reportssearch($userid,$from_date,$to_date,$longurl,$off_set,$limit)
	{
		$condition1='';
		$condition2='';
		$condition3='';

		$fromdate = date("Y-m-d",strtotime($from_date));
		$todate = date("Y-m-d",strtotime($to_date));
	
		if($off_set >= 0 && $limit > 0)
		{
			$condition2 = "limit $off_set,$limit";
		}

		if($from_date!='' && $to_date!='')
		{
			$condition1= " AND date(su.date_created)>='$fromdate' AND date(su.date_created)<='$todate'";
		}

		if($longurl!='')
		{
			$condition3= " AND su.long_url='$longurl'";
		}	   //   date_default_timezone_set('Asia/Calcutta');
		
		/*  $query = "SELECT su.long_url, su.short_code, su.counter, sui.device_type, sui.ip_address, sui.operating_system, sui.build_by, sui.browser_type, sui.created_on, su.date_created
	FROM shorturl_db.short_urls su
	INNER JOIN (

	SELECT device_type, ip_address, operating_system, build_by, browser_type, short_url, MAX( created_on ) created_on
	FROM shorturl_db.shorturl_table_info
	GROUP BY short_url
	)sui ON sui.short_url = su.short_code
	WHERE user_id =$userid $condition1 $condition3 order by su.id desc $condition2";  
	
	  $query = "SELECT su.long_url, su.short_code, su.counter, sui.device_type, sui.ip_address, sui.operating_system, sui.build_by, sui.browser_type, sui.created_on, su.date_created
	FROM shorturl_db.short_urls su
	INNER JOIN  shorturl_db.shorturl_table_info
	 sui ON sui.short_url = su.short_code
	WHERE user_id =$userid $condition1 $condition3 order by su.id desc $condition2";   */
		

	 $query = "SELECT su.long_url, su.short_code, su.counter,su.date_created FROM shorturl_db.short_urls su LEFT JOIN shorturl_db.shorturl_table_info sui ON su.short_code = sui.short_url WHERE user_id =$userid $condition1 $condition3 order by su.id desc $condition2";  
	  
    
		$result = $this->db->query($query);
		//return $this->db->last_query();
		$re = array();
		$x = 0;

		foreach($result->result_array() AS $res)
		{
			  				
			$shortcode = $res['short_code'];
			$created_date = date("Y-m-d",strtotime($res['date_created']));
			$current_date = date("Y-m-d");
			$date_diff = (strtotime($current_date) - strtotime($created_date)) / (60 * 60 * 24); 

			if($date_diff < 1)
			{
   
				$sql = "select to_mobile_no from sms.campaigns_to where short_url = '$shortcode'";
				$res_1 = $this->db->query($sql);
				//echo  $this->db->last_query().";</br>";
				foreach($res_1->result_array() AS $res12)
				{
					$re[$x] = array_merge($res,$res12);
				}

			}     
			else 
			{
 
				$createddate = date("mY",strtotime($res['date_created']));
 
				$table_name = "campaigns_backup.campaigns_to_".$createddate;
				 $sql1 = "select to_mobile_no from " .$table_name . " where short_url = '$shortcode'";
				 $res_2 = $this->db->query($sql1);
 				//  echo $this->db->last_query();
				foreach($res_2->result_array() AS $res123)
				{    
					$re[$x] = array_merge($res,$res123);
 
				}	      	
			}    
		$x++;
		}
		return $re;  
	}


	function getUserNames($user_id)
	{
		$this->db->select()
			->from('sms.users')
			->where('reseller_id',$user_id);
		$rs = $this->db->get();
		return $rs->result();	 		
	}
   
   
	public function assigncampainsvausernames($mobile,$reseller_id)
	{
		$sql="select assigned_id,masked_id from crm.lead_assign where  to_mobile_no='$mobile' and re_assigned_id='' and assigned_id!='' and user_id='$reseller_id'";

		$rs=$this->db->query($sql)->result();

		if($rs)
		{

			///$assigned_id=explode(',',$rs[0]->assigned_id);

			$assigned_id=$rs[0]->assigned_id;

			$masked_id=$rs[0]->masked_id;


			// for masking
			/*  
			$sqluser="select user_id,username from sms.users where user_id='$masked_id'";

			$sqluserrs=$this->db->query($sqluser)->result();

			if($sqluserrs[0]->username!='')
			{
			$getusers[]=$sqluserrs[0]->username."(m)"; 
			}*/

			//echo $normaluser;

			$sqlnormaluser="select user_id,username from sms.users where user_id='$assigned_id'";

			$sqlnormaluserrs=$this->db->query($sqlnormaluser)->result();

			if($masked_id=='1')
			{ 
				if($sqlnormaluserrs[0]->username!='')
				{
					$getusers[]=$sqlnormaluserrs[0]->username."(m)";  
				}
			}
			else
			{

				if($sqlnormaluserrs[0]->username!='')
				{
					$getusers[]=$sqlnormaluserrs[0]->username;  
				}

			}

			//print_r($getusers);

			$getusernames=implode(",",$getusers);

			return $users=trim($getusernames,",");

		}

		else
		{
			return false;
		}
	}



	public function get_call_status($mobile,$reseller_id)
	{
		$query = "select call_status from crm.lead_assign where to_mobile_no = '$mobile' AND user_id = '$reseller_id' and call_status !='0'";
		$res = $this->db->query($query);
		return $this->db->query($query)->row()->call_status;
	}
	
	/*public function getcallerid($user_id)
	{
	
	
		//echo $sql="SELECT * FROM `lead_assign` WHERE `assigned_id` = ($user_id) and reason='$leadreason' ORDER BY assign_date desc";
		
		 $sql="select * from sms.users where user_id='$user_id'";

		$rs=$this->db->query($sql);
		
		return $rs->result();			
	} 
	
	
	public function get_reseller_users($user_id)
	{
		$query = "SELECT  concat(`reseller_id`, ',',
	  group_concat(`user_id` )) as rid  FROM sms.`users` where reseller_id=$user_id   group by reseller_id";
		$res = $this->db->query($query);
		return $res->result();
	} 
	
	
	
public function Agentput_userscampaignFeedback($lead_assigntbl,$user_id,$users_reason,$users_comment,$users_phoneno,$lead_id,$call_status,$call_duration)
{



if($users_reason && $users_comment) {

  echo $sql = "INSERT INTO `crm`.`techsupport_client_fb` (
`lead_id` ,
`feedback` ,
`user_id` ,
`fb_status` ,
`client_name` ,
`email` ,
`mobile` ,
`organization` ,
`call_status` ,
`call_response` ,
`call_duration` ,
`call_type` ,
`reason`,
`commented_by`,
`reseller_id`

)
VALUES ('$lead_id', '$users_comment','$user_id', '', '', '', '$users_phoneno', '', '', '$call_status','$call_duration', '', '$users_reason','','$user_id')";
  
$this->db->query($sql);
}

 $updatesql = "update $lead_assigntbl set call_status='1' where  to_mobile_no='$users_phoneno' and user_id in($user_id) and lead_id='$lead_id'";

$this->db->query($updatesql);


   $sql="SELECT fb.feedback,fb.reason,fb.mobile, u.username,fb.call_duration,fb.call_response
FROM crm.techsupport_client_fb fb
LEFT JOIN sms.users u ON u.user_id = fb.user_id
WHERE fb.user_id in ($user_id) and  fb.mobile=$users_phoneno
ORDER BY app_fb_id DESC";
$result = $this->db->query($sql)->result();

//print_r($result);

if(count($result)>0)
{
return $result;
}
else
{
return array();
}
}

	 
	public function feedbackform_reportssearch($shortcode,$from_date,$to_date)
	{
	$condition1='';

	$fromdate = date("Y-m-d",strtotime($from_date));
	$todate = date("Y-m-d",strtotime($to_date));

	if($from_date!='' && $to_date!='')
	{
		$condition1= " AND date(insert_date)>='$fromdate' AND date(insert_date)<='$todate'";
	}	   //   date_default_timezone_set('Asia/Calcutta');
	$query = "select form_count,form_name,insert_date from crm.dynamic_form_values where unique_code = '$shortcode' $condition1 group by form_count "; 
	$result = $this->db->query($query);
	$re = array();
	$x = 0;
	foreach($result->result_array() AS $res)
	{
		$count_val = $res['form_count'];
		$form_name = $res['form_name'];
		$insert_date = $res['insert_date'];

		$sql = "select value from crm.dynamic_form_values where unique_code = '$shortcode' AND form_count = '$count_val' ";
		$result_1 = $this->db->query($sql);
		$re_1 = array();
		$y = 0;
		foreach($result_1->result_array() AS $res_1)
		{
			$re_1[$y] = $res_1['value'];
			$y++;
		}
		
		$re1 = array_push($re_1,"form_name","insert_date");
		$re[$x]	= $re_1;
		$x++;
	}
	return $re;
	}



	public function feedbackform_reports($shortcode)
	{
		$query = "select form_count,form_name,insert_date from crm.dynamic_form_values where unique_code = '$shortcode' group by 	form_count ";
	$result = $this->db->query($query);

	$re = array();
	$x = 0;
	foreach($result->result_array() AS $res)
	{
		$count_val = $res['form_count'];
		$form_name = $res['form_name'];
		$insert_date = $res['insert_date'];

		$sql = "select value from crm.dynamic_form_values where unique_code = '$shortcode' AND form_count = '$count_val' ";
		$result_1 = $this->db->query($sql);
		$re_1 = array();
		$y = 0;
		foreach($result_1->result_array() AS $res_1)
		{
			$re_1[$y] = $res_1['value'];
			$y++;  
		}
		
		$re1 = array_push($re_1,"$form_name","$insert_date");
		$re[$x]	= $re_1;
		$x++;
		}
		return $re;
	}	




	public function shortcode_dynamicfields($shortcode)
	{
		$query = "select dynamic_id from crm.dynamic_form_values where unique_code = '$shortcode' AND form_count = '1' ";
		$result = $this->db->query($query);
		$re = array();
		$x = 0;
		foreach($result->result_array() AS $res)
		{
			$lable_id = $res['dynamic_id'];

			$sql = "select lname from crm.dynamic_fields where test_id = '$lable_id'";
			$result_1 = $this->db->query($sql);
			foreach($result_1->result_array() AS $res_1)
			{
				$re[$x] = $res_1['lname'];
			}
			$x++;
		}
		array_push($re,"Form Name","Date & Time");
		return $re;
	} */


	

public function shortcode_all_reports($user_id,$short_code)
{	   //   date_default_timezone_set('Asia/Calcutta');
$query = "SELECT su.long_url, su.short_code, sui.device_type, sui.ip_address, sui.operating_system, sui.build_by, sui.browser_type, sui.created_on FROM shorturl_db.short_urls su INNER JOIN shorturl_db.shorturl_table_info sui ON sui.short_url = su.short_code WHERE user_id ='$user_id' AND su.short_code = '$short_code'";
 
	$result = $this->db->query($query);
	$re = array();
	$x = 0;
	foreach($result->result_array() AS $res)
	{
		$shortcode = $res['short_code'];
		$created_date = date("Y-m-d",strtotime($res['created_on']));
		$current_date = date("Y-m-d");
		$date_diff = (strtotime($current_date) - strtotime($created_date)) / (60 * 60 * 24);

		if($date_diff <= 1)
		{
			$sql = "select to_mobile_no from sms.campaigns_to where short_url = '$shortcode'";
			$res_1 = $this->db->query($sql);

			foreach($res_1->result_array() AS $res12)
			{
				$re[$x] = array_merge($res,$res12);
			}

		}
		else
		{
			$createddate = date("mY",strtotime($res['created_on']));
			$table_name = "campaigns_backup.campaigns_to_".$createddate;
			$sql1 = "select to_mobile_no from " .$table_name . " where short_url = '$shortcode'";
			$res_2 = $this->db->query($sql1);
			foreach($res_2->result_array() AS $res123)
			{
				$re[$x] = array_merge($res,$res123);
			}		
		}
	$x++;
	}  
	return $re;
}	

  

public function shortcode_reportssearch($user_id,$from_date,$to_date,$shortcode)
{
	$condition1='';
	$condition2='';

	$fromdate = date("Y-m-d",strtotime($from_date));
	$todate = date("Y-m-d",strtotime($to_date));

	if($from_date!='' && $to_date!='')
	{
		$condition1= " AND date(sui.created_on)>='$fromdate' AND date(sui.created_on)<='$todate'";
	}	   //   date_default_timezone_set('Asia/Calcutta');
$query = "SELECT su.long_url, su.short_code, sui.device_type, sui.ip_address, sui.operating_system, sui.build_by, sui.browser_type, sui.created_on FROM shorturl_db.short_urls su INNER JOIN shorturl_db.shorturl_table_info sui ON sui.short_url = su.short_code WHERE user_id ='$user_id' AND su.short_code = '$shortcode' $condition1"; 
	$result = $this->db->query($query);
	$re = array();
	$x = 0;
	foreach($result->result_array() AS $res)
	{
		$shortcode = $res['short_code'];
		$created_date = date("Y-m-d",strtotime($res['created_on']));
		$current_date = date("Y-m-d");
		$date_diff = (strtotime($current_date) - strtotime($created_date)) / (60 * 60 * 24);

		if($date_diff < 1)
		{
			$sql = "select to_mobile_no from sms.campaigns_to where short_url = '$shortcode'";
			$res_1 = $this->db->query($sql);

			foreach($res_1->result_array() AS $res12)
			{
				$re[$x] = array_merge($res,$res12);
			}

		}
		else
		{
			$createddate = date("mY",strtotime($res['created_on']));
			$table_name = "campaigns_backup.campaigns_to_".$createddate;
			$sql1 = "select to_mobile_no from " .$table_name . " where short_url = '$shortcode'";
			$res_2 = $this->db->query($sql1);
			foreach($res_2->result_array() AS $res123)
			{
				$re[$x] = array_merge($res,$res123);
			}		
		}
	$x++;
	}
 
	return $re;
}	
	/*
	
public function put_userscampaignFeedback($user_id,$users_reason,$users_comment,$users_phoneno)
{

if($users_reason && $users_comment) {
  $sql = "INSERT INTO `crm`.`techsupport_client_fb` (
`lead_id` ,
`feedback` ,
`user_id` ,
`fb_status` ,
`client_name` ,
`email` ,
`mobile` ,
`organization` ,
`call_status` ,
`call_type` ,
`reason`,
`commented_by`,
`reseller_id`

)
VALUES ('', '$users_comment','$user_id', '', '', '', '$users_phoneno', '', '', '', '$users_reason','','$user_id')";
$this->db->query($sql);
}

$updatesql = "update crm.lead_assign set call_status='1' where  to_mobile_no='$users_phoneno' and user_id in($user_id)";

$this->db->query($updatesql);


   $sql="SELECT fb.feedback,fb.reason,fb.mobile, u.username
FROM crm.techsupport_client_fb fb
LEFT JOIN sms.users u ON u.user_id = fb.user_id
WHERE fb.user_id in ($user_id) and  fb.mobile=$users_phoneno
ORDER BY app_fb_id DESC";
$result = $this->db->query($sql)->result();

//print_r($result);

if(count($result)>0)
{
return $result;
}
else
{
return array();
}
}	
 
 */
public function assignmissedcall($mobile,$user_id,$reseller_id)
{
	for($x=0;$x<=count($mobile)-1;$x++)
	{
		$sql="INSERT INTO crm.lead_assign (to_mobile_no ,lead_date ,assigned_id ,assign_date ,masked_id ,user_id ,lead_type)VALUES ('$mobile[$x]', NOW(), '$user_id', NOW(), '0', '$reseller_id','Missedcall')";

		$this->db->query($sql);
	}
}
 
 
 
public function unassigncampainsvalues($mobile,$user_id,$reseller_id)
{
	for($x=0;$x<=count($mobile)-1;$x++)
	{
		$query = "select call_status from crm.lead_assign where to_mobile_no='$mobile[$x]' and user_id='$reseller_id' AND assigned_id ='$user_id'";
		$res = $this->db->query($query);
		if($res->num_rows() > 0)
		{	
			if($this->db->query($query)->row()->call_status == 0)
			{
				$updatesql = "delete from crm.lead_assign where to_mobile_no='$mobile[$x]' and user_id='$reseller_id' AND assigned_id ='$user_id'";
				$this->db->query($updatesql);
			}
		}
	}
}  
	
	function campaignToNormalShorturl($campaign_id,$sendShorturl,$sms_length,$mobile_no, $message = null,$port_no = null, $dlr = null, $error_text = null)
	{
		$unique_msg_id = $this->get_unique();
		$values = array(
		'campaign_id' => $campaign_id,
		'unique_msg_id' => $unique_msg_id,
		'to_mobile_no' => $mobile_no,
		'sms_text' => $message,
		'dlr_status' => $dlr,
		'error_text' => $error_text,
		'port_no' => $port_no,
		'short_url' => $sendShorturl 
		);
  

		$this->db->set('sent_on', 'NOW()', FALSE);
		$this->db->insert('campaigns_to', $values);
		 // echo $this->db->last_query();  
  
	}  

	
	 
	function get_unique()
	{
 
	 	$msg_c = ''; 
		$set_msg = 'set @u:= hex(uuid())'; 
		$q = $this->db->query($set_msg); 

		if($q) 
		{
			$msg_str = "select concat(substr(@u,7,4),'-',substr(@u,5,4), '-', substr(@u,1,4),'-', substr(@u,9,4) ) as unique_no";
			$res = $this->db->query($msg_str); 
			$msg_carr = $res->row('unique_no'); 
 			if(isset($msg_carr)) 
				$msg_c = $msg_carr; 
			return $msg_c; 
			// if(isset($msg_carr['unique_no']))
				// $msg_c = $msg_carr['unique_no']; 
			// return $msg_c; 
		}	
		return $msg_c;
	}  
 
 

	function createFileShortUrlCampaign($userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input)
	{
		// calculate SMS length
		if(strlen($sms_text)>160)
			$sms_length_tmp=ceil(strlen($sms_text)/153);
		else
			$sms_length_tmp=ceil(strlen($sms_text)/160);
		
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length = ceil(strlen($sms_text)/160);
		 
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender,  
			'sender' => $_sender, 
			'sms_text' => $sms_text,
			'sms_count' => $sms_length,
			'no_of_messages' => $total_no_of_sms,
			'campaign_type' => $sms_type,
			'campaign_name' => $campaign_name,
			'long_url' => $shorturl_input,
			'shorturl_text' => $shorturl_text,
			'source_type' =>  3, // ADDED ON 2017-02-09, FILE SMS TYPE
			'port_no' => $sms_port
		);
		if($is_schedule == 1) {
			$values['is_scheduled'] = $is_schedule;
			$values['scheduled_on'] = $scheduled_date;
		}
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('campaigns', $values)) {
			return $this->db->insert_id();
		}
		echo	$this->db->last_query();
	
		return false;    
	}
	
	function createShortUrlCampaign($userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input)
	{
		// calculate SMS length
		if(strlen($sms_text)>160)
			$sms_length_tmp=ceil(strlen($sms_text)/153);
		else
			$sms_length_tmp=ceil(strlen($sms_text)/160);
		
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length = ceil(strlen($sms_text)/160);
		
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender,
			'sender' => $_sender,
			'sms_text' => $sms_text,
			'sms_count' => $sms_length,
			'no_of_messages' => $total_no_of_sms,
			'campaign_type' => $sms_type,
			'campaign_name' => $campaign_name,
			'long_url' => $shorturl_input,
			'shorturl_text' => $shorturl_text,
			'source_type' => 1, // ADDED ON 2017-02-09, NORMAL SMS TYPE
			'port_no' => $sms_port
		);
		if($is_schedule == 1) {
			$values['is_scheduled'] = $is_schedule;
			$values['scheduled_on'] = $scheduled_date;
		}
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('campaigns', $values)) {
			return $this->db->insert_id();
		}
		echo	$this->db->last_query();
	
		return false;    
	}
	
	 
	
	function createUnicodeShortUrlCampaign($userId,$sms_type,$is_unicode_sms,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input)
	{
		// calculate SMS length  
		if(mb_strlen($sms_text)>70)
			$sms_length_tmp=ceil(mb_strlen($sms_text)/63);
		else
			$sms_length_tmp=ceil(mb_strlen($sms_text)/70);
		
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length = ceil(strlen($sms_text)/160);
		
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender, 
			'sender' => $_sender, 
			'sms_text' => $sms_text,
			'is_unicode_sms' => $is_unicode_sms,
			'sms_count' => $sms_length,
			'no_of_messages' => $total_no_of_sms,
			'campaign_type' => $sms_type,
			'campaign_name' => $campaign_name,
			'source_type' => 2, // ADDED ON 2017-02-09, UNICODE SMS TYPE
			'long_url' => $shorturl_input,
			'shorturl_text' => $shorturl_text,   
			'port_no' => $sms_port
		);
		if($is_schedule == 1) {
			$values['is_scheduled'] = $is_schedule;
			$values['scheduled_on'] = $scheduled_date;
		}
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('campaigns', $values)) {
			return $this->db->insert_id();
		}
		return false;
	}
	
	
	
	function createCustomizedCampaign($userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input)
	{
		// calculate SMS length  
		if(strlen($sms_text)>160)
			$sms_length_tmp=ceil(strlen($sms_text)/153);
		else
			$sms_length_tmp=ceil(strlen($sms_text)/160);
		
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length = ceil(strlen($sms_text)/160);
		
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender,
			'sender' => $_sender, 
			'sms_text' => $sms_text,
			'sms_count' => $sms_length, 
			'no_of_messages' => $total_no_of_sms,
			'campaign_type' => $sms_type,
			'campaign_name' => $campaign_name,
			'source_type' => 4, // ADDED ON 2017-02-09, CUSTOMIZED SMS TYPE
			'long_url' => $shorturl_input,
			'shorturl_text' => $shorturl_text,   
			'port_no' => $sms_port
		);
		if($is_schedule == 1) {
			$values['is_scheduled'] = $is_schedule;
			$values['scheduled_on'] = $scheduled_date;
		}
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('campaigns', $values)) {
			return $this->db->insert_id();
		}
		//echo	$this->db->last_query();
	
		return false;
	}
	

	public function addTemplate($user_id,$template,$template_name,$templateId=null)
	{
		if(strlen($template_name) > 15) {
			return 4;
		}else{
			if($templateId != NULL && $template_name != NULL) {
				 $this->db->where('template_id', $templateId);
				 $this->db->update('templates', array('template' => $template,'template_name' => $template_name));
			  	return 2;  
			}else{
			      $checkUnique = $this->db->select('user_id')
						      ->from('templates')
	 					      ->where('template_name',$template_name)
						      ->get();
			      if($checkUnique->num_rows() > 0) {
					return 3;
			      }else{
					$values = array(    
						'user_id' => $user_id,
						'template' => $template,
						'template_name' => $template_name,
						'status' => '',
						'added_by' => '0'
					);
					$this->db->set('on_date', 'NOW()', FALSE);
					$rs = $this->db->insert('templates', $values);
			 
					if($this->db->insert_id() > 0) {
						return 1;
					}else{
						return FALSE;
					}
				}
			}
		}	
	}
	
	public function getRecentTemplatesInfo($user_id) {
		 $to_date = $this->input->post('to_date');
		 $from_date = $this->input->post('from_date'); 			
		 $this->db->select('sms_text,created_on,campaign_id');
		 $this->db->from('campaigns');
		 $this->db->where('user_id',$user_id);
		 if($from_date) {
			$this->db->where('date(created_on) >=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on) <=',"$to_date");
		}			
		 	
		$this->db->order_by('campaign_id','desc');
		$this->db->limit(5);	
		 $rs = $this->db->get();
		// return $this->db->last_query();
  		return $rs->result();	 
	
	}
	
	
	
	public function getSelectedTemplate($template_id,$user_id) {
		$this->db->select();
		$this->db->from('templates'); 
		$this->db->where('user_id',$user_id);
		$this->db->where('template_id',$template_id);
		$rs = $this->db->get();  
  		return $rs->result();
			
	
	}
	
	public function getSelectedCampaignTemplate($campaign_id,$user_id) {
		$this->db->select('sms_text');
		$this->db->from('campaigns'); 
		$this->db->where('user_id',$user_id);
		$this->db->where('campaign_id',$campaign_id);
		$this->db->order_by('campaign_id','desc');
		$this->db->limit(5);	
		$rs = $this->db->get();  
  		return $rs->result();
			
	
	}
	


	public function getCampaignTemplateDetails($user_id, $campaign_id)
	{
		$this->db->select()
			->from('campaigns')
			->where('user_id', $user_id)
			->where('campaign_id', $campaign_id);

		$query = $this->db->get();
		$rs = $query->result();
		return $rs;
	}
	public function delete_camapignTemplate($user_id, $campaign_id)
	{
		$rs = $this->db->where('user_id', $user_id)
				->where('campaign_id', $campaign_id)
				->delete('campaigns');

		return $rs;
	}
 
 
    
       function get_api_campaign_count($user_id, $days_diff, $ondate)
	{
		if($days_diff <= 1) {
			$table_name = "sms.sms_api_messages";
		} else {
			$year = substr($ondate,0,4);
			$month = substr($ondate,5,2);
			$table_name = "campaigns_backup.sms_api_messages_".$month.$year;
		}

		
		
		$sql = $this->db->select("count(to_mobileno) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status=0 THEN to_mobileno END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count, 
			count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count, 
			(count(CASE WHEN dlr_status=16 THEN to_mobileno END) + count(CASE WHEN dlr_status=4 THEN to_mobileno END) + count(CASE WHEN dlr_status=5 THEN to_mobileno END) ) as invalid_count")
				->from($table_name) 
				->where('user_id',$user_id)
				->where('date(ondate)',$ondate)		 		
				->order_by('ondate','desc');
				$rs = $this->db->get(); 
    		//return $this->db->last_query();
		$array = array(
				'total_count' => $rs->row('total_count'),
				'pending_dlr_count' => $rs->row('pending_dlr_count'),
				'delivered_count' => $rs->row('delivered_count'),
				'expired_count' => $rs->row('expired_count'),
				'dnd_count' =>  $rs->row('dnd_count'),
				'invalid_count' => $rs->row('invalid_count'),
		    
		);
 
		$invalid_nos_count = $this->db->query("SELECT count(*) as invalid_nos_count FROM $table_name WHERE (dlr_status = 16 OR dlr_status = 2)  AND ( error_code IN (1080,1081,001,005,015)  OR error_text = 'Invalid Number' ) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."' ");     
		$array['invalid_nos_count'] = $invalid_nos_count->row('invalid_nos_count');
		
		$multiple_submit_count = $this->db->query("SELECT count(*) as multiple_submit_count FROM $table_name WHERE dlr_status = 16 AND (error_code = 1077 OR error_code = 411 OR error_text = 'Duplicate Msg' ) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['multiple_submit_count'] = $multiple_submit_count->row('multiple_submit_count');
		
		$invalid_number_length_count = $this->db->query("SELECT count(*) as invalid_number_length_count FROM $table_name WHERE dlr_status = 16 AND (error_code = '0x00000404' OR error_text = 'Invalid destination number')  AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['invalid_number_length_count'] = $invalid_number_length_count->row('invalid_number_length_count');
		
		 $misc_error_count = $this->db->query("SELECT count(*) as misc_error_count FROM $table_name WHERE dlr_status = 16 AND (error_code IN ('0x00000450',1077,100,020,019,410,409, 205,202,200,195,193,178,176,166,164,162,160,145,036,034,031,011, 090,109,252,124,102,037,021,032,035,144,146,161,163,165,167,177,192,194,196,201,204,404) OR error_text = 'Spam Error' OR error_text = 'Black-listed number' ) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");       
		$array['misc_error_count'] = $misc_error_count->row('misc_error_count');
		    
		$invalid_sender_ids_count = $this->db->query("SELECT count(*) as invalid_sender_ids_count FROM $table_name WHERE dlr_status = 16 AND (error_code = '0x00000455' OR error_text = 'Sender ID not found') AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['invalid_sender_ids_count'] = $invalid_sender_ids_count->row('invalid_sender_ids_count');  
		
		//$dnd_count = $this->db->query("SELECT count(*) as dnd_count FROM $table_name WHERE (dlr_status = 16 OR dlr_status = 3 ) AND (error_code IN ('0x00000481' ,1078,478,'0x00000436',1032) OR error_text = 'DND number') AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		//$array['dnd_count'] = $dnd_count->row('dnd_count');
		
		//$pending_dlrs_count = $this->db->query("SELECT count(*) as pending_dlrs_count FROM $table_name WHERE dlr_status = 0 OR dlr_status = ''  AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		//$array['pending_dlrs_count'] = $pending_dlrs_count->row('pending_dlrs_count');
		
		$out_of_range_count = $this->db->query("SELECT count(*) as out_of_range_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (002,027,203,010,016) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['out_of_range_count'] = $out_of_range_count->row('out_of_range_count');  
		
		$memory_capacity_exceeded_count = $this->db->query("SELECT count(*) as memory_capacity_exceeded_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (003,013,412,009) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['memory_capacity_exceeded_count'] = $memory_capacity_exceeded_count->row('memory_capacity_exceeded_count');
		
		$mobile_equipment_error_count = $this->db->query("SELECT count(*) as mobile_equipment_error_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (004,012,007) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."' ");     
		$array['mobile_equipment_error_count'] = $mobile_equipment_error_count->row('mobile_equipment_error_count');
		
		$network_error_count = $this->db->query("SELECT count(*) as network_error_count FROM $table_name WHERE dlr_status = 2  AND error_code IN (005,008,161,034,033,017) AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['network_error_count'] = $network_error_count->row('network_error_count');
		
		$barring_count = $this->db->query("SELECT count(*) as barring_count FROM $table_name WHERE dlr_status = 2  AND error_code  = 006  AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['barring_count'] = $barring_count->row('barring_count');
		
		$promo_blocked_count = $this->db->query("SELECT count(*) as promo_blocked_count FROM $table_name WHERE dlr_status = 2  AND error_code = 044 AND user_id = '".$user_id."' AND date(ondate) = '".$ondate."'");     
		$array['promo_blocked_count'] = $promo_blocked_count->row('promo_blocked_count');
		return $array;      
	} 
	
	function get_sms_api_details_by_filter($ondate,$user_id,$days_diff,$sender,$mobile_number)
	{
		if($days_diff <= 1){
		    $table_name = "sms.sms_api_messages";
		} else {
		    $year = substr($ondate,0,4);
		    $month = substr($ondate,5,2);
		    $table_name = "campaigns_backup.sms_api_messages_".$month.$year;
		}
		
		$this->db->select('ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text');
		$this->db->from($table_name);
		$this->db->where('user_id',$user_id);
		 if($sender) {
			$this->db->where('sender_name',$sender);
		 }
		if($mobile_number) {
			$this->db->where('to_mobileno',$mobile_number);
		}	
			
		$this->db->where('date(ondate)',$ondate);
		$this->db->order_by('ondate','desc');
		$rs = $this->db->get();
		 //return $this->db->last_query();
		return $rs->result();
	}
	  
 
	// UPDATED ON 2017-02-10
	function createUserShorturl($user_id,$data,$totalCredits) { 
		$shorturl_number = $data['shorturl_number'];
		$long_url = $data['shorturlenter'];
		//$shorturl = $this->input->post('shorturl'); 
		$this->db->insert('user_shorturl',array('user_id' => $user_id,'long_url' => $long_url,'number_of_url' => $shorturl_number,'credits' => $totalCredits));
		if($this->db->insert_id() > 0) { 
			return $this->db->insert_id();
		}else{ 
			return FALSE;
		}   
		   
	}
	function createUserBulShorturl($shorturl,$shorturl_id,$shortCode) { 
		$this->db->insert('user_bulk_shorturl',array('shorturl_id' => $shorturl_id,'shorturl' => $shorturl,'shortCode' => $shortCode));	
 
		  
	}
	function getUserShortUrls($user_id,$fromdate,$todate) {  
		$this->db->select();
		$this->db->from('user_shorturl'); 
		if($fromdate) {	
 
			$this->db->where('date(created_date) >=', $fromdate); 
		}
		if($todate) {
			$this->db->where('date(created_date) <=', $todate); 
		}
		$this->db->where('user_id', $user_id); 
		
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		// return $this->db->last_query();
		$rs = $query->result();    
		return $rs;
	}
        
	function getUserUrls($user_id,$shorturlId) {
 
		 $query =  $this->db->query("SELECT `user_bulk_shorturl`.*, `shorturl_db`.`short_urls`.`counter` FROM (`user_bulk_shorturl`) JOIN user_shorturl ON user_bulk_shorturl.shorturl_id = user_shorturl.shorturl_id LEFT JOIN `shorturl_db`.`short_urls` ON `shorturl_db`.`short_urls`.`short_code` = `user_bulk_shorturl`.`shortCode` WHERE `user_shorturl`.`user_id` = '".$user_id."' AND `user_bulk_shorturl`.`shorturl_id` = '". $shorturlId."'");   
		/*$this->db->select('user_bulk_shorturl.*,shorturl_db.short_urls.counter');
		$this->db->from('user_bulk_shorturl'); 
		$this->db->join('shorturl_db.short_urls','shorturl_db.short_urls.short_code = user_bulk_shorturl.shortCode','left');
 		$this->db->where('shorturl_db.short_urls.user_id',$user_id);
		$this->db->where('user_bulk_shorturl.shorturl_id', $shorturlId); 
		$query = $this->db->get(); */
		$rs = $query->result();  
		return $rs;

	} 


	  
	public function global_shorturlVal()
	{
		$this->db->select();
		     $this->db->from('global_settings');
			 $this->db->where('setting_name','shorturl');
			 $query = $this->db->get();

		if($query->num_rows() == 1) {
			 return $query->row('value');
		}else{
			return FALSE; 
		}

	}
		
	public function updateUserUrlCredits($userId,$remainingCredits) {
		$this->db->query("UPDATE users SET shorturl_credits = '".$remainingCredits."' WHERE  user_id = '".$userId."'");
  	}    
	

	public function getUrlReports($user_id,$short_code) {
		$query = $this->db->query("SELECT su.long_url, su.short_code, sui.device_type, sui.ip_address, sui.operating_system, sui.build_by, sui.browser_type, sui.created_on FROM shorturl_db.short_urls su INNER JOIN shorturl_db.shorturl_table_info sui ON sui.short_url = su.short_code WHERE user_id ='".$user_id."' AND su.short_code = '".$short_code."'"); 
		$rs = $query->result();
 
		return $rs; 
	}

	public function getShortcodeReports($user_id,$shorturlId) {
		$query = $this->db->query("SELECT * FROM user_bulk_shorturl JOIN shorturl_db.short_urls ON user_bulk_shorturl.shortCode = shorturl_db.short_urls.short_code LEFT JOIN shorturl_db.shorturl_table_info  ON shorturl_db.short_urls.short_code = shorturl_db.shorturl_table_info.short_url WHERE user_bulk_shorturl.shorturl_id = '".$shorturlId."'  AND  shorturl_db.short_urls.user_id = '".$user_id."'  ");
		//$query = $this->db->query("SELECT su.long_url, su.short_code, sui.device_type, sui.ip_address, sui.operating_system, sui.build_by, sui.browser_type, sui.created_on FROM shorturl_db.short_urls su INNER JOIN shorturl_db.shorturl_table_info sui ON sui.short_url = su.short_code WHERE user_id ='".$user_id."' AND su.short_code = '".$short_code."'"); 
		$rs = $query->result();
 
		return $rs; 
	}

 
	public function getUserLongcodeData($user_id) {
		$userPackageData = $this->db->select()
					    ->from('longcode_subscription')
					    ->where('user_id',$user_id)
					    ->where('status',1)
					    ->where('date(subscription_start) <= ',date('Y-m-d'))
					    ->where('date(subscription_end) >= ',date('Y-m-d')) 			  
					    ->order_by('longcode_id','desc')
					    ->get();
		 // return $this->db->last_query();
		return $userPackageData->result_array();  


	}


	public function longCodePackage($id) {
		$this->db->select();
		$this->db->from('longcode_packages'); 
		if($id) {
			$this->db->where('package_id',$id);
		}
		$query =  $this->db->get(); 
		return $query->result_array();  
	}  

	public function getServiceData($user_id,$longcode_id) {
		$userPackageData = $this->db->select()
					    ->from('longcode_subscription')
					    ->where('user_id',$user_id)
					    ->where('longcode_id',$longcode_id)
					    ->get();
		//return $this->db->last_query();
		return $userPackageData->result_array();  
	}

	public function global_servicetax() {
		
		$this->db->select();
		     $this->db->from('global_settings');
			 $this->db->where('setting_name','Service Tax');
			 $query = $this->db->get();
 
		if($query->num_rows() == 1) {  
			 return $query->row('value');
		}else{
			return FALSE; 
		}
	}
 
	public function getUserProfileData($user_id) {
		$query  = $this->db->query("SELECT user_id,u.no_ndnc,u.dnd_check,u.username, u.email, u.mobile, u.address1, u.address2, u.zipcode,c.city_name,c.state FROM users u left join new_citylist c on u.city_id = c.city_id   left join new_statelist s on u.state_id = s.state_id WHERE u.user_id ='".$user_id."' ");  
		return $query->result_array();  	
	}

	public function userLongcodeRenewal($amount,$num_sms,$service_tax,$price_per_long_code,$total_amount,$longcode_number,$subscription_duration,$user_id,$transaction_id,$name,$email,$mobile,$smstype) {
 	 
		$this->db->query("INSERT INTO price_enquery SET noofsms = '".$num_sms."',price_per_sms= '".$price_per_long_code."',smstype = '".$smstype."',name = '".$name."',mobile = '".$mobile."',email = '".$email."',servicetype = 'longcode',description = 'longcodeRenewal',subcription = '".$subscription_duration."',registeruser_id = '".$user_id."',total_amount ='".$total_amount."',amount = '".$amount."',tax_amount = '".$service_tax."' ,longcode_numbers ='".$longcode_number."'"); 
   		//return $this->db->last_query();
			
		//$sql = "UPDATE price_enquery SET servicetype = 'longcodeRenewal',description='longcodeRenewal',noofsms = '".$num_sms."' ,price_per_sms = '".$price_per_long_code."' ,subcription = '".trim($subscription[0])."',amount = '".$amount."',tax_amount = '".$service_tax."',total_amount = '".$total_amount."' WHERE id ='".$product_id."'"; 
 		//$query=$this->db->query($sql);
		 return $this->db->insert_id(); 
		    
		  
	}

	public function updateUserLongcodeInfo($transaction_id,$userId) {

		$longcode_id = $this->session->userdata('longcode_id');  
		$product_id = $this->session->userdata('productId');  
		$number_cost = $this->session->userdata('number_cost');  
		$package_amount = $this->session->userdata('package_amount');
		$subscription_duration = $this->session->userdata('subscription_duration'); 
		if($longcode_id != NULL && $product_id != NULL && $package_amount != NULL ) {  
			//Maintaining backup for user subscribed longcode information 
			$this->db->query("INSERT INTO longcode_user_renewal_info (SELECT * FROM longcode_subscription WHERE longcode_id = '".$longcode_id."' )");

			// Updating user longcode renewal information
			$getorderinfo =	$this->db->query("SELECT * FROM price_enquery WHERE id = '".$product_id."' "); 
			if($getorderinfo->num_rows() > 0) { 
				 
				$endSubscriptionDate = date('Y-m-d H:i:s', strtotime($subscription_duration));
				$amount = $getorderinfo->row('amount');
				//return $sql = "UPDATE longcode_subscription SET subscription_start = '".date('Y-m-d H:i:s')."',subscription_end = '".$endSubscriptionDate."',transaction_id = '".$transaction_id."',no_of_sms='".$getorderinfo->row('noofsms')."',subscription_duration='".$subscription_duration."',package_cost = '".$package_amount."',amount='". $amount."',total_tax='".$getorderinfo->row('tax_amount')."',total_amount='". $getorderinfo->row('total_amount')."',price_per_long_code='".$getorderinfo->row('price_per_sms')."' WHERE longcode_id = '".$longcode_id."' ";
	 			$this->db->query("UPDATE longcode_subscription SET subscription_start = '".date('Y-m-d H:i:s')."',subscription_end = '".$endSubscriptionDate."',transaction_id = '".$transaction_id."',no_of_sms='".$getorderinfo->row('noofsms')."',subscription_duration='".$subscription_duration."',package_cost = '".$package_amount."',amount='". $amount."',total_tax='".$getorderinfo->row('tax_amount')."',total_amount='". $getorderinfo->row('total_amount')."',price_per_long_code='".$getorderinfo->row('price_per_sms')."',number_cost = '".$number_cost."' WHERE longcode_id = '".$longcode_id."' ");

			      $this->db->query("UPDATE order_details SET price = '".$getorderinfo->row('total_amount')."', transaction_id = '".$transaction_id."' WHERE id = '".$product_id."'  AND  user_id = '".$getorderinfo->row('registeruser_id')."' AND longcode_number = '".$getorderinfo->row('longcode_numbers')."'"); 
	  
			    $this->db->query("update price_enquery set order_status=1,transaction_id = '".$transaction_id."' where id= '".$product_id."'");  
			  $query = $this->db->query("insert into transaction_history (user_id,noofsms,sms_price,amount,tax_amount,total_amount,epg_txnID,authcode,payment_status)
 values ($userId,'".$getorderinfo->row('noofsms')."','".$getorderinfo->row('price_per_sms')."',$amount,'".$getorderinfo->row('tax_amount')."','".$getorderinfo->row('total_amount')."',$transaction_id,'".$getorderinfo->row('authcode')."','".$getorderinfo->row('pgresponse')."')");    
			} 

		}
		$this->session->unset_userdata('longcode_id');  
		$this->session->unset_userdata('productId');  
		$this->session->unset_userdata('package_amount');    
		  
	}


	public function addUserUrlCredits($name,$email,$mobile,$urlcount,$user_id,$tax_amount,$amount,$total_amount,
	$sms_price,$smstype,$shorturl_credits) {
		 
 
		$this->db->query("INSERT INTO price_enquery (price_per_sms,smstype,name,mobile,email,servicetype,description,noofshorturl,registeruser_id,total_amount,amount,tax_amount,shorturl_credits) VALUES('".$sms_price."','".$smstype."','".$name."','".$mobile."','".$email."','shorturl','shorturl','".$urlcount."','".$user_id."','".$total_amount."','".$amount."','".$tax_amount."','".$shorturl_credits."') ");
		//	return $this->db->last_query();
		if($this->db->insert_id() > 0) {
  
			return $this->db->insert_id();    
		}else{
			return FALSE;
		}   
	}

	public function updateUrlPaymentStatus($transaction_id,$user_id,$userCredits) {
		$product_id = $this->session->userdata('productId');  
		if($product_id) {
			$this->session->unset_userdata('productId');  
 			$this->db->query("update price_enquery set order_status=1,transaction_id = '".$transaction_id."' where id= '".$product_id."'");   
			//$getUrls = $this->db->query("SELECT shorturl_credits FROM price_enquery WHERE id = '".$product_id."'");
			//$userCredits = $this->db->query("SELECT shorturl_credits FROM users WHERE user_id = '".$user_id."'");
			//$total_credits = $userCredits->row('shorturl_credits') + $getUrls->row('shorturl_credits');
			//$total_credits = $getUrls->row('shorturl_credits');
 			//$this->db->query("UPDATE users SET shorturl_credits = '".$total_credits."' WHERE user_id = '".$user_id."'");  

		}   

	}


    
        public function getBulkurlPrice($urls) {
		if($urls > 1000000) {
			return '0.2';
		}else{
			$query = $this->db->query("SELECT smsprice FROM userbulkurlsmsprice WHERE (min_no_of_url <= '".$urls."' AND max_no_of_url >= '".$urls."') ");

	 		if($query->row('smsprice')) {
				return $query->row('smsprice'); 
			}else{
   
				return '0.4';
			}  
		}
		
	}

	public function updateCampaignSmsText($campaign_id,$user_id,$sms_text,$campaign_long_url,$campaign_shorturl_text)
	{
		$sql=$this->db->query("UPDATE sms.campaigns SET sms_text ='".$sms_text."',long_url= '".$campaign_long_url."',shorturl_text = '".$campaign_shorturl_text."' WHERE user_id ='".$user_id."' AND campaign_id = '".$campaign_id."'"); 

	}
	public function shorturl_reportssearch_new($userid)
	{
		 $query =  $this->db->query("SELECT shorturl_text as long_url,created_on as date_created,RIGHT(shorturl_text, 7 ) AS short_code FROM sms.campaigns WHERE sms.campaigns.user_id = '".$userid."' AND sms.campaigns.shorturl_text != '' ORDER BY campaign_id desc");
		return $query->result_array();
	}
  


}
 

