<?php
Class Missedcall extends CI_Controller
{
protected $_userId;
	protected $_username;
    protected $_userType;
	protected $_credits;
	protected $_data = array();
    protected $_template_check;
    protected $_dlr_report_type;
	protected $_campaign;
	protected $_campaign_id;
	protected $_dndCheck;
	protected $_detailed_dlr_report;
	
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   

          
        //user details from session
        $this->_userId = $this->session->userdata('user_id');
        $this->load->model('User_model');
        $userInfo = $this->User_model->getUserDetails($this->_userId);
        $this->_credits = $userInfo[0]->available_credits;
$this->_data['shorturlCredits'] =  $userInfo[0]->shorturl_credits;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
        $this->_userType = $userInfo[0]->no_ndnc;
        $this->_template_check = $userInfo[0]->template_check;
        $this->_dlr_report_type = $userInfo[0]->dlr_enabled;
        $this->_data['available_credits'] = $this->_credits;
		$this->_data['user_id']=$this->_userId;
		$this->_dndCheck = $userInfo[0]->dnd_check;		
		$this->_detailed_dlr_report = $userInfo[0]->detailed_dlr_report;		
	}


public function index()
	{

	$rangeA = $this->input->post('rangeA');
	 $mobile_no= $this->input->post('mobile_no_');
	$option_value= $this->input->post('option_value');
	 $servicenumber= $this->input->post('servicenumber');
				
		if(strlen($rangeA)>0)
		{
		$split = explode("-",$rangeA);
		$from_date = $split[0].'-'.$split[1].'-'.$split[2];
		$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		
		
		if(sizeof($split)==1) 
		{
		$from_date = $split[0];
		$to_date = $split[0];
		
		}else
		{
		
		$from_date = $split[0].'-'.$split[1].'-'.$split[2];
		$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		}

		}
		$this->load->model('Missedcall_model');
		
		
		$getGVMN = $this->Missedcall_model->getGVMN();
		$this->_data['getGVMN'] = $getGVMN;


            $off_set = 0;
            if($this->uri->segment(3)) {
               $off_set = $this->uri->segment(3);
            }
			
$limit = 20;



if(!empty($from_date)&&!empty($to_date))
{
	$missedcalld_reports = $this->Missedcall_model->getMissedCalls_from_To($from_date,$to_date,$mobile_no,$servicenumber,$off_set, $limit);
	$getTotalRows = $this->Missedcall_model->getMissedCalls_from_To($from_date,$to_date,$mobile_no,$servicenumber);
}else{
$from_date=NULL;
$to_date=NULL;

	$missedcalld_reports = $this->Missedcall_model->getMissedCalls_from_To($from_date,$to_date,$mobile_no,$servicenumber,$off_set, $limit);
	$getTotalRows = $this->Missedcall_model->getMissedCalls_from_To($from_date,$to_date,$mobile_no,$servicenumber);
}
$total_rows = count($getTotalRows);
$this->_data['missedcalld_reports'] = $missedcalld_reports;

			
		
         

$this->load->library('pagination');
$config['base_url'] = site_url().'/missedcall/index';
$config['total_rows'] = $total_rows;
$config['per_page'] = $limit; 
$config['use_page_numbers']  = TRUE;
$this->pagination->initialize($config);



			
		$this->_data['rangeA'] = "";
		$this->_data['mobile_no'] = "";
		$this->_data['from_date'] = $from_date;
		$this->_data['to_date'] = $to_date;

		
	
		$this->load->view('includes/header_longcode',$this->_data);
		$this->load->view('includes/leftmenu_longcode');
		$this->load->view('missedcall/missedcall');
		$this->load->view('/includes/footer');
	}
	
	// api reports
	

	
	
	public function smsapi_report()
	{
		
		error_reporting(0);
		$this->_data['page_title'] = "SMS API Reports";
		
		
		
		 $rangeA = $this->input->post('rangeA');
	
	
		$this->load->model('Campaign_model');
		
		$off_set = $this->uri->segment(3);
		if(strlen(trim($off_set))== 0)
		{
			$off_set = 0;
		}
		
		$limit = 25;
		$day_count = 0;
		$api_data = array();		
	
			if(!$off_set) {
			$campaigns_data = $this->Campaign_model->get_SMS_API_Reports($this->_userId,$from_date,$to_date);
			
			foreach($campaigns_data as $data_row) {
				$api_data[]= array(
					'ondate' => $data_row->ondate,
					'noofmsg' => $data_row->noofmsg
				);
			}
			
			$day_count = count($campaigns_data);
		}	
		
		
		$total_days = $this->Campaign_model->get_total_sms_api_days($this->_userId,$from_date=null,$to_date=null);
		

		
		
	if(strlen($rangeA)>0)
		{
		$split = explode("-",$rangeA);
		 $from_date = $split[0].'-'.$split[1].'-'.$split[2];
		 $to_date = $split[3].'-'.$split[4].'-'.$split[5];
$days_data = $this->Campaign_model->get_sms_api_days($this->_userId,$from_date,$to_date,$off_set,$limit);
		
}else{
	$days_data = $this->Campaign_model->get_sms_api_days($this->_userId,$from_date,$to_date,$off_set,$limit);
	}
	
		foreach($days_data as $dayrow) {
			$api_data[]= array(
				'ondate' => $dayrow->on_date, 
				'noofmsg' => $dayrow->sms_count
			);
		}
		$total_days = $total_days+$day_count;
	
		$this->_data['api_data'] = $api_data;
		
			$this->load->library('pagination');
		$config['base_url'] = site_url().'/missedcall/smsapi_report';
		$config['total_rows'] = $total_days;
		$config['per_page'] = $limit; 
		//$config['use_page_numbers']  = TRUE;

		//config for bootstrap pagination class integration
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
		
		$this->load->view('includes/header_longcode',$this->_data);
		$this->load->view('includes/leftmenu_longcode');
		$this->load->view('missedcall/api_reports_longcode');
		$this->load->view('/includes/footer');
	}
	
	
	public function changepassword()
	{
		$this->_data['page_title'] = "Change Password";
		
		if($this->uri->segment(3) == "changed") {
			$this->_data['changed'] = "Your Password has been Changed."; 
		}
		
		if ($this->input->post('change_password')) {
			$this->load->library('form_validation');			
			if ($this->form_validation->run('change_password_form') == TRUE) {
				$current_password = $this->input->post('current_password');
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');			
				
				if($new_password == $confirm_password) {
					$this->load->model('User_model');
					
					if($this->User_model->isOldPasswordCorrect($this->_userId,$current_password)){
						$this->User_model->setNewPassword($this->_userId, $new_password);
						redirect('missedcall/changepassword/changed');
					} else {
						$this->_data['error'] = "Wrong Current Password";
					}				
					
				} else {
					$this->_data['error'] = "Passwords are Matching";
				}					
			}
		}
		
		$this->load->view('/includes/header_longcode',$this->_data);
		$this->load->view('/includes/leftmenu_longcode');
		$this->load->view('missedcall/changepassword_longcode');
		$this->load->view('/includes/footer');
	}
	
	public function messages()
	{

	$rangeA = $this->input->post('rangeA');
	 $mobile_no= $this->input->post('mobile_no_');
	$option_value= $this->input->post('option_value');
				
		if(strlen($rangeA)>0)
		{
		$split = explode("-",$rangeA);
		$from_date = $split[0].'-'.$split[1].'-'.$split[2];
		$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		
		
		if(sizeof($split)==1) 
		{
		$from_date = $split[0];
		$to_date = $split[0];
		
		}else
		{
		
		$from_date = $split[0].'-'.$split[1].'-'.$split[2];
		$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		}	

		}
		
$this->load->model('Missedcall_model');
 $this->_data['user_id'] =  $this->_userId = $this->session->userdata('user_id');

 		  $off_set = 0;
            if($this->uri->segment(3)) {
               $off_set = $this->uri->segment(3);
            }

            $limit = 50;

		
if(!empty($from_date)&&!empty($to_date))
{
	if( $this->session->userdata('user_id')==3958|| $this->session->userdata('user_id')==4065){
		
		$sms_reports = $this->Missedcall_model->getpriyafoodscractard_from_To($from_date,$to_date,$mobile_no,$off_set,$limit);
	 $getTotalRows = $this->Missedcall_model->getpriyafoodscractard_from_To($from_date,$to_date,$mobile_no);

	}else{
$sms_reports = $this->Missedcall_model->getSmsmessages_from_To($from_date,$to_date,$mobile_no,$off_set,$limit);
	 $getTotalRows = $this->Missedcall_model->getSmsmessages_from_To($from_date,$to_date,$mobile_no);
	}

}else{
$from_date=NULL;
$to_date=NULL;
if( $this->session->userdata('user_id')==3958|| $this->session->userdata('user_id')==4065){
		
$sms_reports = $this->Missedcall_model->getpriyafoodscractard_from_To($from_date,$to_date,$mobile_no,$off_set,$limit);
 $getTotalRows = $this->Missedcall_model->getpriyafoodscractard_from_To($from_date,$to_date,$mobile_no);
}else{
	$sms_reports = $this->Missedcall_model->getSmsmessages_from_To($from_date,$to_date,$mobile_no,$off_set,$limit);
 $getTotalRows = $this->Missedcall_model->getSmsmessages_from_To($from_date,$to_date,$mobile_no);
	
}

}
 $getcityCount = $this->Missedcall_model->getcityCount();
$total_rows = count($getTotalRows);
			       
$this->_data['getcityCount'] = $getcityCount;
$this->_data['sms_reports'] = $sms_reports;

         
        

$this->load->library('pagination');
$config['base_url'] = site_url().'/missedcall/messages';
$config['total_rows'] = $total_rows;
$config['per_page'] = $limit; 
$config['use_page_numbers']  = TRUE;

$this->pagination->initialize($config);



			
		$this->_data['rangeA'] = "";
		$this->_data['mobile_no'] = "";
		$this->_data['from_date'] = $from_date;
		$this->_data['to_date'] = $to_date;
		$this->load->view('includes/header_longcode',$this->_data);
		$this->load->view('includes/leftmenu_longcode');
		$this->load->view('missedcall/messages');
		$this->load->view('/includes/footer');
	}
	
	
	 public function download_missedcall()
    {
 
	
        $from_date = $this->uri->segment(3);
        $to_date = trim($this->uri->segment(4));
        $this->load->model('missedcall_model');
		
        $rs = $this->missedcall_model->getMissedCalls_from_To($from_date,$to_date,$mobile_no=NULL,$servicenumber=NULL);
        $string = "S No\tService Number\tMobile Number\tmessage_time\n";
        $sno=1;
        foreach($rs as $row){
            $string .=$sno."\t".$row->service_number."\t".$row->called_from."\t".$row->called_time."\n";
            $sno++;
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Received_missedcalls_".uniqid().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $string;
        exit;

    }
	
	
	
	 public function download()
    {
 
	
        $from_date = $this->uri->segment(3);
        $to_date = trim($this->uri->segment(4));
        $this->load->model('missedcall_model');
		
        $rs = $this->missedcall_model->getSmsmessages_from_To($from_date,$to_date,$mobile_no=NULL);
        $string = "S No\tService Number\tMobile Number\tmessage_time\tSMS Text\n";
        $sno=1;
        foreach($rs as $row){
        	$sms_text=$row->message;
            $string .=$sno."\t".$row->service_number."\t".$row->message_from."\t".$row->message_time."\t".$sms_text."\n";
            $sno++;
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Received_sms_".uniqid().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $string;
        exit;

    }


 public function download_priya_food()
    {
 
	error_reporting(0);
        $from_date = $this->uri->segment(3);
        $to_date = trim($this->uri->segment(4));
        $this->load->model('missedcall_model');
		
        $rs = $this->missedcall_model->getpriyafoodscractard_from_To($from_date,$to_date,$mobile_no=NULL);
        $string = "S.No\tDate & Time\tService Number\tIncoming No\tScratch Card Number\tLocation & Product Data\tMessage from Customer\n";
        $sno=1;
		
        foreach($rs as $row){
        	$sms_text=$row->message;
preg_match_all('!\d+!', $row->message, $matches);
$sctracthcard= $matches[0][0];

$arr=str_split($sctracthcard,3);
 $n= $arr[0];

switch ($n) {
    case 111:
    $location= "Hyderabad";
        break;
    case 222:
        $location="Krishnapatnam";
        break;
    	case 333:
         $location="Kakinada";
		break;
		case 444:
        $location= "Vijayawada";
		break;
       
    default:
         $location= "Hyderabad";
			break;
}


$sms_text = str_replace(array("\r","\n"),"",$sms_text);

            $string .=$sno."\t".$row->message_time."\t".$row->service_number."\t".$row->message_from."\t".$sctracthcard."\t".$location."\t".$sms_text."\n";
            $sno++;
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Received_sms_".uniqid().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $string;
        exit;

    }

	
	
	
	
	
}
