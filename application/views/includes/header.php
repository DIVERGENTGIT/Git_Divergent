  <?php 
  error_reporting(0);
  if(!$this->session->userdata('user_id'))
  {
  redirect(base_url());
  }
	$userid= $this->session->userdata('user_id');
        //$sql3="update  order_numbers set  status=0 where status=1 and user_id=$user_id";
        //$this->db->query($sql3);
        //$sql3="update  longcode_tmp set  status=0 where status=1 and user_id=$user_id";
        //$this->db->query($sql3);

	$this->db->select('mverify,dnd_check,no_ndnc,longcode_credits');
	$this->db->from('users');
	$this->db->where('user_id', $userid);
	$query = $this->db->get();
	$row = $query->row_array();
 

	$mverify=$row['mverify'];
	$dnd_check=$row['dnd_check'];
	$no_ndnc=$row['no_ndnc'];

	$longcode_credits=$row['longcode_credits'];


//var_dump($u); 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

	  <link rel="icon" href="<?php echo base_url(); ?>images_n/logo.png" type="image/png" sizes="16x16">
	  <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
 <link href="<?php echo base_url(); ?>assets/css/lib/new-css.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/lib/admin-new-style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom-css.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/striker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/timepicker-ui.css" type="text/css">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome Icons -->
   <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    
    <!-- jvectormap -->
   <link href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>js/jquery.min.js"></script>

  <script src="<?php echo base_url();?>assets/js/jquery-ui.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui-timepicker-addon-i18n.min.js" type="text/javascript"></script>
  <script>
    // bridge them
    $.widget.bridge('uibutton', $.ui.button);
    $.widget.bridge('uitooltip', $.ui.tooltip);
  </script>
   <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script>
$(document).ready(function(){
	
    $(".welcometopdiv").click(function(){
       
		$(this).toggleClass('toggletopwel');
		$(".welcomebottomdiv").toggleClass('togglebotomwel');
		$(".welcometext").toggleClass('togglewel');
    });
	 $(".bottomarrow").click(function(){
      
		$(".welcometopdiv").toggleClass('toggletopwel');
		$(".welcomebottomdiv").toggleClass('togglebotomwel');
		$(".welcometext").toggleClass('togglewel');
    });
	$('.navbar-nav > li .submenuli').removeClass('leftmenutoggle');
	$(".navbar-nav > li .submenuli").click(function(){
      
		$(this).toggleClass('leftmenutoggle');
		
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){ 
// window.onload = function() {  
    //if(!window.location.hash) {
     //   window.location = window.location + '#loaded';
        //window.location.reload();
   // }  
//} 
$('#to_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
		 
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth()));
                
       //$("#to_date").datepicker("option", 'minDate', selectedDate);
                $("#from_date").datepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#from_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
	
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
             //   var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() - 1));
               
              //  $("#to_date").datepicker("option", 'minDate', monthsAddedDate);
                $("#to_date").datepicker("option", 'minDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
   </head>
   <!--
  <body oncontextmenu="return false;">
  -->
<!--
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero" style="padding-top: 8px;padding-bottom: 6px;background: #f1f1f3;">
<div class="col-sm-8 col-md-8 col-xs-12" style="padding-left: 20px !important;">
<p style="margin-bottom:0px;margin-bottom: 0px;color: #FF727D;font-weight: bold;font-size: 11px;"> 
 <marquee>Older version will be available only till 10-June-2017. </marquee></p>
</div>
<div class="col-sm-4 col-md-4 col-xs-12 oldversiondiv" style="padding-right: 20px !important;">

<h5 class="sms_avbl" style="margin-top:0px;"><a href="<?php echo base_url(); ?>old/campaign/normalSMS">Old Version</a></h5>

</div>
</div> -->
<header class="col-sm-12 col-md-12 col-xs-12 padding_zero main-header top_header">
<div class="header_padding">
<div class="col-sm-3 col-md-3 col-xs-12 padding_lrt0 logo_header">

        <!-- Logo -->
        <?php if($mverify==0): ?>
   
      <a href="#myModal" class="logo-padding" data-toggle="modal">  <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>images_n/logo.png"></span>
        </a>
        
       <?php else: ?>
           <a href="<?php echo base_url(); ?>campaign/normalSMS" class="logo-padding">
 <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>images_n/logo.png"></span>
        </a>
	   
	   <?php endif;?>
</div>
<div class="col-sm-9 col-md-9 col-xs-12 padding_lrt0 profil_bar padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-8 col-md-8 col-xs-12">
<h5 class="sms_avbl">Available SMS Credits : <span><?php echo number_format($available_credits,0); ?>
</span></h5>
<h5 class="sms_avbl">Longcode Credits : <span><?php echo number_format($longcode_credits,0); ?>
</span></h5>
<h5 class="sms_avbl">Short URL Credits : <span><?php echo number_format($shorturlCredits,0); ?>
</div>
<div class="col-sm-4 col-md-4 col-xs-12">

 <?php 

if($mverify==0): ?>
<div class="welcometext">
<div class="welcometopdiv" data-toggle="collapse" data-target="#topmenuacc">
<img src="<?php echo base_url(); ?>images-new/welcome-icon.png" class="welcomeimg"> <span class="usernametext">Welcome To <?php   echo  $this->session->userdata('username'); ?></span>
</div>
<div class="welcomebottomdiv collapse" id="topmenuacc">
<ul class="user-listli">


<li><a href="<?php echo base_url(); ?>myaccount/index">My Profile</a></li>

<li><a href="<?php echo base_url(); ?>myaccount/myprice">My Price</a></li>

<li><a href="<?php echo base_url(); ?>myaccount/changepassword">Change Password</a></li>

  

<li><a href="<?php echo base_url(); ?>index.php/myaccount/userLogout"><span class="spanlogout">Logout</span></a></li>
</ul>
<img src="<?php echo base_url(); ?>images-new/bottomarrow.png" class="bottomarrow" data-toggle="collapse" data-target="#topmenuacc">
</div>     
</div>

  
              <?php else: ?>
			  <div class="welcometext">
<div class="welcometopdiv" data-toggle="collapse" data-target="#topmenuacc">
<img src="<?php echo base_url(); ?>images-new/welcome-icon.png" class="welcomeimg"> <span class="usernametext">Welcome To <?php   echo  $this->session->userdata('username'); ?></span>
</div>
<div class="welcomebottomdiv collapse" id="topmenuacc">
<ul class="user-listli">


<li><a href="<?php echo base_url(); ?>myaccount/index">My Profile</a></li> 

<li><a href="<?php echo base_url(); ?>myaccount/myprice">My Price</a></li>

<li><a href="<?php echo base_url(); ?>myaccount/changepassword">Change Password</a></li>

<!-- <li><a href="<?php echo base_url(); ?>old/campaign/normalSMS">Old UI</a></li>  -->

  
 <!-- <li>  <a  href="<?php echo base_url(); ?>old/campaign/normalSMS">Old Version</a> </li>  -->
<li><a href="<?php echo base_url(); ?>index.php/myaccount/userLogout"><span class="spanlogout">Logout</span></a></li>
</ul>
<img src="<?php echo base_url(); ?>images-new/bottomarrow.png" class="bottomarrow" data-toggle="collapse" data-target="#topmenuacc">
</div>
</div>
			  
			  <?php endif; ?>


		</div>
        </div>
        <div class="col-sm-12 col-md-12 col-xs-12 mrgtop12 mrg-btm10">
        <div class="col-sm-8 col-md-8 col-xs-12 padding_zero">
        <?php    if((@$no_ndnc==1 && @$dnd_check==1)|| (@$no_ndnc==0)):?>
        <marquee class="marquee_class">Promotional Messages should be sent between 9:00 am to 9:00 pm only.</marquee>
        <?php endif;?>

        </div>
        
        <div class="col-sm-4 col-md-4 col-xs-12 oldversiondiv sms_avb2">

<?php 

//echo date("D d M Y g:i A");     
?></div>
        </div>
        </div>
      </header>
      
          <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" style="float:right; " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   
                </div>
                <div class="modal-body">
                    <p style="color:#D65A24;"> Please Verify Your Mobile Number for authentication and further Communication Purpose. <br /><br />
                    
                 <span> Note :</span>OTP(One Time Password) Will be Sent Your Mobile Number. </p>
                </div>
                <div class="modal-footer">
                 <button class="submit_btn" data-toggle="modal" data-target="#largeModal" style="float:right;"> OK	</button>
               </div>
            </div>
        </div>
    </div>


