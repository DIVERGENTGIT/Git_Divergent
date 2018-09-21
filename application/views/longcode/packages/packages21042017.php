


<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Long Code Packages</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        
<form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="" name="campaign_search" id="campaign_search" method="post">
  <ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="from_date" value="<?php echo @$from_date;?>" placeholder="" class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php echo @$to_date;?>" placeholder="" class="data-pickerbg"></li>
<li>
					
                      <select name="servicer_number">
                       <option value="">Select Service Numbers</option>
                      <?php
                      foreach($longcode_numbers as $key=>$longcode_number)
                      {
                      ?>
                      <option value="<?php echo $longcode_number->longcode_number;?>"
                       <?php if($longcode_number->longcode_number==$service_number) { echo "selected";}?> >
                      <?php echo $longcode_number->longcode_number;?></option>
                      <?php
                      }
                      ?>
                      </select>
 
</li><li>
                      <select name="service_type">
                       <option value="">Select Service Type</option>
                         <option value="dedicated"
                          <?php if($service_type=="dedicated") { echo "selected";}?> >Dedicated</option>
                         <option value="shared"   
                         <?php if($service_type=="shared") { echo "selected";}?> >Shared</option>
                      </select>

   <!-- <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">File Formate</label>
    <div class="col-sm-8"> 
	<select name="file_format" class="form-control">
<option value="xls">Excel</option>
</select>    </div>
  </div> -->
  
</li>

<li><input type="submit" class="submit_btn" value="Search" name="Search"></li>
</ul>


 </form>		
            </div>
        </div>
       
        </section>
        
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>No of Records : </span><?php echo @$total_reports;?>
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<div class="table-responsive">
		<table class="table_all">
		<thead>
		<tr>
		<th>S.No</th>
		<th>Longcode Number</th>
		<th>Service Type</th>
		<th>No.of.Keywords</th>
		<th>In Coming SMS</th>
		<th>Used SMS</th>
		<th>Available SMS</th>
		<th>Amount</th>
		<th>Subscribed Date</th>
		<th>Expiry Date</th>				
		<th>Actions</th>  
		</tr>
		</thead>
		<tbody>
		
		<?php
		$sno=1;
		if($this->uri->segment(3)!='')
		{
		$sno=$this->uri->segment(3)+1;
		}
		foreach($longcode_reports as $key => $longcode_report)
		{
		?>
		<tr>
		<td><?php echo $sno;?></td>
		<td><?php echo $longcode_report->longcode_number;?></td>
		<td><?php echo $longcode_report->service_type;?></td>
		<td><?php 
		if($longcode_report->no_of_keywords>0)
		{
		echo $longcode_report->no_of_keywords;
		}
		else
		{
		echo "---";
		}
		?></td>
		<td><?php if($longcode_report->no_of_sms>0) {echo $longcode_report->no_of_sms;}else { echo "0";}?></td>
		<td><?php if($longcode_report->used_incoming_sms>0) {echo $longcode_report->used_incoming_sms;}else { echo "0";}?></td>
		<td><?php
		$available=$longcode_report->no_of_sms-$longcode_report->used_incoming_sms;
		if($available>0) {echo $available;}else { echo "0";}
		?></td>
		<td><?php echo $longcode_report->total_amount;?></td>
		<td><?php echo $longcode_report->subscription_start;?></td>
		<td><?php echo $longcode_report->subscription_end;?></td>
		
		
<td> 

<a href="#renewalModal_<?php echo $longcode_report->longcode_id.'-'.$longcode_report->service_type;?>" data-toggle="modal" data-target="#renewalModal_<?php echo $longcode_report->longcode_id.'-'.$longcode_report->service_type;?>"><span data-toggle="tooltip" data-original-title="Renewal"><i class="fa fa-repeat" aria-hidden="true"></i></span></a>

<?php 
if($longcode_report->service_type=='dedicated')
{
?>
<!-- DEDICATED Model Start -->
<div class="modal fade" id="renewalModal_<?php echo $longcode_report->longcode_id.'-'.$longcode_report->service_type;?>" tabindex="-1" role="dialog" aria-labelledby="renewalModal_<?php $longcode_report->longcode_id.'-'.$longcode_report->service_type?>" data-backdrop="static">
<div class="modal-dialog role="document""> 
      
      <!-- Modal content-->
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
         
    </div>
Current Dedicated Package
<div class="modal-body col-md-12 col-sm-12 col-xs-12 displaydedicatedpackage">

<form name="dedicatedrenew_conf" target="_blank" action="<?php echo base_url();?>longcode/renwaldedicated" method="post" id="renew_conf" class="missedcall_allform renew_conf<?php //echo $user_pkg->usc_id; ?>"> 
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Subcription :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">

<select class="subscription<?php echo $longcode_report->longcode_id;?>" name="subscription" >
<option value="">Select Subscription</option>
<?php
foreach($getsubscription_packages as $key=>$subscription_package)
{
?>
<option value="<?php echo $subscription_package->subscription_duration;?>"
<?php if($subscription_package->subscription_duration==$longcode_report->subscription_duration) { echo "selected";} ?>>
<?php echo $subscription_package->subscription_duration;?></option>
<?php
}
?>
</select>
<span class="silversubmsg"></span>

</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">No.of.SMS :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">

<select class="getnoofsms<?php echo $longcode_report->longcode_id;?>" name="noofsms" >
		<option value="">Select No.of.SMS</option>
		<?php
		foreach($noofsms_packages as $key=>$noofsms_package)
		{
		?>
		<option value="<?php echo $noofsms_package->no_of_sms;?>"
		 <?php if($noofsms_package->no_of_sms==$longcode_report->no_of_sms) { echo "selected";} ?>>
		<?php echo $noofsms_package->no_of_sms;?></option>
		<?php
		}
		?>
</select>
 <span class="silvernoofsmsmsg"></span>
</div>

</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Service Number Cost :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span class="service_number_cost" id="service_number_cost<?php echo $longcode_report->longcode_id;?>" class="number_cost<?php echo $longcode_report->longcode_id;?>" >
 <?php echo $longcode_report->number_cost;?>
 </span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Amount :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span id="grand_total<?php echo $longcode_report->longcode_id;?>" class="amount<?php echo $longcode_report->longcode_id;?>"  >
<?php echo $longcode_report->amount;?> 		
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Tax :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i> 
<span class="renewal_tax" id="tax_amount<?php echo $longcode_report->longcode_id;?>" class="total<?php echo $longcode_report->longcode_id;?>" >
<?php echo $longcode_report->total_tax;?>  
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Total Amount :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span id="grand_total<?php echo $longcode_report->longcode_id;?>" class="total_amount<?php echo $longcode_report->longcode_id;?>" >
<?php echo $longcode_report->total_amount;?> 		
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-7 col-sm-7 col-sm-offset-5 col-md-offset-5 padding_rtzero padding_mzero col-xs-12">  

<input type="hidden" name="number_cost" class="number_cost<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->number_cost;?>"> 

<input type="hidden" name="number_type" class="number_type<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->longcode_type;?>">   

<input type="hidden" name="amount" class="amount<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->amount;?>">  

<input type="hidden" name="total_tax" class="total_tax<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->total_tax;?>">
<input type="hidden" name="total_amount" class="total_amount<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->total_amount;?>"> 
<input type="hidden" name="longcode_id" class="longcode_dedicated<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->longcode_id;?>"> 
<input type="hidden" name="longcode_number" class="longcode_number<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->longcode_number;?>">  
<input type="submit" name="renewal_package" class="submit_btn" value="Renewal Now"/>

</div>
</div>
</div>
    </form> 
<script type="text/javascript">
    $(document).ready(function(){
    
    $(".subscription<?php echo $longcode_report->longcode_id;?>,.getnoofsms<?php echo $longcode_report->longcode_id;?>").change(function(){
				
				var snosprice = "<?php echo $longcode_report->longcode_number;?>";
				var getsilvernoofsms = $(".getnoofsms<?php echo $longcode_report->longcode_id;?>").val();
				var getsilversubscription =$(".subscription<?php echo $longcode_report->longcode_id;?>").val();
				if(getsilversubscription!='')
				{
				
				$(".silversubmsg").html("");

				if(getsilvernoofsms!='')
				{

				$('.service_number_msg').html("");
				$(".silvernoofsmsmsg").html('');

				//var snosprice= $('.append_service_num').val();

				if(snosprice!='')
				{
					$.ajax({
					type: "GET",
					dataType:"json",
					data: {snosprice:snosprice,getnoofsms:getsilvernoofsms,getsubscription:getsilversubscription,status:'1'},
					url: "<?php echo base_url(); ?>longcode/RenwalSelectedNumbers",
					success: function (response) 
					{
					
					console.log(response);
					
					// input hidden
					$(".number_cost<?php echo $longcode_report->longcode_id;?>").val(response[0].number_cost);
					$(".number_type<?php echo $longcode_report->longcode_id;?>").val(response[0].longcode_type);
					$(".amount<?php echo $longcode_report->longcode_id;?>").val(response[0].amount);
					$(".total_tax<?php echo $longcode_report->longcode_id;?>").val(response[0].total_tax);
					$(".total_amount<?php echo $longcode_report->longcode_id;?>").val(response[0].total_amount);
					//$(".longcode_dedicated<?php echo $longcode_report->longcode_id;?>").val(response[0].longcode_id);
					//$(".longcode_number<?php echo $longcode_report->longcode_id;?>").val(response[0].longcode_number);
					
					// span
					
					$(".number_cost<?php echo $longcode_report->longcode_id;?>").html(response[0].number_cost);
					$(".number_type<?php echo $longcode_report->longcode_id;?>").html(response[0].longcode_type);
					$(".amount<?php echo $longcode_report->longcode_id;?>").html(response[0].amount);
					$(".total_tax<?php echo $longcode_report->longcode_id;?>").html(response[0].total_tax);
					$(".total_amount<?php echo $longcode_report->longcode_id;?>").html(response[0].total_amount);
					//$(".longcode_dedicated<?php echo $longcode_report->longcode_id;?>").html(response[0].longcode_id);
					//$(".longcode_number<?php echo $longcode_report->longcode_id;?>").html(response[0].longcode_number);
					
					
					
					}
					});	

				} 

				}
				else
				{
				
				$(".silvernoofsmsmsg").html("Select no of sms");
	                  $(".silvernoofsmsmsg").css('color','red');
				
				}
				}
				else
				{
				$(".silversubmsg").html("Select subscription");
				$(".silversubmsg").css('color','red');
				
				}

				
                
                
                
            
            
        });
    });
</script>
 
    </div>  
    </div>
    </div>
</div> 
  <!-- DEDICATED Model End -->
<?php 
}
if($longcode_report->service_type=='shared')
{
?> 
  
<!-- SHARED Model Start -->
<div class="modal fade" id="renewalModal_<?php echo $longcode_report->longcode_id.'-'.$longcode_report->service_type;?>" tabindex="-1" role="dialog" aria-labelledby="renewalModal_<?php $longcode_report->longcode_id.'-'.$longcode_report->service_type;?>" data-backdrop="static">
<div class="modal-dialog role="document""> 
      
      <!-- Modal content-->
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
         
    </div>
    
<div class="modal-body col-md-12 col-sm-12 col-xs-12">
Long Code Shared Package
<form name="dedicatedrenew_conf" target="_blank" action="<?php echo base_url();?>longcode_shared/renwalshared" method="post" id="renew_conf" class="missedcall_allform renew_conf<?php //echo $user_pkg->usc_id; ?>"> 
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Subcription :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">

<select class="sharedsubscription<?php echo $longcode_report->longcode_id;?>" name="subscription" >
<option value="">Select Subscription</option>
<?php
foreach($getsubscription_packages as $key=>$subscription_package)
{
?>
<option value="<?php echo $subscription_package->subscription_duration;?>"
<?php if($subscription_package->subscription_duration==$longcode_report->subscription_duration) { echo "selected";} ?>>
<?php echo $subscription_package->subscription_duration;?></option>
<?php
}
?>
</select>
<span class="sharedsilversubmsg"></span>

</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">No.of.Keywords :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<input type="text" name="noofkeywords" class="getsharedkeyword<?php echo $longcode_report->longcode_id;?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter No of Keywords" maxlength="15" value="<?php echo $longcode_report->no_of_keywords;?>">
<span class="sharedkeywordmsg"></span>
</div>

</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Amount :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span id="grand_total<?php echo $longcode_report->longcode_id;?>" class="amount<?php echo $longcode_report->longcode_id;?>"  >
<?php echo $longcode_report->amount;?> 		
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Tax :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i> 
<span class="renewal_tax" id="tax_amount<?php echo $longcode_report->longcode_id;?>" class="total<?php echo $longcode_report->longcode_id;?>" >
<?php echo $longcode_report->total_tax;?>  
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding_zero col-xs-12">
<span class="form_lable03">Total Amount :</span>
</div>
<div class="col-md-7 col-sm-7 padding_rtzero padding_mzero col-xs-12">
<i class="fa fa-inr" aria-hidden="true"></i>
<span id="grand_total<?php echo $longcode_report->longcode_id;?>" class="total_amount<?php echo $longcode_report->longcode_id;?>" >
<?php echo $longcode_report->total_amount;?> 		
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-7 col-sm-7 col-sm-offset-5 col-md-offset-5 padding_rtzero padding_mzero col-xs-12">  

<input type="hidden" name="number_type" class="number_type<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->longcode_type;?>">   

<input type="hidden" name="amount" class="amount<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->amount;?>">  

<input type="hidden" name="total_tax" class="total_tax<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->total_tax;?>">
<input type="hidden" name="total_amount" class="total_amount<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->total_amount;?>"> 
<input type="hidden" name="longcode_id" class="longcode_dedicated<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->longcode_id;?>"> 
<input type="hidden" name="longcode_number" class="longcode_number<?php echo $longcode_report->longcode_id;?>" 
value="<?php echo $longcode_report->longcode_number;?>">  
<input type="submit" name="renewal_package" class="submit_btn" value="Renewal Now"/>

</div>
</div>
</div>
    </form> 
<script type="text/javascript">
    $(document).ready(function(){
    
    $(".sharedsubscription<?php echo $longcode_report->longcode_id;?>,.getsharedkeyword<?php echo $longcode_report->longcode_id;?>").change(function(){
				
				var snosprice = "<?php echo $longcode_report->longcode_number;?>";
				var getsharedkeyword = $(".getsharedkeyword<?php echo $longcode_report->longcode_id;?>").val();
				
				var sharedsubscription =$(".sharedsubscription<?php echo $longcode_report->longcode_id;?>").val();
				
				if(sharedsubscription!='')
				{
				
				$(".sharedsilversubmsg").html("");

				if(getsharedkeyword!='')
				{

				$('.service_number_msg').html("");
				$(".silvernoofsmsmsg").html('');

				//var snosprice= $('.append_service_num').val();

				if(snosprice!='')
				{
					$.ajax({
					type: "GET",
					dataType:"json",
					data: {snosprice:snosprice,getkeyword:getsharedkeyword,getsubscription:sharedsubscription,status:'1'},
					url: "<?php echo base_url(); ?>longcode_shared/RenwalSelectedNumbers",
					success: function (response) 
					{
					
					console.log(response);
					
					// input hidden
					$(".number_cost<?php echo $longcode_report->longcode_id;?>").val(response[0].number_cost);
					$(".number_type<?php echo $longcode_report->longcode_id;?>").val(response[0].longcode_type);
					$(".amount<?php echo $longcode_report->longcode_id;?>").val(response[0].amount);
					$(".total_tax<?php echo $longcode_report->longcode_id;?>").val(response[0].total_tax);
					$(".total_amount<?php echo $longcode_report->longcode_id;?>").val(response[0].total_amount);
					//$(".longcode_dedicated<?php echo $longcode_report->longcode_id;?>").val(response[0].longcode_id);
					//$(".longcode_number<?php echo $longcode_report->longcode_id;?>").val(response[0].longcode_number);
					
					// span
					
					$(".number_cost<?php echo $longcode_report->longcode_id;?>").html(response[0].number_cost);
					$(".number_type<?php echo $longcode_report->longcode_id;?>").html(response[0].longcode_type);
					$(".amount<?php echo $longcode_report->longcode_id;?>").html(response[0].amount);
					$(".total_tax<?php echo $longcode_report->longcode_id;?>").html(response[0].total_tax);
					$(".total_amount<?php echo $longcode_report->longcode_id;?>").html(response[0].total_amount);
					//$(".longcode_dedicated<?php echo $longcode_report->longcode_id;?>").html(response[0].longcode_id);
					//$(".longcode_number<?php echo $longcode_report->longcode_id;?>").html(response[0].longcode_number);
					
					
					
					}
					});	

				} 

				}
				else
				{
				
				$(".sharedkeywordmsg").html("Please enter no of keywords");
	                  $(".sharedkeywordmsg").css('color','red');
				
				}
				}
				else
				{
				$(".sharedsilversubmsg").html("Select subscription");
				$(".sharedsilversubmsg").css('color','red');
				
				}

				
                
                
                
            
            
        });
    });
</script>
     
    </div>  
    </div>
    </div>
</div> 
  <!-- SHARED Model End -->
 <?php
 }
 ?>
  
</td> 
		
		</tr>
		<?php
		$sno++;
		}
		?>
		</tbody>
		</table>
			</div>	
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">	  
			<?php echo $this->pagination->create_links(); 
			?>
			</div>
</div>
</div>
</div>
</div>

<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
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

 
 
 
<!--  
<script src="<?php echo base_url();?>js/jquery.min.js" type="text/javascript"></script>
-->
 <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>
 <script>
$(document).ready(function() {
  
	 $(".addmisstabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentmisstab");
        $(this).parent().siblings().removeClass("currentmisstab");
        var tab = $(this).attr("href");
        $(".missadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	
$('#customersms').change(function(){
  if($(this).prop("checked")) {
    $('.customshowdiv').show();
  } else {
    $('.customshowdiv').hide();
  }
});
$('#vendorsms').change(function(){
  if($(this).prop("checked")) {
    $('.vendorshowdiv').show();
  } else {
    $('.vendorshowdiv').hide();
  }
});
});
</script>
 

<?php $this->load->view("longcode/longcode_script");?>

<!--
<script src="http://10.10.10.199/FirstRing/js/jquery.min.js" type="text/javascript"></script>
-->

<script type="text/javascript">
	$(document).ready(function(){
	$(".vendor_alertbtns").click(function(){
	var txt = $.trim($(this).val());
	var box = $(".append_venderchkval");
	box.val(box.val() +'<'+txt+'>' +' ');
	});
	$('.vendor_alertbtns').click(function(){
	
  $('.append_venderchkval').attr("readonly", false);
	
	 
});
	});
	</script>

<script>
$(document).ready(function() {
$(".missedcall_allformsub").validate({
    rules: {
        
		'longcode_numbers[]': {
            required: true
		        },
       // 'getkeywords[]': {
            //required: true			
       // }, 
        customeralert:{
                  required: function (element) {
                     if($("#customersms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  },
                 regexpcol: function (element) {
                     if($("#customersms").is(':checked')){
                       regexpcol: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }	  
               },
          longcode_sender_name:{
                  required: function (element) {
                     if($("#customersms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  },
                 regexpcol: function (element) {
                     if($("#customersms").is(':checked')){
                       regexpcol: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }	  
               },
        vendoralert:{
                  required: function (element) {
                     if($("#vendorsms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  },
                 regexpcol: function (element) {
                     if($("#vendorsms").is(':checked')){
                       regexpcol: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
 
                 vendor_mobileno: {
			number: true,
		     required: function (element) {
                     if($("#vendorsms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }  
		},
 		connect_api_url: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		phone_number: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		service_numbers: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		sms_time: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},sms_text_param: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		}
		 
		
    },
    messages: {
        
		'longcode_numbers[]': {
            required: "Please Select Services Number"            
        },
     //   'getkeywords[]': {
           // required: "Please Select Services Keyword"            
       // },
        longcode_sender_name: {
            required: "Please Enter Sender Name"            
        },
        customeralert: {
            required: "Please Enter Customer Alert"            
        },
	connect_api_url: {
 		required: "Please Enter Url"    
	},
	phone_number: {
 		required: "Please Enter Phone Number Parameter"    
	},
	service_numbers: {
 		required: "Please Enter Service Number Parameter"    
	},
	sms_time: {
 		required: "Please Enter Time Parameter"    
	},sms_text_param: {
 		required: "Please Enter SMS Text Parameter"    
	},
	 
		vendor_mobileno: {
			  number: "Please Enter 10 Digit Mobile Numbers",
			  required: "Please Enter Mobile Number"
		},  
         vendoralert: {
            required: "Please Enter Vendor Alert"            
        }
    },
	tooltip_options: {
		'longcode_numbers[]': {placement:'bottom',html:true},
		'getkeywords[]': {placement:'bottom',html:true},
		longcode_sender_name: {placement:'bottom',html:true},
		customeralert: {placement:'bottom',html:true},
		vendor_mobileno: {placement:'bottom',html:true},
		vendoralert: {placement:'bottom',html:true}
		}
}); 
}); 
 </script>
 
 <script type="text/javascript">
    $(document).ready(function(){
    
		$.ajax({
		type: "GET",
		data: {},
		url: "<?php echo base_url(); ?>longcode/DisplayNumbers",
		success: function (callback_data) 
		{
		console.log(callback_data);
		//console.log($('#rental_plan'));
		$('.didprice').html(callback_data);
		}
		});	
    
    });
  </script>	

	<script>
	$(document).ready(function() {
$('#longcode_api').change(function(){
	$('#api_alert').val('');
  if($(this).prop("checked")) {
    $('.api_show_div').show();
$('#api_alert').val(1);
  } else {
    $('.api_show_div').hide();
$('#api_alert').val('');
  }
});

});
	</script>




  
