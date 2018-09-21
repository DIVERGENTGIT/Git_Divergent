<!DOCTYPE html>
<html class="no-js" lang="en">
  

<head>
  
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
   
   <title> Login - Register | smsstriker.com </title>

<meta name="description" content=" SMS Striker is a leading provider of Bulk SMS, Digital Marketing, Web & Mobile Developing services across India at a very best affordable pricing. ">

<meta name="keywords" content=" Bulk SMS Price, best priced SMS, affordable SMS services, Customized SMS, best price SMS">

	
</head>
<style type="text/css">

    
    .breadcrumb > li {
    display: inline-block;
}
  
   
   
    
    .modal-dialog {
   
        left: 0% !important;}
		.form_error
		{
			color:#F25E3C;
		}
		label.error {
    color: red !important;
    font-size: 12px !important;
    font-weight: 100 !important;
}
	img#refresh-captcha {
    float: right;
    margin-right: 2px;
    margin-top: 4px;
}

.captcha_error {
	color:red;
}	
    </style>
<script type="text/javascript">

   //Created / Generates the captcha function    
    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var f = Math.ceil(Math.random() * 10)+ '';  
        var g = Math.ceil(Math.random() * 10)+ '';  
        var code = a + b +  c +  d +  e +  f +  g;
        document.getElementById("txtCaptcha").value = code
    }

    
 
    </script>
    
    <script language="javascript" type="text/javascript">  
function disableCopy()  
{  
alert("You cannot perform Copy");  
return false;  
}  
  
  
function disablePaste()  
{  
alert("You cannot perform Paste");  
return false;  
}  
  

  
function disableContextMenu()  
{  
alert("You cannot perform right click via mouse as well as keyboard");  
return false;  
}  
</script>
    
<body onload="DrawCaptcha();">
	
	<!-- Load page -->
	
	<!-- NAVBAR SECTION -->
	
	<!-- BANNER ROTATOR -->
	<div class="section subbanner col-sm-12">
		<div class="container">
			<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
					<div class="caption">
                        
					
						<ol class="breadcrumb">
						<li class="active">Home</li>
						  <li class="active">Register</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- ABOUT SECTION -->
	<!-- STATS SECTION FACTS --> 
		<div class="col-md-12 "  >
		<?php if(!empty($userExist)) { echo $userExist; } ?>
		<?php if(!empty($sucess)){ echo $sucess; } ?> 
		<?php echo form_open('register',
					array('id' => 'register_form1', 'name' => 'register_form', 'method' => 'post', 'class' =>'form-horizontal')
	); ?>
        <h2 class="col-sm-offset-3" style="font-size:20px; padding:15px 10px;">Account Details</h2>
       <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Username<span>*</span></label>
        <div class="col-md-4">
		
			<?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control acc_det_txtbox','placeholder' => 'Username','onkeypress'=>'return blockSpecialChar(event)')); ?>
	
        </div>
		<div class="form_error">
		<span id="username_error" style="display:none;color:green;">Username Available</span>
			<span id="username_error01" style="display:none;color:red;">Username not Available!  Please try Another Username</span><span id="username_error02" style="display:none;color:red;">username must be at least 5 characters long</span></div>
   </div>
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Password<span>*</span></label>
        <div class="col-md-4">
		<?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'value' => set_value('userpass'), 'class' => 'form-control','placeholder' => 'Password' ));?>
          
        </div>
		
    </div>
      <h2 class="col-sm-offset-3" style="font-size:20px; padding:15px 10px; padding-top:0px !important;">Contact Details</h2>
    <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Full name<span>*</span></label>
        <div class="col-xs-12 col-md-2">
		<?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name'), 'class' => 'form-control' ,'placeholder' => 'First name'));?>
        </div>
        <div class="col-xs-12 col-md-2 col-xs-4">
		<?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name'), 'class' => 'form-control' ,'placeholder' => 'Last name'));?>
            
        </div> 
    </div>
   <!-- <div class="form-group">
        <label class="col-xs-3 control-label">Username</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="username" />
        </div>
    </div>-->
    <div class="form-group">
        <label class="col-xs-5 col-md-3  control-label">Email address<span>*</span></label>
        <div class="col-md-4">
		<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email'), 'class' => 'form-control','placeholder' => 'Email address' ));?>
   </div>
    </div>
    <div class="form-group">
        <label class="col-xs-6 col-md-3 control-label">Mobile number<span>*</span></label>
        <div class="col-md-4 ">
		<?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile'), 'class' => 'form-control','placeholder' => 'Mobile number' ));?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-6 col-md-3 control-label">Organization Name<span>*</span></label>
        <div class="col-md-4 ">
        <?php echo form_input(array('name' => 'organization', 'id' => 'organization', 'maxlength' => 45, 'value' => set_value('organization'), 'class' => 'form-control','placeholder' => 'Organization Name' ));?>
        </div>
    </div>
        
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Address1<span>*</span></label>
        <div class="col-xs-12 col-md-4">
		<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1'), 'class' => 'form-control','placeholder' => 'Address1' ));?>
            
        </div>
        </div>
          <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Address2</label>
        <div class="col-xs-12 col-md-4 ">
		<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2'), 'class' => 'form-control' ,'placeholder' => 'Address2' ));?>
            
        </div>
        </div>
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">State<span>*</span></label>
        <div class="col-xs-12 col-md-4 selectContainer">
            <select name="state_id" id="state_id" onChange="get_city(this.value)" class="form-control" >
                <option value=""> --select--</option>
								<?php
                                print_r($statesAll);
								foreach($statesAll as $key): ?>
								<option value="<?php echo $key->state_id; ?>" ><?php echo $key->state; ?></option>
								<?php endforeach; ?>
							</select>
        </div>
        </div>
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">City<span>*</span></label>
        <div class="col-xs-12 col-md-4 selectContainer">
        <select name="city_id" id="city_id" class="form-control">
        </select>
        </div>
        </div>
         <div class="form-group">
        <label class="col-xs-5 col-md-3  control-label"> Pin Code<span>*</span></label>
        <div class="col-xs-12 col-md-4 ">
		<?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode'), 'class' => 'form-control','placeholder' => 'postalCode'));?>
        </div>
        </div>
   <!--<div class="form-group">
        <label class="col-xs-3 control-label">Password</label>
        <div class="col-md-4">
        <input type="password" class="form-control" name="password" />
        </div>
    </div>-->

	<div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Captcha<span>*</span></label>
		 <div class="col-xs-12 col-md-2" > 
		<input type="text" class="form-control" placeholder="Enter Code" name="captch" id="captch"  />
		<div class="error captcha_error"><?php 
	
		if(!empty($invalidCaptcha)){
			echo $invalidCaptcha;
		}

		?></div>
		
        </div>
        <div class="col-xs-12 col-md-2 ">
		 <input type="text" name="codetypecopy" id="txtCaptcha" style="background: url(<?php echo base_url(); ?>images_n/captcha.png);text-align:center; border:none; font-weight:bold; font-family:Modern; font-size:20px; font-size: 20px; width: 150px;" class="valid imgcaptcha" readonly oncopy="return false" onpaste="return false" oncontextmenu="return false">

   
		<a href="#" onclick="DrawCaptcha();"><img title="Refresh new Captcha Code!" id="refresh-captcha" src="<?php echo base_url(); ?>images_n/refresh_1.png" class="refresh"></a>
		</div>
           
		
        
		
    </div>
        <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
        <div class="checkbox">
                <label>
				<?php echo form_checkbox(array('name' => 'tnc', 'id' => 'tnc', 'value' => 1));?>
                     Agree with the terms and conditions<span>*</span>
                </label>
            </div>
        </div>
    </div>
   <!-- <div class="form-group">
        <label class="col-xs-3 control-label">Date of birth</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="birthday" placeholder="YYYY/MM/DD" />
        </div>
    </div>
-->
    <div class="form-group">
        <div class="col-xs-9 col-xs-offset-3">
		<?php echo form_submit(array('name' => 'register', 'id'=>'register', 'value' => 'Register', 'class'=>'btn btn-primary'));?>
            <!--<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Submit</button>-->
        </div>
    </div>
<?php echo form_close(); ?>
    </div>
	<!-- ABOUT SECTION -->
	<div class="clearfix"></div>
	<!-- FOOTER SECTION -->
	<!-- -Login Modal -->
	<!-- - Login Model Ends Here -->
	
	
	
    
       <script language="javascript" type="text/javascript">
function blockSpecialChar(e) {
    var keynum
    var keychar
    var numcheck
    // For Internet Explorer
    if (window.event) {
        keynum = e.keyCode;
    }
    // For Netscape/Firefox/Opera
    else if (e.which) {
        keynum = e.which;
    }
    keychar = String.fromCharCode(keynum);
    //List of special characters you want to restrict
    if (keychar == "'" || keychar == "`" || keychar =="!" || keychar =="@" || keychar =="#" || keychar =="$" || keychar =="%" || keychar =="^" || keychar =="&" || keychar =="*" || keychar =="(" || keychar ==")" || keychar =="-" || keychar =="_" || keychar =="+" || keychar =="=" || keychar =="/" || keychar =="~" || keychar =="<" || keychar ==">" || keychar =="," || keychar ==";" || keychar ==":" || keychar =="|" || keychar =="?" || keychar =="{" || keychar =="}" || keychar =="[" || keychar =="]" || keychar =="¬" || keychar =="£" || keychar =='"' || keychar =="\\" ||  e.which==32) {
        return false;
    } else {
        return true;
    }
}
</script>
    
    
	<script>
  function get_city(state_id)
	{
		
		var data ={state_id:state_id};
		$('#city_id').html("Please Wait.....");
		$.ajax({
			
			url: "<?php echo site_url(); ?>cities_ajaxreg",
			type: "POST",
			data: data,
			//data: {'passcode': '1'},
			cache: false,
			success: function (callback_data) 
			{
				$('#city_id').html(callback_data);
			}
		});
	}
	</script>
<script>					 
			$(document).ready(function () {
			jQuery.validator.addMethod("lettersonly", function(value, element) {
  			return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
			}, "Enter a valid name, Alphabets only"); 
            $('#register_form1').validate({ // initialize the plugin
                rules: {
                    userpass: {
                        required: true
                     },
					 username: {
                        required: true
                     },
					 first_name: {
                        required: true
                     },
					 last_name: {
                        required: true
                     },
					  organization: {
                        required: true
                     },
					  address1: {
                        required: true
                     },
					  Address2: {
                        required: true
                     },
					 state_id: {
                        required: true
                     },
					 city_id: {
                        required: true
                     },
					 pincode: {
                        required: true
                     },
                    email: {
                        required: true,
                        email: true
                    },
					mobile: {
                        required: true,
                        number: true,
						minlength:10,
                       maxlength:10
                    }
                },
				
    messages: {
        userpass: {
            required: "Please enter password"		
			},	
username: {
            required: "Please enter username"		
			},	
first_name: {
            required: "Please enter First name"		
			},
last_name: {
            required: "Please enter Last name"		
			},	
organization: {
            required: "Please enter organization name"		
			},
address1: {
            required: "Please enter address"		
			},
Address2: {
            required: "Please enter address"		
			},	
state_id: {
            required: "Please select state"		
			},
city_id: {
            required: "Please select city"		
			},		
pincode: {
            required: "Please enter pincode"		
			},			
email: {
            required: "Please enter Email",  
            email: "Please enter correct Email"			
			},
mobile: {
            required: "Please enter Mobile Number",
          number: "Please enter 10 Digit Mobile Number",
          minlength: "Please enter 10 Digit Mobile Number",
         maxlength: "Please enter 10 Digit Mobile Number"		  
			}			
    },
	
		tooltip_options: {
				userpass: {placement:'bottom',html:true},				
				email: {placement:'bottom',html:true},
				mobile: {placement:'bottom',html:true}
				}
               
            });
        
        });
        </script> 
	

	<script>
$(document).ready(function(){
	$('#username').blur(checkAvailability);
});

function checkAvailability(){
	var username = $('#username').val();	
	if(username == "" || username.length <= 5){		
      $('#username_error02').css('display', 'block');	
       		  
	}else{
		$.ajax({
			
			url: "<?php echo site_url(); ?>userchecker",
			type: "POST",
			cache: false,				
			data:'username=' + $("#username").val(),
			success: function(response){	
				try{
					if(response=='true'){
						$('#username_error').css('display', 'block');	
						$('#username_error01').css('display', 'none');
						$('#username_error02').css('display', 'none');
					}
					if(response!='true'){
						$('#username_error01').css('display', 'block');	
						$('#username_error').css('display', 'none');	
						  $('#username_error02').css('display','none');
					}										
				}catch(e) {		
					alert('Exception while request..');
				}		
			},
			error: function(){						
				alert('Error while request..');
			}
		 });
	}
}	
</script>

</body>
</html>
