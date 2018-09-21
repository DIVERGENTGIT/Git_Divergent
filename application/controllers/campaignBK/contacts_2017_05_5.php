<?php 
 ini_set('display_errors',1);
Class contacts extends CI_Controller
{
    protected $_userId;
    protected $_username;
    protected $_userType;
    protected $_credits;
    protected $_data = array();
    protected $_template_check;
	protected $_International;
	protected $_dndCheck;

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('user_id')) {
            redirect('index/login');
        }

        //user details from session
        $this->_userId = $this->session->userdata('user_id');

        $this->load->model('User_model');
        $userInfo = $this->User_model->getUserDetails($this->_userId);
        $this->_credits = $userInfo[0]->available_credits;
	$this->_data['shorturlCredits'] =  $userInfo[0]->shorturl_credits;
		$this->_International = $userInfo[0]->International;
        $this->_userType = $userInfo[0]->no_ndnc;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
        $this->_template_check = $userInfo[0]->template_check;
        $this->_data['available_credits'] = $this->_credits;
		$this->_dndCheck = $userInfo[0]->dnd_check;
			 	$this->_data['UrlGenIp'] = $UrlGenIp = $this->config->item('UrlGenIp');
    }  

    private function _sendSMS($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date)
    {
		// calculate SMS length
		if(strlen($sms_text)>160)
			$sms_length_tmp=ceil(strlen($sms_text)/153);
		else
			$sms_length_tmp=ceil(strlen($sms_text)/160);

		$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
        //$sms_length = ceil(strlen($sms_text)/160); 
       	$to_mobileno = array_unique($to_mobileno); 
					$to_mobileno = array_values($to_mobileno);
	    $total_numbers = count($to_mobileno);
        $total_no_of_sms = $total_numbers * $sms_length;

        //sender names  
        $_sender = $sender;
	//sender names
	if($this->_userType == 1 && $this->_dndCheck != 1){
		//loop Transactional SMPP
		//$sender_name = "LM-" . $sender;
		$sender_name = $sender;
		$portType = "LT1";

		//sinfini transactional
		//  $sender_name = $sender;
		//$portType = "ST1";
	} elseif($this->_userType == 0){
		//loop Promo SMPP
		$sender = "0". rand(16066,16075);
		//$sender_name = "LM-" . $sender;
		$sender_name = $sender;
		$portType = "LP1";
  
		//sinfini promo
		// $sender_name = $sender;
		//$portType = "SP1";
	} elseif($this->_userType == 2){ 
		//vfirst transactional
		$sender_name = $sender;
		$portType = "VT1";

	}elseif($this->_userType == 1 && $this->_dndCheck == 1){
		//vfirst transactional
		$sender_name = $sender;
		$portType = "LS1";

	}

        $this->load->model('Campaign_model');

        //get port number based on port type
        $sms_port = $this->Campaign_model->getFirstPriorityPort($portType);

        /* To Delete This 
        if($this->_userId == 647){
            $sms_port = 35013;
        } elseif($this->_userId == 1){
            $sms_port = 28013;
        }*/
	 $campaign_name="";
        //create campaign
        $campaign_id = $this->Campaign_model->createCampaign($this->_userId,$sms_type,$sms_text,$sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name);
        if($campaign_id) {
            //deducting credits
            $this->Campaign_model->deductSMSCredits($this->_userId, $total_no_of_sms);

           $configFile = $this->config->item('configFile');
		$functionsFile = $this->config->item('functionsFile');
     include($configFile);
	   include($functionsFile);

            //if campaign is scheduled
            if($is_schedule) {

                for($i=0; $i<count($to_mobileno); $i++) {
                    $mobile_no = trim($to_mobileno[$i]);
                    $this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
                }
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

                //campaign is immediate
                for($i=0; $i < $offset; $i++)
                {
                    $mobile_no = trim($to_mobileno[$i]);
                    //check is block listed number?
                    $is_block_listed = $this->Campaign_model->isBlockListed($mobile_no);
                    if($is_block_listed){
                        $error_text = "Block Listed Number";
                        $this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $sms_text, 2, $error_text);
                    } else {
                        if(!$this->_userType){
                            //check for dnd number
                            $isDND = $this->Campaign_model->checkIsDND($mobile_no);
                            if($isDND){
								  $error_text = "DND Number";
                                $this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $sms_text, 3, $error_text);
                            } else {
                                                          $this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $sms_text,$sms_port);
                                $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name)
                                    ."&to=91$mobile_no&text=".urlencode($sms_text);
                                          $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185:81/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                              // $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185:81/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                                //$URL .= "$mclass&dlr-mask=31&dlr-url=".urlencode("http://smsstriker.com/test.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                               // http_send($URL, $sms_port);


                            }
                        } else {
                                                      $this->Campaign_model->campaignTo($campaign_id, $sms_length, $mobile_no, $sms_text,$sms_port);
                            $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name)
                                ."&to=91$mobile_no&text=".urlencode($sms_text);
                                
                                
      $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185:81/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
// $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185:81/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                            //$URL .= "$mclass&dlr-mask=31&dlr-url=".urlencode("http://smsstriker.com/test.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                            http_send($URL, $sms_port);

                        }
                    }
                }

                if($total_numbers > $priority_sms_count) {
                    for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
                        $mobile_no = trim($to_mobileno[$i]);
                        $this->Campaign_model->scheduledCampaignTo($campaign_id, $sms_text, $mobile_no);
                    }
                }

                if($total_numbers > $priority_sms_count) {
                    $this->Campaign_model->update_campaign_status($campaign_id, '1');
                } else {
                    $this->Campaign_model->update_campaign_status($campaign_id, '2');
                }
            }
            return true;
        }//end of camapign id
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
	
	public function index()
	{
		 

		if($this->input->post('editsubmit')) 
		{
		 $contact_id = $this->uri->segment(5);
			
			
        	if(!$contact_id){
            		redirect('contacts/index');
       		}

		$this->load->model('contact_model');
		$result = $this->contact_model->getContactDetails($this->_userId,$contact_id);

		if(!$result){
		    redirect('contacts/index');
		}
			/*$grouid_byajax= $_REQUEST['id'];
			
			 $this->_data['grouid_byajax'] = $grouid_byajax; */
			 

	//$contacts = $this->contact_model->getAllContacts($this->_userId,$grouid_byajax);

   
			$group_id = $this->input->post('group');
			$contact_name = $this->input->post('contact_name');
			$contact_mobileno = $this->input->post('contcat_mobileno');

                $contact_gender = $this->input->post('contact_gender');
             //  $contact_dob = explode('/',$this->input->post('dob'));
				  
             //   $dob = trim($contact_dob[2])."-".trim($contact_dob[1])."-".trim($contact_dob[0]);
$dob = $this->input->post('dob');
				                $address = $this->input->post('address');
              //  $c_join_date = explode('/',$this->input->post('join_date'));
              //  $join_date = trim($c_join_date[2])."-".trim($c_join_date[1])."-".trim($c_join_date[0]);
              //  $c_relieve_date = explode('/',$this->input->post('relieve_date'));
              //  $relieve_date = trim($c_relieve_date[2])."-".trim($c_relieve_date[1])."-".trim($c_relieve_date[0]);
$relieve_date = $this->input->post('relieve_date');
$join_date = $this->input->post('join_date');
                $this->load->model('contact_model');
                $this->contact_model->updateContact($contact_id,$this->_userId,$group_id,$contact_name,
                 $contact_mobileno,$contact_gender,$dob,$address,$join_date,$relieve_date);
				 
                redirect('contacts/index');
       
     
 //if client type is transactional, check for template if not dynamic
                if($this->_userType == 1 && $this->_template_check){
                    //check for templates
                    $temp_check = $this->_templateCheck($sms_text);
                    if(!$temp_check){
                        $error = true;
                        $error_msg .= "SMS Text not matching with Approved Templates";
                    }
                }

		
		$this->_data['contact_detils'] = $result;
		
		$group_rs = $this->contact_model->getGroups($this->_userId);
		$groups = array('' => '--select--');
		foreach ($group_rs as $rs) {
			$groups[$rs->group_id] = $rs->group_name;
		}
		$this->_data['groups'] = $groups;
		$this->_data['contact_id'] = $contact_id;
		
		}
		    $sender = array();
			
		if($this->_userType){
		    $this->load->model('Campaign_model');
		    $senderNames = $this->Campaign_model->getSenderNames($this->_userId);
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
		  
		  if($this->input->post('editsubmit')){

		$template=$this->input->post('edittemp');
		$template_id=$this->input->post('template_id');
		$this->user_model->updated_template($this->_userId,$template_id,$template);
		redirect('contacts/index');

		}
	
		if($this->input->post('addsubmit')){
			$template=$this->input->post('addtemp');
			$this->user_model->addTemplate($this->_userId,$template);
			redirect('contacts/index');
		}
		if($this->uri->segment(3) == "del")
		{
			$template_id=$this->uri->segment(4);
			$this->user_model->delete_template($this->_userId, $template_id);
			redirect('contacts/index');
		}
	
		if($this->_template_check==1)
			{
			  $templates = $this->user_model->getTemplatesApprove($this->_userId);
			 $this->_data['templates'] = $templates;
			}else
		{
			//$templates = $this->user_model->getTemplates($this->_userId);
			//$this->_data['templates'] = $templates;
	
		}
		if($this->_userType==0)
		{
			//$templates = $this->user_model->getTemplates($this->_userId);
       		//$this->_data['templates'] = $templates;
		}

		if($this->uri->segment(5) == "added") {
			$this->_data['added'] = "New Group has been added"; 
		}
		$mobile_no = $this->input->post('mobile_no');
		if($this->uri->segment(5) == "edited") {
			$this->_data['edited'] = "Changes to the group has been saved"; 
		}
		if($this->uri->segment(5) == "contactdeleted") {
			$this->_data['deleted'] = "Contact has been Deleted"; 
		}
		if($this->uri->segment(5) == "deleted") {
			$this->_data['deleted'] = "Group has been Deleted"; 
		}
		
		if($this->uri->segment(3) == "selectGroups") {
			$this->_data['deleted'] = "Please Select Groups to send SMS";  
		}
		if($this->uri->segment(5) == "addContact") {
			$this->_data['deleted'] = "New Contact has been added";  
		} 
		if($this->uri->segment(3) == "deleted") {
			$this->_data['deleted'] = "Group has been Deleted";  
		}   

		if($this->uri->segment(3) == "file") {
			$this->_data['file'] = "Please upload your file.";
		}
		if($this->uri->segment(3) == "notvalid") {
			$this->_data['file'] = "Not a valid data."; 
		} 
		if($this->uri->segment(3) == "changeName") {
			$this->_data['file'] = "Please select another group name.";  
		}   
		//if($this->uri->segment(3) == "notvalid") {
			//$this->_data['file'] = "Not a valid file data.";
		//}
		    
		//get Groups
		$this->load->model('contact_model');
		$groups = $this->contact_model->getGroupsMobile($this->_userId, $mobile_no);

		
		foreach($groups as $row) {
			$contacts = $this->contact_model->getAllContacts($this->_userId,$row->group_id);
			$row->no_of_contacts = count($contacts);
			}
	  	
			
		
		$this->load->model('Campaign_model');
		$campaigns_data = $this->Campaign_model->getCampaignsLast($this->_userId);
		$this->_data['campaigns'] = $campaigns_data;
	
		$this->_data['userid']=$this->_userId;


		$groups = $this->contact_model->getGroups($this->_userId);


		$this->_data['groups'] = $groups;
		$this->_data['group_id'] = 0;
		$this->_data['page_title'] = "Manage Contacts";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//$this->load->view('contacts/index');
		$this->load->view('contacts/my-contacts');
		$this->load->view('includes/footer');
	}
	
	public function addGroup()
	{
 
		$this->_data['page_title'] = "Add Group - Manage Contacts";
		if ($this->input->post('add_group')) {
			$this->load->library('form_validation'); 
			if ($this->form_validation->run('add_group_form') == TRUE) {

				$config['upload_path'] = 'uploads/';
				$config['allowed_types'] = 'xls|xlsx|txt';
				$config['overwrite'] = true;
				$this->load->library('upload', $config);  
				if ($this->upload->do_upload()) {   
 
					$file = $this->upload->data(); 
 
 
 					  $file_type = $file['file_ext'];
					$file_name = 'uploads/'.$file['file_name']; 


					if($file_type != ".xls" && $file_type != ".xlsx") {
						$this->_data['error'] = "Invalid File Type.";
					} else {
						$this->load->model('contact_model');
						$group_name = $this->input->post('group_name');
						if(!$group_name){redirect('contacts/index');}
						$group_id = $this->contact_model->checkGroupName($this->_userId,$group_name); 
						if($group_id == 'changeName') {
							redirect('contacts/index/changeName');
						}  
   
						 //if($group_id) {
						if($file_type == ".xls") {
							require_once('Excellib/PHPExcel.php');
							require_once('Excellib/PHPExcel/Reader/Excel5.php');
							require_once('Excellib/PHPExcel/IOFactory.php');
							$objReader = new PHPExcel_Reader_Excel5();
						} else if($file_type == '.xlsx') {
							require_once('Excellib/PHPExcel.php');
							require_once('Excellib/PHPExcel/IOFactory.php');

							require_once('Excellib/PHPExcel/Reader/Excel2007.php');
							$objReader = new PHPExcel_Reader_Excel2007();
						}

							$inputFileType = PHPExcel_IOFactory::identify($file_name);

$ContactsAdded = FALSE;

							 if($inputFileType != 'CSV') {


						 		$objPHPExcel = $objReader->load($file_name);
						 		$worksheet = $objPHPExcel->getActiveSheet();
  								$contactsCount = $worksheet->getHighestRow();
								if($contactsCount > 5000) {
									$contactsCount = 5001;
								}   
								
								for ($i = 2; $i <= $contactsCount; $i++) {
									if(strlen(trim($worksheet->getCellByColumnAndRow(1, $i)->getValue())) > 0) {
									       $name = trim($worksheet->getCellByColumnAndRow(0, $i)->getValue());
		

										$mobile = trim($worksheet->getCellByColumnAndRow(1, $i)->getValue());


										$gender = trim($worksheet->getCellByColumnAndRow(2, $i)->getValue());
										$dob = trim($worksheet->getCellByColumnAndRow(3, $i)->getValue());
										$address = trim($worksheet->getCellByColumnAndRow(4, $i)->getValue());
										//$joindate = trim($worksheet->getCellByColumnAndRow(5, $i)->getValue());
										//$relievedate = trim($worksheet->getCellByColumnAndRow(6, $i)->getValue());
										$joindate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(trim($worksheet->getCellByColumnAndRow(5, $i)->getValue())));

										$relievedate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(trim($worksheet->getCellByColumnAndRow(6, $i)->getValue())));   

										$city = 0;
										$gender = $gender?$gender:'';  
										if(is_numeric($mobile)) {
											if($name != NULL && $mobile != NULL &&   $address != NULL )
											{
	 
											
													 if(!$group_id) {
														 $group_id = $this->contact_model->addGroup($this->_userId, $group_name);
													 }	
							  						 if(!$group_id) {
								  						redirect('contacts/index');
													  }else{  
														$ContactsAdded =  $this->contact_model->addContact($this->_userId, $group_id, $name, $mobile, $gender, $dob, $address, $city,$joindate,$relievedate);  

													  }
											}else{
												break;
											}    
										}else{
											break;
										}   		
										  
  
								}else{
									break;
								} 	  
							} 
   
						} 
						
						if($ContactsAdded) {
							redirect('contacts/index/group_id/'.$group_id.'/added');
						}else{
							redirect('contacts/index/notvalid');
						}	  
						
					}
					
				} else {

					 $this->_data['error'] = $this->upload->display_errors('','');
					redirect('contacts/index/notvalid');
 
				}
					
			}
                         
		}

        $this->_data['nogroups'] = false;
        if($this->uri->segment(3) == "nogroups"){
            $this->_data['nogroups'] = true;
        }
		
		 if($this->uri->segment(2) == "addGroup"){
          redirect('contacts/index');
        }
		
		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('contacts/my-contacts');
		$this->load->view('includes/footer');
	}
	
	
	public function addContactsToGroup()
	{
		$this->_data['page_title'] = "Add Group - Manage Contacts";
		
		if ($this->input->post('add_multiplecontacts')) {
			$this->load->library('form_validation');
			if ($this->form_validation->run('add_multiplegroupcontacts_form') == TRUE) {
				$group_id = $this->input->post("group");	
				$config['upload_path'] = 'uploads/';
				$config['allowed_types'] = 'xls|xlsx';
				$config['overwrite'] = true;
				$this->load->library('upload', $config);
				if($group_id) 
				{
				
				if ($this->upload->do_upload()) {
					
					$file = $this->upload->data();
					$file_type = $file['file_ext'];
					$file_name = 'uploads/'.$file['file_name'];
 
 
					if($file_type != ".xls" && $file_type != ".xlsx") {
						$this->_data['error'] = "Invalid File Type.";
					} else {
						$this->load->model('contact_model');
						$group_name = $this->input->post('group_name');
						//$group_id = $this->contact_model->addGroup($this->_userId, $group_name);
						
						if($group_id) {
							if($file_type == ".xls") {
								require_once('Excellib/PHPExcel.php');
								require_once('Excellib/PHPExcel/Reader/Excel5.php');
								$objReader = new PHPExcel_Reader_Excel5();
							} else if($file_type == '.xlsx') {
								require_once('Excellib/PHPExcel.php');
								require_once('Excellib/PHPExcel/Reader/Excel2007.php');
 
								$objReader = new PHPExcel_Reader_Excel2007();
							}
	
							$inputFileType = PHPExcel_IOFactory::identify($file_name);
							if($inputFileType != 'CSV') { 
								$objPHPExcel = $objReader->load($file_name);
								$worksheet = $objPHPExcel->getActiveSheet();

								for ($i = 2; $i <= $worksheet->getHighestRow(); $i++) {
									if(strlen(trim($worksheet->getCellByColumnAndRow(1, $i)->getValue())) > 0) {
										$name = trim($worksheet->getCellByColumnAndRow(0, $i)->getValue());
										$mobile = trim($worksheet->getCellByColumnAndRow(1, $i)->getValue());
										$gender = trim($worksheet->getCellByColumnAndRow(2, $i)->getValue());
										$dob = trim($worksheet->getCellByColumnAndRow(3, $i)->getValue());
										$address = trim($worksheet->getCellByColumnAndRow(4, $i)->getValue());
										$joindate = trim($worksheet->getCellByColumnAndRow(5, $i)->getValue());
										$relievedate = trim($worksheet->getCellByColumnAndRow(6, $i)->getValue());
										$city = null;
										$gender = $gender?$gender:'';
											if($name != NULL && $mobile != NULL &&   $address != NULL )
						  					{
												if(is_numeric($mobile)) {
											  		$this->contact_model->addContact($this->_userId, $group_id, $name, $mobile, $gender, $dob, $address, $city,$joindate,$relievedate);  
												}else{
													redirect('contacts/index/notvalid');
												}

											}else{
												redirect('contacts/index/notvalid');
											}	
										 
									}	  
								}
								 redirect('contacts/index/group_id/'.$group_id.'/added');
							}else{
								redirect('contacts/index/notvalid');
							}  
							//redirect('contacts/index');

						}
						
					}  
					
				} else {
					$this->_data['error'] = $this->upload->display_errors('','');
				}
				
				}
					
			}
		}

		//get Groups
		$this->load->model('contact_model');
		$group_rs = $this->contact_model->getGroups($this->_userId);
        if(count($group_rs) == 0){
           // redirect('contacts/add_group/nogroups');
		   redirect('contacts/index');
        }
        $groups = array('' => '--select--');
		foreach ($group_rs as $rs) {
			$groups[$rs->group_id] = $rs->group_name;
		}
		$this->_data['groups'] = $groups;
			
        $this->_data['nogroups'] = false;
        
        if($this->uri->segment(3) == "nogroups"){
            $this->_data['nogroups'] = true;
        }
        $this->_data['group_id'] = 0;
									redirect('contacts/index');

		//$this->load->view('includes/header',$this->_data);
		//$this->load->view('contacts/add_contacts_to_group');
		//$this->load->view('includes/leftmenu');
		//$this->load->view('contacts/index');
		//$this->load->view('includes/footer');
	}
	
	
	
		/*  public function addContact()
	{
		$this->_data['page_title'] = "Add Contact - Manage Contacts";
		
		if ($this->input->post('add_contact')) {
			$this->load->library('form_validation');
			if ($this->form_validation->run('add_contact_form') == TRUE) {
				
				 //$group_id = $this->input->post("gid");

                $group_count = $this->input->post("group_count");

                $groups = array();
                for($i=1; $i<=$group_count; $i++) {
                    $group_id = $this->input->post("group_$i");
                    if(strlen($group_id)>0 && $group_id!="") {
                        $groups[] = $group_id;
                    }
                }

                if(count($groups) == 0) {

                } else {

				    $contact_name = $this->input->post('contact_name');
				    $contcat_mobileno = $this->input->post('contcat_mobileno');
				    $contact_gender = $this->input->post('contact_gender');
				    $contact_dob = explode('/',$this->input->post('dob'));
				    $dob = trim($contact_dob[2])."-".trim($contact_dob[1])."-".trim($contact_dob[0]);
				    $address = $this->input->post('address');
				    $c_join_date = explode('/',$this->input->post('join_date'));
				    $join_date = trim($c_join_date[2])."-".trim($c_join_date[1])."-".trim($c_join_date[0]);
				    $city = "";
				    $c_relieve_date = explode('/',$this->input->post('relieve_date'));
				    $relieve_date = trim($c_relieve_date[2])."-".trim($c_relieve_date[1])."-".trim($c_relieve_date[0]);
				
				    $this->load->model('contact_model');
				
				    foreach($groups as $group_id) {
					    $this->contact_model->addContact($this->_userId, $group_id, $contact_name, $contcat_mobileno, $contact_gender, $dob, $address, $city, $join_date, $relieve_date);
				    }
                }
				
				redirect('contacts/index');
			}
		}
		
		//get Groups
		$this->load->model('contact_model');
		$group_rs = $this->contact_model->getGroups($this->_userId);
        if(count($group_rs) == 0){
            redirect('contacts/addGroup/nogroups');
        }
		foreach ($group_rs as $rs) {
			$groups[$rs->group_id] = $rs->group_name;
		}
		$this->_data['groups'] = $groups;
		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('contacts/add_contact');
		$this->load->view('includes/footer');		
	}
	*/
	
	
 
	public function addContact()
	{
		$this->_data['page_title'] = "Add Contact - Manage Contacts";

		if ($this->input->post('add_contact')) { 

			$this->load->library('form_validation');
			if ($this->form_validation->run('add_contact_form') == TRUE) {
 
				 $group_id = $this->input->post("gid");

/*            $group_count = $this->input->post("group_count");

                $groups = array();
                for($i=1; $i<=$group_count; $i++) {
                    $group_id = $this->input->post("group_$i");
                    if(strlen($group_id)>0 && $group_id!="") {
                        $groups[] = $group_id;
                    }
                }*/

 
 
				    $contact_name = $this->input->post('contact_name');
				    $contcat_mobileno = $this->input->post('contcat_mobileno');
				    $contact_gender = $this->input->post('contact_gender');
 
				   // $contact_dob = explode('/',$this->input->post('dob'));
				    //   $dob = trim($contact_dob[2])."-".trim($contact_dob[1])."-".trim($contact_dob[0]);
 $dob = $this->input->post('dob');
				    $address = $this->input->post('address');
				  //  $c_join_date = explode('/',$this->input->post('join_date'));
				   //  $join_date = trim($c_join_date[2])."-".trim($c_join_date[1])."-".trim($c_join_date[0]);

   					$join_date =$this->input->post('join_date');
				    $city = "0"; 
				  //  $c_relieve_date = explode('/',$this->input->post('relieve_date'));
				     // $relieve_date = trim($c_relieve_date[2])."-".trim($c_relieve_date[1])."-".trim($c_relieve_date[0]);
				$relieve_date = $this->input->post('relieve_date');
 
			  $this->load->model('contact_model');

$gender = $contact_gender?$contact_gender:'';
			if($contact_name != NULL && $contcat_mobileno != NULL  &&   $address != NULL )
			{  
				if(is_numeric($contcat_mobileno)) {
			  		$this->contact_model->addContact($this->_userId, $group_id, $contact_name, $contcat_mobileno, $gender, $dob, $address, $city, $join_date, $relieve_date);  
				}else{  
					redirect('contacts/index/notvalid');
				}
  
			}else{
				redirect('contacts/index/notvalid');
			}
			    
				 
                
				
				redirect('contacts/index/group_id/'.$group_id.'/addContact');
			}
		}
		
		//get Groups
		$this->load->model('contact_model');
		$group_rs = $this->contact_model->getGroups($this->_userId);
        if(count($group_rs) == 0){
            //redirect('contacts/addGroup/nogroups');
			redirect('contacts/index');
        }
		foreach ($group_rs as $rs) {
			$groups[$rs->group_id] = $rs->group_name;
		}
		$this->_data['groups'] = $groups;
			 if($this->uri->segment(5) == "addContact"){
         redirect('contacts/index/addContact'); 
        }
		$this->load->view('includes/header',$this->_data);
	//	$this->load->view('contacts/add_contact');
		$this->load->view('includes/leftmenu');
		$this->load->view('contacts/index');
		$this->load->view('includes/footer');		
	}
	public function viewGroup()
	{
		$group_id = $this->uri->segment(4);

        if(!$group_id){
            redirect('contacts/index');
        }

		$this->load->model('contact_model');

		$contacts = $this->contact_model->getAllContacts($this->_userId,$group_id);

        if(!$contacts){
            redirect('contacts/index');
        }

        if($this->uri->segment(3) == "selectContacts") {
            $this->_data['deleted'] = "Please Select Contacts to send SMS";
        }

        if($this->uri->segment(5) == "edited"){
            $this->_data['edited'] = "Changes to the contact details have been saved";
        }

        if($this->uri->segment(5) == "deleted"){
            $this->_data['edited'] = "Contact has been deleted from this Group";
        }

		$this->_data['group_id'] = $group_id;
		$this->_data['contacts'] = $contacts;
		$this->_data['page_title'] = "Manage Contacts";
		//$this->load->view('includes/header',$this->_data);
		//$this->load->view('contacts/contacts');
		//$this->load->view('includes/footer');
		   redirect('contacts/index');
	}
	
	//added this by bharath on 09/08/2014
	public function Download()
	{
		$group_id = $this->uri->segment(4);

        if(!$group_id){
            redirect('contacts/index');
        }

		$this->load->model('contact_model');

		$contacts = $this->contact_model->getAllContacts($this->_userId,$group_id);

        if(!$contacts){
            redirect('contacts/index');
        }

        $this->_data['group_id'] = $group_id;
		$this->_data['contacts'] = $contacts;
		
		
		$filename="contactslist.xls";
		$contents="Name \t Mobile \t Gender \t classid \t \n";
		foreach($contacts as $contact) {
            $mobile = $contact->mobile_no;
            $name=$contact->name;
            $gender=$contact->gender;
            
		
		$contents.= $name. "\t";
		$contents.=$mobile. "\t";
		$contents.=$gender. "\n";
		
		}
		header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $contents;
			}
	
	public function editGroup()
	{
		 $group_id = $this->uri->segment(4);

        if(!$group_id){
            redirect('contacts/index');
        }

		$this->load->model('contact_model');
		$group_name = $this->contact_model->getGroupName($this->_userId,$group_id);
		
		

        if(!$group_name){
            redirect('contacts/index');
        }

		if($group_name) {
		
			if ($this->input->post('edit_group')) {
			
				$this->load->library('form_validation');
				if ($this->form_validation->run('edit_group_form') == TRUE) {
				$groupName = $this->input->post('group_name');

				
					
					$this->contact_model->editGroup($group_id,$groupName);
					redirect('contacts/index/group_id/'.$group_id.'/edited');
				}
			}
		
			$this->_data['group_id'] = $group_id;
			$this->_data['group_name'] = $group_name;
		}
		$this->_data['page_title'] = "Edit Group";
		$this->load->view('includes/header',$this->_data);
		//$this->load->view('contacts/edit_group');

		$this->load->view('includes/footer');
				
	}
	

	
	public function deleteGroup()
	{
		$group_id = $this->uri->segment(4);

        if(!$group_id){
            redirect('contacts/index');
        }

		$this->load->model('contact_model');
		$group_name = $this->contact_model->getGroupName($this->_userId,$group_id);
		if($group_name) {
			$this->contact_model->deleteGroup($this->_userId, $group_id);
			redirect('contacts/index/deleted');
		} else {
			redirect('contacts/index');
		}
	}
	
	public function viewContact()
	{
		$contact_id = $this->uri->segment(4);

        if(!$contact_id){
            redirect('contacts/index');
        }

		$this->load->model('contact_model');
		$contact_details = $this->contact_model->getContactDetails($this->_userId,$contact_id);

        if(!$contact_details){
            redirect('contacts/index');
        }
			
        foreach($contact_details as $contact) {
            $mobile = $contact->mobile_no;
            $groups_rows = $this->contact_model->getMobileGroups($this->_userId,$mobile);

            $groups ="";
            foreach($groups_rows as $grp) {
                $groups .= "<a href='".site_url('contacts/viewGroup/group/'.$grp->group_id)."'>$grp->group_name</a>,";
            }
        }

        $this->_data['groups'] = substr($groups,0,-1);
        $this->_data['contact_details'] = $contact_details;
        $this->_data['page_title'] = "Manage Contacts - View Contact Details";
        $this->load->view('includes/header',$this->_data);
        $this->load->view('contacts/view_contact_details');
        $this->load->view('includes/footer');
	}

    public function deleteContact()
    {
      $contact_id = $this->uri->segment(4);
	

        if(!$contact_id){
            redirect('contacts/index');
        }

        $this->load->model('contact_model');
        $contact_details = $this->contact_model->getContactDetails($this->_userId,$contact_id);

        if(!$contact_details){
            redirect('contacts/index');
        }
  
        foreach($contact_details as $row){
            $group_id = $row->group_id;
        }

        $this->contact_model->deleteContact($this->_userId,$contact_id);
       redirect("contacts/index/group_id/$group_id/contactdeleted");
		 //redirect("contacts/index");

    }  
	
	  
	public function sendGroupSMS()
	{
		$this->load->model('contact_model');
 		if($this->input->post('sendsms')) {  
 
			$groups = $this->input->post('selected_groups');  
			$this->load->library('form_validation');
			if ($this->form_validation->run('group_sms_form') == TRUE) {
				$this->_data['validatationtrue'] ="1";
				if(strlen($groups) == 0) {
					//redirect('contacts/index/selectGroups');
					 redirect("contacts/index");
				}  
		$campaign_name = $this->input->post('campaign_name');
                $sms_text = $this->input->post('sms_text');
                $sender = $this->input->post('sender');
                $sms_type = $this->input->post('sms_type');
                $is_schedule = $this->input->post('schedule');
                $scheduled_date = $this->input->post('on_date');
		$shorturl_input=$this->input->post('shorturl_input');
		$shorturl_text=$this->input->post('shorturl_text');

                $error = false;
                $error_msg = "";
                //validating the scheduled date, if it is scheduled
		$is_schedule = '';
		if($scheduled_date != NULL )  { $is_schedule = 1; }
                if($is_schedule) {
                    if(!$scheduled_date) {    
                        $error = true;
                       $this->_data['error'] = $error_msg .= "Please enter schedule date";
                    }
                }

                //if client type is transactional, check for template if not dynamic
                if($this->_userType == 1 && $this->_template_check){
                    //check for templates
                    $temp_check = $this->_templateCheck($sms_text);
                    if(!$temp_check){
                        $error = true;
                       $this->_data['error'] =   $error_msg .= "SMS Text not matching with Approved Templates";
                    }
                }

                if($error) {
                    $this->_data['error'] = $error_msg;
                } else {
					
					// calculate SMS length
					if(strlen($sms_text)>160)
						$sms_length_tmp=ceil(strlen($sms_text)/153);
					else
						$sms_length_tmp=ceil(strlen($sms_text)/160);
	
					$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
                    			//$sms_length = ceil(strlen($sms_text)/160); 

					$contacts = $this->contact_model->getGroupContacts($this->_userId,$groups);
 
                    $to_mobileno = array();
                    foreach($contacts as $row) {
                          $to_mobileno[] = trim($row->mobile_no);
                      }
                      	$to_mobileno = array_unique($to_mobileno); 
					$to_mobileno = array_values($to_mobileno);
					$total_numbers = count($to_mobileno);  
					$total_no_of_sms = $total_numbers * $sms_length;
					
					//checking credits
					if($total_no_of_sms > $this->_credits) {
						 $this->_data['error'] = $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$total_no_of_sms} credits"; 
					} else {
                        //send SMS
 
			               $this->_sendNormalSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text);  
     
                              		// redirect('campaign/viewcampaigns');
                                    }
				}
				
			}
			  
		} else {
 
 
		 	$groups_count = $this->input->post('groups');
			$groupCount = $this->input->post('groups_count');
			
			$group_select_count = 0;
			$selected_groups = "";
			for($i=0; $i<count($groups_count); $i++) {
			 	if($groupCount == 1) {
					$val = $groups_count;
				}else{
			 		$val = $groups_count[$i];
 	
				}  
 
				if($val != '') 
				{ 
					$group_select_count++;
					 $selected_groups .= $val.",";
			 		
				}
				
			}
 
					
			if($group_select_count==0) {
				//redirect('contacts/index/selectGroups');
				redirect('contacts/index');
			} else{
				$groups = substr($selected_groups,0,-1);
			}
		}
 
 
		
		$sender = array();
          if($this->_userType){
            $this->load->model('Campaign_model');
            $senderNames = $this->Campaign_model->getSenderNames($this->_userId);
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
		  
		if($this->_template_check==1)
			{
			  $templates = $this->user_model->getTemplatesApprove($this->_userId);
			 $this->_data['templates'] = $templates;
			}else
		{
			$templates = $this->user_model->getTemplates($this->_userId);
			$this->_data['templates'] = $templates;
	
		}
		if($this->_userType==0)
		{
			$templates = $this->user_model->getTemplates($this->_userId);
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
 		$this->_data['user_id'] = $this->_userId;
		$this->_data['groups'] = $groups;  
		$this->_data['getgroupinfo'] = $this->contact_model->getGroupInfo($this->_userId,$groups); 
 
 		$this->_data['page_title'] = "Group SMS";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('contacts/group_sms');
		//$this->load->view('contacts/my-contacts');
	
		$this->load->view('includes/footer');
		
	}
	  
	  
	
	
	public function contact_list_ajax()
	{
		 
		 $this->load->model('Contact_model');
		$group_id = $this->input->post('id');
			$this->_data['group_id'] = $group_id;
 
		$contactdetails = $this->Contact_model->contact_view_ajax($this->_userId,$group_id);
		$this->_data['contactdetails'] = $contactdetails;
			$this->_data['user_id'] = $this->_userId;
		
			$sender = array();
		if($this->_userType){
		    $this->load->model('Campaign_model');
			

		    $senderNames = $this->Campaign_model->getSenderNames($this->_userId);
		    $sender[''] = '--select--';
		    foreach($senderNames as $rs){
		        $sender[$rs->sender_name] = $rs->sender_name;
		    }
		} else {
		    $sender['Promo'] = 'Promo';
		}
		
		
		
					//get added templates
		$this->load->model('Campaign_model');
		$campaigns_data = $this->Campaign_model->getCampaignsLast($this->_userId);
		$this->_data['campaigns'] = $campaigns_data;

		$this->load->model('user_model');
			  
			  if($this->input->post('editsubmit')){

			$template=$this->input->post('edittemp');
			$template_id=$this->input->post('template_id');
			$this->user_model->updated_template($this->_userId,$template_id,$template);
			redirect('contacts/index');

		}
	
		if($this->input->post('addsubmit')){
			$template=$this->input->post('addtemp');
			$this->user_model->addTemplate($this->_userId,$template);
			redirect('contacts/index');
		}
		if($this->uri->segment(3) == "del")
		{
			$template_id=$this->uri->segment(4);
			$this->user_model->delete_template($this->_userId, $template_id);
			redirect('contacts/index');
		}
	
			if($this->_template_check==1)
				{
				  $templates = $this->user_model->getTemplatesApprove($this->_userId);
				 $this->_data['templates'] = $templates;
				}else
			{ 
				$templates = $this->user_model->getTemplates($this->_userId);
				$this->_data['templates'] = $templates;
	
			}
			if($this->_userType==0)
			{
				$templates = $this->user_model->getTemplates($this->_userId);
	       		$this->_data['templates'] = $templates;
			}

		
			if($this->uri->segment(5) == "added") {
				$this->_data['added'] = "New Group has been added"; 
			}
			$mobile_no = $this->input->post('mobile_no');
			if($this->uri->segment(5) == "edited") {
				$this->_data['edited'] = "Changes to the group has been saved"; 
			}
		
			if($this->uri->segment(3) == "deleted") {
				$this->_data['deleted'] = "Group has been Deleted"; 
			}
		
			if($this->uri->segment(3) == "selectGroups") {
				$this->_data['deleted'] = "Please Select Groups to send SMS";
			}
		
				$this->_data['sender_names'] = $sender;


		//print_r($this->_data['contactdetails']);exit;
		$this->load->view('contacts/contact_list_ajax',$this->_data);
		
	}
	
	
	
	public function group_view_details()
	{
		$this->load->model('Contact_model');
		$group_id = $this->input->post('id');
		$this->_data['group_id'] = $group_id;

		$groupdetails = $this->Contact_model->group_view_ajax($this->_userId,$group_id);
		$this->_data['groupdetails'] = $groupdetails;
	
		$groupcount = $this->Contact_model->getTotalContactsCount($this->_userId,$group_id);
		$this->_data['groupcount'] = $groupcount;

		$sender = array();
		if($this->_userType){
		    $this->load->model('Campaign_model');
			

		    $senderNames = $this->Campaign_model->getSenderNames($this->_userId);
		    $sender[''] = '--select--';
		    foreach($senderNames as $rs){
		        $sender[$rs->sender_name] = $rs->sender_name;
		    }
		} else {
		    $sender['Promo'] = 'Promo';
		}
		
		
		
					//get added templates
		$this->load->model('Campaign_model');
		$campaigns_data = $this->Campaign_model->getCampaignsLast($this->_userId);
		$this->_data['campaigns'] = $campaigns_data;

		$this->load->model('user_model');
			  
			  if($this->input->post('editsubmit')){

			$template=$this->input->post('edittemp');
			$template_id=$this->input->post('template_id');
			$this->user_model->updated_template($this->_userId,$template_id,$template);
			redirect('contacts/index');

		}
	
		if($this->input->post('addsubmit')){
			$template=$this->input->post('addtemp');
			$this->user_model->addTemplate($this->_userId,$template);
			redirect('contacts/index');
		}
		if($this->uri->segment(3) == "del")
		{
			$template_id=$this->uri->segment(4);
			$this->user_model->delete_template($this->_userId, $template_id);
			redirect('contacts/index');
		}
	
			if($this->_template_check==1)
				{
				  $templates = $this->user_model->getTemplatesApprove($this->_userId);
				 $this->_data['templates'] = $templates;
				}else
			{
				$templates = $this->user_model->getTemplates($this->_userId);
				$this->_data['templates'] = $templates;
	
			}
			if($this->_userType==0)
			{
				$templates = $this->user_model->getTemplates($this->_userId);
	       		$this->_data['templates'] = $templates;
			}

		
			if($this->uri->segment(5) == "added") {
				$this->_data['added'] = "New Group has been added"; 
			}
			$mobile_no = $this->input->post('mobile_no');
			if($this->uri->segment(5) == "edited") {
				$this->_data['edited'] = "Changes to the group has been saved"; 
			}
		
			if($this->uri->segment(3) == "deleted") {
				$this->_data['deleted'] = "Group has been Deleted"; 
			}
		
			if($this->uri->segment(3) == "selectGroups") {
				$this->_data['deleted'] = "Please Select Groups to send SMS";
			}  
		
			$this->_data['sender_names'] = $sender;
			//print_r($this->_data['groupdetails']);exit;
			$this->load->view('contacts/group_view_details',$this->_data);

	  
	

	}
	
	
	public function contact_view()
	{
		$this->load->model('contact_model');
		 $contact_id = $_REQUEST['cid'];
		$this->_data['contact'] = $this->contact_model->getContactDetails($this->_userId,$contact_id);
		$this->_data['groups'] = $this->contact_model->getGroups($this->_userId);

		 $this->load->view('contacts/contact_view',$this->_data);

	}
	public function editContact()  
	{
		// $contact_id = $this->uri->segment(5);
	
		$contact_id = $this->input->post('contact_id');

		if(!$contact_id){
		    redirect('contacts/index');
		}

		$this->load->model('contact_model');
		$result = $this->contact_model->getContactDetails($this->_userId,$contact_id);

        if(!$result){
            redirect('contacts/index');
        }


        if ($this->input->post('edit_contact')) {
 
                $group_id = $this->input->post('group');
			   
                $contact_name = $this->input->post('contact_name');
				 $contact_mobileno = $this->input->post('contcat_mobileno');
                $gender = $this->input->post('contact_gender')?$this->input->post('contact_gender'):'0';
				 $address = $this->input->post('address');
						   
				$dob=$this->input->post('dob');
				$join_date=$this->input->post('join_date');
				$relieve_date=$this->input->post('relieve_date');

                $this->load->model('contact_model');

  $this->contact_model->updateContact($contact_id,$this->_userId,$group_id,$contact_name,$contact_mobileno,$gender,$dob,$address,$join_date,$relieve_date);  
                 redirect('contacts/index/group_id/'.$group_id.'/edited');
                //redirect('contacts/index');  
				
                     }
     
		
		$this->_data['contact_detils'] = $result;
		
		$group_rs = $this->contact_model->getGroups($this->_userId);
		$groups = array('' => '--select--');
		foreach ($group_rs as $rs) {
			$groups[$rs->group_id] = $rs->group_name;
		}
		$this->_data['groups'] = $groups;
		$this->_data['contact_id'] = $contact_id;
		
		$this->_data['page_title'] = "Edit Contact";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('contacts/edit_contact');
		$this->load->view('includes/footer');
	}
	
	public function sendSMS()
	{
  	
		$this->load->model('contact_model');
		 $group_id = $this->input->post('group');  
		 $this->_data['getgroupinfo'] = array();
		if ($this->input->post('sendsms')) {
 
			$contacts = $this->input->post('selected_contacts');
			$this->load->library('form_validation');
			$error = false;
			if ($this->form_validation->run('contact_sms_form') == TRUE) {
					$this->_data['validatationtrue'] ="1";  
				if(strlen($contacts) == 0) {
					//redirect('contacts/viewGroup/group/'.$group_id.'/selectContacts');
					redirect('contacts/index');
				}
		$campaign_name = $this->input->post('campaign_name');
                $sms_type = $this->input->post('sms_type');
                $sms_text = $this->input->post('sms_text');
                $sender = $this->input->post('sender');
                $is_schedule = $this->input->post('schedule');
                $scheduled_date = $this->input->post('on_date');
		$shorturl_input=$this->input->post('shorturl_input');
		$shorturl_text=$this->input->post('shorturl_text');
				$error = false;
                $error_msg = "";
                //validating the scheduled date, if it is scheduled
                if($is_schedule) {
                    if(!$scheduled_date) {
                        $error = true;
                       $this->_data['error'] =   $error_msg .= "Please enter schedule date";
                    }
                }

                //if client type is transactional, check for template if not dynamic
                if($this->_userType == 1 && $this->_template_check){
                    //check for templates
                    $temp_check = $this->_templateCheck($sms_text);
                    if(!$temp_check){
                        $error = true;
                       $this->_data['error'] =   $error_msg .= "SMS Text not matching with Approved Templates";
                    }
                }

                if($error) {
                    $this->_data['error'] = $error_msg;
                } else {

					
					// calculate SMS length
					if(strlen($sms_text)>160)
						$sms_length_tmp=ceil(strlen($sms_text)/153);
					else
						$sms_length_tmp=ceil(strlen($sms_text)/160);
					
					$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
					//$sms_length = ceil(strlen($sms_text)/160);

					$contacts_info = $this->contact_model->getContacts($this->_userId,$contacts);
                    $to_mobileno = array();  
                    foreach($contacts_info as $row) {
                        $to_mobileno[] = trim($row->mobile_no);
                    }
                    	$to_mobileno = array_unique($to_mobileno); 
					$to_mobileno = array_values($to_mobileno);
					$total_numbers = count($to_mobileno);
					$total_no_of_sms = $total_numbers * $sms_length;  
					
					//checking credits
					if($total_no_of_sms > $this->_credits) {
					 $this->_data['error'] =  $this->_data['no_balance'] = "Insufficient SMS Credits. Require {$total_no_of_sms} credits"; 
					} else {
                        //send SMS
                        //$this->_sendSMS($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date);
			  $this->_sendNormalSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text);  
                        //redirect('campaign/viewcampaigns');
					}
					  
				}
				
			}
			
		} else {
			/*$contacts_count = $this->input->post('contacts_count');
		
			$contact_select_count = 0;
			$selected_contacts = "";
			for($i=1; $i<=$contacts_count; $i++) {
				$val = $this->input->post('contact_'.$i);
				if($val != '') {
					$contact_select_count++;
					$selected_contacts .= $val.",";
				}
			} */


 			$contact_select_count = 0;
			$selected_contacts = "";    
			$contacts_count = $this->input->post('contacts_count');
			if($contacts_count == 1) {
				for($i=1; $i<=$contacts_count; $i++) {
					$val = $this->input->post('contact_'.$i);
					//$val = $contacts_info[$i]['contact_id'];  
					if($val != '') {  
						$contact_select_count++;
						$selected_contacts .= $val.",";
	   
					}      
				}
			}else{
				if($group_id) {
				$contacts_info = $this->contact_model->contact_list_view_ajax($this->_userId,$group_id);
				$contacts_count =  count($contacts_info);
				    
				for($i=0; $i<$contacts_count; $i++) {
					//$val = $this->input->post('contact_'.$i);
					$val = $contacts_info[$i]['contact_id'];  
					if($val != '') {  
						$contact_select_count++;
						$selected_contacts .= $val.",";
	   
					}    
				}
					}
			}  

			if($contact_select_count==0) {
				redirect('contacts/viewGroup/group/'.$group_id.'/selectContacts');
			} else{
				$contacts = substr($selected_contacts,0,-1);
			}
					$this->_data['getgroupinfo'] = $this->contact_model->getContactsInfo($this->_userId,$group_id,$contacts);
		}


        $sender = array();
        if($this->_userType){
            $this->load->model('Campaign_model');
            $senderNames = $this->Campaign_model->getSenderNames($this->_userId);
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
		  
		if($this->_template_check==1)
			{
			  $templates = $this->user_model->getTemplatesApprove($this->_userId);
			 $this->_data['templates'] = $templates;
			}else
		{
			$templates = $this->user_model->getTemplates($this->_userId);
			$this->_data['templates'] = $templates;
	
		}
		if($this->_userType==0)
		{
			$templates = $this->user_model->getTemplates($this->_userId);
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
	
		$this->_data['group'] = $group_id;
		$this->_data['contacts'] = $contacts;
		$this->_data['user_id'] = $this->_userId;

  
 		$this->_data['page_title'] = "Send SMS to Contacts";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('contacts/send_sms');
		$this->load->view('includes/footer');
	}
	
	public function getGroupDetails() {  
		$this->load->model('contact_model'); 
		if($this->input->post('group_id')) {
			 if($this->input->post('contact_id')) {
				 $groupId = $this->input->post('group_id');
				 $contactId = $this->input->post('contact_id');
				 $resp = $this->contact_model->getContactDetails_new($this->_userId,$contactId,$groupId);
				 echo json_encode($resp);   
			 }else{
				 $groupId = $this->input->post('group_id');
				 $resp = $this->contact_model->getGroupData($this->_userId,$groupId);
				 echo json_encode($resp);  
		   	 } 
		}  
	} 

	public function addGroupData() {
 
		$this->load->model('contact_model'); 
		if($this->input->post('add_group')) {

			$addgrouptype = $this->input->post('addgrouptype'); 
			if($addgrouptype == 1) { 
	  			$this->addGroup($this->input->post());  
			}else{
				$group_name = $this->input->post('group_name');
				$group_id = $this->contact_model->checkGroupName($this->_userId,$group_name); 
				if($group_id == 'changeName') {
					redirect('contacts/index/changeName');
				}else if($group_id) {
 					$group_id = $group_id; 
				}else{
					$group_id = $this->contact_model->addGroup($this->_userId,$group_name);
				} 
				
				$contact_name = $this->input->post('contact_name');
				$contcat_mobileno = $this->input->post('contcat_mobileno');
				$contact_gender = $this->input->post('contact_gender');

				//$contact_dob = explode('/',$this->input->post('dob'));
				//$dob = trim($contact_dob[2])."-".trim($contact_dob[1])."-".trim($contact_dob[0]);
				$dob = $this->input->post('dob'); 
				$address = $this->input->post('address');
				//$c_join_date = explode('/',$this->input->post('join_date'));
				//$join_date = trim($c_join_date[2])."-".trim($c_join_date[1])."-".trim($c_join_date[0]);
				$join_date = $this->input->post('join_date');
				$relieve_date = $this->input->post('relieve_date');
				$city = "0";  
				//$c_relieve_date = explode('/',$this->input->post('relieve_date'));
				//$relieve_date = trim($c_relieve_date[2])."-".trim($c_relieve_date[1])."-".trim($c_relieve_date[0]);

				$this->contact_model->addContact($this->_userId, $group_id, $contact_name, $contcat_mobileno, $contact_gender, $dob, $address, $city, $join_date, $relieve_date);   
				redirect('contacts/index/group_id/'.$group_id.'/added'); 	
			} 
 
		}    
		redirect('contacts/index'); 	
	}

	private function _sendNormalSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text)
   {
         
 
	//  date_default_timezone_set("Asia/Calcutta"); 
	//Country code and route port configuration  
	$CountryRoute = array("971" => "34013","91" => "34013","972" => "34013","971" => "34013","968" => "34013","966" => "34013","974" => "34013","90" => "34013","973" => "34013","962" => "34013","965" => "34013","60" => "34013","95" => "34013","63" => "34013","65" => "34013","84" => "34013","62" => "34013");

  
	// calculate SMS length
	$sms_text1 = strtolower($sms_text);
	//remove special characters 
	//changed on 4thmay2015 by bharath for characters count.
	$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

	$sms_text_spl = str_replace($special_char, ' ', $sms_text1);



	$special_char_2 = array('{','}','[',']','^','|');
	$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);

	if(strlen($sms_text_spl2)>160)
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
	else
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

	$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request	
	//$sms_length = ceil(strlen($sms_text)/160);
	$to_mobileno = array_unique($to_mobileno); 
					$to_mobileno = array_values($to_mobileno);

	$total_numbers_ex_invalidno=0;
	//$mobile_no = trim($to_mobileno[$i]);
	$this->load->model('campaign_model');
		 $to_mobileno =  array_values($to_mobileno); 
	$validNosArray = $this->campaign_model->Validnumbers($to_mobileno);
	$validNosArray = array_filter($validNosArray);
	if($this->_International==1)
	{
		$validNosArray = $to_mobileno;
		$validNosArray = $this->campaign_model->checkCountry($to_mobileno,$this->_AllowedCountry);
	}
  
 	  	$to_mobileno = $validNosArray;
	
	//print_r($validNosArray);
	$validNosCount=count($validNosArray);  
	//echo $validNosCount;
	$total_numbers = count($to_mobileno);
	//$is_duplicate=$this->campaign_model->checkduplicate($this->_userId,$sms_text,$sender,$mobile_no);
	//duplicate

	$invalidNosCount=$total_numbers-$validNosCount;
	$duplicatecount = $this->campaign_model->duplicate($this->_userId,$sms_text,$sender,$validNosArray); 
	//duplicate	
        $total_numbers_ex_invalidno=$total_numbers-($invalidNosCount+$duplicatecount);		
        //$total_numbers_ex_invalidno=$total_numbers-$invalidNosCount;
        $total_no_of_sms = $total_numbers * $sms_length;
	$total_numbers_ex_invalidno = $total_numbers_ex_invalidno*$sms_length;

 	 $_sender = $sender;
	//sender names
	if($this->_userType == 1 && $this->_dndCheck != 1){
		//loop Transactional SMPP
		//$sender_name = "LM-" . $sender;
		$sender_name = $sender;
		$portType = "LT1";

		//sinfini transactional
		//  $sender_name = $sender;  
		//$portType = "ST1";
	} elseif($this->_userType == 0){
		//loop Promo SMPP
		$sender = "0". rand(16066,16075);
		//$sender_name = "LM-" . $sender;
		$sender_name = $sender;
		$portType = "LP1";

		//sinfini promo
		// $sender_name = $sender;
		//$portType = "SP1";
	} elseif($this->_userType == 2){ 
		//vfirst transactional
		$sender_name = $sender;
		$portType = "VT1";

	}elseif($this->_userType == 1 && $this->_dndCheck == 1){
		//vfirst transactional
		$sender_name = $sender;
		$portType = "LS1";

	}
	 

	$this->load->model('Campaign_model');
	$sms_port = 0;
	//get port number based on port type
	$sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	//This is added for the purpose of trans scrub users on 23/08/2014

	/*if($this->_userType == 1 && $this->_dndCheck == 1){
		$sms_port='48113';
	}
	if($this->_userId==3361)
	{
		$sms_port ="23013";
	}
	if($this->_userId==1395)
	{
		$sms_port ="35013";
	}
	if($this->_userId==1392)
	{
		$sms_port ="22013";
	}
	if($this->_userId==3783)//water borad user
	{
		$sms_port ="28013";
	}
	if($this->_userId==1393)
	{
		$sms_port ="58013";
	}
	if($this->_userId==3837)
	{
		$sms_port ="33013";

	}
	if($this->_userId==4036)
	{
		$sms_port ="19013";

	}

		 */
		

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
 
  $shortInput = '';$getsendShorturl = '';
	if($campaign_id) {  
		//deducting credits
		$this->Campaign_model->deductSMSCredits($this->_userId, $total_numbers_ex_invalidno); 

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
						
						$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

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
 						$shortInput = $this->Campaign_model->getShortcodeInput($short_code);
 }
						if($shortInput) {
							$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
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
			 
			for($i=0; $i < $offset; $i++)
			{
                

				$mobile_no = trim($to_mobileno[$i]);  

 
					if($shorturl_input != NULL)
					{
						
						$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

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
 						$shortInput = $this->Campaign_model->getShortcodeInput($short_code);
 }
						if($shortInput) {
							$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
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
					 
					//check is block listed number?
					//check is duplicate number? changed on 05/01/2015
					$is_duplicate=$this->campaign_model->checkduplicate($this->_userId,$sms_text,$sender,$mobile_no);
					//$is_duplicate=$this->campaign_model->checkduplicate($username,$sms_text,$sender,$mobile_no);
					$is_block_listed = $this->Campaign_model->isBlockListed($mobile_no); 


					if($this->_International!=1){
						$is_invalid_no = $this->Campaign_model->isValidNo($mobile_no);
					}else{
						$is_invalid_no = $this->Campaign_model->IsCountry($mobile_no,$this->_AllowedCountry);
						if(isset($CountryRoute[substr($mobile_no, 0, 4)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 4)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 3)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 3)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 2)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 2)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 1)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 1)];
						else $sms_port = "32013";  //Default Port
					}
 

					if($is_block_listed){
					
						  $error_text = "Block Listed Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,2, $error_text);
					}elseif($is_invalid_no){


						  $error_text = "Invalid Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,16, $error_text);

					}elseif($is_duplicate){
						  $error_text = "Duplicate Msg";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port, 16, $error_text);
					} else {
 
 
						
						if(!$this->_userType){
	 

							 
							//check for dnd number  
							$isDND = $this->Campaign_model->checkIsDND($mobile_no);
							 if($isDND)
							 {
								   $error_text = "DND Number";	
								 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext,  $sms_port,3,$error_text );
							 } else {
	

								if($this->_International==1)
								{
									   $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name)."&to=$mobile_no&text=".urlencode($smstext); 

								}
								else{
 

									   $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=91$mobile_no&text=".urlencode($smstext);
								}
							  $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/crmdlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=crmdlr.php");
								 http_send($URL, $sms_port); 

								 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,$dlr = null, $error_text= null);  
							}
						
						
							 
						
						} else {  
							 
 
							if($this->_dndCheck)
							{
								$isDND = $this->Campaign_model->checkIsDND($mobile_no);
								if($isDND)
								{
									$error_text = "DND Number";	
									$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, 3,$error_text );
								}else
								{
									if($this->_International==1)
									{
									 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=$mobile_no&text=".urlencode($smstext); 
									}else{

										 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=91$mobile_no&text=".urlencode($smstext); 
									}
								  $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/crmdlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=crmdlr.php");
								  http_send($URL, $sms_port); 
									$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
								}

							}else
							{

								if($this->_International==1)
								{
								 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=$mobile_no&text=".urlencode($smstext); 
								}else{


								  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=91$mobile_no&text=".urlencode($smstext); 
								}
								  $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/crmdlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=crmdlr.php"); 
								 http_send($URL, $sms_port);
								//echo $URL; 
							
	 
								$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
							}  

						}  

				}
                    
                	} 
 
 
 

              		if($total_numbers > $priority_sms_count)
			{
				for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
					$mobile_no = trim($to_mobileno[$i]);
 
					if($shorturl_input != NULL)
					{
						
						$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

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
 						$shortInput = $this->Campaign_model->getShortcodeInput($short_code);
 }
						if($shortInput) {
							$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
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
              
                                 $this->Campaign_model->updateCampaignShortUrl($campaign_id,$shortInput,$getsendShorturl,$smstext);
            return true; 
        }//end of camapign id 
        
    }

	
	/** ADDED ON 2017-02-23, saisandeepthi. **/
		
	/*  with working 4 short urls, 2017_03_5
	private function _sendNormalSMSShortUrl($sms_text, $sender, $to_mobileno, $sms_type, $is_schedule, $scheduled_date,$campaign_name,$shorturl_input,$shorturl_text)
   {
       
 
	//  date_default_timezone_set("Asia/Calcutta"); 
	//Country code and route port configuration  
	$CountryRoute = array("971" => "34013","91" => "34013","972" => "34013","971" => "34013","968" => "34013","966" => "34013","974" => "34013","90" => "34013","973" => "34013","962" => "34013","965" => "34013","60" => "34013","95" => "34013","63" => "34013","65" => "34013","84" => "34013","62" => "34013");

  
	// calculate SMS length
	$sms_text1 = strtolower($sms_text);
	//remove special characters 
	//changed on 4thmay2015 by bharath for characters count.
	$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

	$sms_text_spl = str_replace($special_char, ' ', $sms_text1);



	$special_char_2 = array('{','}','[',']','^','|');
	$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);

	if(strlen($sms_text_spl2)>160)
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
	else
		$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);

	$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request	
	//$sms_length = ceil(strlen($sms_text)/160);
	$to_mobileno = array_unique($to_mobileno); 
					$to_mobileno = array_values($to_mobileno);

	$total_numbers_ex_invalidno=0;
	//$mobile_no = trim($to_mobileno[$i]);
	$this->load->model('campaign_model');
		 $to_mobileno =  array_values($to_mobileno); 
	$validNosArray = $this->campaign_model->Validnumbers($to_mobileno);
	$validNosArray = array_filter($validNosArray);
	if($this->_International==1)
	{
		$validNosArray = $to_mobileno;
		$validNosArray = $this->campaign_model->checkCountry($to_mobileno,$this->_AllowedCountry);
	}
  
 	  	$to_mobileno = $validNosArray;
	
	//print_r($validNosArray);
	$validNosCount=count($validNosArray);  
	//echo $validNosCount;
	$total_numbers = count($to_mobileno);
	//$is_duplicate=$this->campaign_model->checkduplicate($this->_userId,$sms_text,$sender,$mobile_no);
	//duplicate

	$invalidNosCount=$total_numbers-$validNosCount;
	$duplicatecount = $this->campaign_model->duplicate($this->_userId,$sms_text,$sender,$validNosArray); 
	//duplicate	
        $total_numbers_ex_invalidno=$total_numbers-($invalidNosCount+$duplicatecount);		
        //$total_numbers_ex_invalidno=$total_numbers-$invalidNosCount;
        $total_no_of_sms = $total_numbers * $sms_length;
	$total_numbers_ex_invalidno = $total_numbers_ex_invalidno*$sms_length;

 
	 $_sender = $sender;
	//sender names
	if($this->_userType == 1){
		//loop Transactional SMPP
		//$sender_name = "LM-" . $sender;
		$sender_name = $sender;
		$portType = "LT1";

		//sinfini transactional
		//  $sender_name = $sender;
		//$portType = "ST1";
	} elseif($this->_userType == 0){
		//loop Promo SMPP
		$sender = "0". rand(16066,16075);
		//$sender_name = "LM-" . $sender;
		$sender_name = $sender;
		$portType = "LP1";

		//sinfini promo
		// $sender_name = $sender;
		//$portType = "SP1";
	} elseif($this->_userType == 2){ 
		//vfirst transactional
		$sender_name = $sender;
		$portType = "VT1";

	}

	$this->load->model('Campaign_model');

	//get port number based on port type
	$sms_port = $this->Campaign_model->getFirstPriorityPort($portType);
	//This is added for the purpose of trans scrub users on 23/08/2014

	if($this->_userType == 1 && $this->_dndCheck == 1){
		$sms_port='48113';
	}
	if($this->_userId==3361)
	{
		$sms_port ="23013";
	}
	if($this->_userId==1395)
	{
		$sms_port ="35013";
	}
	if($this->_userId==1392)
	{
		$sms_port ="22013";
	}
	if($this->_userId==3783)//water borad user
	{
		$sms_port ="28013";
	}
	if($this->_userId==1393)
	{
		$sms_port ="58013";
	}
	if($this->_userId==3837)
	{
		$sms_port ="33013";

	}
	if($this->_userId==4036)
	{
		$sms_port ="19013";

	}

		
		

	//create campaign
	//ADDED ON 2017-01-23
	
	       $shorturl = '';$shorttext ='';
		if($shorturl_input[0] != NULL) {
			$shorturl = $shorturl_input[0];
			$shorttext = $shorturl_text[0];
		}else if($shorturl_input[1] != NULL) {
			$shorturl = $shorturl_input[1];
			$shorttext = $shorturl_text[1];  
		}else if($shorturl_input[2] != NULL) {
			$shorturl = $shorturl_input[2];  
			$shorttext = $shorturl_text[2];
		}else if($shorturl_input[3] != NULL) {
			$shorturl = $shorturl_input[3];
			$shorttext = $shorturl_text[3];
		}   
 
	  $campaign_id = $this->Campaign_model->createShortUrlCampaign($this->_userId,$sms_type,$sms_text,$sender,$_sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$shorttext,$shorturl,$total_numbers);
 

	if($campaign_id) {  
		//deducting credits
		$this->Campaign_model->deductSMSCredits($this->_userId, $total_numbers_ex_invalidno); 

		//ADDED ON 2017-01-23
		 $configFile = $this->config->item('configFile');
		$functionsFile = $this->config->item('functionsFile');
            	 include($configFile);
	  	 include($functionsFile);
		
		$created_on=date("Y-m-d H:i:s");
		//if campaign is scheduled
	$sendShorturl = ''; $smstext = $sms_text;$sendShorturl = '';$newShortText = '';$newShortInput = '';
 $filter = $shorturl_input;
		 $filter = array_filter($filter);
		if($is_schedule) {
			//$dataV[]=null;  

			for($i=0; $i<count($to_mobileno); $i++) 
			{
				$mobile_no = trim($to_mobileno[$i]);
if(count($filter) > 0) {
					if($shorturl_input != NULL)
					{
						if($newShortText == '') {
							$shorturl_text = $shorturl_text;
						}else{
							$shorturl_text = $newShortText;
							$shorturl_input = $newShortInput;
						}
	 					$shorturlResponse = $this->getShortCode($campaign_id,$shorturl_input,$shorturl_text);
						$smstext = $shorturlResponse['smstext'];
						$sendShorturl = $shorturlResponse['sendShorturl'];
						$newShortText = $shorturlResponse['newShortText'];
						$newShortInput = $shorturlResponse['newShortInput']; 
					}
					if($smstext == NULL) {
						$smstext = $sms_text;
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
			 
			for($i=0; $i < $offset; $i++)
			{
                

				$mobile_no = trim($to_mobileno[$i]);  

				 if(count($filter) > 0) {
					if($shorturl_input != NULL)
					{
						if($newShortText == '') {
							$shorturl_text = $shorturl_text;
						}else{
							$shorturl_text = $newShortText;
							$shorturl_input = $newShortInput;
						}
	 					$shorturlResponse = $this->getShortCode($campaign_id,$shorturl_input,$shorturl_text);
						$smstext = $shorturlResponse['smstext'];
						$sendShorturl = $shorturlResponse['sendShorturl'];
						$newShortText = $shorturlResponse['newShortText'];
						$newShortInput = $shorturlResponse['newShortInput']; 
					}
					if($smstext == NULL) {
						$smstext = $sms_text;
					}
				}

					//check is block listed number?
					//check is duplicate number? changed on 05/01/2015
					$is_duplicate=$this->campaign_model->checkduplicate($this->_userId,$sms_text,$sender,$mobile_no);
					//$is_duplicate=$this->campaign_model->checkduplicate($username,$sms_text,$sender,$mobile_no);
					$is_block_listed = $this->Campaign_model->isBlockListed($mobile_no); 


					if($this->_International!=1){
						$is_invalid_no = $this->Campaign_model->isValidNo($mobile_no);
					}else{
						$is_invalid_no = $this->Campaign_model->IsCountry($mobile_no,$this->_AllowedCountry);
						if(isset($CountryRoute[substr($mobile_no, 0, 4)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 4)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 3)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 3)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 2)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 2)];
						elseif(isset($CountryRoute[substr($mobile_no, 0, 1)])) $sms_port = $CountryRoute[substr($mobile_no, 0, 1)];
						else $sms_port = "32013";  //Default Port
					}
 

					if($is_block_listed){
					
						  $error_text = "Block Listed Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,2, $error_text);
					}elseif($is_invalid_no){


						  $error_text = "Invalid Number";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,16, $error_text);

					}elseif($is_duplicate){
						  $error_text = "Duplicate Msg";
						$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port, 16, $error_text);
					} else {
 
 
						
						if(!$this->_userType){
	 

							 
							//check for dnd number  
							$isDND = $this->Campaign_model->checkIsDND($mobile_no);
							 if($isDND)
							 {
								   $error_text = "DND Number";	
								 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext,  $sms_port,3,$error_text );
							 } else {
	

								if($this->_International==1)
								{
									   $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name)."&to=$mobile_no&text=".urlencode($smstext); 

								}
								else{
 

									   $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=91$mobile_no&text=".urlencode($smstext);
								}
							  $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/crmdlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=crmdlr.php");
								 http_send($URL, $sms_port); 

								 $this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port,$dlr = null, $error_text= null);  
							}
						
						
							 
						
						} else {  
							 
 
							if($this->_dndCheck)
							{
								$isDND = $this->Campaign_model->checkIsDND($mobile_no);
								if($isDND)
								{
									$error_text = "DND Number";	
									$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, 3,$error_text );
								}else
								{
									if($this->_International==1)
									{
									 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=$mobile_no&text=".urlencode($smstext); 
									}else{

										 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=91$mobile_no&text=".urlencode($smstext); 
									}
								  $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/crmdlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=crmdlr.php");
								  http_send($URL, $sms_port); 
									$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
								}

							}else
							{

								if($this->_International==1)
								{
								 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=$mobile_no&text=".urlencode($smstext); 
								}else{


								  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name) ."&to=91$mobile_no&text=".urlencode($smstext); 
								}
								  $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/crmdlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=crmdlr.php"); 
								 http_send($URL, $sms_port);
								//echo $URL; 
							
	 
								$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext, $sms_port, $dlr = null, $error_text= null);
							}  

						}  

				}
                    
                	} 
 
 
 

              		if($total_numbers > $priority_sms_count)
			{
				for($i = $priority_sms_count; $i < count($to_mobileno); $i++) {
					$mobile_no = trim($to_mobileno[$i]);
 if(count($filter) > 0) {
					if($shorturl_input != NULL)
					{
						if($newShortText == '') {
							$shorturl_text = $shorturl_text;
						}else{
							$shorturl_text = $newShortText;  
							$shorturl_input = $newShortInput;
						}
	 					$shorturlResponse = $this->getShortCode($campaign_id,$shorturl_input,$shorturl_text);
						$smstext = $shorturlResponse['smstext'];
						$sendShorturl = $shorturlResponse['sendShorturl'];
						$newShortText = $shorturlResponse['newShortText'];
						$newShortInput = $shorturlResponse['newShortInput']; 
					}
					if($smstext == NULL) {
						$smstext = $sms_text;
					}
}

					$values = array(
						'campaign_id' => $campaign_id,
						'sms_text' => $smstext,
						'to_mobile_no' => $mobile_no,
						'created_on' => $created_on
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
              
   
            return true;
        }//end of camapign id 
        
    } */

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
				/*	$fields = array(
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
					//echo $result1;*/
										$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

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

	
	
}

?>
