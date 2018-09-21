<?php
class SMS extends CI_Controller
{
	protected $_credits;
	protected $_servicetax;
	protected $_smsprice;
	protected $_longcode;
	
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
$this->_data['shorturlCredits'] = $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
	        }
	        
		$gbl_rs = $this->User_model->global_settings();
	        foreach ($gbl_rs as $key=>$gblrs) {
	       // print_r($gblrs);
	        if($gblrs->setting_name=='Service Tax')
	        {
	        $this->_servicetax = $gblrs->value;
	        }
	        
	        if($gblrs->setting_name=='smspricevalue')
	        {
	        $this->_smsprice = $gblrs->value;
	        }
	        
	        if($gblrs->setting_name=='longcode')
	        {
	        $this->_longcode = $gblrs->value;
	        }
	        	
	        }
        }
	}
	public function pricelist()
	{
    
		$this->load->model('sms_model');
		$user_id=$this->session->userdata('user_id');
		  $sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
	//	exit;
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
		$this->_data['getsmspricelist']=$this->sms_model->getsmspricelist();
		$this->_data['tax']=$this->_servicetax;
		$this->_data['smsprice']=$this->_smsprice;
		$this->_data['available_credits']=$this->_credits;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//$this->load->view('payments/confirm_order',$this->_data);
		$this->load->view('sms/sms_pricelist',$this->_data);
		//$this->load->view('campaign/messages');
		$this->load->view('/includes/footer');
	}
	
public function paynow()
	{
	     $this->load->model('sms_model');
	    $userId = $this->session->userdata('user_id');
		$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile,first_name,last_name FROM users u WHERE u.user_id = $userId";
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
			$usertypecol="semitrans";
			}

		    //$name=$value->username;
                    $name=$value->first_name." ".$value->last_name;
		    $email=$value->email;
		    $mobile=$value->mobile;
			
		}
	     $otpverify='1';
	    if($this->uri->segment(3)!='')
	    {
			if($this->uri->segment(3)!='')
			{
			$id=$this->uri->segment(3);
			$priceinfo=$this->sms_model->getsmspricerange($id);
				foreach ($priceinfo as $key=>$value)
				{
				
					if($value->pkg_range=="10 Lakh above")
					{
						$noofsms='1000000';
					}
					else 
					{
						$rs=explode("-","$value->pkg_range");
						$noofsms=$rs[1];
					}
				
				}
			}
			$rs=$this->sms_model->insertLeadDetails($noofsms,$usertype,$userId,$name,$email,$mobile,$otpverify);
			if($rs)
			{
			redirect('products/index');
			}
			else
			{
			redirect('sms/pricelist');
			}
	    }
	    
	    $this->_data['smstype']=$smstype;
        $this->_data['tax']=$this->_servicetax;
        $this->_data['smsprice']=$this->_smsprice;
        $this->_data['available_credits']=$this->_credits;
        $this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//$this->load->view('payments/confirm_order',$this->_data);
		 $this->load->view('sms/sms_pricelist',$this->_data);
		//$this->load->view('campaign/messages');
		$this->load->view('/includes/footer');
	}
}
