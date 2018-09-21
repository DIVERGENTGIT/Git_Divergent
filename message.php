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
    
    
    

 <?php if(!empty($_GET['id'])){?>
<input type="hidden" value="<?php if($_GET['id']!=''){ echo urldecode($_GET['id']);}else{echo '0';}?>" id="getid">
 <?php }?>
<?php if(!empty($_GET['ud'])){?>
<input type="hidden" value="<?php if($_GET['ud']!=''){ echo urldecode($_GET['ud']);}else{echo '0';}?>" id="getud">

 <?php }?>
<link rel="stylesheet" href="css_newui/style1.css" type="text/css">
<link rel="stylesheet" href="css_newui/style.css" type="text/css">
<link rel="stylesheet" href="css_newui/bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/flip.js"></script>
<script src="js/config.js"></script> 
<script type="text/javascript">
    $(function(){
   // var baseurl="http://www.smsstriker.com/";
     
      var id=$("#getid").val();
      if(id!='0')
      {

   var urlstr=baseurl+"contact_form.php";
      $.ajax({
    	  method: "POST",
			url: urlstr,
			async: true,
			dataType: 'json',
			data:{id:id,sendemail:"sendemail"},
			success: function(data){
		console.log(data.message);
		//$(".thankh3top01").html(data.message);
		//$(".thankh3top01").css("color",data.color);
			},
			error: function(){
			
				 console.log("Error");
				 
			}
	      });
      }
      else
      {
    	//$(".thankh3top01").html(data.message);
  		//$(".thankh3top01").css("color","red");   
      } 
      
      // registration
      var ud=$("#getud").val();
      if(ud!='')
      {
    	  var urlstr=baseurl+"registrationemail.php";
    	  
      $.ajax({
    	  method: "POST",
			url: urlstr,
			async: true,
			dataType: 'json',
			data:{ud:ud,sendemail:"registration"},
			success: function(data){
 
		
		//$(".thankh3top01").html(data.message);
		//$(".thankh3top01").css("color",data.color);
		
			},
			error: function(){
			
				 console.log("Error");
				 
			}
	      });
      }
      else
      {
    	       // $(".thankh3top01").html(data.message);
  		//$(".thankh3top01").css("color","red");   
      }
      
    });
    </script>
    


<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>


<script src="js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
    
<script> 
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68950345-2', 'auto');
  ga('send', 'pageview');

</script>
</body>

</html>

	
	
