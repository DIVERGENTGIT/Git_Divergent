

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
	},'Please enter 500 or above 500');
	
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
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/credits-icon.png" class="right-title-img">Add Longcode Credits</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-10 col-md-10 col-xs-12 mrg-mainrt-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

<form class="col-sm-12 col-md-12 col-xs-12 missedcall_allform padding_zero confirm_add_credits" action="confirm_add_credits" method="post">


<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Longcode Credits</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php
$sql="select * from longcode_packages group by no_of_sms order by no_of_months asc ";
$query=$this->db->query($sql);
if($query->num_rows()>0)
{
$packages_data=$query->result();
}
else
{
$packages_data=array();
}

//print_r($packages_data);
$user_id=$this->session->userdata('user_id');

	$pgresponse='Transaction Successful';
      $sql="select th.sms_price as longcode_price from transaction_history th INNER JOIN 
	price_enquery pe on th.epg_txnID=pe.epg_txnID
	where th.user_id=$user_id and pe.servicetype='longcode' and pe.description='Add Longcode Credits' and th.payment_status='$pgresponse' order by th.payment_id desc limit 1";
	$query1=$this->db->query($sql);
	
	if($query1->num_rows()>0)
	{
		//print_r($query1->result());exit;
		$user_payments=$query1->result();

		foreach ($user_payments as $key=>$user_payment)
		{
			if($user_payment->longcode_price!='' && $user_payment->longcode_price!=0)
			{
				$longcode_price=$user_payment->longcode_price;
			}
			else
			{
				$longcode_price='';
			}

		}
	}
	else
	{
	 $sql1="select price_per_sms as longcode_price from price_enquery  where registeruser_id=$user_id and description='Add Longcode Credits' and payment_status=0 group by longcode_numbers order by id desc limit 1 ";
	 
	$query1=$this->db->query($sql1);
	if($query1->num_rows()>0)
	{
		//print_r($query1->result());exit;
		
		$user_payments=$query1->result();

		foreach ($user_payments as $key=>$user_payment)
		{
			if($user_payment->longcode_price!='' && $user_payment->longcode_price!=0)
			{
				$longcode_price=$user_payment->longcode_price;
			}
			else
			{
				$longcode_price='';
			}

		}
	}
	
	}



$price='';

if(@$sms_price!='')
{
 $price=$sms_price;
}
else if(@$longcode_price!='')
{
 $price=$longcode_price;
}
else
{
$price='';
}

?>
<!--
<input type="text" name="longcode_credits" class="getnoofsms" value="<?php echo @$_SESSION['noofsms']?>" />
-->
<select name="package_id" class="getpackage">
<option value="">Select Longcode Credits</option>
<?php
foreach($packages_data as $key=>$package)
{
?>
<option value="<?php echo $package->package_id;?>" 
<?php if(@$price==$package->price_per_long_code) { echo "selected";}?>
><?php echo $package->no_of_sms." - ".$package->price_per_long_code." Price ";?></option>
<?php
}
?>
</select>

<span class="getnoofsms-msg" ></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<span class="amount" >0.00</span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Total Tax (<?php echo $tax;?> % <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<span class="total_tax" >0.00</span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Total Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<span class="total_amount" >0.00</span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-3 col-xs-12 padding-ltzero padding-mzero">

<input type="hidden" name="add_credits" value="add_credits">

<input type="hidden" name="amount" class="amount">
<input type="hidden" name="priceperlongcode" class="sms_price" value="<?php echo $sms_price;?>">
<input type="hidden" name="service_tax_percent" class="service_tax_percent" value="<?php echo $tax;?>">

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
                package_id: {
			required: true 
		}
    },
    messages: {
         package_id: {
            required: "Please Select Longcode Credits"            
        }
    },
	tooltip_options: {
		package_id: {placement:'bottom',html:true}
		}
}); 

}); 
 </script>
 

<script type="text/javascript" >
$( document ).ready(function( $ ) {

var package_id=$(".getpackage").val();
		if(package_id.length>0)
		{
			$.ajax({
				type: "GET",
				data: {package_id:package_id},
				dataType:"json",
				url: "<?php echo base_url(); ?>longcode/getpackage",
				success: function (callback_data) 
				{
				console.log(callback_data);
			      $(".amount").html(callback_data.amount);
			      $(".total_tax").html(callback_data.total_tax);
			      $(".total_amount").html(callback_data.total_amount);
			      $(".sms_price").html(callback_data.sms_price);
				}
				});	
			
		}
	
	// get all cities names
	$(".getpackage").on("change",function(){
	
	     var package_id=$(".getpackage").val();
		if(package_id.length>0)
		{
			$.ajax({
				type: "GET",
				data: {package_id:package_id},
				dataType:"json",
				url: "<?php echo base_url(); ?>longcode/getpackage",
				success: function (callback_data) 
				{
				console.log(callback_data);
			      $(".amount").html(callback_data.amount);
			      $(".total_tax").html(callback_data.total_tax);
			      $(".total_amount").html(callback_data.total_amount);
			      $(".sms_price").html(callback_data.sms_price);
				}
				});	
			
		}
		
		
	
		
	});
	
});
</script>
</html>

