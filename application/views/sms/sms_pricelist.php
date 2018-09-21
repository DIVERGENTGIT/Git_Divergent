
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Price List</h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    <div class="table-responsive">
  <?php
       // print_r($products);
	$user_id=$this->session->userdata('user_id');
	$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
	$user=$this->db->query($sql)->result();
	$usertype='';
	foreach($user as $key => $value)
	{
	//print_r($value);
		if($value->no_ndnc=="0")
		{
		$usertype="Promotional";
		$usertypecol="promotional";
		}
		if($value->no_ndnc=="1")
		{
		$usertype="Transactional";
		$usertypecol="transactional";
		}
		if($value->no_ndnc=="1" && $value->dnd_check=='1')
		{
		$usertype="Semi Trans";
		$usertypecol="semitrans";
		}
	}
	//echo $usertype;
	?>  
  <table class="table_all">
<thead>
<tr><th rowspan="2">SMS Pack Range</th><th colspan="2">Price Per SMS <span class="indian-rupee"><img src="http://strikersoftsolutions.com/images/firstring-email/rupee-indian-white.png"  alt=""></span> </th><th rowspan="2">&nbsp;</th></tr>
<tr>

<th><?php echo $usertype;?></th>

<th>OTP</th></tr>
</thead>
<tbody>
<?php
foreach($getsmspricelist as $key=>$value)
{
?>
<?php
if($value->pkg_range!='10 Lakh above')
{
?>
<tr>
<td><?php echo $value->pkg_range;?></td>

<td><?php echo $value->$usertypecol;?>
</td>
<td><?php echo $value->otp;?> 
</td>
<td>


<span class="play-btn"><a class="submit_btn" href="<?php echo base_url()?>sms/paynow/<?php echo $value->id;?>">Pay Now</a></span>

</td>
</tr>
<?php
 }
else
{
?>
<tr><td style="border-left: 1px solid #7fdbda;-moz-border-bottom-left-radius: 10px;-webkit-border-bottom-left-radius: 10px;border-bottom-left-radius: 10px;"><?php echo $value->pkg_range;?></td><td colspan="2">Contact Support Team for price</td><td style="-moz-border-bottom-right-radius: 10px;-webkit-border-bottom-right-radius: 10px;border-bottom-right-radius: 10px;"></td></tr>
<?php
 }
}
?>
</tbody>
</table>
       </div>
       
     </div>   
</div>
</div>



