
  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Credit Usage</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 mrg_40 padding_zero">
<ul class="package_three04">
        <li><a href="<?php echo base_url(); ?>analysis/index">Over View</a></li>
        <li><a href="<?php echo base_url(); ?>analysis/creditUsage">Credit Usage</a></li>
      <li><a href="<?php echo base_url(); ?>analysis/smsSource">Sms Source</a></li>
	  <li class="packcurrent04"><a href="<?php echo base_url(); ?>analysis/localProviders">Location Provider</a></li>
       
    </ul>
	</div>
<div class="content_bg01">
<div class="col-sm-12 location_wise">
<h3 class="sb_heading">Location Wise</h3>
<div class="col-sm-2">
<ul class="chart_title">


<?php 
  $size= sizeof($locationwise_report);
for($i=0;$i<$size;$i++)
{
?>
 <li><span class="wise_title"> 
<?php
if(!empty($locationwise_report[$i]['Service_Areas_Code']))
{
echo ucfirst($locationwise_report[$i]['Service_Areas_Code']);
}else
{
echo "N/A";
}
?>
</span></li>
<?php

}

?>


</div>

<div class="col-sm-10">
         <ul class="chart">


<?php 
$locationtotalcnt=0;
 $size3= sizeof($locationwise_report);
for($i=0;$i<$size3;$i++)
{
	 $locationtotalcnt+= $locationwise_report[$i]['cnt'];
	?>


<li><span class="bar" data-number="<?php if(!empty($locationwise_report[$i]['cnt']))
{
echo $locationwise_report[$i]['cnt'];}else
{
echo "0";
}
?>"></span>
<span class="number"><?php if(!empty($locationwise_report[$i]['cnt']))
{
echo  $locationwise_report[$i]['cnt'];}else{
echo "0";
}
?></span></li>

<?php }

?>


            </ul>
    </div>      
        </div>
     <div class="col-sm-12 provider_wise">
     <h3 class="sb_heading">Provider Wise</h3>
     <div class="col-sm-3">
<ul class="chart_title">
 
 
 <?php 
$size5= sizeof($operator_report);
for($i=0;$i<$size5;$i++)
{
?>
 <li><span class="wise_title"> 
<?php
if(!empty($operator_report[$i]['Network_Operator_Name']))
{
echo ucfirst($operator_report[$i]['Network_Operator_Name']);
}else
{
echo "N/A";
}
?>
</span></li>
<?php

}

?>

 

</div>



 <div class="col-sm-9">
         <ul class="chart02">
         
         
         <?php 
$totalcnt=0;
 $size1= sizeof($operator_report);
for($i=0;$i<$size1;$i++)
{
		$totalcnt+= $operator_report[$i]['cnt'];

?>
        
<li><span class="bar" data-number="<?php if(!empty($operator_report[$i]['cnt']))
{


echo  $operator_report[$i]['cnt'];
}else{
echo "0";
}
?>"></span>

<span class="number">
<?php if(!empty($operator_report[$i]['cnt']))
{
echo  $operator_report[$i]['cnt'];
}else{
	
echo "0";
}

?></span>

</li>

<?php

}

?>
   

            </ul>
         </div> 
        </div>   
</div>
</div>
           
      

    

  
      <div class='control-sidebar-bg'></div>



<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
<!--This page js Start -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery.horizBarChart.min.js"></script>

<script>

		$('.chart').horizBarChart({
            selector: '.bar',
            speed: 3000
          });
        
$('.chart02').horizBarChart({
            selector: '.bar',
            speed: 3000
          });

	</script>
<!--This page js End -->  
 
  </body>
