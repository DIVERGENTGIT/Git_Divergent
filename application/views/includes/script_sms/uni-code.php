
<script> var chart;
 
  var chartDatauni = [
                {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[0]['daywise'])){ echo $getWeekCampaignUnicode[0]['daywise']; }else{ echo "0";}?>",
                    "visitsuni": <?php if(!empty($getWeekCampaignUnicode[0]['totalmsg'])){ echo $getWeekCampaignUnicode[0]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[1]['daywise'])){ echo $getWeekCampaignUnicode[1]['daywise']; }else{ echo "0";}?>",
                    "visitsuni": <?php if(!empty($getWeekCampaignUnicode[1]['totalmsg'])){ echo $getWeekCampaignUnicode[1]['totalmsg']; }else{ echo "0";}?>
                },
               
                {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[2]['daywise'])){ echo $getWeekCampaignUnicode[2]['daywise']; }else{ echo "0";  }?>",
                    "visitsuni":<?php if(!empty($getWeekCampaignUnicode[2]['totalmsg'])){ echo $getWeekCampaignUnicode[2]['totalmsg']; }else{ echo "0";}?>
                },
				 {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[3]['daywise'])){ echo $getWeekCampaignUnicode[3]['daywise']; }else{ echo "0";}?>",
                    "visitsuni":  <?php if(!empty($getWeekCampaignUnicode[3]['totalmsg'])){ echo $getWeekCampaignUnicode[3]['totalmsg']; }else{ echo "0";}?>
                }
				,
				 {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[4]['daywise'])){ echo $getWeekCampaignUnicode[4]['daywise']; }else{ echo "0";}?>",
                    "visitsuni": <?php if(!empty($getWeekCampaignUnicode[4]['totalmsg'])){ echo $getWeekCampaignUnicode[4]['totalmsg']; }else{ echo "0";}?>
                }
				,
				 {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[5]['daywise'])){ echo $getWeekCampaignUnicode[5]['daywise']; }else{ echo "0";}?>",
                    "visitsuni": <?php if(!empty($getWeekCampaignUnicode[5]['totalmsg'])){ echo $getWeekCampaignUnicode[5]['totalmsg']; }else{ echo "0";}?>
                }
				,
				 {
                    "Weekuni": "<?php if(!empty($getWeekCampaignUnicode[6]['daywise'])){ echo $getWeekCampaignUnicode[6]['daywise']; }else{ echo "0";}?>",
                    "visitsuni": <?php if(!empty($getWeekCampaignUnicode[6]['totalmsg'])){ echo $getWeekCampaignUnicode[6]['totalmsg']; }else{ echo "0";}?>
                }
            ];

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatauni;
                chart.categoryField = "Weekuni";
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
                graph.valueField = "visitsuni";
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

                chart.write("chartdivuni");
            });
    
	





  var chartDatauni2 = [
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[0]['daywise'])){ echo $getMonthCampaignUnicode[0]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[0]['totalmsg'])){ echo $getMonthCampaignUnicode[0]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[1]['daywise'])){ echo $getMonthCampaignUnicode[1]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[1]['totalmsg'])){ echo $getMonthCampaignUnicode[1]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[2]['daywise'])){ echo $getMonthCampaignUnicode[2]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[2]['totalmsg'])){ echo $getMonthCampaignUnicode[2]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[3]['daywise'])){ echo $getMonthCampaignUnicode[3]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[3]['totalmsg'])){ echo $getMonthCampaignUnicode[3]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[4]['daywise'])){ echo $getMonthCampaignUnicode[4]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[4]['totalmsg'])){ echo $getMonthCampaignUnicode[4]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[5]['daywise'])){ echo $getMonthCampaignUnicode[5]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[5]['totalmsg'])){ echo $getMonthCampaignUnicode[5]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[6]['daywise'])){ echo $getMonthCampaignUnicode[6]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[6]['totalmsg'])){ echo $getMonthCampaignUnicode[6]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[7]['daywise'])){ echo $getMonthCampaignUnicode[7]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[7]['totalmsg'])){ echo $getMonthCampaignUnicode[7]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[8]['daywise'])){ echo $getMonthCampaignUnicode[8]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[8]['totalmsg'])){ echo $getMonthCampaignUnicode[8]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[9]['daywise'])){ echo $getMonthCampaignUnicode[9]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[9]['totalmsg'])){ echo $getMonthCampaignUnicode[9]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[10]['daywise'])){ echo $getMonthCampaignUnicode[10]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[10]['totalmsg'])){ echo $getMonthCampaignUnicode[10]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[11]['daywise'])){ echo $getMonthCampaignUnicode[11]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[11]['totalmsg'])){ echo $getMonthCampaignUnicode[11]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[12]['daywise'])){ echo $getMonthCampaignUnicode[12]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[12]['totalmsg'])){ echo $getMonthCampaignUnicode[12]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[13]['daywise'])){ echo $getMonthCampaignUnicode[13]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[13]['totalmsg'])){ echo $getMonthCampaignUnicode[13]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[14]['daywise'])){ echo $getMonthCampaignUnicode[14]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[14]['totalmsg'])){ echo $getMonthCampaignUnicode[14]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[15]['daywise'])){ echo $getMonthCampaignUnicode[15]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[15]['totalmsg'])){ echo $getMonthCampaignUnicode[15]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[16]['daywise'])){ echo $getMonthCampaignUnicode[16]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[16]['totalmsg'])){ echo $getMonthCampaignUnicode[16]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[17]['daywise'])){ echo $getMonthCampaignUnicode[17]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[17]['totalmsg'])){ echo $getMonthCampaignUnicode[17]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[18]['daywise'])){ echo $getMonthCampaignUnicode[18]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[18]['totalmsg'])){ echo $getMonthCampaignUnicode[18]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[19]['daywise'])){ echo $getMonthCampaignUnicode[19]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[19]['totalmsg'])){ echo $getMonthCampaignUnicode[19]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[20]['daywise'])){ echo $getMonthCampaignUnicode[20]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[20]['totalmsg'])){ echo $getMonthCampaignUnicode[20]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[21]['daywise'])){ echo $getMonthCampaignUnicode[21]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[21]['totalmsg'])){ echo $getMonthCampaignUnicode[21]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[22]['daywise'])){ echo $getMonthCampaignUnicode[22]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[22]['totalmsg'])){ echo $getMonthCampaignUnicode[22]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[23]['daywise'])){ echo $getMonthCampaignUnicode[23]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[23]['totalmsg'])){ echo $getMonthCampaignUnicode[23]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[24]['daywise'])){ echo $getMonthCampaignUnicode[24]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[24]['totalmsg'])){ echo $getMonthCampaignUnicode[24]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[25]['daywise'])){ echo $getMonthCampaignUnicode[25]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[25]['totalmsg'])){ echo $getMonthCampaignUnicode[25]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[26]['daywise'])){ echo $getMonthCampaignUnicode[26]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[26]['totalmsg'])){ echo $getMonthCampaignUnicode[26]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[27]['daywise'])){ echo $getMonthCampaignUnicode[27]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[27]['totalmsg'])){ echo $getMonthCampaignUnicode[27]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[28]['daywise'])){ echo $getMonthCampaignUnicode[27]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[28]['totalmsg'])){ echo $getMonthCampaignUnicode[28]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[29]['daywise'])){ echo $getMonthCampaignUnicode[29]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[29]['totalmsg'])){ echo $getMonthCampaignUnicode[29]['totalmsg']; }else{ echo "0";}?>
                }
				,
                {
                    "monthuni": "<?php if(!empty($getMonthCampaignUnicode[30]['daywise'])){ echo $getMonthCampaignUnicode[30]['daywise']; }else{ echo "0";}?>",
                    "numuni": <?php if(!empty($getMonthCampaignUnicode[30]['totalmsg'])){ echo $getMonthCampaignUnicode[30]['totalmsg']; }else{ echo "0";}?>
                }
               
            ];



            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatauni2;
                chart.categoryField = "monthuni";
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
                graph.valueField = "numuni";
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

                chart.write("chartdivuni2");
            });
    
	
	 var chartDatauni3 = [
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[0]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[0]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[0]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[0]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[1]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[1]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[1]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[1]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
               {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[2]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[2]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[2]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[2]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
               {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[3]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[3]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[3]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[3]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[4]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[4]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[4]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[4]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[5]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[5]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[5]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[5]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[6]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[6]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[6]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[6]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
               {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[7]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[7]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[7]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[7]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[8]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[8]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[8]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[8]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
               {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[9]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[9]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[9]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[9]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[10]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[10]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[10]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[10]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
               {
                    "yearuni": "<?php if(!empty($getYearCampaignUnicode[11]['daywise']))
					{ 
					
				$monthNumunicode  = $getYearCampaignUnicode[11]['daywise'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNumunicode);
				echo $monthNameunicode = $dateObj->format('F'); 
				
				}else{ 
				
				echo "0";
				
				}
					
					?>",
                    "nmyruni": <?php if(!empty($getYearCampaignUnicode[11]['totalmsg'])){ 
					
					echo $getYearCampaignUnicode[11]['totalmsg']; 
					
					
					}else{ echo "0";}?>
                },
                
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatauni3;
                chart.categoryField = "yearuni";
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
                graph.valueField = "nmyruni";
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

                chart.write("chartdivuni3");
            });
    </script>
  