<?php
class alerts_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function addAlert($user_id, $field_id, $field_name, $days_before, $on_time, $sms_txt)
	{
		$values = array(
			'user_id' => $user_id,
			'field_id' => $field_id,
			'field_name' => $field_name,
			'sms_text' => $sms_txt,
			'days_before' => $days_before,
			'on_time' => $on_time
		);
		$this->db->set('created_on', 'NOW()', FALSE);
		if($this->db->insert('sms_alerts', $values)){
			return $this->db->insert_id();
		}
		return false;
	}
	
	function alertsTo($alert_id,$group_id)
	{
		$values = array(
			'alert_id' => $alert_id,
			'group_id' => $group_id
		);
		$this->db->insert('alerts_to_groups', $values);
	}
	
	function getAlertsCount($user_id)
	{
		$this->db->where('user_id',$user_id);			
		return $this->db->count_all_results('sms_alerts');
	}
	
	function getSMSAlerts($user_id,$offset = 0,$limit)
	{
		$this->db->select()
			->from('sms_alerts')
			->where('user_id',$user_id)
			->where('status != "2"');
					
		$this->db->order_by('created_on','desc')
			->limit($limit, $offset);
		$rs = $this->db->get();
		return $rs->result();
	}
	
	function getAlertGroups($alert_id)
	{
		$query = "select g.group_id, g.group_name 
			from contact_groups g, alerts_to_groups a
			where a.group_id = g.group_id and a.alert_id = '$alert_id'
		";
		$rs = $this->db->query($query);
		return $rs->result();
	}
	
	function getAlertDetails($user_id, $alert_id)
	{
		$query = "select * from sms_alerts where alert_id='$alert_id' and user_id='$user_id'";
		$rs = $this->db->query($query);
		return $rs->result();
	}
	
	function changeStatus($user_id, $alert_id, $status)
	{
		$data = array(
			'status' => $status
		);		
		$this->db->where('alert_id', $alert_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('sms_alerts',$data);
	}
	
	function updateAlert($user_id, $alert_id, $field_id, $field_name, $days_before, $on_time, $sms_txt)
	{
		$data = array(
			'field_id' => $field_id,
			'field_name' => $field_name,
			'days_before' => $days_before,
			'on_time' => $on_time,
			'sms_text' => $sms_txt
		);
		
		$this->db->where('alert_id', $alert_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('sms_alerts',$data);
	}
	
	function deleteAlertsTo($alert_id) 
	{
		$this->db->where('alert_id', $alert_id);
		$this->db->delete('alerts_to_groups'); 
	}
	
}	