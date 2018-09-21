<script type="text/javascript" src='<?php echo base_url();?>/js/jquery.js'></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />


   <script src="<?php echo base_url();?>/js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>

     
<script type="text/javascript">
$(document).ready( function(){
	 $('#from_date').datetimepicker({	
		 	dateFormat: 'yyyy-mm-dd'
	 });

	 $('#to_date').datetimepicker({	
		 	dateFormat: 'yyyy-mm-dd'
	 });
});
</script>

<?php
$form_attributes = array(
	'id' => 'single_sms_form',
	'name' => 'single_sms_form'
);
?>
<td align="left" valign="top"> <div id="explore_hedder">
                <div id="lft_bg"></div>
                <div id="mid_hed_bg">Business SMS</div>
                <div id="mid_mid_bg"></div>
                <div id="mid_bg"></div>
                <div id="rit_bg"></div>
            </div>
          <div id="explore_content">
		  <br />
		  <br />
		 <?php if(isset($deleted)) { ?>
		 <h3 align="center" style='color: red;'><?php echo $deleted?></h3>
		 <?php } ?> 
		 <div style='height: 40px;'>
		 
		 <?php echo form_open('campaign/viewcampaigns',array('name' => 'campaign_search', 'id' => 'campaign_search')); ?>
		 <table cellpadding=0 cellspacing=0 class="textsmstd" align="center" width="98%">
		 <tr><td><?php echo form_input(array('name' => 'search', 'id' => 'search', 'class' => 'register_input', 'style' => 'width:200px;', 'value' => set_value('search')))?>&nbsp;
		 <?php echo form_submit(array('name' => 'Search','value' => 'Search', 'class' => 'register_button'));?></td>
		 <td align="right">
		 <input type="button" name="add_purchase" value="Add Purchase" 
		 	onclick="javascript: window.location='<?php echo site_url('/businessSMS/add'); ?>'"></input>
		 &nbsp;<input type="button" name="send_SMS" value="Send SMS To All"></input></td>
		 </tr>
		 </table>
		 <?php echo form_close();?>
		 </div>
		 <div class="campaign_list">
		 <table cellpadding=0 cellspacing=0 align="center">
		 <tr>
		 <th>#</th>
		 <th>On Date</th>
		 <th>Sender</th>
		 <th>SMS Text</th>
		 <th>No. of SMS </th>
		 <th> Status </th>
		 <th>Download</th>
		 </tr>
		 
		 </table>
		 <div align='center' class="textsmstd">
		<?php //echo $this->pagination->create_links(); ?>
		</div>
		 <br></br>
     <br></br>
     
        
     </div>  
    
     
         
     
     </div>
          <div id="explore_content_dwn"></div></td>
  </tr>
</table>

    </td>
  </tr>