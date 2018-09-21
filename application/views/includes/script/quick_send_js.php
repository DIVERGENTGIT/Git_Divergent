<script> 
var chart;
 
     var chartData = [
                {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[0]['daywise'])){ echo $weekcampaignsquick_report[0]['daywise']; }else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[0]['totalmsg'])){ echo $weekcampaignsquick_report[0]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[1]['daywise'])){ echo $weekcampaignsquick_report[1]['daywise']; }else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[1]['totalmsg'])){ echo $weekcampaignsquick_report[1]['totalmsg']; }else{ echo "0";}?>
                },
               
                {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[2]['daywise'])){ echo $weekcampaignsquick_report[2]['daywise']; }else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[2]['totalmsg'])){ echo $weekcampaignsquick_report[2]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[3]['daywise'])){ echo $weekcampaignsquick_report[3]['daywise']; }else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[3]['totalmsg'])){ echo $weekcampaignsquick_report[3]['totalmsg']; }else{ echo "0";}?>
                }
                ,
                 {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[4]['daywise'])){ echo $weekcampaignsquick_report[4]['daywise']; }else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[4]['totalmsg'])){ echo $weekcampaignsquick_report[4]['totalmsg']; }else{ echo "0";}?>
                }
                ,
                 {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[5]['daywise'])){ echo $weekcampaignsquick_report[5]['daywise']; }else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[5]['totalmsg'])){ echo $weekcampaignsquick_report[5]['totalmsg']; }else{ echo "0";}?>
                }
                ,
                 {
                    "Week": "<?php if(!empty($weekcampaignsquick_report[6]['daywise'])){ 
                    echo $weekcampaignsquick_report[6]['daywise']; }
                    else{ echo "0";}?>",
                    "visit": <?php if(!empty($weekcampaignsquick_report[6]['totalmsg'])){ 
                    echo $weekcampaignsquick_report[6]['totalmsg']; }
                    else{ echo "0";}?>
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "Week";
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
                graph.valueField = "visit";
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
    
    

            var chartData2 = [
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[0]['daywise'])){ echo $monthcampaignsquick_report[0]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[0]['totalmsg'])){ echo $monthcampaignsquick_report[0]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[1]['daywise'])){ echo $monthcampaignsquick_report[1]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[1]['totalmsg'])){ echo $monthcampaignsquick_report[1]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[2]['daywise'])){ echo $monthcampaignsquick_report[2]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[2]['totalmsg'])){ echo $monthcampaignsquick_report[2]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[3]['daywise'])){ echo $monthcampaignsquick_report[3]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[3]['totalmsg'])){ echo $monthcampaignsquick_report[3]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[4]['daywise'])){ echo $monthcampaignsquick_report[4]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[4]['totalmsg'])){ echo $monthcampaignsquick_report[4]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[5]['daywise'])){ echo $monthcampaignsquick_report[5]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[5]['totalmsg'])){ echo $monthcampaignsquick_report[5]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[6]['daywise'])){ echo $monthcampaignsquick_report[6]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[6]['totalmsg'])){ echo $monthcampaignsquick_report[6]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[7]['daywise'])){ echo $monthcampaignsquick_report[7]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[7]['totalmsg'])){ echo $monthcampaignsquick_report[7]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[8]['daywise'])){ echo $monthcampaignsquick_report[8]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[8]['totalmsg'])){ echo $monthcampaignsquick_report[8]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[9]['daywise'])){ echo $monthcampaignsquick_report[9]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[9]['totalmsg'])){ echo $monthcampaignsquick_report[9]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[10]['daywise'])){ echo $monthcampaignsquick_report[10]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[10]['totalmsg'])){ echo $monthcampaignsquick_report[10]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[11]['daywise'])){ echo $monthcampaignsquick_report[11]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[11]['totalmsg'])){ echo $monthcampaignsquick_report[11]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[12]['daywise'])){ echo $monthcampaignsquick_report[12]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[12]['totalmsg'])){ echo $monthcampaignsquick_report[12]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[13]['daywise'])){ echo $monthcampaignsquick_report[13]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[13]['totalmsg'])){ echo $monthcampaignsquick_report[13]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[14]['daywise'])){ echo $monthcampaignsquick_report[14]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[14]['totalmsg'])){ echo $monthcampaignsquick_report[14]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[15]['daywise'])){ echo $monthcampaignsquick_report[15]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[15]['totalmsg'])){ echo $monthcampaignsquick_report[15]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[16]['daywise'])){ echo $monthcampaignsquick_report[16]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[16]['totalmsg'])){ echo $monthcampaignsquick_report[16]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[17]['daywise'])){ echo $monthcampaignsquick_report[17]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[17]['totalmsg'])){ echo $monthcampaignsquick_report[17]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[18]['daywise'])){ echo $monthcampaignsquick_report[18]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[18]['totalmsg'])){ echo $monthcampaignsquick_report[18]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[19]['daywise'])){ echo $monthcampaignsquick_report[19]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[19]['totalmsg'])){ echo $monthcampaignsquick_report[19]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[20]['daywise'])){ echo $monthcampaignsquick_report[20]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[20]['totalmsg'])){ echo $monthcampaignsquick_report[20]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[21]['daywise'])){ echo $monthcampaignsquick_report[21]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[21]['totalmsg'])){ echo $monthcampaignsquick_report[21]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[22]['daywise'])){ echo $monthcampaignsquick_report[22]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[22]['totalmsg'])){ echo $monthcampaignsquick_report[22]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[23]['daywise'])){ echo $monthcampaignsquick_report[23]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[23]['totalmsg'])){ echo $monthcampaignsquick_report[23]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[24]['daywise'])){ echo $monthcampaignsquick_report[24]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[25]['totalmsg'])){ echo $monthcampaignsquick_report[25]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[26]['daywise'])){ echo $monthcampaignsquick_report[26]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[26]['totalmsg'])){ echo $monthcampaignsquick_report[26]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[27]['daywise'])){ echo $monthcampaignsquick_report[27]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[27]['totalmsg'])){ echo $monthcampaignsquick_report[27]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[28]['daywise'])){ echo $monthcampaignsquick_report[28]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[28]['totalmsg'])){ echo $monthcampaignsquick_report[28]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[29]['daywise'])){ echo $monthcampaignsquick_report[29]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[29]['totalmsg'])){ echo $monthcampaignsquick_report[29]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "month": "<?php if(!empty($monthcampaignsquick_report[30]['daywise'])){ echo $monthcampaignsquick_report[30]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[30]['totalmsg'])){ echo $monthcampaignsquick_report[30]['totalmsg']; }else{ echo "0";}?>
                },
                 {
                    "month": "<?php if(!empty($monthcampaignsquick_report[31]['daywise'])){ echo $monthcampaignsquick_report[31]['daywise']; }else{ echo "0";}?>",
                    "num": <?php if(!empty($monthcampaignsquick_report[31]['totalmsg'])){ echo $monthcampaignsquick_report[31]['totalmsg']; }else{ echo "0";}?>
                }

            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData2;
                chart.categoryField = "month";
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
    
    
      var chartData3 = [
                
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[0]['daywise']))
                    { 
                    
                $monthNum  = $yearcampaignsquick_report[0]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                
                }else{ 
                
                echo "0";
                
                }
                    
                    ?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[0]['totalmsg'])){ 
                    
                    echo $yearcampaignsquick_report[0]['totalmsg']; 
                    
                    
                    }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[1]['daywise'])){ 
                    
                    $monthNum  = $yearcampaignsquick_report[1]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                    
                    
                    }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[1]['totalmsg'])){ 
                    
                    echo $yearcampaignsquick_report[1]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[2]['daywise'])){ 
$monthNum  = $yearcampaignsquick_report[2]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F');                    
                     }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[2]['totalmsg'])){ 
                    echo $yearcampaignsquick_report[2]['totalmsg'];
                    
                     }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[3]['daywise'])){
                        
                    $monthNum  = $yearcampaignsquick_report[3]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                         }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[3]['totalmsg'])){ echo $yearcampaignsquick_report[3]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[4]['daywise'])){ 
$monthNum  = $yearcampaignsquick_report[4]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F');                    
                    }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[4]['totalmsg'])){ echo $yearcampaignsquick_report[4]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[5]['daywise'])){
                        
                        $monthNum  = $yearcampaignsquick_report[5]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                         
                         }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[5]['totalmsg'])){ 
                    echo $yearcampaignsquick_report[5]['totalmsg']; 
                    
                    }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[6]['daywise'])){ 
                    $monthNum  = $yearcampaignsquick_report[6]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                     }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[6]['totalmsg'])){ echo $yearcampaignsquick_report[6]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[7]['daywise'])){ 
                    $monthNum  = $yearcampaignsquick_report[7]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                    }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[7]['totalmsg'])){ 
                    echo $yearcampaignsquick_report[7]['totalmsg']; 
                    
                    }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[8]['daywise'])){ 
                    
                    $monthNum  = $yearcampaignsquick_report[8]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                    
                    }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[8]['totalmsg'])){ echo $yearcampaignsquick_report[8]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[9]['daywise'])){ 
                $monthNum  = $yearcampaignsquick_report[9]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                    
                    }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[9]['totalmsg'])){ echo $yearcampaignsquick_report[9]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[10]['daywise'])){ 
                $monthNum  = $yearcampaignsquick_report[10]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                    
                    }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[10]['totalmsg'])){ echo $yearcampaignsquick_report[10]['totalmsg']; }else{ echo "0";}?>
                },
                {
                    "yearquick": "<?php if(!empty($yearcampaignsquick_report[11]['daywise'])){ 
                $monthNum  = $yearcampaignsquick_report[11]['daywise'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                echo $monthName = $dateObj->format('F'); 
                    
                     }else{ echo "0";}?>",
                    "nmyr1": <?php if(!empty($yearcampaignsquick_report[11]['totalmsg'])){ echo $yearcampaignsquick_report[11]['totalmsg']; }else{ echo "0";}?>
                }
                
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData3;
                chart.categoryField = "yearquick";
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
                graph.valueField = "nmyr1";
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