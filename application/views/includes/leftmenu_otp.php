<?php
if($profile['mverify']==0): ?>
<div class="col-sm-12 padding_zero left_menu01">
<div class="col-sm-3 col-md-3 col-xs-12 menutablft padding_zero">
<nav class="navbar navbar-default custom-menu">
  <div class="container-fluid padding-zero">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>  
        <span class="icon-bar"></span>
      </button>
     
    </div>
                          
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="padding-zero collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	   <li><span class="submenuli" data-toggle="collapse" data-target="#smsmenuacc">
		<img src="<?php echo base_url(); ?>images/sms-icon.png" class="nav-menu-icons">SMS Services</span>
		<div class="collapse" id="smsmenuacc">
<ul class="left-submenu">       
	<li><a href="#myModal" data-toggle="modal">Normal SMS</a></li> 
	<li><a href="#myModal" data-toggle="modal">File SMS</a></li>
	<li><a href="#myModal" data-toggle="modal">Custom SMS</a></li> 
	<li><a href="#myModal">Unicode SMS</a></li>
	<!-- ADDED ON 2017-01-30
	<li><a href="<?php echo base_url();?>customized/newVariableSMS">Custom</a></li>  -->
	<li><a href="#myModal" data-toggle="modal">Bulk URL</a></li>
		   
	  </ul>
</div>
</li>

 <li><span class="submenuli" data-toggle="collapse" data-target="#longmenuacc">
		<img src="<?php echo base_url(); ?>images/longcode-icon.png" class="nav-menu-icons">Long Code</span>
		<div class="collapse" id="longmenuacc">
<ul class="left-submenu">       

		   <li><a href="#myModal" data-toggle="modal">Dedicated Number</a></li>

		   <li><a href="#myModal" data-toggle="modal">Shared Number</a></li>
	  </ul>
</div>
</li>	
	<li>
			<span class="submenuli" data-toggle="collapse" data-target="#ftpcampaign"><img src="<?php echo base_url();?>images/reports-icon.png" class="nav-menu-icons">Service Reports</span>
			<div class="collapse" id="ftpcampaign">
				<ul class="left-submenu">
					<li><a href="#myModal" data-toggle="modal">SMS Reports</a></li>
					<li><a href="<?php echo base_url();?>longcode/reports">Long Code reports</a></li>
					<li><a href="#myModal" data-toggle="modal">Short URL reports</a></li>
 					<li><a href="#myModal" data-toggle="modal">Ftp reports</a></li>
 					
 					<li><a href="#myModal" data-toggle="modal">Missed Call reports</a></li>
 					
 				</ul>  
 			</div>	        
 		</li>	
        <li><a href="#myModal" data-toggle="modal"><img src="<?php echo base_url();?>images/api-integration-icon.png" class="nav-menu-icons">API Integration</a></li>
      
		<li><span class="submenuli" data-toggle="collapse" data-target="#managemenuacc"><img src="<?php echo base_url();?>images/manage-icon.png" class="nav-menu-icons">Manage</span>
		<div class="collapse" id="managemenuacc">   
<ul class="left-submenu">
	  <li><a href="#myModal" data-toggle="modal">Template</a></li>
	   <li><a href="#myModal" data-toggle="modal">Group</a></li>
	    <li><a href="#myModal" data-toggle="modal">Sender ID</a></li>
		 <li><a href="#myModal" data-toggle="modal">Users</a></li>
	  </ul>
</div>
		</li>
		<li><span class="submenuli" data-toggle="collapse" data-target="#paymentmenuacc"><img src="<?php echo base_url();?>images/payments-icon.png" class="nav-menu-icons">Payments</span>
		<div class="collapse" id="paymentmenuacc">
<ul class="left-submenu">

<li><a href="#myModal">Longcode Package</a></li>
<li><a href="#myModal">My Order</a></li>
<li><a href="#myModal">Balance History</a></li>
<li><a href="#myModal">Order history</a></li>
  
</ul>
</div> 
		
		</li>
		
		   
		    
		 
		<!-- ADDED ON 2017-02-13 
		<li><a href="<?php echo base_url(); ?>campaign/bulkShorturl"><img src="<?php echo base_url();?>images/longcode-icon.png" class="nav-menu-icons">Bulk Shorturl</a></li> 
<li><a href="<?php echo base_url(); ?>campaign/shorturlReports"><img src="<?php echo base_url();?>images/reports-icon.png" class="nav-menu-icons">Bulk Shorturl Reports</a></li>
		  -->  

			     
       </ul>    
    
    </div>
  </div>
</nav>     




      </div>
      <?php endif;?>
	  
      
        <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <p style="color:#D65A24;">
                    Please Verify Your Mobile Number for authentication and further Communication Purpose. <br /><br />
                 <span> Note :</span>OTP(One Time Password) Will be Sent Your Mobile Number </p>
                </div>
                <div class="modal-footer">
                
             <button class="btn btn-default btn-sm " ata-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#largeModal" style="float:right;   margin-right: 50px;"> OK	</button>
         <!--     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>-->
            </div>
            </div>
        </div>
    </div>
	
<div id="largeModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content col-sm-12 col-xs-12 col-md-12 padding_zero">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   
                </div>
                <div class="modal-body col-sm-12 col-xs-12 col-md-12 padding_zero">
                    <div class="col-sm-12 col-xs-12 col-md-12">
  <?php echo form_open('myaccount',
					array('id' => 'edit_profile_form', 'name' => 'edit_profile_form', 'method' => 'post')
	); ?>
        <div class="col-sm-12 col-xs-12 col-md-12">
           <div class="col-sm-6 col-md-6 col-xs-12 form-div">
    <div class="col-sm-5 col-md-5 col-xs-12"><label for="text">First name</label></div>
	<div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name') ? set_value('first_name') : (isset($profile['first_name']) ? $profile['first_name']  : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('first_name'); ?></div></div>  </div>
  <div class="col-sm-6 col-md-6 col-xs-12 form-div">
   <div class="col-sm-5 col-md-5 col-xs-12"> <label for="pwd">Last name</label></div>
	<div class="col-sm-7 col-md-7 col-xs-12"><?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name') ? set_value('last_name') : (isset($profile['last_name']) ? $profile['last_name'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('last_name'); ?></div> </div> </div>
        </div>
        
        <div class="col-sm-12 col-md-12 col-xs-12">
           <div class="col-sm-6 col-md-6 form-div col-xs-12">
    <div class="col-sm-5 col-md-5 col-xs-12"><label for="text">Adress</label></div>
	<div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1') ? set_value('address1') : (isset($profile['address1']) ? $profile['address1']:""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address1'); ?></div></div>
							</div>
  <div class="col-sm-6 col-md-6 form-div col-xs-12">
   <div class="col-sm-5 col-md-5 col-xs-12"> <label for="pwd">Address 2</label></div>
   <div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2') ? set_value('address2') : (isset($profile['address2']) ? $profile['address2']:""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address2'); ?></div></div>  </div>
        </div>
        
        <div class="col-sm-12 col-md-12 col-xs-12">
           <div class="col-sm-6 col-md-6 form-div col-xs-12">
    <div class="col-sm-5 col-md-5 col-xs-12"><label for="text">Landline</label></div>
	<div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'mobileno_org', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobileno_org') ? set_value('mobileno_org') : (isset($profile['mobileno_org']) ? $profile['mobileno_org'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('mobileno_org'); ?></div></div>
							</div>
  <div class="col-sm-6 col-md-6 form-div col-xs-12">
   <div class="col-sm-5 col-md-5 col-xs-12"> <label for="pwd">Phone No</label></div>
   <div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile') ? set_value('mobile') : (isset($profile['mobile']) ? $profile['mobile'] : ""), 'class' => 'form-control' ));?>
      <div class="form_error"><?php echo form_error('mobile'); ?></div></div>
							</div>
        </div>
        
        
        <div class="col-sm-12 col-md-12 col-xs-12">
           <div class="col-sm-6 col-md-6 form-div col-xs-6">
    <div class="col-sm-5 col-md-5 col-xs-12"><label for="text">Email</label></div>
	<div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email') ? set_value('email') : (isset($profile['email']) ? $profile['email'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('email'); ?></div></div>  </div>
                            
                            
                            <div class="col-sm-6 col-md-6 col-sm-12">
   <div class="col-sm-5 col-md-5 col-xs-12"> <label for="text">organization</label></div>
   <div class="col-sm-7 col-md-7 col-xs-12">
<?php echo form_input(array('name' => 'organization', 'id' => 'organization', 'maxlength' => 45, 'value' => set_value('organization') ? set_value('organization') : (isset($profile['email']) ? $profile['organization'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('organization'); ?></div></div>  </div>
  
        </div>
        <?php
					 
			$query= $this->db->query('select city_id,city_name from new_citylist');
	
		?>
             
        
        <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="col-sm-6 col-md-6 col-xs-12 sender_id01">
   <div class="col-sm-5 col-md-5 col-xs-12"> <label for="text">City:</label></div>
    
    <div class="col-sm-7 col-md-7 col-xs-12">   <select name="city_id" id="city_id" style="width:100%" class="form-control">
         <option  value=""> --select--</option>
								<?php foreach($query->result_array() as $row){ ?>
								<option value="<?php echo $row['city_id']; ?>" <?php if($profile['city_id']==$row['city_id']){echo "selected";} ?>><?php echo $row['city_name']; ?></option>
								<?php } ?>
							</select>
                            	<div class="form_error"><?php echo form_error('city_id'); ?></div> 
                            
</div>

                            
                             </div>
           <div class="col-sm-6 col-md-6 col-sm-12">
    <div class="col-sm-5 col-md-5 col-sm-12"> <label for="text">Pin/Zip Code:</label></div>
	<div class="col-sm-7 col-md-7 col-xs-12"> 
<?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode') ? set_value('pincode') : (isset($profile['zipcode']) ? $profile['zipcode'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('pincode'); ?></div></div>  </div>

        </div>
        
        
        <!--<button type="submit" class="btn btn-primary">Login</button>-->

</div>

                </div>   
                <input type="hidden" name="mverify" value="<?php echo $profile['mverify']; ?>"   />                       <input type="hidden" name="username" value="<?php echo $profile['username']; ?>"   />     


         
                <div class="modal-footer col-sm-12 col-xs-12 col-md-12 padding_zero" style="text-align:center; margin-top:20px; ">
                    
					     <?php echo form_submit(array('name' => 'edit','value' => 'Save', 'class' => 'btn btn-default btn-sm'));?>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                </div>
				 <?php echo form_close(); ?>
                 
            </div>
        </div>
    </div>
