<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>

<script>
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");


$.validator.addMethod("alphanumericspace", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
  
  $.validator.addMethod('minStrict', function (value, el, param) {
	    return value > param;
	},'Please enter 500 or above 500 SMS');
	
$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');
	
 $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
    },'Should Enter Numbers, Letters');
	
	 $.validator.addMethod("alphanumericunder", function(value, element) {
        return this.optional(element) || /^[a-z0-9_]+$/i.test(value);
    },'Should Enter Numbers, Letters, underscore');
	$.validator.addMethod("api_values_not_same", function(value, element) {
   return $('#field1').val() != $('#field2').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same13", function(value, element) {
   return $('#field1').val() != $('#field3').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same14", function(value, element) {
   return $('#field1').val() != $('#field4').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same15", function(value, element) {
   return $('#field1').val() != $('#field5').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same23", function(value, element) {
   return $('#field2').val() != $('#field3').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same24", function(value, element) {
   return $('#field2').val() != $('#field4').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same25", function(value, element) {
   return $('#field2').val() != $('#field5').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same34", function(value, element) {
   return $('#field3').val() != $('#field4').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same35", function(value, element) {
   return $('#field3').val() != $('#field5').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same45", function(value, element) {
   return $('#field4').val() != $('#field5').val()
}, "API values should not equal");

</script>



<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/credits-icon.png" class="right-title-img">Add SMS Credits</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-10 col-md-10 col-xs-12 padding_mzero mrg-mainrt-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

<?php 
	$user_id=$this->session->userdata('user_id');
	$sms_price=0;
	$service_tax_percent=0;
	$sql2="select * from global_settings";
	$query2=$this->db->query($sql2);
	if($query2->num_rows()>0)
	{
		$global_settings=$query2->result();
		//print_r($global_settings);
		foreach ($global_settings as $key=>$global_setting)
		{
			if($global_setting->setting_name=='smspricevalue')
			{
				$getsms_price=$global_setting->value;
			}
			if($global_setting->setting_name=='Service Tax')
			{
				$service_tax_percent=$global_setting->value;
			}
		}
	}
	
	//$pgresponse='Transaction Cancelled';
	
	$pgresponse='Transaction Successful';
	
	/*
	$sql="select up.price,up.service_tax_percent,pe.servicetype,up.transaction_id from user_payments up INNER JOIN 
	price_enquery pe on up.transaction_id=pe.epg_txnID
	where up.user_id=$user_id and pe.servicetype='sms' and pe.pgresponse='$pgresponse' order by up.payment_id desc limit 1";
	*/
	
	$sql="select price from user_payments where user_id=$user_id and price>0 order by payment_id desc limit 1";
	$query1=$this->db->query($sql);
	if($query1->num_rows()>0)
	{
	    //print_r($query1->result());exit;
	    $user_payments=$query1->result();
	
		foreach ($user_payments as $key=>$user_payment)
		{
		
			if($user_payment->price!='')
			{
			 //$sms_price=$user_payment->sms_price;
			  $sms_price=$user_payment->price;
			}
			else
			{
			 $sms_price=$getsms_price;
			}
			
		}
	
	}
	else
	{
	 $sms_price=$getsms_price;
	}
	
	
?>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

<form class="col-sm-12 col-md-12 col-xs-12 missedcall_allform padding_zero confirm_add_credits" action="confirm_add_credits" method="post">


<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-4 col-md-3 col-xs-12 padding_zero">
<label class="form_lable">No of SMS</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding_rtzero padding_mzero">
<input type="text" name="noofsms" class="getnoofsms" value="<?php echo @$_SESSION['noofsms']?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
<span class="getnoofsms-msg" ></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-4 col-md-3 col-xs-12 padding_zero">
<label class="form_lable">Price per SMS</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding_rtzero padding_mzero">
<span><?php echo $sms_price;?></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-4 col-md-3 col-xs-12 padding_zero">
<label class="form_lable">Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>

<div class="col-sm-7 col-md-7 col-xs-12  padding_rtzero padding_mzero">
<span class="amount" >0.00</span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-4 col-md-offset-3 col-xs-12 padding_rtzero padding_mzero">

<input type="hidden" name="add_credits" value="add_credits">
<input type="hidden" name="amount" class="amount">
<input type="hidden" name="sms_price" class="sms_price" value="<?php echo $sms_price;?>">
<input type="hidden" name="service_tax_percent" class="service_tax_percent" value="<?php echo $service_tax_percent;?>">

<input type="submit" name="add_credits" class="submit_btn form-registration" id="" value="Submit">
</div>
</div>
</form>
</div>
</div>
 <span style="color:red"; id="failedmsg"> </span> 

</div>
            
 </div>                      
                        </div>
</div>

</div>
</body>


<script>
$(document).ready(function() {

$(".confirm_add_credits").validate({

    rules: {
                noofsms: {
			number: true,
			minStrict: 499,
			required: true 
		}
    },
    messages: {
         noofsms: {
            required: "Please Enter No of SMS"            
        }
    },
	tooltip_options: {
		noofsms: {placement:'bottom',html:true}
		}
}); 

}); 
 </script>
 

<script type="text/javascript" >
$( document ).ready(function( $ ) {

	var getnoofsms=$(".getnoofsms").val();
	var sms_price=$(".sms_price").val();
	console.log(getnoofsms*sms_price);
	if(getnoofsms.length>0)
		{
			$(".getnoofsms-msg").html(" ");
			$(".amount").html((getnoofsms*sms_price) .toFixed(1));
			$(".amount").val((getnoofsms*sms_price) .toFixed(1));
		}
		else
		{
			//$(".getnoofsms-msg").html("Please enter no of SMS");
			//$(".getnoofsms-msg").css("color","red");	
		}
	// get all cities names
	$(".getnoofsms").on("blur",function(){
	
	if($.isNumeric($(".getnoofsms").val()))
	{
	var getnoofsms=$(".getnoofsms").val();
	var sms_price=$(".sms_price").val();
	console.log(getnoofsms*sms_price);
	
		if(getnoofsms.length>0)
		{
			$(".getnoofsms-msg").html(" ");
			$(".amount").html((getnoofsms*sms_price) .toFixed(1));
			$(".amount").val((getnoofsms*sms_price) .toFixed(1));
			
		}
		else
		{
			//$(".getnoofsms-msg").html("Please enter no of SMS");
			//$(".getnoofsms-msg").css("color","red");	
		}
		
	}
	else
	{
		$(".getnoofsms-msg").html(" ");
		$(".amount").html('0.00');
		$(".amount").val('0.00');
	}
		
	});
	
});
</script>
</html>

