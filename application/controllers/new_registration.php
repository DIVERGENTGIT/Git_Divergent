<?php
class new_registration extends CI_Controller
{
	protected $_credits;
	
	public function __construct()
	{
		parent::__construct();
 if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
		if($this->session->userdata('user_id')) {            
        	$this->_userId = $this->session->userdata('user_id');
        	$this->load->model('User_model');
			$credits_rs = $this->User_model->getAvailableCredits($this->_userId);

	        foreach ($credits_rs as $rs) {
	        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
	        }
        }
	}
	public function index()
	{
		$data['page_title'] = "Home";
		$data['available_credits'] = $this->_credits;
$data['available_credits'] = $this->_data['shorturlCredits'];
		$this->load->view('/includes/header_n',$data);
		$this->load->view('/index_new/index');
		$this->load->view('/includes/footer_index_n');
	}
	


	
	
	 public function cities_ajaxreg()
    {
		//get cities
		$this->load->model('user_model');
        $state_id_ajax=$this->input->post('state_id');
        $citiesAll = $this->user_model->getNew_CitiesListReg($state_id_ajax);
        $city_all = array('' => '--select--');
        foreach($citiesAll as $row){
             $city_all[$row->city_id] = ucwords(strtolower($row->city_name));
        }
        
        //$this->_data['city_all'] = $city_all;
         print form_dropdown('city_id',$city_all);
	}
	
	
	
	
	public function register()
	{
		$data['available_credits'] = 0;
		$data['page_title'] = "Register";
		if ($this->input->post('register')) {
			
			
			
$username=$this->input->post('username');
$first_name= $this->input->post('first_name');
$last_name =  $this->input->post('last_name');
$email= $this->input->post('email');
$mobile= $this->input->post('mobile');
$address1= $this->input->post('address1');
$address2= $this->input->post('address2');
$city_id = $this->input->post('city_id');
$state_id= $this->input->post('state_id');
$zipcode=$this->input->post('pincode');
$acctype= $this->input->post('acctype');
	if($acctype=='1')
{
	$actyp= "Transactional Account";
}else
{
		$actyp= "Promotional Account";

}
		//send email
					$email_msg = "<h3> Registration Details </h3><p>".$_SERVER['SERVER_NAME']."</p>
					<p>Username : ".$username."<br>Mobile Number : ".$mobile."<br>Email ID : ".$email."<br>
					 Address1 :".$address1."<br>Address2 : ".$address2."<br>zipcode: ".$zipcode."<br> Account Type: ".$actyp."</p>";
					 
					$subject = "New Client Registration Details";
					$this->load->library('email');
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->from('support@smsstriker.com', 'Support Team');
					$this->email->to('krishna@smsstriker.net');
					$this->email->subject($subject);
					$this->email->message($email_msg);
			  if($this->email->send())
				 {
				  echo 'Email sent. Executive will get back to you very soon Thank you';
				 }
				 else
				{
				 show_error($this->email->print_debugger());
				}
			 
						
			
			$this->load->library('form_validation');			
			if ($this->form_validation->run('register_form') == TRUE) {
				$this->load->model('User_model');
				if(!$this->User_model->usernameExist()) {
					$this->User_model->register();
					redirect('index_new/login');
				}
				 else {
					$data['userExist'] = "User already exist with the same Username";
				}
					
			}
		}


		
				$data['acctype'] = array('' => '--select--', '1'=> 'Transactional','0'=> 'Promotional');
				

				//$data['states'] = array('' => '--seelct--', '1' => 'Arunachal Pradesh', '2' => 'Andhra Pradesh');
			$this->load->model('user_model');
		$statesAll = $this->user_model->getNew_StatesList();
		 $states_all = array('' => '--select--');
        foreach($statesAll as $row){
            $states_all[$row->state_id] = ucwords(strtolower($row->state));
        }
        $this->_data['states_all'] = $states_all;

		$data['countries'] = array('' => '--select--', '1' => 'INDIA');
		$this->load->view('/includes/header_n',$data);
		$this->load->view('/index_new/register-n');
		$this->load->view('/includes/footer_index_n');
	}
	
	
	
	
	
	
	

	
}
