<?php
class Voice_rental_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();			
		$this->load->database();	
		
    }
	// Start chandrasekhar
	public function get_users() 
	{    
		$this->db->select('user_id,username')
		    ->from('users');			
		$query = $this->db->get();
		return $query->result();	         
    	}
    	
    public function get_tax_value() 
	{    
		$this->db->select('value')
			->where('setting_name','Service Tax')
		    ->from('global_settings');			
		$query = $this->db->get();
		return $query->result();	         
    	}
    	
    	public function add_cart($userid,$sel_nos)
    	{
    		$dids_array = explode(",",$sel_nos);
    		$xy = 0;
		for($x=0;$x<count($dids_array);$x++)
		{
			$did_num = $dids_array[$x];
			
			$sql = "select * from cart_table where did_number = '$did_num'";
			$rs=$this->db->query($sql)->result();
			
			if(!$rs)
			{
		    		$sql_insert = "insert into cart_table (did_number,user_id) values('$did_num','$userid')";
			    	$result = $this->db->query($sql_insert);
			} 	
	    }
    	$sql_insert = "delete from cart_table where user_id = '$userid' AND did_number NOT IN($sel_nos)";
		$result = $this->db->query($sql_insert);
    	}
    	
    	public function get_cart()
    	{           
    	            /*
    		      $this->db->select('did_number,user_id')
					 ->from('cart_table');			
			$query = $this->db->get();
			return $query->result_array();
			*/
			$real_url=$this->config->item('firstring_url');
			$qry_fields =array();
			echo $did_url = $real_url."get_cart_api.php";
			echo $qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
			$result1  =$getsilver_didlist_api;
				if(count($result1)>0)
				{
				   //$this->_data['didprice_result']=$result1;
				   return $result1;
				   
				}
		      
			
    	}
    	
    	public function get_cart_val($user_id)
    	{
    		$this->db->select()
		    ->from('cart_table')
		    ->where('user_id',$user_id);			
		$query = $this->db->get();
		return $query->result_array();
    	}
    	
    	public function delete_cart($sel_nos,$userid)
    	{
    		$sql_insert = "delete from cart_table where user_id = '$userid' AND did_number IN($sel_nos)";
		$result = $this->db->query($sql_insert);
    	}
    	
    	public function deletecart($userid)
    	{
    		$sql_insert = "delete from cart_table where user_id = '$userid'";
		$result = $this->db->query($sql_insert);
    	}
    	
    	public function orders_history($user_id,$user_service)
	{ 
		$array = array('user_service' => $user_service,'status' => 1);	
		$this->db->select('*,count(mcbill_id) AS did_count')
		    ->from('voicestriker.voice_billing')            
		    ->where($array)		
		    		->group_by('admin_transaction_id')
				->group_by('transaction_id')
				->order_by("mcbill_id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();	         
    	}
    	
    	public function orders_history_count($offset,$page,$user_id,$user_service)
    	{
    		$array = array('user_service' => $user_service,'status' => 1);	
		$this->db->select('*,count(mcbill_id) AS did_count')
		    ->from('voicestriker.voice_billing')            
		    ->where($array)		
		    		->group_by('admin_transaction_id')
				->group_by('transaction_id')
				->limit($offset, $page)	
				->order_by("mcbill_id", "desc");
		$query = $this->db->get();
		return $query->result();
    	}
	
	public function package_details($package_id,$service)
	{
		$condition = "Missedcall_ConnectDialler";
		if($service == 'Inbound' || $service == 'Conference' || $service == 'Announcement' || $service == 'IVRS')
		{
			$array = array('service_name' => $condition,'package_id' => $package_id, 'active' => 1);
		}
		else
		{
			$array = array('service_name' => $service,'package_id' => $package_id, 'active' => 1);
		}
		
		$this->db->select()
		    ->from('voice_service_plans')	
				->where($array)
				->order_by("plan_duration","ASC");
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	
	public function service_credits($service) 
	{    
		$array = array('plan_service' => $service);
		$this->db->select()
		    ->from('voice_service_credits')	
				->where($array)
				->order_by("extra_credits","ASC");
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();	         
	}
	
	public function insert_payments($user_name,$userid,$rental_plan,$plan_service,$planprice,$sel_nos,$did_values,$user_service,$order_type,$tax_value)
    	{
    		$plan = explode(",",$rental_plan);
    		$package_cost = $plan[1];
    		$mc_quantity = $plan[0];
    		$plan_days = $plan[2];
			$sms_credits = $plan[3];
    		$vc_amount = $plan[4];
    		$package_id = $plan[5];
    		
    		$dids_array = explode(",",$did_values);
    		$xy = 0;
			
		$transaction_id = $userid . substr(mt_rand(), 0, 6);	
		for($x=0;$x<count($dids_array);$x++)
		{
			$did_values = explode("-",$dids_array[$x]);
			$did_num = $did_values[1];
			$did_plan = $did_values[4];
			$did_type = $did_values[2];
			$did_amount = $did_values[3];
			if($xy == 0)
			{				
				$xy++;
			}
			
		/// did price
		//Code added by ramsri
			$tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $did_amount;				
			} else if($plan_days == 60){
			$tot_no_cost = $did_amount * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $did_amount * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $did_amount * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $did_amount * 12;				
			} else {
			$tot_no_cost = 0;
			}
				$totalplanprice = $tot_no_cost + $package_cost;
			    $gettax = $totalplanprice * ($tax_value/100);
			  
			    $amount=$totalplanprice+$gettax;
			    $message ='Transaction Cancelled';		
		// end
/*
				
$sql_insert = "insert into voice_billing (service_nos,mc_quantity,amount,tax,total_amount,cust_name,user_id,description,plan_days,sms_credits,vc_amount,tax_percentage,user_service,plan_service,package_cost,did_plan,did_type,did_amount,renewal_date,transaction_id,package_id,message) values('$did_num','$mc_quantity','$amount','$gettax','$totalplanprice','$user_name','$userid','$order_type','$plan_days','$sms_credits','$vc_amount','$tax_value','$user_service','$plan_service','$package_cost','$did_plan','$did_type','$did_amount',ADDDATE(now(), INTERVAL $plan_days DAY),'$transaction_id','$package_id','$message')";
*/	

$sql_insert = "insert into voice_billing (service_nos,mc_quantity,amount,tax,total_amount,cust_name,user_id,description,plan_days,sms_credits,vc_amount,tax_percentage,user_service,plan_service,package_cost,did_plan,did_type,did_amount,renewal_date,transaction_id,package_id,message) values('$did_num','$mc_quantity','$amount','$gettax','$totalplanprice','$user_name','$userid','$order_type','$plan_days','$sms_credits','$vc_amount','$tax_value','$user_service','$plan_service','$package_cost','$did_plan','$did_type','$tot_no_cost',ADDDATE(now(), INTERVAL $plan_days DAY),'$transaction_id','$package_id','$message')";
    		
	    		$result = $this->db->query($sql_insert);
	    		$insert_id = $this->db->insert_id();
				$insert_id = $transaction_id;
				
	    		/*if($insert_id > 0)
	    		{
	    			$sql_query = "INSERT INTO users_servicewise_credits (did_number,did_type,did_service,amount,max_calls,
vc_amount,subscription_duration,did_plan,user_id,admin_id,package_cost,subscription_date,expire_date,active,user_service,package_id) values('$did_num','$did_type','$plan_service','$did_amount','$mc_quantity','$vc_amount','$plan_days','$did_plan','$userid',
'$admin_id','$package_cost',now(),ADDDATE(now(), INTERVAL $plan_days DAY),'1','$user_service','$package_id')";
	    			$res = $this->db->query($sql_query);
	    		}*/
    	}
		if($insert_id > 0)return $insert_id;
		else return 0;
    	}
    	
     // renwal and upgrade package 		
    	public function renewal_package($userid,$did_num,$user_service,$did_amount,$rental_plan,$tax,$renew_tax,$plan_service,$total_amount,$did_type,$did_plan,$expire_date,$order_type,$user_name)
    	{
    		$transaction_id = $userid.substr(mt_rand(), 0, 6);
    		$plan = explode(",",$rental_plan);
    		$package_cost = $plan[1];
    		$mc_quantity = $plan[0];
    		$plan_days = $plan[2];
			$sms_credits = $plan[3];
    		$vc_amount = $plan[4];
    		$package_id = $plan[5];
    		$user_name = $user_name;
    		$renew_amt = $total_amount - $renew_tax; 
    		$message ='Transaction Cancelled';
    		
    		
    		//get did number cost start
			$tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $did_amount;				
			} else if($plan_days == 60){
			$tot_no_cost = $did_amount * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $did_amount * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $did_amount * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $did_amount * 12;				
			} else {
			$tot_no_cost = 0;
			}
			
		      //get did number cost start
		      
    	 $sql_insert = "insert into voice_billing (service_nos,mc_quantity,amount,tax,total_amount,cust_name,user_id,description,plan_days,sms_credits,vc_amount,tax_percentage,user_service,plan_service,package_cost,did_plan,did_type,did_amount,renewal_date,transaction_id,package_id,message) values('$did_num','$mc_quantity','$total_amount','$renew_tax','$renew_amt','$user_name','$userid','$order_type','$plan_days','$sms_credits','$vc_amount','$tax','$user_service','$plan_service','$package_cost','$did_plan','$did_type','$tot_no_cost',ADDDATE('$expire_date', INTERVAL $plan_days DAY),'$transaction_id','$package_id','$message')";
		
	
		$result = $this->db->query($sql_insert);
		$mcbill_id=$this->db->insert_id();
		$mcbill_id=$transaction_id;
		if($mcbill_id > 0)return $mcbill_id;
		else return 0;
    	}
    	
   // upgrade service 	
    public function upgrade_package($userid,$did_num,$user_service,$did_amount,$rental_plan,$tax,$upgd_taxtot,$plan_service,$total_amount,$did_type,$did_plan,$expire_date,$order_type,$user_name,$upgrade_from,$used_days)
    	{
    		$transaction_id = $userid.substr(mt_rand(), 0, 6);
    		$plan = explode(",",$rental_plan);
    		$package_cost = $plan[1];
    		$mc_quantity = $plan[0];
    		$plan_days = $plan[2];
			$sms_credits = $plan[3];
    		$vc_amount = $plan[4];
    		$package_id = $plan[5];
    		$user_name = $user_name;
    		
    		$duration = $plan_days - $used_days;
    		$amount_wot = $total_amount - $upgd_taxtot;
    		
    		
    		$did_cost=$did_amount;
    		
    		
    		
    		
    		    //get did number cost start
			$tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $did_amount;				
			} else if($plan_days == 60){
			$tot_no_cost = $did_amount * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $did_amount * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $did_amount * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $did_amount * 12;				
			} else {
			$tot_no_cost = 0;
			}
			$did_cost=$tot_no_cost;
		      //get did number cost start
    	 
    		
    		
    		
    		
$sql_insert = "insert into voice_billing (service_nos,mc_quantity,amount,tax,total_amount,cust_name,user_id,description,plan_days,sms_credits,vc_amount,tax_percentage,user_service,plan_service,package_cost,did_plan,did_type,did_amount,renewal_date,transaction_id,package_id) values('$did_num','$mc_quantity','$total_amount','$upgd_taxtot','$amount_wot','$user_name','$userid','$order_type','$duration','$sms_credits','$vc_amount','$tax','$user_service',
'$plan_service','$package_cost','$did_plan','$did_type','$did_cost',ADDDATE('$expire_date', INTERVAL $duration DAY),'$transaction_id','$package_id')";


		$result = $this->db->query($sql_insert);
		$insert_id = $this->db->insert_id();
		$insert_id = $transaction_id;
		
		if($insert_id > 0)return $insert_id;
		else return 0;
    	}
    	
    	
    	public function addcredits_package($userid,$did_num,$user_service,$tax,$plan_service,$planprice,$user_name,$calls_amt,$max_calls,$order_type,$current_maxcalls)
    	{
    		$transaction_id = $userid.substr(mt_rand(), 0, 6);
    		$tax_amt = $planprice-$calls_amt;
    		$sql_insert = "insert into voice_billing (service_nos,mc_quantity,amount,tax,total_amount,cust_name,user_id,description,
tax_percentage,user_service,plan_service,transaction_id) values('$did_num','$max_calls','$planprice','$tax_amt','$calls_amt','$user_name','$userid','$order_type','$tax','$user_service','$plan_service','$transaction_id')";
//print_r($sql_insert);
//exit;
		$result = $this->db->query($sql_insert);
		$insert_id = $this->db->insert_id();
		$insert_id = $transaction_id;
    		if($insert_id > 0)return $insert_id;
		else return 0;
		
		/*
		if($insert_id > 0)
    		{
    			$sql_query = "update users_servicewise_credits set max_calls='$total_maxcalls' WHERE user_id = '$userid' AND usc_id = '$auto_id'";
			$res = $this->db->query($sql_query);
    		}
    		*/
    	}
	
	// End chandrasekhar
	
	public function Getall_rentalplans() 
	{    
	$this->db->select()
            ->from('voice_service_plans');			
        $query = $this->db->get();
        return $query->result();	         
    }
	
	public function getRentalplans($days) 
	{    
	$this->db->select()
            ->from('voice_service_plans')	
			->where('plan_duration', "$days")
			->order_by("plan_duration","ASC");
        $query = $this->db->get();
        return $query->result();	         
    }
	
	public function Service_packages($service) 
	{    
		$array = array('service_name' => $service, 'active' => 1);
		$this->db->select()
		    ->from('voice_service_plans')	
				->where($array)
				->order_by("plan_duration","ASC");
		$query = $this->db->get();
		return $query->result();	         
    	}
    
	public function Service_callcredits($service) 
	{ 	
	$this->db->select()
            ->from('call_credits')	
			->where('plan_service',$service)
			->order_by("credits_id","ASC");
        $query = $this->db->get();
		$this->db->last_query();
        return $query->result();	         
    }
	public function Get_service_packages($service,$days) 
	{    
	$array = array('service_name' => $service, 'plan_duration' => $days, 'active' => 1);
	$this->db->select()
            ->from('voice_service_plans')	
			->where($array)
			->order_by("plan_duration","ASC");
        $query = $this->db->get();
        return $query->result();	         
    }
	
	public function getupgrade_rtlplans($days) 
	{ 
	$arr = array('plan_duration' => $days, 'plan_price !=' => 0 );	
	$this->db->select()
            ->from('voice_service_plans')	
			->where($arr)			
			->order_by("plan_duration","ASC");
        $query = $this->db->get();
        return $query->result();	         
    }	
	public function getUserdetails($user_id)
	{		
		$this->db->select()
				 ->from('users')
				 ->where('user_id',$user_id);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
		return false; }
	}
	
	public function Getuser_details($user_id)
	{		
		$this->db->select()
				 ->from('users')
				 ->where('user_id',$user_id);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
		return false; }
	}
	
	public function getCitylist()
	{		
		$this->db->select()
				 ->from('new_citylist')
				 ->order_by("city_id", "asc");
		$query=$this->db->get();
		return $query->result(); 
	}
	
	public function getStatelist()
	{		
		$this->db->select()
				 ->from('new_statelist')
				 ->order_by("state_id", "asc");
		$query=$this->db->get();
		return $query->result(); 
	}
		
	public function pay_register($customerid,$password,$mobile,$email,$name,$address1,$city,$state,$zip)
	{	
        $this->db->select()
				 ->from('new_citylist')
				 ->where('city_name', $city);
		$city_dtl = $this->db->get();		
		foreach($city_dtl->result() as $cityd){ $city_id = $cityd->city_id;}
     	
		$this->db->select()
				 ->from('new_statelist')
				 ->where('state', $state);
		$state_dtl=$this->db->get();	
		foreach($state_dtl->result() as $stated){ $state_id = $stated->state_id;}
	
		$values = array(
			'username' => $customerid,
			'password' => md5($password),
			'first_name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'address1' => $address,
			'city_id' => $city_id, 
			'state_id' => $state_id,
			'zipcode' => $zip			
			);
		//print_r($values);	
		$this->db->set('registered_on', 'NOW()', FALSE);		
		//exit;
		$this->db->insert('users', $values);
		return $this->db->insert_id();
	}	
	public function Insert_user_credits($user_id,$user_service,$did_no,$pservice,$quantity,$fsms,$fcalls,$active,$sdate,$sdays,$pay_edate,$bill_id) {
		$data = array(
				   'user_id' => $user_id,
				   'user_service' => $user_service,
				   'did_number' => $did_no,
				   'did_service' => $pservice,
				   'max_calls' => $quantity,
				   'sms_credits' => $fsms,
				   'vc_amount' => $fcalls,
				   'active' => $active,
				   'subscription_date' => $sdate,
				   'subscription_duration' => $sdays,
				   'expire_date' => $pay_edate,
				   'renewal_mc_id' => $bill_id, 
				   'entry_date' => date('Y-m-d H:i:s')
				   );

		$this->db->insert('users_servicewise_credits', $data);		
		
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		} 
		
	}	
	public function Update_user_credits($fsms,$fcalls,$user_id)
	{
		$this->db->select()
				 ->from('users')
				 ->where('user_id',$user_id);
		$query=$this->db->get();
		
		$data = array('sms_credits' => $fsms, 'vc_amount' => $fcalls);
		$where = "user_id = $user_id";		
		$this->db->update_string('users', $data, $where);
	}
	
	// changed this function chandrasekhar
	/*
	public function Allbills($user_id)
	{ 
		$array = array('user_id'=> $user_id, 'user_service' => 'VoiceStriker');	
		$this->db->select()
		    ->from('voice_billing')            
		    ->where($array)			
				->order_by("mcbill_id", "desc");
		$query = $this->db->get();
		return $query->result();	         
    	}
    	*/
    	
    	// chandrasekhar
    	public function Allbills($transaction_id,$user_service)
	{ 
		$array = array('admin_transaction_id' => $transaction_id,'user_service' => $user_service);	
		$this->db->select()
		    ->from('voicestriker.voice_billing')            
		    ->where($array)			
				->order_by("mcbill_id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();	         
    	}
    	
	public function Billig_details($user_id)
	{
	$array = array('user_id'=> $user_id, 'user_service' => 'VoiceStriker');		
	$this->db->select()
            ->from('voice_billing')            
            ->where($array)			
			->order_by("mcbill_id", "desc");
        $query = $this->db->get();
        return $query->result();	         
    }
    
    	// changed this function chandrasekhar
    /*
	public function Billig_pagedetails($offset,$page,$user_id)
	{  
		$array = array('user_id'=> $user_id, 'user_service' => 'VoiceStriker');
		$this->db->select()
		    ->from('voice_billing')            
		    ->where($array)
				->limit($offset, $page)	
				->order_by("mcbill_id", "desc");
		$query = $this->db->get();
		return $query->result();	         
    	}
    */	
    
    	// chandrasekhar
    	public function Billig_pagedetails($offset,$page,$transaction_id,$user_service)
	{  
		$array = array('admin_transaction_id' => $transaction_id,'user_service' => $user_service);
		$this->db->select()
		    ->from('voicestriker.voice_billing')            
		    ->where($array)
				->limit($offset, $page)	
				->order_by("mcbill_id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();	         
    	}
    	
    	// changeed function chandrasekar
    /*
	public function User_packages($user_id)
	{    
	$this->db->select()
            ->from('users_servicewise_credits')            
            ->where('user_id', $user_id)			
			->order_by("usc_id", "desc");
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();	
		
	}	
    */	
	
	// Ramshree
	public function User_packages($user_id,$from_date,$to_date,$src_sno)
	{   
	$condition1='';
	$condition2='';
	$condition3='';
	$condition4='';
	if($user_id!='')
	{
	  	$condition1=" AND user_id='$user_id'";
	} 
	
	if($from_date!='')
	{
	  	$condition2=" AND date(subscription_date)>='$from_date'";
	}  
	
	if($to_date!='')
	{
	  	$condition3=" AND date(subscription_date)<='$to_date'";
	}
	if($src_sno!='')
	{
	  	$condition4=" AND did_number='$src_sno'";
	}
	
		$sql="SELECT * FROM users_servicewise_credits WHERE user_id != '' $condition1 $condition2 $condition3 $condition4 ORDER BY usc_id desc";
	if($this->db->query($sql)->num_rows()>0)
	   {  
	   return $this->db->query($sql)->num_rows(); 
	   }
	   else
	   {
	   return false;
	   }  
		
		/* $this->db->select()
		    ->from('users_servicewise_credits') 
		    ->where('user_id',$user_id)
			->or_where(array('did_service'=>'Missedcall_SMS_Voice', 'did_service'=>'Missedcall_Tollfree', 'did_service'=>'ConnectDialler'))	
			->order_by("usc_id", "desc");
		$query = $this->db->get(); */
		//echo $this->db->last_query();
		//return $query->result();	             
	}
	
	// changeed function chandrasekar
    /*
	public function User_pagepackages($offset,$page,$user_id)
	{    
		$this->db->select()
		    ->from('users_servicewise_credits')            
		    ->where('user_id', $user_id)
				->limit($offset, $page)	
				->order_by("usc_id", "desc");
		$query = $this->db->get();
			//echo $this->db->last_query();
		return $query->result();	         
    	}
     */	
    	
    // Ramshree
    public function User_pagepackages($user_id,$from_date,$to_date,$src_sno,$limit,$offset)
	{    
	$condition1='';
	$condition2='';
	$condition3='';
	$condition4='';
	if($user_id!='')
	{
	  	$condition1=" AND user_id='$user_id'";
	} 	
	if($from_date!='')
	{
	  	$condition2=" AND date(subscription_date)>='$from_date'";
	}  
	
	if($to_date!='')
	{
	  	$condition3=" AND date(subscription_date)<='$to_date'";
	} 
	if($src_sno!='')
	{
	  	$condition4=" AND did_number='$src_sno'";
	}
	if($offset=='')
	{
	 $offset='0';
	}
	
	$sql="SELECT * FROM users_servicewise_credits WHERE user_id != '' $condition1 $condition2 $condition3 $condition4 ORDER BY usc_id desc limit $offset,$limit";
		
	return $this->db->query($sql)->result(); 
  	
		/* $this->db->select()
		    ->from('users_servicewise_credits')
		    ->where('user_id',$user_id)            
			->or_where(array('did_service'=>'Missedcall_SMS_Voice', 'did_service'=>'Missedcall_Tollfree', 'did_service'=>'ConnectDialler'))	
			->limit($offset, $page)	
			->order_by("usc_id", "desc");
		$query = $this->db->get();
		return $query->result();	 */         
    }    	
    	
	public function Billig_id_details($bill_id)
	{    
	$this->db->select()
            ->from('voice_billing')            
            ->where('user_id', $user_id)            
			->order_by("mcbill_id", "desc");
        $query = $this->db->get();
        return $query->result();	         
    }
	
	public function billigPaydetails($ePGTxnID) 
	{    
	$this->db->select()
            ->from('voice_billing')            
            ->where('epg_txnID', $ePGTxnID)            
			->order_by("mcbill_id", "desc");
        $query = $this->db->get();
        return $query->result();	         
    }
	
	public function Update_add_credits($tot_credits,$user_id)
	{
		
		$upd_qry = "UPDATE users SET main_balance='$tot_credits' WHERE user_id = $user_id;";
		
		$result = $this->db->query($upd_qry);
		
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}  
	}
	
	public function Add_user_payments($amount,$user_id)
	{		
		
		$service_tax = $amount * 0.14;
		$service_tax_percent = 14;
		$tot_amount = $amount - $service_tax;		
		
		$data = array(
				   'user_id' => $user_id,
				   'amount' => $amount,
				   'service_tax' => $service_tax,
				   'service_tax_percent' => $service_tax_percent,
				   'total_amount' => $tot_amount,
				   'on_date' => date('Y-m-d H:i:s')
				   );

		$this->db->insert('user_payments', $data); 
		
		
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}  
	}
	
	public function Plan_days()
	{
		$this->db->select('plan_duration')
				->from('voice_service_plans')
				->group_by('plan_duration')
				->order_by("plan_duration", "ASC");		
		$query = $this->db->get();
        return $query->result();	
	}	
	
	//billing bkpuser_details
	public function billigTotaldetails() 
	{    
	$this->db->select()
            ->from('voice_billing')                                    
			->order_by("mcbill_id", "desc");
        $query = $this->db->get();
        return $query->result();	         
    }
	public function billigDetails($user_id) 
	{    
	$this->db->select()
            ->from('voice_billing')            
            ->where('user_id', $user_id)            
			->order_by("mcbill_id", "desc");
        $query = $this->db->get();
        return $query->result();	         
    }	
	public function All_states() 
	{    
	$this->db->select()
            ->from('new_statelist')                    
			->order_by("state", "ASC");
        $query = $this->db->get();
        return $query->result();	         
    }	
	public function getCities($state)
	{		
		$sql="select city_id,city_name from new_citylist where state_id='$state' group by city_id order by city_name asc "; 
		return $rs=$this->db->query($sql)->result();
	}
	public function Get_servicewise_credits()
	{
		$arr = array('renewal_date' => date('Y-m-d'), 'renewal_mc_id >',0);
		$this->db->select()
				->from('users_servicewise_credits')
				->where($arr)
				->order_by("usc_id","ASC");
			$query = $this->db->get();	
			return $query->result();	
	}
	
	public function add_transaction()
	{	
	$servicenos = '';
	$servicenos=$this->input->post('service_nos');

	$nos = implode(',', $servicenos);		
		    
	$data = array(
		'service_nos' => $nos,
		'mc_quantity' => $this->input->post('qnty'),
		'amount' => $this->input->post('amount'),
		'cust_name' => $this->input->post('name'),
		'user_id' => $this->input->post('customerid'),
		'company_name' => $this->input->post('cname'),
		'mobile' => $this->input->post('mobile'),
		'email' => $this->input->post('email'),
		'address1' => $this->input->post('address1'),
		'address2' => $this->input->post('address2'),		
		'state' => $this->input->post('state'),
		'city' => $this->input->post('city'),
		'pincode' => $this->input->post('zip'),
		'description' => $this->input->post('description'),
		'transaction_id' => $this->$TxnID,
		'status' => 1			
		);
		
	$rs=$this->db->insert('voice_billing', $data);
	$this->db->last_query();
	return $rs->result();	
	}
	
	public function update_uservals($address1,$address2,$state,$city,$zip,$user_id) 
	{
	//$this->load->model('Voice_rental_model');		
		$this->db->select()
				 ->from('new_citylist')
				 ->where('city_name', $city);
		$city_dtl = $this->db->get();		
		foreach($city_dtl->result() as $cityd){ $city_id = $cityd->city_id;}
     	
		$this->db->select()
				 ->from('new_statelist')
				 ->where('state', $state);
		$state_dtl=$this->db->get();	
		foreach($state_dtl->result() as $stated){ $state_id = $stated->state_id;}
	
	$userdata = array('address1' => $address1, 
						'address2' => $address2, 
						'state_id' => $state_id, 
						'city_id' => $city_id, 
						'zipcode' => $zip);
		
		$this->db->where('user_id',$user_id);
        $this->db->update('users',$userdata);		
	}
	
	public function get_tax() 
	{
		$this->db->select()
            ->from('global_settings')            
            ->where('setting_name', 'Service Tax');			
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
	}
	public function Update_userdata($userid,$address1,$address2,$city_idn,$state_idn,$zipcode)
	{		
		$sql="Update users set address1='$address1', address2='$address2', city_id=$city_idn, state_id=$state_idn, zipcode=$zipcode where user_id='$userid'"; 
				
		return $rs=$this->db->query($sql);
		//echo $this->db->last_query();
		//exit;
	}	
	
}
