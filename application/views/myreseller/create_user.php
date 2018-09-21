

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
#add_user_form input, #add_user_form select{
      margin: 0px !important;
}
.form_error p{text-align:right;margin-top:5px;color:#ff0000;}
.selectht_01 select{ padding: 0px !important;
    height: 40px !important;}
</style>
  

 <script>
 $(document).ready(function(){
  $(function() {
    $(":file").filestyle({input: false});
  });
});
 </script>
 

  
  
  <body class="skin-blue sidebar-mini" style="margin-top:-20px !important;">
      <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
   
<?php if(isset($userExist)): ?>
	<div class="error_box">
	 	<?php echo $userExist; ?>
	</div>
    <div class="error_box">
 	All the fields are mandatory
</div>
<?php else: ?>

<?php endif; ?>
      <div class="content-wrapper" style="min-height:757px !important;">
	    <div class="col-md-12 col-sm-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
   <div class="panel panel-default" >
   <div class="panel-heading "><strong><span class="glyphicon glyphicon-th"></span> Create User</strong></div>
            
            
            
<div class="form">
    <section>
	<?php echo form_open('reseller/createUser',
					array('id' => 'add_user_form', 'name' => 'add_user_form', 'method' => 'post')
	); ?>
	
        
  <h4  style="color:#777; background-color:#F5F5F5; margin-bottom:20px !important;  line-height:25px; margin-top:0px; padding:5px 10px !important;">Account Details</h4>
  

                <fieldset>
				
                  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Username:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
                       
							<?php echo form_input(array('name' => 'username', 'id' => 'username', 'value' => set_value('username'), 'class' => 'form-control',)); ?>
					</div>
                    							<div class="form_error"><?php echo form_error('username'); ?></div>

                  </div>
                                   <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Password:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
                        
                        	<?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'value' => set_value('userpass'), 'class' => 'form-control' ));?>
                      </div>
                                              	<div class="form_error"><?php echo form_error('userpass'); ?></div>

              	</fieldset>
	       		
  <h4  style="color:#777; background-color:#F5F5F5; margin-bottom:20px !important;  line-height:25px;  padding:5px 10px !important;">Contact Details</h4>

              	<fieldset>
				 <div class="col-md-12">
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">First Name:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        
                        	<?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name'), 'class' => 'form-control' ));?>
                       </div>
                                               	<div class="form_error"><?php echo form_error('first_name'); ?></div>

					   </div>
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Last Name:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name'), 'class' => 'form-control' ));?>
                       </div>
                                               	<div class="form_error"><?php echo form_error('last_name'); ?></div>

					   </div>
					   </div>
					    <div class="col-md-12">
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Email:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email'), 'class' => 'form-control' ));?>
                     </div>
                                             	<div class="form_error"><?php echo form_error('email'); ?></div>

					 </div>
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="mobile">Mobile :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile'), 'class' => 'form-control' ));?>
                        	
                     </div>
                                          <div class="form_error"><?php echo form_error('mobile'); ?></div>

					 </div>
					 </div>
					  <div class="col-md-12">
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="mobile">organization  :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'organization', 'id' => 'organization', 'maxlength' => 45, 'value' => set_value('organization'), 'class' => 'form-control' ));?>
                     </div>
                                             	<div class="form_error"><?php echo form_error('organization'); ?></div>

					 </div>
                     
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="mobile">Land Line Number :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'mobileno_org', 'id' => 'mobileno_org', 'maxlength' => 45, 'value' => set_value('mobile'), 'class' => 'form-control' ));?>
                     </div>
                                             	<div class="form_error"><?php echo form_error('mobileno_org'); ?></div>

					 </div>
					  </div>
					  <div class="col-md-12">
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Address1:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1'), 'class' => 'form-control' ));?>
                 </div>
                 
                                         	<div class="form_error"><?php echo form_error('address1'); ?></div>
</div>

                  
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Address2:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span> 
                        	<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2'), 'class' => 'form-control' ));?>
                       </div>
                                               	<div class="form_error"><?php echo form_error('address2'); ?></div>

					   </div>
                        </div>
					  <div class="col-md-12">
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="city">City :</label>
    <div class="col-md-8 selectht_01 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 
                        	<?php echo form_dropdown('city_id', $cities, set_value('city_id'), 'class = "form-control"'); ?>
                        </div>
                        
                                                	<div class="form_error"><?php echo form_error('city_id'); ?></div>
						</div>
                        
                     <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Pin/Zip Code :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode'), 'class' => 'form-control' ));?>
                       </div>
                                               	<div class="form_error"><?php echo form_error('pincode'); ?></div>
</div>
</div>
             </fieldset>
   
	 

  <h4 style="color:#777; background-color:#F5F5F5; margin-bottom:20px !important;  line-height:25px;  padding:5px 10px !important;">SMS Credits</h4>

     		<fieldset>
     				  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="sms">No of sms :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 
                        
                        	<?php echo form_input(array('name' => 'no_of_sms', 'id' => 'no_of_sms', 'maxlength' => 45, 'value' => set_value('no_of_sms'), 'class' => 'form-control' ));?>
                    </div>
                                            	<div class="form_error"><?php echo form_error('no_of_sms'); ?></div>

					</div>
                    
                      <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Price :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><i class="fa fa-inr" style="font-size:14px;"></i></span> 
                        
                        	<?php echo form_input(array('name' => 'price', 'id' => 'price', 'maxlength' => 45, 'value' => set_value('price'), 'class' => 'form-control' ));?>
                      </div>
                                              	<div class="form_error"><?php echo form_error('price'); ?></div>

					  </div>
                       <div class="form-group col-md-12" style="margin-top:25px;">
           <div style="text-align:center;">                
              <?php echo form_submit(array('name' => 'register','value' => 'Create User', 'class' => 'btn btn-default'));?>
           </div>
        </div>
                     
                 </fieldset>   
                             <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div></div>
 
       
               
                


        <?php echo form_close(); ?> </div>
 
 
 
 
 </div>  
 </div>
 </section>
 </div>
 
 </div>
 </div>
 </div>
                              <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->

   <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
   
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/js/demo.js" type="text/javascript"></script>
    
    
    <script>
	     $(document).ready(function () {
			 
			 // number of sms
			 
            $('#no_of_sms').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			// pin code validation
			
            $('#pincode').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			// price validation
			
            $('#price').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			
			// landline number validation
			
            $('#mobileno_org').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			// mobil number validation
			
			
			
			
			
			$("#mobile").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#mobile').val().length >= 10 || $('#mobile').val().length == 10) {
            e.preventDefault();
        } });
			
			
			
			
			
			
			
			
			
			  });
			  </script>

  </body>
</html>

