<?php
/**** @author Rushyendra ****/
class Ftpcampaign extends CI_Controller
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
	protected $_International;
	protected $_AllowedCountry;
        protected $_Total_Cnt;	
	protected $_index_pg;	
	
	public function __construct()
	{
		parent::__construct();
		ini_set("display_errors","on");
		$this->load->model(array('ftp_campaign_model','Campaign_model','User_model',"customized_model"));
		$this->_index_pg = "";
		 
		$this->load->helper(array("custom","url"));
		 
		if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		 
		//user details from session
		$this->_userId = $this->session->userdata('user_id');
		$this->_Total_Cnt = 100;	
		//$this->load->model('User_model');
		$userInfo = $this->User_model->getUserDetails($this->_userId);
		//$this->_data['profile']  = $this->User_model->get_user_verfiy($userid);
		$this->_credits = $userInfo[0]->available_credits;
$this->_data['shorturlCredits'] =  $userInfo[0]->shorturl_credits;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
		$this->_userType = $userInfo[0]->no_ndnc;
		$this->_template_check = $userInfo[0]->template_check;
		$this->_dlr_report_type = $userInfo[0]->dlr_enabled;
		$this->_data['available_credits'] = $this->_credits;
		//$this->_data['date_time'] = trim(date('D d M Y g:i A'));
		$this->_data['user_id']=$this->_userId;
		$this->_dndCheck = (isset($userInfo[0]->dnd_check))?$userInfo[0]->dnd_check:0;		
		$this->_detailed_dlr_report = $userInfo[0]->detailed_dlr_report;
		$this->_International = $userInfo[0]->International;
		$this->_AllowedCountry = $userInfo[0]->AllowedCountry;		
	}

	public function viewcampaigns()
	{
  
		 
		$sender_name = $this->input->post('sender');
 
		$from_date=date("Y-m-d");
		 $to_date=date("Y-m-d");
		if($this->input->post('submit'))
		{
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');
			$this->session->unset_userdata('sender_name');	
			$this->session->set_userdata('from_date',  $this->input->post('from_date'));
			$this->session->set_userdata('to_date', $this->input->post('to_date'));	
			$this->session->set_userdata('sender_name', $this->input->post('sender'));
			$from_date =  $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');
			$sender_name = $this->session->userdata('sender_name');

		}
		//$status_ = $this->input->post('status_');
		
		if($this->uri->segment(3) == "deleted") {
			$this->_data['deleted'] = "Campaign Has been Deleted"; 
		}
		
		$this->_data['page_title'] = "SMS Campaign Reports";
		
		$this->load->model('ftp_campaign_model');
		
		
		$sender = array();
		if($this->_userType)
		{
			$senderNames = $this->Campaign_model->getSenderNames($this->_userId);
 
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}
		$this->_data['sender_names'] = $sender;
		$this->_data['user_type'] = $this->_userType;// promo or trans
		$delivered_count=0;
		$off_set = 0;
		$this->_data['userid'] = $this->_userId;
		if(!$this->uri->segment(4))
		{
			$off_set = $this->uri->segment(3);
		}else
		{
			$from_date = $this->uri->segment(3);
			$to_date =$this->uri->segment(4);
			$off_set = $this->uri->segment(5);

		}
		
		/*if($off_set > 0 ) {
			$this->_data['from_date'] = $fd = $from_date = $this->session->userdata('from_date');; 
			$this->_data['sender_name'] = $sn =  $sender_name = $this->session->userdata('sender_name');
			$this->_data['to_date']  =  $td =  $to_date = $this->session->userdata('to_date');
 
		}else {
			$this->_data['from_date'] = $fd = $from_date; 
			$this->_data['sender_name'] = $sn =  $sender_name = $this->session->userdata('sender_name');
			$this->_data['to_date']  =  $td =  $to_date;
 
		} */
		if($this->session->userdata('from_date')) {
				$this->_data['from_date'] = $fd = $from_date = $this->session->userdata('from_date');
			}else{
				$this->_data['from_date'] = $fd = $from_date;
			}
			if($this->session->userdata('to_date')) {
				$this->_data['to_date'] = $td  = $to_date = $this->session->userdata('to_date');
			}else{
				$this->_data['to_date']  =  $td =  $to_date;
			}
			if($this->session->userdata('sender_name')) {
				$this->_data['sender_name'] = $sn = $sender_name = $this->session->userdata('sender_name');
			}else{
				$this->_data['sender_name'] = $sn =  $sender_name = '';
			}
			   

		$limit =10;
		
		if(!empty($from_date)&&!empty($to_date))
		{
 
			$campaigns_report = $this->ftp_campaign_model->get_ftp_campaigns_report($this->_userId,$from_date,$to_date);
     
  
			$campaigns_data = $this->ftp_campaign_model->getAllFTPCampaigns1($this->_userId,$sender_name,$from_date,$to_date,$off_set,$limit);

			$total_campaigns = $this->ftp_campaign_model->get_ftp_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date,$to_date);

		}else{
			$campaigns_report = $this->ftp_campaign_model->get_ftp_campaigns_report_default($this->_userId);

			$total_campaigns = $this->ftp_campaign_model->get_ftp_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date=null,$to_date=null);


			$campaigns_data = $this->ftp_campaign_model->getAllFTPCampaigns1($this->_userId,$sender_name,$from_date=null,$to_date=null,$off_set,$limit);
 

		}
 
 
 
		$errorTextArray = array();
		$this->_data['campaigns_report'] = $campaigns_report;
		$totalmsg=0;
		$exprd=0;
		$dlrd=0;
		$dnds=0;
		$pndng=0;
		$invald=0;  
		foreach($campaigns_report as $campaignreport)
		{
			$totalmsg=$campaignreport['totalmsg'];
			$exprd=$campaignreport['exprd'];
			$dlrd=$campaignreport['dlrd'];
			$dnds=$campaignreport['dnds'];
			$pndng=$campaignreport['pndng'];
			$invald=$campaignreport['invald'];
			$processcnt=$campaignreport['processcnt'];

		}  
		$this->_data['processcnt'] = $processcnt;
		$this->_data['totalmsg'] = $totalmsg;
		$this->_data['exprd'] = $exprd;
		$this->_data['dlrd'] = $dlrd;
		$this->_data['dnds'] = $dnds;
		$this->_data['pndng'] = $pndng;
		$this->_data['invald'] = $invald;
		$this->load->library('pagination'); 
		
 
		
		$config['base_url'] = site_url().'ftpcampaign/viewcampaigns';

		//$config['base_url'] = site_url().'/campaign/viewcampaigns/'.trim($from_date).'/'.trim($to_date);

		$config['total_rows'] = $total_campaigns;
		$config['per_page'] = $limit; 
		//$config['use_page_numbers']  = TRUE;

		//config for bootstrap pagination class integration  

		//print_r($campaigns_data);exit;

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
		$this->_data['campaigns'] = $campaigns_data;
		$this->_data['search_result_rs'] ="";
		$this->_data['errorTextArray'] = "";
		$this->_data['rangeA'] = "";
		$this->_data['search'] = "";	 
		$this->_data['delivered_count'] = $delivered_count;
 
		$this->load->view('includes/header',$this->_data);  
		$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/reports_ftp',$this->_data);
		$this->load->view('/includes/footer');  

	}
	
	public function viewFtpcampaigns()
	{
		//$from_date = $this->input->post('from_date');
		//$to_date = $this->input->post('to_date');
		$sender_name = $this->input->post('sender');
		$rangeA = $this->input->post('rangeA');

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
				//$from_date = $split[0];
				// $to_date = $split[1];
				$from_date = $split[0].'-'.$split[1].'-'.$split[2];
				$to_date = $split[3].'-'.$split[4].'-'.$split[5];

			}
			$this->_data['from_date'] = $from_date;
			$this->_data['to_date'] = $to_date;

		}
		//$status_ = $this->input->post('status_');

		if($this->uri->segment(3) == "deleted") {
			$this->_data['deleted'] = "Campaign Has been Deleted";
		}

		$this->_data['page_title'] = "SMS Campaign Reports";

		$this->load->model('Campaign_model');


		$sender = array();
		if($this->_userType){
			$senderNames = $this->Campaign_model->getSenderNames($this->_userId);
			$sender[''] = '--All--';
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}
		$this->_data['sender_names'] = $sender;
		$this->_data['user_type'] = $this->_userType;// promo or trans
		$delivered_count=0;
		//$off_set = $this->uri->segment(3);
		$this->_data['userid'] = $this->_userId;
		if(!$this->uri->segment(4))
		{
			$off_set = $this->uri->segment(3);
		}else
		{
			$from_date = $this->uri->segment(3);
			$to_date =$this->uri->segment(4);
			$off_set = $this->uri->segment(5);

		}
		$limit =10;

		if(!empty($from_date)&&!empty($to_date))
		{
			$campaigns_report = $this->ftp_campaign_model->get_ftp_campaigns_report($this->_userId,$from_date,$to_date);

				
			$campaigns_data = $this->ftp_campaign_model->getAllFTPCampaigns1($this->_userId,$sender_name,$from_date,$to_date,$off_set,$limit);

			$total_campaigns = $this->ftp_campaign_model->get_ftp_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date,$to_date);

		}else{
			$campaigns_report = $this->ftp_campaign_model->get_ftp_campaigns_report_default($this->_userId);

			$total_campaigns = $this->ftp_campaign_model->get_ftp_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date=null,$to_date=null);
				

			$campaigns_data = $this->ftp_campaign_model->getAllFTPCampaigns1($this->_userId,$sender_name,$from_date=null,$to_date=null,$off_set,$limit);

				
		}
		$errorTextArray = array();



		$this->_data['campaigns_report'] = $campaigns_report;
		$totalmsg=0;
		$exprd=0;
		$dlrd=0;
		$dnds=0;
		$pndng=0;
		$invald=0;
		foreach($campaigns_report as $campaignreport)
		{
			$totalmsg=$campaignreport['totalmsg'];
			$exprd=$campaignreport['exprd'];
			$dlrd=$campaignreport['dlrd'];
			$dnds=$campaignreport['dnds'];
			$pndng=$campaignreport['pndng'];
			$invald=$campaignreport['invald'];
			$processcnt=$campaignreport['processcnt'];

		}
		$this->_data['processcnt'] = $processcnt;
		$this->_data['totalmsg'] = $totalmsg;

		$this->_data['exprd'] = $exprd;
		$this->_data['dlrd'] = $dlrd;
		$this->_data['dnds'] = $dnds;
		$this->_data['pndng'] = $pndng;
		$this->_data['invald'] = $invald;




		$this->load->library('pagination');
		$config['base_url'] = site_url().'ftpcampaign/viewFtpcampaigns';

		//$config['base_url'] = site_url().'/campaign/viewcampaigns/'.trim($from_date).'/'.trim($to_date);

		$config['total_rows'] = $total_campaigns;
		$config['per_page'] = $limit;
		//$config['use_page_numbers']  = TRUE;

		//config for bootstrap pagination class integration

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

		$this->_data['campaigns'] = $campaigns_data;
		$this->_data['search_result_rs'] ="";
		$this->_data['errorTextArray'] = "";
		$this->_data['rangeA'] = "";
		$this->_data['search'] = "";
		$this->_data['delivered_count'] = $delivered_count;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/ftpreports',$this->_data);
		$this->load->view('/includes/footer');
	}

	
	//view reports
	public function viewReport()
	{
		$this->_data['page_title'] = "View DLR Report";
		$mobile_no = $this->input->post('mobile_no');
		$campaign_id = $this->uri->segment(4);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$campaign_details_rs =  $this->ftp_campaign_model->get_ftp_campaign_details($campaign_id,$this->_userId); 
			if($campaign_details_rs) {

				foreach($campaign_details_rs as $campaign){
					if($campaign->is_scheduled == 1) {  
						$campaign_ondate = $campaign->scheduled_on;
					} else {
						$campaign_ondate = $campaign->created_date_time;
					}       
				}

				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate); 
 
				$total_rows =  $this->ftp_campaign_model->getTotalNumbersCount($campaign_id, $days_diff, $campaign_ondate);

				$off_set = $this->uri->segment(5);
				$limit = 25;
 
				$dlr_report_old = $this->ftp_campaign_model->getFTPCampaignNumbers($campaign_id, $mobile_no, $days_diff, $campaign_ondate, $off_set, $limit);
 
				 $dlr_report = $this->ftp_campaign_model->get_ftp_campaign_count($campaign_id, $days_diff, $campaign_ondate);    
 
 
   
				$this->load->library('pagination');
				$config['base_url'] = site_url().'ftpcampaign/viewReport/campaign/'.$campaign_id.'/';
				$config['full_tag_open'] = "<div><ul class='pagination'>";

				$config['full_tag_open'] = "<div><ul class='pagination'>";
				$config['full_tag_close'] ="</ul></div>";

				$config['num_tag_open'] = '<li class="page">';
				$config['num_tag_close'] = '</li>';

				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';

				$config['next_link'] = 'Next →';
				$config['next_tag_open'] = '<li class="next page">';
				$config['next_tag_close'] = '</li>';

				$config['prev_link'] = '← Previous';
				$config['prev_tag_open'] = '<li class="prev page">';
				$config['prev_tag_close'] = '</li>';

				$config['first_link'] = '« First';
				$config['first_tag_open'] = '<li class="prev page">';
				$config['first_tag_close'] = '</li>';

				$config['last_link'] = 'Last »';
				$config['last_tag_open'] = '<li class="next page">';
				$config['last_tag_close'] = '</li>';

				$config['total_rows'] = $total_rows;  
				$config['per_page'] = $limit;
				$config['uri_segment'] = 5;
				$this->pagination->initialize($config); 
					
				$this->_data['_userId'] = $this->_userId;
				$this->_data['detailed_dlr_report'] = $this->_detailed_dlr_report;
				$this->_data['offset'] = $off_set;
				$this->_data['campaign_id'] = $campaign_id;
				$this->_data['dlr_report'] = $dlr_report;
				$this->_data['dlr_report_old'] = $dlr_report_old;
				$this->_data['dlr_report_type'] = $this->_dlr_report_type;

				$this->load->view('includes/header',$this->_data);
				$this->load->view('includes/leftmenu');
				$this->load->view('campaign/ftp_dlr_report');
				$this->load->view('/includes/footer');
			}
		}
  
	}

	//days difference
	private function daysDifference($date1, $date2)
	{
		$month1 = substr($date1,5,2);  
		$day1 = substr($date1,8,2);
		$year1 = substr($date1,0,4);

		$month2 = substr($date2,5,2);
		$day2 = substr($date2,8,2);
		$year2 = substr($date2,0,4);

		$date1 = mktime(0,0,0,$month1,$day1,$year1);
		$date2 = mktime(0,0,0,$month2,$day2,$year2);

		if($date1 > $date2){
			$dateDiff = $date1 - $date2;
		} else {
			$dateDiff = $date2 - $date1;
		}
		return $fullDays = floor($dateDiff/(60*60*24));
	}
	
	/*
	
	public function download_dlr_report()
	{
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->ftp_campaign_model->get_ftp_campaign_details($campaign_id,$this->_userId);
			if($rs) {
				$string = '';
				foreach($rs as $val) {
					$string .= "SenderName: ".$val->sender_id."\n";
					$string .= "Message: ". $val->sms_text."\n";
					
					if($val->is_scheduled == 1) {
						$campaign_ondate = $val->scheduled_on;
					} else {
						$campaign_ondate = $val->created_date_time;
					}
					$campaign_type = $val->campaign_type;
				}

				$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
				if(in_array($this->_userId,$specialusermask) ){  
					$string .= "AccountNumber \t\n";
				}else{
					$string .= "AccountNumber,SentOn,Status\n";
				}
  
				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);
				//get_ftp_campaign_count
				$campaign_numbers = $this->ftp_campaign_model->get_ftp_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);
 
				foreach ($campaign_numbers as $row) {
					if($campaign_type == 2) {
						$to_m = substr($row->to_mobile_no,0,6)."XX".substr($row->to_mobile_no,8,2);
					} else {

						$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
						if(in_array($this->_userId,$specialusermask) )
						{
							$to_m = substr($row->to_mobile_no,0,5)."XXXXX".substr($row->to_mobile_no,8,0);

	  					}
						else
						{
							$to_m = $row->to_mobile_no;
							
						}
					}  
					
					$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
					if(in_array($this->_userId,$specialusermask) ){
						$string .= $row->acccount_num.",";
						//$string .= $to_m.","; 
					}else{
						$string .= $row->acccount_num.",".$row->sent_on.",";
						//$string .= $to_m.",".$row->sent_on.",";
					}

					if(strlen($row->to_mobile_no) < 10){
						$string .= "Invalid Number";
					} elseif($row->dlr_status == 1){
						$string .= $row->error_text;
					}
					elseif($row->dlr_status == "" || $row->dlr_status == 0)
					{
						$string .= "Pending DLR";
					}
					elseif($row->dlr_status == 16)
					{
						
						$string .=$row->error_text;



					} elseif(($row->dlr_status != 0) && $row->dlr_status == 3){
						$string .= $row->error_text;
					} elseif($row->dlr_status == 2){
						if($row->dlr_status == 2){
							$string .= "Failed - " . $row->error_text;
						} elseif($row->dlr_status == 4){
							$string .= "Queued at SMSC - " . $row->error_text;
						}
					} else {
						$string = $row->error_text;
					}



  
					$string .= "\n";
				}

				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=SMSReport_".$campaign_id.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");  
				echo $string;
				exit;  
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('/includes/footer');


	}*/

	
	public function downloadDlrReport_new()
	{
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->ftp_campaign_model->get_ftp_campaign_details($campaign_id,$this->_userId);
			if($rs) {
				$string = '';
				$error_text= '';
				foreach($rs as $val)
				{
					$sender_name=$val->sender_id;
					$msglength=strlen($val->sms_text);
					$message_=$val->sms_text;
					$campaign_name_=$val->campaign_name;
						
						
					$chargedcredits=0;
					// calculate SMS length
					if(strlen($msglength)>160)
					$sms_length_tmp=ceil(strlen($msglength)/153);
					else
					$sms_length_tmp=ceil(strlen($msglength)/160);
						
					$temp_len=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
					//$temp_len=$msglength/160;
					if($temp_len<=1)
					$chargedcredits=1;
					else if($temp_len<=2)
					$chargedcredits=2;
					else if($temp_len<=3)
					$chargedcredits=3;
					else if($temp_len<=4)
					$chargedcredits=4;
					else if($temp_len<=5)
					$chargedcredits=5;
					else if($temp_len<=6)
					$chargedcredits=6;
					else if($temp_len<=7)
					$chargedcredits=7;
					else if($temp_len<=8)
					$chargedcredits=8;
					else if($temp_len<=9)
					$chargedcredits=9;
					else if($temp_len<=10)
					$chargedcredits=10;
						
						
						
					$string .= "Sender Name: ".$sender_name."\n";
					$string .= "Message: ". $message_."\n";
					$string .= "Message Length : ". $msglength."\n";
						
						
						
					if($val->is_scheduled == 1)
					{
						$campaign_ondate = $val->scheduled_on;
					} else {
						$campaign_ondate = $val->created_date_time;
					}
					$campaign_type = $val->campaign_type;
					$campaign_id = $val->campaign_id;
				}
				$string .= "Sl.No\tMSG ID\tCampaign Name\tSender Name\tMobile No\tSent Time\tLast Updated\tAcknowledgment\tMessage Text\tSMS Length\tCredits Charged\tProvider\tLocation\n";

				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);

				$campaign_numbers = $this->ftp_campaign_model->get_ftp_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);  
				$rowId=1;    
				foreach ($campaign_numbers as $row) {
					$to_mobile_number=$row->to_mobile_no;
					if($campaign_type == 2) 
					{	
						$to_m = $row->acccount_num;
						//$to_m = substr($to_mobile_number,0,6)."XX".substr($row->to_mobile_no,8,2);
					} else {
						//$to_m = $to_mobile_number;
						$to_m = $row->acccount_num;
					}
					$to_mobile_number_4=substr($to_mobile_number, 0, 4);
						
					$operator_areadetails_rs = $this->Campaign_model->get_operator_areadetails($to_mobile_number_4);
					$operator_name="N/A";
					$service_area="N/A";
						
					foreach ($operator_areadetails_rs as $row1)
					{
						$operator_name=$row1->Network_Operator_Name;
						$service_area=$row1->Service_Areas;
					}
					if(strlen($row->to_mobile_no) < 10){
						$error_text = "Invalid Number";
					} elseif($row->dlr_status == "" || $row->dlr_status == 0 || $row->dlr_status == 1){
						$error_text = "Delivered";
					} elseif($row->dlr_status == 16){
						$error_text = "Invalid Number";
					} else {  
						if($this->_dlr_report_type == 0){
							$error_text = "Delivered";
						} elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
							$error_text = "DND Number";
						} elseif($this->_dlr_report_type == 2){
							if($row->dlr_status == 2){
								$error_text = "Failed - " . $row->error_text;
							} elseif($row->dlr_status == 4){
								$error_text = "Queued at SMSC - " . $row->error_text;
							}
						} else {
							$error_text = $row->error_text;  
						}
					}
					$string .= $rowId++."\t".$campaign_id."\t".$campaign_name_."\t".$sender_name."\t".$to_m."\t".$row->sent_on."\t".$row->delivered_on."\t".$error_text."\t".$message_."\t".$msglength."\t".$chargedcredits."\t".$operator_name."\t".$service_area;
					$string .= "\n";
				}  

				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=SMSReport_".$campaign_id.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
				echo $string;
				exit;
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu');
		$this->load->view('cancel_campaign');
		$this->load->view('/includes/footer');
	}
	
	
	public function viewcampaignssearch()
	{
		//$this->output->enable_profiler(TRUE);
		session_start();
		$this->load->model('Campaign_model');
		$this->load->library('pagination');
		 
		$config["base_url"] = base_url() . "ftpcampaign/viewcampaignssearch";
		//$config["per_page"] = 10;
		//$config["uri_segment"] = 3;

		$off_set = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//if($this->uri->segment(3)))

		$off_set = $this->uri->segment(3);

		$limit =10;

		$sender_name = $this->input->post('sender');

		$rangeA = $this->input->post('rangeA');


		if($this->uri->segment(3) == "deleted") {
			$this->_data['deleted'] = "Campaign Has been Deleted";
		}

		$this->_data['page_title'] = "SMS Campaign Reports";

		$this->load->model('Campaign_model');


		$sender = array();

		if($this->_userType){
			$senderNames = $this->Campaign_model->getSenderNames($this->_userId);
			$sender[''] = '--All--';
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}
		$this->_data['sender_names'] = $sender;
		$this->_data['user_type'] = $this->_userType;// promo or trans
		$this->_data['userid'] = $this->_userId;
		$delivered_count = 0;
		if($this->input->post('submit'))
		{
			$from_date=null;
			$to_date=null;
		 $sn='';
		 $fd='';
		 $td='';
		 $sender_name = $this->input->post('sender');
		 if(@$rangeA){
		 	$split = explode("-",$rangeA);

		 	@$from_date = $split[0].'-'.$split[1].'-'.$split[2];
		 	@$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		 }
		 if(empty($from_date) && empty($to_date) && empty($sender_name) )
		 {
		 	$this->session->unset_userdata($sn);
		 	$this->session->unset_userdata($fd);
		 	$this->session->unset_userdata($td);
		 }
		 $_SESSION['from_date'] =  $from_date;
		 $_SESSION['sender_name'] = $sender_name;
		 $_SESSION['to_date'] =  $to_date;

		 @$sn = $_SESSION['sender_name'];
		 @$fd = $_SESSION['from_date'];
		 @$td = $_SESSION['to_date'];
		}
		else
		{
			$campaigns_report = $this->ftp_campaign_model->get_ftp_campaigns_report_default($this->_userId);
			$total_campaigns = $this->ftp_campaign_model->get_ftp_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date=null,$to_date=null);
			$campaigns_data = $this->ftp_campaign_model->getAllFTPCampaigns1($this->_userId,$sender_name,$from_date=null,$to_date=null,$off_set,$limit);
		}
		@$fd = $_SESSION['from_date'];
		@$td = $_SESSION['to_date'];
		@$sn = $_SESSION['sender_name'];  

		$campaigns_data = $this->ftp_campaign_model->getAllFtpCampaignsSearchValues( $limit, $off_set, $this->_userId, $sn, $fd, $td);

		$campaigns_report = $this->ftp_campaign_model->get_aftersearch_ftp_campaigns_report($this->_userId, $sn, $fd, $td);
		//print_r($campaigns_report);
  
		$total_campaigns = $this->ftp_campaign_model->get_ftp_campaigns_count1($this->_userId,$sn,$status_=null,$fd,$td);

		$config["total_rows"] =  $total_campaigns;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		//$config['use_page_numbers'] = TRUE;
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
		$errorTextArray = array();
		$this->_data['campaigns_report'] = $campaigns_report;
		$totalmsg=0;
		$exprd=0;
		$dlrd=0;
		$dnds=0;
		$pndng=0;
		$invald=0;
		foreach($campaigns_report as $campaignreport)
		{
			$totalmsg=$campaignreport['totalmsg'];
			$exprd=$campaignreport['exprd'];
			$dlrd=$campaignreport['dlrd'];
			$dnds=$campaignreport['dnds'];
			$pndng=$campaignreport['pndng'];
			$invald=$campaignreport['invald'];
			$processcnt=$campaignreport['processcnt'];
		}
		$this->_data['processcnt'] = $processcnt;
		$this->_data['totalmsg'] = $totalmsg;
		$this->_data['exprd'] = $exprd;
		$this->_data['dlrd'] = $dlrd;
		$this->_data['dnds'] = $dnds;
		$this->_data['pndng'] = $pndng;
		$this->_data['invald'] = $invald;
		$this->_data['campaigns'] = $campaigns_data;
		//print_r($campaigns_data);  
		$this->_data['search_result_rs'] ="";
		$this->_data['errorTextArray'] = "";
		$this->_data['rangeA'] = "";
		$this->_data['search'] = "";
		$this->_data['delivered_count'] = $delivered_count;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//$this->load->view('campaign/reports',$this->_data);
		$this->load->view('campaign/ftpcampaign_searchtest',$this->_data);
		$this->load->view('/includes/footer');

	}
	
	public function misreports()
	{
		session_start();
		$rangeA = $this->input->post('rangeA');

		$from_date  = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
	        $to_date  = date('Y-m-d');
		if(strlen($rangeA)>0)  
		{
			$split = explode("-",$rangeA);
			$from_date = $split[0].'-'.$split[1].'-'.$split[2];
			$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		}
			
		$this->load->model('ftp_campaign_model');
		$data['users'] = $this->ftp_campaign_model->get_all_users($this->_userId);

		if($this->input->post('submit_search'))
		{
			if($this->input->post('username') == "")
			{
				$user_id = $this->_userId;
			}
			else
			{
				$user_id = $this->input->post('username');
			}
 
			$from_date =  $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$newdata = array(
		           'rangeA'  => $rangeA,  
		           'from_date'  => $from_date,
		           'to_date'  => $to_date,
		           'agent_id' => $this->input->post('username')
			);
			$this->session->set_userdata($newdata);
				
			$from_date = $this->session->userdata('from_date');  
		  	$to_date = $this->session->userdata('to_date');	
		 

			$data['result'] = $this->ftp_campaign_model->get_all_smsreports($user_id,$from_date,$to_date);
 
		}
		else
		{
			$data['result'] = $this->ftp_campaign_model->get_all_smsreports($this->_userId,$from_date,$to_date);
 
		}
   
		if($this->input->post('submit_reset'))
		{
			$this->session->unset_userdata('rangeA');
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');
			$this->session->unset_userdata('agent_id');
		}  
		$this->_data['to_date']  =   $to_date;	 $this->_data['from_date'] =  $from_date;
		if($this->input->post('submit_download'))
		{
			if($this->session->userdata('agent_id') != "")
			{
				$user_id=$this->session->userdata('agent_id');
			}
			else
			{
				$user_id=$this->_userId;
			}
			$from_date = $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');



	$result1 = $this->ftp_campaign_model->get_usersms_download($user_id,$from_date,$to_date);
				
//	print_r($result1);exit;
			//Array ( [0] => ,,,,,2917,,0 [1] => 5,1,0,0,0,2917,2017-03-02 10:57:58,6 )	
			$getreports=array();
			foreach($result1 as $key=>$dlrreportcount)
			{
				//echo $dlrreportcount;

				$arr1=explode(',',$dlrreportcount);
					
				//print_r($arr1);exit;
				$Delivered=$arr1[0];
				$DND=$arr1[1];
				$Expired=$arr1[2];
				$Pending=$arr1[3];
				$invalid=$arr1[4];
				$getuserid=$arr1[5];
				$created_date=$arr1[6];
				$total=$arr1[7];
				$rs=$this->ftp_campaign_model->get_username_download($getuserid);
				$username=$rs[0]->username;
					
				$dlr=array("Date"=>$created_date,"UserName"=>$username,"Delivered"=>$Delivered,"DND"=>$DND,"Failed"=>$Expired,"Pending"=>$Pending,"Invalid"=>$invalid,"Total"=>$total);
				$getreports[]=$dlr;
					
			}
				
			//print_r($getreports);
				
			
			$fileName = 'Ftp_Misreport.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($getreports  as $key => $value) {
				if ( !$headerDisplayed ) {
					fputcsv($fh, array_keys($value));
					$headerDisplayed = true;
				}
				fputcsv($fh, $value);
			}  
			fclose($fh);
			exit;
		}  
  
			$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/ftpmisreports',$data);
		$this->load->view('includes/footer');
	}

	public function download_dlr_report()
	{
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->ftp_campaign_model->get_ftp_campaign_details($campaign_id,$this->_userId);
			if($rs) {
				$string = '';
				foreach($rs as $val) {
					$string .= "SenderName: ".$val->sender_id."\n";
					$string .= "Message: ". $val->sms_text."\n";
					
					if($val->is_scheduled == 1) {
						$campaign_ondate = $val->scheduled_on;
					} else {
						$campaign_ondate = $val->created_date_time;
					}
					$campaign_type = $val->campaign_type;
				}

				$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
				if(in_array($this->_userId,$specialusermask) ){  
					$string .= "AccountNumber \t\n";
				}else{
					$string .= "AccountNumber,SMSText,SMSLength,SentOn,Status\n";
				}
  
				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);
				//get_ftp_campaign_count
				$campaign_numbers = $this->ftp_campaign_model->get_ftp_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);
 
				foreach ($campaign_numbers as $row) {
					if($campaign_type == 2) {
						$to_m = substr($row->to_mobile_no,0,6)."XX".substr($row->to_mobile_no,8,2);
					} else {

						$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
						if(in_array($this->_userId,$specialusermask) )
						{
							$to_m = substr($row->to_mobile_no,0,5)."XXXXX".substr($row->to_mobile_no,8,0);

	  					}
						else
						{
							$to_m = $row->to_mobile_no;
							
						}
					}  
					
					$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
					if(in_array($this->_userId,$specialusermask) ){
						$string .= $row->acccount_num.",";
						//$string .= $to_m.","; 
					}else{
						$string .= $row->acccount_num.",".$row->sms_text.",".$row->sms_count.",".$row->sent_on.",";
						//$string .= $to_m.",".$row->sent_on.",";
					}

					if(strlen($row->to_mobile_no) < 10){
						$string .= "Invalid Number";
					} elseif($row->dlr_status == 1){
						$string .= $row->error_text;
					}
					elseif($row->dlr_status == "" || $row->dlr_status == 0)
					{
						$string .= "Pending DLR";
					}
					elseif($row->dlr_status == 16)
					{
						
						$string .=$row->error_text;



					} elseif(($row->dlr_status != 0) && $row->dlr_status == 3){
						$string .= $row->error_text;
					} elseif($row->dlr_status == 2){
						if($row->dlr_status == 2){
							$string .= "Failed - " . $row->error_text;
						} elseif($row->dlr_status == 4){
							$string .= "Queued at SMSC - " . $row->error_text;
						}
					} else {
						$string = $row->error_text;
					}



  
					$string .= "\n";
				}

				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=SMSReport_".$campaign_id.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");  
				echo $string;
				exit;  
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('/includes/footer');


	}

}
?>
