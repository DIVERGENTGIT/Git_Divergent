<!DOCTYPE html>
<head>
 
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <title> Login - Register | smsstriker.com </title>

<meta name="description" content=" SMS Striker is a leading provider of Bulk SMS, Digital Marketing, Web & Mobile Developing services across India at a very best affordable pricing. ">

<meta name="keywords" content=" Bulk SMS Price, best priced SMS, affordable SMS services, Customized SMS, best price SMS">

<script type="text/javascript" src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>	  
    <style type="text/css">
    .logo_f {
    width: 213px;
    height: 36px;
    background-image: url("../images_n/apple-touch-icon.png");
    margin: 0px auto;
}

.login-block {
    width: 320px;
    padding: 0px 20px;
    background: #fff;
    border-radius: 5px;
    margin: 0 auto;
}
        
 input.button.login-block {
    padding-left: 20px !important;
} 
input#captch {
    padding-left: 18px !important;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('<?php echo base_url(); ?>images_n/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}
.login-block input#username1 {
    background: #fff url('<?php echo base_url(); ?>images_n/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}
.login-block input#username1:focus {
    background: #fff url('<?php echo base_url(); ?>images_n/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}


.login-block input#username:focus {
    background: #fff url('<?php echo base_url(); ?>images_n/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#userpass {
    background: #fff url('<?php echo base_url(); ?>images_n/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#userpass:focus {
    background: #fff url('<?php echo base_url(); ?>images_n/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #29ABE2;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #29ABE2;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #29ABE2;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #29ABE2;
} 
     .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
    
    
    background-color: #f5f5f5 !important;
}   
        
       /* forgot possword*/
        
        
.panel-default {

    border: none !important;
}
        
.panel-default > .panel-heading {
   
    background-color: transparent !important;
   
} 
        .panel-default > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: transparent !important;
}

   label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: 100 !important;
    color: red;
	font-size: 12px !important;
}
.captcha_error {
	color:red;
}
.error_box {
	color:red;
}


img#refresh-captcha {
    float: right;
      margin-right: -164px;
    margin-top: -54px;
}


    </style>
	<script type="text/javascript">

   //Created / Generates the captcha function    
    function DrawCaptcha()
    {
		
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 9)+ '';       
        var c = Math.ceil(Math.random() * 9)+ '';  
        var d = Math.ceil(Math.random() * 9)+ '';  
        var e = Math.ceil(Math.random() * 9)+ '';  
        var f = Math.ceil(Math.random() * 9)+ '';  
        var g = Math.ceil(Math.random() * 9)+ '';  
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


var captch = document.getElementById('captch');
captch.addEventListener('drop', drop, false);


function drop(evt) {
    evt.stopPropagation();
    evt.preventDefault(); 
    var imageUrl = evt.dataTransfer.getData('text/html');
    var url = $(imageUrl).attr('src');
    console.log(url);
}



</script>

</head>


<body onload="DrawCaptcha();">
<div class="col-sm-12 mar_top10">
<div class="login-block">
    <h1 style="margin-top: 14px;">Login</h1>
	<?php if(isset($invalid)): ?>
	<div class="error_box">
	 	<?php echo $invalid; ?>
	 </div>
<?php else: ?>
	 <div class="warning_box">
	 	<!--Login with User Name and Password-->
	 </div>	
<?php endif; ?>
	<?php echo form_open('login', array('id' => 'login_form', 'name' => 'login_form') ); ?>
	<?php echo form_input(array('name' => 'username', 'id' => 'username', 'maxlength' => 45,'value' => set_value('username'),'placeholder' => 'Username'));?>
     <div class="form_error"><?php echo form_error('username'); ?></div>
   
    <?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'maxlength' => 45, 'value' => set_value('userpass'),'placeholder' => 'Password'));?>
    <div class="form_error"><?php echo form_error('userpass'); ?></div>

<div class="col-xs-12 col-md-6 " style="
    padding: 0px !important;
">
		<input type="text" class="form-control" placeholder="Enter Code" name="captch" id="captch" ondrop="drop(event);" ondragover="return false"  />
		</div>
		
		
		
       
        <div class="col-xs-12 col-md-1 " >
		 <input type="text" name="codetypecopy" id="txtCaptcha" style="background: url(<?php echo base_url();?>images_n/captcha.png);text-align:center; border:none; font-weight:bold; font-family:Modern;  font-size: 20px; width: 125px; padding:0px !important; " class="valid imgcaptcha" readonly oncopy="return false" onpaste="return false" oncontextmenu="return false">

		<a href="#" onclick="DrawCaptcha();"><img title="Refresh new Captcha Code!" id="refresh-captcha" src="<?php echo base_url(); ?>images_n/refresh_1.png" class="refresh"></a>
		</div>
      
	  <div class="error captcha_error col-xs-12 col-md-12"><?php 
	
		if(!empty($invalidloginCaptcha)){
			echo $invalidloginCaptcha;
		}

		?></div> 

	
	<?php echo form_submit(array('name' => 'login','value' => 'Login', 'class' => 'button login-block', 'style' => 'background-color:#29ABE2;  text-align: center;color: #fff;'));?>
	<?php echo form_close(); ?>
</div>
        
    <div class="login-block"  style=" text-align:left; width: 340px;
    padding-top:0px !importat;
    background: #fff;
    border-radius: 0px !important;
    border-top:none !important;
    margin: 0 auto;">
      <div class="panel-group " id="accordion" style="margin-top:10px; ">
  <div class="panel panel-default">
    <div >
      
        <a class="accordion-toggle panel-heading" style="font-size:13px; cursor:pointer"  data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne"  >
         Forgot your password ?
        </a>
     <a class="accordion-toggle" href="<?php echo site_url('register'); ?>" style="font-size:13px ; text-align:right;">
         Create an account ?
        </a>
        
    </div>
	<?php if(isset($issued)): ?>
	<div class="valid_box">
        <?php echo $issued; ?>
    </div>
	<?php else: ?>
    <?php if(isset($not_exist)): ?>
        <div class="error_box">
            <?php echo $not_exist; ?>
        </div>
    <?php else: ?>
        
    <?php endif; ?>
<?php endif; ?>



    <div id="collapseOne" class="panel-collapse collapse ">
      <div class="panel-body">
          
		  <?php echo form_open('forgot',
                    array('id' => 'forgot_form', 'name' => 'forgot_form','method' => 'post')
    ); ?>
       
    <?php echo form_input(array('name' => 'username', 'id' => 'username1', 'placeholder' => 'Username', 'value' => set_value('username'))); ?>
                <div class="form_error">
				<!--<span id="username_error" style="display:none;color:green;">Username Available</span>-->
			<span id="username_error01" style="display:none;color:red;">Specified Username Not Exist</span><?php echo form_error('username'); ?></div>
   
	<?php echo form_submit(array('name' => 'forgot_password','value' => 'Submit','class' => 'button login-block', 'style' => 'background-color:#29ABE2;  text-align: center;color: #fff;'));?>
            <?php echo form_close(); ?>
      </div>
    </div>
  </div>
    
</div> 
     
       
  </div>  
  </div>  	
	<!-- login code end -->
	
	
	<div class="clearfix"></div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
	<script>
$(document).ready(function(){
	$('#username1').blur(checkAvailability);
});

function checkAvailability(){
	var username = $('#username1').val();	
	if(username == "" || username.length < 0){		
     	
       		 
	}else{
		$.ajax({
			
			url: "<?php echo site_url(); ?>userchecker_forget",
			type: "POST",
			cache: false,				
			data:'username=' + $("#username1").val(),
			success: function(response){	
				try{
					if(response=='true'){
							$('#username_error').css('display', 'block');	
						    $('#username_error01').css('display', 'none');
					}
					if(response!='true'){
						$('#username_error01').css('display', 'block');	
						$('#username_error').css('display', 'none');	
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
	
<script>

(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#login_form").validate({
                rules: {
                    username: "required",
                    userpass: "required"
                    captch:"required"
                   
                   
                },
                messages: {
                    username: "Please enter your Username",
                    userpass: "Please enter your Password",
                     captch: " Enter Captcha Code"
                   
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

	</script>
	<script>

(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#forgot_form").validate({
                rules: {
                    username: "required"
                   
                   
                   
                   
                },
                messages: {
                    username: "Please enter your Username"
                   
                    
                   
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

	</script>
	
	
	<!-- FOOTER SECTION -->
	
	
	<!-- -Login Modal -->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
	
 	<!-- - Login Model Ends Here -->
	
	<!-- Visitor Chat -->
<script type="text/javascript">
    function loadVC() {
      var vcjs = document.createElement('script'); vcjs.type = 'text/javascript'; 
      vcjs.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'smsstriker.com/chat/chat'; 
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(vcjs, s);
    };
    if (window.addEventListener) window.addEventListener('load', loadVC, false); 
    else if (window.attachEvent) window.attachEvent('onload', loadVC);
</script>
<!-- Visitor Chat -->
</body>


</html>
