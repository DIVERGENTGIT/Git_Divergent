<style type="text/css">
.top_login{ position:absolute; z-index:1000;
       top: 200px !important;
	   position:fixed; 
	   left: 0px !important;
	   
	    }
.title-page_clr04{color: #524c4c;    font-weight: bold;
}
.title_sub05{    font-size: 15px;
margin: 8px 0px 4px;    color: #1c6a9e;}
.mrgs-top15{margin-top:15px;}
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
				<h2 class="lead col_or">Bulk SMS</h2>
				</div>

					<div class="caption">
					<!--<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
<li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
<li class="active"><a href="<?php echo site_url('enterprise-messaging'); ?>">Enterprise Messaging</a></li>
						  <li class="active">Bulk SMS</li>
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

<div class="col-sm-12 col-md-12 padding_zero mrg_top">
				<div class="col-sm-12 padding_zero col-md-12 besniss_benfit01">
				<div class="col-sm-3 padding_ltzero">
				<a href="#bulksms">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/bulk-sms.png" alt="logo" >
                </div>
				<h5>Bulk SMS</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="#smsapi">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/2-way-sms.png" alt="logo" >
</div>				
				<h5>SMS API's</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="#longcodesms">
				<div class="bussiness_icons">
	<img src="<?php echo  base_url(); ?>images_n/long-code.png" alt="logo" >
				</div>
				<h5>LONG CODE SMS</h5>
				</a>
				</div>
				
				</div>
			
				</div>
				<div class="col-xs-12 padding_zero col-md-12">
				<div class="col-xs-12 padding_ltzero col-md-12">
						<div class="desc-wrap">
						<a name="bulksms"></a>
							<h4 class="title-page"> BULK SMS</h4>
							<p>Bulk SMS is the fastest way of communication with your customers because the bulk SMS conveys the information to the targeted groups within some time. Messages can be sent to all the groups and contacts at a time which are created with the recipient's name </p>
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> SMS is highly readable when compared with any communication media.</li>
								<li><i class="fa fa-check-circle"></i> SMS is one of the best mobile services in the mobile industry.</li>
								<li><i class="fa fa-check-circle"></i> Bulk SMS lets business use text message as the basic mode of communication with their customers.</li>
								<li><i class="fa fa-check-circle"></i> Bulk SMS can be sent in all the Indian languages and in a customized way. BULK SMS can also be scheduled in the future at any time.</li>
								<li><i class="fa fa-check-circle"></i> BULK SMS has built up a reputation for itself as one of the most reliable communication systems, guaranteeing almost 98 % deliveries to the receiver.</li>
								<li><i class="fa fa-check-circle"></i> According to the TRAI regulations, BULK SMS is divided into Transactional SMS and promotional SMS on the basis of the business requirement.</li>
							</ul>
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
				<div class="col-sm-12 col-md-12">
				<div class="col-xs-12 padding_zero col-md-12 mrgs-top15">
				<div class="col-xs-12 padding_ltzero col-md-12">
						<div class="desc-wrap">
						<a name="smsapi"></a>
							<h4 class="title-page">SMS API</h4>
							<p>SMS API is a virtual ten digit mobile number which receives high volume of messages from the users.</p>
							<p>A keyword is a great and unique option which does the separation of different customers, different services and different products.</p>
							<p>In the dedicated long codes, a single number is dedicated to one company and the dedicated keywords are also provided.</p>
							<p>In the shared long codes, the number is shared to many companies but the dedicated keywords are provided.</p>
							<p>High volume of data is captured easily and the replies can be sent through SMS and voices.</p>
							<h4 class="title-page_clr04">Features:</h4>	
							<div class="col-sm-12 col-md-12 padding_zero">
							<div class="col-sm-6 col-md-6 padding_zero">
							<h5 class="title_sub05">Detailed analytics:</h5>
							<p>The detailed reporting is done instantly on delivery, operator and area wise.</p>
							 </div>
							 <div class="col-sm-6 col-md-6 padding_rtzero">
							<h5 class="title_sub05">24/7:</h5>	
  <p>Once the service is activated, it is not interrupted anywhere because of high redundancy as our servers are located in the multiple places.</p>
  </div></div>
						</div>
					</div>
				
</div>
<div class="col-xs-12 padding_zero col-md-12 mrgs-top15">
				<div class="col-xs-12 padding_ltzero col-md-12">
						<div class="desc-wrap">
						<a name="longcodesms"></a>
							<h4 class="title-page">LONG CODE SMS</h4>
							<p>The BULK SMS service has reached to an extreme level because of the predominance and prevalence shown by the API.</p>
							<p>Our Bulk SMS services let the programmers integrate the SMS component into any program by using the following standard API(application programming interface).</p>
							<p>SMPP:The Short Message Peer to Peer is a protocol which can be integrated to your own application and it has been designed for sending the bulk messages on your own.
</p>
							<h4 class="title-page_clr04">Features:</h4>	
							<div class="col-sm-12 col-md-12 padding_zero">
							<div class="col-sm-6 col-md-6 padding_zero">
							<h5 class="title_sub05">OTP engine:</h5>
							<p>Because of the presence of the large volume of the data, An engine has been designed separately which is used to send or deliver the large volume of confirmations and OTPs(one time password) instantly.</p>
							</div>
							<div class="col-sm-6 col-md-6 padding_rtzero">
							<h5 class="title_sub05">DND engine:</h5>
							<p>The registered DND numbers as per the TRAI regulations are automatically

filtered by this engine.</p>
							</div>
							</div>
							
							<div class="col-sm-12 col-md-12 padding_zero">
							<div class="col-sm-6 col-md-6 padding_zero">
							<h5 class="title_sub05">User friendly Interface:</h5>
							<p>Long code sms is so simple and easily understood to the clients just by taking a look at it.</p>
							</div>
							<div class="col-sm-6 col-md-6 padding_rtzero">
							<h5 class="title_sub05">Detailed analytics:</h5>
							<p>The detailed reporting is done instantly on the basis of operator, error reports, Area, Time and Individuals and more.</p>
							</div>
							</div>
							<div class="col-sm-12 col-md-12 padding_zero">
							<div class="col-sm-6 col-md-6 padding_zero">
							<h5 class="title_sub05">Multiple API:</h5>
							<p>The integration of the API would be very easy to the programmers.
An API is provided to all the services that we have like Checking the balance, Error reports, Sending SMS.</p>
							</div>
							<div class="col-sm-6 col-md-6 padding_rtzero">
							<h5 class="title_sub05">Multi operator connectivity:</h5>
							<p>We are connected with the multiple operators as we are not dependent on one operator.</p>
							</div>
							</div>
								<div class="col-sm-12 col-md-12 padding_zero">
							<div class="col-sm-6 col-md-6 padding_zero">
							<h5 class="title_sub05">24/7:</h5>
							<p>Once the service is activated, it is not interrupted anywhere because of high redundancy as our servers are located in the multiple places.</p>
							</div>
							<div class="col-sm-6 col-md-6 padding_rtzero">
							<h5 class="title_sub05">Scalable:</h5>
							<p>when there is a substantial growth or expansion in the work load, it is capable to handle or perform also under these circumstances. The SMS push can be done significantly by increasing the throughput service.</p>
							</div>
							</div>
							<div class="col-sm-12 col-md-12 padding_zero">
							<div class="col-sm-6 col-md-6 padding_zero">
							<h5 class="title_sub05">Plug-in:</h5>
							<p>An excel Plug-In is provided with which there is no need to open the application every time. The complete information can be sent by the excel Plug In.</p>
							</div>
							<div class="col-sm-6 col-md-6 padding_rtzero">
							<h5 class="title_sub05">Email to SMS:</h5>
							<p>If u want to send SMS from an email, you have to be linked to the internet everytime.But this feature lets u send the Bulk SMS to any mobile all over the world from any email application.</p>
							</div>
							</div>

						</div>
					</div>
				
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
	
	
	
	
</body>


</html>