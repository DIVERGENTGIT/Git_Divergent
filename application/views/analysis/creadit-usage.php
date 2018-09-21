
  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Credit Usage</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<ul class="package_three04">
        <li><a href="<?php echo base_url(); ?>analysis/index">Over View</a></li>
        <li class="packcurrent04"><a href="<?php echo base_url(); ?>analysis/creditUsage">Credit Usage</a></li>
      <li><a href="<?php echo base_url(); ?>analysis/smsSource">Sms Source</a></li>
	  <li><a href="<?php echo base_url(); ?>analysis/localProviders">Location Provider</a></li>
       
    </ul>
	</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <ul class="chartcredit_three">
        <li class="creditcurrent"><a href="#week_chartdiv">Week</a></li>
        <li><a href="#month_chartdiv">Month</a></li>
        <li><a href="#year_chartdiv">Year</a></li>
        
    </ul>
<div class="crdt3tab">	
  <div id="week_chartdiv" class="crdttab-content">
<div id="chartdiv" style="width: 100%; height: 400px;"></div>
</div>
<div id="month_chartdiv" class="crdttab-content" style="display:none;">
<div id="chartdiv2" style="width: 100%; height: 400px;"></div>
</div>
 <div id="year_chartdiv" class="crdttab-content" style="display:none;">
<div id="chartdiv3" style="width: 100%; height: 400px;"></div>
</div> 
</div>
</div>
        
</div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
 <!--This page js Start -->
<script src="<?php echo base_url(); ?>assets/js/lib/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/serial.js" type="text/javascript"></script>


<script>
  var chart;

            var chartData = [
                {
                    "country": "<?php if(!empty($weekcampaigns_report[0]['daywise'])):echo $weekcampaigns_report[0]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[0]['totalmsg'])):echo $weekcampaigns_report[0]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "country": "<?php if(!empty($weekcampaigns_report[1]['daywise'])):echo $weekcampaigns_report[1]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[1]['totalmsg'])):echo $weekcampaigns_report[1]['totalmsg']; else:  echo "0"; endif;?>
                },
               
                {
                    "country": "<?php if(!empty($weekcampaigns_report[2]['daywise'])):echo $weekcampaigns_report[2]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[2]['totalmsg'])):echo $weekcampaigns_report[2]['totalmsg']; else:  echo "0"; endif;?>
                },
				 {
                    "country": "<?php if(!empty($weekcampaigns_report[3]['daywise'])):echo $weekcampaigns_report[3]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[3]['totalmsg'])):echo $weekcampaigns_report[3]['totalmsg']; else:  echo "0"; endif;?>
                }
				,
				 {
                    "country": "<?php if(!empty($weekcampaigns_report[4]['daywise'])):echo $weekcampaigns_report[4]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[4]['totalmsg'])):echo $weekcampaigns_report[4]['totalmsg']; else:  echo "0"; endif;?>
                }
				,
				 {
                    "country": "<?php if(!empty($weekcampaigns_report[5]['daywise'])):echo $weekcampaigns_report[5]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[5]['totalmsg'])):echo $weekcampaigns_report[5]['totalmsg']; else:  echo "0"; endif;?>
                }
				,
				 {
                    "country": "<?php if(!empty($weekcampaigns_report[6]['daywise'])):echo $weekcampaigns_report[6]['daywise']; else:  echo "0"; endif;?>",
                    "visits": <?php if(!empty($weekcampaigns_report[6]['totalmsg'])):echo $weekcampaigns_report[6]['totalmsg']; else:  echo "0"; endif;?>
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
    <script>
  var chart;

            var chartData2 = [
                {
                    "week": " <?php if(!empty($monthlyreport[0]['daywise'])):echo $monthlyreport[0]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[0]['totalmsg'])):echo $monthlyreport[0]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[1]['daywise'])):echo $monthlyreport[1]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[1]['totalmsg'])):echo $monthlyreport[1]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[2]['daywise'])):echo $monthlyreport[2]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[2]['totalmsg'])):echo $monthlyreport[2]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[3]['daywise'])):echo $monthlyreport[3]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[3]['totalmsg'])):echo $monthlyreport[3]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[4]['daywise'])):echo $monthlyreport[4]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[4]['totalmsg'])):echo $monthlyreport[4]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[5]['daywise'])):echo $monthlyreport[5]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[5]['totalmsg'])):echo $monthlyreport[5]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[6]['daywise'])):echo $monthlyreport[6]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[6]['totalmsg'])):echo $monthlyreport[6]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[7]['daywise'])):echo $monthlyreport[7]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[7]['totalmsg'])):echo $monthlyreport[7]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[8]['daywise'])):echo $monthlyreport[8]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[8]['totalmsg'])):echo $monthlyreport[8]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[9]['daywise'])):echo $monthlyreport[9]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[9]['totalmsg'])):echo $monthlyreport[9]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[10]['daywise'])):echo $monthlyreport[10]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[10]['totalmsg'])):echo $monthlyreport[10]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[11]['daywise'])):echo $monthlyreport[11]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[11]['totalmsg'])):echo $monthlyreport[11]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[12]['daywise'])):echo $monthlyreport[12]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[12]['totalmsg'])):echo $monthlyreport[12]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[13]['daywise'])):echo $monthlyreport[13]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[13]['totalmsg'])):echo $monthlyreport[13]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[14]['daywise'])):echo $monthlyreport[14]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[14]['totalmsg'])):echo $monthlyreport[14]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[15]['daywise'])):echo $monthlyreport[15]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[15]['totalmsg'])):echo $monthlyreport[15]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[16]['daywise'])):echo $monthlyreport[16]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[16]['totalmsg'])):echo $monthlyreport[16]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[17]['daywise'])):echo $monthlyreport[17]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[17]['totalmsg'])):echo $monthlyreport[17]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[18]['daywise'])):echo $monthlyreport[18]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[18]['totalmsg'])):echo $monthlyreport[18]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[19]['daywise'])):echo $monthlyreport[19]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[19]['totalmsg'])):echo $monthlyreport[19]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[20]['daywise'])):echo $monthlyreport[20]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[20]['totalmsg'])):echo $monthlyreport[20]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[21]['daywise'])):echo $monthlyreport[21]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[21]['totalmsg'])):echo $monthlyreport[21]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[22]['daywise'])):echo $monthlyreport[22]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[22]['totalmsg'])):echo $monthlyreport[22]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[23]['daywise'])):echo $monthlyreport[23]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[23]['totalmsg'])):echo $monthlyreport[23]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[24]['daywise'])):echo $monthlyreport[24]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[24]['totalmsg'])):echo $monthlyreport[24]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[25]['daywise'])):echo $monthlyreport[25]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[25]['totalmsg'])):echo $monthlyreport[25]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[26]['daywise'])):echo $monthlyreport[26]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[26]['totalmsg'])):echo $monthlyreport[26]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[27]['daywise'])):echo $monthlyreport[27]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[27]['totalmsg'])):echo $monthlyreport[27]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[28]['daywise'])):echo $monthlyreport[28]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[28]['totalmsg'])):echo $monthlyreport[28]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "week": " <?php if(!empty($monthlyreport[29]['daywise'])):echo $monthlyreport[29]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[29]['totalmsg'])):echo $monthlyreport[29]['totalmsg']; else:  echo "0"; endif;?>
                }
				,
                {
                    "week": " <?php if(!empty($monthlyreport[30]['daywise'])):echo $monthlyreport[30]['daywise']; else:  echo "0"; endif;?>",
                    "num": <?php if(!empty($monthlyreport[30]['totalmsg'])):echo $monthlyreport[30]['totalmsg']; else:  echo "0"; endif;?>
                }
               
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData2;
                chart.categoryField = "week";
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
                graph.valueField = "num";
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

                chart.write("chartdiv2");
            });
    
	
	
	</script>
    <script>
  var chart;

            var chartData3 = [
                {
                    "year": "<?php if(!empty($yearreport[0]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[0]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[0]['totalmsg'])):echo $yearreport[0]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[1]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[1]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[1]['totalmsg'])):echo $yearreport[1]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[2]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[2]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[2]['totalmsg'])):echo $yearreport[2]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[3]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[3]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[3]['totalmsg'])):echo $yearreport[3]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[4]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[4]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[4]['totalmsg'])):echo $yearreport[4]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[5]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[5]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[5]['totalmsg'])):echo $yearreport[5]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[6]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[6]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr":<?php if(!empty($yearreport[6]['totalmsg'])):echo $yearreport[6]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[7]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[7]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[7]['totalmsg'])):echo $yearreport[7]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[8]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[8]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[8]['totalmsg'])):echo $yearreport[8]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[9]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[9]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[9]['totalmsg'])):echo $yearreport[9]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[10]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[10]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[10]['totalmsg'])):echo $yearreport[10]['totalmsg']; else:  echo "0"; endif;?>
                },
                {
                    "year": "<?php if(!empty($yearreport[11]['daywise']))
					{ 
					
				$monthNumunicode  = $yearreport[11]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($yearreport[11]['totalmsg'])):echo $yearreport[11]['totalmsg']; else:  echo "0"; endif;?>
                }
                
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData3;
                chart.categoryField = "year";
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
                graph.valueField = "nmyr";
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

                chart.write("chartdiv3");
            });
    
	
	
	</script>
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
<!--This page js End --> 
 
  </body>
