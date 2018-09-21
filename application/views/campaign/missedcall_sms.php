 

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<style>

	
		


#modal-add{height: 270px !important;}

input#remove_duplictes {
    height: 20px !important;
    width: 20px !important;}
 
 input#numbers_count {
	 height: 20px !important;
    width: 20px !important;
	
}
input#schedule{
	 height: 20px !important;
    width: 20px !important; 
	}
	
	.modal {
    top: 10%;

   }

	.modal-header {
    padding: 5px 15px;
    border-bottom: 1px solid #eee;
  
}
.bootstrap-datetimepicker-widget.dropdown-menu {
margin-top: -69px !important;
}

label.col-sm-3 {
    text-align: right;
}
div#sectionC {
    height: 705px !important;
    margin-bottom: 10px;
}
div#sectionA {
		
    height: 705px !important;
	margin-bottom: 10px;
}
div#sectionB {

    height: 705px !important;
	margin-bottom: 10px;
}



/* delet popop padding */
.popover-content.text-center {
    width: 194px !important;
    height: 45px !important;
    padding: 4px !important;
   
}
.tab-content {
    margin-bottom: 44px;
}


.sender_id01 select, input[type="file"]{height:30px;width:100% !important;}
.sender_id01 select {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    height: 40px;
	border-radius: 0px;
}

</style>

  <body class="skin-blue sidebar-mini "  >

  <!--  <div class="col-sm-6 col-xs-12 mbl_left padding_zero">

  <div class="col-sm-12 crm_sms_tabs">  
<ul class="jtab-trigger jtab-ul">
	<li>
        <a href="<?php echo base_url();?>campaign/missedcallSMS" class="jtab-selected">Missedcall SMS</a>
    </li>
    <li>
        <a href="<?php echo base_url();?>campaign/missedcallfileSMS">File SMS</a>
    </li>
    <li>
        <a href="<?php echo base_url();?>campaign/missedcallunicodeSMS">Unicode SMS</a>
    </li>
   <li>
        <a href="<?php echo base_url();?>campaign/missedcallvariableSMS">New variable SMS</a>
    </li>
</ul>
</div>  -->
      
    
      <div class="content-wrapper accordion-1" data-url="@{jqueryui.Accordion-1.region('')}">
      
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="col-sm-9"  data-wow-duration="2s" data-wow-delay="5s" >
<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Missedcall SMS   <?php    
?></strong>     <span style="float:right; color:#F00;">
<?php 
if(isset($error)){
echo $error;
}

if(isset($total_no_of_sms)){
echo $total_no_of_sms;
}

?>

 </span></div>
<div class="col-sm-12 crm_div_bg">
<div class="col-md-7 ng-scope" data-ng-controller="formConstraintsCtrl" style="padding:0px;">
        <div class="panel panel-default">
    
<?php echo form_open('campaign/missedcallSMS',
array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post', 'style' => 'margin:0px !important')
); ?> 

                <div class="panel-body">
                <div class="col-sm-12 padding_zero">
				<div class="col-md-4" style="margin-bottom:10px; margin-left:13px;">
                <label class="ui-radio">
				
				<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 

				<span>Normal SMS</span></label>
				</div>
			  
			    <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
				
		<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
<span>Flash SMS</span></label>
				
				
				</div>
              
				<div class="col-md-3 padding_zero" style="margin-bottom:10px;">
                
				
				
				</div>
				<div class="col-md-3 padding_zero" style="margin-bottom:10px;">
               
				
				</div>
              
              </div>
			 
            
                <form class="form-horizontal ng-pristine ng-valid">

	
                <div class="form-group">
				
				
                    <label for="" class="col-sm-3">Campaign Name</label>
                    <div class="col-sm-9">
                        
						<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => 'form-control',
						'value' => set_value('campaign_name'),'style'=>'height:30px;'));?>
                        	<div class="form_error"></div>
							
							
                    </div>
                </div>
				<div class="col-sm-12 padding_zero form-group missed_call_div">
<label for="" class="col-sm-3">Missed Call</label>
                    <div class="col-sm-9">
				
                     <select name="mc_nos[]"  id="mc_nos" placeholder="Long Code" class="lc_nos01 form-control" style="margin-bottom:0px !important;"> 
                     <option value="">--Select DID Number--</option>
                      
					  <?php 
				          foreach($did_result_response as $key=>$mobileno)
				          {
				           ?>
							  <option  class="" value="<?php echo $mobileno['did_number'] ?>"><?php echo $mobileno['did_number'] ?></option>
							  
					  <?php
					   }
					  ?>
					  </select>
					  <span class="saveselected" style="display:none;"></span>
<div class="short_error"></div>		  
                    </div>
    </div>
                <div class="form-group">
                    <label for="label-focus" class="col-sm-3">Sender ID </label>
                    <div class="col-sm-9 sender_id01">

	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'),
		array( 'class'=>'form-control'));?> 
        </span>
<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                </div>
                
                 <div class="form-group">
    
                    <label for="" class="col-sm-3">Text </label>
					<div class="col-sm-9">
				   
				   	<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text', 'placeholder' => 'Type here', 'rows' => 10, 'cols' => 30, 'style' => 'margin-bottom:0px !important;padding: 5px !important;', 'class' => 'form-control', 'value' => set_value('sms_text')));?>
						

                        <td> 
                        <h6  class="label label-default" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Characters</small>
						</td>
                        <td><span class="label label-default" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
						<div class="form_error"><?php
						
						
						 echo form_error('sms_text'); ?></div>
                    </div>
                    
		                    
                </div>
                
               
                
                <div class="form-group">
                
                    <label for="" class="col-sm-3">Mobile No </label>
                    <div class="col-sm-9 append_data">
<?php 

echo form_textarea(array('name' => 'to_mobileno', 'id' => 'to_mobileno', 'placeholder' => 'Mobile numbers (one number each line)', 'rows' => 7, 'cols' => 30, 'class' => 'form-control', 'style' => 'padding: 5px !important;', 'value' => set_value('to_mobileno')));?>
	<div class="form_error"><?php echo form_error('to_mobileno'); ?></div>

                    </div>
                    
                </div>
				
		<div class="form-group" style="text-align:left; ">
              
        
        
                    <!--this is new code-->
					 <div class="col-sm-3">
					 </div>
                    <div class="col-sm-9 col-md-9  col-xs-9">
                   <div class="form-group">
				   <ul class="check_sms_03">
				   <li>
				   
                      <span><?php echo form_checkbox(array('name' => 'remove_duplictes', 'class'=>'flat-red', 'id' => 'remove_duplictes', 
                    'value' => 1)); ?></span>
					<span>Remove Duplicate</span>
                   
				   
				   </li>
				    <li>
				  <span> <?php echo form_checkbox(array('name' => 'numbers_count', 'id' => 'numbers_count', 'value' => 1)); ?>
                  </span>
					<span>Show Count</span>
				   
				   </li>
				    <li>
				
                       <span> <?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'class' => 'col-md-1', 'value' => 1,'style'=>' ;'))?></span>
                     <span> Schedule SMS</span>
				   </li>
				   </ul>
			
					<div class="additional-info icheckbox_minimal-blue date_hide01 checked padding_ltrt col-sm-12" style="margin-top:25px;">     
                                 <label class=" col-md-4" style="padding:0px;">Date & time :</label>	            
           
         <div>
            
          <div id="datetimepicker1" class="input-append date">
            
            
            <?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control col-md-4', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px; width:200px; padding: 0px 7px !important;margin-bottom: 0px !important;margin-left: 7px;')); ?>
            
            <span class="add-on" style=" height:30px;">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
              </i>
            </span>
          </div>
           
          </div>
                                    <div class="form_error"><?php echo form_error('on_date'); ?></div>
        
        
                        </div>
					</div>
                    
                  
                 
                                </div>
       </div>
             
                     <!--this is new code-->
                    
                
                
          
                
                
                 	                        	

                <br>
     <div class="form-group">
                    
                    <div class="col-sm-9" style="float:right; margin-top: 20px;">
			<!--		
 <input type="button" class="btn warning" value="Send"  data-placement="top" tooltip-trigger="focus" style=" height:30px; width:200px; background-color:#04A8ED; border:none; color:#fff;"> -->
 
                    		<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 
							'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
                    </div>
                </div>
                
            </form>
                
                </div>
            </div>
        </div>
        <div class="col-md-5 ng-scope padding_rt" data-ng-controller="formConstraintsCtrl" style="margin-top:0px">
        
        
           <div class="col-md-12 padding_ltrt ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default" style="height:780px">
              
                 <div class="bs-example">
    <ul class="nav nav-tabs" style="padding:0px !important; text-align:left; margin-bottom: 10px !important;">
        <li class="active"><a data-toggle="tab"  href="#sectionA">Recent Templates</a></li>
	    <li><a data-toggle="tab" href="#sectionC">Groups</a></li>
   		 <li><a data-toggle="tab" href="#sectionB">Templates</a></li>         
  	 </ul>
    
    <div class="tab-content" >
	<!--fghfdghdfghfgh-->

        <div id="sectionA" class="tab-pane fade in active" style="padding:0px 10px; word-break:break-all;">
           
            <div class="box-body col-md-12 col-sm-12 col-xs-12" style=" padding-right:5px;">
			<ul class="recent_temp">
                 <?php foreach($campaigns as $camp => $cmpval): ?>
			  
			<li class="fa " style="word-wrap: break-word !important; width: 100% !important;"><!--<input type="button"  class="" style="width:auto !important; word-wrap: break-word; background-color:transparent; border:none;  font-family: 'Play', sans-serif;"  value="<?php echo $cmpval->sms_text;?>" id="checkit" >-->
            <div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" style="overflow: hidden; "
				 title='<?php echo $cmpval->sms_text;?>' > 
         <p id="checkit" style=" width:auto !important; height:40px; cursor:pointer; " >  <input type="button"   style="font-family: 'Play', sans-serif;     height: 40px !important;width:100% !important; background-color:transparent; border:none; word-wrap:break-word; "  
         value="<?php echo htmlspecialchars($cmpval->sms_text);?>" id="checkit" > </p>
         </div>
			</li>
             
                  
				  <?php endforeach;?>
				  </ul>				 
				 
				
				 
                </div>
        </div>
       
<div id="sectionC" class="tab-pane fade" style="padding:0px 10px;">
		
		
            
 
  
  <div class="box-body" style="padding:0px;">
  
  
  <div class="col-md-12 check_box_sh" style= " padding:0px 0px;">
         
		   <!-- group  ================== Start===================== -->
                <div class="col-md-6 well" style= " padding:0px 0px;  ">
                 
                         
                         <div class="col-md-12" style= " padding:0px 0px; height:580px;">
        
           
          
<div style="padding:10px 10px 3px 10px; background-color:#215A94; color:#fff;"><span >
<input type="checkbox" class="group_select" style="float:left; margin-right:10px;"  
 onchange="DoAction(0)" name="group_ids[]" value="0"/></span><p style="margin-left:15px;">Group Name</p></div> 
<div class="grp_check">
<ul class="grp_list">
         <?php 
   $groups_count=0;	

foreach($groups as $group=>$groupname):
	$groups_count++;
	?>
         <li><input type="checkbox" value="<?php echo $groupname->group_id; ?>" name="group_ids[]"  onClick="DoAction(<?php echo $groupname->group_id;?>)">
		 
 <?php echo $groupname->group_name; ?> 
         
         </li>
   
               <?php  endforeach;?>  
</ul>			   
                         </div>
                                
              </div>
                        
                 </div>
          <!-- group  ================== End===================== -->
         
             <!-- contact ================== Start===================== -->
         
                <div class="col-md-6 well" style= " padding:0px 0px;  ">
                
         <div class="col-md-12" style= " padding:0px 0px; height:580px;">
       <div style="padding:10px 10px 3px 10px;  background-color:#215A94; color:#fff;"><span >
<!--    <input type="checkbox" id="checkall" style="float:left; margin-right:10px;" class="checkbox1"/>
-->    <input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"  style="float:left; margin-right:10px;"/>
</span><p style="margin-left:15px;">Check All Contacts </p></div>


<span id="contact_list"> 
</span>

<!--<div class="main select_all2">


</div>-->

</div>




</div>
              <!-- group  ================== End===================== -->
              
              
              
              
              
              <!-- Group Details ================== Start===================== -->
         
                
                 
        
        
       </div>
			
		
			
			</div>
			</div>

        <div id="sectionB" class="tab-pane fade">
		
		<a style="float:right; margin-bottom:10px; margin-right:20px;" href="#modal-add" role="button" class="btn btn-sm btn-default" data-toggle="modal">Add Template</a>
        <div class="clearfix"></div>
           
           
           
           
            <div class="box-body" style="">
		
        

                	  
<?php  foreach($templates as $temp =>$val) :?>
<div class=" col-md-12 well alert alert- alert-dismissable" style="    height: 53px !important; padding-top: 4px !important; " data-toggle="tooltip" data-placement="bottom" title="<?php echo  $val->template;?>" >   
			
               
                   <!--text-->
            
       <div class="col-md-8 well " style="padding:0px !important; background-color: transparent;    border: none; box-shadow: none;    height: 44px;    overflow: hidden;"><!--<input type="button" class=" col-md-4 col-sm-6 col-xs-10"  style="font-family: 'Play', sans-serif; "  value="<?php echo $val->template;?>" id="checkit"  >-->
            
        <p id="checkit" style="height:50px; padding:0px 5px; overflow:hidden;"> <input type="button" class=" "  style="font-family: 'Play', sans-serif; width:100% !important; background-color:transparent; border:none; height:50px; word-wrap:break-word; "  value="<?php echo $val->template;?>" id="checkit" onClick="myFunction()"  > </p>
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
        </div>
        <!-- End of Modal body -->
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
        
         </div>
         </div>
		 </div>
        </section>

	<!-- Add template -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 0px !important;">
        <div class="modal-content" style="border:0px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title"><center>Add Templates</center></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" name="templateform" method="post" action="<?php echo base_url(); ?>campaign/normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="addtemp" name="addtemp" ></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
<button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="addsubmit"  class="btn btn-default btn-sm pull-right" style="margin-right:20px;">Submit</button>
        
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
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->
	</div>
</div>
   <!-- jQuery 2.1.4 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    
  
    <!-- Bootstrap 3.3.2 JS -->
    
	 <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.checkAll.js"></script>
	

	<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
   <!-- <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>-->
    <!-- AdminLTE App -->
 
 <!--<script src="<?php echo base_url();?>assets/js/remodal.min.js" type="text/javascript"></script>-->
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script type="text/javascript"src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
   <!-- ChartJS 1.0.1 -->
      <!--<script src="http://www.kptemplates.com/preview/unicorn/js/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>-->

    
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.checkAll.js"></script>

<script type="text/javascript">
$(document).ready(function () {
 $("#to_mobileno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 17, 86, 67, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>
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

    <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
			 
			 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})

	
   </script> 

   <script type='text/javascript'>
        
 $(document).ready(function() {
var text_max = 0;
$('#count_message').html(text_max + '');
$('#sms_text').keyup(function() {
  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
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
<!--<script>
 $(document).ready(function(){
 $('#on_date').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});
});
 </script>-->
 <?php //echo $user_id ?>
 <script>
$(document).ready(function(){
	var taVal;
  var taArr;
	$('.recent_temp li input').on('click', function(){
  	
  	$('#sms_text').val($('#sms_text').val()+' '+$(this).val());
	var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
  });
  
  
  $('#sms_text').on('blur', function(){
  	taVal=	$('#sms_text').val();
  })
  
  $('#mc_nos').on('change', function(){
  	taVal=	$('#sms_text').val(); // store textara text in a variable
     taArr=taVal.split(" "); // split string into words and store it as an array taArr
    	
    // traverse throug the dropdown
      $('#mc_nos option').each(function(i){
      
      // check whether the dropdown value exists in textarea text
      	if($.inArray(this.value,taArr)!=-1){
        	//if found remove it
         taArr.splice(taArr.indexOf(this.value ), 1);;
        }
      });
      
      var newtaArr="";
      $.each(taArr,function(i, value){
      	newtaArr+=value+' ';
      });
    $('#sms_text').val(newtaArr+$('#mc_nos').val());
    var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
  });
});
</script>
 
<script>
var maxLength = 10;
$('#to_mobileno').on('input focus keydown keyup', function() {
    var text = $(this).val();
    var lines = text.split(/(\r\n|\n|\r)/gm); 
    for (var i = 0; i < lines.length; i++) {
        if (lines[i].length > maxLength) {
            lines[i] = lines[i].substring(0, maxLength);
        }
    }
    $(this).val(lines.join(''));
});
</script>
<SCRIPT LANGUAGE="JavaScript">

function CheckAll(chk)
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;
}

function UnCheckAll(chk)
{

for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
}

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

   <!--  ===============================group details javascript===================================================== -->

     <!-- group details javascript -->
   
  <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
			 
			 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})

	
function DoAction(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>campaign/contact_list_ajax2",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajax-content-container').html(data);

                  }
				  
    });
}


function DoActionGroup(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>contacts/group_view_details",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajaxgroup-content-container').html(data);

                  }
				  
    });
}


function DoActionContact(id,cid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>contact_view.php",
		  dataType: "html",
         data: {id:id,cid:cid},
		 
		         success: function(data){
                  
				      $('#ajaxcontact-content-container').html(data);

                  }
				  
    });
}


   </script> 
   
   
   
   <!-- test group details javascript-->
   
    <script type="text/javascript">
	$('#menu-2 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.main-2 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.main-2 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
   </script>  
   
   
  <!-- contact details javascript-->
   
   
  <script type="text/javascript">
   $(document).ready(function(){
	   

	$('#kk-1 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.mm-1 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.mm-1 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
});
   </script> 

  <script type="text/javascript">
function DoAction(id)
{
	var group_ids=document.getElementsByName('group_ids[]');
	
	var group_ids_array=new Array();
	for(i=0,j=0; i<group_ids.length; i++)
	{
		if(group_ids[i].checked)
		{
			group_ids_array[j]=group_ids[i].value;
			j++;
	   }
    }
    group_ids=group_ids_array.join();
	//alert(group_ids);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{ //alert(xmlhttp.readyState);
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//alert('hi')
		
		document.getElementById("contact_list").innerHTML=xmlhttp.responseText;
		}
				document.getElementById("contact_list").innerHTML=xmlhttp.responseText;

		}
		

		xmlhttp.open("POST","<?php echo base_url(); ?>campaign/contact_list_ajax2?group_ids="+group_ids,true);
		xmlhttp.send();
}
</script>
<script src="<?php echo base_url();?>assets/js/wow.min.js" type="text/javascript"></script>      
      
 <script type="text/javascript">

    $(document).click(function(e){
		$('#checkall').on('click',function(){
        if(this.checked){
            $('.check_all input').each(function(){
                this.checked = true;
            });
        }else{
             $('.check_all input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.check_all input').on('click',function(){
        if($('.check_all input:checked').length == $('.check_all input').length){
            $('#checkall').prop('checked',true);
        }else{
            $('#checkall').prop('checked',false);
        }
    });
	
	
	// 3
	$('.group_select').on('click',function(){
        if(this.checked){
            $('.grp_check input').each(function(){
                this.checked = true;
            });
        }else{
             $('.grp_check input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.grp_check input').on('click',function(){
        if($('.grp_check input:checked').length == $('.grp_check input').length){
            $('.group_select').prop('checked',true);
        }else{
            $('.group_select').prop('checked',false);
        }
    });
	
	// data insert
	  
	var checkboxes = $("#sectionC input[type='checkbox']");

checkboxes.on('change', function() {
    $('.append_data .form-control').val(
        checkboxes.filter('.checkboxstyle:checked').map(function(item) {
            return this.value;
        }).get().join('\n')
     );
}); 
  
    
});
</script>  
<script>
$(document).ready(function () {
	$('.date_hide01').hide();
    $('#schedule').change(function () {
		
        if (!this.checked) 
        //  ^
            $('.date_hide01').fadeOut('slow');
        else   
		$('.date_hide01').fadeIn('slow');
    });
});
 </script>

</body>
