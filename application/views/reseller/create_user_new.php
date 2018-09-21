<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SMS Striker</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url();?>assets/css/striker.min.css" rel="stylesheet" type="text/css" />
   
   
   
    <link href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/custom-css.css" rel="stylesheet" type="text/css">

<style type="text/css">
hr {
  -moz-border-bottom-colors: none;
  -moz-border-image: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  border-color: #ECF0F5 -moz-use-text-color #ECF0F5;
  
  color:#ECF0F5;
  border-style: solid none;
  border-width: 1px 0;
  margin: 18px 0;
}
.control-label{ text-align:right;}
</style>
  

 <script>
 $(document).ready(function(){
  $(function() {
    $(":file").filestyle({input: false});
  });
});
 </script>
 
 
 
  </head>
  <body>
    <div class="wrapper">

      
      


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       
        <section class="content" style="padding-left:0px !important;">
        <div class="col-md-12 col-md-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
   <div class="panel panel-default">
 <div class="panel-heading"><strong><span class="glyphicon glyphicon-th" style="margin-top:50px !important; padding-top: 0px !important;"></span> Reseller</strong></div>
			  
			  
			  
			  
         <div class="panel panel-default col-md-12" >
        
       
                      <div class="panel panel-default col-md-12"  style="top:10px;">
                     
                     
                     
                   	<?php echo form_open('reseller/createUser',
					array('id' => 'add_user_form', 'name' => 'add_user_form', 'method' => 'post','class'=>'form-inline')
	); ?>   
  
  <div class="col-lg-10"  >
          <h4  style="color:#777; margin-bottom:10px !important; background-color:#F5F5F5; line-height:25px;  padding:5px 10px !important;">Account Details</h4>
        </div>
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Username:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
     <?php echo form_input(array('name' => 'username', 'id' => 'username', 'value' => set_value('username'), 'class' => 'form-control',)); ?>
    	<div class="form_error"><?php echo form_error('username'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Password :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
   <?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'value' => set_value('userpass'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('userpass'); ?></div>
     </div>
  </div>
 
 
 
 
  <div class="clearfix"></div>
 
 
 
 
 
 

 <div class="col-lg-10" >
  <h4  style="color:#777;   margin-bottom:20px !important; background-color:#F5F5F5; line-height:25px;  padding:5px 10px !important;">Contact Details</h4>
 </div>
 
 
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">First Name:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
  <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name'), 'class' => 'form-control' ));?>
      <div class="form_error"><?php echo form_error('first_name'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Last Name:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
   <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('last_name'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>

  
 
  
   <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Email:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span> 
   <?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('email'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Mobile:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class=" glyphicon glyphicon-phone"></span></span> 
  <?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('mobile'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
 
 
 
 
 <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Address1:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span> 
   <?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address1'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Address2:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span> 
   	<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address2'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
 
 
 <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">City:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span> 
   	<?php echo form_dropdown('city_id', $cities, set_value('city_id'), 'class = "form-control"'); ?>
                        	<div class="form_error"><?php echo form_error('city_id'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Pin/Zip Code:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 
    <?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('pincode'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
  
  
  
 <div class="col-lg-10" >
  <h4  style="color:#777; background-color:#F5F5F5; margin-bottom:20px !important;  line-height:25px;  padding:5px 10px !important;">SMS Credits</h4>
 </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">No.of SMS :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 
   <?php echo form_input(array('name' => 'no_of_sms', 'id' => 'no_of_sms', 'maxlength' => 45, 'value' => set_value('no_of_sms'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('no_of_sms'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Price :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span> 
    <?php echo form_input(array('name' => 'price', 'id' => 'price', 'maxlength' => 45, 'value' => set_value('price'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('price'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
 
 <div class="form-group col-md-12">
   
    <div class="col-md-8 " style="float:right;;">
     <?php echo form_submit(array('name' => '','value' => 'Create User', 'class' => 'btn btn-default'));?>
    </div>
  </div>       
 
   <?php echo form_close(); ?>
 
        </div>
    
     <div class="col-md-12" style="padding:20px;"></div>   
    
      
  </div>
        
        
        	
        
        
           
        </div>
        </section>
        

                   
<div class="clearfix"></div>




           <!--footer starts-->
 
     
     
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
   
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   
   

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <!-- AdminLTE for demo purposes -->
    
  </body>
</html>
