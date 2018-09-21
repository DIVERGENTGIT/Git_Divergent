<?php
class newuser_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	public function usernameExist()
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
	 
    
	public function global_settings()
	    {
		$this->db->select()
		    ->from('global_settings');
		$query = $this->db->get();
		return $query->result();
	    } 
	    
	       public function userSMSDetails($userName,$userMobile,$userEmailID,$noOfSMS,$couponCode,$user_id,$pageName) {  
	  	/*$couponUsed = FALSE;$otpCode = substr(mt_rand(), 0, 4); $time = time() + 3 * 60;
		if($couponCode) {      
			$checkCouponUsed =  "SELECT id FROM price_enquery WHERE couponCode = '".$couponCode."' AND pgresponse = 'Transaction Successful' AND (email = '".$userEmailID."' OR mobile = '".$userMobile."') ";
			$checkCouponUsedRes = $this->db->query($checkCouponUsed);
 			$couponUsed = $checkCouponUsedRes->num_rows();
 		}  
 		if($couponUsed) {	   
			return array("status" => 201);		
		}else{  */ 

			$getUserID = $this->db->query("SELECT user_id from users where username = '".trim($userName)."' ");
			$getUserIDRes = $getUserID->result_array();
			foreach($getUserIDRes as $user) {
				$user_id = $user['user_id'];  
			}     
 
  			$otpCode = substr(mt_rand(), 0, 4); $time = time() + 3 * 60;
  			
			 $query = "INSERT INTO `price_enquery`(noofsms,name,mobile,email,otpcode,otptime,registeruser_id,couponCode,pagetype,description) VALUES('".$noOfSMS."','".$userName."','".$userMobile."','".$userEmailID."','".$otpCode."','".$time."','".$user_id."','".$couponCode."','".$pageName."','landingPage')";
			 
			$this->db->query($query);
			$insertID = $this->db->insert_id(); 
			if($insertID){   
				$pid=base64_encode($insertID);  
				return array("status" => 200,"otp" => $otpCode,'pid'=>$pid,'id'=>$insertID);		
			}
		//}  
	}
	
	public function checkCoupon($couponCode,$user_id) {
		$couponCode = trim($couponCode); 
		$checkCouponUsedFor = $this->db->select('couponUsed,discountOnMaxPrice,price')
					       ->from('coupons')
					       ->where('coupon',$couponCode)
					       ->where('date(endDate) >=',date('Y-m-d'))
					       ->get();  
		$discountOnMaxPrice=0;$price=0;
		if($checkCouponUsedFor->num_rows() > 0) {
			$couponUsedFor = $checkCouponUsedFor->row('couponUsed'); 
			$price = $checkCouponUsedFor->row('price');    
			$discountOnMaxPrice = $checkCouponUsedFor->row('discountOnMaxPrice'); 
			return  array('status' => 200,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
			/*if($couponUsedFor == 1) {
				$checkUserValidity = $this->db->select('id')
					      ->from('price_enquery')
					      ->where('couponCode',$couponCode)
					      ->where('pgresponse_code',0)
					      ->where('pgresponse','Transaction Successful')
					     // ->where('registeruser_id',$user_id)
					      ->limit(1)
					      ->get();
				if($checkUserValidity->num_rows() > 0) {
					 return  array('status' => 201,'maxPrice' => $discountOnMaxPrice,'price' => $price);   
				}else{	
					//$this->db->query("INSERT INTO price_enquery (registeruser_id,couponCode) VALUES('".$user_id."','".$couponCode."')"); 
				  	 return  array('status' => 200,'maxPrice' => $discountOnMaxPrice,'price' => $price);     
				}   
			}else{
 				$checkUserValidity = $this->db->select('id')
					      ->from('price_enquery')
					      ->where('couponCode',$couponCode)
					      ->where('pgresponse_code',0)
					      ->where('pgresponse','Transaction Successful')
					      //->where('registeruser_id',$user_id)
					      ->limit(1)
					      ->get();          
				if($checkUserValidity->num_rows() > 0) {
					return  array('status' => 201,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
				}else{	
					//$this->db->query("INSERT INTO price_enquery (registeruser_id,couponCode) VALUES('".$user_id."','".$couponCode."')");
			              return  array('status' => 200,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
				}   
			}  */
		}else{
			return  array('status' => 202,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
		} 
	} 
	
	public function getUserVerifiedCoupon($user_id) {
		$checkUserValidity = $this->db->query("SELECT  id,`couponCode` FROM (`price_enquery`) WHERE `pgresponse_code` IS NULL AND `pgresponse` IS NULL AND couponCode != '' AND `registeruser_id` = '".$user_id."' ORDER BY id desc LIMIT 1");
 		if($checkUserValidity->num_rows() > 0) {
			/*$couponCode = trim($checkUserValidity->row('couponCode'));
			$checkCouponUsedFor = $this->db->select('*')
					       ->from('coupons')
					       ->where('coupon',$couponCode)
					       ->where('price <',$planPrice)
					       ->where('date(endDate) >=',date('Y-m-d'))
					       ->get(); 
			if($checkCouponUsedFor->num_rows() > 0) {     
				return TRUE;
			}else{   
				return FALSE;    
			}  */  
			return TRUE;
		}else{
			return FALSE;
		} 
	} 

	 
	public function getCouponOffer($user_id) {
		$checkUserValidity = $this->db->query("SELECT  id,`couponCode` FROM (`price_enquery`) WHERE `pgresponse_code` IS NULL AND `pgresponse` IS NULL AND couponCode != '' AND `registeruser_id` = '".$user_id."' ORDER BY id desc LIMIT 1");

		if($checkUserValidity->num_rows() > 0) {  
			$couponCode = $checkUserValidity->row('couponCode'); 
			$couponCode = trim($couponCode);	
			$PID = $checkUserValidity->row('id'); 
			$query = $this->db->select('CID,coupon,discountNum,offer_percent,price,couponUsed,discountOnMaxPrice')
					 ->from('coupons')  
					 ->where('coupon',$couponCode)
					 ->where('date(endDate) >=',date('Y-m-d'))
					 ->limit(1)  
					 ->get();  

			/*foreach($query->result_array() as $result) {

				$returnArray = array (  
						'CID' => $result['CID'],
						'coupon' => $result['coupon'],
						'discountNum' => $result['discountNum'],
						'offer_percent' => $result['offer_percent'],
						'price' => $result['price'],
						'couponUsed' => $result['couponUsed'],
						'PID' => $PID
						);
			} */
			//$returnResponse = $returnArray;
			$returnResponse = $query->result_array();  
			if($query->num_rows() > 0) {
				$couponUsedFor = $query->row('couponUsed'); 

				if($couponUsedFor == 1) {
					$checkUserValidity = $this->db->select('id')
								      ->from('price_enquery')
								      ->where('couponCode',$couponCode)
								      ->where('pgresponse_code',0)
								      ->where('pgresponse','Transaction Successful')
								      ->where('registeruser_id',$user_id)
								      ->limit(1)
								      ->get();
					if($checkUserValidity->num_rows() > 0) {
 						return FALSE;            
					}else{
						// $this->db->query("UPDATE price_enquery SET  couponCode = ''  WHERE  `registeruser_id` = '".$user_id."' AND couponCode = '".$couponCode."' "); 
						return $returnResponse;

					}   
				}else{ 
					$checkUserValidity = $this->db->select('id')
					      ->from('price_enquery')
					      ->where('couponCode',$couponCode)
					      ->where('pgresponse_code',0)
					      ->where('pgresponse','Transaction Successful')
					      //->where('registeruser_id',$user_id)
					      ->limit(1)
					      ->get();  
 					if($checkUserValidity->num_rows() > 0) {
 						return FALSE;            
					}else{
						// $this->db->query("UPDATE price_enquery SET  couponCode = ''  WHERE  `registeruser_id` = '".$user_id."' AND couponCode = '".$couponCode."' "); 
						return $returnResponse;
					}  
				} 
				   
			}else{  
 				return FALSE;            
			}     
		}else{	        
  			return FALSE;   
		}    
			     
	}     
	
	   
    public function userOrderedSMSData($id) { 
    	$userArray = array();
    	$getOrderData = $this->db->query("SELECT noofsms,name,mobile,email,couponCode FROM price_enquery WHERE id='".$id."' and otpverify = 1"); 
    	$getOrderDataRes = $getOrderData->result_array();
    	foreach($getOrderDataRes as $userData) {
    		$userArray['noofsms'] = $noofsms = $userData['noofsms'];
    	 	$userArray['userName'] = $userName = $userData['name'];
    	 	$userArray['userMobile'] = $userMobile = $userData['mobile'];
    	 	$userArray['userEmail'] = $userEmail = $userData['email'];
    	 	$userArray['couponCode'] = $couponCode = $userData['couponCode']; 
    	 	$accountPassword = $this->generatePassword(); 
 		$this->db->query("INSERT INTO users SET username = '".$userName."',password='".$accountPassword."',email='".$userEmail."',mobile='".$userMobile."',otpMobileNo='".$userMobile."',registered_on = '".date('Y-m-d H:i:s')."',mverify = 1,shorturl_credits = 100000");  
 		$userArray['userID'] = $userID =   $this->db->insert_id(); 
 		$this->db->query("UPDATE price_enquery SET registeruser_id = '".$userID."' WHERE id ='".$id."'"); 

    	}  
    	return $userArray;
    
    }
    
    
    	public function updateTransactionData($transaction_id) {
    	 	$id =$this->session->userdata('priceEnqID');
    	 	$user_id = $this->session->userdata('userID');
    	 	$noofsms = $this->session->userdata('noofsms'); 
    	 	$smsprice = $this->session->userdata('smsprice');
    	 	$amount = $this->session->userdata('totalPrice');
    	 	$tax_amount = $this->session->userdata('taxAmount'); 
    	 	$total_amount = $this->session->userdata('total_amount');
		$this->db->query("UPDATE price_enquery set noofsms = '".$noofsms."' ,price_per_sms = '".$smsprice."',total_amount = '".$total_amount."', amount = '".$amount."',tax_amount = '".$tax_amount."',transaction_id = '".$transaction_id."'  where id ='".$id."'");
 		$this->db->query("INSERT INTO transaction_history (user_id,noofsms,sms_price,amount,tax_amount,total_amount,
 		transaction_id) values ('".$user_id."','".$noofsms."','".$smsprice."','".$amount."','".$tax_amount."','".$total_amount."','".$transaction_id."')");  
    	}   
      
    
	function generatePassword($l = 9, $c = 4, $n = 1, $s = 4) {
		// get count of all required minimum special chars
		$count = $c + $n + $s;

		// sanitize inputs; should be self-explanatory
		if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
		trigger_error('Argument(s) not an integer', E_USER_WARNING);
		return false;
		}
		elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
		trigger_error('Argument(s) out of range', E_USER_WARNING);
		return false;
		}
		elseif($c > $l) {
		trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
		return false;
		}  
		elseif($n > $l) {
		trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
		return false;
		}
		elseif($s > $l) {
		trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
		return false;
		}
		elseif($count > $l) {
		trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
		return false;
		}

		// all inputs clean, proceed to build password

		// change these strings if you want to include or exclude possible password characters
		  $chars = "abcdefghijklmnopqrstuvwxyz";
	  	  $caps = strtoupper($chars);
		  $nums = "0123456789";
		  $syms =  $chars;
		  $out = '';
		// build the base password of all lower-case letters
		for($i = 0; $i < $l; $i++) {
		$out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}

		// create arrays if special character(s) required
		if($count) {
		// split base password to array; create special chars array
		$tmp1 = str_split($out);
		$tmp2 = array();

		// add required special character(s) to second array
		for($i = 0; $i < $c; $i++) {
		array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
		}
		for($i = 0; $i < $n; $i++) {
		array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
		}
		for($i = 0; $i < $s; $i++) {
		array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
		}

		// hack off a chunk of the base password array that's as big as the special chars array
		$tmp1 = array_slice($tmp1, 0, $l - $count);
		// merge special character(s) array with base password array
		$tmp1 = array_merge($tmp1, $tmp2);
		// mix the characters up
		shuffle($tmp1);
		// convert to string for output
		$out = implode('', $tmp1);
		}

		return $out;
	}

   	public function updatePPCUserIP($data,$source,$pageName) {
		$getSource = $this->db->query("SELECT id FROM ppc_users_ip WHERE ipaddress = '".$data['ip']."' AND source = '".$source."' AND pageName = '".$pageName."' AND date(dateTime) = date(now())");
		if($getSource->num_rows() == 0) {
			$this->db->query("INSERT INTO ppc_users_ip (ipaddress,source,pageName,region_name,city,country_name,latitude,longitude) VALUES('".$data['ip']."','".$source."','".$pageName."','".$data['region_name']."','".$data['city']."','".$data['country_name']."','".$data['latitude']."','".$data['longitude']."')");
		}
	}    
 
	
	public function updateNewUSersUsedCoupons($transactionId) { 
		 $this->session->sess_destroy();  
	 	 
	}
    
      
	 
	
}
