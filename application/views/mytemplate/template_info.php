<div class="table-responsive">
<table class="table_all" id="bootstrap-table2">
				<thead>
					<tr><th>S.No</th><th>Date</th><th>SMS Content</th><th>Template Name</th><th colspan="2">Action</th></tr>
				</thead>  
				 <!-- Updated ON 2017-02-4 -->
				<tbody class="templatesData">  
					 
				
 
				
	<?php 
	$count = 0;  
	foreach($templates as $temp_info) {   
		$count++;$id = $temp_info['template_id'];
		?>    
 		<tr>
			<td> <?php echo $count;?></td>
			<td> <?php echo $temp_info['on_date'];?> </td> 
			<td>  <?php echo  substr($temp_info['template'],0,30);?></td>   
			<td> <?php echo $temp_info['template_name'];?> </td> 
			<td><button data-dismiss="modal" class="btn btn-sm btn-default" onClick="selectTemplateContent(<?php echo $id;?>);">select</button> 
             </td>
			 <td>
  			<input type="button" class="btn btn-sm btn-default" onClick="editTemplateContent(<?php echo $id;?>);" value="edit">  </td>  
		</tr>
 <?php } ?>    
	</tbody>   
 </table>    
</div>
 <script src="<?php echo base_url();?>js/jquery.sortelements.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/jquery.bdt.js" type="text/javascript"></script>
<script>
    $(document).ready( function () {
        $('#bootstrap-table2').bdt({
            showSearchForm: 0,
            showEntriesPerPageField: 0,
			pageRowCount: 10,

        });
    });
</script>
<script>

/**
  * ADDED ON 2017-02-3
  * Select template content
  */
function selectTemplateContent(template_id) {  
  	  $.ajax({
		url:"<?php echo base_url();?>campaign/getSelectedTemplateContent",
		type:"post", 
		data:{'template_id':template_id},
		success:function(res) {  
 			 var result = $.parseJSON(res);
 			  var box = $("#sms_text");
			  box.val(box.val() + result[0].template +'\n'); 	
 	calculateSMSLength();  
 		}
 	});	 
}

</script> 


  <script type="text/javascript">

/**
  * ADDED ON 2017-02-3
  * Select template content
  */


function editTemplateContent(template_id) { 
 
 	$('#template').text();       
 	  $.ajax({
		url:"<?php echo base_url();?>campaign/getSelectedTemplateContent",
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
