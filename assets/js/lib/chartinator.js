

; (function ($, window, document, Math, undefined ) {

    'use strict';

    var chartinator = function (el, options) {

        // The chartinator object
        var o = this;

        // Define table and chart elements
        o.chartS = $(el);
        o.tableS = o.chartS;

        // Define fonts
        o.fontFamily = $('body').css('font-family').replace(/["']{1}/gi, "") || 'Arial, Helvetica, sans-serif';

        // Initialize option defaults ------------------------------------------------------------
        o.optionsInit = {

            // The path to the Google AJAX API
            urlJSAPI: 'https://www.google.com/jsapi',

            // The Google Sheet key
            // The id code of the Google sheet taken from the public url of your Google Sheet
            // Default: false
            googleSheetKey: false,

            // The data columns js array
            // An array of object literals that define each column
            // Default: false
            columns: false,

            // Column indexes array - An array of column indexes defining where
            // the data will be inserted into any existing data extracted from an HTML table or Google Sheet
            // Default: false - js data array columns replace any existing columns
            // Note: when inserting more than one column be sure to increment index number
            // to account for previously inserted indexes
            colIndexes: false,

            // Rows - The rows data-array
            // If colIndexes array has values the row data will be inserted into the columns
            // defined in the colindexes array. Otherwise the row data will be appended
            // to any existing row data extracted from an HTML table or Google Sheet
            // Default: false
            rows: false,

            // The jQuery selector of the HTML table element to extract the data from.
            // Default: false - Checks if the element this plugin is applied to is an HTML table
            tableSel: false,

            // The data title
            // A title used to identify the set of data
            // Used as a caption when generating an HTML table
            dataTitle: false,

            // Create Table - String
            // Create a basic HTML table or a Google Table Chart from chart data
            // Options: false, 'basic-table', 'table-chart'
            // Note: This table will replace an existing HTML table
            createTable: false,

            // Ignore row indexes array - An array of row index numbers to ignore
            // Default: []
            // Note: Only works on data extracted from HTML tables or Google Sheets
            // The headings row is index 0
            ignoreRow: [],

            // Ignore column indexes array
            // An array of column indexes to ignore in the HTML table or Google Sheet
            // Default: []
            // Note: Only works on data extracted from HTML tables or Google Sheets
            ignoreCol: [],

            // Transpose data Boolean - swap columns and rows
            // Default: false
            // Note: Only works on data extracted from HTML tables or Google Sheets
            transpose: false,

            // The tooltip concatenation - Defines a string for concatenating a custom tooltip.
            // Keywords: 'domain', 'data', 'label' - these will be replaced with current values
            // 'domain': the primary axis value, 'data': the data value, 'label': the column title
            // Default: false - use Google Charts tooltip defaults
            // Note: Only works when extracting data from HTML tables or Google Sheets
            // Not supported on pie, calendar charts
            tooltipConcat: false,

            // The annotation concatenation - Defines a string for concatenating a custom annotation.
            // Keywords: 'domain', 'data', 'label' - these will be replaced with current values
            // 'domain': the primary axis value, 'data': the data value, 'label': the column title
            // Default: false - use Google Charts annotation defaults
            // Note: Only works when extracting data from HTML tables or Google Sheets.
            // Not supported on pie, geo, calendar charts
            annotationConcat: false,

            // The chart type - String
            // Derived from the Google Charts visualization class name
            // Default: 'BarChart'
            // Use TitleCase names. eg. BarChart, PieChart, ColumnChart, Calendar, GeoChart, Table.
            // See Google Charts Gallery for a complete list of Chart types
            // https://developers.google.com/chart/interactive/docs/gallery
            chartType: 'BarChart',

            // Chart Id - The id applied to the chart container element as an id and a class
            // This is overridden if the chart element has an id or is user defined
            chartId: 'c24_chart_' + Math.random().toString(36).substr(2, 9),

            // The class to apply to the chart container element
            chartClass: 'chtr-chart',

            // Table Id - The id applied to the table element as an id and a class
            // This is overridden if the table element has an id or is user defined
            tableId: 'c24_table_' + Math.random().toString(36).substr(2, 9),

            // The class to apply to the table element
            tableClass: 'chtr-table',

            // The chart aspect ratio custom option - width/height
            // Used to calculate the chart dimensions relative to the width or height
            // this is overridden if the Google Chart's height and width options have values
            // Default: false - not used
            chartAspectRatio: false,

            // The chart zoom factor - number
            // A scaling factor for the chart - uses CSS3 transform
            // To prevent tooltips from displaying off canvas while zooming, set tooltip.isHtml: true
            // Default: 0
            chartZoom: 0,

            // The chart offset - Array of numbers
            // An array of x and y offset percentage values
            // Used to offset the chart by percentages of the height and width - uses CSS3 transform
            // To prevent tooltips from displaying off canvas while offsetting, set tooltip.isHtml: true
            // Default: false
            chartOffset: false,

            // The chart event objects array
            // An array of objects containing Google Chart event types and handlers
            // Each object must contain an 'event' and a 'handler' name value pair
            // Example: [{ 'event': 'select', 'handler': function (e) { ... }}]
            // Default: false
            chartEvents: false,

            // Google Bar Chart Default Options
            barChart: {

                // The font size in pixels - Number
                // Or use css selectors as keywords to assign font sizes from the page
                // For example: 'body'
                // Default: false - Use Google Charts defaults
                fontSize: false,

                // the chart font-family
                fontName: o.fontFamily,

                chartArea: { left: '20%', top: 40, width: '75%', height: '85%' },

                legend: { position: 'bottom' }
            },

            // Google Pie Chart Default Options
            pieChart: {

                // The font size in pixels - Number
                // Or use css selectors as keywords to assign font sizes from the page
                // For example: 'body'
                // Default: false - Use Google Charts defaults
                fontSize: false,

                // the chart font-family
                fontName: o.fontFamily,

                chartArea: { left: '6%', top: 40, width: '94%', height: '100%' }
            },

            // Google Column Chart Default Options
            columnChart: {

                // The font size in pixels - Number
                // Or use css selectors as keywords to assign font sizes from the page
                // For example: 'body'
                // Default: false - Use Google Charts defaults
                fontSize: false,

                // the chart font-family
                fontName: o.fontFamily,

                chartArea: { left: '15%', top: 40, width: '85%', height: '70%' },

                legend: { position: 'bottom' }
            },

            // Google line Chart Default Options
            lineChart: {

                // The font size in pixels - Number
                // Or use css selectors as keywords to assign font sizes from the page
                // For example: 'body'
                // Default: false - Use Google Charts defaults
                fontSize: false,

                // the chart font-family
                fontName: o.fontFamily,

                chartArea: { left: '15%', top: 40, width: '80%', height: '70%' },

                legend: { position: 'bottom' }
            },

            // Google Area Chart Default Options
            areaChart: {

                // The font size in pixels - Number
                // Or use css selectors as keywords to assign font sizes from the page
                // For example: 'body'
                // Default: false - Use Google Charts defaults
                fontSize: false,

                // the chart font-family
                fontName: o.fontFamily,

                chartArea: { left: '15%', top: 40, width: '80%', height: '70%' },

                legend: { position: 'bottom' }
            },

            // Google Geo Chart Default Options
            geoChart: {

                titleTextStyle: {
                    // Note: Support for this option has been added by Chartinator
                    // but is not supported by Google Charts for this chart type

                    // The html tag that contains the title Chartinator adds to the top of the chart
                    // This is supported by Chartinator only
                    tag: 'h3'
                }
            },

            // Google Calendar Chart Default Options
            calendar: {

                // The cell scaling factor custom option - Not a Google Chart option
                // Used to refactor the cell size in responsive designs
                // this is overridden if the calendar.cellSize option has a value
                cellScaleFactor: 0.017,

                titleTextStyle: {
                    // Note: Support for this option has been added by Chartinator
                    // but is not supported by Google Charts for this chart type

                    color: '#000',
                    fontWeight: 'bold',
                    fontName: o.fontFamily,

                    // The font size in pixels - Number
                    // Or use css selectors as keywords to assign font sizes from the page
                    // For example: 'body'
                    // Default: '' - Use Google Charts defaults
                    fontSize: ''
                },

                calendar: {
                    monthLabel: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: false,

                        fontName: o.fontFamily
                    },
                    dayOfWeekLabel: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: false,

                        fontName: o.fontFamily
                    }
                },
                tooltip: {

                    // Note: Support for this option has been added by Chartinator
                    // but is not supported by Google Charts for this chart type
                    textStyle: {
                        color: '#000',
                        fontName: o.fontFamily,
                        fontSize: 16
                    }
                }
            },

            // Google Table Chart Default Options
            table: {

                // The font-family - not a Google Charts option for this chart type
                // Chartinator option only
                // Default: the body font-family
                fontName: o.fontFamily,

                // Format a data column in a Table Chart
                formatter: {

                    // Formatter type - Options: 'none', 'BarFormat'
                    type: 'none',

                    // The index number of the column to format. Options: 0, 1, 2, etc.
                    column: 1
                },

                // Allow HTML in cells. default: false
                allowHtml: true,

                cssClassNames: {
                    headerRow: 'headerRow',
                    tableRow: 'tableRow',
                    oddTableRow: 'oddTableRow',
                    selectedTableRow: 'selectedTableRow',
                    hoverTableRow: 'hoverTableRow',
                    headerCell: 'headerCell',
                    tableCell: 'tableCell',
                    rowNumberCell: 'rowNumberCell'
                }
            },

            // Show table along with chart. String, Options: 'show', 'hide', 'remove'
            showTable: 'hide',

            // The CSS to apply to show or hide the table and chart
            showTableCSS: { 'position': 'static', 'top': 0, 'width': '' },
            hideTableCSS: { 'position': 'absolute', 'top': '-99999px', 'width': o.tableS.width() },
            showChartCSS: {  },
            hideChartCSS: { 'opacity': 0 }

        };  //  o.optionsInit close

        // The Google Chart options object
        o.chartOptions = {};

        // The Google Chart options object clone
        o.cchartOptions = {};

        // Window resize event timer function
        o.timer = false;

        // Chart Id - The id to apply to the chart container element
        o.chartId = o.optionsInit.chartId;

        // Table Id - The id to apply to the table element
        o.tableId = o.optionsInit.tableId;

        // The table has data boolean
        o.tableHasData = false;

        // The table caption jQuery objects
        o.tableCaption = false;

        // The table caption text
        o.tableTitle = false;

        // The Google Sheet data object - Data returned
        o.googleSheetData = false;

        // Data array - the array of collected data to send to Google Charts
        o.dataArray = [];

        // Set chartPackage - Default: corechart - The Google Chart Package to load.
        o.chartPackage = 'corechart';

        // Array of chart types included in the Google Charts corechart package
        o.coreCharts = ['BarChart','ColumnChart','PieChart','AreaChart','BubbleChart','CandlestickChart','ComboChart','Histogram', 'LineChart', 'ScatterChart', 'SteppedAreaChart'];

        // Init chart parent
        o.chartParent = false;

        // Init the window width
        o.windowWidth = false;

        // Init chart parent width
        o.chartParentWidth = false;

        //  Initiate Chart ======================================================================
        o.init = function (el, options) {

            //  Merge options
            o.options = $.extend( true, {}, o.optionsInit, options );

            // Update chartId
            o.chartId = options.chartId || o.chartS.attr('id') || o.options.chartId ;

            // Define table and chart elements --------------------------------------------------

            // Set table element
            if (o.options.tableSel) {
                o.tableS = ($(o.options.tableSel + ' td').length) ? $(o.options.tableSel) : o.tableS;
            }

            // Check table for data
            o.tableHasData = o.tableS.find('td').length;

            if (o.chartS[0] === o.tableS[0]) { // table and chart are the same element

                if (o.tableHasData) { // chart element does not exist

                    // Reset Chart id
                    o.chartId = o.options.chartId ;

                    // Insert a new chart element after the table
                    o.chartS = $( '<div id="' + o.chartId +
                        '" class="' + o.chartId + ' ' + o.options.chartClass +
                        '"></div>' ).insertAfter( o.tableS );

                } else { // table does not exist
                    o.tableS = false;
                }
            }

            // Add chart class and id
            o.chartS
                .addClass( o.chartId + ' ' + o.options.chartClass )
                .attr( 'id', o.chartId );

            // Add table class and id and get caption
            if (o.tableHasData) {

                // Update tableId
                o.tableId = options.tableId || o.tableS.attr('id') || o.options.tableId ;

                // Apply id and classes to table
                o.tableS
                    .addClass( o.tableId + ' ' + o.options.tableClass )
                    .attr( 'id', o.tableId );

                o.tableCaption = o.tableS.find( 'caption' );

            } else {

                // Update tableId
                o.tableId = o.options.tableId ;
            }

            // Get chart parent element
            o.chartParent = o.chartS.parent();

            // Get data ----------------------------------------------------------
            if ( o.options.googleSheetKey ) {

                // Get Google Sheets data
                o.getGoogleSheet( o.options.googleSheetKey, o.setupChart );
            } else {
                o.setupChart();
            }

        };  // o.init close

        // Get Google Sheet data - CSV format
        o.getGoogleSheet = function ( key, callBack ) {

            $.ajax({
                type: 'GET',
            
                dataType: 'text'
            })
                .done(function (data) {
                    o.googleSheetData = data;
                    callBack();
                })
                .fail(function (e) {
                    o.googleSheetData = e;
                    callBack();
                    // Google Sheet failed
                    console.log('Google Sheet failed');
                })
            ;
        };

        // Set the chart - get Google Chart
        o.setupChart = function ( ) {

            // Get data
            o.dataArray = o.collectData();

            if ( !o.dataArray.length ) { // No data

                // Show table remove chart
                o.showTableChart('show', 'remove');
                console.log('No data found in data array');
                return;
            }

            // Set chart package
            if ( o.coreCharts.indexOf(o.options.chartType) === -1 ) { // not a core chart

                // Get chart package from chart type
                o.chartPackage = o.options.chartType.toLowerCase();
            }

            // Construct Chart options -------------------------------------------

            // Set the Google chart options
            if ( o.options.chartOptions ) { // Use chartOptions object if it exists
                o.chartOptions = o.options.chartOptions;
            } else if (o.options[o.camelCase(o.options.chartType)]) { // Use options specific to the chart type if they exist
                o.chartOptions = o.options[o.camelCase(o.options.chartType)];
            }

            // Clone Google Chart options so we don't overwrite original values
            o.cchartOptions = $.extend( true, {}, o.chartOptions );

            // Create table -------------------------------------------------------

            // Set caption text
            o.tableTitle = o.options.dataTitle;
            if ( o.tableTitle === false ) {
                o.tableTitle = o.cchartOptions.title || 'The Chart Data';
            }

            // Create table and or set caption
            if ( o.options.createTable ) {

                var table = false;
                if( o.options.createTable === 'table-chart' ) {
                    table = $( '<div id="' + o.tableId + '" class="' + o.tableId + ' ' + o.options.tableClass + '"></div>');
                } else {
                    table = o.generateTable( o.dataArray, o.tableTitle, o.tableId, o.options.tableClass );
                }

                if ( o.tableHasData ) {
                    o.tableS.replaceWith( table );
                } else {
                    o.tableS = table.insertBefore( o.chartS );
                }

            } else if ( o.tableHasData && o.tableTitle ) {
                if ( o.tableCaption.length ) {
                    o.tableCaption.text( o.tableTitle );
                } else {
                    o.tableS.prepend( '<caption>' + o.tableTitle + '</caption>' );
                    o.tableCaption = o.tableS.find( 'caption' );
                }
            }

            // Load Google Chart --------------------------------------------------

            // Hide chart and HTML table
            o.showTableChart('hide', 'hide');

            try {

                $.ajax({
                    url: o.options.urlJSAPI,
                    dataType: 'script',
                    cache: true
                })
                    .done(function () {

                        // Create and draw Chart
                        google.load('visualization', '1', {
                            packages: [o.chartPackage],
                            callback: o.drawChart
                        });

                        // Add Window Resize event
                        o.addResize();
                    })
                    .fail(function () {

                        // Chart failed - Show HTML table and remove chart
                        o.showTableChart('show', 'remove');
                    })
                ;
            }
            catch (e) {

                // Chart failed - Show HTML table and remove chart
                o.showTableChart('show', 'remove');
                console.log(e);
            }

        };

        // Collect data - Assemble data from the HTML table, js array and Google Sheet
        // Returns an Array of data
        o.collectData = function () {

            var dataArray = [];

            // Format Google Sheet data
            if ( o.googleSheetData && !o.googleSheetData.statusText ) {
                dataArray = o.formatSheet( o.googleSheetData );
            } else if ( o.googleSheetData ) {
                console.log(o.googleSheetData);
            }

            // Get HTML table data
            // Note: this overwrites any data extracted from A Google Sheet
            if ( o.tableHasData ) {
                dataArray = o.getTableData( o.tableS );
            }

            // Add/overwrite with js data-array columns
            if ( o.options.columns && o.options.columns.length ) {
                if (dataArray[0] && dataArray[0][0] && dataArray[0][0].label) { // header data exists
                    if ( o.options.colIndexes && o.options.colIndexes.length ) { // insert columns
                        for (var i = 0; i < o.options.colIndexes.length; i++) {
                            dataArray[0].splice(o.options.colIndexes[i], 0, o.options.columns[i]);
                        }
                    } else {
                        // Overwrite columns array as first row
                        dataArray[0] = o.options.columns;
                    }
                } else { // header data does not exists
                    // Insert columns array as first row
                    dataArray.unshift(o.options.columns);
                }
            }

            // Add js data-array rows
            if (  o.options.rows && o.options.rows.length && dataArray.length ) { // js data array exists
                if ( o.options.colIndexes && o.options.colIndexes.length ) { // colIndexes array exists
                    for (var i = 0; i < o.options.rows.length; i++) { // loop through each row in js data array
                        for (var j=0; j < o.options.colIndexes.length; j++) { // loop through colIndexes

                            // Insert new data into dataArray
                            dataArray[i+1].splice(o.options.colIndexes[j], 0, o.options.rows[i][j]);
                        }
                    }
                } else { // colIndexes array does not exist
                    // Add rows to end of dataArray
                    $.merge( dataArray, o.options.rows );
                }
            }

            return dataArray;

        };

        // Draw the chart
        o.drawChart = function ( ) {

            // Create dataTable -----------------------------------------------------------
            o.data = new google.visualization.arrayToDataTable( o.dataArray );

            if ( !o.data || !o.data.getNumberOfRows() ) { // No data

                // Show table remove chart
                o.showTableChart( 'show', 'remove' );

                console.log( 'Google Charts data table failed' );
                return;
            }

            // Format data ----------------------------------------------------------------
            if ( o.cchartOptions.formatter && o.cchartOptions.formatter.type !== 'none' ) {
                var formatter = new google.visualization[o.cchartOptions.formatter.type](o.cchartOptions.formatter);
                formatter.format( o.data, o.cchartOptions.formatter.column ); // Apply formatter to column
            }

            // Adjust options -------------------------------------------------------------

            // Set chart Title
            if ( o.tableHasData && typeof o.cchartOptions.title === 'undefined' ) { // table exists and title is undefined
                o.cchartOptions.title = o.tableCaption.text() || '';
            } else { // table does not exist or title is defined
                o.cchartOptions.title = o.cchartOptions.title || '';
            }

            // Set the Calendar cell size if a calendar chart
            if ( o.options.chartType === 'Calendar' ) {
                o.cchartOptions.calendar.cellSize = o.cchartOptions.calendar.cellSize || o.chartS.width() * o.cchartOptions.cellScaleFactor;
            }

            // Set font sizes
            if ( o.cchartOptions.fontSize ) {
                o.cchartOptions.fontSize = o.getFontSize(o.cchartOptions.fontSize, 16);
            }
            if ( o.cchartOptions.titleTextStyle && o.cchartOptions.titleTextStyle.fontSize ) {
                o.cchartOptions.titleTextStyle.fontSize = o.getFontSize(o.cchartOptions.titleTextStyle.fontSize, 20);
            }
            if ( o.cchartOptions.calendar ) {
                if ( o.cchartOptions.calendar.monthLabel && o.cchartOptions.calendar.monthLabel.fontSize ) {
                    o.cchartOptions.calendar.monthLabel.fontSize = o.getFontSize( o.cchartOptions.calendar.monthLabel.fontSize, 16 );
                }
                if ( o.cchartOptions.calendar.dayOfWeekLabel && o.cchartOptions.calendar.dayOfWeekLabel.fontSize ) {
                    o.cchartOptions.calendar.dayOfWeekLabel.fontSize = o.getFontSize(o.cchartOptions.calendar.dayOfWeekLabel.fontSize, 16);
                }
            }

            // Set Chart dimensions
            o.setDimensions();

            // Revise Chart Options -------------------------------------------------------------
            if ( o.options.chartType === 'BarChart' && !o.options.chartAspectRatio && !o.chartOptions.height) { // Height not set

                var fontSize = o.cchartOptions.fontSize || o.getFontSize('body', 16);
                // Define height based on font size and number of rows
                o.cchartOptions.height = fontSize * 2 * o.data.getNumberOfRows();
            }

            // Create Table Chart
            if ( o.options.createTable === 'table-chart') {
                o.tableS = $( '#' + o.tableId ).chartinator( {
                    columns: o.dataArray[0],
                    rows: o.dataArray.slice(1),
                    chartType: 'Table',
                    chartId: o.options.tableId,
                    chartClass: o.options.tableClass,
                    table: {
                        title: o.options.dataTitle
                    }
                } );
            }

            // Apply Chartinator tooltip styles
            if ( o.options.chartType === 'Calendar') {

                // Get any previously applied styles
                var $styles = $( '.tooltip-calendar-styles' );

                // Append styles
                if ( !$styles.length ){
                    $styles = $( '<style class="tooltip-calendar-styles"></style>' ).appendTo( 'head' );
                }

                // Add style to adjust tooltip
                $styles.text( '.' + o.chartId +' .google-visualization-tooltip span { ' +
                    'color: ' + o.cchartOptions.tooltip.textStyle.color  + ' !important; ' +
                    'font-size: ' + o.cchartOptions.tooltip.textStyle.fontSize  + 'px !important; ' +
                    'font-family: "' + o.cchartOptions.tooltip.textStyle.fontName  + '" !important; ' +
                    '}' );
            }

            // Draw chart ----------------------------------------------------------------------

            // Create and draw the visualization.
            o.chart = new google.visualization[o.options.chartType](o.chartS.get(0));

            // Add ready event listeners
            google.visualization.events.addListener( o.chart, 'ready', function (e) {

                // Show chart
                o.showTableChart(o.options.showTable, 'show');

                // Store the window width
                o.windowWidth = $( window ).width();

                // Store the chart parent width
                o.chartParentWidth = o.chartParent.width();

                // Add title to table chart and set font-size & font-family
                if ( o.options.chartType === 'Table' ) {
                    var table = o.chartS.find( 'table' );
                    table.css( {
                        'fontSize': o.cchartOptions.fontSize,
                        'fontFamily': o.cchartOptions.fontName });

                    if ( o.cchartOptions.title ) {
                        table.prepend( '<caption>' + o.cchartOptions.title + '</caption>' );
                    }
                }

                // Add title to Geo Chart
                if ( o.options.chartType === 'GeoChart' && o.cchartOptions.title && !o.chartS.children( '.chart-title' ).length ) {
                    var title = $( '<' + o.options.geoChart.titleTextStyle.tag + ' class="chart-title">' +
                    o.cchartOptions.title +
                    '</' + o.options.geoChart.titleTextStyle.tag + '>' );
                    title.css( {
                        position: 'relative',
                        zIndex: 1,
                        backgroundColor: '#fff',
                        padding: '0 .5em'
                    });
                    o.chartS.prepend( title );
                }

                // Zoom and offset chart
                if ( o.options.chartZoom || ( o.options.chartOffset && o.options.chartOffset.length ) ) {

                    // Get any previously applied styles
                    var $styles = $('.tooltip-zoom-offset-styles');

                    // The CSS3 transform value
                    var transform = '';

                    // The chart canvas object
                    var $chartCanvas = o.chartS.children( ':last' );

                    // The top and left css values to be applied to the tooltip
                    var top = 0;
                    var left = 0;

                    // The zoom and offset values
                    var zoom = parseFloat(o.options.chartZoom) || 0;
                    var tooltipZoom = 1/zoom || 1;
                    var offsetX = parseInt(o.options.chartOffset[0]) || 0;
                    var offsetY = parseInt(o.options.chartOffset[1]) || 0;
                    offsetX = offsetX*o.chartS.width()*zoom/100;
                    offsetY = offsetY*o.chartS.height()*zoom/100;

                    // Zoom
                    if ( zoom ) {
                        transform = 'scale(' + zoom + ')';
                        top = (((o.chartS.height()*zoom) - o.chartS.height())/2)/zoom;
                        left = (((o.chartS.width()*zoom) - o.chartS.width())/2)/zoom;
                    }

                    // Offset
                    if ( offsetX || offsetY ) {
                        transform += ' translate(' + offsetX + 'px,' + offsetY + 'px)';
                        top -= offsetY;
                        left -= offsetX;
                    }

                    // Transform chart and prevent overflow
                    $chartCanvas.css( 'transform', transform );
                    o.chartS.css( 'overflow', 'hidden' );

                    // Append styles
                    if ( !$styles.length ){
                        $styles = $( '<style class="tooltip-zoom-offset-styles"></style>' ).appendTo( 'head' );
                    }

                    // Add style to Adjust tooltip
                    $styles.text( '.' + o.chartId +' .google-visualization-tooltip { ' +
                        'top: ' + top  + 'px !important; ' +
                        'left: ' + left + 'px !important; ' +
                        'transform: scale(' + tooltipZoom + ')}');
                }

                //Style calendar chart
                if ( o.options.chartType === 'Calendar' && o.cchartOptions.title ) {

                    o.chartS.find( 'text:contains("' + o.cchartOptions.title + '")' ).css({
                        fill: o.cchartOptions.titleTextStyle.color,
                        fontWeight: o.cchartOptions.titleTextStyle.fontWeight,
                        fontSize: o.cchartOptions.titleTextStyle.fontSize,
                        fontFamily: o.cchartOptions.titleTextStyle.fontName
                    });
                }
            });

            // Add error event listener
            google.visualization.events.addListener( o.chart, 'error', function (e) {
                // Show table remove chart
                o.showTableChart('show', 'remove');
                console.log(e);
            });

            // Add user defined chart events
            if ( o.options.chartEvents && o.options.chartEvents.length ) {
                for (var i=0; i<o.options.chartEvents.length; i++) {
                    var chartEvent = o.options.chartEvents[i].event;
                    var chartHandler = o.options.chartEvents[i].handler;
                    google.visualization.events.addListener( o.chart, chartEvent, chartHandler );
                }
            }

            // Draw chart
            o.chart.draw( o.data, o.cchartOptions );

        }; // o.drawChart close

        // Format Google Sheets csv data
        // Returns an array of formatted data
        o.formatSheet = function( data ) {

            // The array of data to return
            var dataArray = [];

            // Format Google Sheet csv data
            if ( data && !data.statusText ) {

                try {

                    // The array of all rows
                    var rows = data.split(/\r\n|\n/);

                    // The Array of column headings
                    var columns = [];

                    // Create cells
                    for (var i=0; i<rows.length; i++) { // Each row
                        rows[i] = rows[i].split(',');
                    }

                    if ( o.options.transpose ) {
                        rows = o.transpose(rows);
                    }

                    columns = rows[0];

                    // Get and format columns
                    for ( var i=0; i<columns.length; i++ ) {

                        if ( columns[i].toUpperCase() === 'TOOLTIP' ) {
                            columns[i] = { type: 'string', role: 'tooltip' };
                        } else if ( columns[i].toUpperCase() === 'ANNOTATION' ){
                            columns[i] = { type: 'string', role: 'annotation' };
                        } else {
                            columns[i] = { label: columns[i] };
                        }
                    }

                    // Add data to dataArray
                    dataArray = rows;
                    dataArray[0] = columns;

                    // Format data
                    dataArray = o.formatData(dataArray);
                }
                catch (e) {

                    // Formatting of sheet data failed
                    console.log(e);
                }
            }

            return dataArray;
        };

        // Get data from an HTML table
        // Accepts a jQuery html table object
        // Returns a formatted data array
        o.getTableData = function ( $tableHTML ) {

            // The data table Array - The array of column and row data extracted from the HTML table
            var dataTable = [];

            try {

                // The rows - The collection of HTML table rows
                var $rows = $tableHTML.find( 'tr' ).not( $tableHTML.find( 'tfoot tr') );

                // The array of data collected from all rows
                var rowsArr = [];

                // Add cells as objects to rowsArr
                $rows.each(function (row) {

                    rowsArr.push([]);

                    $( this ).find( 'td, th' ).each( function (col) {

                        var $cell = $( this );
                        var cellObj = {};

                        // Construct the cell object
                        if ( $cell.attr( 'data-type' ) ) {
                            cellObj.type = $cell.attr( 'data-type' );
                        }
                        if ( $cell.attr( 'data-role' ) ) {
                            cellObj.role = $cell.attr( 'data-role' );
                        }
                        cellObj.label = $cell.text();

                        // add cell object to rowsArr
                        rowsArr[row].push(cellObj);
                    });
                });

                // Transpose data
                if ( o.options.transpose ) {
                    rowsArr = o.transpose(rowsArr);
                }

                // Add columns to dataTable
                dataTable.push(rowsArr[0]);

                // Change cell data back to values - excluding headings
                for ( var i=1; i<rowsArr.length; i++ ) { // each row

                    // The Array of row data
                    var rowData = [];

                    for ( var j=0; j<rowsArr[i].length; j++ ) { // each cell

                        // Add cell to row
                        var cellData = rowsArr[i][j].label || '';
                        rowData.push( cellData );
                    }

                    // add row to dataTable
                    if ( rowData.length > 0 ) {
                        dataTable.push(rowData);
                    }
                }

                // Format data
                dataTable = o.formatData(dataTable);
            }
            catch (e) { //  Could not extract data

                console.log(e);
                return [];
            }
            return dataTable;
        };

        // Format the data - infer data types and add and remove columns
        // Returns an array of formatted data
        o.formatData = function( data ) {

            // The formatted data array - The array of reformatted data
            var formattedData = data;

            try {

                // Array of columns to remove
                var removeColArr = [];

                // Dynamic column types array - An array listing the active dynamic column types
                var dynColTypesArr = [];

                // The dynamic columns Array - An array of objects containing dynamic column metadata
                var dynColumns = [];

                // Remove ignore rows filter function
                var filterRows = function( n, i ) {
                    return (o.options.ignoreRow.indexOf(i) === -1);
                };

                // Remove ignore columns filter function
                var filterCols = function( n, i ) {
                    return (o.options.ignoreCol.indexOf(i) === -1);
                };

                // Remove dynamic columns filter function
                var filterDynamic = function( n, i ) {
                    return (removeColArr.indexOf(i) === -1);
                };

                // Get active dynamic column types
                if ( o.options.tooltipConcat ) {
                    dynColTypesArr.push('tooltip');
                }
                if ( o.options.annotationConcat ) {
                    dynColTypesArr.push('annotation');
                }

                // Remove ignored rows
                formattedData = $.grep(formattedData, filterRows);

                // Remove ignored columns
                for (var j=0; j<formattedData.length; j++) { // each row

                    // Remove columns
                    formattedData[j] = $.grep(formattedData[j], filterCols);
                }

                // If dynamic tooltip or annotation remove existing tooltip and annotation columns
                // and add dynamic columns
                if ( dynColTypesArr.length ) {

                    // The primary axis heading - used to construct dynamic tooltips and annotations
                    var domain = '';

                    // Get column indexes to remove
                    for ( var i = 0; i < formattedData[0].length; i++ ) { // each column heading

                        var role = formattedData[0][i].role || '';

                        // Add annotation and tooltip column indexes to remove to removeColArr
                        if ( role && dynColTypesArr.indexOf(role) !== -1 ) {
                            removeColArr.push(i);
                        }
                    }

                    // Remove selected annotation and tooltip columns
                    for (var j=0; j<formattedData.length; j++) { // each row

                        // Remove columns
                        formattedData[j] = $.grep(formattedData[j], filterDynamic);
                    }

                    // Add dynamic tooltip and annotation col headers
                    for (var i=0; i<formattedData[0].length; i++) { // each header col

                        var role = formattedData[ 0 ][ i ].role || '';
                        var label = formattedData[ 0 ][ i ].label || '';

                        // Get domain for use with tooltip and annotation
                        if ( role === 'domain' || i === 0 ) {
                            domain = formattedData[0][i];
                        }

                        if ( (!role || dynColTypesArr.indexOf(role) === -1) && i > 0 ) { // not a dynamic column

                            // Add dynamic column if needed
                            for (var j=0; j<dynColTypesArr.length; j++) { // each dynamic col type

                                i++;

                                // Insert the dynamic column
                                formattedData[ 0 ].splice( i, 0, { type: 'string', role: dynColTypesArr[j] });

                                // Add column metadata to dynColumns
                                dynColumns.push( { index: i, domain: domain, role: dynColTypesArr[j], label: label } );
                            }
                        }
                    }

                    // Add dynamic columns data
                    for (var i=1; i<formattedData.length; i++) { // each data row
                        for (var j=0; j<dynColumns.length; j++) { // each dynamic column

                            var dynData  = '';

                            // Get dynamic column type
                            if ( dynColumns[j].role === 'toolip' ) {
                                dynData = o.options.tooltipConcat;
                            } else if ( dynColumns[j].role === 'annotation' ) {
                                dynData = o.options.annotationConcat;
                            }

                            // Replace keywords
                            dynData = dynData.replace( new RegExp( 'domain', 'g' ), dynColumns[j].domain );
                            dynData = dynData.replace( new RegExp( 'label', 'g' ), dynColumns[j].label );
                            dynData = dynData.replace( new RegExp( 'data', 'g' ), formattedData[i][dynColumns[j].index] );

                            // Insert into formattedData
                            formattedData[ i ].splice( dynColumns[j].index, 0, dynData);

                        }
                    }
                }

                // Format row data according to data types
                for ( var i=1; i<formattedData.length; i++ ) { // each row

                    // The Array of row data
                    var rowData = [];

                    for ( var j = 0; j < formattedData[ i ].length; j++ ) { // each cell

                        // Initiate cell metadata
                        var colType = formattedData[ 0 ][ j ].type || '';
                        var colRole = formattedData[ 0 ][ j ].role || '';
                        var cellData = formattedData[ i ][ j ] || '';

                        // Format data and add to cellData array
                        if ( [ 'tooltip', 'annotation' ].indexOf( colRole ) === -1 ) { // Not a tooltip/annotation
                            if ( colType === 'date' || colType === 'datetime' ) {
                                cellData = new Date( cellData );
                            } else if ( colType === 'number' ) {
                                cellData = parseFloat( cellData );
                            } else if ( colType === 'boolean' ) {
                                var str = cellData.toLowerCase();
                                cellData = (str !== 'false' && str !== '0' && str !== 'no' && str !== '' );
                            } else if ( colType === 'timeofday' ) {
                                cellData = cellData.getTime();
                            } else if ( j !== 0 ) { // not the first column
                                if ( !isNaN( parseFloat( cellData ) ) ) {
                                    cellData = parseFloat( cellData );
                                } else if ( new Date( cellData ) !== 'Invalid Date' && !isNaN( new Date( cellData ) ) ) {
                                    cellData = new Date( cellData );
                                }
                            }
                        }

                        // Add cell to row
                        rowData.push( cellData );
                    }

                    // Replace row with formatted data
                    if (rowData.length > 0) {
                        formattedData[i] = rowData;
                    }
                }
            }
            catch (e) { //  Could not extract data

                console.log(e);
                return [];
            }
            return formattedData;
        };

        // Generate HTML table jQuery object from chart data
        // Returns a jQuery object defining the table
        o.generateTable = function ( data, tableTitle, tableId, tableClass ) {

            // The html string
            var html = '<table id="' + tableId +
                '" class="' + tableId + ' ' + tableClass +
                '"><caption>' + tableTitle + '</caption><thead><tr>';

            // Add header columns to html
            for (var i = 0; i < data[0].length; i++) {
                if ( data[0][i].role && data[0][i].role === 'tooltip' ) {
                    html += '<th>Tooltip</th>';
                } else if ( data[0][i].role && data[0][i].role === 'annotation' ) {
                    html += '<th>Annotation</th>';
                } else if ( data[0][i].label ) {
                    html += '<th>' + data[0][i].label + '</th>';
                }
            }
            html += '</tr></thead><tbody>';

            // Add rows to html
            for (var i = 1; i < data.length; i++) {
                html += '<tr>';
                for (var j = 0; j < data[i].length; j++) {
                    var align = isNaN(data[i][j]) ? 'left': 'right';
                    html += '<td align="' + align + '">' + data[i][j] + '</td>';
                }
                html += '</tr>';
            }
            html += '</tbody></table>';

            return $( html );
        };

        // Add window resize event
        o.addResize = function () {
            // Window event handlers
            $( window ).on({

                // Reset on screen resize
                'resize': function() {

                    // Adjust layout
                    clearTimeout( o.timer );
                    o.timer = setTimeout( function() {

                        // Test if width has resized - as opposed to height
                        if ( $( window ).width() !== o.windowWidth ) {

                            // Save the chart style
                            var elStyle = o.chartS.attr( 'style' );

                            // Remove js styles from chart
                            o.chartS.removeAttr( 'style' );

                            // Test if chart parent has changed width
                            if ( o.chartParent.width() !== o.chartParentWidth ) {

                                // Recalculate calculated option values ---------------------

                                // Recalculate calendar cellSize
                                if ( o.cchartOptions.calendar && !o.options.calendar.calendar.cellSize ) {
                                    o.cchartOptions.calendar.cellSize = o.chartS.width() * 0.017;
                                }

                                // Set Chart dimensions
                                o.setDimensions();

                                // Redraw chart ---------------------------------------------
                                o.chart.draw( o.data, o.cchartOptions );

                            } else { // parent has not changed width

                                // Re-apply the chart style
                                o.chartS.attr( 'style', elStyle );
                            }
                        }
                    }, 500 );
                }
            });
        };

        // Show, hide or remove chart and table
        o.showTableChart = function ( table, chart ) {    //  Values: 'show', 'hide', or 'remove'

            var tableLen = o.tableS ? o.tableS.length : false;
            var chartLen = o.chartS ? o.chartS.length : false;

            // Table
            if ( table === 'show' && tableLen ) {
                o.tableS.css( 'opacity', 0 );
                o.tableS.css( o.options.showTableCSS );
                o.tableS.fadeTo( 400, 1 );
            } else if ( table === 'hide' && tableLen ) {
                o.tableS.css( o.options.hideTableCSS );
            } else if ( table === 'remove' && tableLen ) {
                o.tableS.css( 'display', 'none' );
            }

            // Chart
            if ( chart === 'show' && chartLen ) {
                o.chartS.css( 'opacity', 0 );
                o.chartS.css( o.options.showChartCSS );
                o.chartS.fadeTo( 400, 1 );
            } else if ( chart === 'hide' && chartLen ) {
                o.chartS.css( o.options.showChartCSS );
            } else if ( chart === 'remove' && chartLen ) {
                o.chartS.css( 'display', 'none' );
            }
        };

        // Get font size function
        // Accepts selector: must be a tag or a number, dSize: the fall-back font-size in pixels - number
        // Returns an integer
        o.getFontSize = function ( selector, dSize ) {
            var fontSize = dSize || 16;
            if ( parseInt( selector, 10 ) ) {
                fontSize = parseInt( selector, 10 );
            } else if ( $( selector ).length ) {
                fontSize = parseInt( $( selector ).css( 'fontSize' ), 10 ) || fontSize;
            } else {
                var $element = $( '<' + selector + '></' + selector + '>' );
                o.chartS.append( $element );
                fontSize = parseInt( $element.css( 'fontSize' ), 10 ) || fontSize;
                $element.remove();
            }
            return fontSize;
        };

        // Transpose data array function
        // Returns the transposed array of data
        o.transpose = function (arr) {
            var tArr = new Array( arr[0].length );
            for ( var i = 0; i < arr[0].length; i++ ) {
                tArr[i] = new Array( arr.length );
                for ( var j = 0; j < arr.length; j++ ) {
                    tArr[i][j] = arr[j][i];
                }
            }
            return tArr;
        };

        // Set chart width and height values
        o.setDimensions = function () {

            var width = !isNaN( o.chartOptions.width ) ? parseFloat( o.chartOptions.width ) : false;
            var height = !isNaN( o.chartOptions.height ) ? parseFloat( o.chartOptions.height ) : false;
            var ratio = !isNaN( o.options.chartAspectRatio ) ? parseFloat( o.options.chartAspectRatio ) : false;

            // Store the chart parent width
            o.chartParentWidth = o.chartParent.width();

            // Set chart width and height
            if ( ratio ){
                if ( width && !height ){
                    o.cchartOptions.height = width / ratio;
                } else if ( !width && height ){
                    o.cchartOptions.width = height * ratio;
                } else if (!width && !height) {
                    o.cchartOptions.width = o.chartS.width();
                    o.cchartOptions.height = o.chartS.width() / ratio;
                }
            } else if (!width && !height) {
                o.cchartOptions.width = o.chartS.width();
            }
        };

        // camelCase function - converts text to camelCase
        // Returns a camelCased string
        o.camelCase = function ( str ) {
            return str.replace(/(?:^\w|[A-Z]|\b\w|\s+)/g, function(match, index) {
                if (+match === 0) return ''; // or if (/\s+/.test(match)) for white spaces
                return index === 0 ? match.toLowerCase() : match.toUpperCase();
            });
        };

        // initialize --------------------------------------------------------------------------
        o.init(el, options);
        return this;

    };  // chartinator close

    // Create the plugin ======================================================================
    $.fn.chartinator = function (options) {
        // Enable multi-element support
        return this.each(function () {
            var $el = $( this );
            if (!$el.data('chartinator')) {
                $( this ).data( 'chartinator', new chartinator( this, options ) );
            }
        });
    };
})(jQuery, window, document, Math);