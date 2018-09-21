<style type="text/css">
.top_login{ position:absolute; z-index:1000;
       top: 200px !important;
	   position:fixed; 
	   left: 0px !important;
	   
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
</script>
<body onload="DrawCaptcha();">
        
	<!-- BANNER -->
	<div class="section subbanner col-sm-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-md-6 padding_ltzero">
				<h2 class="lead col_or">ENTERPRISE MESSAGING</h2>
				</div>

					<div class="caption">
					<!-- <h3>SMS SERVICES</h3> -->
						<ol class="breadcrumb">
<li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
<li class="active">Enterprise Messaging</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		
	</div>
<!-- ABOUT SECTION -->
	<div id="services" class="section services">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
				<div class="col-sm-8 padding_ltzero">
					<div class="page-title">
<div class="col-sm-12 padding_zero txt_aln">
<p>Utilize text messaging to effectively communicate with your customers</p>
<p>With 90 percent of text messages being read within minutes of delivery, according to Mobile Squared, text messages (SMS or MMS), are considered to be one of the world’s most popular and practical forms of mobile technology to reach your customers.</p>
<div class="col-sm-12 col-md-12 padding_zero">
				<div class="col-sm-12 padding_zero col-md-12 besniss_benfit01">
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('bulk-sms'); ?>">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/bulk-sms.png" alt="logo" >
                </div>
				<h5>Bulk SMS</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('sms-api'); ?>">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/2-way-sms.png" alt="logo" >
</div>				
				<h5>SMS API's</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('long-code-sms'); ?>">
				<div class="bussiness_icons">
	<img src="<?php echo  base_url(); ?>images_n/long-code.png" alt="logo" >
				</div>
				<h5>LONG CODE SMS</h5>
				</a>
				</div>
				
				</div>
			
				</div>

			</div>
					</div>
					</div>
					<div class="col-sm-4 reg_page01">
					<div class="col-sm-12 reg_pageheader">
						<script>					 
			$(document).ready(function () {
			jQuery.validator.addMethod("lettersonly", function(value, element) {
  			return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
			}, "Enter a valid name, Alphabets only"); 
            $('#enquire_form1').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
						lettersonly: true
                       
                    },
                    email: {
                        required: true,
                        email: true
                    },
					phone_no: {
                        required: true,
                        number: true,
						minlength:10,
                       maxlength:10
                    }
                },
				
    messages: {
        name: {
            required: "Please Enter Name", 
            lettersonly: "Please Enter letters"			
			},		
		email: {
            required: "Please Enter Email",  
            email: "Please Enter correct Email"			
			},
        phone_no: {
            required: "Please Enter Mobile Number",
          number: "Please Enter 10 Digit Mobile Number",
          minlength: "Please Enter 10 Digit Mobile Number",
         maxlength: "Please Enter 10 Digit Mobile Number"		  
			}			
    },
	
		tooltip_options: {
				name: {placement:'bottom',html:true},				
				email: {placement:'bottom',html:true},
				phone_no: {placement:'bottom',html:true}
				}
               
            });
        
        });
        </script> 
			<h4>Looking for exploring your</h4>
			<h4>business with Striker!</h4>
     </div>
			<form role="form" name="enquire_form" id="enquire_form1" action="enquire_form" method="post">
			<div class="col-sm-12 reg_pagebody">
			<input type="text" name="name" placeholder="Full Name">
			<input type="text" name="email" placeholder="Enter Your Email">
			<input type="text" name="phone_no" id="phone_no" placeholder="Phone Number">
			<div class="col-xs-12 padding_zero">
			<div class="col-xs-6 padding_zero">
			<input type="text" class="form-control" placeholder="Enter Code" name="captch" id="captch"  />
			</div>
			<div class="col-xs-6 padding_zero">
		 <input type="text" name="codetypecopy" id="txtCaptcha" style="background: url(<?php echo base_url();?>images_n/captcha.png);text-align:center; border:none; font-weight:bold; font-family:Modern;  font-size: 20px; width: 125px; padding:0px !important; " class="valid imgcaptcha" readonly oncopy="return false" onpaste="return false" oncontextmenu="return false">

		<a href="#" onclick="DrawCaptcha();"><img title="Refresh new Captcha Code!" id="refresh-captcha" src="<?php echo base_url(); ?>images_n/refresh_1.png" class="refresh"></a>
		 
		</div>
		</div>
			<h5>We will never Spam You,or sell Your email to third parties. All fields are required</h5>
			<div class="col-sm-12">
			<input type="submit" name="enqui_form" value="submit"></div>
			<div class="col-sm-12 talk_sales02 padding_zero"><a href="#" class="talk_sales">TALK TO SALES CALL : 040 - 6454 7711</a></div>
			</div>
		</form>
			</div>
				</div>
			</div>
			
			<div class="row">
			
				<!--<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php //echo base_url(); ?>images_n/sms2_1.png" alt="sms" class="img-responsive" />
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">BULK SMS</h4>
							
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> Feature-rich, highly-accessible and fully-redundant, cloud-based service.</li>
								<li><i class="fa fa-check-circle"></i> Designed to enable businesses send alerts, updates and marketing messages and 2-way communication, to wireless devices.</li>
								<li><i class="fa fa-check-circle"></i> Leverages cutting-edge, cloud-based product & service architecture with scalable solutions to optimize operating costs.</li>
								<li><i class="fa fa-check-circle"></i> Provides a robust roadmap for the evolving needs of next-gen messaging technologies.</li>
								
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>-->
				
         			
			</div>
			
		</div>
	</div>
	
	
	<!-- FOOTER SECTION -->
		
	
 <!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
 	




<script type="text/javascript">
$(document).ready(function() {
    $("#phone_no").keydown(function (e) {
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
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#mobile').val().length >= 10 || $('#mobile').val().length == 10) {
            e.preventDefault();
        }
    });
	
	

});
</script>


	
	
	
	
</body>


</html>