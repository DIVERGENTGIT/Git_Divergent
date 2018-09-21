<?php
class Missedcall_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
		

function getMissedCalls_from_To($from_date,$to_date,$mobile_no,$servicenumber,$offset='',$limit='')
	{
		
	
		$this->db->select('called_from,called_time,service_number')
			->from('longecode_db.sms_missedcall');
			
			$this->db->where('user_id',$this->session->userdata('user_id'));
		if($from_date) {
			$this->db->where('date(called_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(called_time)<=',"$to_date");
		}			
		if($mobile_no) {
			$this->db->where('called_from',"$mobile_no");
		}
		if($servicenumber) {
			$this->db->where('service_number',"$servicenumber");
		}
	$this->db->order_by('called_time','desc');
	
	  if(strlen($limit)>0 && strlen($offset)>0){
            $this->db->limit($limit, $offset);
        }

		$rs = $this->db->get();
		
	//echo $this->db->last_query();
		return $rs->result();			
	}
	
	
	/*
function getMissedCalls_from_To($from_date,$to_date,$mobile_no,$servicenumber)
	{
		
	
		$this->db->select('called_from,called_time,service_number')
			->from('missedcall.missed_calls');
			
		if($from_date) {
			$this->db->where('date(called_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(called_time)<=',"$to_date");
		}			
		if($mobile_no) {
			$this->db->where('called_from',"$mobile_no");
		}
		if($servicenumber) {
			$this->db->where('service_number',"$servicenumber");
		}
	$this->db->order_by('called_time','desc');
		$rs = $this->db->get();
	//	echo $this->db->last_query();
		return $rs->result();			
	}
	
	
	function getGVMN()
{
		$this->db->select('service_number')
			->from('missedcall.missed_calls');
			
				$this->db->group_by('service_number');

				$this->db->order_by('service_number','desc');
					$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();	
			
}
	*/
function getGVMN()
{
		$this->db->select('service_number')
			->from('longecode_db.sms_missedcall');
			
				$this->db->group_by('service_number');

				$this->db->order_by('service_number','desc');
					$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();	
			
}

function getcityCount()
	{
		$this->db->select('message')
		->from('longecode_db.sms_messages');
	$this->db->where('user_id',$this->session->userdata('user_id'));
	$this->db->order_by('message_time','desc');
		$rs = $this->db->get();
			return $rs->result();
         
}
	
	function getSmsmessages_from_To($from_date,$to_date,$mobile_no,$offset='',$limit='')
	{
		$this->db->select('message,message_from,message_time,service_number,created_on')
			->from('longecode_db.sms_messages');
						$this->db->where('user_id',$this->session->userdata('user_id'));
		if($from_date) {
			$this->db->where('date(message_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(message_time)<=',"$to_date");
		}			
		if($mobile_no) {
			$this->db->where('message_from',"$mobile_no");
		}
	$this->db->order_by('message_time','desc');
          if(strlen($limit)>0 && strlen($offset)>0){
            $this->db->limit($limit, $offset);
        }

     
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();			
	}
	
	
	function getpriyafoodscractard_from_To($from_date,$to_date,$mobile_no,$offset='',$limit='')
	{
		$this->db->select('message,message_from,message_time,service_number,created_on')
			->from('longecode_db.sms_messages');
						$this->db->where('user_id',$this->session->userdata('user_id'));
						$this->db->where('f_n',1);
		if($from_date) {
			$this->db->where('date(message_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(message_time)<=',"$to_date");
		}			
		if($mobile_no) {
			$this->db->where('message_from',"$mobile_no");
		}
	$this->db->order_by('message_time','desc');
          if(strlen($limit)>0 && strlen($offset)>0){
            $this->db->limit($limit, $offset);
        }

     
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();			
	}
	
	
	/*function getSmsmessages_from_To($from_date,$to_date,$mobile_no)
	{
		$this->db->select('message_from,message,message_time,service_number')
			->from('missedcall.sms_messages');
			
		if($from_date) {
			$this->db->where('date(message_time)>=',"$from_date");
		}
		if($to_date) {
			$this->db->where('date(message_time)<=',"$to_date");
		}			
		if($mobile_no) {
			$this->db->where('message_from',"$mobile_no");
		}
	$this->db->order_by('message_time','desc');
		$rs = $this->db->get();
		//echo $this->db->last_query();
		return $rs->result();			
	}*/
	
  

	
	
}
	