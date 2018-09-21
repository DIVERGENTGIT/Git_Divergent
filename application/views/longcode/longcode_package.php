<style>
.error_lable {
    color: #899597;
    font-weight: bold;
	margin_bottom:15px;
}
</style> 
<style>
.dn {display:none;}
</style>
 
<div class="col-md-9 col-sm-9 col-xs-12 main-right-div padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 mrg-mainrt-div">
 
 <div class="col-md-12 col-sm-12 col-xs-12 main-title-admin padding_zero">
 
 </div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_twofive main-divnwbg">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">	
	 
</div>	
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 
    	  <h3>Longcode Package Reports </h3>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 
 
</div>

<div class="col-md-12 col-sm-12 col-xs-12 mrgbtm5zero padding_zero">
<div class="col-md-6 col-sm-6 col-xs-12 form-div padding_zero">
 <span class="comment_all">
No of Records : 
<span class="camp_count_number"><?php
	if(count($userlongcodes) > 0)
	{
		echo count($userlongcodes);
	}
	else
	{
		echo "0";
	}
?></span>
</span>
</div>

	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	
	<!-- <div class="table-responsive table_xauto">
	
	<div class="table-responsive table_xauto"> -->
	<table class="table_all" id="example">
		<thead>
			<tr>
				<th>S No</th>
				<th>Service Number</th>		
				<th>Service Name</th> 
				<th>Service Type</th> 
				<th>No.Of SMS</th>
				<th>Amount</th>
				<th>Subscribed Date</th>
				<th>Expiry Date</th>				
				<th>Actions</th>  
			</tr>
	
		</thead> 

		<tbody> 
		
			<?php 
			 
 
				$count = 0;
				foreach($userlongcodes as $serviceData) {  $count++; ?>
					<tr id="<?php echo $serviceData['longcode_id'];?>">
						<td><?php echo $count;?></td>
						<td><?php echo $serviceData['longcode_number'];?></td>
						<td><?php echo $serviceData['service_type'];?></td>
						<td><?php echo $serviceData['longcode_type'];?></td>
						<td><?php echo $serviceData['no_of_sms'];?></td>
						<td><?php echo $serviceData['total_amount'];?></td>
						<td><?php echo $serviceData['subscription_start'];?></td>
						<td><?php echo $serviceData['subscription_end'];?></td> 
						<td> <a href="#renewalModal_<?php echo $serviceData['longcode_id'];?>" data-toggle="modal" data-target="#renewalModal_<?php echo $serviceData['longcode_id'];?>"><span data-toggle="tooltip" data-original-title="Renewal"><i class="fa fa-repeat" aria-hidden="true" onClick="getpackageData(<?php echo $serviceData['longcode_id'];?>);"></i></span></a>
  


<!-- SMS Model Start -->
 
<div class="modal fade" id="renewalModal_<?php echo $serviceData['longcode_id'];?>" tabindex="-1" role="dialog" aria-labelledby="renewalModal_<?php $serviceData['longcode_id']?>" data-backdrop="static">
<div class="modal-dialog role="document""> 
      
      <!-- Modal content-->
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" id="renewalModalLabel"><span class="form_lable02">Renewal Order</span></h4>
    </div>
    <div class="modal-body col-md-12 col-sm-12 col-xs-12">
	
<script>
 function getpackageData(longcode_id) {
		
	 $('#service_number_cost'+longcode_id).val();
	 $('#tax_amount'+longcode_id).val();
	 $('#grand_total'+longcode_id).val();
	// $('#rental_plan'+longcode_id).val();  
	 $('#rental_plan'+longcode_id).find('option').remove();
	 var number_cost = 0; var no_of_keywords = 0;	
	 $.ajax({
		type: "POST",
		data: {'longcode_id':longcode_id},
		url: "<?php echo base_url(); ?>campaign/myLongcodePackage",
		success: function (data) 
		{  
			 
			var result = $.parseJSON(data);   
 
			$('#service_number_cost'+longcode_id).text(result['userpackage'][0].number_cost); 
			$('#tax_amount'+longcode_id).text(result['userpackage'][0].total_tax); 
			$('#grand_total'+longcode_id).text(result['userpackage'][0].total_amount);  
			$('#packageData'+longcode_id).val();
			var options = "";  
			
//console.log(result['userpackage'][0].subscription_duration+ '' + result['userpackage'][0].no_of_sms + '' +result['userpackage'][0].package_cost);
			$.each(result.package,function(i,item) {
								  
				if((result['userpackage'][0].subscription_duration == item.subscription_duration) && (result['userpackage'][0].no_of_sms == item.no_of_sms) && (result['userpackage'][0].package_cost == item.amount)) {
  					options += "<option  value="+item.package_id+" selected >"+item.subscription_duration+"/"+item.no_of_sms+" sms/"+item.amount+" Rupees </option>"; 				 
				 }else{  
					options += "<option value="+item.package_id+">"+item.subscription_duration+"/"+item.no_of_sms+" sms/"+item.amount+" Rupees </option>";	

				 }     
			}); 

			$('#rental_plan'+longcode_id).append(options);	 
			 $('#subscription_id'+longcode_id).val(result['userpackage'][0].longcode_id);
			 $('#service_amount'+longcode_id).val(result['userpackage'][0].amount);
			 $('#service_tax'+longcode_id).val(result['userpackage'][0].total_tax);
			 $('#num_sms'+longcode_id).val(result['userpackage'][0].no_of_sms);
			 $('#service_total_amount'+longcode_id).val(result['userpackage'][0].total_amount);   
			 $('#subscription_duration'+longcode_id).val(result['userpackage'][0].subscription_duration);
			 $('#price_per_long_code'+longcode_id).val(result['userpackage'][0].price_per_long_code);  
			$('#longcode_number'+longcode_id).val(result['userpackage'][0].longcode_number); 
  			$('#transaction_id'+longcode_id).val(result['userpackage'][0].transaction_id);
			$('#longcode_type'+longcode_id).val(result['userpackage'][0].longcode_type);
			if(result['userpackage'][0].number_cost != '' )
			{  
				number_cost = result['userpackage'][0].number_cost; 	
			} 
			if(result['userpackage'][0].no_of_keywords != '' )
			{
				no_of_keywords = result['userpackage'][0].no_of_keywords; 	
			} 
 
			$('#number_cost'+longcode_id).val(number_cost);
			$('#no_of_keywords'+longcode_id).val(no_of_keywords);
 
   
		}      
	});     
   } 
		 
function getServiceTax(longcode_id) {
 	 var servicePlan_id = $('#rental_plan'+longcode_id+' :selected').val();	
  	 var tax = "<?php echo $service_tax;?>";
	 var number_cost = 0; var no_of_keywords = 0;	
 	 $.ajax({
		type: "POST",
		data: {'package_id':servicePlan_id,'longcode_id':longcode_id},
 
		url: "<?php echo base_url(); ?>campaign/myLongcodePackage",
		success: function(data) 
		{  
 
			 var result = $.parseJSON(data);  
 		 	 if(result['userpackage'][0].number_cost != '' )
			 {
				number_cost = result['userpackage'][0].number_cost; 	
			 } 
			 $('#tax_amount'+longcode_id).val();
	  	 	 $('#grand_total'+longcode_id).val();
			 var amount = parseInt(result['package'][0].amount) + parseInt(number_cost);
			 var tax_amount = (amount*tax)/100; 
			 var total = parseInt(tax_amount) + parseInt(amount);
			 $('#tax_amount'+longcode_id).text(tax_amount);  
			 $('#grand_total'+longcode_id).text(total);  

			 $('#subscription_id'+longcode_id).val(longcode_id); 
			 $('#service_amount'+longcode_id).val(result['package'][0].amount);
			$('#service_tax'+longcode_id).val(tax_amount);
			 $('#num_sms'+longcode_id).val(result['package'][0].no_of_sms);
			 $('#subscription_duration'+longcode_id).val(result['package'][0].subscription_duration);
			 $('#price_per_long_code'+longcode_id).val(result['package'][0].price_per_long_code); 
			  $('#transaction_id'+longcode_id).val(result['userpackage'][0].transaction_id);   
 			$('#longcode_type'+longcode_id).val(result['userpackage'][0].longcode_type);
			$('#longcode_number'+longcode_id).val(result['userpackage'][0].longcode_number); 
 			  
			if(result['userpackage'][0].no_of_keywords != '' )  
			{
				no_of_keywords = result['userpackage'][0].no_of_keywords; 	
			} 
 
			$('#number_cost'+longcode_id).val(number_cost);
			var service_total = parseInt(total);  
			 $('#service_total_amount'+longcode_id).val(service_total);   
			$('#no_of_keywords'+longcode_id).val(no_of_keywords);
	  

       
			 
		}  
	});  
   
 }   
	    
</script>
<form name="renew_conf" action="<?php echo base_url();?>campaign/renewalLongcodeService" method="post" id="renew_conf" class="missedcall_allform renew_conf<?php //echo $user_pkg->usc_id; ?>"> 
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Current Package :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12" >
  <select id="rental_plan<?php echo $serviceData['longcode_id'];?>" class="rental_plan"  onChange="getServiceTax(<?php echo $serviceData['longcode_id'];?>);" required>
	
	 
</select>  
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Service Number Cost :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span class="service_number_cost" id="service_number_cost<?php echo $serviceData['longcode_id'];?>">
 <?php  // $serviceData['number_cost'];?>
 </span>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Tax :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i> 
<span class="renewal_tax" id="tax_amount<?php echo $serviceData['longcode_id'];?>">
	 					
		
  
</span>
<script>
$(function(){
	//var rnw_tottax = $('.renewal_tax').html();	
	//$('input.renewtax_tot').val(rnw_tottax);
});
</script>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Total Amount :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span id="grand_total<?php echo $serviceData['longcode_id'];?>" >
	<?php		
		// echo $serviceData['total_amount'];   
 		//echo $grand_total = number_format(($total + $renew_tax),2,".","");
	?>		
</span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-7 col-sm-7 col-sm-offset-5 col-md-offset-5 padding_zero col-xs-12">  

  <input type="hidden" name="service_amount" id="service_amount<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="number_cost" id="number_cost<?php echo $serviceData['longcode_id'];?>" > 
<input type="hidden" name="service_tax" id="service_tax<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="num_sms" id="num_sms<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="subscription_duration" id="subscription_duration<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="price_per_long_code" id="price_per_long_code<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="total_amount" id="service_total_amount<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="subscription_id" id="subscription_id<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="longcode_number" id="longcode_number<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="no_of_keywords" id="no_of_keywords<?php echo $serviceData['longcode_id'];?>" >  
<input type="hidden" name="transaction_id" id="transaction_id<?php echo $serviceData['longcode_id'];?>" >
<input type="hidden" name="longcode_type" id="longcode_type<?php echo $serviceData['longcode_id'];?>" >    
<input type="submit" name="renewal_package" class="submit_btn" value="Renewal Now"/>
</div>
</div>
</div>
    </form>
    </div>  
    </div>
    </div>
</div> 
  <!-- Model End -->



</td> 

 </tr>		   
		
			<?php	 } ?>		
		</tbody> 
	</table>
	<!-- </div>
	   
	   </div> -->
	    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	<div class="pagination_div pull-right"> 
		 
	</div>	
	</div>
	   </div>
    </div>
</div>

</div>
</div>
</div> 
 




</body>
</html>
  
 
  <script src="<?php echo base_url(); ?>assets/js/jquery-validate.bootstrap-tooltip.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {

    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 50,
	   info: false,
		bLengthChange: false,
        filter: false,
		fnDrawCallback:function(){
if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
$('#example_wrapper .dataTables_paginate').css("display", "block");	
} else {
$('#example_wrapper .dataTables_paginate').css("display", "none");
}
}
    } );
} );

</script>


		
