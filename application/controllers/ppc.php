<?php
class ppc extends CI_Controller
{
 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session'); 
	}
	    
	public function index() {    
		$this->session->sess_destroy();   
		redirect('ppc/bulk-sms-services');
	}  
	     
	public function bulk_sms_services() {  
	
		$this->session->sess_destroy();   
		redirect('ppc/bulk-sms-services');
	}       
	    
	public function checkCouponValidity() {  
		$this->load->model('newuser_model'); 
		$user_id = 0;// $this->session->userdata('user_id');
		$couponCode =  $this->input->post('coupon');  
	 	$response = $this->newuser_model->checkCoupon($couponCode,$user_id);  
		echo json_encode($response);
    
 	     
	}   
	
	public function userLandingPage() { 
		$this->load->model('newuser_model');
		if($this->input->post('coupon')) {
			$userName = $this->input->post('userName');  
			$userMobile =$this->input->post('userMobile');
			$userEmailID = $this->input->post('userEmailID');
			$noOfSMS =$this->input->post('noOfSMS');
			$pageName =$this->input->post('pageName');
			$user_id = '0';    
			$coupon = $this->input->post('coupon');  
			$response = $this->newuser_model->userSMSDetails($userName,$userMobile,$userEmailID,$noOfSMS,$coupon,$user_id,$pageName);  
			echo json_encode($response); 
		} else{  
			$this->session->sess_destroy(); 
			echo json_encode(array("status"=>202)); 
		}
	}   
	
	public function placeOrder() { 
		$user_id = $this->session->userdata('userID'); 
		if(!$user_id) {      
			$this->session->sess_destroy();   
			redirect(base_url().'ppc/index');
       		}
		$this->_data['userID'] = base64_encode($user_id);  
 		if($this->input->post('orderCredits')) {
 		       	$this->load->model('newuser_model');	
			$noofsms = $this->input->post('smsLength');
			$user_id = $this->session->userdata('userID'); 
			if(!$user_id) {      
				$this->session->sess_destroy();   
       				redirect(base_url().'ppc/index');
			}else{   
 
				if($noofsms >= 500) {  
					$this->session->set_userdata('noofsms',$noofsms);
					if($noofsms < 10000) {  
					      $smsprice = '0.18';
					}elseif($noofsms >= 10000 && $noofsms < 25000) {
					 	$smsprice = '0.15';
					}elseif($noofsms >= 25000 && $noofsms < 50000) {
					 	$smsprice = '0.13';
					}elseif($noofsms >= 50000 && $noofsms < 100000) {
					 	$smsprice = '0.12';
					}elseif($noofsms >= 100000 && $noofsms < 500000) {
					 	$smsprice = '0.10';
					}elseif($noofsms >= 500000 && $noofsms < 1000000) { 
					 	$smsprice = '0.09';
					}elseif($noofsms >= 1000000 && $noofsms < 2000000) { 
					 	$smsprice = '0.085';
					}else {    
					   	$smsprice = '0.18';  
					}   
					$amount = $noofsms*($smsprice); 
					$this->session->set_userdata('GSMSPRICE',$smsprice);
				
					$this->_data['discount'] = 0; $couponId='';$coupon='';
					/*** APPLYING COUPON START ***/  
					  $totalPrice = $amount;$discountType = 0;$couponUsed='';$offerPercent='';$discountPrice='';$discountOnMaxPrice = 0;
		 
					$getDiscount = $this->newuser_model->getCouponOffer($user_id);
		 
					if($getDiscount) {	   
						 foreach($getDiscount as $response) {  
							$discountType = $response['discountNum'];    
							$offerPercent = $response['offer_percent'];
							$discountPrice = $response['price'];
							$couponId = $response['CID'];
							$coupon = $response['coupon'];
							$couponUsed = $response['couponUsed'];
							$discountOnMaxPrice = $response['discountOnMaxPrice'];
							$this->_data['discount'] = ($offerPercent)?$offerPercent:$discountPrice;
						 }  


						//1-%discount  On Amount,2-%discount  On Plan Price,3-Rs/-discount On price
						if($noofsms >= $discountOnMaxPrice) {

							if($discountType == 1) { // percent based discount
								if($offerPercent > 0) {
		 
									$total = $noofsms*($smsprice);  
									$price = ($total*$offerPercent)/100;  
									$totalPrice = $total-$price;   
								}  
				  
							}else if($discountType == 2) { 
								 	 	 			 
		 
								if($discountPrice > 0) {
		 
									if($smsprice > $discountPrice) {

								  	  $smsprice = $discountPrice;						 
									}else{
										$this->_data['discount'] = 0;
									}     
								}    	

								$total = $noofsms*($smsprice);	
								$totalPrice = $total; 
														 		
							}else{    
								if($discountPrice > 0) {
									$total = $noofsms*($smsprice);	// Rupees based discount
				 
									$totalPrice = $total-$discountPrice; 
			  					}  
							}     

						}else{
							$discountType = 0;
							$this->_data['discount'] = 0;
							$offerPercent=0;$couponUsed=0;$discountPrice=0;$couponId=0;$coupon='';
						}
					}     
		 
					/*** APPLYING COUPON END ***/ 
					
					$this->session->set_userdata('couponCode',$coupon);
					$servicetax = $this->session->userdata('servicetax'); 
					$tax_amount=round(($totalPrice *$servicetax)/100);
					$total_amount=$totalPrice+$tax_amount; 
					$this->session->set_userdata('totalPrice',$totalPrice);				
					$this->session->set_userdata('smsprice',$smsprice);
					$this->session->set_userdata('amount',$amount);	
					$this->session->set_userdata('taxAmount',$tax_amount);
					$this->session->set_userdata('total_amount',$total_amount); 
					$transaction_id = mt_rand(100000, 999999); 
					$this->session->set_userdata('transaction_id',$transaction_id);				
       					$this->newuser_model->updateTransactionData($transaction_id);
					$this->load->view('landingPage/confirm_order',$this->_data); 
				}else{ 
					$this->load->view('landingPage/smsPlans',$this->_data); 
				}
			}  
		}else{  
			$this->load->view('landingPage/smsPlans',$this->_data); 
		} 
			
	}
	  
	  public function confirmOrder() {
	 	   
       		$priceEnqId = $this->uri->segment(3);
       		$id = base64_decode($priceEnqId);
       		$this->load->model('newuser_model');	
       		$getUserSMSData = $this->newuser_model->userOrderedSMSData($id);  
		$this->_data['userID'] = base64_encode($getUserSMSData['userID']);
       		if($getUserSMSData['userID']) {  

       			$user_id = $getUserSMSData['userID'];
       			$globalValues = $this->newuser_model->global_settings();
 
			foreach($globalValues as $key => $value) { 
				if($value->setting_name=='Service Tax')
				{
					$this->_servicetax = $value->value;
				} 
				if($value->setting_name=='smspricevalue')
				{
					$this->_smsprice = $value->value;
				}
			}
       			$noofsms = $getUserSMSData['noofsms'];
       			$smsprice = $this->_smsprice;        			
       			$amount = $noofsms*$smsprice;
       			$this->_data['discount'] = 0; $couponId='';$coupon='';
			/*** APPLYING COUPON START ***/  
			  $totalPrice = $amount;$discountType = 0;$couponUsed='';$offerPercent='';$discountPrice='';$discountOnMaxPrice = 0;
 
			$getDiscount = $this->newuser_model->getCouponOffer($user_id);
 
			if($getDiscount) {	   
				 foreach($getDiscount as $response) {  
					$discountType = $response['discountNum'];    
					$offerPercent = $response['offer_percent'];
					$discountPrice = $response['price'];
					$couponId = $response['CID'];
					$coupon = $response['coupon'];
					$couponUsed = $response['couponUsed'];
					$discountOnMaxPrice = $response['discountOnMaxPrice'];
					$this->_data['discount'] = ($offerPercent)?$offerPercent:$discountPrice;
				 }  


				//1-%discount  On Amount,2-%discount  On Plan Price,3-Rs/-discount On price
				if($noofsms >= $discountOnMaxPrice) {

					if($discountType == 1) { // percent based discount
						if($offerPercent > 0) {
 
							$total = $noofsms*($smsprice);  
							$price = ($total*$offerPercent)/100;  
							$totalPrice = $total-$price;   
						}
		  
					}else if($discountType == 2) { 
						 	 	 			 

						if($discountPrice > 0) {
							if($smsprice > $discountPrice) {

						  		  $smsprice = $discountPrice;						 
							}else{
								$this->_data['discount'] = 0;
							}     
						}    	

						$total = $noofsms*($smsprice);	
						$totalPrice = $total; 
												 		
					}else{    
						if($discountPrice > 0) {
							$total = $noofsms*($smsprice);	// Rupees based discount
		 
							$totalPrice = $total-$discountPrice; 
	  					}  
					}     

				}else{
					$discountType = 0;
					$this->_data['discount'] = 0;
					$offerPercent=0;$couponUsed=0;$discountPrice=0;$couponId=0;$coupon='';
				}
			}    
			
 			$this->session->set_userdata('userID',$getUserSMSData['userID']);
 			$this->session->set_userdata('servicetax',$this->_servicetax); 
			$this->session->set_userdata('userName',$getUserSMSData['userName']);				 
			$this->session->set_userdata('userMobile',$getUserSMSData['userMobile']);
			$this->session->set_userdata('userEmail',$getUserSMSData['userEmail']);
			$this->session->set_userdata('priceEnqID',$id);
			$this->session->set_userdata('couponCode',$getUserSMSData['couponCode']);  
			$this->session->set_userdata('landingPage',1);
			$this->session->set_userdata('noofsms',$noofsms);
			$this->session->set_userdata('GSMSPRICE',$this->_smsprice);
			/*** APPLYING COUPON END ***/
			
			if($this->_data['discount'] == 0 ) {
				$this->load->view('landingPage/smsPlans',$this->_data); 
			}else{
			 	$this->session->set_userdata('totalPrice',$totalPrice);				
				$this->session->set_userdata('smsprice',$smsprice); 
				$this->session->set_userdata('amount',$amount);	  			
				$tax_amount=round(($totalPrice *$this->_servicetax)/100);
				$total_amount=$totalPrice+$tax_amount; 
				$this->session->set_userdata('taxAmount',$tax_amount);
				$this->session->set_userdata('total_amount',$total_amount);
				$transaction_id = mt_rand(100000, 999999); 
				$this->session->set_userdata('transaction_id',$transaction_id);				
       				$this->newuser_model->updateTransactionData($transaction_id); 
				$this->load->view('landingPage/confirm_order',$this->_data); 
			}  
       		}else{  
       			$this->session->sess_destroy();   
       			redirect(base_url().'ppc/index');
       		}          
       }     
            
           
       public function paymentProcess() {  
       		
              	$this->load->model('newuser_model');      
		$this->_data['userID'] = base64_encode($this->session->userdata('userID'));
       		if($this->input->post('confirmOrder')) {   
       			$transaction_id = $this->session->userdata('transaction_id');
       		 	$totalAmount = $this->session->userdata('total_amount'); 
			// if($this->_data['userID'] == 5673) { $totalAmount = 1;}
       			if($this->session->userdata('total_amount')) {       	   		  
       		 	$this->encryptPaynow($totalAmount,$transaction_id); 
       		 	}else{ redirect(base_url().'ppc/index'); }      
       		}else{
       			$this->load->view('landingPage/confirm_order',$this->_data); 
       		}  
	 	 
       }    
       	
	/********* encrypt payment gateway values  *****************/
	public function encryptPaynow($amount,$referenc_id)
	{
		$key = $this->config->item('MerchantKey');
		$MerchantId = $this->config->item('MerchantId'); 
		//Mandatory Fields Start
		$ReferenceNo =$referenc_id;
		$SubMarchantID =$MerchantId;
		$TransactionAmt =$amount;
		$mandatoryfields = $ReferenceNo.'|'.$SubMarchantID.'|'.$TransactionAmt;
		$Encrypt_MandatoryFields = $this->aes128Encrypt($mandatoryfields,$key);
		$returnurl = $this->config->item('returnurl'); 
		$Encrypt_ReturnUrl = $this->aes128Encrypt($returnurl,$key);
		$Encrypt_ReferenceNo = $this->aes128Encrypt($ReferenceNo,$key);  
		$Encrypt_SubMerchantId = $this->aes128Encrypt($SubMarchantID,$key);
		$Encrypt_TransactionAmount = $this->aes128Encrypt($TransactionAmt,$key);
		$paymode = $this->config->item('paymode');
		$Encrypt_PaymentMode = $this->aes128Encrypt($paymode,$key);
		$paymenturl=$this->config->item('paymenturl'); 
		//https://eazypay.icicibank.com/EazyPG?merchantid=129258&mandatory fields=NqHcbn13md1mhpffpjdmJw==&optional fields=&returnurl=fMqEJX6IWJTNvUSiv5mklIDrmZWUwB0jrozOqhhtErvc2YWP7v/vCH65lCBA8CawCAHh/S0leHdGFJD/5k4mnA==&Reference No=QN7MsBndbVf9ixSehXpbeg==&submerchantid=xI4l+bXCpNBcRjp02YsagA==&transaction amount=rGxBbxAzDNKHeXStEq/LSw==&paymode=jtqX/Un4jV1tisUhpwlRqw==
		$url="$paymenturl?merchantid=$MerchantId&mandatory fields=$Encrypt_MandatoryFields&optional fields=&returnurl=$Encrypt_ReturnUrl&Reference No=$Encrypt_ReferenceNo&submerchantid=$Encrypt_SubMerchantId&transaction amount=$Encrypt_TransactionAmount&paymode=$Encrypt_PaymentMode";
		redirect($url);  
	}
	 
	public function aes128Encrypt($str,$key)
	{
		$block = mcrypt_get_block_size('rijndael_128', 'ecb');
		$pad = $block - (strlen($str) % $block);
		$str .= str_repeat(chr($pad), $pad);
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB));
	}

	public function paymentStatus() {       
		$this->load->model('newuser_model');  
 
		if($_REQUEST['tn'] || $_REQUEST['rm']) 
	  	{  
   			$transaction_id = $_REQUEST['tn'];
 			$rm = $_REQUEST['rm']; 
			if($_REQUEST['rm'] == 'Transaction Successful') 
			{     
	  			$servicetax = $this->session->userdata('servicetax'); 
	 			$this->newuser_model->updateNewUSersUsedCoupons($transaction_id);
	 			$orderData['transaction_id'] = $transaction_id;
	 			$orderData['trnStatus'] = $rm;  
	 			$this->load->view('landingPage/thank-you-ppc',$orderData); 
	  		}else{    
				$this->newuser_model->updateNewUSersUsedCoupons($transaction_id);
	  			redirect(base_url()."ppc/thank-you-ppc.php?tn=$transaction_id&rm=$rm");  
	  		}      
	 	}   
	 	
	}
		  
	  
	public function clicktocallAPI() {
		$source =  $this->input->post('source');
		$number = $this->input->post('number');
		$tmp_number = trim($number); $result = '';
		if(strlen($tmp_number)==10 )
		{  
			if($tmp_number[0]==7 or $tmp_number[0]==8 or $tmp_number[0]==9 )
			{ 
				//$result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&listname=PPC&source_type=$source");
				/*$agentstatus_json= file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/CheckAgent?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&division=Sales%20Agent"); 
		    		$agentstatus = json_decode($agentstatus_json,true);   
		    		if($agentstatus['message']=='available') 
		        	{ 
		        		return  $result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&source_type=STRIKER-$source&listname=PPC%20Agent"); 
		        	} 
		   	 	else     
		        	{ 
		        		return $result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&source_type=STRIKER-$source&listname=PPC%20Executive"); 
		       	 	} */
				$listName = 'SMS Preview';
				
				// $request = file_get_contents("http://demo.office24by7.com/inhost/apis/Generate/Tracker?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&First_Name=$username&Email_ID=$email&Mobile_Number=$number&Source_Event=SEO&Source_Type=Landing Page&Source_Value=Smart SMS&Budget=0");  
				
				return $result = file_get_contents("https://voiceapi.office24by7.com/LeadGenerate/AddLead?API_Key=484960c1-5861-42a7-aebd-ee92639bea0e&cust_number=$number&listname=$listName&source_type=$source");
				
				   
			}
		}      
		echo $result;    
	}
   
	public function ppcUserIp() { 
 		$this->load->model('newuser_model');  
		$data = $this->input->post('json');
		$source = $this->input->post('source');
		$pageName = $this->input->post('pageName');
		$this->newuser_model->updatePPCUserIP($data,$source,$pageName);

	}


	
}
?>
