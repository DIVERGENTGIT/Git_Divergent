<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="SMS Striker is one of the most successful company to delivered packed of services like Bulk SMS Services in Hyderabad, Banglore Delhi and more with 24/7 support" >
<meta name="keywords" content="Bulk SMS Provider,Bulk SMS,Services on Bulk SMS,Long Code Services,Short Url Services,Send Bulk SMS,How to send Bulk SMS, Transactional Bulk Sms,Promotional Bulk Sms,SMS Services in Bulk,Bulk SMS Providers."> 
<link rel="icon" href="<?php echo base_url();?>images-new/favicon.gif" type="image/gif">
<title> </title>
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/aos.css" type="text/css">

<style>
body {
	width:100%;
	height:100%; 
}
.new-user {
   
    background: #1f5489;
    padding: 11px;
    text-align: center;
    display:block;
    width: 75%; 
    margin: auto;
    font-size: 16px;
    font-weight: bold;
    color: #fff; 
    border-radius: 6px; 
    margin-top:10%;
   margin-bottom:10%;
}
 
a:hover {
    color: #fff;
}
</style>
</head>
<body>
<div class="col-sm-12 col-md-12 col-xs-12 header-border padding-zero">
<div class="container01" data-include="nav">



</div>
</div>
    <div class="clearfix"></div>
 
 
 
<section class="container01">
<article class="col-sm-12 col-md-12 col-xs-12 service-mid-content padding-zero"> 

<span class="invalid-login1"><?php if(isset($errmsg)){echo $errmsg;} ?></span>
 
<form class="login-form-smsstriker" id="validation-login" name="login_form" action="login" method="post">
	<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
		<div class="col-sm-4 col-md-4 col-xs-12 padding-zero"></div>
		<div class="col-sm-4 col-md-4 col-xs-12 padding-zero ">
			<a href="<?php echo  base_url(); ?>User/signup/<?php echo @$id; ?>" class="new-user">New User ? </a>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12 exit-new-user padding-zero"></div>
	</div>
</form>  
</article>

</section>
 
      <div class="clearfix"></div>
    <div class="clearfix"></div>
 

<footer class="col-sm-12 col-md-12 col-xs-12 main-footer padding-zero" data-include="footer">

</footer>
    <script type="text/javascript" src="<?php echo base_url();?>smsstriker-js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>smsstriker-js/bootstrap.js"></script>
    <script  src="<?php echo base_url();?>smsstriker-js/aos.js" defer></script>
   <script>
			AOS.init({
				easing: 'ease-out-back',
				duration: 1000
			});
		</script>
        <script>
			hljs.initHighlightingOnLoad();

			$('.hero__scroll').on('click', function(e) {
				$('html, body').animate({
					scrollTop: $(window).height()
				}, 1200);
			});
		</script>
    
    
    
    <script type="text/javascript">

    $(function () {
    	var base_url = "<?php echo base_url();?>";
        var includes = $('[data-include]');

        jQuery.each(includes, function () {
            var file = base_url+'includesview/' + $(this).data('include') + '.html';
            $(this).load(file);  
            
        });
    });

    $(document).ready(function () {
        $(".product-hover, .sub-menu-list02").hover(function (event) {
            $(".sp-layer").toggle();
        });

        $(".subemenumob").click(function () {
            $(".sub-menu-list02").toggleClass("mobsub-menu");

        });

    });
    </script>
    <style>
        #about {
            color: #000;
        }
    </style>

</body>
  
</html>
