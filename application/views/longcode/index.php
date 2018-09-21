
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

<div class="col-sm-12 col-md-12 col-xs-12">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Long Code - Received SMS </h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div id="basicExample">
<form action="<?php echo site_url('longcode/index'); ?>" 
name="sms_inbox_search" id="sms_inbox_search" class="recive_sms_dtpik" method="post" >
  <?php if(isset($no_long_code) && $no_long_code): ?>
        <div align="center"><h3>Your not subscribed for Long Code Service. To subscribe Call 040-64547711.</h3></div>
    <?php else: ?>


  <label>From Date:</label>
  <input type="text" name="from_date" id="from_date" class="date start" style="width:200px;">
  <label>To Date:</label>
  <input type="text" name="to_date" id="to_date" class="date end" style="width:200px;">
  <input type="submit" name="Search">
     </form>
    
</div>
<div class="code_div">
   <div class="col-sm-6">
    <a href="<?php echo site_url('longcode/invalidateLongCodeSession'); ?>" class="chage_code_bt">Change Code</a>
     </div>
     <div class="col-sm-6">
      <a href="<?php echo site_url('longcode/download/'.$from_date.'/'.$to_date); ?>" class="export_exel_bt">Export To Excel</a>
     </div>
</div>

     <table class="table_recive">
     <thead>
      <tr>
        <th>S.No.</th>
         <th>On Date</th>
          <th>To</th>
          <th>From</th>
           <th>SMS Text</th>
        </tr>
     </thead>
        <tbody>
           <?php
		  
            $count=1;
			 if(!empty($rownum)){
			 $count=$count+$rownum; 
		}
            foreach($received_sms as $sms): 
			
			?>
         <tr>
        <td><?php echo $count; ?></td>
         <td><?php echo $sms->created_on; ?></td>
          <td><?php echo $sms->code_number; ?></td>
          <td><?php echo $sms->from_number; ?></td>
           <td><?php echo wordwrap($sms->sms_text,60,"\n",1); ?></td>
        </tr>
         <?php
              $count++;
            endforeach;
            ?>
       
        </tbody>
        </table>   
        
         <div align='center' class="F_pagination">
            <?php echo $this->pagination->create_links(); ?>
        </div>
           <?php endif; ?>
		   
		   
		   <!-- New Code For POPUP Start ----->
        <div class="modal fade" id="myModal" style="margin: 120px 1px 1px 150px; width: 500px;">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="purchaseLabel" style="text-align: left">Enter Password</h4>
		            </div>
		            <div class="modal-body" style="text-align: left">
		                 <div class="form-group" id="div_pass">
		                    <div class="input-group">
		                        <!--<span class="input-group-addon">Enter Password : </span>-->
		                        <span class="control-label">Password : </span>
		                        <input type="password" id="txt_password_sales" name="txt_password_sales" class="form-control" placeholder="Password">
		                    </div>
		                </div>
		                <div class="form-group" id="div_pass_err" >
		                	<span class="control-label" for="inputError" id="error" style="display: none;">Password Mismatch</span>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary btn-sm" id="btnPassword_chk_sales" name="btnPassword_chk_sales" onclick="fun_passwrod_chk()">OK</button>
		            </div>
		        </div>
		    </div>
		</div>
</div>
</div>
</div>


    </div><!-- ./wrapper -->

<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>

<script>
    // initialize input widgets first
    $('#basicExample .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });

    $('#basicExample .date').datepicker({
        'format': 'yyyy-m-d',
        'autoclose': true
    });

    // initialize datepair
    var basicExampleEl = document.getElementById('basicExample');
    var datepair = new Datepair(basicExampleEl);
</script>
<!--This page js End -->            
 
  </body>
</html>