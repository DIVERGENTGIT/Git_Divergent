<div class="col-sm-12 padding_zero footer">

		<div class="f-desc">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="footer-item">
							<div class="footer-logo">
								<img src="<?php echo  base_url(); ?>images_n/footer_logo.png" alt="bulk sms services in hyderabad" />
							</div>
							<p class="footer_p">Striker is a Hyderabad-based company specializing in computer telephony platforms and associated multichannel applications.</p>
							<p class="footer_p">Striker simplifies and secures enterprise communications. Safeguard your most important assets, accelerate organization speed, and comply with industry regulations. 
In other words – add value to your enterprise.</p>
							<div class="footer-sosmed">
								<a href="https://www.facebook.com/smsstriker" title="facebook" target="_blank">
									<div class="item">
										<i class="fa fa-facebook"></i>
									</div>
								</a>
								<a href="https://twitter.com/strikersoftsol" title="twitter" target="_blank">
									<div class="item">
										<i class="fa fa-twitter"></i>
									</div>
								</a>
								<a href="https://www.pinterest.com/ssoftsol/" title="pinterest" target="_blank">
									<div class="item">
										<i class="fa fa-pinterest"></i>
									</div>
								</a>
								<a href="https://plus.google.com/u/0/111944089972259140770/posts" title="google-plus" target="_blank">
									<div class="item">
										<i class="fa fa-google"></i>
									</div>
								</a>
								<!--<a href="#" title="">
									<div class="item">
										<i class="fa fa-instagram"></i>
									</div>
								</a>-->
								<a href="https://www.linkedin.com/company/striker-soft-solutions?trk=biz-companies-cym" title="linkedin" target="_blank">
									<div class="item">
										<i class="fa fa-linkedin"></i>
									</div>
								</a> 
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					
                        <div class="footer-item">
                            <div class="footer-title">
                            
                                    	<h4> QUICK LINKS</h4>
							
                            </div>
                           <div class="list-group">
                           <ul>
                              <li class="list-group-item"><a href="<?php echo base_url('index'); ?>"><span class="f_sp">&#9830;</span>   Home</a></li>
                              <li type="button" class="list-group-item"><a href="about.html"> <span class="f_sp">&#9830;</span>  About Us</a></li>
                              <li type="button" class="list-group-item"><a href="whystriker.html"> <span class="f_sp">&#9830;</span>  Why We Are</a></li>
                              <li type="button" class="list-group-item"><a href="verticals.html">  <span class="f_sp">&#9830;</span>  Verticals</a></li>
                              <li type="button" class="list-group-item"><a href="bulk-sms.html"> <span class="f_sp">&#9830;</span>  Bulk SMS Service</a></li>
                              <li type="button" class="list-group-item"><a href="voice-service.html"> <span class="f_sp">&#9830;</span>  Voice Service</a></li>
                               
                              <li type="button" class="list-group-item"><a href="pricing.html"> <span class="f_sp">&#9830;</span>  Pricing</a></li>
                               <li type="button" class="list-group-item"> <a href="striker-reseller.html"> <span class="f_sp">&#9830;</span>  Reseller</a></li>
                               <li type="button" class="list-group-item"><a href="careers.html"><span class="f_sp">&#9830;</span>  Careers</a></li>
                               
                               </ul>
                            </div>
                              
                             </div>     
						
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="footer-item">
							<div class="footer-title">
								<h4>NEWSLETTER</h4>
							</div>
							<?php if(!empty($userExistnew)) { echo $userExistnew; } ?>
		                    <?php if(!empty($sucess1)){ echo $sucess1; } ?> 
							<div class="footer-form">

								<?php echo form_open('newsletter',
					array( 'method' => 'post','id' => 'news_letters')
	); ?>
								
									<div class="form-group">

										<?php 


                             echo form_input(array('name' => 'user_name', 'id' => 'user_name', 'maxlength' => 45, 'class' => 'form-control','placeholder' => 'Username'));?>
										
									</div>
									<div class="form-group">
										<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'class' => 'form-control','placeholder' => 'email' ));?>
										
									</div>
									<div class="form-group">
										<?php echo form_submit(array('name' => 'news_letter', 'id'=>'news_letter', 'value' => 'SEND', 'class'=>'btn btn-default'));?>
										
									</div>
									
								<?php echo form_close(); ?>
							</div>
							
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="footer-item">
							<div class="footer-title">
								<h4>GET IN TOUCH</h4>
							</div>
							<div class="footer-getintouch">
								<div class="footer-getintouch-item">
									<div class="icon">
										<b class="fa fa-phone"></b>
									</div>
									<div class="desc">
										<div class="desc-1">Phone</div>
										<div class="desc-2">:</div>
										<div class="desc-3">040 - 6454 7711</div>
									</div>
								</div>
								<div class="footer-getintouch-item">
									<div class="icon">
										<b class="fa fa-envelope "></b>
									</div>
									<div class="desc">
										<div class="desc-1">Email</div>
										<div class="desc-2">:</div>
										<div class="desc-3" ><a style="color:#fff !important;" href="mailto:support@smsstriker.com" title="">support@smsstriker.com</a></div>
									</div>
								</div>
								<div class="footer-getintouch-item">
									<div class="icon">
										<b class="fa fa-globe"></b>
									</div>
									<div class="desc">
										<div class="desc-1">Website </div>
										<div class="desc-2">:</div>
										<div class="desc-3">www.smsstriker.com</div>
									</div>
								</div>
								<div class="footer-getintouch-item">
									<div class="icon">
										<b class="fa fa-map-marker"></b>
									</div>
									<div class="desc">
										<div class="desc-1">Address </div>
										<div class="desc-2">:</div>
										<div class="desc-3"># 4th Floor, <br />Sinman Dwaraka,<br /> Opp Lane - Cyber Gateway, <br />Madhapur, Hyderabad ,<br />500081, Telangana, India.</div>
     

									</div>
								</div>
								
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
				
		</div>
		
		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-md-6 footer_links">
			<a href="http://www.smsstriker.com/">Home</a> | <a href="http://www.smsstriker.com/about.html">About Us</a> | <a href="http://www.smsstriker.com/privacy-statement.html">Privacy Statement</a> | <a href="http://www.smsstriker.com/terms-of-services.html">Terms Of Services</a>
</div>				
<div class="col-md-6">
						<p class="ftex"> <i class="fa fa-copyright" style="margin-right:5px;"></i>All Copy rights 2014  Striker Soft Solutions Pvt. Ltd., All rights reserved</p>
</div>						
					</div>
				</div>
			</div>
		</div>
		 
	</div>

	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content login-modal">
      		<div class="modal-header login-modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> </span></button>
        		<h4 class="modal-title text-center" id="loginModalLabel">USER AUTHENTICATION</h4>
      		</div>
      		<div class="modal-body">
      			<div class="text-center">
	      			<div role="tabpanel" class="login-tab">
					  	<!-- Nav tabs -->
					  	<ul class="nav nav-tabs" role="tablist">
					    	<li role="presentation" class="active"><a id="signin-taba" href="#home" aria-controls="home" role="tab" data-toggle="tab">Sign In</a></li>
					    	<!--<li role="presentation"><a id="signup-taba" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>-->
					    	<li role="presentation"><a id="forgetpass-taba" href="#forget_password" aria-controls="forget_password" role="tab" data-toggle="tab">Forget Password</a></li>
					  	</ul>
					
					  	<!-- Tab panes -->
					 	<div class="tab-content">
					    	<div role="tabpanel" class="tab-pane active text-center" id="home">
					    		
					    		<span id="login_fail" class="response_error" style="display: none;">Loggin failed, please try again.</span>
					    		<div class="clearfix"></div>
					    			<?php echo form_open('index_new', array('id' => 'login_form', 'name' => 'login_form') ); ?>
									<div class="form-group">
								    	<div class="input-group">
								      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
											<?php echo form_input(array('name' => 'username', 'id' => 'username', 'maxlength' => 45,'value' => set_value('username'),'placeholder' => 'Username', 'class' => 'form-control' ));?>
                                          <div class="form_error"><?php echo form_error('username'); ?></div>
								      		
								    	</div>
								    	<span class="help-block has-error" id="email-error"></span>
								  	</div>
								  	<div class="form-group">
								    	<div class="input-group">
								      		<div class="input-group-addon"><i class="fa fa-lock"></i></div>
											<?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'maxlength' => 45, 'value' => set_value('userpass'),'placeholder' => 'Password','class' => 'form-control'));?>
    <div class="form_error"><?php echo form_error('userpass'); ?></div>
								      		
								    	</div>
								    	<span class="help-block has-error" id="password-error"></span>
								  	</div>
									<?php echo form_submit(array('name' => 'login','value' => 'Login', 'class' => 'btn btn-block bt-login'));?>

						  			
									<?php echo form_close(); ?>
						  			<div class="clearfix"></div>
						  			<div class="login-modal-footer">
						  				<div class="row">
											
											
											<div class="col-xs-8 col-sm-8 col-md-8" style="margin-top:5px;">
												<i class="fa fa-check"></i>
												<a href="<?php echo site_url('index_new/register'); ?>" class="signup-tab"> Register - New Account </a>
											</div>
                                           <!-- <div class="col-xs-8 col-sm-8 col-md-8">
												<i class="fa fa-lock"></i>
												<a href="javascript:;"  class="forgetpass-tab"> Forgot password? </a>
											
											</div>-->
										</div>
						  			</div>
								
					    	</div>
					    	
					    	<div role="tabpanel" class="tab-pane text-center" id="forget_password">
					    	
					    	    <span id="reset_fail" class="response_error" style="display: none;"></span>
						    		<div class="clearfix"></div>
						    		<form>
										<div class="form-group">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
									      		<input type="text" class="form-control" id="femail" placeholder="Email">
									    	</div>
									    	<span class="help-block has-error" data-error='0' id="femail-error"></span>
									  	</div>
									  	
							  			<button type="button" id="reset_btn" class="btn btn-block bt-login" data-loading-text="Please wait....">Forget Password</button>
										<div class="clearfix"></div>
										<div class="login-modal-footer">
							  				<div class="row">
												<div class="col-xs-8 col-sm-8 col-md-8" style="margin-top:5px;">
												<i class="fa fa-check"></i>
												<a href="<?php echo site_url('index_new/register'); ?>" class="signup-tab"> Register - New Account </a>
											</div>
												
												<!--<div class="col-xs-6 col-sm-6 col-md-6">
													<i class="fa fa-check"></i>
													<a href="login.html" class="signup-tab">Register </a>
												</div>-->
											</div>
							  			</div>
									</form>
						    	</div>
						  	</div>
						</div>
	      				
	      			</div>
	      		</div>
	      		
	    	</div>
	   </div>
 	</div>

	<script>
$(document).ready(function() {
$('.carousel[data-type="multi"] .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().appendTo($(this));
  }
});
    
});
</script>
	</body>
</html>
<!-- Visitor Chat -->

<script type="text/javascript">
    function loadVC() {
      var vcjs = document.createElement('script'); vcjs.type = 'text/javascript'; 
      vcjs.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.smsstriker.com/chat/chat'; 
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(vcjs, s);
    };
    if (window.addEventListener) window.addEventListener('load', loadVC, false); 
    else if (window.attachEvent) window.attachEvent('onload', loadVC);
</script>
<!-- Visitor Chat -->
