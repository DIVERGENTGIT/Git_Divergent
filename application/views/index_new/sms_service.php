<style type="text/css">
.top_login{ position:absolute; z-index:1000;
       top: 200px !important;
	   position:fixed; 
	   left: 0px !important;
	   
	    }
.errors {
	color:#900;
	} 		
</style>
<body>
        
	<!-- BANNER -->
	<div class="section subbanner col-sm-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-md-6">
					<h2 class="lead col_or">ENTERPRISE MESSAGING</h2>
					</div>
					<div class="caption">
					<!--<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
						  <li class="active">Home</li>
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
				<div class="col-sm-8 padding_zero">
					<div class="page-title">
     					<div class="col-sm-12 padding_zero txt_aln">			
<p>Utilize text messaging to effectively communicate with your customers</p>
<p>With 90 percent of text messages being read within minutes of delivery, according to Mobile Squared, text messages (SMS or MMS), are considered to be one of the world’s most popular and practical forms of mobile technology to reach your customers.</p>
		<div class="col-sm-12 col-md-12 padding_zero">
			<div class="col-sm-12 padding_zero col-md-12 besniss_benfit01">
				<div class="col-sm-3 padding_ltzero">
				<div class="bussiness_icons">
				<div class="fa fa-tags"></div>
				</div>
				<h5>Bulk SMS</h5>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<div class="bussiness_icons">
				<div class="fa fa-suitcase"></div>
				</div>				
				<h5>SMS API's</h5>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<div class="bussiness_icons">
				<div class="fa fa-user"></div>
				</div>
				<h5>LONG CODE SMS</h5>
				</div>
				
		  	</div>
	</div>
    <br>
    <br>
    <div class="col-sm-12 col-md-12 padding_zero">
         	
				  
    </div>
	</div>
				</div>
					</div>
					<div class="col-sm-4 reg_page01">
					<div class="col-sm-12 reg_pageheader">
			<h4>signup for demo account</h4>
			<h4>it's free and takes only seconds!</h4>
			</div>
            <div class="col-sm-12 reg_pagebody">
           <script>					 
			$(document).ready(function () {
			jQuery.validator.addMethod("lettersonly", function(value, element) {
  			return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
			}, "Enter a valid name, alphabets only"); 
           
		    $('#sms_form').validate({ 
				errorClass:"errors",
                rules: {
                    name: {
                        required: true,
						lettersonly: true                       
                    },
                    email: {
                        required: true,
                        email: true
                    },
					phone: {
                        required: true,
                        number: true
                    }					
                },
				messages: {
					phone: "Just check the box<h5 class='text-error'>You aren't going to read the EULA</h5>"
				},
				tooltip_options: {
					name: {trigger:'focus'},
					email: {placement:'left',html:true}
				},
				submitHandler: function (form) { 
                  		alert('valid form submitted!');
						$(".errors").html('<div class="alert alert-success">No errors.  Like a boss.</div>'); 
                    	return false; 
                }
            });
        
        });
		
		
        </script>   
		    <form id="sms_form" action="" method="post">
            <input type="text" name="name" data-toggle="tooltip" data-placement="left" placeholder="Full Name">            
			<input type="text" name="email" data-toggle="tooltip" data-placement="left" placeholder="Enter Your Email">
			<input type="text" name="phone" data-toggle="tooltip" data-placement="left" placeholder="Phone Number">
			<h5>We will never Spam You,or sell Your email to third parties. All fields are required</h5>
			<div class="col-sm-12"><input type="submit" name="" value="submit"></div></form>
			<div class="col-sm-12 talk_sales02 padding_zero"><a href="#" class="talk_sales">TALK TO SALES</a></div>
			</div>
			</div>
				</div>
			</div>
			
			<div class="row">
				<div class="services-item-full">
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
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/sms2_1.png" alt="BULK" class="img-responsive" />
						</div>
					</div>
					<div class="clearfix"></div>
				</div>		
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/sms_api.jpg" alt="SMSAPI" class="img-responsive" />
						</div>  
                    </div>                      
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page"> SMS API's</h4>
							<p>Bulk Messaging services allow programmers to add SMS functionality to any program using the following popular standard API's (Application Programming Interface):</p>
                             <p><H5>Enterprise SMS API:</H5>
                             Enterprise SMS API is a smart and efficient way to connect business applications to SMS networks across the globe sans complexities like messaging protocols, routing and telecom contracts. Our reliable telecom platform connects to all global SMS networks and presents a small set of functions to deliver messages to mobile phones across the world. Messages or replies originating from mobile phones can also be delivered to your application using the same tool. Applications can leverage this protocol to send and receive business messages.
                            </p>
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> FTP (File Transfer Protocol).</li>
								<li><i class="fa fa-check-circle"></i> SMPP (Short Message Peer-to-Peer).</li>
								<li><i class="fa fa-check-circle"></i> HTTP.</li>
								<li><i class="fa fa-check-circle"></i> Easy Costumizable.</li>
								<li><i class="fa fa-check-circle"></i> Email.</li>
							</ul>
                           
						
                         
					</div>
                        
					</div>
                   
					<div class="clearfix"></div>
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/custom_sms.jpg" alt="custom sms" class="img-responsive" />
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">Customized SMS</h4>
							<p>Different companies have different marketing communication needs. Reason why, customized solutions are essential. Striker’s customized SMS ensures company-specific SMS solutions for better results. The flexible SMS platform can be integrated with any application and SMS can be delivered through Excel plug-in / software. Round-the-clock technical assistance ensures uninterrupted service. The service complements web e-mail services and the accompanying SMS alerts. What’s more, Strikers SMS portals come with clear registration, login platforms and user flexibility.</p>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">LONG CODE SMS</h4>
							<p>Long code is used by businesses to receive feedback SMS and to generate sales leads through their own numbers. Clients availing this service are provided with a Keyword, which is similar to a unique company. The received messages are segregated on the basis of keywords and routed to the accounts of companies.</p>
                            
                            <p>Striker’s Long Codes Solutions are very cost-effective and ideal for long term campaigns. Long Code SMS is used mainly by mutual fund companies to communicate bonus, dividends and profits, by Insurance companies to confirm policy, premiums, payments etc., by FMCG companies to gather feedback, by airline, train, bus and other travel operators to travel schedules and other related information, by hotels and restaurants to confirm food deliveries etc. and by other industries such as Banking, Entertainment, Finance and Education etc.</p>
                            
                            <h5>Features and Benefits</h5>
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> Quick response with Auto reply and Customised reply.</li>
								<li><i class="fa fa-check-circle"></i> Real time monitoring and reporting.</li>
								<li><i class="fa fa-check-circle"></i> Easy customer interaction.</li>
								<li><i class="fa fa-check-circle"></i> Ideal for TV shows, product promotions.</li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url(); ?>images_n/long-code.png" alt="LONGCODESMS" class="img-responsive" />
						</div>
                        <ul class="service-list">
								
								
								<li><i class="fa fa-check-circle"></i> 2way SMS with unlimited sub keywords.</li>
                                	<li><i class="fa fa-check-circle"></i> SMS to Email applications.</li>
                                	<li><i class="fa fa-check-circle"></i> Response directed towards the URL.</li>
							</ul>
					</div>
					<div class="clearfix"></div>
				</div>
         			
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

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="base_url('js_n/jquery-validate.bootstrap-tooltip.js');"></script>

</body>
</html>