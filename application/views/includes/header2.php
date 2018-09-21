   <?php 
			 $userid= $this->session->userdata('user_id');

$mverifyquery= mysql_query('SELECT mverify FROM users where user_id='.$userid.' order by user_id desc LIMIT 1');
			 $profile=mysql_fetch_array($mverifyquery);
			 
			 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	  
	  <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
 <link href="<?php echo base_url(); ?>assets/css/lib/new-css.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/custom-css.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/striker.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome Icons -->
   <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    
    <!-- jvectormap -->
   <link href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css" type="text/css" rel="stylesheet">
    
        
  
<link href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link href="<?php echo base_url();?>assets/css/bootstrap-combined.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen"
	href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
	
    <style type="text/css">
a.sidebar-toggle {
    display: none !important;
}

.skin-blue .sidebar-menu>li>a {
    border-left:0px !important;
}



.img-circle{ height:30px !important; width:30px !important;}


@media (max-width: 768px) {
	a.sidebar-toggle {
    display:inherit !important;
	
	}
    
    </style>
<header class="col-sm-12 padding_zero main-header top_header">
<div class="header_padding">
<div class="col-sm-2 padding_lrt0 logo_header">
        <!-- Logo -->
        <?php if($profile['mverify']==0): ?>
   
      <a href="#myModal" data-toggle="modal">  <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>images_n/logo.png" style="width:175px;margin-top: 15px; height:40px;"></span>
        </a>
        
       <?php else: ?>
           <a href="<?php echo base_url(); ?>index.php/campaign/normalSMS">
 <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>images_n/logo.png" style="width:175px;margin-top: 15px; height:40px;"></span>
        </a>
	   
	   <?php endif;?>
</div>
<div class="col-sm-10 col-xs-12 padding_lrt0 profil_bar padding_zero">
<div class="col-sm-6 col-xs-12">
<h5 class="sms_avbl">Available Credits : <span><?php echo number_format($available_credits,0); ?>
</span></h5>

</div>
<div class="col-sm-6 col-xs-12">

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <a href="<?php echo base_url(); ?>index.php/campaign/normalSMS" style="line-height:50px;color:#fff; margin-left:20px;">
            <span> <i class="fa fa-home"></i>&nbsp;Home</span>
          </a>-->
          
         
          

          <!-- Navbar Right Menu -->
           <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              
              <?php 
			 $smallquery= mysql_query('SELECT profile_img,profile_backgroundimg FROM profile_images where user_id='.$userid.' order by id desc LIMIT 1');
			 $row=mysql_fetch_array($smallquery);


$mverifyquery= mysql_query('SELECT mverify FROM users where user_id='.$userid.' order by user_id desc LIMIT 1');
			 $profile=mysql_fetch_array($mverifyquery);

if($profile['mverify']==0): ?>

			 
              <!-- Tasks: style can be found in dropdown.less -->
              
              <li style="background:#0C78B7;">
			 <a href="#myModal" data-toggle="modal"> old version </a>
			  </li>
                             <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu" style=" ">
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if(!empty($row['profile_img'])):?>
                  <img src="<?php echo base_url(); ?>profile_img/<?php echo $row['profile_img']; ?>" class="user-image" alt="User Image"/>
                  <?php endif;?>
                  <span class="hidden-xs" style="font-size: 16px;">  <?php   echo  $this->session->userdata('username'); ?></span>
                </a>
                
                <ul class="dropdown-menu" style=" ">
                  <!-- User image -->
                  <li class="user-header">
                   <?php if(!empty($row['profile_img'])):?>
                    <img src="<?php echo base_url(); ?>profile_img/<?php echo $row['profile_img']; ?>" class="img-circle" style="width:70px !important; height:70px !important; " alt="User Image" />
                        <?php endif;?>
                    <p>
              <?php   echo  $this->session->userdata('username'); ?>
                    </p>
                  </li>
                    
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                     <!-- <a href="<?php echo base_url(); ?>index.php/myaccount/index" class="btn btn-default btn-flat">Profile</a>-->
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

              <?php else: ?>
			   <li style="background:#0C78B7;">
			 <a href="http://www.smsstriker.com/old/index.php/campaign/normalSMS">Old Version</a>
			  </li>
			
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu" style=" ">
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if(!empty($row['profile_img'])):?>
                  <img src="<?php echo base_url(); ?>profile_img/<?php echo $row['profile_img']; ?>" class="user-image" alt="User Image"/>
                  <?php endif;?>
                  <span class="hidden-xs" style="font-size: 16px;">  <?php   echo  $this->session->userdata('username'); ?></span>
                </a>
                
                <ul class="dropdown-menu" style=" ">
                  <!-- User image -->
                  <li class="user-header">
                   <?php if(!empty($row['profile_img'])):?>
                    <img src="<?php echo base_url(); ?>profile_img/<?php echo $row['profile_img']; ?>" class="img-circle" style="width:70px !important; height:70px !important; " alt="User Image" />
                        <?php endif;?>
                    <p>
              <?php   echo  $this->session->userdata('username'); ?>
                    </p>
                  </li>
                    
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>myaccount/index" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li><?php endif; ?>
              <!-- Control Sidebar Toggle Button -->
              <!--  <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
          </div>

        </nav>
<div class="sms_avb2">
<?php 
error_reporting(0); 
echo  date("D d M Y g:i A");     
?></div>
		</div>
        </div>
      </header>
      
          <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" style="float:right; " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style=" text-align:center; color:#fff; font-size:15px;">Notice</h4>
                </div>
                <div class="modal-body">
                    <p style=" color:#D65A24;"> Please Verify Your Mobile Number for authentication and further Communication Purpose. <br /><br />
                    
                 <span> Note :</span>OTP(One Time Password) Will be Sent Your Mobile Number. </p>
                </div>
                <div class="modal-footer">
                 <button class="btn btn-default btn-sm " data-toggle="modal" data-target="#largeModal" style="float:right;   margin-right: 50px;"> OK	</button>
<!--                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
-->                </div>
            </div>
        </div>
    </div>
