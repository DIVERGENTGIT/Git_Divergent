<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Short Url Reports</h3>
</div>
<!-- 
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
<a style="float: right;" href="<?php echo base_url();?>campaign/shorturl_reports_download/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" class="submit_btn">
     Download Report <span class="bt_green_r"></span></a>	  
</div> -->

<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
 <!-- <a href="<?php echo base_url();?>campaign/shorturl_reports_download">Download</a> -->
<div class="col-md-12 col-xs-12 col-sm-12 form-div padding_zero">
<div class="">
    <table class="table_all">
        <thead>
        <tr> 
	<th>S.No</th>  
	<th>Phone</th>
 	<th>Short Url </th>  
	<th>Date & Time</th> 
	<th>Reports</th>
         </tr>
        </thead>       
        <tbody>   

        <?php

   $count = 0;
   
 $sno=1;
   
   if($this->uri->segment(5)!='')
   {  
    $sno=$this->uri->segment(5)+1;
   }
   
//echo count($urlReports);
  
foreach($urlReports as $shorturl)
{ 

//print_r($shorturl);

//echo $shorturl['to_mobile_no'];

	$findString = $UrlGenIp; $longurls = array();
	$number_of_shorturl = substr_count($shorturl['sms_text'], $findString);  
	 if($number_of_shorturl == 1) {
		$pos = stripos($shorturl['sms_text'], $findString); 
		$str = substr($shorturl['sms_text'], $pos); 
		$shortCode = substr($str, strlen($findString)); 
		$longurls[0] = $short_code = substr($shortCode, 0, 7);  
 	 }else if($number_of_shorturl == 2) {
		$pos = stripos($shorturl['sms_text'], $findString); 
		$str = substr($shorturl['sms_text'], $pos); 
		$shortCode = substr($str, strlen($findString)); 
		$longurls[0] = $short_code = substr($shortCode, 0, 7);
	  	$search_string = "$findString$short_code";  
		$smstext = str_replace($search_string, "find", $shorturl['sms_text']); 

		$pos1 = stripos($smstext, $findString); 
		$str1 = substr($smstext, $pos1); 
		$shortCode1 = substr($str1, strlen($findString)); 
		$longurls[1] = $short_code1 = substr($shortCode1, 0, 7); 
	 }else if($number_of_shorturl == 3) {
		$pos = stripos($shorturl['sms_text'], $findString); 
		$str = substr($shorturl['sms_text'], $pos); 
		$shortCode = substr($str, strlen($findString)); 
		$longurls[0] = $short_code = substr($shortCode, 0, 7);
	  	$search_string = "$findString$short_code";  
		$smstext = str_replace($search_string, "find", $shorturl['sms_text']);
  
		$pos1 = stripos($smstext, $findString); 
		$str1 = substr($smstext, $pos1); 
		$shortCode1 = substr($str1, strlen($findString)); 
		$longurls[1] = $short_code1 = substr($shortCode1, 0, 7); 
	  	$search_string = "$findString$short_code1";  
		$smstext1 = str_replace($search_string, "find", $smstext);  
 
		$pos2 = stripos($smstext1, $findString); 
		$str2 = substr($smstext1, $pos2); 
		$shortCode2 = substr($str2, strlen($findString)); 
		$longurls[2] = $short_code2 = substr($shortCode2, 0, 7);
	 }else if($number_of_shorturl == 4) {
			$pos = stripos($shorturl['sms_text'], $findString); 
			$str = substr($shorturl['sms_text'], $pos); 
			$shortCode = substr($str, strlen($findString)); 
			$longurls[0] = $short_code = substr($shortCode, 0, 7);
				$search_string = "$findString$short_code";  
			$smstext = str_replace($search_string, "find", $shorturl['sms_text']); 

			$pos1 = stripos($smstext, $findString);    
			$str1 = substr($smstext, $pos1); 
			$shortCode1 = substr($str1, strlen($findString)); 
			$longurls[1] = $short_code1 = substr($shortCode1, 0, 7); 
				$search_string1 = "$findString$short_code1";  
			$smstext1 = str_replace($search_string1, "find", $smstext); 


			$pos2 = stripos($smstext1, $findString); 
			$str2 = substr($smstext1, $pos2); 
			$shortCode2 = substr($str2, strlen($findString)); 
			$longurls[2] = $short_code2 = substr($shortCode2, 0, 7);
			$search_string2 = "$findString$short_code2";  
			$smstext2 = str_replace($search_string2, "find", $smstext1); 
 
	   $pos3 = stripos($smstext2, $findString); 
			$str3 = substr($smstext2, $pos3); 
			$shortCode3 = substr($str3, strlen($findString)); 
			$longurls[3] = $short_code3 = substr($shortCode3, 0, 7);  
	 } 
	// print_r($longurls);
	
 	 foreach($longurls as $longurl) {
 	  
		$longurl = explode(' ',$longurl);
		$longCode = array_filter($longurl); 
		 foreach($longCode as $longurl) { 
			 if(strlen($longurl) == 7) { 
			 $short_code = substr($longurl, 0, 7); $count++;
       		 ?>
       		  
		<tr style="height:30px !important;" > 
			<td><?php echo $count; ?></td> 
			<td><?php echo $shorturl['to_mobile_no']; ?></td> 
					
				<td><?php  echo $UrlGenIp.$short_code; ?></td>  
		
			 
			<td><?php echo $shorturl['sent_on']; ?></td>
	<td>	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#<?php echo $short_code;?>">View  </button>

<div id="<?php echo $short_code;?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">         

        <div class="modal-dialog modal-md">  
        
            <div class="modal-content col-md-12 col-sm-12 col-xs-12">           
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   
                </div>
                <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="table-responsive">
<table class="table_all">
<thead>
        <tr>
	<th scope="col" class="rounded-company">S.No</th>  
	<th scope="col" class="rounded">Device type</th>
	<th scope="col" class="rounded">Browser type</th>
	<th scope="col" class="rounded">Operating System</th>
	<th scope="col" class="rounded">Build By</th>
	<!-- <th scope="col" class="rounded">Short Url</th> -->
	<th scope="col" class="rounded">Date &amp; Time</th>
     
        </tr>  
        </thead>
<tbody>    
<?php $number = 0;  
	 $shorturlreports = $this->Campaign_model->shortcode_reports($userId,$short_code); 
	//print_r($shorturlreports);  
	foreach($shorturlreports as $userInfo) {  
  		$number++;  ?>
		<tr style="height:30px !important;" >
			<td><?php echo $number; ?></td>
 			<td><?php echo $userInfo['device_type']; ?></td>
			<td><?php echo $userInfo['browser_type']; ?></td>
			<td><?php echo $userInfo['operating_system']; ?></td>
			<td><?php echo $userInfo['build_by']; ?></td>
			<!-- <td><?php echo $UrlGenIp.$userInfo['short_code'];  ?></td> -->
			<td><?php echo $userInfo['created_on']; ?></td>
		</tr>

	<?php } ?>

 </tbody>
    
</table>
</div>
</div>



</div> 
               
              
            </div>
             
        </div>
       
   
        </div>


</td>	  	 
    
		</tr> 
		 
	<?php }  }  } 

	$sno++;
 } ?>
    
  
 
    </table>
	</div>
<div class="col-md-12 col-sm-12 col-xs-12 pagination_div padding_zero">
<?php echo $this->pagination->create_links(); 
?>
</div>
 </div>
   

	<div class="col-md-12 col-xs-12 col-sm-12 padding_zero"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
		<span class="bt_green_lft"></span><a onclick="history.back();" style="cursor:default"; ><strong>Back</strong></a><span class="bt_green_r"></span> 
 	</div>
</div>

</div>
</div></div></body>

	<!-- FastClick -->
	
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>



	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-sliderAccess.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-validate.bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<script>

  
  
  
$(document).ready(function(){
    $("tr .dropdown-toggle").click(function(){
		 $(this).parent().children().toggleClass("selected_001");
        
    });
   
});
</script>
<script>
$(document).ready(function(){
    $(".close_dropdown").click(function(){
		 $(".dropdown-menu").removeClass("selected_001");
        
    });
   
});


</script>
		
			
<script>
function goBack() {
    window.history.back();
}
</script>

    <script>
	$(document).ready(function() {
	
      $(".assign").on("change",function () {
          
            $(".assigncampaign").prop('checked', $(this).prop("checked"));
      });
      
      $(".masking").on("change",function () {
           
            $(".maskingcampaign").prop('checked', $(this).prop("checked"));
      });
      
      
       $(".unassign").on("change",function () {
          
            $(".unassigncampaign").prop('checked', $(this).prop("checked"));
      });
      
      $(".unmasking").on("change",function () {
           
            $(".unmaskingcampaign").prop('checked', $(this).prop("checked"));
      });
      
      });
     </script>     
     
<!-- view End-->
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 25,
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


function validation()
{
	if($("#from_date").val() != '' || $("#to_date").val() != '')
	{
		if($("#from_date").val() == '' || $("#to_date").val() == '')
		{
			alert("Please select from date and to date.");
			return false;
		}
	}
}
</script>

