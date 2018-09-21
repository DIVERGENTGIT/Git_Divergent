 var chart;
 
     var chartDatauni = [
                {
                    "Weekuni": "SunDay",
                    "visitsuni": 200
                },
                {
                    "Weekuni": "MonDay",
                    "visitsuni": 100
                },
               
                {
                    "Weekuni": "TuseDay",
                    "visitsuni": 328
                },
				 {
                    "Weekuni": "WednessDay",
                    "visitsuni": 508
                }
				,
				 {
                    "Weekuni": "ThursDay",
                    "visitsuni": 458
                }
				,
				 {
                    "Weekuni": "FriDay",
                    "visitsuni": 128
                }
				,
				 {
                    "Weekuni": "SaterDay",
                    "visitsuni": 228
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
                    "monthuni": "Day1",
                    "numuni": 200
                },
                {
                    "monthuni": "Day2",
                    "numuni": 1882
                },
                {
                    "monthuni": "Day3",
                    "numuni": 1809
                },
                {
                    "monthuni": "Day4",
                    "numuni": 1322
                },
                {
                    "monthuni": "Day5",
                    "numuni": 1122
                },
                {
                    "monthuni": "Day6",
                    "numuni": 1114
                },
                {
                    "monthuni": "Day7",
                    "numuni": 794
                },
                {
                    "monthuni": "Day8",
                    "numuni": 524
                },
                {
                    "monthuni": "Day9",
                    "numuni": 734
                },
                {
                    "monthuni": "Day10",
                    "numuni": 464
                },
                {
                    "monthuni": "Day11",
                    "numuni": 824
                },
                {
                    "monthuni": "Day12",
                    "numuni": 744
                },
                {
                    "monthuni": "Day13",
                    "numuni": 574
                },
                {
                    "monthuni": "Day14",
                    "numuni": 354
                },
                {
                    "monthuni": "Day15",
                    "numuni": 224
                },
                {
                    "monthuni": "Day16",
                    "numuni": 534
                },
                {
                    "monthuni": "Day17",
                    "numuni": 674
                },
                {
                    "monthuni": "Day18",
                    "numuni": 464
                },
                {
                    "monthuni": "Day19",
                    "numuni": 854
                },
                {
                    "monthuni": "Day20",
                    "numuni": 574
                },
                {
                    "monthuni": "Day21",
                    "numuni": 764
                },
                {
                    "monthuni": "Day22",
                    "numuni": 554
                },
                {
                    "monthuni": "Day23",
                    "numuni": 254
                },
                {
                    "monthuni": "Day24",
                    "numuni": 674
                },
                {
                    "monthuni": "Day25",
                    "numuni": 364
                },
                {
                    "monthuni": "Day26",
                    "numuni": 844
                },
                {
                    "monthuni": "Day27",
                    "numuni": 734
                },
                {
                    "monthuni": "Day28",
                    "numuni": 324
                },
                {
                    "monthuni": "Day29",
                    "numuni": 584
                },
                {
                    "monthuni": "Day30",
                    "numuni": 444
                }
				,
                {
                    "monthuni": "Day31",
                    "numuni": 564
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
                    "yearuni": "Jan",
                    "nmyruni": 200
                },
                {
                    "yearuni": "feb",
                    "nmyruni": 1882
                },
                {
                    "yearuni": "March",
                    "nmyruni": 1809
                },
                {
                    "yearuni": "April",
                    "nmyruni": 1322
                },
                {
                    "yearuni": "May",
                    "nmyruni": 1122
                },
                {
                    "yearuni": "June",
                    "nmyruni": 1114
                },
                {
                    "yearuni": "July",
                    "nmyruni": 984
                },
                {
                    "yearuni": "Aug",
                    "nmyruni": 711
                },
                {
                    "yearuni": "Sept",
                    "nmyruni": 665
                },
                {
                    "yearuni": "oct",
                    "nmyruni": 665
                },
                {
                    "yearuni": "Nov",
                    "nmyruni": 665
                },
                {
                    "yearuni": "Dec",
                    "nmyruni": 665
                }
                
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
    