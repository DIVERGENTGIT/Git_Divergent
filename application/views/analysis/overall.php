  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="content_bg01">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Analytics</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 mrg_40 padding_zero">
<ul class="package_three04">
        <li class="packcurrent04"><a href="<?php echo base_url(); ?>analysis/index">Over View</a></li>
        <li><a href="<?php echo base_url(); ?>analysis/creditUsage">Credit Usage</a></li>
      <li><a href="<?php echo base_url(); ?>analysis/smsSource">Sms Source</a></li>
	  <li><a href="<?php echo base_url(); ?>analysis/localProviders">Location Provider</a></li>
       
    </ul>
	</div>
<div class="col-md-12 col-sm-12 col-xs-12 report_top_div padding_zero">
<div class="col-md-6 col-sm-6 report_toplt_div col-xs-12">
<div id="donutchart" style="width: 100%; height: 250px;"></div>
</div>
<div class="col-md-6 col-sm-6 report_toprt_div col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<h3 class="total_ldshd">Total Leads</h3>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-4 col-sm-4 col-xs-12">
<div id="leads-circle"></div>
<h4 class="cir_charttitl">Ans</h4>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
<div id="leads-circle2"></div>
<h4 class="cir_charttitl">Un Ans</h4>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
<div id="leads-circle3"></div>
<h4 class="cir_charttitl">Total</h4>
</div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<table class="table_all">
<thead>
<tr>
<th>S.No</th>
<th>Campaign</th>
<th>Campaign Type</th>
<th>Services Numbers</th>
<th>Total Calls</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>Name</td>
<td>Missedcall</td>
<td>68769789078089</td>
<td>22</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>


 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lib/vroom.css">
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/pie-chart.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.circliful.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Delivery',     11],
          ['DND',      2],
          ['Invalid Number',  2],
          ['Failed', 2]
        ]);

        var options = {
          pieHole: 0.4,
		  legend: 'none',
		  pieSliceText: 'none',
		  chartArea:{
    //right:75,
    top: 0,
    width: '100%',
    height: '100%'
},
		  colors: ['#99e3e2', '#c8c9cb', '#d3d4d6', '#dedfe1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
<script>
    $( document ).ready(function() { // 6,32 5,38 2,34
        $("#leads-circle").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
			foregroundColor: '#99e3e2',
            percent: 38,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            multiPercentage: 1,
            percentages: [10, 20, 30]
        });

    });

</script>
<script>
    $( document ).ready(function() { // 6,32 5,38 2,34
        $("#leads-circle2").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
			foregroundColor: '#99e3e2',
            percent: 38,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            multiPercentage: 1,
            percentages: [10, 20, 30]
        });

    });

</script>
<script>
    $( document ).ready(function() { // 6,32 5,38 2,34
        $("#leads-circle3").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
			foregroundColor: '#99e3e2',
            percent: 38,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            multiPercentage: 1,
            percentages: [10, 20, 30]
        });

    });

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-barIndicator.js"></script>
<script src="<?php echo base_url(); ?>js/scripts.js"></script>
  </body>
