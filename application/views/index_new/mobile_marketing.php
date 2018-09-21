 <style type="text/css">
 .about-img {
    margin-bottom: 20px;
    margin-top: 0px !important;
}

.top_login{ position:absolute; z-index:1000;
       top: 200px !important;
	   position:fixed; 
	   left: 0px !important;
	    }
    </style>
<body>
	
	<!-- Load page -->
	
	
	
	<!-- NAVBAR SECTION -->
	

	<!-- BANNER -->
    
    
	<div class="section subbanner col-sm-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="caption">
					<!--	<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
						<li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
						  <li class="active">Mobile Marketing</li>
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
				<div class="col-sm-8">
					<div class="page-title">
						<h2 class="lead"> MOBILE MARKETING</h2>
</div>
					<div class="desc-wrap">
							<h4 class="title-page">Introduction </h4>
							
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> 2.33 Bn people spend time @ 90 to 120 mins daily on their mobiles to messaging, sharing/uploading videos/pictures, and surf web..</li>
								<li><i class="fa fa-check-circle"></i> 3.5% yoy growth in mobile apps.</li>
								<li><i class="fa fa-check-circle"></i> 138 Bn mobile apps are downloaded every year.</li>
								<li><i class="fa fa-check-circle"></i> 25% enterprises will have personalized mobile apps by 2017.</li>
                                <li><i class="fa fa-check-circle"></i> 68% enterprises develop mobile apps every year.</li>
								
							</ul>
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
			<h4>signup for demo account</h4>
			<h4>it's free and takes only seconds!</h4>
			</div>
			<form role="form" name="enquire_form" id="enquire_form1" action="enquire_form" method="post">
			<div class="col-sm-12 reg_pagebody">
			<input type="text" name="name" placeholder="Full Name">
			<input type="text" name="email" placeholder="Enter Your Email">
			<input type="text" name="phone_no" placeholder="Phone Number">
			<h5>We will never Spam You,or sell Your email to third parties. All fields are required</h5>
			<div class="col-sm-12">
			<input type="submit" name="enqui_form" value="submit"></div>
			<div class="col-sm-12 talk_sales02 padding_zero"><a href="#" class="talk_sales">TALK TO SALES</a></div>
			</div>
		</form>
			</div>
				</div>
			</div>
			
			<div class="row">
			
				<div class="">
				<div class="col-xs-12 col-md-12">
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url();?>images_n/mobile_marketing.png" alt="MOBILEMARKETING" class="img-responsive" />
						</div>
					</div>
					
                    
					<div class="col-xs-12 col-md-6">
                    <P>With people getting addicted to using mobile phones to do all their activities be it passing information, shopping, sending messages, downloading apps, calling services, and web surfing, businesses have also started using the same source for advertising, also called as Mobile Marketing <BR>
Every business enterprise has to understand the fact that, mobile users have been increasing every second, every minute and so is also a potential customer, a prospective lead. Every users with WI-FI integrated into their mobile devices has the whole world in their hands.</P>
                        <BR>
                            
            <P>Competition has ensured business enterprise to create mobile apps to pull customers. Every day new, engaging and innovative apps are being launched into the market and available on the store for free or at nominal prices. <BR>
At adFruits, we create different optimization techniques to ensure our customer apps are available and visible in app stores. We also provide ranking boost strategy to increase download of the app, written reviews from industrial experts and push Ads on mobile devices based on the user’s location.</P>  
</div>  
</div>                          
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page"> APP STORE OPTIMIZATION</h4>
                           
							
							<P>Everyday different apps are created and launched in the market place. Most of these apps are created for professional requirements like advertising, selling and buying products, providing services, sending and receiving information, audio- video services and gaming services.

At adFruits, our focus is not only to generate app-page traffic, but also to make sure that your app is visible and discovered by relevant users, who regularly visit the app page. We follow a unique mechanism to truly optimize your app store page, we pay close attention to various aspects that benefit you everytime there is a user’s visit. Our mechanism involves creating creative, innovative, compelling informative details based on Keyword Search, App Description, App Logo, Screenshots, video Trailers, Competitive Research, Reviewing & Rating, App Name, Pricing and Analytics.</P>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url();?>images_n/app_store.png" alt="APPSTOREOPTIMIZATION" class="img-responsive" />
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url();?>images_n/02.gif" alt="APP STORE OPTIMIZATION" class="img-responsive" />
                            <br>
                            
                            	
                           
                           
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">APP REVIEWS</h4>
							<H5 style="font-weight:600;">APP REVIEWS</H5>
							<P> App Review is a key source for a user to gather information regarding the app and more so critical for the app owner to get the much needed position in the market place.
<BR>
At adFruits, we get your app reviewed by the industry specific expertise from the most efficient app review sites. With a network of 100+ app review sites, we have a very strong and extended global reach out to the maximum review sites and assure you the highest traffic reach to your app. Our focus is towards building up a very big fan following to your app an also leveraging it to get highest app store ranking.
                            
                            </P>
                            
						</div>
                        
					</div>
                    
					<div class="clearfix"></div>
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">APP RANK BOOSTING</h4>
							<p>Every app has to maintain its stand in the market place and this usually happens based on the reviews and downloads from different users browsing through the app store. To get a good ranking the app owner has to focus on the visibility of the app.
<BR>
At adFruirs, apart from getting reviews from different industrial experts and advisor, we also provide the app visibility and reviews from target country of your app, to get genuine reviews along with 4 to 5 ratings for your app. We also try to for a sustainable push to stabilize your rankings for any desired time frame.</p>
                                <H5>We provide the following service to impact app Ranking</H5>
							<ul class="service-list">
								<li><i class="fa fa-check-circle"></i> High visibility in the app store as well as high quality users</li>
								<li><i class="fa fa-check-circle"></i> Ranking-Boost and / or stabilization of rankings</li>
								<li><i class="fa fa-check-circle"></i> Flat rate or cost per install (CPI) pricing</li>
								<li><i class="fa fa-check-circle"></i> Platforms: iOS and Android</li>
							
							</ul>
                           
						</div>
                         
					</div>
                    
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url();?>images_n/app_09.gif" alt="APPRANKBOOSTING" class="img-responsive" />
						</div>
					</div>
                   
					<div class="clearfix"></div>
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url();?>images_n/app_13.gif" alt="APP RANK BOOSTING" class="img-responsive" />
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">APP BASED MARKETING </h4>
							The present generation of enterprise marketers are taking keen interest in app based marketing also called as Mobile Marketing as they have seen the innovations, reliability, visibility and most importantly customer’s involvement by way of mobile devices.
<BR>
At adFruits, we have a team of dedicated mobile app consultants, who are involved in developing different app marketing strategies, sales campaigns, app store optimization activities and also creating innovative and interactive apps. We support two way app marketing:
<BR>
Advertising to mobile users through third-party apps and websites to acquire new users.
Creating app marketing strategies to generate more revenue and engagement from the mobile users who already use your app.
Our mobile app development team has a huge design base comprising of static, iterative designs, dynamic and classy designs with varying for different mobile devices.
<BR>
We following the multi-platform development methodological implementation, we make use of latest technology and its innovations to integrate into our application development platform and create new features as part of the mobile app.
<BR>
We support multi-platform cross-functional development environment and provide customized and personalized apps specific for different operating systems and mobile devices. Also support mobile app development for different business and enterprise requirements.
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				</div>
				
				<div class="services-item-full">
					<div class="col-xs-12 col-md-6">
						<div class="desc-wrap">
							<h4 class="title-page">LOCATION BASED MARKETING</h4>
							<P>Location-Based Marketing (LBM) is the usage of mobile marketing to target mobile users from different geographic areas. Instead of treating mobile users as individual entity, this adapts to specific social, cultural and personal traits of customers by creating assumptions about their habits, wants, needs and preferences based on their location.
<BR>
At adFruits, we use a technique of publishing enterprise businesses products ads using mobile display (banner) ads, mobile paid search ads and/or other forms of mobile advertising to mobile users who have been located using GPS. This is the most effective marketing strategy for mobile users within a specific geographical area.<BR>

<H5>Mobile Search Ads</H5>
These are Google search ads for mobile including options of click-to-call or click-to-download which generate a link for the aforesaid action.
				</P>
                            
                            
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="about-img">
							<img src="<?php echo base_url();?>images_n/app_location.gif" alt="LOCATIONBASEDMARKETING" class="img-responsive" />
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
                
                
                
				
				
			</div>
			
		</div>
	</div>
	
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