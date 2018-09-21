 var chart;
 
     var chartDatacust = [
                {
                    "Weekcust": "SunDay",
                    "visitscust": 200
                },
                {
                    "Weekcust": "MonDay",
                    "visitscust": 100
                },
               
                {
                    "Weekcust": "TuseDay",
                    "visitscust": 328
                },
				 {
                    "Weekcust": "WednessDay",
                    "visitscust": 508
                }
				,
				 {
                    "Weekcust": "ThursDay",
                    "visitscust": 458
                }
				,
				 {
                    "Weekcust": "FriDay",
                    "visitscust": 128
                }
				,
				 {
                    "Weekcust": "SaterDay",
                    "visitscust": 228
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
                    "monthcust": "Day1",
                    "numcust": 200
                },
                {
                    "monthcust": "Day2",
                    "numcust": 1882
                },
                {
                    "monthcust": "Day3",
                    "numcust": 1809
                },
                {
                    "monthcust": "Day4",
                    "numcust": 1322
                },
                {
                    "monthcust": "Day5",
                    "numcust": 1122
                },
                {
                    "monthcust": "Day6",
                    "numcust": 1114
                },
                {
                    "monthcust": "Day7",
                    "numcust": 794
                },
                {
                    "monthcust": "Day8",
                    "numcust": 524
                },
                {
                    "monthcust": "Day9",
                    "numcust": 734
                },
                {
                    "monthcust": "Day10",
                    "numcust": 464
                },
                {
                    "monthcust": "Day11",
                    "numcust": 824
                },
                {
                    "monthcust": "Day12",
                    "numcust": 744
                },
                {
                    "monthcust": "Day13",
                    "numcust": 574
                },
                {
                    "monthcust": "Day14",
                    "numcust": 354
                },
                {
                    "monthcust": "Day15",
                    "numcust": 224
                },
                {
                    "monthcust": "Day16",
                    "numcust": 534
                },
                {
                    "monthcust": "Day17",
                    "numcust": 674
                },
                {
                    "monthcust": "Day18",
                    "numcust": 464
                },
                {
                    "monthcust": "Day19",
                    "numcust": 854
                },
                {
                    "monthcust": "Day20",
                    "numcust": 574
                },
                {
                    "monthcust": "Day21",
                    "numcust": 764
                },
                {
                    "monthcust": "Day22",
                    "numcust": 554
                },
                {
                    "monthcust": "Day23",
                    "numcust": 254
                },
                {
                    "monthcust": "Day24",
                    "numcust": 674
                },
                {
                    "monthcust": "Day25",
                    "numcust": 364
                },
                {
                    "monthcust": "Day26",
                    "numcust": 844
                },
                {
                    "monthcust": "Day27",
                    "numcust": 734
                },
                {
                    "monthcust": "Day28",
                    "numcust": 324
                },
                {
                    "monthcust": "Day29",
                    "numcust": 584
                },
                {
                    "monthcust": "Day30",
                    "numcust": 444
                }
				,
                {
                    "monthcust": "Day31",
                    "numcust": 564
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
                    "yearcust": "Jan",
                    "nmyrcust": 200
                },
                {
                    "yearcust": "feb",
                    "nmyrcust": 1882
                },
                {
                    "yearcust": "March",
                    "nmyrcust": 1809
                },
                {
                    "yearcust": "April",
                    "nmyrcust": 1322
                },
                {
                    "yearcust": "May",
                    "nmyrcust": 1122
                },
                {
                    "yearcust": "June",
                    "nmyrcust": 1114
                },
                {
                    "yearcust": "July",
                    "nmyrcust": 984
                },
                {
                    "yearcust": "Aug",
                    "nmyrcust": 711
                },
                {
                    "yearcust": "Sept",
                    "nmyrcust": 665
                },
                {
                    "yearcust": "oct",
                    "nmyrcust": 665
                },
                {
                    "yearcust": "Nov",
                    "nmyrcust": 665
                },
                {
                    "yearcust": "Dec",
                    "nmyrcust": 665
                }
                
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartDatacust3;
                chart.categoryField = "yearcust";
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
                graph.valueField = "nmyrcust";
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
    