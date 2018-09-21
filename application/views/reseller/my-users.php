
<link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo  base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo  base_url(); ?>js/jquery.validate.min.js"></script>
<script src="<?php echo  base_url(); ?>js/additional-methods.min.js"></script>
<script src="<?php echo  base_url(); ?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>

 <script>
 $(document).ready(function(){
  $(function() {
    $(":file").filestyle({input: false});
  });
});
 </script>


    <div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<!-- Main content -->
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/manage-icon.png" class="right-title-img">Users</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<?php if($this->session->flashdata('error_message')){?> 
<span class="" style="color:red">  <?php echo $this->session->flashdata('error_message')?> 
</span> 
<?php } ?>

<?php if($this->session->flashdata('success_message')){?> 
<span class="" style="color:green">  <?php echo $this->session->flashdata('success_message')?> 
</span> 
<?php } ?>

<a href="#addusermodel" data-toggle="modal" data-target="#addusermodel" class="submit_btn pull-right">Add User</a>
</div>


 <section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 
	

				<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
				<div class="table-responsive">
				
                  <table id="example1" class="table_all table">
                    <thead>
                      <tr>
                        <th>S No</th>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Registered On</th>
                        <th>Last Login</th>
                        <th>Available SMS Credits</th>
				<th colspan="3">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
							$countu=0;
							$sno=1;
							if($this->uri->segment(3)!='')
							{
							$sno=$this->uri->segment(3)+1;
							}
							 if(!empty($rownum)){
								 $countu=$countu+$rownum; 
							}
							foreach($users as $user) :		 
							$countu++;
						?>
                      <tr>
			<td><?php echo $sno;?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->registered_on; ?></td>
                        <td><?php if($user->login_time) { echo $user->login_time; } else { echo "---"; } ?></td>
                        <td><?php echo $user->available_credits; ?></td>
                        <td><a data-href="<?php echo base_url(); ?>reseller/myUsers/usersbalance/puid/<?php echo $user->user_id; ?>";  class="T-Color btn btn-default btn-sm" style="text-decoration:none;"  data-toggle="modal" data-target="#Creat-user-Modal<?php echo $user->user_id;?>"> Add SMS Credits</a>
                        
                         <div id="Creat-user-Modal<?php echo $user->user_id;?>" class="modal fade" tabindex="-1" role="dialog">         

        <div class="modal-dialog modal-md">
        
            <div class="modal-content col-md-12 col-sm-12 col-xs-12">           
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">User Payments</h4>
                </div>
                <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
<form class="form-horizontal add_sms_form<?php echo $countu;?>" method="POST" action="<?php echo base_url()?>reseller/myUsers/<?php echo $offset;?>" name="add_sms_form">

        <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		 <div class="col-sm-3 col-md-3 col-xs-12 padding_zero">
            <label class="form_lable">No. Of SMS :</label>
			</div>
            <div class="col-sm-7 col-md-7 padding_mzero col-xs-12">
                <input type="text" class="form-control" id="no_of_sms" placeholder="No. Of SMS" name="no_of_sms">
            </div>
        </div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-sm-3 col-md-3 col-xs-12 padding_zero">
            <label class="form_lable">Price :</label>
			</div>
           <div class="col-sm-7 col-md-7 padding_mzero col-xs-12">
                <input type="text" class="form-control" id="price" name="price"  placeholder="Price"/>
            </div>
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-7 col-xs-12 col-sm-offset-3 padding_mzero col-md-offset-3">
            <input type="hidden" class="form-control" id="resellers_user_id" name="resellers_user_id" value="<?php echo $user->user_id;?>" />
<input type="submit"  name="add_balance" class="submit_btn" value="Add SMS Credits"/>
        </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="table-responsive">
<table class="table_all">
<thead>
<tr><th>S.No</th><th>Date</th><th>No. of SMS</th><th>Price/SMS</th><th>Total Amount</th></tr>
</thead>
 
<tbody>
 <?php
	//echo $user->user_id;
	// $total_payments = $this->reseller_model->get_user_payments_count($user->user_id, $mainusersid);

	//$off_set = $this->uri->segment(4);
	$off_set=0;
	$limit = 1000;
	//$payment_type=2;

	$payment_type=1; // Changed on 2017-06-2 by saisandeepthi
	$payments_data = $this->reseller_model->get_user_payments($user->user_id, $mainusersid, $payment_type, $off_set, $limit);

	$count=0;
	foreach($payments_data as $payment) :	
	$count=$count+1;	 
	?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo $payment->on_date; ?></td>
<td><?php echo $payment->no_of_sms; ?></td>
<td><?php echo $payment->price; ?></td>
<td><?php echo $payment->total_amount; ?></td>
</tr>
<?php 
	endforeach;
	?>
</tbody>

</table>
</div>
</div>
</form>


</div> 
               
              
            </div>
             
        </div>
       
   
        </div>
                        </td>
						
						<td><a data-href="<?php echo base_url(); ?>reseller/myUsers/usersbalance/puid/<?php echo $user->user_id; ?>";  class="T-Color btn btn-default btn-sm" style="text-decoration:none;"  data-toggle="modal" data-target="#Deduct-bal-Modal<?php echo $user->user_id;?>">Deduct SMS Credits</a>
						
						<!-- deduct balance model-->
	<div id="Deduct-bal-Modal<?php echo $user->user_id;?>" class="modal fade" tabindex="-1" role="dialog">         

        <div class="modal-dialog modal-md">
        
            <div class="modal-content col-md-12 col-sm-12 col-xs-12">           
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">User Deduct SMS Credits</h4>
                </div>
                <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
		<form class="form-horizontal deduct_sms_form<?php echo $countu;?>" method="POST" action="<?php echo base_url()?>reseller/myUsers/<?php echo $offset;?>" name="deduct_sms_form">

        <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		 <div class="col-md-3 col-sm-3 col-xs-12">  
            <label class="form_lable">No. Of SMS :</label>
			</div>
           <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" class="form-control" id="no_of_sms" placeholder="No. Of SMS" name="no_of_sms">
            </div>
        </div>
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
  <div class="col-md-3 col-sm-3 col-xs-12">
            <label class="form_lable">Price :</label>
			</div>
        <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" class="form-control" id="price" name="price"  placeholder="Price"/>
            </div>
        </div>
		 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
            <div class="col-md-7 col-sm-7 col-xs-12 col-sm-offset-3 col-md-offset-3">
            <input type="hidden" class="form-control" id="resellers_user_id" name="resellers_user_id" value="<?php echo $user->user_id;?>" />
<input type="submit"  name="deduct_balance" class="submit_btn" value="Deduct SMS Credits"/>
</div>
                       
                </div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="table-responsive">
<table class="table_all">
<thead>
<tr><th>S.No</th><th>Date</th><th>No. of SMS</th><th>Price/SMS</th><th>Total Amount</th></tr>
</thead>
 
<tbody>
<?php
	//$total_payments = $this->reseller_model->get_user_payments_count($user->user_id, $mainusersid);
	/*
	$off_set = $this->uri->segment(4);
	$limit = 1000;
	$payments_data = $this->reseller_model->get_user_payments($user->user_id, $mainusersid, $off_set, $limit);
	*/
	//$off_set = $this->uri->segment(4);
	$off_set=0;
	$limit = 1000;
	$payment_type=3; 
 
	$payments_data = $this->reseller_model->get_user_payments($user->user_id, $mainusersid, $payment_type, $off_set, $limit);
  
	$count=0;
	foreach($payments_data as $payment) :	
	$count=$count+1;	 
	?>  
<tr>
<td><?php echo $count; ?></td>
<td><?php echo $payment->on_date; ?></td>
<td><?php echo $payment->no_of_sms; ?></td>
<td><?php echo $payment->price; ?></td>
<td><?php echo $payment->total_amount; ?></td>
</tr>
<?php 
	endforeach;
	?>
</tbody>

</table>
</div>
</div>
</form> 
</div> 
               
</div>
             
        </div>
       
   
        </div>
	<!-- Deduct balance ending -->	
						
						</td>
                                 
                        <td> 
			<a data-href="<?php echo base_url(); ?>reseller/myUsers/usereditails/<?php echo $user->user_id; ?>";  class="T-Color btn btn-default btn-sm" style="text-decoration:none;"  data-toggle="modal" data-target="#edit-user-Modal<?php echo $user->user_id;?>"> Edit</a>
 
 
 
 
 
    
			
	<div id="edit-user-Modal<?php echo $user->user_id;?>" class="modal fade editpro-modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content col-sm-12 col-md-12 col-xs-12 padding_zero">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  
                </div>
                <div class="modal-body col-sm-12 col-md-12 col-xs-12 padding_zero">
  <!--                  
  <?php echo form_open('reseller/myUsers',array('id' => 'edit_profile_form','class' => 'edit_profile_form', 'name' => 'edit_profile_form', 'method' => 'post')); ?>
  --->
  <form method="post" action="<?php echo base_url();?>reseller/myUsers/<?php echo $offset;?>" id="edit_profile_form" class="edit_profile_form<?php echo $countu?>" 
  name="edit_profile_form">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero reg-border01">

<div class="col-sm-12 col-md-12 col-xs-12 contact-details padding_zero">
Enter Profile Information
</div>
<div class="col-sm-12 col-md-12 col-xs-12">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">First name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name') ? set_value('first_name') : (isset($user->first_name) ? $user->first_name  : ""), 'class' => 'form-control' ));?>
<div class="form_error"><?php echo form_error('first_name'); ?>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Last name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name') ? set_value('last_name') : (isset($user->last_name) ? $user->last_name : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('last_name'); ?></div>
</div>

</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Adress</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1') ? set_value('address1') : (isset($user->address1) ? $user->address1:""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address1'); ?></div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Address 2</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2') ? set_value('address2') : (isset($user->address2) ? $user->address2:""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address2'); ?></div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Landline</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'mobileno_org', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobileno_org') ? set_value('mobileno_org') : (isset($user->mobileno_org) ? $user->mobileno_org : ""), 'class' => 'form-control' ));?>
      	<div class="form_error"><?php echo form_error('mobileno_org'); ?></div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Phone No</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12  padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 12, 'value' => set_value('mobile') ? set_value('mobile') : (isset($user->mobile) ? $user->mobile : ""), 'class' => 'form-control' ));?>
      <div class="form_error"><?php echo form_error('mobile'); ?></div>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">OTP MobileNo</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12  padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'otpmobile', 'id' => 'otpmobile',  'value' => set_value('otpmobile') ? set_value('otpmobile') : (isset($user->otpMobileNo) ? $user->otpMobileNo : ""), 'class' => 'form-control' ));?>

      <div class="form_error"><?php echo form_error('otpmobile'); ?></div>
</div>
</div>  


<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Email</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email') ? set_value('email') : (isset($user->email) ? $user->email : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('email'); ?></div>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Organization</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'organization', 'id' => 'organization', 'maxlength' => 45, 'value' => set_value('organization') ? set_value('organization') : (isset($user->organization) ? $user->organization : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('organization'); ?></div>
</div>
</div>

<?php
//echo $sql="select city_id,city_name from new_citylist";

$cities=$this->db->query("select city_id,city_name from new_citylist")->result();

$states=$this->db->query("select state_id,state from new_statelist")->result();
?>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">State</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<select name="city_id" class="state_id">
         <option  value=""> --select--</option>
         
<?php
// while($row=mysql_fetch_array($query)){
foreach($states as $key=>$state)
{ 
?>
<option value="<?php echo $state->state_id; ?>" <?php if($user->state_id==$state->state_id){echo "selected";} ?>><?php echo $state->state; ?></option>
<?php } ?>
								
							</select>
                            	<div class="form_error"><?php echo form_error('state_id'); ?></div> 
</div>
</div>


<?php
//echo $sql="select city_id,city_name from new_citylist";

$cities=$this->db->query("select city_id,city_name from new_citylist")->result();

//print_r($cities);

//echo $user->city_id;		 
//$query= mysql_query('select city_id,city_name from new_citylist');



?>
		
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">City</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<select name="city_id" class="city_id">
         <option  value=""> --select--</option>
         
<?php
// while($row=mysql_fetch_array($query)){
foreach($cities as $key=>$cityval)
{ 
?>
<option value="<?php echo $cityval->city_id; ?>" <?php if($user->city_id==$cityval->city_id){echo "selected";} ?>><?php echo $cityval->city_name; ?></option>
<?php } ?>
								
							</select>
                            	<div class="form_error"><?php echo form_error('city_id'); ?></div> 
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label class="form_lable">Zip Code</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode') ? set_value('pincode') : (isset($user->zipcode) ? $user->zipcode : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('pincode'); ?></div>
</div>
</div>




<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-8 col-md-8 col-sm-offset-4 col-md-offset-4 col-xs-12 padding_rtzero padding_mzero">
<?php echo form_submit(array('name' => 'save_details','value' => 'Save', 'class' => 'submit_btn'));?>
<input type="hidden" name="userid" value="<?php echo $user->user_id; ?>" />

</div>
</div>
</div>
</div>
   </form>          
 <?php //echo form_close(); ?>
            </div> 
			
 <script type="text/javascript" >
$( document ).ready(function( $ ) {
	
	var baseurl="<?php echo  base_url(); ?>";

	$.validator.addMethod("alphanumericspace", function(value, element) {
	        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
	    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
		
	$.validator.addMethod("regexpcol", function(value, element, param) { 
	  return this.optional(element) || !(/['"]/).test(value); 
	},'Single quotes and double quotes not allowed');

	jQuery.validator.addMethod("myEmail", function(value, element) {
	    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
	}, 'Please enter valid email address.'); 


	 $(".edit_profile_form<?php echo $countu?>").validate({
		 rules:  {
				first_name: {
				required: true,
				minlength:5,
				maxlength:25,
				alphanumeric: true,
				regexpcol: true
				},
				last_name: {
				required: true,
				minlength:5,
				maxlength:25,
				alphanumeric: true
				
				},
				mobile: {
				required: true,
				minlength:10,
				maxlength:10,
				number: true			
				},
				otpmobile: {
				required: true 		
				},
				email: {
				required: true,
				maxlength:50,
				myEmail:true

				},
				organization: {
				required: true,
				regexpcol: true
				},
				address1: {
				required: true,
				regexpcol: true
				},
				city: {
				required: true,
				},
				pincode: {
				required: true,
				number: true
				}
				
			},
			messages: 
			{
				
				first_name: {
				required: "Please Enter First Name",
				minlength: "username must be at least 5 characters long"

				},
				last_name: {
				required: "Please Enter Last Name",
				minlength: "username must be at least 5 characters long"

				}, 
				mobile: {
				required: "Please Enter Mobile Number",
				minlength: "Please Enter 10 Digit Mobile Number", 
				maxlength: "Please Enter 10 Digit Mobile Number",

				number: "Please Enter Numbers Only"				
				},
				otpmobile: {  
				required: "Please Enter OTP Mobile Number" 			
				},
				email: {
				required: "Please Enter Email",
				email: "Please Enter Valid Email" 				
				},
				organization: {
				required: "Please Enter Organization Name"
				},
				address1: {
				required: "Please Enter Address1"
				},
				city: {
				required: "Please Select City"
				},
				pincode: {
				required: "Please Enter Pin Code"
				}
				
				
					
			}
			,
			tooltip_options: 
			{
				
				first_name: {placement:'bottom',html:true},
				last_name: {placement:'bottom',html:true},
				email: {placement:'bottom',html:true},
				mobile: {placement:'bottom',html:true},
				otpmobile: {placement:'bottom',html:true},
				organization: {placement:'bottom',html:true},
				address1: {placement:'bottom',html:true},
				city: {placement:'bottom',html:true},
				pincode: {placement:'bottom',html:true}
			}
	    })
	    
/// add sms credits validation

	    $(".add_sms_form<?php echo $countu?>").validate({

	        rules: {
	    	no_of_sms: {
	    			number: true,
	    			required: true 
	    		},
	    		price: {
					required: true 
				}
	        },
	        messages: {
	        	no_of_sms: {
	                required: "Please Enter No of SMS"            
	            },
	            price: {
                required: "Please Enter SMS Price"            
            }
	        },
	    	tooltip_options: {
	        	no_of_sms: {placement:'bottom',html:true},
	            price: {placement:'bottom',html:true}
	    		}
	    }); 

	/// add sms credits validation

	    $(".deduct_sms_form<?php echo $countu?>").validate({

	        rules: {
	    	no_of_sms: {
	    			number: true,
	    			required: true 
	    		},
	    		price: {
					required: true 
				}
	        },
	        messages: {
	        	no_of_sms: {
	                required: "Please Enter No of SMS"            
	            },
	            price: {
             required: "Please Enter SMS Price"            
         }
	        },
	    	tooltip_options: {
	        	no_of_sms: {placement:'bottom',html:true},
	            price: {placement:'bottom',html:true}
	    		}
	    }); 


});       
		
	 </script>			
                 
            </div>
        </div>
    </div>                    
    </div>                       
		
      
	
        </td>                                               
            </tr>

	
    
        <?php
					 
	$count++;
	$sno++; 
	endforeach;
	?>
                    </tbody>
                  
                  </table>
				  </div>
				  
					
					
				  </div>
				  <div class="col-md-12 col-sm-12 col-xs-12 pagination_div padding_zero">
					<?php echo $this->pagination->create_links(); 
					?>
					</div>
				  <style>
				  
				  </style>
				  
				
                  <!--
                   <table id="example1_1" class="table table-bordered table-striped">
                    <thead>
                    <?php 
	$count=1;
	foreach($payments as $payment) :		 
	?>
                      <tr>
                        <th class="sendee-color">Sc No</th>
                        <th class="sendee-color">On Date</th>
                        <th class="sendee-color">No. of SMS</th>
                        <th class="sendee-color">Price/SMS</th>
                        <th class="sendee-color">Total Amount</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $payment->on_date; ?></td>
		<td><?php echo $payment->no_of_sms; ?></td>
		<td><?php echo $payment->price; ?></td>
		<td><?php echo $payment->total_amount; ?></td>				 	
	</tr><?php 
	$count++; 
	endforeach;
	?>
                    </tbody>
                   
                  </table> -->
</section>

</div>

    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>

     <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    

<!-- SMS Model Start -->
  <div class="modal fade" id="addusermodel" role="dialog">
   <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">
	  <div class="modal-header">
<button type="button" class="close close-position" data-dismiss="modal">&times;</button>
</div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
		
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero reg-border01">

<div class="col-sm-12 col-md-12 col-xs-12 contact-details padding-zero">
User Details
</div>
<form class="validation-signup" method="post" action="<?php echo base_url();?>reseller/myUsers/<?php echo $offset;?>">
<div class="col-sm-12 col-md-12 col-xs-12 padding-lrt75">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>User Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="text" name="username" id="username" maxlength="20" minlength="5" placeholder="User Name">
<span class="usernamemsg"></span>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Password</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="password" id="userpassword" name="userpassword" maxlength="20" minlength="5" placeholder="Password">
</div>

</div>
<!--  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Confirm Password</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_ltzero padding_mzero">
<input type="Password" name="cnfpassword" id="cnfpassword" placeholder="Confirm Password">
</div>
</div>
-->
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>First Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="text" name="firstname" id="firstname" placeholder="First Name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Last Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="text" name="lastname" id="lastname" placeholder="Last Name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Email</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="text" name="email"  id="emailid" maxlength="50" minlength="4" placeholder="Email address">
</div>
</div>  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Mobile Number</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">

<input type="text" name="mobile"  id="mobileno" maxlength="10" minlength="10" placeholder="Mobile number">
<span class="mobilenomsg"></span>

</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>OTP Mobile Number</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">

<input type="text" name="Otpmobileno"  id="Otpmobileno"  placeholder="OTP Mobile number">
<span class="mobilenoOTPmsg"></span>

</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Organization Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12  padding_rtzero padding_mzero">
<input type="text" name="organization" id="organization" maxlength="50" minlength="4" placeholder="Organization name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Address</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="text" name="address1" id="address1" placeholder="Address 1">
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>State</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">

<select name="state" id="state_id">
<option value="">Select State</option>
</select>


</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>City</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<select name="city" id="city_id" class="city_id" ><option value="">Select City</option></select>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Zip Code</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<input type="text" name="pincode" maxlength="9" id="pincode" placeholder="Pin Code">
</div>
</div>
<!--
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
<label>Status</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding_rtzero padding_mzero">
<select><option>Active</option><option>In Active</option></select>
</div>
</div>
--->
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-8 col-md-8 col-sm-offset-4 col-md-offset-4 col-xs-12 padding_rtzero padding_mzero">
<input type="submit" name="Registration" class="submit_btn" value="Registration">
</div>
</div>
</div>
</form>
</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Model End -->

<script type="text/javascript" >
$( document ).ready(function( $ ) {
	
	var baseurl="<?php echo  base_url(); ?>";

	$.validator.addMethod("alphanumericspace", function(value, element) {
	        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
	    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
		
	$.validator.addMethod("regexpcol", function(value, element, param) { 
	  return this.optional(element) || !(/['"]/).test(value); 
	},'Single quotes and double quotes not allowed');

	jQuery.validator.addMethod("myEmail", function(value, element) {
	    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
	}, 'Please enter valid email address.'); 



		 $(".validation-signup").validate({
			 rules:  {
					username: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumeric: true,
					regexpcol: true
					},
					firstname: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumeric: true,
					regexpcol: true
					},
					lastname: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumeric: true
					
					},
					mobile: {
					required: true,
					minlength:10,
					maxlength:10,
					number: true			
					},
					Otpmobileno: {
					required: true 		
					},
					userpassword: {
					required: true,
					minlength:5,
					maxlength:10,
					
					regexpcol: true

					},
					email: {
					required: true,
					maxlength:50,
					myEmail:true

					},
					organization: {
					required: true,
					regexpcol: true
					},
					address1: {
					required: true,
					regexpcol: true
					},
					address2: {
					required: true,
					regexpcol: true
					},
					state: {
					required: true,
					},
					city: {
					required: true,
					},
					pincode: {
					required: true,
					number: true
					}
					
				},
				messages: 
				{
					username: {
					required: "Please Enter UserName",
					minlength: "username must be at least 5 characters long"

					},
					firstname: {
					required: "Please Enter First Name",
					minlength: "username must be at least 5 characters long"

					},
					lastname: {
					required: "Please Enter Last Name",
					minlength: "username must be at least 5 characters long"

					},
					mobile: {
					required: "Please Enter Mobile Number",
					minlength: "Please Enter 10 Digit Mobile Number", 
					maxlength: "Please Enter 10 Digit Mobile Number",

					number: "Please Enter Numbers Only"				
					},Otpmobileno: {
					required: "Please Enter OTP Mobile Number" 			
					},
					userpassword: {
					required: "Please Enter Password",
					minlength: "Password must be at least 5 characters long", 
					maxlength: "Password must be 10 characters only"	
					},
					
					email: {
					required: "Please Enter Email",
					email: "Please Enter Valid Email" 				
					},
					organization: {
					required: "Please Enter Organization Name"
					},
					address1: {
					required: "Please Enter Address1"
					},
					address2: {
					required: "Please Enter Address2"
					},
					state: {
					required: "Please Select State"
					},
					city: {
					required: "Please Select City"
					},
					pincode: {
					required: "Please Enter Pin Code"
					}
					 
					
						
				}
				,
				tooltip_options: 
				{
					username: {placement:'bottom',html:true},
					firstname: {placement:'bottom',html:true},
					lastname: {placement:'bottom',html:true},
					email: {placement:'bottom',html:true},
					userpassword: {placement:'bottom',html:true},
					mobile: {placement:'bottom',html:true},
					Otpmobileno: {placement:'bottom',html:true},
					organization: {placement:'bottom',html:true},
					address1: {placement:'bottom',html:true},
					address2: {placement:'bottom',html:true},
					state: {placement:'bottom',html:true},
					city: {placement:'bottom',html:true},
					pincode: {placement:'bottom',html:true}
					
				}
		    });

		// get all state names	
			$.ajax({
				type:"GET",
				url:baseurl+"registration.php",
				data:{getstate:"all"},
				dataType:"html",
				success:function(response)
				{
					console.log(response);
					
					$("#state_id").html(response);
				},
				error:function(error)
				{
					//alert(error);
					console.log(error);
				}
					
			});
			
			
			
	var urlstr=baseurl+"registration.php";
			// get all cities names
 
			
			$("#state_id").on("change",function(){
				var state_id=$("#state_id").val();
 
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{getcity:"all",state_id:state_id},
					dataType:"html",
					success:function(response)
					{
						console.log(response);
						
						$(".city_id").html(response);
					},  
					error:function(error)
					{
						console.log(response);
						console.log(error);
					}
						
				});
				
			});
			
			$(".state_id").on("change",function(){
				var state_id=$(".state_id").val();
						console.log($(".state_id").val());
				$.ajax({  
					type:"GET",
					url:urlstr,  
					data:{getcity:"all",state_id:state_id},
					dataType:"html",
					success:function(response)
					{
						console.log(response);
						
						$(".city_id").html(response);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
						
				});
				
			});

			// user name validation
			$("#username").on("blur",function(){
				var username=$("#username").val();
				if(username.length > 5)
				{
				$(".usernamemsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalidation:"unvalidation",username:username},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".usernamemsg").html(response.message);
						$(".usernamemsg").css('color',response.color);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});

				}
				else
				{
				$(".usernamemsg").hide();
				}
				
			});

			// user Mobile no validation
			$("#mobileno").on("blur",function(){
				var mobileno=$("#mobileno").val();
				if(mobileno.length=='10')
				{
				$(".mobilenomsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{mbnovalidation:"mbnovalidation",mobileno:mobileno},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".mobilenomsg").html(response.message);
						$(".mobilenomsg").css('color',response.color);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});

				}
				else
				{
				$(".mobilenomsg").hide();
				}
				
			});
			
			
			//mobile no validation
			$("#mobileno").keydown(function (e) {
			       // Allow: backspace, delete, tab, escape, enter and .
			       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			            // Allow: Ctrl+A, Command+A
			           (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
			            // Allow: home, end, left, right, down, up
			           (e.keyCode >= 35 && e.keyCode <= 40)) {
			                // let it happen, don't do anything
			                return;
			       }
			       // Ensure that it is a number and stop the keypress
			       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			           e.preventDefault();
			       }
			   });

});

</script>
     
  </body>
</html>
