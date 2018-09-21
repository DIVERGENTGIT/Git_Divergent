
<table class="table_all border-price-table">
<thead>
<tr>
	<th>S No</th>
	<th>Service Number</th>	
	<th>Service Type</th>
	<th>Service Plan</th>		
	<th>Service Price <br>( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
</tr>
</thead>
<tbody>
<?php
$didprice=0;
$sno=1;
if(count($result)>0)
{
foreach($result as $key=>$value)
{
?>
<tr>
<td><?php echo $sno;?></td>
<td><?php echo $value['did_number'];?></td>
<td><?php echo $value['did_type'];?></td>
<td><?php echo $value['did_plan'];?></td>
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

</tr>
<?php
 //$didprice+=$value['did_price'];
 $sno++;
}
?>
<tr><td colspan="4"><b>Grand Total</b></td><td><b><span class="total=didprice"><?php echo $didprice;?></span></b></td></tr>

<?php
}
else
{
?>
<tr><td colspan="5">Please select Service Numbers from available Service Numbers list</td></tr>
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




