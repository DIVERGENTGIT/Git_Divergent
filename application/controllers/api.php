<?php
Class API extends CI_Controller
{
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

        $this->load->model('User_model');
        $userInfo = $this->User_model->getUserDetails($this->_userId);
        $this->_credits = $userInfo[0]->available_credits;
$this->_data['shorturlCredits'] =  $userInfo[0]->shorturl_credits;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
        $this->_userType = $userInfo[0]->no_ndnc;
        $this->_template_check = $userInfo[0]->template_check;
        $this->_dlr_report_type = $userInfo[0]->dlr_enabled;
        $this->_data['available_credits'] = $this->_credits;
	}
	
	public function index()
	{
		$this->_data['page_title'] = "Bulk SMS API";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('api/sms-api');
		$this->load->view('includes/footer');
	}
	// long code API View
	public function apiview()
	{
		$this->_data['viewapireport'] = 'View API Reports';
		$ondate = $this->uri->segment(3);
		$curdate = date('Y-m-d');
            $days_diff = $this->daysDifference($curdate, $ondate);
			$this->load->model('Campaign_model');
			$apireportview = $this->Campaign_model->get_sms_api_details($ondate,$this->_userId,$days_diff);

			
			$this->_data['apireportview'] = $apireportview;
		
		
		
		$this->load->view('includes/header_longcode',$this->_data);
		$this->load->view('includes/leftmenu_longcode');
			$this->load->view('missedcall/viewapireport_longcode');
		$this->load->view('/includes/footer');
	}
	
	public function apiviewreport()
	{
		$this->_data['viewapireport'] = 'View API Reports';
		$ondate = $this->uri->segment(3);
		$curdate = date('Y-m-d');
            $days_diff = $this->daysDifference($curdate, $ondate);
			$this->load->model('Campaign_model');
			$apireportview = $this->Campaign_model->get_sms_api_details($ondate,$this->_userId,$days_diff);
$this->_data['dlr_report_type']=$this->_dlr_report_type;
			
			
		$this->_data['apireportview'] = $apireportview;
		 $campaignapidate = $this->uri->segment(3);
		/*********  mobile number search ******************/
       if($this->input->post('to_mobileno')){
          $mobileno=$this->input->post('to_mobileno');
        $apimobilenosearch=$this->Campaign_model->get_sms_api_mobileno_search($campaignapidate,$this->_userId,$days_diff,$mobileno);
          $this->_data['seacrh_mobileno'] = $apimobilenosearch;

        } 
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('api/viewapireport');
		$this->load->view('includes/footer');
	}
	
	public function reports()
	{
		error_reporting(0);
		$this->_data['page_title'] = "SMS API Reports";
		
		/*$curdate = date('Y-m-d');
		$ondate = $this->uri->segment(3);
        $days_diff = $this->daysDifference($curdate, $ondate);*/
		

/*	 $rangeA = $this->input->post('rangeA');

		$split = explode("-",$rangeA);
	  $from_date = $split[0].'-'.$split[1].'-'.$split[2];
 $to_date = $split[3].'-'.$split[4].'-'.$split[5];

		$this->_data['to_date'] = $to_date;
		$this->_data['from_date'] = $from_date;*/
		
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
		$config['base_url'] = site_url().'/api/reports';
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
		
		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('api/api_reports.php');
		$this->load->view('includes/footer');
	}
	
	public function download_report()
	{
		$ondate = $this->uri->segment(3);
		//header("Content-type: application/octet-stream");
		//header("Content-Disposition: attachment; filename=SMSAPIReport_".$ondate.".txt");
		//header("Pragma: no-cache");
		//header("Expires: 0");
		if($ondate) {
            $curdate = date('Y-m-d');
            $days_diff = $this->daysDifference($curdate, $ondate);
			$this->load->model('Campaign_model');
			$rs = $this->Campaign_model->get_sms_api_details($ondate,$this->_userId,$days_diff);
			if($rs) {
				$string = '';
				$string .= "DateTime\tTo Mobile No\tNo.of SMS\tSender Name\tMessage\n";
				//print_r($rs);
				//exit;
				foreach ($rs as $row) {
					$string .= $row->ondate."\t".$row->to_mobileno."\t".$row->noofmessages."\t".$row->sender_name."\t".$row->message."\t";

                     if(strlen($row->to_mobileno) < 10){
                        $string .= "Invalid Number";
                    } elseif($row->dlr_status == 1){
                        $string .= "Delivered";
                    } elseif($row->dlr_status == "" || $row->dlr_status == 0){
                        $string .= "Pending DLR";
                    }elseif($row->dlr_status == 16){
                        $string .= $row->error_text;
                    } elseif($row->dlr_status == 12){
                        $string .= "Not a valid Sender Name";		
                    } elseif($row->dlr_status == 13){
                        $string .= "Not a valid Template";
                        	
					
					}elseif($row->dlr_status == 2){
                                $string .= "Failed - " . $row->error_text;
                            } elseif($row->dlr_status == 4){
                                $string .= "Queued at SMSC - " . $row->error_text;
                            } else {
                        if($this->_dlr_report_type == 0){
                            $string .= "Delivered";
                        } elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
                            $string .= "DND Number";
                        } elseif($this->_dlr_report_type == 2){
                            if($row->dlr_status == 2){
                                $string .= "Failed - " . $row->error_text;
                            } elseif($row->dlr_status == 4){
                                $string .= "Queued at SMSC - " . $row->error_text;
                            }
                        } else {
                            $string .= "Delivered";
                        }
                    }
					$string .= "\n";
				} 
				//echo $string;
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=SMSAPIReport_".$ondate.".xls");
				header("Pragma: no-cache");
				header("Expires: 0"); 
				echo $string;
				exit;
				
				//exit;
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('cancel_campaign');
		$this->load->view('/includes/footer');
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
	
}	
