<?php
Class lead_missedcall extends CI_Controller
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
        $real_url=$this->data = $this->config->item('voice_url');

        $this->_userId = $this->session->userdata('user_id');
        $this->load->model('User_model');
        $userInfo = $this->User_model->getUserDetails($this->_userId);
        $this->_credits = $userInfo[0]->available_credits;
$this->_data['shorturlCredits'] =  $userInfo[0]->shorturl_credits;
        $this->_userType = $userInfo[0]->no_ndnc;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
        $this->_template_check = $userInfo[0]->template_check;
        $this->_dlr_report_type = $userInfo[0]->dlr_enabled;
        $this->_data['available_credits'] = $this->_credits;
		$this->_data['user_id']=$this->_userId;
		$this->_dndCheck = $userInfo[0]->dnd_check;		
		$this->_detailed_dlr_report = $userInfo[0]->detailed_dlr_report;		
	}


public function missedcall()
{
    $data['page_title'] = "SMS Striker | Conference Bridge";

        $user_id=$this->session->userdata('user_id');
	$real_url=$this->data;
	$leadmissedcall='LEADMISSEDCALL';
	$misscall_fields = array(
	'user_id' => urlencode($user_id),
	'leadmissedcall'=>$leadmissedcall);
	 $misscall_url = $real_url."/get_smspanelmissedcall_api.php";
	$misscall_string = http_build_query($misscall_fields);
      	//open connection
	$misscall = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($misscall,CURLOPT_URL, $misscall_url);
	curl_setopt($misscall,CURLOPT_POST, count($_POST));
	curl_setopt($misscall,CURLOPT_POSTFIELDS, $misscall_string);
	curl_setopt($misscall, CURLOPT_FORBID_REUSE, 1);
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($misscall, CURLOPT_RETURNTRANSFER, true);
	$misscall_result = curl_exec($misscall);
	$misscall_reportresult= json_decode($misscall_result, true);
	curl_close($misscall);
	$data['misscall_reportresult']=$misscall_reportresult;
 if($this->input->post('misscall_report_search')){
           $leadmissedcallsearch='LEADMISSEDCALLSEARCH';
     	$misscallsearch_fields = array(
     	'leadmissedcallsearch'=>$leadmissedcallsearch,
	'user_id' => urlencode($user_id),
         'fdate'=> urlencode($_REQUEST['from_date']),
         'tdate'=> urlencode($_REQUEST['to_date']),
         'phone_no'=> urlencode($_REQUEST['phone_no']),
         'service_no'=> urlencode($_REQUEST['service_no'])
         );
	 $misscallsearch_url = $real_url."/get_smspanelmissedcall_api.php";
	 $misscallsearch_string = http_build_query($misscallsearch_fields);
	 //print_r($misscallsearch_string);
      	//open connection
	$call = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($call,CURLOPT_URL, $misscallsearch_url);
	curl_setopt($call,CURLOPT_POST, count($_POST));
	curl_setopt($call,CURLOPT_POSTFIELDS, $misscallsearch_string);
	curl_setopt($call, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($call, CURLOPT_RETURNTRANSFER, true);
	$misscallsearch_result = curl_exec($call);
	$misscallsearch_reportresult= json_decode($misscallsearch_result, true);
	//print_r($misscallsearch_reportresult);
	curl_close($call);
	$data['misscallsearch_reportresult']=$misscallsearch_reportresult; 
   
       }
if($this->input->post('misscall_download'))
        {
          $leadmissedcalldownload='LEADMISSEDCALLDOWNLOAD';
      $misscal=array(
      'leadmissedcalldownload'=>$leadmissedcalldownload,
      	'user_id' => urlencode($user_id),
		'fdate'=> urlencode($_POST['from_date']),
		'tdate'=> urlencode($_POST['to_date']),
		'phone_no'=> urlencode($_REQUEST['phone_no']),
                'service_no'=> urlencode($_REQUEST['service_no'])
		);
		$download_misscall_url=$real_url."/get_smspanelmissedcall_api.php";
		$download_misscall_fields_string = http_build_query($misscal);
		$dmcal= curl_init();
		curl_setopt($dmcal,CURLOPT_URL, $download_misscall_url);
		curl_setopt($dmcal,CURLOPT_POST, count($_POST));
		curl_setopt($dmcal,CURLOPT_POSTFIELDS, $download_misscall_fields_string);
		curl_setopt($dmcal, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($dmcal, CURLOPT_RETURNTRANSFER, true);
		$download_miscalls_result = curl_exec($dmcal);
		$downlad_response= json_decode($download_miscalls_result, true);

		curl_close($dmcal);
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
        $data['getdid_calllist_api'] =$this-> getdid();
       
	$this->load->view('includes/header', $this->_data);
	$this->load->view('includes/leftmenu');
	$this->load->view('missedcall/lead_misscall',$data);
}
public function getdid()
 {
 $real_url=$this->data;
	
	$user_id =$this->session->userdata('user_id');
     $router_type_url = $real_url."/getDID_calllist.php";
            $didsystem_fields = array(
	     'user_id' => urlencode($user_id));
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
		
		//print_r($result);
		return $result;
}

	
	
	
	
	
}
