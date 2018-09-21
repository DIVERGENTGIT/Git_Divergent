  
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/short-url-icon.png" class="right-title-img">Short URL</h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	 	<p  style="color:red;"><?php if($this->uri->segment(3) == 'noCredits' || $shorturlCredits <= 0) { echo "You don't have enough credits,Please contact admin."; }  ?>
<?php if($this->uri->segment(3) == 'invalid') { echo "Not a valid number of short urls."; }  ?>
</p>
 <ul class="addshorttabs">
  
  <!-- Updated ON 2017-02-4 -->
        <li class="currentshorttab"><a href="<?php echo base_url();?>campaign/bulkshortUrl">Web Short URL</a></li>
        <li><a href="<?php echo base_url();?>campaign/bulkshortUrlimg">Image Short URL</a></li>
        <li><a href="<?php echo base_url();?>campaign/bulkshortUrlvideo">Video Short URL</a></li>
        <li><a href="<?php echo base_url();?>campaign/bulkshortUrlaudio">Audio Short URL</a></li>
         
           
    </ul>      
    <div class="smsadmintabdiv">  
	  <form action="<?php echo base_url();?>campaign/bulkShorturl" id="shorturl_valid" method="post"> 
 
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
				<input type="text" name="shorturl_number" id="shorturl_number" placeholder="Number Of Short URLS" value="" class="shorturl-txt">
	       		</div>
				<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
					<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
						<input type="text" name="shorturlenter"  placeholder="http://www.example.com" class="shorturlenter"> 
							<!-- <input type="submit" id="checkit2"   class="gobtn" value="Go"> -->
							<button type="button" id="checkit2"   class="gobtn"  >Go </button>
		       			 </div>
				</div>
			<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
			<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			<label class="shorlurl-lable">Short URL</label>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			<div class="col-md-5 col-sm-5 form-div col-xs-12 padding_zero">
				
				 <!-- Updated ON 2017-02-4 -->
			 	<input type="text" name="shorturl" id="shorturl" readonly placeholder="Your Short URL" value="" class="shorturl-txt">
				</div>
				<div class="col-md-5 col-sm-5 form-div col-xs-12 padding_zero">
				<input type="hidden" name="shortCode" id="shortCode" >
				 		 <!-- Updated ON 2017-02-4 -->
						 <input type="submit" class="submit_btn" data-dismiss="modal" value="Submit" name="createBulkUrl">
						 </div>
						 </div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
			 	<div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
					 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						<iframe class="iframe-shorturl" id="load_frame" src="https://www.smsstriker.com"></iframe>

		     
				 		<img src="<?php echo base_url();?>images/short-url-mobile.png" alt="short url preview" class="img-responsive">
						
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
	
 $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
    },'Should Enter Numbers, Letters');

$("#shorturl_valid").validate({
    rules: {
	shorturl_number: {
          required:true,
            regexpcol: true			
        },
		shorturlenter: {
          required:true,
            regexpcol: true			
        },
		shorturl: {
          required:true,
            regexpcol: true			
        }
		

    },
	messages: {
		shorturl_number: {
            required: "Please Enter No.of Short URLS"            
        },
		shorturlenter: {
            required: "Please Enter Short URL"            
        },
		shorturl: {
            required: "You will get Short url after click on Go button"            
        }

    },
  
	tooltip_options: {
    	shorturl_number: {placement:'bottom',html:true},
		shorturlenter: {placement:'bottom',html:true},
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
 /*   $(document).ready(function() {
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
} ); */


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
//$api_url= 'http://10.10.10.199/shorturl/';

?>  
<script>

$(document).click("click", function(e) {
 
	
	if ((e.target.id == "checkit2"))   
	{ 
 		var urlCredits = "<?php echo $shorturlCredits;?>"; 
   		if(urlCredits > 0) {
 			if((e.target.id != "if") && (e.target.id != "while")) {

 
						if ($(".shorturlenter").val().match(/http:\/\//) || $(".shorturlenter").val().match(/https?:\/\//) || $(".shorturlenter").val().match(/www./)) {
				
		 	
		 
		     var txt = $.trim($(".shorturlenter").val());
		    if (!txt.match(/https:\/\//)) {
        if (!txt.match(/http:\/\//)) {
 	 	txt = 'http://'+txt;  
	}  
   
      }
		    
		 console.log(txt);
		  // Changing iframe  

		  $("#load_frame").attr("src",txt);  

 
		     $.ajax({
			//url: "<?php echo $api_url?>api.php",
			url: "<?php echo base_url();?>campaign/getShortCodeView",
			type: 'POST',
		      	data: {  
			 	get_shorturl: 'success',user_url: txt,user_id:'<?php echo $user_id ?>'
		      	},
			dataType: "JSON",
			success: function(data) {
 
		 
			$("#shortCode").val(data);
			$("#shorturl").val('<?php echo $api_url?>'+data+'\n'); 
		   
			},
			error: function(){

		 
			     //  alert("error");
			}
		   }); 
				}
				else
				{
			
			  alert("Invalid URL");
				}		

	
	
				}
		 }else{
		    window.location.href = "<?php echo base_url();?>campaign/bulkShorturl/noCredits";
		}  	
		
	}
});



  
		

 

</script>
 
