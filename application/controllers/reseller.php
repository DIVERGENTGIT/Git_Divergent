<?php
Class reseller extends CI_Controller
{
	protected $_userId;
	
	protected $_username;
	
	protected $_credits;
	
	protected $_no_ndnc;
	
	protected $_data = array();
	
	protected $_is_reseller;
	
	public function __construct()
	{
		parent::__construct();
		 if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
                
        $this->_is_reseller = $this->session->userdata('is_reseller');        
        $this->_userId = $this->session->userdata('user_id');
        $this->_username = $this->session->userdata('first_name');
        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) {
        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] = $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        }
        $this->_data['available_credits'] = $this->_credits;
        $no_ndnc_rs = $this->User_model->getNondnc($this->_userId);
		 foreach($no_ndnc_rs as $rs) {
				$this->_no_ndnc = $rs->no_ndnc;
		}
	}
	
/*	public function index()
	{
		
		if($this->_is_reseller) {
			redirect('reseller/myUsers');
		}
		
		$this->_data['page_title'] = "Resellers";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('reseller/index');
		$this->load->view('includes/footer');
	}
	*/
	
	public function myUsers()
	{
		$this->_data['page_title'] = "My Users - Reseller";
		$this->_data['usernamemsg']='';
		$this->load->model('reseller_model');
		$limit="10";
		$offset='0';
		if($this->uri->segment(3)!='')
		{
		 	$offset=$this->uri->segment(3);
		}
		
		// add sms credits for user
		if ($this->input->post('add_balance')) {
		
			 //print_r($_POST);
			 //exit;
			 
			$user_id = $this->input->post('resellers_user_id');
			$this->load->library('form_validation');			
			if ($this->form_validation->run('add_sms_form') == TRUE) {
				$rs = $this->User_model->is_user_belongs_to_reseller($user_id, $this->_userId);
				if($rs){
				
					if($this->_credits >= $this->input->post('no_of_sms') ) {
					
						if($this->input->post('no_of_sms')>0){
						//$payment_type = 3; //subtracting SMS
						$payment_type = 2; //subtracting SMS  , Changes on 2017_05_26
						//$this->User_model->insertPaymentDetails($this->_userId, $payment_type, 0);
						
						$this->User_model->insertPaymentDetails($this->_userId, $payment_type, $user_id);
						$this->User_model->subtractBalance($this->_userId);

						//$payment_type = 2; //adding SMS
						$payment_type = 1; //adding SMS , Changes on 2017_05_26
						$this->User_model->insertPaymentDetails($user_id, $payment_type, $this->_userId);
						$this->User_model->addBalance($user_id);
						$this->session->set_flashdata('success_message', 'Add SMS Credits successfully.');
						redirect("reseller/myUsers/$offset");
						}
						else 
						{
						$this->session->set_flashdata('error_message', 'Please Enter Sufficient SMS Credits.');
				            redirect("reseller/myUsers/$offset");	
						}
						
						
					} else {
						//$this->_data['error'] = "Insufficient SMS Credits.";
						$this->session->set_flashdata('error_message', 'Insufficient SMS Credits.');
				            redirect("reseller/myUsers/$offset");							
					}
					
				} else {  
					//echo "Invalid Request";
					//exit;
					$this->session->set_flashdata('error_message', 'Invalid Request.');
				      redirect('reseller/myUsers');	
				}
					
			}
		} else {
			 $user_id = $this->uri->segment(3);
		
			if($this->uri->segment(4) == "added") {
				$this->_data['added'] = "Balance has been added.";
				
			}
		}
		// deduct sms credits for user
		if ($this->input->post('deduct_balance')) {
		
		
			$user_id = $this->input->post('resellers_user_id');
		
		
	
			$this->load->library('form_validation');			
			if ($this->form_validation->run('add_sms_form') == TRUE) {
			
				$rs = $this->User_model->is_user_belongs_to_reseller($user_id, $this->_userId);
				if($rs){
				
			
				
					if($rs[0]->available_credits >= $this->input->post('no_of_sms') ) {
					

					if($this->input->post('no_of_sms')>0){
						$payment_type =2; //add SMS
						$this->User_model->insertPaymentDetails($this->_userId, $payment_type,$this->_userId);
						$this->User_model->addBalance($this->_userId);						
						$payment_type = 3; //subtracting SMS
						$this->User_model->insertPaymentDetails($user_id, $payment_type, $this->_userId);
						$this->User_model->subtractBalance($user_id);
						$this->session->set_flashdata('success_message', 'Deduct SMS Credits successfully.');
						redirect("reseller/myUsers/$offset");
						}
						else
						{
						$this->session->set_flashdata('error_message', 'Please Enter Sufficient SMS Credits.');
				            redirect("reseller/myUsers/$offset");	
						}
					} else {
					
						//$this->_data['error'] = "Insufficient SMS Credits.";
						$this->session->set_flashdata('error_message', 'Insufficient SMS Credits.');
						redirect("reseller/myUsers/$offset");					
					}
					
				} else {
					//echo "Invalid Request";
					//exit;
					$this->session->set_flashdata('error_message', 'Invalid Request.');
				      redirect('reseller/myUsers');	
				}
					
			}
		} else {
			$user_id = $this->uri->segment(3);		
			if($this->uri->segment(4) == "deduct") {
				$this->_data['added'] = "Balance has been deducted.";				
			}
		}
		
		 
		// edit  user details
		 if($this->input->post('save_details')){
		//print_r($_POST);
            $this->load->library('form_validation');
            if ($this->form_validation->run('edit_profile_form') == true) {
            //;	
           // echo "success";		
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $mobile = $this->input->post('mobile');
		$otpmobile = $this->input->post('otpmobile'); 
                $address1 = $this->input->post('address1');
                $address2 = $this->input->post('address2');
                $city = $this->input->post('city_id');
                  $organization = $this->input->post('organization');

                $pincode = $this->input->post('pincode');
				$clientId = $this->input->post('userid');
				$useracctype=1;
			$rs = $this->reseller_model->updmyUserDetails($clientId, $first_name, $last_name, $email, $mobile, $address1, $address2, $city, $organization,$pincode,$useracctype,$otpmobile);
			
			$this->session->set_flashdata('success_message', 'Your Profile updated successfully.');
			redirect("reseller/myUsers/$offset");
			
			//if($rs){ 
			//redirect('reseller/myUsers');				
			//}
            }
            else
            { 
            //echo "failed";
            } 
        }

	
	//print_r($_POST);
	
	if(@$_POST['Registration']=='Registration')
	{
		extract($_POST);
		$reseller_id=$this->session->userdata('user_id');
		$sql1="select count(*) as count from users where username='$username'";
		$result1=$this->db->query($sql1)->result();
		foreach($result1 as $key=>$value)
		{  
			if($value->count==0)
			{  
			$password=md5($userpassword);
			$registered_on=date("Y:m:d H:i:s");
			$sql="insert into users (username,password,first_name,last_name,email,mobile,otpMobileNo,organization,address1,city_id,state_id,zipcode,reseller_id,registered_on)
			values('$username','$password','$firstname','$lastname','$email','$mobile','$Otpmobileno','$organization','$address1',$city,$state,$pincode,$reseller_id,'$registered_on')";
			 $this->db->query($sql);
			 $this->session->set_flashdata('success_message', 'User Created successfully.');
			 redirect("reseller/myUsers");
			}
			else
			{
			//$this->_data['usernamemsg']="User Name already exist";
			$this->session->set_flashdata('error_message', 'User Name already exist.');
			redirect("reseller/myUsers");
			}
		}
		 
	}	
	
	
	$total_rows = $this->reseller_model->get_users_countnew($this->_userId);
	$this->_data['users']  = $this->reseller_model->get_usersnew($this->_userId, $offset, $limit);
	
	$this->_data['mainusersid'] = $this->_userId;
	
		$this->load->library('pagination');
		$config['base_url'] = base_url()."reseller/myUsers";
		$config['total_rows'] = @$total_rows;
		$config['per_page'] = $limit; 
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li >';
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
		$this->_data['offset'] = $offset;  
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('reseller/my-users');
		$this->load->view('/includes/footer');
	}
	
	
	
	
	public function createUser()
	{
		
		 $this->_no_ndnc;
		$this->_data['page_title'] = "Create User - Reseller";
		
		if ($this->input->post('register')) {
		
		
	
			$this->load->library('form_validation');			
			if ($this->form_validation->run('add_user_form') == TRUE) {
						
				$this->load->model('User_model');
				
				if(!$this->User_model->usernameExist()) {
			
					if($this->_credits > $this->input->post('no_of_sms') ) {

						
					 $resellers_user_id = $this->User_model->register($this->_no_ndnc);
						
						if($resellers_user_id) {
							
							$payment_type = 2; //subtracting SMS
							$this->User_model->insertPaymentDetails($this->_userId, $payment_type, 0);
							$this->User_model->subtractBalance($this->_userId);
							
							$payment_type = 1; //adding SMS
							$this->User_model->insertPaymentDetails($resellers_user_id, $payment_type, $this->_userId);
							$this->User_model->addBalance($resellers_user_id);
													
						}
						
						redirect('reseller/myUsers');
					} else {
						$this->_data['userExist'] = "Insufficient SMS Credits.";
					}	
				} else {
					$this->_data['userExist'] = "User Already Exist";
				}
					
			}
		}
		
		
		
	

		
		$this->_data['cities'] = array('' => '--select--', '1'=>'Bangalore', '2'=>'Calcutta', '3'=>'Chittor', '4'=>'Chennai', '5' => 'Delhi', '6' => 'Hyderabad', '7'=>'Guntur',
								'8'=>'Gurgaon', '9'=>'Jaipur', '10'=>'Mumbai', '11'=>'Nagpur', '12'=>'Nalgonda', '13'=>'Nellore', '14'=>'Noida', '15'=>'Pune', '16'=>'Pondicherry', 
								'17'=>'Vijayawada', '18'=>'Warangal');
		$this->_data['states'] = array('' => '--seelct--', '1' => 'Arunachal Pradesh', '2' => 'Andhra Pradesh');
		$this->_data['countries'] = array('' => '--select--', '1' => 'INDIA');
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('reseller/create_user');

		//$this->load->view('reseller/create-user');
		$this->load->view('/includes/footer');
	}
	
	public function addBalance()
	{
		if ($this->input->post('add_balance')) {
			 $user_id = $this->input->post('resellers_user_id');
			$this->load->library('form_validation');			
			if ($this->form_validation->run('add_sms_form') == TRUE) {
				$rs = $this->User_model->is_user_belongs_to_reseller($user_id, $this->_userId);
				if($rs){
					if($this->_credits > $this->input->post('no_of_sms') ) {
						
						$payment_type = 2; //subtracting SMS
						$this->User_model->insertPaymentDetails($this->_userId, $payment_type, 0);
						$this->User_model->subtractBalance($this->_userId);
							
						$payment_type = 1; //adding SMS
						$this->User_model->insertPaymentDetails($user_id, $payment_type, $this->_userId);
						$this->User_model->addBalance($user_id);
						redirect('reseller/addBalance/'.$user_id.'/added');
					} else {
						$this->_data['error'] = "Insufficient SMS Credits.";						
					}
					
				} else {
					echo "Invalid Request";
					exit;
				}
					
			}
		} else {
			 $user_id = $this->uri->segment(3);
		
			if($this->uri->segment(4) == "added") {
				$this->_data['added'] = "Balance has been added.";
				
			}
		}
		
		$this->_data['page_title'] = "Add Balance - Reseller";
		$this->load->model('reseller_model');
		$total_payments = $this->reseller_model->get_user_payments_count($user_id, $this->_userId);
		$off_set = $this->uri->segment(4);
		$limit = 100;
		$payments_data = $this->reseller_model->get_user_payments($user_id, $this->_userId, $off_set, $limit);
		if(!$payments_data) {
			echo "Invalid Request";
			exit;
		}
	
		redirect('reseller/myUsers');
		$this->load->library('pagination');
		$config['base_url'] = site_url()."reseller/addBalance/$user_id/";
		$config['total_rows'] = $total_payments;
		$config['per_page'] = $limit; 
		$this->pagination->initialize($config); 
		$this->_data['resellers_user_id'] = $user_id;
		$this->_data['payments'] = $payments_data;
		//$this->load->view('includes/header',$this->_data);
	//	$this->load->view('reseller/user_payments');
	//$this->load->view('/includes/footer');
	}
	
	
	
	
}
