<?php
class contact_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	function group_view_ajax($user_id,$group_id)
	{
		$query =$this->db->query("select group_id,group_name,created_on from contact_groups where user_id=$user_id  and group_id=$group_id order by group_name asc");
//echo $this->db->last_query();
		return   $row = $query->result_array(); 
		
	}

	function contact_list_view_ajax($user_id,$group_id)
	{
		$query =$this->db->query("select contact_id  from contacts where  user_id=$user_id and group_id=$group_id and group_id != 0" );
 		if($query->num_rows() > 0) {
		return   $row = $query->result_array();  
		}else{  

		return array();
}  
		
	}
	
	function contact_view_ajax($user_id,$group_id)
	{
		$query =$this->db->query("select contact_id,group_id, name,dob,address,join_date,relieve_date, mobile_no,gender from contacts where  user_id=$user_id and group_id=$group_id and group_id != 0" );
//echo $this->db->last_query();
		return   $row = $query->result_array();  
		
	}  
	
	function getContactsByIds_ajax($user_id,$contact_ids)
	{
		
		$ids = explode(",",$contact_ids);
		
		$this->db->select('mobile_no')
			->from('contacts')
			->where('user_id',$user_id);
			if(!empty($ids))
			{
			$this->db->where_in('contact_id',$ids);
			}
		$rs = $this->db->get();
		//echo  $this->db->last_query();
		return $rs->result();
	}
	function getGroupContacts_ajax($user_id, $groups)
	{
		
		
		
		if(!empty($groups))
		{
				$query = "select distinct c.mobile_no,c.name,c.group_id,c.contact_id from contacts c, contact_groups cg where c.user_id='$user_id' and c.group_id=cg.group_id and c.user_id=cg.user_id ";
			$query .=" and c.group_id in ({$groups})";
		}else
		{
			$groups=0;
			$query = "select distinct c.mobile_no,c.name,c.group_id,c.contact_id from contacts c, contact_groups cg where c.user_id='$user_id' and c.group_id=cg.group_id and c.user_id=cg.user_id ";
			$query .=" and c.group_id in ({$groups})";
		}
		$rs = $this->db->query($query);
		//echo $this->db->last_query();

		return $rs->result();
	}
	
	
	
	function getGroupsMobile($user_id, $mobile_no)
	{
		$this->db->select('contact_groups.group_id,contact_groups.group_name')
			->from('contact_groups')
			->join('contacts','contact_groups.group_id =contacts.group_id','left')
			->where('contact_groups.user_id',$user_id);
		if($mobile_no){
			$this->db->where('contacts.mobile_no',$mobile_no);
		}	
		
		$this->db->group_by('group_id');
		$this->db->order_by('group_name','asc');
		$rs = $this->db->get();
		return $rs->result();		
	}
	
	function getGroups($user_id)
	{
		$this->db->select('group_id,group_name')
			->from('contact_groups')
			->where('user_id',$user_id);
		
		$this->db->order_by('group_name','asc');
		$rs = $this->db->get();
		return $rs->result();		
	}
	
	function getAllContacts($user_id, $group_id = null)
	{
		$this->db->select('contact_id, name, mobile_no,gender')
			->from('contacts')
			->where('user_id',$user_id)
			->where('group_id', $group_id);
			
		//if($group_id) {
			//$this->db->where('group_id', $group_id);
		//}
		
		$this->db->order_by('name','asc');
			
		$rs = $this->db->get();
		 $this->db->last_query();
		return $rs->result();		
	}
	
	function getTotalGroupsCount($user_id,$group_id = null)
	{
		$this->db->where('user_id',$user_id);
		return $this->db->count_all_results('contact_groups');
	}
	
	function getTotalContactsCount($user_id, $group_id)
	{
		$this->db->where('user_id',$user_id)
			->where('group_id', $group_id);
		return $this->db->count_all_results('contacts');	
	}
	 
	
	function getContactsByIds($user_id,$contact_ids)
	{
		$ids = explode(",",$contact_ids);
		$this->db->select('mobile_no')
			->from('contacts')
			->where('user_id',$user_id)
			->where_in('contact_id',$ids);
			
		$rs = $this->db->get();
		return $rs->result();
	}
	
	function getCities()
	{
		$this->db->select('id, region')
			->from('region')
			->order_by('region','asc');
			
		$rs = $this->db->get();
		return $rs->result();	
	}
	
	function addContact($user_id, $group_id, $name, $mobileno, $gender, $dob, $address, $city, $joindate, $relievedate)
	{
		$values = array(
			'user_id' => $user_id,
			'name' => $name,
			'gender' => $gender,
			'city_id' => $city,
			'mobile_no' => $mobileno,
			'dob' => $dob,
			'group_id' => $group_id,
			'address' => $address,
			'join_date' => $joindate,
			'relieve_date' => $relievedate
		);
		$this->db->insert('contacts', $values);
		 return $this->db->last_query();
	}
	
	function addGroup($user_id, $group_name)
	{
		if($group_name != NULL) {
			$values = array(
			'user_id' => $user_id,
			'group_name' => $group_name
		);
			$this->db->insert('contact_groups', $values);
			return $this->db->insert_id();
		}else{
			return False;
		}
		
	}
	
	function getContactDetails($user_id, $contact_id)
	{
		$this->db->select()
			->from('contacts')
			->join('contact_groups','contact_groups.group_id = contacts.group_id')
			->where('contact_id',$contact_id)
			->where('contact_groups.user_id', $user_id);
			
		$rs = $this->db->get();
		return $rs->result();	
	}

	
	
	function updateContact($contact_id, $user_id, $group_id, $name, $mobileno, $gender, $dob, $address, $join_date, $relieve_date)
	{
		$data = array(
			'name' => $name,
			'gender' => $gender,
			'mobile_no' => $mobileno,
			'dob' => $dob,
			'group_id' => $group_id,
			'address' => $address,
			'join_date' => $join_date,
			'relieve_date' => $relieve_date
		);
		$this->db->where('contact_id', $contact_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('contacts',$data);
		//return $this->db->last_query();
	}
	
	function deleteContact($user_id,$contact_id)
	{
		$this->db->delete('contacts', array('contact_id' => $contact_id, 'user_id' => $user_id)); 
	}
	

	
	function getGroupName($user_id,$group_id)
	{
		$this->db->select('group_name')
			->from('contact_groups')
			->where('group_id', $group_id)
			->where('user_id', $user_id);
			
		$rs = $this->db->get();
		$group_name = "";
		foreach($rs->result() as $row) {
			$group_name = $row->group_name;
		}
		return $group_name;
	}
	
	function deleteGroup($user_id, $group_id) 
	{
		$this->db->delete('contact_groups', array('group_id' => $group_id, 'user_id' => $user_id)); 
	}
	
	function editGroup($group_id,$groupName)
	{
		$data = array(
			'group_name' => $groupName
		);
		$this->db->where('group_id', $group_id);
		$this->db->update('contact_groups',$data);
	}
	
	function getGroupContacts($user_id, $groups)
	{
		$query = "select distinct mobile_no from contacts where user_id='$user_id' and group_id in ($groups)";
		
		$rs = $this->db->query($query);
		return $rs->result();
	}
	
	function getContacts($user_id, $contacts)
	{
		$query = "select distinct mobile_no from contacts where user_id='$user_id' and contact_id in ($contacts)";
		
		$rs = $this->db->query($query);
		return $rs->result();
	}
	
	function getMobileGroups($user_id, $mobile)
	{
		$query = "select distinct g.group_id,g.group_name 
				  from contact_groups g,contacts c 
				  where g.group_id=c.group_id and g.user_id='$user_id' and c.mobile_no='$mobile'";
		
		$rs = $this->db->query($query);
		return $rs->result();
	}
   
	public function getGroupData($user_id,$group_id) {
		$groupinfo = $this->db->select('contact_groups.*,count(contacts.group_id) as count')
					->from('contact_groups')
					->join('contacts','contacts.group_id = contact_groups.group_id')
					->where('contact_groups.group_id',$group_id)
					->where('contact_groups.user_id',$user_id)
					->group_by('contact_groups.group_id')
					->get();

		return $groupinfo->result_array();
		
	} 

	public function getGroupInfo($user_id,$group_id) {
		$groupinfo = $this->db->query("SELECT `contact_groups`.`group_name`, count(contacts.group_id) as count FROM (`contact_groups`) JOIN `contacts` ON `contacts`.`group_id` = `contact_groups`.`group_id` WHERE `contact_groups`.`group_id` IN ($group_id) AND `contact_groups`.`user_id` = $user_id GROUP BY `contact_groups`.`group_id`");
		/*$groupinfo = $this->db->select('contact_groups.group_name,count(contacts.group_id) as count')
					->from('contact_groups')
					->join('contacts','contacts.group_id = contact_groups.group_id')
					->where_in('contact_groups.group_id',)
					->where('contact_groups.user_id',$user_id)
					->group_by('contact_groups.group_id')
					->get();  */
 
		return $groupinfo->result_array();

	}

	public function getContactsInfo($user_id,$group_id,$contactid) {
		$groupinfo = $this->db->query("SELECT `contact_groups`.`group_name`, count(contacts.group_id) as count FROM (`contact_groups`) JOIN `contacts` ON `contacts`.`group_id` = `contact_groups`.`group_id` WHERE `contact_groups`.`group_id` IN ($group_id) AND `contact_groups`.`user_id` = $user_id AND `contacts`.`contact_id` IN ($contactid) GROUP BY `contact_groups`.`group_id`");
		 
 
		return $groupinfo->result_array();

	}
  
	function getContactDetails_new($user_id,$contact_id,$group_id)
	{
		$this->db->select() 
			->from('contacts')
 			->where('contact_id',$contact_id)
			->where('group_id',$group_id)
			->where('contacts.user_id', $user_id);
			
		$rs = $this->db->get();
		return $rs->result();	
	}

	function checkGroupName($user_id,$group_name) {
		$query = $this->db->select('group_id')
				 ->from('contact_groups')
				 ->where('user_id',$user_id)
				 ->where('group_name',trim($group_name))
				 ->order_by('group_id','desc')
  				 ->limit(1) 
				 ->get();
		return $query->row('group_id');  
	}






}
