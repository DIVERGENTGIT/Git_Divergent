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
				<h2 class="lead col_or">HOSTED IVR SERVICES AND SOLUTION PROVIDER</h2>
				</div>

					<div class="caption">
					<!--	<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
						  <li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
						   <li class="active"><a href="<?php echo site_url('voice-service'); ?>">Enterprise Voice Solutions</a></li>
						  <li class="active">HOSTED IVRS</li>
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
<h4 class="title-page">HOSTED IVR SERVICES AND SOLUTION PROVIDER </h4>
							<p>This dynamic automated response mechanism is used by companies to automate their telephone response system with callers (existing/prospective customers, vendors and all other stakeholders).</p>
							 <p>IVR reduces call time by streamlining the call and by-passing layers of communication so that it is answered directly by the right person. For instance, customers calling a company’s central office seeking service-related queries need not go through the receptionist and wait for their call to be transferred; they can directly be connected to the service department using IVR which offers automated options such as ‘Press 1 for Sales-related queries’ and ‘Press 2 for Service-related queries’ which reduces the call time and helps the caller reach the target conveniently.</p>
			</div>
					</div>
					<div class="row">
			<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							
                           
                            <h5>Advantages of Hosted IVR Solutions</h5>
                            
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> Efficient automated system</li>
								<li><i class="fa fa-check-circle"></i> Less resources required – manpower and time</li>
								<li><i class="fa fa-check-circle"></i> Building a brand on a single number</li>
								<li><i class="fa fa-check-circle"></i> CRM panel to manage call records</li>
								<li><i class="fa fa-check-circle"></i> Better customer interface</li>
							</ul>
							 
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/voicesms.png" alt="voicesms" class="img-responsive" />
						</div>
                       
					</div>
					<div class="col-xs-12 col-md-12">
					<h5>IVR is ideal for:</h5>
                        
                        <ul class="service-list">
								<li><i class="fa fa-check-circle"></i> Organizations with multiple teams/departments which need to communicate directly with customers</li>
								<li><i class="fa fa-check-circle"></i> Organizations with virtual teams across locations - For instance, Sales team in Hyderabad, Service team in Chennai</li>
								<li><i class="fa fa-check-circle"></i> Organizations requiring automated information gathering or feedback mechanisms over voice for improved data analysis</li>
								<li><i class="fa fa-check-circle"></i> Marketing organizations seeking to disseminate information on product/service launch, sales schemes, etc.</li>
								
							</ul>
					<div class="clearfix"></div>
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
			
			
			
		</div>
	</div>
	
	
	<!-- FOOTER SECTION -->
		
	
 <!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
	
	
</body>


</html>