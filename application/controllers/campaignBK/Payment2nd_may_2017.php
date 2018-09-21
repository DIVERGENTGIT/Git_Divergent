<?php
class Payment extends CI_Controller
{
	protected $_credits;
	protected $_servicetax;
	protected $_smsprice;
	protected $_longcode;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		
		$this->load->model('product_model','product');
		$this->load->model('payment_model','payment');
		
		$this->load->helper('url','html');
		$this->data['tax']='';
		$this->data['tax_per']='';
		if($this->session->userdata('user_id')) {            
        	$this->_userId = $this->session->userdata('user_id');
        	$this->load->model('User_model');
			$credits_rs = $this->User_model->getAvailableCredits($this->_userId);
			foreach ($credits_rs as $rs) {
			$this->_credits = $rs->available_credits;
			$this->_data['isftpuser'] = $rs->is_ftp;
			$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
			}
	        
			$gbl_rs = $this->User_model->global_settings();
			foreach ($gbl_rs as $key=>$gblrs) {
			//print_r($gblrs);
			if($gblrs->setting_name=='Service Tax')
			{
			$this->_servicetax = $gblrs->value;
			$tax=$this->data['tax']=$gblrs->value/100;
			$tax_per=$this->data['tax_per']=$gblrs->value;

			$tax=$this->_data['tax']=$gblrs->value/100;
			$tax_per=$this->_data['tax_per']=$gblrs->value;

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

public function confirm(){

extract($_REQUEST);

if($Response_Code=='E000'){
    $Message= 'Transaction Successful';
}else{
    $Message= 'Transaction Cancelled';
}

/*$Total_Amount;
$Transaction_Date;
$Payment_Mode;*/


$ePGTxnID=$Unique_Ref_Number;
$TxnID=$ReferenceNo;
$Transaction_Date;
$RRN=$Payment_Mode;
$AuthIdCode=$Response_Code;
$ResponseCode=$Response_Code;
$web_url=base_url();
	
 $date=date("Y-m-d");
    $data="UPDATE price_enquery SET payment_status=1, pgresponse_code='$ResponseCode',pgresponse='$Message', RRN='$Payment_Mode', epg_txnID='$ePGTxnID', 	authcode='$AuthIdCode' WHERE transaction_id = '$TxnID'";

error_log($data."\r\n",3,"/var/www/html/logs/payments_log/".$date."_.log");


if($Response_Code=='E000')
	{
	
     $sql="UPDATE price_enquery SET payment_status=1, pgresponse_code='$ResponseCode',pgresponse='$Message', RRN='$Payment_Mode', epg_txnID='$ePGTxnID', 
	authcode='$AuthIdCode' WHERE transaction_id = '$TxnID'";
	
	 $upd_mcbill = $this->db->query("UPDATE price_enquery SET payment_status=1, pgresponse_code='$ResponseCode',pgresponse='$Message', RRN='$Payment_Mode', epg_txnID='$ePGTxnID', 
	authcode='$AuthIdCode' WHERE transaction_id = '$TxnID'");
	
	$trn_mcbill = $this->db->query("UPDATE transaction_history SET  payment_status='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', 
	authcode='$AuthIdCode' WHERE transaction_id = '$TxnID'");
	$get_bill = $this->db->query("SELECT * FROM price_enquery WHERE transaction_id = '$TxnID'");
	foreach($get_bill->result_array() as $mbill)
	{
		  	$order_type = $mbill['description'];
		      $bill_id = $mbill['id'];
			$amount = $mbill['amount'];
			$mobile = $mbill['mobile'];
	}
	
	$smsText = "Thank you for choosing our product.  This is to  acknowledge you that we have received payment of Rs $amount Pertaining to the Transaction ID : $ePGTxnID .";
    $sms_url = "http://www.smsstriker.com/API/sms.php?username=support&password=Str!k3r2020&from=SMSSTR&to=$mobile&msg=".urlencode($smsText)."&type=1";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sms_url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //$res=curl_exec($ch);
    $res=true;
    if($res){


// redirect success case start

    if($order_type == "Add SMS Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>index.php/Payment/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "Add Longcode Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "dedicated")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shared")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shorturl")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/campaign/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}
	else if($order_type == "longcode Dedicated Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/renwaldedicated/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>  
	<?php     
	} 
	else if($order_type == "longcode Shared Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/renwalshared/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}       
	else
	{
	?>
	<script language="javascript" type="text/javascript">
	window.self.location='<?php print $web_url;?>index.php/Payment/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
      <?php
	}
// redirect success case start

     } 
    curl_close($ch);
} 
else { // failed case

$get_bill = $this->db->query("SELECT * FROM price_enquery WHERE transaction_id = $TxnID");

	foreach($get_bill->result_array() as $mbill)
	{
	    $order_type = $mbill['description'];
	}

	$upd_mcbill = $this->db->query("UPDATE price_enquery SET payment_status=1, pgresponse_code='$ResponseCode',
	pgresponse='$Message', RRN='$RRN',  authcode='$AuthIdCode' WHERE transaction_id = $TxnID");


	 $trn_mcbill = $this->db->query("UPDATE transaction_history SET pgresponse_code='$ResponseCode',
	payment_status='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', authcode='$AuthIdCode' WHERE transaction_id = $TxnID");

	// redirect cancel case start

	if($order_type == "Add SMS Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>index.php/Payment/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "Add Longcode Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "dedicated")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shared")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shorturl")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/campaign/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}
	else if($order_type == "longcode Dedicated Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/renwaldedicated/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>  
	<?php     
	} 
	else if($order_type == "longcode Shared Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/renwalshared/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}       
	else
	{
	?>
	<script language="javascript" type="text/javascript">
	window.self.location='<?php print $web_url;?>index.php/Payment/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
      <?php
	}
// redirect cancel case end
	
 }

 }

	public function paynow()
	{
    $this->load->view('payments/cart_form');
	} 
	
/********* encrypt payment gateway values  *****************/
public function encryptPaynow($amount,$referenc_id)
	{
		$key = $this->config->item('MerchantKey');
		$MerchantId = $this->config->item('MerchantId');
		//Mandatory Fields Start
		$ReferenceNo =$referenc_id;
		$SubMarchantID =$MerchantId;
		$TransactionAmt =$amount;
		$mandatoryfields = $ReferenceNo.'|'.$SubMarchantID.'|'.$TransactionAmt;
		$Encrypt_MandatoryFields = $this->aes128Encrypt($mandatoryfields,$key);
		$returnurl = $this->config->item('returnurl');
		$Encrypt_ReturnUrl = $this->aes128Encrypt($returnurl,$key);
		$Encrypt_ReferenceNo = $this->aes128Encrypt($ReferenceNo,$key);
		$Encrypt_SubMerchantId = $this->aes128Encrypt($SubMarchantID,$key);
		$Encrypt_TransactionAmount = $this->aes128Encrypt($TransactionAmt,$key);
		$paymode = $this->config->item('paymode');
		$Encrypt_PaymentMode = $this->aes128Encrypt($paymode,$key);
		$paymenturl=$this->config->item('paymenturl');

	/*echo $Beforeurl="$paymenturl?merchantid=$MerchantId&mandatory fields=$mandatoryfields&optional fields=&returnurl=$returnurl&Reference No=$ReferenceNo&submerchantid=$MerchantId&transaction amount=$TransactionAmt&paymode=$paymode";
echo "<br>";*/
		 $url="$paymenturl?merchantid=$MerchantId&mandatory fields=$Encrypt_MandatoryFields&optional fields=&returnurl=$Encrypt_ReturnUrl&Reference No=$Encrypt_ReferenceNo&submerchantid=$Encrypt_SubMerchantId&transaction amount=$Encrypt_TransactionAmount&paymode=$Encrypt_PaymentMode";
		redirect($url);
	}
public function aes128Encrypt($str,$key)
	{
		$block = mcrypt_get_block_size('rijndael_128', 'ecb');
		$pad = $block - (strlen($str) % $block);
		$str .= str_repeat(chr($pad), $pad);
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB));
	}


	public function confirm_order()
	{
		session_start();
		$user_id=$this->session->userdata('user_id');
         $this->load->model('user_model');
        	$this->load->library('cart');
		$user_id=$this->session->userdata('user_id');
		$this->_data['products'] = $this->cart->contents($user_id);
		  // print_r($this->_data['products']);  
		$this->_data['total'] = $this->cart->total();
		$this->_data['total_items'] = $this->cart->total_items();
		if($this->uri->segment(3)!='')
		{
			  $ids = base64_decode($this->uri->segment(3));
		}
		  
		if(@$_POST['confirm_order']!='')
		{
		extract($_POST);
		//print_r($_POST);exit;
		$sql="SELECT state from new_statelist WHERE state_id = $getstate_id";
		$new_statelist=$this->db->query($sql)->result();
		foreach($new_statelist as $key => $svalue)
		{
		$state=$svalue->state;
		}
		$sql="SELECT city_name from new_citylist WHERE city_id = $getcity_id";
		$new_citylist=$this->db->query($sql)->result();
		foreach($new_citylist as $key => $cvalue)
		{
		$city=$cvalue->city_name;
		}

		$sql="update users set state_id = $getstate_id,city_id = $getcity_id WHERE user_id = $user_id";
		$this->db->query($sql);

		//exit;

		$this->session->set_userdata('or_state',$state);
		$this->session->set_userdata('or_city',$city);

		$this->session->set_userdata('or_zipcode',$zipcode);
		$this->session->set_userdata('or_address',$address);
		$this->session->set_userdata('or_organization',$organization);
		// echo $this->session->userdata('or_state');
		$_SESSION['product_id'] = $ids;
		$userid= $this->session->userdata('user_id');
		
		$gettotal_amount=ceil($total_amount);
		if($_SESSION['couponId']) {    
       
 			$this->user_model->addCouponToReports($userid,$name,$gettotal_amount,$ids); 
		} 
		/*$val = 'amount='.base64_encode($amount).'&tax_amount='.base64_encode($tax_amount).'&total_amount='.base64_encode($gettotal_amount).'&name='.base64_encode($name).
		'&sms_price='.base64_encode($sms_price).'&trnsale='.base64_encode($qty).'&customerid='.base64_encode($userid).
		'&address1='.base64_encode($address).'&address2='.base64_encode($address).
		'&state='.base64_encode($state).'&city='.base64_encode($city).
		'&zip='.base64_encode($zipcode).
		'&mobile='.base64_encode($mobile).'&email='.base64_encode($email);
		$testssl_url=base_url()."payment/TestSsl.php?ids=".base64_encode($ids)."&".$val;*/
		//redirect($testssl_url);
		$transaction_id = mt_rand(100000, 999999);
		$sql="update price_enquery set transaction_id='$transaction_id'  where id in ($ids)";
		$this->db->query($sql);
		$query = "insert into transaction_history (user_id,noofsms,sms_price,amount,tax_amount,total_amount,transaction_id)
		values ($userid,$qty,$sms_price,$amount,$tax_amount,$gettotal_amount,'$transaction_id')";
		$this->db->query($query);
		
		$this->encryptPaynow($gettotal_amount,$transaction_id);

	
	}
	if(isset($_REQUEST['tn']))  
		{
			if($_REQUEST['rm']=='Transaction Successful' || $_REQUEST['rm']=='Transaction Cancelled')
			{
				$transaction_id = $_REQUEST['tn']; 
 
				if($_REQUEST['rm']=='Transaction Successful')  {
					if($_SESSION['couponId']) { 
	  
						  $this->user_model->updateCouponAppliedPaymentStatus($transaction_id,$user_id);  
					}
				}                 
				foreach($this->cart->contents() as $key=>$value)  
				{  
				$data = array(  
				'rowid' => $value['rowid'],
				'qty'   => 0
				);
				$this->cart->update($data);
				$id=$value['id'];     
				$sql="update price_enquery set order_status=1 where id=$id";
				$this->db->query($sql);
				} 
			}
		}
		 	$this->load->model('user_model'); 
		$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
		$user=$this->db->query($sql)->result();
		$usertype='';
		foreach($user as $key => $value)
		{  

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

  
			$this->_data['state']=$value->state_id;
			$this->_data['city_name']=$value->city_id;
			$this->_data['address']=$value->address1;
			$this->_data['zipcode']=$value->zipcode;
			$this->_data['organization']=$value->organization;
			$this->_data['email']=$value->email;
			$this->_data['mobile']=$value->mobile;  
		}
		$price=0; 
		$qty=0;
		$ids='';
		$noofsms=0;
		$pkg_range=''; 
		$sms_price ='';
		$pid = 0;
		foreach($this->_data['products'] as $product){
			$ids .= $product['id'].",";
			$price = $price+$product['price'];
			$qty = $qty + $product['qty'];
			$smstype = $product['name'];
		}
		$this->_data['ids'] = $ids =trim($ids,","); 
		$this->data['noofsms'] = $noofsms=$qty;
		if($noofsms>0)  
		{ 
			$noofsms=$noofsms;
		}
		$pkg_range='';
		$sql="SELECT * FROM `sms_packages` where noofsms<=$noofsms order by id desc limit 1";
		$rs= $this->db->query($sql)->result();
		$sms_price ='';
		foreach($rs as $key=>$pricevalue)
		{ 
			$sms_price = $pricevalue->$usertypecol;
		}
		$idss=trim($ids,',');
		$smsprice = $price = $sms_price;
	
 		$amount = 0;$numberOfSms = '';
		foreach($this->_data['products'] as $product){ 
			//print_r($product);
			$numberOfSms = $numberOfSms+$product['qty'];
			$amount1=$product['qty']*$price; 
			$tax_amount1=round(($amount1 *$this->_servicetax)/100);
			$total_amount1=$amount1+$tax_amount1;
			$pid = $product['id']; 
			$amount = $amount+$amount1; 
			 
			$sql1="update price_enquery set price_per_sms='$sms_price',amount=$amount1,tax_amount=$tax_amount1, total_amount=$total_amount1,couponCode = '".$product['couponCode']."'where id=$pid";
			$rs=$this->db->query($sql1);
   
		}  

 
  
		$this->_data['discount'] = 0; $couponId='';$coupon='';
		/*** APPLYING COUPON START ***/
		$totalPrice = $amount;$discountType = 0;$couponUsed='';$offerPercent='';$discountPrice='';$discountOnMaxPrice = 0;

		$getDiscount = $this->user_model->getCouponOffer($user_id);
 		
		if($getDiscount) {	   
			 foreach($getDiscount as $response) {  
				$discountType = $response['discountNum'];    
				$offerPercent = $response['offer_percent'];
				$discountPrice = $response['price'];
				$couponId = $response['CID'];
				$coupon = $response['coupon'];
				$couponUsed = $response['couponUsed'];
				$discountOnMaxPrice = $response['discountOnMaxPrice'];
				$this->_data['discount'] = ($offerPercent)?$offerPercent:$discountPrice;
			 }  
 
			//1-%discount  On Amount,2-%discount  On Plan Price,3-Rs/-discount On price
			if($totalPrice >= $discountOnMaxPrice) {
				if($discountType == 1) { // percent based discount
					if($offerPercent > 0) {
						$total = $numberOfSms*($smsprice);  
						$price = ($total*$offerPercent)/100;  
						$totalPrice = $total-$price;   
					}
	  
				}else if($discountType == 2) {
					//echo $discountPrice;
					if($discountPrice > 0) {
						if($smsprice > $discountPrice) {
							$smsprice = $smsprice-$discountPrice;								
						}else{
							$this->_data['discount'] = 0;
						}     
					}    				
					$total = $noofsms*($smsprice);	
					$totalPrice = $total; 
				}else{  
					if($discountPrice > 0) {
						$total = $numberOfSms*($smsprice);	// Rupees based discount
	 
						$totalPrice = $total-$discountPrice; 
  					}  
				}     

			}else{
				$discountType = 0;
				$this->_data['discount'] = 0;
				$offerPercent=0;$couponUsed=0;$discountPrice=0;$couponId=0;$coupon='';
			}
		}  
		/*** APPLYING COUPON END ***/   
 
		$_SESSION['totalPrice'] = $totalPrice;
		$_SESSION['discount'] = $this->_data['discount'];  
		$_SESSION['offer_percent'] = $offerPercent;
		$_SESSION['couponUsed'] = $couponUsed;  
		$_SESSION['price'] = $discountPrice;  
		$_SESSION['discountType'] = $discountType;
        	$_SESSION['noofsms'] = $numberOfSms;  
        	$_SESSION['sms_price'] = $sms_price;
        	$_SESSION['amount'] = $amount;		  	
		$_SESSION['couponId'] = $couponId;    
		$_SESSION['coupon'] = $coupon; 
		$_SESSION['taxAmount']  = $tax_amount=round(($totalPrice *$this->_servicetax)/100);
		$_SESSION['total_amount'] = $total_amount1=$totalPrice+$tax_amount;
 
		
  
	$this->_data['tax']=$this->_servicetax;    
	$this->_data['smsprice']=$this->_smsprice;  
	$this->_data['available_credits']=$this->_credits;
	$this->load->view('includes/header',$this->_data);
	$this->load->view('includes/leftmenu');
	$this->load->view('payments/confirm_order',$this->_data);
	$this->load->view('/includes/footer');
    
	}  
	
     public function add_credits(){
	$this->load->model('user_model'); 
	session_start();
	$user_id=$this->session->userdata('user_id'); 
	$this->_data['couponVerified'] = $this->user_model->getUserVerifiedCoupon($user_id);
	$this->_data['tax']=$this->_servicetax;
	$this->_data['smsprice']=$this->_smsprice;  
	$this->_data['available_credits']=$this->_credits;  
	$this->load->view('includes/header',$this->_data);
	$this->load->view('includes/leftmenu');  
	$this->load->view('payments/add_credits',$this->_data);
	$this->load->view('/includes/footer'); 
       
     }
     
     	
 public function confirm_add_credits()
	{
	session_start();
	$user_id=$this->session->userdata('user_id');
 	$this->load->model('user_model');
 
     	if(!empty($_POST['noofsms']) && @$_POST['noofsms']!='')
        {
 
		//print_r($_POST);
        	$noofsms = $_POST['noofsms'];
        	$smsprice = $_POST['sms_price'];
        	$amount = $_POST['amount'];   
		$this->_data['discount'] = 0; $couponId='';$coupon='';
		/*** APPLYING COUPON START ***/
		$totalPrice = $amount;$discountType = 0;$couponUsed='';$offerPercent='';$discountPrice='';$discountOnMaxPrice=0;

		$getDiscount = $this->user_model->getCouponOffer($user_id);
 
		if($getDiscount) {	   
			foreach($getDiscount as $response) {  
				$discountType = $response['discountNum'];    
				$offerPercent = $response['offer_percent'];
				$discountPrice = $response['price'];
				$couponId = $response['CID'];
				$coupon = $response['coupon'];
				$couponUsed = $response['couponUsed'];
				$discountOnMaxPrice = $response['discountOnMaxPrice'];
				$this->_data['discount'] = ($offerPercent)?$offerPercent:$discountPrice;
			}  

			if($totalPrice >= $discountOnMaxPrice) {

				if($discountType == 1) {
					if($offerPercent > 0) {
						$total = $noofsms*($smsprice);  
						$price = ($total*$offerPercent)/100;  
						$totalPrice = $total-$price;   
					}
	  
				}else if($discountType == 2) {
  					//echo $discountPrice;
					if($discountPrice > 0) {
						if($smsprice > $discountPrice) {
							$smsprice = $smsprice-$discountPrice;								
						}else{
							$this->_data['discount'] = 0;
						}     
					}    				
					$total = $noofsms*($smsprice);	
					$totalPrice = $total;     
				}else{  
					if($discountPrice > 0) {
						$total = $noofsms*($smsprice);	
						$totalPrice = $total-$discountPrice; 
					}   
				}  
			}else{
				$discountType = 0;
				$this->_data['discount'] = 0;
				$offerPercent=0;$couponUsed=0;$discountPrice=0;$couponId=0;$coupon='';
			}
		}  
		/*** APPLYING COUPON END ***/  
   
 
		$_SESSION['totalPrice'] = $totalPrice;
		$_SESSION['discount'] = $this->_data['discount'];
		$_SESSION['offer_percent'] = $offerPercent;
		$_SESSION['couponUsed'] = $couponUsed;  
		$_SESSION['price'] = $discountPrice;  
		$_SESSION['discountType'] = $discountType;
        	$_SESSION['noofsms'] = $_POST['noofsms'];  
        	$_SESSION['sms_price'] = $_POST['sms_price'];
        	$_SESSION['amount'] = $_POST['amount'];		  	
		$_SESSION['couponId'] = $couponId;  
		$_SESSION['coupon'] = $coupon;
        }
	if(@$_POST['confirm_order']!='')  
	{
		extract($_POST); 
	        $sql="SELECT state from new_statelist WHERE state_id = $getstate_id";
			$new_statelist=$this->db->query($sql)->result();
			foreach($new_statelist as $key => $svalue)
			{
			$state=$svalue->state;
			}
			$sql="SELECT city_name from new_citylist WHERE city_id = $getcity_id";
			$new_citylist=$this->db->query($sql)->result();
			foreach($new_citylist as $key => $cvalue)
			{
			$city=$cvalue->city_name;
			}
			
          	$sql="update users set state_id = $getstate_id,city_id = $getcity_id WHERE user_id = $user_id";
	    	$this->db->query($sql);
	    
 
	    
		 $this->session->set_userdata('or_state',$state);
		 $this->session->set_userdata('or_city',$city);
		 
		 $this->session->set_userdata('or_zipcode',$zipcode);
		 $this->session->set_userdata('or_address',$address);
		 $this->session->set_userdata('or_organization',$organization);
		// echo $this->session->userdata('or_state');
		 $_SESSION['product_id'] = $ids;
		 $userid= $this->session->userdata('user_id');
		 
		$gettotal_amount=ceil($total_amount);  
		if($_SESSION['couponId']) {    
   
 			$this->user_model->addCouponToReports($userid,$name,$gettotal_amount,$ids); 
		} 
		 /*   
		$val = 'amount='.base64_encode($amount).'&tax_amount='.base64_encode($tax_amount).'&total_amount='.base64_encode($gettotal_amount).'&name='.base64_encode($name).
'&sms_price='.base64_encode($sms_price).'&trnsale='.base64_encode($qty).'&customerid='.base64_encode($userid).
'&address1='.base64_encode($address).'&address2='.base64_encode($address).
'&state='.base64_encode($state).'&city='.base64_encode($city).
'&zip='.base64_encode($zipcode).
'&mobile='.base64_encode($mobile).'&email='.base64_encode($email);
$testssl_url=base_url()."payment/TestSsl.php?ids=".base64_encode($ids)."&".$val;
redirect($testssl_url);*/
	$transaction_id = mt_rand(100000, 999999);
	$sql="update price_enquery set transaction_id='$transaction_id'  where id in ($ids)";
	$this->db->query($sql);
	$query = "insert into transaction_history (user_id,noofsms,sms_price,amount,tax_amount,total_amount,transaction_id)
	values ($userid,$qty,$sms_price,$amount,$tax_amount,$gettotal_amount,'$transaction_id')";
	$this->db->query($query);
	$this->encryptPaynow($gettotal_amount,$transaction_id);
	}	
		       
	  if(isset($_REQUEST['tn'] )) 
	  {
		if($_REQUEST['rm']=='Transaction Successful') 
		{
  			$transaction_id = $_REQUEST['tn']; 
			if($_SESSION['couponId']) {   
				$this->user_model->updateCouponAppliedPaymentStatus($transaction_id,$this->_userId);  
			}   
  		}  
	 }      
   		

		$this->_data['tax']=$this->_servicetax;
		$this->_data['smsprice']=$this->_smsprice;
		$this->_data['available_credits']=$this->_credits;
		$this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('payments/add_credits_confirm',$this->_data);
		$this->load->view('/includes/footer');
    
	}
	  
     public function order_history(){
	    
        session_start();
	    $user_id=$this->session->userdata('user_id');
        $limit="15";
        $offset='0';
		if($this->uri->segment(3)!='')
		{
		 	$offset=$this->uri->segment(3);
		}
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
        $to_date=date('Y-m-d');
        $tr_ID='';
        $trn_status='';
        $trn_service='';
        
		if($this->input->post('Search')=='Search')
		{
		//print_r($_POST);
		$_SESSION['from_date']=$this->input->post('from_date');
		$_SESSION['to_date']=$this->input->post('to_date');
		$_SESSION['trn_transid']=trim($this->input->post('trn_transid'));
		$_SESSION['trn_status']=$this->input->post('trn_status');
		$_SESSION['trn_service']=$this->input->post('trn_service');
		}
		
		//echo $_SESSION['from_date'];
		if(@$_SESSION['from_date']!='')
		{
		$from_date=$_SESSION['from_date'];
		}
        if(@$_SESSION['to_date']!='')
		{
		$to_date=$_SESSION['to_date'];
		}
        if(@$_SESSION['trn_transid']!='')
		{
		$tr_ID=$_SESSION['trn_transid'];
		}
       if(@$_SESSION['trn_status']!='')
		{
		$trn_status=$_SESSION['trn_status'];
		}
		
	 if(@$_SESSION['trn_service']!='')
		{
		$trn_service=$_SESSION['trn_service'];
		}
		
		//echo $from_date;
		$total_products = $this->payment->order_history_count($user_id,$from_date,$to_date,$tr_ID,$trn_status,$trn_service);
		$this->_data['products'] = $this->payment->order_history($user_id,$from_date,$to_date,$tr_ID,$trn_status,
		$trn_service,$limit,$offset);
		//print_r($this->_data['products']);
		    $this->load->library('pagination');
			$config['base_url'] = base_url().'/Payment/order_history';
		    $config['total_rows'] = @$total_products;
			$config['per_page'] = $limit; 
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
		
		$this->_data['from_date']=$from_date;
		$this->_data['to_date']=$to_date;
		$this->_data['tax']=$this->_servicetax;
		$this->_data['smsprice']=$this->_smsprice;
		$this->_data['available_credits']=$this->_credits;
        $this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//print_r($this->_data['products']);
		$this->load->view('payments/order_history',$this->_data);
		//$this->load->view('campaign/messages');
		$this->load->view('/includes/footer');
		
	}
	
 public function order_details(){
	
	    $user_id=$this->session->userdata('user_id');
	    $trnid='';
	    if($this->uri->segment(3)!='')
	    {
	    $trnid=$this->uri->segment(3);
	    }
        $limit="15";
        $offset='0';
		if($this->uri->segment(4)!='')
		{
		 	$offset=$this->uri->segment(4);
		}
	    //echo  $trnid='201701117119021';
		$total_products = $this->payment->order_details_count($user_id,$trnid);
	    $this->_data['products'] = $this->payment->order_details($user_id,$trnid,$limit,$offset);
		
		$order_details_noofsms = $this->payment->order_details_noofsms($user_id,$trnid);
		
                   foreach($order_details_noofsms as $key=>$pricevalue)
					{
					
						  $noofsms = $pricevalue->noofsms;
						
					}
		
		 $this->_data['getnoofsms']=$noofsms;
		
                       
                           
		
	
		//print_r($this->_data['products']);
		    $this->load->library('pagination');
			$config['base_url'] = base_url().'/Payment/order_details/'.$this->uri->segment(3);
		    $config['total_rows'] = @$total_products;
			$config['per_page'] = $limit; 
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
        
		$this->_data['tax']=$this->_servicetax;
		$this->_data['smsprice']=$this->_smsprice;
		$this->_data['available_credits']=$this->_credits;
        $this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//print_r($this->_data['products']);
		$this->load->view('payments/order_details',$this->_data);
		//$this->load->view('campaign/messages');
		$this->load->view('/includes/footer');
		
	}

/****
missed call payments
****/

public function order_numbers()
	{	
	      //date_default_timezone_set('asia/kolkata');
	      
	      //$this->load->model('Voice_rental_model'); 
	        
	      $data=array();
		$this->_data['didprice_result']=array();
		  $this->load->model("User_model");
		  $gbl_rs = $this->User_model->global_settings();
	        foreach ($gbl_rs as $key=>$gblrs) {
	      //  print_r($gblrs);
			  if($gblrs->setting_name=='Service Tax')
			  {
			  $this->_servicetax = $gblrs->value;
			  $tax=$this->data['tax']=$gblrs->value/100;
			  $tax_per=$this->data['tax_per']=$gblrs->value;
			  
		     		$tax=$this->_data['tax']=$gblrs->value/100;
		    	      $tax_per=$this->_data['tax_per']=$gblrs->value;
			  
			  }
	        }
	        
	      
		/*
		$user_id = $this->_data['user_id'] = $this->session->userdata('user_id');
        	if(!$this->session->userdata('user_id')) 
        	{            
        		redirect('index');
        	}*/
        	      $plan_service=$_REQUEST['plan_service'];
        	      $real_url=$this->config->item('firstring_url');
			$qry_fields =array();
			$cart_val=array();
			$did_url = $real_url."API/smsstriker/get_cart.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
		 	
			if(count($getsilver_didlist_api)>0)
		 	{
			 $cart_val =$getsilver_didlist_api;
			}
			else
			{
			$cart_val=array();
			}
			 
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
			$array_did[$xyz] = $did_val['did_number'];
			$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
        	
        	
        	
        	if(@$_REQUEST['snos']!='')
        	{
        	  $_SESSION['sel_nos']=$_REQUEST['snos'];
        	}
	      
	            $did_types=array();
	            $rs=array();
	            $plan_service="Missedcall";
	            $real_url=$this->config->item('firstring_url');
			$qry_fields =array('getservice_value' => urlencode('getservice_value'),'service_value' => urlencode($plan_service));
			$did_url = $real_url."API/smsstriker/order_numbers.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
		 	
			 $rs =$getsilver_didlist_api;
			 
			if(count($getsilver_didlist_api)>0)
			{
			 $rs =$getsilver_didlist_api;
			}
			else
			{
			$rs=array();
			}
			 
			// print_r($rs);
			 
				foreach($rs as $key=>$value)
				{
				$rs3=explode(',',$value['service_types']);
					foreach($rs3 as $key=>$value3)
					{
					$did_name=$value3;
					$real_url=$this->config->item('firstring_url');
		                  $qry_fields =array('getdid_name' => urlencode('getdid_name'),'did_name' => urlencode($did_name));
					$did_url = $real_url."API/smsstriker/order_numbers.php";
					$qry_fields_string = http_build_query($qry_fields);
					$did_conn= curl_init();
					//set the url, number of POST vars, POST data
					curl_setopt($did_conn,CURLOPT_URL, $did_url);
					curl_setopt($did_conn,CURLOPT_POST, count($_POST));
					curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
					curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
					curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
					//execute post
					$did_result = curl_exec($did_conn);
					$getsilver_didlist_api=json_decode($did_result, true);
					curl_close($did_conn);
					$rs2=$getsilver_didlist_api;
						foreach($rs2 as $key=>$value1)
						{
						@$did_name = $value1['did_name'];
						@$did_value = $value1['did_value'];
						array_push($did_types,array('did_name'=>$did_name,'did_value'=>$did_value));
						}
					}
				}
			// print_r($did_types);
	      $this->_data['did_types']=$did_types;
        	//print_r($this->_data['did_types']);	
		$this->_data['avl_silvernos'] = $this->get_didnos('SILVER',$plan_service);
		$this->_data['avl_goldnos'] = $this->get_didnos('GOLD',$plan_service);
		$this->_data['avl_platinumnos'] = $this->get_didnos('PLATINUM',$plan_service);
		// get did numbers price sart
		
			if(@$_SESSION['sel_nos']!='')
			{
			$did_nos= @$_SESSION['sel_nos'];
			$data['did_nos']=$did_nos;
			//$real_url=$this->data['real_url'];
			$real_url=$this->config->item('voice_did_url');
			$qry_fields =array('did_nos' => urlencode($did_nos));
			$did_url = $real_url."get_didprice_api.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
			$result1  =$getsilver_didlist_api;
				if(count($result1)>0)
				{
				   $this->data['didprice_result']=$result1;
				   
				}
		      }
		      
		      //print_r($result1);
		// get did numbers price sart
		
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		
		$this->load->view('missedcall_payments/order_numbers',$this->_data);
		//$this->load->view('include/footer');
	}
	
	
	
	public function get_didnos($did_plan,$plan_service)
	{   
	      //date_default_timezone_set('asia/kolkata');  
		//$real_url=$this->data['real_url'];
		$real_url=$this->config->item('voice_did_url');
		$qry_fields =array('did_plan' => urlencode($did_plan),'did_service' => urlencode($plan_service));
	      $did_url = $real_url."get_didnos.php";
		$qry_fields_string = http_build_query($qry_fields);
		$did_conn= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getsilver_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getsilver_didlist_api;
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}
		return $result;
	}
	// for getdidnos_price 18-10-2016.
	
	public function getdidnos_price()
	{
		//date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		$user_id=$this->session->userdata('user_id');
		//print_r($_REQUEST['snosprice']);
		$did_nos=trim($_REQUEST['snosprice'],","); 
		$data['did_nos']=$did_nos;

		//$real_url=$this->data['real_url'];
		$real_url=$this->config->item('voice_did_url');
		$qry_fields =array('did_nos' => urlencode($did_nos));
		$did_url = $real_url."get_didprice_api.php";
		$qry_fields_string = http_build_query($qry_fields);
		$did_conn= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getsilver_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getsilver_didlist_api;
		if(count($result1)>0)
		{
		//$data['result']=$result1;
		
			// insert order numbers
			
			foreach($result1 as $key=>$number)
			{
				$did_number=$number['did_number'];
				$did_type=$number['did_type'];
				$did_plan=$number['did_plan'];
				$did_price=$number['did_price'];
				$pri_rental=$number['pri_rental'];
				$mobile_rental=$number['mobile_rental'];
				$tollfree_rental=$number['tollfree_rental'];
		            $sqlcount="select * from order_numbers where status=1 and user_id=$user_id";
				$querycount=$this->db->query($sqlcount);
				//echo $querycount->num_rows();
				if($querycount->num_rows()<=2)
				{
					$sql1="select * from order_numbers where did_number='$did_number' and user_id=$user_id";
					$query=$this->db->query($sql1);
					//echo $query->num_rows();
					if($query->num_rows()==0)
					{
					$status=1;
					$sql="insert into order_numbers (user_id,did_number,did_type,
					did_plan,did_price,status,pri_rental,mobile_rental,tollfree_rental)
					values($user_id,'$did_number','$did_type','$did_plan','$did_price','$status',
					'$pri_rental','$mobile_rental','$tollfree_rental')";
					$this->db->query($sql);	
					}
					else
					{
					$sql3="update  order_numbers set  status=1 where status=0 and user_id=$user_id and did_number='$did_number'";
				      $this->db->query($sql3);
					}
				
				}

			}
		
		}
		
		// get order numbers
		
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		$data['result']=$query_result;
		
		$this->load->view('missedcall_payments/viewdidprice',$data);	
	}
	
	
	
	public function SelectedNumbers()
	{
		//date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		$user_id=$this->session->userdata('user_id');
		//print_r($_REQUEST['snosprice']);
		$did_nos=trim($_REQUEST['snosprice'],","); 
		$data['did_nos']=$did_nos;

		//$real_url=$this->data['real_url'];
		$real_url=$this->config->item('voice_did_url');
		$qry_fields =array('did_nos' => urlencode($did_nos));
		$did_url = $real_url."get_didprice_api.php";
		$qry_fields_string = http_build_query($qry_fields);
		$did_conn= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getsilver_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getsilver_didlist_api;
		if(count($result1)>0)
		{
		//$data['result']=$result1;
		
			// insert order numbers
			
			foreach($result1 as $key=>$number)
			{
				$did_number=$number['did_number'];
				$did_type=$number['did_type'];
				$did_plan=$number['did_plan'];
				$did_price=$number['did_price'];
				$pri_rental=$number['pri_rental'];
				$mobile_rental=$number['mobile_rental'];
				$tollfree_rental=$number['tollfree_rental'];
		            $sqlcount="select * from order_numbers where status=1 and user_id=$user_id";
				$querycount=$this->db->query($sqlcount);
				//echo $querycount->num_rows();
				if($querycount->num_rows()<=2)
				{
					$sql1="select * from order_numbers where did_number='$did_number' and user_id=$user_id";
					$query=$this->db->query($sql1);
					//echo $query->num_rows();
					if($query->num_rows()==0)
					{
					$status=1;
					$sql="insert into order_numbers (user_id,did_number,did_type,
					did_plan,did_price,status,pri_rental,mobile_rental,tollfree_rental)
					values($user_id,'$did_number','$did_type','$did_plan','$did_price','$status',
					'$pri_rental','$mobile_rental','$tollfree_rental')";
					$this->db->query($sql);	
					}
					else
					{
					$sql3="update  order_numbers set  status=1 where status=0 and user_id=$user_id and did_number='$did_number'";
				      $this->db->query($sql3);
					}
				
				}

			}
		
		}
		
		// get order numbers
		
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		$data['result']=$query_result;
		
		$this->load->view('missedcall_payments/viewdidprice',$data);	
	}
	
	
	public function DisplayNumbers()
	{
		// get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		$data['result']=$query_result;
		
		$this->load->view('missedcall_payments/viewdidprice',$data);	
	}
	
	public function orderNumbers()
	{
		// get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		if(count($query_result)>0)
		{
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		print_r(json_encode(array('orderNumbers'=>$_SESSION['sel_nos'])));
		}
		print_r(json_encode(array('orderNumbers'=>"0")));	
	}
	
	public function cancel_did_numbers()
	{
	      //date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		//print_r($_REQUEST['snosprice']);
		$did_nos=trim($_REQUEST['snosprice'],",");
		
		$user_id=$this->session->userdata('user_id');
		
		$sql3="update  order_numbers set  status=0 where status=1 and user_id=$user_id and did_number in ($did_nos)";
		$this->db->query($sql3);
		
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		
		$data['result']=$query_result;
		
		$this->load->view('missedcall_payments/viewdidprice',$data);	
	
	}
	
	public function get_did_numbers()
	{
	
	      //date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		
		$data['result']=$query_result;
		
		$this->load->view('missedcall_payments/viewdidprice',$data);	
	
	}
	
		
public function getuserforms()
	{
	
	      //date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		
		$data['result']=$query_result;
		
		$this->load->view('missedcall_payments/userform',$data);	
	
	}
	
	public function userlogin()
	{
	//print_r($_REQUEST);
	      extract($_REQUEST);
	      //date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		     $_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		
		      $real_url=$this->config->item('firstring_url');
		      
			$qry_fields =array('userlogin'=>'userlogin','username'=>$username,'password'=>$password,
			'mobileno'=>$mobileno,'user_id'=>$user_id,'did_numbers'=>$_SESSION['sel_nos'],'didcost'=>$_REQUEST['didcost']);
			$did_url = $real_url."API/smsstriker/registration.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			echo $did_result = curl_exec($did_conn);
			//$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
	}


	public function userregistration()
	{
	      extract($_REQUEST);
	      //date_default_timezone_set('asia/kolkata');
		$data=array();
		$data['result']=array();
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		     $_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		
		      $real_url=$this->config->item('firstring_url');
		      
			$qry_fields =array('registration'=>'registration','user_id'=>$user_id,'username'=>$username,'firstname'=>$firstname,
			'lastname'=>$lastname,'password'=>$password,'emailid'=>$emailid,'emailid'=>$emailid,'mobileno'=>$mobileno,'organization'=>$organization,'address1'=>$address1,'address2'=>$address2,'state_id'=>$state_id,'city_id'=>$city_id,'pincode'=>$pincode,'did_numbers'=>$_SESSION['sel_nos'],'didcost'=>$didcost);
			
			$did_url = $real_url."API/smsstriker/registration.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			echo $did_result = curl_exec($did_conn);
			//$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
	}
	
	
	public function Search_silverno()
	{
	      //date_default_timezone_set('asia/kolkata');
		$silverno = $this->_data['silverno']=$_REQUEST['silverno'];
		$checkedno = $this->_data['checkedno']=$_REQUEST['checkedno'];
		$service_type = $this->_data['service_type']=$_REQUEST['service_type'];
		
		$Number_type = $this->_data['Number_type']=$_REQUEST['Number_type'];
		//echo ($this->_data['checkedno']);
		//exit;		
		//$cart_val = $this->Voice_rental_model->get_cart();
		
		      $real_url=$this->config->item('firstring_url');
			$qry_fields =array();
			$cart_val=array();
			$did_url = $real_url."API/smsstriker/get_cart.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
		 	if(count($getsilver_didlist_api)>0)
		 	{
			 $cart_val =$getsilver_didlist_api;
			}
			else
			{
			$cart_val=array();
			}
			
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
		$array_did[$xyz] = $did_val['did_number'];
		$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
		
		// GET SILER SERACH NOS   
		$real_url=$this->config->item('voice_did_url');
		$qry_fields =array('did_plan' => urlencode('SILVER'),'search_no' => urlencode($_REQUEST['silverno']),'service_type' => urlencode($_REQUEST['service_type']),'Number_type' => urlencode($_REQUEST['Number_type']));
		//print_r($qry_fields);
		//exit;
		$did_url = $real_url."get_livedidnos_api.php";		
		$qry_fields_string = http_build_query($qry_fields);
		$did_conn= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		//exit;
		$getsilver_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getsilver_didlist_api;
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}

		$this->_data['avl_silvernos'] = $result;	
		//return $result;
		//print_r($this->_data['avl_silvernos']);
		
		
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/

		$this->load->view('missedcall_payments/service_nos/getsilver_nos',$this->_data);	 
	}
	
	public function existing_order_numbers()
	{
	            //date_default_timezone_set('asia/kolkata');
                  $plan_service=$_REQUEST['plan_service'];
                  $user_id=$_REQUEST['user_id'];
		      $real_url=$this->config->item('firstring_url');
			$qry_fields =array('user_id'=>$user_id,'plan_service'=>$plan_service);
			$did_url = $real_url."API/smsstriker/existing_numbers.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
		 	curl_close($did_conn);
		 	$did_numbers=json_decode($did_result,true);
		 	
		 	//print_r($did_numbers);
		 	
		$this->_data['did_numbers'] = $did_numbers;	
		$this->load->view('missedcall_payments/existing_numbers',$this->_data);	 
	}
	
	public function Search_goldno()
	{
	//date_default_timezone_set('asia/kolkata');
		 //print_r($_REQUEST);
		
		$goldno = $this->_data['goldno'] = $_REQUEST['goldno'];
		$checkedno = $this->_data['checkedno']=$_REQUEST['checkedno'];
		$service_type = $this->_data['service_type']=$_REQUEST['service_type'];
		$Number_type = $this->_data['Number_type']=$_REQUEST['Number_type'];
		
		//$cart_val = $this->Voice_rental_model->get_cart();
		
		      $real_url=$this->config->item('firstring_url');
			$qry_fields =array();
			$cart_val=array();
			$did_url = $real_url."API/smsstriker/get_cart.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
		 	
			if(count($getsilver_didlist_api)>0)
		 	{
			 $cart_val =$getsilver_didlist_api;
			}
			else
			{
			$cart_val=array();
			}
			 
		//print_r($cart_val);
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
		$array_did[$xyz] = $did_val['did_number'];
		$xyz++;
		}
		$this->_data['cart_num'] = $array_did;
//print_r($this->_data['cart_num']);
		// GET GOLD SERACH NOS   
		$real_url=$this->config->item('voice_did_url');
		$qry_fields =array('did_plan' => urlencode('GOLD'),'search_no' => urlencode($_REQUEST['goldno']),'service_type' => urlencode($_REQUEST['service_type']),'Number_type' => urlencode($_REQUEST['Number_type']));
		 $did_url = $real_url."get_livedidnos_api.php";
		 $qry_fields_string = http_build_query($qry_fields);
		$did_conn= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getgold_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		 $result1 =$getgold_didlist_api;
		 //print_r($result1);
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}

		$this->_data['avl_goldnos'] = $result;	
		//print_r($this->_data['avl_goldnos']);
		//$this->_data['avl_goldnos'] = $this->get_didtypes('GOLD');
		
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/
		$this->load->view('missedcall_payments/service_nos/getgold_nos',$this->_data);			
	}
	public function Search_platinumno()
	{
	      //date_default_timezone_set('asia/kolkata');
		$platinumno = $this->_data['platinumno'] = $_REQUEST['platinumno'];
		$checkedno = $this->_data['checkedno']=$_REQUEST['checkedno'];
		$service_type = $this->_data['service_type']=$_REQUEST['service_type'];
		$Number_type = $this->_data['Number_type']=$_REQUEST['Number_type'];
		
		//$cart_val = $this->Voice_rental_model->get_cart();
		
		      $real_url=$this->config->item('firstring_url');
			$qry_fields =array();
			$cart_val=array();
			$did_url = $real_url."API/smsstriker/get_cart.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
		 	
			if(count($getsilver_didlist_api)>0)
		 	{
			 $cart_val =$getsilver_didlist_api;
			}
			else
			{
			$cart_val=array();
			}
		
		$array_did = array();
		$xyz=0;
		foreach($cart_val AS $did_val)
		{
		$array_did[$xyz] = $did_val['did_number'];
		$xyz++;
		}
		$this->_data['cart_num'] = $array_did;


		// GET PLATINUM SERACH NOS   
		$real_url=$this->config->item('voice_did_url');
		$qry_fields =array('did_plan' => urlencode('PLATINUM'),'search_no' => urlencode($_REQUEST['platinumno']),'service_type' => urlencode($_REQUEST['service_type']),'Number_type' => urlencode($_REQUEST['Number_type']));
		$did_url = $real_url."get_livedidnos_api.php";
		//exit;
		$qry_fields_string = http_build_query($qry_fields);
		//exit;
		$did_conn = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($did_conn,CURLOPT_URL, $did_url);
		curl_setopt($did_conn,CURLOPT_POST, count($_POST));
		curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
		curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$did_result = curl_exec($did_conn);
		$getplati_didlist_api=json_decode($did_result, true);
		curl_close($did_conn);
		$result1  =$getplati_didlist_api;
		if(count($result1)>0)
		{
		$result=$result1;
		}
		else
		{
		$result=array();
		}

		$this->_data['avl_platinumnos'] = $result;
		
		/**  get order number for session variable start **/
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from order_numbers where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['did_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		/**  get order number for session variable end **/

		$this->load->view('missedcall_payments/service_nos/getplatinum_nos',$this->_data);	
	}
	
	
		
		


	
	
	
	
}
