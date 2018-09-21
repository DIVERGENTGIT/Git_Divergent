<?php
Class home extends CI_Controller
{
    protected $_userId;

    protected $_username;

    protected $_no_ndnc;

    protected $_is_dlr_enabled;

    protected $_credits;

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
        $this->_data['page_title'] = "Added SMS Credits";
        //get the user details
        $this->load->model('User_model');
        $user_details = $this->User_model->getUserDetails($this->_userId);

        $ndnc_return = 0;
        foreach($user_details as $row){
            $ndnc_return = $row->return_ndnc_credits;
        }

        $credits_type = "-1";
        if($this->uri->segment(3)){
            $credits_type = $this->uri->segment(3);
        } elseif($this->input->post('Search')){
            $credits_type = $this->input->post('payment_type');
        }

        //get user total credits Added
        $total_rows = $this->User_model->getTotalAddedCredits($this->_userId, $credits_type);

        $off_set = $this->uri->segment(4);
        $limit = 10;

        //get user credits added transactions
        $credits_history = $this->User_model->getAddedCredits($this->_userId, $credits_type, $off_set, $limit);

        $this->load->library('pagination');
        $config['base_url'] = site_url()."home/index/$credits_type";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        $this->_data['offset'] = $off_set;
        $this->_data['payment_type'] = $credits_type;
        $this->_data['added_credits'] = $credits_history;
        $this->_data['ndnc_return'] = $ndnc_return;
        $this->load->view('includes/header',$this->_data);
	$this->load->view('includes/leftmenu'); 
        $this->load->view('home/index');
        $this->load->view('/includes/footer');
    }

}
