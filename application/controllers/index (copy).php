<?php
class index extends CI_Controller
{
	protected $_credits;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		 

		if($this->session->userdata('user_id')) {            
			$this->_userId = $this->session->userdata('user_id');
			$this->load->model('User_model');
			$credits_rs = $this->User_model->getAvailableCredits($this->_userId);
			foreach ($credits_rs as $rs) {
			$this->_credits = $rs->available_credits;
			$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
			$this->_data['isftpuser'] = $rs->is_ftp;
			}
		}
	}

public function about(){
redirect(base_url());
}
public function tollfree(){
redirect(base_url());
}
public function bulksms(){
redirect(base_url());
}
public function sms_service(){
redirect(base_url());
}


public function team(){
redirect(base_url());
}
 public function contact(){
redirect(base_url());
}

 public function search_engine_optmization(){
redirect(base_url());
}

public function missed_call_services(){
redirect(base_url());
}

public function hosted_ivr_services_solution_provider(){
redirect(base_url());
}
public function voice_service(){
redirect(base_url());
}
public function mobile_marketing(){


redirect(base_url());
}
public function digital_marketing(){


redirect(base_url());
}

public function careers(){


redirect(base_url());
}
public function missedcallalerts(){


redirect(base_url());
}

public function mobile(){


redirect(base_url());
}

	/*public function chat()
	{
			$data['page_title'] = "Home";
			$data['canonical'] = "http://www.smsstriker.com/";
			$this->load->view('includes/header_new',$data);
		//	$this->load->view('includes/menu_new');
			$this->load->view('index_new/chattest');
				//$this->load->view('includes/footer_new');
			
			
	}*/
	
	/*	public function index()
	{
		$data['page_title'] = "Bulk Sms | Bulk Sms Hyderabad | Bulk sms services in Hyderabad";
		
		$data['canonical'] = "http://www.smsstriker.com/";
		$data['page_meta_des'] = "SMS Striker is one of the Best and Reliable Bulk SMS Services Providers company in India which offers Promotional and Transactional Bulk sms along with bulk sms gateway and SMS API, missed call, ivrs solutions etc";
		$data['page_meta_key'] = "bulk sms,bulk sms service,bulk sms hyderabad,bulk sms gateway,bulk sms in india,bulk sms service provider,bulk sms services india";


		$this->load->view('index');
			

	}*/
	/*
	public function index()
	{
		$data['page_title'] = "Bulk Sms | Bulk Sms Hyderabad | Bulk sms services in Hyderabad";
		
		$data['canonical'] = "http://www.smsstriker.com/";
		$data['page_meta_des'] = "SMS Striker is one of the Best and Reliable Bulk SMS Services Providers company in India which offers Promotional and Transactional Bulk sms along with bulk sms gateway and SMS API, missed call, ivrs solutions etc";
		$data['page_meta_key'] = "bulk sms,bulk sms service,bulk sms hyderabad,bulk sms gateway,bulk sms in india,bulk sms service provider,bulk sms services india";

		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/index');
		//redirect("error");
		//$this->load->view('index_new/Eq_form');
			
		$this->load->view('includes/footer_new');


	}*/
	/*public function enterprise_messaging()
	{		
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		

		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/enterprise_messaging');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	public function bulk_sms()
       {

		
		$data['page_title'] = "Bulk Sms | Bulk Sms Service provider | Bulk sms services in India";
		
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$data['page_meta_des'] = "SMS STRIKER is one of the Best and Reliable Bulk SMS Services Providers company in India which offers Promotional and Transactional Bulk sms along with bulk sms gateway and API, missed call, ivrs solutions etc.. Bulk SMS Hyderabad, Delhi, Mumbai, Chennai, Bangalore,Pune, Kolkata, Ahmedabad, Coimbatore, Chandigarh";
		$data['page_meta_key'] = "bulk sms,bulk sms service,bulk sms hyderabad,bulk sms gateway,bulk sms in india,bulk sms service provider,bulk sms services india";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/bulk_sms');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
		
       }
	public function about()
	{		
		$data['canonical'] = "http://www.smsstriker.com/about.html";
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/about');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	
	public function sitemap()
	{		
		$data['canonical'] = "http://www.smsstriker.com/sitemap.html";
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/sitemap');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	public function team()
	{		
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/team.html";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/team');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	public function whystriker()
	{		
			$data['page_title'] = "We Make Different – Digital Communications | SMS Striker";
		$data['page_meta_des'] = "We make difference with Pan India coverage, Robust infrastructure, Customized plans, Proven expertise, Attractive pricing, 100% convenience, Trusted brand.";
		$data['page_meta_key'] = "sms, Voice and E-Mail services, digital platform, 24x7pro-active support, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/whystriker.html";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/whystriker');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	public function infrastructure()
	{		
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/infrastructure.html";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/infrastructure');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
    public function sms_service()
	{		
			$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";

		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/sms_service');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	 public function voice_service()
	 {		
		$data['page_title'] = "Enterprise Voice Solutions – IVR, Missed Call, Voice, Toll Free  | smsstriker.com";
		$data['page_meta_des'] = "Enterprise voice solutions includes - IVRS services, Hosted IVR and solution provider, Missed Call Alerts, Cloud Voice, Toll Free, Voice Conferencing.";
		$data['page_meta_key'] = "Voice SMS, IVRS, hosted IVR, Missed Call Alerts, Cloud Voice, Toll Free Numbers";
		$data['canonical'] = "http://www.smsstriker.com/voice-service.html";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/voice_service');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	 }
	 ///redirect start urls
public function smstoemail()
{
		redirect('digital_marketing');
}
public function business_verticals()
{
		redirect('verticals');

}

public function terms()
	{		
	redirect('error');
		
	}
public function mobile()
{
redirect('mobile-marketing');
}

public function contactUs()
	{
		$data['page_title'] = "Contact Us";
		$data['canonical'] = "http://www.smsstriker.com/contact.html";

		$this->load->view('includes/header_new',$data);
		
		$this->load->view('includes/menu_new');	
	    redirect('contact');
		//$this->load->view('/index/contact');
		$this->load->view('includes/footer_new');
	}


//end redirect urls




	  public function digital_marketing()
	 {		
			$data['page_title'] = "Digital Marketing – SEM, SEO, SMM, Email Marketing | smsstriker.com";
		$data['page_meta_des'] = "We broadcast your information through the digital channels to the users using mobile phones, tablets, laptops and desktop to reach the targeted audience.";
		$data['page_meta_key'] = "Digital Marketing, SEO, Search Engine Optimization, SEM, Search Engine Marketing, SMM, Social Media Marketing";
		$data['canonical'] = "http://www.smsstriker.com/digital_marketing.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/digital_marketing');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	 }
	  public function mobile_marketing()
	 {		
			$data['page_title'] = "Mobile Marketing – App Store, Marketing | smsstriker.com";
		$data['page_meta_des'] = "In this digital world, people are addicted in using mobile phones for texting, shopping,    calling, web surfing etc, as it makes mobile marketing huge";
		$data['page_meta_key'] = "Digital Marketing, SEO, Mobile Marketing, SEM, Mobile Search Ads, SMM, Mobile apps";
		$data['canonical'] = "http://www.smsstriker.com/mobile-marketing.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/mobile_marketing');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	 }
	 
	public function verticals()
	{		
			$data['page_title'] = "Business Verticals - Ideal Solutions for all Businesses | smsstriker.com";
		$data['page_meta_des'] = "Our solutions are ideal for industries include - Banking, Education, IT and ITeS, Media, Healthcare, Retail, Food, Communications, E-Commerce etc.";
		$data['page_meta_key'] = "Digital Marketing, SMS, Mobile Marketing, SEM, Voice SMS, SMM, whatsapp";
		$data['canonical'] = "http://www.smsstriker.com/verticals.html";
		
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/verticals');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	*/
  /* public function reseller()
	{		
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/reseller');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	*/
	/*
public function striker_reseller()
{		
$data['page_title'] = "Reseller Opportunities - For Dedicated Individuals with Entrepreneurial Dreams | smsstriker.com";
		$data['page_meta_des'] = "SMS Striker has reseller opportunities for dedicated individuals with entrepreneurial dreams - Easy-to-sell, Bulk SMS, Long code & Short Code SMS, SMS APIs";
		$data['page_meta_key'] = "Bulk SMS, Long code SMS, Short Code SMS, Customized SMS, whatsapp";
		$data['canonical'] = "http://www.smsstriker.com/striker-reseller.html";
	$this->load->view('includes/header_new',$data);
	$this->load->view('includes/menu_new');
	$this->load->view('index_new/strikerreseller');
	$this->load->view('includes/footer_new');
}
	public function pricing()
	{		
			$data['page_title'] = "Affordable Pricing – Best Price in the Industry | smsstriker.com";
		$data['page_meta_des'] = "SMS Striker is a leading provider of Bulk SMS, Digital Marketing, Web & Mobile Developing services across India at a very best affordable pricing.";
		$data['page_meta_key'] = "Bulk SMS Price, best priced SMS, affordable SMS services, Customized SMS, best price SMS";
		$data['canonical'] = "http://www.smsstriker.com/pricing.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/pricing');
		$this->load->view('includes/footer_new');
	}
	  public function apply()
	{
		redirect('careers');
		
	}
	  public function bulkoutbound()
	{
		redirect('sms_service');
		//$this->load->view('index_new/Eq_form');
	}
   public function careers()
	{
			$data['page_title'] = "Careers – Right Place for Innovations | smsstriker.com";
		$data['page_meta_des'] = "Talented and committed individuals can expect long, fulfilling and rewarding careers at Striker as we encourage new talent and innovative ideas.";
		$data['page_meta_key'] = "Job openings, Marketing placements, digital marketing jobs, online marketing jobs, internet marketing jobs";
		$data['canonical'] = "http://www.smsstriker.com/careers.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/careers');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	public function contact()
	{
		$data['page_title'] = "We are located in India - Hyderabad | smsstriker.com";
		$data['page_meta_des'] = "SMS Striker is a leading provider of Bulk SMS, Digital Marketing, Web & Mobile Developing services across India at a very best affordable pricing.";
		$data['page_meta_key'] = "Bulk SMS Price, best priced SMS, affordable SMS services, Customized SMS, best price SMS";
		$data['canonical'] = "http://www.smsstriker.com/contact.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/contact');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}

	
	public function terms_of_services()
	{
			$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/terms-of-services.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/terms_of_services');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	
	public function privacy_statement()
	{
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
				$data['canonical'] = "http://www.smsstriker.com/privacy-statement.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/privacy_statement');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
	}
	*/
	
	
	public function password_check($str)
		{
		   if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			 return TRUE;
		   }
		   return FALSE;
		}
	/*
	public function register()
	{     
	     

            
	      $this->load->library('email');
		date_default_timezone_set("Asia/Bangkok");
		
			$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/register.html";
		$no_ndnc=0;
		$data['available_credits'] = 0;
		$data['page_title'] = "Register";
		$userCaptcha =$this->input->post('codetypecopy');
		 $validCaptcha =$this->input->post('captch');
		 $data['validCaptcha'] = $validCaptcha;
		  if($userCaptcha == $validCaptcha){
		if ($this->input->post('register')) {
		
			$this->load->library('form_validation');	
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[8]|alpha_numeric|callback_password_check');		
			if ($this->form_validation->run('register_form') == FALSE) {
				$this->load->model('User_model');
				 //$username=$this->input->post('username');
				
				
				if(!$this->User_model->usernameExist()) {
				
				  
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
<p>Dear Customer,</p> 
<br> 
<p>Greetings from Striker !!!!!</p> 
<br> 
<p>This is to inform you that your User ID  has been registered with Striker as mentioned below.  To login into your User ID please click the below link.</p>

<br> 
<p>User Name :'.$this->input->post('username').'</p>
<p>Password : '.$this->input->post('userpass').'</p>

<p>Link: <a href="http://www.smsstriker.com/login.html">http://www.smsstriker.com/login.html</a></p> 
<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p> 
<p>For adding credits and Finance related, please contact to <a href="mailto:accounts@smsstriker.com" target="_top">accounts@smsstriker.com&#59;</a> 040&#45;79417712.</p> 
<br> 
<p>For providing your feedback, please click the URL.....</p> 
 <p>Thanks for being our valid customer....Have a great day ahead.....</p> 
<p><b>Best Regards&#44;</b></p><br> 
<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
<div> 
<img src="http://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
</div> 
<div class="signature"> 
<p><b>Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
<p><b>Hightech City| Hyderabad &#45; 81 |</b></p> 
<p><b>Mobile: +91 9966507711| Ph : 040&#45;64547711|</b></p> 
</div> 
</div> 
</div> 
 </body> 
     
</html>'; 
					
					$subject = "Welcome To SMS Striker";
					
					$this->load->library('email');
					
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
		                   
					$this->email->from('support@smsstriker.com', 'Support Team');
					$this->email->to($this->input->post('email'));	
					$this->email->subject($subject);
					$this->email->message($email_msg);
					$this->email->send();
					
					
					$this->User_model->register();
					
					
					redirect('login');
	      //$data['sucess'] = "User Registration Successfully";
	      } else 
				{
					$data['userExist'] = "User already exist with the same Username";
				}
			}
		}
		  }
		else
			{
			
			$data['invalidCaptcha']="Invalid Captcha ";
			}
		$this->load->model('user_model');
		$statesAll = $this->user_model->getNew_StatesList();
        $data['statesAll'] = $statesAll;
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/registration',$data);
		$this->load->view('includes/footer_new');
	}
*/
	public function billings()
	{	
		$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/billings.html";
		
     if($this->input->post('send'))
	 {
	 $this->load->library('session');
	 $this->session->set_userdata('end');
	 }
	 
		$this->load->model('user_model');
		$statesAll = $this->user_model->getNew_StatesList();
       	 $states_all = array('' => '--select--');
        	foreach($statesAll as $row){
            $states_all[$row->state_id] = ucwords(strtolower($row->state));
        	}
        $this->_data['states_all'] = $states_all;
		/*$data['page_title'] = "Billing Information";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/billing');
		$this->load->view('includes/footer_new'); */
redirect('http://www.smsstriker.com');
	}
    public function cities_ajax()
    {
		//get cities
		$this->load->model('user_model');
        $state_id_ajax=$this->input->post('state_id');
        $citiesAll = $this->user_model->getNew_CitiesList($state_id_ajax);
        $city_all = array('' => '--select--');
        foreach($citiesAll as $row){
            $city_all[$row->city_id] = ucwords(strtolower($row->city_name));
        }
        //$this->_data['city_all'] = $city_all;
         print form_dropdown('city',$city_all);
	}
    public function cities_ajaxreg()
    {
		//get cities
		$this->load->model('user_model');
        $state_id_ajax=$this->input->post('state_id');
        $citiesAll = $this->user_model->getNew_CitiesListReg($state_id_ajax);
        $city_all = array('' => '--select--');
        foreach($citiesAll as $row){
             $city_all[$row->city_id] = ucwords(strtolower($row->city_name));
        }
        //$this->_data['city_all'] = $city_all;
         print form_dropdown('city_id',$city_all);
	}
	
	
	 public function userchecker_forget()
	{
		$this->load->model('user_model');
		 $username=$this->input->post('username');
		 $checker=$this->user_model->usernameExist($username);
		 $status ="false";	
		  if($checker)
		  {
			$status = "true";
		}                
                echo $status;	
	}
	
	 public function userchecker()
	{
		$this->load->model('user_model');
		 $username=$this->input->post('username');
		 $checker=$this->user_model->getUser_Checker($username);
		 $status ="true";	
		  if($checker)
		  {
			$status = "false";
		}                
                echo $status;	
	}
		
public function login()
	{ 	
 
 
redirect(base_url());
 			 
		  
		  
		  
	}
	
	public function otpVerify() {
 
		$otpCode = $this->input->post('otpCode');
		$this->load->model('user_model');
		$rs = $this->user_model->checkUserAuth($otpCode); 
		if($rs && $otpCode)
			{
				foreach($rs as $result)
				{
					$sessionData = array (
							'username' => $result->username,
							'first_name' => $result->first_name,
							'user_id' => $result->user_id,
							'mobile' => $result->mobile,
							'no_ndnc' => $result->no_ndnc,
							'dnd_check' => $result->dnd_check,
							'dlr_enabled' => $result->dlr_enabled,
							'is_reseller' => $result->is_reseller,
							
                            'ndnc_return' => $result->return_ndnc_credits,
                            'template_check' => $result->template_check,
                            'is_longcode' => $result->is_longcode,
                            'is_missedcall' => $result->is_missedcall
						);
					$is_blocked = $result->is_blocked;
					$otpMobileNo = $result->otpMobileNo;
				}
				$mobile = $sessionData['mobile'];
				$username = $sessionData['username'];
				$user_id = $sessionData['user_id'];


				if(!$is_blocked)
				{ 

					//$otpMobileNo = explode(',',$otpMobileNo);
					$checkIsOtpSent = $this->db->query("SELECT * FROM sms_api_messages WHERE to_mobileno IN ($otpMobileNo) AND date(ondate) = date(now()) AND message LIKE '%$otpCode%'");	
					if($checkIsOtpSent->num_rows() > 0 )  { 
						$status = 'OTP Verified';   
						$this->userActivityLog($user_id,$username,$otpCode,$status); 

						$this->user_model->updateLoginTime($user_id);
						$this->session->sess_create();
						$this->session->set_userdata($sessionData);
					
	 
					
							$user_id=$this->session->userdata('user_id');
							$sql3="update  order_numbers set  status=0 where status=1 and user_id=$user_id";
							$this->db->query($sql3);
							$sql3="update  longcode_tmp set  status=0 where status=1 and user_id=$user_id";
							$this->db->query($sql3);
	 
	 
						$userarray=array(3907,3958,4065,4066,4084);
						if(in_array($result->user_id,$userarray))
						{
								redirect('index.php/missedcall/messages','refresh');
						}
						else
						{
							//if($profile['mverify']==0)
							if($result->mverify==0)
							{
							redirect('index.php/myaccount/index','refresh');
							}
							else
							{
								//redirect('campaign/normalSMS');
								$userexist=$this->user_model->getPriceTableuser($result->user_id);
								if(count($userexist)>0)
								{
									  $paymentstatus=$this->user_model->getpaymentstatus($result->user_id);
									if(count($paymentstatus)>0)
									{
								
									//redirect('Payment/paynow');
									 redirect('index.php/products/index','refresh');
									}
									else
									{

								    	 redirect('index.php/campaign/normalSMS','refresh');
									}
								}
								else
								{

							    	 redirect('index.php/campaign/normalSMS','refresh');
								}
							}
						} 
					}else { 
						$status = 'Invalid OTP'; $user_id = 0;$username = '';
						$this->userActivityLog($user_id,$username,$otpCode,$status);
						redirect(base_url().'otp.php?msg=1');
					}  
				}
				else
				{
					$status = 'OTP - User has been blocked'; 
					$this->userActivityLog($user_id,$username,$otpCode,$status);
					redirect(base_url());				
				
				}
				
				
			  
			}
			else
			{
				$status = 'Invalid OTP'; $user_id = 0;$username = '';
				$this->userActivityLog($user_id,$username,$otpCode,$status);
				redirect(base_url().'otp.php?msg=1');
			
			}	
	
	}
			
public function userLogin()
	{ 	
		   

		$data['page_title'] = "Login Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		//$data['canonical'] = "http://www.smsstriker.com/login.html";
		$loginCaptcha =$this->input->post('codetypecopy');
		$validCaptcha =$this->input->post('captch');
		$username = $this->input->post('username');
		$data['validCaptcha'] = $validCaptcha;$res = array();
		if($loginCaptcha == $validCaptcha)
		{ 


		if($this->input->post('username') && $this->input->post('userpass'))

		{
		$this->load->model('user_model');
			$rs = $this->user_model->login();

			if ($rs)
			{  

			foreach($rs as $result)
				{
					$sessionData = array (
							'username' => $result->username,
							'first_name' => $result->first_name,
							'user_id' => $result->user_id,
							'mobile' => $result->otpMobileNo, 
							'otpRequired' => $result->otpRequired,
							'no_ndnc' => $result->no_ndnc,
							'dnd_check' => $result->dnd_check,
							'dlr_enabled' => $result->dlr_enabled,
							'is_reseller' => $result->is_reseller,
							  
                            'ndnc_return' => $result->return_ndnc_credits,
                            'template_check' => $result->template_check,
                            'is_longcode' => $result->is_longcode,
                            'is_missedcall' => $result->is_missedcall
						);
					$is_blocked = $result->is_blocked;
				} 
				$mobileNo = $sessionData['mobile'];
				$mobileNoArr = explode(',',$mobileNo);
				$mobileNoArr = array_unique($mobileNoArr);
				$mobileNoArr = array_filter($mobileNoArr);
				$mobileNoArr = array_values($mobileNoArr);
				$user_id = $sessionData['user_id'];
				$username = $sessionData['username'];
				$otpRequired = $sessionData['otpRequired'];
				
				if(!$is_blocked)
				{

					if($otpRequired == 1) { 

 
						if(count($mobileNoArr) > 0 ) {
							$otpSend = FALSE;	 
							foreach($mobileNoArr as $mobileNumber) {  
								$mobileNumber = trim($mobileNumber);
							 	$tmp_number = trim($mobileNumber);						  
								if($tmp_number) {
									if($tmp_number[0] == 6 or  $tmp_number[0] == 7 or $tmp_number[0] == 8 or $tmp_number[0] == 9 )	 {		  	  													
									  	$OTPCODE = $this->generatePassword(); 
										$checkOTPTime = $this->user_model->sendAuthCode($sessionData['user_id'],$OTPCODE,$mobileNumber);   
										 
										if($checkOTPTime) {  
											$this->sendOTP($mobileNumber,$OTPCODE,$username);    				 					 
											$otpSend = TRUE;
										}else{
											$msgError = 'OTP have been sent. Please try after 2 mins.'; 
										}    
									  
									}else{
										$msgError = 'Not a valid mobile number'; 	 
									}  
    
								} else{
									$msgError = 'Not a valid mobile number'; 	
								}
							}    

							if($otpSend) {

								$res['redirect'] =  'otp.php'; 
								$status = 'OTP Generated';$otpCode = '';
								//$this->userActivityLog($user_id,$username,$otpCode,$status);  
								   	//echo "test",exit; 
							}else{  
								$status = $msgError;$otpCode = '';
								$this->userActivityLog($user_id,$username,$otpCode,$status); 
								$res['errmsg'] =  $data['errmsg'] =  $msgError;
							}       
							//$res['redirect'] =   6 ;//'otp.php';
						}else{
							$status = 'Mobile number not found';$otpCode = '';
							$this->userActivityLog($user_id,$username,$otpCode,$status); 
							$res['errmsg'] =  $data['errmsg'] = "Please update your OTP mobile number to send OTP";
						} 

						
					} else {
					$status = 'Login Successfully';$otpCode = '';
					$this->userActivityLog($user_id,$username,$otpCode,$status);  
					 $this->user_model->updateLoginTime($user_id);
					//$this->session->sess_destroy();
					 $this->session->sess_create();
					//$this->session->set_userdata($sessionData);  
					$this->session->set_userdata('username',$sessionData['username']);
					$this->session->set_userdata('first_name',$sessionData['first_name']);
					$this->session->set_userdata('user_id',$sessionData['user_id']);
					$this->session->set_userdata('template_check',$sessionData['template_check']);
					$this->session->set_userdata('ndnc_return',$sessionData['ndnc_return']);
					$this->session->set_userdata('no_ndnc',$sessionData['no_ndnc']);
					$this->session->set_userdata('dnd_check',$sessionData['dnd_check']);
					$this->session->set_userdata('dlr_enabled',$sessionData['dlr_enabled']);
					$this->session->set_userdata('is_reseller',$sessionData['is_reseller']); 
					$this->session->set_userdata('is_longcode',$sessionData['is_longcode']);
					$this->session->set_userdata('is_missedcall',$sessionData['is_missedcall']);

    

					//if($user_id == 2917) { print_r($this->session->all_userdata());exit;}

										
						$user_id=$this->session->userdata('user_id'); 
						if(   $this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
							  $res['redirect'] =  'index.php/ftpcampaign/viewcampaigns';
 							//$res['redirect'] =  5;//'ftpcampaign/viewcampaigns';
						}else{
						  

						$sql3="update  order_numbers set  status=0 where status=1 and user_id=$user_id";
						$this->db->query($sql3);
						$sql3="update  longcode_tmp set  status=0 where status=1 and user_id=$user_id";
						$this->db->query($sql3);
 
		                  
					$userarray=array(3907,3958,4065,4066,4084);
					if(in_array($result->user_id,$userarray))
					{
				$res['redirect'] = 'index.php/missedcall/messages';
					//$res['redirect'] = 4;//'missedcall/messages';
					}
					else
					{


						//if($profile['mverify']==0)
						if($result->mverify==0)
						{
						$res['redirect'] =  'index.php/myaccount/index';
						//$res['redirect'] = 3; //'myaccount/index';
						}
						else
						{

 							//redirect('campaign/normalSMS');
							$userexist=$this->user_model->getPriceTableuser($result->user_id);
							if(count($userexist)>0)
							{
								  $paymentstatus=$this->user_model->getpaymentstatus($result->user_id);
								if(count($paymentstatus)>0)
								{
													
								//redirect('Payment/paynow');
								 $res['redirect'] = 'index.php/products/index';  
 								//$res['redirect'] =  2 ;//'products/index';
 
								}  
								else
								{
							    	 $res['redirect'] = 'index.php/campaign/normalSMS';
									// $res['redirect'] = 1;//'campaign/normalSMS';
								}
							}
							else
							{
						    	 $res['redirect'] =  'index.php/campaign/normalSMS';
 									//$res['redirect'] = 1;//'campaign/normalSMS';
							}
						}
					}
				    } 
				} 
				
				}
				else
				{
					$status = 'login - User Has Been Blocked';$otpCode = '';
					$this->userActivityLog($user_id,$username,$otpCode,$status);
					$res['errmsg'] = $data['errmsg'] = "User Has Been Blocked. Please Contact Administrator.";				
				
				}
				
				
			
			}
			else
			{
				$status = 'Invalid User Details';$otpCode = '';$user_id = 0;
					$this->userActivityLog($user_id,$username,$otpCode,$status);
				$res['errmsg'] =  $data['errmsg'] = "Invalid User Details";
			
			}
		} else{
			  $status = 'Invalid User Details';$otpCode = '';$user_id = 0;
					$this->userActivityLog($user_id,$username,$otpCode,$status);	
			$res['errmsg'] =   $data['errmsg']="Invalid User Details ";
			
		  }	
	
		}  
		  else{
			  
			$res['errmsg'] =   $data['errmsg']="Invalid Captcha ";
			
		  }
				 // if($user_id == 2917) {  echo json_encode($res);exit;}
		  	//$this->load->view('index/login',$data);
		    echo json_encode($res); exit;
		  
		  
		  
	}
	

	
	public function loginold()
	{
		redirect(base_url());
		 
	}


	
public function loginotp()
{	
		
$data['otp'] = "OTP Password";

	
	$this->load->view('/includes/header_new_n',$data);
	$this->load->view('index_new/loginotp');
	$this->load->view('/includes/footer_new_index_n');
	
	
	
}	
public function otp()
{


$this->load->view('/index_new/otp');

}
public function codeotp()
{
   $data['page_title'] = "codeotp";
		
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/codeotp.html";
	$data['end']=$this->session->userdata('end');
	$this->load->view('includes/header_new',$data);
	$this->load->view('includes/menu_new');
	$this->load->view('index_new/codeotp');
	$this->load->view('includes/footer_new');
}
	public function thanku()
	{
		$this->load->view('thanku');	
	}
	
	public function forgot()
	{
		$data['page_title'] = "Forgot Password";
				$data['canonical'] = "http://www.smsstriker.com/forgot.html";
		if ($this->input->post('forgot_password')) {
			$this->load->library('form_validation');
			if ($this->form_validation->run('forgot_form') == TRUE) {
				$this->load->model('User_model');
	$rs = $this->User_model->usernameExist();

				if($rs) {
					foreach($rs as $result) 
					{
						$user_id = $result->user_id;
						$email = $result->email;
						$firstName = $result->first_name;
						$username = $result->username;
                        $mobile = $result->mobile;
					}
 
	$userarray=array(647,4130,4131);
if(in_array($user_id,$userarray))  
{
$data['not_exist'] = "Your Password not sent!. Please Contact Administrator";
}else{
		
					$new_password = rand(100000,999999);
					$this->User_model->setNewPassword($user_id, $new_password);

                    //send sms
                    $sms_text = "Your SMS Striker's User Id : $username ,New Password is: $new_password. - Support, ".$_SERVER['SERVER_NAME'];
                    $sms_url = "http://www.rkadvertisings.com/API/sms.php?username=support&password=Str!k3r2020&from=STRIKR&to=$mobile&msg=".urlencode($sms_text)."&type=1";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $sms_url);
                    curl_setopt($ch, CURLOPT_header_new, 0);
                    curl_exec($ch);
                    curl_close($ch);

                    //send email
                    
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
					<p>Dear Customer,</p> 
					<br> 
					<p>Greetings from Striker !</p> 
					<br> 
					<p>This is to inform you that your password for the <strong>User ID </strong> : '.$username.' at Striker has been reset successfully. Please keep your login credentials confidentially.</p> 
					<br> 
					<p><strong>User Name </strong>:'.$username.' </p>
					<p><strong>Password </strong>: '.$new_password.'</p>

					<p>Link: <a href="http://www.smsstriker.com/login.html">http://www.smsstriker.com</a></p> 
					<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p> 
					<p>For adding credits and Finance related, please contact to <a href="mailto:accounts@smsstriker.com" target="_top">accounts@smsstriker.com&#59;</a> 040&#45;79417712.</p> 
					<br> 
					<p>For providing your feedback, please click the URL : <a href="http://www.smsstriker.com/users_feedback.html">http://www.smsstriker.com </a></p> 
					 <p>Thanks for being our valid customer....Have a great day ahead.....</p> 
					<p><b>Best Regards&#44;</b></p><br> 
					<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
					<div> 
					<img src="http://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
					</div> 
					<div class="signature"> 
					<p><b>Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
					<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
					<p><b>Hightech City| Hyderabad &#45; 81 |</b></p> 
					<p><b>Mobile: +91 9966507711| Ph : 040&#45;64547711|</b></p> 
					</div> 
					</div> 
					</div> 
					 </body> 
					     
					</html>'; 
					$this->load->library('email');
					$SMTPOptions = array('ssl' => array(  'allow_self_signed' => true ));
					$subject = "New Password has been Issued";
					$this->email->initialize(array(
					'protocol' => $SMTPOptions,
		'smtp_host' => 'mail.office24by7.in',
		'smtp_user' => 'app@office24by7.in',
		'smtp_pass' => 'Str!ker@123',
		'smtp_port' => 465,
					'wordwrap' => TRUE,
					'charset' => 'iso-8859-1',
					'mailtype' => 'html',
					'crlf' => "\r\n",
					'newline' => "\r\n"
					));
				
					 $this->email->from('support@smsstriker.com', 'Support Team');
					$this->email->to($email);	
					$this->email->subject($subject);
					$this->email->message($email_msg);
					$this->email->send();
					//echo $this->email->print_debugger();
					
					redirect('forgot/issued/'.base64_encode($email));
}
				} else 
				{
					$data['not_exist'] = "Specified Username Not Exist";
				}

				
			}
			
		}
		if($this->uri->segment(2))
		{
			$email = base64_decode($this->uri->segment(3));
		$str=explode('@',$email);
			$strrep= substr($str[0],0,3);
			$cnt=strlen($str[0])-strlen($strrep);
			
			switch ($cnt) {
    case 1:$mask='x';
       
        break;
    case 2:$mask='xx';
        break;
     case 3:$mask='xxx';
	break;
	  case 4:$mask='xxxx';
	break;
	  case 5:$mask='xxxxx';
	break;
	  case 6:$mask='xxxxxx';
	break;
	  case 7:$mask='xxxxxxx';
	break;
	  case 8:$mask='xxxxxxxx';
	break;
	  case 9:$mask='xxxxxxxxx';
	break;
    default:$mask='xxxxxxxxxx';
	}
			$email=$strrep.$mask.'@'.$str[1];

			$data['issued'] = "New Password Has Been Sent To Your Mail Address <a> {$email} </a>";
		}
	
			$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		        $this->load->view('includes/header_new',$data);
				$this->load->view('includes/menu_new');
				$this->load->view('index_new/login');
				$this->load->view('includes/footer_new');
	}
	  
	 
	

	public function logout()
	{


	
	   // $this->load->library('session');
		
		/**** remove order number start***/
		$user_id=$this->session->userdata('user_id');

		$sql3="update  order_numbers set  status=0 where status=1 and user_id=$user_id";
		$this->db->query($sql3);
		$sql3="update  longcode_tmp set  status=0 where status=1 and user_id=$user_id";
		$this->db->query($sql3);
		/**** remove order number end***/
		 
		 $this->session->unset_userdata('session_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_id'); 

		$this->session->unset_userdata('ip_address');
		$this->session->unset_userdata('user_agent');
		$this->session->unset_userdata('last_activity'); 

		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('no_ndnc');
		$this->session->unset_userdata('dnd_check'); 

		$this->session->unset_userdata('dlr_enabled');
		$this->session->unset_userdata('is_reseller');
		$this->session->unset_userdata('ndnc_return'); 

		$this->session->unset_userdata('template_check');
		$this->session->unset_userdata('is_longcode');
		$this->session->unset_userdata('is_missedcall'); 
		$this->session->sess_destroy();
	/*if($user_id==2917)
	{
	echo "test";
	exit;
	}*/
			$redirect = base_url().'login.html';

		redirect($redirect);  
 
 
	}	
			
	/*
	public function voice()
	{
			$data['page_title'] = "Bulk SMS & Voice Service Provider - India | SMS Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['is_bloked'] = false;
		$data['invalid'] = false;
		$data['page_title'] = "Welcome RK Advertisings :: Voice Services";
		$data['canonical'] = "http://www.smsstriker.com/voice-service.html";
		$this->load->view('/includes/header_new',$data);
		if($this->session->userdata('user_id')) { 
			$this->load->view('/includes/menu_new');
		}
		$this->load->view('voice');
		$this->load->view('/includes/footer_new');
	}
	
	public function pricing_old()
	{
		$data['is_bloked'] = false;
		$data['invalid'] = false;
		$data['page_title'] = "Welcome RK Advertisings :: Pricing";
			$data['canonical'] = "http://www.smsstriker.com/pricing.html";
		$this->load->view('/includes/header_new',$data);
		if($this->session->userdata('user_id')) { 
			$this->load->view('/includes/menu_new');
		}
		$this->load->view('pricing_old');
		$this->load->view('/includes/footer_new');
	}
	
	public function ourClients()
	{
		$data['is_bloked'] = false;
		$data['invalid'] = false;
		$data['page_title'] = "Welcome RK Advertisings :: Our Clients";
			$data['canonical'] = "http://www.smsstriker.com/verticals.html";
		$this->load->view('/includes/header_new',$data);
		if($this->session->userdata('user_id')) { 
			$this->load->view('/includes/menu_new');
		}
		$this->load->view('our_clients');
		$this->load->view('/includes/footer_new');
	}
	
	
	
	public function complaintBox()
	{
        if(!$this->session->userdata('user_id')) {
            redirect('index/login');
        }

		$data['page_title'] = "Complaint Box";
		$data['canonical'] = "http://www.smsstriker.com/index.html";
		$data['available_credits'] = $this->_credits;
		
		if($this->uri->segment(3) == "thankyou") {
			$data['msg'] = "Thank you for contacting support Team, will contact you with in 24 hours";
		}
		
		if ($this->input->post('submit')) {
			
			$this->load->library('form_validation');
			if ($this->form_validation->run('complaint_form') == TRUE) {
				
				$complaint_type = $this->input->post('issue_type');
				$number = $this->input->post('contact_number');
				$title = $this->input->post('title');
				$text = $this->input->post('complaint_text');
				
				$email_msg = "
				    <p>UserName: ".$this->session->userdata('username')."</p>
				    <p>To: {$complaint_type} </p>
					<p>From: {$number} </p>
					<p>Title: ".$title." </p>
					<p align='justify'> ".$text."</p>";
				
				$subject = "For: ".$complaint_type." - ".$title;
				$this->load->library('email');
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('complaints@smsstriker.com', 'Complaint box');
			    $this->email->to(array('bharath@smsstriker.com','pasula.naveenkumar@gmail.com','santosh@smsstriker.com'));
				$this->email->subject($subject);
				$this->email->message($email_msg);
				$this->email->send();
				redirect('index/complaintBox/thankyou');				
			}	
		}
		
		$this->load->view('/includes/header_new',$data);		
		$this->load->view('/index/complaint_box');
		$this->load->view('/includes/footer_new');		
		
	}
	public function bulksms()
       {

		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/bulksms');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
		
       }
	public function smsapi()
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/smsapi');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function longcodesms()
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
				$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/longcodesms');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	    public function ivr_intractive_voice_responsivesystem()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
				$data['canonical'] = "http://www.smsstriker.com/ivrs.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/ivr_intractive_voice_responsivesystem');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       } 
	    public function hosted_ivr()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
					$data['canonical'] = "http://www.smsstriker.com/hosted-ivr.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/hosted_ivr');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function tollfree_number()
      
       {  
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
			$data['canonical'] = "http://www.smsstriker.com/tollfree-number.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/tollfree_number');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function cloud_voice()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/cloud-voice.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/cloud_voice');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	    public function missed_call_services()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/missed-call-services.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/missed_call_services');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function hosted_ivr_services_solution_provider()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/hosted-ivr.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/hosted_ivr_services_solution_provider');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function missedcallalerts()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/missed-call-services.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/missedcallalerts');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	    
	   public function cloudvoice()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/cloud-voice.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/cloudvoice');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function voice_conferencing()
      
       { 
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/voice-conferencing.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/voice_conferencing');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function search_engine_optmization()
      
       {  
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/search-engine-optmization.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/search_engine_optmization');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   
	   public function tollfree()
      
       {  
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/tollfree-number.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/tollfree');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }


 public function search_engine_marketing()
      
       {  
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/search-engine-marketing.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/search_engine_marketing');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }



       public function social_media_marketing()
      
       {  
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/social-media-marketing.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/social_media_marketing');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	public function enquire_form() 
	{
		
		if ($this->input->post('enqui_form')) {
		
		
			
			$this->load->library('form_validation');
			
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$phone_no = $this->input->post('phone_no');
				
				$enquire = "smsstriker Enquire ";
				  $email_msg = "
				    <p>Name: {$name}</p>
				    <p>Email: {$email} </p>
					<p>Mobile No: {$phone_no} </p>";
		
				
				$this->load->library('email');
					$subject = "For: ".$enquire." - ".$name;
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
				
					 $this->email->from($email);
					$this->email->to('support@smsstriker.com','info@adfruitsdigital.com');	
					$this->email->subject($subject);
					$this->email->message($email_msg);
					$this->email->send();
				//echo $this->email->print_debugger();
				echo "<script> alert('Thank You For Contact Us.We Will Get Back To You Shortly.');</script>";
				
				echo "<script>  window.location='http://www.smsstriker.com'</script>";
				//redirect('index_new/index');				
			
		}

	

	}


public function newsletter()
	{
			$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		
		$data['page_title'] = "newsletter";
	$data['canonical'] = "http://www.smsstriker.com/newsletter.html";
		if ($this->input->post('news_letter')) {
				$this->load->model('User_model');
				if(!$this->User_model->usernameExist_newsletter()) {
					$this->User_model->newsletter_register();
					//redirect('login');
	  //$data['sucess1'] = "User Registration Successfully";
	      } else 
				{
					$data['userExistnew'] = "User already exist with the same Name And Emailid";
				}
			
		}
		  
	$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/index');
		$this->load->view('includes/footer_new');

	
	}
	
	
	public function users_feedback()
	{

	  //date_default_timezone_set('asia/calcutta');
			$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/users-feedback.html";
		$data['page_title'] = "Feed Back";
		
		if ($this->input->post('feedback')) {
				$contact_number = $this->input->post('contact_number');
				$name = $this->input->post('name');
				$contact_email = $this->input->post('contact_email');
				$contact_subject = $this->input->post('contact_subject');
				$comment = $this->input->post('comment');
				//$this->load->model('User_model');
				//$this->User_model->feedback($contact_number,$name,$contact_email,$contact_subject,$comment);
				$enquire = "smsstriker feedback ";
				        $email_msg = "
					<p>Name: {$name}</p>
					<p>Email: {$contact_email} </p>
					<p>Subject: {$contact_subject} </p>
					<p>Comment: {$comment} </p>
					<p>Mobile No: {$contact_number} </p>";
				        $subject = "For: ".$enquire." - ".$name;
				        
				        
				        
				        
				        $this->load->library('email');
					$subject = "Customer FeedBack Details";
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
				
					 $this->email->from($contact_email, $name);
					$this->email->to(array('bharath@smsstriker.com','naveen@smsstriker.com'));
					$this->email->subject($subject);
					$this->email->message($email_msg);
					$this->email->send();
				        
				 
					

				echo "<script> alert('Thank You For Contact Us.We Will Get Back To You Shortly.');</script>";
				echo "<script>  window.location='http://www.smsstriker.com'</script>";
							
					
			
		}
		
		  
	        $this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/feedback');
		//$this->load->view('includes/footer_new');

	
	}
	public function long_code_sms()
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/long_code_sms');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	   public function ivrs()
      
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/ivrs.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/ivrs');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       } 
	  public function sms_api()
       {
		$data['page_title'] = "Enterprise Messaging – For Individuals and Corporates | smsstriker.com";
		$data['page_meta_des'] = "We provide Bulk Sms, Flash Sms, Sms Api'S, Customized Sms, Long Code Sms, 2-Way Sms and evolving the needs of next-gen messaging technologies.";
		$data['page_meta_key'] = "Bulk Sms, Flash Sms, Sms Api'S, Long Code Sms, 2-Way Sms";
		$data['canonical'] = "http://www.smsstriker.com/bulk-sms.html";
		$this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/sms_api');
		//$this->load->view('index_new/Eq_form');
		$this->load->view('includes/footer_new');
       }
	
	// college feedback form
	
	public function college_enquiryform()
	{


			$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";
		$data['canonical'] = "http://www.smsstriker.com/college-enquiryform.html";
		$data['page_title'] = "Feed Back";
		
		if ($this->input->post('college_enquireform')) {
				$contact_number = $this->input->post('contact_number');
				$name = $this->input->post('name');
				$address = $this->input->post('address');
				$courses = $this->input->post('courses');
				$comment = $this->input->post('comment');
				$this->load->model('User_model');
				$this->User_model->college_enquireform($contact_number,$name,$address,$courses,$comment);
				
				
				$message ="Thank you for your interest. Our executive will contact you soon";
				$user="support"; //your username
				$password="Str!k3r2020"; //your password
				$senderid="STRIKR"; //Your senderid


				 $this->call_sms_api($user, $password,$message,$contact_number, $senderid, $messagetype=1);
				
				
				
				
				/*$enquire = "smsstriker feedback ";
				        $email_msg = "

					<p>Name: {$name}</p>
					<p>Email: {$contact_email} </p>
					<p>Subject: {$contact_subject} </p>
					<p>Comment: {$comment} </p>

					<p>Mobile No: {$contact_number} </p>";
				        $subject = "For: ".$enquire." - ".$name;

					$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.sendgrid.net',
					'smtp_port' => 587,
					'smtp_user' => 'smsstriker',
					'smtp_pass' => 'striker@123',
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
					);
					$this->load->library('email', $config);
					$this->email->from($contact_email,'smsstriker');
				
				$this->email->to(array('sivap455@gmail.com','sivapenki@gmail.com'));
				$this->email->subject($subject);
				$this->email->message($email_msg);
				$this->email->send();
                               echo $this->email->print_debugger();
				echo "<script> alert('Thank You For Contact Us.We Will Get Back To You Shortly.');</script>";
				echo "<script>  window.location='http://www.smsstriker.com'</script>";
							
					
			
		}
		
		  
	        $this->load->view('includes/header_new',$data);
		$this->load->view('includes/menu_new');
		$this->load->view('index_new/college_form');
		//$this->load->view('includes/footer_new');

	
	}  
	  
	
	 public function call_sms_api($user, $password,$message,$contact_number, $senderid, $messagetype=1){
				$api = "http://www.smsstriker.com/API/sms.php?";
				$api .= "username=$user&";
				$api .= "password=$password&";
				$api .= "to=".$contact_number."&";
				$api .= "msg=".urlencode($message)."&";
				$api .= "from=".$senderid."&";
				$api .= "type=".$messagetype;
				
				return file_get_contents($api);
				}

*/
      
  
	public function checkCouponValidity() {  
		$this->load->model('user_model');
		$user_id=$this->session->userdata('user_id');
		$couponCode = $this->input->post('coupon');  
	 	$response = $this->user_model->checkCoupon($couponCode,$user_id);  
		echo json_encode($response);
 
 	   
	}  

	public function striker_reseller(){
 
		redirect(base_url());
	}
	
	public function whystriker() {
		redirect(base_url());
	} 
	
       public function sms_api()
       {
		redirect(base_url());
       } 

	function generatePassword($l = 8, $c = 0, $n = 8, $s = 0) {
	   // get count of all required minimum special chars
	   $count = $c + $n + $s;
	 
	   // sanitize inputs; should be self-explanatory
	   if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
	      trigger_error('Argument(s) not an integer', E_USER_WARNING);
	      return false;
	   }
	   elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
	      trigger_error('Argument(s) out of range', E_USER_WARNING);
	      return false;
	   }
	   elseif($c > $l) {
	      trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
	      return false;
	   }  
	   elseif($n > $l) {
	      trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
	      return false;
	   }
	   elseif($s > $l) {
	      trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
	      return false;
	   }
	   elseif($count > $l) {
	      trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
	      return false;
	   }
	 
	   // all inputs clean, proceed to build password
	 
	   // change these strings if you want to include or exclude possible password characters
	   $chars = "abcdefghijklmnopqrstuvwxyz";
	   $caps = strtoupper($chars);
	   $nums = "0123456789";
	   $syms = "!@#%^&*$?";
	   $out = '';
	   // build the base password of all lower-case letters
	   for($i = 0; $i < $l; $i++) {
	      $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	   }
	 
	   // create arrays if special character(s) required
	   if($count) {
	      // split base password to array; create special chars array
	      $tmp1 = str_split($out);
	      $tmp2 = array();
	 
	      // add required special character(s) to second array
	      for($i = 0; $i < $c; $i++) {
		 array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
	      }
	      for($i = 0; $i < $n; $i++) {
		 array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
	      }
	      for($i = 0; $i < $s; $i++) {
		 array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
	      }
	 
	      // hack off a chunk of the base password array that's as big as the special chars array
	      $tmp1 = array_slice($tmp1, 0, $l - $count);
	      // merge special character(s) array with base password array
	      $tmp1 = array_merge($tmp1, $tmp2);
	      // mix the characters up
	      shuffle($tmp1);
	      // convert to string for output
	      $out = implode('', $tmp1);
	   }
	 
	   return $out;  
	}

	 public function sendOTP($mobile,$otp,$name) {
	       $user="support";    
		$password="Str!k3r2020"; 
 
		$message = "Dear $name,Your OTP Code is : $otp";
 
		$messagetype="1";  
  
      
		$message = urlencode($message);   
		 $senderid="STRIKR";    
  
 
	        $url = "https://www.smsstriker.com/API/sms.php?username=$user&password=$password&from=$senderid&to=$mobile&msg=$message";
	      $res = file_get_contents($url); 
 
  	  
           }
  
	 public function userActivityLog($userID,$userName,$otpCode,$status) {
 
		$this->load->model('user_model'); 
		$ipAddress = getenv('HTTP_X_FORWARDED_FOR') ?: getenv('REMOTE_ADDR'); 
		//$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ipAddress));
		//if($query && $query['status'] == 'success')
 		//{  
			$this->user_model->addUserActivity($userID,$userName,$otpCode,$status,$ipAddress);
			//  $this->user_model->addUserActivity($query,$userID,$userName,$otpCode,$status);
		//}
	}		
	
}
