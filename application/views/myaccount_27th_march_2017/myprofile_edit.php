<div class="col-md-9 col-sm-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images-new/welcome-icon.png" class="right-title-img">Edit Profile</h3>
</div>

<?php 
$user_id=$this->session->userdata('user_id');
 $sql="SELECT * FROM users u WHERE u.user_id = $user_id";
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

$username=$value->username;
$first_name=$value->first_name;
$last_name=$value->last_name;
$address1=$value->address1;
$address2=$value->address2;
}
?>

<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<form method="post" id="validation-signup" >
<div class="col-sm-12 col-md-9 col-xs-12 padding_zero reg-border">
<div class="col-sm-12 col-md-12 col-xs-12 account-details padding-zero">
Account Details
</div>
<div class="col-sm-12 col-md-12 col-xs-12 editproftop padding-lrt75">
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Username</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<!--  
<input type="text" name="username" id="" placeholder="User Name" value="<?php echo @$username ?>" readonly style="color: rgb(204, 204, 204);">
-->
<?php echo @$username ?>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">

<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>User Type</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<!--  
<input type="text" name="username" id="" placeholder="User Name" value="<?php echo @$usertype ?>" readonly style="color: rgb(204, 204, 204);">
-->
<?php echo @$usertype ?>
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 contact-details padding-zero">
Contact Details
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-lrt75">
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>First Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="first_name" id="first_name"  value="<?php echo @$first_name ?>" placeholder="First Name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Last Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="last_name" id="last_name"  value="<?php echo @$last_name ?>" placeholder="Last Name">
</div>

</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Email Address</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="email" value="<?php echo @$email ?>" id="emailid" placeholder="Email address">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Mobile Number</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="mobile" id="mobileno"  maxlength="10"  value="<?php echo  @$mobile ?>" placeholder="Mobile number">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Organization Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12  padding-ltzero padding-mzero">
<input type="text" name="organization" id="organization"  value="<?php echo @$organization ?>" placeholder="Organization name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Address 1</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="address1" id="address1" placeholder="Address 1" value="<?php echo @$address1 ?>">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Address 2</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="address2" id="address2" placeholder="Address 2" value="<?php echo @$address2 ?>">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>State</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">

<select name="state" id="getstate_id" class="getstate_id">
<option value="">Select State</option>	
</select>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>City</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<select name="city" id="getcity_id" class="getcity_id" ><option value="">Select City</option></select>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Zip Code</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="pincode" maxlength="9" id="pincode" value="<?php echo @$zipcode ?>" placeholder="Pin Code">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-8 col-md-8 col-sm-offset-4 col-md-offset-4 col-xs-12 padding-ltzero padding-mzero">
<input type="submit" name="edituser" class="submit_btn" value="Submit">
</div>
</div>
</div>
</div>
</form>

</div>
    </div>


</div>
</div>
</div>


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


<script type="text/javascript" >
$( document ).ready(function( $ ) {
		 $("#validation-signup").validate({
			 rules:  {
					
					first_name: {
					required: true,
					minlength:5,
					maxlength:25,
					regexpcol: true
					},
					last_name: {
					required: true,
					minlength:5,
					maxlength:25
					
					},
					mobile: {
					required: true,
					minlength:10,
					maxlength:10,
					number: true			
					},
					email: {
					required: true,
					maxlength:50,
					email:true

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
				
					first_name: {placement:'bottom',html:true},
					last_name: {placement:'bottom',html:true},
					email: {placement:'bottom',html:true},
					mobile: {placement:'bottom',html:true},
					organization: {placement:'bottom',html:true},
					address1: {placement:'bottom',html:true},
					address2: {placement:'bottom',html:true},
					state: {placement:'bottom',html:true},
					city: {placement:'bottom',html:true},
					pincode: {placement:'bottom',html:true}
					
				}
		    })
});
</script>
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


   
  </body>
 
</html>
