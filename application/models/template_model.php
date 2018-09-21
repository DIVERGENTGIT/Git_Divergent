<?php
class template_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function addTemplate($user_id, $template)
	{
		$data = array(
   			'sms_template' => $template ,
   			'user_id' => $user_id
		);
		$this->db->set('on_date', 'NOW()', FALSE);
		$this->db->insert('sms_templates', $data); 
	}
	
	function get_templates_count($user_id)
	{
		$this->db->where('user_id',$user_id);
		
		return $this->db->count_all_results('sms_templates');		
	}
	
	function getTemplates($user_id, $offset = NULL, $limit = NULL)
	{
		$this->db->select('template_id,sms_template,on_date')
			->from('sms_templates')
			->where('user_id',$user_id);
		
		
		$this->db->order_by('on_date','desc')
			->limit($limit, $offset);
			
		$rs = $this->db->get();
		return $rs->result();
	}
	
	function getTemplateDetails($user_id,$template_id)
	{
		$this->db->select('template_id,sms_template,on_date')
			->from('sms_templates')
			->where('user_id',$user_id)
			->where('template_id', $template_id);
			
		$rs = $this->db->get();
		if($rs) {
			return $rs->result();
		}
		return false;
	}
	
	function delete($template_id)
	{
		$this->db->where('template_id', $template_id);
		$this->db->delete('sms_templates'); 
	}
	
}