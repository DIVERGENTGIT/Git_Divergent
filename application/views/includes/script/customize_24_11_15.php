<script> 
var chart;
 
     var chartDatacust = [
                {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[0]['daywise'])){ echo $getWeekCampaignCustomized[0]['daywise']; }else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[0]['totalmsg'])){ echo $getWeekCampaignCustomized[0]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[1]['daywise'])){ echo $getWeekCampaignCustomized[1]['daywise']; }else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[1]['totalmsg'])){ echo $getWeekCampaignCustomized[1]['totalmsg']; }else{ echo "0";}?>
                },
               
                {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[2]['daywise'])){ echo $getWeekCampaignCustomized[2]['daywise']; }else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[2]['totalmsg'])){ echo $getWeekCampaignCustomized[2]['totalmsg']; }else{ echo "0";}?>
                },
				 {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[3]['daywise'])){ echo $getWeekCampaignCustomized[3]['daywise']; }else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[3]['totalmsg'])){ echo $getWeekCampaignCustomized[3]['totalmsg']; }else{ echo "0";}?>
                }
				,
				 {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[4]['daywise'])){ echo $getWeekCampaignCustomized[4]['daywise']; }else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[4]['totalmsg'])){ echo $getWeekCampaignCustomized[4]['totalmsg']; }else{ echo "0";}?>
                }
				,
				 {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[5]['daywise'])){ echo $getWeekCampaignCustomized[5]['daywise']; }else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[5]['totalmsg'])){ echo $getWeekCampaignCustomized[5]['totalmsg']; }else{ echo "0";}?>
                }
				,
				 {
                    "Weekcust": "<?php if(!empty($getWeekCampaignCustomized[6]['daywise'])){ 
					echo $getWeekCampaignCustomized[6]['daywise']; }
					else{ echo "0";}?>",
                    "visitscust": <?php if(!empty($getWeekCampaignCustomized[6]['totalmsg'])){ 
					echo $getWeekCampaignCustomized[6]['totalmsg']; }
					else{ echo "0";}?>
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatacust;
                chart.categoryField = "Weekcust";
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
                graph.valueField = "visitscust";
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

                chart.write("chartdivcust");
            });
    
	

            var chartDatacust2 = [
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[0]['daywise'])){ echo $getMonthCampaignCustomized[0]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[0]['totalmsg'])){ echo $getMonthCampaignCustomized[0]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[1]['daywise'])){ echo $getMonthCampaignCustomized[1]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[1]['totalmsg'])){ 
					echo $getMonthCampaignCustomized[1]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[2]['daywise'])){ echo $getMonthCampaignCustomized[2]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[2]['totalmsg'])){ echo $getMonthCampaignCustomized[2]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[3]['daywise'])){ echo $getMonthCampaignCustomized[3]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[3]['daywise'])){ echo $getMonthCampaignCustomized[3]['daywise']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[4]['daywise'])){ echo $getMonthCampaignCustomized[4]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[4]['totalmsg'])){ echo $getMonthCampaignCustomized[4]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[5]['daywise'])){ echo $getMonthCampaignCustomized[5]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[5]['totalmsg'])){ echo $getMonthCampaignCustomized[5]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[6]['daywise'])){ echo $getMonthCampaignCustomized[6]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[6]['totalmsg'])){ echo $getMonthCampaignCustomized[6]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[7]['daywise'])){ echo $getMonthCampaignCustomized[7]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[7]['totalmsg'])){ echo $getMonthCampaignCustomized[7]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[8]['daywise'])){ echo $getMonthCampaignCustomized[8]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[8]['totalmsg'])){ echo $getMonthCampaignCustomized[8]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[9]['daywise'])){ echo $getMonthCampaignCustomized[9]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[9]['totalmsg'])){ echo $getMonthCampaignCustomized[9]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[10]['daywise'])){ echo $getMonthCampaignCustomized[10]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[10]['totalmsg'])){ echo $getMonthCampaignCustomized[10]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[11]['daywise'])){ echo $getMonthCampaignCustomized[11]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[11]['totalmsg'])){ echo $getMonthCampaignCustomized[11]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[12]['daywise'])){ echo $getMonthCampaignCustomized[12]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[12]['totalmsg'])){ echo $getMonthCampaignCustomized[12]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[13]['daywise'])){ echo $getMonthCampaignCustomized[13]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[13]['totalmsg'])){ echo $getMonthCampaignCustomized[13]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[14]['daywise'])){ echo $getMonthCampaignCustomized[14]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[14]['totalmsg'])){ echo $getMonthCampaignCustomized[14]['daywise']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[15]['daywise'])){ echo $getMonthCampaignCustomized[15]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[15]['totalmsg'])){ echo $getMonthCampaignCustomized[15]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[16]['daywise'])){ echo $getMonthCampaignCustomized[16]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[16]['totalmsg'])){ echo $getMonthCampaignCustomized[16]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[17]['daywise'])){ echo $getMonthCampaignCustomized[17]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[17]['totalmsg'])){ echo $getMonthCampaignCustomized[17]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[18]['daywise'])){ echo $getMonthCampaignCustomized[18]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[3]['totalmsg'])){ echo $getMonthCampaignCustomized[18]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[19]['daywise'])){ echo $getMonthCampaignCustomized[19]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[19]['totalmsg'])){ echo $getMonthCampaignCustomized[19]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[20]['daywise'])){ echo $getMonthCampaignCustomized[20]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[20]['totalmsg'])){ echo $getMonthCampaignCustomized[20]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[21]['daywise'])){ echo $getMonthCampaignCustomized[21]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[21]['totalmsg'])){ echo $getMonthCampaignCustomized[21]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[22]['daywise'])){ echo $getMonthCampaignCustomized[22]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[22]['totalmsg'])){ echo $getMonthCampaignCustomized[22]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[23]['daywise'])){ echo $getMonthCampaignCustomized[23]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[23]['totalmsg'])){ echo $getMonthCampaignCustomized[23]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[24]['daywise'])){ echo $getMonthCampaignCustomized[24]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[24]['totalmsg'])){ echo $getMonthCampaignCustomized[24]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[25]['daywise'])){ echo $getMonthCampaignCustomized[25]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[25]['totalmsg'])){ echo $getMonthCampaignCustomized[25]['totalmsg']; }else{ echo "0";}?>
					
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[26]['daywise'])){ echo $getMonthCampaignCustomized[26]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[26]['totalmsg'])){ echo $getMonthCampaignCustomized[26]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[27]['daywise'])){ echo $getMonthCampaignCustomized[27]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[27]['totalmsg'])){ echo $getMonthCampaignCustomized[27]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[28]['daywise'])){ echo $getMonthCampaignCustomized[28]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[28]['totalmsg'])){ echo $getMonthCampaignCustomized[28]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[29]['daywise'])){ echo $getMonthCampaignCustomized[29]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[29]['totalmsg'])){ echo $getMonthCampaignCustomized[29]['totalmsg']; }else{ echo "0";}?>
                }
				,
                {
                    "monthcust": "<?php if(!empty($getMonthCampaignCustomized[30]['daywise'])){ echo $getMonthCampaignCustomized[30]['daywise']; }else{ echo "0";}?>",
                    "numcust": <?php if(!empty($getMonthCampaignCustomized[30]['totalmsg'])){ echo $getMonthCampaignCustomized[30]['totalmsg']; }else{ echo "0";}?>
                }
               
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatacust2;
                chart.categoryField = "monthcust";
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
                graph.valueField = "numcust";
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

                chart.write("chartdivcust2");
            });
    
	
	  var chartDatacust3 = [
                
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[0]['daywise']))
					{ 
					
				$monthNum  = $getYearCampaignCustomized[0]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[0]['totalmsg'])){ 
					
					echo $getYearCampaignCustomized[0]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[1]['daywise'])){ 
					
					$monthNum  = $getYearCampaignCustomized[1]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					
					
					}else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[1]['totalmsg'])){ 
					
					echo $getYearCampaignCustomized[1]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[2]['daywise'])){ 
$monthNum  = $getYearCampaignCustomized[2]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 					
					 }else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[2]['totalmsg'])){ 
					echo $getYearCampaignCustomized[2]['totalmsg'];
					
					 }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[3]['daywise'])){
						
					$monthNum  = $getYearCampaignCustomized[3]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
						 }else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[3]['totalmsg'])){ echo $getYearCampaignCustomized[3]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[4]['daywise'])){ 
$monthNum  = $getYearCampaignCustomized[4]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 					
					}else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[4]['totalmsg'])){ echo $getYearCampaignCustomized[4]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[5]['daywise'])){
						
						$monthNum  = $getYearCampaignCustomized[5]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
						 
						 }else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[5]['totalmsg'])){ 
					echo $getYearCampaignCustomized[5]['totalmsg']; 
					
					}else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[6]['daywise'])){ 
					$monthNum  = $getYearCampaignCustomized[6]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					 }else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[6]['totalmsg'])){ echo $getYearCampaignCustomized[6]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[7]['daywise'])){ 
					$monthNum  = $getYearCampaignCustomized[7]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					}else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[7]['totalmsg'])){ 
					echo $getYearCampaignCustomized[7]['totalmsg']; 
					
					}else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[8]['daywise'])){ 
					
					$monthNum  = $getYearCampaignCustomized[8]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					
					}else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[8]['totalmsg'])){ echo $getYearCampaignCustomized[8]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[9]['daywise'])){ 
				$monthNum  = $getYearCampaignCustomized[9]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					
					}else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[9]['totalmsg'])){ echo $getYearCampaignCustomized[9]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($monthcampaignsquick_report[10]['daywise'])){ 
				$monthNum  = $getYearCampaignCustomized[10]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					
					}else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[10]['totalmsg'])){ echo $getYearCampaignCustomized[10]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "year": "<?php if(!empty($getYearCampaignCustomized[11]['daywise'])){ 
				$monthNum  = $getYearCampaignCustomized[11]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				echo $monthName = $dateObj->format('F'); 
					
					 }else{ echo "0";}?>",
                    "nmyr": <?php if(!empty($getYearCampaignCustomized[11]['totalmsg'])){ echo $getYearCampaignCustomized[11]['totalmsg']; }else{ echo "0";}?>
                }
                
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatacust3;
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

                chart.write("chartdivcust3");
            });
    </script>