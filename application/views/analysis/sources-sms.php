
<script src="<?php echo base_url(); ?>assets/js/lib/jquery.min.js"></script> 
 <script>
   $(function(){
    $('.tab-section').hide();
    $('#tabs a').bind('click', function(e){
        $('#tabs a.current').removeClass('current');
        $('.tab-section:visible').hide();
        $(this.hash).show();
        $(this).addClass('current');
        e.preventDefault();
    }).filter(':first').click();
});
</script>

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
      <li class="packcurrent04"><a href="<?php echo base_url(); ?>analysis/smsSource">Sms Source</a></li>
	  <li><a href="<?php echo base_url(); ?>analysis/localProviders">Location Provider</a></li>
       
    </ul>
	</div>
<div class="col-md-12 col-sm-12 padding_zero col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 padding_zero col-sm-12">
<ul class="chartcredit_three max-widthsms" style="max-width:420px;">
        <li class="creditcurrent"><a href="#quick_chartdiv">Quick Send</a></li>
        <li><a href="#uni_chartdiv">Uni Code</a></li>
        <li><a href="#cust_chartdiv">Customized</a></li>
         <li><a href="#file_chartdiv">File</a></li>
    </ul>
        </div>
<div class="crdt3tab">	
        <div id="quick_chartdiv" class="crdttab-content">
         
  <div class="col-md-12 col-sm-12 padding_zero col-sm-12">
<h2 class="week_colr">Week</h2>
         <div id="chartdiv" style="width: 100%; height: 400px;"></div>
         <h2 class="month_colr">Month</h2>
         <div id="chartdiv2" style="width: 100%; height: 400px;"></div>
           <h2 class="year_colr">Year</h2>
         <div id="chartdiv3" style="width: 100%; height: 400px;"></div>
        </div>    
</div>
  <div id="uni_chartdiv" class="crdttab-content">
  <div class="col-md-12 col-sm-12 padding_zero col-sm-12">
  
<h2 class="week_colr">Week</h2>
         <div id="chartdivuni" style="width: 100%; height: 400px;"></div>
         <h2 class="month_colr">Month</h2>
         <div id="chartdivuni2" style="width: 100%; height: 400px;"></div>
           <h2 class="year_colr">Year</h2>
         <div id="chartdivuni3" style="width: 100%; height: 400px;"></div>
        </div>    
</div>
  <div id="cust_chartdiv" class="crdttab-content">
  <div class="col-md-12 col-sm-12 padding_zero col-sm-12">

<h2 class="week_colr">Week</h2>
         <div id="chartdivcust" style="width: 100%; height: 400px;"></div>
         <h2 class="month_colr">Month</h2>
         <div id="chartdivcust2" style="width: 100%; height: 400px;"></div>
           <h2 class="year_colr">Year</h2>
         <div id="chartdivcust3" style="width: 100%; height: 400px;"></div>
        </div>    
</div>
  <div id="file_chartdiv" class="crdttab-content">
  <div class="col-md-12 col-sm-12 padding_zero col-sm-12">

<h2 class="week_colr">Week</h2>
         <div id="chartdivfile" style="width: 100%; height: 400px;"></div>
         <h2 class="month_colr">Month</h2>
         <div id="chartdivfile2" style="width: 100%; height: 400px;"></div>
           <h2 class="year_colr">Year</h2>
         <div id="chartdivfile3" style="width: 100%; height: 400px;"></div>
        </div>    
</div>
</div>
</div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
 <!--This page js Start -->
<script src="<?php echo base_url(); ?>assets/js/lib/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/serial.js" type="text/javascript"></script>

<!--This page js End -->  
  <script>
$(document).ready(function() {
    $(".chartcredit_three a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("creditcurrent");
        $(this).parent().siblings().removeClass("creditcurrent");
        var tab = $(this).attr("href");
        $(".crdttab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
  </body>
