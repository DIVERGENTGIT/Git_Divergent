<?php
class reseller_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function get_users_count($user_id)
	{
		$this->db->where('reseller_id',$user_id);
		
		return $this->db->count_all_results('users');
	}
	
	function get_users($user_id, $offset = NULL, $limit = NULL)
	{
		$this->db->select()
			->from('users')
			->where('reseller_id',$user_id);
			
		$this->db->order_by('registered_on','desc')
			->limit($limit, $offset);
		$rs = $this->db->get();
		return $rs->result();
	}
	
	function get_user_payments($user_id, $reseller_id, $offset = NULL, $limit = NULL)
	{
		$this->db->select()
			->from('user_payments')
			->where('user_id',$user_id)
			->where('added_by',$reseller_id);
			
		$this->db->order_by('on_date','desc')
			->limit($limit, $offset);
		$rs = $this->db->get();
		return $rs->result();		
	}
	
	function get_user_payments_count($user_id, $reseller_id)
	{
		$this->db->where('user_id',$user_id)
			->where('added_by',$reseller_id);
		
		return $this->db->count_all_results('user_payments');
	}
}