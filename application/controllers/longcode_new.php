<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mahesh.lavanam
 * Date: 8/5/12
 * Time: 2:17 AM
 * To change this template use File | Settings | File Templates.
 */
class longcode_new  extends CI_Controller
{
    protected $_userId;

    protected $_username;

    protected $_credits;

    protected $_international_credits;

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

        //user details from session
        $this->_userId = $this->session->userdata('user_id');
        $this->_username = $this->session->userdata('first_name');
        $this->_no_ndnc = $this->session->userdata('no_ndnc');

        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) {
            $this->_credits = $rs->available_credits;
            $this->_international_credits = $rs->international_available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        }

        $this->_data['available_credits'] = $this->_credits;
        $this->_data['international_credits'] = $this->_international_credits;

    }

    public function index()
    {
        $this->_data['page_title'] = "Long Code - Inbox";
        $this->load->model('codes_model');
        //get all long codes
        $codes = $this->codes_model->getCodes($this->_userId, "LONG");
		
		        $keywordcodes = $this->codes_model->getUserCodes($this->_userId);
		        $this->_data['keywordcodes'] = $keywordcodes;

		if(count($codes)>0) {
            

            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $code_id = $this->input->post('code');
          	$longcode_keyword=$this->session->userdata('longcode');
          	
            $getTotalRows = $this->codes_model->getReceivedSMS($this->_userId, "LONG", $code_id,$longcode_keyword, $from_date, $to_date);
            $total_rows = count($getTotalRows);

            $off_set = 0;
            if($this->uri->segment(3)) {
               $off_set = $this->uri->segment(3);
            }

            $limit = 10;

            $receiveSMS = $this->codes_model->getReceivedSMS($this->_userId, "LONG", $code_id,$longcode_keyword, $from_date, $to_date, $off_set, $limit);
            $this->load->library('pagination');
            $config['base_url'] = site_url().'/longcode/index';
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            $this->_data['received_sms'] = $receiveSMS;
            $this->_data['from_date'] = $from_date;
            $this->_data['to_date'] = $to_date;

        } else {
            $this->_data['no_long_code'] = true;
        }

			//2817

        $this->load->view('includes/header',$this->_data);
        if($this->_userId=='3345' )
        {
			if($this->session->userdata('longcode'))	
			{	
        		$this->load->view('longcode/index');
			}
        	else	
			{
        			$this->load->view('longcode/index_2817');
			}
		}
        else{
        	$this->load->view('longcode/index');
       		 $this->load->view('includes/footer');
		}
    }
	
    public function invalidateLongCodeSession()
	{
		$this->session->unset_userdata('longcode');
		redirect('longcode/index');
	}
    
	
	
	
	
	
	public function pageAuthenticate()
	{
		$passcode = $this->input->post('passcode');
		$longcode = $this->input->post('longcode_id_pop');
    	$passcode=trim($passcode);
    	$passcode=mysql_real_escape_string($passcode);
		        $this->load->model('codes_model');

    	if($longcode=="OFS" && $passcode=="OFS")
    	{
    		
    		$uData = array ('longcode' => "OFS");
			$this->session->set_userdata($uData);	
    		echo 1;
		}
		 elseif($longcode=="HK" && $passcode=="HK"){
    		
    		$uData = array ('longcode' => "HK");
			$this->session->set_userdata($uData);	
    		echo 1;
		}
		 elseif($longcode=="SAFETY" && $passcode=="SAFETY"){
    		
    		$uData = array ('longcode' => "SAFETY");
			$this->session->set_userdata($uData);	
    		echo 1;
		}
    	elseif($longcode=="BD" && $passcode=="BD")
    	{
    		$uData = array ('longcode' => "BD");
			$this->session->set_userdata($uData);		
    		echo 1;	
		}
		elseif($longcode=="QA" && $passcode=="QA")
    	{
    		$uData = array ('longcode' => "QA");
			$this->session->set_userdata($uData);		
    		echo 1;	
		}
		elseif($longcode=="ALL" && $passcode=="ALL")
    	{
    		$uData = array ('longcode' => "ALL");
			$this->session->set_userdata($uData);		
    		echo 1;	
		}
   		else
		{
    		echo 0;	
		}
			
				}
				
				
    public function download()
    {
        $from_date = $this->uri->segment(3);
        $to_date = $this->uri->segment(4);
        $longcode_keyword=$this->session->userdata('longcode');
        $code_id = "";
        $this->load->model('codes_model');
        $rs = $this->codes_model->getReceivedSMS($this->_userId, "LONG", $code_id, $longcode_keyword,$from_date, $to_date);
        $string = "S No\tOn Date\tTo\tFrom\tSMS Text\n";
        $sno=1;
        foreach($rs as $row){
        	$sms_text=$row->sms_text;
            $string .=$sno."\t".$row->created_on."\t".$row->code_number."\t".$row->from_number."\t".$sms_text."\n";
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
