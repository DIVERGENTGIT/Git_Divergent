<?php
Class template extends CI_Controller
{
	protected $_userId;
	
	protected $_username;
	
	protected $_no_ndnc;
	
	protected $_is_dlr_enabled;
	
	protected $_credits;
	 
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('user_id')) {            
        	redirect('login');
        }
        $this->_userId = $this->session->userdata('user_id');
        $this->_username = $this->session->userdata('first_name');
        $this->_no_ndnc = $this->session->userdata('no_ndc');
        $this->_is_dlr_enabled = $this->session->userdata('dlr_enabled');
        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) {
        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] = $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        }
        
	}

	public function index()
	{
		$data['available_credits'] = $this->_credits;
$data['shorturlCredits'] = $this->_data['shorturlCredits'];
		$data['username'] = $this->_username;
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - SMS Templates";
		if($this->input->post('addtemplate')) {
			$this->load->library('form_validation');
			if ($this->form_validation->run('sms_template') == TRUE) {
				$this->load->model('template_model');
				$template = $this->input->post('template');
				$this->template_model->addTemplate($this->_userId, $template);
				redirect('template/index/added');
			}
		}
		if($this->uri->segment(3) == "added") {
			$data['error'] = "New SMS Template has been Added";
		} elseif ($this->uri->segment(3)=="deleted") {
			$data['error'] = "SMS Template has been Deleted";
		}
		
		$this->load->model('template_model');
		$total_templates = $this->template_model->get_templates_count($this->_userId);
		$off_set = $this->uri->segment(3);
		$limit = 10;
		$templates_data = $this->template_model->getTemplates($this->_userId,$off_set,$limit);
		$this->load->library('pagination');
		$config['base_url'] = 'http://localhost/RKAds/template/index/';
		$config['total_rows'] = $total_templates;
		$config['per_page'] = $limit; 
		$this->pagination->initialize($config); 
		$data['templates'] = $templates_data;
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu');
		$this->load->view('templates');
		$this->load->view('includes/footer');
	}
	
	public function delete()
	{
		$template_id = $this->uri->segment(3);
		$this->load->model('template_model');
		$template_details = $this->template_model->getTemplateDetails($this->_userId,$template_id);
		if($template_details) {			
			$rs = $this->template_model->delete($template_id);	
			redirect('template/index/deleted');		
		} else {
			echo "Invalid Request";
			exit;
		}
	}
	
}
