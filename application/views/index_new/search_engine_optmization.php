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
				<h2 class="lead col_or">SEARCH ENGINE OPTMIZATION</h2>
				</div>

					<div class="caption">
					<!--	<h3>SMS SERVICES</h3>-->
						<ol class="breadcrumb">
						    <li class="active"><a href="<?php echo base_url('index'); ?>">Home</a></li>
						   <li class="active"><a href="<?php echo site_url('digital-marketing'); ?>">DIGITAL MARKETING</a></li>
						  <li class="active">SEO</li>
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

<div class="col-sm-12 col-md-12 mrg_top padding_zero">
<div class="col-sm-12 padding_zero col-md-12 besniss_benfit01">
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('search-engine-optmization'); ?>">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/seo.png" alt="logo" >
				</div>
				<h5>SEO</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('search-engine-marketing'); ?>">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/sem.png" alt="logo" >
</div>				
				<h5>SEM</h5>
				</a>
				</div>
				<div class="col-sm-3 padding_ltzero">
				<a href="<?php echo site_url('social-media-marketing'); ?>">
				<div class="bussiness_icons">
				<img src="<?php echo  base_url(); ?>images_n/smm.png" alt="logo" >
				</div>
				<h5>SMM</h5>
				</a>
				</div>

			</div>
			
				</div>

			</div>
					</div>
					<h4 class="title-page">SEARCH ENGINE OPTMIZATION </h4>
                            
                            <p>Did you know that there are more than 1 billion websites on the Internet Search engines are the sources driving 75% + traffic to websites With advent of digital technology and WI-FI at your doorsteps, people have started using online search engines to search for information on product/services.<BR>

Keeping your website among the top or the first page in the search engine is the most critical activity every business has to accomplish. This is not a simple task and this has to be continued until the business exists to keep itself alive in the market place. Search Engine Optimization (SEO) is the right answer.<BR>

Over the years adFruits have successfully provided scalable selling strategies to increase qualified traffic to their client’s sites. Our team of highly-skilled SEO consultants will help your website site get the much-needed attention by:</p>
 <h5>Search Engine Optimization @ Striker:</h5>
                                 <ul class="service-list">
								<li><i class="fa fa-check-circle"></i> Initial Website Consultation.</li>
								<li><i class="fa fa-check-circle"></i> Keyword Research.</li>
								<li><i class="fa fa-check-circle"></i> Meta Data Alterations.</li>
								<li><i class="fa fa-check-circle"></i> Front Page Content Consultation.</li>
                                <li><i class="fa fa-check-circle"></i> Review of Internal Text Links.</li>
                                <li><i class="fa fa-check-circle"></i> Content Writing (additional charges may apply).</li>
                                <li><i class="fa fa-check-circle"></i> Review of and Implementation of Google Analytics/Google Search Console.</li>
                                <li><i class="fa fa-check-circle"></i> Ranking / Status Reports.</li>
                            <li><i class="fa fa-check-circle"></i> Increasing Visibility in the Search Engines.</li>
								<li><i class="fa fa-check-circle"></i> Amplifying Qualified Traffic.</li>
								<li><i class="fa fa-check-circle"></i> Boosting Keyword Rankings.</li>
								<li><i class="fa fa-check-circle"></i> You want your website in front of as many people as possible. Our SEO services provide lasting results that extend beyond a quick, temporary boost in rankings.</li>
							</ul>
							<div>
						
                
                            <p>Our strategies are designed and developed to take advantage of existing tactics that work and are inline with the Google Search Quality Guidelines. We anticipate and change our approach in building a feasible solution based on the algorithmic changes in the search engines.
<BR>
Every business is unique to us and we pay utmost attention towards their goals, customers needs and accordingly we customize to fit into your business planning and budgets. We closely work with all types of businesses across industries.</p>
                            
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