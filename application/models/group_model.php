<?php
class group_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function get_groups_count($user_id, $search_str = null)
	{
		$this->db->where('user_id',$user_id);
		
		if($search_str) {
			$this->db->like('group_name', $serach_str);
		}
		
		return $this->db->count_all_results('groups');		
	}
	
	function getGroups($user_id, $offset = NULL, $limit = NULL, $search_str = null)
	{
		$this->db->select('group_id,group_name,count,on_date')
			->from('groups')
			->where('user_id',$user_id);
		
		if($search_str) {
			$this->db->like('group_name', $serach_str);
		}
		
		$this->db->order_by('on_date','desc')
			->limit($limit, $offset);
			
		$rs = $this->db->get();
		return $rs->result();		
	}
	
	function getGroupDetails($group_id,$user_id)
	{
		$this->db->select('group_id,group_name,count,on_date')
			->from('groups')
			->where('user_id',$user_id)
			->where('group_id',$group_id);
			
		$rs = $this->db->get();
		if($rs) {
			return $rs->result();
		}
		return false; 
	}
	
	function deleteGroup($group_id)
	{
		$this->db->where('group_id', $group_id);
		$this->db->delete('groups'); 
		
		$this->db->where('group_id', $group_id);
		$this->db->delete('group_numbers'); 
	}
	
	function getGroupNumbers($group_id)
	{
		$this->db->select('mobile_no')
			->from('group_numbers')
			->where('group_id', $group_id);
		$rs = $this->db->get();
		if($rs) {
			return $rs->result();
		}
		return false;	
	}
}