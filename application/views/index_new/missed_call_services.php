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
				<h2 class="lead col_or">MISSED CALL ALERTS</h2>
				</div>

					<div class="caption">
					<!--	<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
						   <li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
						   <li class="active"><a href="<?php echo site_url('voice-service'); ?>">Enterprise Voice Solutions</a></li>
						  <li class="active">MISSED CALL ALERTS</li>
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
					<div class="">
						
						<div class="col-sm-12 padding_zero txt_aln">

<div class="col-sm-12 col-md-12 mrg_top padding_zero">
				<div class="col-sm-12 padding_zero col-md-12 besniss_benfit01">
				<div class="col-sm-12 padding_zero">
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('ivrs'); ?>">
				<div class="bussiness_icons">
<img src="<?php echo  base_url(); ?>images_n/ivr.png" alt="logo" >
				</div>
				<h5>IVRS</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('hosted-ivr'); ?>">
				<div class="bussiness_icons">
	<img src="<?php echo  base_url(); ?>images_n/hosted-ivr.png" alt="logo" >
</div>				
				<h5>HOSTED IVR</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('missed-call-services'); ?>">
				<div class="bussiness_icons">
<img src="<?php echo  base_url(); ?>images_n/missed-call.png" alt="logo" >
				</div>
				<h5>MISSED CALL ALERTS</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('cloud-voice'); ?>">
				<div class="bussiness_icons">
<img src="<?php echo  base_url(); ?>images_n/voice-cloud.png" alt="logo" >
				</div>
				<h5>CLOUD VOICE</h5>
				</a>
				</div>
				</div>
				<div class="col-sm-12 padding_zero mrg_25">
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('tollfree-number'); ?>">
				<div class="bussiness_icons">
<img src="<?php echo  base_url(); ?>images_n/tollfree.png" alt="logo" >
				</div>
				<h5>TOLL FREE</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('voice-conferencing'); ?>">
				<div class="bussiness_icons">
<img src="<?php echo  base_url(); ?>images_n/voice-conferencing.png" alt="logo" >
				</div>
				<h5>VOICE CONFERENCING</h5>
				</a>
				</div>
				</div>
				</div>
			
				</div>

			</div>
					</div>
					<h4 class="title-page"> MISSED CALL ALERTS</h4>
							<p>Customers can place a missed call on your toll-free number free of cost to enable the concerned department respond to the call through IVR, Call or SMS. The incoming missed call can be stored on your IT/CRM application using URL forwarding while the server can send email alerts to missed calls using email forwarding service. A complete analysis of missed calls details (caller name, time of call, response duration time) is possible. Missed call services include:</p>
							<h5>Missed Call to Call</h5>
                            <p>Customers can place missed calls on the toll-free number and receive a call back from the response team. The Server will dial the call center, call back the customer and connect both the calls. Since the integrated system allows multiple phone numbers to be configured with the server, in the event that any number is busy, the server will hunt for a free number and connect. Customers benefit from cost-free call and 0-waiting time while you do not miss any lead.</p>
							<div class="row">
			
				<div class="services-item-full">
				<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							
                            
                            <h5>Missed call to SMS</h5>
                            <P>Customers can place missed calls to your toll-free number and receive an SMS in response. The standard/customized SMS can feature personal as well as dynamic data. The missed call to SMS service is ideal for gathering feedback, conducting surveys, opinion polls and voting polls and also for receiving real-time information from customers. Multiple voice numbers enable the gathering of customer feedback on offerings, client opinions and news and also for promoting social causes and marketing events.</P>
                            <h5>Missed call to IVR</h5>
                            <p>Missed call to IVR Customers can place missed calls to the toll-free number and receive a call back to record and save their inputs. The integrated IVR can also patch the call and connect your company executive and customer to enable them communicate directly. The server can send feedback survey SMS at the end of the call. This service helps enterprises manage virtual queues for customers, who have placed a missed call.</p>
							<h5>Advantages of Missed Call Alert Services</h5>
							 
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/missed_call1.png" alt="MissedCall1" class="img-responsive" />
						</div>
                       
					</div>
					<div class="col-xs-12 col-md-12">
                        <ul class="service-list" style="margin-top:0px;">
								<li><i class="fa fa-check-circle"></i>A unique national number.</li>
								<li><i class="fa fa-check-circle"></i> Free call for customers.</li>
								<li><i class="fa fa-check-circle"></i> Automatic disconnection after one ring.</li>
								<li><i class="fa fa-check-circle"></i> Easy to integrate with existing systems.</li>
								<li><i class="fa fa-check-circle"></i> Better response from callers.</li>
                            	<li><i class="fa fa-check-circle"></i> Multiple response options - IVR, Call and SMS.</li>
                            	<li><i class="fa fa-check-circle"></i> Email forwarding enables Email alerts for placed missed calls.</li>
                            	<li><i class="fa fa-check-circle"></i> Detailed reports & accurate analysis of campaign response.</li>
                            	<li><i class="fa fa-check-circle"></i>URL forwarding updates incoming missed call to your IT/CRM applications.</li>
							</ul>
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
			
			
			
		</div>
	</div>
	
	
	<!-- FOOTER SECTION -->
		
	
 <!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
	
	
</body>


</html>