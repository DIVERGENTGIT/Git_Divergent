  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

      <div class="content-wrapper">
<div class="col-sm-12 col-md-12 col-xs-12">
<h2 class="content_h2">Over All</h2>
<div class="content_bg01">

        
      
				
        <div class="col-sm-12">
        <h3 class="over_all_h3">Rechages</h3>
<div class="col-sm-6">
      
        <table class="table_all">
     
        <tbody>
         <tr>
        <th>S.No.</th>
         <th>Date</th>
          <th>Sms</th>
          <th>View</th>
        </tr>
         <tr>
        <td>1</td>
         <td><?php if(!empty($rechargedetails[0]['daywise'])){ echo $rechargedetails[0]['daywise']; }else{ echo "0";}?></td>
          <td><?php if(!empty($rechargedetails[0]['totalmsg'])){ echo $rechargedetails[0]['totalmsg']; }else{ echo "0";}?></td>
          <td><a href="<?php echo base_url(); ?>analysis/index/<?php if(!empty($rechargedetails[0]['daywise'])){ echo $rechargedetails[0]['daywise']; }else{ echo "0";}?>">View</a></td>
        </tr>
         <tr>
        <td>2</td>
         <td><?php if(!empty($rechargedetails[1]['daywise'])){ echo $rechargedetails[1]['daywise']; }else{ echo "0";}?></td>
          <td><?php if(!empty($rechargedetails[1]['totalmsg'])){ echo $rechargedetails[1]['totalmsg']; }else{ echo "0";}?></td>
          <td><a href="<?php echo base_url(); ?>analysis/index/<?php if(!empty($rechargedetails[1]['daywise'])){ echo $rechargedetails[1]['daywise']; }else{ echo "0";}?>" >View</a></td>
        </tr>
         <tr>
        <td>3</td>
         <td><?php if(!empty($rechargedetails[2]['daywise'])){ echo $rechargedetails[2]['daywise']; }else{ echo "0";}?></td>
          <td><?php if(!empty($rechargedetails[2]['totalmsg'])){ echo $rechargedetails[2]['totalmsg']; }else{ echo "0";}?></td>
          <td><a href="<?php echo base_url(); ?>analysis/index/<?php if(!empty($rechargedetails[2]['daywise'])){ echo $rechargedetails[2]['daywise']; }else{ echo "0";}?>">View</a></td>
        </tr>
        
        <td>4</td>
         <td><?php if(!empty($rechargedetails[3]['daywise'])){ echo $rechargedetails[3]['daywise']; }else{ echo "0";}?></td>
          <td><?php if(!empty($rechargedetails[3]['totalmsg'])){ echo $rechargedetails[3]['totalmsg']; }else{ echo "0";}?></td>
          <td><a href="<?php echo base_url(); ?>analysis/index/<?php if(!empty($rechargedetails[3]['daywise'])){ echo $rechargedetails[3]['daywise']; }else{ echo "0";}?>">View</a></td>
        </tr>
        
        <td>5</td>
         <td><?php if(!empty($rechargedetails[4]['daywise'])){ echo $rechargedetails[4]['daywise']; }else{ echo "0";}?></td>
          <td><?php if(!empty($rechargedetails[4]['totalmsg'])){ echo $rechargedetails[4]['totalmsg']; }else{ echo "0";}?></td>
          <td><a href="<?php echo base_url(); ?>analysis/index/<?php if(!empty($rechargedetails[4]['daywise'])){ echo $rechargedetails[4]['daywise']; }else{ echo "0";}?>">View</a></td>
        </tr>
        </tbody>
        </table>
        </div>
        <div class="col-sm-6">
       
			
			<section id="charts1" class="charts">
<div class="wrapper-flex">

    <table id="pieChart" class="pieChart data-table col-table">
       
        <tr>
            <th scope="col" data-type="string">Country</th>
            <th scope="col" data-type="number">Number of Students</th>
        </tr>
        <tr>
            <td>Delivery</td>
            <td align="right">
			<?php if(!empty($dlrdRchrg))
			{
				echo $dlrdRchrg;
			}else
			{
				 echo "0";
			}?></td>
        </tr>

        <tr>
            <td>DND</td>
            <td align="right">	<?php if(!empty($dndsRchrg))
			{
				echo $dndsRchrg;
			}else{
				 echo "0";
			}?></td>
        </tr>

        <tr>
            <td>Invalid Number</td>
            <td align="right">	
			<?php if(!empty($invaldRchrg))
			{
				echo $invaldRchrg;
			}else{
				 echo "0";
			}?></td>
        </tr>
         <tr>
            <td>Out Of Coverage</td>
            <td align="right">	
			<?php if(!empty($exprdRchrg))
			{
				echo $exprdRchrg;
			}else{
				 echo "0";
			}?></td>
        </tr>
    </table>



</div><!-- .wrapper-flex -->
</section>
		
		
        </div>
        </div>
</div>
</div>
           
      

    

  
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->


<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
<!--This page js Start -->
<script src="<?php echo base_url(); ?>assets/js/lib/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/Chart.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/lib/chartinator.js" ></script>
  
  <script>

		var pieData = [
				{
					value: <?php echo $dlrd;?>,
					color:"#3691ff",
					highlight: "#3691ff",
					label: "Delivered"
				},
				{
					value: <?php echo $dnds;?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "DND"
				},
				{
					value: <?php echo $invald;?>,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Invalid"
				},
				{
					value: <?php echo $exprd;?>,
					color: "#F7464A",
					highlight: "#FF5A5E",
					label: "Expired"
				}

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx).Pie(pieData);
			};



	</script>
    
    
    
<script>
  var chart;

            var chartData = [
                {
                    "country": "SunDay",
                    "visits": <?php if(!empty($weekcampaigns_report[0]['totalmsg'])):echo $weekcampaigns_report[0]['totalmsg']; else:   echo "0"; endif;?>
                },
                {
                    "country": "MonDay",
                    "visits": <?php if(!empty($weekcampaigns_report[1]['totalmsg'])):echo $weekcampaigns_report[1]['totalmsg']; else:   echo "0"; endif;?>
                },
               
                {
                    "country": "TuseDay",
                    "visits":  <?php if(!empty($weekcampaigns_report[2]['totalmsg'])):echo $weekcampaigns_report[2]['totalmsg']; else:   echo "0"; endif;?>
                },
				 {
                    "country": "WednessDay",
                    "visits":  <?php if(!empty($weekcampaigns_report[3]['totalmsg'])):echo $weekcampaigns_report[3]['totalmsg']; else:   echo "0"; endif;?>
                }
				,
				 {
                    "country": "ThursDay",
                    "visits":  <?php if(!empty($weekcampaigns_report[4]['totalmsg'])):echo $weekcampaigns_report[4]['totalmsg']; else:   echo "0"; endif;?>
                }
				,
				 {
                    "country": "FriDay",
                    "visits":  <?php if(!empty($weekcampaigns_report[5]['totalmsg'])):echo $weekcampaigns_report[5]['totalmsg']; else:   echo "0"; endif;?>
                }
				,
				 {
                    "country": "SaterDay",
                    "visits":  <?php if(!empty($weekcampaigns_report[6]['totalmsg'])):echo $weekcampaigns_report[6]['totalmsg']; else:   echo "0"; endif;?>
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                chart.startDuration = 1;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.gridPosition = "start";

                // value
                // in case you don't want to change default settings of value axis,
                // you don't need to create it, as one value axis is created automatically.

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
                graph.balloonText = "[[category]]: <b>[[value]]</b>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.8;
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-right";

                chart.write("chartdiv");
            });
    
	
	
	</script>

    <script type="text/javascript">
        jQuery(function ($) {
  

            //  Pie Chart Example
            var chart2 = $('#pieChart').chartinator({

          

                // Create Table - String
                // Create a basic HTML table or a Google Table Chart from chart data
                // Options: false, 'basic-table', 'table-chart'
                // Note: This table will replace an existing HTML table
                createTable: 'table-chart',

                chartType: 'PieChart',

                // The class to apply to the chart container element
                chartClass: 'col',

                // The class to apply to the table element
                tableClass: 'col-table',

                pieChart: {

                    // Width of chart in pixels - Number
                    // Default: automatic (unspecified)
                    width: null,

                    // Height of chart in pixels - Number
                    // Default: automatic (unspecified)
                    height: 300,

                    chartArea: {
                        left: "6%",
                        top: 30,
                        width: "94%",
                        height: "100%"
                    },

                    // The font size in pixels - Number
                    // Or use css selectors as keywords to assign font sizes from the page
                    // For example: 'body'
                    // Default: false - Use Google Charts defaults
                    fontSize: 'body',

                    // The font family name. String
                    // Default: body font family
                    fontName: 'Roboto',

                    // Chart Title - String
                    // Default: Table caption.
                    //title: 'Pie Chart',

                    titleTextStyle: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: 'h4'
                    },
                    legend: {

                        // Legend position - String
                        // Options: bottom, top, left, right, in, none.
                        // Default: right
                        position: 'right'
                    },

                    // Array of colours
                    colors: ['#94ac27', '#3691ff', '#e248b3', '#f58327'],

                    // Make chart 3D - Boolean
                    // Default: false.
                    is3D: true,

                    tooltip: {

                        // Shows tooltip with values on hover - String
                        // Options: focus, none.
                        // Default: focus
                        trigger: 'focus'
                    }
                },
                // Show table as well as chart - String
                // Options: 'show', 'hide', 'remove'
                showTable: 'hide'
            });

           

        });
    </script>    
  
<!--This page js End -->  

  </body>
