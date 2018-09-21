
 
 <style type="text/css">
 
 section.content {
    margin-top: 43px !important;
}
 .label-info {
       background-color: rgb(236, 240, 245) !important;
    border: 1px solid #ccc !important;
    color: #215A94 !important;
}
.panel-heading strong {
    color: #09F !important;
}
/*.may-temp-content p{ max-width:400px; min-width:300px !important;}*/
.well{ border:0px !important; background-color:transparent !important; border-radius:0px !important; }

.well {
    min-height: 11px !important;
    padding: 11px !important;
    margin-bottom: 0px !important;
	box-shadow:none !important;
	
}
.row-fluid {
    word-wrap: break-word;
}

.alert.alert-.alert-dismissable {
margin-bottom: 1px !important;
border: 0px !important;
height: 45px !important;
overflow: hidden !important;
width:350px;
}

.modal-title {
color: #fff;
padding: 0px !important;

}
.modal-open .modal {

top: 12% !important;
}
#template {
    width: 500px !important;
}

 </style>

  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper col-md-12 col-sm-12 col-xs-12" style=" background-color: #ecf0f5; ">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
			<?php if(isset($added)): ?>
			<div class="alert alert-warning" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>
		<div class="valid_box">
		 	<?php echo $added; ?>
		</div>
		</div>
	<?php elseif(isset($edited)): ?>
		<div class="alert alert-warning" style="background:#d9edf7 !important;color:#31708f !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>
		<div class="valid_box">
		 	<?php echo $edited; ?>
		</div>
		</div>
	<?php elseif(isset($deleted)): ?>
	<div class="alert alert-warning" style="background:#f2dede !important;color:#a94442 !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>
		<div class="error_box">
		 	<?php echo $deleted; ?>
		</div>	
</div>		
	<?php endif; ?>
	
        <section  style="padding-left:0px !important;">
        <div class="ng-scope" data-ng-controller="formConstraintsCtrl" style="      margin-bottom: -16px;   padding: 0px !important; ">
            <div class="panel panel-default">
			
			<?php echo form_open('myaccount/templates',
									array('id' => 'form', 'name' => 'add_template_form', 'method' => 'post', 'class' => 'login_text')
								); ?>
                <div class="panel-heading col-md-12"><strong><span class="glyphicon glyphicon-th" style="margin-left:15px;"></span>Templates</strong></div>
               
               
                <div class="panel-body">
                <div class="col-sm-12 form-group" style="margin-top: 20px;">
                
                    <label for="" class="col-sm-3" style="text-align:right;">Request Template </label>
					
                    <div class="col-sm-6">
                      <?php echo form_textarea(array('name' => 'template', 'id' => 'template', 'value' => set_value('template'), 'class'=> 'form-textarea','rows'=>'8')); ?>
					  			<?php if(form_error('template')): ?>									
									<div class="error-inner">
										<?php echo form_error('template', '<span>', '</span>'); ?>
										<?php echo "<script> document.getElementById('template').style.border='1px solid red';</script>"; ?>
									</div>
									<?php endif; ?>
                        <td> 
                        <h6 class="label label-info" id="count_message">0</h6>
                        <small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td>
                        <td ><span class="label label-info" id="hwmnysms"  style="margin-left:20px; font-weight:200 !important;">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
						<?php echo form_submit(array('name' => 'add_template','value' => 'Add Template', 'class' => 'btn  btn-default btn-sm','style'=>'float:right;'));?>
                    </div>
                     
                </div>
			
                              
                    
                </div>
            </div>
			<?php echo form_close();?>
        </div>
        
        </section>
        
      
       <div class="cliarfix"></div>
	   
	   
	
	   
	<section>
        <div class="col-md-12 padding_ltrt ng-scope" data-ng-controller="formConstraintsCtrl"  style="margin-bottom: 60px;">
            <div class="panel panel-default" style="  background-color:#fff;">
            
            
            
     
    <div class=" clearfix"></div>
    
  
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Approved Templates</strong></div>
				<div class="col-sm-12" style="background:#ffffff">
				<div class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
				<table class="col-sm-12 table_all">
				<thead>
				<tr>
				<td>Sc No</td>
				<td>Date</td>
				<td>Template Content</td>
				<td>Edit</td>
				<td>Pending</td>
				<td>Delete</td>
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
	<td><?php echo $count; ?></td>
	<td><?php echo $row->on_date; ?></td>
	<td> <p class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" 
             data-original-title="<?php echo $row->template; ?>" ><?php
			
echo wordwrap($row->template,132,"...");
			 ?></p></td>
			 <td>  <span class="btn btn-sm  btn-default " ><a href="#<?php echo $row->template_id; ?>"  data-remodal-target="<?php echo $row->template_id; ?>" data-toggle="modal">
					<span class="" style=" margin-right:5px; padding:0px 9px !important; color:#333; ">Edit</span></a>
</span></td>
<td>
  <span class="btn btn-sm  btn-default " style="  "><?php
							if($row->status == 0):
								echo "Pending";
							elseif($row->status == 1):
								echo "Approved";
							elseif($row->status == 2):
								echo "Rejected";
							endif;
							?></span>
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
					
					data-href="<?php echo site_url('myaccount/delete_template/'.$row->template_id); ?>";
					class=" confirmation-callback" id="dataConfirm" style=" ">Delete</span>
</td>

	</tr>

  
    <!-- start of Modal -->	
     <div id="<?php echo $row->template_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background:transparent;border:0px;-webkit-box-shadow:none;box-shadow:none;z-index:999999 !important">
        <div class="modal-dialog" style="margin-top:0px !important;">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" style=" color: #FFF !important;  font-size: 17px !important; background-color:transparent !important;"><center>Edit Templates</center></h4>
        </div>
        <div class="modal-body">
 <form class="form-horizontal" name="templateform" method="post" action="<?php echo base_url();?>/index.php/campaign/normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="edittemp" name="edittemp" ><?php echo $row->template; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">

		<input type="hidden" name="template_id" value="<?php echo $row->template_id;?>"/>
        <button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="editsubmit"  class="btn btn-default btn-sm pull-right "  style="margin-right: 20px;">Save</button>
       
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div>
    <!-- End of Modal -->				
			
    
  
				    
			<?php endforeach; ?>
              
    </div>
			<?php else: ?>
            
		<span> No Records</span>
			<?php endif; ?>
			
			
			 </tbody>
    </table>
			
		</div>	
		</div>	
				
        </div>
        </div>
        
        </section>   
	   
	   
	   
	  <!-- Edit modal start-->
	   

	   
	   




                   
<div class="clearfix"></div>


</div>

           <!--footer starts-->     


     
     

    </div><!-- ./wrapper -->

   <!-- jQuery 2.1.4 -->
    
  
    <!-- Bootstrap 3.3.2 JS -->
    
		

	<!--<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>-->

     <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
 
 <script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
  
    <!-- ChartJS 1.0.1 -->
    
    
    <!-- <script src="http://ethaizone.github.io/Bootstrap-Confirmation/bootstrap-confirmation.js" type="text/javascript"></script>
    <script src=" http://ethaizone.github.io/Bootstrap-Confirmation/assets/js/bootstrap-tooltip.js" type="text/javascript"></script>-->

<!--<script>
	$(function() {
		
		$('body').confirmation({
			selector: '[data-toggle="confirmation"]'
		});
		
	});
	</script>-->
    
    <!--<script type="text/javascript"src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>-->
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
