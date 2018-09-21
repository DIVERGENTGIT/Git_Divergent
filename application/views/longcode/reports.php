


<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Reports</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero"> 
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        
<form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="" name="campaign_search" id="campaign_search" method="post">
  <ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="from_date" value="<?php echo @$from_date;?>" placeholder="" class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php echo @$to_date;?>" placeholder="" class="data-pickerbg"></li>
<li>
					
                      <select name="servicer_number">
                       <option value="">Select Service Numbers</option>
                      <?php
                      foreach($longcode_numbers as $key=>$longcode_number)
                      {
                      ?>
                      <option value="<?php echo $longcode_number->longcode_number;?>"
                       <?php if($longcode_number->longcode_number==$service_number) { echo "selected";}?> >
                      <?php echo $longcode_number->longcode_number;?></option>
                      <?php
                      }
                      ?>
                      </select>
 
</li><li>
                      <select name="service_type">
                       <option value="">Select Service Type</option>
                         <option value="dedicated"
                          <?php if($service_type=="dedicated") { echo "selected";}?> >Dedicated</option>
                         <option value="shared"   
                         <?php if($service_type=="shared") { echo "selected";}?> >Shared</option>
                      </select>

   <!-- <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">File Formate</label>
    <div class="col-sm-8"> 
	<select name="file_format" class="form-control">
<option value="xls">Excel</option>
</select>    </div>
  </div> -->
  
</li>

<li><input type="submit" class="submit_btn" value="Search" name="Search"></li>
</ul>


 </form>		
            </div>
        </div>
       
        </section>
        
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>No of Records : </span><?php echo @$total_reports;?>
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<div class="table-responsive">
		<table class="table_all">
		<thead>
		<tr>
		<th>S.No</th>
		<th>Service Number</th>
		<th>Service Type</th>
		<!--
		<th>SMS Text</th>
		-->
		<th>Date</th>
		<th>Count</th>
		<th colspan="1">Action</th>
		</tr>
		</thead>
		<tbody>
		
		<?php
		$sno=1;
		if($this->uri->segment(3)!='')
		{
		$sno=$this->uri->segment(3)+1;
		}
		foreach($longcode_reports as $key => $longcode_report)
		{
		?>
		<tr>
		<td><?php echo $sno;?></td>
		<td><?php echo $longcode_report->service_number;?></td>
		<td><?php echo $longcode_report->service_type;?></td>
		
		<!--
		<td class="text-right"><div class="dropdown col-sm-12 col-md-12 form-div col-xs-12 padding_zero">
		<div class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-eye" aria-hidden="true"></i> SMS</div>
		
  <div class="dropdown-menu">
  <div class="col-sm-12 col-md-12 col-xs-12">
  <p><?php echo $longcode_report->message;?></p>
  </div>
  </div>
		
		</div>
		</td>
		-->
		
		<td><?php echo $longcode_report->created_on;?></td>
		<td>
		<?php
		/* 
		$service_number=$longcode_report->service_number;
		$user_id=$longcode_report->user_id;
		echo $sql="select * from longcode_smsmessages where service_number='$service_number' and user_id=$user_id ";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
		echo $query->num_rows();
		}
		else
		{
		echo "0";
		}
		*/
		$user_id=$longcode_report->user_id;
		$longcode_number=$longcode_report->service_number;
		$service_type=$longcode_report->service_type;
		$longcode_mobile='';
		$longcode_keyword='';
		echo $count=$this->longcode_model->getViewReportscount($user_id,$from_date,$to_date,$longcode_number,$longcode_mobile,$longcode_keyword,$service_type)
		?>
		</td>
		<td>
		<a href="<?php echo base_url();?>index.php/longcode/viewreports/<?php echo $longcode_report->service_number;?>" 
		class="btn btn-sm btn-default">View</a>
		</td>
		</tr>
		<?php
		$sno++;
		}
		?>
		</tbody>
		</table>
			</div>	
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">	  
			<?php echo $this->pagination->create_links(); 
			?>
			</div>
</div>
</div>
</div>
</div>

<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
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
<script src="http://10.10.10.199/FirstRing/js/jquery.min.js" type="text/javascript"></script>
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
		url: "<?php echo base_url(); ?>index.php/longcode/DisplayNumbers",
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




  
