<?php		

		$prinumtype="";
		$planprice=0;
		$slno = 0;  
		$checked = '';
		$mobilecount=0;
		$checked_nos=$checkedno;
		$data=array();	
		if(count($avl_silvernos)>0)
		{
		
		foreach($avl_silvernos as $key => $silver_nos) 
		{				
			if(@$_SESSION['sel_nos']!='' || $checked_nos != "" )
			{
				if(@$_SESSION['sel_nos'] != "")
				{
					//echo ($_SESSION['sel_nos']);
					$data = explode(",",$_SESSION['sel_nos']);
					
					//print_r($data);
					//echo $silver_nos['cdn_did_type'];					
					$checked = '';
					for($z=0;$z<count($data);$z++)
					{
						if($data[$z] == $silver_nos['cdn_sno'])
						{
							$checked = "checked";
						}
						if($silver_nos['cdn_did_type']!=$prinumtype)
						{
							$prinumtype=$silver_nos['cdn_did_type'];
							$planprice=$silver_nos['st_price'];
							if($prinumtype=="PRI")
							$planprice=$planprice+$silver_nos['pri_rental'];
							if($prinumtype=="MOBILE")
							$planprice=$planprice+$silver_nos['mobile_rental'];
							if($prinumtype=="TOLLFREE")
							$planprice=$planprice+$silver_nos['tollfree_rental'];
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
						if($data[$z] == $silver_nos['cdn_sno'])
						{
							$checked = "checked";
						}
						
						if($silver_nos['cdn_did_type']!=$prinumtype)
						{
							$prinumtype=$silver_nos['cdn_did_type'];
							$planprice=$silver_nos['st_price'];
							if($prinumtype=="PRI")
							$planprice=$planprice+$silver_nos['pri_rental'];
							if($prinumtype=="MOBILE")
							$planprice=$planprice+$silver_nos['mobile_rental'];
							if($prinumtype=="TOLLFREE")
							$planprice=$planprice+$silver_nos['tollfree_rental'];
						}
						
					}
				}			
				
				if((!in_array($silver_nos['cdn_sno'], $cart_num)) || (in_array($silver_nos['cdn_sno'], $data))) { $slno++;
				
				if($silver_nos['cdn_did_type']=='MOBILE')
				{
				$mobilecount=$mobilecount+1;
				?>
				
				<li class="cls<?php echo $silver_nos['cdn_did_type'];?>" >
				<div class="all_checkbox model_check">
				<input id="checksernumbsilver<?php echo $silver_nos['cdn_sno'];?>" type="checkbox" name="ssnos[]" class="checkboxstyle ssnos getsilvernumber<?php echo $silver_nos['cdn_sno'];?>" value="<?php echo $silver_nos['st_price'].','.$silver_nos['cdn_sno'] .','. $silver_nos['cdn_did_type'] .','. $planprice.','. $silver_nos['did_plan'];?>" <?php echo $checked;?>><label class="font_normal" for="checksernumbsilver<?php echo $silver_nos['cdn_sno'];?>" ><span><span></span></span><?php echo $silver_nos['cdn_sno']; ?></label>
				</div>
				</li>
				
			<?php }
			      else
			      {
			       //echo "Service Numbers are not available with this criteria!.";
			      }
			
			} }
			
			else
			{
			//echo "test";
				if($silver_nos['cdn_did_type']!=$prinumtype)
				{
					$prinumtype=$silver_nos['cdn_did_type'];
					$planprice=$silver_nos['st_price'];
					if($prinumtype=="PRI")
					$planprice=$planprice+$silver_nos['pri_rental'];
					if($prinumtype=="MOBILE")
					$planprice=$planprice+$silver_nos['mobile_rental'];
					if($prinumtype=="TOLLFREE")
					$planprice=$planprice+$silver_nos['tollfree_rental'];
				}
				
				if(!in_array($silver_nos['cdn_sno'], @$cart_num)) { $slno++;
				
	if($silver_nos['cdn_did_type']=='MOBILE')
	{
	$mobilecount=$mobilecount+1;
	?>
	<li class="cls<?php echo $silver_nos['cdn_did_type'];?>" >
	<div class="all_checkbox model_check">
	<input id="checksernumbsilver<?php echo $silver_nos['cdn_sno'];?>" type="checkbox" name="ssnos[]" class="checkboxstyle ssnos 
	getsilvernumber<?php echo $silver_nos['cdn_sno'];?>" value="<?php echo $silver_nos['st_price'].','.$silver_nos['cdn_sno'] .','. $silver_nos['cdn_did_type'] .','. $planprice.','. $silver_nos['did_plan'];?>" > <label class="font_normal" 
	for="checksernumbsilver<?php echo $silver_nos['cdn_sno'];?>" ><span><span></span></span><?php echo $silver_nos['cdn_sno']; ?></label>
	</div>
	</li>
	
	<?php }
	      else
	      {
	//echo "Service Numbers are not available with this criteria!.";
	      }
	
	 } }
	?>
	
<script type="text/javascript">
    $(document).ready(function(){
        $(".getsilvernumber<?php echo $silver_nos['cdn_sno'];?>").click(function(){
      
				var sno = this.value;
				console.log(this);
				console.log("test"+sno);
				var snos = sno.split(",");
				//return snos[1];
				var snosprice= snos[1];
        
            if($(this).prop("checked") == true){
				  //alert("Checkbox is checked.");
				if($('.checkboxstyle:checked').length<=1)
				{
				$('.service_number_msg').html("");
				if(snosprice!='')
				{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,status:'1'},
					url: "<?php echo base_url(); ?>Free_service/SelectedNumbers",
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
            
            $('.service_number_msg').html("");
                //alert("Checkbox is unchecked.");
                        if(snosprice!='')
				{
				
				$.ajax({
				type: "GET",
				data: {snosprice:snosprice,status:'0'},
				url: "<?php echo base_url(); ?>Free_service/cancel_did_numbers",
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
	
	<?php
	if($mobilecount==0)
	{
	 echo "Service Numbers are not available with this criteria!.";
	}
	?>
	

