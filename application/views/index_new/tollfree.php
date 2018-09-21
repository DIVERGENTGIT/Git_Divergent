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
				<h2 class="lead col_or">Toll Free</h2>
				</div>

					<div class="caption">
					<!--	<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
						   <li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
						   <li class="active"><a href="<?php echo site_url('voice-service'); ?>">Enterprise Voice Solutions</a></li>
						  <li class="active">Toll Free</li>
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
				<div class="col-sm-8 padding_zero">
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
                        number: true
                    }
                },
               
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
			
				<div class="services-item-full">
				<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">TOLL FREE</h4>
							<p>Tool-free numbers help businesses stay connected with their customers 24x7 and achieve a range of goals including lead generation, customer feedback, voting and brand fortification. Striker Soft offers businesses a unique, country-wide toll-free number that can be dialed directly by its customers without any STD/ISD codes across India and from any operator’s network. As customers are just a phone call away and the service is free of cost to the caller (customer), businesses stand to benefit from the proximity and convenience to its customers.</p>
                            <h5>Routing:</h5><P>  Maximize your business efficiency with best-in-class routing flexibility.</P>
                            <P>Time-based routing: Benefit from flexibility with time-based routing. Calls can be routed to the number of your choice and based on the time of the call. For instance you can route all calls during working hours (10 am to 6 pm) to your Hyderabad-based call centre and calls thereafter (6 pm to 10 am) to your outsourced call centre.</P>
                            
                           <h5>Time-based routing:</h5> <p> Benefit from flexibility with time-based routing. Calls can be routed to the number of your choice and based on the time of the call. For instance you can route all calls during working hours (10 am to 6 pm) to your Hyderabad-based call centre and calls thereafter (6 pm to 10 am) to your outsourced call centre.</p>
                            
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> Smart, virtual business phone number.</li>
								<li><i class="fa fa-check-circle"></i> Receive calls on your existing phones</li>
								<li><i class="fa fa-check-circle"></i> Record and study incoming calls.</li>
								<li><i class="fa fa-check-circle"></i> Attend all customer calls.</li>
								<li><i class="fa fa-check-circle"></i> Enhance business efficiency and productivity</li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/tollfree.png" alt="Tollfree" class="img-responsive" />
						</div>
                        <h5>Call redirect</h5>
                        <p>Call redirect Calls that don’t go through due to busy lines or calls that go unanswered after a particular number of rings can be redirected so that you do not loose a business prospect.</p>
                        <h5>Call redirect:</h5>
                        <p> Calls that don’t go through due to busy lines or calls that go unanswered after a particular number of rings can be redirected so that you do not loose a business prospect.</p>
                        <h5>IVR-based routing:</h5>
                        <p>IVR-based routing: IVR-based call routing offers flexibility and convenience as calls can be routed according to the callers preference. For instance, calls can be routed to the relevant department Marketing, HR, Service etc., to ensure accurate access to the caller. Some of the advantages of Toll free numbers include:</p>
					</div>
				
					<div class="clearfix"></div>
				</div>
				
         			
			</div>
			
		</div>
	</div>
	
	
	<!-- FOOTER SECTION -->
		
	
 <!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
	
	
</body>


</html>