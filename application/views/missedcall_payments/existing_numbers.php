<?php
		$prinumtype="";
		$planprice=0;
		$slno = 0;  
		$checked = '';
		//$checked_nos=$checkedno;
		$checked_nos='';
		//print_r($cart_num);
			
		if(count($did_numbers)>0)
		{		
			foreach($did_numbers as $key => $gold_nos) 
			{
			?>	
			<li class="cls<?php echo $gold_nos['did_type']; ?>"	>
			<div class="all_checkbox model_check">
			<input id="checksernumb<?php echo $slno;?>" type="checkbox" name="ssnos[]" class="existcheckboxstyle ssnos 
			getnumber<?php echo $gold_nos['did_number'];?> " value="<?php echo $gold_nos['did_amount'].','.$gold_nos['did_number'] .','. $gold_nos['did_type'] .','. $planprice.','. $gold_nos['did_plan'];?>"><label class="font_normal"><span><span></span></span><?php echo $gold_nos['did_number'];?></label>
			</div></li>
			<?php		
			}
	} else {
			//echo "Your search - ".$goldno." - did not match any service numbers!";
			
			echo "Service Numbers are not available with this criteria!.";
			
			return false;
		}
?>

<input type="hidden" class="append_data"/>

<input type="hidden" class="getdidnos"/>

<input type="hidden" class="smscontent"/>

<script>
$(document).click(function(e){
var checkboxes = $("ul li input[type='checkbox']");
var snos = '';
var sum = 0;
checkboxes.on('change', function() {
	
    $('.append_data').val(	
        checkboxes.filter('.existcheckboxstyle:checked').map(function(item) { 			
			sno = this.value;
			snos = sno.split(",");			
			return snos[1];			
        }).get().join('\n')		
     );
     
     $('.getdidnos').val(	
        checkboxes.filter('.existcheckboxstyle:checked').map(function(item) { 			
			sno = this.value;
			snos = sno.split(",");			
			return snos[1];			
        }).get().join(',')		
     );
     	
     	/*
     	$('#sms_text').val(	
        checkboxes.filter('.checkboxstyle:checked').map(function(item) { 			
			sno = this.value;
			snos = sno.split(",");			
			return snos[1];			
        }).get().join(',')		
     );*/
     
     //	$(".append_data").val(''); 
      //$(".append_data").html(''); 
     		 
	});		
}); 
</script>

 <script>
 $(document).ready(function() {
 
 $(".existorderbtn").on("click",function(){
 
 if($('#sms_text').val()=="\n")
 {
 	$('#sms_text').val($('#sms_text').val()+$(".append_data").val());
 }
 else
 {
 	$('#sms_text').val($('#sms_text').val()+"\n"+$(".append_data").val());
 }
	var arr = $("#sms_text").val().split("\n");
	var arrDistinct = new Array();
	$(arr).each(function(index, item) {
	if ($.inArray(item, arrDistinct) == -1)
	arrDistinct.push(item);
	});
	$("#sms_text").val("");
	$(arrDistinct).each(function(index, item) {
	$("#sms_text").val($("#sms_text").val() + item + "\n"); 
	});
		
 });

 });
 </script>



