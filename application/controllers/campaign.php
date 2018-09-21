<?php
Class campaign extends CI_Controller
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
	protected $_smsPrice;


	public function __construct()
	{
		parent::__construct();    
		   
 		$this->load->library('session');
		$this->output->clear_all_cache(); //This method returns NULL

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

		// ADDED ON 2017-02-14
		$this->_shorturlCredits = $userInfo[0]->shorturl_credits;
		$this->_data['shorturlCredits'] = $userInfo[0]->shorturl_credits;
		$this->_userType = $userInfo[0]->no_ndnc; 
		 $this->_data['isftpuser'] = $userInfo[0]->is_ftp;
		$this->_template_check = $userInfo[0]->template_check;
		$this->_dlr_report_type = $userInfo[0]->dlr_enabled;
		$this->_data['available_credits'] = $this->_credits;   
		$this->_data['user_id']=$this->_userId;
		$this->_dndCheck = $userInfo[0]->dnd_check;
		$this->_detailed_dlr_report = $userInfo[0]->detailed_dlr_report;
		$this->_International = $userInfo[0]->International;
		$this->_AllowedCountry = $userInfo[0]->AllowedCountry;
		
		//ADDED ON 2017-01-23       
		$this->_smsPrice = $userInfo[0]->sms_price;  
		$real_url=$this->data =$this->config->item('host_api_url1');
		$this->_data['kernalIp'] = $kernalIp=$this->config->item('kernalIp');
	 	$this->_data['UrlGenIp'] = $UrlGenIp = $this->config->item('UrlGenIp');
	
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
		
		$this->load->model('codes_model');
		
		$this->_data['user_id'] =  $this->_userId = $this->session->userdata('user_id');

		$off_set = 0;
		if($this->uri->segment(3)) {
			$off_set = $this->uri->segment(3);
		}

		$limit = 50;


		if(!empty($from_date) && !empty($to_date))
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
		$config['base_url'] = site_url().'campaign/messages';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['use_page_numbers']  = TRUE;

		$this->pagination->initialize($config);



			
		$this->_data['rangeA'] = "";
		$this->_data['mobile_no'] = "";
		$this->_data['from_date'] = $from_date;
		$this->_data['to_date'] = $to_date;

		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/messages');
		$this->load->view('/includes/footer');
	}


	public function missedcall()
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
		$config['base_url'] = site_url().'campaign/missedcall';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['use_page_numbers']  = TRUE;
		$this->pagination->initialize($config);



			
		$this->_data['rangeA'] = "";
		$this->_data['mobile_no'] = "";
		$this->_data['from_date'] = $from_date;
		$this->_data['to_date'] = $to_date;



		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/missedcall');
		$this->load->view('/includes/footer');
	}

	public function index()
	{
		$this->_data['page_title'] = "User Dashboard";
		/*$this->load->view('includes/header',$this->_data);
		$this->load->view('campaign/my-contacts');
		$this->load->view('includes/footer');*/
		redirect('error');
	}

	// ajax load for group in normal-sms

	public function contact_list_ajax()
	{
			
		$this->load->model('Contact_model');


		@$group_id=$_REQUEST['group_ids'];
		$this->_data['groups'] = $group_id;

		//$contactdetails = $this->Contact_model->contact_view_ajax($this->_userId,$group_id);

		$contactdetails = $this->Contact_model->getGroupContacts_ajax($this->_userId,$group_id);

		$this->_data['contactdetails'] = $contactdetails;


		$this->load->view('campaign/contact_list_ajax_normal',$this->_data);

	}



	public function contact_list_ajax2()
	{
			
		$this->load->model('Contact_model');


		$group_id=$_REQUEST['group_ids'];
		$this->_data['groups'] = $group_id;


		$contactdetails = $this->Contact_model->getGroupContacts_ajax($this->_userId,$group_id);

		$this->_data['contactdetails'] = $contactdetails;
		//print_r($this->_data['contactdetails']);exit;

		$this->load->view('campaign/contact_list_ajax',$this->_data);

	}
	//////////// DND Check //////////////

	public function dndregistrationheck()
	{
		$dnd_chk_number = trim($this->input->post('dnd_chk_number'));

		$dnd_chk_res = "";

		if($dnd_chk_number == "")
		{
			$dnd_chk_res ="<span class='error'> Please Enter Number.</span>";
		}
		else
		{
				
				
			$this->load->model('Campaign_model');
			$isDND = $this->Campaign_model->checkIsDND($dnd_chk_number);
			//$avail_dnd = array("040110011", "040111111");
				
			if ($isDND) {
				$dnd_chk_res ="<span class='success'> $dnd_chk_number Registered.</span>";
			}
			else
			{
				$dnd_chk_res ="<span class='error'> $dnd_chk_number UnRegistered.</span>";
			}
		}

		echo $dnd_chk_res;
	}

	//////////// DND Check  END//////////////


	 
 
	 
 
	public function fileSMS()
	{
		if($this->session->userdata('user_id') ==  5742  || $this->session->userdata('user_id') ==  5741  || $this->session->userdata('user_id') ==  5740 || $this->session->userdata('user_id') ==  5739 )   {
			  redirect(base_url().'campaign/viewcampaigns');   
		}
		$this->_data['page_title'] = "File SMS";
		$this->session->unset_userdata('selected_sms_type');
		$this->session->unset_userdata('from_date');
		$this->session->unset_userdata('to_date');
		 if ($this->input->post('sendsms')) {
 
			$this->load->library('form_validation');
				//print_r($this->input->post());exit;
			if ($this->form_validation->run('file_sms_form') == TRUE) {


				$this->_data['validatationtrue'] ="1";
				$campaign_name = $this->input->post('campaign_name');
				$sms_text = $this->input->post('sms_text');
				$sender = $this->input->post('sender');
				//$is_schedule = $this->input->post('schedule');
				$scheduled_date = $this->input->post('on_date');
				$sms_type = $this->input->post('sms_type');
				$remove_duplictes = $this->input->post('remove_duplictes');
				$sms_text = trim($sms_text);
				//ADDED ON 2017-01-23
				
				$shorturl_input=$this->input->post('shorturl_input');
				$shorturl_text=$this->input->post('shorturl_text');
				//  print_r($this->input->post());exit;
  				$this->_data['error'] = '';$this->_data['no_balance']='';$this->_data['file'] ='';
				$error = false;  
				$error_msg = "";
				//validating the scheduled date, if it is scheduled
				$is_schedule = '0';		
				if($scheduled_date != NULL) { $is_schedule = 1; };
				if($is_schedule) {
					if(!$scheduled_date) {
						$error = true;
						$this->_data['error'] = $error_msg .= "Please enter schedule date";
					}
						
					$current_date_t = date_create(date("Y-m-d H:i:s"));
					$scheduled_date_t = date_create($scheduled_date);

					if( $current_date_t > $scheduled_date_t )
					{
						$error = true;
						$this->_data['error'] = $error_msg .= "Please enter valid schedule date";
					}
				}

				//if client type is transactional, check for template if not dynamic
				if($this->_userType == 1 && $this->_template_check){
					//check for templates
					$temp_check = $this->_templateCheck($sms_text);
					if(!$temp_check){
						$error = true;
						$this->_data['error'] = $error_msg .= "SMS Text not matching with Approved Templates";
					}
				}
 

				if($this->_userType != 1 || $this->_dndCheck == 1 )
				{
 
					 if($is_schedule) {
					  	$time =  date('H', strtotime($scheduled_date)); 
 
						if($time < 9 || $time >= 21)
						{

   								$error = true;
								$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm.";				
       
						}   
					 }else{ 
						$time = date('H');
 
						if($time < 9 || $time >= 21)
						{ 
								$error = true;
								$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm."; 
  							 
						} 

					}  
				}  
				if($error) {
					$this->_data['error'] = $error_msg;
 
				} else { 
					
					$config['upload_path'] = 'uploads/';
					$file_name = uniqid('vs_'); 
					$config['file_name'] = $file_name;  
					$config['allowed_types'] = 'xls|xlsx';
					$config['overwrite'] = true;
					$this->load->library('upload', $config); 
					if ($this->upload->do_upload()) {
						$file = $this->upload->data();   
						$file_type = $file['file_ext'];
						$fileName = explode('.',$file['file_name']);
						if($fileName[0]) {
							$csvFileName = $fileName[0].'.csv';
							if(file_exists($csvFileName)) {
						 		unlink($csvFileName); 
					        	}  
						}
						$file_name = 'uploads/'.$file['file_name'];
						
 						$test = shell_exec("sudo /bin/ls /var/www/html/strikerapp/$file_name | xargs sudo /usr/bin/unoconv -f csv 2>&1");
						$fileCsvPath = '';
						if($fileName[0]) {
							$fileCsvPath = 'uploads/'.$fileName[0].'.csv';
						}
 						$size = intval(shell_exec("wc -l $fileCsvPath"));

						  
						/*if(strlen($sms_text)>160)
						$sms_length_tmp=ceil(strlen($sms_text)/153);
						else
						$sms_length_tmp=ceil(strlen($sms_text)/160);

						$sms_length=$sms_length_tmp;  */
						
						$sms_text = trim($sms_text);    
						$splMessage = strtolower($sms_text);
						$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');
						
						$sms_text_spl = str_replace($special_char, ' ', $splMessage);
						$special_char_2 = array('{','}','[',']','^','|','€','~');
						$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);
						//$sms_text_spl2 = trim($sms_text_spl2);		 				 
						if(strlen($sms_text_spl2)>160)
							$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
						else
							$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

						$sms_length=$sms_length_tmp;
						  
						
						
						$totalCount = $size*$sms_length;
						if($totalCount > $this->_credits) {
							$this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$totalCount} credits";
						}else{ 
						 	
					        $originalFile = $file['file_name']; 	
						$activeRows = '';	
						$to_mobileno = array();

						$excelReader = $this->config->item('excelReader');
						$spreadSheet = $this->config->item('spreadSheet'); 
						$this->_data['file'] = FALSE;
						$this->_data['error']  = FALSE;
						require($excelReader);    
						require($spreadSheet);
						try
						{						 	
							 $Spreadsheet = new SpreadsheetReader($file_name); 
	 
							 $isValidFile = $Spreadsheet->valid(); 

							 if($isValidFile == 1) 	{ 
								 $BaseMem = memory_get_usage(); 
								 $Sheets = $Spreadsheet -> Sheets(); 
								// if(!$is_schedule) {    
									 foreach ($Sheets as $Index => $Name) 
									 { 
									    $Spreadsheet -> ChangeSheet($Index); 
									    $j = 1;
									    foreach ($Spreadsheet as $Key => $Row) 
									    { 
 
										if($j == 3) {
											if(!is_numeric($Row[0])) { 
												$this->_data['file'] = 'Uploaded file is not a valid format.';
											}  
										}
										if(count($to_mobileno) == 100) { break;}
										$tmp_number = $Row[0];
										if(is_numeric($tmp_number) && strlen($tmp_number) > 0)  
										{
											$to_mobileno[] =  $tmp_number;
										} 
										  
			   							$j++;
									    }
									    break;     
								    	 }     
								//}   
							}else{ 
								$this->_data['file'] =  'Uploaded file is not in readable format.'; 
							} 
						}catch (Exception $E)
						{
							$this->_data['file'] =  'Uploaded file is not in readable format.'; 
 
						} 	

 					 	if(count($to_mobileno) > 0) {
							// calculate SMS length
							if(strlen($sms_text)>160)
							$sms_length_tmp=ceil(strlen($sms_text)/153);
							else
							$sms_length_tmp=ceil(strlen($sms_text)/160);

							$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
							//$sms_length = ceil(strlen($sms_text)/160);

							/*if($remove_duplictes == 1) {
								$result = array_unique($to_mobileno);
								echo "<script type='text/javascript'>alert('".count($result)." are unique out of ".count($to_mobileno)." Numbers');</script>";
								$to_mobileno = array();
								foreach($result as $row) {
									$to_mobileno[] = trim($row);
								}
							}*/
 
 
							$total_numbers = count($to_mobileno);
							$total_no_of_sms = $total_numbers*$sms_length;
							//added on 21/08/2014 because to prevent the sms push beyond the avai//lable credits
							$userInfo = $this->User_model->getUserDetails($this->_userId);
							$this->_credits = $userInfo[0]->available_credits;
							//checking sms credits exit
							 
								if($total_no_of_sms > $this->_credits) {
									$this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$total_no_of_sms} credits";
								} else { 
	     
								 if(!$this->_data['file'] && !$this->_data['error']) {

							
								$this->_sendFileSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text,$originalFile,$totalCount);
								 //  redirect('campaign/viewcampaigns');
									}
								}//end of sms credits checking
							 }else{
								$this->_data['file'] = 'Not a valid file';	
							 }
						 }  
					} else { // end of upload
 						$this->_data['file'] = $this->upload->display_errors('','');
						if($this->_data['file'] == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.') {
			$this->_data['file'] = 'The uploaded file exceeds the maximum allowed size';
		}
					}      
				}//scheduled date error
			} // end validation
		}

		$sender = array();  
		if($this->_userType){
			$this->load->model('Campaign_model');
			//  $senderNames = $this->Campaign_model->getSenderNames($this->_userId);

			$this->load->model('user_model');
			$senderNames = $this->user_model-> getSenderNames_accept($this->_userId);
			 

			$this->_data['sender_names'] = $senderNames;
  
			$sender[''] = '--select--';
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}
		$this->_data['sender_names'] = $sender;


		// ADDED ON 2017-01-23
		
			$this->_data['did_result_response']=$this->get_misscalleddid_list();		
		
		
		//get added templates
		$this->load->model('Campaign_model');
		$campaigns_data = $this->Campaign_model->getCampaignsLast($this->_userId);
		$this->_data['campaigns'] = $campaigns_data;

		$this->load->model('user_model');
		 $limit = 25;$offset = '0';
		if($this->_template_check==1)
		{
			$templates = $this->user_model->getTemplatesApprove($this->_userId);
			$this->_data['templates'] = $templates;
		}else
		{
			$templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);
			$this->_data['templates'] = $templates;

		}  
		if($this->_userType==0)
		{
			$templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);
			$this->_data['templates'] = $templates;
		}

		if($this->input->post('editsubmit')){

			$template=$this->input->post('edittemp');
			$template_id=$this->input->post('template_id');
			$this->user_model->updated_template($this->_userId,$template_id,$template);
			redirect('campaign/normalSMS');

		}

		if($this->input->post('addsubmit')){
			$template=$this->input->post('addtemp');
			$this->user_model->addTemplate($this->_userId,$template);
			redirect('campaign/normalSMS');
		}
		if($this->uri->segment(3) == "del")
		{
			$template_id=$this->uri->segment(4);
			$this->user_model->delete_template($this->_userId, $template_id);
			redirect('campaign/normalSMS');
		}
		if($this->uri->segment(3) == "notvalid")
		{
 			$this->_data['error'] = 'Not a valid file data'; 
		}
  
		$this->_data['user_id'] = $this->_userId;
		$this->_data['isInternational'] = $this->_International;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/file_sms');
		$this->load->view('/includes/footer');
	}

 
 

 
	public function newVariableSMS() 
	{
		if($this->session->userdata('user_id') ==  5742  || $this->session->userdata('user_id') ==  5741  || $this->session->userdata('user_id') ==  5740 || $this->session->userdata('user_id') ==  5739 )   {
			  redirect(base_url().'campaign/viewcampaigns');   
		}
		 $IP = $this->_data['kernalIp'];  
		$ViewTemplete="";$original_file = "";
		$file_type = "";$Filepath="";$offset = 0;$message = '';
		$this->session->unset_userdata('selected_sms_type');  
		$this->session->unset_userdata('from_date');
		$this->session->unset_userdata('to_date');
		if($this->input->post('sendsms'))
		{   
			$file_type = $this->input->post('file_type');
 
			$original_file = $this->input->post('uploadedFileName');

			 $Filepath= str_replace(" ","_",$original_file);
  			    
 
		 
			$excelReader = $this->config->item('excelReader');
		$spreadSheet = $this->config->item('spreadSheet'); 

			require($excelReader);  
			require($spreadSheet);
			
			//date_default_timezone_set('UTC');
			$StartMem = memory_get_usage();

			try
			{

				//echo "data dump into an array uploaded_data....."


				$this->load->library('form_validation');
   
				if ($this->form_validation->run('variable_sms_form') == TRUE)
				{


					$this->_data['validatationtrue'] ="1";

					//input variables
					$campaign_name = $this->input->post('campaign_name');
					$sender = $this->input->post('sender');
					$sms_text = $this->input->post('sms_text');
					$from_row = $this->input->post('from_row');
					$to_row = $this->input->post('to_row');
					 $is_schedule = $this->input->post('schedule');
					$scheduled_date = $this->input->post('on_date');
					$sms_type = $this->input->post('sms_type');
					$mobileColumn = $this->input->post('mobile_column'); 
					//ADDED ON 2017-01-30
					$shorturl_input=$this->input->post('shorturl_input');
					$shorturl_text=$this->input->post('shorturl_text');
 					
					//sms type - normal/ Flash SMS
					$mclass = "";  
					if($sms_type==1) {
						$mclass = "&mclass=0";
					}  
					$sms_text = trim($sms_text);
  					$this->_data['error'] = '';
					$this->_data['no_balance'] = '';
					$this->_data['file'] = '';  
					$error = false;
					$error_msg = "";  
					$is_schedule = '0';		
					if($scheduled_date != NULL) { $is_schedule = 1; };
					if($is_schedule) {
						if(!$scheduled_date){
							$error = true;
							$this->_data['error'] = $error_msg .= "Please enter schedule date";
						}
								 
						$current_date_t = date_create(date("Y-m-d H:i:s"));
						$scheduled_date_t = date_create($scheduled_date);

						if( $current_date_t > $scheduled_date_t )
						{
							$error = true;
							$this->_data['error'] = $error_msg .= "Please enter valid schedule date";
						}  
					}

					//if client type is transactional, check for template if not dynamic
					if($this->_userType == 1 && $this->_template_check){
						//check for templates
						$temp_check = $this->_templateCheck($sms_text);
						if(!$temp_check){
							$error = true;
							$this->_data['error'] = $error_msg .= "SMS Text not matching with Approved Templates";
						}  
					}
 

				if($this->_userType != 1 || $this->_dndCheck == 1 )
					{
 
						 if($is_schedule) {
						  	$time =  date('H', strtotime($scheduled_date)); 
	 
							if($time < 9 || $time >= 21)
							{

	   								$error = true;
									$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm.";				
	       
							}   
						 }else{ 
							$time = date('H');
	 
							if($time < 9 || $time >= 21)
							{ 
									$error = true;
									$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm."; 
	  							 
							} 

						}  
					}  
			
					 
					if($error) {
						$this->_data['error'] = $error_msg;
						$ViewTemplete="Y";//if fails
					} else { 
						// ADDED ON 2017-02-08
 
						$fileName = $Filepath;
						$getFileName = explode('.',$fileName);
						if(isset($getFileName[0])) {
							$csvFileName = $getFileName[0].'.csv';
							if(file_exists($csvFileName)) {
						 		unlink($csvFileName); 
					        	}    
						}
						$Filepath = 'uploads/'.$fileName;  
						$test = shell_exec("sudo /bin/ls /var/www/html/strikerapp/$Filepath | xargs sudo /usr/bin/unoconv -f csv 2>&1");
						$fileCsvPath = '';
						if(isset($getFileName[0])) {
							$fileCsvPath = 'uploads/'.$getFileName[0].'.csv';
						}
						$size = intval(shell_exec("wc -l $fileCsvPath"));

						if(strlen($sms_text)>160)
							$sms_length_tmp1=ceil(strlen($sms_text)/153);
						else
							$sms_length_tmp1=ceil(strlen($sms_text)/160);

						$sms_length1=$sms_length_tmp1;
						$totalCount = $size*$sms_length1;
 						//if($totalCount > $this->_credits) {
							// $this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$totalCount} credits";
						//}else{	  					
 							  
						$Spreadsheet = new SpreadsheetReader($Filepath);
						$isValidFile = $Spreadsheet->valid(); 
 						
						if($isValidFile == 1) 	{ 
							$BaseMem = memory_get_usage();
							$Sheets = $Spreadsheet -> Sheets();

							//print_r($Sheets);
							$i=0;$string = "";$uploded_data=array();$k=0;
							$maxrows=0;$maxcols=0;
							$string = '<table class="table table-bordered table-striped  no-footer" width="100%" style=" border: 1px solid #E5E5E5;" cellpadding=0 cellspacing=0>';
							//if(!$is_schedule) {
								foreach ($Sheets as $Index => $Name)
								{
									$Spreadsheet -> ChangeSheet($Index); 
									foreach ($Spreadsheet as $Key => $Row)
									{
		   								$i++; 
										for($j = 0; $j < sizeof($Row); $j++)
										{ 
											if($k > 100) { break;}
										       if(isset($Row[$j])){
										       
						// if(is_numeric($Row[$j]) && strlen($Row[$j]) > 0) {  			 				
					     					 	$uploded_data[$i-1][$j] = $Row[$j];
											} 
											$maxrows++;
										}  $k++; 
									}     
									break;
								} 
							//}  
						}else{   
							$this->_data['error'] =  'Uploaded file is not in readable format.'; 
						} 
     
 
						unset($Spreadsheet); 
						$max_rows=$maxrows; 
 						$maxrows = $max_rows = count($uploded_data); 
						$mobile_no_column = $this->input->post('mobile_column'); 
						$var_positions_msg=explode("#",$sms_text);
						$varpositionscount=count($var_positions_msg);
						$data_array = array();
						$total_no_of_sms = 0;
						$validMobileCount = 0; 
						// ADDED ON 2017-02-08
						if(!$mobile_no_column){$mobile_no_column=0;}
						if(!$sms_text){$sms_text=1;}	
						 
						if($to_row > $maxrows) { $to_row = $maxrows; }
 						if(!$to_row) { $to_row = $maxrows; }
 						$mobileNoCount = 0;
						if(!$from_row){$from_row=1;}  
						
						$message = $sms_text;
						$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');
						$special_char_2 = array('{','}','[',']','^','|','€','~');
						$sms_length = 1;  
						
						//if(!$is_schedule) {    
							$n = 0;  
							for ($i = $from_row-1; $i < $to_row; $i++) {
								  $mobile_no = 0;
								if(isset($uploded_data[$i][$mobile_no_column])) { 
								    $mobile_no = trim($uploded_data[$i][$mobile_no_column]);
								}
  								     
								if(!$this->_data['error']) {  
								 $mobileNoCount++;  
								 if($mobileNoCount > 100) { break;}
								 if(is_numeric($mobile_no) && strlen($mobile_no) > 0 && $mobile_no != 0) {
	  							 	$tmp_number = trim($mobile_no);
	  							 	
	  							 	//Config flag to check only valid numbers
									$isCheckInvalidNum = $this->config->item('checkInvalidNumbers');
									
									//Check valid numbers  
									if($isCheckInvalidNum == 1 && $this->_International == 0) {
										if(strlen($tmp_number) == 10) {
											if( $tmp_number[0] =='6' || $tmp_number[0] =='7' || $tmp_number[0] =='8' ||  $tmp_number[0] =='9' )
										  	{ 
										  		$tmp_number = $tmp_number;
										  	}else{ $tmp_number = 0; } 
										}else{ $tmp_number = 0; }
									}
	  							 	 
	  							 	   
	  							 	 
	  							 	 
	 								if(strlen($tmp_number) > 0)  
									{
										$validMobileCount++;
	 
										$message = "";
										for($j=0;$j<$varpositionscount;$j++) {
											if($j%2 == 1) {
												$colstringValue = $var_positions_msg[$j];
											
												$colIndex = $colstringValue;
												if(isset($colIndex)) {
													if(isset($uploded_data[$i][$colIndex])) {
													$message .= trim($uploded_data[$i][$colIndex]);	
													}  
												}
											} else {
												$message .= $var_positions_msg[$j];
											} 
										}
									
										$splMessage = trim($message); 
										$sms_text_spl = str_replace($special_char, ' ', $splMessage);  
										$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 
				  
										if(strlen($sms_text_spl2)>160)
											$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
										else
											$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

										$sms_length = $sms_length_tmp;
										$total_no_of_sms = $total_no_of_sms + $sms_length;
										$data_array[] = array($mobile_no, $message);
										 
									}
								    }   
 							      } 
							$n++;				 
							}  
						//} 
						
						 
 						if(!$this->_data['error']) {			
							$totalCount = $size*$sms_length; 
  							$deductCustomCredits = $totalCount;  
 
							if($deductCustomCredits > $this->_credits) {
		$this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$deductCustomCredits} credits";

							} else {   


							//if max rows > 1000
							//insert a job into new table
							//send to customer an alert =we are processing you data for campaigning. Please wait sometime and check the status below
							//table of current processing activities. if no error status as SMS processing check at campaign status
							// if error display error and go to re campaign option...
							 
							 
							 
								$configFile = $this->config->item('configFile');
								$functionsFile = $this->config->item('functionsFile');
								include($configFile);
								include($functionsFile);    
							

							
							$_sender = $sender;
							$sms_port = 0;	
							//echo "test inside of condition";
							//sender names
							if($this->_userType == 1){ //loop Transactional SMPP
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
			$portType = "LT1";
		} elseif($this->_userType == 0){            //loop Promo SMPP
			$sender = "0". rand(16066,16075);
			//$sender_name = "LM-" . $sender;
			$sender_name = $sender;
			$portType = "LP1";
 

		} elseif($this->_userType == 2){ //solutions infini transactional
			$portType = "ST1";
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
		} 

		if($this->_userType == 1 && $this->_dndCheck == 1){// semi trans
 
			$sender_name = $sender;
			$portType = "LS1";
			$portTypeNAS = 'NASP1';
		}

							 
							$this->load->model('Campaign_model');

							//echo "test inside of campaign model";
							//get port number based on port type
						
			
			
 
			 
			 			
						
		if($this->_userType == 1){ 					 
			 $isValidSenderName = $this->Campaign_model->checkIsValidSenderName($this->_userId,$sender);
	if($isValidSenderName) {
		 $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}else{
		$sms_port =  $this->Campaign_model->getNASPortNumber($portTypeNAS);
	} 	 
		}else{
	 $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}		
	 
	 
	 
 	
 	
 	

if($this->_userId==4130)
{
$sms_port =0;

}

/*if($this->_userId==250)
{
	$sms_port = 34113;
}*/
 


$senderName_kennel = $sender;
 	if($sms_port > 0) {
 		$sms_portFor = $this->Campaign_model->getFirstPriorityPortType($sms_port);
 		if($sms_portFor == 1) {
 		 	if($this->_userType == 0) {
 				$senderName_kennel = "BA-611128";
 			}else{
 				$senderName_kennel = "BA-".$sender;
 			} 
 		}
 	}
 	
 	

							$sms_type = 4;
							if($shorturl_input != NULL) {
					 			$findString1 = 'ion.bz/';
								$pos1 = stripos($message, $findString1); 
								if($pos1 === false) {
									$shorturl_input = '';$shorturl_text= '';
								}
					   
							}   
							if($is_schedule) {
								$total_no_of_sms = 0;$validMobileCount=0;
							} 
							 $campaign_id = $this->Campaign_model->createCustomizedCampaign($this->_userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input,$validMobileCount,$sms_length);  
  
							   $shortInput = '';$getsendShorturl = '';
    							
							  if($campaign_id) {
								  
        							$current_balance = $this->Campaign_model->get_SMSCredits($this->_userId);
								 
								   
						  		if($is_schedule) {
								   
								    	$ipAddress = $this->ip_address();
									$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $deductCustomCredits,$current_balance,$campaign_id,$ipAddress);
									$this->Campaign_model->deductSMSCredits($this->_userId, $deductCustomCredits);   							  										$this->Campaign_model->update_campaign_status($campaign_id, '1');
 									$largecampaignactivity_id = $this->Campaign_model->createLargeCampaignActivity_New($this->_userId,$campaign_id,$original_file,$total_no_of_sms,$mobile_no_column,$sms_text,$is_schedule,$from_row,$to_row);
 					  				//redirect('campaign/viewcampaigns');
								}else{


								if($this->_userId == 5813) {

											$CountryRoute = array("971" => "33013");
										}else{
											 $CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
										}

								//echo "test inside of campaign";exit;
								$count = 1; 
								 $sendShorturl = '';  $creditsCount = 0; 
								 //$filter = $shorturl_input;
								// $filter = array_filter($filter);
								foreach($data_array as $mobile_arr_var) {

									$mobile_no = $mobile_arr_var[0];
									$message = trim($mobile_arr_var[1]);

									// calculate SMS length
									/*if(strlen($message)>160)
									$sms_length_tmp=ceil(strlen($message)/153);
									else
									$sms_length_tmp=ceil(strlen($message)/160);

									$sms_length=$sms_length_tmp; */ // changed on 26-12-2013 as per santosh request
									//$sms_length = ceil(strlen($message)/160);
									
									
									$splMessage = trim($message); 
									$sms_text_spl = str_replace($special_char, ' ', $splMessage);  
									$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 
			  
									if(strlen($sms_text_spl2)>160)
										$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
									else
										$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

									$sms_length = $sms_length_tmp;
									
									$sendShorturl = '';
							 $creditsCount  = $creditsCount +$sms_length;					
								
							if($shorturl_input != NULL)
							{ 
								// $result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
								$result1 = $this->generateShortCode();
  
								$sendShorturl=$result1;

								$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
								$this->Campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
								$getSmsText = $this->Campaign_model->getLastCampaignSmsText($this->_userId);

		 
								foreach($getSmsText as $key=>$newsmsvalue)
								{
									$newsms_text= $message; //$newsmsvalue->sms_text;
									$newshorturl_text=$newsmsvalue->shorturl_text;
									$findString = 'ion.bz/';
									$pos = stripos($newsms_text, $findString); 
									if($pos === false) {
 
									}else{
										$str = substr($newsms_text, $pos); 
					  					$shortCode = substr($str, strlen($findString)); 
						 				$newshorturl_text = substr($shortCode, 0, 7);
				 						 
			 						}
								}
								$newshorturl_text = str_replace("\n", "", $newshorturl_text);
								$newshorturl_text = str_replace("\t", "", $newshorturl_text);
								$newshorturl_text = str_replace("\r", "", $newshorturl_text);

								$message = str_replace($newshorturl_text, "$sendShorturl", $newsms_text);   
							}else{
								$findString = 'ion.bz/';
								$pos = stripos($message, $findString); 
								if($pos === false) {
									$shortInput = FALSE;
								}else{
								$str = substr($message, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
				 				$short_code = substr($shortCode, 0, 7);
		 						$shorturl_input  = $shortInput = $this->Campaign_model->getShortcodeInput($short_code);
		 						}
								if($shortInput) {
									//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
									$result1 = $this->generateShortCode();
									$sendShorturl=$result1;  

									$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

									$this->Campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
		 							$newsms_text= $message;


									$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
									$newshorturl_text = str_replace("\n", "", $newshorturl_text);
									$newshorturl_text = str_replace("\t", "", $newshorturl_text);
									$newshorturl_text = str_replace("\r", "", $newshorturl_text);
		 
									  $message = str_replace($short_code, "$sendShorturl", $newsms_text); 
								}    
							}  
  
									$message = trim($message);  
									if(strlen($message)>160)
									$sms_length_tmp=ceil(strlen($message)/153);
									else
									$sms_length_tmp=ceil(strlen($message)/160);

									$sms_length=$sms_length_tmp;

									//if($is_schedule) {
									
										//$this->Campaign_model->scheduledCampaignTo($campaign_id, $message, $mobile_no);
									//} else {

										if($count <= 100) {
											//check is block listed number?
											//check for duplicate numbers? on 05-01-201
											//$is_duplicate=$this->Campaign_model->checkduplicate($username,$sms_text,$sender,$mobile_no);


										$is_block_listed = $this->Campaign_model->isBlockListed($mobile_no,$this->_userId);
										$is_duplicate=$this->Campaign_model->checkduplicate($this->_userId,$message,$sender_name,$mobile_no);  

						if($this->_International!=1){
						if(empty($mobile_no) || !is_numeric($mobile_no)) { 
								$is_invalid_no = 1;$mobile_no=0;
							}else{
								$is_invalid_no = $this->Campaign_model->isValidNo($mobile_no);
							}
							
						}else{
						if(empty($mobile_no) || !is_numeric($mobile_no)) { 
								$is_invalid_no = 1;$mobile_no=0;
							}else{
								$is_invalid_no = $this->Campaign_model->IsCountry($mobile_no,$this->_AllowedCountry);
							}
							
							if(isset($CountryRoute[substr($mobile_no, 0, 4)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 4)];
							elseif(isset($CountryRoute[substr($mobile_no, 0, 3)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 3)];
							elseif(isset($CountryRoute[substr($mobile_no, 0, 2)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 2)];
							elseif(isset($CountryRoute[substr($mobile_no, 0, 1)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 1)];
							else $sms_port = "33013";  //Default Port
						}






										if($is_duplicate){
											$error_text = "Duplicate Msg";
											$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $message,$sms_port, 16, $error_text);
										}elseif($is_invalid_no){


							  $error_text = "Invalid Number";
							$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $message,$sms_port, 16, $error_text);

						}else if($is_block_listed){
												$error_text = "Block Listed Number";
												// ADDED ON 2017-01-30 
												//$this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $message,$sms_port, 2, $error_text);
												$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $message,$sms_port, 2, $error_text);
											} else {
 												
												
					 							if(!$this->_userType){
													//check for dnd number
													$isDND = $this->Campaign_model->checkIsDND($mobile_no);

													if($isDND){
													 $error_text = "DND Number";
													 //$this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $message,$sms_port, 3, $error_text);
													 
													 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $message,$sms_port, 3, $error_text);
													} else {
if($this->_International ==1){

$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$mobile_no&text=".urlencode($message);
}else{
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$mobile_no&text=".urlencode($message);
}
														//$this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $message,$sms_port);
													 	$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $message,$sms_port);  
														
														  
														$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
														http_send($URL, $sms_port);
													}
												} else {
													//$this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $message,$sms_port);
													if($this->_International ==1){

$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$mobile_no&text=".urlencode($message);
}else{
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$mobile_no&text=".urlencode($message);
}
													$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $message,$sms_port);

													$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
													http_send($URL, $sms_port);
												}
											}  
										} else {
											$this->Campaign_model->scheduledCampaignTo($campaign_id, $message, $mobile_no);
											

										}
									//}

									 
									 
									
									$count++; 
								 }
							    

								//if($kount>0){$this->Campaign_model->scheduledCampaignTo1($dataV);}
								//update customized SMS sample SMS
							 $this->Campaign_model->update_campaign_sample_text($campaign_id, $message);

							 	
							 if($is_schedule) {
							 	$this->Campaign_model->update_campaign_status($campaign_id, '1');
							 } else {
							 	if($maxrows >= 100) {
							 		$this->Campaign_model->update_campaign_status($campaign_id, '1');
							 	} else {
							 		$this->Campaign_model->update_campaign_status($campaign_id, '2');
							 	}
							 }

							if($shorturl_input != NULL) {
								$findString = 'ion.bz/';
								$pos = stripos($message, $findString); 
								if($pos === false) {
									$shortInput = FALSE;
								}else{
									$str = substr($message, $pos); 

			  						$shortCode = substr($str, strlen($findString)); 
				 					$short_code = substr($shortCode, 0, 7); 
								}    
								$getsendShorturl=$this->_data['UrlGenIp']."$short_code";
								$this->Campaign_model->updateCampaignShortUrl($campaign_id,$shorturl_input,$getsendShorturl,$message);
							}
							

							  $ipAddress = $this->ip_address();
							if($maxrows >= 100) {  
									$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $deductCustomCredits,$current_balance,$campaign_id,$ipAddress);  
									$this->Campaign_model->deductSMSCredits($this->_userId, $deductCustomCredits);   

								 $largecampaignactivity_id = $this->Campaign_model->createLargeCampaignActivity_New($this->_userId,$campaign_id,$original_file,$total_no_of_sms,$mobile_no_column,$sms_text,$is_schedule,$from_row,$to_row);
								 
 
							}else{
								if($creditsCount > 0) {
									$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $creditsCount,$current_balance,$campaign_id,$ipAddress);
									$this->Campaign_model->deductSMSCredits($this->_userId, $creditsCount);   
								}
						
							}

							redirect('campaign/viewcampaigns');
							}
						    }	   
						}    
					//}      
				     }
				  }
				}else{  
					//$this->_data['error'] ='' ;//$this->upload->display_errors('','');//'Customize your file data.';  
				}  
   

				//$this->_data['columns'] = $columns;

				$sender = array();  
				if($this->_userType){
					$this->load->model('Campaign_model');
					//  $senderNames = $this->Campaign_model->getSenderNames($this->_userId);


					$this->load->model('user_model');
					$senderNames = $this->user_model-> getSenderNames_accept($this->_userId);
					 
					$sender[''] = '--select--';
					foreach($senderNames as $rs){
						$sender[$rs->sender_name] = $rs->sender_name;
					}
				} else {
					$sender['Promo'] = 'Promo';
				}
				
				//$this->_data['sender_names'] = $sender;
				//$this->_data['file_name'] = $original_file;
				//$this->_data['file_type'] = $file_type;
				//$this->_data['maxcols'] = $maxcols;
				//$this->_data['max_rows'] = $max_rows;
				//$this->_data['uploaded_data'] = $string;


			}
			catch (Exception $E)  
			{
				  $this->_data['error'] = $E -> getMessage();
			}

			//print_r($this->_data);


		}
		 
 
		// ADDED ON 2017-01-23
		
		$this->_data['did_result_response']=$this->get_misscalleddid_list();
		
		$sender = array();
		if($this->_userType){
			$this->load->model('Campaign_model');
			//  $senderNames = $this->Campaign_model->getSenderNames($this->_userId);


			$this->load->model('user_model');
			$senderNames = $this->user_model-> getSenderNames_accept($this->_userId);
			 
			$sender[''] = '--select--';
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}

		$this->_data['sender_names'] = $sender;
		$this->_data['isInternational'] = $this->_International;
 		$this->_data['user_id'] = $this->_userId;
		$this->_data['page_title'] = "Variable SMS";  
		$this->load->view('includes/header',$this->_data);
		$this->load->view('/includes/leftmenu');

		$this->load->view('campaign/new_variable_sms');  
		$this->load->view('/includes/footer');
	}   
   
   
	 


       // ADDED ON 2017-02-7
	public function uploadCustomSmsFile() {  
		$ViewTemplete="";$original_file = "";
		$file_type = "";$Filepath="";$offset = 0;
		$data['error'] = '';

	        if(isset($_FILES['userfile'])) { 
			$this->load->library('form_validation');
			$config['upload_path'] = 'uploads/';

			$file_name = uniqid('vs_');
                     	//$file_name = $_FILES['userfile']['name'];  
			$config['file_name'] = $file_name;  
			//$config['max_size'] = 100000; 
			$config['allowed_types'] = 'xls|xlsx';
			$config['overwrite'] = true; 

			$this->load->library('upload', $config);

			if ($this->upload->do_upload()) {
				 $file = $this->upload->data();

 				 $file_type = $file['file_ext'];
 				$uploadedFileName =  $file_name = $file['file_name'];
				 $file_name = 'uploads/'.$file_name;

					$excelReader = $this->config->item('excelReader');
					$spreadSheet = $this->config->item('spreadSheet'); 
				if($file_type == ".xls") {
					
				
						/** ADDED ON 2017-01-30**/
					require($excelReader);  
					require($spreadSheet);
					
				} else if($file_type == '.xlsx') {
					
					
					 
					/** ADDED ON 2017-01-30**/
					require($excelReader);  
					require($spreadSheet);
				}

				//$original_file = $file_name.$file_type;
				$original_file = $file_name;
				$Filepath=$original_file;
				$ViewTemplete="Y";

				date_default_timezone_set('UTC');
				$StartMem = memory_get_usage();

			}else {  $data['error'] = 'The uploaded file exceeds the maximum allowed size';} 
							//$this->upload->display_errors('','');}
	       } 
 
 
		if($ViewTemplete=="Y")
		{  

			try
		{ 

 				$Spreadsheet = new SpreadsheetReader($Filepath); 
				
 
   			      	$isValidFile = $Spreadsheet->valid();
				if($isValidFile == 1) 	{  
				$BaseMem = memory_get_usage();
				$Sheets = $Spreadsheet->Sheets();  
 				$i=0;$string = "";
				$maxrows=0;$maxcols=0;
				

 
				 $string = '<div class="table-responsive"><table class="table_all" width="100%" style=" border: 1px solid #E5E5E5;" cellpadding=0 cellspacing=0>'; 
$columns = array();

				foreach ($Sheets as $Index => $Name)
				{
 

					$Spreadsheet -> ChangeSheet($Index);
					$count = $Spreadsheet->Count(); 
					
   			      	 	$isValidFile = $Spreadsheet->valid();
					if($isValidFile == 1) 	 {			 
						foreach ($Spreadsheet as $Key => $Row)
						{
	 						$rowValues = array_filter($Row);
							if(!empty($rowValues)) {
	 						if($maxrows >= 5) {  break;};
								$maxrows++;$i++;
								if($i == 1){$string .= '<tbody>';}
								$string .= "<tr>" ;
						
								for($j = 0; $j < sizeof($Row); $j++)
					   			{
									//echo $j;  
								   	if($maxrows<=5)
								   	{
								   		if($i == 1)
								   		{
								   			$maxcols=sizeof($Row);
								   			$columns = array();
								   			for($k = 0; $k < $maxcols; $k++)
								   			{
								   				$columnValue = $k;
 											//if($Row[$k] == NULL) { $i++; break;}
												if(isset($Row[$k])) { 
								   			 $columns[$columnValue] = ($columnValue) . '-'. $Row[$k];	
												}
								   			}
											if(isset($Row[$j])) { 	
								   			$string .= '<td>'.$Row[$j].'</td>';
											}
								   			//$string .= '<th style="border: 1px solid #E5E5E5;">'.$Row[$j].'</th>';
								   		}
								   		else {   
											 if(isset($Row[$j])) { 	
												$string .= '<td>'.$Row[$j].'</td>';
												}
										} 
										 if(isset($Row[$j])) { 		    
								   		$uploded_data[$i-1][$j] = $Row[$j];
										}
								   	}


								   } 
					 			  if($i == 1){$string .='</tbody>';}
					  			 $string .= '</tr>';
								 
							}
  
						}
						//print_r($columns);exit;
						break;
					}
				}
						   	   
				unset($Spreadsheet);
				$string .= '</table> </div>';
				$max_rows=$maxrows;
 
				$data['columns'] = $columns; 
			 	$data['total_rows'] = intval(shell_exec("wc -l $Filepath"));    
				$data['file_name'] = $uploadedFileName;
				//$data['file_name'] = $original_file;
				$data['file_type'] = $file_type[1];
				$data['maxcols'] = $maxcols;  
				$data['max_rows'] = $max_rows;
				$data['uploaded_data'] = $string;  
				  
				//echo $string;  
  				}else {
			  		$data['error'] = 'Uploaded file is not in readable format.'; 
				 } 
			}
			catch (Exception $E)
			{
				  $data['error'] =  'Uploaded file is not in readable format.'; 
 
			}    
			 
		}
		else {
			  $data['error'] = 'Uploaded file is not in readable format.'; 
		}
		//if(empty($data['columns'])) { 
			// $data['error'] =  'Uploaded file is not in readable format.'; 

		//}
		     
		   echo json_encode($data);           
        }
        	
	
	 
	 


	   
	public function viewcampaignssearch()
	{
		//$this->output->enable_profiler(TRUE);
		session_start();
		$this->load->model('Campaign_model');
		$this->load->library('pagination');
		 
		$config["base_url"] = base_url() . "campaign/viewcampaignssearch";
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
			$campaigns_report = $this->Campaign_model->get_campaigns_report_default($this->_userId);
			$total_campaigns = $this->Campaign_model->get_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date=null,$to_date=null);
			$campaigns_data = $this->Campaign_model->getAllCampaigns1($this->_userId,$sender_name,$from_date=null,$to_date=null,$off_set,$limit);
		}
		@$fd = $_SESSION['from_date'];
		@$td = $_SESSION['to_date'];
		@$sn = $_SESSION['sender_name'];

		$campaigns_data = $this->Campaign_model->getAllCampaignsSearchValues( $limit, $off_set, $this->_userId, $sn, $fd, $td);

		$campaigns_report = $this->Campaign_model->get_aftersearch_campaigns_report($this->_userId, $sn, $fd, $td);
		//print_r($campaigns_data);
  
		$total_campaigns = $this->Campaign_model->get_campaigns_count1($this->_userId,$sn,$status_=null,$fd,$td);

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
		$this->load->view('campaign/campaign_searchtest',$this->_data);
		$this->load->view('/includes/footer');

	}
	
	 

	public function viewcampaigns1()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$sender_name = $this->input->post('sender');
		$rangeA = $this->input->post('rangeA');
		$mobile_no_ = $this->input->post('mobile_no_');


		if(strlen($rangeA)>0)
		{
			$split = explode("-",$rangeA);
			if(sizeof($split)==1)
			{
				$from_date = $split[0];
				$to_date = $split[0];
			}else
			{
				$from_date = $split[0];
				$to_date = $split[1];
			}

		}
		else // if not enter date
		{
			$from_date  = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
			$to_date = date("Y-m-d");
		}

		$status_ = $this->input->post('status_');

		if($this->uri->segment(3) == "deleted") {
			$this->_data['deleted'] = "Campaign Has been Deleted";
		}

		$this->_data['page_title'] = "SMS Campaign Reports";
		$this->_data['mobile_no_'] = "$mobile_no_";

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



		$total_campaigns = $this->Campaign_model->get_campaigns_count1($this->_userId,$sender_name,$status_,$from_date,$to_date);
		//$off_set = $this->uri->segment(3);
		//$limit = 10;

		$campaigns_data = $this->Campaign_model->getAllCampaigns1($this->_userId,$sender_name,$status_,$from_date,$to_date);
		$campaigns_ids='';
		$senderNamesArray = array();
		foreach($campaigns_data as $campaigns):
		$campaigns_ids .= $campaigns->campaign_id.",";
		$senderNamesArray[$campaigns->campaign_id] = $campaigns->sender_name;
		endforeach;

		//print_r($senderNamesArray);


		$campaign_ids =substr($campaigns_ids,0,strlen($campaigns_ids)-1);;

		$search_result_rs=$this->Campaign_model->get_search_results($this->_userId,$from_date,$to_date,$campaign_ids,$status_,$mobile_no_);

		$delivered_count=0;
		$errorTextArray = array();

		foreach($search_result_rs as $error_codes):
		//$myArray[] = array($error_codes->error_text => $error_codes->cnt);
		if (!array_key_exists($error_codes->error_text, $errorTextArray))
		$errorTextArray[$error_codes->error_text] = $error_codes->cnt;
		else
		$errorTextArray[$error_codes->error_text] += $error_codes->cnt;

		$delivered_count=$error_codes->cnt;
		endforeach;


		$this->load->library('pagination');
		$config['base_url'] = site_url().'campaign/viewcampaigns';
		$config['total_rows'] = $total_campaigns;
		//$config['per_page'] = $limit;
		$this->pagination->initialize($config);
			
		$this->_data['campaigns'] = $campaigns_data;
		$this->_data['campaigns1'] = $campaigns_data;
		$this->_data['search_result_rs'] = $search_result_rs;
		$this->_data['status_'] = $status_;
		$this->_data['rangeA'] = $rangeA;
		$this->_data['search'] = "search";

		//		$this->_data['delivered_count'] = $delivered_count;
		$this->_data['errorTextArray'] = $errorTextArray;

		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/campaigns_list');

		$this->load->view('/includes/footer');
	}


	/*public function scheduledcampaigns()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$data['available_credits'] = $this->_credits;
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - Manage Scheduled Campaigns";
		$this->load->model('Campaign_model');
		$total_campaigns = $this->Campaign_model->get_scheduled_campaigns_count($this->_userId,$from_date,$to_date);
		$off_set = $this->uri->segment(3);
		$limit = 10;
		$campaigns_data = $this->Campaign_model->get_scheduled_campaigns($this->_userId,$from_date,$to_date,$off_set,$limit);
		$this->load->library('pagination');
		$config['base_url'] = 'http://www.rkadvertisings.com/campaign/viewcampaigns/';
		$config['total_rows'] = $total_campaigns;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$data['campaigns'] = $campaigns_data;
		 $data['isftpuser'] = $this->_data['isftpuser'];
		$this->load->view('includes/header',$data);
		$this->load->view('includes/menu');
		$this->load->view('scheduled_campaigns_list');
		$this->load->view('/includes/footer');
	} */

	public function editcampaign()
	{
		$campaign_id = $this->uri->segment(3);
		//echo $campaign_id;
		$this->_data['available_credits'] = $this->_credits;
		$this->load->model('Campaign_model');
		$campaign_rs = $this->Campaign_model->get_scheduled_campaign_details($campaign_id);
		$this->_data['campaign_id'] = $campaign_id;
		foreach($campaign_rs as $rs){
			$this->_campaign = $rs->scheduled_on;
			$this->_campaign_id = $rs->campaign_id;
		}
		$this->_data['campaign'] = $this->_campaign;
		$this->_data['campaign_id'] = $this->_campaign_id;
		$this->_data['page_title'] = "Edit Schedule sms";
		$this->_data['isftpuser'] = $this->_data['isftpuser'];
		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/edit_campaign',$this->_data);   
		$this->load->view('includes/footer');


		//$this->load->view('includes/header',$data);
		//$this->load->view('campaign/edit_campaign');  
		//$this->load->view('/includes/footer');
	}
	public function updateschedulecampaign()
	{
		//$this->_data['campaign'] = $this->_campaign;
		//$this->_data['campaign_id'] = $this->_campaign_id;
		//$this->_data['available_credits'] = $this->_credits;
		$on_date = $this->input->post('on_date');
		$campaign_id = $this->input->post('campaign_id'); 
 
		  $current_date_t = date_create(date("Y-m-d H:i:s"));
		  $scheduled_date_t = date_create($on_date);
		//print_r($current_date_t);print_r($scheduled_date_t );
		if( $current_date_t > $scheduled_date_t )
		{   
			$error = true; 
			$report['status'] = 201;
			//$error_msg .= "Please enter valid schedule date";
		}else{	
			$this->load->model('Campaign_model');
			$this->Campaign_model->UpdateScheduleCampaign($campaign_id,$on_date);
			$report['status'] = 200;
		}  

		echo json_encode($report);
		//$this->_data['edited'] = "Scheduled sms has been updated";
		//$this->_data['page_title'] = "Edit Schedule sms";
		// $this->_data['isftpuser'] = $this->_data['isftpuser'];
		//redirect('viewcampaigns/edited');
		//$this->load->view('includes/header',$this->_data);
		//$this->load->view('includes/leftmenu');  
		//$this->load->view('campaign/edited_campaign',$this->_data);   
		//$this->load->view('includes/footer');

		//$this->load->view('includes/header',$data);  
		//$this->load->view('campaign/edited_campaign');
		//$this->load->view('/includes/footer');

	}

	public function cancelcampaign()
	{
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->Campaign_model->get_campaign_details($campaign_id,$this->_userId);
			if($rs) {

				foreach($rs as $campaign) {
					$campaign_id = $campaign->campaign_id;
					$no_of_sms = $campaign->no_of_messages;
					$campaign_status = $campaign->campaign_status;
				}
				//if($campaign_status != 3) {
					if($campaign_status == 1) {
						$this->Campaign_model->addSMSCredits($this->_userId, $no_of_sms);
					//}
				//}  
				//if($campaign_status == 1) {	
					$this->Campaign_model->update_campaign_status($campaign_id, '3');
				}  
				//add scheduled SMS credits

				redirect('campaign/viewcampaigns');
			} else {
				$data['available_credits'] = $this->_credits;
				$data['error'] = "Invalid Request";
			}
		} else {
			$data['available_credits'] = $this->_credits;
			$data['error'] = "Invalid Request";
		}
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - Cancel Campaign";
		 $data['isftpuser'] = $this->_data['isftpuser'];
		//$this->load->view('includes/header',$data);
		//$this->load->view('includes/menu');
		//$this->load->view('cancel_campaign');
		//$this->load->view('/includes/footer');
	}



	 	 

	// Changed report on 2018-2-5 by saisandeepthi
	 public function downloadDlrReport_new() 
	{
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->Campaign_model->get_campaign_details($campaign_id,$this->_userId);
 
			if($rs) {
				 
				$error_text= ''; $reports = array();
				foreach($rs as $val)
				{
					 
					$sender_name=$val->sender_name;
					$msglength=strlen($val->sms_text);
					$message_= $val->sms_text;
					$campaign_name_=$val->campaign_name;
						
						
					 
					if($val->is_scheduled == 1)
					{
						$campaign_ondate = $val->scheduled_on;
					} else {
						$campaign_ondate = $val->created_on;
					}
					$campaign_type = $val->campaign_type;
					$campaign_id = $val->campaign_id;
				}
				 
    
				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);

				$campaign_numbers = $this->Campaign_model->get_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);
 
				$rowId=1;
				foreach ($campaign_numbers as $row) {
					$to_mobile_number=$row->to_mobile_no;
					$message_ = $row->sms_text;
					if($campaign_type == 2)  
					{  
						$to_m = substr($to_mobile_number,0,6)."XX".substr($row->to_mobile_no,8,2);
					} else {
						$to_m = $to_mobile_number;
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
					if(strlen($row->to_mobile_no) < 10) {   
						$error_text = "Invalid Number";
					} elseif($row->dlr_status == "" || $row->dlr_status == 0 ) {
						$error_text = "Pending DLR";
					}else if($row->dlr_status == 1) {
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
					
					
					
					 $message_ = trim(preg_replace('/\s+/', ' ',$message_)); 
				 
					$slNo = $rowId++;
    					$values = array('SlNo'=> $slNo,'CampaignID'=>$campaign_id,'CampaignName'=>$campaign_name_,'SenderName'=>$sender_name ,'MobileNo'=>$to_m,'SentTime' => $row->sent_on,"DeliveredTime" => $row->delivered_on ,"DLRStatus" => $error_text,"Message" => $message_,"SMSLength" => $row->sms_count,"Provider" => $operator_name,"Location" => $service_area  );
    					array_push($reports,$values);     
				}

			 
 ob_clean();
			 	$headerDisplayed = false;
				header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
				header('Content-Description: File Transfer');
				header('Content-Type: text/csv; charset=utf-8');
				header("Content-Disposition: attachment; filename=SMSReport_".$campaign_id.".csv");
				header("Expires: 1");
				header("Pragma: private");
				$fh = @fopen( 'php://output', 'w' );
			 
				foreach ($reports  as $key => $value) {
					if ( !$headerDisplayed ) {
						fputcsv($fh, array_keys($value));
						$headerDisplayed = true;
					}
					fputcsv($fh, $value);
				}  
				fclose($fh);
				exit;
			}  
		}  
		 
	}
	
	 
	
	 public function downloadDlrReport_new1() 
	{
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->Campaign_model->get_campaign_details($campaign_id,$this->_userId);
 
			if($rs) {
				$string = '';
				$error_text= '';
				foreach($rs as $val)
				{
					// $message_ = preg_replace('/\s+/', ' ', $val->sms_text);
 
					//$message_ = wordwrap(preg_replace('/\s+/', ' ', $val->sms_text), 20);
					$sender_name=$val->sender_name;
					$msglength=strlen($val->sms_text);
					$message_= $val->sms_text;
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
						$campaign_ondate = $val->created_on;
					}
					$campaign_type = $val->campaign_type;
					$campaign_id = $val->campaign_id;
				}
				$string .= "Sl.No\tMSG ID\tCampaign Name\tSender Name\tMobile No\tSent Time\tLast Updated\tAcknowledgment\tMessage Text\tSMS Length\tCredits Charged\tProvider\tLocation\n";

				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);

				$campaign_numbers = $this->Campaign_model->get_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);
				//print_r($campaign_numbers);exit;
				$rowId=1;
				foreach ($campaign_numbers as $row) {
					$to_mobile_number=$row->to_mobile_no;
					$message_ = $row->sms_text;
					if($campaign_type == 2)  
					{  
						$to_m = substr($to_mobile_number,0,6)."XX".substr($row->to_mobile_no,8,2);
					} else {
						$to_m = $to_mobile_number;
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
					 $message_ = trim(preg_replace('/\s+/', ' ',$message_)); 
					$string .= $rowId++."\t".$campaign_id."\t".$campaign_name_."\t".$sender_name."\t".$to_m."\t".$row->sent_on."\t".$row->delivered_on."\t".$error_text."\t".$message_."\t".$msglength."\t".$chargedcredits."\t".$operator_name."\t".$service_area;
					$string .= "\n";
				}

				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=SMSReport_".$campaign_id.".xls");
				header("Pragma: no-cache");
header("Content-Type: text/plain");
				header("Expires: 0");
				echo $string;  
				exit;
			} else {  
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		 $data['isftpuser'] = $this->_data['isftpuser'];
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		//$this->load->view('includes/header',$data);
		//$this->load->view('includes/menu');
		//$this->load->view('cancel_campaign');
		//$this->load->view('/includes/footer');
	}


	public function downloadDlrReport()
	{
		$campaign_id = $this->uri->segment(3);
		$userID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409';
		} 
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$rs = $this->Campaign_model->get_campaign_details($campaign_id,$userID);
			if($rs) {
				$string = '';
				foreach($rs as $val) {
					$string .= "Sender Name: ".$val->sender_name."\n";
					$string .= "Message: ". $val->sms_text."\n";
						
					if($val->is_scheduled == 1) {
						$campaign_ondate = $val->scheduled_on;
					} else {
						$campaign_ondate = $val->created_on;
					}
					$campaign_type = $val->campaign_type;
				}
				$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");

				if(in_array($this->_userId,$specialusermask) )
				{
					$string .= "To \n";
				}else{
					$string .= "To,Sent On\n";
				}

				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);

				$campaign_numbers = $this->Campaign_model->get_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);
				foreach ($campaign_numbers as $row) {
					if($campaign_type == 2) {
						$to_m = substr($row->to_mobile_no,0,6)."XX".substr($row->to_mobile_no,8,2);
					} else {

						$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");

						if(in_array($this->_userId,$specialusermask) )
						{						$to_m = substr($row->to_mobile_no,0,5)."XXXXX".substr($row->to_mobile_no,8,0);


						}else{
							$to_m = $row->to_mobile_no;
						}
					}
					$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");

					if(in_array($this->_userId,$specialusermask) )
					{
						$string .= $to_m.",";
					}else{
						$string .= $to_m.",".$row->sent_on.",";
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
					elseif($row->dlr_status == 16){
						$string .= $row->error_text;
					} elseif(($row->dlr_status != 0) && $row->dlr_status == 3){
						$string .= "DND Number";
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
				header("Content-Type: text/plain");
				echo $string;
				exit;
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		 $data['isftpuser'] = $this->_data['isftpuser'];
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		//$this->load->view('includes/header',$data);
		//$this->load->view('includes/menu');
		//$this->load->view('cancel_campaign');
		//$this->load->view('/includes/footer');
	}

	public function normalSmsRemoveDublicates()
	{
		$mobile = trim($this->input->post('to_mobileno'));
		$to_mobile_array = explode("\n",$mobile);
		$to_mobile = array();
		for($i=0; $i<count($to_mobile_array); $i++) {
			$to_mobile[] = trim($to_mobile_array[$i]);
		}
		$result = array_unique($to_mobile);
		$to_mobile = "";
		foreach($result as $value) {
			$to_mobile .= $value."\n";
		}
 
		echo trim($to_mobile);
	}

	public function numbersCount()
	{
		$mobile = trim($this->input->post('to_mobileno'));
		$to_mobile_array = explode("\n",$mobile);
		$to_mobile = array();
		for($i=0; $i<count($to_mobile_array); $i++) {
			$to_mobile[] = trim($to_mobile_array[$i]);
		}

		$result = array_unique($to_mobile);
		$to_mobile = "";
		foreach($result as $value) {
			$to_mobile .= $value."\n";
		}
		$totalCount=count($to_mobile_array);
		$uniqueCount=count($result);
		echo $uniqueCount." Unique number(s) out of : ".$totalCount;
	}

  
      public function download_dlr_report()
      {
		$campaign_id = $this->uri->segment(3);
		if($campaign_id) {
		$this->load->model('Campaign_model');
		$rs = $this->Campaign_model->get_campaign_details($campaign_id,$this->_userId);
		$string = '';
		if($rs) {
			
			foreach($rs as $val) {
				// $message_ = preg_replace('/\s+/', ' ', $val->sms_text);
				$string .= "Sender Name: ".$val->sender_name."\n";
				$string .= "Message: ".$val->sms_text."\n";
					
				if($val->is_scheduled == 1) {
					$campaign_ondate = $val->scheduled_on;
				} else {
					$campaign_ondate = $val->created_on;
				}
				$campaign_type = $val->campaign_type;
			}

			$specialusermask=array("4117","4121","4122","4123","4124","4126","4127");
			if(in_array($this->_userId,$specialusermask) ){
				$string .= "To \t\n";
			}else{
				$string .= "To,Sent On,Status\n";
			}

			$cur_date = date('Y-m-d H:i:s');
			$days_diff = $this->daysDifference($cur_date, $campaign_ondate);

			$campaign_numbers = $this->Campaign_model->get_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);
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
						
					$string .= $to_m.",";
				}else{
					$string .= $to_m.",".$row->sent_on.",";
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

			
		} else {
			$this->_data['error'] = "Invalid Request";
		}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=SMSReport_".$campaign_id.".xls");
			header("Pragma: no-cache");   
			header("Expires: 0");
 


			echo $string;
			exit;
		 $data['isftpuser'] = $this->_data['isftpuser'];
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('/includes/footer');


	}

	//view reports
	public function viewReport()
	{
		$this->_data['page_title'] = "View DLR Report";
		$mobileNum = $this->input->post('mobileNum');
		$campaign_id = $this->uri->segment(4);
		$userID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409';
		} 
		if($campaign_id) {
			$this->load->model('Campaign_model');
			$campaign_details_rs = $this->Campaign_model->get_campaign_details($campaign_id,$userID);
			if($campaign_details_rs) {
  
				foreach($campaign_details_rs as $campaign){
					if($campaign->is_scheduled == 1) {
						$campaign_ondate = $campaign->scheduled_on;
					} else {
						$campaign_ondate = $campaign->created_on;
					}
				}   

				$cur_date = date('Y-m-d H:i:s');
				$days_diff = $this->daysDifference($cur_date, $campaign_ondate);

				$total_rows = $this->Campaign_model->getTotalNumbersCount($campaign_id, $days_diff, $campaign_ondate,$mobileNum);
   
				$off_set = $this->uri->segment(5);
				$limit = 25;       
      
				$dlr_report_old = $this->Campaign_model->getCampaignNumbers($campaign_id,  $days_diff,$mobileNum, $campaign_ondate, $off_set, $limit);
				//$dlr_report = $this->Campaign_model->get_campaign_numbers($campaign_id, $days_diff, $campaign_ondate);

				$dlr_report = $this->Campaign_model->get_SMS_campaign_count($campaign_id, $days_diff, $campaign_ondate);
 				//print_r($dlr_report);

				$this->load->library('pagination'); 
				$config['base_url'] = site_url().'campaign/viewReport/campaign/'.$campaign_id.'/';
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
				$this->load->view('campaign/dlr_report');
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

	//template check
	private function _templateCheck($sms_text)
	{
		//lower case
		$sms_text = strtolower($sms_text);

		//remove special characters
		$special_char = array(',','.','-','!','&');
		$sms_text = str_replace($special_char, ' ', $sms_text);
		$sms_text_array = explode(" ", $sms_text);
		$txt_array1 = array();
		for($i = 0; $i < count($sms_text_array); $i++){
			$txt1 = trim($sms_text_array[$i]);
			if(strlen($txt1) > 0){
				$txt_array1[] = $txt1;
			}
		}

		//get SMS Templates
		$this->load->model('Campaign_model');
		$templates = $this->Campaign_model->get_templates($this->_userId);

		foreach($templates as $row){
			$temp = strtolower($row->template);
			$txt2 = str_replace($special_char, ' ', $temp);
			$sms_template = str_replace('xxxx','', $txt2);
			$sms_template_array = explode(" ", $sms_template);

			$txt_array2 = array();
			for($i = 0; $i < count($sms_template_array); $i++){
				$txt3 = trim($sms_template_array[$i]);
				if(strlen($txt3) > 0){
					$txt_array2[] = $txt3;
				}
			}

			$diff_array = array_diff($txt_array2, $txt_array1);

			$text_array2_count = count($txt_array2);
			$diff_array_count = count($diff_array);

			$diff_percentage = ($diff_array_count/$text_array2_count)*100;

			if($diff_percentage <= 40){
				return true;
			}
		}
		return false;
	}

	function get_months($date1, $date2)
	{
		$time1  = strtotime($date1);
		$time2  = strtotime($date2);
		$my     = date('n-Y', $time2);
		$mesi = array('01','02','03','04','05','06','07','08','09','10','11','12');

		//$months = array(date('F', $time1));
		$months = array();
		$f      = '';

		while($time1 < $time2) {
			if(date('n-Y', $time1) != $f) {
				$f = date('n-Y', $time1);
				if(date('n-Y', $time1) != $my && ($time1 < $time2)) {
					$str_mese=$mesi[(date('n', $time1)-1)];
					$months[] = $str_mese."".date('Y', $time1);
				}
			}
			$time1 = strtotime((date('Y-n-d', $time1).' +15days'));
		}

		$str_mese=$mesi[(date('n', $time2)-1)];
		$months[] = $str_mese."".date('Y', $time2);
		return $months;
	}

	public function unicodeSMS()
	{
		if($this->session->userdata('user_id') ==  5742  || $this->session->userdata('user_id') ==  5741  || $this->session->userdata('user_id') ==  5740 || $this->session->userdata('user_id') ==  5739 )   {
			  redirect(base_url().'campaign/viewcampaigns');   
		}
		$this->_data['page_title'] = "Unicode SMS";
		$this->session->unset_userdata('selected_sms_type');
		$this->session->unset_userdata('from_date');
		$this->session->unset_userdata('to_date');
		if ($this->input->post('sendsms')) {

			$this->load->library('form_validation');
			if ($this->form_validation->run('single_sms_form') == TRUE) {

    				$this->_data['validatationtrue'] ="1";
				$campaign_name = $this->input->post('campaign_name');
				$sms_text = $this->input->post('sms_text');
				$sender = $this->input->post('sender');
				$sms_type = $this->input->post('sms_type');
				//$is_schedule = $this->input->post('schedule');
				$scheduled_date = $this->input->post('on_date');
				$sms_text = trim($sms_text);  
				//ADDED ON 2017-01-23
				
				$shorturl_input=$this->input->post('shorturl_input');
				$shorturl_text=$this->input->post('shorturl_text');	
   				$this->_data['error'] = '';$this->_data['no_balance']=''; 
				$is_unicode_sms=1;
				$error = false;
				$error_msg = "";
				//validating the scheduled date, if it is scheduled
				$is_schedule = '0';	
				if($scheduled_date != NULL) { $is_schedule = 1; };	
				if($is_schedule)
				{
					if(!$scheduled_date) {
						$error = true;
						$this->_data['error'] = $error_msg .= "Please enter schedule date";
					}
					$current_date_t = date_create(date("Y-m-d H:i:s"));
					$scheduled_date_t = date_create($scheduled_date);

					if( $current_date_t > $scheduled_date_t )
					{
						$error = true;
						$this->_data['error'] = $error_msg .= "Please enter valid schedule date";
					}
				}

				//if client type is transactional, check for template if not dynamic
				if($this->_userType == 1 && $this->_template_check){
					//check for templates
					$temp_check = $this->_templateCheck($sms_text);
					if(!$temp_check){
						$error = true;
						$this->_data['error'] = $error_msg .= "SMS Text not matching with Approved Templates";
					}
				}
				//if client type is Promotional, check for Promotion Timings
				
				if($this->_userType != 1 || $this->_dndCheck == 1 )
				{
 
					 if($is_schedule) {
					  	$time =  date('H', strtotime($scheduled_date)); 
 
						if($time < 9 || $time >= 21)
						{

   								$error = true;
								$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm.";				
       
						}   
					 }else{ 
						$time = date('H');
 
						if($time < 9 || $time >= 21)
						{ 
								$error = true;
								$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm."; 
  							 
						} 

					}  
				}  

				//for restricting user testing unicode start
				$to_mobileno_tmp = explode("\n",trim($this->input->post('to_mobileno')));
				$total_numbers_tmp = count($to_mobileno_tmp);
				/*
				 if($total_numbers_tmp>5)
				 {
				 $error = true;
				 $error_msg .= "Unicode module is currently under testing,So Please don't do bulk campaigns.Right now it accepts only five numbers at a time. Sorry for the inconvenience we will back to you shortly <br />";
					}
					//for restricting user testing unicode end
					*/
				if($error) {
					$this->_data['error'] = $error_msg;
				} else {
					$to_mobileno = explode("\n",trim($this->input->post('to_mobileno')));

					// calculate SMS length

					$splMessage = $sms_text = trim($sms_text);
					$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

					$sms_text_spl = str_replace($special_char, ' ', $splMessage); 


					$special_char_2 = array('{','}','[',']','^','|','€','~');
					$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 

					if(mb_strlen($sms_text_spl2)>70)
						$sms_length_tmp = ceil(mb_strlen($sms_text_spl2)/63);
					else
						$sms_length_tmp = ceil(mb_strlen($sms_text_spl2)/70);

 


					/* 
					if(mb_strlen($sms_text)>70)
						$sms_length_tmp=ceil(mb_strlen($sms_text)/63);
					else
						$sms_length_tmp=ceil(mb_strlen($sms_text)/70);*/

					$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
					//$sms_length = ceil(strlen($sms_text)/160);
					$to_mobileno = array_unique($to_mobileno); 
					$to_mobileno = array_values($to_mobileno); 
					$normalSMSLimit = $this->config->item('normalSMSLimit');
					$totalMobileCount = count($to_mobileno);
					if($totalMobileCount > $normalSMSLimit) { 
						$this->_data['error'] =   "For More than $normalSMSLimit sms please use FILE SMS or CUSTOM SMS.";
  
					}else{ 
						$to_mobileno = array_slice($to_mobileno, 0, $normalSMSLimit);    
						$total_numbers = count($to_mobileno);
						 
						$total_no_of_sms = $total_numbers * $sms_length;

						//checking credits  
						if($total_no_of_sms > $this->_credits) {
							$this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$total_no_of_sms} credits";
						} else {
							//send SMS
						
							// ADDED ON2017-01-23
						
							//$this->_sendUnicodeSMS($sms_text, $sender, $to_mobileno, $sms_type,$is_unicode_sms, $is_schedule, $scheduled_date,$campaign_name);
						
							$this->_sendUnicodeSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type,$is_unicode_sms, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text);
							// redirect('campaign/viewcampaigns');
						}
					}
				}  
			}  
		}

		$sender = array();
		if($this->_userType){
			$this->load->model('Campaign_model');
			//$senderNames = $this->Campaign_model->getSenderNames($this->_userId);

			$this->load->model('user_model');
			$senderNames = $this->user_model-> getSenderNames_accept($this->_userId);
			 
			$sender[''] = '--select--';
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}
		$this->_data['sender_names'] = $sender;

		//get added templates
		$this->load->model('Campaign_model');
		$campaigns_data = $this->Campaign_model->getCampaignsLast($this->_userId);
		$this->_data['campaigns'] = $campaigns_data;
		
		// ADDED ON 2017-01-23
		
			$this->_data['did_result_response']=$this->get_misscalleddid_list();
 
		
				
		$this->load->model('contact_model');

		$groups = $this->contact_model->getGroups($this->_userId);
		$this->_data['groups'] = $groups;


		$this->load->model('user_model');
		$limit = 25;$offset = '0';
		if($this->_template_check==1)
		{
			$templates = $this->user_model->getTemplatesApprove($this->_userId);
			$this->_data['templates'] = $templates;
		}else
		{
			$templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);
			$this->_data['templates'] = $templates;

		}
		if($this->_userType==0)
		{
			$templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);
			$this->_data['templates'] = $templates;
		}

		if($this->input->post('editsubmit')){

			$template=$this->input->post('edittemp');
			$template_id=$this->input->post('template_id');
			$this->user_model->updated_template($this->_userId,$template_id,$template);
			redirect('campaign/normalSMS');

		}

		if($this->input->post('addsubmit')){
			$template=$this->input->post('addtemp');
			$this->user_model->addTemplate($this->_userId,$template);
			redirect('campaign/normalSMS');
		}
		if($this->uri->segment(3) == "del")
		{
			$template_id=$this->uri->segment(4);
			$this->user_model->delete_template($this->_userId, $template_id);
			redirect('campaign/normalSMS');
		}

		// ADDED ON 2017-02-4
		$this->_data['userInfo'] = $this->User_model->getUserDetails($this->_userId);

    		$this->_data['user_id'] = $this->_userId;
		$this->_data['isInternational'] = $this->_International;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/unicode_sms');
		$this->load->view('includes/footer');  
	}

	private function _sendUnicodeSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type,$is_unicode_sms ,$is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text)
	{
 
 
		if($this->_userId == 5813) {

			$CountryRoute = array("971" => "33013");
		}else{
			$CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
		}


		//$created_on=date("Y-m-d H:i:s");
		/* if(mb_strlen($sms_text)>70)
			$sms_length_tmp=ceil(mb_strlen($sms_text)/63);
		else
			$sms_length_tmp=ceil(mb_strlen($sms_text)/70); */


		$splMessage = $sms_text = trim($sms_text);
		$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

		$sms_text_spl = str_replace($special_char, ' ', $splMessage); 


		$special_char_2 = array('{','}','[',']','^','|','€','~');
		$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 

		if(mb_strlen($sms_text_spl2)>70)
			$sms_length_tmp = ceil(mb_strlen($sms_text_spl2)/63);
		else
			$sms_length_tmp = ceil(mb_strlen($sms_text_spl2)/70);
 

		$sms_length=$sms_length_tmp; 
 
		$this->load->model('Campaign_model');

		
		
		//Config flag to check only valid numbers
		$isCheckInvalidNum = $this->config->item('checkInvalidNumbers');
	
		//Check valid numbers
		if($isCheckInvalidNum == 1 && $this->_International == 0) {
			$to_mobileno = $this->Campaign_model->Validnumbers($to_mobileno);
		} 
		
		$to_mobileno = array_filter($to_mobileno);
		$to_mobileno = array_values($to_mobileno); 

		$total_numbers = count($to_mobileno);
		$total_numbers_ex_invalidno = $total_no_of_sms = $total_numbers*$sms_length;
		
		 
	
	

		$_sender = $sender;
		//sender names
		if($this->_userType == 1){ //loop Transactional SMPP
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
			$portType = "LT1";
		} elseif($this->_userType == 0){            //loop Promo SMPP
			$sender = "0". rand(16066,16075);
			//$sender_name = "LM-" . $sender;
			$sender_name = $sender;
			$portType = "LP1";
 

		} elseif($this->_userType == 2){ //solutions infini transactional
			$portType = "ST1";
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
		} 

		if($this->_userType == 1 && $this->_dndCheck == 1){// semi trans
 
			$sender_name = $sender;
			$portType = "LS1";
			$portTypeNAS = 'NASP1';
		}

		$sms_port = 0;
		//get port number based on port type
		
		
 
	 if($this->_userType == 1){ 
		   $isValidSenderName = $this->Campaign_model->checkIsValidSenderName($this->_userId,$sender);
	if($isValidSenderName) {
		 $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}else{
		  $sms_port =  $this->Campaign_model->getNASPortNumber($portTypeNAS);
	} 
	}else{
	 $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}
	
	
 	
 	
 	
  
if($this->_userId==4130)
{
$sms_port =0;
 
}
/*if($this->_userId==250)
		{
			$sms_port = 34113;
		}*/
 
		 
		 	$senderName_kennel = $sender;
 	if($sms_port > 0) {
 		$sms_portFor = $this->Campaign_model->getFirstPriorityPortType($sms_port);
 		if($sms_portFor == 1) {
 		 	if($this->_userType == 0) {
 				$senderName_kennel = "BA-611128";
 			}else{
 				$senderName_kennel = "BA-".$sender;
 			} 
 		}
 	}
		 
		//create campaign
if($shorturl_input != NULL) {  
		$findString1 = 'ion.bz/';
		$pos1 = stripos($sms_text, $findString1); 
		if($pos1 === false) {
			$shorturl_input = '';$shorturl_text= '';
		}

	}   
 		 
		$campaign_id = $this->Campaign_model->createUnicodeShortUrlCampaign($this->_userId,$sms_type,$is_unicode_sms,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input,$total_numbers,$sms_length);
		
		
		$request = json_encode($to_mobileno);
		$date = date('Y-m-d');
		$userID = $this->_userId; 

		error_log("\n".date('Y-m-d H:i:s')."| Requested Numbers for campaign - $campaign_id | ".$request."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/campaign_logs/str_Unicodesms_".$userID.".log");
		
		
		
		
		//$campaign_id = $this->Campaign_model->createUnicodeCampaign($this->_userId,$sms_type,$is_unicode_sms,$sms_text,$sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name);
	  $shortInput = '';$getsendShorturl = '';
		if($campaign_id) {
			//deducting credits  
			$current_balance = $this->Campaign_model->get_SMSCredits($this->_userId);
			 $ipAddress = $this->ip_address();
			$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $total_numbers_ex_invalidno,$current_balance,$campaign_id,$ipAddress);
			$this->Campaign_model->deductSMSCredits($this->_userId, $total_numbers_ex_invalidno);
 			if($total_numbers_ex_invalidno >= 50000) {
 					$userName = $this->session->userdata('username');
 					$sampleSubText = substr($sms_text, 0, 70);
				$this->sendAlert($campaign_id,$userName,$sampleSubText,$total_numbers_ex_invalidno); 
			}  

			// ADDED ON 2017-01-23
			
			  $configFile = $this->config->item('configFile');
		 $functionsFile = $this->config->item('functionsFile');
            include($configFile);
	   include($functionsFile);
			
			$created_on=date("Y-m-d H:i:s");
			$dataV1=null;
			$dataV=null;
			//if campaign is scheduled
		  $sendShorturl = ''; $smstext = $sms_text; 
 
  
			if($is_schedule) {


				for($i=0; $i<count($to_mobileno); $i++)
				{
					$mobile_no = trim($to_mobileno[$i]);
 
					if($shorturl_input != NULL)
					{
						
						//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

						$result1 = $this->generateShortCode();
						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->Campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->Campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/';
							$pos = stripos($newsms_text, $findString); 
							if($pos === false) {
 
							}else{
								$str = substr($newsms_text, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
				 				$newshorturl_text = substr($shortCode, 0, 7);
 
	 						}
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text);  
					} else{
						$findString = 'ion.bz/';
						$pos = stripos($smstext, $findString); 
						if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shorturl_input = $shortInput = $this->Campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->Campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}
					 
					$values = array(
							'campaign_id' => $campaign_id,
							'sms_text' => $smstext,
							'to_mobile_no' => $mobile_no,
							'created_on' => $created_on
					);
					$dataV[]=$values;
					//$this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);

				}
				 

				$this->Campaign_model->scheduledCampaignTo1($dataV);
				$this->Campaign_model->update_campaign_status($campaign_id, '1');

				/*

				 for($i=0; $i<count($to_mobileno); $i++) {
				 $mobile_no = trim($to_mobileno[$i]);

				 $this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
				 }

				 $this->Campaign_model->update_campaign_status($campaign_id, '1');
				 */
			} else {
				$priority_sms_count = 100;

				if($total_numbers >= $priority_sms_count) {

					$offset = $priority_sms_count;
				} else {
					$offset = $total_numbers;
				}

				//sms type - normal/ Flash SMS
				$mclass = "";
				if($sms_type==1)
				$mclass = "&mclass=0";

				//sms content type - normal/ Unicode SMS
				$unicode_sms = "";
				if($is_unicode_sms)
				$unicode_sms = "&coding=2&charset=utf-8";


				$newShortText = '';
				$smstext = $sms_text;
				//campaign is immediate

				for($i=0; $i < $offset; $i++)
				{
					$mobile_no = trim($to_mobileno[$i]);
					//check is block listed number?
					

 
					// ADDED ON 2017-01-23
 
					if($shorturl_input != NULL)
					{
						
						//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

						$result1 = $this->generateShortCode();
						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->Campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->Campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/'; 
							$pos = stripos($newsms_text, $findString); 
							if($pos === false) {
 
							}else{
								$str = substr($newsms_text, $pos);  
		  						$shortCode = substr($str, strlen($findString));  
			 					$newshorturl_text = substr($shortCode, 0, 7);  
 
							}
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text); 
					}else{
						$findString = 'ion.bz/'; 
						$pos = stripos($smstext, $findString); 
						if($pos === false) {
							$shortInput = FALSE;
						}else{
							$str = substr($smstext, $pos);  
	  						$shortCode = substr($str, strlen($findString));  
		 					$short_code = substr($shortCode, 0, 7);  
 							$shorturl_input = $shortInput = $this->Campaign_model->getShortcodeInput($short_code);
						}
 
						if($shortInput) {

							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->Campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}
					
					$smstext = trim($smstext);  
 					/* if(mb_strlen($smstext)>70)
						$sms_length_tmp=ceil(mb_strlen($smstext)/63);
					else
						$sms_length_tmp=ceil(mb_strlen($smstext)/70);

					$sms_length = $sms_length_tmp; */

					$IP = $this->_data['kernalIp'];
					$is_block_listed = $this->Campaign_model->isBlockListed($mobile_no,$this->_userId);
					if($this->_International!=1){
					if(empty($mobile_no) || !is_numeric($mobile_no)) { 
							$is_invalid_no = 1;$mobile_no = 0;
						}else{
							$is_invalid_no = $this->Campaign_model->isValidNo($mobile_no);
						}
						
						
					}else{
					if(empty($mobile_no) || !is_numeric($mobile_no)) { 
							$is_invalid_no = 1;$mobile_no = 0;
						}else{
							$is_invalid_no = $this->Campaign_model->IsCountry($mobile_no,$this->_AllowedCountry);
						}
						
						if(isset($CountryRoute[substr($mobile_no, 0, 4)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 4)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 3)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 3)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 2)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 2)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 1)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 1)];
						else $sms_port = "33013";  //Default Port

					} 


					if($is_block_listed){
						$error_text = "Block Listed Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId, $sender_name,$sendShorturl,$sms_length, $mobile_no, $smstext, $sms_port, 2, $error_text);
					} elseif($is_invalid_no){


						 $error_text = "Invalid Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId, $sender_name,$sendShorturl,$sms_length, $mobile_no, $smstext, $sms_port, 16, $error_text);
						 

					}else {
						if(!$this->_userType){
							//check for dnd number
							$isDND = $this->Campaign_model->checkIsDND($mobile_no);
							if($isDND)
							{
								$error_text = "DND Number";
								$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,3,$error_text );
							} else {
							$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port);
								// ADDED on 2017-01-23
								if($this->_International == 1) {
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($sms_text);
								}else{
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($sms_text);
								}
								$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
								
								
								http_send($URL, $sms_port);
								 
								 
							} 
						} else {
							if($this->_dndCheck)
							{
								$isDND = $this->Campaign_model->checkIsDND($mobile_no);
								if($isDND)
								{
									$error_text = "DND Number";
									$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,3,$error_text );
								}else
								{
								$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port);
								if($this->_International == 1) {
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($sms_text);
								}else{
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($sms_text); }
									$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
									http_send($URL, $sms_port);
									
									
								}
									
							}else
							{
							$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port);
								if($this->_International == 1) {
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($sms_text);
								}else{
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($sms_text);}
								$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
								http_send($URL, $sms_port);
								
								// ADDED on 2017-01-23
								//$this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $sms_text,$sms_port);
								
								
							}
								
						}
					}  
				}

				if($total_numbers > $priority_sms_count) {
					 

					for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
						$mobile_no = trim($to_mobileno[$i]);
 
					 if($shorturl_input != NULL)
					{
						
						//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
						$result1 = $this->generateShortCode();
						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->Campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->Campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/';  
							$pos = stripos($newsms_text, $findString);
							if($pos === false) {
 
							}else{ 
								$str = substr($newsms_text, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
				 				$newshorturl_text = substr($shortCode, 0, 7);
 
	 						}
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text);  
					}else{
						$findString = 'ion.bz/';  
						$pos = stripos($smstext, $findString);
						if($pos === false) {
							$shortInput = FALSE;
						}else{ 
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shorturl_input = $shortInput = $this->Campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->Campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}
					$values = array(
						'campaign_id' => $campaign_id,
						'sms_text' => $smstext,
						'to_mobile_no' => $mobile_no,
						'created_on' => $created_on
						//'unique_msg_id' => $unique_msg_id


					);
					$dataV1[]=$values;


						//$this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
					}

					$this->Campaign_model->scheduledCampaignTo1($dataV1);
					/*

					 for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
					 $mobile_no = trim($to_mobileno[$i]);

					 $this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
					 }

					 */
				}
  
					
					
				if($total_numbers > $priority_sms_count) {
					$this->Campaign_model->update_campaign_status($campaign_id, '1');
				} else {
					$this->Campaign_model->update_campaign_status($campaign_id, '2');
				}
			}
			if($shorturl_input != NULL) {			           
				$findString = 'ion.bz/';
				$pos = stripos($smstext, $findString); 
				if($pos === false) {
					$shortInput = FALSE;  
				}else{
					$str = substr($smstext, $pos); 

					$shortCode = substr($str, strlen($findString)); 
					$short_code = substr($shortCode, 0, 7); 
				}    
				$getsendShorturl=$this->_data['UrlGenIp']."$short_code";      
				$this->Campaign_model->updateCampaignShortUrl($campaign_id,$shorturl_input,$getsendShorturl,$smstext);
			}
			
			redirect('campaign/viewcampaigns');
			return true;
		}//end of camapign id 
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
		
		$this->load->model('Campaign_model');
				
		$userID = $this->_userId;  
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		$data['abhibusUsers'] = $abhibusUsers;
		$usersList = ''; $this->_data['abhiBusUserNames'] = array();$this->_data['selectedAbhiUser'] = '';
		if(in_array($userID,$abhibusUsers)) {
			if($this->session->userdata('selectedAbhiUser')) {
				$this->_data['selectedAbhiUser'] = $userID = $this->session->userdata('selectedAbhiUser');
			}else{
				$this->_data['selectedAbhiUser'] = $userID = 4411;
			}
			$usersList = '4409,4411';
			$this->_data['abhiBusUserNames'] = $this->Campaign_model->getAbhiBusUsersNames($usersList);
		} 		

		$data['users'] = $this->Campaign_model->get_all_users($this->_userId);

		if($this->input->post('submit_search'))
		{
			if($this->input->post('username') == "")
			{
				$user_id = $userID;
			}
			else
			{
				$user_id = $userID = $this->input->post('username');
				if(in_array($userID,$abhibusUsers)) {
 					$this->session->set_userdata('selectedAbhiUser', $user_id);
 				}
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

			$data['result'] = $this->Campaign_model->get_all_smsreports($user_id,$from_date,$to_date);
 
		}
		else  
		{
			$data['result'] = $this->Campaign_model->get_all_smsreports($userID,$from_date,$to_date);
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
				$user_id=$userID;
			}
			$from_date = $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');

			$result1 = $this->Campaign_model->get_usersms_download($user_id,$from_date,$to_date);
				 
 
			$getreports=array();
			foreach($result1 as $key=>$dlrreportcount)
			{
				//echo $dlrreportcount;

				$arr1=explode(',',$dlrreportcount);
					
				//print_r($arr1);
				$Delivered=$arr1[0];
				$DND=$arr1[1];
				$Expired=$arr1[2];
				$Pending=$arr1[3];
				$invalid=$arr1[4];
				$getuserid=$arr1[5];
				$created_date=$arr1[6];
				$total=$arr1[7];
				$rs=$this->Campaign_model->get_username_download($getuserid);
				$username=$rs[0]->username;
					
				$dlr=array("Date"=>$created_date,"UserName"=>$username,"Delivered"=>$Delivered,"DND"=>$DND,"Failed"=>$Expired,"Pending"=>$Pending,"Invalid"=>$invalid,"Total"=>$total);
				$getreports[]=$dlr;
					
			}
				
 
				
				
			$fileName = 'Misreport.csv';
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
		$this->load->view('campaign/misreports',$data);
		$this->load->view('/includes/footer');
	}



	//================= controller method API MIS Report start==============
	public function api_misreports()
	{
		session_start();
		$rangeA = $this->input->post('rangeA');
		$from_date = "";  
		$to_date = "";
		if(strlen($rangeA)>0)
		{
			$split = explode("-",$rangeA);
			$from_date = $split[0].'-'.$split[1].'-'.$split[2];
			$to_date = $split[3].'-'.$split[4].'-'.$split[5];
		}
		$this->load->model('Campaign_model');
				
		$userID = $this->_userId;  
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		$data['abhibusUsers'] = $abhibusUsers;
		$usersList = ''; $data['abhiBusUserNames'] = array();$data['selectedAbhiUser'] = '';
		if(in_array($userID,$abhibusUsers)) {
			if($this->session->userdata('selectedAbhiUser')) {
				$data['selectedAbhiUser'] = $userID = $this->session->userdata('selectedAbhiUser');
			}else{
				$data['selectedAbhiUser'] = $userID = 4411;
			}
			$usersList = '4409,4411';
			$data['abhiBusUserNames'] = $this->Campaign_model->getAbhiBusUsersNames($usersList);
		} 		
		  
   
		if($this->input->post('submit_search'))
		{
			if($this->input->post('user_name') == "")
			{
				$user_id = $userID;
			}
			else
			{
				$user_id = $this->input->post('user_name');
				if(in_array($userID,$abhibusUsers)) {
 					$this->session->set_userdata('selectedAbhiUser', $user_id);
 				}
			}
				
			$newdata = array(
		           'rangeA'  => $rangeA,
		           'from_date'  => $from_date,
		           'to_date'  => $to_date,
		           'agent_id' => $this->input->post('user_name')
			);
			$this->session->set_userdata($newdata);
				
			  $from_date = $this->session->userdata('from_date');
			  $to_date = $this->session->userdata('to_date');

			$data['result'] = $this->Campaign_model->get_all_api_smsreports($user_id,$from_date,$to_date);
		}
		else
		{
			$data['result'] = $this->Campaign_model->get_all_api_smsreports($userID,$from_date,$to_date);
		}

		if($this->input->post('submit_reset'))
		{
			$this->session->unset_userdata('rangeA');
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');
			$this->session->unset_userdata('agent_id');
		}

		if($this->input->post('submit_download'))
		{
			if($this->session->userdata('agent_id') != "")
			{
				$user_id=$this->session->userdata('agent_id');
			}
			else
			{
				$user_id=$userID;
			}
			$from_date = $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');

			$result1 = $this->Campaign_model->get_userapi_download($user_id,$from_date,$to_date);
				
				
			$getreports=array();
			foreach($result1 as $key=>$dlrreportcount)
			{
				//echo $dlrreportcount;

				$arr1=explode(',',$dlrreportcount);
					
				 //print_r($arr1);
				$Delivered=$arr1[0];
				$DND=$arr1[1];
				$Expired=$arr1[2];
				$Pending=$arr1[3];
				$invalid=$arr1[4];
				$getuserid=$arr1[5];
				$created_date=$arr1[6];
				$total=$arr1[7];
				$rs=$this->Campaign_model->get_username_download($getuserid);
				$username=$rs[0]->username;
					
				$dlr=array("Date"=>$created_date,"UserName"=>$username,"Delivered"=>$Delivered,"DND"=>$DND,"Failed"=>$Expired,"Pending"=>$Pending,"Invalid"=>$invalid,"Total"=>$total);
				$getreports[]=$dlr;
					
			}
				
			 
				
				
			$fileName = 'API_Misreport.csv';
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
		$data['users'] = $this->Campaign_model->get_all_users($this->_userId);
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/api_misreports',$data);
		$this->load->view('/includes/footer');
	}
	
	//================= controller method API MIS Report end==============


	// ===== get credit history controller method start====

	public function credits_logs()
	{
		$data['page_title'] = "SMS Striker | Campaign Wise Credits Deducting";

		if($this->input->post('report_search') != '')
		{
			$newdata = array(
			   'from_date'  => $this->input->post('from_date'),
			   'to_date'     => $this->input->post('to_date'),
			);
			$this->session->set_userdata($newdata);
		}

		if($this->uri->segment(3) != '')
		{
			$offset = $this->uri->segment(3);
		}
		else
		{
			$offset = 0;
		}
		$limit="15";

		$this->load->library('pagination');
		$this->load->model('campaign_model');
		$user_id=$this->session->userdata('user_id');

		$from_date = $this->session->userdata('from_date');
		$to_date = $this->session->userdata('to_date');

		$data['logs_result'] = $this->campaign_model->get_credits_logs($user_id,$from_date,$to_date,$offset,$limit);
		$total_logs = $this->campaign_model->get_credits_logs_count($user_id,$from_date,$to_date);

		$config['base_url'] = site_url().'campaign/credits_logs';

		$config['total_rows'] = count($total_logs);
		$config['per_page'] = $limit;

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

		if($this->input->post('report_Download'))
		{
			$reports = array();
			if(count($total_logs)>0)
			{
				foreach($total_logs as $key => $value)
				{
					if($value->campaign_id != 0)
					{
						$id_val = $value->campaign_id;
					}
					else
					{
						$id_val = $value->job_id;
					}
					$values=array('Before Campaign Credits'=>$value->before_campaign_credits,'After Campaign Credits'=>$value->after_campaign_credits,'Used Credits'=>$value->current_campaign_credits,'Campaign Id'=>$id_val,'Date & Time'=>$value->date);
					array_push($reports,$values);
				}
			}
			else
			{
				print_r($total_logs);
			}
			//print_r($reports);
			$fileName = 'campaign_credits_logs.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($reports  as $key => $value) {
				if ( !$headerDisplayed ) {
					fputcsv($fh, array_keys($value));
					$headerDisplayed = true;$config['total_rows'] = count($total_logs);
					$config['per_page'] = $limit;
				}
				fputcsv($fh, $value);
			}
			fclose($fh);
			exit;
		}

		$this->load->view('includes/header', $this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('reseller/credits_campaign_logs',$data);
	}

	// ===== get credit history controller method end====
	
	
	/**  shortUrlSms adding in smsstriker on 2017-01-23  **/
	
	
	
	public function normalSMS()
	{
 		
 		if($this->session->userdata('user_id') ==  5742  || $this->session->userdata('user_id') ==  5741  || $this->session->userdata('user_id') ==  5740 || $this->session->userdata('user_id') ==  5739 )   {
			  redirect(base_url().'campaign/viewcampaigns');   
		}
   	  
		$this->_data['page_title'] = "Normal SMS";
		$this->session->unset_userdata('selected_sms_type');
		$this->session->unset_userdata('from_date');
		$this->session->unset_userdata('to_date');
		if ($this->input->post('sendsms')) {

			$this->load->library('form_validation');

			
			if($this->form_validation->run('single_sms_form') == TRUE) {
   

				//if($this->_userId=='2917')
				//{
				$this->_data['validatationtrue'] ="1";
				//}
				 
				$campaign_name = $this->input->post('campaign_name');
				$sms_text = $this->input->post('sms_text');
				$sender = $this->input->post('sender');
				$sms_type = $this->input->post('sms_type');
				//$is_schedule = $this->input->post('schedule');
				$scheduled_date = $this->input->post('on_date');
				$shorturl_input=$this->input->post('shorturl_input');
				$shorturl_text=$this->input->post('shorturl_text'); 
				 //print_r($this->input->post());exit;
 				$this->_data['error'] = '';$this->_data['no_balance']='';
				$error = false;
				$error_msg = ""; 
				$sms_text = trim($sms_text);
				//validating the scheduled date, if it is scheduled
				$is_schedule = '0';		
				if($scheduled_date != NULL) { $is_schedule = 1; };
				if($is_schedule) {
					if(!$scheduled_date) {
						$error = true;
						$this->_data['error'] = $error_msg .= "Please enter schedule date";
					}
						 
					$current_date_t = date_create(date("Y-m-d H:i:s"));
					$scheduled_date_t = date_create($scheduled_date);

					if( $current_date_t > $scheduled_date_t )
					{
						$error = true;
						$this->_data['error'] = $error_msg .= "Please enter valid schedule date";
					}
				} 

				//if client type is transactional, check for template if not dynamic
				if($this->_userType == 1 && $this->_template_check){
					//check for templates
					$temp_check = $this->_templateCheck($sms_text);
					if(!$temp_check){
						$error = true;
						$this->_data['error'] = $error_msg .= "SMS Text not matching with Approved Templates";
					}
				}
				//if client type is Promotional, check for Promotion Timings
				/*if($this->_userType != 1 )
				{
					$time = date('H');

						
					if($time < 8 || $time > 21)
					{
						$error = true;
						$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm.";

					}
				}
 */
 
				//if($this->_userType != 1 )
				if($this->_userType != 1 || $this->_dndCheck == 1 )
				{
 
					 if($is_schedule) {
					  	$time =  date('H', strtotime($scheduled_date)); 
 
						if($time < 9 || $time >= 21)
						{

   								$error = true;
								$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm.";				  
       
						}   
					 }else{ 
						$time = date('H');
 
						if($time < 9 || $time >= 21)
						{ 
								$error = true;
								$this->_data['error'] = $error_msg .= "Non Promotion Timings i.e., Before 9 am and after 9 Pm."; 
  							 
						} 

					}  
				}  
			  
				if($error) {
					$this->_data['error'] = $error_msg;
				} else {
					$to_mobileno = explode("\n",trim($this->input->post('to_mobileno')));
					//$to_mobileno = array_unique($to_mobileno); 
					//$to_mobileno = array_values($to_mobileno); 
					$normalSMSLimit = $this->config->item('normalSMSLimit');
					$totalMobileCount = count($to_mobileno);
					if($totalMobileCount > $normalSMSLimit) { 
						$this->_data['error'] = $this->_data['no_balance'] = "For More than $normalSMSLimit sms please use FILE SMS or CUSTOM SMS.";
  
					}else{
						$to_mobileno = array_slice($to_mobileno, 0, $normalSMSLimit); 
						
						$splMessage = $sms_text = trim($sms_text);
						$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

						$sms_text_spl = str_replace($special_char, ' ', $splMessage); 


						$special_char_2 = array('{','}','[',']','^','|','€','~');
						$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 
  
						if(strlen($sms_text_spl2)>160)
							$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
						else
							$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

						$sms_length=$sms_length_tmp;
						/*if(strlen($sms_text)>160)    
						$sms_length_tmp=ceil(strlen($sms_text)/153);
						else
						$sms_length_tmp=ceil(strlen($sms_text)/160);

						$sms_length=$sms_length_tmp;  */// changed on 26-12-2013 as per santosh request
						//$sms_length = ceil(strlen($sms_text)/160);
						$total_numbers = count($to_mobileno);
						 
						$total_no_of_sms = $total_numbers * $sms_length;
					
					
		    //checking credits
						if($total_no_of_sms > $this->_credits) {
							$this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$total_no_of_sms} credits";
						
						}
						else
						{
							//send SMS  

							//$this->_sendSMS($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text);
							  
							if(!$this->_data['error']) {
								 
								//Method to include shorturlsms & missedcall in normal sms, Created on 2017-01-23
								$this->_sendNormalSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text); 
							}
							//if($this->_userId!=2917){
							 // redirect('campaign/viewcampaigns');
							//}
						}   
					}  
				}
			}
		}
		$this->load->model('contact_model');
		$sender = array();
		if($this->_userType){
			$this->load->model('Campaign_model');
			//  $senderNames = $this->Campaign_model->getSenderNames($this->_userId);

			$this->load->model('user_model');
			$senderNames = $this->user_model-> getSenderNames_accept($this->_userId);
			 
			$sender[''] = '--select--';
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {  
			$sender['Promo'] = 'Promo';
		}
		$this->_data['sender_names'] = $sender;

		//get added templates
		$this->load->model('Campaign_model');
		$campaigns_data = $this->Campaign_model->getCampaignsLast($this->_userId);
		$this->_data['campaigns'] = $campaigns_data;

		$this->load->model('user_model');
		$limit = 25;$offset = '0';
		if($this->_template_check==1)
		{
			$templates = $this->user_model->getTemplatesApprove($this->_userId);
			$this->_data['templates'] = $templates;
		}else
		{
			$templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);
			$this->_data['templates'] = $templates;

		}
		if($this->_userType==0)
		{
			$templates = $this->user_model->getTemplates($this->_userId,$limit,$offset);
			$this->_data['templates'] = $templates;
		}
		$this->_data['did_result_response']=$this->get_misscalleddid_list();
		//print_r($data['did_result_response']);


		$groups = $this->contact_model->getGroups($this->_userId);

		$this->_data['groups'] = $groups;
 
		if($this->input->post('editsubmit')){

			$template=$this->input->post('edittemp');
			$template_id=$this->input->post('template_id');
			$this->user_model->updated_template($this->_userId,$template_id,$template);
			redirect('campaign/normalSMS');

		}

		if($this->input->post('addsubmit')){
			$template=$this->input->post('addtemp');
			$this->user_model->addTemplate($this->_userId,$template);
			redirect('campaign/normalSMS');
		}
		if($this->uri->segment(3) == "del")  
		{
			$template_id=$this->uri->segment(4);
			$this->user_model->delete_template($this->_userId, $template_id);
			redirect('campaign/normalSMS');
		}
 		$this->_data['user_id'] = $this->_userId;
		$this->_data['isInternational'] = $this->_International;

		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/normal-sms',$this->_data);  
		//$this->load->view('campaign/normal_sms_new');
		$this->load->view('includes/footer');
	}

   
	
	private function _sendFileSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text,$originalFile,$totalCount) {
		    
	$mobileNoCount = count($to_mobileno);
	//  date_default_timezone_set("Asia/Calcutta"); 
	//Country code and route port configuration 

 	if($this->_userId == 5813) {

		$CountryRoute = array("971" => "33013");
	}else{
		$CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
	}

  	$sms_text = trim($sms_text);
	// calculate SMS length  
	$splMessage = $sms_text1 = strtolower($sms_text);
	//remove special characters 
	//changed on 4thmay2015 by bharath for characters count.
	$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

	$sms_text_spl = str_replace($special_char, ' ', $splMessage);



	$special_char_2 = array('{','}','[',']','^','|','€','~');
	$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);
	//$sms_text_spl2 = trim($sms_text_spl2);
	 
	if(strlen($sms_text_spl2)>160)
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
	else
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

	$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request	
  

	$this->load->model('campaign_model');  
		
		
	//Config flag to check only valid numbers
	$isCheckInvalidNum = $this->config->item('checkInvalidNumbers');
	
	//Check valid numbers
	if($isCheckInvalidNum == 1 && $this->_International == 0) {
		$to_mobileno = $this->campaign_model->Validnumbers($to_mobileno);
	}	
		
	
	$to_mobileno = array_filter($to_mobileno);
	 $to_mobileno = array_values($to_mobileno); 
	 
	$total_numbers = count($to_mobileno);
 
	$total_numbers_ex_invalidno = $total_no_of_sms =  $total_numbers*$sms_length;

 
	$_sender = $sender;$sender_name = $sender;	 
	//sender names
if($this->_userType == 1){ //loop Transactional SMPP
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
			$portType = "LT1";
		} elseif($this->_userType == 0){            //loop Promo SMPP
			$sender = "0". rand(16066,16075);
			//$sender_name = "LM-" . $sender;
			$sender_name = $sender;
			$portType = "LP1";
 

		} elseif($this->_userType == 2){ //solutions infini transactional
			$portType = "ST1";
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
		} 

		if($this->_userType == 1 && $this->_dndCheck == 1){// semi trans
 
			$sender_name = $sender;
			$portType = "LS1";
			$portTypeNAS = 'NASP1';
		}
		
		 
	$this->load->model('Campaign_model');

	$sms_port = 0;
	//get port number based on port type
 
	//This is added for the purpose of trans scrub users on 23/08/2014

	/*if($this->_userType == 1 && $this->_dndCheck == 1){
		$sms_port='48113';
	}*/
 


	if($this->_userType == 1){ 
	$isValidSenderName = $this->Campaign_model->checkIsValidSenderName($this->_userId,$sender);
	if($isValidSenderName) {
		 $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}else{
		$sms_port =  $this->Campaign_model->getNASPortNumber($portTypeNAS);
	}  
	}else{
	 $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}
	
	 
	

if($this->_userId==4130)
{
$sms_port=0; 
}

if($this->_userId == 5874)
{
	$sms_port = 37513;
}
	
 
		
		
		
 	 $senderName_kennel = $sender;
 	if($sms_port > 0) {
 		$sms_portFor = $this->Campaign_model->getFirstPriorityPortType($sms_port);
 		if($sms_portFor == 1) {
 		 	if($this->_userType == 0) {
 				$senderName_kennel = "BA-611128";
 			}else{
 				$senderName_kennel = "BA-".$sender;
 			} 
 		}
 	}
	 
		
   		if($shorturl_input != NULL) {
 			$findString1 = 'ion.bz/';
			$pos1 = stripos($sms_text, $findString1); 
			if($pos1 === false) {
				$shorturl_input = '';$shorturl_text= '';
			}
  
		}  
	  $campaign_id = $this->Campaign_model->createFileShortUrlCampaign($this->_userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input,$total_numbers);
  	$date = date('Y-m-d');  $log = 'NO_OF_MSGS - '.$total_no_of_sms.' -----   CAMPAIGNID -  '.$campaign_id;
error_log($log."\r\n",3,"/var/www/html/logs/strikerCampReturnCredits_log/file_first_process".$date.".log");      

	    $shortInput = '';$getsendShorturl = '';
	if($campaign_id) {
		//deducting credits    
 
 
		$deductTotalFileCredits = $totalCount;  
 
		$current_balance = $this->Campaign_model->get_SMSCredits($this->_userId);
		
      
		//ADDED ON 2017-01-23  
		 $configFile = $this->config->item('configFile');
		$functionsFile = $this->config->item('functionsFile');  
              include($configFile);    
	 include($functionsFile);   
		
		$created_on=date("Y-m-d H:i:s");
 
		//if campaign is scheduled
		 $sendShorturl = ''; $smstext = $sms_text; 
            
		if($is_schedule) {
			//$dataV[]=null;  

			/*for($i=0; $i<count($to_mobileno); $i++) 
			{ 
				$mobile_no = trim($to_mobileno[$i]);
					//if(count($filter) > 0) {  
					if($shorturl_input != NULL)
					{
 
 
						$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text); 

						 
					}else{
						$findString = '/ion.bz/';  
						$pos = stripos($smstext, $findString); 
						if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shortInput = $this->campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;
  

							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							$smstext = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text); 
						}    
					}
					 
				$values = array(
				'campaign_id' => $campaign_id,
				'sms_text' => $smstext,
				'to_mobile_no' => $mobile_no,
				'created_on' => $created_on
				);
				$dataV[]=$values;
				//$this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
		        		
		        } */
                
                
			//  $this->Campaign_model->scheduledCampaignTo1($dataV); 
			$this->Campaign_model->update_campaign_status($campaign_id, '1');
 $ipAddress = $this->ip_address();
 				$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $deductTotalFileCredits,$current_balance,$campaign_id,$ipAddress);
				$this->Campaign_model->deductSMSCredits($this->_userId,$deductTotalFileCredits); 
			    
			 
				$mobileColumn = 0;$from_row = 0;$to_row=0; $total_no_of_sms =  0; 
				$largecampaignactivity_id = $this->Campaign_model->createLargeCampaignActivity_New($this->_userId,$campaign_id,$originalFile,$total_no_of_sms,$mobileColumn,$sms_text,$is_schedule,$from_row,$to_row);
				// redirect('campaign/viewcampaigns');  
			 
			 

            	} else {
            	
            						 	
			$priority_sms_count = 100;    

			if($total_numbers >= $priority_sms_count) {
				$offset = $priority_sms_count;
			} else {
				$offset = $total_numbers;  
			}

			//sms type - normal/ Flash SMS
			$mclass = "";
			if($sms_type==1) {
				$mclass = "&mclass=0";
			}
 
			$sendShorturl='';
			//campaign is immediate
			  $smstext=$sms_text;

			for($i=0; $i < $offset; $i++)
			{
                

				$mobile_no = trim($to_mobileno[$i]);

				    if(is_numeric($mobile_no)) {
 
					if($shorturl_input != NULL)
					{
						
					       // $result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
						$result1 = $this->generateShortCode();
						$sendShorturl=$result1;
						  $this->campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl); 
						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$getSmsText = $this->campaign_model->getLastCampaignSmsText($this->_userId);

   
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/';
							$pos = stripos($newsms_text, $findString); 
							if($pos === false) {
 
							}else{
								$str = substr($newsms_text, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
				 				$newshorturl_text = substr($shortCode, 0, 7);
 
	 						}	
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text);
					}else{
						$findString = 'ion.bz/';
						$pos = stripos($smstext, $findString); 
if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shorturl_input = $shortInput = $this->campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}
					 

						 
						//check is block listed number?
						//check is duplicate number? changed on 05/01/2015
						$is_duplicate=$this->campaign_model->checkduplicate($this->_userId,$sms_text,$sender,$mobile_no);
						//$is_duplicate=$this->campaign_model->checkduplicate($username,$sms_text,$sender,$mobile_no);
						$is_block_listed = $this->Campaign_model->isBlockListed($mobile_no,$this->_userId);  
						if($this->_International!=1) {
						
							if(empty($mobile_no) || !is_numeric($mobile_no)) {   
								$is_invalid_no = 1;$mobile_no = 0;
							}else{
								$is_invalid_no = $this->Campaign_model->isValidNo($mobile_no);
							} 
							
						}else{
							if(empty($mobile_no) || !is_numeric($mobile_no)) {   
								$is_invalid_no = 1;$mobile_no = 0;
							}else{
								$is_invalid_no = $this->Campaign_model->IsCountry($mobile_no,$this->_AllowedCountry);
							} 
						
							
							if(isset($CountryRoute[substr($mobile_no, 0, 4)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 4)];
							elseif(isset($CountryRoute[substr($mobile_no, 0, 3)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 3)];
							elseif(isset($CountryRoute[substr($mobile_no, 0, 2)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 2)];
							elseif(isset($CountryRoute[substr($mobile_no, 0, 1)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 1)];
							else $sms_port = "33013";  //Default Port
						}
	 					$smstext = trim($smstext);
						 
		            $IP = $this->_data['kernalIp'];
						if($is_block_listed){
					
							  $error_text = "Block Listed Number";
							$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,2, $error_text);
						}elseif($is_invalid_no){


							  $error_text = "Invalid Number";
							$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,16, $error_text);

						}elseif($is_duplicate){
							  $error_text = "Duplicate Msg";
							$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId, $sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port, 16, $error_text);
						} else {
  

							if(!$this->_userType){
		 

								 
								//check for dnd number
								$isDND = $this->Campaign_model->checkIsDND($mobile_no);
								 if($isDND)
								 {
									   $error_text = "DND Number";	
									 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext,  $sms_port,3,$error_text );
								 } else {
	 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,$dlr = null, $error_text= null);

									if($this->_International==1)
									{
										$URL= "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$mobile_no&text=".urlencode($smstext); 

									}
									else{
	 

										$URL= "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($smstext);
									}
									$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
									 http_send($URL, $sms_port); 

									
								}
						
						
								 
						
							} else {
								 
	 
								if($this->_dndCheck)
								{
									$isDND = $this->Campaign_model->checkIsDND($mobile_no);
									if($isDND)
									{
										$error_text = "DND Number";	
										$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, 3,$error_text );
									}else
									{
									$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
										if($this->_International==1)
										{
											$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($smstext); 
										}else{

											$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($smstext); 
										}
										$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
										 http_send($URL, $sms_port); 
										
									}

								}else
								{
$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
									if($this->_International==1)
									{
										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($smstext); 
									}else{


										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($smstext); 
									}
									$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port"); 
									http_send($URL, $sms_port);
									//echo $URL; 
							
		 
									
								}  

							} 
							 

					}
 
                    		}else{
					//redirect('campaign/fileSMS/notvalid');
				}
                    
                	} 
   
 		
			    $ipAddress = $this->ip_address();
			 	if($mobileNoCount  >= 100)  {
					$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $deductTotalFileCredits,$current_balance,$campaign_id,$ipAddress);
					$this->Campaign_model->deductSMSCredits($this->_userId,$deductTotalFileCredits); 
					$mobileColumn = 0;$from_row = 0;$to_row=0; $total_no_of_sms =  0; 
					$largecampaignactivity_id = $this->Campaign_model->createLargeCampaignActivity_New($this->_userId,$campaign_id,$originalFile,$total_no_of_sms,$mobileColumn,$sms_text,$is_schedule,$from_row,$to_row);
					// redirect('campaign/viewcampaigns');  
			 	}else{
					$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $total_numbers_ex_invalidno,$current_balance,$campaign_id,$ipAddress);
					$this->Campaign_model->deductSMSCredits($this->_userId,$total_numbers_ex_invalidno);	
				}
			    

              		/*if($total_numbers > $priority_sms_count)
			{
				for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
					$mobile_no = trim($to_mobileno[$i]);
 					//if(count($filter) > 0) {
					if($shorturl_input != NULL)
					{
						$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
						$sendShorturl=$result1;
						$this->campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$getSmsText = $this->campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text);
						 
					}else{
						$findString = '/ion.bz/';
						$pos = stripos($smstext, $findString); 
if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos);   
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shortInput = $this->campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text); 
						}    
					}
					 
 
					$values = array(
						'campaign_id' => $campaign_id,
						'sms_text' => $smstext,
						'to_mobile_no' => $mobile_no,
						'created_on' => $created_on
						//'unique_msg_id' => $unique_msg_id


					);
					$dataV1[]=$values;
  


					//$this->Campaign_model->scheduledCampaignTo($campaign_id, $smstext, $mobile_no);
				}


				$this->Campaign_model->scheduledCampaignTo1($dataV1);
			}
			
  			*/  
			
			//if($total_numbers > $priority_sms_count) {
			if($mobileNoCount  >= 100)  {
				$this->Campaign_model->update_campaign_status($campaign_id, '1');
			} else {
				$this->Campaign_model->update_campaign_status($campaign_id, '2'); 
			} 
			    
		} 
		if($shorturl_input != NULL) { 
                $findString = 'ion.bz/';
		$pos = stripos($smstext, $findString); 
		if($pos === false) {
			$shortInput = FALSE;  
		}else{
			$str = substr($smstext, $pos); 

			$shortCode = substr($str, strlen($findString)); 
			$short_code = substr($shortCode, 0, 7); 
		}    
		$getsendShorturl=$this->_data['UrlGenIp']."$short_code"; 	  


                $this->Campaign_model->updateCampaignShortUrl($campaign_id,$shorturl_input,$getsendShorturl,$smstext);
		 
		}
		
	   redirect('campaign/viewcampaigns');
            return true;  
        }//end of camapign id
        	
	}
	   

	 private function _sendNormalSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text)
   {
       
	//  date_default_timezone_set("Asia/Calcutta"); 
	//Country code and route port configuration  
	

	if($this->_userId == 5813) {

		$CountryRoute = array("971" => "33013");
	}else{
		$CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
	}
	
	

  	$sms_text = trim($sms_text);
	// calculate SMS length
	$splMessage = $sms_text1 = strtolower($sms_text);
	//remove special characters 
	//changed on 4thmay2015 by bharath for characters count.
	$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

	$sms_text_spl = str_replace($special_char, ' ', $splMessage); 


          
	$special_char_2 = array('{','}','[',']','^','|','€','~');
	$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 

	if(strlen($sms_text_spl2)>160)
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
	else
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

	$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request	
	//$sms_length = ceil(strlen($sms_text)/160);

 
 
	$this->load->model('campaign_model');
	
	//Config flag to check only valid numbers
	$isCheckInvalidNum = $this->config->item('checkInvalidNumbers');
	
	//Check valid numbers
	if($isCheckInvalidNum == 1 && $this->_International == 0) {
		$to_mobileno = $this->campaign_model->Validnumbers($to_mobileno);
	}
	
	
	$to_mobileno = array_filter($to_mobileno);
	 $to_mobileno = array_values($to_mobileno); 
 
	$total_numbers = count($to_mobileno);
	$total_numbers_ex_invalidno = $total_no_of_sms = $total_numbers*$sms_length;
 
 
		
 
 
	 $_sender = $sender;
	//sender names
	if($this->_userType == 1){ //loop Transactional SMPP
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
			$portType = "LT1";
		} elseif($this->_userType == 0){            //loop Promo SMPP
			$sender = "0". rand(16066,16075);
			//$sender_name = "BA-".$sender;
			$sender_name = $sender;
			$portType = "LP1"; 

		} elseif($this->_userType == 2){ //solutions infini transactional
			$portType = "ST1";
			$sender_name = $sender;
			$portTypeNAS = 'NAST1';
		} 

		if($this->_userType == 1 && $this->_dndCheck == 1){// semi trans
 
			$sender_name = $sender;
			$portType = "LS1";
			$portTypeNAS = 'NASP1';
		}
		
		 

	$this->load->model('Campaign_model');

	$sms_port = 0;
	//get port number based on port type
 
	//This is added for the purpose of trans scrub users on 23/08/2014

 	 
 
	 if($this->_userType == 1) { 
		$isValidSenderName = $this->Campaign_model->checkIsValidSenderName($this->_userId,$sender);
		if($isValidSenderName) {
			$sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
		}else{
			$sms_port =  $this->Campaign_model->getNASPortNumber($portTypeNAS);
		}  
	}else{
		$sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	}
	  
  
  	
 	
 	
 	  
   
   if($this->_userId == 5874)
{
	$sms_port = 37513;  
}  


if($this->_userId==4130)
{
$sms_port =0;

}
 
   
 		 
		 
		 
		 if($this->_userId==4453)
		{ 
			$sms_port = 34313;
		} 
		 
                 /*if($this->_userId==4248)
                {
                        $sms_port = 11113;
                }*/                

		if($this->_userId==6116)
		{ 
			$sms_port = 36113;
		} 
		
		
		
		if($this->_userId == 4455)
		{ 
			$sms_port = 51113;
		} 
		
		
   $senderName_kennel = $sender;
 	if($sms_port > 0) {
 		$sms_portFor = $this->Campaign_model->getFirstPriorityPortType($sms_port);
 		if($sms_portFor == 1) {
 		 	if($this->_userType == 0) {
 				$senderName_kennel = "BA-611128";
 			}else{
 				$senderName_kennel = "BA-".$sender;
 			} 
 		}
 	}

	//create campaign
	//ADDED ON 2017-01-23
	 if($shorturl_input != NULL) {  
 			$findString1 = 'ion.bz/';
			$pos1 = stripos($sms_text, $findString1); 
			if($pos1 === false) {
				$shorturl_input = '';$shorturl_text= '';
			}
  
		}  
 
	    $campaign_id = $this->Campaign_model->createShortUrlCampaign($this->_userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorturl_text,$shorturl_input,$total_numbers);  
 
 $request = json_encode($to_mobileno); 
	$date = date('Y-m-d');
	$userID = $this->_userId; 

	error_log("\n".date('Y-m-d H:i:s')."| Requested Numbers for campaign - $campaign_id | ".$request."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/campaign_logs/str_Normalsms_".$userID.".log"); 
 
 
	  $shortInput = '';$getsendShorturl = ''; 
	if($campaign_id) {  
		//deducting credits
		$current_balance = $this->Campaign_model->get_SMSCredits($this->_userId);
		  $ipAddress = $this->ip_address();
		$this->Campaign_model->insert_SMSCredits_logs($this->_userId, $total_numbers_ex_invalidno,$current_balance,$campaign_id,$ipAddress);
		$this->Campaign_model->deductSMSCredits($this->_userId, $total_numbers_ex_invalidno); 
		
		if($total_numbers_ex_invalidno >= 50000) {
		$userName = $this->session->userdata('username');
		$sampleSubText = substr($sms_text, 0, 70);

			$this->sendAlert($campaign_id,$userName,$sampleSubText,$total_numbers_ex_invalidno); 
		} 

		//ADDED ON 2017-01-23
		 $configFile = $this->config->item('configFile');
		$functionsFile = $this->config->item('functionsFile');
     include($configFile);
	   include($functionsFile); 
		
		$created_on=date("Y-m-d H:i:s");
		//if campaign is scheduled
		 $sendShorturl = ''; $smstext = $sms_text; 
 		 
 
		if($is_schedule) {
			//$dataV[]=null;  
 
			for($i=0; $i<count($to_mobileno); $i++) 
			{
				$mobile_no = trim($to_mobileno[$i]);

                
					if($shorturl_input != NULL)
					{
						//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
						$result1 = $this->generateShortCode();
						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->campaign_model->getLastCampaignSmsText($this->_userId);

   
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/';
							$pos = stripos($newsms_text, $findString); 
							if($pos === false) {
 
							}else{
								$str = substr($newsms_text, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
				 				$newshorturl_text = substr($shortCode, 0, 7);
 
	 						}
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text); 
					}else{
						$findString = 'ion.bz/';
						$pos = stripos($smstext, $findString); 
						if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shorturl_input = $shortInput = $this->campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}   
				 
				$values = array( 
				'campaign_id' => $campaign_id,
				'sms_text' => $smstext,
				'to_mobile_no' => $mobile_no,
				'created_on' => $created_on
				);
				$dataV[]=$values;
				//$this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
		        		
		        } 
			  $this->Campaign_model->scheduledCampaignTo1($dataV); 
			$this->Campaign_model->update_campaign_status($campaign_id, '1');

            	} else {
            	
            								 	
			$priority_sms_count = 100;

			if($total_numbers >= $priority_sms_count) {
				$offset = $priority_sms_count;
			} else {
				$offset = $total_numbers;
			}

			//sms type - normal/ Flash SMS
			$mclass = "";
			if($sms_type==1) {
				$mclass = "&mclass=0";
			}
 
			$sendShorturl='';
			//campaign is immediate
			 $smstext=$sms_text;

			for($i=0; $i < $offset; $i++)
			{
                

				$mobile_no = trim($to_mobileno[$i]);


 

					if($shorturl_input != NULL)
					{
						//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
						$result1 = $this->generateShortCode();

						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/';
							$pos = stripos($newsms_text, $findString); 
							if($pos === false) {
 
							}else{
								$str = substr($newsms_text, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
								$shortCode = trim($shortCode);

				 				$newshorturl_text = substr($shortCode, 0, 7);
 
							}
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text); 
					}else{
						$findString = 'ion.bz/';
						$pos = stripos($smstext, $findString); 
if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
						$shortCode = trim($shortCode);

		 				$short_code = substr($shortCode, 0, 7);
 						$shorturl_input = $shortInput = $this->campaign_model->getShortcodeInput($short_code);
						}
 						
						

						if($shortInput) {
							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}
				 
					//check is block listed number?
					//check is duplicate number? changed on 05/01/2015
					$is_duplicate=$this->campaign_model->checkduplicate($this->_userId,$sms_text,$sender,$mobile_no);
					//$is_duplicate=$this->campaign_model->checkduplicate($username,$sms_text,$sender,$mobile_no);
					$is_block_listed = $this->Campaign_model->isBlockListed($mobile_no,$this->_userId);  
					if($this->_International!=1){
					
						if(empty($mobile_no) || !is_numeric($mobile_no)) {   
							$is_invalid_no = 1;$mobile_no = 0;
						}else{
							$is_invalid_no = $this->Campaign_model->isValidNo($mobile_no);
						} 
						  
					}else{
						if(empty($mobile_no) || !is_numeric($mobile_no)) {   
							$is_invalid_no = 1;$mobile_no = 0;
						}else{
							$is_invalid_no = $this->Campaign_model->IsCountry($mobile_no,$this->_AllowedCountry);
						} 
						
						if(isset($CountryRoute[substr($mobile_no, 0, 4)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 4)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 3)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 3)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 2)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 2)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 1)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 1)];
						else $sms_port = "33013";  //Default Port

					} 
 
 
 					 
					$smstex = trim($smstext);
 						
					if($is_block_listed){ 
					
						 $error_text = "Block Listed Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId, $sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,2, $error_text);
					}elseif($is_invalid_no){


						 $error_text = "Invalid Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId, $sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,16, $error_text);

					}elseif($is_duplicate){
						 $error_text = "Duplicate Msg";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId, $sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port, 16, $error_text);
					} else {

                     $IP = $this->_data['kernalIp'];
                     
                     
 					
 					
						if(!$this->_userType){ // promotional block
	 

							 
							//check for dnd number
				$isDND = $this->Campaign_model->checkIsDND($mobile_no);
				if($isDND)
				{
				$error_text = "DND Number";	
																																																																				$this->Campaign_model->campaignToNormalShorturl($campaign_id,$this->_userId,$sender_name, $sendShorturl, $sms_length, $mobile_no, $smstext,  $sms_port,3,$error_text );
				} else {
	$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,$dlr = null, $error_text= null); 

				if($this->_International==1)
				{
				$URL= "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$mobile_no&text=".urlencode($smstext); 

				}
				else{

                     $IP = $this->_data['kernalIp'];
				$URL= "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($smstext);
				}
				$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");

				http_send($URL, $sms_port); 
  
			 
				}
					
						
							 
						
						} else {
							 
                     $IP = $this->_data['kernalIp'];
                     
                   
							if($this->_dndCheck)
							{
								$isDND = $this->Campaign_model->checkIsDND($mobile_no);
								if($isDND)
								{
									$error_text = "DND Number";	
									$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, 3,$error_text );
								}else
								{
								$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
									if($this->_International==1)
									{
										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($smstext); 
									}else{


										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($smstext); 
									}
                     $IP = $this->_data['kernalIp'];
									 $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");

									 http_send($URL, $sms_port); 
									
								}

							}else
							{
$this->Campaign_model->campaignToNormalShorturl($campaign_id, $this->_userId,$sender_name,$sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
								if($this->_International==1)
								{
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=$mobile_no&text=".urlencode($smstext); 
								}else{

                     $IP = $this->_data['kernalIp'];

  
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel) ."&to=91$mobile_no&text=".urlencode($smstext); 
								}
								$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("$IP/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port"); 
								http_send($URL, $sms_port);
								//echo $URL; 
							
						 
	 
								
							}  

						} 
						 

				}

                    
                    
                	} 
 
 
			 

              		if($total_numbers > $priority_sms_count)
			{

 
				for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
					$mobile_no = trim($to_mobileno[$i]);
					//$unique_msg_id = $this->Campaign_model->get_unique();
 
					if($shorturl_input != NULL)
					{ 
						//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
						$result1 = $this->generateShortCode();
						$sendShorturl=$result1;

						$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
						$this->campaign_model->addShortUrl($shorturl_input,$this->_userId,$sendShorturl);
						$getSmsText = $this->campaign_model->getLastCampaignSmsText($this->_userId);

 
						foreach($getSmsText as $key=>$newsmsvalue)
						{
							$newsms_text=$newsmsvalue->sms_text;
							$newshorturl_text=$newsmsvalue->shorturl_text;
							$findString = 'ion.bz/';
							$pos = stripos($newsms_text, $findString); 
							if($pos === false) {
 
							}else{
								$str = substr($newsms_text, $pos); 
			  					$shortCode = substr($str, strlen($findString)); 
				 				$newshorturl_text = substr($shortCode, 0, 7);
 
	 						}
						}
						$newshorturl_text = str_replace("\n", "", $newshorturl_text);
						$newshorturl_text = str_replace("\t", "", $newshorturl_text);
						$newshorturl_text = str_replace("\r", "", $newshorturl_text);

						$smstext = str_replace($newshorturl_text, "$sendShorturl", $newsms_text);
					} else{
						$findString = 'ion.bz/';
						$pos = stripos($smstext, $findString); 
if($pos === false) {
							$shortInput = FALSE;
						}else{
						$str = substr($smstext, $pos); 
	  					$shortCode = substr($str, strlen($findString)); 
		 				$short_code = substr($shortCode, 0, 7);
 						$shorturl_input = $shortInput = $this->campaign_model->getShortcodeInput($short_code);
 						}
						if($shortInput) {
							//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
							$result1 = $this->generateShortCode();
							$sendShorturl=$result1;  

							$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 

							$this->campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
 							$newsms_text= $smstext;


							$newshorturl_text=$this->_data['UrlGenIp']."$short_code"; 
							$newshorturl_text = str_replace("\n", "", $newshorturl_text);
							$newshorturl_text = str_replace("\t", "", $newshorturl_text);
							$newshorturl_text = str_replace("\r", "", $newshorturl_text);
 
							  $smstext = str_replace($short_code, "$sendShorturl", $newsms_text); 
						}    
					}
					$values = array(
						'campaign_id' => $campaign_id,
						'sms_text' => $smstext,
						'to_mobile_no' => $mobile_no,
						'created_on' => $created_on
						//'unique_msg_id' => $unique_msg_id


					);
					$dataV1[]=$values;



					//$this->Campaign_model->scheduledCampaignTo($campaign_id, $smstext, $mobile_no);
				}

 
				  $this->Campaign_model->scheduledCampaignTo1($dataV1);   
			}
			
 
			
			if($total_numbers > $priority_sms_count) {
				$this->Campaign_model->update_campaign_status($campaign_id, '1');
			} else {
				$this->Campaign_model->update_campaign_status($campaign_id, '2'); 
			} 
			  
		}  
		if($shorturl_input != NULL) {
			$findString = 'ion.bz/';
			$pos = stripos($smstext, $findString); 

			if($pos === false) {
				$shortInput = FALSE;  
			}else{
				$str = substr($smstext, $pos); 
				$shortCode = substr($str, strlen($findString)); 
				$short_code = substr($shortCode, 0, 7); 
			}   


 
			$getsendShorturl=$this->_data['UrlGenIp']."$short_code";  
				$userID = $this->_userId;
						 
                  
       		   $this->Campaign_model->updateCampaignShortUrl($campaign_id,$shorturl_input,$getsendShorturl,$smstext);
		}
     

     	redirect('campaign/viewcampaigns');
      	 return true;	  
         
        }//end of camapign id  
        
          
        
    }    
   
   

	  


	public function  get_misscalleddid_list()
	{
		$real_url=$this->data; 
		$user_id =$this->session->userdata('user_id');
		//$did_url = $real_url."/inboundservice/get_misscalleddid_list.php";
		
		//ADDED ON 2017-01-23
		
		$api_url=$this->config->item('host_api_url');
		$did_url = 'http://'.$api_url.'/collegecrm/inboundservice/get_misscalleddid_list.php';
		$did_fields = array(
		'user_id' => $user_id);
		$did_string = http_build_query($did_fields);
		//print_r($audio_string);
		$did_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_ch,CURLOPT_URL, $did_url);
		curl_setopt($did_ch,CURLOPT_POST, count($_POST));
		curl_setopt($did_ch,CURLOPT_POSTFIELDS, $did_string);
		curl_setopt($did_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($did_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_ch);
		$did_result_response =json_decode($did_result, true);
		//print_r($audio_result_response);
		curl_close($did_ch);
		$result1=$did_result_response;     
		if(count($result1)>0)
		{
			$result=$result1;
		}
		else
		{
			$result=array();
		}

		return $result;

  
	}
	
	
	
	public function shorturl_allreports()
	{
 
            $total_rows1=0;
            $limit = 15;  
            $off_set = 0;
		$this->load->library('session');
		   
		 $from_date  = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
		 $to_date  = date('Y-m-d');
		if($this->input->post('shorturl_report_search') != '')
		{
			$this->session->unset_userdata('from_date');
		        $this->session->unset_userdata('to_date');
		       $this->session->unset_userdata('longurl');
	    	        $newdata = array(
			   'from_date'  => $this->input->post('from_date'),
			   'to_date'     => $this->input->post('to_date'),
			   'longurl' => $this->input->post('longurl'),
			);
			$this->session->set_userdata($newdata);
			
			$from_date = $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');
 
		}          
		      
	
		$longurl = $this->session->userdata('longurl');
 
 
	
		$this->load->library('pagination');
		$this->load->helper('url');
		
		if($this->uri->segment(3))
		{
			$off_set = $this->uri->segment(3);
		}
		     
		if($this->session->userdata('from_date')) {
				$this->_data['from_date'] =  $from_date = $this->session->userdata('from_date');
		}else{
			$this->_data['from_date'] = $from_date;
		}
		if($this->session->userdata('to_date')) {
			$this->_data['to_date'] = $to_date = $this->session->userdata('to_date');
		}else{
			$this->_data['to_date']  =  $to_date;
		}	        

		$reseller_id=$this->_userId;
		$this->load->model('campaign_model');

	    	$user_id='';

		$this->_data['page_title'] = "All Long Code Reports";
		$this->load->model('Campaign_model');


		
 
		if($this->input->post('shorturl_download'))
		{
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$longurl = $this->input->post('longurl');
	
			$download_shorturl_result=$this->Campaign_model->shorturl_reportssearch($this->_userId,$from_date,$to_date,$longurl,$off_set=NULL,$limit=NULL);
 
			$reports = array();
			if(count($download_shorturl_result)>0)
		    	{
				foreach($download_shorturl_result as $key => $value)
				{
				$values=array('Phone'=>$value['to_mobile_no'],'Ip Address'=>$value['ip_address'],'Device type'=>$value['device_type'],'Browser type'=>$value['browser_type'],'Operating System'=>$value['operating_system'],'Build by'=>$value['build_by'],'Long URL'=>$value['long_url'],'No of Tries'=>$value['counter'],'Date & Time'=>$value['created_on']);
				array_push($reports,$values);
				}
			}
		
 
			$fileName = 'shorturl_report.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($reports  as $key => $value) {
			if ( !$headerDisplayed ) {
			fputcsv($fh, array_keys($value));
			$headerDisplayed = true;
			}
			fputcsv($fh, $value);
			}  
			fclose($fh);
			exit;
		}



		$data['users']=$this->Campaign_model->getUserNames($this->_userId);
		  
		$this->load->model('reseller_model');

		$get_agent_nums_names=$this->reseller_model->get_users($this->_userId);
		$data['getagent_numbers']=$get_agent_nums_names;
		 
		  
  
     

		$total_rows1= $this->Campaign_model->shorturl_reportssearch_newcount($this->_userId,$from_date,$to_date);
  
 		$data['shorturlreports']=$this->Campaign_model->shorturl_reportssearch_new($this->_userId,$limit,$off_set,$from_date,$to_date);	  
 
 
		      $this->load->library('pagination');
			$config['base_url'] = base_url().'campaign/shorturl_allreports';
		      $config['total_rows'] = @$total_rows1;
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
		 
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
 
		$this->load->view('campaign/all_shorturl_reports',$data);
		$this->load->view('includes/footer');
	}
  
  
	  	
	/*public function Agentput_userscampaignFeedback()
	{
 
		$this->load->model('Campaign_model');
		$user_id = $this->_userId;
		$users_reason = $_REQUEST['users_reason'];
		$users_comment = $_REQUEST['users_comment'];
		$users_phoneno = $_REQUEST['users_phoneno'];
		$lead_id = @$_REQUEST['lead_id'];
		     
		$lead_assigntbl="crm.lead_assign";

		$usersfeedback_result = $this->Campaign_model->Agentput_userscampaignFeedback($lead_assigntbl,$user_id,$users_reason,$users_comment,$users_phoneno,$lead_id);
		    $result1=$usersfeedback_result;
		  // print_r($result1);
		  
		  if(count($result1)>0)
		{

		//$result=$result1;
		 foreach($result1 as $userleads)  {?>	
	      <tr>
	    <td><?php echo $userleads->username;  ?></td>
	    <td><?php echo $userleads->reason;  ?></td>
	   <td><?php echo $userleads->feedback;  ?></td>
	   </tr>
	     <?php } ?>

		<?php
		}
		else
		{
		$result1=array();
		}

		return $result1; 
	} 
	  
	   
	 public function feedbackform_reports()
	{
		$this->load->model('Campaign_model');
		$shortcode = $this->uri->segment(3);
	
		$data['header_form'] = $this->Campaign_model->shortcode_dynamicfields($shortcode);
		$data['feedback_form'] = $this->Campaign_model->feedbackform_reports($shortcode);

		if($this->input->post('feedbackform_report_search') != '')
		{
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');

			$data['feedback_form'] = $this->Campaign_model->feedbackform_reportssearch($shortcode,$from_date,$to_date);
		}

		if($this->input->post('shorturl_download'))
		{
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
	
			if($from_date != '' || $to_date != '')
			{
				$download_shorturl_result = $this->Campaign_model->feedbackform_reportssearch($shortcode,$from_date,$to_date);
			}
			else
			{
				$download_shorturl_result = $this->Campaign_model->feedbackform_reports($shortcode);
			}

			$reports = array();
			if(count($download_shorturl_result)>0)
		    	{
				foreach($download_shorturl_result as $value)
				{
					$header_result = $data['header_form'];
					$res_12 = array_combine($header_result,$value);

					$values = $res_12;
					array_push($reports,$values);
				}
			}
			//print_r($reports);
			$fileName = 'feedbackform_report.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($reports  as $key => $value) {
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
		$this->load->view('campaign/feedbackform_reports',$data);
		$this->load->view('includes/footer');
	}     */
	
	public function shortcode_reports()
        {
 
		$this->_data['page_title'] = "All Long Code Reports";
		$this->load->model('Campaign_model');

		$shortcode = $this->uri->segment(4);
            $campaign_id = $this->uri->segment(3);
            
            $limit="15";  
		$offset="0";
		
	 //  $data['shorturlreports']=$this->Campaign_model->shortcode_all_reports($this->_userId,$shortcode,$campaign_id,$limit,$offset);
          // print_r($data['shorturlreports']);
		if($this->input->post('shorturl_report_search'))
		{
 
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');

			$data['shorturlreports']=$this->Campaign_model->shortcode_reportssearch($this->_userId,$from_date,$to_date,$shortcode);
   
		}

		if($this->input->post('shorturl_download'))
		{
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
	
			if($from_date != '' || $to_date != '')
			{
			$download_shorturl_result=$this->Campaign_model->shortcode_reportssearch($this->_userId,$from_date,$to_date,$shortcode);
			}
			else
			{
			$download_shorturl_result=$this->Campaign_model->shortcode_all_reports($this->_userId,$shortcode,$campaign_id,$limit,$offset);
			}
  
			$reports = array();  
			if(count($download_shorturl_result)>0)
		    	{
				foreach($download_shorturl_result as $key => $value)
				{
						$shortCode = $this->_data['UrlGenIp'].$value['short_code'];
					//$values=array('Phone'=>$value['to_mobile_no'],'Ip Address'=>$value['ip_address'],'Device type'=>$value['device_type'],'Browser type'=>$value['browser_type'],'Operating System'=>$value['operating_system'],'Build by'=>$value['build_by'],'Long URL'=>$value['long_url'],'Date & Time'=>$value['created_on']);
					$values=array('Phone'=>$value['to_mobile_no'],'Ip Address'=>$value['ip_address'],'Device type'=>$value['device_type'],'Browser type'=>$value['browser_type'],'Operating System'=>$value['operating_system'],'Build by'=>$value['build_by'],'Short URL'=>$shortCode,'Date & Time'=>$value['created_on']);
				array_push($reports,$values);
				}
			}
			//print_r($reports);
			$fileName = 'shorturl_report.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($reports  as $key => $value) {
			if ( !$headerDisplayed ) {
			fputcsv($fh, array_keys($value));
			$headerDisplayed = true;
			}
			fputcsv($fh, $value);
			}
			fclose($fh);
			exit;
		}
		
		
		if($this->uri->segment(5)!='')
		{
		$offset=$this->uri->segment(5);
		}
		
		$data['shorturlreports']=$this->Campaign_model->shortcode_all_reports($this->_userId,$shortcode,$campaign_id,$limit,$offset);
		
		$total_rows=$this->Campaign_model->shortcode_all_reportsCount($this->_userId,$shortcode,$campaign_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'campaign/shortcode_reports/'.$campaign_id.'/'.$shortcode.'/';
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
  
		// print_r($data['shorturlreports']);   
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/shortcode_reports',$data);
		$this->load->view('includes/footer');
	}     
	         
	
	public function shorturl_reports_download() {
		$this->load->model('Campaign_model');
   
		 $campaign_id = $this->uri->segment(3);
 		$shortcode = $this->uri->segment(4);
		 $download_shorturl_result=$this->Campaign_model->shortcode_download_all_reports($this->_userId,$shortcode,$campaign_id);
			//print_r($download_shorturl_result);exit; 
  
			$reports = array();    
			if(count($download_shorturl_result)>0)
		    	{
				foreach($download_shorturl_result as $key => $value)
				{
					$shortCode = $this->_data['UrlGenIp'].$value['short_code'];
					 
					$values = array(

							'Phone' => $value['to_mobile_no'],
							'Short URL'=> $shortCode, 
							'Ip Address' => $value['ip_address'],
							'Device type' => $value['device_type'],
							'Browser type'=> $value['browser_type'],
							'Operating System' => $value['operating_system'],
							'Build by' => $value['build_by'],
							'Date & Time' => $value['created_on']
						);
				array_push($reports,$values);    
				}
			}
			// print_r($reports);exit;
			$fileName = 'shorturl_report.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($reports  as $key => $value) {
			if ( !$headerDisplayed ) {
			fputcsv($fh, array_keys($value));
			$headerDisplayed = true;
			}
			fputcsv($fh, $value);
			}
			fclose($fh);
			exit;
	}
	
	public function missedcall_allreports()
	{
	      session_start();
		$reseller_id=$this->_userId;
	
		$this->load->model("campaign_model");

		if($this->input->post('assign_masking'))
		{
		      	if($this->input->post('assigncampiagn') !='')
			{
				  if($this->input->post('username'))
				  { 
				 	 $user_id=$this->input->post('username');
				  }  
				     
				  $mobile = $this->input->post('assigncampiagn');
				  $this->campaign_model->assignmissedcall($mobile,$user_id,$reseller_id);
			 }
			 
			 if($this->input->post('unassigncampiagn')!='')
			 {  
				  if($this->input->post('username'))
				  { 
				  	$user_id=$this->input->post('username');
				  }  
				 
				  $mobile = $this->input->post('unassigncampiagn');
				  $this->campaign_model->unassigncampainsvalues($mobile,$user_id,$reseller_id);
			 }
		} 

		$data['users']=$this->campaign_model->getUserNames($this->_userId);

		$real_url=$this->config->item('host_api_url');
		$this->_data['page_title'] = "All Missed Call Reports";
	
		  
		   if($this->uri->segment(3)=='sessout')
		 {
		 
		     unset($_SESSION['from_date']);
			 unset($_SESSION['to_date']);
			 unset($_SESSION['phone_no']);
			 unset($_SESSION['service_no']);
			 redirect('campaign/missedcall_allreports');
		 
		 }
	
		 if($this->input->post('misscall_report_search')){
	 
	       unset($_SESSION['from_date']);
	       unset($_SESSION['to_date']);
	       unset($_SESSION['phone_no']);
	       unset($_SESSION['service_no']);
	       
	       $_SESSION['from_date']=$_REQUEST['from_date'];
	       $_SESSION['to_date']=$_REQUEST['to_date'];
	       $_SESSION['phone_no']=$_REQUEST['phone_no'];
	       $_SESSION['service_no']=$_REQUEST['service_no'];
	       redirect('campaign/missedcall_allreports');
	       }
	   
	   

	   	
		$user_id=$this->session->userdata('user_id');
		
		
		$offset="0";
		if($this->uri->segment(3)!='')
		{
		 $offset=$this->uri->segment(3);
		}
		$limit=15;
		$from_date='';
		$to_date='';
		$phone_no='';
		$service_no='';
		
		if(@$_SESSION['from_date']!='')
		{
		 $from_date=@$_SESSION['from_date'];
		}
		 if(@$_SESSION['to_date']!='')
		{
		 $to_date=@$_SESSION['to_date'];
		}
		 if(@$_SESSION['phone_no']!='')
		{
		 $phone_no=@$_SESSION['phone_no'];
		}
		 if(@$_SESSION['service_no']!='')
		{
		 $service_no=@$_SESSION['service_no'];
		}
		

	
		 $misscall_fields = array(
		'user_id' => urlencode($user_id),
		 'fdate'=> urlencode($from_date),
		 'tdate'=> urlencode($to_date),
		 'phone_no'=> urlencode($phone_no),
		 'service_no'=> urlencode($service_no),
		 'limit' => urlencode($limit),
		   'offset' => urlencode($offset)
		 );
	
		// ADDED ON 2017-01-23
		$api_url=$this->config->item("host_api_url");	
		$router_type_url = 'http://'.$api_url.'/missedcall_api.php';
			  
	     	
	
		$misscall_string = http_build_query($misscall_fields);
	      	//open connection
		$misscall = curl_init();
		//set the url, number of POST vars, POST data
		
		// ADDED ON 2017-01-23	
		$api_url=$this->config->item("host_api_url");
		
		$get_allmissedreports_api = 'http://'.$api_url.'/collegecrm/missedcallreports/get_missedcall_api.php';	
			//curl_setopt($misscall,CURLOPT_URL, $this->config->item('get_allmissedreports_api'));
		
		curl_setopt($misscall,CURLOPT_URL, $get_allmissedreports_api);
		curl_setopt($misscall,CURLOPT_POST, count($_POST));
		curl_setopt($misscall,CURLOPT_POSTFIELDS, $misscall_string);
		curl_setopt($misscall, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($misscall, CURLOPT_RETURNTRANSFER, true);
		 $misscall_result = curl_exec($misscall);
		$misscall_reportresult= json_decode($misscall_result, true);
		curl_close($misscall);
	
		//print_r( $misscall_fields);

		$data['misscall_reportresult']=$misscall_reportresult['misscall_report'];

	
		 $total_campaigns=$misscall_reportresult['total_rows'];
		 
		$data['numbers']=$misscall_reportresult['numbers'];
		if(isset($misscall_reportresult['didnumbers']))
		{
			$data['didnumbers']=$misscall_reportresult['didnumbers'];
		}
		else
		{
			$data['didnumbers']=array();
		}
		//print_r($data['didnumbers']);


	       
		if($this->input->post('misscall_download'))
		{
		
		
		
		$misscal = array(
		    'user_id' => urlencode($user_id),
		 'fdate'=> urlencode($from_date),
		 'tdate'=> urlencode($to_date),
		 'phone_no'=> urlencode($phone_no),
		 'service_no'=> urlencode($service_no)
		 
		 );
		
			//$download_misscall_url=$real_url."/download_misscall_report_api.php";
		
			$download_misscall_fields_string = http_build_query($misscal);
			$dmcal= curl_init();
			curl_setopt($dmcal,CURLOPT_URL, $this->config->item('download_allmissedreports_api'));
			curl_setopt($dmcal,CURLOPT_POST, count($_POST));
			curl_setopt($dmcal,CURLOPT_POSTFIELDS, $download_misscall_fields_string);
			curl_setopt($dmcal, CURLOPT_FORBID_REUSE, 1);
			//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($dmcal, CURLOPT_RETURNTRANSFER, true);
			$download_miscalls_result = curl_exec($dmcal);
		
			$downlad_response= json_decode($download_miscalls_result, true);

			curl_close($dmcal);
		
			//print_r($downlad_response);
		
			//exit;
			$fileName = 'Misscall_report.csv';
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
			foreach ($downlad_response as $key => $value) {
			if ( !$headerDisplayed ) {
			fputcsv($fh, array_keys($value));
			$headerDisplayed = true;
			}
			fputcsv($fh, $value);
			}
			fclose($fh);
			exit;
	    		 }
			$data['getdid_calllist_api'] =$this->getdid();
 
			$this->load->model('reseller_model');

			$get_agent_nums_names=$this->reseller_model->get_users($this->_userId);
			$data['getagent_numbers']=$get_agent_nums_names;
		  

	
		$this->load->library('pagination');
	 
		// ADDED ON 2017-01-31
		$config['base_url'] = site_url().'campaign/missedcall_allreports/';
		//$config['base_url'] ='http://localhost/smsstriker/campaign/missedcall_allreports/';

	
	
		$config['total_rows'] = @$total_campaigns;
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
 
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/all_missedcall_reports',$data);
		$this->load->view('includes/footer');
	}
   
	   
	  public function getdid()
	 {  
 
	 	$real_url=$this->config->item('host_api_url');
	 	
	 	
			
			
		$user_id =$this->session->userdata('user_id');
	     	$router_type_url = $real_url."/missedcall_api.php";
	     	
		    $didsystem_fields = array(
		     'user_id' => urlencode($user_id),
		     'missedcall_didnumbers' => 'didnumbers'
		);
	       $did_fields_string = http_build_query($didsystem_fields);
		$_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($_ch,CURLOPT_URL, $router_type_url);
		curl_setopt($_ch,CURLOPT_POST, count($_POST));
		curl_setopt($_ch,CURLOPT_POSTFIELDS, $did_fields_string);
		curl_setopt($_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$type_result = curl_exec($_ch);
		$_result_response =json_decode($type_result, true);
       		curl_close($_ch);
		$result1 = $_result_response;
 		if(count($result1)>0)
		{
			$result=$result1;
		}
		 else
		{
			$result=array();
		}   
	
		return $result;  
	} 
	
	
	
	/** ADDED ON 2017-02-2 **/	   
   	public function upload_encoded_image() {   
   		$data = $this->input->post('image_data');
		if($data != NULL) {
			list($type, $data) = explode(';', $data);  
			list(, $data)      = explode(',', $data);
			$data = base64_decode($data); 
			$year = date('Y');
			$month = date('n');
			$date = date('d');    
			$file_name = $this->_userId.'_'.substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,4).mt_rand(0,9999).'.png'; 
			$imageUploadPath = $this->config->item('imageUploadPath');
			$imagesPath = $this->config->item('imagesPath');
			$path_name = "$imageUploadPath/$year";
 			if(!file_exists($path_name)) {
			  	mkdir($path_name, 0777, true);
				//chown($path_name,'striker:root');    
 
			}
			$path_name = "$imageUploadPath/$year/$month";
	 		if(!file_exists($path_name)) {
				mkdir($path_name, 0777, true);
				//chown($path_name,'striker:root');  
			}
			$path_name = "$imageUploadPath/$year/$month/$date";
			if(!file_exists($path_name)) {  
				mkdir($path_name, 0777, true);
				//chown($path_name,'striker:root');    
			}
			$fileExt = '.png';
			$file_name = uniqid('vs_').$fileExt; 
 			$file_full_path = "$path_name/$file_name";
			file_put_contents($file_full_path, $data);  
			echo base_url()."$imagesPath/$year/$month/$date/$file_name"; 
		}
   	}  
         
       
	public function upload_file_data() { 
 
  		 if($_FILES != NULL) {
			$year = date('Y');
			$month = date('n');
			$date = date('d');
			$PATH = '';
			$file_name = $_FILES['file_input']['name'];
			$videoUploadPath = $this->config->item('videoUploadPath');
			$videosPath = $this->config->item('videosPath'); 
			$audioUploadPath = $this->config->item('audioUploadPath');
			$audiosPath = $this->config->item('audiosPath');  
 			if($this->input->post('filetype') == 'video') {
				$PATH = $videoUploadPath;
				$fileLocation = $videosPath;
				$fileExt = '.mp4';
			}else{
				$PATH = $audioUploadPath;
				$fileLocation = $audiosPath;
				$fileExt = '.mp3';				
			}
 			$path_name = "$PATH/$year";
			
			if(!file_exists($path_name)) {
			  	mkdir($path_name, 0777, true);
				//chown($path_name,'striker:root');
 
			}  
			$path_name = "$PATH/$year/$month";
	 		if(!file_exists($path_name)) {
				mkdir($path_name, 0777, true);
				//chown($path_name,'striker:root');  
			}
			$path_name = "$PATH/$year/$month/$date";
			if(!file_exists($path_name)) {  
				mkdir($path_name, 0777, true);
				//chown($path_name,'striker:root');    
			}	 
			 
			$file_name = uniqid('vs_').$fileExt; 
 			if($_FILES['file_input']['tmp_name']) {
	 	  		move_uploaded_file($_FILES['file_input']['tmp_name'],"$path_name/$file_name");
				echo base_url()."$fileLocation/$year/$month/$date/$file_name";  
			}
		}  
   	}  
       

     	public function templates() { 
     		 $this->load->model('Campaign_model');
     		 $template = $this->input->post('template');
     		 $template_name = $this->input->post('template_name');
     		 $templateId = $this->input->post('templateId');
                 echo $this->Campaign_model->addTemplate($this->_userId, $template,$template_name,$templateId);
     	}      
     	  
     	public function getTemplates() { 
     		$this->load->model('user_model');
		 $limit = '';$offset= '';
     	        $this->_data['templates'] = $this->user_model->getTemplates($this->_userId,$limit,$offset);
		$this->load->view('mytemplate/template_info',$this->_data);
      	       // echo json_encode($templates);
     	}  
   
        public function getRecentTemplates() {
        	$this->load->model('Campaign_model');
		$to_date = $this->input->post('to_date');
		$from_date = $this->input->post('from_date'); 
     	        $templates = $this->Campaign_model->getRecentTemplatesInfo($this->_userId,$from_date,$to_date);
     	        echo json_encode($templates);        
        }
   
        public function getSelectedTemplateContent() {
        	$this->load->model('Campaign_model');
        	$template_id = $this->input->post('template_id');
     	        $templates = $this->Campaign_model->getSelectedTemplate($template_id,$this->_userId);
     	        echo json_encode($templates);   
          
        }
        
          public function getSelectedCampaignTemplateContent() {
        	$this->load->model('Campaign_model');
        	$campaign_id = $this->input->post('campaign_id');
     	        $template_content = $this->Campaign_model->getSelectedCampaignTemplate($campaign_id,$this->_userId);
     	        echo json_encode($template_content);   
             
        }
        
        
        // ADDED on 2017-02-5, by saisandeepthi
        
        public function apiViewReport() {
 
      		$this->_data['viewapireport'] = 'View API Reports';    		
      		$mobile_number = '';
		$ondate = $this->uri->segment(4);
		$offset = $this->uri->segment(5);
		$curdate = date('Y-m-d'); 
		if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $ondate)){
			 $days_diff = $this->daysDifference($curdate, $ondate);	
		}else{ 
			$days_diff = 0;  
			   
		}  
            	//$days_diff = $this->daysDifference($curdate, $ondate);
		$this->load->model('Campaign_model');
		$limit = 25;    
    		$userID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409'; 
		} 
		if($this->input->post('api_report_Search')) {
			$sender = '';//$this->input->post('sender');
			$mobile_number = $this->input->post('mobile_number');
 			$apireportview =  $this->Campaign_model->get_sms_api_details_by_filter($ondate,$userID,$days_diff,$sender,$mobile_number);  
      		}else{
      			$apireportview =  $this->Campaign_model->get_sms_api_details($ondate,$userID,$days_diff,$limit,$offset);

      		} 

  		$total_rows =   $this->Campaign_model->get_sms_api_details_total($ondate,$mobile_number,$userID,$days_diff); 
		$this->_data['dlr_report_type']=$this->_dlr_report_type;
  
		 $this->_data['dlr_report'] =  $this->Campaign_model->get_api_campaign_count($userID,$days_diff,$ondate);

 		 
   
		$this->_data['apireportview'] = $apireportview; 

		$this->load->library('pagination');
		$config['base_url'] = site_url().'campaign/apiViewReport/campaign/'.$ondate.'/';
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

       	 	$this->_data['_userId'] = $userID;
       	 	$this->_data['detailed_dlr_report'] = $this->_detailed_dlr_report;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu'); 
		$this->load->view('campaign/api_dlr_report',$this->_data);
		$this->load->view('includes/footer'); 
        
        }
        
        /* Changed on 2018-1-23 by saisandeepthi for xl plugin reports 
        public function download_report() {
        	$ondate = $this->uri->segment(3); 
		$string = '';
		$userID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = 4411;
		} 
		if($ondate) { 
            $curdate = date('Y-m-d');  
            $days_diff = $this->daysDifference($curdate, $ondate);
		$this->load->model('Campaign_model');
		$rs = $this->Campaign_model->get_sms_api_details($ondate,$userID,$days_diff);
		if($rs) {
			
			$tab ="\t";
			$newline ="\n";
			$string .= "DateTime" . $tab . " ToMobile No " . $tab . " No.of SMS " . $tab . " Sender Name " .  $tab . "Status" . $tab . " Message " .$newline;

		 
		foreach ($rs as $row) {
		 	$message_ = trim(preg_replace('/\s+/', ' ', trim($row->message)));
			$string .= $row->ondate .$tab. $row->to_mobileno .$tab. $row->noofmessages .$tab. $row->sender_name .$tab; 

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
                        if($row->dlr_status == 0){
                            $string .= "Pending";
                        } elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
                            $string .= "DND Number";
                        } elseif($this->_dlr_report_type == 2){
                            if($row->dlr_status == 2){
                                $string .= "Failed - " . $row->error_text;
                            } elseif($row->dlr_status == 4){
                                $string .= "Queued at SMSC - " . $row->error_text;
                            }
                        } else {  
                            $string .= $row->error_text;
                        }
                    }
                    
                      $string .= $tab. $message_ ;
					$string .=$newline;
				}
				//echo $string;
				
				
				//exit;  
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}

		//	header('Content-type: application/vnd.ms-excel');
  			header("Content-Type: text/csv; charset=UTF-16LE");


				header("Content-Disposition: attachment; filename=SMSAPIReport_".$ondate.".csv");
				header("Pragma: no-cache");
				header("Expires: 0"); 
				echo $string;
				exit;
		
        
        } */
        
        
        //Changed on 2018-1-23 by saisandeepthi for xl plugin reports 
         public function download_report1() {
        	$ondate = $this->uri->segment(3); 
		$string = '';
		$userID = $this->_userId;  
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409';
		}   
		if($ondate) { 
            $curdate = date('Y-m-d');  
            $days_diff = $this->daysDifference($curdate, $ondate);
		$this->load->model('Campaign_model');
		$rs = $this->Campaign_model->get_sms_api_details($ondate,$userID,$days_diff);
		if($rs) {
			
			$tab ="\t";
			$newline ="\n";
			$string .= "DateTime" . $tab ."DeliveredOn".$tab. " ToMobileNo " . $tab . " No.ofSMS " . $tab . " SenderName " .  $tab . "Status" . $tab . " Message " .$newline;

		 
		foreach ($rs as $row) {
			$message_ = NULL; 
			if($row->message) {
				$message = ltrim($row->message,',');  
		 		$message_ = trim(preg_replace('/\s+/', ' ', trim($message))); 
		 	}
		 	
		 	$deliveredDate = NULL;
		 	if($row->delivered_on) {
		 		$deliveredDate = $row->delivered_on;
		 	}
		 	$createdDate = NULL;
		 	if($row->ondate) {
		 		$createdDate = $row->ondate;
		 	}
		 	
		 	$toMobileNum = NULL;
		 	if($row->to_mobileno) {
		 		$toMobileNum = $row->to_mobileno;
		 	}
		 	
		 	$senderName = NULL;
		 	if($row->sender_name) {
		 		$senderName = $row->sender_name;
		 	}
		 	
		 	$numberOFSMS = 0;
		 	if($row->noofmessages) {
		 		  $numberOFSMS = $row->noofmessages;
		 	}
		 	
		 	$dlrStatus = $errorText = 'Failed';
		 	if($row->error_text) {
		 		$errorText = $row->error_text;
		 	}
		 	
		 	 
		 	 
 
 

			$string .= $createdDate .$tab. $deliveredDate .$tab. $toMobileNum .$tab. $numberOFSMS .$tab. $senderName .$tab; 

                     if(strlen($toMobileNum) < 10){
                       $dlrStatus =   "Invalid Number";
                    } elseif($row->dlr_status == 1){
                       $dlrStatus =  "Delivered";
                    } elseif($row->dlr_status == "" || $row->dlr_status == NULL  ||  $row->dlr_status == 0){
                      $dlrStatus=  "Pending DLR";
                    }elseif($row->dlr_status == 16){
                        $dlrStatus = $errorText;
                    } elseif($row->dlr_status == 12){  
                       $dlrStatus =   "Not a valid Sender Name";		
                    } elseif($row->dlr_status == 13){
                     $dlrStatus =    "Not a valid Template";
                        	
					
					}elseif($row->dlr_status == 2){
                              $dlrStatus =   "Failed - " . $errorText;
                            } elseif($row->dlr_status == 4){
                                $dlrStatus =   "Queued at SMSC - " . $errorText;
                            } else {
                        if($row->dlr_status == 0){
                            $dlrStatus =   "Pending";
                        } elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
                            $dlrStatus =   "DND Number";
                        } elseif($this->_dlr_report_type == 2){
                            if($row->dlr_status == 2){
                               $dlrStatus =  "Failed - " . $errorText;
                            } elseif($row->dlr_status == 4){
                                $dlrStatus =   "Queued at SMSC - " . $errorText;
                            }
                        } else {  
                            $dlrStatus =   $errorText;
                        }
                    }
                    
                     
		 	
		 	
                     $string .= $dlrStatus;
                    $string .= $tab. $message_ ;
 
					$string .= $newline;
				}
  
			} else {
				$this->_data['error'] = "Invalid Request";
			}
		} else {
			$this->_data['error'] = "Invalid Request";
		}
 
 
		header("Content-Type: text/csv; charset=UTF-16LE");


				header("Content-Disposition: attachment; filename=SMSAPIReport_".$ondate.".csv");
				header("Pragma: no-cache");
				header("Expires: 0"); 
				echo $string;
				exit;
		  
        
        }
           /* public function downloadReport() {
		require('Excellib/PHPExcel.php');
		require('Excellib/PHPExcel/Reader/Excel2007.php');
	    	$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 2;
		$ondate =  $this->uri->segment(3); 
		$string = '';
		$userID = $this->_userId;  
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = 4411;
		} 
		
		$curdate = date('Y-m-d');  
           	$days_diff = $this->daysDifference($curdate, $ondate);
		$this->load->model('Campaign_model');
		$rs = $this->Campaign_model->get_sms_api_details($ondate,$userID,$days_diff);
		if(count($rs)> 0) {
		    $objPHPExcel->getActiveSheet()->getCell('A1')->setValue("DateTime");
    $objPHPExcel->getActiveSheet()->getCell('B1')->setValue("Delivered On");
    $objPHPExcel->getActiveSheet()->getCell('C1')->setValue("To MobileNo");
    $objPHPExcel->getActiveSheet()->getCell('D1')->setValue("No.of SMS");
    $objPHPExcel->getActiveSheet()->getCell('E1')->setValue("Sender Name");
    $objPHPExcel->getActiveSheet()->getCell('F1')->setValue('Status');
        $objPHPExcel->getActiveSheet()->getCell('G1')->setValue('Message');
		foreach ($rs as $row) { 
			$message_ = NULL; 
			if($row->message) {
				$message = ltrim($row->message,',');  
		 		$message_ = trim(preg_replace('/\s+/', ' ', trim($message))); 
		 	}
		 	
		 	$deliveredDate = NULL;
		 	if($row->delivered_on) {
		 		$deliveredDate = $row->delivered_on;
		 	}
		 	$createdDate = NULL;
		 	if($row->ondate) {
		 		$createdDate = $row->ondate;
		 	}
		 	
		 	$toMobileNum = NULL;
		 	if($row->to_mobileno) {
		 		$toMobileNum = $row->to_mobileno;
		 	}
		 	
		 	$senderName = NULL;
		 	if($row->sender_name) {
		 		$senderName = $row->sender_name;
		 	}
		 	
		 	$numberOFSMS = 0;
		 	if($row->noofmessages) {
		 		  $numberOFSMS = $row->noofmessages;
		 	}
		 	
		 	$dlrStatus = $errorText = 'Failed';
		 	if($row->error_text) {
		 		$errorText = $row->error_text;
		 	}
		 
		    if(strlen($toMobileNum) < 10){
                       $dlrStatus =   "Invalid Number";
                    } elseif($row->dlr_status == 1){
                       $dlrStatus =  "Delivered";
                    } elseif($row->dlr_status == "" || $row->dlr_status == NULL  ||  $row->dlr_status == 0){
                      $dlrStatus=  "Pending DLR";
                    }elseif($row->dlr_status == 16){
                        $dlrStatus = $errorText;
                    } elseif($row->dlr_status == 12){  
                       $dlrStatus =   "Not a valid Sender Name";		
                    } elseif($row->dlr_status == 13){
                     $dlrStatus =    "Not a valid Template";
                        	
					
					}elseif($row->dlr_status == 2){
                              $dlrStatus =   "Failed - " . $errorText;
                            } elseif($row->dlr_status == 4){
                                $dlrStatus =   "Queued at SMSC - " . $errorText;
                            } else {
                        if($row->dlr_status == 0){
                            $dlrStatus =   "Pending";
                        } elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
                            $dlrStatus =   "DND Number";
                        } elseif($this->_dlr_report_type == 2){
                            if($row->dlr_status == 2){
                               $dlrStatus =  "Failed - " . $errorText;
                            } elseif($row->dlr_status == 4){
                                $dlrStatus =   "Queued at SMSC - " . $errorText;
                            }
                        } else {  
                            $dlrStatus =   $errorText;
                        }
                    }
                     
                    
                       $objPHPExcel->getActiveSheet()->getCell('A'.$rowCount)->setValue($createdDate);
		    $objPHPExcel->getActiveSheet()->getCell('B'.$rowCount)->setValue($deliveredDate);
		     $objPHPExcel->getActiveSheet()->getCell('C'.$rowCount)->setValue($toMobileNum);
		      $objPHPExcel->getActiveSheet()->getCell('D'.$rowCount)->setValue($numberOFSMS);
		       $objPHPExcel->getActiveSheet()->getCell('E'.$rowCount)->setValue($SenderName);
		        $objPHPExcel->getActiveSheet()->getCell('F'.$rowCount)->setValue($dlrStatus);
		        
		      //  $objPHPExcel->getActiveSheet()->getCell('G'.$rowCount)->setValue($message_); 
 
 
 $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(-1); 
//$objPHPExcel->getActiveSheet()->getColumnDimension('G'.$rowCount)->setWidth(50);
   
      
				//$objPHPExcel->setActiveSheetIndex()->getStyle('G'.$rowCount)->getAlignment()->setWrapText(true);    
				   
    


		    $rowCount++;
                    
                    
                    }
                    
 
                 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 

			 // We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');

			// It will be called file.xls  
			header("Content-Disposition: attachment; filename=SMSAPIReport_".$ondate.".xls");

			// Write file to the browser  
			$objWriter->save('php://output');
		}
        } */
        
         //Changed on 2018-2-5 by saisandeepthi for xl plugin reports 
         public function download_report() {
        	$ondate = $this->uri->segment(3); 
		$string = '';
		$userID = $this->_userId;  
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409';
		} 
 
            $curdate = date('Y-m-d');  
            $days_diff = $this->daysDifference($curdate, $ondate);
		$this->load->model('Campaign_model');
		$rs = $this->Campaign_model->get_sms_api_details($ondate,$userID,$days_diff);
		if($rs) {
			
		 
		$reports = array(); $rowID = 0;
		foreach ($rs as $row) { 
			$message_ = NULL; 
			if($row->message) {
				$message = $row->message;
				$message = ltrim($row->message,',');  
		 		$message_ = trim(preg_replace('/\s+/', ' ', trim($message))); 
		 	}
		 	
		 	$deliveredDate = NULL;
		 	if($row->delivered_on) {
		 		$deliveredDate = $row->delivered_on;
		 	}
		 	$createdDate = NULL;
		 	if($row->ondate) {
		 		$createdDate = $row->ondate;
		 	}
		 	
		 	$toMobileNum = NULL;
		 	if($row->to_mobileno) {
		 		$toMobileNum = $row->to_mobileno;
		 	}
		 	
		 	$senderName = NULL;
		 	if($row->sender_name) {
		 		$senderName = $row->sender_name;
		 	}
		 	
		 	$numberOFSMS = 0;
		 	if($row->noofmessages) {
		 		  $numberOFSMS = $row->noofmessages;
		 	}
		 	
		 	$dlrStatus = $errorText = 'Failed';
		 	if($row->error_text) {
		 		$errorText = $row->error_text;
		 	}
		 
		    if(strlen($toMobileNum) < 10){
                       $dlrStatus =   "Invalid Number";
                    } elseif($row->dlr_status == 1){
                       $dlrStatus =  "Delivered";
                    } elseif($row->dlr_status == "" || $row->dlr_status == NULL  ||  $row->dlr_status == 0){
                      $dlrStatus=  "Pending DLR";
                    }elseif($row->dlr_status == 16){
                        $dlrStatus = $errorText;
                    } elseif($row->dlr_status == 12){  
                       $dlrStatus =   "Not a valid Sender Name";		
                    } elseif($row->dlr_status == 13){
                     $dlrStatus =    "Not a valid Template";
                        	
					
					}elseif($row->dlr_status == 2){
                              $dlrStatus =   "Failed - " . $errorText;
                            } elseif($row->dlr_status == 4){
                                $dlrStatus =   "Queued at SMSC - " . $errorText;
                            } else {
                        if($row->dlr_status == 0){
                            $dlrStatus =   "Pending";
                        } elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
                            $dlrStatus =   "DND Number";
                        } elseif($this->_dlr_report_type == 2){
                            if($row->dlr_status == 2){
                               $dlrStatus =  "Failed - " . $errorText;
                            } elseif($row->dlr_status == 4){
                                $dlrStatus =   "Queued at SMSC - " . $errorText;
                            }
                        } else {  
                            $dlrStatus =   $errorText;
                        }
                    }
                    
                      	$slNo = ++$rowID;
 				$values = array('SLNo'=> $slNo,'DateTime'=> $createdDate,'DeliveredOn'=>$deliveredDate,'ToMobileNo'=>$toMobileNum,'NoofSMS'=>$numberOFSMS ,'SenderName'=>$senderName,'Status' => $dlrStatus,"Message" => $message_ );
				array_push($reports,$values);     
 
				}  
  
			 
		}   
		
  ob_clean();
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header('Content-Type: text/csv; charset=utf-8');
				header("Content-Disposition: attachment; filename=SMSAPIReport_".$ondate.".csv");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
		 
			foreach ($reports  as $key => $value) {
				if ( !$headerDisplayed ) {
					fputcsv($fh, array_keys($value));
					$headerDisplayed = true;
				}
				fputcsv($fh, $value);
			}  
			fclose($fh);
			exit;
				
		 
        }
          
          
      
          
   
        
         
    
       
	/** ADDDED ON 2017-02-10, By saisandeepthi 
          * Method calling to create bulk urls through url		
	  */
 	
        public function bulkShorturl() {  
 
		if($this->session->userdata('user_id') ==  5742  || $this->session->userdata('user_id') ==  5741  || $this->session->userdata('user_id') ==  5740 || $this->session->userdata('user_id') ==  5739 )   {
			  redirect(base_url().'campaign/viewcampaigns');   
		}
 		if($this->input->post('createBulkUrl')) {
			$this->load->model('Campaign_model');
			// Get shorturl value from global settings table
			//$global_val = $this->Campaign_model->global_shorturlVal(); 
			if($this->_shorturlCredits) {
				$urlCount = $this->input->post('shorturl_number');
				if($urlCount > 0 ) {	
					//$totalCredits = $urlCount*$global_val;
					$totalCredits = $urlCount;
	 				if($this->_shorturlCredits >= $totalCredits) {
					
						$remainingCredits = $this->_shorturlCredits - $totalCredits; 
						$this->Campaign_model->updateUserUrlCredits($this->_userId,$remainingCredits); 
						$this->generateBulkUrl($this->input->post(),$totalCredits); 	
					}else{   	 
						redirect('campaign/bulkShorturl/noCredits');
					}
				}else{   	 
					redirect('campaign/bulkShorturl/invalid');
				}
			}else{
				redirect('campaign/bulkShorturl/noCredits');
			} 		      
		}       
 		$this->_data['user_id'] = $this->_userId;  
		$this->_data['isInternational'] = $this->_International;
        	$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu');
		$this->load->view('campaign/shorturl_view');  
		$this->load->view('/includes/footer');        
        }  
  
	/** ADDDED ON 2017-02-10, By saisandeepthi 
	  * Method calling to create bulk urls through image		
	  */
 	public function bulkshortUrlimg() {
		if($this->input->post('createBulkImgUrl')) {
			$this->load->model('Campaign_model');
			// Get shorturl value from global settings table
			//$global_val = $this->Campaign_model->global_shorturlVal(); 
			if($this->_shorturlCredits) {
				$urlCount = $this->input->post('shorturl_number');
				if($urlCount > 0 ) {	
					$totalCredits = $urlCount;
	 				if($this->_shorturlCredits >= $totalCredits) {
	 
						 $remainingCredits = $this->_shorturlCredits - $totalCredits; 
						 $this->Campaign_model->updateUserUrlCredits($this->_userId,$remainingCredits); 
						 $this->generateBulkUrl($this->input->post(),$totalCredits); 	
					}else{
	 
						redirect('campaign/bulkshortUrlimg/noCredits');
					}
				}else{   	 
					redirect('campaign/bulkshortUrlimg/invalid');
				}
			}else{
				redirect('campaign/bulkshortUrlimg/noCredits');
			}    

 
		}
        	$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu');
		$this->load->view('campaign/shorturlimg_view');
		$this->load->view('/includes/footer');        
        }

	/** ADDDED ON 2017-03-15, By saisandeepthi 
	  * Method calling to create bulk urls through video		
	  */
 	public function bulkshortUrlvideo() {   
		if($this->input->post('createBulkImgUrl')) {   
			$this->load->model('Campaign_model');
			// Get shorturl value from global settings table
			//$global_val = $this->Campaign_model->global_shorturlVal(); 
			if($this->_shorturlCredits) {
				$urlCount = $this->input->post('shorturl_number');	
				if($urlCount > 0 ) {
					$totalCredits = $urlCount;
	 				if($this->_shorturlCredits >= $totalCredits) {
	 
						 $remainingCredits = $this->_shorturlCredits - $totalCredits; 
						 $this->Campaign_model->updateUserUrlCredits($this->_userId,$remainingCredits); 
						 $this->generateBulkUrl($this->input->post(),$totalCredits); 	
					}else{
	 
						redirect('campaign/bulkshortUrlvideo/noCredits');
					}
				}else{   	 
					redirect('campaign/bulkshortUrlvideo/invalid');
				}
			}else{
				redirect('campaign/bulkshortUrlvideo/noCredits');
			}    

 
		}
        	$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu');
		$this->load->view('campaign/shorturlvideo_view');
		$this->load->view('/includes/footer');        
        }

	/** ADDDED ON 2017-03-15, By saisandeepthi 
	  * Method calling to create bulk urls through audio		
	  */
 	public function bulkshortUrlaudio() {     
		if($this->input->post('createBulkImgUrl')) { 
			$this->load->model('Campaign_model');
			// Get shorturl value from global settings table
			//$global_val = $this->Campaign_model->global_shorturlVal(); 
			if($this->_shorturlCredits) {
				$urlCount = $this->input->post('shorturl_number');	
				if($urlCount > 0 ) {
					$totalCredits = $urlCount;
	 				if($this->_shorturlCredits >= $totalCredits) {
	 
						 $remainingCredits = $this->_shorturlCredits - $totalCredits; 
						 $this->Campaign_model->updateUserUrlCredits($this->_userId,$remainingCredits); 
						 $this->generateBulkUrl($this->input->post(),$totalCredits); 	
					}else{
	 
						redirect('campaign/bulkshortUrlaudio/noCredits');
					}
				}else{   	   
					redirect('campaign/bulkshortUrlaudio/invalid');
				}
			}else{
				redirect('campaign/bulkshortUrlaudio/noCredits');
			}    

 
		}
        	$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu');
		$this->load->view('campaign/shorturlaudio_view');
		$this->load->view('/includes/footer');        
        }

	/** ADDDED ON 2017-02-10, By saisandeepthi  
 	  * One function to create bulk url 	
	  */
	public function generateBulkUrl($data,$totalCredits) 
	{	 
		$this->load->model('Campaign_model');
		$shorturl_id = $this->Campaign_model->createUserShorturl($this->_userId,$data,$totalCredits);
 
	 	if($shorturl_id) 
		{

			if($data['shorturl_number'] != '' && $data['shorturlenter'] != '')
			{
				// $this->Campaign_model->createUserBulShorturl($data['shorturl'],$shorturl_id,$data['shortCode']);
				$bulk_url_count = $data['shorturl_number'];  
				$data_array  = array();$shortUrl_array = array();
				for($i=1;$i <= $bulk_url_count;$i++ ) {
				
					$shorturl_input=$data['shorturlenter'];
 
					//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
					$result1 = $this->generateShortCode();
					$getsendShorturl= $this->_data['UrlGenIp'].$result1;
					array_push($data_array, array(
						'shorturl_id' => $shorturl_id,
						'shorturl' => $getsendShorturl,
						'shortCode' =>  $result1,
						'created_date' => date('Y-m-d H:i:s')
					));
					array_push($shortUrl_array,array(
								'long_url' => $shorturl_input,
								'user_id' => $this->_userId,
								'short_code' => $result1,
								'date_created' => date('Y-m-d H:i:s')
					));

					  
		  		}    
 			 $this->Campaign_model->createUserBulShorturl($data_array,$shortUrl_array); 
 
				 redirect('campaign/shorturlReports');
  
			}      
		  
		 }
	}   


	/** ADDDED ON 2017-02-10, By saisandeepthi  
	  * User shorturl reports 
	  */
		  
	public function shorturlReports() {   
		$this->load->model('Campaign_model');
		$this->load->library('session');
	       $from_date  = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
		 $to_date  = date('Y-m-d');
		
		if($this->input->post('shorturl_report_search') != '')
		{ 	 
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');
			$this->session->set_userdata('from_date',  $this->input->post('from_date'));
			$this->session->set_userdata('to_date', $this->input->post('to_date'));	
			$from_date =  $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');		   
		}  
		  
	   
		
		$limit="15";
		$offset="0";
	
		if($this->uri->segment(3)!='')
		{
		  $offset=$this->uri->segment(3);
		}
		    
		if($offset > 0 ) {
			$this->_data['from_date'] = $fd = $from_date = $this->session->userdata('from_date'); 
			$this->_data['to_date']  =  $td =  $to_date = $this->session->userdata('to_date');
 
		}else {
			$this->_data['from_date'] = $fd = $from_date;  
			$this->_data['to_date']  =  $td =  $to_date; 
		}
 
		$this->_data['userurl'] = $this->Campaign_model->getUserShortUrls($this->_userId,$from_date,$to_date,$limit,$offset);
		
		 $total_rows = $this->Campaign_model->getUserShortUrlsCount($this->_userId,$from_date,$to_date);
	
		      $this->load->library('pagination');
			$config['base_url'] = base_url().'campaign/shorturlReports';
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
				
		//print_r($this->_data['userurl']);exit;
		$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/shorturl_reports');  
		$this->load->view('/includes/footer');
	}


	/** ADDDED ON 2017-02-10, By saisandeepthi 
	  * Bulk short url report	
	  */
	    
	public function bulkurl() { 
 
		$urlId = $this->uri->segment(3);
		
		$limit=15;
		$offset=0;
	
		if($this->uri->segment(4)!='')
		{
		  $offset=$this->uri->segment(4);
		}
		
		if($urlId) {		  
			$this->load->model('Campaign_model'); 
			
			  //$this->_data['userurl'] = $this->Campaign_model->getUserUrls($this->_userId,$urlId,$limit,$offset);
			  
			$this->_data['userurl'] = $this->Campaign_model->getUserUrlsData($this->_userId,$urlId,$limit,$offset);
			  
			$total_rows = $this->Campaign_model->Campaign_model->getUserUrlsCount($this->_userId,$urlId);
			
		      $this->load->library('pagination');
			$config['base_url'] = site_url().'campaign/bulkurl/'.$urlId.'/';
			$config['uri_segment'] = 4;
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
		}  

 
                  
			
		$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu');
		$this->load->view('campaign/bulk_url');    
		$this->load->view('/includes/footer');
	} 

  
	/** ADDDED ON 2017-02-10, By saisandeepthi 
          *  Download user bulk url
          */

	/*public function download_url_report() {
		$this->load->model('Campaign_model');  
		$urlId = $this->uri->segment(3);
		$string = '';  
		//$limit = '';$offset='';
		if($urlId) {		

			$rs = $this->_data['userurl'] = $this->Campaign_model->getUserUrls($this->_userId,$urlId); 
 			
  
			if($rs) {  
				  
				$string .= "Shorturl \t DateTime \n";
 
				foreach($rs as $val) {  
					$string .=  $val->shorturl."\t".$val->created_date."\t";
					$string .= "\n"; 
					 
				}
			}
			
		}
header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=SMSReport_".$urlId.".xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			header("Content-Type: text/plain");
			echo $string;
			exit; 
		 $data['isftpuser'] = $this->_data['isftpuser'];
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('/includes/footer'); 
       
	} */
  
	public function download_url_report() {
		$this->load->model('Campaign_model');  
		$urlId = $this->uri->segment(3);
		$string = '';
		if($urlId) {		

			$rs = $this->_data['userurl'] = $this->Campaign_model->getUserUrls($this->_userId,$urlId); 
 			//print_r($rs);exit;
  
			if($rs) {    
				
				$string .= "Shorturl \t DateTime \n";
 
				foreach($rs as $val) {  
					$string .=  $val->shorturl."\t".$val->created_date."\t";
					$string .= "\n"; 
					 
				} 
			}
			
		}
header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=BulkShortCodeReport_".$urlId.".xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			header("Content-Type: text/plain");
			echo $string;
			exit; 
		 $data['isftpuser'] = $this->_data['isftpuser'];
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('/includes/footer'); 
       
	}

	/** ADDDED ON 2017-02-10, By saisandeepthi 
          *  Download user short code user reports
          */

	public function download_shortCode_reports() {   
		$this->load->model('Campaign_model'); 
		$urlId = $this->uri->segment(3);
		if($urlId) { 
			$rs = $this->_data['userurl'] = $this->Campaign_model->getShortcodeReports($this->_userId,$urlId); 
			$string = '';  
			//print_r($rs );exit;
 			if($rs) {
				$string .= "Shorturl \t NumberOfTries \t IPAddress \t DeviceType  \t BrowserType  \t OperatingSystem  \t DateTime \n";    
				foreach($rs as $val) {  
					$shorturl = $val->shorturl;
					$counter = $val->counter?$val->counter:'';
					$ip_address = $val->ip_address?$val->ip_address:'';
					$device_type = $val->device_type?$val->device_type:'';
					$browser_type = $val->browser_type?$val->browser_type:'';
					$operating_system = $val->operating_system?$val->operating_system:'';
					$created_on = $val->created_on?$val->created_date:'';
					$string .=  $shorturl."\t".$counter."\t".$ip_address."\t".$device_type."\t".$browser_type."\t".$operating_system."\t".$created_on."\t";
					$string .= "\n"; 
					     
					   
				}
			}
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=BulkShortCodeReport_".$urlId.".xls");
			header("Pragma: no-cache");
			header("Expires: 0");  
			header("Content-Type: text/plain");
			echo $string;
			exit; 
		}  
		$data['isftpuser'] = $this->_data['isftpuser'];
		$data['page_title'] = "Welcome RK Advertisings :: Bulk SMS - View Campaigns";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('/includes/footer'); 
	}


      
	/** ADDDED ON 2017-02-10, By saisandeepthi 
     	  * 
 	  */
	public function shortCodeReports() {

		$shortCode = $this->uri->segment(3); 
		$this->load->model('Campaign_model'); 
		$data['shorturlreports'] = $this->Campaign_model->getUrlReports($this->_userId,$shortCode); 
 		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/shortcode_url_reports',$data);
		$this->load->view('includes/footer');
 
	}
      
	public function addShorturlCredits() {
		$this->load->model('Campaign_model');
 		$this->_data['global_val'] = $this->Campaign_model->global_shorturlVal(); 
 		$this->_data['service_tax'] = $this->Campaign_model->global_servicetax(); 
		$this->session->set_userdata('qty','0');
		$this->session->set_userdata('sms_price','0');
		$this->session->set_userdata('amount','0');
		$this->session->set_userdata('tax_amount','0');
		$this->session->set_userdata('total_amount','0');	
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/add_url_credits',$this->_data);
		$this->load->view('includes/footer');  
	}

	public function encryptPaynow($amount,$referenc_id)
	{
		$key = $this->config->item('MerchantKey');
		$MerchantId = $this->config->item('MerchantId');
		//Mandatory Fields Start
		$ReferenceNo =$referenc_id;
		$SubMarchantID =$MerchantId;
		$TransactionAmt =$amount;
		$mandatoryfields = $ReferenceNo.'|'.$SubMarchantID.'|'.$TransactionAmt;
		$Encrypt_MandatoryFields = $this->aes128Encrypt($mandatoryfields,$key);
		$returnurl = $this->config->item('returnurl');
		$Encrypt_ReturnUrl = $this->aes128Encrypt($returnurl,$key);
		$Encrypt_ReferenceNo = $this->aes128Encrypt($ReferenceNo,$key);
		$Encrypt_SubMerchantId = $this->aes128Encrypt($SubMarchantID,$key);
		$Encrypt_TransactionAmount = $this->aes128Encrypt($TransactionAmt,$key);
		$paymode = $this->config->item('paymode');
		$Encrypt_PaymentMode = $this->aes128Encrypt($paymode,$key);
		$paymenturl=$this->config->item('paymenturl');
		$url="$paymenturl?merchantid=$MerchantId&mandatory fields=$Encrypt_MandatoryFields&optional fields=&returnurl=$Encrypt_ReturnUrl&Reference No=$Encrypt_ReferenceNo&submerchantid=$Encrypt_SubMerchantId&transaction amount=$Encrypt_TransactionAmount&paymode=$Encrypt_PaymentMode";
	
		redirect($url);
	}

	public function aes128Encrypt($str,$key)
	{
		$block = mcrypt_get_block_size('rijndael_128', 'ecb');
		$pad = $block - (strlen($str) % $block);
		$str .= str_repeat(chr($pad), $pad);
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB));
	}
	public function confirm_order() {
		//if(!$this->session->userdata('qty')) {
			//redirect('campaign/addShorturlCredits');
		//}  
		$this->load->model('Campaign_model'); 
		$this->_data['tax'] = $this->Campaign_model->global_servicetax();
		if($this->input->post('confirm_order')) {
 
 			$this->_data['number_of_url'] = $urlcount = $this->input->post('urlcount');   
			$this->_data['priceper_sms'] = $this->Campaign_model->getBulkurlPrice($urlcount);
			 $smsprice = $this->_data['priceper_sms'];
			// $amount = $urlcount*($this->_data['global_val']);
			$this->_data['amount'] = $amount = $urlcount*($smsprice); 
			$this->_data['service_tax'] = $service_tax = ($amount*$this->_data['tax'])/100; 
			$total_amount = $this->_data['total_amount'] = $service_tax+$amount;
			$user_id = $this->_userId;    
			$this->_data['price_per_Sms'] = $smsprice;
			$this->session->set_userdata('serv_url', $urlcount); 
			$this->session->set_userdata('serv_amount',$amount);
			$this->session->set_userdata('serv_tax', $service_tax); 
			$this->session->set_userdata('serv_total', $this->_data['total_amount']);

			$this->session->set_userdata('qty',$urlcount);
			$this->session->set_userdata('sms_price',$smsprice);
			$this->session->set_userdata('amount',$amount);
			$this->session->set_userdata('tax_amount',$service_tax);
			$this->session->set_userdata('total_amount',$total_amount);
		}  
		if($this->input->post('place_order')) {  
 	 
			$urlcount = $this->input->post('qty');  
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$mobile = $this->input->post('mobile');
			$total_amount = $this->input->post('total_amount');
			$tax_amount = $this->input->post('tax_amount');
			$amount = $this->input->post('amount');
			$user_id = $this->input->post('custid');
			$smstype = $this->input->post('smstype');
			$zipcode = $this->input->post('zipcode');
			$address = $this->input->post('address');
			$sms_price = $this->input->post('sms_price');
			$getstate_id = $this->input->post('getstate_id');
			$getcity_id = $this->input->post('getcity_id'); 
			$shorturl_credits = $this->input->post('shorturl_credits');  
			$description = $this->input->post('description');  
			 
			  $product_id = $this->Campaign_model->addUserUrlCredits($name,$email,$mobile,$urlcount,$user_id,$tax_amount,$amount,$total_amount,$sms_price,$smstype,$shorturl_credits); 
 
			if($product_id) {   
				$this->session->set_userdata('productId', $product_id); 
				$userid = $this->_userId;
				

				
				
				$transaction_id = mt_rand(100000, 999999);
				
				$sql="update price_enquery set transaction_id='$transaction_id'  where id in ($product_id)";
				$this->db->query($sql);
	
				$shorturl_credits = $this->session->userdata('qty');  
				$sms_price = $this->session->userdata('sms_price'); 
				$amount = $this->session->userdata('amount'); 
				$tax_amount = $this->session->userdata('tax_amount'); 
				$total_amount = $this->session->userdata('total_amount'); 
				$gettotal_amount=ceil($total_amount);
				$query = "insert into transaction_history (user_id,shorturl_credits,sms_price,amount,tax_amount,total_amount,transaction_id)
				values ($user_id,$shorturl_credits,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
				$this->db->query($query);
				$this->encryptPaynow($gettotal_amount,$transaction_id);
				   
			}else{
				redirect('campaign/addShorturlCredits');
			}  

		}      
		
		if(isset($_REQUEST['tn']))      
		{
			if($_REQUEST['rm']=='Transaction Successful')
			{
  				$transaction_id = $_REQUEST['tn'];  
 
				$res = $this->Campaign_model->updateUrlPaymentStatus($transaction_id,$this->_userId,$this->_shorturlCredits);   
				 		
			}        
		}
   		$this->_data['number_of_url'] =$this->session->userdata('serv_url'); 
		$this->_data['service_tax'] =$this->session->userdata('serv_tax'); 
		$this->_data['amount'] =$this->session->userdata('serv_amount'); 
		$this->_data['total_amount'] =$this->session->userdata('serv_total'); 	

		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');  
		$this->load->view('campaign/url_credits_payment',$this->_data);
		$this->load->view('includes/footer'); 
 
	}

	 public function getBulkUrlPrice() {
		$this->load->model('Campaign_model');
		if($this->input->post('numberofurl')) {			
			echo  $this->_data['priceper_sms'] = $this->Campaign_model->getBulkurlPrice($this->input->post('numberofurl'));
 
		}
	}  
  

	public function myLongcodePackage() {
		$this->load->model('Campaign_model'); 
		$this->_data['service_tax'] = $this->Campaign_model->global_servicetax(); 		  
		 if($this->input->post('longcode_id')) { 
			$package_id = ''; 
			if($this->input->post('package_id')) {
			 	$package_id = $this->input->post('package_id'); 
			}
			 
			$data['userpackage'] = $this->Campaign_model->getServiceData($this->_userId,$this->input->post('longcode_id'));
			$data['package'] =  $this->Campaign_model->longCodePackage($package_id);   
			echo json_encode($data);    
		  
		}else{  
			$this->_data['userlongcodes'] = $this->Campaign_model->getUserLongcodeData($this->_userId); 
			$this->load->view('includes/header',$this->_data);
			$this->load->view('includes/leftmenu');  
			$this->load->view('campaign/longcode_package',$this->_data);
			$this->load->view('includes/footer');   
		}   
    
	}  

	public function renewalLongcodeService() {
 		
		$this->load->library('session'); 
		$this->load->model('Campaign_model');   
		if($this->input->post('renewal_package')) { 
			//  print_r($this->input->post());exit;
 			$this->_data['number_of_sms'] = $this->input->post('num_sms');  
 			$this->_data['amount'] = $this->input->post('service_amount');
			$this->_data['service_tax'] = $this->input->post('service_tax');
			$this->_data['total_amount'] = $this->input->post('total_amount');
			$this->_data['number_cost']  = $this->input->post('number_cost');
			$this->_data['transaction_id'] =  $this->input->post('transaction_id');	
			$this->_data['longcode_type'] =  $this->input->post('longcode_type');		 
			$this->_data['subscription_duration']=   $this->input->post('subscription_duration');
			$this->_data['subscription_id'] =   $this->input->post('subscription_id'); 
			$user_id = $this->_userId;     
			$this->_data['long_code_price'] = $this->input->post('price_per_long_code'); 
			$longcode_number = $this->input->post('longcode_number'); 
			$this->session->set_userdata('long_sms', $this->_data['number_of_sms'] ); 
			$this->session->set_userdata('long_amount',$this->_data['amount'] );
			$this->session->set_userdata('long_tax', $this->_data['service_tax']); 
			$this->session->set_userdata('long_total', $this->_data['total_amount']);
			$this->session->set_userdata('long_num', $longcode_number);		
			 
		}       
  		if($this->input->post('place_order')) {
 			 // print_r($this->input->post());exit; 
			$number_of_sms = $this->input->post('number_of_sms');  
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$mobile = $this->input->post('mobile');
			$total_amount = $this->input->post('total_amount');
			$tax_amount = $this->input->post('tax_amount'); 
			$amount = $this->input->post('amount');

			$user_id = $this->input->post('custid');
			$smstype = $this->input->post('smstype');
			$zipcode = $this->input->post('zipcode');
			$address = $this->input->post('address');
			$sms_price = $this->input->post('sms_price');
			$getstate_id = $this->input->post('getstate_id');
			$getcity_id = $this->input->post('getcity_id');   

			$longcode_type  =  $this->input->post('longcode_type');	
			$transaction_id = $this->input->post('transaction_id');	
 			$subscription_id = $this->input->post('subscription_id'); 
			$number_cost = $this->input->post('number_cost'); 
			$this->session->set_userdata('number_cost', $number_cost); 
			$this->session->set_userdata('package_amount', $amount);
			$this->session->set_userdata('transaction_id', $transaction_id);

			$subscription_duration = $this->input->post('subscription_duration');
			$this->session->set_userdata('subscription_duration', $subscription_duration);
 			$transaction_id = $this->session->userdata('transaction_id'); 
			$longcode_number = $this->session->userdata('long_num');  
 
			 $product_id = $this->Campaign_model->userLongcodeRenewal($amount,$number_of_sms,$tax_amount,$sms_price,$total_amount,$longcode_number,$subscription_duration,$this->_userId,$transaction_id,$name,$email,$mobile,$smstype); 
			 //print_r($product_id);exit;
			if($product_id) {  
				 $this->session->set_userdata('longcode_id',$subscription_id);
				 $this->session->set_userdata('productId', $product_id); 
				 $userid = $this->_userId;
				 
				 if($sms_count!='')
				 {
				 $sms_count=$sms_count;
				 }
				 else
				 {
				  $sms_count=0;
				 }
				 
				 $gettotal_amount=ceil($total_amount);
				 
				 $val = 'amount='.base64_encode($amount).'&tax_amount='.base64_encode($tax_amount).'&total_amount='.base64_encode($gettotal_amount).'&name='.base64_encode($name).'&sms_price='.base64_encode($sms_price).'&trnsale='.base64_encode($sms_count).'&customerid='.base64_encode($userid).'&address1='.base64_encode($address).'&address2='.base64_encode($address).'&state='.base64_encode($getstate_id).'&city='.base64_encode($getcity_id).'&zip='.base64_encode($zipcode).'&mobile='.base64_encode($mobile).'&email='.base64_encode($email).'&description='.base64_encode('longcodeRenewal');
				$testssl_url = base_url()."payment/TestSsl.php?ids=".base64_encode($product_id)."&".$val;
	  
				  redirect($testssl_url);    
			}else{
				redirect('campaign/myLongcodePackage'); 
			}   
 		}  
 
		  if(isset($_REQUEST['tn'] ))
		{
			if($_REQUEST['rm']=='Transaction Successful')
			//if($_REQUEST['rm']=='Transaction Cancelled')
			 {
  				$transaction_id = $_REQUEST['tn'];
//1 21 25500
				    $this->Campaign_model->updateUserLongcodeInfo($transaction_id,$this->_userId);  
			 
				//redirect('campaign/myLongcodePackage'); 
			 }  
		 }    
   
		$this->_data['number_of_sms'] =$this->session->userdata('long_sms'); 
		$this->_data['service_tax'] =$this->session->userdata('long_tax'); 
		$this->_data['amount'] =$this->session->userdata('long_amount'); 
		$this->_data['total_amount'] =$this->session->userdata('long_total'); 
		$this->_data['tax'] = $this->Campaign_model->global_servicetax();
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');    
		$this->load->view('campaign/longcode_renewal',$this->_data);
		$this->load->view('includes/footer');  
		    
	}  

	/*public function shorturlPriceList()
	{    
 
		 
		 $sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = '".$this->_userId."'";
		 $user=$this->db->query($sql)->result(); 
	 	 $usertype='';
		foreach($user as $key => $value)
		{  
			//print_r($value);
			if($value->no_ndnc=="0")
			{
				$usertype="Promotional";
				$usertypecol="promotional";
			}
			if($value->no_ndnc=="1")
			{
				$usertype="Transactional";
				$usertypecol="transactional";
			}
			if($value->no_ndnc=="1" && $value->dnd_check=='1')
			{
				$usertype="Semi Trans";
			}
		}
		$this->_data['smstype']=$usertype; 
		$sql="select * from userbulkurlsmsprice";
		$this->db->query($sql)->result();
		$this->_data['getsmspricelist']=$this->db->query($sql)->result();
		 
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
 
		$this->load->view('campaign/shorturl_pricelist',$this->_data);
 
		$this->load->view('/includes/footer');  
	} */


  public function getshortcode_reports() {
  
		$limit="15";
            $offset="0";
  
		$campaign_id = '';    $shortcode = '';
		if($this->uri->segment(3))
		{
			$campaign_id = $this->uri->segment(3);   
		}
		 
		if($this->uri->segment(4))
		{
			$shortcode = $this->uri->segment(4);  
		}  
           
            
            if($this->uri->segment(5)!='')  
		{
			$offset = $this->uri->segment(5);  
		} 
		$this->load->model('Campaign_model');  
		   
		$this->_data['urlReports'] = $this->Campaign_model->getShortCodeUrls($campaign_id,$shortcode,$limit,$offset);
		
		$total_rows = $this->Campaign_model->getShortCodeUrlsCount($campaign_id,$shortcode); 
		 $this->_data['userId'] = $this->_userId;
 	  
		$this->load->library('pagination');
		$config['base_url'] = base_url().'campaign/getshortcode_reports/'.$campaign_id."/".$shortcode."/";
		$config['total_rows'] = @$total_rows;  
		$config['uri_segment'] =5;
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
		
		$this->load->view('includes/header',$this->_data);
        	$this->load->view('includes/leftmenu'); 
		$this->load->view('campaign/campaign_shorturl_reports');    
		$this->load->view('/includes/footer');

	}

	 
	 
	 	 public function getShortCode($campaign_id,$shortUrl,$shortText)   
 
	{  
   

 		$this->load->model('Campaign_model');  
 

		if($shortUrl != '')
		{
			$filter_array = $shortUrl;
		 	$filterArr =  array_filter($filter_array);$sendShorturl = '';
 
			 if(count($filterArr) > 0) {

			for($i=0;$i<count($shortUrl);$i++) 
			{  
 
				     $shorturl_input = $shortUrl[$i];$sendShorturl = $sendShorturl?$sendShorturl:'';
				     $getsendShorturl = '';
 				     if($shortUrl[$i] != NULL) {
					  				 
					$getSmsText = $this->Campaign_model->getLastCampaignSmsText($this->_userId); 
	 				$newsms_text = '';
					foreach($getSmsText as $key=>$newsmsvalue)
					{
						$newsms_text = $newsmsvalue->sms_text; 
						//$shorturl_input = $newsmsvalue->long_url; 
						//$newshorturl_text = $newsmsvalue->shorturl_text; 
					}
					$newshorturl_text = $shortText[$i];  
 

					//echo $shortUrl[$i+2];exit;
					/*$fields = array(
						'get_shorturl' => "success",
						'user_url' => $shorturl_input,
						'user_id' => $this->_userId 
					);  
					$url = $this->_data['UrlGenIp'].'api.php';
					$fields_string = http_build_query($fields); 

					//open connection
					$ch = curl_init();
					//set the url, number of POST vars, POST data
					curl_setopt($ch,CURLOPT_URL, $url);
					curl_setopt($ch,CURLOPT_POST, count($_POST));
					curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
					curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
					//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					$result1 = json_decode($result, true);
					curl_close($ch);
					//echo $result1; */
					//$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
					$result1 = $this->generateShortCode();
					$sendShorturl=$result1;

					$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
					
					$newshorturl_text = str_replace("\n", "", $newshorturl_text);
					$newshorturl_text = str_replace("\t", "", $newshorturl_text);
					$newshorturl_text = str_replace("\r", "", $newshorturl_text); 
					$smstext = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text); 
					if(isset($shortUrl[$i+1]) && $shortUrl[$i+1] != NULL) {
						$campaign_long_url = $shortUrl[$i+1];
					}else{
						$campaign_long_url = $shortUrl[$i];
					}
					if(isset($shortText[$i+1]) && $shortText[$i+1] != NULL) {
						$campaign_shorturl_text = $shortText[$i+1];
					}else{
						$campaign_shorturl_text = $shortText[$i];
					} 
	
 
					
						  $getSmsText = $this->Campaign_model->updateCampaignSmsText($campaign_id,$this->_userId,$smstext,$campaign_long_url,$campaign_shorturl_text,$result1);    
				}    
 				$newShortText[$i] = $getsendShorturl;  
				$newShortInput[$i] = $shorturl_input;  
			}     
 			
				return array('smstext' => $smstext,'sendShorturl' => $sendShorturl,'newShortText' => $newShortText,'newShortInput' => $newShortInput);
			}else{  
				return array('smstext' => '','sendShorturl' => '','newShortText' => array(),'newShortInput' => array());
			}  
		} 
   
		 
	} 

	public function convertXLStoCSV($infile,$outfile)
	{
	    require_once('Excellib/PHPExcel.php'); 
 
	    if(file_exists($outfile)) {
		unlink($outfile); 
	    } 
	    $fileType = PHPExcel_IOFactory::identify($infile);
	    $objReader = PHPExcel_IOFactory::createReader($fileType);  
	 
	    $objReader->setReadDataOnly(true);   
	    $objPHPExcel = $objReader->load($infile);    

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
 	   
 	    $objWriter->save($outfile);
 	    $total_rows = intval(shell_exec("wc -l $outfile"));    
	    return $total_rows;
 	    
	}   


	/*** CHECK SHORTCODE ALREADY EXISTS ,By Saisandeepthi,2017_05_05 ***/
	public function generateShortCode() {  		
		$this->load->model('Campaign_model'); 
		$codeExists = 0; 
		$n = 1;
		for($i=0;$i<$n;$i++) {   
			$shortCode =  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
			$result = $this->Campaign_model->checkCodeExists($shortCode);
			if($result == 1) {
				$codeExists = 1;    
				$n = 0;break;
			}else{  
				$codeExists = 0;   
			}                 
			     
			$n++;          
		}      
		if($codeExists == 1) {
			return  $shortCode;      
		}else{
			return  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);  
		}
	}


	public function getShortCodeView() {
		$this->load->model('Campaign_model'); 
		$result1 = $this->generateShortCode();
		$shortInput = $this->input->post('user_url');  
		$sendShorturl=  trim($result1);  
		//$getsendShorturl=$this->_data['UrlGenIp']."$result1"; 
		$this->Campaign_model->addShortUrl($shortInput,$this->_userId,$sendShorturl);
		echo json_encode($sendShorturl);
	}

	public function viewcampaigns()
	{ 
 		$off_set = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit =10;  $from_date  = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
	        $to_date  = date('Y-m-d');
   		$mobileNum = '';
  		   
 		$this->_data['selectedUser'] = '';
		if($this->input->post('submit'))
		{  
			
 			$this->session->unset_userdata('mobileNum');
 			$this->session->unset_userdata('noRecordsFound');	
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');	
			$this->session->unset_userdata('selected_sms_type');
			$this->session->unset_userdata('sender_name');	
			$this->session->set_userdata('mobileNum',  $this->input->post('mobileNum'));
			$this->session->set_userdata('from_date',  $this->input->post('from_date'));
			$this->session->set_userdata('to_date', $this->input->post('to_date'));
			$this->session->set_userdata('sender_name', $this->input->post('sender'));  
			$this->session->set_userdata('selected_sms_type', $this->input->post('selected_sms_type'));
			
			if($this->input->post('usersList')) {
				$selectedUser = $this->input->post('usersList');
				$this->session->set_userdata('selectedUser', $selectedUser);
			}
			
			$from_date =  $this->session->userdata('from_date');
			$to_date = $this->session->userdata('to_date');
			$sender_name = $this->session->userdata('sender_name');
		   	$mobileNum = $this->session->userdata('mobileNum');
		   	$selected_sms_type = $this->session->userdata('selected_sms_type');
		   	if($selected_sms_type != 'ApiSms') { $this->session->unset_userdata('noRecordsFound');	$this->session->unset_userdata('mobileNum'); } 
			
			if($selected_sms_type == 'ApiSms') {
				if($sender_name || $mobileNum) { 
					redirect('campaign/apiReport');  
				}
			}
		  }     
		 
			
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
		if($this->session->userdata('selected_sms_type')) {
			$this->_data['selected_sms_type'] =  $this->session->userdata('selected_sms_type');
		}else{
			$this->_data['selected_sms_type'] = 'NormalSms';
		}

		if($this->session->userdata('mobileNum')) {
			$this->_data['mobileNum'] = $mobileNum = $this->session->userdata('mobileNum');
		}else{
			$this->_data['mobileNum'] = $mobileNum;
		} 
		
		if($this->uri->segment(3) == "deleted") {
			$this->_data['deleted'] = "Campaign Has been Deleted";
		}

		$this->_data['page_title'] = "SMS Campaign Reports";

		$this->load->model('Campaign_model');
				  
		$this->_data['abhiBusUserNames'] = $this->_data['abhibusUsers'] = array();$usersList ='';
				
		$userID = $loginUserID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);  
		if(in_array($userID,$abhibusUsers)) {  
			if($this->session->userdata('selectedUser')) {
				$this->_data['selectedUser'] = $userID = $this->session->userdata('selectedUser');
			}else{
				$this->_data['selectedUser'] = $userID = 4411;
			}
			$this->_data['abhibusUsers'] = $abhibusUsers;
			$usersList = '4409,4411';
			$this->_data['abhiBusUserNames'] = $this->Campaign_model->getAbhiBusUsersNames($usersList);
		} 
		 
		$sender = array();  
		if($this->_userType){
			$senderNames = $this->Campaign_model->getSenderNames($userID);
 
			foreach($senderNames as $rs){
				$sender[$rs->sender_name] = $rs->sender_name;
			}
		} else {
			$sender['Promo'] = 'Promo';
		}
 
		
		$this->_data['sender_names'] = $sender;
		$this->_data['user_type'] = $this->_userType;// promo or trans
		$delivered_count=0;
 
		$this->_data['userid'] = $userID;
		$this->_data['loginUserID'] = $loginUserID;
 
 		$campaigns_data = array();
		$campaigns_report = array();
		$this->_data['api_data'] = array(); 

 		if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $td)){
			 $days_diff = $this->daysDifference($fd, $td);	
		}else{     
			$days_diff = 0;
			   
		} 
		
 
		 
		if($this->_data['selected_sms_type'] == 'ApiSms') {
 
			$total_campaigns = $total_days = $day_count = 0;  
			$api_data = array(); 
			if(!$this->session->userdata('noRecordsFound')) {  
				$campaigns_api_data = $this->Campaign_model->get_SMS_API_Reports1($userID,$mobileNum,$fd,$td,$sn);	
				if(!$off_set) { 			
	  
					 foreach($campaigns_api_data as $data_row) {
						 $api_data[]= array(
						 'ondate' => $data_row->ondate,  
						 'noofmsg' => $data_row->noofmsg    
						 );
					 } 
					$day_count = count($campaigns_api_data); 
					$limit = $limit - $day_count;
				}
				if($off_set >= 10) { 
					$totalRecordsCount = count($campaigns_api_data); 
					$off_set = $off_set - $totalRecordsCount; 

				}
				//if(!$mobileNum) {
					$total_days = $this->Campaign_model->get_total_sms_api_days($userID,$fd,$td);			
									
		
		  			$days_data =  $this->Campaign_model->get_sms_api_days($userID,$fd,$td,$off_set,$limit);
					foreach($days_data as $dayrow) {
						$api_data[]= array(
						'ondate' => $dayrow->on_date,   
						'noofmsg' => $dayrow->sms_count  
						);   
					}  
				/*}else{
					$total_days = 0;//$this->Campaign_model->get_total_sms_api_days1($userID,$mobileNum,$days_diff,$fd,$td);			  
	 
	  				$days_data =  $this->Campaign_model->get_sms_api_days1($userID,$mobileNum,$days_diff,$fd,$td,$off_set,$limit);
	  
					foreach($days_data as  $key=>$dayrow) {   
	 
	 					foreach($dayrow as $dayrows) { 
							$api_data[]= array(  
								'ondate' => $dayrows->ondate,   
						  		'noofmsg' => $dayrows->noofmsg  
							);   
						}  
					} 
	 
				}*/	  
		  	        $total_campaigns = $total_days = $total_days+$day_count;
	 			rsort($api_data);
				$this->_data['api_data'] = $api_data;
		         }
 		}else if($this->_data['selected_sms_type'] == 'NormalSms') {
 			 
 			  $campaigns_data = $this->Campaign_model->getAllCampaignsSearchValues( $limit, $off_set, $userID, $sn, $fd, $td); 
   
  	
			  $total_campaigns = $this->Campaign_model->get_campaigns_count1($userID,$sn,$status_=null,$fd,$td); 
 		}else{
 		
 			$campaigns_report = $this->Campaign_model->get_campaigns_report_default($userID);

			  $total_campaigns = $this->Campaign_model->get_campaigns_count1($userID,$sender_name,$status_=null,$from_date=null,$to_date=null);


			$campaigns_data = $this->Campaign_model->getAllCampaigns1($userID,$sender_name,$from_date=null,$to_date=null,$off_set,$limit);
 		
 		} 
 
		$errorTextArray = array();				 
		$limit = 10; 
		$this->_data['campaigns_report'] = $campaigns_report;
		$totalmsg=0;
		$exprd=0;
		$dlrd=0;
		$dnds=0;
		$pndng=0;
		$invald=0;
		$processcnt = 0;
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
		$config['base_url'] = site_url().'campaign/viewcampaigns';

 

		  $config['total_rows'] = $total_campaigns;
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
		$this->_data['campaigns'] = $campaigns_data;
		//print_r($campaigns_data);
		$this->_data['search_result_rs'] ="";
		$this->_data['errorTextArray'] = "";
		$this->_data['rangeA'] = "";
		$this->_data['search'] = "";
		
		 
		$this->_data['delivered_count'] = $delivered_count;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('campaign/reports',$this->_data);  
		$this->load->view('/includes/footer');

	}


	public function getAbhiBusSenderNames() {
		$sender = array();    
		if($this->input->post('selectedUser')) {  
			$userId = $this->input->post('selectedUser');
			if($this->_userType && $userId){
				$this->load->model('Campaign_model');
				$senderNames = $this->Campaign_model->getSenderNames($userId);
				foreach($senderNames as $rs){
					$sender[$rs->sender_name] = $rs->sender_name;
				}
			} else {
				$sender['Promo'] = 'Promo';
			}
		}
		echo json_encode($sender);
	}
  



	
	public function newVariableSMSTest()
	{
		$IP = $this->_data['kernalIp'];  
		$ViewTemplete="";$original_file = "";
		$file_type = "";$Filepath="";$offset = 0;$sms_text = "Of course, the google browser starts with request method OPTION
but always getting this error Request header field Content-Type is not allowed by Access-Control-Allow-Headers in preflight response.";

 		$from_row = 0;$to_row = 0; 

		$original_file = 'test_custom_file.xlsx';

		$Filepath= str_replace(" ","_",$original_file);
 
     

		$excelReader = $this->config->item('excelReader');
		$spreadSheet = $this->config->item('spreadSheet'); 

		require($excelReader);  
		require($spreadSheet);





		// ADDED ON 2017-02-08

		$fileName = $Filepath;
		$getFileName = explode('.',$fileName);
		if(isset($getFileName[0])) {
		$csvFileName = $getFileName[0].'.csv';
		if(file_exists($csvFileName)) {
			unlink($csvFileName); 
		}    
		}
		$Filepath = 'uploads/'.$fileName;  
		$test = shell_exec("sudo /bin/ls /var/www/html/strikerapp/$Filepath | xargs sudo /usr/bin/unoconv -f csv 2>&1");
		$fileCsvPath = '';
		if(isset($getFileName[0])) {
		$fileCsvPath = 'uploads/'.$getFileName[0].'.csv';
		}
		$size = intval(shell_exec("wc -l $fileCsvPath"));

		if(strlen($sms_text)>160)
		$sms_length_tmp1=ceil(strlen($sms_text)/153);
		else
		$sms_length_tmp1=ceil(strlen($sms_text)/160);

		$sms_length1=$sms_length_tmp1;
		$totalCount = $size*$sms_length1;
		 
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$isValidFile = $Spreadsheet->valid(); 

		if($isValidFile == 1) 	{ 
		$BaseMem = memory_get_usage();
		$Sheets = $Spreadsheet -> Sheets();

		//print_r($Sheets);
		$i=0;$string = "";$uploded_data=array();$k=0;
		$maxrows=0;$maxcols=0;
		$string = '<table class="table table-bordered table-striped  no-footer" width="100%" style=" border: 1px solid #E5E5E5;" cellpadding=0 cellspacing=0>';
		//if(!$is_schedule) {
		foreach ($Sheets as $Index => $Name)
		{
			$Spreadsheet -> ChangeSheet($Index); 
			foreach ($Spreadsheet as $Key => $Row)
			{
			$i++; 
			for($j = 0; $j < sizeof($Row); $j++)
			{ 
			if($k > 100) { break;}
			// if($Row[$j] == NULL){ continue; }								
			$uploded_data[$i-1][$j] = $Row[$j];
			$maxrows++;
			}  $k++; 
			}     
			break;
		} 
		//}
		}else{   
		$this->_data['error'] =  'Uploaded file is not in readable format.'; 
		} 


		unset($Spreadsheet); 
		$max_rows=$maxrows; 
		$maxrows = $max_rows = count($uploded_data); 
		$mobile_no_column = $this->input->post('mobile_column'); 
		$var_positions_msg=explode("#",$sms_text);
		$varpositionscount=count($var_positions_msg);
		$data_array = array();
		$total_no_of_sms = 0;
		$validMobileCount = 0; 
		// ADDED ON 2017-02-08
		
		if(!$mobile_no_column){$mobile_no_column=0;}
		if(!$sms_text){$sms_text=1;}	
		if($to_row > $maxrows) { $to_row = $maxrows; }
		if(!$to_row) { $to_row = $maxrows; }
		$mobileNoCount = 0;
		if(!$from_row){$from_row=1;}  
		$message = $sms_text;
		$sms_length = 1;  
		//if(!$is_schedule) {    
		$n = 0;  
		for ($i = $from_row-1; $i < $to_row; $i++) {


		$mobile_no = trim($uploded_data[$i][$mobile_no_column]);
		if($n == 3) {

		if(!is_numeric($mobile_no)) {
		$this->_data['error'] =  'Mobile number column is not matched.';                                                                         
		}    
		} else{  
		$mobileNoCount++;
		if($mobileNoCount > 100) { break;}
		if(strlen($mobile_no)>0 && $mobile_no!=0) {
		$tmp_number = trim($mobile_no);
		if(strlen($tmp_number) == 10)  
		{
		if($tmp_number[0] =='7' or $tmp_number[0] =='8' or $tmp_number[0] =='9' )
		{

		$validMobileCount++;

		$message = "";
		for($j=0;$j<$varpositionscount;$j++) {
		if($j%2 == 1) {
		$colstringValue = $var_positions_msg[$j];
 
 
		$colIndex = $colstringValue;
		if(isset($colIndex)) {
		if(isset($uploded_data[$i][$colIndex])) {
		$message .= trim($uploded_data[$i][$colIndex]);	
		}
		}
		} else {
		$message .= $var_positions_msg[$j];
		}
		}

		// calculate SMS length
		if(strlen($message)>160)
		$sms_length_tmp=ceil(strlen($message)/153);
		else
		$sms_length_tmp=ceil(strlen($message)/160);



		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
		//$sms_length =ceil(strlen($message)/160);

		//$total_no_of_sms = $total_no_of_sms + ceil(strlen($message)/160);
		$total_no_of_sms = $total_no_of_sms + $sms_length;

		$data_array[] = array($mobile_no, $message);
		}
		}
		}   
		}
		$n++;				 
		}  
 
		echo $total_no_of_sms;
						 
	}   
 


	public function customizePreview() {
		$excelReader = $this->config->item('excelReader');
		$spreadSheet = $this->config->item('spreadSheet');
		require($excelReader);  
		require($spreadSheet);
		$data_array = array();
		$fileName = $this->input->post('fileName');
		if($fileName != NULL ) {
			$file_name = $fileName; 
			$file_name = str_replace(" ","_",$file_name);
			//echo $file_name;exit; 
			$Filepath = 'uploads/'.$file_name;
 
			$sms_text = $this->input->post('sms_text');
			$from_row = $this->input->post('from_row');
			$to_row = $this->input->post('to_row');  
			$Spreadsheet = new SpreadsheetReader($Filepath);
			$isValidFile = $Spreadsheet->valid(); 
			$maxrows = 0;
			if($isValidFile == 1) 	{ 
				$Sheets = $Spreadsheet -> Sheets();
				foreach ($Sheets as $Index => $Name)
				{	
					$i = 0;
					$Spreadsheet -> ChangeSheet($Index); 
					foreach ($Spreadsheet as $Key => $Row)
					{
						$i++;      
						for($j = 0; $j < sizeof($Row); $j++)
						{ 
							if($i > 5) { break;}
							 			
							$uploded_data[$i-1][$j] = $Row[$j];
							$maxrows++;
						}  
					}   
					break;
				} 
				unset($Spreadsheet); 
				$max_rows=$maxrows;   
				$maxrows = $max_rows = count($uploded_data); 
				$mobile_no_column = $this->input->post('mobile_column'); 
				$var_positions_msg=explode("#",$sms_text);
				$varpositionscount=count($var_positions_msg);
				$total_no_of_sms = 0;
				$validMobileCount = 0; 
				// ADDED ON 2017-02-08
				if(!$mobile_no_column){$mobile_no_column=0;}
				if(!$sms_text){$sms_text=1;}	
				if($to_row > $maxrows) { $to_row = $maxrows; }
				if(!$to_row) { $to_row = $maxrows; }
				$mobileNoCount = 0;
				if(!$from_row){$from_row=1;}  
				$message = $sms_text;
				$sms_length = 1;  	 
				$n = 0;
				for ($i = $from_row-1; $i < $to_row; $i++) {
					$mobile_no = trim($uploded_data[$i][$mobile_no_column]);		 
					$mobileNoCount++;
					//if($mobileNoCount > 100) { break;}
					//if(strlen($mobile_no)>0 && $mobile_no!=0) {
						$tmp_number = trim($mobile_no);
						//if(strlen($tmp_number) == 10)  
						//{
							//if($tmp_number[0] =='7' or $tmp_number[0] =='8' or $tmp_number[0] =='9' )
							//{

								$validMobileCount++;
								$message = ""; 
								for($j=0;$j<$varpositionscount;$j++) {
									if($j%2 == 1) {
										$colstringValue = $var_positions_msg[$j];
							 
							 
										$colIndex = $colstringValue;
										if(isset($colIndex)) {
											if(isset($uploded_data[$i][$colIndex])) {
												$message .= trim($uploded_data[$i][$colIndex]);	
											}
										}
									} else {
										$message .= $var_positions_msg[$j];
									}
								}
								// calculate SMS length
								if(strlen($message)>160)
									$sms_length_tmp=ceil(strlen($message)/153);
								else
									$sms_length_tmp=ceil(strlen($message)/160);

								$sms_length=$sms_length_tmp;  

 
								$total_no_of_sms = $total_no_of_sms + $sms_length;
								$data_array[] = array($mobile_no, $message,$sms_length);
							//}
						//}  
					//}   
					$n++;				 
				}  
			}
		} 
		echo json_encode($data_array);
	}

    

	public function getCampaignStatus() {
		$campaign_id = $this->input->post('campaign_id');
		$this->load->model('Campaign_model'); 
		$getStatus = $this->Campaign_model->getCampaignStatus($campaign_id);
		echo $getStatus;exit;
	}
	
	public function calculateSMSLength() {
         	$smsText = $this->input->post('smsText'); 
         	$sms_text1 = strtolower(trim($smsText));
		//$isunicode = 0; 
		//if($this->input->post('isunicode')) { $isunicode = $this->input->post('isunicode'); }
         	$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');
         
  
		$sms_text_spl = str_replace($special_char, ' ', $sms_text1); 

		$special_char_2 = array('{','}','[',']','^','|','€','~');
		$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);
   
	 	$array['characters'] = strlen($sms_text_spl2);  
		/*if($isunicode == 1) {
			if(strlen($sms_text_spl2)>70)
				$sms_length_tmp=ceil(mb_strlen($sms_text_spl2)/153);
			else
				$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);
		}else{*/

			if(strlen($sms_text_spl2)>160)
				$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
			else
				$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);
		//}
		 $sms_length=$sms_length_tmp;
		 $array['slength'] = $sms_length;
 
         	echo json_encode($array);
         	
         }
      
          public function apiReport() {
		$fromDate = $this->session->userdata('from_date');
 		$toDate = $this->session->userdata('to_date');
 		$mobileNum = $this->session->userdata('mobileNum');
 		$sender_name = $this->session->userdata('sender_name');
 		$this->_data['viewapireport'] = 'View API Reports'; 
 
		 $off_set=0;  
		$limit = 25;
   
		if($this->uri->segment(3)!='')
		{ 
			$off_set=$this->uri->segment(3);  
		}
 		if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $toDate)){
			 $days_diff = $this->daysDifference($fromDate, $toDate);	
		}else{   
			$days_diff = 0;  
			   
		} 
 
		$this->load->model('Campaign_model');

		$this->_data['userID'] = $userID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409';
		} 
		$apireportview = $api_data = array();
		 $total_days = 0;
		if($mobileNum || $sender_name ) {
		  $apireportview = $this->Campaign_model->get_sms_api_details_filter($userID,$mobileNum,$days_diff,$fromDate,$toDate,$sender_name,$off_set,$limit);
 
		$total_days = $this->Campaign_model->get_sms_api_details_filter_count($userID,$days_diff,$mobileNum,$fromDate,$toDate,$sender_name,$off_set,$limit);  
      
		}   
   
   		 
   		 
 
   		 if($total_days == 0) {
   			$this->session->set_userdata('noRecordsFound',  1);
   			redirect('campaign/viewcampaigns');
   		 }
   

		$this->_data['apireportview'] = $apireportview;
 		$this->_data['dlr_report_type']=$this->_dlr_report_type;
		$this->load->library('pagination');   
		$config['base_url'] = site_url().'/campaign/apiReport';
		$config['total_rows'] = $total_days;
		$config['per_page'] = $limit; 
   
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
		$config['uri_segment'] = 3;
		
   
		$this->pagination->initialize($config);  
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('api/apimobilereport');  
		$this->load->view('includes/footer');  
		 
	} 
	
	
	 public function apiReport_download() {
		$fromDate = $this->session->userdata('from_date');
 		$toDate = $this->session->userdata('to_date');
 		$mobileNum = $this->session->userdata('mobileNum');
 		$sender_name = $this->session->userdata('sender_name');
 		$this->_data['viewapireport'] = 'View API Reports'; 
 		if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $toDate)){
			 $days_diff = $this->daysDifference($fromDate, $toDate);	
		}else{   
			$days_diff = 0;  
			   
		} 
 
		$this->load->model('Campaign_model');

		$userID = $this->_userId;
		$abhibusUsers = array(5742,5741,5740,5739,5733);
		if(in_array($userID,$abhibusUsers)) {
			$userID = '4411,4409';
		}  
		$apireportview = $this->Campaign_model->get_sms_api_details_filter_download($userID,$mobileNum,$days_diff,$fromDate,$toDate,$sender_name);
		$reports = array();
 		if($apireportview) {
 			$rowID = 0;
 			foreach($apireportview as $key => $value) {	
		 		 foreach($value as $row) {
		 		 	$message_ = NULL; 
					if($row->message) {
						$message = $row->message;
						$message = ltrim($row->message,',');  
				 		$message_ = trim(preg_replace('/\s+/', ' ', trim($message))); 
				 	}
				 	
				 	$deliveredDate = NULL;
				 	if($row->delivered_on) {
				 		$deliveredDate = $row->delivered_on;
				 	}
				 	$createdDate = NULL;
				 	if($row->ondate) {
				 		$createdDate = $row->ondate;
				 	}
				 	
				 	$toMobileNum = NULL;
				 	if($row->to_mobileno) {
				 		$toMobileNum = $row->to_mobileno;
				 	}
				 	
				 	$senderName = NULL;
				 	if($row->sender_name) {
				 		$senderName = $row->sender_name;
				 	}
				 	
				 	$numberOFSMS = 0;
				 	if($row->noofmessages) {
				 		  $numberOFSMS = $row->noofmessages;
				 	}
				 	
				 	$dlrStatus = $errorText = '';
				 	if($row->error_text) {
				 		$errorText = $row->error_text;
				 	}
				 
				    if(strlen($toMobileNum) < 10){
				       $dlrStatus =   "Invalid Number";
				    } elseif($row->dlr_status == 1){
				       $dlrStatus =  "Delivered";
				    } elseif($row->dlr_status == "" || $row->dlr_status == NULL  ||  $row->dlr_status == 0){
				      $dlrStatus=  "Pending DLR";
				    }elseif($row->dlr_status == 16){
				        $dlrStatus = $errorText;
				    } elseif($row->dlr_status == 12){  
				       $dlrStatus =   "Not a valid Sender Name";		
				    } elseif($row->dlr_status == 13){
				     $dlrStatus =    "Not a valid Template";
				        	
					
							}elseif($row->dlr_status == 2){
				              $dlrStatus =   "Failed - " . $errorText;
				            } elseif($row->dlr_status == 4){
				                $dlrStatus =   "Queued at SMSC - " . $errorText;
				            } else {
				        if($row->dlr_status == 0){
				            $dlrStatus =   "Pending";
				        } elseif(($this->_dlr_report_type != 0) && $row->dlr_status == 3){
				            $dlrStatus =   "DND Number";
				        } elseif($this->_dlr_report_type == 2){
				            if($row->dlr_status == 2){
				               $dlrStatus =  "Failed - " . $errorText;
				            } elseif($row->dlr_status == 4){
				                $dlrStatus =   "Queued at SMSC - " . $errorText;
				            }
				        } else {  
				            $dlrStatus =   $errorText;
				        }
				    }
		 		 
	 		 		$slNo = ++$rowID;
	 		 		$values = array('SLNo'=> $slNo,'DateTime'=> $createdDate, 'ToMobileNo'=>$toMobileNum,'NoofSMS'=>$numberOFSMS ,'SenderName'=>$senderName,'Status' => $dlrStatus,"Message" => $message_ );
					array_push($reports,$values);     
				 
		 		 } 
		 	}
		 		
		 	$date = date('Y-m-d');				
  			ob_clean();
			$headerDisplayed = false;
			header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
			header('Content-Description: File Transfer');
			header('Content-Type: text/csv; charset=utf-8');
			header("Content-Disposition: attachment; filename=APIReport_".$date.".csv");
			header("Expires: 1");
			header("Pragma: private");
			$fh = @fopen( 'php://output', 'w' );
		 
			foreach ($reports  as $key => $value) {
				if ( !$headerDisplayed ) {
					fputcsv($fh, array_keys($value));
					$headerDisplayed = true;
				}
				fputcsv($fh, $value);
			}  
			fclose($fh);
			exit;
 		} 
	}   
	
	
	function ip_address() 
	{
		return getenv('HTTP_X_FORWARDED_FOR') ?: getenv('REMOTE_ADDR'); 
	} 
	
	
	public function sendAlert($camapign_id,$user_id,$text,$smsLength) {
      		$user="support";  
		$password="Str!k3r2020"; 
		$ipAddress = getenv('HTTP_X_FORWARDED_FOR') ?: getenv('REMOTE_ADDR'); 
		$message = "SMS Campaign CampaignID - $camapign_id, UserName - $user_id ,SMSText - $text , with $smsLength, from $ipAddress";  
   
		$senderid="STRIKR";    
		$messagetype="1";  
  
		$message = urlencode($message); 
		$to = '8886638806,9701019800,7799911229,9966507711';
 
	       $url = "https://www.smsstriker.com/API/sms.php?username=$user&password=$password&from=$senderid&to=$to&msg=$message";
	       $res = file_get_contents($url); 
      	} 
	 
            
}


?>




