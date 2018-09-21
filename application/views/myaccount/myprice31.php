
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/payments-icon.png" class="right-title-img">Default Price </h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    <div class="table-responsive">          
  <table class="table_all table">
  <thead>
                <tr>
                <th>S.no</th>
                 <th>Name</th>
                 <th>Value ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </th>
                </tr>
				</thead>
				<tbody>
        <?php
       // print_r($products);
	$user_id=$this->session->userdata('user_id');
	$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
	$user=$this->db->query($sql)->result();
	$usertype='';
	foreach($user as $key => $value)
	{
	
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
	
	$user_id=$this->session->userdata('user_id');
	$sql1="select * FROM global_settings where setting_name in('smspricevalue','longcode','shorturl')";
	$products=$this->db->query($sql1)->result();
	
	//print_r($products);
	
	 if(count($products)>0)
	   { 
	   $sno=1;
	   if($this->uri->segment(3)!='')
		{
		 	$sno=$this->uri->segment(3)+1;
		}
        foreach($products as $key=>$product)
        {
         ?>
                        <tr>
                        <td><?php echo $sno;?></td>
                        <td>
                        <?php 
                        if($product->setting_name=='smspricevalue')
                        {
                         echo "SMS Price";
                         $servicetype="smspricevalue";
                        }
				else if($product->setting_name=='longcode')
                        {
                         echo "Long Code";
                         $servicetype="longcode";
                        }
			      else if($product->setting_name=='shorturl')
                        {
                         echo "Short URL";
                          $servicetype="shorturl";
                        }
                        ?>
                        </td>
                         <td>
                         
                         
<?php 
	$user_id=$this->session->userdata('user_id');
	$sms_price='';
	$service_tax_percent='';
	
	//$pgresponse=='Transaction Cancelled';
	$pgresponse=='Transaction Successful';
	$sql="select up.price,up.service_tax_percent,pe.servicetype,up.transaction_id from user_payments up INNER JOIN 
	price_enquery pe on up.transaction_id=pe.epg_txnID
	where up.user_id=$user_id and pe.servicetype='$servicetype' and pe.pgresponse='$pgresponse' order by up.payment_id desc limit 1";
	
	$query1=$this->db->query($sql);
	if($query1->num_rows()>0)
	{
	//print_r($query1->result());
	    $user_payments=$query1->result();
	
		foreach ($user_payments as $key=>$user_payment)
		{
			$sms_price=$user_payment->price;
			$service_tax_percent=$user_payment->service_tax_percent;
			
			if($sms_price==0 || $sms_price=='' || $sms_price=='NULL')
			{
				$sql2="select * from global_settings";
				$query2=$this->db->query($sql2);
				if($query2->num_rows()>0)
				{
				$global_settings=$query2->result();
				//print_r($global_settings);
				foreach ($global_settings as $key=>$global_setting)
				{
				if($global_setting->setting_name==$servicetype)
				{
				$sms_price=$global_setting->value;
				}
				if($global_setting->setting_name=='Service Tax')
				{
				$service_tax_percent=$global_setting->value;
				}
				}
				}
			}
			
			
		}
	
	}
	else
	{
	
		$sql2="select * from global_settings";
		$query2=$this->db->query($sql2);
		if($query2->num_rows()>0)
		{
			$global_settings=$query2->result();
			//print_r($global_settings);
			foreach ($global_settings as $key=>$global_setting)
			{
				if($global_setting->setting_name==$servicetype)
				{
				$sms_price=$global_setting->value;
				}
			   if($global_setting->setting_name=='Service Tax')
				{
				$service_tax_percent=$global_setting->value;
				}
			}
		}
	}
	
	echo $sms_price;
?>
                         
                         <?php //echo $product->value;?>
                         
                         </td>
                        </tr>
                    
         <?php 
          $sno++;
        }
        
	   }
	   else 
	   {
       ?>
      <tr><td colspan="7">No Records Available.</td></tr>
        <?php 
        }
        ?>
		</tbody>
        </table>
        
        
        
       </div>
       
     </div>   
</div>
</div>




