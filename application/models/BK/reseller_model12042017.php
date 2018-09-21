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
	
	function get_users_countnew($user_id)
	{
		$sql3="select * from users where reseller_id=$user_id
		order by user_id desc";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
		return $query->num_rows();
		}
		else
		{
		return 0;
		}
	}
	function get_usersnew($user_id, $offset, $limit)
	{
		$sql3="select * from users where reseller_id=$user_id
		order by user_id desc limit $offset,$limit";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
		return $query->result();
		}
		else
		{
		return array();
		}
	}
	
	function updmyUserDetails($clientId, $first_name, $last_name, $email, $mobile, $address1,
        $address2, $city, $organization, $pincode,$useracctype)
	{
        $values = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'mobile' => $mobile,
            'address1' => $address1,
            'address2' => $address2,
            'city_id' => $city,
             'organization' => $organization,
            'zipcode' => $pincode,			
	'useracctype' => $useracctype
        );		
        

        $this->db->where('user_id', $clientId)
            ->update('users', $values);
            
  //   echo  $this->db->last_query();

     //return true;
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
		//echo $rs = $this->db->last_query();
		return $rs->result();		
	}
	
	function get_user_payments_count($user_id, $reseller_id)
	{
		$this->db->where('user_id',$user_id)
			->where('added_by',$reseller_id);
		
		return $this->db->count_all_results('user_payments');
	}
}
