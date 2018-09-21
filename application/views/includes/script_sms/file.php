<script>
 var chart;
 
     var chartDatafile = [
                {
                    "Weekfile": "SunDay",
                    "visitsfile": 200
                },
                {
                    "Weekfile": "MonDay",
                    "visitsfile": 100
                },
               
                {
                    "Weekfile": "TuseDay",
                    "visitsfile": 328
                },
				 {
                    "Weekfile": "WednessDay",
                    "visitsfile": 508
                }
				,
				 {
                    "Weekfile": "ThursDay",
                    "visitsfile": 458
                }
				,
				 {
                    "Weekfile": "FriDay",
                    "visitsfile": 128
                }
				,
				 {
                    "Weekfile": "SaterDay",
                    "visitsfile": 228
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatafile;
                chart.categoryField = "Weekfile";
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
                graph.valueField = "visitsfile";
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

                chart.write("chartdivfile");
            });
    
	

            var chartDatafile2 = [
                {
                    "monthfile": "Day1",
                    "numfile": 200
                },
                {
                    "monthfile": "Day2",
                    "numfile": 1882
                },
                {
                    "monthfile": "Day3",
                    "numfile": 1809
                },
                {
                    "monthfile": "Day4",
                    "numfile": 1322
                },
                {
                    "monthfile": "Day5",
                    "numfile": 1122
                },
                {
                    "monthfile": "Day6",
                    "numfile": 1114
                },
                {
                    "monthfile": "Day7",
                    "numfile": 794
                },
                {
                    "monthfile": "Day8",
                    "numfile": 524
                },
                {
                    "monthfile": "Day9",
                    "numfile": 734
                },
                {
                    "monthfile": "Day10",
                    "numfile": 464
                },
                {
                    "monthfile": "Day11",
                    "numfile": 824
                },
                {
                    "monthfile": "Day12",
                    "numfile": 744
                },
                {
                    "monthfile": "Day13",
                    "numfile": 574
                },
                {
                    "monthfile": "Day14",
                    "numfile": 354
                },
                {
                    "monthfile": "Day15",
                    "numfile": 224
                },
                {
                    "monthfile": "Day16",
                    "numfile": 534
                },
                {
                    "monthfile": "Day17",
                    "numfile": 674
                },
                {
                    "monthfile": "Day18",
                    "numfile": 464
                },
                {
                    "monthfile": "Day19",
                    "numfile": 854
                },
                {
                    "monthfile": "Day20",
                    "numfile": 574
                },
                {
                    "monthfile": "Day21",
                    "numfile": 764
                },
                {
                    "monthfile": "Day22",
                    "numfile": 554
                },
                {
                    "monthfile": "Day23",
                    "numfile": 254
                },
                {
                    "monthfile": "Day24",
                    "numfile": 674
                },
                {
                    "monthfile": "Day25",
                    "numfile": 364
                },
                {
                    "monthfile": "Day26",
                    "numfile": 844
                },
                {
                    "monthfile": "Day27",
                    "numfile": 734
                },
                {
                    "monthfile": "Day28",
                    "numfile": 324
                },
                {
                    "monthfile": "Day29",
                    "numfile": 584
                },
                {
                    "monthfile": "Day30",
                    "numfile": 444
                }
				,
                {
                    "monthfile": "Day31",
                    "numfile": 564
                }
               
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatafile2;
                chart.categoryField = "monthfile";
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
                graph.valueField = "numfile";
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

                chart.write("chartdivfile2");
            });
    
	
	 var chartDatafile3 = [
                {
                    "yearfile": "Jan",
                    "nmyrfile": 200
                },
                {
                    "yearfile": "feb",
                    "nmyrfile": 1882
                },
                {
                    "yearfile": "March",
                    "nmyrfile": 1809
                },
                {
                    "yearfile": "April",
                    "nmyrfile": 1322
                },
                {
                    "yearfile": "May",
                    "nmyrfile": 1122
                },
                {
                    "yearfile": "June",
                    "nmyrfile": 1114
                },
                {
                    "yearfile": "July",
                    "nmyrfile": 984
                },
                {
                    "yearfile": "Aug",
                    "nmyrfile": 711
                },
                {
                    "yearfile": "Sept",
                    "nmyrfile": 665
                },
                {
                    "yearfile": "oct",
                    "nmyrfile": 665
                },
                {
                    "yearfile": "Nov",
                    "nmyrfile": 665
                },
                {
                    "yearfile": "Dec",
                    "nmyrfile": 665
                }
                
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatafile3;
                chart.categoryField = "yearfile";
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
                graph.valueField = "nmyrfile";
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

                chart.write("chartdivfile3");
            });
    </script>