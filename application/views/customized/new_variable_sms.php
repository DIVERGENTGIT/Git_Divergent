<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">SMS Delivery Report</h3>
</div>
	
        <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    
          <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
      
         <?php if(!isset($uploaded_data)): ?>
 


		 <div class="panel panel-default col-md-6">
         <div class="col-md-6 " style="top:30px;color:#ff0000">
             <?php if(isset($error)) {  echo $error;  
		 } ?>
		
<?php 

	echo form_open_multipart('customized/index',
    	$form_attributes = array('id' => 'variable_sms_file_upload', 'name' => 'variable_sms_file_upload',
			"enctype" => "multipart/form-data")
	); 
?>

         <tr>
   <td  >			
	
  
                   
				<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'class' => '', 'value' => set_value('userfile')));?>
                 
                 
                <div class="form_error"><?php echo form_error('userfile'); ?></div>
                  
                                     <a class="btn btn-file btn-sm " style="margin-top:10px;padding:0px 9px;"> <i class="fa fa-upload "></i>  <?php echo form_submit(array('name' => 'file_upload','value' => 'Upload', 'style' => '  font-family:Play, sans-serif; background-color:transparent; border:none;'));?> </a>
                 
				  </td>
	
	   </tr><?php echo form_close(); ?>


			</div>

       <!-- <span style="color:#F00;">
<?php if(!empty($error)){ echo $error;}?>
</span>-->
		
              </div>
	  		<div class="callout callout col-md-4" style="  padding:5px !important;border:none !important;  margin-right: 40px; margin-top: 27px; background-color:rgb(236, 240, 245) !important; ">
           
<h4 style="color:#F78F50 !important; font-size:16px !important;">Note :</h4>
<p  style="color:#F78F50 !important;">Please Uload Only Excel files. ( xis/xisx)</p>
</div>		
         <?php endif; ?>

    </div>
          
       
        

        </div>
     
        <?php if(isset($uploaded_data)): ?>
	<?php if(isset($error)) {  echo "<span style='color:#ff0000'>".$error."</span><br/>";  
		 } ?>
        <!-- Main content -->
        <section class="content">
		<div style="width:100%; padding:5px; overflow:auto; margin:0px auto; background-color:#fff;">
<?php echo $uploaded_data; ?>
 
</div>

        <div class="col-md-12 ng-scope" data-ng-controller="formConstraintsCtrl" style="padding:0px;margin: 10px 0px 20px 0px !important;">
            <div class="panel panel-default">
			            	<?php echo form_open('customized/index',
					array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post')
	); ?> 
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> <?php echo $page_title; ?></strong></div>
				  <div class="col-sm-12" style="background:#fff;">
                <div class="col-sm-7 panel-body" style="float: none;margin: auto;">
              <div class="col-md-4" style="margin-bottom:10px; margin-left:19px;">
<label class="ui-radio">
<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 

<span>Normal SMS</span></label>
              </div>
			  
			     <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
				
		<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
<span>Flash SMS</span></label>
				
				
              </div>
			  <br><br>
            
          
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
                    <div class="col-sm-9 sender_id01">
	  
	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="form-control"');?> 
		                        	<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                </div>
                
   
                
				
			<div class="form-group">

			<label for="" class="col-sm-3">Text </label>
			<div class="col-sm-6">
			<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text', 'rows' => 4, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('sms_text')));?>

			</div>
                     
			<div class="col-sm-3 sender_id01" style="padding-left:1px;">
			<?php echo form_dropdown('colum', $columns, '', 'id="colum" class = "form-control"'); ?> 
			</div> 

			<div class="form_error"><?php echo form_error('sms_text'); ?></div>

			</div>
				
             <div class="clearfix"></div>
<div class="form-group">
        <label for="label-focus" class="col-sm-3">Mobile Column </label>
        
        <div class="col-sm-6 sender_id01">

		<?php echo form_dropdown('mobile_column', $columns, set_value('mobile_column'), 'class="form-control"');?> 
		<div class="form_error"><?php echo form_error('mobile_column'); ?></div>
		
        </div>
 </div>
              
			

	<div class="form-group">
	<div class="form-inline col-sm-9" role="form">
	<div class="form-group" style="margin-left:0px;" >
	<label for="email" style="margin-left:10px;" >Select Row From:</label> 
 

	<?php echo form_input(array('name' => 'from_row', 'id' => 'from_row', 'class' => 'form-control', 'value' => set_value('from_row') ? set_value('from_row') : 2,'style'=>'width:60px;')); ?>
	<div class="form_error"><?php echo form_error('from_row'); ?></div>

	</div>
	<div class="form-group" style="margin-left:30px;">
	<label for="pwd" style="margin-right: 10px;">To</label>   

	<?php echo form_input(array('name' => 'to_row', 'id' => 'to_row', 'class' => 'form-control', 'value' => set_value('to_row') ? set_value('to_row') : $max_rows ,'style'=>'width:60px;')); ?>
	<div class="form_error"><?php echo form_error('to_row'); ?></div>


	</div>

	</div>
	</div>
    <div class="clearfix"></div>
             
			<div class="additional-info-wrap form-group"> 
            
	<label class=" col-sm-3" for="Checkboxes_Grape" style="" > Schedule SMS </label> 
	<div class="col-sm-9">
	<?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1,'class' => 'col-md-5','style'=>' border:none !importent;width:20px; height:20px;     margin-right: 15px; border-style:1px solid #04A8ED; background-color:#04A8ED; '))?>
 <div class="additional-info hide icheckbox_minimal-blue checked col-sm-10">                             
   <label class=" col-md-4" style="padding:0px;margin-top: 4px;">Date and time</label>	
	<div>

<div id="datetimepicker1" class="input-append date">
            
            
            <?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control col-md-4', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px; width:200px; padding: 0px 7px !important;margin-bottom: 0px !important;margin-left: 7px;')); ?>
            
            <span class="add-on" style=" height:30px;">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
              </i>
            </span>
          </div>
	
		

                        	<div class="form_error"><?php echo form_error('on_date'); ?></div>
	

	</div>
	</div> 
	   </div>                     
	  
	</div>  
				<br>
     <div class="form-group">
                    
                    <div class="col-sm-9" style="float:right;margin-top: 15px;">
    <input type="hidden" name = "file_name" value="<?php echo $file_name; ?>"></input>
    <input type="hidden" name = "file_type" value="<?php echo $file_type; ?>"></input>
    <input type="hidden" name="total_count" value="<?php echo $max_rows ?>">	
                    		<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 
							'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
                    </div>
                </div>
                
            </form>
                
                </div>
				</div>
            </div>
        </div>
        
        </section>
  
	<!-- Add template -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin:0px !important;">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
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
<button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="addsubmit"  class="btn btn-default btn-custom pull-right" style="margin-right:20px;">Submit</button>
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->		

	   
<div class="clearfix"></div>
           <!--footer starts-->     
      
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->
<?php endif; ?>
   <!-- jQuery 2.1.4 -->
    
<body>
</html>
