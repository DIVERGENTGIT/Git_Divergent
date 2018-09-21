
    
     <style>
 
	 body{background-color: #ECF0F5;}
	 .panel {
    border: none;
    box-shadow: none;
}
.modal {
  position: fixed;
  top: 10%;
  left: 50%;
  z-index: 1050;
  height:240px !important;
  overflow:hidden !important;
  width: 601px !important;
  margin-left: -280px;
  margin-top: -40px !important;
  background-color: #fff;
  border: 1px solid #999;
  border: 1px solid rgba(0,0,0,0.3);
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
  outline: 0;
  -webkit-box-shadow: 0 3px 7px rgba(0,0,0,0.3);
  -moz-box-shadow: 0 3px 7px rgba(0,0,0,0.3);
  box-shadow: 0 3px 7px rgba(0,0,0,0.3);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding-box;
  background-clip: padding-box;
}
input#from_row {
margin-left:21px;
height: 25px;
}

input#to_row {
height: 25px;
}

input#checkit {

width: 253px !important;
overflow: hidden !important;
}
.modal-header .close {
margin-top: 12px !important;
margin-right:40px !important;
}


label.col-sm-3 {
    text-align: right;
}


div#sectionC {
    height: 409px !important;
}
div#sectionA {
    height: 409px !important;
}
div#sectionB {
    height: 409px !important;
}
input#schedule {
    width: 20px !important;
    height: 20px !important;
}

.table thead{background-color: #0073b7 !important;}
.sender_id01 select{padding-top:0px !important;padding-bottom:0px !important;height: 40px !important;height: 30px !important;
line-height: 30px !important;
width: 100% !important;}
</style>
      
<!-- <script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
});
</script>-->


 
 
 
  </head>
  <body>

    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

      <!-- Left side column. contains the logo and sidebar -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
   

		  <section style=" padding-left:0px;">
        <div class="col-sm-12 col-md-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
         <div class="panel panel-default">
             			  
			 
         <div class="panel panel-default col-md-12"  style="padding:0px;">
        <div class="panel-heading" ><strong><span class="glyphicon glyphicon-th"></span> Customized SMS</strong></div>
         <?php if(!isset($uploaded_data)): ?>
		 <div class="panel panel-default col-md-6">
         <div class="col-md-6 " style="top:30px;">
              

<?php 

	echo form_open_multipart('customized/newVariableSMS',
    	$form_attributes = array('id' => 'variable_sms_file_upload', 'name' => 'variable_sms_file_upload')
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

       
		
              </div>
	  		<div class="callout callout col-md-4" style="  padding:5px !important;border:none !important;  margin-right: 40px; margin-top: 27px; background-color:rgb(236, 240, 245) !important; ">
           
<h4 style="color:#F78F50 !important; font-size:16px !important;">Note :</h4>
<p  style="color:#F78F50 !important;">Please Upload Only Excel files. ( xls/xlsx)</p>
</div>		
         <?php endif; ?>

    </div>
          
            </div>
        



        
           
        </div>
        </section>
        <?php 

        if(isset($uploaded_data)): ?>

        <!-- Main content -->
        <section class="content">
		<div style="width:100%; padding:5px; overflow:auto; margin:0px auto; background-color:#fff;">
<?php echo $uploaded_data; ?>
</div>

        <div class="col-md-12 ng-scope" data-ng-controller="formConstraintsCtrl" style="padding:0px;margin: 10px 0px 20px 0px !important;">

 <span style="color:#F00;">
<?php if(!empty($error)){ echo $error;}?>


</span>
            <div class="panel panel-default">
			            	<?php echo form_open('customized/newVariableSMS',
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
              
			
<!--
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
	</div> -->
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
    
    <!-- Bootstrap 3.3.2 JS -->
      <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>


	<script src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/loadingoverlay_progress.min.js"></script>



	<?php
if(isset($validatationtrue) && empty($no_balance)) {

	$start=microtime(true); // dynamic page loading time calculate
	$y=0;
	for($x=0;$x<1000000;$x++)
	{
	$end=round(number_format((microtime(true)-$start),2))*1000;
	}

	?>

	<script>
	var customtext   = "Please do not refresh the Page. !!!!!!";
	var customElement   = $("<div>", 
	{
	id      : "countdown",
	css     : {
	"font-size" : "20px",
	"color"    : "red",
	"margin-top"    : "200px",

	},
	text    : customtext
	});

	$.LoadingOverlay("show", {
	image   : "<?php echo base_url();?>/loading.gif",
	custom  : customElement

	});




	var interval = setInterval(function(){

	customElement.text(customtext);
	if (customtext) {
	clearInterval(interval);
	$.LoadingOverlay("hide");
	window.location = "<?php echo base_url();?>customized/viewcampaigns.html";
	return;

	}

	}, <?php echo $end; ?>);

	</script>



	<?php

	} ?>

	<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
  
    <!-- ChartJS 1.0.1 -->
 <script type="text/javascript"src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.pt-BR.js">
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
	
	
		 $('#colum').change(function(){
			 if($('#colum').val()!= "") {
			 	var colum = "#"+$('#colum').val()+"#";
			 	var text = $('textarea#sms_text').val();
			 	$('#sms_text').val(text+colum);
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

<body>
</html>
