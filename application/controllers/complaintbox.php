<?php
Class complaintbox extends CI_Controller
{
	protected $_userId;
	
	protected $_username;
	
	protected $_no_ndnc;
	
	protected $_is_dlr_enabled;
	
	protected $_credits;
	
	protected $_international_credits;
	
	protected $_sms_port;
	
	protected $_data = array();
	
	public function __construct()
	{
		parent::__construct();
		 if(!$this->session->userdata('user_id') )   { 
		  redirect(base_url()); 
	} 
		 
	if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {

		 redirect(base_url().'ftpcampaign/viewcampaigns'); 
	 }  
        
        $this->_userId = $this->session->userdata('user_id');
        $this->_username = $this->session->userdata('first_name');
        $this->_no_ndnc = $this->session->userdata('no_ndnc');
        $this->_is_dlr_enabled = $this->session->userdata('dlr_enabled');
        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) {
        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        } 
        $this->_data['available_credits'] = $this->_credits;
	}
	
		
	
	
	 public function index()
	{
        if(!$this->session->userdata('user_id')) {
            redirect('index/login');
        }

		$data['page_title'] = "Complaint Box";
		$data['available_credits'] = $this->_credits;
		
		if($this->uri->segment(3) == "thankyou") {
			$data['msg'] = "Thank you for contacting support Team, will contact you with in 24 hours";
		}
		
		if ($this->input->post('submit')) {
			
			$this->load->library('form_validation');
			if ($this->form_validation->run('complaint_form') == TRUE) {
				
				$complaint_type = $this->input->post('issue_type');
				$number = $this->input->post('contact_number');
				$cust_email = $this->input->post('cust_email');
				$subject = $this->input->post('subject');
				$text = $this->input->post('complaint_text');
				
				$email_msg = "
				    <p>UserName: ".$this->session->userdata('username')."</p>
				    <p>To: {$complaint_type} </p>
					<p>From: {$number} </p>
					<p>Subject: ".$subject." </p>
					<p>Email: ".$cust_email." </p>
					<p align='justify'>Complaint: ".$text."</p>";
				
				/*
				$this->load->library('email');
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('support@smsstriker.com', 'Complaint box');
				$this->email->to(array('support@smsstriker.com','bharath@smsstriker.com','susheel@smsstriker.in'));
				$this->email->subject($subject);
				$this->email->message($email_msg);
				$this->email->send();
				
				*/
				
				$this->load->library('email');
				$SMTPOptions = array('ssl' => array(  'allow_self_signed' => true ));
					$subject = "For: ".$complaint_type." - ".$subject;
					$this->email->initialize(array(
					'protocol' => $SMTPOptions,
		'smtp_host' => 'mail.office24by7.in',
		'smtp_user' => 'app@office24by7.in',
		'smtp_pass' => 'Str!ker@123',
		'smtp_port' => 465,
					'wordwrap' => TRUE,
					'charset' => 'iso-8859-1',
					'mailtype' => 'html',
					'crlf' => "\r\n",
					'newline' => "\r\n"
					));
				
					 $this->email->from($cust_email, $this->session->userdata('username'));
					$this->email->to(array('support@smsstriker.com','bharath@smsstriker.com','susheel@smsstriker.in'));
					$this->email->subject($subject);
					$this->email->message($email_msg);
					$this->email->send();
				redirect('complaintbox/index/thankyou');				
			}	
		}
		
		$this->load->view('/includes/header',$data);
		$this->load->view('includes/leftmenu');		
		$this->load->view('/complaint/complaint_box',$data);
		$this->load->view('/includes/footer');		
		
	}
	public function contactus()
	{
		$data['page_title'] = "Contact Us";
		$data['available_credits'] = $this->_credits;
		$this->load->view('/includes/header',$data);
		$this->load->view('includes/leftmenu');		
		$this->load->view('/complaint/contactus');
		$this->load->view('/includes/footer');
	}
	public function thankyou()
	{
		$data['page_title'] = "thankyou";
		$data['available_credits'] = $this->_credits;
		$this->load->view('/includes/header',$data);
		$this->load->view('includes/leftmenu');		
		$this->load->view('/complaint/thankyou');
		$this->load->view('/includes/footer');
	}
	
	
}
