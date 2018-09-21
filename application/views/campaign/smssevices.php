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
    <!-- jvectormap -->

    <link href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/custom-css.css" rel="stylesheet" type="text/css">
   <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
	 
	



	
	<script type="text/javascript" src="http://www.google.com/jsapi"> </script>
	
    <script type="text/javascript">

      // Load the Google Transliteration API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['te','ar','hi','kn','ml','ta'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        // Create an instance on TransliterationControl with the required
        // options.
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = [ "transl1", "sms_text_unique" ];
        transliterationControl.makeTransliteratable(ids);

        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);

        // Add the SERVER_UNREACHABLE event handler to display an error message
        // if unable to reach the server.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
            serverUnreachableHandler);

        // Add the SERVER_REACHABLE event handler to remove the error message
        // once the server becomes reachable.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,
            serverReachableHandler);

        // Set the checkbox to the correct state.
        document.getElementById('checkboxId').checked =
          transliterationControl.isTransliterationEnabled();

        // Populate the language dropdown
        var destinationLanguage =
          transliterationControl.getLanguagePair().destinationLanguage;
        var languageSelect = document.getElementById('languageDropDown');
        var supportedDestinationLanguages =
          google.elements.transliteration.getDestinationLanguages(
            google.elements.transliteration.LanguageCode.ENGLISH);
        for (var lang in supportedDestinationLanguages) {
          var opt = document.createElement('option');
          opt.text = lang;
          opt.value = supportedDestinationLanguages[lang];
          if (destinationLanguage == opt.value) {
            opt.selected = true;
          }
          try {
            languageSelect.add(opt, null);
          } catch (ex) {
            languageSelect.add(opt);
          }
        }
      }

      // Handler for STATE_CHANGED event which makes sure checkbox status
      // reflects the transliteration enabled or disabled status.
      function transliterateStateChangeHandler(e) {
        document.getElementById('checkboxId').checked = e.transliterationEnabled;
      }

      // Handler for checkbox's click event.  Calls toggleTransliteration to toggle
      // the transliteration state.
      function checkboxClickHandler() {
		  
        transliterationControl.toggleTransliteration();
      }

      // Handler for dropdown option change event.  Calls setLanguagePair to
      // set the new language.
      function languageChangeHandler() {
        var dropdown = document.getElementById('languageDropDown');
        transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
      }

      // SERVER_UNREACHABLE event handler which displays the error message.
      function serverUnreachableHandler(e) {
        document.getElementById("errorDiv").innerHTML =
            "Transliteration Server unreachable";
      }

      // SERVER_UNREACHABLE event handler which clears the error message.
      function serverReachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "";
      }
      google.setOnLoadCallback(onLoad);
	  
	  function charcount()
	  {
	     var msg=document.unicodesmsform.sms_text.value;
		 document.getElementById("charactercount").innerHTML=msg.length;
		 document.unicodesmsform.char_count.value=msg.length;
	  }

    </script>

<!--unicode sms end -->
	


<style type="text/css">
 .skin-blue .sidebar a{font-size:12px !important;}
 .fa-check-circle{ color:#73DAFF;}
 .my-template{background-color:#d0e7ff !important; padding-top:4px; border-radius:5px !important; }
 
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
span{font-size:13px !important;}
.label {
    font-size:13px !important;
}
 
 .nav-tabs > li, .nav-pills > li {
    float:none;
    display:inline-block;
    *display:inline; /* ie7 fix */
     zoom:1; /* hasLayout ie7 trigger */
}
.label{ text-align:right !important;}

input#checkit {
    min-width: 100px !important;
    max-width: 200px !important;
	color:#6A6B6D !important;
}
input#checkit {
    min-width: 243px !important;
    max-width: 243px !important;
   
    margin-right: 8px !important;
}
/*fade.in ( after .modal should be , but fade.in not working now )*/
.modal {
    top: 10%;
    overflow: hidden !important;
    height: 35% !important;
   }
   
.callout  h4 {
    margin-top: 0!important;
    font-weight: 400 !important;
    padding: 2px !important;
}

.bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
    background-color:rgba(0, 174, 231, 0.54) !important;
    border-left: 0px !important;
}

.modal-header .close {
    margin-top: 9px !important;
    margin-right: 59px !important;
    color: #000 !important;
	}
	
	
	.modal-header {
    padding: 5px 15px;
    border-bottom: 1px solid #eee;
  
}
.bootstrap-datetimepicker-widget.dropdown-menu {
    margin-top: 0px !important;
}
/*button.btn, input[type="submit"].btn {
    margin-top: 14px !important;
}*/
@media (min-width: 768px){
.modal-dialog { margin: 0px auto !important;}
    
   

}
/*.nav-tabs, .nav-pills {
    text-align:center;
	
.nav {
  margin-bottom:0px !important; */	
 </style>

  </head>
  <body class="skin-blue sidebar-mini ">
    <div class="wrapper">


      <!-- Content Wrapper. Contains page content -->
	  
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
 

        <!-- Main content -->
        <section class="content" style=" margin-top:50px;">
        <div class="col-md-7 ng-scope" data-ng-controller="formConstraintsCtrl">
         

		 <div class="bs-example">
    <ul class="nav nav-tabs " style="margin-bottom:0px !important; ">
        <li class="active"><a data-toggle="tab" href="#Normal-SMS"  onclick="tabrefresh()">Normal SMS</a></li>
        <li><a data-toggle="tab" href="#File-SMS">File SMS</a></li>
         <li><a data-toggle="tab" href="#Unicode-SMS">Unicode SMS</a></li>
		 <li><a data-toggle="tab" href="#Costomised-SMS">Customised SMS</a></li>
       
    </ul>
    <div class="tab-content">
        
		<div id="Normal-SMS" class="tab-pane fade in active" style="overflow:hidden !important; height:auto !important;">
           
			
   <div class="panel panel-default">
   <?php echo form_open('campaign/normalSMS',
array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post')
); ?> 
                <div class="panel-heading" style="color:#009BFA;"><strong><span class="glyphicon glyphicon-th"></span> Normal SMS</strong></div>
                <div class="panel-body">
                 
				 
				 <div class="col-md-3">
                
                 </div>
               <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
								<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 

				
				<span>Normal SMS</span></label>
              </div>
			  
			     <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
			<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
				
				<span>Flash SMS</span></label>
              </div>
                    
                    
                <div class="form-group">
                    <label for="" class="col-sm-3" >Campaign Name</label>
                    <div class="col-sm-9" >
<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => 'form-control',
						'value' => set_value('campaign_name'),'style'=>'height:34px;'));?>
                        	<div class="form_error"></div>                    </div>
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
                        <h6  class="label label-info" id="count_message">0</h6>
						<small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td>
                       &nbsp;&nbsp; <td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
                    </div>	<div class="form_error"><?php echo form_error('sms_text'); ?></div>
                     
                </div>
                
               
                
                <div class="form-group">
                
                    <label for="" class="col-sm-3">Mobile No </label>
                    <div class="col-sm-9">
<?php 

echo form_textarea(array('name' => 'to_mobileno', 'id' => 'to_mobileno', 'placeholder' => 'Mobile numbers (one number each line)', 'rows' => 7, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('to_mobileno')));?>                    </div>
                </div>
                		<div class="form_error"><?php echo form_error('to_mobileno'); ?></div>                        	

                <div class="form-group" style="text-align:left; ">
                    
                    
                    
                    <div class="col-sm-9 col-md-9  col-xs-9  " style="padding-left:0px;">
	   <div class="form-group"style="margin:0px !important;" >
           
          <label class="col-md-5 " style="" > Remove Duplicate</label>
         <div class="col-sm-1" style="padding:0px !important; ">
				<?php echo form_checkbox(array('name' => 'remove_duplictes', 'class'=>'flat-red','id' => 'remove_duplictes', 
		'value' => 1)); ?>
        </div>
        </div>
        
        <div class="form-group" style="margin:0px !important;" >
           
          <label class="col-md-5 " style="text-align:right;" > Show Count</label>
         <div class="col-sm-1" style="padding:0px !important;">
				<?php echo form_checkbox(array('name' => 'numbers_count', 'id' => 'numbers_count', 'value' => 1)); ?>
        </div>
        </div>
	 
                    </div>
                </div>
                
				
				
				<div class="additional-info-wrap form-group"> 
				<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
				<?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1,'style'=>' border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED; margin-top: 11px;'))?>
				                      </label> 
                                      
                                                              
			 <div class="additional-info hide icheckbox_minimal-blue checked col-sm-12" style="margin-top:10px;">     
                         <label class=" col-md-4" style="padding:0px;">Date and time range :</label>	            
	
 <div id="datetimepicker1" class="input-append date">
 	
	
	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control col-md-4', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px; width:200px; ')); ?>
	
    <span class="add-on" style=" height:30px;">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
      </i>
    </span>
  </div>
                          	<div class="form_error"><?php echo form_error('on_date'); ?></div>


				</div>   
				</div>  
				
			
			
                <div class="form-group col-sm-12 " >
                     <div class=" col-md-4" > </div>
                     <div class="form-group col-md-8" style="paddin:0px;" >
                    
                   <?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 
							'class' => 'btn btn-sm btn-default','data-placement' => 'top','style' => ''));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-sm btn-default','data-placement' => 'top','style' => ''));?>
	  
                   
                </div>
                </div>
                
            </form>
                
                                    
                </div>
            </div>
        
		</div>
       
	   
	   <div id="File-SMS" class="tab-pane fade" style="overflow:hidden !important; height:auto !important;">
           
    <div class="panel panel-default">
	<?php echo form_open_multipart('campaign/normalSMS',
	array('id' => 'file_sms_form', 'name' => 'file_sms_form', 'method' => 'post')
	); ?> 
                <div class="panel-heading" style="color:#009BFA;"><strong><span class="glyphicon glyphicon-th"></span> File SMS</strong></div>
                <div class="panel-body">
                
                 <div class="col-md-3">
                
                 </div>
               <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
			
					<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 
				<span>Normal SMS</span></label>
              </div>
			  
			     <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
		<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
				<span>Flash SMS</span></label>
              </div>
            
            

					<div class="form-group">
						<label for="" class="col-sm-3"  >Campaign Name</label>
						<div class="col-sm-9">
							<?php echo form_input(array('name' => 'campaign_name', 
	'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => 'form-control',
	'value' => set_value('campaign_name'),'style'=>'height:34px;'));?>
						</div>
					</div>
					<div class="form-group">
						<label for="label-focus" class="col-sm-3">Sender ID </label>
						<div class="col-sm-9">
						  <?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="form-control"');?> 
	<div class="form_error"><?php echo form_error('sender'); ?>
	
						</div>
					</div>
					
		 
					
					
					 <div class="form-group">
					
						<label for="" class="col-sm-3">Text </label>
						
							<div class="col-sm-9">
							<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text_f', 'placeholder' => 'Message', 'rows' => 4, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('sms_text')));?>
							 
							<h6 class="label label-info" id="count_message-F">0</h6><small style="margin-left:10px; color:#215A94;">Number of Charters</small>
						&nbsp; &nbsp;	<span class="label label-info" id="hwmnysms-F">0</span> <small style="margin-left:10px; color:#215A94;">Number of SMS</small>
						</div>
						 
							<div class="form_error"><?php echo form_error('sms_text'); ?></div>

						 
					</div>
				   
					   
	
							
					
<div class="form-group col-md-12" style=" ">
		 <div class="form-group col-md-4" >    </div>
    <div id="testForm" class="btn-group  col-md-4" >
			
			   <a class="btn btn-sm btn-file btn-default" style="">
				 <i class="fa fa-upload  "    style=" "></i> 
				 	<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'value' => set_value('userfile')));?>Upload

			   </a>

		    

	</div>
							   
</div>
		
	
			<div class="additional-info-wrap form-group"> 
	<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
	
	<?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1,'style'=>' border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED; margin-top: 11px;'))?>

	</label> 
                            
	<div class="additional-info hide icheckbox_minimal-blue checked col-sm-12" style="margin-top:10px;">     
                         <label class=" col-md-4" style="padding:0px;">Date and time range :</label>	            
	
 <div id="datetimepicker2" class="input-append date">
 	
	
	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control col-md-4', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px; width:200px; ')); ?>
	
    <span class="add-on" style=" height:30px;">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
      </i>
    </span>
  </div>
                          	<div class="form_error"><?php echo form_error('on_date'); ?></div>


				</div>   
    
    
    
	</div>  <br>
	<div class="form-group">
	<div class="col-sm-9 " style="float:right;">
	<?php echo form_submit(array('name' => 'sendfilesms','value' => 'Send', 
	'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
	<?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
	</div>
	</div>
	</form>
                  
                </div>
            </div>
       
	   </div>
        
			</div>
            
            <div class="clearfix" style="margin-bottom:0px;"></div>
		
		<div id="Unicode-SMS" class="tab-pane fade" style="overflow:hidden !important; height:auto !important;">
		
    <div class="panel panel-default">
		<?php echo form_open('campaign/normalSMS',
					array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post')
	); ?> 
                <div class="panel-heading" style="color:#009BFA;"><strong><span class="glyphicon glyphicon-th"></span> Unicode SMS</strong></div>
                <div class="panel-body">
                
              <div class="col-md-3">
                
                 </div>
               <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
					<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 
				<span>Normal SMS</span></label>
              </div>
			  
			     <div class="col-md-4" style="margin-bottom:10px;">
                <label class="ui-radio">
				<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
				
				<span>Flash SMS</span></label>
              </div>
            
            
            

                <div class="form-group">
                    <label for="" class="col-sm-3" >Campaign Name</label>
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
                    <label for="label-focus" class="col-sm-3">Language </label>
                    <div class="col-sm-9">
       <div id="translControl">      
	   <input type="checkbox" id="checkboxId" onClick="javascript:checkboxClickHandler()" 
	   checked="checked" />
	  
      Type in <select id="languageDropDown" onChange="javascript:languageChangeHandler()"></select>
    </div>
				<input type='hidden' id="transl1"/>
				   	<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text_unique', 'placeholder' => 'Message', 'rows' => 4, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('sms_text')));?>
						 
				  
                    </div>
                </div>
              
                
                
                 <div class="form-group">
                
                    <label for="" class="col-sm-3">Text </label>
					
                    <div class="col-sm-9">
                                     <h6 class="label label-info" id="count_message-u">0</h6>
						  <small style="margin-left:10px; color:#016EC7">Number of Charters</small>
                  &nbsp; &nbsp;     <span class="label label-info" id="hwmnysms-u">0</span> <small style="margin-left:10px; color:#016EC7">Number of SMS</small>        
				  
                    </div>
                     
					 
					 <div class="form_error"><?php echo form_error('sms_text'); ?></div>
                </div>
                
               
                
               
                
               <div class="form-group">

                    <label for="" class="col-sm-3">mobile No </label>
                    <div class="col-sm-9">
                     	<?php 
		
		echo form_textarea(array('name' => 'to_mobileno', 'id' => 'to_mobileno_u', 'placeholder' => 'Mobile numbers (one number each line)', 'rows' => 7, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('to_mobileno')));?>

                        
                    </div>
                     
                </div>
				
	<div class="form-group" style="text-align:left; ">
	

 <div class="form-group" style="text-align:center; ">
<div class="col-sm-12 col-md-12 col-xs-12  " style=" padding-left:0px;">

   <div class="form-group"style="margin:0px !important;" >
<label label class="col-md-3 " for="remove_duplictes" style=" text-align:left; padding-right:0px !important">
Remove Duplicate
</label>
		     <div class="col-sm-1" style="padding:0px !important; ">			
<?php echo form_checkbox(array('name' => 'remove_duplictes', 'class'=>'flat-red','id' => 'remove_duplictes_u', 
'value' => 1)); ?>
</div>
</div>


<div class="form-group"style="margin:0px !important;" >
<label class="col-md-3 "  style=" padding-right:0px !important; text-align:right;">Show Count</label>
<div class="col-sm-1" style="padding:0px !important; ">
 <?php echo form_checkbox(array('name' => 'numbers_count', 'id' => 'numbers_count_u', 'value' => 1)); ?>
</div>
              	<div class="form_error"><?php echo form_error('to_mobileno'); ?></div>                        	

      </div>             
  </div>
</div>
 </div>
            

<div class="additional-info-wrap form-group"> 
	<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
	
	<?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1,'style'=>' border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED; margin-top: 11px;'))?>

	</label>                         
	<div class="additional-info hide icheckbox_minimal-blue checked col-sm-12" style="margin-top:10px;">     
                         <label class=" col-md-4" style="padding:0px;">Date and time range :</label>	            
	
 <div id="datetimepicker3" class="input-append date">
 	
	
	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control col-md-4', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px; width:200px; ')); ?>
	
    <span class="add-on" style=" height:30px;">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
      </i>
    </span>
  </div>
                          	<div class="form_error"><?php echo form_error('on_date'); ?></div>


				</div>   
	</div>  
				<br>	
 <div class="form-group col-md-12">
                    
                    <div class="col-md-9" style="float:right;">
		
                    		<?php //echo form_submit(array('name' => 'sendsms','value' => 'Send', 'class' => 'button'));?>

                    		<?php  echo form_submit(array('name' => 'sendunicodesms','value' => 'Send', 
							'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => '')); ?>
                    </div>
                </div>				
  
  <?php echo form_close(); ?>
 
                
                
                
                
                    
                </div>
            </div>
       
	   </div>
		
		
		 <div id="Costomised-SMS" class="tab-pane fade" style="overflow:hidden !important; height:auto !important;">
    
	<div class="panel panel-default col-md-12" style=" padding:0px; " >
	
	<?php 
	echo form_open_multipart('campaign/normalSMS',
    	$form_attributes = array('id' => 'variable_sms_file_upload', 'name' => 'variable_sms_file_upload')
	); 
?>
        <div class="panel-heading" style="color:#009BFA;"><strong><span class="glyphicon glyphicon-th"></span> Customized SMS</strong></div>
		 <div class="panel panel-default col-md-3" style="  ">
         <div class="col-md-9 " style=" top:10px; ">
         
                <a class="btn btn-file btn-sm btn-default" style=" paddign-bottom:20px;">
                    <i class="fa fa-upload "></i> 
					
					<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'class' => 'btn btn-file btn-sm ','class' =>'width:90px;', 'value' => set_value('userfile')));?>
                  </a>
                 
                  <br>  <br>
           
                   
					<?php echo form_submit(array('name' => 'file_upload','value' => 'Upload', 'class' => 'btn btn-file btn-sm '));?>
                
			</div>
        
            </div>
	
    </div><?php echo form_close(); ?>
	<div class="callout callout-info">
<h4>Note :</h4>
<p>Please Uload Only Excel files. ( xis/xisx)</p>
</div>
	 <?php if(isset($uploaded_data)): ?>

        <!-- Main content -->
        <section class="content">
		<div style="width:90%; height:100px; overflow:auto;">
<?php echo $uploaded_data; ?>
</div>

        <div class="col-md-12 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
			            	<?php echo form_open('campaign/normalSMS',
					array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post')
	); ?> 
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> <?php echo $page_title; ?></strong></div>
                <div class="panel-body">
              <div class="col-md-4" style="margin-bottom:10px;">
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
                <div class="form-group">
                    <label for="" class="col-sm-3">Campaign Name</label>
                    <div class="col-sm-8">
                        
						<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => 'form-control',
						'value' => set_value('campaign_name'),'style'=>'height:34px;'));?>
                        	<div class="form_error"></div>
                    </div>
                
                </div>
                <div class="form-group">
                    <label for="label-focus" class="col-sm-3">Sender ID </label>
                    <div class="col-sm-8">
	  
	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="form-control"');?> 
		                        	<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                        
                </div>
                
   <div class="clearfix"></div>
                
				
			<div class="form-group">

			<label for="" class="col-sm-3">Text </label>
			<div class="col-sm-6" style="    padding-right: 0px !important;">
			<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text_c', 'rows' => 4, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('sms_text')));?>

			</div>
                     
			<div class="col-sm-3" style="    padding: 0px !important;">
			<?php echo form_dropdown('colum', $columns, '', 'id="colum" class = "form-control"'); ?> 
			</div> 

			<div class="form_error"><?php echo form_error('sms_text'); ?></div>

			</div>
				  <div class="clearfix"></div>
             
		<div class="form-group">
		<div class="form_error"><?php echo form_error('mobile_column'); ?></div>
		<label for="label-focus" class="col-sm-3">Mobile Column </label>
		<div class="col-sm-8" >

		<?php echo form_dropdown('mobile_column', $columns, set_value('mobile_column'), 'class="form-control"');?> 
		<div class="form_error"><?php echo form_error('mobile_column'); ?></div>
		</div>
		</div>
              
			

	<div class="form-group" >
	<div class="form-inline col-sm-12" role="form">
	<div class="form-group" style="margin-left:2px;" >
	<label for="email" >Select Row From:</label> 


	<?php echo form_input(array('name' => 'from_row', 'id' => 'from_row', 'class' => 'form-control', 'value' => set_value('from_row') ? set_value('from_row') : 2,'style'=>'width:60px; margin-left:20px;')); ?>
	<div class="form_error"><?php echo form_error('from_row'); ?></div>

	</div>
	<div class="form-group" style="margin-left:30px;">
	<label for="pwd">To</label>   

	<?php echo form_input(array('name' => 'to_row', 'id' => 'to_row', 'class' => 'form-control', 'value' => set_value('to_row') ? set_value('to_row') : $max_rows ,'style'=>'width:60px;')); ?>
	<div class="form_error"><?php echo form_error('to_row'); ?></div>


	</div>

	</div>
	</div>
             
             
             
			<div class="additional-info-wrap form-group"> 
	<label class=" col-sm-5" for="Checkboxes_Grape" style=" " > Schedule SMS  
	
	<?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1,'style'=>' border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:40px; background-color:#04A8ED; margin-top: 11px;'))?>

	</label>                         
	<div class="additional-info hide icheckbox_minimal-blue checked col-sm-5">                             

	<div id="datetimepicker-custom-1" class="input-append date">

	
	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date_c', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px;')); ?>
	
		<span class="add-on" style=" height:30px;">
	<i data-time-icon="icon-time" data-date-icon="icon-calendar" >
	</i>
	</span>

                        	<div class="form_error"><?php echo form_error('on_date'); ?></div>
	

	</div>
	</div>   
	</div>  
				<br>
     <div class="form-group">
                    
                    <div class="col-sm-9" style="float:right; margin-bottom:20px !important;">
		
                    		<?php echo form_submit(array('name' => 'sendcustomsms','value' => 'Send', 
							'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
                    </div>
                </div>
                
            </form>
                
                </div>
            </div>
        </div>
        
        </section>
		<?php endif;?>
        
		</div>
            </div>
					 

</div>
	    
        
       


		</div>
        
        </section>
        
     
	   
	   
	<section class="content" >
        <div class="col-md-5 ng-scope" data-ng-controller="formConstraintsCtrl" style="margin-top:38px !important;">
            <div class="panel panel-default" style="margin-top:-15px">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span>  customised SMS</strong></div>
                     <div class="bs-example">
    <ul class="nav nav-tabs" style="padding:0px !important; text-align:left; margin-bottom: 10px !important;">
       
	    <li class="active"><a data-toggle="tab" href="#sectionC">Notice Board</a></li>
      
	    <li ><a data-toggle="tab"  href="#sectionA">Recent Templates</a></li>
       
        <li><a data-toggle="tab" href="#sectionB">Templates</a></li>
		
		  
       
    </ul>
    <div class="tab-content" >
	<!--fghfdghdfghfgh-->
		<div id="sectionC" class="tab-pane fade in active" style="padding:0px 10px;">
		
		
            <div class="box-body" style="padding:0px;">
			
            <div class="callout " style="background-color:#ECF0F5; border:0px !important; margin-bottom: 3px;">
    <h4 style="color:#009BFA; padding:0px; font-weight:400 !important; font-size:15px; margin-bottom:3px;">About the note</h4>
    <p style="margin:0px 10px; color:#5C6167; text-align:justify;">The starter page is a good place to start building your app if you'd like to start from scratch.</p>
  </div>
  
  <!--<div class="callout " style="background-color:#ECF0F5; border:0px !important; margin-bottom: 3px;">
    <h4 style="color:#009BFA; padding:0px; font-weight:400 !important; font-size:16px; margin-bottom:3px;">About the note</h4>
    <p style="margin:0px 10px; color:#5C6167; text-align:justify;">The starter page is a good place to start building your app if you'd like to start from scratch.</p>
  </div>-->
            
			
			</div>
			</div>
        <!--fghfdghdfghfgh-->
	
	
	
	
	
	
	
        <div id="sectionA" class="tab-pane fade " style="padding:0px 10px;">
           
            <div class="box-body">
			
                 <?php foreach($campaigns as $camp => $cmpval): ?>
			<div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom"
				 title="<?php echo $cmpval->sms_text;?>" >   
			<li class="fa fa-file-text-o"><input type="button" class="my-enter"  style=" "  value="<?php echo $cmpval->sms_text;?>" id="checkit"  >
			</li>
             
                  </div>
				  <?php endforeach;?>
				  				 
				  
				
				
				 
                </div>
        </div>
       

	   
	   
	   
	   
	   
	   


        <div id="sectionB" class="tab-pane fade" style="padding:0px 10px;">
		
		<a style="float:right; margin-bottom:10px; margin-right:20px;" href="#modal-add" role="button" class="btn btn-sm btn-default" data-toggle="modal">Add Template</a>
        <div class="clearfix"></div>
            <div class="box-body" style="padding:0px;">
			
                      
                
     

                	  
<?php  foreach($templates as $temp =>$val) :?>
<div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom"
				 title="<?php echo  $val->template;?>" >   
			<li class="fa fa-file-text-o"><input type="button" class="my-enter"  style=" "  value="<?php echo $val->template;?>" id="checkit"  >
			</li>
            					<a href="#<?php echo $val->template_id; ?>"  data-remodal-target="<?php echo $val->template_id; ?>" data-toggle="modal">
					<span class="badge " style="background-color: rgba(33, 90, 148, 0.56); margin-right:5px; color:#FFFFFF; ">Edit</span></a>

            <span style="    background-color: #ACB2B9;" class="badge"   
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					style="margin-left:10px;" 
					data-href="<?php echo base_url(); ?>campaign/normalSMS/del/<?php echo $val->template_id; ?>";
					class="badge bg-blue">Delete</span> 
    </button>
             
<div id="<?php echo $val->template_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
       <button type="submit" value="Submit" name="editsubmit"  class="btn btn-default btn-sm pull-right ">Save</button>
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
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title"><center>Add Templates</center></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" name="templateform" method="post" action="<?php echo base_url(); ?>/campaign/normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="addtemp" name="addtemp" ></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">

       <button type="submit" value="Submit" name="addsubmit"  class="btn btn-default btnsm  pull-right">Submit</button>
    
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div>
	
	
	
	
	
	
	
	
	<!-- Edit template -->
	
	
	
	<div class="remodal" data-remodal-id="modal-edit">
             <button data-remodal-action="close" class="remodal-close"></button>
        <div class="form-group">
                 <h4 style="color:#016EC7;"> Edit template</h4>
                    <label for="" class="col-sm-3">Text </label>
                    <div class="col-sm-9" style="margin-left:0px;">
                        <textarea name="" id="text" class="form-control" rows="4"></textarea>
                       <div style="margin-left:0px; text-align:left;">
                      
                        <h6  class="label label-info" id="count_message_3"  style="margin-left:0px;">0</h6>
						<span style=" margin-left:5px;color:#016EC7">Number of Charters</span>
						
                       
						<span class="label label-info" style="margin-left:20px; color:#016EC7" id="hwmnysms">0</span>
						<span  style="margin-left:5px; color:#016EC7">Number of SMS</span>
						</div>
                    </div>
                     
                </div>
               <button data-remodal-action="confirm" class="remodal-confirm"style="background-color:#00AEE7;" >Save</button>
			  <button  data-remodal-action="cancel" class="remodal-cancel " >Cancel</button>
			 
    </div>
	
	


                   
<div class="clearfix"></div>




           <!--footer starts-->     
		   <?php //require_once('includes/footer');?>


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

   
    <!-- Bootstrap 3.3.2 JS -->
      <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		

	<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>

  
   <!-- <!-- ChartJS 1.0.1 -->
     <!--<script src="http://www.kptemplates.com/preview/unicorn/js/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>-->

    
    <script type="text/javascript"src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
   

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
	<script type="text/javascript">
  $(function() {
    $('#datetimepicker-custom-1').datetimepicker({
      language: 'en'
    });
  });
</script>


<script type="text/javascript">
  $(function() {
    $('#datetimepicker2').datetimepicker({
      language: 'en'
    });
  });
</script>



<script type="text/javascript">
  $(function() {
    $('#datetimepicker3').datetimepicker({
      language: 'en'
    });
  });
</script><script type='text/javascript'>
        // count normal sms
        $(document).ready(function() {
        
       var text_max='';
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

// count file sms
  var text_max = '';
$('#count_message-F').html(text_max + '');

$('#sms_text_f').keyup(function() {
  var text_length = $('#sms_text_f').val().length;
  var text_remaining = text_max + text_length;
 if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		} 
		
		 $('#count_message-F').html(text_remaining + '');
		    $('#hwmnysms-F').html(persms+ '');
});




// unicode sms count
		
  var text_max = '';
$('#sms_text_unique').html(text_max + '');

$('#sms_text_unique').keyup(function() {
  var text_length = $('#sms_text_unique').val().length;
  var text_remaining = text_max + text_length;
  if(text_remaining>70)
		{
			persms = Math.ceil(text_remaining/63);
		}else
		{
			persms = Math.ceil(text_remaining/70);
		}

  $('#count_message-u').html(text_remaining + '');
    $('#hwmnysms-u').html(persms+ '');
});


    $("#to_mobileno").keydown(function (e) {
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
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	
	 $("#to_mobileno_u").keydown(function (e) {
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
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
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
					
					
	$('#remove_duplictes_u').click(function() {
		
		if ($('#remove_duplictes_u').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno_u").val();
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
		        	$('textarea#to_mobileno_u').val(callback_data);				    
		    	}
			});
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
	
	
	
	
	$('#numbers_count_u').click(function() {
		
		if ($('#numbers_count_u').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno_u").val();
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
 		 <script>
 $(document).ready(function(){

  
  	$('#on_date_f').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});
});
 </script>
 		 <script>
 $(document).ready(function(){

  
  	$('#on_date_u').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});
});
 </script>
 		 <script>
 $(document).ready(function(){

  
  	$('#on_date_c').datetimepicker({	
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
				$('#sms_text_f').val($('#sms_text_unique').val() + e.target.value+'\n');
		}	else
$('#sms_text_f').val($('#sms_text_f').val() + e.target.value+'\n');		
	}
});


</script>
 <script>
$(document).click("click", function(e) {
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text').val($('#sms_text_unique').val() + e.target.value+'\n');
		}	else
$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');		
	}
});


</script>
 <script>
$(document).click("click", function(e) {
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text').val($('#sms_text_unique').val() + e.target.value+'\n');
		}	else
$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');		
	}
});


</script>
 <script>
$(document).click("click", function(e) {
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text_unique').val($('#sms_text_unique').val() + e.target.value+'\n');
		}	else
$('#sms_text_unique').val($('#sms_text_unique').val() + e.target.value+'\n');		
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

<script type="text/javascript">
	$(document).ready( function(){
		
	

		 $('#colum').change(function(){
			 if($('#colum').val()!= "") {
			 	var colum = "#"+$('#colum').val()+"#";
			 	var text = $('textarea#sms_text_c').val();
			 	$('#sms_text_c').val(text+colum);
			 }	
		 });
	
	});
	</script>
   
 </div>
</html>
