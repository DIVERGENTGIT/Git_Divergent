<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
	
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>	

<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

      <!-- Left side column. contains the logo and sidebar -->
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/sms-icon.png" class="right-title-img">Customized SMS</h3>
</div>

      <!-- Content Wrapper. Contains page content -->
   <div class="col-md-10 col-sm-10 col-xs-12 servicewidth padding_zero">
        <!-- Content Header (Page header) -->
     <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 <p class="errortxt"> 
 	<?php if(isset($error)) { 
 	
 		echo $error; 
 		  
 		}?>
 </p>
 
 </div>
<section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 
 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
      
         <?php if(!isset($uploaded_data)): ?>
<?php 

	echo form_open('campaign/newVariableSMS',
    	$form_attributes = array('id' => 'variable_sms_file_upload', 'class' => 'missedcall_allform', 'name' => 'variable_sms_file_upload')
	); 
?>
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-7 padding_mzero col-md-offset-2 col-sm-offset-2 col-xs-12">
<div class="col-md-7 col-sm-7 col-xs-12 padding_ltzero">
<div class="radiobtn">
 <!-- Updated ON 2017-02-4 
 <input type="radio" class="" id="normsms" name="selector" checked> -->
   <input type="radio" class="" id="normsms"  value='0' name="sms_type" checked>
   
    <label for="normsms" class="mob_lable">Normal SMS</label>
<div class="check"></div>
</div>
</div>
<div class="col-md-5 col-sm-5 col-xs-12 padding_zero">
<div class="radiobtn">


<!-- Updated ON 2017-02-4   
   <input type="radio" class="" id="flashsms" name="selector"> -->
    <input type="radio" class="" id="flashsms"  value='1' name="sms_type"  >
    <label for="flashsms" class="mob_lable">Flash SMS</label>
<div class="check"></div>
</div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-sm-12 tbresp-label padding_zero">
						<span class="form_lable">Campaign Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 tbresp-rt padding_mzero col-sm-12">
						<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => '',
						'value' => set_value('campaign_name'),'style'=>'height:32px;'));?>
						 </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-2 col-sm-2 col-sm-12 tbresp-label padding_zero">
						<span class="form_lable">Sender ID</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 tbresp-rt padding_mzero col-sm-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
						 <?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="form-control"');?> 
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero form_error"><?php
						
						
						 echo form_error('sender'); ?></div>
						 </div>
						 
						  </div>
</div>
  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 
						  <div class="col-md-7 col-sm-7 col-xs-12 col-sm-offset-2 tbresp-rt padding_mzero col-md-offset-2">
						  <div class="col-md-12 col-sm-12 col-xs-12 form-divadd add-btns-div padding_zero">
						
						 <!-- Updated ON 2017-02-4 -->
						<span class="add-btns-divspan add01span"><a href="#addtemplatemodel" data-toggle="modal" class="add_pluse" data-target="#addtemplatemodel" onClick="getTemplatesInfo();">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Template</span>
                                </a></span>
								<span class="add-btns-divspan add02span"><a href="#addshorturlmodel" data-toggle="modal" class="add_pluse" data-target="#addshorturlmodel">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Short URL</span>
                                </a></span>
								<span class="add-btns-divspan add02span">
					<a href="#addmissedcallmodel" data-toggle="modal" class="add_pluse" data-target="#addmissedcallmodel">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Missed Call</span>
                                </a>
                                </span>
						
						 </div>
						 
						  </div>
</div>
 <div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
    <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
                    <label class="form_lable">Text </label>
					</div>
                   <div class="col-sm-7 col-md-7 tbresp-rt padding_mzero col-xs-12">
				    <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
					<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text', 'placeholder' => 'Type here', 'rows' => 4, 'cols' => 30, 'class' => '', 'value' => set_value('sms_text')));?>
</div>
           <div class="col-sm-12 col-md-12 col-xs-12 padding_zero"> 
<div class="col-md-6 col-sm-6 col-xs-6 numwfull padding_zero">		   
                        <h6  class="label count_message count_num" id="count_message">0</h6><small>Number of Characters</small>
</div>
<div class="col-md-6 col-sm-6 col-xs-6 numwfull pull-right txt_alignrt padding_zero">
                        <span class="label count_message count_num" id="hwmnysms">0</span><small>Number of SMS</small>
						</div>
							</div>
						<div class="col-sm-12 col-md-12 col-xs-12 padding_zero form_error"><?php
						
						
						 echo form_error('sms_text'); ?></div>
                    </div>
                    
		                    
                </div>


 
 
 
	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	  <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
                    <label class="form_lable">Upload File</label>
					</div>
		<div class="col-md-7 col-sm-7 col-sm-12 tbresp-rt padding_mzero">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
			<span class="btn submit_btn btn-file"><span>Upload</span><input type="file" name="userfile" id="userUploadedFile" onChange="getUploadedFile();"></span>
				<!--<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'class' => '', 'value' => set_value('userfile')));?>
		         -->
				 <p id="uploaded_upfile"> </p>
				 </div>
				 <div class="col-md-9 col-sm-9 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Please upload xls,xlsx filetypes and size must be less than 20MB</li>
</ul>
 </div>
<div  class="col-md-12 col-sm-12 col-xs-12 padding_zero" style="color:#F00; !important; border: 0px;">
<p id="sizeError"  ></p>
</div> 
 </div>  

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<p style="color:red;" id="fileupload_error"></p>
</div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <p id="uploaded_img"></p>
</div>	       

		</div>
	</div>
  


	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero" id="load01_file_view" style="display:none;">

							  <div class="col-md-7 col-sm-7 col-sm-offset-2 col-md-offset-2 tbresp-rt padding_mzero col-sm-12">
							  
						
							<a href="#custumsmsmodel" data-toggle="modal"  data-target="#custumsmsmodel" class="addhomebt pull-left add_mrnumb">
		                            <i class="fa fa-plus"></i>
		                            <span>Customize your Data</span>
		                        </a>
							   
							  </div>
	</div>
 

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-7 col-sm-12 col-sm-offset-2 tbresp-rt padding_mzero col-md-offset-2">

  <input type="hidden" name="shorturl_text[]" id="shorturl_text1"  />
  <input type="hidden" name="shorturl_text[]" id="shorturl_text2"  />
  <input type="hidden" name="shorturl_text[]" id="shorturl_text3"  />
  <input type="hidden" name="shorturl_text[]" id="shorturl_text4"  />


  <input type="hidden" name="shorturl_input[]" id="shorturl_input1" />
  <input type="hidden" name="shorturl_input[]" id="shorturl_input2" />
  <input type="hidden" name="shorturl_input[]" id="shorturl_input3" />
  <input type="hidden" name="shorturl_input[]" id="shorturl_input4" />

 <input type="hidden" name="mobile_column" id="mobile_column"  />    
  <input type="hidden" name="from_row" id="from_row" />
 <input type="hidden" name="to_row" id="to_row"  />
    
 
<!-- <a class="submit_btn">  <?php echo form_submit(array('name' => 'file_upload','value' => 'Upload', 'style' => ''));?> </a>

<input type="submit" class="submit_btn" name="file_upload">-->

<input type="submit" class="submit_btn" value="Send" name="sendsms">
 </div>
 </div>
 <?php echo form_close(); ?>
 <?php endif; ?>
</div>

        </section>



    </div><!-- ./wrapper -->

 <script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
 <script src=" <?php echo base_url();?>js/jquery.validate.file.js" type="text/javascript"></script>

 
	
	<script>
$(document).ready(function(){

$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");


$("#video_file_upload").validate({
    rules: {
	file_input: {
          required:true,
           extension: "mp4",
maxFileSize: {
"unit": "MB",
 "size": 10
}		   
        },
		short_url_video: {
			required:true
		}


    },
	messages: {
		file_input: {
            required: "Please Upload Video File",
            extension: "Please Upload MP4 Formate"	            
        }

    },
  
	tooltip_options: {
    	file_input: {placement:'bottom',html:true},
		short_url_video: {placement:'bottom',html:true}
		}
});  
}); 
 </script>
 <script>
$(document).ready(function(){
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");

 
$("#audio_file_upload").validate({
    rules: {
	file_input: {
          required:true,
           extension: "mp3",
          maxFileSize: {
"unit": "MB",
 "size": 2
}	  
        },
		short_url_audio: {
		required:true
			
		}

    },
	messages: {
		file_input: {
            required: "Please Upload Audio File",
            extension: "Please Upload MP3 Formate",
            maxFileSize: "File cannot larger than 2MB"			
        }

    },
  
	tooltip_options: {
    	file_input: {placement:'bottom',html:true},
		short_url_audio: {placement:'bottom',html:true}
		}
});  
}); 
 </script>
 <script>
$(document).ready(function(){
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");


$("#imge_validation").validate({
    rules: {
        image_input: {
            required: true,
             extension: "jpg|png",
 maxFileSize: {
"unit": "MB",
 "size": 1
}			 
        },
   short_url_image: {
	required: true
	
}
    },
    messages: {
        image_input: {
            required: "Please Upload File",
            extension: "Please upload jpg,png Extentions"            
        }
			
    },
	
	tooltip_options: {
		image_input: {placement:'bottom',html:true},
		short_url_image: {placement:'bottom',html:true}
		}
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
				callback_data = $.trim(callback_data);	        	
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
				callback_data = $.trim(callback_data);		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	//alert(callback_data);
		        	// ADDED ON 2017-01-31
		        	alert($.trim(callback_data));
		        	
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
   
   <?php
//ADDED ON 2017-01-23



$api_url= $UrlGenIp;
//$api_url= 'http://ion.bz';

//$api_url= 'http://10.10.10.199/shorturl/';

?>
 <script>
 /* ADDED ON 2017-02-7
$(document).click("click", function(e) {
	if ((e.target.id == "checkit2")) 
		{ 
 
 		if((e.target.id != "if") && (e.target.id != "while")) {

				if ($(".short_input").val().match(/http:\/\//) || $(".short_input").val().match(/https?:\/\//) || $(".short_input").val().match(/www./)) {

  var txt = $.trim($(".short_input").val());
   var box = $("#sms_text");



   $.ajax({
	url: '<?php echo $api_url?>/api.php',
	type: 'POST',
      	data: {
         	get_shorturl: 'success',user_url: txt,user_id:'<?php echo $user_id ?>'
      	},
	dataType: "JSON",
	success: function(data) {
									

//box.val(box.val() + "http://ion.bz/"+data+'\n');
box.val(box.val() + '<?php echo $api_url?>'+data+'\n');


$("#shorturltext").val('<?php echo $api_url?>'+data+'\n');

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
	},
	error: function(){

	console.log('i am here');
               alert("error");
        }
   });
		}
		else
		{
			
	 alert("Invalid URL");
		}		

	
	
		}	
		
	}
});

*/



 
$(document).click("click", function(e) {
	
	if ((e.target.id == "checkit2")) 
		{ 
 
 		if((e.target.id != "if") && (e.target.id != "while")) {

 
				if ($(".shorturlenter").val().match(/http:\/\//) || $(".shorturlenter").val().match(/https?:\/\//) || $(".shorturlenter").val().match(/www./)) {
				
 	
 
     var txt = $.trim($(".shorturlenter").val());
    if (!txt.match(/https:\/\//)) {
 	 if (!txt.match(/http:\/\//)) {
 	txt = 'http://'+txt;    
  }
      }
  
  // Changing iframe  

  $("#load_frame").attr("src",txt); 
 
var urlInput = $("#shorturl_input1");
   urlInput.val(urlInput.val() + txt );
  


   $.ajax({
	url: '<?php echo $api_url?>api.php',
	type: 'POST',
      	data: {
         	get_shorturl: 'success',user_url: txt,user_id:'<?php echo $user_id ?>'
      	},
	dataType: "JSON",
	success: function(data) {
									
 

$("#checkshorturl").val('<?php echo $api_url?>'+data+'\n');

var urltext = $("#shorturl_text1");
   urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
   
	},
	error: function(){

	console.log('i am here');
              // alert("error");
        }
   });
		}
		else
		{
			
	 alert("Invalid URL");
		}		

	
	
		}	
		
	}
});



</script>


  
<script>
/** ADDED ON 2017-02-7
  * SHOW UPLOADED CUSTOM FILE IN POPUP
  */
   
function getUploadedFile() { 
	$('#load01_file_view').hide(); 
	$('#sizeError').text('');
	document.getElementById("uploadedFileData").innerHTML = "";
	document.getElementById("uploadedFileMobileColumns").innerHTML = "";
	document.getElementById("uploadedFileColumns").innerHTML = "";
	document.getElementById("read_from_row").innerHTML = "";
	var file = $("#userUploadedFile").prop('files')[0];
 	var ext = $("#userUploadedFile").val().split('.').pop().toLowerCase();
 	var size = file.size / 1048576;
 	if(size > 30){
		  $('#sizeError').text("Allowed file size exceeded. (Max. 30 MB) ");
	}else if($.inArray(ext, ['xls','xlsx']) == -1) {
	  	$('#sizeError').text('Uploaded file is not a valid extension!');
	  
	}else{    
 
	   	 $('#uploaded_upfile').text(file.name);  
 
	  
  
	 $('#fileupload_error').text(''); 
	 var formData = new FormData(document.getElementById("variable_sms_file_upload")); 
 	   $.ajax({
		url: "<?php echo base_url();?>campaign/uploadCustomSmsFile",
		type: "POST",
 		enctype: 'multipart/form-data',  
    		processData: false,  // tell jQuery not to process the data
   		 contentType: false,
	      	data: formData,
   		success: function(data) { 
			console.log(data);    
		 	  
			 var result = $.parseJSON(data);  
   
			if(result.error != '') {  
				//console.log(result.error);
				$('#load01_file_view').hide(); 
				$('#fileupload_error').text(result.error);
			}else if(result.uploaded_data != '') {	
			     	$('#load01_file_view').show(); 
				$('#fileupload_error').text('');  
	   			$('#uploadedFileMobileColumns').find('option').remove(); 
	   			$('#uploadedFileColumns').find('option').remove(); 
	   			var mobileno_positions = '<option value="" selected="selected">-- Select Mobile Number Column --</option>';
				var number_of_positions = '<option value="" selected="selected">-- Select Message Columns --</option>';
				$('#uploadedFileData').append(result.uploaded_data);
				$.each(result.columns, function (i, item) {    
	 
	 				number_of_positions += '<option value='+i+'>'+item+'</option>';
					mobileno_positions += '<option value='+i+'>'+item+'</option>';

				});    
  
				$('#uploadedFileMobileColumns').append(mobileno_positions); 
				$('#uploadedFileColumns').append(number_of_positions); 
				$('#read_from_row').val('2');  
				$('#read_to_row').val(result.total_rows);  

			}else{
				$('#fileupload_error').text('The file is not readable.');
			}   
   			   
		}  
	}); 

	 //var file = $("#userUploadedFile").prop('files')[0];
	
	 /*$.ajax({
		url: "<?php echo base_url();?>campaign/uploadCustomSmsFile",
		type: "POST",
	      	data: {'uploaded_file':file.name}, 
   		success: function(data) {   

   			var result = $.parseJSON(data);          
   			$('select#uploadedFileMobileColumns').find('option').remove(); 
   			$('select#uploadedFileColumns').find('option').remove(); 
   			var number_of_positions = '<option value="" selected="selected">--select--</option>';
 
			$('#uploadedFileData').append(result.uploaded_data);
			$.each(result.columns, function (i, item) {    
 
 				number_of_positions += '<option value='+i+'>'+item+'</option>';
			});

			$('#uploadedFileMobileColumns').append(number_of_positions); 
			$('#uploadedFileColumns').append(number_of_positions); 
   
		}
	});  */ 
	}
}   
</script>


<script>

function submitFileData() {
	var message = $('#selectedColumn').val();
	var from_row = $('#read_from_row').val();
	var to_row = $('#read_to_row').val();
        var mobile_column = $('#uploadedFileMobileColumns').val();
        
	var box = $("#sms_text");  
	box.val(box.val() + message +'\n');
        $('#mobile_column').val(mobile_column); 
	$('#from_row').val(from_row); 
	$('#to_row').val(to_row); 
}

</script>




<script>

function addSelectedColumns() {
 	var colum = "#"+$('#uploadedFileColumns').val()+"#";
	var text = $('textarea#selectedColumn').val();
	$('#selectedColumn').val(text+colum);
} 

</script>


<script>
 
function submit_url() {

	var url_input =$('#shorturl_input1').val();
	var url_text = $('#shorturl_text1').val(); 
	//alert(url_input+ ', ' +url_text);
if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
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
  }
 
}
</script>
 

<script>
 
$(document).ready(function() {
	$('form#imge_validation').submit(function(e)  {
 		e.preventDefault();

	var url_input =$('#shorturl_input2').val();
	var url_text = $('#shorturl_text2').val();   
 
	if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
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
 $('#addshorturlmodel').modal('hide');

		}
	   
	});
});
</script>
 

<script>
 
$(document).ready(function() {
	$('form#video_file_upload').submit(function(e)  {
 		e.preventDefault();

var url_input =$('#shorturl_input3').val();
	var url_text = $('#shorturl_text3').val();   
 
	if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
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
   $('#addshorturlmodel').modal('hide');
}
 
});
});
</script>
 
<script>
 
$(document).ready(function() {
	$('form#audio_file_upload').submit(function(e)  {
 		e.preventDefault();

	var url_input =$('#shorturl_input4').val();
	var url_text = $('#shorturl_text4').val();   
 
	if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
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
 $('#addshorturlmodel').modal('hide');
}
 
});
});
</script>
<script>
   
  function upload_audio() {
//$(document).ready(function() {
	//$('form#audio_file_upload').submit(function(e) { 
 var file = $("#audio_input").prop('files')[0];
		var ext = $("#audio_input").val().split('.').pop().toLowerCase();
		var size = file.size / 1048576;
		 if($.inArray(ext, ['mp3']) == -1) {
		  	//alert('invalid extension!');  
		}else if(size > 2){
			//alert("Allowed file size exceeded. (Max. 10 MB) ");
		}else{
	 var formData = new FormData(document.getElementById("audio_file_upload")); 
	 console.log(formData);
 	   $.ajax({
		url: "<?php echo base_url();?>campaign/upload_file_data",
		type: "POST",
 		enctype: 'multipart/form-data',  
    		processData: false,  // tell jQuery not to process the data
   		 contentType: false,
	      	data: formData,  
   		success: function(data) {  
			console.log(data);
			var file_location = $.trim(data);  
			if(file_location != '') { 
		  	 var player = document.getElementById('audio_play');

				 var mp4Vid = document.getElementById('audio_frame');

				 player.pause(); 
				 // Now simply set the 'src' property of the mp4Vid variable!!!!

				  mp4Vid.src = file_location; 
				  player.load();
				  player.play();
 
		  		 var urlInput = $("#shorturl_input4");
				  urlInput.val(urlInput.val() + file_location );
		  		 $.ajax({
					url: '<?php echo $api_url?>/api.php',
					type: 'POST',
				      	data: {
					 	get_shorturl: 'success',user_url: file_location,user_id:'<?php echo $user_id ?>'
				      	},
					dataType: "JSON",
					success: function(data) { 	 
						$("#short_url_audio").val('<?php echo $api_url?>'+data+'\n');
						var urltext = $("#shorturl_text4");
						  urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
			
					},
					error: function(){

						//console.log('i am here');
						     //  alert("error");
					}
				});
			}else{
					$('#error_audio').text('Uploaded file is not a valid MIME type.');
				}
		}  
	});
	}
	//e.preventDefault(); 
	//});
//});  
}
</script>
<script>
   function upload_video() { 
//$(document).ready(function() {
	//$('form#video_file_upload').submit(function(e) {
 var file = $("#video_input").prop('files')[0];
		var ext = $("#video_input").val().split('.').pop().toLowerCase();
		var size = file.size / 1048576;
		 if($.inArray(ext, ['mp4']) == -1) {  
		  	//alert('invalid extension!');
		}else if(size > 10){
			//alert("Allowed file size exceeded. (Max. 10 MB) ");
		}else{
	 var formData = new FormData(document.getElementById("video_file_upload")); 
 	   $.ajax({
		url: "<?php echo base_url();?>campaign/upload_file_data",
		type: "POST",
 		enctype: 'multipart/form-data',  
    		processData: false,  // tell jQuery not to process the data
   		 contentType: false,
	      	data: formData,  
   		success: function(data) {  
			var file_location = $.trim(data);  
			if(file_location != '') {
 				  var player = document.getElementById('video_play');

					  var mp4Vid = document.getElementById('video_frame');

					 player.pause(); 
					 // Now simply set the 'src' property of the mp4Vid variable!!!!

					  mp4Vid.src = file_location; 
					  player.load();
					  player.play();
			  		var urlInput = $("#shorturl_input3");
					urlInput.val(urlInput.val() + file_location );
		  		 $.ajax({
					url: '<?php echo $api_url?>/api.php',
					type: 'POST',
				      	data: {
					 	get_shorturl: 'success',user_url: file_location,user_id:'<?php echo $user_id ?>'
				      	},
					dataType: "JSON",
					success: function(data) { 	 
						$("#short_url_video").val('<?php echo $api_url?>'+data+'\n');
						var urltext = $("#shorturl_text3");
						   urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
			
					},
					error: function(){

						//console.log('i am here');
						      // alert("error");
					}
				});
			}else{
					$('#error_video').text('Uploaded file is not a valid MIME type.');
				}
		}
	});
}
	//e.preventDefault(); 
	//});
//});  
}

</script>
 

<script>

function upload_image() {    
   //var file = $("#image_input").prop('files')[0]['name'];
   var file = $("#image_input").prop('files')[0];
   var reader = new FileReader(); // instance of the FileReader
      reader.readAsDataURL(file);
      reader.onloadend = function(){ // set image data as background of div 
          var ext = $("#image_input").val().split('.').pop().toLowerCase();
		var size = file.size / 1048576;
		 if($.inArray(ext, ['jpg','png']) == -1) {
		  	//alert('invalid extension!');
		}else if(size > 1){
			//alert("Allowed file size exceeded. (Max. 10 MB) ");
		}else{ 
          $.ajax({
          	url:"<?php echo base_url();?>index.php/campaign/upload_encoded_image",
          	type:"POST",
          	data:{'image_data' : this.result },
          	success:function(data) {
          		 //console.log(data);
          		var file_location = $.trim(data);
          		//$('#encoded_data').val(file_location); 
          		$("#load_frame1").attr("src", file_location);  
          		var urlInput = $("#shorturl_input2");
			urlInput.val(urlInput.val() + file_location ); 
          		 $.ajax({
				url: '<?php echo $api_url?>/api.php',
				type: 'POST',
			      	data: {
				 	get_shorturl: 'success',user_url: file_location,user_id:'<?php echo $user_id ?>'
			      	},
				dataType: "JSON",
				success: function(data) { 	 
					$("#short_url_image").val('<?php echo $api_url?>'+data+'\n');
					var urltext = $("#shorturl_text2");
					   urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
			
			
				},
				error: function(){

					//console.log('i am here');
					     //  alert("error");
				}
			});
          	}
          });	
   
	 }
          
      }   
}   

</script>
 
 
 
 
<script>

/** ---------  Template start --------  **/

/** 
  * ADDED ON 2017-02-3
  * Create template     
  */  


function CreateTemplate() {
	var template = $("#template").val();
	var template_name = $('#template_name').val();
	var templateId = $('#templateId').val();
	$('#template_status').text('');
 	if(template_name == '' || template == '') {
		$('#template_status').append('<div class="alert a" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a>Please enter valid Template and Template Name.</div>'); 
	}else{ 
		 $.ajax({
			url:"<?php echo base_url();?>index.php/campaign/templates",  
			type:"post",
			data:{'template':template,'template_name':template_name,'templateId':templateId},
			success:function(data) { 
				$('#template_status').text('');
					$('#template_name').val('');
					$('#template').val('');		
					$('#templateId').val('');
				if(data == 1) {
	 				$('#template_status').append('<div class="alert a" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template has been Added </div>'); 
	 			
	 			}else if(data == 2) {
	 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template has been Updated </div>'); 
	 			
	 			}else if(data == 3) {
	 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template name aleady added, Please choose another Name</div>'); 
	 			
	 			}else if(data == 4) {
		 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a>Template Name should be less than 15 characters</div>'); 
		 			
		 		}else{
	 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template Not Added</div>'); 
	 			
	 			}
	 			getTemplatesInfo(); 
			}
		}); 
	} 
	
}
 
/**
  * ADDED ON 2017-02-3
  * Count template content characters
  */ 
   
function countCharacters() {   
	var text_max = 0; 
	var text_length = $('#template').val().length;
	var text_remaining = text_max + text_length;
	//console.log(text_length);
	if(text_remaining>160)
	{
		persms = Math.ceil(text_remaining/153);
	}else
	{
		persms = Math.ceil(text_remaining/160);
	}
	$('#count_message1').html(text_remaining + '');
	$('#hwmnysms1').html(persms+ '');
 
}


</script>

<script>


/** ADDED ON 2017-02-3 
  * Get templates
  **/ 
function getTemplatesInfo() {
 
	$.ajax({
		url:"<?php echo base_url();?>index.php/campaign/getTemplates",
		type:"post", 
		success:function(data) {  
			$('#temp_info').text('');  
			 $('#temp_info').append(data);    
			/*$('.templatesData').text('');
			//$('#templateNames').text('<option>Select Campaign Name</option>');
 			var templates = $.parseJSON(data);
 			var tbody = '';
 			var templateNames = '';
                
			$.each(templates, function (i, item) {	
				  var currentText = item.template;	
			    var result =  currentText.substr(0, 100); 
 
			    tbody += '<tr><td>' + item.template_id + '</td><td>' +item.on_date + '</td><td><p class="wordwraptxt">' +result + '...</p></td><td>' +item.template_name + '</td><td><button data-dismiss="modal" onClick="selectTemplateContent('+item.template_id+');">select</button>  <button onClick="editTemplateContent('+item.template_id+');">edit</button> </td></tr>';
 
			 //  templateNames += '<option value='+item.template_name+'>'+item.template_name+'</option>';
			});
	       
			$('.templatesData').append(tbody);  
			//$('#templateNames').append(templateNames);  */  
		}    
	});

};




</script>



<script>

/**
  * ADDED ON 2017-02-3
  * Select campaign template content
  */
function campaignTemplateContent(campaign_id) { 	
 	  $.ajax({
		url:"<?php echo base_url();?>index.php/campaign/getSelectedCampaignTemplateContent",
		type:"post", 
		data:{'campaign_id':campaign_id},
		success:function(res) {  
 			 var result = $.parseJSON(res);
 			 
 			  var box = $("#sms_text");  
			  box.val(box.val() + result[0].sms_text +'\n'); 
 
 		}  
 	});	 
}

</script> 

<script>

/**
  * ADDED ON 2017-02-3
  * Select template content
  */
function selectTemplateContent(template_id) { 
	
 	  $.ajax({
		url:"<?php echo base_url();?>index.php/campaign/getSelectedTemplateContent",
		type:"post", 
		data:{'template_id':template_id},
		success:function(res) {  
 			 var result = $.parseJSON(res);
 			  var box = $("#sms_text");
			  box.val(box.val() + result[0].template +'\n'); 	
 
 		}
 	});	 
}

</script> 


<script>

/**
  * ADDED ON 2017-02-3
  * Select template content
  */
function editTemplateContent(template_id) { 
	event.preventDefault();
	 $('#template').text();
 	  $.ajax({
		url:"<?php echo base_url();?>index.php/campaign/getSelectedTemplateContent",
		type:"post", 
		data:{'template_id':template_id},
		success:function(res) {  
 			 var result = $.parseJSON(res); 
 
 			 $('#template').val(result[0].template);
 			 $("#template_name").val(result[0].template_name);
 			 $('#templateId').val(result[0].template_id); 
 			 countCharacters();
 		}
 	});	 
}  

</script>  


 

<script> 


/** ADDED ON 2017-02-3 
  * Get recent templates by From & To dates
  **/ 
function getRecentTemplates() {
	var to_date = $('#to_date').val();
	var from_date = $('#from_date').val();
	//var template_name = $('#templateNames').val();
	
	 $.ajax({
		url:"<?php echo base_url();?>index.php/campaign/getRecentTemplates",
		type:"post", 
		//data:{'to_date':to_date,'from_date':from_date,'template_name':template_name},
		data:{'to_date':to_date,'from_date':from_date },
		success:function(data) { 
 
			$('.recenttemplatesData').text(''); 
 			var templates = $.parseJSON(data);
 			var tbody = '';        var count = 0;              
			$.each(templates, function (i, item) {
			count +=1;			    
			    tbody += '<tr><td>' +count  + '</td><td>' +item.created_on + '</td><td>' +item.sms_text + '</td><td><button data-dismiss="modal" class="btn btn-sm btn-default" onClick="campaignTemplateContent('+item.campaign_id+');">select</button> </td> </tr>'; 
  
			});  
	       
			$('.recenttemplatesData').append(tbody);   

			 
		}    
	});

}

/** ----------  Template end ------- **/

</script>

 
 
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


<!-- SMS Model Start -->
  <div class="modal fade" id="custumsmsmodel" role="dialog">
   <div class="modal-dialog custom-dialog02">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12">
<button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-8 col-sm-8 col-xs-12" id="uploadedFileData">
	
        		<!-- <table class="table_all"> 
			<thead>
			<tr><th>S.no</th><th>Date</th><th>Sender</th><th>SMS Text</th><th>No. of SMS</th>
			<th>Status</th>
			</tr>
			</thead>
			<tbody>
				<tr>

				<td>1</td>
				<td>01-03-2016</td>
				<td>Name1</td>
				<td>Test Msg</td>
				<td>345436</td>
				<td>Done</td>
				</tr>
		
			</tbody>
	       		 </table> -->

 		</div>
 <div class="col-md-4 col-sm-4 col-xs-12 missedcall_allform">
 <!-- ADDED ON 2017-02-8 
 <form class="missedcall_allform">  -->
<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">
	<select  id="uploadedFileColumns" onChange="addSelectedColumns();">
 
	</select>    
 

 
</div>
<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">
<textarea id="selectedColumn"></textarea>
</div>
<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">

	<select  id="uploadedFileMobileColumns">
 
	</select>

<div class="form_error"><?php
	  echo form_error('mobile_column'); ?></div>
 
</div>
<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">
<span class="select_rowcolr">Select Rows</span>
<span class="row_input"><input type="text" id="read_from_row" placeholder="From"></span>
<span class="row_input pull-right"><input type="text" id="read_to_row" placeholder="To"></span>
</div>
<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">
<!-- <input type="submit" name="" value="Preview" class="pull-left submit_btn"> -->
<input type="submit" name="" value="submit" class="pull-right submit_btn" onClick="submitFileData();" data-dismiss="modal">
</div>
<!-- </form> -->
 </div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Model End -->

  <!-- missedcall start-->
 <?php  
 $this->load->view("missedcall_payments/missedcall");
 ?>
 <!-- missedcall End-->
	 <!-- short url Model Start -->
  <div class="modal fade" id="addshorturlmodel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12"> 
 <ul class="addshorttabs">
 
  <!-- Updated ON 2017-02-4 -->
        <li class="currentshorttab"><a href="#shorturltb">Web Short URL</a></li>
        <li><a href="#shorturlimgeurltb">Image Short URL</a></li>
       <li><a href="#shorturlvideo">Video Short URL</a></li>
        <li><a href="#shorturlaudio">Audio Short URL</a></li>
    </ul>  
    <div class="smsadmintabdiv">
        <div id="shorturltb" class="shortadmintab-content">
		<form class="col-md-12 col-sm-12 col-xs-12 padding_zero" id="shorturl_valid_modl" method="post">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <input type="text" name="shorturlenter" placeholder="www.example.com" class="shorturlenter"> <input type="button" id="checkit2"   class="gobtn" value="Go">
        </div>
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short URL</label>
		</div>
		 <!-- Updated ON 2017-02-4 -->
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		  <div class="col-md-6 col-sm-6 col-xs-12 padding_ltzero">
         <input type="text" name="checkshorturl" id="checkshorturl" readonly placeholder="Your Short URL" value="" class="shorturl-txt">
		 </div>
		 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		 <input type="submit"  onClick="submit_url();"  class="submit_btn" data-dismiss="modal" value="Submit">
		 </div>
		 </div>
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			<iframe class="iframe-shorturl" id="load_frame" src="http://www.firstring.in/"></iframe>

     
		 <img src="<?php echo base_url();?>images/short-url-mobile.png" alt="short url preview" class="img-responsive">
		  <!-- Updated ON 2017-02-4 -->
		 
		 </div>
		 </div>
		 
        </div>
		</form>
		</div>
        <div id="shorturlimgeurltb" class="shortadmintab-content" style="display:none;">
		<form id="imge_validation" class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
      <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	  <div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
         <span class="select-yourimage">Select Your Image</span>
		 </div>
		 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		 
<div class="fileUpload btn submit_btn">  
    <span>Upload</span>
    <input id="image_input" name="image_input" type="file" class="upload" onChange="upload_image();"  />
</div>
		 </div>
		 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Upload only jpg,png filetypes and size must be less than 1MB.</li>
</ul>
 </div>
        </div>
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short image URL</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
         <input type="text" id="short_url_image" name="short_url_image" readonly placeholder="Your Short URL" class="flinp-width shorturl-txt">
		 </div>
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 <input type="submit" id="submit_url_image"  class="submit_btn" value="Submit">
		</div>
		</div>
		
		
        </div>
		</form>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 
		 <img src="<?php echo base_url();?>images/short-url-img-mob.png" id="load_frame1" alt="short url preview" class="mob-inner-shortimg img-responsive"> 
		 <img src="<?php echo base_url();?>images/short-url-mobile.png" alt="short url preview" class="img-responsive">
		   <!-- Updated ON 2017-02-4 -->
		 
		 </div>
		 </div>
		 
        </div>
        
        </div>
		<div id="shorturlvideo" class="shortadmintab-content" style="display:none;">
 			 <form id="video_file_upload" name="video_file_upload" method="post" enctype="multipart/form-data" action="#" >   
	     			
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				 	<input type="hidden" name="filetype" value="video"/>
 <p class="errortxt" id="error_video"> </p>
			  		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
					 <span class="select-yourimage">Select Your Video</span>
				 	</div>
					 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
				 
					<div class="fileUpload btn submit_btn">
					    <span>Upload</span>
					    <input id="video_input" name="file_input" onChange="upload_video();"  type="file" class="upload" />
					</div>
					 </div>
					 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Upload only MP4 filetypes and size must be less than 10MB.</li>
</ul>
 </div>
				  </div>
				  <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
				  
		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short Video URL</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
                <input type="text" id="short_url_video" name="short_url_video" placeholder="Your Short URL" readonly class="shorturl-txt flinp-width">
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 <input type="submit"  id="submit_url_video" class="submit_btn" value="Submit">
		</div>
		</div>
		
		  
        </div>
			 </form>  
       		
 
		
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 
		 <video width="100%" height="240" controls id="video_play">

			  <source src="<?php echo base_url();?>video/videoplayback.mp4" type="video/mp4" id="video_frame"  > 
			Your browser does not support the video tag.
		</video>
		 

		 </div>  
		 </div>
		 
        </div>  
        
        </div>
      <div id="shorturlaudio" class="shortadmintab-content" style="display:none;">
	 <form id="audio_file_upload" name="audio_file_upload" method="post" enctype="multipart/form-data" action="#">
 
     		 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				 	<input type="hidden" name="filetype" value="audio"/>
 <p class="errortxt" id="error_audio"> </p>
		  <div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
		 <span class="select-yourimage">Select Your Audio</span>      
			 </div>
			 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						 
				<div class="fileUpload btn submit_btn">
				    <span>Upload</span>
				    <input  id="audio_input" name="file_input" onChange="upload_audio();" type="file" class="upload" />
				</div>
			 </div> 
<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Upload only MP3 filetypes and size must be less than 2MB.</li>
</ul>
 </div>	
</div> 
			 <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
			<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
			<label class="shorlurl-lable">Short Audio URL</label>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		 <input type="text" id="short_url_audio" name="short_url_audio" placeholder="Your Short URL" readonly class="flinp-width shorturl-txt">
		 </div>
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			 <input type="submit" id="submit_url_audio"  class="submit_btn" value="Submit">
			</div>
			</div>
			
		
        </div>
		</div>
			 </form>
      		  
			
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 
		<audio controls id="audio_play">
 
  <source src="<?php echo base_url();?>audio/test-file.wav" type="audio/mp3" id="audio_frame" >
Your browser does not support the audio element.
</audio>
		 
		 </div>
		 </div>
		 
        </div>
        
        </div>
       
    </div>
</div>

        </div>
        
      </div>
      
    </div>
  </div>
  <!-- short url Model End -->
  
  <!-- SMS Model Start -->
  <div class="modal fade" id="addtemplatemodel" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
         <ul class="addtemptabs">  
         
          <!-- Updated ON 2017-02-4 -->
        <li class="currenttemptab"><a href="#template-model" onClick ="getTemplatesInfo();">Template</a></li>
        <li><a href="#recentemplate-model" onClick ="getRecentTemplates();">Recent Template</a></li>
       
        
    </ul>
	<div class="smsadmintabdiv">
	 <div id="template-model" class="tempadmintab-content">
 
	<form class="missedcall_allform" method="post" >
	
	     <!-- Updated ON 2017-02-4 -->
		<div class="col-sm-12 col-md-12 col-xs-12 padding_zero" id="template_status">
        	<!-- Template Status content -->
		 
		</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
         	
						<span class="form_lable">Template Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-8 col-xs-12 padding_mzero">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  
						   <!-- Updated ON 2017-02-4 -->
						   <input type="hidden"  name="templateId" id="templateId" >
						  <input type="text" class="valuetemptxt" name="template_name" id="template_name" placeholder="Template Name">
						
						 </div>
						 
						  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
						<span class="form_lable">SMS Content</span> 
						 </div>
						  <div class="col-md-7 col-sm-8 padding_mzero col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  
						   <!-- Updated ON 2017-02-4 -->
						  <textarea class="valuetemparea" name="template" onkeyup="countCharacters();" id="template" placeholder="Type here"></textarea>
						  
						 </div>
						 
						  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-8 col-md-offset-3 col-sm-offset-3 padding_mzero col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
						 <div class="col-md-6 col-sm-6 col-xs-6 tempnumod padding_zero">
						  
						   <!-- Updated ON 2017-02-4 -->
						 <span id="count_message1" class="count_num">0</span><span class="count_txt07">Number Of Characters</span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 tempnumod txt_alignrt padding_zero">
						
						 <!-- Updated ON 2017-02-4 -->
						  <span id="hwmnysms1" class="count_num">0</span><span class="count_txt07">Number Of SMS</span>
						</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						 
						 
						  <!-- Updated ON 2017-02-4 -->
						 <input type="button" name="" class="temp-append-btn submit_btn"   value="Save" onClick="CreateTemplate();">
</div>
						</div>
						</div>
</form>
<div class="col-md-12 col-sm-12 form-div col-xs-12" >
	<div class="row">
		<div class="col-md-12 col-sm-12 form-div padding_mzero col-xs-12" id="temp_info">
			 
		</div>
	</div>
	
	
</div>
</div>
 
</div>
 <div id="recentemplate-model"  class="tempadmintab-content" style="display:none">
  <div class="col-md-12 col-sm-12 mrgbtom55 col-xs-12 missedcall_allform padding_zero">
  <ul class="search-list05 missedcall_allform">
<li>
<input type="text" id="from_date" name="" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg">
</li>
<li>
<input type="text" id="to_date" name="" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg">
</li>
<li>
 <input type="submit" class="submit_btn" value="Search" onClick="getRecentTemplates();">
</li>
</ul>

  </div>
 <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
  <div class="table-responsive">
<table class="table_all">
	<thead>
	<tr><th>S.No</th><th>Date</th><th>Template</th><th>Action</th></tr>
	</thead>
	 <!-- Updated ON 2017-02-4 -->
	<tbody class="recenttemplatesData">
	 
	</tbody>
</table>
 </div>
 </div>
  </div>
</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Model End -->
  <script>
$(document).ready(function() {
    $(".addtemptabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currenttemptab");
        $(this).parent().siblings().removeClass("currenttemptab");
        var tab = $(this).attr("href");
        $(".tempadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	 $(".addshorttabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentshorttab");
        $(this).parent().siblings().removeClass("currentshorttab");
        var tab = $(this).attr("href");
        $(".shortadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	 $(".addmisstabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentmisstab");
        $(this).parent().siblings().removeClass("currentmisstab");
        var tab = $(this).attr("href");
        $(".missadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	$(".chartcredit_three a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("creditcurrent");
        $(this).parent().siblings().removeClass("creditcurrent");
        var tab = $(this).attr("href");
        $(".crdttab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
<body>
</html>
