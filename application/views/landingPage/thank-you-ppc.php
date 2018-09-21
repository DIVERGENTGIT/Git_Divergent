<html>
<head>
<meta name="language" content="en-uk, english">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Register in smsstriker.com and free Trial bulk sms service In India">
<meta name="keywords" content="Register Smsstriker"> 
<link rel="icon" href="https://www.smsstriker.com/smsstriker-img/fevicon.png" type="image/png" sizes="16x16"> 
<title>Register - Smsstriker.com</title>
<link rel="stylesheet" href="https://www.smsstriker.com/smsstriker-css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="https://www.smsstriker.com/smsstriker-css/style.css" type="text/css">
<link rel="stylesheet" href="https://www.smsstriker.com/smsstriker-css/font-awesome.min.css" type="text/css">
<script type="text/javascript" src="https://www.smsstriker.com/smsstriker-js/jquery.min.js"></script>
<script type="text/javascript" src="https://www.smsstriker.com/smsstriker-js/bootstrap.js"></script>
</head>
<body>
<!-- 
<div class="col-sm-12 col-md-12 col-xs-12 header-border padding-zero">
<div class="container01" data-include="nav">

</div>
</div>

 <span style="color:red"; id="failedmsg"> </span> 
<div class="clearfix"></div>
<div class="thank-you">
<div class="container">
<div class="col-md-4 col-md-offset-4">
<img alt="thankyou" src='https://www.smsstriker.com/smsstriker-img/register.png' width="100%">
</div>
</div>
</div>



    <footer class="col-sm-12 col-md-12 col-xs-12 main-footer padding-zero" data-include="footer"></footer>
-->
    <script src="https://www.smsstriker.com/smsstriker-js/jquery.validate.min.js"></script>
    <script src="https://www.smsstriker.com/smsstriker-js/additional-methods.min.js"></script>
    <script src="https://www.smsstriker.com/smsstriker-js/config.js"></script> 
    <script src="https://www.smsstriker.com/smsstriker-js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
    
       <script type="text/javascript">
        $(function () {
            var includes = $('[data-include]');
            jQuery.each(includes, function () {
                var file = 'includes/' + $(this).data('include') + '.html';
                $(this).load(file);
            });
        });
    </script> 


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

  
<!-- Google Code for smsstriker Conversion Page --> 
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 949237873;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "9PXPCN2SwXMQ8fDQxAM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
  
 
<script type="text/javascript" >
$( document ).ready(function() {
	var status = 0;
	var trn_id = "<?php echo $transaction_id;?>";
	var trnStatus = "<?php echo $trnStatus;?>"; 
        var urlvar="<?php echo base_url();?>checkMail.php?accondDetails=1&trnID="+trn_id; 
 
		  $.ajax({
			type:"GET",
			url:urlvar,   
			success:function(response)
			{
				status = 1;
			} 
		});  
		  
		  
	var verified = 0;
	var trn_id = "<?php echo $transaction_id;?>";  
        var urlvar="<?php echo base_url();?>checkMail.php?payment=payment&trn_id="+trn_id;   
 
		 $.ajax({
			type:"GET",
			url:urlvar, 
			success:function(response)
			{    
				status = 1;  
				if(status == 1) {
					//location.href = "<?php echo base_url();?>thank-you-ppc.php?tn="+trn_id+"&rm="+trnStatus;
					location.href = "<?php echo base_url();?>thank-you-ppc.php";  
				}else{
					//location.href = "<?php echo base_url();?>thank-you-ppc.php?tn="+trn_id+"&rm="+trnStatus;
					location.href = "<?php echo base_url();?>thank-you-ppc.php";  
				}  
			},error: function(error){  
				 //location.href = "<?php echo base_url();?>thank-you-ppc.php?tn="+trn_id+"&rm="+trnStatus;
				 location.href = "<?php echo base_url();?>thank-you-ppc.php";
			}  
		});      
 
 	
  	 	
 	 
 
	
});
</script>
 
    
</body>

</html>

	
	
