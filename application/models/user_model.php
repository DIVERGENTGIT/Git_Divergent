<?php

class user_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function getPaymentUserDetails($user_id)
	{
		
		$this->db->select()
				 ->from('users')
				 ->where('user_id',$user_id);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;
	}

	 
	
	public function usernameExist()
	{
		$username=$this->input->post('user_name');
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('username',$username);
		$query=$this->db->get();
		
		/*
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;*/
		
		return $query->num_rows();
	}
	
	public function getusernameExist()
	{
		$username=$this->input->post('user_name');
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('username',$username);
		$query=$this->db->get();
		
		
		if ($query->num_rows()>=1) {
			return $query->result();
		}
		return array();
		
		
	}
	
	public function mincheckbalance()
	    {    
	    $this->db->select('value')
	    ->from('global_settings')
	    ->where('setting_name','minimum_balance_checker');
	    $query=$this->db->get();
	  // echo  $this->db->last_query();
	    return $rs=$query->result();
	    }
	
	public function mobilenoExist($mobile_number)
	{
		 
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('mobile',$mobile_number);
		$query=$this->db->get();
		
		return $query->num_rows();
	}
	
	public function usernamechecker($user_name)
	{
		
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('username',$user_name);
		$query=$this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;
	}
	
	
	
	public function getUserProfileData($user_id)
	{
		
		  $sql="select u.user_id,u.username,u.first_name,u.last_name,u.email,u.mobile,u.organization,u.address1,u.address2,u.city_id,u.state_id,
		 c.city_name,s.state,u.zipcode,
		p.profile_img from users u
		left join new_citylist c on c.city_id=u.city_id
		left join new_statelist s on s.state_id=u.state_id
		left join profile_images p  on p.user_id=u.user_id  
		where u.user_id='$user_id'";
		
		  $rs=$this->db->query($sql)->result();
 
		 // print_r($rs);
		       if(count($rs)>0)
		       {
		       return $rs;
		       }
		       else
		       {
		       return array();
		       }
	}
	
	public function getStates()
	{
		
		 $sql="select state,state_id from new_statelist  group by state_id order by state asc"; 
		
		
		return $rs=$this->db->query($sql)->result();
	}
	
	public function UpdateUserProfileData($user_id, $firstname, $lastname, $username, $email_id,  $mobile_number,  $orginization, $address, $state_id, $city_id,$pincode) 
	{
		
		
		  $sql="Update users set first_name='$firstname',last_name='$lastname',
		 email='$email_id',mobile='$mobile_number',organization='$orginization',address1='$address',city_id='$city_id',zipcode='$pincode',state_id='$state_id'
		 where user_id='$user_id'"; 
		
		
		 $rs=$this->db->query($sql);
		
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
		public function UpdateUserProfileDatamobileexit($user_id, $firstname, $lastname, $username, $email_id, $orginization, $address, $state_id, $city_id,$pincode) 
	{
		
		
		  $sql="Update users set first_name='$firstname',last_name='$lastname',
		 email='$email_id',organization='$orginization',address1='$address',city_id='$city_id',zipcode='$pincode',state_id='$state_id'
		 where user_id='$user_id'"; 
		
		
		 $rs=$this->db->query($sql);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	public function changepassword($user_id,$oldpassword,$newpassword)
	{
		
		  $sql="Update users set password='$newpassword'
		 where user_id='$user_id' and password='$oldpassword'";
		return $rs=$this->db->query($sql);
	}
	
	public function admin_changepassword_user($user_id,$reseller_id,$newpassword)
	{
		
		 $sql="Update users set password='$newpassword'
		 where user_id='$user_id' and reseller_id = '$reseller_id'";
		return $rs=$this->db->query($sql);
	}
	
	public function Check_OLD_password($user_id,$oldpassword)
	{
		 $sql="select password from users where user_id='$user_id' and password='$oldpassword'"; 
		
		return $rs=$this->db->query($sql)->result();
	}
	
	public function UpdateUserProfilePic($user_id, $filename) 
	{
		
		$sql="select * from profile_images   where user_id='$user_id'";
		echo $exist=count($this->db->query($sql)->result());
		
		if($exist>0)
		{
		 
		 $sql="Update profile_images set profile_img='$filename'
		 where user_id='$user_id'"; 
		
		return $rs=$this->db->query($sql);
		 
		}
		else
		{
		   $sql="INSERT INTO `profile_images` (`id`, `profile_img`, `profile_backgroundimg`, `user_id`) VALUES (NULL, '$filename', '', '$user_id')"; 
		
		return $rs=$this->db->query($sql);
		}
		
	}
	
	public function getCities($stateid)
	{
		
		 $sql="select city_id,city_name from new_citylist where state_id='$stateid' group by city_id order by city_name asc "; 
		
		
		return $rs=$this->db->query($sql)->result();
	}
	
	public function users_register($mobile_number,$username,$email,$password)
	{
		
		$values = array(
			'mobile' => $mobile_number,
			'username' => $username,
			'email' => $email,
			'mverify' => 1,
			'useracctype'=>1,
			'is_user'=>1,
			'password' => md5($password)
			);
			
		$this->db->set('registered_on', 'NOW()', FALSE);
		$this->db->insert('users', $values);
		return $this->db->insert_id();
	}
	
	public function login($username,$password)
	{
	     $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
             $query=$this->db->query($sql, array($username, $password));
				

		if ($query->num_rows() > 0) 
		{
			$salted="sihtmcdtakny".$password."cmkspudv";
			$hashed=hash('sha512',$salted);
			$sqlpwd="Update users set salt_pwd='$hashed' where username='$username'"; 
			$this->db->query($sqlpwd);
			return $query->result();
			
		}
		else
		{
		        return false;
		}
	}
	
	public function generateNewPassword($user_id, $new_password)
	{
		$values = array(
			'password' => md5($new_password)
		);
		$this->db->where('user_id',$user_id) 
			->update('users',$values);
			if ($this->db->affected_rows() > 0)
{
  return TRUE;
}
else
{
  return FALSE;
}
	}
	
	public function getUserDetails($user_id)
	{
		$this->db->select()
			->from('users')
			->join('region','region.id = users.city_id','left')
			->where('users.user_id',$user_id);
			
		$query=$this->db->get();
		return $query->result();	
	}
	
	public function getUserInfoDetails($user_id)
	{
		$this->db->select()
			->from('users')
			->where('user_id',$user_id);
			
		$query=$this->db->get();
 
		return $query->result();	
	}
	
    public function getSenderNames($user_id)
	{
	$this->db->select()
	->from('sender_names')
	->where('user_id', $user_id);

	$query = $this->db->get();
	return $query->result();
	}
	
	
	
	public function put_sendername_templates($user_id,$sender_names,$customer_sms_temp,$vender_phoneno,$vendor_sms_temp)
	{
	
	$sql="INSERT INTO  sendernames_template(sender_name,cus_sms_temp,vender_phone,vender_sms_temp,user_id) VALUES('$sender_names','$customer_sms_temp','$vender_phoneno','$vendor_sms_temp','$user_id')";
	 return $rs= $this->db->query($sql);
	
	
	
	}
	
	public function isSenderNameAvailable($user_id, $sender_name)
    {
        $this->db->select('sender_name')
            ->from('sender_names')
            ->where('user_id', $user_id)
            ->where('sender_name', $sender_name);

        $query = $this->db->get();
       	if($query->num_rows() > 0)
       		return false;
       	else
        	return true;
    }
    
      public function addSenderName($user_id, $sender_name)
    {
        $values = array(
            'user_id' => $user_id,
            'sender_name' => $sender_name
        );

        $this->db->set('on_date', 'NOW()', FALSE);
        $rs = $this->db->insert('sender_names', $values);
        return $rs;
    }
    
    public function availablebalance($user_id)
    {    
    $this->db->select('main_balance,mobile,username')
    ->from('users')
    ->where('user_id',$user_id);
    $query=$this->db->get();
   
    return $rs=$query->result();
    if($rs>0){
     return $query->result();
    } 
    else
    {
    return array();
    }
    
   
    }
    public function getagents($user_id)
    {    
    $this->db->select()
    ->from('users')
    ->where('reseller_id',$user_id)
    ->where('is_agent',1);
    $query=$this->db->get();
  // echo $this->db->last_query();
    return $rs=$query->result();
    
   
    }
		public function userExist()
	{
		$username=$this->input->post('username');
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('username',$username);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;
	}
	
  public function firstringavailablebalance($user_id)
    {    
    $this->db->select('main_balance')
    ->from('users')
    ->where('user_id',$user_id);
    $query=$this->db->get();
   
    return $rs=$query->result();
    
   
    }
    
    public function didbasedbalncecheck($user_id,$campaign_type,$multididnumbers)
    {
    
     $i=0;
     $arr=array();
    for($i=0;$i<count($multididnumbers);$i++)
    {
	 $sql="SELECT uc.sms_credits, u.main_balance, uc.did_number,uc.did_service,uc.vc_amount
		FROM `users_servicewise_credits` uc
		INNER JOIN users u on u.user_id=uc.user_id
		WHERE u.user_id =$user_id
		AND RIGHT(uc.did_number,8) = RIGHT('$multididnumbers[$i]',8) and uc.did_service='$campaign_type'";
	
	    $query=$this->db->query($sql)->result();
	    $arr[]=$query;
   }
   // print_r($arr);
    return $arr;    
    }	
}
