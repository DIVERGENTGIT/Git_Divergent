<?php
class sms_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	public function getsmspricelist()
	{
		$this->db->select()
				 ->from('sms_price_list');
		$query=$this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return false;
	}
	
public function getsmspricerange($id)
	{
		$this->db->select()
				 ->from('sms_price_list')
				  ->where('id', $id);
		$query=$this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return false;
	}
	
public function getUserDetails($user_id)
	{
		$this->db->select()
				 ->from('users')
				  ->where('user_id', $user_id);
		$query=$this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}
		return false;
	}
	
public function insertLeadDetails($noofsms,$smstype,$userId,$name,$email,$mobile,$otpverify)
	{
		$values = array(
		    'noofsms' => $noofsms,
		    'smstype' => $smstype,
		     'servicetype' => 'sms',
            'registeruser_id' => $userId,
            'name' => $name,
		    'email' => $email,
		    'mobile' => $mobile,
		    'otpverify' => $otpverify
        );

        $this->db->set('created_on', 'NOW()', FALSE);
        $rs = $this->db->insert('price_enquery', $values);
        
        return $rs;
	}
}
