

<style type="text/css">
.table-nonfluid {
   width: 100% !important;
   margin:0px !important;
}
.panel-heading{margin:0px;}
td.numeric {
    padding: 6px 40px !important;
}
th.numeric {   
    padding: 6px 40px !important;
}
.form_credits span{float:left;display:inline;margin-right: 20px;}
.pagination a{ padding: 7px 11px;
			background: #fff;}
.pagination strong{background:#08c;color:#fff;padding: 7px 11px;}

/*---- Bootstrap slider -- */
 output1 {
            display: block;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
            width: 100%;
        }
</style>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<body class="skin-blue sidebar-mini">
 
    <div class="col-sm-9">    
      
      <!-- Content Wrapper. Contains page content -->  
      	<div class="content-wrapper">
		<!-- Content Header (Page header) -->  

			 <div>
		<h3>Flexi Plan For Shorturl   </h3>

	       	    <output></output>
		    <span style="display: block;  padding-top: 7px;  font-size: 14px; line-height: 1.42857143;   color: #555;">Price per short url : <?php echo $global_val; ?></span>
		
		     </br></br> 
		     <input type="text" id="urls" placeholder="Please select number of url" onkeyup="getUrlNum();" />
		     <h3>Select number of short url to buy</h3>
		     <input type="range" min="1" max="1000000"  data-rangeslider id="urlRangeVal" >
	      	     <output1></output1>


		<form method="post" action="<?php echo base_url();?>campaign/addShorturlCredits">
 			<input type="hidden" id="selectedurlcount" name="urlcount">
			<input type="submit" name="confirm_order" value="Confirm Order">
		</form>
	     </div>
	 
 </div>
    


</div>

</body>




 <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
	

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker-ui.css" />

<!-- bootstrap slider -->
 <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>assets/css/rangeslider.css">


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-sliderAccess.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-validate.bootstrap-tooltip.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>

<!-- bootstrap slider -->
    <script src="<?php echo base_url(); ?>assets/js/rangeslider.js"></script>



 <script type="text/javascript">
			
$(document).ready(function(){ 
$('#from_date').datetimepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() + 1));
                
                $("#to_date").datetimepicker("option", 'minDate', selectedDate);
                $("#to_date").datetimepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#to_date').datetimepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() - 1));
               
                $("#from_date").datetimepicker("option", 'minDate', monthsAddedDate);
                $("#from_date").datetimepicker("option", 'maxDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>
			
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
      
 
<!-- view End-->
<script type="text/javascript">
    $(document).ready(function() {
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
} );


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
	     var res = value*url_price;
	    output1[textContent] = 'Total Price : '+res.toFixed(2);  
	  
	    $('#selectedurlcount').val(value);

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

	var output = $element[0].parentNode.getElementsByTagName('output')[0] || $element[0].parentNode.parentNode.getElementsByTagName('output')[0];
	var output1 = $element[0].parentNode.getElementsByTagName('output1')[0] || $element[0].parentNode.parentNode.getElementsByTagName('output1')[0];
	output[textContent] = 'Number of Shorturl : '+value;
	  
	console.log(output);
        var url_price = "<?php echo $global_val;?>";
 	var res = value*url_price;
	output1[textContent] = 'Total Price : '+res.toFixed(2);  
	  
	    $('#selectedurlcount').val(value);  
 	
}


</script>


