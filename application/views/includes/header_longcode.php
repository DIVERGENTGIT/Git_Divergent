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
        <a href="<?php echo base_url();?>index.php/missedcall/index">
 <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>images_n/logo.png" style="width:175px;margin-top: 15px; height:40px;"></span>
        </a>
</div>
<div class="col-sm-10 padding_lrt0 profil_bar padding_zero">
<div class="col-sm-6">
<h5 class="sms_avbl">Available Credits : <span><?php echo number_format($available_credits,0); ?>
</span></h5>

</div>
<div class="col-sm-6">

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
			 $userid= $this->session->userdata('user_id');
			 $smallquery= mysql_query('SELECT profile_img,profile_backgroundimg FROM profile_images where user_id='.$userid.' order by id desc LIMIT 1');
			 $row=mysql_fetch_array($smallquery);


$mverifyquery= mysql_query('SELECT mverify FROM users where user_id='.$userid.' order by user_id desc LIMIT 1');
			 $profile=mysql_fetch_array($mverifyquery);

if($profile['mverify']==0): ?>

			 
              <!-- Tasks: style can be found in dropdown.less -->
       
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
                     <a href="<?php echo base_url(); ?>index.php/missedcall/changepassword" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

              <?php else: ?>
		
			
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
                      <a href="<?php echo base_url(); ?>index.php/missedcall/changepassword" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>index.php/index/index" class="btn btn-default btn-flat">Sign out</a>
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
echo  date("l jS M y g:i A.");     
?></div>
		</div>
        </div>
      </header>
      
     