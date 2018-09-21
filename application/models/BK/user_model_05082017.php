<?php
class user_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	public function usernameExist()
	{
		$username=$this->input->post('username');
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('username',$username);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;
	}
	 
	 public function getSenderNames($user_id)
    {
        $this->db->select()
            ->from('sender_names')
            ->where('user_id', $user_id)
	    ->order_by('id','desc');
        $query = $this->db->get();
        return $query->result();
    }
    
public function global_settings()
    {
        $this->db->select()
            ->from('global_settings');
        $query = $this->db->get();
        return $query->result();
    }
    
public function getPriceTable($id)
    {
        $this->db->select()
            ->from('price_enquery')
            ->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
public function getPriceTableuser($id)
    {
        $this->db->select()
            ->from('price_enquery')
            ->where('registeruser_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
public function getpaymentstatus($id)
    {
        $this->db->select()
            ->from('price_enquery')
            ->where('registeruser_id', $id)
            ->where('payment_status', 0);
        $query = $this->db->get();
	//return $this->db->last_query();
        return $query->result();
    }

	 public function getSenderNames_accept($user_id)
    {
        $this->db->select()
            ->from('sender_names')
            ->where('user_id', $user_id);
              // ->where('status', 1);
            

        $query = $this->db->get();
        return $query->result();
    }
    
    public function addSenderName($user_id, $sender_name)
    {
        $values = array(
            'user_id' => $user_id,
            'sender_name' => $sender_name
        );

        $this->db->set('on_date', 'NOW()', FALSE);
        $rs = $this->db->insert('sender_names', $values);
        return $rs;
    }
    
    public function getNewPasswordDetails($user_id)
	{
		$username=$this->input->post('username');
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('user_id',$user_id);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;
	}
	
	
	public function isSenderNameAvailable($user_id, $sender_name)
    {
        $this->db->select('sender_name')
            ->from('sender_names')
            ->where('user_id', $user_id)
            ->where('sender_name', $sender_name);

        $query = $this->db->get();
       	if($query->num_rows() > 0)
       		return false;
       	else
        	return true;
    }
	public function getSenderNameDetails($user_id, $sender_id)
    {
        $this->db->select()
            ->from('sender_names')
            ->where('user_id', $user_id)
            ->where('id', $sender_id);

        $query = $this->db->get();
        return $query->result();
    }
    public function delete_sender_name($user_id, $sender_id)
    {
        $rs = $this->db->where('id', $sender_id)
            ->where('user_id', $user_id)
            ->delete('sender_names');

        return $rs;
    }

     public function getTemplatesApprove($user_id)
    {
        $this->db->select()
            ->from('templates')
            ->where('status', 1)
			 ->where('user_id', $user_id);
			 $this->db->order_by('template_id','desc');

       $query = $this->db->get();
	  
        return $query->result();
    }
	

	 public function getTemplates($user_id,$limit = null,$offset = null)
       {
        $this->db->select()
            ->from('templates')
            ->where('user_id', $user_id);
			 $this->db->order_by('template_id','desc');
			$this->db->limit($limit,$offset);
			$query = $this->db->get();
			
		  return $query->result_array();
    }

 public function getTemplatesCount($user_id)
       {
        $this->db->select()
            ->from('templates')
            ->where('user_id', $user_id);
			 $this->db->order_by('template_id','desc');
			
			$query = $this->db->get();
			
		  return $query->num_rows();
    }

    public function addTemplate($user_id, $template)
    {
        $values = array(
            'user_id' => $user_id,
            'template' => $template
        );
        $this->db->set('on_date', 'NOW()', FALSE);
        $rs = $this->db->insert('templates', $values);
        return $rs;
    }
 public function updated_template($user_id,$template_id,$template)
    {
	if(strlen($template) <= 0) {  
			return FALSE;
		}else{ 
			$values = array(
			    'template' => $template
			);

		     	$rs=$this->db->where('user_id',$user_id)
					->where('template_id',$template_id)
			    ->update('templates',$values);
					 $this->db->last_query();
			return $rs;
		}	
    }
    public function getTemplateDetails($user_id, $template_id)
    {
        $this->db->select()
            ->from('templates')
            ->where('user_id', $user_id)
            ->where('template_id', $template_id);

        $query = $this->db->get();
        $rs = $query->result();
        return $rs;
    }
    
    

    public function delete_template($user_id, $template_id)
    {
        $rs = $this->db->where('user_id', $user_id)
            ->where('template_id', $template_id)
            ->delete('templates');

        return $rs;
    }
    
	public function register()
	{
	//print_r($_POST);

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

		if($no_ndnc!=1)
		{
			$no_ndnc=0;
		}	
		$values = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('userpass')),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'organization' => $this->input->post('organization'),
			'mobileno_org' => $this->input->post('mobileno_org'),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city_id' => $this->input->post('city_id'),
			'state_id' => 0,
			'country_id' => 0,
			'no_ndnc' => $no_ndnc,
			'zipcode' => $this->input->post('pincode'),
			'from_striker' => 1
		);
		if($this->session->userdata('is_reseller')) {
			$values['reseller_id'] = $this->session->userdata('user_id');
		}
		$this->db->set('registered_on', 'NOW()', FALSE);
		$this->db->insert('users', $values);
	$this->db->last_query();

		return $this->db->insert_id();
	}
	
	public function login()
	{
		$user_name = $this->input->post('username');
		$password = md5($this->input->post('userpass'));
		
		/*if($password == "16828c250617a66fc03c5cfc3eebad0a") {
			//$where = "username = '$user_name' and password = '$password'";
					$where = "binary(LOWER(username)) = binary(LOWER('$user_name')) and binary(password) = binary('$password')";
		} else {
			//$where = "username = '$user_name' and password = '$password'";
					$where = "binary(LOWER(username)) = binary(LOWER('$user_name')) and binary(password) = binary('$password')";
		}*/

/*					
$sql = "SELECT user_id,username,first_name,last_name,is_blocked,no_ndnc,return_ndnc_credits,dlr_enabled,is_reseller,
template_check,is_longcode,is_missedcall FROM users WHERE username = ? AND password = ? ";*/
		
					
$sql = "SELECT * FROM users WHERE username = ? AND password = ? ";
$query=$this->db->query($sql, array($user_name, $password));

   
		/*
		$this->db->select('user_id,username,first_name,last_name,is_blocked,no_ndnc,return_ndnc_credits,dlr_enabled,is_reseller,template_check,is_longcode,is_missedcall')
		         ->from('users')
		         ->where($where);
		$query=$this->db->get();
		echo $this->db->last_query();
		 */
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	

	public function updateLoginTime($user_id)
	{
		if($user_id)
		{
			$this->db->set('login_time', 'NOW()', FALSE)
				->where('user_id',$user_id)
				->update('users');
		}
	}
	
	public function setNewPassword($user_id, $new_password)
	{
		$values = array(
			'password' => md5($new_password)
		);
		$this->db->where('user_id',$user_id) 
			->update('users',$values);
	}
	
	public function getAvailableCredits($user_id)
	{
		$this->db->select('available_credits,international_available_credits,shorturl_credits,is_ftp')
			->from('users')
			->where('user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	public function getNondnc($user_id)
	{
		$this->db->select('no_ndnc')
			->from('users')
			->where('user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	
	public function addBalance($user_id)
	{
		$no_of_SMS = $this->input->post('no_of_sms');
		if($no_of_SMS>0){
		
		$this->db->query("update users set available_credits = available_credits + $no_of_SMS where user_id='$user_id'");
				
		}
		
		
		$curdate = date('Y-m-d H:i:s');	
$query_text="update users set available_credits = available_credits + $no_of_SMS where user_id='$user_id'";
$errorlog_balancecheck="/var/www/vhosts/www.smsstriker.com/htdocs/balance_logs/added_log/balance_added_".date("Ymd").".log";
error_log("| Query : $query_text date & time : $curdate |"."\n",3,$errorlog_balancecheck);
	}
	
	public function subtractBalance($user_id)
	{
		$no_of_SMS = $this->input->post('no_of_sms');
		if($no_of_SMS>0){
			$this->db->query("update users set available_credits = available_credits - $no_of_SMS where user_id='$user_id'");
			

		}
		
		$curdate = date('Y-m-d H:i:s');	
$query_text="update users set available_credits = available_credits - $no_of_SMS where user_id='$user_id'";
$errorlog_balancecheck="/var/www/vhosts/www.smsstriker.com/htdocs/balance_logs/deducted_log/balance_deduction_".date("Ymd").".log";
error_log("| Query : $query_text date & time : $curdate |"."\n",3,$errorlog_balancecheck);
		
	}
	
	public function insertPaymentDetails($user_id, $payment_type, $added_by)
	{
		$values = array(
			'user_id' => $user_id,
			'no_of_sms' => $this->input->post('no_of_sms'),
			'price' => $this->input->post('price'),
			'total_amount' => $this->input->post('no_of_sms') * $this->input->post('price'),
			'added_by' => $added_by,
			'payment_type' => $payment_type 
		);
		$this->db->set('on_date', 'NOW()', FALSE);
		$this->db->insert('user_payments', $values);
	}
	
	public function is_user_belongs_to_reseller($user_id, $reseller_id)
	{
		$this->db->select()
			->from('users')
			->where('user_id',$user_id)
			->where('reseller_id',$reseller_id);
		$query=$this->db->get();
		//echo $this->db->last_query();

		return $query->result();	 
	}
	

	public function getUserDetails($user_id)
	{
		$this->db->select()
			->from('users')
			->join('region','region.id = users.city_id','left')
			->where('users.user_id',$user_id);
			
		$query=$this->db->get();
		return $query->result();	
	}
	
	public function editUserDetails($user_id)
	{  
				
		if($this->input->post('mverify')==1):
				
			$values = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'organization' => $this->input->post('organization'),
			'mobileno_org' => $this->input->post('mobileno_org'),
			'mobile' => $this->input->post('mobile'),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city_id' => $this->input->post('city_id'),
			'state_id' => $this->input->post('state_id'),
			'country_id' => 0,
			'zipcode' => $this->input->post('pincode'),
			'from_striker' => 1
		);
		else:
				
if($this->input->post('mobile'))
{
session_start();
$username=$this->input->post('username');

$otpcode=substr(mt_rand(), 0, 4); /// to generate random number
$body="Your OTP for User ID : $username  is : ".$otpcode;
$subject="One Time Password : OTP";

$_SESSION['otp']=$otpcode;	/// save otp code in sesion	
$_SESSION['end'] = time() + 3 * 60;	// set sesion time to 3 mins

$_SESSION['mobile']=$this->input->post('mobile');
$_SESSION['user_id']=$user_id;

$message =$body;

$mobileno=$this->input->post('mobile');

//$ticketid="DLL-903-66894";
$cur = date('Y-m-d H:i:s');
$user="support"; //your username
$password="Str!k3r2020"; //your password
$mobilenumbers=$mobileno; //enter Mobile numbers comma seperated
$message = $message; //enter Your Message
$senderid="STRIKR"; //Your senderid
$messagetype="1"; //Type Of Your Message
$url="https://www.smsstriker.com/API/sms.php";

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
if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret)) {
// some kind of an error happened
die(curl_error($ch));
curl_close($ch); // close cURL handler
} else 
{
$info = curl_getinfo($ch);
curl_close($ch); // close cURL handler
//var_dump($info);
			date_default_timezone_set("Asia/Calcutta");
			$dt = new DateTime();
			$otptime= $dt->format('Y-m-d h:i:s');
			
			

$url='https://www.smsstriker.com/index.php/myaccount/codeotp_mverify.html';
?>
<script language="javascript" type="text/javascript">
window.self.location='<?php print($url);?>';
</script>
<?php
}
echo "<script>alert('Message Sent Succesfully');</script>";	

}

					redirect('index.php/myaccount/codeotp_mverify');

		endif;
		$this->db->where('user_id',$user_id) 
			->update('users',$values);
			
			// send email
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
					<p>Greetings from Striker !!!</p> 
					<br> 
					<p>Your profile information has been updated successfully.</p>  
					<br> 
					

					<p>Link: <a href="https://www.smsstriker.com/login.html">https://www.smsstriker.com</a></p> 
					<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p> 
					<p>For adding credits and Finance related, please contact to <a href="mailto:accounts@smsstriker.com" target="_top">accounts@smsstriker.com&#59;</a> 040&#45;79417712.</p> 
					<br> 
					<p>For providing your feedback, please click the URL : <a href="https://www.smsstriker.com/contact-us.html">https://www.smsstriker.com </a></p> 
					 <p>Thanks for being our valid customer....Have a great day ahead.....</p>
					 <br>
					<p><b>Best Regards&#44;</b></p><br> 
					<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
					<div> 
					<img src="https://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
					</div> 
					<div class="signature"> 
					<p><b>(Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
					<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
					<p><b>Hightech City| Hyderabad &#45; 81 </b></p> 
					</div> 
					</div> 
					</div> 
					 </body> 
					     
					</html>'; 
					$this->load->library('email');
					$subject = "Your profile information has been updated successfully.";
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
					
			
	}
	
	public function isOldPasswordCorrect($user_id, $current_password)
	{
		$where = "user_id = '$user_id' and password = md5('$current_password')";
		
		$this->db->select('user_id')
		         ->from('users')
		         ->where($where);
		         		
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

    public function getTotalAddedCredits($user_id, $credits_type)
    {
        $this->db->where('user_id',$user_id);

        if($credits_type == "-1"){
            $this->db->where('payment_type in (0,1,3)');
        } else {
            $this->db->where('payment_type', $credits_type);
        }

        return $this->db->count_all_results('user_payments');
    }

    public function getAddedCredits($user_id, $credits_type, $off_set, $limit)
    {
        $this->db->select('payment_id,no_of_sms,price,total_amount,payment_type,on_date')
            ->from('user_payments')
            ->where('user_id', $user_id);

        if($credits_type == "-1"){
            $this->db->where('payment_type in (0,1,3)');
        } else {
            $this->db->where('payment_type', $credits_type);
        }

        $this->db->order_by('on_date','desc')
            ->limit($limit, $off_set);

        $query=$this->db->get();
        return $query->result();
    }


 public function getNew_StatesList()
    {
        $this->db->select('state_id,state')
            ->from('new_statelist')
            ->order_by('state', 'asc');
        $query = $this->db->get();
        $rs = $query->result();
        //echo $this->db->last_query();
        return $rs;
    }
    public function getState($state_id)
    {
        $this->db->select('state_id,state')
            ->from('new_statelist')
            	->where('state_id', $state_id)
            ->order_by('state', 'asc');
        $query = $this->db->get();
        $rs = $query->result();
       // echo $this->db->last_query();
        return $rs;
    }
    public function getNew_CitiesList($state_id=NULL)
    {
        $this->db->select('city_id,city_name')
            ->from('new_citylist')
   
				->where('state', $state_id)
            ->order_by('city_name', 'asc');
        $query = $this->db->get();
        $rs = $query->result();
       //  $this->db->last_query();
	
        return $rs;
    }

 public function getNew_CitiesListReg($state_id=NULL)
    {
        $this->db->select('city_id,city_name')
            ->from('new_citylist')
   
				->where('state_id', $state_id)
            ->order_by('city_name', 'asc');
        $query = $this->db->get();
        $rs = $query->result();
      // echo $this->db->last_query(); 
        return $rs;
    }
	
	
	function getUser_Checker($username)
	{	$username=$this->input->post('username');
		$this->db->select('user_id,username,first_name,email,mobile')
				 ->from('users')
				 ->where('username',$username);
		$query=$this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		}
		return false;
	}	



	public function usernameExist_newsletter()
	{
		$user_name=$this->input->post('user_name');
		$email=$this->input->post('email');
		$this->db->select('n_name,n_email')
				 ->from('news_letter')
				 ->where('n_name',$user_name)
				 ->where('n_email',$email);
				 		$query=$this->db->get();
// $this->db->last_query();
		
		if ($query->num_rows()==1) {
			return $query->result();
		}

		return false;
	}

public function newsletter_register()
	{
			
		$values1 = array(
			'n_name' => $this->input->post('user_name'),
			'n_email' => $this->input->post('email')
		);
		$this->db->set('register_on', 'NOW()', FALSE);
		$rs=$this->db->insert('news_letter', $values1);
  
		return $rs;
		
		
	}
	
	// college feed form
	
	 public function college_enquireform($contact_number,$name,$address,$courses,$comment)
    {
        $values = array(
            'phone' => $contact_number,
            'name' => $name,
            'course' => $courses,
            'address' => $address,
            'comments' => $comment
           
        );
        $rs = $this->db->insert('college_enquireform', $values);
     //  echo $this->db->last_query();

        return $rs;
    }
	
	
	
	
	/**  Added on 2017-01-23  **/
	public function getuserMobilenos($user_id)
	{
		$sql="SELECT service_no as mobile
		FROM sms.service_nos
		WHERE `user_id` =$user_id
		AND `status` =1
		ORDER BY service_id DESC";
		$rs = $this->db->query($sql);
		if(count($rs)>0)
		{
			return $rs->result();
		}
		else
		{
			return array();
		}
	}
	  
	
	
	public function checkCoupon($couponCode,$user_id) {
		$couponCode = trim($couponCode);
		$checkCouponUsedFor = $this->db->select('couponUsed,discountOnMaxPrice,price')
					       ->from('coupons')
					       ->where('coupon',$couponCode)
					       ->where('date(endDate) >=',date('Y-m-d'))
					       ->get();  
		$discountOnMaxPrice=0;$price=0;
		if($checkCouponUsedFor->num_rows() > 0) {
			$couponUsedFor = $checkCouponUsedFor->row('couponUsed'); 
			$price = $checkCouponUsedFor->row('price');    
			$discountOnMaxPrice = $checkCouponUsedFor->row('discountOnMaxPrice'); 
			if($couponUsedFor == 1) {
				$checkUserValidity = $this->db->select('id')
					      ->from('price_enquery')
					      ->where('couponCode',$couponCode)
					      ->where('pgresponse_code',0)
					      ->where('pgresponse','Transaction Successful')
					      ->where('registeruser_id',$user_id)
					      ->limit(1)
					      ->get();
				if($checkUserValidity->num_rows() > 0) {
					 return  array('status' => 201,'maxPrice' => $discountOnMaxPrice,'price' => $price);   
				}else{	
					$this->db->query("INSERT INTO price_enquery (registeruser_id,couponCode) VALUES('".$user_id."','".$couponCode."')"); 
				  	 return  array('status' => 200,'maxPrice' => $discountOnMaxPrice,'price' => $price);     
				}   
			}else{
 				$checkUserValidity = $this->db->select('id')
					      ->from('price_enquery')
					      ->where('couponCode',$couponCode)
					      ->where('pgresponse_code',0)
					      ->where('pgresponse','Transaction Successful')
					      //->where('registeruser_id',$user_id)
					      ->limit(1)
					      ->get();          
				if($checkUserValidity->num_rows() > 0) {
					return  array('status' => 201,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
				}else{	
				$this->db->query("INSERT INTO price_enquery (registeruser_id,couponCode) VALUES('".$user_id."','".$couponCode."')");
			              return  array('status' => 200,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
				}   
			} 
		}else{
			return  array('status' => 202,'maxPrice' => $discountOnMaxPrice,'price' => $price); 
		} 
	} 
	
	public function getUserVerifiedCoupon($user_id) {
		$checkUserValidity = $this->db->query("SELECT  id,`couponCode` FROM (`price_enquery`) WHERE `pgresponse_code` IS NULL AND `pgresponse` IS NULL AND couponCode != '' AND `registeruser_id` = '".$user_id."' ORDER BY id desc LIMIT 1");
 		if($checkUserValidity->num_rows() > 0) {
			/*$couponCode = trim($checkUserValidity->row('couponCode'));
			$checkCouponUsedFor = $this->db->select('*')
					       ->from('coupons')
					       ->where('coupon',$couponCode)
					       ->where('price <',$planPrice)
					       ->where('date(endDate) >=',date('Y-m-d'))
					       ->get(); 
			if($checkCouponUsedFor->num_rows() > 0) {     
				return TRUE;
			}else{   
				return FALSE;    
			}  */  
			return TRUE;
		}else{
			return FALSE;
		} 
	} 

	 
		public function getCouponOffer($user_id) {
		$checkUserValidity = $this->db->query("SELECT  id,`couponCode` FROM (`price_enquery`) WHERE `pgresponse_code` IS NULL AND `pgresponse` IS NULL AND couponCode != '' AND `registeruser_id` = '".$user_id."' ORDER BY id desc LIMIT 1");

		if($checkUserValidity->num_rows() > 0) {  
			$couponCode = $checkUserValidity->row('couponCode'); 
			$couponCode = trim($couponCode);	
			$PID = $checkUserValidity->row('id'); 
			$query = $this->db->select('CID,coupon,discountNum,offer_percent,price,couponUsed,discountOnMaxPrice')
					 ->from('coupons')  
					 ->where('coupon',$couponCode)
					 ->where('date(endDate) >=',date('Y-m-d'))
					 ->limit(1)  
					 ->get();  

			/*foreach($query->result_array() as $result) {

				$returnArray = array (  
						'CID' => $result['CID'],
						'coupon' => $result['coupon'],
						'discountNum' => $result['discountNum'],
						'offer_percent' => $result['offer_percent'],
						'price' => $result['price'],
						'couponUsed' => $result['couponUsed'],
						'PID' => $PID
						);
			} */
			//$returnResponse = $returnArray;
			$returnResponse = $query->result_array();  
			if($query->num_rows() > 0) {
				$couponUsedFor = $query->row('couponUsed'); 

				if($couponUsedFor == 1) {
					$checkUserValidity = $this->db->select('id')
								      ->from('price_enquery')
								      ->where('couponCode',$couponCode)
								      ->where('pgresponse_code',0)
								      ->where('pgresponse','Transaction Successful')
								      ->where('registeruser_id',$user_id)
								      ->limit(1)
								      ->get();
					if($checkUserValidity->num_rows() > 0) {
 						return FALSE;            
					}else{
						// $this->db->query("UPDATE price_enquery SET  couponCode = ''  WHERE  `registeruser_id` = '".$user_id."' AND couponCode = '".$couponCode."' "); 
						return $returnResponse;

					}   
				}else{ 
					$checkUserValidity = $this->db->select('id')
					      ->from('price_enquery')
					      ->where('couponCode',$couponCode)
					      ->where('pgresponse_code',0)
					      ->where('pgresponse','Transaction Successful')
					      //->where('registeruser_id',$user_id)
					      ->limit(1)
					      ->get();  
 					if($checkUserValidity->num_rows() > 0) {
 						return FALSE;            
					}else{
						// $this->db->query("UPDATE price_enquery SET  couponCode = ''  WHERE  `registeruser_id` = '".$user_id."' AND couponCode = '".$couponCode."' "); 
						return $returnResponse;
					}  
				} 
				   
			}else{  
 				return FALSE;            
			}     
		}else{	        
  			return FALSE;   
		}    
			     
	}     
    
      
	public function addCouponToReports($userid,$name,$total,$pid) {
 
		 $this->db->query("INSERT INTO usedCouponsReports (CID,PID,coupon,couponUsed,discountNum,offer_percent,price,userId,userName,numberOfSms,sms_price,actualPrice,finalPrice,grandTotal,createdDate,modifiedDate) VALUES ('".$_SESSION['couponId']."','".$pid."','".$_SESSION['coupon']."','".$_SESSION['couponUsed']."','".$_SESSION['discountType']."','".$_SESSION['offer_percent']."','".$_SESSION['price']."','".$userid."','".$name."','".$_SESSION['noofsms']."','".$_SESSION['sms_price']."','".$_SESSION['amount']."','".$_SESSION['totalPrice']."','".$total."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."' ) ");
   
	}    
	         
	 
	public function updateCouponAppliedPaymentStatus($transactionId,$userId) {
		$this->db->query("UPDATE usedCouponsReports SET transaction = 'success' , status = 1,transaction_id='".$transactionId."' where PID IN (SELECT id from price_enquery where epg_txnID = '".$transactionId."' AND couponCode = '".$_SESSION['coupon']."' AND registeruser_id = '".$userId."') order by id desc limit 1 ");
		$this->db->update("UPDATE price_enquery SET couponCode = '".$_SESSION['coupon']."' WHERE  epg_txnID = '".$transactionId."' ");       
	 	 $_SESSION['coupon'] = FALSE;  $_SESSION['couponId'] = FALSE;   $_SESSION['discount'] = FALSE; 
	}    
	    
	/** Added block listed on 2017_07_18 **/
    public function isNumberAvailable($user_id, $mNumber)
    {
        $this->db->select('id')
            ->from('block_listed_numbers')
            ->where('user_id', $user_id)
            ->where('mobile_no', $mNumber);

        $query = $this->db->get();
       	if($query->num_rows() > 0)
       		return false;
       	else
        	return true;
    }
	
	
     public function addBNumber($user_id, $number)
    {
        $values = array(
            'user_id' => $user_id,
            'mobile_no' => $number
        );

 
        $rs = $this->db->insert('block_listed_numbers', $values);
        return $rs;
    }
    public function getBlockedNames($user_id) {
		$query = $this->db->query("SELECT * FROM  block_listed_numbers WHERE user_id = '".$user_id."' ORDER BY id desc  ");
		return $query->result();
	
    }
    
    
     public function getBlockNumberDetails($user_id, $bid)
    {
        $this->db->select()
            ->from('block_listed_numbers')
            ->where('user_id', $user_id)
            ->where('id', $bid);  

        $query = $this->db->get();
        return $query->result();
    }	
    
      public function delete_blockedNumber($user_id, $bid)
    {
        $rs = $this->db->where('id', $bid)
            ->where('user_id', $user_id)
            ->delete('block_listed_numbers');

        return $rs;
    }
	
}
