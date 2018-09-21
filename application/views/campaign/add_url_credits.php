 <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>assets/css/rangeslider.css">

<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">  
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/credits-icon.png" class="right-title-img">Add Short URL</h3>
</div>


<p style="color:red;" id="errorMsg"></p>
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero"> 
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero missedcall_allform profile-page-section">
			
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Price per short url</span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
<span class="profilerightlab-cont" id="price_per_url"><?php //echo $global_val; ?></span>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Number of short url</span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">  
<input type="text" id="urls" placeholder="Please select number of url" onkeyup="getUrlNum();" />
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<div class="col-md-8 col-sm-8 col-sm-offset-4 col-md-offset-4 col-xs-12 padding_zero">
 <input type="range" min="1" max="1000000"  data-rangeslider id="urlRangeVal" >
	      	     <output1></output1>
				   <output></output>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-8 col-sm-8 col-sm-offset-4 col-md-offset-4 col-xs-12 sendbtnmrgn padding_zero">
<form method="post" action="<?php echo base_url();?>index.php/campaign/confirm_order">
 			<input type="hidden" id="selectedurlcount" name="urlcount">
			<input type="submit" class="submit_btn" name="confirm_order" id="checkShortUrlCOunt" value="Confirm Order">
		</form>  
</div>
</div>  
</div>  
<div>

	     </div>
	 
 </div>
    


</div>

</body>


<!-- bootstrap slider -->



<!-- bootstrap slider -->
    <script src="<?php echo base_url(); ?>js/rangeslider.js"></script>

		
	<!-- view start-->
<div class="modal model_01 fade" id="modelconferenceview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modelconferenceview">Conferences</h4>
      </div>

<script>
function goBack() {
    window.history.back();
}



</script>

  <script>

       function ViewRecord(room_id,room_desc,admin_pin,user_pin,announcement,moh,join_leave,wait_for_admin,exit_with_admin,active,entry_time)
  {
	 
	// $("#empeditmobile").attr("value",mobile);
	 $("#room_id").html(room_id);
	 $("#room_desc").html(room_desc);
	 $("#admin_pin").html(admin_pin);
	 $("#user_pin").html(user_pin);
	 $("#announcement").html(announcement);

     $("#moh").html(moh);
	 $("#join_leave").html(join_leave);
     $("#wait_for_admin").html(wait_for_admin);
     $("#exit_with_admin").html(exit_with_admin);
     $("#active").html(active);
     $("#entry_time").html(entry_time);
	 
	 //$("#empviewphoto").attr("src","<?php echo "http://".$_SERVER['SERVER_NAME']?>/emptracker/uploads/"+photo);
	 //$("#req_id").attr("value",id);
	// console.log($("#empviewphoto").attr("src",photo));
	// console.log(empid);
	// console.log(id);
	 
  }
      </script>
      


 

<script>
$(document).ready(function() {  
    $("#urls").keydown(function (e) {
	if ((this.value.length == 0 && e.which == 48 ) || (this.value.length == 0 && e.which == 96 )){
    	              return false;
  	}
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||   (e.keyCode >= 35 && e.keyCode <= 40)) {
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
$(function() {
	var $document = $(document);
	var selector = '[data-rangeslider]';
	var $element = $(selector);
	// For ie8 support
	var textContent = ('textContent' in document) ? 'textContent' : 'innerText';
	// Example functionality to demonstrate a value feedback
	function valueOutput(element) {
	    var value = element.value;
	   
	    var output = element.parentNode.getElementsByTagName('output')[0] || element.parentNode.parentNode.getElementsByTagName('output')[0];
	   var output1 = element.parentNode.getElementsByTagName('output1')[0] || element.parentNode.parentNode.getElementsByTagName('output1')[0];
	   output[textContent] = 'Number of Shorturl : '+value;
 	  var url_price = "<?php echo $global_val;?>";
	     $('#price_per_url').text(url_price);

	    $('#urls').val(value);  
	     var res = value*url_price;
	   // output1[textContent] = 'Total Price : '+res.toFixed(2);  
	  
	    $('#selectedurlcount').val(value);

	 	$.ajax({
			url:"<?php echo base_url();?>campaign/getBulkUrlPrice",
			type:'post',
			data:{'numberofurl':value},
			success:function(pricepersms) {  
	 			$('#price_per_url').text(pricepersms);
	 			 var url_price = pricepersms;  
				var res = value*url_price;  
				output1[textContent] = 'Total Price : '+res.toFixed(2);  	
			}	  
		 });  

	}         

	 $document.on('input', 'input[type="range"], ' + selector, function(e) {


		valueOutput(e.target);
	});
	 


	$element.rangeslider({
	    // Deactivate the feature detection
	    polyfill: false,
	    // Callback function
	    onInit: function() {
		valueOutput(this.$element[0]);


	    },
	    // Callback function  
	    onSlide: function(position, value) {
		 
		//console.log('onSlide');
		//console.log('position: ' + position, 'value: ' + value);
	    },
	    // Callback function
	    onSlideEnd: function(position, value) {
		//console.log('onSlideEnd');
		//console.log('position: ' + position, 'value: ' + value);
	    }
	});
});



</script>


<script> 
function getUrlNum() {
	var $document = $(document);
	var selector = '[data-rangeslider]';
	var $element = $(selector);
  	var textContent = ('textContent' in document) ? 'textContent' : 'innerText';
	var value = $('#urls').val();
	if (value.length == 0){
 		return false;
  	}
	var output = $element[0].parentNode.getElementsByTagName('output')[0] || $element[0].parentNode.parentNode.getElementsByTagName('output')[0];
	var output1 = $element[0].parentNode.getElementsByTagName('output1')[0] || $element[0].parentNode.parentNode.getElementsByTagName('output1')[0];
	output[textContent] = 'Number of Shorturl : '+value;
	  
 
        //var url_price = "<?php echo $global_val;?>";
 	
	  
	    $('#selectedurlcount').val(value);   
 
	  $.ajax({
		url:"<?php echo base_url();?>campaign/getBulkUrlPrice",
		type:'post',
		data:{'numberofurl':value},
		success:function(pricepersms) {  
 			$('#price_per_url').text(pricepersms);
 			 var url_price = pricepersms;    
			var res = value*url_price;  
			output1[textContent] = 'Total Price : '+res.toFixed(2);  	
		}	  
	 });  
 	
}


</script>
      
<script>
$('#checkShortUrlCOunt').click(function() {
	var value = $('#urls').val();
	$('#errorMsg').text(''); 
	if(value <= 0) {    
		 
		$('#errorMsg').text('Number of short url not empty.');
		return false; 
	}else{  
		return true; 
	}

});

</script>


<script>
$(document).ready(function() {
	var error = "<?php echo $error;?>";
	if(error) {
	alert(error);
	}
});

</script>


