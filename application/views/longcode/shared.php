
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
    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/longcode-icon.png" class="right-title-img">Shared</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-10 col-sm-10 col-xs-12 servicewidth padding_zero">
<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
  
<form class="missedcall_allform missedcall_allformsub" method="post" enctype="multipart/form-data">
                <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			   <div class="col-sm-3 col-md-2 col-xs-12 padding_zero">
 <label class="form_lable lablefont">Long Code Number</label>
 </div>
                    <div class="col-sm-7 col-md-7 padding_mzero col-xs-12">
                    <!--
                    <select name="longcode_numbers[]" multiple>
                       <option value="">Select Numbers</option>
                      <?php
                      foreach($longcode_numbers as $key=>$longcode_number)
                      {
                      ?>
                      <option value="<?php echo $longcode_number->longcode_number;?>">
                      <?php echo $longcode_number->longcode_number;?></option>
                      <?php
                      }
                      ?>
                      </select>
                      -->
                      <select name="longcode_numbers[]">
                       <option value="">Select Numbers</option>
                      <?php
                      foreach($longcode_numbers as $key=>$longcode_number)
                      {
                      ?>
                      <option value="<?php echo $longcode_number->longcode_number;?>">
                      <?php echo $longcode_number->longcode_number;?></option>
                      <?php
                      }
                      ?>
                      </select>
							
                    </div>
					<div class="col-sm-2 col-md-2 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				<span class=""><a href="#addloncodemodel" data-toggle="modal" class="add_pluse" data-target="#addloncodemodel">
                                    <i class="fa fa-plus"></i>
                                    <span>Add</span>
                                </a></span>
				</div>
						
			</div>
                </div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-3 col-md-2 col-xs-12 padding_zero">
			<label class="form_lable lablefont">Keyword</label>
			</div>
			<div class="col-sm-7 col-md-7 padding_mzero col-xs-12">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

				<!-- 
				<input type="text" name="" placeholder="Enter Keyword">
				 -->
				 <!--
			    <select name="getkeywords[]" multiple class="getkeywords">
                      <option value="">Select Keywords</option>
                      </select>
				-->
				
				<select name="getkeywords"  class="getkeywords">
				<option value="">Select Keywords</option>
				</select>
                      
				</div>
						
			</div> 
			<div class="col-sm-2 col-md-2 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				<span class="getkeywordnumbers addkeywords"><a href="#addkeywordmodel" data-toggle="modal" class="add_pluse" data-target="#addkeywordmodel">
                                    <i class="fa fa-plus"></i>
                                    <span >Add</span>
                                </a></span>
				</div>
						
			</div>
			</div>   
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		
<input type="checkbox" name="customersms" id="customersms">
  <label class="checklable font_normal" for="customersms">Customer SMS</label>

<input type="hidden" name="customersmsreqired" value="1" id="customersmsreqired">
				</div>
				</div>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12 customshowdiv padding_zero" style="display:none;">
				<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				
		<!--
		            <input type="text" name="senderid">
		            -->
		            <select name="longcode_sender_name" >
                       <option value="">Select Sender ID</option>
                      <?php
                      foreach($sender_names as $key=>$sender)
                      {
                      ?>
                      <option value="<?php echo $sender->sender_name;?>">
                      <?php echo $sender->sender_name;?></option>
                      <?php
                      }
                      ?>
                      </select>
		
				</div>
				</div>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		<textarea name="customeralert"></textarea>
				</div>
				</div>
				</div>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		
<input type="checkbox" name="vendorsms" id="vendorsms">
  <label class="checklable font_normal" for="vendorsms">Vendor SMS</label>
    <input type="hidden" name="vendorsmsreqired" value="1" id="vendorsmsreqired">

				</div>
				</div>
				</div>
				
				<div class="col-sm-12 col-md-12 col-xs-12 vendorshowdiv padding_zero" style="display:none;">
				
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
<?php
$user_id=$this->session->userdata('user_id');
$mobile='';
$sql="select mobile from users where user_id=$user_id";
$result=$this->db->query($sql)->result();
//print_r($result);
foreach($result as $key=>$value)
{
$mobile=$value->mobile;
}  
?>

				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		            <input type="text" name="vendor_mobileno" value="<?php echo @$mobile;?>"
		             maxlength="10"onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Phone Number" >
				</div>
				
				</div>
				</div>
				
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		<textarea name="vendoralert" class="append_venderchkval"></textarea>
		</div>
		

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<ul class="venderlist">
<li>
<span>
<input type="button" name="" value="Message" class="vendor_alertbtns" placeholder=""></span>
</li>
<li>
<span>
<input type="button" name="" value="Customer Number" class="vendor_alertbtns" placeholder=""></span>
</li>
<li>
<span>
<input type="button" name="" value="Service Number" class="vendor_alertbtns" placeholder=""></span>
</li>
<li>
<span>
<input type="button" name="" value="Sent Time" class="vendor_alertbtns" >
</span>
</li>
</ul>

</div>
				</div>
				</div>
				</div>

</div>		
			
	 </div> 



<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-2 padding_mzero col-xs-12">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		
<input type="checkbox" name="" id="longcode_api">
  <label class="checklable font_normal" for="longcode_api">API</label>

				</div>
				</div>  
				</div>	

<div class="col-sm-12 col-md-12 col-xs-12 api_show_div padding_zero" style="display:none;">
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-2">
<input type="text" name="connect_api_url" id="connect_api_url" placeholder="Enter API Url (ex: http://www.example.com)" >				
			</div>
			</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-2">
<input type="text" name="phone_number" id="phone_number"  placeholder="Enter Phone Number Parameter (ex: Phoneno)">				
			</div>
			</div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-2">
<input type="text" name="service_numbers" id="service_numbers"  placeholder="Enter Service Number Parameter (ex: Serviceno)">				
			</div>
			</div> 
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-2">
<input type="text" name="sms_time" id="sms_time" placeholder="Enter Sms Time Parameter (ex: smstime)">				
			</div>
			</div>
<!--			
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
			<div class="col-sm-4 col-md-4 col-xs-12 col-sm-offset-2 col-md-offset-2">
<input type="text" name="sms_status" id="sms_status" placeholder="Enter Service Type Parameter (ex: Servicetype)">				
			</div>
			</div>
-->
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-2">
<input type="text" name="sms_text_param" id="sms_text_param" placeholder="SMS Text Parameter (ex:message)">				
			</div>
			</div>
 
<input type="hidden" name="api_alert" id="api_alert" >	 			
 
 
</div>
			<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-2">
<input type="submit" name="LongcodeSubmit" value="Submit" class="submit_btn">		
			</div>
			</div>
                </div>
				</form>
            </div>
        </div>
       
        </section>
        
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span></span>
		</div>
		
		<?php
		if(@$existnumber!='')
		{
		?>
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>Note : </span>
		<?php
		echo "<span style='color:red'>This Keywords already configured ".rtrim($existnumber,",")."!...</span>";
		?>
		</div>
		
		<?php
		}
		?>
        
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>No of Records : </span><?php echo @$total_reports;?>
		</div>
		
		<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		<div class="">
		<table class="table_all" >
		<thead>
		<tr>
		<th>S.No</th>
		<th>Keywords</th>
		<th>Service Number</th>
		<th>Date</th>
		<th>text</th>
		<th colspan="2">Action</th>
		</tr>
		</thead>
		
		<tbody>
		
		<?php
		$sno=1;
		foreach($longcode_configdata as $key => $keyworddata)
		{
		?>
		<tr>
		<td><?php echo $sno;?></td>
		<td><?php echo $keyworddata->keyword;?></td>
		<td><?php echo $keyworddata->longcode_number;?></td>
		<td><?php echo $keyworddata->created_on;?></td>
		<td class="text-right"><div class="dropdown col-sm-12 col-md-12 form-div col-xs-12 padding_zero">
		<div class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-eye" aria-hidden="true"></i> Customer SMS</div>
		
  <div class="dropdown-menu">
  <div class="col-sm-12 col-md-12 col-xs-12">
  <p><?php echo $keyworddata->customer_alert;?></p>
  </div>
  </div>
		
		</div>
		<div class="dropdown col-sm-12 col-md-12 form-div col-xs-12 padding_zero">
		<div class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-eye" aria-hidden="true"></i> Vendor SMS</div>
	<div class="dropdown-menu">
	<div class="col-sm-12 col-md-12 col-xs-12">
  <p><?php echo $keyworddata->vender_alert;?></p>
  </div>
	</div>	
		</div>
		
		</td>
	
		<td>
		<a href="#editlongcodetbl<?php echo $keyworddata->longcode_id;?>" data-toggle="modal" data-target="#editlongcodetbl<?php echo $keyworddata->longcode_id;?>" 
		class="btn btn-sm btn-default">Edit</a>
		
		
  <!-- SMS Model Start -->
  <div class="modal fade" id="editlongcodetbl<?php echo $keyworddata->longcode_id;?>" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
       
	<div class="smsadmintabdiv">
	 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">  

	 
<form class="missedcall_allform longcode_shared<?php echo $keyworddata->longcode_id;?>" name="longcode_dedicated" method="post" enctype="multipart/form-data">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_dzero">
 						<span class="form_lable">Sender ID</span> 
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  
	                     <select name="edit_sender_name<?php echo $keyworddata->longcode_id;?>" >
	                       <option value="">Select Sender ID</option>
	                      <?php
	                      foreach($sender_names as $key=>$sender)
	                      {
	                      ?>
	                      <option value="<?php echo $sender->sender_name;?>"
	                       <?php if($sender->sender_name==$keyworddata->sender_id) { echo "selected";} ?>>
	                      <?php echo $sender->sender_name;?></option>
	                      <?php
	                      }
	                      ?>
	                      </select>
						 
						 </div>
						  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_dzero">
 						<span class="form_lable">Customer SMS</span> 
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<textarea  name="editcustomeralert<?php echo $keyworddata->longcode_id;?>" class="editcustomeralert<?php echo $keyworddata->longcode_id;?>" placeholder="Type here"><?php echo $keyworddata->customer_alert;?></textarea>
						 </div>
						  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_dzero">
						<span class="form_lable">Vendor SMS</span> 
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<textarea name="editvendoralert<?php echo $keyworddata->longcode_id;?>" 
class="editvendoralert<?php echo $keyworddata->longcode_id;?>" placeholder="Type here"><?php echo $keyworddata->vender_alert;?></textarea>
						 </div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<ul class="venderlisteidt">
<li>
<span>
<input type="button" name="" value="Message" class="editvendor_alertbtns<?php echo $keyworddata->longcode_id;?>" placeholder=""></span>
</li>
<li>
<span>
<input type="button" name="" value="Customer Number" class="editvendor_alertbtns<?php echo $keyworddata->longcode_id;?>" placeholder=""></span>
</li>
<li>
<span>
<input type="button" name="" value="Service Number" class="editvendor_alertbtns<?php echo $keyworddata->longcode_id;?>" placeholder=""></span>
</li>
<li>
<span>
<input type="button" name="" value="Sent Time" class="editvendor_alertbtns<?php echo $keyworddata->longcode_id;?>" >
</span>
</li>
</ul>

</div>
						  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_dzero">
						<span class="form_lable">Vendor Number</span> 
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<input type="text" name="editvendornumber<?php echo $keyworddata->longcode_id;?>" class="editvendornumber<?php echo $keyworddata->longcode_id;?>" value="<?php echo $keyworddata->vendor_number;?>"  maxlength="10"   placeholder="Phone Number"/>
						 </div>
						  </div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-5 col-md-5 col-sm-offset-3 col-md-offset-3 col-xs-12">
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		<div class="all_checkbox">
<input type="checkbox" name="" id="longcode_apiedit<?php echo $keyworddata->longcode_id;?>">
  <label class="font_normal" for="longcode_apiedit<?php echo $keyworddata->longcode_id;?>"><span><span></span></span>API</label>
</div>
				</div>
				</div>  
				</div>
				
				<div class="col-sm-12 col-md-12 col-xs-12 api_show_divedit<?php echo $keyworddata->longcode_id;?> padding_zero" style="display:none;">
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-5 col-md-5 col-xs-12 col-sm-offset-3 col-md-offset-3">
<input type="text" name="connect_api_url<?php echo $keyworddata->longcode_id;?>" id="connect_api_url"  value="<?php echo $keyworddata->connect_api_url;?>"
placeholder="Enter API Url (ex: http://www.example.com)" >				
			</div>
			</div>

<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-5 col-md-5 col-xs-12 col-sm-offset-3 col-md-offset-3">
<input type="text" name="phone_number<?php echo $keyworddata->longcode_id;?>"  id="phone_number" value="<?php echo $keyworddata->phone_number;?> "
 placeholder="Enter Phone Number Parameter (ex: Phoneno)"  >				
			</div>
			</div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-5 col-md-5 col-xs-12 col-sm-offset-3 col-md-offset-3">
<input type="text" name="service_numbers<?php echo $keyworddata->longcode_id;?>"   id="service_numbers" value="<?php echo $keyworddata->service_numbers;?>"
placeholder="Enter Service Number Parameter (ex: Serviceno)">				
			</div>
			</div> 
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-5 col-md-5 col-xs-12 col-sm-offset-3 col-md-offset-3">
<input type="text" name="sms_time<?php echo $keyworddata->longcode_id;?>" id="sms_time" value="<?php echo $keyworddata->sms_time;?>"
 placeholder="Enter Sms Time Parameter (ex: smstime)">				
			</div>
			</div>
<!--
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-4 col-md-4 col-xs-12 col-sm-offset-2 col-md-offset-2">
<input type="text" name="sms_status" id="sms_status" placeholder="Enter Service Type Parameter (ex: Servicetype)">				
			</div>
			</div>
 -->
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-5 col-md-5 col-xs-12 col-sm-offset-3 col-md-offset-3">
<input type="text" name="sms_text_param<?php echo $keyworddata->longcode_id;?>" id="sms_text_param" value="<?php echo $keyworddata->sms_text_param;?>"
placeholder="SMS Text Parameter (ex:message)">				
			</div>
			</div>
 
 
<input type="hidden" name="api_alert" id="api_alert" >	 			
 
 
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 col-md-offset-3 col-sm-offset-3 txt_alignrt col-xs-12">
<input type="hidden" name="longcode_id"  value="<?php echo $keyworddata->longcode_id;?>">

<input type="submit" name="editlongcode_config" class="temp-append-btn submit_btn" value="Update">

						</div>
						</div>

</div>
</form>


<script>
$(document).ready(function() {
$(".longcode_shared<?php echo $keyworddata->longcode_id;?>").validate({
    rules: {
        'editcustomeralert<?php echo $keyworddata->longcode_id;?>':{
                  required: true
               },
          'edit_sender_name<?php echo $keyworddata->longcode_id;?>':{
                  required: true
               },
        'editvendoralert<?php echo $keyworddata->longcode_id;?>':{
                  required: true
               },
         'editvendornumber<?php echo $keyworddata->longcode_id;?>': { 
      		     required:true,
      		     number:true
      		},
         'connect_api_url<?php echo $keyworddata->longcode_id;?>': { 
		     required: function (element) {
                     if($("#longcode_apiedit<?php echo $keyworddata->longcode_id;?>").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		
		'phone_number<?php echo $keyworddata->longcode_id;?>': { 
		     required: function (element) {
                    if($("#longcode_apiedit<?php echo $keyworddata->longcode_id;?>").is(':checked')){
                      required: true;                               
                    }  
                    else
                    {
                        return false;
                    }  
                 },
                 number:true  
		},
		'service_numbers<?php echo $keyworddata->longcode_id;?>': { 
		     required: function (element) {
                     if($("#longcode_apiedit<?php echo $keyworddata->longcode_id;?>").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }   
		},
		'sms_time<?php echo $keyworddata->longcode_id;?>': { 
		     required: function (element) {
                     if($("#longcode_apiedit<?php echo $keyworddata->longcode_id;?>").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		'sms_text_param<?php echo $keyworddata->longcode_id;?>': { 
		     required: function (element) {
                     if($("#longcode_apiedit<?php echo $keyworddata->longcode_id;?>").is(':checked')){
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
        'edit_sender_name<?php echo $keyworddata->longcode_id;?>': {
            required: "Please Select Sender Name"            
        },
        'editcustomeralert<?php echo $keyworddata->longcode_id;?>': {
            required: "Please Enter Customer SMS Reply"            
        },
        'editvendornumber<?php echo $keyworddata->longcode_id;?>': {
            required: "Please Enter Vendor Number"            
        },
        'editvendoralert<?php echo $keyworddata->longcode_id;?>': {
            required: "Please Enter Vendor SMS Reply"            
        },
        'connect_api_url<?php echo $keyworddata->longcode_id;?>': {
 		required: "Please Enter Url"    
	},
	'phone_number<?php echo $keyworddata->longcode_id;?>': {
 		required: "Please Enter Phone Number Parameter"    
	},
	'service_numbers<?php echo $keyworddata->longcode_id;?>': {
 		required: "Please Enter Service Number Parameter"    
	},
	'sms_time<?php echo $keyworddata->longcode_id;?>': {
 		required: "Please Enter Time Parameter"    
	},
	'sms_text_param<?php echo $keyworddata->longcode_id;?>': {
 		required: "Please Enter SMS Text Parameter"    
	},
		
    },
	tooltip_options: {
		'edit_sender_name<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'editcustomeralert<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'editvendoralert<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'editvendornumber<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'connect_api_url<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'phone_number<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'service_numbers<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'sms_time<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true},
		'sms_text_param<?php echo $keyworddata->longcode_id;?>': {placement:'bottom',html:true}
		
		}
});

$('#longcode_apiedit<?php echo $keyworddata->longcode_id;?>').change(function(){

  if($(this).prop("checked")) {
  
    $('.api_show_divedit<?php echo $keyworddata->longcode_id;?>').show();

  } else {
    $('.api_show_divedit<?php echo $keyworddata->longcode_id;?>').hide();

  }
}); 
 
}); 
 </script>
 
 <script type="text/javascript">
	$(document).ready(function(){
	
	$(".editvendor_alertbtns<?php echo $keyworddata->longcode_id;?>").click(function(){
	var txt = $.trim($(this).val());
	var box = $(".editvendoralert<?php echo $keyworddata->longcode_id;?>");
	box.val(box.val() +'<'+txt+'>' +' ');
	});
	
	$('.editvendor_alertbtns<?php echo $keyworddata->longcode_id;?>').click(function(){
	
  $('.editvendoralert<?php echo $keyworddata->longcode_id;?>').attr("readonly", false);
	
	 
});
	});
	</script>
 

</div>
 
</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Model End -->
		</td>
		<td>
		<span class="btn btn-sm btn-default"   
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					style="" 
					data-href="shared/delete/<?php echo $keyworddata->longcode_id;?>";
					>Delete</span>
		
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

<!-- Add Missedcall Model Start -->
  <div class="modal fade" id="addloncodemodel" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12">

        <div class="modal-header">
		
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-10 col-sm-10 col-xs-12 padding_zero">

<!---		
<ul class="addmisstabs">
<li class="currentmisstab silvertab_numbers"  ><a href="#silvertab">Silver</a></li>
<li class="goldtab_numbers" ><a href="#goldtab" >Gold</a></li>
<li class="platinumtab_numbers" ><a href="#platinumtab">Platinum</a></li>

</ul>
-->
   <!-- 
    <input type="text" class="append_service_num">
    -->
	</div>
	<div class="col-md-2 col-sm-2 col-xs-12 round-priceing price-abslut02 padding_zero">
	<div class="total_price">
	<div class="total-price-lable">
	<span>Total Price ( <i class="fa fa-inr" aria-hidden="true"></i> ) </span>
	</div>
	<div class="total-price-amount">
	<span class="total-price" >0</span>
	</div>
	</div>
	</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	 <div class="smsadmintabdiv missedcall_allform">
	 
		<div id="silvertab" class="missadmintab-content">
		<!-- displaysilvertab start-->
		<div class="displaysharednos">
		</div>
		<!-- displaysilvertab end-->
		</div>
	 
	        
	
</div>
</div>
	
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<p class="select-num-title">Selected Numbers</p>
		</div>
		
		<!--  sevice number table dispaly start-->
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero didprice">
		</div>
		<!--  sevice number table dispaly end-->
		
		<!-- confirm order start -->
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		
		<!--
		<form action="<?php echo base_url()?>Payment/confirm_order" method="post" target="_blank">
		
		<input type="hidden" name="service_numbers" class="append_service_num" value="<?php echo $_SESSION['sel_nos'];?>">
		<input type="hidden" name="flag"   value="longcode">
		<input type="hidden" name="service_type"   value="shared">
		<input type="submit" name="" class="create-btn" value="Confirm Order">
		</form>
		-->
		
		</div>
		</div>
		<!-- confirm order start -->
		
</div>

        </div>
        
      </div>
      
    </div>
 <!-- Add longcode Model End -->
 
 
 <!-- Add keyword Model Start -->
  <div class="modal fade" id="addkeywordmodel" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12">

        <div class="modal-header">
        
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<!--
		<div class="col-md-10 col-sm-10 col-xs-12 missedcall_allform form-div padding_zero">
		<div class="col-md-8 col-sm-8 col-xs-12 col-sm-offset-4 col-md-offset-4 mrg-keywd padding_zero">
<div class="col-md-6 col-sm-6 col-xs-12">
 
		<input type="text" name="getcreatekeyword" class="getcreatekeyword" placeholder="Enter Keyword">

		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		 
		<input type="button" name="" class="create-btn createkeyword" value="create">
		
		</div>
		</div>
		</div>-->
	<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
	
	<!--  
	<div class="total_price">
	<div class="total-price-lable">
	<span>Total Price</span>
	</div>
	<div class="total-price-amount">
	<span>100</span>
	</div>
	</div>
	-->
	
	</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	 <div class="smsadmintabdiv missedcall_allform">
    <!-- displaykeywords start -->
    <div class="displaykeywords" > 
	
	</div>
	
	<!-- displaykeywords end -->
	
	
</div>

</div>	
</div>

        </div>
        
      </div>
      
    </div>
 
 <!-- Add keyword Model End -->
 
 
 
  <!-- SMS Model Start -->
  <div class="modal fade" id="editlongcodetbl" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
       
	<div class="smsadmintabdiv">
	 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <form class="missedcall_allform" method="post" enctype="multipart/form-data">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_dzero">
						<span class="form_lable">Customer SMS Reply</span> 
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  <input type="text" class="customeralert" name="customeralert" placeholder="Type here">
						
						 </div>
						 
						  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_dzero">
						<span class="form_lable">Vendor SMS Reply</span> 
						 </div>
						  <div class="col-md-5 col-sm-5 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  <textarea class="vendoralert" name="vendoralert" placeholder="Type here"></textarea>
						
						 </div>
						 
						  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 col-md-offset-3 col-sm-offset-3 txt_alignrt col-xs-12">

<input type="button" name="" class="temp-append-btn create-btn" data-dismiss="modal" value="Update">

						</div>
						</div>

</div>
</form>
</div>
 
</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Model End -->
  
  
 <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>
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
    $('#customersmsreqired').val('1');
  } else {
    $('.customshowdiv').hide();
    $('#customersmsreqired').val('0');
     $('#vendorsmsreqired').val('1');
  }
});

$('#vendorsms').change(function(){
  if($(this).prop("checked")) {
    $('.vendorshowdiv').show();
    $('#vendorsmsreqired').val('1');
  } else {
    $('.vendorshowdiv').hide();
    $('#vendorsmsreqired').val('0');
     $('#customersmsreqired').val('1');
  }
});


});
</script>

<?php $this->load->view("longcode/shared/shared_script");?>




<script>
$(document).ready(function() {
$(".missedcall_allformsub").validate({
    rules: {
        
		'longcode_numbers[]': {
            required: true
		        },
		        
         'getkeywords': {
            required: true			
        }, 
        
       /* 'customersms': {
           required: function (element) {
           
                     if($("#customersmsreqired").val()=='1'){
                    
                       required: true;
                                                      
                     }
                     else
                     {
                         return false;
                     } 
                      
                  }			
        },
         'vendorsms': {
           required: function (element) {
           
                      if($("#vendorsmsreqired").val()=='1'){
                    
                       required: true;
                                                      
                     }
                     else
                     {
                         return false;
                     } 
                      
                  }			
        },  */
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
            required: "Please Select  Number"            
        },
        'getkeywords': {
            required: "Please Select  Keyword"            
        },
        longcode_sender_name: {
            required: "Please Enter Sender Name"            
        },
        /*customersms: {
            required: "Required Customer SMS"            
        },
         vendorsms: {
            required: "Required Vendor SMS"            
        },*/
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
	      'getkeywords': {placement:'bottom',html:true},
		/*customersms: {placement:'bottom',html:true},
		vendorsms: {placement:'bottom',html:true},*/
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
		url: "<?php echo base_url(); ?>index.php/longcode_shared/DisplayNumbers",
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
 	
