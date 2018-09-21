
<body>
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

        <!-- Main content -->
   <section class="col-sm-12 col-md-12 col-xs-12">
          <!-- title row -->
         <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Payment Details </h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<span><b> Note:  Please Check Payment History and  pay intime without fail.</b></span>
</div>
 <section class="col-md-12 col-sm-12 col-xs-12 padding_zero" id="unseen">
                                                          
                            <table class="table_all">
                              <thead>
          <tr> <th class="numeric">S.NO</th><th class="numeric">Number of SMS</th> <th class="numeric">Date</th> <th class="numeric">Amount</th><th class="numeric">Invoice No</th><th class="numeric">No of Day Pending</th></tr>
          </thead>
         <?php
         /*
         $pendingsql=mysql_query("SELECT up.invoice_id,up.price,up.on_date,up.no_of_sms ,up.total_amount , up.payment_type  from user_payments up where   up.user_id='".$userid."' and payment_type =1  and YEAR(on_date)=YEAR(CURDATE())  ORDER BY on_date DESC " );
         
         */
 
 //print_r($userpayments);
      $sno=1;
	if($this->uri->segment(3)!='')
	{
	$sno=$this->uri->segment(3)+1;
	}
	foreach($userpayments as $key=>$pendingrec)
	{
		
	$on_date=$pendingrec['on_date'];
	$todaydate = date('Y-m-d');
    $stildate=date('Y-m-d', strtotime($todaydate));

    $frmdate = date('Y-m-d', strtotime($on_date));
		$month1 = substr($todaydate,5,2);
    	$day1 = substr($todaydate,8,2);
    	$year1 = substr($todaydate,0,4);

    	$month2 = substr($frmdate,5,2);
    	$day2 = substr($frmdate,8,2);
    	$year2 = substr($frmdate,0,4);

    	$date1 = mktime(0,0,0,$month1,$day1,$year1);
    	$date2 = mktime(0,0,0,$month2,$day2,$year2);

    	if($date1 > $date2){
        	$dateDiff = $date1 - $date2;
    	} else {
        	$dateDiff = $date2 - $date1;
    	}?>
   <tr> <td class="numeric"><?php echo $sno; ?></td><td class="numeric"><?php echo $pendingrec['no_of_sms']; ?></td> <td class="numeric"><?php echo $pendingrec['on_date']; ?></td><td class="numeric"><?php echo  number_format(($pendingrec['total_amount']),2,'.',','); ?> </td><td class="numeric"><?php echo $pendingrec['invoice_id']; ?></td><td class="numeric"><?php echo   $fullDays = floor($dateDiff/(60*60*24))." Days Ago"; ?></td></tr>
	
	<?php
	$sno++;
	}
         
      
       ?></table>
                          
                              
                              </section>
                          
                      
                  </div>
                  
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

	<?php echo $this->pagination->create_links(); 
	?>	 
	</div>
              
              
            </div><!-- /.col -->
          </div>
          <!-- info row -->
        
        </section>

      

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
   
  </body>

