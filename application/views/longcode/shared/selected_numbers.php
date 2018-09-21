 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="table-responsive">
<table class="table_all border-price-table">
<thead>
<tr>
	<th>S No</th>
	<th>Service Number</th>	
	<th>No.of.Keywords </th>
	<th>Subcription Duration</th>
	<!--
	<th>Number Type</th>
	<th>Number Cost ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
	-->
	<th>package cost <br>( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
	<th>Keywords cost <br> ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
	<th>Amount <br>( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
	<th>Total Tax <br>(<?php echo @$tax_per;?> % )( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
	<th>Total Amount <br>( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
</tr>
</thead>
<tbody>
<?php
$amount=0;
$sno=1;
$grand_total=0;
if(count($result)>0)
{
foreach($result as $key=>$value)
{
?>
<tr>
<td><?php echo $sno;?></td>
<td><?php echo $value['longcode_number'];?></td>
<td><?php echo $value['no_of_keywords'];?></td>
<td><?php echo $value['subscription_duration'];?></td>
<!--
<td><?php echo $value['longcode_type'];?></td>
<td><?php echo $value['number_cost'];?></td>
-->
<td><?php echo $value['package_cost'];?></td>

<td><?php echo $value['keywords_cost'];?></td>

<td><?php echo $value['amount'];?></td>
<td><?php echo $value['total_tax'];?></td>
<td><?php echo $value['total_amount'];?></td>


</tr>
<?php
 //$didprice+=$value['did_price'];
 $sno++;
 $grand_total =$grand_total+$value['total_amount'];
}
?>
<tr><td colspan="8"><b>Grand Total</b></td><td><b>
<span class="gettotal-price"><?php echo $grand_total;?></span>

</b></td></tr>

<?php
}
else
{
?>
<tr>
<td colspan="9">Please select Service Numbers from available Service Numbers list</td>

</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<?php
if(count($result)>0)
{
?>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<form action="<?php echo base_url()?>longcode_shared/confirm_order" method="post" target="_blank">
<input type="hidden" name="service_numbers" class="append_service_num" value="<?php echo $_SESSION['sel_nos'];?>">
<input type="hidden" name="flag"   value="longcode">
<input type="hidden" name="service_type"   value="shared">
<input type="submit" name="" class="submit_btn" value="Confirm Order">
</form>
</div>

<?php
}
?>

<script>
$(document).ready(function(){
$(".total-price").html('<?php echo $grand_total;?>');
});
</script>




