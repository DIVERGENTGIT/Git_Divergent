<?php
Class analysis extends CI_Controller
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
        $this->_userType = $userInfo[0]->no_ndnc;
        $this->_template_check = $userInfo[0]->template_check;
        $this->_dlr_report_type = $userInfo[0]->dlr_enabled;
		$this->_data['isftpuser'] = $userInfo[0]->is_ftp;
        $this->_data['available_credits'] = $this->_credits;
		$this->_data['user_id']=$this->_userId;
		$this->_dndCheck = $userInfo[0]->dnd_check;		
		$this->_detailed_dlr_report = $userInfo[0]->detailed_dlr_report;		
	}

//view index
	public function index()
	{
$this->_data['page_title'] = "View Analysis";


		$this->load->model('Campaign_model');
		
			$analysisweek=$this->load->model('Analysis_model');

if($date = $this->uri->segment(3))
{
		$rechargewiseReport=	$this->Analysis_model->rechargeWiseAnalysis($this->_userId,$date);



		
$this->_data['rechargewiseReport'] = $rechargewiseReport;


			$totalmsgRchrg=0;
			$exprdRchrg=0;
			$dlrdRchrg=0;
			$dndsRchrg=0;
			$pndngRchrg=0;
			$invaldRchrg=0;
foreach($rechargewiseReport as $rchrgReport)
		{
			$totalmsgRchrg=$rchrgReport['totalmsg'];
			$exprdRchrg=$rchrgReport['exprd'];
			$dlrdRchrg=$rchrgReport['dlrd'];
			$dndsRchrg=$rchrgReport['dnds'];
			$pndngRchrg=$rchrgReport['pndng'];
			$invaldRchrg=$rchrgReport['invald'];
			$processcntRchrg=$rchrgReport['processcnt'];

		}
				$this->_data['processcntRchrg'] = $processcntRchrg;
				$this->_data['totalmsgRchrg'] = $totalmsgRchrg;
				$this->_data['exprdRchrg'] = $exprdRchrg;
				$this->_data['dlrdRchrg'] = $dlrdRchrg;
				$this->_data['dndsRchrg'] = $dndsRchrg;
				$this->_data['pndngRchrg'] = $pndngRchrg;
				$this->_data['invaldRchrg'] = $invaldRchrg;
				}
	$avgtime=	$this->Analysis_model->getAvgTime($this->_userId);
	
	$rechargedetails=	$this->Analysis_model->rechargeDetails($this->_userId);

	
	

$campaigns_report = $this->Analysis_model->get_campaigns_report_default($this->_userId);



$this->_data['rechargedetails'] = $rechargedetails;
$this->_data['avgtime'] = $avgtime;
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
				
$this->load->view('includes/header',$this->_data);
$this->load->view('includes/leftmenu');
$this->load->view('analysis/overall');
$this->load->view('includes/footer');
	}
	public function creditUsage()
	{
	$this->_data['page_title'] = "View Analysis";
	
	$analysisweek=$this->load->model('Analysis_model');
	
	$weeklyreport=	$this->Analysis_model->getWeekCampaign($this->_userId);
	$this->_data['weekcampaigns_report'] = $weeklyreport;
	
	$monthlyreport=	$this->Analysis_model->getMonthCampaign($this->_userId);
	$this->_data['monthlyreport']=$monthlyreport;
	
	$yearreport=	$this->Analysis_model->getYearCampaign($this->_userId);
	$this->_data['yearreport']=$yearreport;
	
	$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
	$this->load->view('analysis/creadit-usage');
	$this->load->view('includes/footer');
	}

public function smsSource()
	{
$this->_data['page_title'] = "View Analysis";

$analysisweek=$this->load->model('Analysis_model');


/***** quick SMS start****/
$weeklyreportquick=	$this->Analysis_model->getWeekCampaignQuicksend($this->_userId);
$this->_data['weekcampaignsquick_report'] = $weeklyreportquick;


$getMonthCampaignQuicksend=	$this->Analysis_model->getMonthCampaignQuicksend($this->_userId);
$this->_data['monthcampaignsquick_report'] = $getMonthCampaignQuicksend;


$getYearCampaignQuicksend=	$this->Analysis_model->getYearCampaignQuicksend($this->_userId);
$this->_data['yearcampaignsquick_report'] = $getYearCampaignQuicksend;

/***** quick SMS End****/

/***** Unicode SMS Start****/

$getWeekCampaignUnicode=	$this->Analysis_model->getWeekCampaignUnicode($this->_userId);
$this->_data['getWeekCampaignUnicode'] = $getWeekCampaignUnicode;

$getMonthCampaignUnicode=	$this->Analysis_model->getMonthCampaignUnicode($this->_userId);
$this->_data['getMonthCampaignUnicode'] = $getMonthCampaignUnicode;

$getYearCampaignUnicode=	$this->Analysis_model->getYearCampaignUnicode($this->_userId);
$this->_data['getYearCampaignUnicode'] = $getYearCampaignUnicode;
/***** Unicode SMS Start****/

/***** Customized SMS Start****/

$getWeekCampaignCustomized=	$this->Analysis_model->getWeekCampaignCustomized($this->_userId);
$this->_data['getWeekCampaignCustomized'] = $getWeekCampaignCustomized;

$getMonthCampaignCustomized=	$this->Analysis_model->getMonthCampaignCustomized($this->_userId);
$this->_data['getMonthCampaignCustomized'] = $getMonthCampaignCustomized;

$getYearCampaignCustomized=	$this->Analysis_model->getYearCampaignCustomized($this->_userId);
$this->_data['getYearCampaignCustomized'] = $getYearCampaignCustomized;

/***** Customized SMS END****/

$this->load->view('includes/header',$this->_data);
$this->load->view('includes/leftmenu');
$this->load->view('analysis/sources-sms');
$this->load->view('includes/script/file');
$this->load->view('includes/script/quick_send_js');
$this->load->view('includes/script/uni-code');
$this->load->view('includes/script/customize');

	}
	public function localProviders()
	{
			

$this->_data['page_title'] = "View Analysis";

$analysisweek=$this->load->model('Analysis_model');

$locationwise_report = $this->Analysis_model->get_locationwise_report_default($this->_userId);

$operator_report = $this->Analysis_model->get_opertatwise_report_default($this->_userId);

$this->_data['locationwise_report'] = $locationwise_report;
$this->_data['operator_report'] = $operator_report;


$this->load->view('includes/header',$this->_data);
$this->load->view('includes/leftmenu');
$this->load->view('analysis/local-provider-wise');
$this->load->view('includes/footer');
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

	
	

} 



