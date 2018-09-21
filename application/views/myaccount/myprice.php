
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/payments-icon.png" class="right-title-img">Default Price </h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    <div class="table-responsive"> 
    
    
<?php 
	$user_id=$this->session->userdata('user_id');
	$sms_price=0;
	$getshorturl=0;
	$getlongcode=0;
	$longcode_price=0;
	$service_tax_percent=0;
	$shorturl_price=0;
	$sql2="select * from global_settings";
	$query2=$this->db->query($sql2);
	if($query2->num_rows()>0)
	{
		$global_settings=$query2->result();
		//print_r($global_settings);
		foreach ($global_settings as $key=>$global_setting)
		{
			if($global_setting->setting_name=='smspricevalue')
			{
				$getsms_price=$global_setting->value;
			}
			if($global_setting->setting_name=='longcode')
			{
				$getlongcode=$global_setting->value;
			}
			if($global_setting->setting_name=='shorturl')
			{
				$getshorturl=$global_setting->value;
			}
			if($global_setting->setting_name=='Service Tax')
			{
				$service_tax_percent=$global_setting->value;
			}
		}
	}
	
	//$pgresponse='Transaction Cancelled';
	$pgresponse='Transaction Successful';
	//**** For SMS Price ***//
	/*
	$sql="select th.sms_price from transaction_history th INNER JOIN 
	price_enquery pe on th.epg_txnID=pe.epg_txnID
	where th.user_id=$user_id and pe.servicetype='sms' and th.payment_status='$pgresponse' order by th.payment_id desc limit 1";
	
	$query1=$this->db->query($sql);
	if($query1->num_rows()>0)
	{
		//print_r($query1->result());exit;
		$user_payments=$query1->result();

		foreach ($user_payments as $key=>$user_payment)
		{

		if($user_payment->sms_price!='')
		{
		$sms_price=$user_payment->sms_price;
		}
		else
		{
		$sms_price=$getsms_price;
		}

		}
	}
	else
	{
	$sms_price=$getsms_price;
	}*/
	
	
$sql="select price from user_payments where user_id=$user_id and price > 0 and service_type ='' order by payment_id desc limit 1";
	
	$query1=$this->db->query($sql);
	if($query1->num_rows()>0)
	{
	    //print_r($query1->result());exit;
	    $user_payments=$query1->result();
	
		foreach ($user_payments as $key=>$user_payment)
		{
		
			if($user_payment->price!='')
			{
			 //$sms_price=$user_payment->sms_price;
			  $sms_price=$user_payment->price;
			}
			else
			{
			 $sms_price=$getsms_price;
			}
			
		}
	
	}
	else
	{
	 $sms_price=$getsms_price;
	}
	
	
	//**** For Longcode Price ***//
	 $sql="select th.sms_price as longcode_price from transaction_history th INNER JOIN 
	price_enquery pe on th.epg_txnID=pe.epg_txnID
	where th.user_id=$user_id and pe.servicetype='longcode' and pe.description='Add Longcode Credits' and th.payment_status='$pgresponse' order by th.payment_id desc limit 1";
	$query1=$this->db->query($sql);
	if($query1->num_rows()>0)
	{
	//print_r($query1->result()); 
		$user_payments=$query1->result();

		foreach ($user_payments as $key=>$user_payment)
		{
			if($user_payment->longcode_price!='')
			{
			$longcode_price=$user_payment->longcode_price;
			}
			else
			{
			$longcode_price=$getlongcode;
			}

		}
	}
	else
	{
	$longcode_price=$getlongcode;
	}
	
	//**** For Short URl Price ***//
	$sql="select th.sms_price as shorturl_price from transaction_history th INNER JOIN 
	price_enquery pe on th.epg_txnID=pe.epg_txnID
	where th.user_id=$user_id and pe.servicetype='shorturl' and th.payment_status='$pgresponse' order by th.payment_id desc limit 1";
	$query1=$this->db->query($sql);
	if($query1->num_rows()>0)
	{
		//print_r($query1->result());exit;
		$user_payments=$query1->result();

		foreach ($user_payments as $key=>$user_payment)
		{
			if($user_payment->shorturl_price!='')
			{
			$shorturl_price=$user_payment->shorturl_price;
			}
			else
			{
			$shorturl_price=$getshorturl;
			}

		}
	}
	else
	{
	$shorturl_price=$getshorturl;
	}
	
	
?>
         
  <table class="table_all table">
  <thead>
                <tr>
                <th>S.no</th>
                 <th>Name</th>
                 <th>Value ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </th>
                </tr>
				</thead>
				<tbody>
				<tr>
				<td>1</td>
				<td>SMS Price</td>
				<td>
				<?php echo $sms_price; ?>
				</td>
				</tr>
				<tr>
				<td>2</td>
				<td>Longcode Price</td>
				<td>
				<?php echo $longcode_price; ?>
				</td>
				</tr>
				<tr>
				<td>3</td>
				<td>Short URl Price</td>
				<td>
				<?php echo $shorturl_price; ?>
				</td>
				</tr>
				</tbody>
        </table>
        
        
        
       </div>
       
     </div>   
</div>
</div>




