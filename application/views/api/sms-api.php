
  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
      <!-- Left side column. contains the logo and sidebar -->


      <!-- Content Wrapper. Contains page content -->
   <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <!-- Content Header (Page header) -->
            <!-- Main content -->
			<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/api-integration-icon.png" class="right-title-img">List Of SMS API</h3>
</div>
        <section class="col-sm-12 col-md-12 col-xs-12 smsapilist padding_zero">
        <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
            
               
                <div class="col-md-12 col-sm-12 col-md-12">
                 
				 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Single Messaging API</h4>
                    <p class="api-wrap">https://www.smsstriker.com/API/sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=[xxxxxxxxxx]&msg=[xxxx]&type=1 </p>
                    </div>
					
				   <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Bulk Messaging API</h4>
                    <p class="api-wrap">https://www.smsstriker.com/API/sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=xxxxxx, xxxxxx, xxxx, xxxxx&msg=[xxxx]&type=1  </p>
                    </div>	
					
					 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Multiple Messages to Multiple Mobile numbers API</h4>
                    <p class="api-wrap">https://www.smsstriker.com/API/multi_messages.php?username=xxxxxx&password=xxxxxx&from=xxxxxxxx
					&mno_msg=xxxxxx^xxxxxx~xxxxxx^xxxxxx~xxxxxx^xxxxxx&type=1&dnd_check=0 </p>
                    </div>
				

		 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Unicode Single Messaging API</h4>
                    <p class="api-wrap">https://smsstriker.com/API/unicodesms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=[xxxxxx, xxxxxx, xxxxx, xxxxx]&msg=[xxxx]&type=1&dnd_check=0 </p>
                    </div>
                    
                      
                     <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Unicode Bulk Messaging API</h4>
                    <p class="api-wrap">https://www.smsstriker.com/API/unicode_multi_sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&mno_msg=xxxxxx^xxxxxx~xxxxxx^xxxxxx~xxxxxx^xxxxxx&type=1&dnd_check=0</p>
                    </div>  

  
		    <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>International Messaging API</h4>
                    <p class="api-wrap">https://smsstriker.com/API/internationalSMS.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=[xxxxxx, xxxxxx, xxxxx, xxxxx]&msg=[xxxx]&type=1&dnd_check=0 </p>
                    </div>	
		   

					 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Get Balance API</h4>
                    <p class="api-wrap"> https://www.smsstriker.com/API/get_balance.php?username=xxxxx&password=xxxxx </p>
                    </div>
              
					
					
					
					<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>DND Check API</h4>
                    <p class="api-wrap">https://www.smsstriker.com/API/dnd_check.php?username=xxxxx&password=xxxx&to=xxxxxx  </p>
                    </div>
					
					
					
					<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    <h4>Scheduled Messaging API </h4>
                    <p class="api-wrap">https://www.smsstriker.com/API/scheduled_sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=[xxxxxx]&msg=[xxxx]&type=1&scheduled_date=
					[YYYY-MM-DD]&scheduled_time=[HH:MM] </p>
                    </div>
                 </div>
 </section>
        
      
       <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
             <div class="col-md-12 col-xs-12 col-sm-12 padding_zero"> 
                <h3 class="right-content-title mrg-top35"><img src="<?php echo base_url();?>images/api-integration-icon.png" class="right-title-img">Input Parameters Description</h3>
				</div>
                <div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
				<table class="table_all">
<thead>
<tr>
<th>Parameter</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td>Username</td>
<td>Registered UserName</td>
</tr>
<tr>
<td>Password</td>
<td>Password associated to the registered UserName.</td>
</tr>
<tr>
<td>From</td>
<td>Sender Name, it should not more than 6 Characters.</td>
</tr>
<tr>
<td>To</td>
<td>Mobile Number (+91 not required). It Support to send same SMS for multiple Numbers at a time. for this, send mobile numbers with comma(,) Seperated.</td>
</tr>
<tr>
<td>Message</td>
<td>SMS Text. It Supports for Long Messages.</td>
</tr>
</tbody>
</table>

                </div><!-- /.box-body -->
              
            </div>
       
        </div>


    </div><!-- ./wrapper -->

  
  
  </body>
</html>
