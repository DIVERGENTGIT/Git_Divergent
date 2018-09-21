<?php
Class myaccount extends CI_Controller
{
	protected $_userId;
	
	protected $_username;
	
	protected $_no_ndnc;
	
	protected $_is_dlr_enabled;
	
	protected $_credits;
	
	protected $_international_credits;
	
	protected $_sms_port;
	
	protected $_data = array();
	
	public function __construct()
	{    
		parent::__construct();    
		 $this->load->library('session');
		 
		$this->_userId = $this->session->userdata('user_id'); 
		if(!$this->_userId)   { 
		  	redirect(base_url()); 
		}   
			
		if($this->_userId ==  4857  || $this->_userId ==  4904 )   {

			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
        
 
        $this->_username = $this->session->userdata('first_name');
        $this->_no_ndnc = $this->session->userdata('no_ndnc');
        $this->_is_dlr_enabled = $this->session->userdata('dlr_enabled');
        
        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) {
        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        } 

        $this->_data['available_credits'] = $this->_credits;
	}
	
		
public function codeotp_mverify()
{

    	$profile = array();
	 $profile_data =$this->User_model->getUserDetails($this->_userId);  
	foreach($profile_data as $row)
	{
		$profile['user_id']= $row->user_id;
		$profile['username']=$row->username;
		$profile['first_name']=$row->first_name;
		$profile['last_name']=$row->last_name;
		$profile['email']=$row->email;
		$profile['mobile']=$row->mobile;
		$profile['mobileno_org']=$row->mobileno_org;
		$profile['organization']=$row->organization;
		$profile['no_ndnc']=$row->no_ndnc;
		$profile['available_credits']=$row->available_credits;
		$profile['address1']=$row->address1;
		$profile['address2']=$row->address2;
		$profile['state_id']=$row->state_id;
		$profile['city_id']=$row->city_id;
		$profile['login_time']=$row->login_time;
		$profile['template_check']=$row->template_check;
		$profile['registered_on']=$row->registered_on;
		$profile['mverify']=$row->mverify;
		$profile['dnd_check']=$row->dnd_check;
		$profile['zipcode']=$row->zipcode;  

	}   
        $this->_data['profile'] = $profile;    
	$data['end']=$this->session->userdata('end');
	$this->load->view('includes/header',$this->_data);  
 	if($profile['mverify'] == 0):
		$this->load->view('includes/leftmenu_otp');
	
	else:  
		$this->load->view('includes/leftmenu');

	endif;   
	$this->load->view('myaccount/codeotp_mverify');
	$this->load->view('includes/footer');
}  

public function myprice()
{
	$data['end']=$this->session->userdata('end');
	$profile = array();
	$profile_data =$this->User_model->getUserDetails($this->_userId);  
	foreach($profile_data as $row)
	{
		$profile['user_id']= $row->user_id;
		$profile['username']=$row->username;
		$profile['first_name']=$row->first_name;
		$profile['last_name']=$row->last_name;
		$profile['email']=$row->email;
		$profile['mobile']=$row->mobile;
		$profile['mobileno_org']=$row->mobileno_org;
		$profile['organization']=$row->organization;
		$profile['no_ndnc']=$row->no_ndnc;
		$profile['available_credits']=$row->available_credits;
		$profile['address1']=$row->address1;
		$profile['address2']=$row->address2;
		$profile['state_id']=$row->state_id;
		$profile['city_id']=$row->city_id;
		$profile['login_time']=$row->login_time;
		$profile['template_check']=$row->template_check;
		$profile['registered_on']=$row->registered_on;
		$profile['mverify']=$row->mverify;
		$profile['dnd_check']=$row->dnd_check;
		$profile['zipcode']=$row->zipcode;  

	}     
	$this->_data['profile'] = $profile;
	$this->load->view('includes/header',$this->_data);
	if($profile['mverify'] == 0):
		$this->load->view('includes/leftmenu_otp');
	
	else:  
		$this->load->view('includes/leftmenu');

	endif;   
  

	//$this->load->view('includes/leftmenu');
	$this->load->view('myaccount/myprice');
	$this->load->view('includes/footer');
}

public function editmyprofile()
{

    $this->_data['userid'] =$this->_userId;
    
     	$profile = array();
	 $profile_data =$this->User_model->getUserDetails($this->_userId);  
	foreach($profile_data as $row)
	{
		$profile['user_id']= $row->user_id;
		$profile['username']=$row->username;
		$profile['first_name']=$row->first_name;
		$profile['last_name']=$row->last_name;
		$profile['email']=$row->email;
		$profile['mobile']=$row->mobile;
		$profile['otpMobileNo']=$row->otpMobileNo;
		$profile['mobileno_org']=$row->mobileno_org;
		$profile['organization']=$row->organization;
		$profile['no_ndnc']=$row->no_ndnc;
		$profile['available_credits']=$row->available_credits;
		$profile['address1']=$row->address1;
		$profile['address2']=$row->address2;
		$profile['state_id']=$row->state_id;
		$profile['city_id']=$row->city_id;  
		$profile['login_time']=$row->login_time;
		$profile['template_check']=$row->template_check;
		$profile['registered_on']=$row->registered_on;
		$profile['mverify']=$row->mverify;
		$profile['dnd_check']=$row->dnd_check;
		$profile['zipcode']=$row->zipcode;

	}     

        $this->_data['profile'] = $profile; 
      if(@$_POST['edituser']=='Submit')
      {
      extract($_POST);
      $user_id=$this->_userId;
      $sql="update users set first_name='$first_name',last_name='$last_name',email='$email',mobile='$mobile',otpMobileNo='$otpmobileno',
      organization='$organization',address1='$address1',address2='$address2',state_id='$state',city_id='$city',zipcode='$pincode'
      where user_id=$user_id";
      $this->db->query($sql);
      
      $this->session->set_flashdata('success_message', 'Your Profile updated successfully.');
      
     	 redirect("myaccount/index");
      }
	$this->load->view('includes/header',$this->_data);
	if($profile['mverify'] == 0):
			$this->load->view('includes/leftmenu_otp');
		
		else:
				$this->load->view('includes/leftmenu');

		endif;  
	//$this->load->view('includes/leftmenu');	
	$this->load->view('myaccount/myprofile_edit');
	$this->load->view('includes/footer');
}


	public function index()
	{
 
		$this->_data['page_title'] = "My Profile";
		$this->load->model('User_model');
		
 
		

     	if(!empty($_REQUEST['submit'])){
	
	
$this->load->database();

if(!empty($_FILES['userfile']['name'])):
$uploaddir = "profile_img/";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
 $image_name = $_FILES['userfile']['name']; //file name
 if ($_FILES["userfile"]["size"] > 20480) {
   $this->_data['file_error']= "Sorry, your file is too large.";
    $uploadOk = 0;
	 
}else
 {
	if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
       
		$profileimg=$_FILES["userfile"]["name"];
		
$query = $this->db->query('SELECT profile_img FROM profile_images where user_id='.$this->_userId.' order by id desc LIMIT 1');
$profile = $query->row();
if(empty($profile)):
		$sql = "INSERT INTO profile_images (profile_img,user_id) 
        VALUES (".$this->db->escape($profileimg).",".$this->_userId.")";
		$this->db->query($sql);
else:

		$sql = "UPDATE `profile_images` SET `profile_img`=".$this->db->escape($profileimg)." WHERE `user_id`=".$this->_userId."";
		$this->db->query($sql);
endif;		
	
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
		endif;

}



$query = $this->db->query("SELECT profile_img,profile_backgroundimg FROM profile_images where user_id='".$this->_userId."' order by id desc LIMIT 1");
$row = $query->row();
 
 
if(!empty($row)):
 $this->_data['profileimg']= $row->profile_img;
 $this->_data['profile_backgroundimg']= $row->profile_backgroundimg;
 endif;
 
		$profile=array();
		$profile_data=$this->User_model->getUserDetails($this->_userId);

		if($profile_data)
     	{
			
			
				if ($this->input->post('edit')) {
					
 
 
					$this->User_model->editUserDetails($this->_userId);
 
					redirect('myaccount/index/edited');					
				
				}
     		foreach($profile_data as $row)
		    {
		     	$profile['user_id']= $row->user_id;
		     	$profile['username']=$row->username;
		     	$profile['first_name']=$row->first_name;
		     	$profile['last_name']=$row->last_name;
		     	$profile['email']=$row->email;
		     	$profile['mobile']=$row->mobile;
				$profile['otpMobileNo']=$row->otpMobileNo;
				$profile['mobileno_org']=$row->mobileno_org;
		     	$profile['organization']=$row->organization;
				$profile['no_ndnc']=$row->no_ndnc;
				$profile['available_credits']=$row->available_credits;
		     	$profile['address1']=$row->address1;
		     	$profile['address2']=$row->address2;
		     	$profile['state_id']=$row->state_id;
				$profile['city_id']=$row->city_id;
				$profile['login_time']=$row->login_time;
				$profile['template_check']=$row->template_check;
				$profile['registered_on']=$row->registered_on;
				$profile['mverify']=$row->mverify;
				$profile['dnd_check']=$row->dnd_check;

		     	$profile['zipcode']=$row->zipcode;
				
				
			
		    }
     	}
 /*    	
$this->db->query('select city_id,city_name from new_citylist where city_id=$city_id');
$city = $query->row();
 $this->_data['city_name']= $city->city_name; */
		if($this->uri->segment(3) == "edited") {
			$this->_data['edited'] = "Your Profile Changes has been Saved."; 
		}
     	
     	/*$this->_data['cities'] = array('' => '--select--', '1'=>'Bangalore', '2'=>'Calcutta', '3'=>'Chittor', '4'=>'Chennai', '5' => 'Delhi', '6' => 'Hyderabad', '7'=>'Guntur',
								'8'=>'Gurgaon', '9'=>'Jaipur', '10'=>'Mumbai', '11'=>'Nagpur', '12'=>'Nalgonda', '13'=>'Nellore', '14'=>'Noida', '15'=>'Pune', '16'=>'Pondicherry', 
								'17'=>'Vijayawada', '18'=>'Warangal');
     	
		if(isset($profile['city_id'])){
     		$profile['city_name']= $this->_data['cities'] [$profile['city_id']];
		}	*/
		 $this->load->model('Campaign_model');
	$senderNames = $this->Campaign_model->getSenderNames($this->_userId);
         $this->_data['senderNames'] = $senderNames;
     	   $this->_data['profile'] = $profile;

		$this->load->view('includes/header',$this->_data);

		if($profile['mverify']==0):
			$this->load->view('includes/leftmenu_otp');
 		//print_r($profile['mverify']);exit;
		
		else:
				$this->load->view('includes/leftmenu');

		endif;  

		$this->load->view('myaccount/myprofile');
		$this->load->view('includes/footer');		
	}



public function resend_otp()
    {
		  $user_id =$this->_userId;
		
		$sql="select * from users where user_id=$user_id";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
		
		foreach($query->result() as $key=>$user)
		{
		  $mobileno=$user->mobile;
		  $email=$user->email;
		  $first_name=$user->first_name;
		  $last_name=$user->last_name;
		  $user_id=$user->user_id;
		  $username=$user->username;
		}
		
		 //$mobileno=8688388672;
		//*********** send mobile alert *****************//
		
		session_start();
		$uname= $first_name." ".$last_name;
		$otpcode=substr(mt_rand(), 0, 4); /// to generate random number
		$body="Your OTP for User ID : $username  is : ".$otpcode;
		$subject="One Time Password : OTP";
		$_SESSION['otp']=$otpcode;	/// save otp code in sesion	
		$_SESSION['end'] = time() + 3 * 60;	// set sesion time to 3 mins
		$_SESSION['mobile']=$mobileno;
		$_SESSION['user_id']=$user_id;
		$message =$body;
		//$ticketid="DLL-903-66894";
		$cur = date('Y-m-d H:i:s');
		$user="support"; //your username
		$password="Str!k3r2020"; //your password
		$mobilenumbers=$mobileno; //enter Mobile numbers comma seperated
		$message = $message; //enter Your Message
		$senderid="STRIKR"; //Your senderid
		$messagetype="1"; //Type Of Your Message
		$url="http://www.smsstriker.com/API/sms.php";
		$message = urlencode($message);
		$ch = curl_init();
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_POSTFIELDS,
		"username=$user&password=$password&to=$mobilenumbers&msg=$message&from=$senderid&type=$messagetype");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
		// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
		$final_url = $url."?"."username=$user&password=$password&mobilenumber=$mobilenumbers&msg=$message&from=$senderid&type=$messagetype";
		//echo $final_url;
		$curlresponse = curl_exec($ch); // execute
		
		// *********************** send email *****************************//

 $message = '<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;}

.mrgleft{margin-left:-25px;}
.main-newsletter{width:100%;max-width:600px;    float: left;}

.header-newsletr{background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
padding: 15px 25px;}

.bold-name{color:#00B8B5;}

.halfwidth02{width:100%;max-width: 300px;float:left;}
.halfwidth03{width:100%;max-width: 200px;float:left;}

	
	
	.paddinglt25{padding-right:25px;}
	.footer-top-list{float:right;}
	.footer-top-list li:first-child{margin-bottom:16px;font-size:15px;}
	.footer-top-list li{text-align:right;list-style-type:none;margin-bottom: 6px;    font-size: 12px;
    font-weight: bold;}
	.footer-top-list span{margin-left:5px;}
	.footer-top-list b{color:#00B8B5;}
	.footerbtm{background:#58595B;padding-bottom: 7px;padding-top: 7px;}
	.footer-social-list{float:right;margin: 0px;}
	.footer-social-list li{list-style-type:none;float:left;margin-right:15px;}
	.footerlast{background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;}
	.footerlast a, .footerlast p{font-size:9px;color:#fff;text-decoration:none;}
	.footerlast p{margin:0px;text-align:right;}
	.footer-social-list li:last-child{margin:0px;}
	.table-btmcont b{color:#00B8B5;}
	.text-right{text-align:right;}
	.table-btmcont p{font-size:11px;font-weight: bold;}
	.democlass a{background:#00b8b6;color:#fff;    color: #fff;
    padding: 3px 6px;
    margin-left: 4px;text-decoration:none;
    border-radius: 5px;}
	.mrgtbbotom{margin-top:10px;margin-bottom:10px;}

	.contactbtm02{position:relative;margin-top: 20px;    padding-top: 15px;
    padding-bottom: 15px;}

	.firstcontent p{font-size: 12px;
    font-weight: bold;}
	.play-btn a{text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;    padding: 3px 5px;}
	.indian-rupee img{    width: 9px;
    margin-left: 2px;}
	.fltright{float:right !important;}
	.oneotp-content b{color: #00B8B5;}
	
	.btmotpcontent p{    background: #cdf1f1;
    padding: 15px;
    border-radius: 10px;}
	.oneotp-content p.otpnumber{font-weight:bold;    font-size: 16px;}
	.oneotp-content p{font-size: 14px;}
	.otp-padding{width:100%;max-width:470px;margin: auto;}
</style>

</head>
<body style="padding:0px;margin:0px;font-family: Lato,sans-serif;">
<div class="main-newsletter">
<div class="header-newsletr" style="width:100%;float:left;">
<a href="index.html"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
</div>
<div class="firstcontent" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<p>Hi</p>
<b class="bold-name">Mr/Mrs. '.$username.',</b>
<p>Thank you for showing interest in our services</p>
</div>
</div>
<div class="oneotp-content" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="otp-padding">

<p class="otpnumber">Your One Time Password is : <b> '.$otpcode.'</b></p>

<p>OTP validity 3 minutes to expired</p>
</div>
</div>
</div>
<div class="btmotpcontent" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="otp-padding">
<p>NEVER SHARE your OTP, User ID, Password anyone,Sharing these details can lead to unauthorized access to your account</p>
</div>
</div>
</div>
<div class="contactbtm02" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="halfwidth fltright" style="width:100%;max-width: 275px;float:left;">
<ul class="footer-top-list">
<li><b>Need help?</b></li>
<li>+91  7097 19 19 19 <span><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
<li>support@smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></li>
<li>www.smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></li>
</ul>
</div>
</div>
</div>
<div class="footerbtm" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
</div>
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<ul class="footer-social-list">
<li><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
<li><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
<li><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
</ul>
</div>
</div>
</div>
<div class="footerlast" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<a href="http://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
</div>
</div>
</div>
<div>

</div>
</body>
</html>';

		$this->load->library('email');
		$SMTPOptions = array('ssl' => array(  'allow_self_signed' => true ));
		$subject = "One Time Password (OTP)!";
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
		$this->email->message($message);
		$this->email->send();
		}
		
		
		
			
    }
   
   	
public function payments()
    {
		$this->_data['userid'] =$this->_userId;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');	
		$this->load->view('myaccount/payments');
		$this->load->view('includes/footer');		
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
	
	
	
	public function editProfile()
	{
		$this->_data['page_title'] = "My Account";
		
		$this->load->model('User_model');
		
		$profile=array();
		$profile_data=$this->User_model->getUserDetails($this->_userId);
		if($profile_data)
     	{
     	
			if ($this->input->post('edit')) {
				$this->load->library('form_validation');			
				if ($this->form_validation->run('edit_profile_form') == TRUE) {
					$this->User_model->editUserDetails($this->_userId);
					redirect('myaccount/index/edited');					
				}
			}
			
		    foreach($profile_data as $row)
		    {
		     	$profile['first_name']= $row->first_name ? $row->first_name : "";
		     	$profile['last_name']=$row->last_name ? $row->last_name : "";
		     	$profile['email']=$row->email ? $row->email : "";
		     	$profile['mobile']=$row->mobile ? $row->mobile : "";
		     	$profile['organization']=$row->organization ? $row->organization : "";
		     	$profile['address1']=$row->address1 ? $row->address1 : "";
		     	$profile['address2']=$row->address2 ? $row->address2 : "";
		     	$profile['city_id']=$row->city_id ? $row->city_id : "";
		     	$profile['state_id']=$row->state_id ? $row->state_id : "";
		     	$profile['country_id']=$row->country_id ? $row->country_id : "";
		     	$profile['zipcode']=$row->zipcode ? $row->zipcode : "";
		    }
			
     	}
				$this->load->model('user_model');
		$statesAll = $this->user_model->getNew_StatesList();
		 $states_all = array('' => '--select--');
        foreach($statesAll as $row){
            $states_all[$row->state_id] = ucwords(strtolower($row->state));
        }
        $this->_data['states_all'] = $states_all;

		/*$this->_data['cities'] = array('' => '--select--', '1'=>'Bangalore', '2'=>'Calcutta', '3'=>'Chittor', '4'=>'Chennai', '5' => 'Delhi', '6' => 'Hyderabad', '7'=>'Guntur',
								'8'=>'Gurgaon', '9'=>'Jaipur', '10'=>'Mumbai', '11'=>'Nagpur', '12'=>'Nalgonda', '13'=>'Nellore', '14'=>'Noida', '15'=>'Pune', '16'=>'Pondicherry', 
								'17'=>'Vijayawada', '18'=>'Warangal');*/
		$this->_data['profile'] = $profile;
		
	}
	
	public function changepassword()
	{
		$this->_data['page_title'] = "Change Password";
		
		if($this->uri->segment(3) == "changed") {
			$this->_data['changed'] = "Your Password has been Changed."; 
		}
		
		if ($this->input->post('change_password')) {
			$this->load->library('form_validation');			
			if ($this->form_validation->run('change_password_form') == TRUE) {
				$current_password = $this->input->post('current_password');
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');			
				
	
				if($new_password == $confirm_password) {
					$this->load->model('User_model');
					


					if($this->User_model->isOldPasswordCorrect($this->_userId,$current_password))
					{
						$userarray=array(647,4130,4131);
					if(in_array($this->_userId,$userarray))
					{
					$data['error'] = "Your Password not sent!. Please Contact Administrator";
					}else{
										$this->load->model('User_model');
			            $this->User_model->setNewPassword($this->_userId, $new_password);
			            $rs = $this->User_model->getNewPasswordDetails($this->_userId);
			           
			          //print_r($rs);
			         
			          
					foreach($rs as $result) 
					{
						$user_id = $result->user_id;
						$email = $result->email;
						$firstName = $result->first_name;
						$username = $result->username;
                                    $mobile = $result->mobile;
					}
			          
			            
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
					<p>This is to inform you that your password for the <strong>User ID </strong> : '.$username.' at Striker has been changed successfully. Please keep your login credentials confidentially.</p> 
					<br> 
					<p><strong>User Name <strong>:'.$username.' </p>
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
					$subject = "Change Password has been Issued";
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

					redirect('myaccount/changepassword/changed');
					}
						
	
					} else 
					{
						$this->_data['error'] = "Wrong Current Password";
					}
					

								
					
				} else {
					$this->_data['error'] = "Passwords are not Matching";
				}					
			}
		}
		$profile = array();
		 $profile_data =$this->User_model->getUserDetails($this->_userId);  
		foreach($profile_data as $row)
		{
			$profile['user_id']= $row->user_id;
			$profile['username']=$row->username;
			$profile['first_name']=$row->first_name;
			$profile['last_name']=$row->last_name;
			$profile['email']=$row->email;
			$profile['mobile']=$row->mobile;
			$profile['mobileno_org']=$row->mobileno_org;
			$profile['organization']=$row->organization;
			$profile['no_ndnc']=$row->no_ndnc;
			$profile['available_credits']=$row->available_credits;
			$profile['address1']=$row->address1;
			$profile['address2']=$row->address2;
			$profile['state_id']=$row->state_id;
			$profile['city_id']=$row->city_id;
			$profile['login_time']=$row->login_time;
			$profile['template_check']=$row->template_check;
			$profile['registered_on']=$row->registered_on;
			$profile['mverify']=$row->mverify;
			$profile['dnd_check']=$row->dnd_check;
			$profile['zipcode']=$row->zipcode;  

		}     
        	$this->_data['profile'] = $profile;
		$this->load->view('/includes/header',$this->_data);
		if($profile['mverify'] == 0):
			$this->load->view('includes/leftmenu_otp');
		
		else:  
			$this->load->view('includes/leftmenu');

		endif; 			
 
		$this->load->view('myaccount/changepassword');
		$this->load->view('/includes/footer');
	}
	
	
	 public function sender_names()
    {
        $this->_data['title'] = "Manage Sender Names";
        $this->load->model('user_model');


        //add sender name
        if($this->input->post('add_sender_name')){
        	
            $this->load->library('form_validation');
            if ($this->form_validation->run('add_sender_name_form') == TRUE) {
            	
                $sender_name = $this->input->post('sender_name');
               	if($this->user_model->isSenderNameAvailable($this->_userId, $sender_name))
               	{
               		$this->user_model->addSenderName($this->_userId, $sender_name);
               		
               		
               		   $rs = $this->User_model->getNewPasswordDetails($this->_userId);
			           
			         
			          
					foreach($rs as $result) 
					{
						$user_id = $result->user_id;
						$email = $result->email;
						$firstName = $result->first_name;
						$username = $result->username;
                                    $mobile = $result->mobile;
					}
               		
               		
               		               		
                             
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
					<p>Dear Team,</p> 

					<br> 
					<p>Request to Sender ID Whitelist!</p> 

					<br> 
				

					<p>This is to Request you that my Sender ID Needed to Whitelist on Striker.</p> 

					<br> 
					<p><strong> My Required Sender ID </strong> : '.$sender_name.'</p> 

					<br> 


					<p>Link: <a href="http://www.smsstriker.com/login.html">http://www.smsstriker.com</a></p> 
					


					<p><b>Best Regards&#44;</b></p><br> 
					<p><b> Name :'.$username .'&#44;</b></p> 
					<p><b> User ID'.$firstName .'&#44;</b></p> 

					

					</div> 
					</div> 

					 </body> 
					     

					</html>'; 
					$this->load->library('email');
					$SMTPOptions = array('ssl' => array(  'allow_self_signed' => true ));
					$subject = "Sender ID Needed to Whitelist on Striker";
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
				
					$this->email->from($username,$firstName);
					//$this->email->to('support@smsstriker.com');
					$this->email->to('gotte.naresh@gmail.com');
					$this->email->subject($subject);
					$this->email->message($email_msg);
					//$this->email->send();
               		
                	redirect("myaccount/sender_names/added");
				}else
				{
					$this->_data['error'] = "Please follow the below errors"; 
					redirect("myaccount/sender_names/exist");
				}
					
            }
			else
            {
				  $this->_data['error'] = "Please follow the below errors"; 
			}
        }

        //get added Sender Names
        $sender_names = $this->user_model->getSenderNames($this->_userId);
        $this->_data['sender_names'] = $sender_names;

        if($this->uri->segment(3) == "added"){
            $this->_data['added'] = "Sender Name has been Added";
        }

        if($this->uri->segment(3) == "deleted"){
            $this->_data['deleted'] = "Sender Name has been Deleted";
        }
        if($this->uri->segment(3) == "exist"){
            $this->_data['exist'] = "Sender Name already exist in your list";
        }

        $this->load->view('includes/header',$this->_data);
				 $this->load->view('includes/leftmenu');

        $this->load->view('myaccount/sender_names');
        $this->load->view('includes/footer');
    }

    public function delete_sender_name()
    {
         $senderId = $this->uri->segment(3);

        if(!$senderId){
            redirect('myaccount/sender_names');
        }

        $this->load->model('user_model');
        $rs = $this->user_model->getSenderNameDetails($this->_userId, $senderId);

        if(!$rs){
            redirect('myaccount/templates');
        }

        $rs = $this->user_model->delete_sender_name($this->_userId, $senderId);

        redirect("myaccount/sender_names/deleted");
    }

    public function templates()
    {
        $this->_data['title'] = "Manage Templates";
        $this->load->model('user_model');

        //add Templates
        if($this->input->post('add_template')){
            $this->load->library('form_validation');
            if ($this->form_validation->run('add_template_form') == TRUE) {
                $template = $this->input->post('template');
                $this->user_model->addTemplate($this->_userId, $template);
                redirect("myaccount/templates/added");
            }
			else
            {
				  $this->_data['error'] = "Please follow the below errors"; 
			}
        }

        //get added templates
        $templates = $this->user_model->getTemplates($this->_userId);
      
        $this->_data['templates'] = $templates;

        if($this->uri->segment(3) == "added"){
            $this->_data['added'] = "Template has been Added";
        }

        if($this->uri->segment(3) == "deleted"){
            $this->_data['deleted'] = "Template has been Deleted";
        }

        $this->load->view('includes/header', $this->_data);
		 $this->load->view('includes/leftmenu');
        $this->load->view('myaccount/templates');
        $this->load->view('includes/footer');
    }

    public function delete_template()
    {
        $templateId = $this->uri->segment(3);

        if(!$templateId){
            redirect('myaccount/templates');
        }

        $this->load->model('user_model');
        $rs = $this->user_model->getTemplateDetails($this->_userId, $templateId);

        if(!$rs){
            redirect('myaccount/templates');
        }

        $rs = $this->user_model->delete_template($this->_userId, $templateId);

        redirect("myaccount/templates/deleted");
    }

	function logout()
	{
	    $user_data = $this->session->all_userdata(); 
		foreach ($user_data as $key => $value) {
		    if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
		        $this->session->unset_userdata($key);
		    }
		}  
	    $this->session->sess_destroy();
	    //$redirect = $this->logout();
	    //redirect($redirect); 
		redirect(base_url().'login.html'); 
	}
	
	public function userLogout() {
			//$this->load->helper('cache');
  			 //$array = array('session_id','username','user_id','ip_address');
 			//$this->session->unset_userdata($array);   
			//$this->session->sess_destroy();
				// print_r($this->session->all_userdata());echo "<br>";echo "<br>";echo "<br>";
			   $this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id'); 

			//$this->session->unset_userdata('ip_address');
			//$this->session->unset_userdata('user_agent');
			//$this->session->unset_userdata('last_activity'); 

			$this->session->unset_userdata('first_name');
			$this->session->unset_userdata('no_ndnc');
			$this->session->unset_userdata('dnd_check'); 
  
			$this->session->unset_userdata('dlr_enabled');
			$this->session->unset_userdata('is_reseller');
			$this->session->unset_userdata('ndnc_return'); 
  
			$this->session->unset_userdata('template_check');
			$this->session->unset_userdata('is_longcode');
			$this->session->unset_userdata('is_missedcall');
			//$redirect = base_url().'login.html';
				//print_r($this->session->all_userdata());echo "<br>";echo "<br>";echo "<br>";
				//  delete_cookie("ci_session"); 

				$this->session->sess_destroy();
 
 
		  	  redirect(base_url().'login.html'); 
 
		  
	 }  
	
	
	
	
}
