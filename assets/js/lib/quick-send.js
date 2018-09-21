 var chart;
 
     var chartData = [
                {
                    "Week": "SunDay",
                    "visits": 200
                },
                {
                    "Week": "MonDay",
                    "visits": 100
                },
               
                {
                    "Week": "TuseDay",
                    "visits": 328
                },
				 {
                    "Week": "WednessDay",
                    "visits": 508
                }
				,
				 {
                    "Week": "ThursDay",
                    "visits": 458
                }
				,
				 {
                    "Week": "FriDay",
                    "visits": 128
                }
				,
				 {
                    "Week": "SaterDay",
                    "visits": 228
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
    
	

            var chartData2 = [
                {
                    "month": "Day1",
                    "num": 200
                },
                {
                    "month": "Day2",
                    "num": 1882
                },
                {
                    "month": "Day3",
                    "num": 1809
                },
                {
                    "month": "Day4",
                    "num": 1322
                },
                {
                    "month": "Day5",
                    "num": 1122
                },
                {
                    "month": "Day6",
                    "num": 1114
                },
                {
                    "month": "Day7",
                    "num": 794
                },
                {
                    "month": "Day8",
                    "num": 524
                },
                {
                    "month": "Day9",
                    "num": 734
                },
                {
                    "month": "Day10",
                    "num": 464
                },
                {
                    "month": "Day11",
                    "num": 824
                },
                {
                    "month": "Day12",
                    "num": 744
                },
                {
                    "month": "Day13",
                    "num": 574
                },
                {
                    "month": "Day14",
                    "num": 354
                },
                {
                    "month": "Day15",
                    "num": 224
                },
                {
                    "month": "Day16",
                    "num": 534
                },
                {
                    "month": "Day17",
                    "num": 674
                },
                {
                    "month": "Day18",
                    "num": 464
                },
                {
                    "month": "Day19",
                    "num": 854
                },
                {
                    "month": "Day20",
                    "num": 574
                },
                {
                    "month": "Day21",
                    "num": 764
                },
                {
                    "month": "Day22",
                    "num": 554
                },
                {
                    "month": "Day23",
                    "num": 254
                },
                {
                    "month": "Day24",
                    "num": 674
                },
                {
                    "month": "Day25",
                    "num": 364
                },
                {
                    "month": "Day26",
                    "num": 844
                },
                {
                    "month": "Day27",
                    "num": 734
                },
                {
                    "month": "Day28",
                    "num": 324
                },
                {
                    "month": "Day29",
                    "num": 584
                },
                {
                    "month": "Day30",
                    "num": 444
                }
				,
                {
                    "month": "Day31",
                    "num": 564
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
                    "year": "Jan",
                    "nmyr": 200
                },
                {
                    "year": "feb",
                    "nmyr": 1882
                },
                {
                    "year": "March",
                    "nmyr": 1809
                },
                {
                    "year": "April",
                    "nmyr": 1322
                },
                {
                    "year": "May",
                    "nmyr": 1122
                },
                {
                    "year": "June",
                    "nmyr": 1114
                },
                {
                    "year": "July",
                    "nmyr": 984
                },
                {
                    "year": "Aug",
                    "nmyr": 711
                },
                {
                    "year": "Sept",
                    "nmyr": 665
                },
                {
                    "year": "oct",
                    "nmyr": 665
                },
                {
                    "year": "Nov",
                    "nmyr": 665
                },
                {
                    "year": "Dec",
                    "nmyr": 665
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
    