<?php
Class mytemplate extends CI_Controller
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
		if(!$this->session->userdata('user_id')) {            
        	redirect('index/index');
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
	
		
	
	
	 public function sender_names()
    {
        $this->_data['title'] = "Manage Sender Names";
        $this->load->model('user_model');

        //add sender name
        if($this->input->post('add_sender_name')){
        	
            $this->load->library('form_validation');
            if ($this->form_validation->run('add_sender_name_form') == TRUE) {
            	
                $sender_name = $this->input->post('sender_name');
               	if($this->user_model->isSenderNameAvailable($this->_userId, $sender_name))
               	{
               	               	
               		$this->user_model->addSenderName($this->_userId, $sender_name);
               		
               		               		
               		
               		   $rs = $this->User_model->getNewPasswordDetails($this->_userId);
			           
			         
			          
					foreach($rs as $result) 
					{
						$user_id = $result->user_id;
						$email = $result->email;
						$firstName = $result->first_name;
						$username = $result->username;
                                    $mobile = $result->mobile;
					}
               		
               		
               		               		
                             
			            $email_msg = '<!DOCTYPE html> 
					<head> 
					<title>SMS Striker</title> 

					<meta name="viewport" content="width=device-width, initial-scale=1"> 
					<meta name="description" content="" > 
					<meta name="keywords" content="">  
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
					 

					 
					<style> 
					body{margin:0px;padding:0px;font-family: sans-serif; font-size: 13px;   color: #1f497d;    line-height: 1.5;} 

					p{    margin-top: 0px; 
					    margin-bottom: 0px;} 
					.col-sm-12{width:100%;float:left;} 
					.container{width:600px;margin:auto;} 

					.signature p{color: gray;} 
					a{color:#15c !important;} 
					 
					</style> 

					</head> 
					 
					    <body> 
					    <div class="col-sm-12"> 

					    <div class="container"> 
					<p>Dear Team,</p> 

					
					<p>Request to Sender ID Whitelist!</p> 

					<p>This is to Request you that my Sender ID Needed to Whitelist on Striker.</p> 
					<br> 
					<p><strong> My Required Sender ID </strong> : '.$sender_name.'</p> 
					<br> 

					<p><b>Best Regards&#44;</b></p><br> 
					<p><b> Name :'.$firstName .'&#44;</b></p> 
					<p><b> User ID :'.$username .'</b></p> 
					</div> 
					</div> 

					 </body> 
					     

					</html>'; 
					$this->load->library('email');
					$subject = "Sender ID Needed to Whitelist on Striker";
					$this->email->initialize(array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.sendgrid.net',
					'smtp_user' => 'smsstriker',
					'smtp_pass' => 'striker@123',
					'smtp_port' => 587,
					'wordwrap' => TRUE,
					'charset' => 'iso-8859-1',
					'mailtype' => 'html',
					'crlf' => "\r\n",
					'newline' => "\r\n"
					));
				
					$this->email->from($username,$firstName);
					$this->email->to('support@smsstriker.com');
					$this->email->subject($subject);
					$this->email->message($email_msg);
					$this->email->send();
               		
                	redirect("mytemplate/sender_names/added");
                	
				}else
				{
					$this->_data['error'] = "Please follow the below errors"; 
					redirect("mytemplate/sender_names/exist");
				}
					
            }
			else
            {
				  $this->_data['error'] = "Please follow the below errors"; 
			}
        }

        //get added Sender Names
        $sender_names = $this->user_model->getSenderNames($this->_userId);
        $this->_data['sender_names'] = $sender_names;
        $sender_names_accept = $this->user_model-> getSenderNames_accept($this->_userId);
        $this->_data['sender_names_accept'] = $sender_names_accept;
       

        if($this->uri->segment(3) == "added"){
            $this->_data['senderadded'] = "Sender Name has been Added";
            

        }

        if($this->uri->segment(3) == "deleted"){
            $this->_data['deleted'] = "Sender Name has been Deleted";
        }
        if($this->uri->segment(3) == "exist"){
            $this->_data['exist'] = "Sender Name already exist in your list";
        }

        $this->load->view('includes/header',$this->_data);
	 $this->load->view('includes/leftmenu');

        $this->load->view('mytemplate/sender_names',$this->_data);
        $this->load->view('includes/footer');
    }

    public function delete_sender_name()
    {
         $senderId = $this->uri->segment(3);

        if(!$senderId){
            redirect('mytemplate/sender_names');
        }

        $this->load->model('user_model');
        $rs = $this->user_model->getSenderNameDetails($this->_userId, $senderId);

        if(!$rs){
            redirect('mytemplate/templates');
        }

        $rs = $this->user_model->delete_sender_name($this->_userId, $senderId);

        redirect("mytemplate/sender_names/deleted");
    }

    public function templates()
    {
        $this->_data['title'] = "Manage Templates";
        $this->load->model('user_model');
	$limit=25;
	$offset="0";
	if($this->uri->segment(3)!='')
	{
	$offset=$this->uri->segment(3);
	}
        //add Templates
        if($this->input->post('add_template')){
            $this->load->library('form_validation');
            if($this->form_validation->run('add_template_form') == TRUE) {
 
                $template = $this->input->post('template');  
                // ADDED ON 2017-02-3
                $template_name = $this->input->post('template_name');
                
                //ADDED ON 2017-02-3 
                // $this->user_model->addTemplate($this->_userId, $template);
                
                $this->load->model('Campaign_model');

                $is_template_added = $this->Campaign_model->addTemplate($this->_userId, $template,$template_name);
                
                if($is_template_added == 1) {  
                
                 	redirect("mytemplate/templates/added");
                  
                 }else if($is_template_added == 2){
			redirect("mytemplate/templates/edittemp");
		 }elseif($is_template_added == 3) {
			redirect("mytemplate/templates/notUnique");
		}elseif($is_template_added == 4) {
			redirect("mytemplate/templates/length");
		}else{
			redirect("mytemplate/templates/notAdded");
		}
              }else
            	{
			 $this->_data['error'] = "Please follow the below errors"; 
		 }
        }
        
       

        //get added templates
       

        if($this->uri->segment(3) == "added"){
            $this->_data['added'] = "Template has been Added";
        }

        if($this->uri->segment(3) == "deleted"){
            $this->_data['deleted'] = "Template has been Deleted";
        }
	if($this->uri->segment(3) == "notUnique"){  
            $this->_data['deleted'] = "Template Name Already Added.";
        }
	if($this->uri->segment(3) == "notAdded"){
            $this->_data['deleted'] = "Template Not Added";
        }
	if($this->uri->segment(3) == "length"){
            $this->_data['deleted'] = "Template Name not empty and should be less than 15 characters";
        }
	if($this->input->post('editsubmit')){

 
		$template=$this->input->post('edittemp');
		$template_id=$this->input->post('template_id');     
		if(strlen($template) <= 0) {
			$this->_data['edited'] = "SMS content should not empty";
			
		}else{
			$res = $this->user_model->updated_template($this->_userId,$template_id,$template);
			$this->_data['edited'] = "Template has been Updated"; 
		}  
	}
	  
 
	$templatescount = $this->user_model->getTemplatesCount($this->_userId);

         $templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);

  
	$this->load->library('pagination');
	$config['base_url'] = site_url().'/mytemplate/templates';
	$config['total_rows'] =  $templatescount;
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

      
        $this->_data['templates'] = $templates;

        $this->load->view('includes/header', $this->_data);
	$this->load->view('includes/leftmenu');
        $this->load->view('mytemplate/templates');
        $this->load->view('includes/footer');
    }  
    
    public function getRecentTemplate() {
     	$this->load->model('user_model');
	$this->load->model('Campaign_model');
        $templates = $this->Campaign_model->getRecentTemplatesInfo($this->_userId);  
        $this->_data['templates'] = $templates; 
       // $template_names = $this->user_model->getTemplates($this->_userId);
       // $this->_data['template_names'] =  $template_names;
        if($this->uri->segment(3) == "deleted"){
            $this->_data['deleted'] = "Template has been Deleted";
        }
	$this->load->view('includes/header', $this->_data);
	$this->load->view('includes/leftmenu');
        $this->load->view('mytemplate/recent-templates');
        $this->load->view('includes/footer');
    }

    public function delete_template()
    {
        $templateId = $this->uri->segment(3);

        if(!$templateId){
            redirect('mytemplate/templates');
        }

        $this->load->model('user_model');
        $rs = $this->user_model->getTemplateDetails($this->_userId, $templateId);

        if(!$rs){
            redirect('mytemplate/templates');
        }

        $rs = $this->user_model->delete_template($this->_userId, $templateId);

        redirect("mytemplate/templates/deleted");
    }
	   
	   
	/** ADDED ON 2017-02-4 
	  * By saisandeepthi 
	  */
	public function delete_campaign_template()
	{
		$campaignId = $this->uri->segment(3);

		if(!$campaignId){
			redirect('mytemplate/getRecentTemplate');
		}

		$this->load->model('user_model');
		$this->load->model('Campaign_model');
		//$rs = $this->user_model->getTemplateDetails($this->_userId, $templateId);
		
		$rs = $this->Campaign_model->getCampaignTemplateDetails($this->_userId, $campaignId);

		if(!$rs){
			redirect('mytemplate/getRecentTemplate');
		}
            
		$rs = $this->Campaign_model->delete_camapignTemplate($this->_userId, $campaignId);

		redirect("mytemplate/getRecentTemplate/deleted");   
	}
	   
	   
	   
	   
	   
	 
	 
	
	
}
