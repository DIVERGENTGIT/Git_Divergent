<h2> SMS API </h2>

<div  style="border:2px solid #E5E5E5; padding:20px 5px 20px 5px; background-color:#EFEFEF; font-size:12px; width:95%; text-align:left">
<strong>Single Messaging API</strong><br/><br/>

   http://www.smsstriker.com/API/sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=[xxxxxxxxxx]&msg=[xxxx]&type=1
   
   
   <br/><br/><strong>Bulk Messaging API</strong><br/><br/>
   http://www.smsstriker.com/API/sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=xxxxxx, xxxxxx, xxxx, xxxxx&msg=[xxxx]&type=1
   
   
   <br/><br/><strong>Multiple Messages to Multiple Mobile numbers API</strong><br/><br/>
	http://www.smsstriker.com/API/multi_messages.php?username=xxxxxx&password=xxxxxx&from=xxxxxxxx&mno_msg=xxxxxx^xxxxxx~xxxxxx^xxxxxx~xxxxxx^xxxxxx&type=1&dnd_check=0

   
   
    <br/><br/><strong>Get Balance API</strong><br/><br/>

		http://www.smsstriker.com/API/get_balance.php?username=xxxxx&password=xxxxx
        
        
        
       <br/><br/><strong> DND Check API</strong><br/><br/>

		http://www.smsstriker.com/API/dnd_check.php?username=xxxxx&password=xxxx&to=xxxxxx

	<br/><br/><strong> Scheduled Messaging API </strong><br/><br/>
	http://www.smsstriker.com/API/scheduled_sms.php?username=[xxxxxx]&password=[xxxxxx]&from=[xxxxxxxx]&to=[xxxxxx]&msg=[xxxx]&type=1&scheduled_date=[YYYY-MM-DD]&scheduled_time=[HH:MM]
   
   
   </div>
   
   </center>
   <br />
   <h2>Input Parameters Description</h2>
   
   <table id="rounded-corner">
   <thead>
   <tr><th scope="col" class="rounded-company">Parameter</th><th scope="col" class="rounded-q4">Description</th></tr>
   </thead>
   <tfoot>
    	<tr>
        	<td class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
   </tfoot>
   <tbody>
   <tr><td>username</td><td>Registered UserName</td></tr>
   <tr><td>password</td><td>Password associated to the registered UserName</td></tr>
   <tr><td>from</td><td> Sender Name, it should not more than 6 Characters </td></tr>
    <tr><td>to</td><td> Mobile Number (+91 not required). It Support to send same SMS for multiple Numbers at a time. for this, send mobile numbers with comma(,) Seperated.  </td></tr>
	<tr><td>Message</td><td> SMS Text. It Supports for Long Messages.</td></tr>
	</tbody>
   </table>