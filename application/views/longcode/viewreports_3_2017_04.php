
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>


<script>
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");


$.validator.addMethod("alphanumericspace", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
	
$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');
	
 $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
    },'Should Enter Numbers, Letters');
	
	 $.validator.addMethod("alphanumericunder", function(value, element) {
        return this.optional(element) || /^[a-z0-9_]+$/i.test(value);
    },'Should Enter Numbers, Letters, underscore');
	$.validator.addMethod("api_values_not_same", function(value, element) {
   return $('#field1').val() != $('#field2').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same13", function(value, element) {
   return $('#field1').val() != $('#field3').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same14", function(value, element) {
   return $('#field1').val() != $('#field4').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same15", function(value, element) {
   return $('#field1').val() != $('#field5').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same23", function(value, element) {
   return $('#field2').val() != $('#field3').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same24", function(value, element) {
   return $('#field2').val() != $('#field4').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same25", function(value, element) {
   return $('#field2').val() != $('#field5').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same34", function(value, element) {
   return $('#field3').val() != $('#field4').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same35", function(value, element) {
   return $('#field3').val() != $('#field5').val()
}, "API values should not equal");
$.validator.addMethod("api_values_not_same45", function(value, element) {
   return $('#field4').val() != $('#field5').val()
}, "API values should not equal");

</script>

<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Reports</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_dzero">
  <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
        
<form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="" name="campaign_search" id="campaign_search" method="post">
  <ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="from_date" value="<?php echo @$from_date;?>" placeholder="" class="data-pickerbg hasDatepicker"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php echo @$to_date;?>" placeholder="" class="data-pickerbg hasDatepicker"></li>
<li>
                     
                      <input type="text" name="longcode_mobile" placeholder="Mobile Number" value="<?php echo @$longcode_mobile;?>" />
 
</li>

<li>
					
                      <select name="longcode_keyword">
                       <option value="">Select Keyword</option>
                      <?php
                      foreach($keywords as $key=>$keyword)
                      {
                      ?>
                      <option value="<?php echo $keyword->keyword_name;?>"
                       <?php if($keyword->keyword_name==$longcode_keyword) { echo "selected";}?> >
                      <?php echo $keyword->keyword_name;?></option>
                      <?php
                      }
                      ?>
                      </select>
 
</li>
<!--
<li>
                      <select name="service_type">
                       <option value="">Select Service Type</option>
                         <option value="dedicated"
                          <?php if($service_type=="dedicated") { echo "selected";}?> >Dedicated</option>
                         <option value="shared"   
                         <?php if($service_type=="shared") { echo "selected";}?> >Shared</option>
                      </select>

  
  
</li>
-->
<li>

<input type="hidden"  name="servicer_number" value="<?php echo @$service_number?>">

<input type="submit" class="submit_btn" name="Search">
</li>
</ul>


 </form>		
            </div>
        </div>
       
        </section>
        
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>Service Number : </span>
		<?php
		$id=0;
		$number;
		if($this->uri->segment(3)!='')
		{
		 echo $number=$this->uri->segment(3);
		 
		  $id=$this->uri->segment(4);
		}
		?>
		
		<form method="post" style="float: right;" action="">
		<input type="submit" class="submit_btn" value="Download Report" name="Download">
		</form>
		</div>
		
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>No of Records : </span>
		<?php
	     echo @$total_reports;
		?>
		</div>
		
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<table class="table_all">
		<thead>
		<tr>
		<th>S.No</th>
		<th>Mobile</th>
		<th>Keyword Name</th>
		<th>Message</th>
		<th>Sent Time</th>
		<th>Status</th>
		</tr>
		</thead>
		<tbody>
		<?php
		//print_r($longcode_reports);
		$sno=1;
		if($this->uri->segment(4)!='')
		{
		$sno=$this->uri->segment(4)+1;
		}
		foreach($longcode_reports as $key => $longcode_report)
		{
		?>
		<tr>
		<td><?php echo $sno;?></td>
		<td>
		<?php 
		if($longcode_report->message_from>0)
		{
		echo $longcode_report->message_from;
		}
		else
		{
		echo "---";
		}
		?>
		</td>
		<td>
		<?php 
		if($longcode_report->keyword!='')
		{
		echo $longcode_report->keyword;
		}
		else
		{
		echo "---";
		}
		?>
		</td>
		<td class="text-right"><div class="dropdown col-sm-12 col-md-12 form-div col-xs-12 padding_zero">
		<div class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-eye" aria-hidden="true"></i>SMS</div>
		
  <div class="dropdown-menu">
  <div class="col-sm-12 col-md-12 col-xs-12">
  <p><?php echo $longcode_report->message;?></p>
  </div>
  </div>
		
		</div>
		</td>
		<td>
		<?php 
		echo $longcode_report->message_time;
		?></td>
		<td>
		<?php
		echo $longcode_report->status;
		?>
		</td>
		</tr>
		<?php
		$sno++;
		}
		?>
		</tbody>
		</table>
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		
		<?php echo $this->pagination->create_links(); 
			?>	 
		</div>
		
		
</div>
</div>
</div>
</div>


 
 
 
<!--  
<script src="<?php echo base_url();?>js/jquery.min.js" type="text/javascript"></script>
-->
 <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>
 <script>
$(document).ready(function() {
  
	 $(".addmisstabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentmisstab");
        $(this).parent().siblings().removeClass("currentmisstab");
        var tab = $(this).attr("href");
        $(".missadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	
$('#customersms').change(function(){
  if($(this).prop("checked")) {
    $('.customshowdiv').show();
  } else {
    $('.customshowdiv').hide();
  }
});
$('#vendorsms').change(function(){
  if($(this).prop("checked")) {
    $('.vendorshowdiv').show();
  } else {
    $('.vendorshowdiv').hide();
  }
});
});
</script>
 

<?php $this->load->view("longcode/longcode_script");?>

<!--
<script src="http://localhost/FirstRing/js/jquery.min.js" type="text/javascript"></script>
-->

<script type="text/javascript">
	$(document).ready(function(){
	$(".vendor_alertbtns").click(function(){
	var txt = $.trim($(this).val());
	var box = $(".append_venderchkval");
	box.val(box.val() +'<'+txt+'>' +' ');
	});
	$('.vendor_alertbtns').click(function(){
	
  $('.append_venderchkval').attr("readonly", false);
	
	 
});
	});
	</script>

<script>
$(document).ready(function() {
$(".missedcall_allformsub").validate({
    rules: {
        
		'longcode_numbers[]': {
            required: true
		        },
       // 'getkeywords[]': {
            //required: true			
       // }, 
        customeralert:{
                  required: function (element) {
                     if($("#customersms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  },
                 regexpcol: function (element) {
                     if($("#customersms").is(':checked')){
                       regexpcol: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }	  
               },
          longcode_sender_name:{
                  required: function (element) {
                     if($("#customersms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  },
                 regexpcol: function (element) {
                     if($("#customersms").is(':checked')){
                       regexpcol: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }	  
               },
        vendoralert:{
                  required: function (element) {
                     if($("#vendorsms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  },
                 regexpcol: function (element) {
                     if($("#vendorsms").is(':checked')){
                       regexpcol: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }  
               },
 
                 vendor_mobileno: {
			number: true,
		     required: function (element) {
                     if($("#vendorsms").is(':checked')){
                       required: true;                               
                     }
                     else
                     {
                         return false;
                     }  
                  }  
		},
 		connect_api_url: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		phone_number: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		service_numbers: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},
		sms_time: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		},sms_text_param: { 
		     required: function (element) {
                     if($("#longcode_api").is(':checked')){
                       required: true;                               
                     }  
                     else
                     {
                         return false;
                     }  
                  }  
		}
		 
		
    },
    messages: {
        
		'longcode_numbers[]': {
            required: "Please Select Services Number"            
        },
     //   'getkeywords[]': {
           // required: "Please Select Services Keyword"            
       // },
        longcode_sender_name: {
            required: "Please Enter Sender Name"            
        },
        customeralert: {
            required: "Please Enter Customer Alert"            
        },
	connect_api_url: {
 		required: "Please Enter Url"    
	},
	phone_number: {
 		required: "Please Enter Phone Number Parameter"    
	},
	service_numbers: {
 		required: "Please Enter Service Number Parameter"    
	},
	sms_time: {
 		required: "Please Enter Time Parameter"    
	},sms_text_param: {
 		required: "Please Enter SMS Text Parameter"    
	},
	 
		vendor_mobileno: {
			  number: "Please Enter 10 Digit Mobile Numbers",
			  required: "Please Enter Mobile Number"
		},  
         vendoralert: {
            required: "Please Enter Vendor Alert"            
        }
    },
	tooltip_options: {
		'longcode_numbers[]': {placement:'bottom',html:true},
		'getkeywords[]': {placement:'bottom',html:true},
		longcode_sender_name: {placement:'bottom',html:true},
		customeralert: {placement:'bottom',html:true},
		vendor_mobileno: {placement:'bottom',html:true},
		vendoralert: {placement:'bottom',html:true}
		}
}); 
}); 
 </script>
 
 <script type="text/javascript">
    $(document).ready(function(){
    
		$.ajax({
		type: "GET",
		data: {},
		url: "<?php echo base_url(); ?>longcode/DisplayNumbers",
		success: function (callback_data) 
		{
		console.log(callback_data);
		//console.log($('#rental_plan'));
		$('.didprice').html(callback_data);
		}
		});	
    
    });
  </script>	

	<script>
	$(document).ready(function() {
$('#longcode_api').change(function(){
	$('#api_alert').val('');
  if($(this).prop("checked")) {
    $('.api_show_div').show();
$('#api_alert').val(1);
  } else {
    $('.api_show_div').hide();
$('#api_alert').val('');
  }
});

});
	</script>




  
