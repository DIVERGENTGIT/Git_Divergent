
<?php
class Analysis_model extends CI_Model {
public $db2;
	function __construct()
	{
		parent::__construct();
					$this->db2 = $this->load->database('backupdb', TRUE);
	}
	
		function getSenderNames($user_id)
	{
		$this->db->select()
			->from('sender_names')
			->where('user_id',$user_id);
		$rs = $this->db->get();  
		return $rs->result();	 		
	}  
	
	
	
	
	function getAvgTime($user_id)
	{
	
	/*	 $query =$this->db->query("SELECT AVG(SECOND( created_on )) as avgtime ,DATE(created_on) as datewise
FROM campaigns
WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 YEAR)  and user_id=$user_id
GROUP BY DATE(created_on) 
ORDER BY created_on DESC limit 0,7
 ");
 
 $query =$this->db->query("SELECT AVG( SECOND( delivered_on ) - SECOND( sent_on ) ) AS avgtime, DATE( sent_on ) AS datewise
 	*/	
$query =$this->db->query("SELECT AVG(TIME_TO_SEC(TIMEDIFF(delivered_on,sent_on))) AS avgtime, DATE( sent_on ) AS datewise
FROM campaigns c, campaigns_to ct
WHERE c.user_id =$user_id
AND c.campaign_id = ct.campaign_id
GROUP BY DATE( HOUR( sent_on )) 
ORDER BY DATE( HOUR( sent_on )) DESC 
LIMIT 0 , 2");

return   $row = $query->result_array(); 
		
	}
		
	 
	function getWeekCampaign($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 WEEK )  and user_id=$user_id
		GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
	
	function getMonthCampaign($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 MONTH)  and user_id=$user_id
		GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
	
		function getYearCampaign($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , MONTH(created_on) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 YEAR )  and user_id=$user_id
		GROUP BY MONTH( created_on ) 
ORDER BY MONTH(created_on) ASC  ");
		
				return   $row = $query->result_array(); 		
	}
	
	
	
	
	
		function rechargeDetails($user_id)
	{
		
		$query =$this->db->query("SELECT SUM( no_of_sms ) as totalmsg , DATE( on_date ) AS 
		daywise FROM user_payments
		WHERE  user_id =  $user_id
		GROUP BY DATE( on_date )  
		 ORDER BY on_date desc limit 0,5  ");

		return   $row = $query->result_array(); 		
	}
	
	
	
function rechargeWiseAnalysis($user_id,$date)
	{
		
		$query =$this->db->query("SELECT SUM( no_of_messages ) AS totalmsg, SUM( expired_count ) AS exprd, SUM( delivered_count ) AS dlrd, SUM( dnd_count ) AS dnds, SUM( pending_dlrs_count ) AS pndng, SUM( invalid_count ) AS invald, COUNT( campaign_status =0 ) AS processcnt, DATE( created_on ) AS dateedon
		FROM campaigns
		WHERE DATE(created_on)>=  '$date'
		AND user_id =$user_id ORDER BY created_on DESC ");
		return   $row = $query->result_array(); 
				
	}
	
	//****************Quick Send SMS start *********************
	
	
	function getWeekCampaignQuicksend($user_id)
	{
			
			$query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
			daywise FROM campaigns
			WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 WEEK )  and user_id=$user_id and campaign_status !=3 and is_unicode_sms=0 and campaign_type =0
			GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
			
			return   $row = $query->result_array(); 		
	}
	
	
		function getMonthCampaignQuicksend($user_id)
	{
		
			$query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
			daywise FROM campaigns
			WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 MONTH )  and user_id=$user_id and campaign_status !=3 and is_unicode_sms=0 and campaign_type =0
			GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
			
			return   $row = $query->result_array(); 		
	}
	
	
	function getYearCampaignQuicksend($user_id)
	{
		
			$query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , MONTH(created_on) AS 
			daywise FROM campaigns
			WHERE created_on >= DATE_SUB( NOW( ), INTERVAL 1 YEAR )  and user_id=$user_id and campaign_status !=3 and is_unicode_sms=0 and campaign_type =0
			GROUP BY MONTH( created_on ) ORDER BY created_on DESC ");
			
			return   $row = $query->result_array(); 		
	}
	
	
	
	//********************Quick SMS end********************

	
	
//********************Unicode SMS  start********************
	
		function getWeekCampaignUnicode($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 WEEK )  and user_id=$user_id and campaign_status !=3 and campaign_type=0 and is_unicode_sms=1
		GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
		function getMonthCampaignUnicode($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 MONTH )  and user_id=$user_id and campaign_status !=3 and campaign_type=0 and is_unicode_sms=1
		GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
	
		function getYearCampaignUnicode($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , MONTH(created_on ) AS 
			daywise FROM campaigns
			WHERE created_on >= DATE_SUB( NOW( ), INTERVAL 1 YEAR )  and user_id=$user_id and campaign_status !=3 and is_unicode_sms=1 and campaign_type=0
			GROUP BY MONTH( created_on ) ORDER BY created_on DESC ");
			
		
		
				return   $row = $query->result_array(); 		
	}
	//********************Unicode SMS  start********************

	
	//********************Cutomized SMS End********************
	
	
function getWeekCampaignCustomized($user_id)
	{
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 WEEK )  and user_id=$user_id and campaign_status !=3 and campaign_type=4
		GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
		
		
				return   $row = $query->result_array(); 		
	}
	
	
function getMonthCampaignCustomized($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 MONTH )  and user_id=$user_id and campaign_status !=3 and campaign_type=4
		GROUP BY DATE( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
	
function getYearCampaignCustomized($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , MONTH( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 YEAR )  and user_id=$user_id and campaign_status !=3 and campaign_type=4
		GROUP BY MONTH( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
	
	
	
		function getWeekCampaignSchedule($user_id)
	{
		
		 $query =$this->db->query("SELECT SUM(no_of_messages)as totalmsg , DATE( created_on ) AS 
		daywise FROM campaigns
		WHERE created_on > DATE_SUB( NOW( ), INTERVAL 1 WEEK )  and user_id=$user_id and campaign_status !=3 and campaign_type=0 and is_scheduled=1
		GROUP BY MONTH( created_on ) ORDER BY created_on DESC ");
		
				return   $row = $query->result_array(); 		
	}
	
	
	
function getAllCampaigns($user_id, $from_date, $to_date, $is_scheduled, $is_customized, $offset = NULL, $limit = NULL)
	{
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id)
			->where('campaign_status !=','3')
            ->where('is_scheduled', $is_scheduled);

        if($is_customized){
            $this->db->where('campaign_type =', 4);
        } else {
            $this->db->where('campaign_type !=', 4);
        }

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
	echo	$this->db->last_query();
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
	}
	
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
		$this->db->insert_batch('schedule_campaigns_to', $data); 
		//echo $this->db->last_query();
		//exit;

		
		
		
	}
	
	function deductSMSCredits($userId, $sms_length)
	{
		$this->db->query("update users set available_credits = available_credits - $sms_length where user_id='$userId'");
	}
	function Validnumbers($to_mobile)
    {
        
         for($i=0; $i<count($to_mobile); $i++) 
		 {
		     $tmp_number = trim($to_mobile[$i]);
		     if(strlen($tmp_number)==10 )	
			 	 $validNos[]=$tmp_number;
		 }
 
         return $validNos;
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
	}
	
	
	
	
	function get_campaigns_count1($user_id,$sender,$status_,$from_date, $to_date)
	{
		$this->db->where('user_id',$user_id)
			->where('campaign_status !=','3');
			
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



		return $this->db->count_all_results('campaigns');	 	
	}

	
	function getAllCampaigns1($user_id, $sender,$from_date,$to_date,$off_set=0,$limit=0)
	{
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id)
			->where('campaign_status !=','3');
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
		return $rs->result();			
	}
	
	
	function get_campaigns_count($user_id, $from_date, $to_date)
	{
		$this->db->where('user_id',$user_id)
			->where('campaign_status !=','3');
			
		if($from_date) {
			$this->db->where('date(created_on)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(created_on)<=',"$to_date");
		}
		return $this->db->count_all_results('campaigns');		
	}
	
	
	function get_campaigns_report($user_id, $from_date, $to_date)
	{
		$query =$this->db->query("select sum(no_of_messages) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald ,count(campaign_status=0) as processcnt from campaigns where user_id=$user_id and date(created_on)>='$from_date' and date(created_on)<='$to_date'");
		return   $row = $query->result_array(); 
	}
	function get_campaigns_report_default($user_id)
	{
		$query =$this->db->query("select sum(no_of_messages) as totalmsg,sum(expired_count) as exprd,sum(delivered_count) as dlrd,sum(dnd_count) as dnds,sum(pending_dlrs_count) as pndng,sum(invalid_count) as invald,count(campaign_status=0) as processcnt from campaigns where user_id=$user_id order by created_on desc");
		
		

		return   $row = $query->result_array(); 
	}
	
	
	function get_opertatwise_report_default($user_id)
	{
		$query =$this->db->query("select count(*)as cnt ,sw.Network_Operator_Name from campaigns_to as ct,campaigns as cp ,series_wise as sw where  cp.campaign_id=ct.campaign_id and cp.user_id=$user_id and SUBSTRING(ct.to_mobile_no,1,4) =sw.Number_Starts_With and Network_Operator_Name!=''  group by sw.Network_Operator_Name order by sw.Network_Operator_Name ASC");

		return   $row = $query->result_array(); 
	}
	

	function get_locationwise_report_default($user_id)
	{
		$query =$this->db->query("select count(*)as cnt ,sw.Service_Areas_Code  from campaigns_to as ct,campaigns as cp ,series_wise as sw where  cp.campaign_id=ct.campaign_id and cp.user_id=$user_id
and SUBSTRING(ct.to_mobile_no,1,4) =sw.Number_Starts_With and Service_Areas_Code!='' group by sw.Service_Areas_Code  order by sw.Service_Areas_Code ASC");

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
		$sending_port = "";
		$this->db->select('sending_port_no')
			->from('sms_queue')
			->where('application_priority',$port_type)
			->order_by('queued','asc')
			->limit(1);	
			
		$rs = $this->db->get();
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
			$this->db->select('to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
			->from($table_name)
			->where('campaign_id', $campaign_id)
			->order_by('sent_on','asc');
			
		$rs = $this->db->get();
		 $this->db->last_query();
		return $rs->result();
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.campaigns_to_".$month.$year;
			$this->db2->select('to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
			->from($table_name)
			->where('campaign_id', $campaign_id)
			->order_by('sent_on','asc');
			 
		$rs = $this->db2->get();
		 $this->db2->last_query();  
		return $rs->result();
		}

		
	}
	
	
	function get_total_sms_api_count($user_id, $from_date, $to_date)
	{
		$query = "select distinct date(ondate) as ondate,sum(noofmessages) as noofmsg from sms_api_messages where user_id='$user_id'";
		
		
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
	
	function get_SMS_API_Reports($user_id,$from_date,$to_date)
	{
		$query = "select distinct date(ondate) as ondate,sum(noofmessages) as noofmsg from sms_api_messages where user_id='$user_id'";
		
		
		if($from_date) {
			$query .= " and date(ondate) >= '$from_date'";
		}
		if($to_date) {
			$query .= " and date(ondate) <= '$to_date'";
		}
		$query .= " group by date(ondate) order by date(ondate) desc";
		$rs = $this->db->query($query);
		//echo $this->db->last_query();
		return $rs->result();
	}
	
	function get_sms_api_details($ondate,$user_id,$days_diff)
	{
        if($days_diff <= 1){
            $table_name = "sms.sms_api_messages";
            $this->db->select('ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text')
			->from($table_name)
			->where('user_id',$user_id)
			->where('date(ondate)',$ondate);
		$rs = $this->db->get();
		return $rs->result();
        } else {
            $year = substr($ondate,0,4);
            $month = substr($ondate,5,2);
            $table_name = "campaigns_backup.sms_api_messages_".$month.$year;
            $this->db2->select('ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text')
			->from($table_name)
			->where('user_id',$user_id)
			->where('date(ondate)',$ondate);
		$rs = $this->db2->get();
		return $rs->result();
        }
		
	}
	
	function getTotalNumbersCount($campaign_id, $days_diff, $campaign_ondate)
	{
		if($days_diff <= 1) {
			$table_name = "sms.campaigns_to";
			$this->db->where('campaign_id',$campaign_id);
		return $this->db->count_all_results($table_name);
		} else {
			$year = substr($campaign_ondate,0,4);
			$month = substr($campaign_ondate,5,2);
			$table_name = "campaigns_backup.campaigns_to_".$month.$year;
			$this->db2->where('campaign_id',$campaign_id);
		return $this->db2->count_all_results($table_name);
		}
		
	}
	
	function getCampaignNumbers($campaign_id, $mobile_no, $days_diff, $campaign_ondate, $offset = NULL, $limit = NULL)
	{
		if($days_diff <= 1) {
				$table_name = "sms.campaigns_to";
				$this->db->select('to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
				->from($table_name)
				->where('campaign_id', $campaign_id);
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
				$table_name = "campaigns_backup.campaigns_to_".$month.$year;
				$this->db2->select('to_mobile_no,sent_on,dlr_status,error_code,error_text,delivered_on')
				->from($table_name)
				->where('campaign_id', $campaign_id);
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
	
	function get_total_sms_api_days($user_id,$from_date,$to_date)
	{
		$query = "select on_date,sms_count from sms_api_daily_count where user_id='$user_id'";
		
		
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
		$query = "select on_date,sms_count from sms_api_daily_count where user_id='$user_id'";
			
		if($from_date) {
			$query .= " and on_date >= '$from_date'";
		}
		if($to_date) {
			$query .= " and on_date <= '$to_date'";
		}
		$query .= " order by on_date desc limit $offset,$limit";
		$rs = $this->db->query($query);
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
        $this->db->where('dnc_number', $mobile_no);
        return $this->db->count_all_results('dnd_db.ndnc_data');
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
		$rs = $this->db2->query($union_query);
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
		$rs = $this->db2->query($union_query);
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
	
}
 
