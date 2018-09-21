<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url(); ?>images/manage-icon.png" class="right-title-img">Template</h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <!-- Main content -->
			<?php if(isset($added)): ?>
		<div class="alert alert-warning" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>	
		 	<?php echo $added; ?>
		</div>
<?php elseif(isset($edited)): ?>
	<div class="alert alert-warning" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>
		<div class="valid_box">
		 	<?php echo $edited; ?>
		</div>
		</div>
	<?php elseif(isset($deleted)): ?>
	<div class="alert alert-warning" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>
		<div class="error_box">
		 	<?php echo $deleted; ?>
		</div>	
		 
</div>		
	<?php endif; ?>
	</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero" id="tabs">
<ul class="smsadmintabs" >
<li class="currentsmstab"><a href="<?php echo base_url(); ?>mytemplate/templates">Template</a></li>
<li><a href="<?php echo base_url(); ?>mytemplate/getRecentTemplate">Recent Template</a></li>
</ul>	
</div>  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 <?php echo form_open('mytemplate/templates',
									array('id' => 'form', 'name' => 'add_template_form', 'method' => 'post', 'class' => 'login_text missedcall_allform')
								); ?>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero mrgtpbtm30">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
						<span class="form_lable">Template Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-8 col-xs-12 padding_mzero">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 
						  <?php echo form_input(array('name' => 'template_name', 'id' => 'template_name', 'value' => set_value('template_name'), 'type'=> 'text', 'placeholder'=> 'Template Name')); ?>
						 </div>
						 <?php if(form_error('template_name')): ?>									
									<div class="error-inner">
										<?php echo form_error('template_name', '<span>', '</span>'); ?>
										<?php echo "<script> document.getElementById('template_name').style.border='1px solid red';</script>"; ?>
									</div>
									<?php endif; ?>
						  </div>  
</div>     
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
						<span class="form_lable">SMS Content</span> 
						 </div>
<div class="col-md-7 col-sm-8 col-xs-12 padding_mzero">
                      <?php echo form_textarea(array('name' => 'template', 'id' => 'template', 'value' => set_value('template'), 'class'=> 'form-textarea', 'placeholder'=> 'Type here', 'rows'=>'8')); ?>
					  			<?php if(form_error('template')): ?>									
									<div class="error-inner">
										<?php echo form_error('template', '<span>', '</span>'); ?>
										<?php echo "<script> document.getElementById('template').style.border='1px solid red';</script>"; ?>
									</div>
									<?php endif; ?>
									</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-7 col-sm-8 col-xs-12 col-sm-offset-3 col-md-offset-3 padding_mzero">
<div class="col-md-6 col-sm-6 form-div col-xs-12 padding_zero">
 <h6  class="label count_message count_num" id="count_message">0</h6><small>Number of Charters</small>
 </div>
 <div class="col-md-6 col-sm-6 form-div col-xs-12 padding_zero">
<span class="label count_message count_num" id="hwmnysms">0</span><small>Number of SMS</small>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<?php echo form_submit(array('name' => 'add_template','value' => 'Create', 'class' => 'submit_btn','style'=>''));?>
</div>
</div>
</div>
						 
</div>
<?php echo form_close();?>
        </div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="table-responsive">
<table class="table_all">
				<thead>
				<tr>
<th>Sc No</th>
<th>Date</th>
<th>SMS Content</th>
<th>Template Name</th>
<th colspan="2">Action</th>  


				
				</tr>
				</thead>

         <tbody>         
                     <?php 
	if(count($templates)>0): ?>
	<?php $count = 0; ?>
	<?php foreach($templates as $row): ?>
	<?php if($count%2 == 0): $class = ""; else: $class = "alternate-row"; endif; ?>
	<?php $count++; ?>
    

<tr>  
<td>
<?php echo $count;?>
</td>
<td>
<?php echo $row['on_date']; ?>
</td>
<td>
 <p style="width:400px;" class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" 
             data-original-title="<?php echo $row['template']; ?>" ><?php
 		echo  substr($row['template'],0,30);
 		//echo wordwrap($row['template'],132,"...");
			 ?></p>    
</td>
<td><?php echo $row['template_name'];?></td>
<td>
   <span class="btn btn-sm btn-default"><a href="#<?php echo $row['template_id']; ?>"  data-remodal-target="<?php echo $row['template_id']; ?>" data-toggle="modal">
	<span class="" style="margin-right:5px; padding:0px 9px !important; color:#333;">Edit</span></a>
</span>
 
    <!-- start of Modal -->	
     <div id="<?php echo $row['template_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
           
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
 <form class="form-horizontal" name="templateform" method="post" action="<?php echo base_url();?>mytemplate/templates">
		  
  
    <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<div class="col-sm-3 col-md-3 col-xs-12 padding_zero">
        <label class="form_lable">Templates</label>
		</div>
        <div class="col-sm-7 col-md-7 col-xs-12">
    <textarea rows="4" class="form-control" id="edittemp" name="edittemp" ><?php echo $row['template']; ?></textarea>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
        <div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 col-md-offset-3">

		<input type="hidden" name="template_id" value="<?php echo $row['template_id'];?>"/>
       
       <button type="submit" value="Submit" name="editsubmit"  class="submit_btn pull-right">Save</button>
       
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div>
    <!-- End of Modal -->
</td>
<td>

  <span class="btn btn-sm btn-default"   
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					
					data-href="<?php echo site_url('mytemplate/delete_template/'.$row['template_id']); ?>";
					class=" confirmation-callback" id="dataConfirm" style=" ">
                    Delete</span>
</td>


</tr>
	<?php endforeach; ?>
              
   
			<?php else: ?>
            
		<span> No Records</span>
			<?php endif; ?>
			
			
		</tbody>
				</table>
</div>				
	
				
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<?php echo $this->pagination->create_links(); ?>
		</div>
</div>

</div>

    </div><!-- ./wrapper -->


   
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
 
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
 <script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>

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

<!-- check box event for datepicker-->

<script type='text/javascript'>
     $(document).ready(function() {
 $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 
     });
  </script>      

    <!-- text box text count code-->
		<!--<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'en'
    });
  });
</script>-->
   <script type='text/javascript'>
        
        $(document).ready(function() {
        
       var text_max = 0;
$('#count_message').html(text_max + '');

$('#template').keyup(function() {
  var text_length = $('#template').val().length;
  var text_remaining = text_max + text_length;
  var persms=text_remaining/160;
    var singlecnt=Math.ceil(persms);
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(singlecnt+ '');
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
		
		 <!--<script>
 $(document).ready(function(){

  
  	$('#on_date').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});
});
 </script>-->
 
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



<script>
/*  $( "#tabs" ).tabs({
    select: function(event, ui) {                   
        window.location.hash = ui.tab.hash;
    }
}); 
*/
$("#tabs").bind("tabsshow", function(event, ui) { 
    history.pushState(null, null, ui.tab.hash);
  });
</script>

<script type="text/javascript">
    $(document).ready(function() {
  
    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 50,
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
        </script>
	
</body>
