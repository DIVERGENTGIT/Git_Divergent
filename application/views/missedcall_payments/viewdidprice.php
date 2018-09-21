
<table class="table_all border-price-table">
<thead>
<tr>
	<th>S No</th>
	<th>Service Number</th>	
	<th>Service Type</th>
	<th>Service Plan</th>		
	<th>Service Price <br>( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$didprice=0;
$sno=1;
$number_type='';
if(count($result)>0)
{
foreach($result as $key=>$value)
{
?>
<tr>
<td><?php echo $sno;?></td>
<td><?php echo $value['did_number'];?></td>
<td><?php echo $value['did_type'];?></td>
<td><?php 



if($value['did_plan']=='GOLD')
{
$number_type="gold";
}

if($value['did_plan']=='SILVER')
{
$number_type="silver";
}
if($value['did_plan']=='PLATINUM')
{
$number_type="platinum";
}

echo $value['did_plan'];

//echo $number_type;

?></td>
<td>
<?php
if($value['did_type']=='PRI')
{
echo @$value['pri_rental'];
$didprice+=@$value['pri_rental']?$value['pri_rental']:0;
}
if($value['did_type']=='MOBILE')
{
echo @$value['mobile_rental'];
 $didprice+=@$value['mobile_rental']?$value['mobile_rental']:0;
}
if($value['did_type']=='TOLLFREE')
{
echo @$value['tollfree_rental'];
$didprice+=@$value['tollfree_rental']?$value['tollfree_rental']:0;
}
?></td>

<td><span title="Delete" class="glyphicon glyphicon-trash deleteservicenumber<?php echo $value['did_number'];?>"></span></td>
	
<script type="text/javascript">
    $(document).ready(function(){
        $(".deleteservicenumber<?php echo $value['did_number'];?>").click(function(){
      $.ajax({
				type: "GET",
				data: {snosprice:"<?php echo $value['did_number'];?>",status:'0'},
				url: "<?php echo base_url(); ?>Payment/cancel_did_numbers",
				success: function (callback_data) 
				{
				console.log(callback_data);
				//console.log($('#rental_plan'));
				$('.didprice').html(callback_data);
				
				$(".get<?php echo $number_type;?>number<?php echo $value['did_number'];?>").attr('checked', false);
				
				}
				});	
        });
    });
</script>

</tr>
<?php
 //$didprice+=$value['did_price'];
 $sno++;
}
?>
<tr>
<td colspan="4"><b>Grand Total</b></td><td><b><span class="total=didprice"><?php echo $didprice;?></span></b></td>
<td></td>
</tr>

<?php
}
else
{
?>
<tr><td colspan="5">Please select Service Numbers from available Service Numbers list</td>
<td></td>
</tr>
<?php } ?>
</tbody>
</table>


<?php
if(count($result)>0)
{
?>
<script>
$(document).ready(function(){
$("#snos_cost").html('<?php echo $didprice;?>');
$(".neworderbtn").show();
});
</script>
<?php
}
else
{
?>
<script>
$(document).ready(function(){
$("#snos_cost").html('<?php echo $didprice;?>');
$(".neworderbtn").hide();
$(".userlogin_from").hide();
$(".userregistration_from").hide();
});
</script>
<?php
}
?>
<!--
<input type="hidden" value="Missedcall" id="plan_service" class="plan_service" />
<input type="hidden" class="append_service_num" value="<?php echo @$_SESSION['sel_nos'];?>" />
<input type="hidden" class="exist_append_service_num"  />
-->




