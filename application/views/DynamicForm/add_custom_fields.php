<style>
.remove_field {
position: absolute;
bottom: 16px;
color: #e4241d;
display: inline-block;
padding: 0px 10px 3px;
border: 1px solid;
font-size: 18px;
}
.into-relative {
position:relative;	
}
</style>

<div class="col-sm-12 col-md-12 col-xs-12 padding-container">
<div class="col-sm-12 col-md-12 col-xs-12 main-contaner">
<h4 class="details-title text-center">Dynamic Form Report</h4>
<div class="col-sm-12 DynamicForm_sms_tabs">
		<ul class="jtab-trigger jtab-ul">
			<li>
				<a href="<?php echo base_url();?>DynamicForm/Create" class="jtab-selected">Creat Dynamic Form</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>DynamicForm/getList">Dynamic Forms List</a>
			</li>
			
			<li>
				<a href="<?php echo base_url(); ?>DynamicForm/Reports">Dynamic Forms Reprt</a>
			</li>
		</ul>
	</div>

	<div class="col-sm-10 col-sm-offset-1">
	
	
<form class="col-sm-12 col-md-12 col-xs-12 officeorg-allform padding-zero" method="post">
<div class="col-sm-2 col-md-2 col-xs-12 padding-zero">
<div class="col-sm-12 col-md-12 col-xs-12 mrgfromto padding-zero">
<label>From</label>
<input type="text" name="from_date" id="from_date" class="datapicbg" placeholder="yyyy-mm-dd" 
value="<?php echo isset($from_date)?$from_date:'';?>" >
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<label>To</label>
<input type="text" name="to_date" id="to_date" class="datapicbg" placeholder="yyyy-mm-dd"
 value="<?php echo isset($to_date)?$to_date:'';?>" >
</div>
</div>
<div class="col-sm-10 col-md-10 col-xs-12 padding-zero">
<ul class="serchfiv_elem">

<li>
<label>Form Name</label>
<select name="form_name">
<option value="">--Select--</option>
<?php 
	//echo count($header_form);
	foreach($formnames as $key=>$value)
	{
	?>
	<option value="<?php echo $value['form_name'];?>" 
	<?php echo ($value['form_name']==$form_name)?'selected':'';?> ><?php echo $value['form_name'];?></option>
	<?php
	}
	?>
</select>
</li>



<li>
<input type="submit" name="search" class="searchbtn" value="Search">
</li>
</ul>
</div>
</form>
			
	

      <div class="clearfix"></div><br />
			
		<table>
		<tr> <th> S.No</th> <th> Form Name  </th> <th> No of Fields</th> <th> No of Leads</th> <th> Date & Time</th>
		 <th> URL</th><th> Action</th></tr>
		
		<?php
		$count=1;
		foreach($formsdata as $key=>$value)
		{
		
		?>
		<tr style="height:30px !important;" >
		<td><?php echo $count++;?></td>
		<td><?php echo isset($value['form_name'])?$value['form_name']:'---';?></td>
		<td>
		<?php echo isset($value['no_of_fields'])?$value['no_of_fields']:'---';?>
		</td>
		<td>
		<?php
		if(isset($value['no_of_leads']))
		{
		?>
		<a href="<?php echo base_url();?>DynamicForm/Leads/<?php echo $value['form_name'];?>/<?php echo $value['no_of_fields'];?>"
		 title="No of Leads"><?php echo isset($value['no_of_leads'])?$value['no_of_leads']:'0';?></a>
		<?php
		}
		else
		{
		echo isset($value['no_of_leads'])?$value['no_of_leads']:'0';
		}
		?>
		</td>
		
		<td>
		<?php echo isset($value['created_on'])?$value['created_on']:'---';?>
		</td>
		
		<td>
		<a href="<?php echo $this->config->item('customform_url');?>/<?php echo $value['form_name'];?>"
		 title="No of Leads"><?php echo $this->config->item('customform_url');?>/<?php echo $value['form_name'];?></a>
		</td>
		
		<!--
		<td>
		<a href="<?php echo base_url();?>DynamicForm/Leads/<?php echo $value['form_name'];?>/<?php echo $value['count'];?>"
		 title="No of Leads">View</a>
		</td>
		-->
		</tr>
		<?php
		}
		?>
			</table>

</div>
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero pull-right">
<?php echo $this->pagination->create_links(); ?>
</div>
</div>
</div>
<script>

$(document).ready(function(){
	
	var customformat=true;

	$('#Company_ID').on('change',function(){  
	var company_id = $('#Company_ID').val();
		if(company_id!="")
		{
			var format_name = $("#format_name").val();
			if(format_name!='') {
				$.ajax({
					type: "POST",
					url:"<?php echo base_url();?>OrgService/checkCustomFormatName",
					data:{'format_name':format_name,'user_id':company_id},     
					dataType:"json",
					success: function(response) {
					//console.log(response);
						
						if(response > 0)
						{
							$("#cid").show().text("Custom Format Name Already Exist");
							customformat=false;
						}
						else
						{
							$("#cid").hide();
							customformat=true;
						}
					}
				});
			} 
		}
	});	
	
	
	//<!-- Check Format Name Start -->
	    $("#format_name").blur(function() {
	       var company_id = $("#Company_ID").val();
	       if(company_id!='')
	       {
	       	var format_name = $("#format_name").val();
	       	
	       	if(format_name!='')
	      	 {
	       	
			if(format_name!='') {
				$.ajax({
					type: "POST",
					url:"<?php echo base_url();?>OrgService/checkCustomFormatName",
					data:{'format_name':format_name,'user_id':company_id},     
					dataType:"json",
					success: function(response) {
					//console.log(response);
						
						var format_name = $("#format_name").val();
						var exist_format_name = $("#exist_format_name").val();
						if(format_name!=exist_format_name)
						{
							if(response > 0)
							{
								$("#cid").show().text("Custom Format Name Already Exist");
								customformat=false;
							}
							else
							{
								$("#cid").hide();
								customformat=true;
							}
						}
					}
				});
			}
		 }
	       else
	       {
	       		$("#frmname").show().text("Please Enter Form Name");
	       		$("#format_name").val('');
	       }
	       	
	       }
	       else
	       {
	       		$("#cid").show().text("Please Select Company");
	       		$("#format_name").val('');
	       }
	    });

	$("#Company_ID").click(function(e){
		$("#cid").hide();	
	});
	
//<!-- Check Format Name End -->

	$("#addcustomfields").validate({
		 rules:  {
				Company_ID: {
					required: true,
				},
				format_name: {
					required: true,
				}
			},
			messages: 
			{
				Company_ID: {
					required: "Please Select Company Name"
				},
				format_name: {
					required: "Please enter Format Name"
				}
			},
			tooltip_options: 
			{
				Company_ID: {placement:'bottom',html:true},
				format_name: {placement:'bottom',html:true}
			} 
	    });
      
});


</script>



<script>
//Addmore Custom Fields Script Start
	$(document).ready(function() {

	    $(".add_field_button").click(function(e){ //on add input button click
		
		var max_fields      = parseInt($("#totalcustomfields").val()); //maximum input boxes allowed
		var addedcustom_fields = parseInt($("#addedcustomfields").val()); //initlal text box count
		
		//if(addedcustom_fields < max_fields)
		//{ 
		//max input box allowed
		addedcustom_fields++; //text box increment
		$(".input_fields_wrap").append('<div class="container-fluid padding-zero into-relative"><div class="col-sm-4 form-group"><input type="text" class="form-control class_labelname" id="mylabelname_'+addedcustom_fields+'" name="mylabelname[]" placeholder="Label Name"></div><div class="col-sm-4 form-group"><select  class="form-control" id="myfieldname_'+addedcustom_fields+'" name="myfieldname[]"><option value="Text Box">Text Box</option><option value="Radio Buttons">Radio Buttons</option><option value="Select Dropdown">Select Dropdown</option><option value="Text Area">Text Area</option></select></div><div class="col-sm-4 form-group"><input type="text" class="form-control" id="myfieldvalue_'+addedcustom_fields+'" name="myfieldvalue[]" id="value_1" placeholder="Value"></div><a href="#" class="remove_field">x</a></div>'); //add input box
		
		$("#addedcustomfields").val(addedcustom_fields);
			
			//Hide Addmore Button Start
			if(addedcustom_fields == max_fields)
			{
				$(".add_field_button").hide();
			}
		/*
			//Hide Addmore Button End
		}
		else
		{
			alert('Custom Fields limit Exceeded');
		}*/
	    });
	   
	    $(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); 
		$(this).parent('div').remove();
	
		//Decrement Add custom Fields Start				
			var addedcustom_fields = parseInt($("#addedcustomfields").val()); //initlal text box count
			addedcustom_fields--;
			$("#addedcustomfields").val(addedcustom_fields);
		//Decrement Add custom Fields End
		
		//Display Addmore Button Start
			var max_fields      = parseInt($("#totalcustomfields").val()); //maximum input boxes allowed
			var addedcustom_fields = parseInt($("#addedcustomfields").val()); //initlal text box count
				
			if(addedcustom_fields < max_fields)
			{
				$(".add_field_button").show();
			}
		//Display Addmore Button End	
		
	    })
	});
//Addmore Custom Fields Script End
</script>


