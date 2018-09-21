<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Register in smsstriker.com and free Trial bulk sms service In India">
<meta name="keywords" content="Register Smsstriker"> 
<link rel="icon" href="images-new/favicon.gif" type="image/gif">
<title>Register - Smsstriker.com</title>
<link rel="stylesheet" href="smsstriker-css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="smsstriker-css/style.css" type="text/css">
<link rel="stylesheet" href="smsstriker-css/font-awesome.min.css" type="text/css">
<script type="text/javascript" src="smsstriker-js/jquery.min.js"></script>
<script type="text/javascript" src="smsstriker-js/bootstrap.js"></script>
</head>
<body>
<div class="col-sm-12 col-md-12 col-xs-12 header-border padding-zero">
<div class="container01" data-include="nav">

</div>
</div>

<div class="clearfix"></div>
<div class="thank-you">
<div class="container">
<div class="col-md-4 col-md-offset-4">
<img alt="thankyou" src=smsstriker-img/register.png width="100%">
</div>
</div>
</div>




    <footer class="col-sm-12 col-md-12 col-xs-12 main-footer padding-zero" data-include="footer"></footer>
    <script type="text/javascript">
        $(function () {
            var includes = $('[data-include]');
            jQuery.each(includes, function () {
                var file = 'includes/' + $(this).data('include') + '.html';
                $(this).load(file);
            });
        });
    </script>
    <script src="smsstriker-js/jquery.validate.min.js"></script>
    <script src="smsstriker-js/additional-methods.min.js"></script>
    <script src="smsstriker-js/config.js"></script>
    <script type="text/javascript" src="smsstriker-js/registration/registration.js"></script>
    <script src="smsstriker-js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
    
    
    

<script> 
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68950345-2', 'auto');
  ga('send', 'pageview');

</script>

<?php if(!empty($_GET['un'])){?>
<input type="hidden" value="<?php if($_GET['un']!=''){ echo urldecode($_GET['un']);}else{echo '0';}?>" id="getun">

<script type="text/javascript">
    $(function(){
 
      var un=$("#getun").val();
      if(un!='0')
      {
   var urlstr="API/smsplan/sentleademail.php";
      $.ajax({
    	  method: "GET",
			url: urlstr,
			async: true,
			dataType: 'json',
			data:{un:un},
			success: function(data){
		console.log(data.message);
			
			if(data.code=='1')
			{
				$(".msgstatus").html(data.message);
				$(".msgstatus1,.msgstatus2").css("color",'green');
				
			}
			else
			{	
				if(data.message=='Alreadysent')
				{
					$(".msgstatus1").html("We've Already sent you an mail to");
					$(".msgstatus2").html("provided email address");
				}
				else
				{
					$(".msgstatus1").html("We've Already sent you an mail to");
					$(".msgstatus2").html("provided email address");
				}
				
				$(".msgstatus1,.msgstatus2").css("color",'red');
			}
			$(".msgstatus").html(data.message);
		//$(".thankh3top01").css("color",data.color);
		
		
			},
			error: function(){
			
				// console.log("Error");
				 
			}
	      });
      }
      else
      {
    	//$(".thankh3top01").html(data.message);
  		//$(".thankh3top01").css("color","red");   
      } 
    });
    </script>
    

 <?php }?>
    
</body>

</html>

	
	
