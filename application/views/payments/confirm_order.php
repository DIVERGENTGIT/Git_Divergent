<body oncontextmenu="return false;">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/credits-icon.png" class="right-title-img">Confirm Order</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-10 col-md-10 col-xs-12 mrg-mainrt-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

 
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<form class="col-sm-12 col-md-12 col-xs-12 missedcall_allform padding_zero" method="post">

<?php if(isset($_REQUEST['tn'])){
?> 
<script src="<?php echo  base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript" >
$( document ).ready(function( $ ) {
	var trn_id="<?php echo $_REQUEST['tn']?>";
        var tax="<?php echo $tax?>";
        var servicetax="<?php echo $servicetax?>";
        var smsprice="<?php echo $smsprice?>";

       var urlvar="<?php echo base_url(); ?>sendemail.php?payment=payment&trn_id="+trn_id+"&servicetax="+servicetax+"&tax="+tax+"&smsprice="+smsprice;   
          console.log(urlvar);
		$.ajax({
			type:"GET",
			url:urlvar,
			//data:{payment:"payment",trn_id:trn_id,servicetax:<?php echo $tax?>,smsprice:<?php echo $smsprice?>},
			dataType:"json",
			success:function(response)
			{
				console.log(response);
				console.log(response.failed);
				('#failedmsg').html(response.failed);
				
			},
			error:function(error)
			{
				//alert(error);
				console.log(error);
			}
		});
		

});
</script>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Status</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding_mzero">
<span class=""> <?php echo @$_REQUEST['rm']; ?></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Transaction ID</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<span class=""> <?php echo @$_REQUEST['tn']; ?></span>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Note</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12 padding-ltzero padding-mzero">
<span class=""> Your Payment details are sent to E-Mail & Mobile!...</span>
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
<label class="form_lable">Organization</label>
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
<label class="form_lable">No of SMS</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php
	 
	echo $_SESSION['noofsms'];
	 
// echo $ids
 ?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Price Per SMS ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo $_SESSION['sms_price'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Actual Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> )</label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
echo $_SESSION['amount'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">

<?php if($_SESSION['discountType'] == 3) { ?>
<label class="form_lable">Coupon Discount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </label>
<?php } else { ?>


<label class="form_lable">Coupon Discount( <span class="iconcolor" style="color:black;font-weight:bold;">&#37;</span> ) </label>

<?php } ?>    
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php  
if($_SESSION['discount'] > 0 ) { echo $_SESSION['discount']; }
 	 else { echo  $_SESSION['discount']." ( Note : coupon not applicable.)";}
?>  
</div>   
</div>  


<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">

<label class="form_lable">Final Amount( <i class="fa fa-inr" aria-hidden="true" style="color:black;"></i> ) </label>

</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
	echo $_SESSION['totalPrice'];
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Tax( <?php echo $tax;?>% ) ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
 	echo $_SESSION['taxAmount'];
 
?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<label class="form_lable">Grand Total ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </label>
</div>
<div class="col-sm-7 col-md-7 col-xs-12  padding-ltzero padding-mzero">
<?php 
	echo $_SESSION['total_amount'];
?>  
</div> 
</div>

<!-- <div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>User type</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12  padding-ltzero padding-mzero">
<?php echo $usertype; ?>
</div>
</div> -->


<div class="col-sm-12 col-md-12 col-xs-12 form-div padding-zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-3 col-xs-12 padding-ltzero padding-mzero">
<input type="hidden" name="ids" value="<?php echo $ids;?>">
<input type="hidden" name="name" value="<?php echo $this->session->userdata('username');?>">
<input type="hidden" name="email" value="<?php echo $email;?>">
<input type="hidden" name="mobile" value="<?php echo $mobile;?>">
<input type="hidden" name="qty" value="<?php echo $_SESSION['noofsms'];?>">
<input type="hidden" name="amount" value="<?php echo $_SESSION['totalPrice'];?>">
<input type="hidden" name="tax_amount" value="<?php echo $_SESSION['taxAmount'];?>">
<input type="hidden" name="total_amount" value="<?php echo  $_SESSION['total_amount'];?>">
<input type="hidden" name="custid" value="<?php echo $total;?>">
<input type="hidden" name="sms_price" value="<?php echo $_SESSION['sms_price'];?>">
<input type="submit" name="confirm_order" class="submit_btn form-registration" id="" value="Order Confirm">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-3 col-xs-12 padding-ltzero padding-mzero">
<a href="<?php echo base_url(); ?>products/shoppingCartView"><input type ="button" class="submit_btn cart-first-form" value ="Back"/></a>
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
			console.log(response);
			
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
			console.log(response);
			
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
				console.log(response);
				
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


</html>

