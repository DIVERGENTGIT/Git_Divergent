<?php
class Customized_model extends CI_Model {
	protected $_validarray;	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
               $this ->load->helper("custom");
	       //$this->_validarray = array(7,8,9);
		$this->_validarray = array(1,2,3);
		
	}
	/***
	* Perform the customized Operation
	*@name load_data_cust
        *@author Rushyendra
        */	
	function load_data_cust($file_name,$insert_array,$credits,$is_sms=0,$dnd_check=0,$user_type=0)
	{
		$file_path = FILEPATH;
		$new_file =  "uploads/abc_2".rand().".csv"; 
		chmod($file_name,0777);
	
		$error = ''; 
		/*** Load the database 2 ***/		
		$db2 = $this->load_2nddb();
		/**** Insert the Job ****/
		$this->benchmark->mark('job-start');
                $db2->insert(SMSDUMPDB.".job_cust", $insert_array);
		$job_id = $db2->insert_id(); 
		if(!$job_id)
		{
			return array(array(),array(),'','Job Id is not inserted');
		}
		$this->benchmark->mark('job-end');
		disp_error_log(" Generate the Job duration : ".$this->benchmark->elapsed_time('job-start','job-end'));	
                /************* Each mobile no, job id is inserted *******/
		$this->benchmark->mark('jobidins-start');
	        $each_line =  "sed 's/^/".$job_id.",/' ".$file_name." > ".$file_path.$new_file ;
		$each_res = shell_exec($each_line);
               
		if($each_res != "")
			return array(array(),array(),'',$each_res);
			
		chmod($file_path.$new_file,0777);
		$this->benchmark->mark('jobidins-end'); /**** Each job id is inserted end here ********/
		disp_error_log(" Insert job Id : ".$this->benchmark->elapsed_time('jobidins-start','jobidins-end'));	
                /****** Create the Temporary table ***/
	        $db2->trans_start();
                $this->benchmark->mark('table-start'); 
		$db2->query(" CREATE TABLE ".SMSDUMPDB.".`camp_mobile_temp_cust".$job_id."` (
  `job_id` int(11) NOT NULL,
  `field1` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field2` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field3` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field4` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field5` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field6` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field7` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field8` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field9` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field10` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `field11` varchar(255) NOT NULL,
  `field12` varchar(255) NOT NULL,
  `field13` varchar(255) NOT NULL,
  `field14` varchar(255) NOT NULL,
  `field15` varchar(255) NOT NULL,
  `actual_msg` text CHARACTER SET utf8 COLLATE utf8_bin,
  `status` int(1) NOT NULL,
  `mobile_no` bigint(11) NOT NULL,
  KEY `jobidCust100` (`job_id`),
  KEY `actual_msg_index` (`actual_msg`(50)),
  KEY `mobile_no_index` (`mobile_no`),
  KEY `jobCustKey` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"); //create temparory table end here 
		/******  Dump into camp_mobile_temp_cust **************************/
		$db2->query("ALTER TABLE camp_mobile_temp_cust".$job_id." DISABLE KEYS");	
		$this->benchmark->mark('table-end');
		disp_error_log(" temporary table creation duration : ".$this->benchmark->elapsed_time('table-start','table-end'));	
					$this->benchmark->mark('load-start');
		$str = "LOAD DATA INFILE  '".$file_path.$new_file."' 
                        INTO  TABLE ".SMSDUMPDB.".camp_mobile_temp_cust".$job_id."
                        FIELDS TERMINATED BY ','
			ENCLOSED BY '\"'
                        LINES TERMINATED BY '\n'"; 
			
		 $q = $db2->query($str);

		if(!$q)  return  array(array(),array(),'',"Unable to load the dump file");
		
		if(!$q)  return  array(array(),array(),'',"Unable to set system files");

                $db2->query("ALTER TABLE camp_mobile_temp_cust".$job_id." ENABLE KEYS");	
                $db2->trans_complete();
		$this->benchmark->mark('load-end');
		disp_error_log(" Load the data to temp table: ".$this->benchmark->elapsed_time('load-start', 'load-end'));	 
		
                 
                $this->benchmark->mark('getMsgCnt-start');  
		$valid_mobile_no_str = implode(",", $this->_validarray);
		$var_msg_str = 'replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace("'.$insert_array['msg'].'","#15#",field15),"#14#",field14) ,"#13#",field13),"#12#",field12),"#11#",field11),"#10#",field10) ,"#9#",field9),"#8#",field8),"#7#", field7),"#6#",field6),"#5#",field5),"#4#",field4),"#3#",field3),"#2#",field2),"#1#",field1) ';
		$set_msg = " UPDATE ".SMSDUMPDB.".camp_mobile_temp_cust".$job_id." c set c.mobile_no= field".$insert_array['mobile_column'].", c.actual_msg= ".$var_msg_str." where   c.job_id= ".$job_id;	
		$get_msg_str = 'select SUM(IF (length(actual_msg) >160 ,ceil(length(actual_msg)/153) , ceil(length(actual_msg)/160 ))) as totalMsg   from '.SMSDUMPDB.'.camp_mobile_temp_cust'.$job_id.' c  where c.job_id='.$job_id;
		$get_actual_msg_str = 'select SUM(IF (length(actual_msg) >160 ,ceil(length(actual_msg)/153) , ceil(length(actual_msg)/160 ))) as totalActMsg   from  '.SMSDUMPDB.'.camp_mobile_temp_cust'.$job_id.' c where  length(mobile_no)<=9 and  substr(mobile_no,1,1) in ('.$valid_mobile_no_str.')  and  c.job_id='.$job_id;
		
		$con = mysqli_connect($this->db->hostname, $this->db->username, $this->db->password,$this->db->database);
		$get_avail_credits = "select available_credits from ".SMS.".users where user_id=". $insert_array['user_id'];
		$get_tot_act_msg_str = $set_msg.";".$get_avail_credits.";".$get_msg_str.";".$get_actual_msg_str.";";
		$q = mysqli_multi_query($con,$get_tot_act_msg_str);	

 		 $message_array = array();

	       	 if($q)
		{
			do{
			 	if ($result = mysqli_store_result($con)) {
					$row = $result->fetch_row();
				if(isset($row[0]))
				{
				 	$msg_c = $row[0];	
                                  	if($msg_c ==NULL)
						$msg_c = 0;	
				  	$message_array[] = $msg_c;
				}
				$result->free();
				}
			}		
			while(mysqli_next_result($con));
		}else 	return  array(array(),array(),'',mysqli_error($con));
 
		$total_msg = $acual_msg_cnt = $avail_credits = 0;
		if(isset($message_array[0]))	
			$avail_credits = $message_array[0];	
		if(isset($message_array[1]))
			$total_msg = $message_array[1];
		if(isset($message_array[2]))	
		  	$acual_msg_cnt = $message_array[2];	
		/*** Check the balance ***/	
		if($total_msg > $credits)
				return array(array(),array(),'',"Insufficient SMS Credits. Require ".$total_msg." credits");
		$this->benchmark->mark('getMsgCnt-end');
		disp_error_log(" Get message replacement,get message cal: ".$this->benchmark->elapsed_time('getMsgCnt-start', 'getMsgCnt-end')); 
		if($acual_msg_cnt == NULL)
			$acual_msg_cnt = 0;

		 $str_update = "UPDATE ".SMSDUMPDB.".job_cust SET no_of_msg = ".$total_msg.",	actual_no_of_msg= ".$acual_msg_cnt. " WHERE  job_id=".$job_id; 
		$camp_id = 0;

	/********* Run the stored stmt ************/	
	if($acual_msg_cnt <= $avail_credits) 	
	{	
		$this->benchmark->mark('proc-start');
		$update_bal_sql = "update users set available_credits = available_credits - ".
				$acual_msg_cnt." where user_id='".$insert_array['user_id']."'";
		$sch_date = '';
		$is_sch = 0;
		if(isset($insert_array['sch_date']))
			$sch_date = $insert_array['sch_date'];
		if(isset($insert_array['is_schedule']) && $insert_array['is_schedule'] != "")
			$is_sch = $insert_array['is_schedule'];
                 
		$sql_camp =  "INSERT INTO campaigns      
                              (user_id,sender_name,sms_text,sms_count,no_of_messages,campaign_type,campaign_name,".
	                     "is_scheduled,scheduled_on,created_on,job_id,is_unicode_sms,campaign_status,port_no) ".
			    "VALUES( ".$insert_array['user_id'].",'".$insert_array['sender']."','".$insert_array['msg'].
			"',".strlen($insert_array['msg']).",".$total_msg.",". $insert_array['sms_type'] .",'".
			 $insert_array['name']."',".$is_sch.",'".$sch_date."','".
			date("Y-m-d H:i:s")."',".$job_id.",0,0,0)";
		$q = mysqli_multi_query($con, $update_bal_sql.";".$sql_camp.";SELECT LAST_INSERT_ID();");
		if(!$q)
		return  array(array(),array(),'',mysqli_error($con));	
		else
		{
			do{
				if ($result = mysqli_store_result($con)) {
					$row = $result->fetch_row();
					if(isset($row[0]))
						$camp_id = $row[0];	
                                	$result->free();
			    	}
			
			}while(mysqli_next_result($con));
                 }
                $this->benchmark->mark('proc-end');
		disp_error_log("update the Balance and create campaign: ".$this->benchmark->elapsed_time('proc-start','proc-end'));
		
                /**** Move to campaigns_to ********/
		if(!$is_sch && $is_sms){	
			$this->benchmark->mark('move-todump-start');
			$insert_dump_100 = 'INSERT INTO '.SMSDUMPDB.'.camp_mobile_temp_cust_dump_100  (SELECT job_id, field1,field2,field3,field4,field5,field6, field7, field8,field9,field10,field11, field12,field13,field14,field15,actual_msg,status,mobile_no FROM '.SMSDUMPDB.'.camp_mobile_temp_cust'.$job_id.
				' WHERE job_id= '.$job_id.' LIMIT 100)';
			$sql_i = mysqli_multi_query($con, $insert_dump_100.";"."SELECT LAST_INSERT_ID();");
			$last_id = 0;
			if(!$q)
				return  array(array(),array(),'',mysqli_error($con));	
			else
			{
				do{
			 		if ($result = mysqli_store_result($con)) {
						$row = $result->fetch_row();
					if(isset($row[0]))
						$last_id = $row[0];	
                                	$result->free();
			    	}
			
			}while(mysqli_next_result($con));
                 }
		 if(!$last_id )
		{
			$del_cust = 'DELETE FROM '.SMSDUMPDB.'.camp_mobile_temp_cust'.$job_id.' WHERE job_id= '.$job_id.' LIMIT 100';
			$sql = mysqli_query($con,$del_cust);
			
		}
		$this->benchmark->mark('move-todump-end');
		disp_error_log("Move to camp_mobile_temp_cust: ".$this->benchmark->elapsed_time('move-todump-start','move-todump-end'));
		}
		/***** Move to schdule campaigns *************/
		$this->benchmark->mark('move-tosch-start');
		
		$ins_sch = '';
                  if($is_sms) 
		{  
		
                 $ins_sch = "INSERT INTO ".SMS.".schedule_campaigns_to(campaign_id,sms_text,to_mobile_no,created_on) (SELECT ".$camp_id.", actual_msg, mobile_no,NOW() FROM ".SMSDUMPDB.".camp_mobile_temp_cust".$job_id."  WHERE job_id= ".$job_id.")";  
		}else {
			if($is_sch)
			$ins_sch = "INSERT INTO ".SMS.".schedule_campaigns_to(campaign_id,unique_msg_id,sms_text,to_mobile_no,created_on) (SELECT ".$camp_id.", get_unique_msg_id(),actual_msg, mobile_no,NOW() FROM ".SMSDUMPDB.".camp_mobile_temp_cust".$job_id."  WHERE job_id= ".$job_id.")"; 		
		}	
		$sql_i = mysqli_multi_query($con, $ins_sch.";"."SELECT LAST_INSERT_ID();");
		$last_id = 0;
		if(!$q)
		return  array(array(),array(),'',mysqli_error($con));	
		else
		{
			do{
			 	if ($result = mysqli_store_result($con)) {
					$row = $result->fetch_row();
					if(isset($row[0]))
						$last_id = $row[0];	
                                	$result->free();
			    	}
			}while(mysqli_next_result($con));
                 }

                
		if($last_id && $is_sms)
		{
			/*** Drop table****/
			$db2->query("DROP TABLE ".SMSDUMPDB.".camp_mobile_temp_cust".$job_id);
		}
		
		$this->benchmark->mark('move-tosch-end');
		disp_error_log("Move to camp_mobile_temp_cust: ".$this->benchmark->elapsed_time('move-tosch-start','move-tosch-end'));	
		/*** Move the schedule campaigns end here *******/
		
	
	} // actual msg if closed
	else{
		$this->benchmark->mark('move-todrp-start');	
		$db2->query("DROP TABLE ".SMSDUMPDB.".camp_mobile_temp_cust".$job_id);
		$db2->query("DELETE FROM ".SMSDUMPDB.".job_cust where job_id=".$job_id);
		$this->benchmark->mark('move-todrp-end');
		disp_error_log("Insufficient prevs: ".$this->benchmark->elapsed_time('move-todrp-start','move-todrp-end'));
	 }
        
	$user_id = $insert_array['user_id'];	
	$get_mobile_start = $this->benchmark->mark('mobile-start');		
	/*** While procedure is there this is required ***/ 
	mysqli_close($con);
	$db2->close();
	return  $this->get_mobile_job_cust_info($job_id,$insert_array['mobile_column'],$get_mobile_start,$camp_id);       
			
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
	/*** 
	*Get the first prioity port
	*@name getFirstPriorityPort
	*@author Rushyendra
	*/
	function getFirstPriorityPort($port_type)
	{
		$sending_port = "";
		$this->db->select('sending_port_no')
			->from('sms_queue')
			->where('application_priority',$port_type)
                        ->where('queued <',18000)  /**** Rushyendra Added the condition <18000 ****/
			->order_by('queued','asc')
			->limit(1);	
			$this->db->close();	
			$this->load->database();
		$rs = $this->db->get();
		$res = $rs->row_array();
		if(isset($res['sending_port_no']))
			$sending_port = $res['sending_port_no'];	
		
		return $sending_port;
	}
	/**
	*Given number is valid or not
	*@name isValidNo
	@author Rushyendra
	*/
	function isValidNo($mobile_no)
    	{
    	
		$mobile_no  = trim($mobile_no);	
		$validNoCount = 1;
	//if( strlen($mobile_no) < 10 && in_array(substr($mobile_no, 0,1), $this->_validarray))	
         if( strlen($mobile_no) == 10 && in_array(substr($mobile_no, 0,1), $this->_validarray))	
		$validNoCount = 0;
	return $validNoCount; 
    }
    /****
     * Send the qsms table	 
     *@name insert_kennel_send_sms
     *@author Rushyendra	
     */
	function insert_kennel_send_sms($camps,$user_type,$dnd_check=0,$type=0)
	{
		if($type){
		$configdata = array("hostname" => $this->db->hostname,
				"username" => $this->db->username,
                                "password" => $this->db->password,
				"database" => KENNELDB,
				"dbdriver" => $this->db->dbdriver
				);
		$db3 = $this->load->database($configdata,TRUE);
		$table = "tqsend1";
		if(!$user_type)
			$table = "pqsend1";
		else if($dnd_check)
			$table = "tqsend4";
		if(is_object($db3)){
			$db3->insert_batch(KENNELDB.'.'.$table, $camps); 	
		}
           }
	}
	/***
	* Send the data to campaigns_to
	*@name insert_camps_cust
	*@author Rushyendra
	*/
	function insert_camps_cust($camps,$job_id)
	{
		$this->db->insert_batch('campaigns_to', $camps);  //Moved to camps
		$rows = $this->db->affected_rows();
		if($rows ){
                        $db2 = $this->load_2nddb();
			//$db2->where_in("mobile_no ", $mobiles);
                        $db2->where("job_id",$job_id);
			$db2->delete("camp_mobile_temp_cust_dump_100");  //Delete that record in temp table
			/*** Delete the Job ***/
			$db2->where("job_id", $job_id);
			$db2->delete("job_cust");
		}	
	}
	/**
	* Update the campaign status
	*@name update_campaign_status
	@author Rushyendra
	*/
	function update_campaign_status($campaign_id, $status)
	{
		$data = array('campaign_status' => $status);
		$this->db->where('campaign_id', $campaign_id);
		$this->db->update('campaigns',$data);
		//echo $this->db->last_query();
	}
	/**
	* Check the DND Number
	*@name checkIsDND
	*@author Rushyendra
	*/	
	function checkIsDND($mobile_no)
    	{
		$configdata = array("hostname" => $this->db->hostname,
				"username" => $this->db->username,
                                "password" => $this->db->password,
				"database" => DNDDB,
				"dbdriver" => $this->db->dbdriver
				);
		$db3 = $this->load->database($configdata,TRUE);
        	$db3->where('dnc_number', $mobile_no);
		$db3->from("ndnc_data"); 
        	return $db3->count_all_results();
    	}
	/**
	* Get the last campaigns 
	*@name getCampaignsLast
	*@author Rushyendra
	*/
	function getCampaignsLast($user_id)
	{
		
		$this->db->select()
			->from('campaigns')
			->where('user_id',$user_id);
		$this->db->where('created_on >= DATE_SUB(NOW(),INTERVAL 1 YEAR)');

		$this->db->order_by('created_on','desc')
			->limit(10);
		$rs = $this->db->get();
		
		return $rs->result();			
	}
	/***
	* Create the campaign
	*@name createCampaign
	*@author Rushyendra
	*/
	function createCampaign($userId,$sms_type,$sms_text,$sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,
			$campaign_name,$sms_length =0)
	{
		// calculate SMS length
		if(!$sms_length) { 
			if(strlen($sms_text)>160)
				$sms_length_tmp=ceil(strlen($sms_text)/153);
			else
			$sms_length_tmp=ceil(strlen($sms_text)/160);
		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		}
		if($sms_port == '')
			$sms_port = 0;
		$values = array(
			'user_id' => $userId,
			'sender_name' => $sender,
			'sms_text' => $sms_text,
			'sms_count' => "$sms_length",
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
	/*
	*Deduct the balance
	*@name deductSMSCredits
	*@author Rushyendra
	*/
	function deductSMSCredits($userId, $sms_length)
	{
		$this->db->query("update users set available_credits = available_credits - ".$sms_length." where user_id='".$userId."'");
		//echo $this->db->last_query(); 
	}
	/***
	* Insert the camapigns_to
        *@name camp_insert
	*@author Rushyendra
        */
	function camp_insert($data)
	{
		$error = '';
		$q = $this->db->insert_batch("campaigns_to", $data); 
                if(!$q) 
		$error = $this->db->_error_message();
		return $error;		 	
	}
	/**
	* Move to schedule camapign
	*@name scheduledCampaignTo1
	*@author Rushyendra
	*/
	function scheduledCampaignTo1($data)
	{
	
		if(count($data)>0)
			$this->db->insert_batch('schedule_campaigns_to', $data); 
	
	}
	/**
	* Get the sender names 
	*@name getSenderNames
	*@author Rushyendra
	*/
	function getSenderNames($user_id)
	{
		$this->db->select()
			->from('sender_names')
			->where('user_id',$user_id);
		$rs = $this->db->get();

		return $rs->result();	 		
	}
	/**
         *@name load_2nddb
          *@author Rushyendra		
         */
	 function load_2nddb()
	{
		$configdata = array("hostname" => $this->db->hostname,
				"username" => $this->db->username,
                                "password" => $this->db->password,
				"database" => SMSDUMPDB,
				"dbdriver" => $this->db->dbdriver
				);

		$db2 = $this->load->database($configdata,TRUE);
			return $db2;
	}
	/***
	* Get the Mobile Information
	@name get_mobile_job_info
	@author Rushyendra
	*/
	function get_mobile_job_cust_info($job_id,$mob_index,$get_mobile_start,$camp_id)
	{
		$error = '';

		$message = 'replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(j.msg,"#15#",field15),"#14#",field14) ,"#13#",field13),"#12#",field12),"#11#",field11),"#10#",field10) ,"#9#",field9),"#8#",field8),"#7#", field7),"#6#",field6),"#5#",field5),"#4#",field4),"#3#",field3),"#2#",field2),"#1#",field1) as actualMsg';
		/**** Get the Mobile nos ****/
		$db2 = $this->load_2nddb();
		$str = " SELECT field".$mob_index." as mobileNo,".$message." from  job_cust j inner join camp_mobile_temp_cust_dump_100 c on c.job_id= j.job_id  where j.job_id=".$job_id;
		
		$q = $db2->query($str);
                $info_array = array();
		if($q !== FALSE){	
                	if($q->num_rows()>0) 
			$info_array = $q->result_array();
			}else{
			$error =  $db2->_error_message(); 
		}
		
		$db2->select(array("j.job_id","j.sender","j.sms_type", "j.is_schedule", "j.sch_date", "j.name", "j.user_id"));
		$db2->from("job_cust j");
		//$this->db->join("job_camp c", "c.job_id=j.job_id","inner");
		$db2->where("j.job_id",$job_id);

		$jobs  = $db2->get();
                $jobs_array = array();
		if($jobs !== FALSE)
                {
			if($jobs->num_rows()>0)
			$jobs_array = $jobs->row_array();
			$jobs_array['camp_id'] = $camp_id;
		}else {
			$error = $db2->error_message();
			}
		return array($info_array,$jobs_array, $get_mobile_start,$error);
	}


}
?>
