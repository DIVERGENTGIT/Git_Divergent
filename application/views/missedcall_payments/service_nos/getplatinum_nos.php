<?php		
		$prinumtype="";
		$planprice=0;
		$slno = 0;  
		$checked = '';
		$checked_nos=$checkedno;	
			$data=array();			
		if(count($avl_platinumnos)>0)
		{
		foreach($avl_platinumnos as $key => $platinum_nos) 
		{				
			if(@isset($_SESSION['sel_nos']) || $checked_nos != "" )
			{
				if(@$_SESSION['sel_nos'] != "")
				{
					//echo ($_SESSION['sel_nos']);
					$data = explode(",",$_SESSION['sel_nos']);					
					$checked = '';
					for($z=0;$z<count($data);$z++)
					{
						if($data[$z] == $platinum_nos['cdn_sno'])
						{
							$checked = "checked";
						}
						if($platinum_nos['cdn_did_type']!=$prinumtype)
						{
							$prinumtype=$platinum_nos['cdn_did_type'];
							$planprice=$platinum_nos['st_price'];
							if($prinumtype=="PRI")
							$planprice=$planprice+$platinum_nos['pri_rental'];
							if($prinumtype=="MOBILE")
							$planprice=$planprice+$platinum_nos['mobile_rental'];
							if($prinumtype=="TOLLFREE")
							$planprice=$planprice+$platinum_nos['tollfree_rental'];
						}
						
					}
				}
				if($checked_nos != "")
				{
					//echo $checkedno;					
					$data = explode(",",$checked_nos);						
					$checked = '';
					for($z=0;$z<count($data);$z++)
					{
						if($data[$z] == $platinum_nos['cdn_sno'])
						{
							$checked = "checked";
						}
						if($platinum_nos['cdn_did_type']!=$prinumtype)
						{
							$prinumtype=$platinum_nos['cdn_did_type'];
							$planprice=$platinum_nos['st_price'];
							if($prinumtype=="PRI")
							$planprice=$planprice+$platinum_nos['pri_rental'];
							if($prinumtype=="MOBILE")
							$planprice=$planprice+$platinum_nos['mobile_rental'];
							if($prinumtype=="TOLLFREE")
							$planprice=$planprice+$platinum_nos['tollfree_rental'];
						}
						
					}
				}			
				
				if((!in_array($platinum_nos['cdn_sno'], $cart_num)) || (in_array($platinum_nos['cdn_sno'], $data))) { $slno++;
				?>
				<li class="cls<?php echo $platinum_nos['cdn_did_type'];?>" >
				<div class="all_checkbox model_check">
				<input id="checksernumbplatinum<?php echo $platinum_nos['cdn_sno'];?>" type="checkbox" name="ssnos[]" class="checkboxstyle ssnos getplatinumnumber<?php echo $platinum_nos['cdn_sno'];?>" value="<?php echo $platinum_nos['st_price'].','.$platinum_nos['cdn_sno'] .','. $platinum_nos['cdn_did_type'] .','. $planprice.','. $platinum_nos['did_plan'];?>" <?php echo $checked;?>><label class="font_normal" for="checksernumbplatinum<?php echo $platinum_nos['cdn_sno'];?>" ><span><span></span></span><?php echo $platinum_nos['cdn_sno']; ?></label>
				</div>
				</li>
			<?php } }
			else
			{
				if($platinum_nos['cdn_did_type']!=$prinumtype)
				{
					$prinumtype=$platinum_nos['cdn_did_type'];
					$planprice=$platinum_nos['st_price'];
					if($prinumtype=="PRI")
					$planprice=$planprice+$platinum_nos['pri_rental'];
					if($prinumtype=="MOBILE")
					$planprice=$planprice+$platinum_nos['mobile_rental'];
					if($prinumtype=="TOLLFREE")
					$planprice=$planprice+$platinum_nos['tollfree_rental'];
				}
				
				if(!in_array($platinum_nos['cdn_sno'], @$cart_num)) { $slno++;
	?>
	<li class="cls<?php echo $platinum_nos['cdn_did_type'];?>" >
	<div class="all_checkbox model_check">
	<input id="checksernumbplatinum<?php echo $platinum_nos['cdn_sno'];?>" type="checkbox" name="ssnos[]" class="checkboxstyle ssnos 
	getplatinumnumber<?php echo $platinum_nos['cdn_sno'];?>" value="<?php echo $platinum_nos['st_price'].','.$platinum_nos['cdn_sno'] .','. $platinum_nos['cdn_did_type'] .','. $planprice.','. $platinum_nos['did_plan'];?>" > <label class="font_normal" 
	for="checksernumbplatinum<?php echo $platinum_nos['cdn_sno'];?>" ><span><span></span></span><?php echo $platinum_nos['cdn_sno']; ?></label>
	</div>
	</li>
	
	<?php } }
	?>
	
<script type="text/javascript">
    $(document).ready(function(){
        $(".getplatinumnumber<?php echo $platinum_nos['cdn_sno'];?>").click(function(){
      
				var sno = this.value;
				console.log(this);
				console.log("test"+sno);
				var snos = sno.split(",");
				//return snos[1];
				var snosprice= snos[1];
        
            if($(this).prop("checked") == true){
				  //alert("Checkbox is checked.");
				if($('.checkboxstyle:checked').length<=3)
				{
				$('.service_number_msg').html("");
				if(snosprice!='')
				{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,status:'1'},
					url: "<?php echo base_url(); ?>Payment/SelectedNumbers",
					success: function (callback_data) 
					{
					console.log(callback_data);
					//console.log($('#rental_plan'));
					$('.didprice').html(callback_data);
					}
					});	

				} 
				
				}
				else
				{
				$('.service_number_msg').html("You have exceeded the maximum number of Service Number");
				$('.service_number_msg').css('color','red');
				this.checked = false;
				}  
                
                
                
                
            }
            else if($(this).prop("checked") == false){
            
                //alert("Checkbox is unchecked.");
                        if(snosprice!='')
				{
				
				$.ajax({
				type: "GET",
				data: {snosprice:snosprice,status:'0'},
				url: "<?php echo base_url(); ?>Payment/cancel_did_numbers",
				success: function (callback_data) 
				{
				console.log(callback_data);
				//console.log($('#rental_plan'));
				$('.didprice').html(callback_data);
				}
				});	

				} 
                
                
                
                
            }
        });
    });
</script>
	<?php
	} 
	}
	else
	{
		//echo "Your search - ".$goldno." - did not match any service numbers!";
			
		echo "Service Numbers are not available with this criteria!.";
		
		return false;
	}?>
	

