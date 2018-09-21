<?php
class newpages extends CI_Controller
{
	protected $_credits;
	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		redirect('index_new/index');
	}
	public function about()
	{		
		redirect('index_new/about');
	}
	public function team()
	{		
		redirect('index_new/team');
	}
	public function infrastructure()
	{		
		redirect('index_new/infrastructure');
	}
	public function business_verticals()
	{		
		redirect('index_new/verticals');
	}
	public function bulksms()
	{		
		redirect('index_new/sms_service');
	}
	public function enterprisemessaging()
	{		
	redirect('index_new/sms_service');
	}
	public function flashsms()
	{		
		redirect('index_new/sms_service');
	}
	public function smsgateway()
	{		
		redirect('index_new/sms_service');
	}
	public function smsapi()
	{		
	    redirect('index_new/sms_service');
	}
	public function smsspiintegration()
	{		
		redirect('index_new/sms_service');
	}
	public function customizedsms()
	{		
		redirect('index_new/sms_service');
	}
	public function longcode_sms()
	{		
		redirect('index_new/sms_service');
	}
	public function shortcode_sms()
	{		
		redirect('index_new/sms_service');
	}
	public function waysms()
	{		
		redirect('index_new/sms_service');
	}
	public function bulkoutbound()
	{
		redirect('index_new/voice_service');
	}
	public function bulkinbound()
	{
		redirect('index_new/voice_service');
	}
	public function ivrs()
	{
		redirect('index_new/voice_service');
	}
	public function enterpriseivr()
	{
		redirect('index_new/voice_service');
	}
	public function missedcallalerts()
	{
		redirect('index_new/voice_service');
	}
	public function voicesmslongcode()
	{
		redirect('index_new/voice_service');
	}
	
	public function voiceapplication()
	{
		redirect('index_new/voice_service');
	}
	public function cloudvoice()
	{
		redirect('index_new/voice_service');
	}
	public function tollfree()
	{
		redirect('index_new/voice_service');
	}
	public function voiceconference()
	{
		redirect('index_new/voice_service');
	}
	/*public function reseller()
	{
		redirect('index_new/reseller');
	}*/
	public function whystriker()
	{
		redirect('index_new/whystriker');
	}
	public function contactus()
	{
		redirect('index_new/contact');
	}
	public function bulkemail()
	{
		redirect('index_new/digital_marketing');
	}
	public function emailtosms()
	{
		redirect('index_new/digital_marketing');
	}
	public function smstoemail()
	{
		redirect('index_new/digital_marketing');
	}
	public function reprots()
	{
		redirect('index_new/digital_marketing');
	}
	public function enquery()
	{
		redirect('index_new/contact');
	}
}