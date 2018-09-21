<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DIDpayments extends CI_Controller {
	
	function __construct() {
		
		parent::__construct();	
			
			$this->load->library('session');
 			if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
			$this->load->database();
			$this->load->helper('url');	
			$this->load->library("pagination");        	
			$this->load->model('User_Model');     
			$this->load->model('Voice_rental_model');      	
        	$real_url=$this->data['real_url'] = $this->config->item('voice_did_url');
			$this->load->model('Mcrental_model');        
			$this->_userId = $user_id =$this->session->userdata('user_id');
		$this->load->model('User_model');
			$credits_rs = $this->User_model->getAvailableCredits($this->_userId);
	        foreach ($credits_rs as $rs) {
	        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
	        }
		$gettaxt=$this->Mcrental_model->get_tax_value();
		foreach($gettaxt as $key=>$taxval)
		{
			$tax=$this->data['tax']=$taxval->value/100;
			$tax_per=$this->data['tax_per']=$taxval->value;
		}			     
        	$this->data['order_new'] = $this->config->item('new_order');
			$this->data['order_renewal'] = $this->config->item('renewal');
			$this->data['immediate_upgrade'] = $this->config->item('immediate_upgrade');
			$this->data['after_expiry_upgrade'] = $this->config->item('after_expiry_date_upgrade');
			$this->data['order_credits'] = $this->config->item('credits');
			$this->data['order_balance'] = $this->config->item('balance');			
    	}	
	
	public function index()
	{	
	date_default_timezone_set('asia/kolkata');
		$real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->_data['avl_silvernos'] = $this->get_didtypes('SILVER');
		$this->_data['avl_goldnos'] = $this->get_didtypes('GOLD');
		$this->_data['avl_platinumnos'] = $this->get_didtypes('PLATINUM');
		
		$cart_val = $this->Voice_rental_model->get_cart();
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
			$array_did[$xyz] = $did_val['did_number'];
			$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
		
		if($this->input->post('submit') != '')
		{
			//print_r($_POST);
			//exit;
			$input = trim($_REQUEST['sel_nos']);
			$numbers = preg_split('/\s+/', $input);
			$didnumber = implode(",",$numbers);
			$result_1 = $this->Voice_rental_model->add_cart($user_id,$didnumber);
			
			$didvalue = explode(",",$didnumber);
			$xyz=0;
			for($y=0;$y<count($didvalue);$y++)
			{
				foreach($cart_val AS $did_val)
				{
					if($didvalue[$y] == $did_val['did_number'] && $user_id != $did_val['user_id'])
					{
						$xyz++;
					}	
				}
				
			}
			
			if($xyz > 0)
			{
				$this->session->set_flashdata('error_message', 'Service number already in processing. Please chose another number');
				redirect('DIDpayments/index');	
			}	
			else
			{			
			/*
				$_SESSION['rental_plan'] = $_REQUEST['rental_plan'];		
				$_SESSION['plan_service'] = $_REQUEST['plan_service'];		
				$_SESSION['planprice'] = $_REQUEST['planprice'];
				$input = trim($_REQUEST['sel_nos']);
				$numbers = preg_split('/\s+/', $input);
				$_SESSION['sel_nos'] = implode(',', $numbers);
				$_SESSION['did_values'] = $_REQUEST['did_values'];*/
				
				//print_r($_REQUEST);
				//exit;
				
				$_SESSION['rental_plan'] = $_REQUEST['rental_plan'];
               	$rr=explode(',',$_REQUEST['rental_plan']);
				$_SESSION['max_calls'] = $rr[0];
				$_SESSION['package_cost'] = $rr[1];	
				$_SESSION['plan_days'] = $rr[2];
					
                //print_r($rr);
                				
				$_SESSION['plan_service'] = $_REQUEST['plan_service'];		
				$_SESSION['planprice'] = $_REQUEST['planprice'];
				$_SESSION['getsstax'] = $_REQUEST['getsstax'];
				$input = trim($_REQUEST['sel_nos']);
				$numbers = preg_split('/\s+/', $input);
				$_SESSION['sel_nos'] = implode(',', $numbers);
				$_SESSION['did_values'] = $_REQUEST['did_values'];
				$_SESSION['totaldidcost'] = $_REQUEST['totaldidcost'];
					
				redirect('DIDpayments/Order_form');
			}
		}
		
		$this->_data['serviceno_types'] = $this->getsno_types();
			
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		//print_r($this->Mcrental_model->getClients());					
				
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/payment',$this->_data);
		
		//$this->load->view('include/footer');
	}
	
	public function order_numbers()
	{	
	date_default_timezone_set('Asia/Kolkata');
	      $data=array();
		$this->_data['didprice_result']=array();
	
		$real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
        	$cart_val = $this->Voice_rental_model->get_cart();
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
			$array_did[$xyz] = $did_val['did_number'];
			$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
        	
        	$plan_service=$_REQUEST['plan_service'];
        	
        	
        	$this->_data['plan_service']=$_REQUEST['plan_service'];
        	
        	if(@$_REQUEST['snos']!='')
        	{
        	  $_SESSION['sel_nos']=$_REQUEST['snos'];
        	}
	      
	          $did_types=array();
	          
	            $sql="select service_types from service_types where service_value='$plan_service'";
			 $rs=$this->db->query($sql)->result();
			 
				foreach($rs as $key=>$value)
				{
				$rs3=explode(',',$value->service_types);
				//print_r($rs3);
					foreach($rs3 as $key=>$value3)
					{
					 
					$sql2="select did_name,did_value from did_types where did_name IN('$value3')";

					$rs2=$this->db->query($sql2)->result();

						foreach($rs2 as $key=>$value1)
						{

						@$did_name = $value1->did_name;
						@$did_value = $value1->did_value;

						array_push($did_types,array('did_name'=>$did_name,'did_value'=>$did_value));

						}

					}
				}
			
			 
			 
			 
			 //print_r($did_types);
			
			 $this->_data['did_types']=$did_types;
        	
        	//print_r($this->_data['did_types']);	
        		
		$this->_data['avl_silvernos'] = $this->get_didnos('SILVER',$plan_service);
		$this->_data['avl_goldnos'] = $this->get_didnos('GOLD',$plan_service);
		
		//print_r($this->_data['avl_goldnos']);
		
		
		// get did numbers price sart
			
			//print_r($_REQUEST['snosprice']);
	
	
			//$did_nos= $_REQUEST['snosprice'];
			
			if(@$_SESSION['sel_nos']!='')
			{
			$did_nos= @$_SESSION['sel_nos'];
			$data['did_nos']=$did_nos;
			$real_url=$this->data['real_url'];
			$qry_fields =array('did_nos' => urlencode($did_nos));
			$did_url = $real_url."get_didprice_api.php";
			$qry_fields_string = http_build_query($qry_fields);
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
				   $this->_data['didprice_result']=$result1;
				   
				}
		      }
		// get did numbers price sart
		
		$this->_data['avl_platinumnos'] = $this->get_didnos('PLATINUM',$plan_service);
	      
		$this->load->view('payments/order_numbers',$this->_data);
		
		//$this->load->view('include/footer');
	}
	
	public function get_didnos($did_plan,$plan_service)
	{   
	date_default_timezone_set('Asia/Kolkata');  
		$real_url=$this->data['real_url'];
		$qry_fields =array('did_plan' => urlencode($did_plan),'did_service' => urlencode($plan_service));
	      $did_url = $real_url."get_didnos.php";
		$qry_fields_string = http_build_query($qry_fields);
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
		$result=$result1;
		}
		else
		{
		$result=array();
		}
		return $result;
	}	
		
	
	public function Search_silverno()
	{
	date_default_timezone_set('Asia/Kolkata');
		$silverno = $this->_data['silverno']=$_REQUEST['silverno'];
		$checkedno = $this->_data['checkedno']=$_REQUEST['checkedno'];
		$service_type = $this->_data['service_type']=$_REQUEST['service_type'];
		
		$Number_type = $this->_data['Number_type']=$_REQUEST['Number_type'];
		//echo ($this->_data['checkedno']);
		//exit;		
		$cart_val = $this->Voice_rental_model->get_cart();
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
		$array_did[$xyz] = $did_val['did_number'];
		$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
		
		// GET SILER SERACH NOS   
		$real_url=$this->data['real_url'];
		$qry_fields =array('did_plan' => urlencode('SILVER'),'search_no' => urlencode($_REQUEST['silverno']),'service_type' => urlencode($_REQUEST['service_type']),'Number_type' => urlencode($_REQUEST['Number_type']));
		//print_r($qry_fields);
		//exit;
		echo $did_url = $real_url."get_livedidnos_api.php";		
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
		//exit;
		$getsilver_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getsilver_didlist_api;
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}

		$this->_data['avl_silvernos'] = $result;	
		//return $result;
		//print_r($this->_data['avl_silvernos']);

		$this->load->view('payments/service_nos/getsilver_nos',$this->_data);	 
	}
	public function Search_goldno()
	{
	date_default_timezone_set('Asia/Kolkata');
		 //print_r($_REQUEST);
		
		$goldno = $this->_data['goldno'] = $_REQUEST['goldno'];
		$checkedno = $this->_data['checkedno']=$_REQUEST['checkedno'];
		$service_type = $this->_data['service_type']=$_REQUEST['service_type'];
		$Number_type = $this->_data['Number_type']=$_REQUEST['Number_type'];
		
		$cart_val = $this->Voice_rental_model->get_cart();
		//print_r($cart_val);
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
		$array_did[$xyz] = $did_val['did_number'];
		$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
//print_r($this->_data['cart_num']);
		// GET GOLD SERACH NOS   
		$real_url=$this->data['real_url'];
		$qry_fields =array('did_plan' => urlencode('GOLD'),'search_no' => urlencode($_REQUEST['goldno']),'service_type' => urlencode($_REQUEST['service_type']),'Number_type' => urlencode($_REQUEST['Number_type']));
		 $did_url = $real_url."get_livedidnos_api.php";
		 $qry_fields_string = http_build_query($qry_fields);
		$did_conn= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getgold_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		 $result1 =$getgold_didlist_api;
		 //print_r($result1);
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}

		$this->_data['avl_goldnos'] = $result;	
		//print_r($this->_data['avl_goldnos']);
		//$this->_data['avl_goldnos'] = $this->get_didtypes('GOLD');
		$this->load->view('payments/service_nos/getgold_nos',$this->_data);			
	}
	public function Search_platinumno()
	{
	date_default_timezone_set('Asia/Kolkata');
		$platinumno = $this->_data['platinumno'] = $_REQUEST['platinumno'];
		$checkedno = $this->_data['checkedno']=$_REQUEST['checkedno'];
		$service_type = $this->_data['service_type']=$_REQUEST['service_type'];
		$Number_type = $this->_data['Number_type']=$_REQUEST['Number_type'];
		
		$cart_val = $this->Voice_rental_model->get_cart();
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
		$array_did[$xyz] = $did_val['did_number'];
		$xyz++;
		}
		$this->_data['cart_num'] = $array_did;


		// GET PLATINUM SERACH NOS   
		$real_url=$this->data['real_url'];
		$qry_fields =array('did_plan' => urlencode('PLATINUM'),'search_no' => urlencode($_REQUEST['platinumno']),'service_type' => urlencode($_REQUEST['service_type']),'Number_type' => urlencode($_REQUEST['Number_type']));
		$did_url = $real_url."get_livedidnos_api.php";
		//exit;
		$qry_fields_string = http_build_query($qry_fields);
		//exit;
		$did_conn = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getplati_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getplati_didlist_api;
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}

		$this->_data['avl_platinumnos'] = $result;

		$this->load->view('payments/service_nos/getplatinum_nos',$this->_data);	
	}
	
	public function cart_timeout()
	{
	date_default_timezone_set('Asia/Kolkata');
		$userid = $this->session->userdata('user_id');
		$cart_val = $this->Voice_rental_model->get_cart_val($userid);
	
		foreach($cart_val as $cart)
		{
			date_default_timezone_set('asia/kolkata');
			$current_time = date("H:i:s");
			$time = date("H:i:s",strtotime($cart['date']));
			$datetime1 = new DateTime($time);
			$datetime2 = new DateTime($current_time);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%i');
			if($elapsed >= 1)
			{
				//echo $val = "true";
				exit;
			}
		}
	}
	
	public function remove_did()
	{
	date_default_timezone_set('Asia/Kolkata');
		$userid = $this->session->userdata('user_id');
		
		$this->Voice_rental_model->deletecart($userid);
		
		$this->session->unset_userdata('rental_plan');
		$this->session->unset_userdata('plan_service');
		$this->session->unset_userdata('planprice');
		$this->session->unset_userdata('sel_nos');
		$this->session->unset_userdata('did_values');
		$this->session->set_flashdata('error_message',  "Order time out.Please reselect service numbers.");
		//redirect('DIDpayments/index');
	}
	
	// changed function Ramshree
	public function Order_form()
	{
	date_default_timezone_set('Asia/Kolkata');
	
		$this->_data['url_redirect']= base_url()."DIDpayments/index";
		
		$userid = $this->session->userdata('user_id');
		
		$this->load->model('Voice_rental_model');
				
		if($_SESSION['rental_plan'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '' || $_SESSION['did_values'] == '')
		{		
			redirect('DIDpayments/index');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$rental_plan = $_SESSION['rental_plan'];		
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$did_values = $_SESSION['did_values'];
		$user_service = $this->config->item('user_service');
		$order_type = $this->data['order_new'];
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		$tax = $this->Voice_rental_model->get_tax_value();
		foreach($tax AS $tax_per)
		{
			$tax_value = $tax_per->value;
		}
		
		$this->load->model('Voice_rental_model');
		
		if($this->input->post('confirm_order') != '')
		{
			//print_r($_POST);
			//exit;
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');
			$address_1 = $this->input->post('address1');
			$_SESSION['address1'] = $address_1;
			$address_2 = $this->input->post('address2');
			$_SESSION['address2'] = $address_2;
			$state_id = $this->input->post('state');
			$_SESSION['state'] = $state_id;
			$city_id = $this->input->post('city');
			$_SESSION['city'] = $city_id;
			$zipcode = $this->input->post('zipcode');
			$_SESSION['zipcode'] = $zipcode;
	
	$userid = $this->session->userdata('user_id');
	$address1 = $address_1;
	$address2 = $address_2;
	$city_idn = $city_id;
	$state_idn = $state_id;
	//exit;
	$this->Voice_rental_model->Update_userdata($userid,$address1,$address2,$city_idn,$state_idn,$zipcode);
				
			$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
			@$state=$staters[0]->state;
				        
				
				      
			$city_id=$_POST['city'];
			$cityrs=$this->db->query("select * from new_citylist where city_id=$city_id")->result();
			@$city=$cityrs[0]->city_name;
				  
				       
			
			$result = $this->Voice_rental_model->insert_payments($user_name,$userid,$rental_plan,$plan_service,$planprice,$sel_nos,$did_values,$user_service,$order_type,$tax_value);
			
			if($result > 0)
			{			
			    $plan = explode(",",$rental_plan);
		    	$mc_quantity = $plan[0];
				//redirect to payment gateway page
				$val = 'amount='.base64_encode($planprice).'&name='.base64_encode($user_name).'&trnsale='.base64_encode($mc_quantity).'&customerid='.base64_encode($userid).'&address1='.base64_encode($address_1).'&address2='.base64_encode($address_2).'&state='.base64_encode($state).'&city='.base64_encode($city).'&zip='.base64_encode($zipcode).'&mobile='.base64_encode($mobile_num).'&email='.base64_encode($email_id);
				$testssl_url=base_url()."payment/TestSsl.php?auto_transid=".base64_encode($result)."&".$val;
				redirect($testssl_url);
				
				
				/*
				$plan = explode(",",$rental_plan);
		    	$mc_quantity = $plan[0];
		    		
				//redirect to payment gateway page
				$val = 'amount='.$planprice.'&name='.$user_name.'&trnsale='.$mc_quantity.'&customerid='.$userid.'&address1='.$address_1.'&address2='.$address_2.'&state='.$state.'&city='.$city.'&zip='.$zipcode.'&mobile='.$mobile_num.'&email='.$email_id;
				 $testssl_url=base_url()."payment/TestSsl.php?mcbill_id=".$result."&".$val;
				redirect($testssl_url);
				*/
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not inserted.Please check order details.');
				redirect('DIDpayments/index');
			}
		}
			
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($userid);	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
		
		
			
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/order-conformation',$this->_data);
		//$this->load->view('include/footer');
	}
	
	
	
	public function Order_Gateway_Response()
	{
	date_default_timezone_set('Asia/Kolkata');
		$userid = $this->session->userdata('user_id');
		if($userid=="")
		{
			$userid=$this->input->get('user_name');
			$this->User_Model->createsessionparameters($userid);
		}
		$voicestriker_balance=$this->User_Model->availablebalance($userid);


		if($this->input->get('rm') == 'Transaction Successful')
		{
			if(@$_SESSION['sel_nos']!='')
			{
			$this->Voice_rental_model->delete_cart(@$_SESSION['sel_nos'],$userid);
			}
			$this->session->unset_userdata('rental_plan');
			$this->session->unset_userdata('plan_service');
			$this->session->unset_userdata('planprice');
			$this->session->unset_userdata('sel_nos');
			$this->session->unset_userdata('did_values');
			$this->session->set_flashdata('success_message',  $_REQUEST[rm]);				
			redirect('DIDpayments/index');
		}
		else
		{
			if(@$_SESSION['sel_nos']!='')
			{
			$this->Voice_rental_model->delete_cart(@$_SESSION['sel_nos'],$userid);
			}
			if($this->input->get('rm') != '')
			{
				$this->session->set_flashdata('error_message',  $_REQUEST[rm]);	
			}
			else
			{
			$this->session->set_flashdata('error_message',  "Transaction Cancelled");	
			}			
			redirect('DIDpayments/index');
		}
	}
	
	public function Order_renewal_Response()
	{
	date_default_timezone_set('Asia/Kolkata');
		$userid = $this->session->userdata('user_id');
		if($userid=="")
		{
			$userid=$this->input->get('user_name');
			$this->User_Model->createsessionparameters($userid);
		}
		$voicestriker_balance=$this->User_Model->availablebalance($userid);


		if($this->input->get('rm') == 'Transaction Successful')
		{
			if(@$_SESSION['sel_nos']!='')
			{
			$this->Voice_rental_model->delete_cart(@$_SESSION['sel_nos'],$userid);
			}
			$this->session->unset_userdata('rental_plan');
			$this->session->unset_userdata('plan_service');
			$this->session->unset_userdata('planprice');
			$this->session->unset_userdata('sel_nos');
			$this->session->unset_userdata('did_values');
			$this->session->set_flashdata('success_message',  $_REQUEST[rm]);				
			redirect('DIDpayments/index');
		}
		else
		{
			if(@$_SESSION['sel_nos']!='')
			{
			$this->Voice_rental_model->delete_cart(@$_SESSION['sel_nos'],$userid);
			}
			if($this->input->get('rm') != '')
			{
				$this->session->set_flashdata('error_message',  $_REQUEST[rm]);	
			}
			else
			{
			$this->session->set_flashdata('error_message',  "Transaction Cancelled");	
			}			
			redirect('DIDpayments/index');
		}
	}
	
	public function codeotp()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		//$user_id =$this->session->userdata('user_id');
		//$this->load->model('Mcrental_model');		
        //$user_details = $this->_data['user_details'] = $this->Mcrental_model->Getuser_details($user_id);
		//print_r($user_details);	
		$data['end']=$this->session->userdata('end');
		
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('payments/codeotp');
		//$this->load->view('include/footer');	
	}
	
	public function thank()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];			        
		$this->load->model('Mcrental_model');
        		
		if($_REQUEST['tn']){
			$ePGTxnID=$_REQUEST['tn'];
			$Message=$_REQUEST['rm'];
			$mcbillings = $this->Mcrental_model->billigPaydetails($ePGTxnID);
			foreach($mcbillings as $key=>$mbill){	
				$did_no = $mbill->service_nos;
				$quantity = $mbill->mc_quantity;	
				$user_id = $mbill->user_id;
				$plan_days = $mbill->plan_days;
				$pservice = $mbill->plan_service;
				$uservice = $mbill->user_service;
				$fsms = $mbill->sms_credits;
				$fcalls = $mbill->vc_amount;
				$epgTid = $mbill->epg_txnID;
           
            $data['user_id']=$mbill->user_id;
			$did_nos = array();
			$did_nos = explode(',',$did_no);
			$tot_nos = count($did_nos);
			
		if($ePGTxnID = $epgTid){			
			$sn = 0;
			while($sn < $tot_nos) {	
			$sdate = date('Y-m-d');
			$sdays = $plan_days;
			$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days')); 	
			$active = 'Y'; 
			$did_callfields = array('did_no' => urldecode($did_nos[$sn]),			
			'user_name' => $user_id,	
			'active' => $active,
			'pservice' => $pservice,
			'uservice' => $uservice,
			'subscription_date' => $sdate,
			'subsc_duration' => $sdays,
			'expiry_date' => $pay_edate,
			'max_calls' => $quantity);
        $did_call_url = $real_url."didpayupdate_api.php";
		$did_call_string = http_build_query($did_callfields);
		$did_ch = curl_init();
		curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
		curl_setopt($did_ch, CURLOPT_HEADER, 0);
		curl_setopt($did_ch,CURLOPT_POST, count($_POST));
		curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
		curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
		echo $did_result = curl_exec($did_ch);
        curl_close($did_ch);	
		
		$sn++;	
		}	     
				}	
			}
			
			
		}
// session data start.
	$this->load->model('User_Model');	
	$rs=$this->User_Model->getPaymentUserDetails($user_id);
	  if($rs)
	  {
     	foreach($rs as $result)
		{
		$sessionData = array (
		'username' => $result->username,
		'mobile' => $result->mobile,
		'first_name' => $result->first_name,
		'user_id' => $result->user_id,
		'no_ndnc' => $result->no_ndnc,
		'dnd_check' => $result->dnd_check,
		'dlr_enabled' => $result->dlr_enabled,
		'is_reseller' => $result->is_reseller,
		'ndnc_return' => $result->return_ndnc_credits,
		'template_check' => $result->template_check,
		'max_ports' => $result->max_ports,
		'voice_users' => $result->voice_users,
		'max_participants' => $result->max_participants,
		'is_missedcall' => $result->is_missedcall,
		'is_obd' => $result->is_obd,
		'caller_id' => $result->caller_id,
		'is_call_record' => $result->is_call_record,
		'price_per_pulse' => $result->price_per_pulse,
		'pulse_duration' => $result->pulse_duration,
		'sms_price' => $result->sms_price
		);
		
		$_SESSION['user_id']=$result->user_id;
		
		}
		
	    $this->session->set_userdata($sessionData);
	  }
	  
// session data end.
		$this->load->view('include/header',$data);
		$this->load->view('include/menu');
		$this->load->view('payments/thank');
		//$this->load->view('include/footer');	
	}
	
	public function Renwal_or_Upgrade()
	{
	date_default_timezone_set('Asia/Kolkata');

	
	if(@$_REQUEST['Upgrade_Package'])
		{
		// echo "Upgrade_Package";
		 $this->UpgradePackage();
		}
		if(@$_REQUEST['Renwal_Package'])
		{
		// echo "Renwal_Package";
		  $this->RenwalPackage();
		}
	 }
      
      
	public function UpgradePackage()
	{
	    date_default_timezone_set('Asia/Kolkata');
	      $this->_data['real_url']=$this->data['real_url'];
	     
	                 $rs=$this->db->get('global_settings')->result();
				//print_r($rs);
				foreach($rs as $key=>$taxval)
				{
				 $tax=$taxval->value/100;
				}
	   
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
           if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		$this->load->model('Mcrental_model');
		
		$user = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));
		foreach($user as $key=>$username)
		{
		$username=$username->username;
		}
		
		
		
			
		if(isset($_POST['Upgrade_Package']))
		{ 
	                  //date_default_timezone_set("Asia/Bangkok");	
				
				
				 	
				
				$transaction_id = substr(mt_rand(), 0, 6);	   
				   
				$didno=$_REQUEST['did_snos']; 
				
		   $getUserDetailts=$this->Mcrental_model->getUserDetailts(@$_REQUEST['user_id']);
                
               // print_r($getUserDetailts);
                
                foreach($getUserDetailts as $key=>$user)
                {
                $cust_name=$user->username;
                } 
                         
                     if($didno!='')
                     {
                     
				// new added code for did payment price start

				$did_callfields=array('did_no'=>urlencode($didno));
				//$did_call_url = $this->data['real_url'].'/get_didpayment.php";
				
				$did_call_url = $this->data['real_url']."get_didpayment.php";
				
				$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				$did_result = curl_exec($did_ch);
				curl_close($did_ch);

				$didplanpricearr=json_decode($did_result,true);

				//print_r($didplanpricearr);
				$didplanprice=$didplanpricearr['didprice'];
				$did_type=$didplanpricearr['did_type'];
				$did_plan=$didplanpricearr['did_plan'];
				
				$plan_duration=$_REQUEST['pdays'];
				$service_name=$_REQUEST['plan_service'];

		            $sql="select * from voice_service_plans where service_name='$service_name' and plan_duration = '$plan_duration'";
                        
                        $data=$this->db->query($sql)->result();
                        
                        foreach($data as $key=>$sevicepricedata)
                        {
                         $plan_price = $sevicepricedata->plan_price; 
                        }
                        
                         if($_REQUEST['newpackage']!='')
                          {
                          $str=explode(',',$_REQUEST['newpackage']);

		               //print_r($str);
		               
		               $qnty=$str[0];
		               $plan_price=$str[1];
		               $plan_days=$str[2];
		               $sms_credits=$str[3];
		               $vc_amount=$str[4];
		               $package_id=$str[5];
		               
		            $sdate = date('Y-m-d');
				$sdays =  $plan_days;
				
				$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));
		               
                          }
                  
                  $snoscost=$didplanprice;     
                  $tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $snoscost;				
			} else if($plan_days == 60){
			$tot_no_cost = $snoscost * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $snoscost * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $snoscost * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $snoscost * 12;				
			} else {
			$tot_no_cost = 0;
			}
				$totalplanprice=$tot_no_cost+$plan_price;
			      $gettax = $totalplanprice * $tax;
			      
			     $amount=$totalplanprice+$gettax;
                        
                      
                       
				// new added code for did payment price end
                         
                $insertmcdata = array(
				   'user_id' => $this->session->userdata('user_id'),
				   'cust_name' => $username,
				   'user_service' => $_REQUEST['user_service'],
				   'service_nos' => $didno,
				   'plan_service' => $_REQUEST['plan_service'],
				   'mc_quantity' => $qnty,
				   'sms_credits' => $sms_credits,
				   'amount' =>  $amount,
				   'vc_amount' => $vc_amount,
				   'status' => "1",
				   'billing_date' => date('Y-m-d H:i:s'),
				   'plan_days' => $plan_days,
				   'transaction_id'=> $transaction_id,
				   'package_cost' =>  $plan_price,
				   'did_plan' =>  $did_plan,
				   'did_type' =>  $did_type,
				   'did_amount' =>  $didplanprice,
				   'description' =>  $this->config->item('renewal'),
				   'package_id' =>  $package_id,
				   'tax_percentage' => $tax				   
				   );
				
				
				  $bill_id=$this->Mcrental_model->admin_didmcpayments($this->session->userdata('user_id'),$_REQUEST['user_service'],$didno,$insertmcdata);  
				   
				  
				  
	 if(@$bill_id > 0)
    		{
    			date_default_timezone_set('Asia/Kolkata');
    			$curent_date = strtotime(date('Y-m-d'));
    			$expiredate = strtotime($_REQUEST['expire_date']);
    			if($curent_date > $expiredate)
    			{
    		  
    		      $active = 'Y'; 
			$did_callfields = array('did_no' => urlencode($didno),			
			'user_name' => urlencode($_REQUEST['user_id']),	
			'active' => urlencode($active),
			'pservice' => urlencode($_REQUEST['plan_service']),
			'uservice' => urlencode($_REQUEST['user_service']),
			'subscription_date' => urlencode(date('Y-m-d H:i:s')),
			'subsc_duration' => urlencode($_REQUEST['pdays']),
			'expiry_date' => urlencode($pay_edate),
			'max_calls' => urlencode($plan_days));

			
    		       
    		       $sql_query = "update users_servicewise_credits set renewal_date = curdate(),renewal_mc_id = '$bill_id' where user_id = '$user_id' AND user_service='$user_service' AND did_number='$didno'";
    			$res = $this->db->query($sql_query);
    			
			$did_call_url = $this->config->item('didpayupdate_api')."/crons/renewal_script.php";
			$did_call_string = http_build_query($did_callfields);
			$did_ch = curl_init();
			curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
			curl_setopt($did_ch, CURLOPT_HEADER, 0);
			curl_setopt($did_ch,CURLOPT_POST, count($_POST));
			curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
			curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
			$did_result = curl_exec($did_ch);
			curl_close($did_ch);
    		 
    			} 
    			else
    			{
    			
    				$date = $_REQUEST['expire_date'];
				$date1 = str_replace('-', '/', $date);
				$renewal_date = date('Y-m-d',strtotime($date1 . "+1 days"));
				$user_service=$_REQUEST['user_service'];
				$user_id=$_REQUEST['user_id'];
    				$sql_query = "update users_servicewise_credits set renewal_date = '$renewal_date',renewal_mc_id = '$bill_id' where user_id = '$user_id' AND user_service='$user_service' AND did_number='$didno'";
    				$res = $this->db->query($sql_query);
    				
    				
    			}
    		}	
		
				}
				
				
				
				if($did_result)
				{
				redirect('DIDpayments/my_packages/upgraded');
				}	
			  
		}
		
	}
// upgrade plan services

	public function UpgradeServicePlan()
	{
	
	date_default_timezone_set('Asia/Kolkata');
	      $this->_data['real_url']=$this->data['real_url'];
	      
	      $rs=$this->db->get('global_settings')->result();
				//print_r($rs);
				foreach($rs as $key=>$taxval)
				{
				 $tax=$taxval->value;
				}
	     
	    $tax=$tax/100; 
	   
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
             if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		$this->load->model('Mcrental_model');
		
		
		
		
		
			
		if(isset($_POST['Upgrade_Package']))
		{ 
	                  //date_default_timezone_set("Asia/Bangkok");	
				
				
				 	
				
	     $transaction_id = substr(mt_rand(), 0, 6);	   
				   
		$didno=$_REQUEST['did_snos']; 
				
		   $getUserDetailts=$this->Mcrental_model->getUserDetailts($this->session->userdata('user_id'));
                
               // print_r($getUserDetailts);
                
                foreach($getUserDetailts as $key=>$user)
                {
                $cust_name=$user->username;
                } 
                         
                     if($didno!='')
                     {
                     
				// new added code for did payment price start

				$did_callfields=array('did_no'=>urlencode($didno));
				//$did_call_url = $this->data['real_url'].'/get_didpayment.php";
				
				$did_call_url = $this->data['real_url']."get_didpayment.php";
				
				$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				$did_result = curl_exec($did_ch);
				curl_close($did_ch);

				$didplanpricearr=json_decode($did_result,true);

				//print_r($didplanpricearr);
				$didplanprice=$didplanpricearr['didprice'];
				$did_type=$didplanpricearr['did_type'];
				$did_plan=$didplanpricearr['did_plan'];
				
				$plan_duration=$_REQUEST['pdays'];
				$service_name=$_REQUEST['plan_service'];

		            $sql="select * from voice_service_plans where service_name='$service_name' and plan_duration = '$plan_duration'";
                        
                        $data=$this->db->query($sql)->result();
                        
                        foreach($data as $key=>$sevicepricedata)
                        {
                         $plan_price = $sevicepricedata->plan_price; 
                        }
                        
                         if($_REQUEST['rental_plan']!='')
                          {
                          $str=explode(',',$_REQUEST['rental_plan']);

		               //print_r($str);
		               
		               $qnty=$str[0];
		               $plan_price=$str[1];
		               $plan_days=$str[2];
		               $sms_credits=$str[3];
		               $vc_amount=$str[4];
		               $package_id=$str[5];
		               
		            $sdate = date('Y-m-d');
				$sdays =  $plan_days;
				
				$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));
		               
                          }
                  
                  $snoscost=$didplanprice;     
                  $tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $snoscost;				
			} else if($plan_days == 60){
			$tot_no_cost = $snoscost * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $snoscost * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $snoscost * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $snoscost * 12;				
			} else {
			$tot_no_cost = 0;
			}
				$totalplanprice=$tot_no_cost+$plan_price;
			      $gettax = $totalplanprice * $tax;
			      
			     $amount=$totalplanprice+$gettax;
                        
                      
                       
				// new added code for did payment price end
                         
                           $insertmcdata = array(
				   'user_id' => $this->session->userdata('user_id'),
				   'cust_name' => $cust_name,
				   'user_service' => $_REQUEST['user_service'],
				   'service_nos' => $didno,
				   'plan_service' => $_REQUEST['plan_service'],
				   'mc_quantity' => $qnty,
				   'sms_credits' => $sms_credits,
				   'amount' =>  $amount,
				   'vc_amount' => $vc_amount,
				   'status' => "1",
				   'billing_date' => date('Y-m-d H:i:s'),
				   'plan_days' => $plan_days,
				   'transaction_id'=> $transaction_id,
				   'package_cost' =>  $plan_price,
				   'did_plan' =>  $did_plan,
				   'did_type' =>  $did_type,
				   'did_amount' =>  $didplanprice,
				   'description' =>  $this->config->item('upgrade'),
				   'package_id' =>  $package_id,
				   'tax_percentage' => $tax
				   );
				   
				 
				  $bill_id=$this->Mcrental_model->admin_didmcpayments($this->session->userdata('user_id'),$_REQUEST['user_service'],$didno,$insertmcdata);  
				   
		
    		if(@$bill_id > 0)
    		{
    			date_default_timezone_set('Asia/Kolkata');
    			$curent_date = strtotime(date('Y-m-d'));
    			$expiredate = strtotime($_REQUEST['expire_date']);
    			if($curent_date > $expiredate)
    			{
    		       
    		    
    		 
			$active = 'Y'; 
			$did_callfields = array('did_no' => urlencode($didno),			
			'user_name' => urlencode($this->session->userdata('user_id')),	
			'active' => urlencode($active),
			'pservice' => urlencode($_REQUEST['plan_service']),
			'uservice' => urlencode($_REQUEST['user_service']),
			'subscription_date' => urlencode(date('Y-m-d H:i:s')),
			'subsc_duration' => urlencode($plan_days),
			'expiry_date' => urlencode($pay_edate),
			'max_calls' => urlencode($qnty));

			$sql_query = "update users_servicewise_credits set renewal_date = curdate(),renewal_mc_id = '$bill_id' where user_id = '$user_id' AND user_service='$user_service' AND did_number='$didno'";
    			$res = $this->db->query($sql_query);
    			
			$did_call_url = $this->config->item('didpayupdate_api')."/crons/renewal_script.php";
			$did_call_string = http_build_query($did_callfields);
			$did_ch = curl_init();
			curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
			curl_setopt($did_ch, CURLOPT_HEADER, 0);
			curl_setopt($did_ch,CURLOPT_POST, count($_POST));
			curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
			curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
			$did_result = curl_exec($did_ch);
			curl_close($did_ch);
    			} 
    			else
    			{
    				
    			
    				$date = $_REQUEST['expire_date'];
				$date1 = str_replace('-', '/', $date);
				$renewal_date = date('Y-m-d',strtotime($date1 . "+1 days"));
				$user_service=$_REQUEST['user_service'];
				$user_id=$_REQUEST['user_id'];
    				$sql_query = "update users_servicewise_credits set renewal_date = '$renewal_date',renewal_mc_id = '$bill_id' where user_id = '$user_id' AND user_service='$user_service' AND did_number='$didno'";
    				$res = $this->db->query($sql_query);
    				
    				
    			}
    		}		
		}					
				
				if($did_result)
				{
				redirect('DIDpayments/my_packages/upgraded');
				}	
			  

		}
		
		
		
		
		
		
	}
// Renwal package

      
	// changed function Ramshree
	public function Order_renewal_confirm()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";	
		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');
		
		
		$user_service = $this->config->item('user_service');
		if($this->input->post('renewal_package') != '')
		{
			//print_r($_POST);
			//exit;
			$_SESSION['order_type'] = $this->data['order_renewal'];
			$_SESSION['sel_nos'] = $this->input->post('ssnos');
			$_SESSION['rental_plan'] = $this->input->post('rental_plan');
			$_SESSION['planprice'] = $this->input->post('total_amount');
			$_SESSION['plan_service'] = $this->input->post('plan_service');
			$_SESSION['did_amount'] = $this->input->post('did_amount');
			$_SESSION['tax'] = $this->input->post('tax_val');
			$_SESSION['renewtax_tot'] = $this->input->post('renewtax_tot');
			$_SESSION['did_type'] = $this->input->post('did_type');
			$_SESSION['did_plan'] = $this->input->post('did_plan');
			$_SESSION['expire_date'] = $this->input->post('expire_date');
		}
		
		if($_SESSION['rental_plan'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$rental_plan = $_SESSION['rental_plan'];		
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$did_amount = $_SESSION['did_amount'];
		$tax = $_SESSION['tax'];
		$renew_tax = $_SESSION['renewtax_tot'];
		$did_type = $_SESSION['did_type'];
		$did_plan = $_SESSION['did_plan'];
		$expire_date = $_SESSION['expire_date'];
		$order_type = $_SESSION['order_type'];
				
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		if($this->input->post('confirm_order') != '')
		{
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');			
			$address_1 = $this->input->post('address1');
			$_SESSION['address1'] = $address_1;
			$address_2 = $this->input->post('address2');
			$_SESSION['address2'] = $address_2;
			$state_id = $this->input->post('state');
			$_SESSION['state'] = $state_id;
			$city_id = $this->input->post('city');
			$_SESSION['city'] = $city_id;
			$zipcode = $this->input->post('zipcode');
			$_SESSION['zipcode'] = $zipcode;
	
	$userid = $this->session->userdata('user_id');
	$address1 = $address_1;
	$address2 = $address_2;
	$city_idn = $city_id;
	$state_idn = $state_id;
	//exit;
	$this->Voice_rental_model->Update_userdata($userid,$address1,$address2,$city_idn,$state_idn,$zipcode);
	
		$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
		@$state=$staters[0]->state;
				        
		$city_id=$_POST['city'];
		$cityrs=$this->db->query("select * from new_citylist where city_id=$city_id")->result();
		@$city=$cityrs[0]->city_name;
				
		$result = $this->Voice_rental_model->renewal_package($userid,$sel_nos,$user_service,$did_amount,$rental_plan,$tax,$renew_tax,$plan_service,$planprice,$did_type,$did_plan,$expire_date,$order_type,$user_name);
			
			if($result > 0)
			{
				$plan = explode(",",$rental_plan);
		    	$mc_quantity = $plan[0];
				//redirect to payment gateway page
				$val = 'amount='.base64_encode($planprice).'&name='.base64_encode($user_name).'&trnsale='.base64_encode($mc_quantity).'&customerid='.base64_encode($userid).'&address1='.base64_encode($address_1).'&address2='.base64_encode($address_2).'&state='.base64_encode($state).'&city='.base64_encode($city).'&zip='.base64_encode($zipcode).'&mobile='.base64_encode($mobile_num).'&email='.base64_encode($email_id);
				$testssl_url=base_url()."payment/TestSsl.php?auto_transid=".base64_encode($result)."&".$val;
				redirect($testssl_url);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
			
		//$this->_data['availablebal']= $this->_credits;
		$this->_data['username']=$this->session->userdata('fruser-username');
				
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/renwal-order-conformation',$this->_data);
		//$this->load->view('include/footer');
	}
 // changed function chandrasekhar
	public function Order_renewal_confirm1()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";	
		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');
		$this->db->where('setting_name','Service Tax');
		$rs=$this->db->get('global_settings')->result();
		//print_r($rs);
		foreach($rs as $key=>$taxval)
		{
			$tax=$taxval->value/100;
		}
		
				
		///print_r($_POST);
		               $plan_days='';
		               $plan_price='';
		               $user_service='';
		          if(@$_REQUEST['rental_plan']!='')
                          {
                          $str=explode(',',$_REQUEST['rental_plan']);

		               //print_r($str);
		               
		               $qnty=$str[0];
		               $plan_price=$str[1];
		               $plan_days=$str[2];
		               $sms_credits=$str[3];
		               $vc_amount=$str[4];
		               $package_id=$str[5];
		               
		        $sdate = date('Y-m-d');
				$sdays =  $plan_days;				
				$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));		               
                }
		
		
		$didno=@$_REQUEST['did_snos'];
		
		if($didno!='')
                     {
                     
				// new added code for did payment price start

				$did_callfields=array('did_no'=>urlencode($didno));
				//$did_call_url = $this->data['real_url'].'/get_didpayment.php";
				
				$did_call_url = $this->data['real_url']."get_didpayment.php";
				
				$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				$did_result = curl_exec($did_ch);
				curl_close($did_ch);

				$didplanpricearr=json_decode($did_result,true);

				//print_r($didplanpricearr);
				$didplanprice=$didplanpricearr['didprice'];
				$did_type=$didplanpricearr['did_type'];
				$did_plan=$didplanpricearr['did_plan'];
				
				
				$service_name=$_REQUEST['plan_service'];

		           $sql="select * from voice_service_plans where service_name='$service_name' and plan_duration = '$plan_days'";
                        
                        $data=$this->db->query($sql)->result();
                        
                        foreach($data as $key=>$sevicepricedata)
                        {
                        $plan_price = $sevicepricedata->plan_price; 
                        }
                        
                  $snoscost=$didplanprice;     
                  $tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $snoscost;				
			} else if($plan_days == 60){
			$tot_no_cost = $snoscost * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $snoscost * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $snoscost * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $snoscost * 12;				
			} else {
			$tot_no_cost = 0;
			}
				$totalplanprice=$tot_no_cost+$plan_price;
			      $gettax = $totalplanprice * $tax;
			      
			     $amount=$totalplanprice+$gettax;
		}
		
	
		
		if($this->input->post('renewal_package') != '')
		{
			
		
			$_SESSION['order_type'] = $this->config->item('renewal');
			$_SESSION['sel_nos'] = $_REQUEST['did_snos'];
			$_SESSION['user_service'] = $_REQUEST['user_service'];
			$_SESSION['rental_plan'] = $_REQUEST['rental_plan'];
			$_SESSION['planprice'] = $amount;
			$_SESSION['plan_service'] = $_REQUEST['plan_service'];
			$_SESSION['did_amount'] = $didplanprice;
			$_SESSION['tax'] =  $tax;
			$_SESSION['did_type'] = $_REQUEST['did_type'];
			$_SESSION['did_plan'] = $_REQUEST['did_plan'];
			$_SESSION['expire_date'] = $_REQUEST['expire_date'];
		}
		
		if($this->input->post('upgrade_package'))
		{
			$_SESSION['order_type'] = $this->config->item('upgrade');
			$_SESSION['sel_nos'] = $_REQUEST['did_snos'];
			$_SESSION['user_service'] = $_REQUEST['user_service'];
			$_SESSION['rental_plan'] = $_REQUEST['rental_plan'];
			$_SESSION['planprice'] = $amount;
			$_SESSION['plan_service'] = $_REQUEST['plan_service'];
			$_SESSION['did_amount'] = $didplanprice;
			$_SESSION['tax'] =  $tax;
			$_SESSION['did_type'] = $_REQUEST['did_type'];
			$_SESSION['did_plan'] = $_REQUEST['did_plan'];
			$_SESSION['expire_date'] = $_REQUEST['expire_date'];
		}
		
	
	
	if($_SESSION['rental_plan'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$rental_plan = $_SESSION['rental_plan'];		
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$did_amount = $_SESSION['did_amount'];
		$tax = $_SESSION['tax'];
		$did_type = $_SESSION['did_type'];
		$did_plan = $_SESSION['did_plan'];
		$expire_date = $_SESSION['expire_date'];
		$order_type = $_SESSION['order_type'];
		
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		if($this->input->post('confirm_order') != '')
		{
		
		
	
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');
			$address_1 = $this->input->post('address1');
			$address_2 = $this->input->post('address2');
			$state_id = $this->input->post('state');
			$city = $this->input->post('city');
			$zipcode = $this->input->post('zipcode');
			
		$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
                 @$state=$staters[0]->state;
			
			$user_service=$this->input->post('user_service');
			$mcbill_id = $this->Voice_rental_model->renewal_package($userid,$sel_nos,$user_service,$did_amount,$rental_plan,$tax,$plan_service,$planprice,$did_type,$did_plan,$expire_date,$order_type,$user_name);
			
			if($mcbill_id > 0)
			{
				$plan = explode(",",$rental_plan);
		    		$mc_quantity = $plan[0];
				//redirect to payment gateway page
				$val = 'amount='.$planprice.'&name='.$user_name.'&trnsale='.$mc_quantity.'&customerid='.$userid.'&address1='.$address_1.'&address2='.$address_2.'&state='.$state.'&city='.$city.'&zip='.$zipcode.'&mobile='.$mobile_num.'&email='.$email_id;
				$testssl_url=base_url()."payment/TestSsl.php?mcbill_id=".$mcbill_id."&".$val;
				redirect($testssl_url);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
			
		//$this->_data['availablebal']= $this->_credits;
		$this->_data['username']=$this->session->userdata('fruser-username');
				
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header', $this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/renwal-order-conformation', $this->_data);
		//$this->load->view('include/footer');
	}
	

       // changed function chandrasekhar
	public function Order_upgrade_confirm1()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";	
		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');
		
		
		$user_service = $this->config->item('user_service');
		
		if($this->input->post('upgrade_package'))
		{
			$_SESSION['upgrade_from'] = $this->input->post('upgrade_from');
			$_SESSION['sel_nos'] = $this->input->post('ssnos');
			$_SESSION['rental_plan'] = $this->input->post('rental_plan');
			$_SESSION['planprice'] = $this->input->post('total_amount');
			$_SESSION['plan_service'] = $this->input->post('plan_service');
			$_SESSION['did_amount'] = $this->input->post('did_amount');
			$_SESSION['tax'] = $this->input->post('tax_val');
			$_SESSION['did_type'] = $this->input->post('did_type');
			$_SESSION['did_plan'] = $this->input->post('did_plan');
			$_SESSION['expire_date'] = $this->input->post('expire_date');
			$_SESSION['used_days'] = $this->input->post('used_days');
		}
		
		if($_SESSION['rental_plan'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$rental_plan = $_SESSION['rental_plan'];		
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$did_amount = $_SESSION['did_amount'];
		$tax = $_SESSION['tax'];
		$did_type = $_SESSION['did_type'];
		$did_plan = $_SESSION['did_plan'];
		$expire_date = $_SESSION['expire_date'];
		$upgrade_from = $_SESSION['upgrade_from'];
		$used_days = $_SESSION['used_days'];
		
		if($_SESSION['upgrade_from'] == "After Expiry Date")
		{
			$order_type = $this->data['after_expiry_upgrade'];
		}
		else if($_SESSION['upgrade_from'] == "immediately")
		{
			$order_type = $this->data['immediate_upgrade'];
		}
		
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		if($this->input->post('confirm_order') != '')
		{
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');
			$address_1 = $this->input->post('address1');
			$address_2 = $this->input->post('address2');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$zipcode = $this->input->post('zipcode');
			
			$mcbill_id = $this->Voice_rental_model->upgrade_package($userid,$sel_nos,$user_service,$did_amount,$rental_plan,$tax,$plan_service,$planprice,$did_type,$did_plan,$expire_date,$order_type,$user_name,$upgrade_from,$used_days);
			
			if($mcbill_id > 0)
			{
				$plan = explode(",",$rental_plan);
		    		$mc_quantity = $plan[0];
		    		
		    		 $staters=$this->db->query("select * from new_statelist  where state_id=$state")->result();
                         @$state=$staters[0]->state;
				//redirect to payment gateway page
				$val = 'amount='.$planprice.'&name='.$user_name.'&trnsale='.$mc_quantity.'&customerid='.$userid.'&address1='.$address_1.'&address2='.$address_2.'&state='.$state.'&city='.$city.'&zip='.$zipcode.'&mobile='.$mobile_num.'&email='.$email_id;
				$testssl_url=base_url()."payment/TestSsl.php?mcbill_id=".$mcbill_id."&".$val;
				redirect($testssl_url);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
		
		/*	
		$this->_data['availablebal']= $this->_credits;
		$this->_data['username']=$this->session->userdata('fruser-username');		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/menu');
		$this->load->view('payments/order-conformation', $this->_data);*/
		
		//$this->_data['availablebal']= $this->_credits;
		$this->_data['username']=$this->session->userdata('fruser-username');
				
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header', $this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/upgrade-order-conformation', $this->_data);
		//$this->load->view('include/footer');
		
	}
	
	
	// changed function Ramshree
	public function MyOrder_upgrade_confirm()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";	
		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');
		
		
		$user_service = $this->config->item('user_service');
		
		if($this->input->post('upgrade_package'))
		{
		$_SESSION['auto_id'] = $this->input->post('auto_id');			
		$_SESSION['upgrade_from'] = $this->input->post('upgrade_from'.$_SESSION['auto_id']);
			$_SESSION['sel_nos'] = $this->input->post('ssnos');
			$_SESSION['rental_plan'] = $this->input->post('rental_plan');
			$_SESSION['planprice'] = $this->input->post('total_amount');
			$_SESSION['plan_service'] = $this->input->post('plan_service');
			$_SESSION['did_amount'] = $this->input->post('did_amount');
			$_SESSION['tax'] = $this->input->post('tax_val');
			$_SESSION['upgd_taxtot'] = $this->input->post('upgdtax_tot');
			$_SESSION['did_type'] = $this->input->post('did_type');
			$_SESSION['did_plan'] = $this->input->post('did_plan');
			$_SESSION['expire_date'] = $this->input->post('expire_date');
			$_SESSION['used_days'] = $this->input->post('used_days');
		}
		
		if($_SESSION['rental_plan'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$rental_plan = $_SESSION['rental_plan'];		
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$did_amount = $_SESSION['did_amount'];
		$tax = $_SESSION['tax'];
		$upgd_taxtot = $_SESSION['upgd_taxtot'];
		$did_type = $_SESSION['did_type'];
		$did_plan = $_SESSION['did_plan'];
		$expire_date = $_SESSION['expire_date'];
		$upgrade_from = $_SESSION['upgrade_from'];
		$used_days = $_SESSION['used_days'];
		
		if($_SESSION['upgrade_from'] == "After Expiry Date")
		{
			$order_type = $this->data['after_expiry_upgrade'];
		}
		else if($_SESSION['upgrade_from'] == "immediately")
		{
			$order_type = $this->data['immediate_upgrade'];
		}
		
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		if($this->input->post('confirm_order') != '')
		{
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');
			$address_1 = $this->input->post('address1'); 
			$_SESSION['address1'] = $address_1;
			$address_2 = $this->input->post('address2');
			$_SESSION['address2'] = $address_2;
			$state_id = $this->input->post('state');
			$_SESSION['state'] = $state_id;
			$city_id = $this->input->post('city');
			$_SESSION['city'] = $city_id;
			$zipcode = $this->input->post('zipcode');
			$_SESSION['zipcode'] = $zipcode;
	
		$this->load->model('Mcrental_model');
		$userid = $this->session->userdata('user_id');
		$address1 = $address_1;
		$address2 = $address_2;
		$city_idn = $city_id;
		$state_idn = $state_id;
		//exit;
		$this->Voice_rental_model->Update_userdata($userid,$address1,$address2,$city_idn,$state_idn,$zipcode);
		
		$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
		@$state=$staters[0]->state;
					      
		$city_id=$_POST['city'];
		$cityrs=$this->db->query("select * from new_citylist where city_id=$city_id")->result();
		@$city=$cityrs[0]->city_name;
			
		$result = $this->Voice_rental_model->upgrade_package($userid,$sel_nos,$user_service,$did_amount,$rental_plan,$tax,$upgd_taxtot,$plan_service,$planprice,$did_type,$did_plan,$expire_date,$order_type,$user_name,$upgrade_from,$used_days);
			
			if($result > 0)
			{
				$plan = explode(",",$rental_plan);
		    	$mc_quantity = $plan[0];
				//redirect to payment gateway page
				$val = 'amount='.base64_encode($planprice).'&name='.base64_encode($user_name).'&trnsale='.base64_encode($mc_quantity).'&customerid='.base64_encode($userid).'&address1='.base64_encode($address_1).'&address2='.base64_encode($address_2).'&state='.base64_encode($state).'&city='.base64_encode($city).'&zip='.base64_encode($zipcode).'&mobile='.base64_encode($mobile_num).'&email='.base64_encode($email_id);
				$testssl_url=base_url()."payment/TestSsl.php?auto_transid=".base64_encode($result)."&".$val;
				redirect($testssl_url);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
			
		$this->_data['username']=$this->session->userdata('fruser-username');
				
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header', $this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/upgrade-order-conformation', $this->_data);
		//$this->load->view('include/footer');
	}
	
		
 // changed function chandrasekhar
	public function Order_upgrade_confirm()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";	
		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');
		$this->db->where('setting_name','Service Tax');
		$rs=$this->db->get('global_settings')->result();
				//print_r($rs);
				foreach($rs as $key=>$taxval)
				{
				 $tax=$taxval->value/100;
				}
		        $plan_days='';
		        $plan_price='';
		        $user_service='';
		        if(@$_REQUEST['rental_plan']!='')
                          {
                          $str=explode(',',$_REQUEST['rental_plan']);

		               //print_r($str);
		               
		               $qnty=$str[0];
		               $plan_price=$str[1];
		               $plan_days=$str[2];
		               $sms_credits=$str[3];
		               $vc_amount=$str[4];
		               $package_id=$str[5];
		               
		            $sdate = date('Y-m-d');
				$sdays =  $plan_days;
				
				$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));
		               
                          }	
		
		$didno=@$_REQUEST['did_snos'];
		
		if($didno!='')
                     {
                     
				// new added code for did payment price start

				$did_callfields=array('did_no'=>urlencode($didno));
				//$did_call_url = $this->data['real_url'].'/get_didpayment.php";
				
				$did_call_url = $this->data['real_url']."get_didpayment.php";
				
				$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				$did_result = curl_exec($did_ch);
				curl_close($did_ch);

				$didplanpricearr=json_decode($did_result,true);

				//print_r($didplanpricearr);
				$didplanprice=$didplanpricearr['didprice'];
				$did_type=$didplanpricearr['did_type'];
				$did_plan=$didplanpricearr['did_plan'];
				
				
				$service_name=$_REQUEST['plan_service'];

		           $sql="select * from voice_service_plans where service_name='$service_name' and plan_duration = '$plan_days'";
                        
                        $data=$this->db->query($sql)->result();
                        
                        foreach($data as $key=>$sevicepricedata)
                        {
                        $plan_price = $sevicepricedata->plan_price; 
                        }
                        
                  $snoscost=$didplanprice;     
                  $tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $snoscost;				
			} else if($plan_days == 60){
			$tot_no_cost = $snoscost * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $snoscost * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $snoscost * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $snoscost * 12;				
			} else {
			$tot_no_cost = 0;
			}
				$totalplanprice=$tot_no_cost+$plan_price;
			      $gettax = $totalplanprice * $tax;
			      
			     $amount=$totalplanprice+$gettax;
		}
		
	   
		/*
		if($this->input->post('upgrade_package'))
		{
		
		//print_r($_REQUEST);
		   
			$_SESSION['order_type'] = $this->config->item('upgrade');
			$_SESSION['sel_nos'] = $_REQUEST['did_snos'];
			$_SESSION['user_service'] = $_REQUEST['user_service'];
			$_SESSION['rental_plan'] = $_REQUEST['rental_plan'];
			$_SESSION['planprice'] = $amount;
			$_SESSION['plan_service'] = $_REQUEST['plan_service'];
			$_SESSION['did_amount'] = $didplanprice;
			$_SESSION['tax'] =  $tax;
			$_SESSION['did_type'] = $_REQUEST['did_type'];
			$_SESSION['did_plan'] = $_REQUEST['did_plan'];
			$_SESSION['expire_date'] = $_REQUEST['expire_date'];
		}
		
		
	
	if($_SESSION['rental_plan'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$rental_plan = $_SESSION['rental_plan'];		
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$did_amount = $_SESSION['did_amount'];
		$tax = $_SESSION['tax'];
		$did_type = $_SESSION['did_type'];
		$did_plan = $_SESSION['did_plan'];
		$expire_date = $_SESSION['expire_date'];
		$order_type = $_SESSION['order_type'];
		
		*/
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		
		
		
		if($this->input->post('confirm_order') != '')
		{
		
		
	
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');
			$address_1 = $this->input->post('address1');
			$address_2 = $this->input->post('address2');
			$state_id = $this->input->post('state');
			$city = $this->input->post('city');
			$zipcode = $this->input->post('zipcode');
			
		$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
                 @$state=$staters[0]->state;
			
			$user_service=$this->input->post('user_service');
			$mcbill_id = $this->Voice_rental_model->upgrade_package($userid,$sel_nos,$user_service,$did_amount,$rental_plan,$tax,$plan_service,$planprice,$did_type,$did_plan,$expire_date,$order_type,$user_name);
			
			if($mcbill_id > 0)
			{
				$plan = explode(",",$rental_plan);
		    		$mc_quantity = $plan[0];
				//redirect to payment gateway page
				$val = 'amount='.$planprice.'&name='.$user_name.'&trnsale='.$mc_quantity.'&customerid='.$userid.'&address1='.$address_1.'&address2='.$address_2.'&state='.$state.'&city='.$city.'&zip='.$zipcode.'&mobile='.$mobile_num.'&email='.$email_id;
				$testssl_url=base_url()."payment/TestSsl.php?mcbill_id=".$mcbill_id."&".$val;
				redirect($testssl_url);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
			
		//$this->_data['availablebal']= $this->_credits;
		$this->_data['username']=$this->session->userdata('fruser-username');
				
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('payments/upgrade-order-conformation', $this->_data);
		//$this->load->view('include/footer');
	}
	
	public function RenwalPackage_Order()
	{
	date_default_timezone_set('Asia/Kolkata');
	      $this->_data['real_url']=$this->data['real_url'];
	     
		$this->db->where('setting_name','Service Tax');
		$rs=$this->db->get('global_settings')->result();
		//print_r($rs);
		foreach($rs as $key=>$taxval)
		{
		$tax=$taxval->value;
		}
				
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
          if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		$this->load->model('Mcrental_model');
		
		               
		$user = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));
		foreach($user as $key=>$username)
		{
		$username=$username->username;
		}
         
             
          @$_SESSION['sel_nos']=$_REQUEST['didno'];
                
            if(isset($_POST['Renwal_Package']))
            {
               
             
             //print_r($_POST); 
              
               $usc_id=$_REQUEST['usc_id'];
               $user_id=$this->session->userdata('user_id');
              $didno=$_REQUEST['didno'];
             
               $getLastRenewalPackagedate=$this->Mcrental_model->getLastRenewalPackagedate($user_id,$didno);
               
                $getUserDetailts=$this->Mcrental_model->getUserDetailts($user_id);
                
               // print_r($getUserDetailts);
                
                foreach($getUserDetailts as $key=>$user)
                {
                $cust_name=$user->username;
                }
               
             
              //print_r($getLastRenewalPackagedate);exit;
               
               foreach($getLastRenewalPackagedate as $key=>$lastpkg)
               {
                $user_id=$lastpkg->user_id;
                $didno=$lastpkg->did_number;
				$user_service=$lastpkg->user_service;
				$plan_service=$lastpkg->did_service;
				$max_calls=$lastpkg->max_calls;
				$sms_credits=$lastpkg->sms_credits;
				
				$vc_amount=$lastpkg->vc_amount;
				$plan_days=$lastpkg->subscription_duration;
				$package_cost=$lastpkg->package_cost;
				
				
				$validityforexpiry=$lastpkg->validityforexpiry;
				$expire_date=$lastpkg->expire_date;
				$package_id=$lastpkg->package_id;
				
				$package_cost=$lastpkg->package_cost;
				
				
				if($validityforexpiry > 0)
				{
				//$sdate = $expire_date;
				$sdate = date('Y-m-d', strtotime($expire_date . ' + 1 days')); 
				}
				else
				{
				$sdate = date('Y-m-d', strtotime($expire_date)); 			
				}
				
				$sdays = $plan_days;
				
				$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days')); 	
				$active = 'Y'; 
				
				$transaction_id = substr(mt_rand(), 0, 6);
				
				
				
				//exit;
					
                }
               
              // exit;
              
                  
				    
                     if($didno!='')
                     {
                     
				// new added code for did payment price start

				$did_callfields=array('did_no'=>urlencode($didno));
				//$did_call_url = $this->data['real_url'].'/get_didpayment.php";
				
				$did_call_url = $this->data['real_url']."get_didpayment.php";
				
				$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				$did_result = curl_exec($did_ch);
				curl_close($did_ch);

				$didplanpricearr=json_decode($did_result,true);

				//print_r($didplanpricearr);
				$didplanprice=$didplanpricearr['didprice'];
				$did_type=$didplanpricearr['did_type'];
				$did_plan=$didplanpricearr['did_plan'];
				
				$plan_duration=$_REQUEST['pdays'];
				$service_name=$_REQUEST['plan_service'];

		            $sql="select * from voice_service_plans where service_name='$service_name' and plan_duration = '$plan_duration'";
                        
                        $data=$this->db->query($sql)->result();
                        
                        foreach($data as $key=>$sevicepricedata)
                        {
                         $plan_price = $sevicepricedata->plan_price; 
                        }
                        
                         if($_REQUEST['rental_plan']!='')
                          {
                          $str=explode(',',$_REQUEST['rental_plan']);

		               //print_r($str);
		               
		               $qnty=$str[0];
		               $plan_price=$str[1];
		               $plan_days=$str[2];
		               $sms_credits=$str[3];
		               $vc_amount=$str[4];
		               $package_id=$str[5];
		               
		            $sdate = date('Y-m-d');
				$sdays =  $plan_days;
				
				$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));
		               
                          }
                  
                  $snoscost=$didplanprice;     
                  $tot_no_cost = 0;
			if($plan_days == 30){
			$tot_no_cost = $snoscost;				
			} else if($plan_days == 60){
			$tot_no_cost = $snoscost * 2;				
			} else if($plan_days == 90){
			$tot_no_cost = $snoscost * 3;				
			} else if($plan_days == 180){
			$tot_no_cost = $snoscost * 6;				
			} else if($plan_days == 365){
			$tot_no_cost = $snoscost * 12;				
			} else {
			$tot_no_cost = 0;
			}
				$totalplanprice=$tot_no_cost+$plan_price;
			      $gettax = $totalplanprice * $tax;
			      
			     $amount=$totalplanprice+$gettax;
                        
                      
                       
				// new added code for did payment price end
                         
                $insertmcdata = array(
				   'user_id' => $this->session->userdata('user_id'),
				   'cust_name' => $cust_name,
				   'user_service' => $_REQUEST['user_service'],
				   'service_nos' => $didno,
				   'plan_service' => $_REQUEST['plan_service'],
				   'mc_quantity' => $qnty,
				   'sms_credits' => $sms_credits,
				   'amount' =>  $amount,
				   'vc_amount' => $vc_amount,
				   'status' => "1",
				   'billing_date' => date('Y-m-d H:i:s'),
				   'plan_days' => $plan_days,
				   'transaction_id'=> $transaction_id,
				   'package_cost' =>  $plan_price,
				   'did_plan' =>  $did_plan,
				   'did_type' =>  $did_type,
				   'did_amount' =>  $didplanprice,
				   'description' =>  $this->config->item('upgrade'),
				   'package_id' =>  $package_id,
				   'tax_percentage' => $tax );
				   
				 
				  $bill_id=$this->Mcrental_model->admin_didmcpayments($this->session->userdata('user_id'),$_REQUEST['user_service'],$didno,$insertmcdata);  
				   
		
    		if(@$bill_id > 0)
    		{
    			date_default_timezone_set('Asia/Kolkata');
    			$curent_date = strtotime(date('Y-m-d'));
    			$expiredate = strtotime($_REQUEST['expire_date']);
    			if($curent_date > $expiredate)
    			{
    		       
    		    
    		 
			$active = 'Y'; 
			$did_callfields = array('did_no' => urlencode($didno),			
			'user_name' => urlencode($this->session->userdata('user_id')),	
			'active' => urlencode($active),
			'pservice' => urlencode($_REQUEST['plan_service']),
			'uservice' => urlencode($_REQUEST['user_service']),
			'subscription_date' => urlencode(date('Y-m-d H:i:s')),
			'subsc_duration' => urlencode($plan_days),
			'expiry_date' => urlencode($pay_edate),
			'max_calls' => urlencode($qnty));

			$sql_query = "update users_servicewise_credits set renewal_date = curdate(),renewal_mc_id = '$bill_id' where user_id = '$user_id' AND user_service='$user_service' AND did_number='$didno'";
    			$res = $this->db->query($sql_query);
    			
			$did_call_url = $this->config->item('didpayupdate_api')."/crons/renewal_script.php";
			$did_call_string = http_build_query($did_callfields);
			$did_ch = curl_init();
			curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
			curl_setopt($did_ch, CURLOPT_HEADER, 0);
			curl_setopt($did_ch,CURLOPT_POST, count($_POST));
			curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
			curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
			$did_result = curl_exec($did_ch);
			curl_close($did_ch);
    			} 
    			else
    			{
    				
    			
    				$date = $_REQUEST['expire_date'];
				$date1 = str_replace('-', '/', $date);
				$renewal_date = date('Y-m-d',strtotime($date1 . "+1 days"));
				$user_service=$_REQUEST['user_service'];
				$user_id=$_REQUEST['user_id'];
    				$sql_query = "update users_servicewise_credits set renewal_date = '$renewal_date',renewal_mc_id = '$bill_id' where user_id = '$user_id' AND user_service='$user_service' AND did_number='$didno'";
    				$res = $this->db->query($sql_query);
    				
    				
    			}
    		}	
				
		
				}
		
            }
       
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($user_id);	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header', $this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/renwal-order-conformation', $this->_data);
		//$this->load->view('include/footer');	
		
		
		
	}
	
// Add credits 
	
	public function AddCredits()
	{
	date_default_timezone_set('Asia/Kolkata');
	    $this->_data['real_url']=$this->data['real_url'];
	    $user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
            if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		$this->load->model('Mcrental_model');
		
		if(isset($_POST['AddCredits']))
		{ 
		   
		   //print_r($_POST);exit;
		   $transaction_id = substr(mt_rand(), 0, 6);
		   $tax=$_REQUEST['tax'];
		   $usc_id=$_REQUEST['usc_id'];
               $user_id=$user_id;
               $didno=$_REQUEST['didno'];
               
               $package_cost=$_REQUEST['package_cost'];
               
               $amount=$_REQUEST['getpkgtotalcost'];
               
               $max_calls=$_REQUEST['max_calls'];
                
             
               
                $getUserDetailts=$this->Mcrental_model->getUserDetailts($user_id);
                
                //print_r($getUserDetailts);
                
                foreach($getUserDetailts as $key=>$user)
                {
                  $cust_name=$user->username;
                  $address1=$user->address1;
                  $address2=$user->address2;
                  $email=$user->email;
                  $mobile=$user->mobile;
                  $zip=$user->zipcode;
                  
                 $cityrs=$this->db->query("select * from new_citylist where city_id=$user->city_id")->result();
                 @$city=$cityrs[0]->city_name;
                  $staters=$this->db->query("select * from new_statelist  where state_id=$user->state_id")->result();
                 @$state=$staters[0]->state;
                  
               
                  
                }
               
              $getLastRenewalPackagedate=$this->Mcrental_model->getLastRenewalPackagedate($user_id,$didno);
              
              //print_r($getLastRenewalPackagedate);exit;
               
               foreach($getLastRenewalPackagedate as $key=>$lastpkg)
               {
                        $user_id=$lastpkg->user_id;
                        $didno=$lastpkg->did_number;
				$user_service=$lastpkg->user_service;
				$plan_service=$lastpkg->did_service;
				$sms_credits=$lastpkg->sms_credits;
				$vc_amount=$lastpkg->vc_amount;
				$plan_days=$lastpkg->subscription_duration;
			      $package_id=$lastpkg->package_id;
			      $did_plan=$lastpkg->did_plan;
				$did_type=$lastpkg->did_type;
				
					
                }
                           
				   $insertmcdata = array(
				   'user_id' => $user_id,
				   'cust_name' => $cust_name,
				   'user_service' => $user_service,
				   'mc_quantity' => $max_calls,
				   'amount' =>  $amount,
				   'billing_date' => date('Y-m-d H:i:s'),
				   'description' => $this->config->item('credits'),
				   'transaction_id'=> $transaction_id,
				   'tax_percentage' => $tax/100
				   );
				   
				 
				
				 
		    $mcbill_id=$this->Mcrental_model->admin_didmcpayments($user_id,$user_service,$didno,$insertmcdata); 
		    
		            $quantity=$max_calls;
				$quantity=$max_calls;
				$customerid=$user_id;
				
				$description=$this->config->item('credits');
				$amount=1;
		 
		 $url = base_url()."payment/TestSsl.php?amount=".$amount."&mcbill_id=".$mcbill_id."&name=".$cust_name."&trnsale=".$quantity."&customerid=".$customerid."&address1=".$address1."&address2=".$address2."&address3=".$address2."&city=".$city."&state=".$state."&email=".$email."&cname=".$cust_name."&desc=".$description."&mobile=".$mobile ."&zip=".$zip;
		    	
		    	    //exit;
		    	redirect($url);
		    
		 
		   	redirect("DIDpayments/my_packages/credits-added");	
			  

		}
		
		
	}
	
	
	// changed function ramshree
	public function Order_addcredits_confirm()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";
		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');
		
		
		$user_service = $this->config->item('user_service');
		if($this->input->post('add_credits') != '')
		{
			//print_r($_POST);
			//exit;
			$_SESSION['order_type'] = $this->data['order_credits'];
			$_SESSION['sel_nos'] = $this->input->post('ssnos');
			$_SESSION['tax'] = $this->input->post('tax_val');
			$_SESSION['plan_service'] = $this->input->post('plan_service');
			$_SESSION['planprice'] = $this->input->post('planprice');
			$plan = explode(",",$this->input->post('add_calls'));
			$_SESSION['calls_amt'] = $plan[0];
			$_SESSION['mc_quantity'] = $plan[1];
			$_SESSION['current_maxcalls'] = $this->input->post('current_maxcalls');
		}
		if($_SESSION['mc_quantity'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$tax = $_SESSION['tax'];
		$order_type = $_SESSION['order_type'];
		$calls_amt = $_SESSION['calls_amt'];
		$max_calls = $_SESSION['mc_quantity'];
		$current_maxcalls = $_SESSION['current_maxcalls'];
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		if($this->input->post('confirm_order') != '')
		{
					
			$mobile_num = $this->session->userdata('fruser-mobile');
			$email_id = $this->session->userdata('fruser-email');
			$address_1 = $this->input->post('address1');
			$_SESSION['address1'] = $address_1;
			$address_2 = $this->input->post('address2');
			$_SESSION['address2'] = $address_2;
			$state_id = $this->input->post('state');
			$_SESSION['state'] = $state_id;
			$city_id = $this->input->post('city');
			$_SESSION['city'] = $city_id;
			$zipcode = $this->input->post('zipcode');
			$_SESSION['zipcode'] = $zipcode;
	
	$userid = $this->session->userdata('user_id');
	$address1 = $address_1;
	$address2 = $address_2;
	$city_idn = $city_id;
	$state_idn = $state_id;
	//exit;
	$this->Voice_rental_model->Update_userdata($userid,$address1,$address2,$city_idn,$state_idn,$zipcode);
			
	$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
	@$state=$staters[0]->state;
				        
	$city_id=$_POST['city'];
	$cityrs=$this->db->query("select * from new_citylist where city_id=$city_id")->result();
	@$city=$cityrs[0]->city_name;		
			
			$result = $this->Voice_rental_model->addcredits_package($userid,$sel_nos,$user_service,$tax,$plan_service,$planprice,$user_name,$calls_amt,$max_calls,$order_type,$current_maxcalls);
		
			if($result > 0)
			{
				//redirect to payment gateway page
				$val = 'amount='.base64_encode($planprice).'&name='.base64_encode($user_name).'&trnsale='.base64_encode($max_calls).'&customerid='.base64_encode($userid).'&address1='.base64_encode($address_1).'&address2='.base64_encode($address_2).'&state='.base64_encode($state).'&city='.base64_encode($city).'&zip='.base64_encode($zipcode).'&mobile='.base64_encode($mobile_num).'&email='.base64_encode($email_id);
				$testssl_url=base_url()."payment/TestSsl.php?auto_transid=".base64_encode($result)."&".$val;
				redirect($testssl_url);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
		
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	    $this->load->view('include/header', $this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/addcredits-order-conformation', $this->_data);
		//$this->load->view('include/footer');
	}
	
	
	// changed function chandrasekhar
	public function Order_addcredits_confirm1()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->_data['url_redirect']= base_url()."DIDpayments/My_packages";		
		$this->load->model('Voice_rental_model');
		$userid = $this->session->userdata('user_id');		
		$user_service = $this->config->item('user_service');
		if($this->input->post('add_credits') != '')
		{	
			$_SESSION['order_type'] = $this->config->item('credits');
			$_SESSION['sel_nos'] = $this->input->post('didno');
			$_SESSION['tax'] = $this->input->post('tax')/100;
			$_SESSION['plan_service'] = $this->input->post('did_service');
			$_SESSION['did_plan'] = $this->input->post('did_plan');
			$_SESSION['planprice'] = $this->input->post('package_cost');
			$_SESSION['plan_days'] = $this->input->post('plan_days');
			$plan = explode(",",$this->input->post('add_calls'));
			
			$_SESSION['mc_quantity'] = $plan[0];
			
			$_SESSION['current_maxcalls'] = $this->input->post('max_calls');
			
			 // new added code for did payment price start

				$did_callfields=array('did_no'=>urlencode($_SESSION['sel_nos']));
				//$did_call_url = $this->data['real_url'].'/get_didpayment.php";
				
				$did_call_url = $this->data['real_url']."get_didpayment.php";
				
				$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				$did_result = curl_exec($did_ch);
				curl_close($did_ch);

				$didplanpricearr=json_decode($did_result,true);

				//print_r($didplanpricearr);
				$didplanprice=$didplanpricearr['didprice'];
				$did_type=$didplanpricearr['did_type'];
				$did_plan=$didplanpricearr['did_plan'];
				
				$plan_duration=$_SESSION['plan_days'];
				$service_name=$_SESSION['plan_service'];

		            $sql="select * from voice_service_plans where service_name='$service_name' and plan_duration = '$plan_duration'";
                        
                        $data=$this->db->query($sql)->result();
                        
                        //print_r($data);
                        
                        foreach($data as $key=>$sevicepricedata)
                        {
                         $plan_price = $sevicepricedata->plan_price; 
                        }
                        
                        

				$totalplanprice=$didplanprice+$plan_price;
			      $tax = $totalplanprice * $this->data['tax'];
			      
			     $amount=$totalplanprice+$tax;
			     
			     $_SESSION['amount'] = $amount;
                
                  // new added code for did payment price end
                  
		}
if($_SESSION['mc_quantity'] == '' || $_SESSION['plan_service'] == '' || $_SESSION['planprice'] == '' || $_SESSION['sel_nos'] == '')
		{
			redirect('DIDpayments/My_packages');
		}
		
		$user_name = $this->session->userdata('fruser-username');
		$plan_service = $_SESSION['plan_service'];		
		$planprice = $_SESSION['planprice'];
		$sel_nos = $_SESSION['sel_nos'];
		$tax = $_SESSION['tax'];
		$order_type = $_SESSION['order_type'];
		$max_calls = $_SESSION['mc_quantity'];
		$current_maxcalls = $_SESSION['current_maxcalls'];
		
		@$amount = $_SESSION['amount'];
		
		$statelist = $this->Voice_rental_model->getStatelist();
		$this->_data['state_list']= $statelist;
		
		$state_name = $this->session->userdata('fruser-state_id');
		$cities = $this->Voice_rental_model->getCities($state_name);
		$this->_data['city_list']= $cities;
		
		if($this->input->post('confirm_order') != '')
		{
			$mobile_num = $this->input->post('mobile');
			$email_id =$this->input->post('email');
			$address_1 = $this->input->post('address1');
			$address_2 = $this->input->post('address2');
			$state_id = $this->input->post('state');
			$city = $this->input->post('city');
			$zipcode = $this->input->post('zipcode');
		      $staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
                 @$state=$staters[0]->state;
                 
                
			
			$voice_billing= $this->Voice_rental_model->addcredits_package($userid,$sel_nos,$user_service,$tax,$plan_service,$amount,$user_name,$max_calls,$order_type,$current_maxcalls);
		
			if($voice_billing > 0)
			{
				//redirect to payment gateway page
				$val = 'amount='.$amount.'&name='.$user_name.'&trnsale='.$max_calls.'&customerid='.$userid.'&address1='.$address_1.'&address2='.$address_2.'&state='.$state.'&city='.$city.'&zip='.$zipcode.'&mobile='.$mobile_num.'&email='.$email_id;
			 $testssl_url=base_url()."payment/TestSsl.php?mcbill_id=".$voice_billing."&".$val;
				
				
				redirect($testssl_url);
			
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Order details are not renewaled.Please check order details.');
				redirect('DIDpayments/My_packages');
			}
		}
		
		$serviceno_types = $this->_data['serviceno_types'] = $this->getsno_types();
		//print_r($this->_data['serviceno_types']);
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		//print_r($this->_data['city_list']);
	      $this->load->view('include/header', $this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/addcredits-order-conformation', $this->_data);
		//$this->load->view('include/footer');
	}
	
	// New function added by chandrasekhar
	public function upgrade_servicepackages()
	{
	  date_default_timezone_set('Asia/Kolkata');    
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');		
		$this->load->model('Voice_rental_model');
		$days_id_ajax =$this->input->get('sel_service');
		$currnt_service =$this->input->get('service_name');
		$currnt_package =$this->input->get('currnt_package');
		
		if($days_id_ajax == 'Inbound'){ $days_id_ajax = 'Missedcall_ConnectDialler';}
		if($days_id_ajax == 'Conference'){ $days_id_ajax = 'Missedcall_ConnectDialler';}
		if($days_id_ajax == 'Announcement'){ $days_id_ajax = 'Missedcall_ConnectDialler';}
		if($days_id_ajax == 'IVRS'){ $days_id_ajax = 'Missedcall_ConnectDialler';}
		
		$getpackage_list =array();
		$getpackage_list = $this->Voice_rental_model->Service_packages($days_id_ajax);
		
		?>
		<option value="">Select Package</option>
		<?php
		foreach($getpackage_list as $key=>$package){
		?>
	<option value="<?php echo $package->plan_totcalls .','. $package->plan_price .','. $package->plan_duration .','. $package->sms_credits .','. $package->vc_amount.','.$package->package_id; ?>" ><?php echo $package->plan_duration . ' Days / ' . $package->plan_totcalls . ' Calls / ' . $package->plan_price . ' Rupees'; ?></option>
	<?php }
	 	
	}
	
	public function My_packages1()
	{
	date_default_timezone_set('Asia/Kolkata');		
		$real_url=$this->data['real_url'];
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		//$user_id=$_SESSION['userid'];
		if(!$this->session->userdata('user_id')) 
		{            
		redirect('index');
		}
		$this->load->model('Mcrental_model');
			$this->load->model('Voice_rental_model');
		$this->load->helper('url');	
		$this->load->library("pagination");	
		$user_packages = $this->_data['user_packages'] = $this->Mcrental_model->AdminUser_packages($user_id);	
		$user_allrec = count($user_packages);
		$Allbills = array();
		$config = array();
		$config["base_url"] = base_url() . "DIDpayments/my_packages";
		$config["total_rows"] = $user_allrec;
		$config["per_page"] = 15;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$page='0';
		if($this->uri->segment(3)=='assigned')
		{
		$page='0';
		}
		else if($this->uri->segment(3)=='upgraded')
		{
		$page='0';
		}
		else if($this->uri->segment(3)=='credits-added')
		{
		$page='0';
		}
		else if($this->uri->segment(3)=='Renewal')
		{
		$page='0';
		}
		else
		{
		$page=$this->uri->segment(3);
		}


		$Allbills = $this->_data['user_packages'] = $this->Mcrental_model->AdminUser_pagepackages($config["per_page"], $page, $user_id);
		$links = $this->_data["links"] = $this->pagination->create_links();		

		//print_r(count($Allbills));	
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($user_id);	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		$this->_data['plan_days'] = $this->Mcrental_model->Plan_days();
		$this->_data['rental_plans'] = $this->Mcrental_model->Getall_rentalplans();
		//print_r($this->_data['plan_days']);	
		$this->_data['real_url']=$this->data['real_url'];
		$this->_data['users'] = $this->Mcrental_model->getClients();
		//print_r( $this->_data['users']);
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('payments/my-pkgs', $this->_data);
		//$this->load->view('include/footer');
		}
	
	
	// New function added by chandrasekhar
	public function get_servicepackages()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');		
		$this->load->model('Voice_rental_model');
		$days_id_ajax =$this->input->get('sel_service');
		$currnt_service =$this->input->get('service_name');
		$currnt_package =$this->input->get('currnt_package');		
		
		$package = $this->Voice_rental_model->package_details($currnt_package,$currnt_service);
		foreach($package AS $cost)
		{
			$package_cost = $cost->plan_price;
			$voice_amount  = $cost->vc_amount;
			$sms_credits = $cost->sms_credits;
			$plan_totcalls = $cost->plan_totcalls;
			$plan_duration = $cost->plan_duration;
		}
		
		$getpackage_list =array();
		$getpackage_list = $this->Voice_rental_model->Service_packages($days_id_ajax);
		
		$current_package = $plan_totcalls.",".$package_cost.",".$plan_duration.",".$sms_credits.",".$voice_amount.",".$currnt_package;
		?>
		<!-- <option value="">Select Package</option> -->
		<?php
		foreach($getpackage_list as $key=>$package){
			$selected = '';
			if($current_package == $package->plan_totcalls .','. $package->plan_price .','. $package->plan_duration .','. $package->sms_credits .','. $package->vc_amount.','.$package->package_id)
			{
				$selected = "selected";
			}
		?>
	<option value="<?php echo $package->plan_totcalls .','. $package->plan_price .','. $package->plan_duration .','. $package->sms_credits .','. $package->vc_amount.','.$package->package_id; ?>" <?php echo $selected?>><?php echo $package->plan_duration . ' Days / ' . $package->plan_totcalls . ' Calls / ' . $package->plan_price . ' Rupees'; ?></option>
	<?php }
	 		
	}
	
	// changed function chandrasekhar
	public function My_packages()
	{		
	
	         date_default_timezone_set('asia/kolkata');
		$real_url=$this->data['real_url'];
		$this->load->model('Voice_rental_model');		
		$this->load->helper('url');	
		$this->load->library("pagination");	
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->session->unset_userdata('rental_plan');
		$this->session->unset_userdata('plan_service');
		$this->session->unset_userdata('planprice');
		$this->session->unset_userdata('sel_nos');
		$this->session->unset_userdata('did_amount');
		$this->session->unset_userdata('tax');
		$this->session->unset_userdata('did_type');
		$this->session->unset_userdata('did_plan');
		$this->session->unset_userdata('expire_date');
		$this->session->unset_userdata('order_type');
		$this->session->unset_userdata('max_calls');
		$this->session->unset_userdata('current_maxcalls');		
		
		$limit='10';
		$offset='0';		
		$user_id='';
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
        $to_date=date('Y-m-d');
		//$src_transid='';
		$src_sno='';
		//$src_status='';
		if($this->uri->segment(3)=='sessout')
		{
		//print_r($_POST);
		// exit;
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		// unset($_SESSION['src_transid']);
		 unset($_SESSION['src_sno']);
		 //unset($_SESSION['src_status']);
		   
		   redirect('DIDpayments/my_packages');
		}
		else if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		  }
		  
		else if($this->uri->segment(3)=='')
		  {
		     $offset='0';
		  }
		  else 
		  {
		   $offset=$this->uri->segment(3);
		  }
		  
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		 //unset($_SESSION['src_transid']);
		 unset($_SESSION['src_sno']);
		 //unset($_SESSION['src_status']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  //$_SESSION['src_transid']=$_POST['src_transid'];
		  $_SESSION['src_sno']=$_POST['src_sno'];
		  //$_SESSION['src_status']=$_POST['src_status'];		  
		  redirect('DIDpayments/my_packages');
		}		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}		
		if(@$_SESSION['src_sno']!='')
		{
		  $src_sno=$_SESSION['src_sno'];
		}
		//if(@$_SESSION['src_status']!='')
		//{
		//  $src_status=$_SESSION['src_status'];
		//}		
		$user_id=$this->session->userdata('user_id');	
			
	      $all_bills = $this->Voice_rental_model->User_packages($user_id,$from_date,$to_date,$src_sno);		
		
		$this->_data['user_packages'] = $this->Voice_rental_model->User_pagepackages($user_id,$from_date,$to_date,$src_sno,$limit,$offset);
		
		$config = array();
		$config["base_url"] = base_url() . "DIDpayments/my_packages";
		$config["total_rows"] = $all_bills;
		$config["per_page"] = $limit;
		//$config["uri_segment"] = 3;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);		
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$this->pagination->initialize($config);
		//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		
		
		$links = $this->_data["links"] = $this->pagination->create_links();		
				
		$this->_data['username']=$this->session->userdata('fruser-username');
				
		//$links = $this->_data["links"] = $this->pagination->create_links();		

		//print_r(count($Allbills));	
		$this->_data['user_details'] = $this->Mcrental_model->getUserdetails($user_id);	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		$this->_data['plan_days'] = $this->Mcrental_model->Plan_days();
		$this->_data['rental_plans'] = $this->Mcrental_model->Getall_rentalplans();
		//print_r($this->_data['plan_days']);	
		$this->_data['real_url']=$this->data['real_url'];
		$this->_data['users'] = $this->Mcrental_model->getClients();
		$this->_data['total_rows'] =$all_bills;			
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/packages',$this->_data);
		//$this->load->view('include/footer');
	}
	
	
	public function Order_history()
	{   
	date_default_timezone_set('asia/kolkata');
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit='10';
		$offset='0';
		$user_id='';
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
		$to_date=date('Y-m-d');
		$src_transid='';
		$src_sno='';
		$src_status='';
		
		
		
		if($this->uri->segment(3)=='sessout')
		{
		
		
		
		// exit;
			unset($_SESSION['pay_userid']);
			unset($_SESSION['from_date']);
			unset($_SESSION['to_date']);
			unset($_SESSION['src_transid']);
			unset($_SESSION['src_sno']);
			unset($_SESSION['src_status']);		   
			redirect('DIDpayments/order_history');
		}
		else if($this->uri->segment(3)=='added')
			{
				$offset='0';
			}		  
		else if($this->uri->segment(3)=='')
			{
				$offset='0';
			}
		  else 
			{
				$offset=$this->uri->segment(3);
			}     
		
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		 unset($_SESSION['src_transid']);
		 unset($_SESSION['src_sno']);
		 unset($_SESSION['src_status']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  $_SESSION['src_transid']=$_POST['src_transid'];
		  $_SESSION['src_sno']=$_POST['src_sno'];
		  $_SESSION['src_status']=$_POST['src_status'];
		  
		 // print_r($_POST);
		  
		 redirect('DIDpayments/order_history');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		if(@$_SESSION['src_transid']!='')
		{
		  $src_transid=$_SESSION['src_transid'];
		}
		if(@$_SESSION['src_sno']!='')
		{
		  $src_sno=$_SESSION['src_sno'];
		}
		if(@$_SESSION['src_status']!='')
		{
		  $src_status=$_SESSION['src_status'];
		}
		
		
		$user_id=$this->session->userdata('user_id');
		$total_rows= $this->Payment_model->AdminAllbills($user_id,$from_date,$to_date,$src_transid,$src_sno,$src_status);
		
		$this->_data['billing_details'] = $this->Payment_model->AdminAllbillsDetails($user_id,$from_date,$to_date,$src_transid,$src_sno,$src_status,$limit,$offset);
		
		$this->load->library("pagination");	
        $config["base_url"] = base_url() . "DIDpayments/order_history";
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $limit;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);		
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
        $this->pagination->initialize($config);
        $links = $this->_data["links"] = $this->pagination->create_links();
       
		$this->_data['users'] = $this->Mcrental_model->getClients();
		$this->_data['total_rows'] = $total_rows;
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/order_history',$this->_data);
		//$this->load->view('include/footer');		
	}
	/***
	*@name get_credits_details
        @author Rushyendra***/
	public function get_credits_details()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Payment_model');	
		$added_date = trim($this->input->post("added_date")); 
		$type = trim($this->input->post("type"));
		$page = trim($this->input->post("page")); 
		$limit = trim($this->input->post("limit"));
		$credits = trim($this->input->post("credits"));
		if(!$credits && !$page)
			{ echo json_encode(array("result" => array(), "total_cnt" => 0)); exit; }
		$added_array = explode(" ",$added_date);
		$cur_date = '';
		if($added_array[0])
			$cur_date = $added_array[0];
		$user_id=$this->session->userdata('user_id');
		$total_count =   $this->Payment_model->total_deduct_bal_user($user_id,$cur_date,$type);
		$dets =   $this->Payment_model->deduct_bal_user($user_id,$cur_date,$type,$page,$limit);
		echo json_encode(array("result" => $dets, "total_cnt" => $total_count));
	}
	public function credits_download()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Payment_model');
		$type = $this->uri->segment(3);
		$from_date = $this->uri->segment(4);
		$to_date = $this->uri->segment(5);
		$user_id = $this->session->userdata('user_id');
		 if($type == 'bal') $type = "";
		$total_count =   $this->Payment_model->total_deduct_bal_user($user_id,$from_date,$to_date,$type);
		$dets =   $this->Payment_model->deduct_bal_user($user_id,$from_date,$to_date,$type,'','');
		$fileName = 'credits_usage.csv';
		$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($dets  as $key => $value) {
				if ( !$headerDisplayed ) {
				fputcsv($fh, array_keys($value));
				$headerDisplayed = true;$config['total_rows'] = count($dets);
		         //$config['per_page'] = $limit; 
			}
			fputcsv($fh, $value);
			}
			fclose($fh);
			exit;
		$this->_data['type'] = $type;
		
	}
	
	public function myprice()
	{   
	date_default_timezone_set('Asia/Kolkata');	
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$this->_data['userdata']=$this->Payment_model->getUserData($this->session->userdata('user_id'));
		
		//print_r($this->_data['userdata']);
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/myprice', $this->_data);
		//$this->load->view('include/footer');		
	}
	public function clearSes()
		{
			
		}
public function usagebal()
	{
	date_default_timezone_set('asia/kolkata');
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit=10;
		$offset='0';
		$user_id='';
		/*$from_date=date('Y-m-d');
            $to_date=date('Y-m-d');*/
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
            $to_date=date('Y-m-d');
		$from_date='';
            	$to_date='';
		//if($this->uri->segment(4)=='sessout')
		if($this->uri->segment(3)=='s')
		{
		  
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		   
		  // redirect('DIDpayments/credits_history/'.$status);
		 redirect('DIDpayments/usagebal/');
		}
		else
//				 if($this->uri->segment(3)=='added')
		 if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		   	
		  }
		  
		else
			 if($this->uri->segment(3)=='')
//		 if($this->uri->segment(4)=='')
		  {
		     $offset='0';
		  }
		  else 
		  {
		  // $offset=$this->uri->segment(4);
					   $offset=$this->uri->segment(3);
		  }    
		
		//$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  
		//  redirect('DIDpayments/credits_history/0');
		  redirect('DIDpayments/usagebal/');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		
		$user_id=$this->session->userdata('user_id');
		
                /***** Credits History  added by Rushyendra ****/
		 $type = '';
		$total_count =   $this->Payment_model->total_deduct_bal_user($user_id,$from_date,$to_date,$type);
		$this->_data['credits_dets'] =   $this->Payment_model->deduct_bal_user($user_id,$from_date,$to_date,$type,$offset,$limit);
		$this->_data['type'] = $type;	
		$this->_data['total_rows'] = $total_count;

		$config["base_url"] = base_url() . "DIDpayments/usagebal/";	
    		$config['total_rows'] =$total_count;
    		$config['per_page'] = $limit; 
               $this->_data['total_rows']=$total_count;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li >';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['first_link'] = '&lt;&lt;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '&gt;&gt;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		    $this->pagination->initialize($config); 
		$this->_data['credits_links'] = $this->pagination->create_links();
		/*******          ****/
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/credits_usage', $this->_data);
	}
	public function usagesms()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit=10;
		$offset='0';
		$user_id='';
		/*$from_date=date('Y-m-d');
            $to_date=date('Y-m-d');*/
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
                 $to_date=date('Y-m-d');
		$from_date='';
            	$to_date='';
		//if($this->uri->segment(4)=='sessout')
		if($this->uri->segment(3)=='s')
		{
		  
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		   
		  // redirect('DIDpayments/credits_history/'.$status);
		 redirect('DIDpayments/usagesms/');
		}
		else

		 if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		   	
		  }
		  
		else
			 if($this->uri->segment(3)=='')

		  {
		     $offset='0';
		  }
		  else 
		  {
		 
					   $offset=$this->uri->segment(3);
		  }    
		
		//$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  
		//  redirect('DIDpayments/credits_history/0');
		  redirect('DIDpayments/usagesms/');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		
		$user_id=$this->session->userdata('user_id');
		
                /***** Credits History  added by Rushyendra ****/
		 $type = 'sms';
		$total_count =   $this->Payment_model->total_deduct_bal_user($user_id,$from_date,$to_date,$type);
		$this->_data['credits_dets'] =   $this->Payment_model->deduct_bal_user($user_id,$from_date,$to_date,$type,$offset,$limit);
		$this->_data['type'] = $type;	
		$this->_data['total_rows'] = $total_count;

		$config["base_url"] = base_url() . "DIDpayments/usagesms/";	
    		$config['total_rows'] =$total_count;
    		$config['per_page'] = $limit; 
               $this->_data['total_rows']=$total_count;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li >';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['first_link'] = '&lt;&lt;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '&gt;&gt;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		    $this->pagination->initialize($config); 
		$this->_data['credits_links'] = $this->pagination->create_links();
		/*******          ****/
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/credits_usage', $this->_data);
	}
	public function usagevoice()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit=10;
		$offset='0';
		$user_id='';
		/*$from_date=date('Y-m-d');
            $to_date=date('Y-m-d');*/
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
            $to_date=date('Y-m-d');

		$from_date='';
            	$to_date='';
		//if($this->uri->segment(4)=='sessout')
		if($this->uri->segment(3)=='s')
		{
		  
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		   
		  // redirect('DIDpayments/credits_history/'.$status);
		 redirect('DIDpayments/usagevoice/');
		}
		else

		 if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		   	
		  }
		  
		else
			 if($this->uri->segment(3)=='')

		  {
		     $offset='0';
		  }
		  else 
		  {
		 
					   $offset=$this->uri->segment(3);
		  }    
		
		//$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  
		//  redirect('DIDpayments/credits_history/0');
		  redirect('DIDpayments/usagevoice/');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		
		$user_id=$this->session->userdata('user_id');
		
	
		
                /***** Credits History  added by Rushyendra ****/
		 $type = 'voice';
		$total_count =   $this->Payment_model->total_deduct_bal_user($user_id,$from_date,$to_date,$type);
		$this->_data['credits_dets'] =   $this->Payment_model->deduct_bal_user($user_id,$from_date,$to_date,$type,$offset,$limit);
		$this->_data['type'] = $type;	
		$this->_data['total_rows'] = $total_count;


		$config["base_url"] = base_url() . "DIDpayments/usagevoice/";	
    		$config['total_rows'] =$total_count;
    		$config['per_page'] = $limit; 
               $this->_data['total_rows']=$total_count;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li >';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['first_link'] = '&lt;&lt;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '&gt;&gt;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		    $this->pagination->initialize($config); 
		$this->_data['credits_links'] = $this->pagination->create_links();
		/*******          ****/
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/credits_usage', $this->_data);
	}
	//public function credits_history($status =0)
	public function credits_history()
{

date_default_timezone_set('asia/kolkata');
	$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit=10;
		$offset='0';
		$user_id='';
		/*$from_date=date('Y-m-d');
            $to_date=date('Y-m-d');*/
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
            $to_date=date('Y-m-d');
		//if($this->uri->segment(4)=='sessout')
		if($this->uri->segment(3)=='s')
		{
		  
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		   
		  // redirect('DIDpayments/credits_history/'.$status);
		 redirect('DIDpayments/credits_history/');
		}
		else
//				 if($this->uri->segment(3)=='added')
		 if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		   	
		  }
		  
		else
			 if($this->uri->segment(3)=='')
//		 if($this->uri->segment(4)=='')
		  {
		     $offset='0';
		  }
		  else 
		  {
		  // $offset=$this->uri->segment(4);
					   $offset=$this->uri->segment(3);
		  }    
		
		//$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  
		//  redirect('DIDpayments/credits_history/0');
		  redirect('DIDpayments/credits_history/');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		
		$user_id=$this->session->userdata('user_id');
		
                /***** Credits History  added by Rushyendra ****/
		 
		list($this->_data['credits_dets'],$this->_data['amt'],$this->_data['voicesms']) = $this->Payment_model->get_total_credits($user_id);  
		$total_credits_rows = count($this->_data['credits_dets']);



		$config["base_url"] = base_url() . "DIDpayments/credits_history/";	
    		$config['total_rows'] = $total_credits_rows;
    		$config['per_page'] = $limit; 
            $this->_data['total_rows']=$total_credits_rows;
		    $this->pagination->initialize($config); 
		$this->_data['credits_links'] = $this->pagination->create_links();
		/*******          ****/
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/credits', $this->_data);
		//$this->load->view('include/footer');			
}
	public function credits_history2()
	{   
	date_default_timezone_set('Asia/Kolkata');	
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit=10;
		$offset='0';
		$user_id='';
		/*$from_date=date('Y-m-d');
            $to_date=date('Y-m-d');*/
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
            $to_date=date('Y-m-d');
		//if($this->uri->segment(4)=='sessout')
		if($this->uri->segment(3)=='s')
		{
		  
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		   
		  // redirect('DIDpayments/credits_history/'.$status);
		 redirect('DIDpayments/credits_history/');
		}
		else
//				 if($this->uri->segment(3)=='added')
		 if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		   	
		  }
		  
		else
			 if($this->uri->segment(3)=='')
//		 if($this->uri->segment(4)=='')
		  {
		     $offset='0';
		  }
		  else 
		  {
		  // $offset=$this->uri->segment(4);
					   $offset=$this->uri->segment(3);
		  }    
		
		//$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  
		//  redirect('DIDpayments/credits_history/0');
		  redirect('DIDpayments/credits_history/');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		
		$user_id=$this->session->userdata('user_id');
		
                /***** Credits History  added by Rushyendra ****/
		 
		$total_credits_rows = $this->Payment_model->total_deduct_list_per_date($user_id,$from_date,$to_date);  
		$data['total_rows'] = $total_credits_rows;
list($this->_data['credits_dets'],$this->_data['total_sms_credits'],$this->_data['total_voice_credits'],$this->_data['billing_date'],$this->_data['main_balance'],$this->_data['prev_result'],$this->_data['prev_total']) = $this->Payment_model->get_deduct_list_per_date($user_id,$from_date,$to_date,$limit,$offset); 
		/*list($this->_data['credits_dets'],$this->_data['total_sms_credits'],$this->_data['total_voice_credits'],$this->_data['billing_date'],$this->_data['main_balance'],$this->_data['prev_result'],$this->_data['prev_total']) = $this->Payment_model->get_deduct_list_per_date_mod($user_id,$from_date,$to_date,$limit,$offset);*/



		$config["base_url"] = base_url() . "DIDpayments/credits_history/";	
    		$config['total_rows'] = $total_credits_rows;
    		$config['per_page'] = $limit; 
            $this->_data['total_rows']=$total_credits_rows;
		    $this->pagination->initialize($config); 
		$this->_data['credits_links'] = $this->pagination->create_links();
		/*******          ****/
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/credits_history', $this->_data);
		//$this->load->view('include/footer');		
	}

	public function credits_history1()
	{   
	date_default_timezone_set('Asia/Kolkata');	
		$real_url=$this->data['real_url'];
		$this->load->model('Payment_model');	
		$this->load->helper('url');
		
		$limit=10;
		$offset='0';
		$user_id='';
		$from_date=date('Y-m-d');
            $to_date=date('Y-m-d');
		
		//if($this->uri->segment(4)=='sessout')
		if($this->uri->segment(3)=='sessout')
		{
		  
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		   
		  // redirect('DIDpayments/credits_history/'.$status);
		 redirect('DIDpayments/credits_history1/');
		}
		else
//				 if($this->uri->segment(3)=='added')
		 if($this->uri->segment(3)=='added')
		  {
		     $offset='0';
		   	
		  }
		  
		else
			 if($this->uri->segment(3)=='')
//		 if($this->uri->segment(4)=='')
		  {
		     $offset='0';
		  }
		  else 
		  {
		  // $offset=$this->uri->segment(4);
					   $offset=$this->uri->segment(3);
		  }    
		
		//$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
		
		//print_r($_POST);	
		
		if($this->input->post('Search'))
		{
		 unset($_SESSION['pay_userid']);
		 unset($_SESSION['from_date']);
		 unset($_SESSION['to_date']);
		  
		  $_SESSION['pay_userid']=$_POST['user_id'];
		  $_SESSION['from_date']=$_POST['from_date'];
		  $_SESSION['to_date']=$_POST['to_date'];
		  
		//  redirect('DIDpayments/credits_history/0');
		  redirect('DIDpayments/credits_history1/');
		}
		
		if(@$_SESSION['pay_userid']!='')
		{
		  $user_id=$_SESSION['pay_userid'];
		}
		if(@$_SESSION['from_date']!='')
		{
		  $from_date=$_SESSION['from_date'];
		}
		if(@$_SESSION['to_date']!='')
		{
		  $to_date=$_SESSION['to_date'];
		}
		
		$user_id=$this->session->userdata('user_id');
		
		

                /***** Credits History  added by Rushyendra ****/
		//$total_credits_rows = $this->Payment_model->total_deduct_list_per_date($user_id,$from_date,$to_date,$status);  
		$total_credits_rows = $this->Payment_model->total_deduct_list_per_date($user_id,$from_date,$to_date);  
		// $this->_data['credits_dets'] = $this->Payment_model->get_deduct_list_per_date($user_id,$from_date,$to_date,$limit,//$offset,$status);
//echo $offset; exit;
		 $this->_data['credits_dets'] = $this->Payment_model->get_deduct_list_per_date1($user_id,$from_date,$to_date,$limit,$offset);
		  //$config['use_page_numbers'] = TRUE;
    		//$config['page_query_string'] = TRUE;
		//$config["base_url"] = base_url() . "DIDpayments/credits_history/".$status."/";	
		$config["base_url"] = base_url() . "DIDpayments/credits_history1/";	
    		$config['total_rows'] = $total_credits_rows;
    		$config['per_page'] = $limit; 
            $this->_data['total_rows']=$total_credits_rows;
		    $this->pagination->initialize($config); 
		$this->_data['credits_links'] = $this->pagination->create_links();
		/*******          ****/
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/credits_history', $this->_data);
		//$this->load->view('include/footer');		
	}
	
	public function thankr()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		//$user_id =$this->session->userdata('user_id');		        
		$this->load->model('Mcrental_model');	
		if($_REQUEST['tn']){
			$ePGTxnID=$_REQUEST['tn'];
			$Message=$_REQUEST['rm'];
			$mcbillings = $this->Mcrental_model->billigPaydetails($ePGTxnID);
			foreach($mcbillings as $key=>$mbill){	
				$did_no = $mbill->service_nos;
				$quantity = $mbill->mc_quantity;	
				$user_id = $mbill->user_id;
				$plan_days = $mbill->plan_days;
				$pservice = $mbill->plan_service;
				$uservice = $mbill->user_service;
				$pay_edate = $mbill->renewal_date;
				$fsms = $mbill->sms_credits;
				$fcalls = $mbill->vc_amount;
				$epgTid = $mbill->epg_txnID;
				$this->session->userdata($user_id);
					
		
		if($ePGTxnID = $epgTid){			
			$active = 'Y'; 
			$did_callfields = array('did_no' => urldecode($did_no),			
			'user_name' => $user_id,
			'expiry_date' => $pay_edate);
			
			$did_call_url = $real_url."didpayupdateexpirydate_api.php";
			$did_call_string = http_build_query($did_callfields);
			$did_ch = curl_init();
			curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
			curl_setopt($did_ch, CURLOPT_HEADER, 0);
			curl_setopt($did_ch,CURLOPT_POST, count($_POST));
			curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
			curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
			echo $did_result = curl_exec($did_ch);
			curl_close($did_ch);	
								
			$log_data = 'sms :' .$fsms .', calls :'. $fcalls .', user_id :'. $user_id .', date :'.date('Y-m-d').' Transaction Completed'; 
			error_log("\n $log_data", 3, "/var/www/html/FirstRing/logs/mybill.log");
			if("$pay_edate" == date('Y-m-d'))
				{
				$did_call_url = base_url()."/crons/renewal_script.php";
				//$did_callfields="";
				//$did_call_string = http_build_query($did_callfields);
				$did_ch = curl_init();
				curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
				curl_setopt($did_ch, CURLOPT_HEADER, 0);
				curl_setopt($did_ch,CURLOPT_POST, count($_POST));
				curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
				curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
				curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
				echo $did_result = curl_exec($did_ch);
				curl_close($did_ch);					
				}
			}	
		  	 		
		}
		}
			// session data start.
	$this->load->model('User_Model');	
	$rs=$this->User_Model->getPaymentUserDetails($user_id);
	  if($rs)
	  {
     	foreach($rs as $result)
		{
		$sessionData = array (
		'username' => $result->username,
		'mobile' => $result->mobile,
		'first_name' => $result->first_name,
		'user_id' => $result->user_id,
		'no_ndnc' => $result->no_ndnc,
		'dnd_check' => $result->dnd_check,
		'dlr_enabled' => $result->dlr_enabled,
		'is_reseller' => $result->is_reseller,
		'ndnc_return' => $result->return_ndnc_credits,
		'template_check' => $result->template_check,
		'max_ports' => $result->max_ports,
		'voice_users' => $result->voice_users,
		'max_participants' => $result->max_participants,
		'is_missedcall' => $result->is_missedcall,
		'is_obd' => $result->is_obd,
		'caller_id' => $result->caller_id,
		'is_call_record' => $result->is_call_record,
		'price_per_pulse' => $result->price_per_pulse,
		'pulse_duration' => $result->pulse_duration,
		'sms_price' => $result->sms_price
		);
		
		$_SESSION['user_id']=$result->user_id;
		
		}
		
	    $this->session->set_userdata($sessionData);
	  }
	  
// session data end. 	
		
		
		$this->load->view('include/header',$data);
		$this->load->view('include/menu');
		$this->load->view('payments/thankr');
		//$this->load->view('include/footer');	
	}
	
	public function upgd_codeotp()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');
		$this->load->model('Mcrental_model');		
        $user_details = $this->_data['user_details'] = $this->Mcrental_model->Getuser_details($user_id);
			
		$data['end']=$this->session->userdata('end');
		
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('payments/upgd_codeotp',$this->_data);
		//$this->load->view('include/footer');	
	}
	
	public function thankugd()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		//$user_id =$this->session->userdata('user_id');		        
		$this->load->model('Mcrental_model');	
		if($_REQUEST['tn']){
			$ePGTxnID=$_REQUEST['tn'];
			$Message=$_REQUEST['rm'];
			$mcbillings = $this->Mcrental_model->billigPaydetails($ePGTxnID);
			foreach($mcbillings as $key=>$mbill){	
				$did_no = $mbill->service_nos;
				$quantity = $mbill->mc_quantity;	
				$user_id = $mbill->user_id;
				$plan_days = $mbill->plan_days;
				$pservice = $mbill->plan_service;
				$uservice = $mbill->user_service;			
				$epgTid = $mbill->epg_txnID;
				$this->session->userdata($user_id);		
			
		if($ePGTxnID = $epgTid){
			
			$serverdid_fields = $this->get_didvals($did_no);
			
			foreach($serverdid_fields as $key=>$serverdid){
			$did_maxcalls = $serverdid['max_calls'];			
			$new_maxcalls = $did_maxcalls + $quantity;
			
			$did_callfields = array('did_no' => urldecode($did_no),			
			'user_name' => $user_id,	
			'active' => 'Y',			
			'max_calls' => $new_maxcalls);
			$did_call_url = $real_url."didpayupgrade_api.php";
			$did_call_string = http_build_query($did_callfields);
			$did_ch = curl_init();
			curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
			curl_setopt($did_ch, CURLOPT_HEADER, 0);
			curl_setopt($did_ch,CURLOPT_POST, count($_POST));
			curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
			curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
			echo $did_result = curl_exec($did_ch);
			curl_close($did_ch);
		
		$visible = 1;
		$this->update_visible($did_no,$visible);	
		
		$log_data = 'Total Calls :'. $new_maxcalls . 'Added Calls :'. $quantity .', user_id :'. $user_id .', date :'.date('Y-m-d').' Transaction Completed'; 
		error_log("\n $log_data", 3, "/var/www/html/FirstRing/logs/upgradebill.log");	
				}	
			}	
			
		  }		 		
		
		}
			  // session data start.
	$this->load->model('User_Model');	
	$rs=$this->User_Model->getPaymentUserDetails($user_id);
	  if($rs)
	  {
     	foreach($rs as $result)
		{
		$sessionData = array (
		'username' => $result->username,
		'mobile' => $result->mobile,
		'first_name' => $result->first_name,
		'user_id' => $result->user_id,
		'no_ndnc' => $result->no_ndnc,
		'dnd_check' => $result->dnd_check,
		'dlr_enabled' => $result->dlr_enabled,
		'is_reseller' => $result->is_reseller,
		'ndnc_return' => $result->return_ndnc_credits,
		'template_check' => $result->template_check,
		'max_ports' => $result->max_ports,
		'voice_users' => $result->voice_users,
		'max_participants' => $result->max_participants,
		'is_missedcall' => $result->is_missedcall,
		'is_obd' => $result->is_obd,
		'caller_id' => $result->caller_id,
		'is_call_record' => $result->is_call_record,
		'price_per_pulse' => $result->price_per_pulse,
		'pulse_duration' => $result->pulse_duration,
		'sms_price' => $result->sms_price
		);
		
		$_SESSION['user_id']=$result->user_id;
		
		}
		
	    $this->session->set_userdata($sessionData);
	  }
	  
// session data end.
		
		$this->load->view('include/header',$data);
		$this->load->view('include/menu');
		$this->load->view('payments/thankr');
		//$this->load->view('include/footer');	
	}
	
	public function Add_mainbal()
	{
	date_default_timezone_set('asia/kolkata');
		$real_url=$this->data['real_url'];
		$this->load->model('Mcrental_model');	
		$this->load->model('Payment_model');
		
        if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}
        	
        	if($this->input->post('Addbalance'))
        	{
			print_r($_POST); 
	
        	$userid=trim($this->session->userdata('user_id'));
        	
        	$add_balance=$_SESSION['add_balance']=trim($_POST['add_balance']);
        	
        	$getUserDetailts=$this->Mcrental_model->getUserDetailts($this->session->userdata('user_id'));
                
                //print_r($_POST);                
                foreach($getUserDetailts as $key=>$user)
                {
                  $username=$user->username;
                  $address1=$user->address1;
                  $address2=$user->address2;
                  $email=$user->email;
                  $mobile=$user->mobile;
                  $zipcode=$user->zipcode;
                  $city_id=$user->city_id;
                  $state_id=$user->state_id;
                  $cityrs=$this->db->query("select * from new_citylist where city_id=$user->city_id")->result();
                  @$city=$cityrs[0]->city_name;
                  $staters=$this->db->query("select * from new_statelist  where state_id=$user->state_id")->result();
                  @$state=$staters[0]->state;                 
                }
      	
	if($address1=='' || $address2=='' || $city_id=='0' || $state_id=='0' || $zipcode=='' || $zipcode=='0'){
		 $city_idn=0;
		 $state_idn=0;
		$userid=trim($this->session->userdata('user_id'));
			
		if($address1==NULL || $address1=='')
		{
		    $address1=$_POST['address1'];
		}
		if($address2==NULL ||$address2=='')
		{
		    $address2 = $_POST['address2'];
		}
		if($city_id=='0')
		{		 
		   $city_idn = $_POST['city'];
		  
		}
		if($state_id=='0')
		{
			$state_idn = $_POST['state'];
									        
		}		
		if($zipcode==NULL || $zipcode=='')
		{
		   $zipcode=$_POST['zipcode'];
		}
		//code written by sivaprasad
		if($city_idn==NULL || $city_idn=='' || $city_idn==0)
		{
		   $city_idn=$city_id;
		}
		if($state_idn==NULL || $state_idn=='' || $state_idn==0)
		{
		   $state_idn=$state_id;
		}
		//end
		if($zipcode!=$_POST['zipcode']){$zipcode=$_POST['zipcode'];}
		$this->Mcrental_model->Update_userdata($userid,$address1,$address2,$city_idn,$state_idn,$zipcode);
	}
        	//$this->_data['added'] = $this->Payment_model->addBalance($userid,$add_balance);
    
			$tax=$this->data['tax'];
			$tax_per=$this->data['tax_per'];        	 
			$total_tax = $tax * $add_balance;
			$amount = $add_balance + $total_tax;
        	$transaction_id = $userid.substr(mt_rand(), 0, 6);
        	$insertmcdata = array(
				   'user_id' => $this->session->userdata('user_id'),
				   'cust_name' => $username,
				   'user_service' => $this->config->item('user_service'),
				   'amount' => $amount,
				   'tax' => $total_tax,
				   'total_amount' => $add_balance,
				   'billing_date' => date('Y-m-d H:i:s'),
				   'tax_percentage' => $tax_per,
				   'description' => $this->config->item('balance'),
				   'message' => 'Transaction Cancelled',
				   'transaction_id'=> $transaction_id );
				   
				   //print_r($insertmcdata);exit;
			   
	    $this->db->insert('voice_billing', $insertmcdata);
	    //echo $this->db->last_query();
	    
		
	    $mcbill_id = $this->db->insert_id();		
	       
	            if($mcbill_id > 0)
				{
				      $quantity='';
				      if($address1=='')
				      {
				        $address1=$_POST['address1'];
				      }
				      if($address2=='')
				      {
				        $address1=$_POST['address1'];
				      }
				      if($state=='')
				      {
				        $state_id=$_POST['state'];			
						$staters=$this->db->query("select * from new_statelist  where state_id=$state_id")->result();
					    @$state=$staters[0]->state;				        
				      }
				      if($city=='')
				      {
				      
				         $city_id=$_POST['city'];
				         $cityrs=$this->db->query("select * from new_citylist where city_id=$city_id")->result();
                         @$city=$cityrs[0]->city_name;
				      }
				      if($zipcode=='')
				      {
				        $zipcode=$_POST['zipcode'];
				      }
				      				      
				      $description= $this->config->item('balance');
									  
				  /*    
				  $url = base_url()."payment/TestSsl.php?mcbill_id=".$mcbill_id."&amount=".$amount."&name=".$username."&customerid=".$userid."&address1=".$address1."&address2=".$address2."&address3=".$address2."&city=".$city."&state=".$state."&email=".$email."&cname=".$username."&desc=".$description."&mobile=".$mobile ."&zip=".$zipcode;
				*/
		 $url = base_url()."payment/TestSsl.php?auto_transid=".base64_encode($transaction_id)."&amount=".base64_encode($amount)."&name=".base64_encode($username)."&customerid=".base64_encode($userid)."&address1=".base64_encode($address1)."&address2=".base64_encode($address1)."&address3=".base64_encode($address1)."&city=".base64_encode($city)."&state=".base64_encode($state)."&email=".base64_encode($email)."&cname=".base64_encode($username)."&desc=".base64_encode($description)."&mobile=".base64_encode($mobile) ."&zip=".base64_encode($zipcode);		
				
					redirect($url);
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Order details are not inserted.Please check order details.');
					//redirect('DIDpayments/index');
				} 
					
					
					
        	
        	//redirect('DIDpayments/order_history/added');
        	//print_r($_POST);
        	//exit;
        	}
	   
		
		$this->load->model('Mcrental_model');	
	    $allstates = $this->_data['allstates'] = $this->Mcrental_model->All_states();		
		$this->_data['billing_details'] = $this->Mcrental_model->Billig_details($this->session->userdata('user_id'));
	    $user_details = $this->_data['user_details'] = $this->Mcrental_model->Getuser_details($this->session->userdata('user_id'));	
		$this->_data['city_list'] = $this->Mcrental_model->getCitylist();
		$this->_data['state_list'] = $this->Mcrental_model->getStatelist();
		
		$get_tax = $this->_data['get_tax'] = $this->Mcrental_model->get_tax();	
		$this->_data['users'] = $this->Mcrental_model->getClients();
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/add_balance',$this->_data);
		//$this->load->view('include/footer');
	}
	
	
	public function Renew_codeotp()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');
		$this->load->model('Mcrental_model');		
        $user_details = $this->_data['user_details'] = $this->Mcrental_model->Getuser_details($user_id);
			
		$data['end']=$this->session->userdata('end');
		
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('payments/renew_codeotp',$this->_data);
		//$this->load->view('include/footer');	
	}
	
	public function Addbal_codeotp()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');
		$this->load->model('Mcrental_model');		
        $user_details = $this->_data['user_details'] = $this->Mcrental_model->Getuser_details($user_id);
			
		$data['end']=$this->session->userdata('end');
		
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('payments/addbal_codeotp',$this->_data);
		//$this->load->view('include/footer');	
	}
		

	public function thanku()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];			       
		$this->load->model('Mcrental_model');	
		if($_REQUEST['tn']){
			$ePGTxnID=$_REQUEST['tn'];
			$Message=$_REQUEST['rm'];
			$mcbillings = $this->Mcrental_model->billigPaydetails($ePGTxnID);
			
			foreach($mcbillings as $key=>$mbill){	
				$did_no = $mbill->service_nos;
				$amount = $mbill->amount;
				$user_id = $mbill->user_id;				
				$epgTid = $mbill->epg_txnID;
				
				$this->session->userdata($user_id);	
			
		if($ePGTxnID=$epgTid){
			
			$user_details = $this->_data['user_details'] = $this->Mcrental_model->Getuser_details($user_id);
			foreach($user_details as $key=>$user_de){
				$mc_credits = $user_de->main_balance;					
				$tot_credits = $mc_credits + $amount;						
				$this->Mcrental_model->Update_add_credits($tot_credits,$user_id);
				
				$this->Mcrental_model->Add_user_payments($amount,$user_id);
			
			$log_data = 'amount :' .$amount .', user_id :'. $user_id .', date :'.date('Y-m-d').' Transaction Completed'; 
			error_log("\n $log_data", 3, "/var/www/html/FirstRing/logs/mainaddbal.log");
				}
			}	
			} 		
		}		
		  // session data start.
	$this->load->model('User_Model');	
	$rs=$this->User_Model->getPaymentUserDetails($user_id);
	  if($rs)
	  {
     	foreach($rs as $result)
		{
		$sessionData = array (
		'username' => $result->username,
		'mobile' => $result->mobile,
		'first_name' => $result->first_name,
		'user_id' => $result->user_id,
		'no_ndnc' => $result->no_ndnc,
		'dnd_check' => $result->dnd_check,
		'dlr_enabled' => $result->dlr_enabled,
		'is_reseller' => $result->is_reseller,
		'ndnc_return' => $result->return_ndnc_credits,
		'template_check' => $result->template_check,
		'max_ports' => $result->max_ports,
		'voice_users' => $result->voice_users,
		'max_participants' => $result->max_participants,
		'is_missedcall' => $result->is_missedcall,
		'is_obd' => $result->is_obd,
		'caller_id' => $result->caller_id,
		'is_call_record' => $result->is_call_record,
		'price_per_pulse' => $result->price_per_pulse,
		'pulse_duration' => $result->pulse_duration,
		'sms_price' => $result->sms_price
		);
		
		$_SESSION['user_id']=$result->user_id;
		
		}
		
	    $this->session->set_userdata($sessionData);
	  }
	  
// session data end.	
		$this->load->view('include/header',$data);
		$this->load->view('include/menu');
		$this->load->view('payments/thanku');
		//$this->load->view('include/footer');	
	}
	
	public function days_plans()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');		
		$this->load->model('Mcrental_model');
		$days_id_ajax=$this->input->get('sel_days');
		$getplan_list =array();
		$getplan_list = $this->Mcrental_model->getRentalplans($days_id_ajax);
		
		//print_r($getplan_list);
		?>
		<option value="0">Select Package</option>
		<?php
		foreach($getplan_list as $key=>$plans){			
		?>
	<option value="<?php echo $plans->plan_totcalls .','. $plans->plan_price .','. $plans->plan_duration; ?>"><?php echo $plans->plan_totcalls; ?></option>
	
	<?php } 		
		
	}
	
	public function service_packages()
	{
	date_default_timezone_set('Asia/Kolkata');
	      //unset($_SESSION['planprice']);
	      //$_SESSION['planprice']=0;
	      // delete cart table start
	      $user_id =$this->session->userdata('user_id');
		$this->load->model('Voice_rental_model');
		$this->Voice_rental_model->deletecart($user_id);
		
	     
	      // delete cart table end.
	      /*
			$_SESSION['rental_plan'] = $_REQUEST['rental_plan'];

			$rr=explode(',',$_REQUEST['rental_plan']);
			$_SESSION['max_calls'] = $rr[0];
			$_SESSION['package_cost'] = $rr[1];	
			$_SESSION['plan_days'] = $rr[2];

			//print_r($rr);

			$_SESSION['plan_service'] = $_REQUEST['plan_service'];		
			$_SESSION['planprice'] = $_REQUEST['planprice'];
			$input = trim($_REQUEST['sel_nos']);
			$numbers = preg_split('/\s+/', $input);
			$_SESSION['sel_nos'] = implode(',', $numbers);
			$_SESSION['did_values'] = $_REQUEST['did_values'];*/
	      
	      if(@$_SESSION['rental_plan']!='')
	      {
	        unset($_SESSION['rental_plan']);
	      }
	       if(@$_SESSION['max_calls']!='')
	      {
	        unset($_SESSION['max_calls']);
	      }
	       if(@$_SESSION['package_cost']!='')
	      {
	        unset($_SESSION['package_cost']);
	      }
	       
	      if(@$_SESSION['sel_nos']!='')
	      {
	      
	      echo $_SESSION['sel_nos'];
	      
	        unset($_SESSION['sel_nos']);
	       
	      }
	       if(@$_SESSION['did_values']!='')
	      {
	        unset($_SESSION['did_values']);
	      }
	      
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');		
		$this->load->model('Mcrental_model');
		
		$days_id_ajax=$this->input->get('sel_service');
		
		$getpackage_list =array();
		$getpackage_list = $this->Mcrental_model->Service_packages($days_id_ajax);
		
		//print_r($getpackage_list);
		
		?>
		<option value="">Select Package</option>
		<?php
		
		foreach($getpackage_list as $key=>$package){			
		?>
	<option value="<?php echo $package->plan_totcalls .','. $package->plan_price .','. $package->plan_duration .','. $package->sms_credits .','. $package->vc_amount.','. $package->package_id; ?>"><?php echo $package->plan_duration . ' Days / ' . $package->plan_totcalls . ' Calls / ' . $package->plan_price . ' Rupees'; ?></option>
	<?php } 
	
			
	}
	
	public function getservice_packages()
	{
	date_default_timezone_set('Asia/Kolkata');
		$real_url=$this->data['real_url'];
		$user_id =$this->session->userdata('user_id');		
		$this->load->model('Voice_rental_model');
		$days_id_ajax=$this->input->get('sel_service');		
		$getpackage_list =array();
		$getpackage_list = $this->Voice_rental_model->Service_packages($days_id_ajax);
		
		//print_r($getplan_list);
		?>
		<option value="">Select Package</option> 
		<?php
		foreach($getpackage_list as $key=>$package){
		
			$selected = '';
			if(isset($_SESSION['rental_plan']) != "")
			{
				if($_SESSION['rental_plan'] == $package->plan_totcalls .','. $package->plan_price .','. $package->plan_duration .','. $package->sms_credits .','. $package->vc_amount.','.$package->package_id)
				{
					$selected = "selected";
				}
			}		
		?>
	<option value="<?php echo $package->plan_totcalls .','. $package->plan_price .','. $package->plan_duration .','. $package->sms_credits .','. $package->vc_amount.','.$package->package_id; ?>" <?php echo $selected?>><?php echo $package->plan_duration . ' Days / ' . $package->plan_totcalls . ' Calls / ' . $package->plan_price . ' Rupees'; ?></option>
	<?php }		
	}

	/* public function renewal_job()
	{
		
		$real_url=$this->data['real_url'];
		$this->load->model('Mcrental_model');
		$today = date('Y-m-d');		
		$user_credits_tbl = $this->Mcrental_model->Get_servicewise_credits();
			foreach($user_credits_tbl as $user_credits) {
				$renewal_date = $user_credits->renewal_date;
				$bill_id = $user_credits->renewal_mc_id;
							
			$user_credits_tbl = $this->Mcrental_model->Billig_id_details($bill_id);	
				foreach($mcbillings as $key=>$mbill){	
				$did_no = $mbill->service_nos;
				$quantity = $mbill->mc_quantity;	
				$user_id = $mbill->user_id;
				$plan_days = $mbill->plan_days;
				$pservice = $mbill->plan_service;
				$uservice = $mbill->user_service;
				$fsms = $mbill->sms_credits;
				$fcalls = $mbill->vc_amount;				
			
			$sdate = date('Y-m-d');
			$sdays = $plan_days;
			$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days')); 	
			$active = 'Y'; 
			$did_callfields = array('did_no' => urldecode($did_no),			
			'user_name' => $user_id,	
			'active' => $active,
			'pservice' => $pservice,
			'uservice' => $uservice,
			'subscription_date' => $sdate,
			'subsc_duration' => $sdays,
			'expiry_date' => $pay_edate,
			'max_calls' => $quantity);
        $did_call_url = $real_url."didpayupdate_api.php";
		$did_call_string = http_build_query($did_callfields);
		$did_ch = curl_init();
		curl_setopt($did_ch, CURLOPT_URL, $did_call_url);
		curl_setopt($did_ch, CURLOPT_HEADER, 0);
		curl_setopt($did_ch,CURLOPT_POST, count($_POST));
		curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_call_string);
		curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
		echo $did_result = curl_exec($did_ch);
        curl_close($did_ch);								
			
		}
		
		}				
			
	} */		
	
	public function statecities()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Mcrental_model');
		$user_id=$this->session->userdata('user_id');
		$rs=$this->db->query("select * from users where user_id=$user_id")->result();

		foreach($rs as $key => $value)
		{
			 
			 $state_id = $value->state_id;
			 $city_id = $value->city_id;
			
		}
		
		$cities =array();	
		$cities=$this->db->get_where('new_citylist',array('state_id'=>$state_id))->result();
				
		?>
		<option value="0">Select City</option>	
		<?php
		foreach($cities as $key=>$city) {?>
			<option value="<?php echo $city->city_id;?>" <?php  if($city_id==$city->city_id) echo "selected";?> ><?php echo $city->city_name;?></option>
			<?php } 		
	}
		
	public function state_cities()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Mcrental_model');		
		$state_ajax=$this->input->get('sel_state');
		$city_ajax=$this->input->get('sel_city');		
		$cities =array();	
		$cities=$this->db->get_where('new_citylist',array('state_id'=>$state_ajax))->result();
				
		?>
		<option value="0">Select City</option>	
		<?php
		foreach($cities as $key=>$city) {?>
			<option value="<?php echo $city->city_id;?>" <?php  if($city_ajax==$city->city_id) echo "selected";?> ><?php echo $city->city_name;?></option>
			<?php } 		
	}
	
	public function state_citiesnames()
	{
	date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Mcrental_model');		
		$state_ajax=$this->input->get('sel_state');
		$city_ajax=$this->input->get('sel_city');		
		$cities =array();	
			
		
		
		$cities=$this->db->get_where('new_citylist',array('state_id'=>$state_ajax))->result();
				
		?>
		<option value="0">Select City</option>	
		<?php
		foreach($cities as $key=>$city) {?>
			<option value="<?php echo $city->city_name;?>" <?php  if($city_ajax==$city->city_id) echo "selected";?> ><?php echo $city->city_name;?></option>
			<?php } 		
	}	

	public function get_didtypes($did_plan)
	{  
	date_default_timezone_set('Asia/Kolkata');   
	$real_url=$this->data['real_url'];
	$qry_fields =array('did_plan' => urlencode($did_plan));
      $did_url = $real_url."get_didtypes_api.php";
	$qry_fields_string = http_build_query($qry_fields);
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
	   $result=$result1;
	}
		else
		{
		   $result=array();
		}
		return $result;
	}
	
	// for getdidnos_price 18-10-2016.
	
	public function getdidnos_price()
	{
	date_default_timezone_set('Asia/Kolkata');
	$data=array();
	$data['result']=array();
	//print_r($_REQUEST['snosprice']);
	$did_nos=$_REQUEST['snosprice']; 
	$data['did_nos']=$did_nos;
	$real_url=$this->data['real_url'];
	$qry_fields =array('did_nos' => urlencode($did_nos));
    $did_url = $real_url."get_didprice_api.php";
    $qry_fields_string = http_build_query($qry_fields);
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
	   $data['result']=$result1;
	   
	}
		
	//print_r($data['result']);	
		//return $result;
		
		
	$this->load->view('payments/viewdidprice',$data);	
		
		
	}		
		
	public function getsno_types()
	{  
	date_default_timezone_set('Asia/Kolkata');   
	$real_url=$this->data['real_url'];
    $did_url = $real_url."get_sno_type.php";
	$did_conn = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($did_conn,CURLOPT_URL, $did_url);
	curl_setopt($did_conn,CURLOPT_POST, count($_POST));
	curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
	//execute post
	$did_result = curl_exec($did_conn);
	$getsno_types_api=json_decode($did_result, true);
 	curl_close($did_conn);
	$result1  = $getsno_types_api;
	if(count($result1)>0)
	{
	   $result=$result1;
	}
		else
		{
		   $result=array();
		}
		return $result;
	}

	public function update_visible($did_no,$visible)
	{
	date_default_timezone_set('Asia/Kolkata');
	$real_url=$this->data['real_url'];
	
	$qry_fields =array('did_number' => urlencode($did_no),
	                   'visible' => urlencode($visible));
    
	$did_url = $real_url."didtrans_payupdate_api.php";
	
	$qry_fields_string = http_build_query($qry_fields);	
	$did_conn= curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($did_conn,CURLOPT_URL, $did_url);
	curl_setopt($did_conn,CURLOPT_POST, count($_POST));
	curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
	curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
	//execute post
	$did_result = curl_exec($did_conn);	
	$didtrans_visible_api=json_decode($did_result, true);
 	curl_close($did_conn);
	  $result1  =$didtrans_visible_api;
	if(count($result1)>0)
	{
	   $result=$result1;
	}
	else
	{
	   $result=array();
	}
	return $result;
	}
		
	public function get_didvals($did_no)
	{   
	date_default_timezone_set('Asia/Kolkata');  
	$real_url=$this->data['real_url'];
	$qry_fields =array('did_number' => urlencode($did_no));
    $did_url = $real_url."get_didvals_api.php";
	$qry_fields_string = http_build_query($qry_fields);	
	//echo $qry_fields_string;
	$did_conn = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($did_conn,CURLOPT_URL, $did_url);
	curl_setopt($did_conn,CURLOPT_POST, count($_POST));
	curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
	curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
	//execute post
	$did_result = curl_exec($did_conn);
	$getdid_calllist_api=json_decode($did_result, true);
 	curl_close($did_conn);
	$result1 = $getdid_calllist_api;
	if(count($result1)>0)
	{
	   $result=$result1;
	}
		else		
		{
		   $result=array();
		}
	return $result;
	}	
	
	public function getall_activedids()
	{
	date_default_timezone_set('Asia/Kolkata');     
	$real_url=$this->data['real_url'];
    $did_url = $real_url."getall_activedids_api.php";
	$did_conn= curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($did_conn,CURLOPT_URL, $did_url);
	curl_setopt($did_conn,CURLOPT_POST, count($_POST));
	curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
	//execute post
	$did_result = curl_exec($did_conn);
	$getdid_field_api=json_decode($did_result, true);
 	curl_close($did_conn);
	$result1  =$getdid_field_api;
	if(count($result1)>0)
	{
	   $result=$result1;
	}else
		{
		   $result=array();
		}
	return $result;
	}

	// For Live search
	public function get_livedids($did_plan,$src_no)
	{  
	date_default_timezone_set('Asia/Kolkata');   
	$real_url=$this->data['real_url'];
	echo $qry_fields =array('did_plan' => urlencode($did_plan),'search_no' => urlencode($src_no));
      echo $did_url = $real_url."get_livedidnos_api.php";
	$qry_fields_string = http_build_query($qry_fields);
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
	   $result=$result1;
	}
		else
		{
		   $result=array();
		}
		return $result;
	}
	
	
	public function Addbal_cancel()
	{
	date_default_timezone_set('Asia/Kolkata');
	    $real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];		
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->load->model('Mcrental_model');
		if($_REQUEST['tn']){
			$ePGTxnID = $this->_data['epgTid'] = $_REQUEST['tn'];
			$Message = $this->_data['message'] = $_REQUEST['rm'];
			$this->session->set_flashdata('error_message', $Message);
		}	
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/addbal_cancel',$this->_data);
	}
	public function Ordernow_cancel()
	{
	date_default_timezone_set('Asia/Kolkata');
	    $real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];
		if($_REQUEST['tn']){
			$user_id = $this->_data['user_id'] = $_REQUEST['user_name'];
			$ePGTxnID = $this->_data['epgTid'] = $_REQUEST['tn'];
			$Message = $this->_data['message'] = $_REQUEST['rm'];
			$this->session->userdata($user_id);
		}
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->load->model('Mcrental_model');
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/neworder_cancel',$this->_data);
	}
	public function Renewal_cancel()
	{
	date_default_timezone_set('Asia/Kolkata');
	    $real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];
		if($_REQUEST['tn']){
			$user_id = $this->_data['user_id'] = $_REQUEST['user_name'];
			$ePGTxnID = $this->_data['epgTid'] = $_REQUEST['tn'];
			$Message = $this->_data['message'] = $_REQUEST['rm'];
			$this->session->userdata($user_id);
		}
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->load->model('Mcrental_model');
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/renewal_cancel',$this->_data);
	}
	public function Upgrade_cancel()
	{
	date_default_timezone_set('Asia/Kolkata');
	    $real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];
		if($_REQUEST['tn']){
			$user_id = $this->_data['user_id'] = $_REQUEST['user_name'];
			$ePGTxnID = $this->_data['epgTid'] = $_REQUEST['tn'];
			$Message = $this->_data['message'] = $_REQUEST['rm'];
			$this->session->userdata($user_id);
		}
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->load->model('Mcrental_model');
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/upgrade_cancel',$this->_data);
	}
	public function Addcredits_cancel()
	{
	date_default_timezone_set('Asia/Kolkata');
	    $real_url=$this->data['real_url'];
		$tax_per=$this->data['tax_per'];
		$tax=$this->data['tax'];
		if($_REQUEST['tn']){
			$user_id = $this->_data['user_id'] = $_REQUEST['user_name'];
			$ePGTxnID = $this->_data['epgTid'] = $_REQUEST['tn'];
			$Message = $this->_data['message'] = $_REQUEST['rm'];
			$this->session->userdata($user_id);
		}
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}		
		$this->load->model('Mcrental_model');
		
		$this->load->view('include/header',$this->_data);
		$this->load->view('include/menu');
		$this->load->view('payments/addcredits_cancel',$this->_data);
	}
	
	
		
}
