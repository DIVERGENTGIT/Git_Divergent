<!DOCTYPE html>
<html lang="en">
<head>
  <title>SMS Strikers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.smsstriker.com/ppc/css/bootstrap.css">
  <link rel="stylesheet" href="https://www.smsstriker.com/ppc/css/style.css">
  <link rel="stylesheet" href="https://www.smsstriker.com/ppc/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.smsstriker.com/ppc/css/slick.css">

<style> 
.borderless td, .borderless th {
    border: none !important;
}
</style>

</head>
<body>
<!-- navigation bar -->
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="https://www.smsstriker.com/ppc/img/logo.png" alt="striker logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="one"><a href="https://smsstriker.com/">Home</a></li>
        <li class="one"><a href="https://smsstriker.com/bulk-sms.html">Bulk SMS</a></li>
        <li class="one"><a href="https://smsstriker.com/short-link-url-services.html">Short URL</a></li>
        <li class="one"><a href="https://smsstriker.com/long-code-services.html">Long Code</a></li>
        <li><a href="https://smsstriker.com/contact-us.html">Contact</a></li>
        <li class="free"><a href="#"><span>Missedcall | Short URL</span>
        <span class="free-star">
        <i class="fa fa-star" aria-hidden="true"></i> FREE <i class="fa fa-star" aria-hidden="true"></i></span>
</a></li>
        
        
        
      </ul>
    </div>
  </div>
</nav>

<div class="banner">
<div class="col-sm-6 col-sm-offset-3 banner-form">
<div class="banner-form-inner">

   	<div class="text-center"> 
   	<h3>User Details</h3>
<table class="table borderless">
<tbody>
<tr><td>Name</td><td>:</td><td><?php echo $this->session->userdata('userName');?></td></tr>
<tr><td>Email</td><td>:</td><td><?php echo $this->session->userdata('userEmail');?></td></tr>
<tr><td>Mobile</td><td>:</td><td><?php echo $this->session->userdata('userMobile');?></td></tr>
<tr><td>No of SMS</td><td>:</td><td><?php echo $this->session->userdata('noofsms');?></td></tr>
<!--<tr><td>Price Per SMS</td><td>:</td><td><?php echo $this->session->userdata('GSMSPRICE');?></td></tr>
<tr><td>Actual Amount</td><td>:</td><td><?php echo $this->session->userdata('amount');?></td></tr>    
<tr><td>Coupon Discount</td><td>:</td><td><?php echo $this->session->userdata('amount') - $this->session->userdata('totalPrice');?></td></tr>  -->
<tr><td>Coupon Code</td><td>:</td><td><?php if($this->session->userdata('couponCode')) { echo $this->session->userdata('couponCode');}else{ echo 'Not Applicable';}?></td></tr> 

<tr><td>Offer Price Per SMS</td><td>:</td><td><?php echo $this->session->userdata('smsprice');?></td></tr>
<tr><td>Final Amount</td><td>:</td><td><?php echo $this->session->userdata('totalPrice');?> </td></tr>
<tr><td>Tax(18% )</td><td>:</td><td><?php echo $this->session->userdata('taxAmount');?></td></tr>
<tr><td>Grand Total</td><td>:</td><td> <?php echo $this->session->userdata('total_amount');?></td></tr>
</tbody>
</table>   
      

<form class="form-horizontal price-form-smsotp" method="post" action="<?php echo base_url();?>ppc/paymentProcess"  name="confirmOrder" >
 
 	<input type="hidden" name="totalAmount"   value="<?php echo $this->session->userdata('total_amount');?>">

        	<input type="submit"  name="confirmOrder" value="Order Confirm" class="btn btn-default sms-otp-submit-btn">  
        	<a href="<?php echo base_url();?>ppc/bulk-sms-services"> <button type="button" class="btn btn-default sms-otp-submit-btn">Cancel</button></a>
	
</form>  
</div>
</div>

</div>
</div>

<div class="clearfix"></div><br>


<div class="footer">
<div class="container">
<div class="footerup">
<div class="col-md-3 col-sm-6 footer-up-inner">
<h4>Bulk SMS Service</h4>
<ul>
<li><a href="http://smsstriker.com/bulk-sms-with-short-url.html">SMS with Short URL</a></li>
<li><a href="http://smsstriker.com/bulk-sms-with-missed-call-number.html">SMS with Missed Call Number</a></li>
<li><a href="http://smsstriker.com/international-sms.html">International SMS</a></li>
<li><a href="http://smsstriker.com/bulk-sms-with-excel-plugin.html">Excel Plugin</a></li>
<li><a href="">Developer</a></li>
<li><a href="http://smsstriker.com/bulk-sms-with-reports-analytics.html">Reports & Analytics</a></li>
</ul>
</div>

<div class="col-md-3 col-sm-6 footer-up-inner">
<h4>Short URL Service</h4>
<ul>
<li><a href="http://smsstriker.com/short-url-web.html">Web Short URL</a></li>
<li><a href="http://smsstriker.com/short-url-image.html">Image Short URL</a></li>
<li><a href="http://smsstriker.com/short-url-video.html">Video Short URL</a></li>
<li><a href="http://smsstriker.com/short-url-audio.html">Audio Short URL</a></li>
<li><a href="">Developer</a></li>
<li><a href="http://smsstriker.com/short-url-reports-and-analytics.html">Reports & Analytics</a></li>
</ul>
</div>

<div class="col-md-3 col-sm-6 footer-up-inner">
<h4>Long Code Service</h4>
<ul>
<li><a href="http://smsstriker.com/long-code-dedicated.html">Dedicated Long Code</a></li>
<li><a href="http://smsstriker.com/long-code-shared.html">Shared Long Code</a></li>
<li><a href="http://smsstriker.com/long-code-unlimited-key-words.html">Unlimited Key Words</a></li>
<li><a href="http://smsstriker.com/long-code-reply.html">Long Code Reply</a></li>
<li><a href="">Developer</a></li>
<li><a href="http://smsstriker.com/long-code-reports-and-analytics.html">Reports & Analytics</a></li>
</ul>
</div>

<div class="col-md-3 col-sm-6 footer-up-inner">
<h4>Bulk SMS Reseller</h4>
<ul>
<li><a href="http://smsstriker.com/white-label-panel.html">White Label Panel</a></li>
<li><a href="http://smsstriker.com/reseller-missed-call.html">Missed Call</a></li>
<li><a href="http://smsstriker.com/reseller-sms-with-short-url.html">Short URL</a></li>
<li><a href="http://smsstriker.com/reseller-exel-plugin.html">Excel Plugin</a></li>
<li><a href="">Developer</a></li>
<li><a href="http://smsstriker.com/reseller-reports-and-analytics.html">Reports & Analytic</a></li>
</ul>
</div>

<div class="col-md-12 social-icons">
<a href="https://www.facebook.com/smsstriker/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
<a href="https://twitter.com/smsstriker" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
<a href="https://plus.google.com/u/0/103708350739318484394" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
<a href="https://www.youtube.com/channel/UCqEm9n00y-XZ9LlQXvvvo4w" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
<a href="https://www.linkedin.com/company-beta/13266180/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
<a href="https://in.pinterest.com/strikersoft/smsstriker/" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
</div>


</div>  

<div class="footer-below">
<div class="col-md-6 col-sm-3">
<img src="https://www.smsstriker.com/ppc/img/logo.png" alt="footer-logo">
</div>
<div class="col-md-6 col-sm-9">
<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
<p>Disclaimers & Privacy Policy</p>
</div>

</div>
  
</div>
</div>


<!--scripting part -->
  <script src="https://www.smsstriker.com/ppc/js/jquery-min.js"></script>
  <script src="https://www.smsstriker.com/ppc/js/bootstrap.min.js"></script>
  <script src="https://www.smsstriker.com/ppc/js/slick.js"></script>
  <script src="https://www.smsstriker.com/ppc/js/style.js"></script>
  <script src="https://www.smsstriker.com/ppc/js/script.js"></script>  
 
</body>
  
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/949237873/?label=9PXPCN2SwXMQ8fDQxAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script> 
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68950345-2', 'auto');
  ga('send', 'pageview');
</script>



<script type="text/javascript">
$(function(){  
 	var userID = "<?php echo $userID;?>"; 
	if(userID != '0') {
		var urlstr="<?php echo base_url();?>API/smsplan/sentleademail.php?un="+userID+"&source=PPC";
 
		$.ajax({ 
			method: "GET",  
			url: urlstr,  
			async: true,  
			dataType: 'json', 
			success: function(data){
 
			}   
		});
	}

});  
</script>
</html>
