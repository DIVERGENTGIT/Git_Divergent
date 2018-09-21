

    <div class="wrapper">

      <!-- Left side column. contains the logo and sidebar -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
<?php if(!empty($error)){ echo $error;}?>
        <!-- Main content -->
        <section class="content">
        <div class="col-md-7 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
			            	<?php echo form_open('campaign/normalSMS',
					array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post')
	); ?> 
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Normal SMS</strong></div>
                <div class="panel-body">
                
                <dl class="dl-horizontal" style=" ">
                

				<dd>
                    <label class="ui-radio">
					
					<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 
					<span>Normal SMS</span>
					</label>
                    <label class="ui-radio">
					<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
					<span>Flash SMS</span>
					</label>
                </dd>
                  	<div class="form_error"><?php echo form_error('sms_type'); ?></div>

            </dl>
            
            
                <form class="form-horizontal ng-pristine ng-valid">

                <div class="form-group">
				
				
                    <label for="" class="col-sm-3">Campaign Name</label>
                    <div class="col-sm-9">
                        
						<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => 'form-control',
						'value' => set_value('campaign_name'),'style'=>'height:32px;'));?>
                        	<div class="form_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="label-focus" class="col-sm-3">Sender ID </label>
                    <div class="col-sm-9">

	  
	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="form-control"');?> 
		                        	<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                </div>
                
   
                



                 <div class="form-group">
    
                    <label for="" class="col-sm-3">Text </label>
                   <div class="col-sm-9">
				   
				   	<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text', 'placeholder' => 'Message', 'rows' => 4, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('sms_text')));?>
						

                        <td> 
                        <h6  class="label label-info" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td><br>
                        <td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
                    </div>
					<div class="form_error"><?php echo form_error('sms_text'); ?></div>

                     
                </div>
                
               
                
                <div class="form-group">
                
                    <label for="" class="col-sm-3">Mobile No </label>
                    <div class="col-sm-9">
		<?php 
		
		echo form_textarea(array('onKeyup'=>'isInteger(this.value)','name' => 'to_mobileno', 'id' => 'to_mobileno', 'placeholder' => 'Mobile numbers (one number each line)', 'rows' => 7, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('to_mobileno')));?>
	<div class="form_error"><?php echo form_error('to_mobileno'); ?></div>
                    </div>
                </div>
				
				<div class="form-group" style="text-align:left; ">
                    
                    <div class="col-sm-9 col-md-9  col-xs-9  " style="float:right;">
	

                
               <div class="form-group" style="text-align:center; ">
                                     <div class="col-sm-9 col-md-9  col-xs-9  " style="float:right;">
					<label for="remove_duplictes">
					<button type="button" class="btn btn-info">Remove Duplicate
				</button> 
					
<?php echo form_checkbox(array('name' => 'remove_duplictes', 'class'=>'flat-red','id' => 'remove_duplictes', 
'value' => 1)); ?>
</label>
 <label for="numbers_count"><?php echo form_checkbox(array('name' => 'numbers_count', 'id' => 'numbers_count', 'value' => 1)); ?></label> <label>Show Count</label>


                    </div>
					
                </div>
				

	 
                    </div>
                </div>
             
			<div class="additional-info-wrap form-group"> 
				<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
				<input type="checkbox" class="flat-red" name="Checkboxes" id="Checkboxes_Grape" value="Grape"  style=" border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED ;  margin-top: 11px;"> 
				
				                      </label>                         
			 <div class="additional-info hide icheckbox_minimal-blue checked col-sm-8">                             
	
 <div id="datetimepicker1" class="input-append date">
    <input data-format="dd/MM/yyyy hh:mm:ss" type="text" style=" height:30px;"></input>
    <span class="add-on" style=" height:30px;">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
      </i>
    </span>
  </div>
				</div>   
				</div>  
				<br>
     <div class="form-group">
                    
                    <div class="col-sm-9" style="float:right;">
			<!--		
 <input type="button" class="btn warning" value="Send"  data-placement="top" tooltip-trigger="focus" style=" height:30px; width:200px; background-color:#04A8ED; border:none; color:#fff;"> -->
 
                    		<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 
							'class' => 'btn btn-info','data-placement' => 'top','style' => 'height:30px;  background-color:#04A8ED !importent; border:none; color:#fff;'));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-info','data-placement' => 'top','style' => 'height:30px;  background-color:#04A8ED !importent; border:none; color:#fff;'));?>
                    </div>
                </div>
                
            </form>
                
                </div>
            </div>
        </div>
        
        </section>
 
	   
	   
	<section class="content" >
        <div class="col-md-5 ng-scope" data-ng-controller="formConstraintsCtrl" style="margin-top:0px">

            <div class="panel panel-default" style="margin-top:-15px">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Recent Text</strong></div>
                     <div class="bs-example">
    <ul class="nav nav-tabs" style="padding:0px 10px; text-align:center;">
        
        <li class="active"><a data-toggle="tab"  href="#sectionA">Recent Templates</a></li>
       
        <li><a data-toggle="tab" href="#sectionB">Templates</a></li>
       
    </ul> 
    <div class="tab-content" >
	<!--fghfdghdfghfgh-->
		<div id="sectionC" class="tab-pane fade in active" style="padding:0px 10px;">
		
		
            <div class="box-body" style="padding:0px;">
  <!--1-->
    <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;     font-size: 13px !important; ">
     <big style="color:#1788CC; font-size:16px;">Compaign Name :</big>  Purpose or agenda for the compaign. 
    </p>
    
  </div>
  <!--2-->
    <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;     font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">Sender ID : </big> Please select from the drop down menu.
    </p>
  </div>
  
  <!--3-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">SMS Text : </big> Type the (message content(body)) 160 characters is 1SMS ,special character like ‘    ‘ will       be counted as 2 characters  and  Unicode characters will be 70 for 1 SMS.
    </p>
  </div>
  
  <!--4-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">Mobile Coloumn :</big>  Enter mobile numbers in vertical format. +91,’,’ or ‘.’ Should not be included.
    </p>
  </div>
  
  
   <!--5-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">Mobile Conts : </big> &nbsp;&nbsp;&nbsp;-- 
    </p>
  </div>
  
  
   <!--6-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">No.of SMS : </big>&nbsp;&nbsp;&nbsp;--  
    </p>
  </div>
  
  
   <!--7-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC;  font-size:16px;">Remove Duplicate :  </big>Remove duplicate numbers from the list. 
    </p>
  </div>
  
   <!--8-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
   <big style="color:#1788CC; font-size:16px;">Schedule SMS :  </big>SMS will be sent at the time  and date set. Please select time first and date/month/year.
    </p>
  </div>
  
  <!--9-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
   <big style="color:#1788CC font-size:16px;">Unicode SMS : </big> Unicode characters are special characters which are not regular characters and are used in different languages.
    </p>
  </div>
  
  <!--10-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">File :  </big>Upload  Please upload xml,etc file.
    </p>
  </div>
  
  <!--11-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
    <big style="color:#1788CC; font-size:16px;">   Note : </big>The file should contain only mobile numbers.(Number,Name and other characters will be supported).
    </p>
  </div>
  
  <!--12-->
  <div class="callout " style="background-color:#ECF0F5; padding:5px 0px !important; border:0px !important; margin-bottom: 3px;">
    <p style="margin:0px 10px; color:#5C6167;      font-size: 13.50px !important; ">
   <big style="color:#1788CC;">Variable SMS :</big>&nbsp;&nbsp;&nbsp; ---
    </p>
  </div>
  
  
			
			</div>
			</div>
       
	
	
	
	
	
	
	
        <div id="sectionA" class="tab-pane fade " style="padding:0px 10px; word-break:break-all;">
           
            <div class="box-body col-md-12 col-sm-12 col-xs-12" style=" padding-right:5px;">
			
                 <?php foreach($campaigns as $camp => $cmpval): ?>
			<div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" style="overflow: hidden; "
				 title="<?php echo $cmpval->sms_text;?>" >   
			<li class="fa "><!--<input type="button"  class="" style="width:auto !important; word-wrap: break-word; background-color:transparent; border:none;  font-family: 'Play', sans-serif;"  value="<?php echo $cmpval->sms_text;?>" id="checkit" >-->
            
         <p id="checkit" style=" width:auto !important; cursor:pointer;" >  <?php echo $cmpval->sms_text;?> </p>
			</li>
             
                  </div>
				  <?php endforeach;?>
				  				 
				  
				
				
				 
                </div>
        </div>
       

	   
	   
	   
	   
	   
	   


        <div id="sectionB" class="tab-pane fade" style="    padding: 0px 3px;">
		
		<a style="float:right; margin-bottom:10px; margin-right:20px;" href="#modal-add" role="button" class="btn btn-sm btn-default" data-toggle="modal">Add Template</a>
        <div class="clearfix"></div>
           
           
           
           
            <div class="box-body" style="">
		
        

                	  
<?php  foreach($templates as $temp =>$val) :?>
<div class=" col-md-12 well alert alert- alert-dismissable" style="    height: 53px !important; padding-top: 4px !important; " data-toggle="tooltip" data-placement="bottom" title="<?php echo  $val->template;?>" >   
			
               
                   <!--text-->
            
       <div class="col-md-8 well " style="padding:0px !important; background-color: transparent;    border: none; box-shadow: none;    height: 44px;    overflow: hidden;"><!--<input type="button" class=" col-md-4 col-sm-6 col-xs-10"  style="font-family: 'Play', sans-serif; "  value="<?php echo $val->template;?>" id="checkit"  >-->
            
        <p id="checkit" style="height:50px; padding:0px 5px; overflow:hidden;"> <?php echo $val->template;?>" </p>
			</div>
            
            
            
                  <!--  edit-->
            
 <div class="col-md-2 well" style="padding: 10px 0px !important; background-color: transparent; border: none; box-shadow: none;">
      <center> <a href="#<?php echo $val->template_id; ?>"  data-remodal-target="<?php echo $val->template_id; ?>" data-toggle="modal">
					<span class="btn btn-sm btn-default" style=" height: 24px;
    width: 59px;font-size: 13px;
    text-align: center;
    padding-top: 0px;">Edit</span>
                    </a>  </center>
                    </div>
                    
                   <!--delete--> 
                    
                    
 <div class="col-md-2 well" style=" padding: 10px 0px !important; background-color: transparent; border: none; box-shadow: none;">
      <center>
                    <span     
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					
					data-href="<?php echo base_url(); ?>campaign/normalSMS/del/<?php echo $val->template_id; ?>";
					
                    class=" btn btn-sm btn-default" style=" height: 24px;
                        width: 65px;
                        text-align: center;font-size: 13px;
                        padding-top: 0px; margin-left:3px ;" > Delete 
                    </span>
                     
                    
                   </center>
      </div>
      
       
             
<div id="<?php echo $val->template_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top:0px !important;">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" style=" color: #FFF !important;  font-size: 17px !important; background-color:transparent !important;"><center>Edit Templates</center></h4>
        </div>
        <div class="modal-body">
 <form class="form-horizontal" name="templateform" method="post" action="normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="edittemp" name="edittemp" ><?php echo $val->template; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">

		<input type="hidden" name="template_id" value="<?php echo $val->template_id;?>"/>
        <button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="editsubmit"  class="btn btn-default btn-sm pull-right "  style="margin-right: 20px;">Save</button>
       
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->				
			
					
 	    </div>	
                   	<?php endforeach; ?>
                    
               
				  
            
			
			
        </div>
		
		
    </div>
</div>
      </div>
        </div>
        
        </section>   
	   
	<!-- Add template -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><center>Add Templates</center></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" name="templateform" method="post" action="normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="addtemp" name="addtemp" ></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">

       <button type="submit" value="Submit" name="addsubmit"  class="btn btn-primary btn-custom pull-right">Submit</button>
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->		

	   
<div class="clearfix"></div>
           <!--footer starts-->     
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-waring pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

   <!-- jQuery 2.1.4 -->
  

<!-- check box event for datepicker-->

<script type='text/javascript'>
     $(document).ready(function() {
 $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 
     });
  </script>      

    <!-- text box text count code-->
		<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'en'
    });
  });
</script>
   <script type='text/javascript'>
        
        $(document).ready(function() {
        
       var text_max = 0;
$('#count_message').html(text_max + '');

$('#sms_text').keyup(function() {
  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
  var persms=text_remaining/160;
    var singlecnt=Math.ceil(persms);
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(singlecnt+ '');
});

 

	$('#remove_duplictes').click(function() {
		
		if ($('#remove_duplictes').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: "<?php echo site_url('/campaign/normalSmsRemoveDublicates'); ?>", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr.length + " Unique Numbers out of " + to_mobileno_count.length);
		        	$('textarea#to_mobileno').val(callback_data);				    
		    	}
			});
		}
		 
	});
	
$('#recenttemp').click(function() {

if($('#recenttemp').val()!= "") {
var colum = $('#recenttemp').val();

var text = $('textarea#sms_text').val();
var s =	$('#sms_text').val(text+colum);



}
});
					 
	
	$('#numbers_count').click(function() {
		
		if ($('#numbers_count').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: "<?php echo site_url('/campaign/numbersCount'); ?>", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr);
		        	
		    	}
			});
		}
		 
	});
	

        });
        
        </script>
		

<script type='text/javascript'>	

 $(document).ready(function() {			
		$('#myDelet').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myDelet').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myDelet').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myDelet').modal('hide');
});
  }); 	

</script>


<!-- conformation-->

    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>
		
		 <script>
 $(document).ready(function(){

  
  	$('#on_date').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});
});
 </script>
 <script>
$(document).click("click", function(e) {
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');
		}	else
$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');		
	}
});


</script>

<script type="text/javascript">
function isInteger(s)
{
var i;s = s.toString();
for (i = 0; i < s.length; i++)
{
var c = s.charAt(i);
if (isNaN(c))
{
alert("Given value is not a number");return false;
}
}return true;
}
</script>


</html>
