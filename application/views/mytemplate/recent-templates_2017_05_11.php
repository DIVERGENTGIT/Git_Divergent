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
	<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<ul class="smsadmintabs">
<li><a href="<?php echo base_url(); ?>mytemplate/templates">Template</a></li>
<li class="currentsmstab"><a href="<?php echo base_url(); ?>mytemplate/getRecentTemplate">Recent Template</a></li>
</ul>	
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">  
  <div class="col-md-12 col-sm-12 form-div col-xs-12 missedcall_allform padding_zero">
  	<!-- <form action="<?php echo base_url();?>mytemplate/getRecentTemplate" method="post">
	<ul class="search-list05 missedcall_allform">
<li>
<input type="text" id="from_date" name="from_date" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg">
</li>
<li>
<input type="text" id="to_date" name="to_date" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg">
</li>
 

<li><input type="submit" name="recentTemplates" class="submit_btn" value="Search"> </li>
</ul>
	   
	 
		 
 
	 
	 </form> -->
	  
  </div>
  
  
  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <!--  <p class="temp-note"><b>Note</b>: Submit your template to send SMS</p> -->
  </div>
<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
<div class="table-reponsive">
<table class="table_all"  >
<thead>
<tr><th>S.No</th><th>Date</th><th>SMS Content</th>  </tr>
</thead> 
<tbody>
	 <?php $count = 0; foreach($templates as $row) {
			$count++; ?>  
		<tr id="<?php echo $row->campaign_id;?>">
			<td><?php echo $count; ?></td>
			<td><?php echo $row->created_on;?></td>		
			<td>  
			<p class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $row->sms_text; ?>" ><?php echo  substr($row->sms_text,0,30); //wordwrap($row->sms_text,132,"..."); ?></p>  
			</td>
			<!-- Updated on 2017-02-4 <td><?php echo $row->template_name;?></td> 
			<td><span class="btn btn-sm btn-default"   
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					
					data-href="<?php echo site_url('mytemplate/delete_campaign_template/'.$row->campaign_id); ?>";
					class=" confirmation-callback" id="dataConfirm" style=" ">
                    Delete</span></td> -->
		</tr>
		
	 <?php } ?>	
		 
</tbody>
</table>
 </div>
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

</body>
