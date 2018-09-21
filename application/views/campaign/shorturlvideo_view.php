<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/short-url-icon.png" class="right-title-img">Short URL</h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 	<p style="color:red;"><?php if($this->uri->segment(3) == 'noCredits' || $shorturlCredits <= 0) { echo "You don't have enough credits,Please contact admin."; }  ?>
<?php if($this->uri->segment(3) == 'invalid') { echo "Not a valid number of short urls."; }  ?>
</p>
 <ul class="addshorttabs">    
 
  <!-- Updated ON 2017-02-4 -->
        <li><a href="<?php echo base_url();?>campaign/bulkshortUrl">Web Short URL</a></li>
        <li><a href="<?php echo base_url();?>campaign/bulkshortUrlimg">Image Short URL</a></li>
        <li class="currentshorttab"><a href="<?php echo base_url();?>campaign/bulkshortUrlvideo">Video Short URL</a></li>
        <li><a href="<?php echo base_url();?>campaign/bulkshortUrlaudio">Audio Short URL</a></li>
       
            
    </ul>  
    <div class="smsadmintabdiv">
       		  <form action="<?php echo base_url();?>campaign/bulkshortUrlvideo" id="shorturlvideo_valid" method="post"> 
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
                <input type="hidden" name="filetype" value="video">
 <p class="errortxt" id="error_video"> </p>  
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		<div class="col-md-2 col-sm-4 col-xs-12 padding_zero">
         <span class="select-yourimage">No. Of Short URLS</span>
		 </div>
		 <div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
	<input type="text" name="shorturl_number" id="shorturl_number" placeholder="Number Of Short URLS"  class="shorturl-txt">
        </div>
		 </div>
      <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	  <div class="col-md-2 col-sm-4 col-xs-12 padding_zero">
         <span class="select-yourimage">Select Your Video</span>
		 </div>
		 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero padding_rtzero">
		<div class="col-md-3 col-sm-3 col-xs-12 padding_zero"> 		
<div class="fileUpload btn submit_btn">  
	 
    <span>Upload</span>

    <input id="file_input" name="file_input" type="file" onChange="upload_video();"  class="upload" />
</div> 
	 <p id="uploaded_img"> </p>	
</div> 
<div class="col-md-9 col-sm-12 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Please upload mp4 filetypes and size must be less than 10MB.</li>
</ul>
 </div>
<!-- <input type="submit" onClick="upload_image();" class="submit_btn upload-mrg"  value="Upload"> -->
		<!-- <button type="button" class="submit_btn upload-mrg">Upload</button> -->
	

		 </div>  

        </div>

		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		<div class="col-md-2 col-sm-4 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short Video URL</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
         <input type="text" id="short_url_image" name="shorturl" placeholder="Your Short URL" readonly class="short-mrg01 shorturl-txt form-div">
		 <input type="hidden" name="shorturlenter" id="shorturlenter">
		 <input type="hidden" name="shortCode" id="shortCode" >
		 <input type="submit" name="createBulkImgUrl" class="submit_btn" data-dismiss="modal" value="Submit">
        </div>
		
		 </div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-4 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		
		 <video width="100%" height="240"  id="video_play" controls>
 
			  <source src="<?php echo base_url();?>vjc.mp4" type="video/mp4" id="video_frame"  > 

</video>  
 
		 

		<!-- <img src="<?php echo base_url();?>images/short-url-img-mob.png" id="load_frame1" alt="short url preview" class="mob-inner-shortimg img-responsive"> 
		 <img src="<?php echo base_url();?>images/short-url-mobile.png" alt="short url preview" class="img-responsive">
		   Updated ON 2017-02-4 --> 
		 
		 </div>
		 </div>
		 
        </div>
        
        </div>
       
       </form>
    </div>
</div>

</div>

</div>
</div></div></body>

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

$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[20].size <= param)
}, 'File size must be less than {20}');

$("#shorturlvideo_valid").validate({
    rules: {
	file_input: {
          required:true,
           extension: "mp4",
           maxFileSize: {
                        "unit": "MB",
                        "size": 10
                    }	  
        },
		shorturl_number: {
          required:true,
            regexpcol: true			
        },
		shorturl: {
			 required:true
		}

    },
	messages: {
		file_input: {
            required: "Please Upload Video File",
            extension: "Please Upload MP4 Formate"             
        },
		shorturl_number: {
            required: "Please Enter No.of Short URLS"
           
        },
		shorturl: {
            required: "You will get Short url after upload an Video"            
        }

    },
  
	tooltip_options: {
    	file_input: {placement:'bottom',html:true},
		shorturl_number: {placement:'bottom',html:true},
		shorturl: {placement:'bottom',html:true}
		}
}); 
}); 
 </script>

 <script>
$(document).ready(function() {  
    $("#shorturl_number").keydown(function (e) {
	if ((this.value.length == 0 && e.which == 48 ) || (this.value.length == 0 && e.which == 96 )){
    	              return false;
  	}
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||   (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
             return false;
        }
    });
}); 
</script> 
	<script>

  
  
  
$(document).ready(function(){
    $("tr .dropdown-toggle").click(function(){
		 $(this).parent().children().toggleClass("selected_001");
        
    });
   
});
</script>
<script>
$(document).ready(function(){
    $(".close_dropdown").click(function(){
		 $(".dropdown-menu").removeClass("selected_001");
        
    });
   
});


</script>
		
			
<script>
function goBack() {
    window.history.back();
}
</script>

    <script>
	$(document).ready(function() {
	
      $(".assign").on("change",function () {
          
            $(".assigncampaign").prop('checked', $(this).prop("checked"));
      });
      
      $(".masking").on("change",function () {
           
            $(".maskingcampaign").prop('checked', $(this).prop("checked"));
      });
      
      
       $(".unassign").on("change",function () {
          
            $(".unassigncampaign").prop('checked', $(this).prop("checked"));
      });
      
      $(".unmasking").on("change",function () {
           
            $(".unmaskingcampaign").prop('checked', $(this).prop("checked"));
      });
      
      });
     </script>     
     
<!-- view End-->
<script type="text/javascript">
    /* $(document).ready(function() {
    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 5,  
	   info: false,
		bLengthChange: false,
        filter: false,
		fnDrawCallback:function(){
if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
$('#example_wrapper .dataTables_paginate').css("display", "block");	
} else {
$('#example_wrapper .dataTables_paginate').css("display", "none");
}
}
    } );
} );*/


function validation()
{
	if($("#from_date").val() != '' || $("#to_date").val() != '')
	{
		if($("#from_date").val() == '' || $("#to_date").val() == '')
		{
			alert("Please select from date and to date.");
			return false;
		}
	}
}
</script>





 <?php
//ADDED ON 2017-01-23



$api_url= $UrlGenIp;
//$api_url= 'http://ion.bz';

//$api_url= 'http://10.10.10.199/shorturl/';

?>
 
<script>
/*
$("#image_input").change(function() {  
 
 	var file = $("#image_input").prop('files')[0];
 	var ext = $("#image_input").val().split('.').pop().toLowerCase();
 	var size = file.size / 1048576;
 	if(size > 10){
		alert("Allowed file size exceeded. (Max. 10 MB) ");
	}else if($.inArray(ext, ['mp4','mov']) == -1) {
	  	alert('invalid extension!');
	
	}else{    

	   	$('#uploaded_img').text(file.name);
	 }

	 
});
 */


/**
  * ADDED ON 2017-02-3
  * Get short code for uploaded image
  */
  /*
function upload_image() {    
   var urlCredits = "<?php echo $shorturlCredits;?>"; 
   if(urlCredits > 0) {
	var file = $("#image_input").prop('files')[0];
	var ext = $("#image_input").val().split('.').pop().toLowerCase();
	var size = file.size / 1048576;
	if(size > 10){
		alert("Allowed file size exceeded. (Max. 10 MB) ");
	}else if($.inArray(ext, ['mp4','mov']) == -1) {
	  	alert('invalid extension!');

	}else{ 
	   var reader = new FileReader(); 
	      reader.readAsDataURL(file);
	      reader.onloadend = function(){ 		  
		  $.ajax({
		  	url:"<?php echo base_url();?>campaign/upload_encoded_image",
		  	type:"POST",
		  	data:{'image_data' : this.result },
		  	success:function(data) {
	 
		  		var file_location = "<?php echo base_url();?>upload_shorturl_image/"+$.trim(data);

		  		$("#load_frame1").attr("src", file_location);  
		  		$("#shorturlenter").val(file_location);  
		  		  $.ajax({
					url: '<?php echo $api_url?>api.php',
					type: 'POST',
				      	data: {
					 	get_shorturl: 'success',user_url:file_location,user_id:'<?php echo $user_id ?>'
				      	},  
					dataType: "JSON",
					success: function(data) { 	
							$("#shortCode").val(data);	 
						$("#short_url_image").val('<?php echo $api_url?>'+data+'\n');
					},
					error: function(){

						//console.log('i am here');
						       alert("error");
					}
				}); 
		  	} 
		  });	
	   
		}
	  }  
          
      }else{
	    window.location.href = "<?php echo base_url();?>campaign/bulkshortUrlimg/noCredits";
      }   
}   

 */

</script> 



<script> 
function upload_video() {    
	var urlCredits = "<?php echo $shorturlCredits;?>"; 
  	if(urlCredits > 0) {
		var file = $("#file_input").prop('files')[0];
		var ext = $("#file_input").val().split('.').pop().toLowerCase();
		var size = file.size / 1048576;
		if(size > 10){
			//alert("Allowed file size exceeded. (Max. 10 MB) ");
		}else if($.inArray(ext, ['mp4']) == -1) {
		 	//alert('invalid extension!');

		}else{ 
			var formData = new FormData(document.getElementById("shorturlvideo_valid")); 
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
						var url = file_location;
						var path = url.split('/').slice(-6).join('/'); 
					//console.log(path); 
						var videopath = "<?php echo base_url();?>player.php?path="+path;
						$("#shorturlenter").val(videopath); 
						var player = document.getElementById('video_play');

						var mp4Vid = document.getElementById('video_frame');

						player.pause();   
						// Now simply set the 'src' property of the mp4Vid variable!!!!

						mp4Vid.src = file_location; 
						player.load();
						player.play(); 
						$.ajax({
							//url: '<?php echo $api_url?>api.php',
							url: "<?php echo base_url();?>campaign/getShortCodeView",
							type: 'POST',  
							data: {
								get_shorturl: 'success',user_url:file_location,user_id:'<?php echo $user_id ?>'
							},  
							dataType: "JSON",
							success: function(data) { 
								$("#shortCode").val(data);	 	 
								$("#short_url_image").val('<?php echo $api_url?>'+data+'\n');
								//$("#shorturl_text").val('<?php echo $api_url?>'+data+'\n');


							},
							error: function(){

								//console.log('i am here');
								alert("error");
							}
						}); 
					} else{
					$('#error_video').text('Uploaded file is not a valid MIME type.');
				} 
				}
			});  
	 	}
	}else{
	    window.location.href = "<?php echo base_url();?>campaign/bulkshortUrlvideo/noCredits";
        } 
}
</script>
 
