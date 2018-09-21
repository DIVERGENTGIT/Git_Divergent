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
		if(!$this->session->userdata('user_id')) {            
        	redirect('index/index');
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
	
	public function index()
	{
		
		if($this->_is_reseller) {
			redirect('reseller/myUsers');
		}
		
		$this->_data['page_title'] = "Resellers";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('reseller/index');
		$this->load->view('includes/footer');
	}
	
	public function myUsers()
	{
		$this->_data['page_title'] = "My Users - Reseller";
		
		$this->load->model('reseller_model');
		$total_users = $this->reseller_model->get_users_count($this->_userId);
		$off_set = $this->uri->segment(3);
		$limit = 10;
		$users_data = $this->reseller_model->get_users($this->_userId, $off_set, $limit);
		$this->load->library('pagination');
		$config['base_url'] = site_url()."/reseller/myUsers";
		$config['total_rows'] = $total_users;
		$config['per_page'] = $limit; 
		$this->pagination->initialize($config); 
		$this->_data['users'] = $users_data;
		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('reseller/my-users');
		$this->load->view('/includes/footer');
	}
	
	public function createUser()
	{
		
		//echo $this->_no_ndnc;
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
		$this->load->view('reseller/create-user');
		$this->load->view('/includes/footer');
	}
	
	public function addBalance()
	{
		if ($this->input->post('add_balance')) {
			$user_id = $this->input->post('resellers_user_id');
			$this->load->library('form_validation');			
			if ($this->form_validation->run('add_sms_form') == TRUE) {
				echo $user_id;
				exit;
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
		$this->load->library('pagination');
		$config['base_url'] = site_url()."/reseller/addBalance/$user_id/";
		$config['total_rows'] = $total_payments;
		$config['per_page'] = $limit; 
		$this->pagination->initialize($config); 
		$this->_data['resellers_user_id'] = $user_id;
		$this->_data['payments'] = $payments_data;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('reseller/user_payments');
		$this->load->view('/includes/footer');
	}
	
	
}
