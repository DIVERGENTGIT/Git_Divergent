<?php
/**** @author Rushyendra ****/
class Customized extends CI_Controller
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
 		if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
		ini_set("display_errors","on");
		$this->load->model(array('Campaign_model','User_model',"customized_model"));
		$this->_index_pg = "";
		//$this->load->model(array('Campaign_model'));
		//$old_error_handler = set_error_handler("error_handlers");
              // register_shutdown_function("fatal_error_handlers");
		//$this->load->library("benchmark");
		$this->load->helper(array("custom","url"));
		//redirect_login($this->session->userdata('user_id'));	
		/*if(!$this->session->userdata('user_id')) {            
        	redirect('login');
        }*/
        
        //user details from session
        $this->_userId = $this->session->userdata('user_id');
	$this->_Total_Cnt = 100;	
        //$this->load->model('User_model');
        $userInfo = $this->User_model->getUserDetails($this->_userId);
	//$this->_data['profile']  = $this->User_model->get_user_verfiy($userid);
        $this->_credits = $userInfo[0]->available_credits;
$this->_data['shorturlCredits'] =  $userInfo[0]->shorturl_credits;
        $this->_userType = $userInfo[0]->no_ndnc;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
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
	/**
	*Display the customized SMS
	*@name index
	*@author Rushyendra
	*/
	
	
public function newVariableSMS()
{

if($this->_userId==4330 || $this->_userId==4022 || $this->session->userdata('user_id')==4456 || $this->session->userdata('user_id')==4410 || $this->session->userdata('user_id')==2917)
{

$ViewTemplete="";$original_file = "";
$file_type = "";$Filepath="";$offset = 0;

if($this->input->post('sendsms')=='Send') 
      {        
       
    
	
	try
	{


		$this->_data['validatationtrue'] ="1";
                //input variables
    		$campaign_name = $this->input->post('campaign_name');
		$sender = $this->input->post('sender');
                $sms_text = $this->input->post('sms_text');
                $is_schedule = $this->input->post('schedule');
                $scheduled_date = $this->input->post('on_date');
                $sms_type = $this->input->post('sms_type');
                 $file_type = $this->input->post('file_type');
		$original_file = $this->input->post('file_name');
		$Filepath=$original_file;

                //sms type - normal/ Flash SMS
                $mclass = "";
                if($sms_type==1) {
                    $mclass = "&mclass=0";
                }

                $error = false;
                $error_msg = "";
                if($is_schedule) {
                    if(!$scheduled_date){
                        $error = true;
                        $error_msg .= "Please enter schedule date";
                    }
                }

              

                if($error) {
                    $this->_data['error'] = $error_msg;
                    $ViewTemplete="Y";//if fails
                } else {
                
            
		$mobile_no_column = $this->input->post('mobile_column');
                            	
                        if($this->_userType == 1){ //Transactional SMPP
                         
			$sender_name =  $sender;
                            $portType = "LT1";
                           
                        } elseif($this->_userType == 0){ //Promo SMPP

                          
                            $portType = "LP1";
                            $sender_name = $sender;
                            //$portType = "SP1";
                        } elseif($this->_userType == 2){ //solutions infini transactional
                            $portType = "ST1";
                            $sender_name = $sender;
                        }
 if($this->_userType == 1 && $this->_dndCheck == 1){

			$sender_name = $sender;
			$portType = "LS1";
		}

                        $this->load->model('Campaign_model');
			$sms_port=47213;
		   $sms_type = 4;
                      
   $campaign_id = $this->Campaign_model->createCampaign($this->_userId,$sms_type,$sms_text,$sender,$total_no_of_sms=0,
   $is_schedule,$scheduled_date,$sms_port,$campaign_name);
                        
                        if($campaign_id) {
                           $largecampaignactivity_id = $this->Campaign_model->createLargeCampaignActivity_New($this->_userId,
                           $campaign_id,$original_file,$total_no_of_sms=0,$this->input->post('mobile_column'),
                           $sms_text,$is_schedule,$from_row=0,$to_row=0);
                           redirect("customized/viewcampaigns");
                           
                       }
                      
                       
                  
                }
           

                $sender = array();
                if($this->_userType){

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
                $this->_data['file_name'] = $original_file;
                $this->_data['file_type'] = $file_type;

                
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}
	
        
       }
       if($this->input->post('file_upload')) 
       {
       
            $this->load->library('form_validation');
            $config['upload_path'] = 'uploads/';
            $file_name = uniqid('vs_');
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'xls|xlsx';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload()) {
                $file = $this->upload->data();
                $file_type = $file['file_ext'];
                $file_name = 'uploads/'.$file_name;
                $header_array =array();
                $uploded_data = array();
                if($file_type == ".xls") {
                    require('/var/www/vhosts/www.smsstriker.com/htdocs/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
			require('/var/www/vhosts/www.smsstriker.com/htdocs/spreadsheet-reader-master/SpreadsheetReader.php');

                } else if($file_type == '.xlsx') {
                    require('/var/www/vhosts/www.smsstriker.com/htdocs/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
			require('/var/www/vhosts/www.smsstriker.com/htdocs/spreadsheet-reader-master/SpreadsheetReader.php');
                }

                $original_file = $file_name.$file_type;
		$Filepath=$original_file;
	        $ViewTemplete="Y";
		        
		date_default_timezone_set('UTC');
		$StartMem = memory_get_usage();    
		}
		else {$this->_data['error'] = $this->upload->display_errors('','');}      
       }	
        
       if($ViewTemplete=="Y") 
       {

	try
	{
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$BaseMem = memory_get_usage();
		$Sheets = $Spreadsheet -> Sheets();
		
	
		
		//print_r($Sheets);
		$i=0;
		$string ="";
		$maxrows=0;$maxcols=0;

		$string = '<table class="table table-bordered table-striped  no-footer" width="100%" style=" border: 1px solid #E5E5E5;" cellpadding=0 cellspacing=0>';
		foreach ($Sheets as $Index => $Name)
		{
		$Spreadsheet -> ChangeSheet($Index);
$r=0;
foreach ($Spreadsheet as $Key => $Row)
			{
			
			
			$maxrows++;$i++;
		   if($i == 1){$string .= '<thead>';}
				$string .= "<tr>" ;
			for($j = 0; $j < sizeof($Row); $j++) 
			   { 
				if($maxrows<=5)
				{
				if($i == 1)	
					{
					$maxcols=sizeof($Row);
					$columns = array('' => '--select--');
			                for($k = 0; $k < $maxcols; $k++)
			                	{
				                    $columnValue = $k;
				                    $columns[$columnValue] = ($columnValue+1) . '-'. $Row[$k];
				                }
				        $string .= '<th class="sendee-color" style=" font-weight:200 !important;">'.$Row[$j].'</th>';
				        //$string .= '<th style="border: 1px solid #E5E5E5;">'.$Row[$j].'</th>';
					}
				 else {$string .= '<td style="border: 1px solid #E5E5E5;">'.$Row[$j].'</td>';}
				 $uploded_data[$i-1][$j] = $Row[$j];
				 }

			      //$uploded_data[$i-1][$j] = $Row[$j];
                           }
		if($i == 1){$string .='</thead>';}
		 $string .= '</tr>';


  $r++;
if($r>5) {


                unset($Spreadsheet); 
           $sender = array();
                if($this->_userType){
                    $this->load->model('Campaign_model');
                   $this->load->model('user_model');
            	$senderNames = $this->user_model-> getSenderNames_accept($this->_userId);
                $sender[''] = '--select--';
                    foreach($senderNames as $rs){
                        $sender[$rs->sender_name] = $rs->sender_name;
                    }
                } else {
                    $sender['Promo'] = 'Promo';
                }

	 $max_rows=$maxrows;
	$this->_data['columns'] = $columns;
	 $string .= '</table>';


                break;
}
             		}

                break;
                }
                

                              
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}

  	}
 	else {
              #  $this->_data['error'] = $this->upload->display_errors('','');
        } 
 		unset($Spreadsheet); 
           $sender = array();
                if($this->_userType){
                    $this->load->model('Campaign_model');
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
                $this->_data['file_name'] = $original_file;
                $this->_data['file_type'] = $file_type;
        	 $this->_data['uploaded_data'] = @$string;
        	$this->_data['page_title'] = "Variable SMS";

    		
       
        
        
}else
{
	
echo "Normal Process";


}
 	$this->load->view('includes/header',$this->_data);
	$this->load->view('/includes/leftmenu');
        $this->load->view('campaign/new_variable_sms_custom',$this->_data);
        $this->load->view('/includes/footer'); 
 
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
		
		$limit =5;
		
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
		//print_r($campaigns_report);

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

		$this->load->view('campaign/campaign_searchtest_custom',$this->_data);
		$this->load->view('/includes/footer');	
	
	}
	
public function viewcampaigns()
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
			 $limit =1;
		
			if(!empty($from_date)&&!empty($to_date))
		{
$campaigns_report = $this->Campaign_model->get_campaigns_report($this->_userId,$from_date,$to_date);

			
$campaigns_data = $this->Campaign_model->getAllCampaigns1($this->_userId,$sender_name,$from_date,$to_date,$off_set,$limit);

$total_campaigns = $this->Campaign_model->get_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date,$to_date);

		}else{
			$campaigns_report = $this->Campaign_model->get_campaigns_report_default($this->_userId);

			$total_campaigns = $this->Campaign_model->get_campaigns_count1($this->_userId,$sender_name,$status_=null,$from_date=null,$to_date=null);
			

$campaigns_data = $this->Campaign_model->getAllCampaigns1($this->_userId,$sender_name,$from_date=null,$to_date=null,$off_set,$limit);

			
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
		$config['base_url'] = site_url().'/customized/viewcampaigns';

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
		$this->load->view('campaign/reports_customized',$this->_data);
		$this->load->view('/includes/footer');
	}

	public function index()
	{
	        $this->_data['page_title'] = "Variable SMS";
		 if($this->input->post('file_upload')) {
            		$this->load->library('form_validation');
            		$config['upload_path'] = 'uploads/';
            		$file_name = uniqid('vs_');
            		$config['file_name'] = $file_name;
           		$config['allowed_types'] = 'xls|xlsx';
	                $config['overwrite'] = true;
			disp_error_log( "*******************************");  /*** Added By Rushyendra for display the error log ***/
			$start_time_dur = date("Y-m-d H:i:s.u");
                	$this->benchmark->mark('code_start');
                	disp_error_log( "File Upload in Customised SMS is started time  ".$start_time_dur);	
            		$this->load->library('upload', $config);
                                         
            		if ($this->upload->do_upload()) {
                		$file = $this->upload->data();
                		$file_type = $file['file_ext'];
				$file_name = 'uploads/'.$file['file_name'];
				$original_file = $file['raw_name'].".csv";
	        		chmod($file_name,0777);  
                		$header_array =array();
                		$uploded_data = array();
                  		/*** Convert into CSV file ****/
                		$dest_file_name = "uploads/".$original_file; /*** Added by Rushyendra ****/
				$file_path = FILEPATH; 
                 		if($file_type == ".xls")
				{
					$str = "HOME=/var/www/vhosts/www.smsstriker.com/htdocs/uploads /usr/bin/unoconv -f csv ".$file_path. $file_name."   2>&1" ;
					list($this->_data['error'],$no_bal,$disp_table_mobiles, $max_rows,$maxcols,$columns) = $this->perform_cust_xls_fun($str,$file_path,$dest_file_name);

				}
                		else if( $file_type == ".xlsx")
				{
					$str = "/usr/bin/xlsx2csv.py ".$file_path. 
			                  $file_name."  >  ".$file_path.$dest_file_name."   2>&1 ";
					$str = "HOME=/var/www/vhosts/www.smsstriker.com/htdocs/uploads /usr/bin/unoconv -f csv ".$file_path. $file_name."   2>&1" ;
					list($this->_data['error'],$no_bal,$disp_table_mobiles, $max_rows,$maxcols,$columns) = $this->perform_cust_xls_fun($str,$file_path,$dest_file_name);
			 
                                                      
				}
	         		if($no_bal != "")
					$this->_data['error'] = $no_bal;
				else if($this->_data['error'] == "")
	          		{	
		
					$sender = array();
					/**** Get the Sender Details ****/	
                			if($this->_userType){
                    				$senderNames = $this->customized_model->getSenderNames($this->_userId);
                    				$sender[''] = '--select--';
						if(count($senderNames)>0 ){	
                    					foreach($senderNames as $rs){
                        					$sender[$rs->sender_name] = $rs->sender_name;
                    				} }
                			}else {
                    				$sender['Promo'] = 'Promo';
                			}
                        		/******              ****/
					$this->session->set_userdata("sendTemp", array("columns" => $columns, 
					"sender_names" => $sender, "file_name" => $original_file,
                                        "file_type" => $file_type, "maxcols" => $maxcols,
                                         "max_rows" => $max_rows, "uploaded_data" => $disp_table_mobiles));
					$this->_data['columns'] = $columns;
					$this->_data['sender_names'] = $sender;
                			$this->_data['file_name'] = $original_file;
                			$this->_data['file_type'] = $file_type;
                			$this->_data['maxcols'] = $maxcols;
                			$this->_data['max_rows'] = $max_rows;
                			$this->_data['uploaded_data'] = $disp_table_mobiles;		
				}
				} else {
                			$this->_data['error'] = $this->upload->display_errors('','');
			 }
        } else if($this->input->post('sendsms')) {
		
		$start_time_dur = date("Y-m-d H:i:s.u");
                $this->benchmark->mark('code_starts');
                disp_error_log( "File Serve  in Customised SMS is started time  ".$start_time_dur);
            	$file_type = $this->input->post('file_type');
            	$original_file = $this->input->post('file_name');
           	 $this->load->library('form_validation');
	    	$this->_data['error'] = '';	

	    
            	if ($this->form_validation->run('variable_sms_form') == TRUE) {
                	//input variables
    			$campaign_name = $this->input->post('campaign_name'); 
			$sender = $this->input->post('sender');
                	$sms_text = $this->input->post('sms_text');
                	$from_row = $this->input->post('from_row');
                	$to_row = $this->input->post('to_row');
                	$is_schedule = $this->input->post('schedule');
                	$scheduled_date = $this->input->post('on_date');
               		$sms_type = $this->input->post('sms_type');
			$total_rows = $this->input->post("total_count");
                	$mobile_coulmn = $this->input->post("mobile_column");    
                
			//sms type - normal/ Flash SMS
                	$mclass = "";
                	if($sms_type==1) {
                    		$mclass = "&mclass=0";
                	}
		
                $error = false;
                $error_msg = "";
                if($is_schedule) {
                    if(!$scheduled_date){
                        $error = true;
                        $error_msg .= "Please enter schedule date";
                    }
                } //else $scheduled_date = 0000-00-00 00:00:00;

                //if client type is transactional, check for template if not dynamic
                if($this->_userType == 1 && $this->_template_check){
                    //check for templates
                    $temp_check = $this->_templateCheck($sms_text);
                    if(!$temp_check){
                        $error = true;
                        $error_msg .= "SMS Text not matching with Approved Templates";
                    }
                }

                if($error) {
                    $this->_data['error'] = $error_msg; 
		   $get_send_array  = $this->session->userdata("sendTemp");

	if(is_array($get_send_array)){	
		
		 $this->_data['columns'] = (isset($get_send_array['columns']))?$get_send_array['columns']: "";
		$this->_data['sender_names'] = (isset($get_send_array['sender_names']))?$get_send_array['sender_names']:"";
                $this->_data['file_name'] = (isset($get_send_array['file_name']))?$get_send_array['file_name']: "";
                $this->_data['file_type'] = (isset($get_send_array['file_type']))?$get_send_array['file_type']:"";
                $this->_data['maxcols'] = (isset($get_send_array['maxcols']))?$get_send_array['maxcols']:"";
                $this->_data['max_rows'] = (isset($get_send_array['max_rows']))?$get_send_array['max_rows']: "";
                $this->_data['uploaded_data'] = (isset($get_send_array['uploaded_data']))?$get_send_array['uploaded_data']:"";		
	}	
			//$this->_data['error_temp'] = $error_msg;
                }else{
                      // "actual operation performed"
			$file_path = FILEPATH;
			$file_name = $file_path."uploads/".$original_file;	
		
			@chmod($file_name,0777);
			$new_file =  "uploads/abc_2".rand().".csv"; 
			$remove_portion = "sed -n ".$from_row.",".$to_row."p ".$file_name." > ".$file_path.$new_file."; mv  ".$file_path.$new_file. " ".$file_name;
		 $each_rest = shell_exec($remove_portion);
		if($each_rest != "")
			$this->_data['error']  = $each_rest;
                   else{
			$total_rows =  shell_exec(" wc -l < ".$file_name);
			$dlr_mask = 31;
			$dlr_url = "http%3A%2F%2F147.120.203.99%2Fsms%2Fdlr.php%3Fdlr%3D%25d%26dest%3D%25p%26report%3D%25A";
			$smsc_id = 'vfirst_home';
			$momt = 'MT';
			if($total_rows > $this->_Total_Cnt) 
			//if($total_rows >0)
			{
				//Perform actual operation
				$insert_array = array("msg"=>$sms_text, "sender" =>$sender,
						      "sms_type" => $sms_type, 
						      "is_schedule" =>$is_schedule, 
						      "camp_id" => 0,
						      "name" =>$campaign_name,
						      "from_row" => $from_row,
						      "to_row" => $to_row,
                                                      "mobile_column" =>$mobile_coulmn,	
                                                      "dlr_mask" => $dlr_mask,
							"dlr_url" => $dlr_url,  
							"smsc_id" => $smsc_id,
							"momt" => $momt,
							"mclass" => $mclass,	
						     "user_id" => $this->_userId);
                                if($is_schedule)                
					$insert_array["sch_date"] = $scheduled_date; 
				list($info_array,$jobs_array,$load_100_time,$this->_data['error']) = $this->customized_model->load_data_cust($file_name,$insert_array,$this->_credits,1);
                                    	

				if($this->_data['error'] == "")
                                 {
					//Perform the operation";
					$this->send100_to_camp_cust($info_array,$jobs_array,$total_rows);	

				//if(isset($jobs_array['camp_id']))
				//$this->Campaign_model->update_campaign_status($jobs_array['camp_id'],1);			
				 }
				
				
			}
			else {
				//perform 100 records to old process
				$file_path = FILEPATH;
				$this->benchmark->mark('mobile-100-start');
                                $content = shell_exec(" cat ".$file_path."uploads/".$original_file);
                                
                		$content_array = explode("\n",$content);
				if(count($content_array)> 0 )
				{
						
					list($mobile_array,$message_array,$total_no_of_sms,$highest_msg_len) = $this->cal_100_msg( $content_array, $sms_text,$mobile_coulmn);

					//Check the balance 
					if($total_no_of_sms > $this->_credits)
						$this->_data['error'] = "Insufficient SMS Credits. Require ".$total_no_of_sms." credits";
					if(isset($this->_data['error']) && $this->_data['error'] == "")
					{
						$sms_port = '0';
						/*** Create the Campaign ***/
						$camp_id = $this->customized_model->createCampaign($this->_userId,$sms_type,$sms_text,$sender,$total_no_of_sms,$is_schedule,$scheduled_date,$sms_port,$campaign_name,$highest_msg_len);
                                                
						/**** ****/
						$this->process_100_camp_cust($mobile_array, $message_array,$sms_type, $sender, $is_schedule, $scheduled_date,$campaign_name,$camp_id,$total_rows);
						$status = 2;
                                                if($is_schedule)
                                                       $status =1;
						$this->customized_model->update_campaign_status($camp_id,$status);
    
					}	
					
				}

                	
							
                          } //less than 100 else is closed
			
 			} //remove the portion else closed		
		$end_time_dur = date("Y-m-d H:i:s.u");
                $this->benchmark->mark('code_ends');
                disp_error_log( "File Serve  in Customised SMS is ending time  ".$end_time_dur);
	        disp_error_log("Total duration: ".$this->benchmark->elapsed_time('code_starts','code_ends'));	 
		disp_error_log("*************************************************");
			if(isset($this->_data['error']) && $this->_data['error'] == "")
			{
				redirect($this->_index_pg.'campaign/viewcampaigns');
			}
                 }  //actual operation is performed
                }// Form validations if closed
		else{
			$get_send_array  = $this->session->userdata("sendTemp");

	if(is_array($get_send_array)){	
		
		 $this->_data['columns'] = (isset($get_send_array['columns']))?$get_send_array['columns']: "";
		$this->_data['sender_names'] = (isset($get_send_array['sender_names']))?$get_send_array['sender_names']:"";
                $this->_data['file_name'] = (isset($get_send_array['file_name']))?$get_send_array['file_name']: "";
                $this->_data['file_type'] = (isset($get_send_array['file_type']))?$get_send_array['file_type']:"";
                $this->_data['maxcols'] = (isset($get_send_array['maxcols']))?$get_send_array['maxcols']:"";
                $this->_data['max_rows'] = (isset($get_send_array['max_rows']))?$get_send_array['max_rows']: "";
                $this->_data['uploaded_data'] = (isset($get_send_array['uploaded_data']))?$get_send_array['uploaded_data']:"";		
	}
		}
			
            }// send Sms Closed

//get added templates
	
	$campaigns_data = $this->customized_model->getCampaignsLast($this->_userId);
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
		redirect('customized/normalSMS');

	}
	
	if($this->input->post('addsubmit')){
		$template=$this->input->post('addtemp');
		$this->user_model->addTemplate($this->_userId,$template);
		redirect('customized/normalSMS');
	}
	if($this->uri->segment(3) == "del")
	{
		$template_id=$this->uri->segment(4);
		$this->user_model->delete_template($this->_userId, $template_id);
		redirect('customized/normalSMS');
	}
	
		
		
        $this->_data['page_title'] = "Variable SMS";
	$foot['js_array'] = array(base_url()."assets/js/custom.js");
	$foot['pageNo'] = 'customized-sms';
        $this->load->view('includes/header',$this->_data);
	$this->load->view('/includes/leftmenu');
        //$this->load->view('campaign/new_variable_sms_camp');
	 $this->load->view('customized/new_variable_sms');
        $this->load->view('customized/footer_cust',$foot);
	}
	/** Convert the xls/xlsx to CSV
	*@name perform_cust_xls_fun
	*@author Rushyendra
        */
	function perform_cust_xls_fun($str,$file_path,$dest_file_name)
	{
		$this->load->helper("custom");
		$no_bal = $error = $disp_table_mobiles = $max_rows= $maxcols= $columns= ''; $no_count = 0;
		try{
		
			$this->benchmark->mark('conv-start');
		        $output = shell_exec($str);
			$no_of_rows =  $output;
		 	$this->benchmark->mark('conv-end');
                	disp_error_log("Converted  into csv  generation time of ".$file_path.$dest_file_name.":".$this->benchmark->elapsed_time('conv-start','conv-end') );
		if($output != "")
                {
			$error = $output;
		} 
                else if(file_exists($file_path.$dest_file_name))
			list($no_bal, $disp_table_mobiles, $max_rows,$maxcols,$columns ) = $this->call_fun_camp_cust($dest_file_name,$file_path);   
			
            }catch(Exception $e){
		$error =  $e->getMessage();
	}

	return array($error, $no_bal,$disp_table_mobiles, $max_rows,$maxcols,$columns);
	
      }
     /**
     *Display the sms table format
     *@name call_fun_camp_cust
     *@author Rushyendra
*/
function call_fun_camp_cust($dest_file_name,$file_path)
{
	
        $result = '';
	$display_table_data = '';
	$no_of_cols =0; $columns =0;
	$this->benchmark->mark("count-start");
	$no_count =  shell_exec(" wc -l < ".$file_path.$dest_file_name);  
	$this->benchmark->mark("count-end");
	disp_error_log("Count the no of lines in converted CSV file:".$this->benchmark->elapsed_time('count-start','count-end') ); 	
	if($no_count == 0 )
		$result = "File is Empty"; 
	else{
		/** Display the 5 Records  first ***/
               $first_5_line = shell_exec("head -6 ".$file_path.$dest_file_name );
	       $first_5_line = trim($first_5_line);
	       $first_5_array =  array();
	       $first_line = '';
		if( $first_5_line != "")
			$first_5_array =  explode("\n",$first_5_line);
		if(isset($first_5_array[0]))
                	$first_line = $first_5_array[0];
			//unset($first_5_array[0]);
		
		 $len = count($first_5_array); 
		
		$first_5_array = array_values($first_5_array);
		
		$no_of_cols = '';
		$columns = array('' => '--select--');
                /**** Check the file is empty or not ***/ 
		if($len ==0)
                   $result = "File is Empty";
		else 
                   {
			/*** display the columns data **/
			$cols_array = explode(",",$first_line);
			 $no_of_cols = count($cols_array); 
			$thead_data = '';	
                        $i = 1;
			if($no_of_cols >15)
			   $result = "Columns list not more than 15";	
			else { if( $no_of_cols > 0){
				$thead_data = '<thead>';
                        	foreach($cols_array as $each)
				{
					$x = $i."-".$each;
					$y = $each;
				 	$columns[$i] = $x;
					if($y != "")
                                        $thead_data .= "<th>".$y."</th>"; 
					$i++;
				}  
				$thead_data .= '</thead>';
			}
                        /*** ****/
			/**** tbody ***/
			$tbody_data = '<tbody>'; $i =0;
			foreach($first_5_array as $each)
				{
					$cols_array = str_getcsv($each);
					if($i != 0 && count($cols_array) >0)
					
					{
						$tbody_data .= '<tr>';
						foreach($cols_array as $col_data){
							if($col_data != "")
							$tbody_data .= '<td>'.$col_data.'</td>';		 	
						}
						$tbody_data .= '</tr>';
					}	
					$i++;
					
				}
			$tbody_data .= '</tbody>';
			/**** ***/
			$display_table_data = '<table class="table table-bordered table-striped  no-footer" width="100%" style=" border: 1px solid #E5E5E5;" cellpadding=0 cellspacing=0>'.$thead_data.$tbody_data.'</table>'; 
                         
						
                   } }
		
			
        
	}

	return array($result,$display_table_data,$no_count,$no_of_cols,$columns);
                                                
}
 /**
 * Send the 100 campaigns in customized above 100 records	
 *@name send100_to_camp_cust
 *@author Rushyendra
 */ 
 function send100_to_camp_cust($info_array,$job_info,$total_mb_rows)
 {
	$CountryRoute = array("971" => "34013","91" => "34013","972" => "34013","971" => "34013","968" => "34013",
			"966" => "34013","974" => "34013","90" => "34013","973" => "34013","962" => "34013",
			"965" => "34013","60" => "34013","95" => "34013","63" => "34013","65" => "34013","84" => "34013","62" => "34013");
	  
	$this->benchmark->mark('recs-start');
		$sender = $job_info['sender'];
       /*** Available Port ***/
	
        if($this->_userType == 1){
            //loop Transactional SMPP
            
	    $sender_name = $sender;
            $portType = "LT1";
	   
        } elseif($this->_userType == 0){
            $sender_name = $sender;
            $portType = "LP1";
 	} elseif($this->_userType == 2){ 

		    $sender_name = $sender;
            $portType = "VT1";
            
        }

	if($this->_userType == 0 && $this->_dndCheck == 1){
		$sender_name = $sender;
		$portType = "LS1";
	}

	/*** Get the SMS Port ****/
	$sms_port = $this->customized_model->getFirstPriorityPort($portType);
	if($this->_userType == 1 && $this->_dndCheck == 1){
		$sms_port='31013';
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
		$sms_port ="24013";
	}
        if($this->_userId==3837)
	{
		$sms_port ="32013";

	}
	$camp_batch = array();
        $send_sms_pre_array = array();
	$dlr_mask = 31;
	$dlr_url = "http%3A%2F%2F147.120.203.99%2Fsms%2Fdlr.php%3Fdlr%3D%25d%26dest%3D%25p%26report%3D%25A";
	$smsc_id = 'vfirst_home';
	$momt = 'MT';
 
	$mclass = '';
	if($job_info['sms_type'] == 1) {
        	$mclass = "&mclass=0";
         }	
	/**** ****/
	 if(count($info_array)>0)
	 {
		foreach($info_array as $each)
		{
			$mobile = (isset($each['mobileNo']))?$each['mobileNo']: "";
                        $msg = (isset($each['actualMsg']))?$each['actualMsg']: "";
			$is_duplicate = $is_block_listed = 0;
			$is_invalid_no =1;
				if($mobile != "" && $mobile != 0 && is_array($job_info) &&   isset($job_info['sender']))
				{
					/***** International Phone check ****/
					if($this->_International!=1){
						$is_invalid_no = $this->customized_model->isValidNo($mobile);
					}else{
						$is_invalid_no = $this->campaign_model->IsCountry($mobile,$this->_AllowedCountry);
						if(isset($CountryRoute[substr($mobile, 0, 4)])) $sms_port = $CountryRoute[substr($mobile, 0, 4)];
						elseif(isset($CountryRoute[substr($mobile, 0, 3)])) $sms_port = $CountryRoute[substr($mobile, 0, 3)];
						elseif(isset($CountryRoute[substr($mobile, 0, 2)])) $sms_port = $CountryRoute[substr($mobile, 0, 2)];
						elseif(isset($CountryRoute[substr($mobile, 0, 1)])) $sms_port = $CountryRoute[substr($mobile, 0, 1)];
						else $sms_port = "32013";  //Default Port
					} /**** ***/
					/**** Check the Duplicate ***/
					//if(!$is_invalid_no){	
					//just comment for customized $is_duplicate = $this->Campaign_model->checkduplicate($job_info['user_id'],$msg,$job_info['sender'],trim($mobile));
					//just comment for customized sms $is_block_listed = $this->Campaign_model->isBlockListed($mobile);
//}
					$unique_msg_id = '';
					/**** Blocked List No ***/	
			      		$camp_single = array("campaign_id" => $job_info['camp_id'], 
				  "to_mobile_no" => $mobile,"sms_text" => $msg,
				//"unique_msg_id" => $unique_msg_id,
				"sent_on" => date('Y-m-d H:i:s'));	
					
					/**** Blocked List No ***/	
			      		/*if($is_block_listed){
	                        		
				$camp_single["dlr_status"] = 2;
				 $camp_single["error_text"] = "Block Listed Number";
                        			
                    			}else*/
					if($is_invalid_no){  /**** Invalid NO ***/
                      				
					$camp_single["dlr_status"] = 16;
				 	$camp_single["error_text"] = "Invalid Number";
             		                } /*elseif($is_duplicate){   /**** Duplicate ****/
						/*
						$camp_single["dlr_status"] = 16;
				 	$camp_single["error_text"] = "Duplicate Msg";
             		                 }*/
					 else{ 
						/*** Perform the Operation ***/
			 			if(!$this->_userType){ /*** If promotional ****/
							$isDND = $this->customized_model->checkIsDND($mobile);
								
                            				if($isDND)
							{ /**** DND Number ***/
								
							$camp_single["dlr_status"] = 3;
				 			$camp_single["error_text"] = "DND Number";
             		
                            				}else{
                                       			/******* Send the SMS for PROMO ****/
								$sender_name = "0". rand(16066,16075);
								$this->send_sms_pre($sender_name,$mobile,$msg,$mclass,$job_info['camp_id'],$sms_port);
								$send_sms_pre_array[]  = array("momt" => $momt,
							 "sender" => $sender_name , "receiver" => $mobile, "mid" => $unique_msg_id,
				  			"msgdata" => $msg , "sms_type" => $job_info["sms_type"] ,
							 "dlr_mask" => $dlr_mask , "dlr_url" => $dlr_url, "smsc_id" => $smsc_id, "mclass" => $mclass);
								
							$camp_single["dlr_status"] = '';
				 			$camp_single["error_text"] = "";
             		
                                			}   
						}else{  /*** if trns and Semi trans ***/
						$isDND = 0;
						/**** If Semi Trans check the DND Number ****/
						if($this->_dndCheck)
						{
							$isDND = $this->customized_model->checkIsDND($mobile);
							if($isDND)
							{ /**** If Is DND not send mail ****/
							
							$camp_single["dlr_status"] = 3;
				 			$camp_single["error_text"] = "DND Number";               	
             		
							}
						} /**** DND Check is CLosed ****/
			    			if(!$isDND){  
				     			/******* Send the SMS for Trans and Semi Trans ****/
							$this->send_sms_pre($sender_name,$mobile,$msg,$mclass,$job_info['camp_id'],$sms_port);
																					  
                                                        $send_sms_pre_array[]  = array("momt" => $momt,
							 "sender" => $sender_name , "receiver" => $mobile, "mid" => $unique_msg_id,
				  			"msgdata" => $msg , "sms_type" => $job_info["sms_type"] ,
							 "dlr_mask" => $dlr_mask , "dlr_url" => $dlr_url, "smsc_id" => $smsc_id, "mclass" => $mclass);
							$camp_single["dlr_status"] = 0;
				 			$camp_single["error_text"] = "";	
						}
					
					}
				} //Else Actual Perform  closed            
			$camp_batch[] = $camp_single;
			} //Mobile is not empty perform the operation
		} //mobile info for loop started
		$camp_cnt = count($camp_batch);
		if(count($send_sms_pre_array)>0)
			$this->customized_model->insert_kennel_send_sms($send_sms_pre_array,$this->_userType,$this->_dndCheck,1);		
		if($camp_cnt > 0 )
		$this->customized_model->insert_camps_cust($camp_batch, $job_info['job_id']);
		
	 } //mobile info is there count closed
	$status =1;
		if($total_mb_rows <= $this->_Total_Cnt)
			$status =2;
			 $this->customized_model->update_campaign_status($job_info['camp_id'],$status);	
	 $this->benchmark->mark('recs-end');
	disp_error_log("Serve 100 records duration: : ".$this->benchmark->elapsed_time('recs-start','recs-end'));	 
        }
	/**
	* process the below 100 campaigns
	*@name process_100_camp_cust
	*@author Rushyendra
	*/
	function process_100_camp_cust($mobile_array, $message_array,$sms_type, $sender, $is_schedule, $scheduled_date,$campaign_name,$camp_id,$total_nb_rows)
	{
		$CountryRoute = array("971" => "34013","91" => "34013","972" => "34013","971" => "34013","968" => "34013",
				"966" => "34013","974" => "34013","90" => "34013","973" => "34013","962" => "34013","965" => "34013",
				"60" => "34013","95" => "34013","63" => "34013","65" => "34013","84" => "34013","62" => "34013");
	  
		if(!$is_schedule)
		{	
       	 		/*** Available Port ***/
		
        		if($this->_userType == 1){
            		$sender_name = $sender;
            		$portType = "LT1";
	   
        		} elseif($this->_userType == 0){
            		$sender_name = $sender;
            		$portType = "LP1";

        		} elseif($this->_userType == 2){ 
		
		    	$sender_name = $sender;
            		$portType = "VT1";
            
        		}

			if($this->_userType == 0 && $this->_dndCheck == 1){
			$sender_name = $sender;
			$portType = "LS1";
			}
	
		/*** Get the SMS Port ****/
		$sms_port = $this->customized_model->getFirstPriorityPort($portType);
		if($this->_userType == 1 && $this->_dndCheck == 1){
			$sms_port='31013';
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
			$sms_port ="24013";
		}
        	if($this->_userId==3837)
		{
			$sms_port ="32013";

		}
	}	
	$camp_batch = array();
	$send_sms_pre_array = array();
	$dlr_mask = 31;
	$dlr_url = "http%3A%2F%2F147.120.203.99%2Fsms%2Fdlr.php%3Fdlr%3D%25d%26dest%3D%25p%26report%3D%25A";
	$smsc_id = 'vfirst_home';
	$momt = 'MT';
	$sch_camp_batch = array();
	$mclass = '';
	if($sms_type == 1) {
        	$mclass = "&mclass=0";
         }	
	/**** ****/
        $actual_no_msg = 0;
	/**** Move to campaign to ***/
		if(count($mobile_array)>0)
		{      
			$jt = 0;	
			foreach($mobile_array as $each)
			{
				$mobile = trim($each);
				$unique_msg_id = '';
                        $msg = (isset($message_array[$jt]))?trim($message_array[$jt]):"";
			$msg_len = strlen($msg);
			if($msg_len>160)
				$no_of_sms = ceil($msg_len/153);
      			 else
				$no_of_sms = ceil(strlen($msg_len)/160);
			$is_duplicate = $is_block_listed = 0;
				if($mobile != "" && $mobile != 0 &&    $msg != "")
				{
                                       /*** If schedule move to schedule ***/
					if($is_schedule)
					{
						$sch_camp_batch[] = array(
							'campaign_id' => $camp_id,
							'sms_text' => $msg,
							'to_mobile_no' => $mobile,
							'created_on' => date('Y-m-d H:i:s')
						);
					}
					/***** International Phone check ****/
					if($this->_International!=1){
						$is_invalid_no = $this->customized_model->isValidNo($mobile);
					}else{
						$is_invalid_no = $this->Campaign_model->IsCountry($mobile,$this->_AllowedCountry);
						if(isset($CountryRoute[substr($mobile, 0, 4)])) $sms_port = $CountryRoute[substr($mobile, 0, 4)];
						elseif(isset($CountryRoute[substr($mobile, 0, 3)])) $sms_port = $CountryRoute[substr($mobile, 0, 3)];
						elseif(isset($CountryRoute[substr($mobile, 0, 2)])) $sms_port = $CountryRoute[substr($mobile, 0, 2)];
						elseif(isset($CountryRoute[substr($mobile, 0, 1)])) $sms_port = $CountryRoute[substr($mobile, 0, 1)];
						else $sms_port = "32013";  //Default Port
					} /**** ***/
					/**** Check the Duplicate ***/
					//if(!$is_invalid_no){	
					 //$is_duplicate = $this->Campaign_model->checkduplicate($this->_userId,$msg,$sender,trim($mobile)); 
					//just comment for customized $is_block_listed = $this->Campaign_model->isBlockListed($mobile);
                                        //}
					
					$camp_single = array("campaign_id" => $camp_id, 
							      "to_mobile_no" => $mobile,"sms_text" => $msg,
							      "sent_on" => date('Y-m-d H:i:s'));
					/**** Blocked List No ***/	
			      		/*if($is_block_listed){
	                        		
					$camp_single["dlr_status"] = 2;
					$camp_single["error_text"] = "Block Listed Number";		
                        			
                    			}else*/
					/*if($is_duplicate){   /**** Duplicate ****/
						
						/*$camp_single["dlr_status"] = 16;
					$camp_single["error_text"] = "Duplicate Msg";	              	
             		                 } else*/ 
					if($is_invalid_no){  /**** Invalid NO ***/
						$camp_single["dlr_status"] = 16;
					$camp_single["error_text"] = "Invalid Number";		               	
             		                } else{
					$actual_no_msg +=  $no_of_sms;
						/*** Perform the Operation ***/
			 			if(!$this->_userType){ /*** If promotional ****/
							$isDND = $this->customized_model->checkIsDND($mobile);
								
                            				if($isDND)
							{ /**** DND Number ***/
								 $camp_single["dlr_status"] = 3;
					                         $camp_single["error_text"] = "DND Number";	             	
             		
                            				}else{
                                       			/******* Send the SMS for PROMO ****/
								$sender_name = "0". rand(16066,16075);	
								$send_sms_pre_array[]  = array("momt" => $momt, "sender" => $sender_name , "receiver" => $mobile, 
				  "msgdata" => $msg , "sms_type" => $sms_type , "dlr_mask" => $dlr_mask , "mid" => $unique_msg_id,
				  "dlr_url" => $dlr_url, "smsc_id" => $smsc_id, "mclass" => $mclass);
								$this->send_sms_pre($sender_name,$mobile,$msg,$mclass,$camp_id,$sms_port);
								$camp_single["dlr_status"] = 0;
					                 $camp_single["error_text"] = "";	             	
                                			}   
						}else{  /*** if trns and Semi trans ***/
						$isDND = 0;
						/**** If Semi Trans check the DND Number ****/
						if($this->_dndCheck)
						{
							$isDND = $this->customized_model->checkIsDND($mobile);
							if($isDND)
							{ /**** If Is DND not send mail ****/
								 $camp_single["dlr_status"] = 3;
					                         $camp_single["error_text"] = "DND Number";	             	
             		
							}
						} /**** DND Check is CLosed ****/
			    			if(!$isDND){  
				     			/******* Send the SMS for Trans and Semi Trans ****/
							$this->send_sms_pre($sender_name,$mobile,$msg,$mclass,$camp_id,$sms_port);
																			

						$send_sms_pre_array[]  = array("momt" => $momt, "sender" => $sender_name , "receiver" => $mobile, 
				  "msgdata" => $msg , "sms_type" => $sms_type , "dlr_mask" => $dlr_mask , "mid" => $unique_msg_id,
				  "dlr_url" => $dlr_url, "smsc_id" => $smsc_id, "mclass" => $mclass);
							 $camp_single["dlr_status"] = 0;
					                         $camp_single["error_text"] = "";	             	
						}
					
					}
				} //Else Actual Perform  closed 
			  // }   //Normal campaign  
			$camp_batch[] = $camp_single;         
			} //Mobile is not empty perform the operation	
				$jt++;	
			} // Foreach mobile closed	
		/*** Deduct the balance ***/
			//echo $actual_no_msg;  
			$this->customized_model->deductSMSCredits($this->_userId,$actual_no_msg); 
		if(count($send_sms_pre_array)>0)
			$this->customized_model->insert_kennel_send_sms($send_sms_pre_array,$this->_userType,$this->_dndCheck,1);
		$camp_cnt = count($camp_batch);
		if(count($camp_batch)>0)
		$this->customized_model->camp_insert($camp_batch);
		if(count($sch_camp_batch)>0)
			$this->customized_model->scheduledCampaignTo1($sch_camp_batch);
		} //If mobile count is greater than 0 if closed	
				$status =1;
		if($total_nb_rows <= $this->_Total_Cnt)
			$status =2;
		 $this->customized_model->update_campaign_status($camp_id,$status);

	}
	/**
        * Display the content in customized
	*@name cal_100_msg
	*@author Rushyendra
	*/	
	function cal_100_msg($content_array, $sms_text,$mobile_column)
	{
		$mobile_array = array();
		$message_array = array();
                $total_msg_len = 0;	
		$high_msg_len = 0;
		$high_msg_len_array = array();
		
		foreach($content_array as $each)
		{
			
			$each_content = str_getcsv($each);
			
			if(count($each_content)>0)
			{
				$index = $mobile_column-1;
				$mobile = '';
                                //Get the Mobile
				if(isset($each_content[$index]))
					$mobile =   $each_content[$index];
				if($mobile != "" && $mobile != NULL)
				{
					$mobile_array[] = $mobile;
					//Get the Message
				       $msg = $sms_text;	
					for($i=1; $i<15; $i++){	
						if(isset($each_content[$i-1]))
							 $msg = str_replace("#".$i."#",trim($each_content[$i-1]),trim($msg));
					}

	                         $message_array[] = $msg;
				$msg_len = strlen($msg);
				
      			if($msg_len>160)
			$sms_length_tmp = ceil($msg_len/153);
      			 else
			$sms_length_tmp = ceil(strlen($msg_len)/160);
				 $high_msg_len_array[] = $msg_len;
				 $total_msg_len  += $sms_length_tmp;
				} //mobile is not empty if closed	
			}
		} //For loop closed
		$high_msg_len = max($high_msg_len_array);
		
		return array($mobile_array,$message_array,$total_msg_len,$high_msg_len);
		
	}		
/**
*Send the SMS
*@name send_sms_pre
*@author Rushyendra
*/
//function send_sms_pre($sender_name,$mobile_no,$sms_text,$unicode_sms,$mclass,$campaign_id,$sms_port)
function send_sms_pre($sender_name,$mobile_no,$sms_text,$mclass,$campaign_id,$sms_port)
 { 

      /*$insert_array_kennel = array("momt" => 'MT', "sender" => $sender_name , "receiver" => $mobile_no, 
				  "msgdata" => $sms_text , "sms_type" => 2 , "dlr_mask" => 31 , 
				  "dlr_url" =>"http%3A%2F%2F147.120.203.99%2Fsms%2Fdlr.php%3Fdlr%3D%25d%26dest%3D%25p%26report%3D%25A", 				  "smsc_id" => 'vfirst_home');
	insert_kennel_send_sms($insert_array_kennel);	*/
		
	/*include("smslib/config.inc");
        include("smslib/functions.inc");
 	if($this->_International==1)
	{
	     $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name)
                                    ."&to=$mobile_no&text=".urlencode($sms_text);

	}else{
	     $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender_name)."&to=91$mobile_no&text=".urlencode($sms_text);
	}
        $URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/livedlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&file_name=dlr.php");
        http_send($URL, $sms_port);*/
 }
	
		
}
?>
