
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/longcode-icon.png" class="right-title-img">Confirm Order</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-10 col-md-10 col-xs-12 mrg-mainrt-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">


<?php 
$user_id=$this->session->userdata('user_id');
 $sql="SELECT u.no_ndnc,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile,u.first_name,last_name FROM users u WHERE u.user_id = $user_id";
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


$state=$value->state_id;
$city_name=$value->city_id;
$address=$value->address1;
$zipcode=$value->zipcode;
$organization=$value->organization;
$email=$value->email;
$mobile=$value->mobile;
$name=$value->first_name.' '.$value->last_name;
}

?>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<form class="col-sm-12 col-md-12 col-xs-12 missedcall_allform padding_zero" method="post">

<?php  if(isset($_REQUEST['tn']) && @$_REQUEST['tn']!=''){

?> 
<script src="<?php echo  base_url(); ?>js/jquery.min.js"></script>

<script type="text/javascript" >
$( document ).ready(function( $ ) {
	var trn_id=  "<?php echo $_REQUEST['tn']?>";
        var tax=  "<?php echo $tax?>";
        var servicetax=  "<?php echo $servicetax?>";
        var smsprice=  "<?php echo $smsprice?>";

       /*
       var urlvar="<?php echo base_url(); ?>sendemail_1.php?payment=payment&trn_id="+trn_id+"&servicetax="+servicetax+"&tax="+tax+"&smsprice="+smsprice;*/
       
       
       var urlvar="<?php echo base_url(); ?>API/longcode/renwal_dedicated.php?payment=payment&trn_id="+trn_id+"&servicetax="+servicetax+"&tax="+tax+"&smsprice="+smsprice;
         // console.log(urlvar);  
		$.ajax({
			type:"GET",
			url:urlvar,
			//data:{payment:"payment",trn_id:trn_id,servicetax:<?php echo $tax?>,smsprice:<?php echo $smsprice?>},
			dataType:"json",
			success:function(response)
			{
				console.log(response);
				console.log(response.failed);    
				//$('#failedmsg').html(response.failed);
				
			},
			error:function(error)
			{
				//alert(error);
				console.log(error);
			}
		});
		

});
</script>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Status</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<span > <?php echo @$_REQUEST['rm']; ?></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Transaction ID</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<span > <?php echo @$_REQUEST['tn']; ?></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Note</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<span > Your Payment details are sent to E-Mail & Mobile!...</span>
</div>
</div>

<?php }
else 
{ ?>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Name</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<?php echo $this->session->userdata('username');?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Email</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<?php echo $email;?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Phone</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<?php echo $mobile;?>
</div>
</div>



<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">State</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero" >
<select name="getstate_id" id="getstate_id" required>
<option value="">Select State</option>
</select>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">City</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero" >
<select name="getcity_id" id="getcity_id" required>
<option value="">Select City</option>
</select>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Zipcode</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<span id="zipcode">
<?php if(!empty($zipcode ) && ($zipcode!='0')) {
?>
<input type="hidden" name="zipcode" value="<?php echo $zipcode;?>">
<?php 
echo $zipcode;
}else{?>
<input type="text" name="zipcode" value="<?php echo @$this->session->userdata('or_zipcode');?>">
<?php } ?>
</span>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Address</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<?php if(!empty($address)) {
?>
<input type="hidden" name="address" value="<?php echo $address;?>">
<?php 
echo $address;
}else{?>
<input type="text" name="address" value="<?php echo @$this->session->userdata('or_address');?>" >

<?php } ?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Organization Name</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php if(!empty($organization)) { 
?>
<input type="hidden" name="organization" value="<?php echo @$organization;?>">
<?php 
echo $organization;
 }else{?>
<input type="text" name="organization" value="<?php echo @$this->session->userdata('or_organization');?>" >
<?php } ?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Subscription</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo @$_SESSION['subscription'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">No of SMS</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php echo @$_SESSION['noofsms'];?>
</div>
</div>


<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Longcode Number</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo @$_SESSION['longcode_number']."-".@$_SESSION['number_type'];
?>
</div>
</div>



<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Number Cost ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo @$_SESSION['number_cost'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo @$_SESSION['amount'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Tax( <?php echo $tax;?>% ) ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo @$_SESSION['total_tax'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Total ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo @$_SESSION['total_amount'];
?>
</div>
</div>
<?php
      $user_id=$this->session->userdata('user_id');
      
      
      
      $longcode_numbers='';
      $ids='';
      $subscription='';
      if(@$_SESSION['longcode_number']!='')
      {
			
			$subscription_duration= $_SESSION['subscription'];
			if($subscription_duration=='1 Month')
			{
			$subscription=1;
			}
			if($subscription_duration=='1 Year')
			{
			$subscription=12;
			}
			if($subscription_duration=='3 Months')
			{
			$subscription=3;
			}
			if($subscription_duration=='6 Months')
			{
			$subscription=6;
			}
      
			$noofsms=$_SESSION['noofsms'];
			$amount=$_SESSION['amount'];
			$total_tax=$_SESSION['total_tax'];
			$total_amount=$_SESSION['total_amount'];
			$longcode_id=$_SESSION['longcode_id'];
			$longcode_numbers=$_SESSION['longcode_number'];
			$number_cost=$_SESSION['number_cost'];
			$number_type=$_SESSION['number_type'];
		 
		 $sql1="select * from price_enquery  where registeruser_id=$user_id and longcode_numbers='$longcode_numbers' and payment_status=0 and description='longcode Dedicated Renewal' group by longcode_numbers";
		 
		 $query1=$this->db->query($sql1);
		 //echo $query1->num_rows();
$price_per_long_code=0;
$noofkeywords=0;
		 if($query1->num_rows()==0)
		 {
		 
		 $sql = "insert into price_enquery (noofsms,noofkeywords,price_per_sms,smstype,subcription,name,mobile,email,
		servicetype,registeruser_id,amount,tax_amount,total_amount,longcode_numbers,description)
	 values ($noofsms,$noofkeywords,'$price_per_long_code','$usertype',$subscription,'$name','$mobile','$email','longcode',$user_id,
	 '$amount','$total_tax','$total_amount','$longcode_numbers','longcode Dedicated Renewal')";
		     $query=$this->db->query($sql);
		     $ids = $this->db->insert_id();
		 }
		 else
		 {
		 $data=$query1->result();
		 
		 foreach($data as $key=>$value)
		 {
			$ids=$value->id;
			$sql1="update price_enquery set noofsms=$noofsms,price_per_sms='$price_per_long_code',subcription=$subscription,
			amount='$amount',tax_amount='$total_amount',total_amount='$total_amount' where id=$ids";
			$this->db->query($sql1);
		 }
		// print_r($data);
		 }
      }
	

?>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-3 col-xs-12 padding-ltzero padding-mzero">
<input type="hidden" name="ids" value="<?php echo $ids;?>">
<input type="hidden" name="name" value="<?php echo $this->session->userdata('username');?>">
<input type="hidden" name="email" value="<?php echo $email;?>">
<input type="hidden" name="mobile" value="<?php echo $mobile;?>">
<input type="hidden" name="qty" value="<?php echo $noofsms;?>">
<input type="hidden" name="amount" value="<?php echo $amount;?>">
<input type="hidden" name="tax_amount" value="<?php echo $total_tax;?>">
<input type="hidden" name="total_amount" value="<?php echo $total_amount;?>">
<input type="hidden" name="custid" value="<?php echo $this->session->userdata('user_id');?>">
<input type="hidden" name="sms_price" value="<?php echo $price_per_long_code;?>">
<input type="hidden" name="smstype" value="<?php echo $usertype;?>">
<input type="hidden" name="description" value="longcode Dedicated Renewal">

<input type="submit" name="confirm_order" class="submit_btn form-registration" id="" value="Order Confirm">
</div>
</div>
</form>
</div>

<?php }?>
</div>
 <span style="color:red"; id="failedmsg"> </span> 

</div>
            
 </div>                      
                        </div>
</div>

</div>
</body>

<script type="text/javascript" >
$( document ).ready(function( $ ) {

	var baseurl="<?php echo base_url(); ?>";
	$.ajax({
		type:"GET",
		url:baseurl+"registration.php",
		data:{cnfrmgetstate:"all",stateid:<?php echo $state;?>},
		dataType:"html",
		success:function(response)
		{
			//console.log(response);
			
			$("#getstate_id").html(response);
		},
		error:function(error)
		{
			//alert(error);
			console.log(error);
		}
			
	});
	

	
	$.ajax({
		type:"GET",
		url:baseurl+"registration.php",
		data:{cnfrmgetcity:"all",state_id:<?php echo $state;?>,city_id:<?php echo $city_name;?>},
		dataType:"html",
		success:function(response)
		{
			//console.log(response);
			
			$("#getcity_id").html(response);
		},
		error:function(error)
		{
			//alert(error);
			console.log(error);
		}
			
	});
  	
	// get all cities names
	
	$("#getstate_id").on("change",function(){
		var state_id=$("#getstate_id").val();
		$.ajax({
			type:"GET",
			url:baseurl+"registration.php",
			data:{getcity:"all",state_id:state_id},
			dataType:"html",
			success:function(response)
			{
				//console.log(response);
				
				$("#getcity_id").html(response);
			},
			error:function(error)
			{
				//alert(error);
				console.log(error);
			}
				
		});
		
	});

	
	
});
</script>

<?php

if(@$_REQUEST['rm']=='Transaction Cancelled')
{

$did_nos=@$_SESSION['longcode_number'];
$user_id=$this->session->userdata('user_id');
$sql3="update  longcode_tmp set  status=0 where status=1 and service_type='dedicated' and user_id=$user_id and longcode_number in ($did_nos)";
$this->db->query($sql3);

// get order numbers
$sql2="select * from longcode_tmp where service_type='dedicated' and status=1 and user_id=$user_id group by longcode_number";
$query_result=$this->db->query($sql2)->result_array();
//print_r($query_result);
$str='';
foreach($query_result as $key=>$getnumber)
{
$str .= $getnumber['longcode_number'].',';
}
$_SESSION['sel_nos']=trim($str,',');


}
?>
</html>

