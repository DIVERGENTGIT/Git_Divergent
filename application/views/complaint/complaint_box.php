  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

      <div class="content-wrapper">
<div class="col-sm-12 col-md-12 col-xs-12">
<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Complaint Box</strong></div>
<?php if(isset($msg))
{?>
<div class="alert alert-warning" style="background:#dff0d8 !important;margin-bottom: 0px !important;color:#3c763d !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d !important;top: -2px;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>
		<div class="error_box">
<?php echo $msg;?>
		</div>	
		</div>
<?php 
} 
?>
		



<div class="content_bg01">
<div class="col-sm-12">
<div id="tabs-container01">
    <ul class="col-sm-12 tabs-menu01">
	 <li class="current01"><a href="#tab-1">Complaints</a></li>
        <li><a href="#tab-2">Customer Support</a></li>
       
    </ul>
    <div class="col-sm-12 tab01">
	
        <div id="tab-1" class="tab-content01">
		<?php echo form_open('complaintbox/index',
					array('id' => 'complaint_form', 'name' => 'complaint_form', 'method' => 'post')
	); ?>
           <table class="col-sm-8 comp_laint_box">
	
	
	<tr>
	<td>
	<label>Complaint For<span>*</span></label>
	</td>
	<td>
	<?php echo form_dropdown('issue_type', 
					array('' => '--select--',
						'Sales Team' => 'Sales Team',
						'Support Team' => 'Support Team',
						'Technical Team' => 'Technical Team'), set_value('issue_type')); ?>
				<div class="form_error"><?php echo form_error('issue_type'); ?></div>
	</td>
	</tr>
	
	<tr><td><label>Contact No<span>*</span></label></td><td><?php echo form_input(array('name' => 'contact_number', 'id' => 'contact_number', 'value' => set_value('contact_number'))); ?>
	<div class="form_error"><?php echo form_error('contact_number'); ?></div>
				</td></tr>
		<tr><td><label>Email<span>*</span></label></td><td><?php echo form_input(array('name' => 'cust_email','id' => 'cust_email', 'value' => set_value('cust_email'))) ?>
		 <div class="form_error"><?php echo form_error('cust_email'); ?></div>
		</td></tr>
			<tr><td><label>Subject<span>*</span></label></td><td><?php echo form_input(array('name' => 'subject', 'id' => 'subject', 'value' => set_value('subject') ));?>
			  <div class="form_error"><?php echo form_error('subject'); ?></div>
                 </td></tr>
				<tr><td><label>Complaint<span>*</span></label></td><td>
				
				 <?php echo form_textarea(array('name' => 'complaint_text', 'id' => 'complaint_text', 'value' => set_value('complaint_text'),'row' => '7'));?>
                 <div class="form_error"><?php echo form_error('complaint_text'); ?></div>
				
				</td></tr>
				<tr><td></td><td>
				<?php echo form_submit(array('name' => 'submit','value' => 'Submit', 'class' => '"btn btn-default btn-sm'));?>
				</td></tr>
				
	</table>
	<?php echo form_close(); ?>
<!--<table class="table_all">
     <thead>
	  <tr>
        <th>S.No.</th>
         <th>Date</th>
          <th>Sms</th>
          <th>View</th>
        </tr>
	 </thead>
        <tbody>
        
         <tr>
        <td>1</td>
         <td>2015-09-03 16:25:54</td>
          <td>2015-09-03 16:25:54</td>
          <td>2015-09-03 16:25:54</td>
        </tr>
         <tr>
        <td>2</td>
         <td>2015-09-03 16:25:54</td>
          <td>2015-09-03 16:25:54</td>
          <td>2015-09-03 16:25:54</td>
        </tr>
		<tr>
        <td>3</td>
         <td>2015-09-03 16:25:54</td>
          <td>2015-09-03 16:25:54</td>
          <td>2015-09-03 16:25:54</td>
        </tr>
     
        </tbody>
        </table>-->

        </div>
		<div id="tab-2" class="tab-content01">
         <p>
<b>Striker Soft Solutions Pvt. Ltd.</b><br/>
4th Floor, Sinman Dwarka Building <br/>
Beside Max Cure Hospital,Patrika Nagar <br/>
Madhapure, Hyderabad - 500 081
</p>
<p>
<b>Ph:</b> 040 - 64547711 <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
 
<p><b>Email:</b>&nbsp;<a href="mailto:support@strikersolutions.in">support@smsstriker.com</a></p>
        
        </div>
    </div>
</div>
</div>

</div>
    </div><!-- ./wrapper -->	
	 
	
</div>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/vroom.css">
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $(".tabs-menu01 a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current01");
        $(this).parent().siblings().removeClass("current01");
        var tab = $(this).attr("href");
        $(".tab-content01").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
 </script>
 <script type="text/javascript">
$(document).ready(function() {
    $("#contact_number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#contact_number').val().length >= 10 || $('#contact_number').val().length == 10) {
            e.preventDefault();
        }
    });
	
	

});
</script>

  </body>
