$(document).ready(function () {
/** longcode ***/
if(page == "longcode")
{
	 // initialize input widgets first
    $('#basicExample .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });

    $('#basicExample .date').datepicker({
        'format': 'yyyy-m-d',
        'autoclose': true
    });

    // initialize datepair
    var basicExampleEl = document.getElementById('basicExample');
    var datepair = new Datepair(basicExampleEl);

	 $('#from_date').datetimepicker({
            dateFormat: 'yyyy-mm-dd'
        });

        $('#to_date').datetimepicker({
            dateFormat: 'yyyy-mm-dd'
        });
}
 /*** template in my account ***/
if(page == "temp-my")
{
	    var text_max = 0;
$('#count_message').html(text_max + '');

$('#template').keyup(function() {
	
  var text_length = $('#template').val().length;
  var text_remaining = text_max + text_length;
  var persms=text_remaining/160;
    var singlecnt=Math.ceil(persms);
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(singlecnt+ '');
});
}
/**** sender names ***/
if(page == "sender-names-my")
{
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
	 $( "#datepicker" ).datepicker();
}
/**** My Profile ***/
if(page == "my-profile")
{
	var app = angular.module("app", ["xeditable"]);

app.run(function(editableOptions) {
  editableOptions.theme = 'bs3';
});

app.controller('Ctrl', function($scope) {
  $scope.user = {
    text: 'STRIKER SOFT SOLUTIONS',
    
  };  
});

$(".chage_img01").hide();
    $(".over_flow").hover(function(){
        $(".chage_img01").toggle();
    });

var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    }
  }
);
wow.init();

}	
/*** ***/
/*** Create User ***/
if(page== "create-users")
{
	//$(":file").filestyle({input: false});
	$('#no_of_sms').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			// pin code validation
			
            $('#pincode').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			// price validation
			
            $('#price').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			
			// landline number validation
			
            $('#mobileno_org').keypress(function (evt) {
               				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			
			// mobil number validation
			
			
			
			
			
			$("#mobile").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#mobile').val().length >= 10 || $('#mobile').val().length == 10) {
            e.preventDefault();
        } });

}	
/**** My users ***/
if(page == "my-users"){
 $(":file").filestyle({input: false});
}
/**** Edit campaign ***/
if(page == "edit-camp"){
/*** Date Picker ***/
	var schDate = dateFormat($.trim($("#schDate").val()));
		 var date = new Date(
            Date.parse(
                $.trim($("#schDate").val()),
                "yyyy-mm-dd HH:MM"
            )
        );
//alert(schDate);
	$('#on_date').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM',
		//'setDate': schDate
	});
	/*** ***/
	$("#editCamp").on("click",function(){
		var campId = $.trim($("#campaign_id").val());
		var schDate = $.trim($("#on_date").val());
		var baseUrl = $.trim($("#base_url").val());
               $.post(baseUrl+"campaign/updateschedulecampaign", {campaign_id:campId, on_date:schDate},function(data){
		//return false;		
		window.location= baseUrl+"campaign/viewcampaigns";
		});
	});
	/**** ***/	
}
	
if(page == "customized-sms")
{
	 $('#colum').on("change",function(e){
			e.stopImmediatePropagation();
			var classView = "addClass";
			if($(this).hasClass(classView))
				return false;
			$(this).addClass(classView);
			 if($('#colum').val()!= "") {
			 	var colum = "#"+$(this).val()+"#";
				//alert(colum);
			 	var text = $('textarea#sms_text').val();
			 	$('#sms_text').val(text+colum);
				$(this).removeClass(classView);
			 }else 	$(this).removeClass(classView);
return false;
		 });
}	
/**** file SMS ****/
 if(page == "file-sms") { 	
   $("#loading")
	.ajaxStart(function(){
	$(this).show();
	})
	.ajaxComplete(function(){
	$(this).hide();
	});

	var options = {
	beforeSubmit:  showRequest,
	success:       showResponse,
	url:       'upload4jquery.php',  // your upload script
	dataType:  'json'
	};

	$('#userfile').change(function(){
	//document.getElementById('form_error').innerHTML = '';
	$(this).ajaxSubmit(options);
	return false;
	});
  }
/********** Normal SMS **************/
	$('.date_hide01').hide();
   	 $('#schedule').click(function () {
		//alert("form");
        if ($(this).is(":checked")) 
         {$(".normC").removeClass("hide");
	$(".normC").show();	
           // $('.date_hide01').fadeOut('slow');
         }
        else  {  $(".normC").addClass("hide");
		$(".normC").hide();	
			$('.date_hide01').fadeIn('slow');
		}
    	});
 /*** Key Down ***/
 $("#to_mobileno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 17, 86, 67, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
/*** Additional Info ***/
$('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 

/*** Set the datetime Picker ***/
$('#datetimepicker1').datetimepicker({
      language: 'en'
    });	
/*** Menu Click ***/
	$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
		
		  });
			

		hideContentDivs(); 	
/*** Toggle ***/
$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });

var text_max = 0;
$('#count_message').html(text_max + '');
$('#sms_text').keyup(function() {
  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
});

/*** Remove Duplicates ****/
$('#remove_duplictes').click(function() {
		
		if ($('#remove_duplictes').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: baseurl+"campaign/normalSmsRemoveDublicates", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr.length + " Unique Numbers out of " + to_mobileno_count.length);
		        	$('textarea#to_mobileno').val(callback_data);				    
		    	}
			});
		}
		 
	});
	
$('#recenttemp').click(function() {

if($('#recenttemp').val()!= "") {
var colum = $('#recenttemp').val();

var text = $('textarea#sms_text').val();
var s =	$('#sms_text').val(text+colum);



}
});
					 
	
	$('#numbers_count').click(function() {
		
		if ($('#numbers_count').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: baseurl+"campaign/numbersCount", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr);
		        	
		    	}
			});
		}
		 
	});
	

       
        
$('#myDelet').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myDelet').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myDelet').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myDelet').modal('hide');
});
$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });

$(document).click("click", function(e) {
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');
				
var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
	
	
		}	else
$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');		
	}
});

var maxLength = 10;
$('#to_mobileno').on('input focus keydown keyup', function() {
    var text = $(this).val();
    var lines = text.split(/(\r\n|\n|\r)/gm); 
    for (var i = 0; i < lines.length; i++) {
        if (lines[i].length > maxLength) {
            lines[i] = lines[i].substring(0, maxLength);
        }
    }
    $(this).val(lines.join(''));
});
	if(page == "reports"){
       /************* Reports *************/ 
	 $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
	// mobil number validation
			
			$('#mobile_no_').keypress(function (evt) {
                if ($('#mobile_no_').val().length >= 10 || $('#mobile_no_').val().length == 10) {
				     $('#mobile_no_').focus(); // focus to next element.
					
					 evt.preventDefault();
                }
				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
	/*** Rushyendra Is added ***/
		/*** Display the Popup ***/
		
		baseurl += '/index.php/';
		$(".resends").on("click",function(){
		var campId = $(this).data("id");
		
		var modalBody = '<div>Do You want Resend the Campaigns  <br/>';
		modalBody += '<div class="form-control pendBut"><input type="hidden" name="campId" id="campId" value="'+campId+'" >';
		modalBody += '<input type="checkbox" value="1" id="pending" name="pending"> Pending Campaigns';
		modalBody += '<input type="checkbox" value="1" id="failure" name="failure"> Failure Campaigns';
		 modalBody += '<input type="checkbox" value="1" id="allCamp" name="allCamp"> All Campaigns';
		modalBody += '<br/><span class="errorMsgPop" ></span></div>';
		/** Is Schedule ***/
		modalBody += '<br/><input type="checkbox" id="isSchdulePop"  > Do You Want to Schedule the Campaign?';
		modalBody += '<div class="additional-info add-pop hide">';
		modalBody += '<label class=" col-md-4" style="padding:0px;margin-top: 4px;">Date and time</label>';
		modalBody += '<div><div id="datetimepickerPop" class="">';
		modalBody += '<input type="text" id="on_datePop" placeholder="Schedule Date & Time" class="inputText"'; 
 modalBody += 'data-format ="yyyy-MM-dd hh:mm:ss"';
		modalBody += 'style = "height:30px; width:200px; padding: 0px 7px;margin-bottom: 0px;">';
		 modalBody += '<span class="add-on" style=" height:30px;">';
		modalBody += '<i data-time-icon="icon-time" data-date-icon="icon-calendar" ></i> </span></div></div></div>';
            /**** ***/
                
		modalBody +=  '<br/><div class="errorDatePOP"><span class="errorMsgPop" ></span> </div><input type="button" id="resendSubmit"  value="Submit"></div>';
                $("#largeModal .modal-body").html(modalBody);
		$("#largeModal .modal-title").html("Resend Campaign");
		$('#largeModal').modal('show');
		resend_sub();
			
		});
		/**** Send the Submit Rushyendra ended code  ***/
		
		//Datemask dd/mm/yyyy
        $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservationtime').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reservationtime span').html(start.format('MMMM D, YYYY') + ' / ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });

	google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Bulk SMS', 'Voice SMS'],
          ['Work',     1001],
          ['Eat',      5092],
          ['Commute',  400],
          ['Watch TV', 2000],
          ['Sleep',    789]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
	google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Bulk SMS',     345311],
          ['UniCode SMS',     234342],
          ['Voice SMS',  25434],
          ['Email', 21567],
          ['Domains',    7231]
        ]);

        var options = {
			width: 500,
			height:250,
          title: 'Year Waise Chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
	 google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
		  // not working 
        var data = google.visualization.arrayToDataTable([
			
          ['Task', 'Hours per Day'],
          ['Pending', pending],
		  ['Failed', failedReport],
          ['DND', dnds],
          ['Deliverd ',dlrd]
		  
		
		 
        ]);
		
		        var options = {
			width: 500,
			height:250,
          title: '',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d-1'));
        chart.draw(data, options);
      }
 google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
			width: 500,
			height: 250,
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }

google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');
      data.addColumn('number', 'Energy Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1, .25],
        [{v: [9, 0, 0], f: '9 am'}, 2, .5],
        [{v: [10, 0, 0], f:'10 am'}, 3, 1],
        [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
        [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
        [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
        [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
        [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
        [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
        [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
      ]);

      var options = {
		  width:500,
		    height:250,
        title: 'SMS Striker Bulk SMS Month Chart',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }

	/*** **/
	/*** Reports End Here *********/

	}

});

function CheckAll(chk)
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;
}

function UnCheckAll(chk)
{

for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
}
function isInteger(s)
        {
        var i;s = s.toString();
        for (i = 0; i < s.length; i++)
        {
        var c = s.charAt(i);
        if (isNaN(c))
        {
        alert("Given value is not a number");return false;
        }
        }return true;
        }


function DoAction(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: baseurl+"index.php/campaign/contact_list_ajax2",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajax-content-container').html(data);

                  }
				  
    });
}


function DoActionGroup(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: baseurl+"index.php/contacts/group_view_details",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajaxgroup-content-container').html(data);

                  }
				  
    });
}


function DoActionContact(id,cid)
{
	
    $.ajax({
         type: "POST",
         url: baseurl+"contact_view.php",
		  dataType: "html",
         data: {id:id,cid:cid},
		 
		         success: function(data){
                  
				      $('#ajaxcontact-content-container').html(data);

                  }
				  
    });
}
$('#menu-2 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.main-2 div').eq(tmp_div).show();
  });
function hideContentDivs(){
    $('.main-2 div').each(function(){
    $(this).hide();});
}
hideContentDivs();

$('#kk-1 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.mm-1 div').eq(tmp_div).show();
  });
hideContentDivs();

function DoAction(id)
{
	var group_ids=document.getElementsByName('group_ids[]');
	
	var group_ids_array=new Array();
	for(i=0,j=0; i<group_ids.length; i++)
	{
		if(group_ids[i].checked)
		{
			group_ids_array[j]=group_ids[i].value;
			j++;
	   }
    }
    group_ids=group_ids_array.join();
	//alert(group_ids);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{ //alert(xmlhttp.readyState);
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//alert('hi')
		
		document.getElementById("contact_list").innerHTML=xmlhttp.responseText;
		}
				document.getElementById("contact_list").innerHTML=xmlhttp.responseText;

		}
		

		xmlhttp.open("POST",baseurl+"index.php/campaign/contact_list_ajax2?group_ids="+group_ids,true);
		xmlhttp.send();
}
 $(document).click(function(e){
		$('#checkall').on('click',function(){
        if(this.checked){
            $('.check_all input').each(function(){
                this.checked = true;
            });
        }else{
             $('.check_all input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.check_all input').on('click',function(){
        if($('.check_all input:checked').length == $('.check_all input').length){
            $('#checkall').prop('checked',true);
        }else{
            $('#checkall').prop('checked',false);
        }
    });
	
	
	// 3
	$('.group_select').on('click',function(){
        if(this.checked){
            $('.grp_check input').each(function(){
                this.checked = true;
            });
        }else{
             $('.grp_check input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.grp_check input').on('click',function(){
        if($('.grp_check input:checked').length == $('.grp_check input').length){
            $('.group_select').prop('checked',true);
        }else{
            $('.group_select').prop('checked',false);
        }
    });
	
	// data insert
	  
	var checkboxes = $("#sectionC input[type='checkbox']");

checkboxes.on('change', function() {
    $('.append_data .form-control').val(
        checkboxes.filter('.checkboxstyle:checked').map(function(item) {
            return this.value;
        }).get().join('\n')
     );
}); 
  
    
});

		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}

/***** Reports ****/

/***
 @name isCheck
 @author Rushyendra	
*/
function isCheck(id)
		{
			var isPending = 0;
				if($(id).is(":checked"))
					isPending =1;
			return isPending;
		}
/*** 
@name resend_sun
@author Rushyendra **/	
function resend_sub(){
showPicker();
			/*** Submit the Resend ****/
			$("#resendSubmit").on("click", function(){
		 		var isPending = isCheck("#pending");
				var isFail = isCheck("#failure");
				var campId = $.trim($("#campId").val());
				var isAllCamp = isCheck("#allCamp");
				var schDate = $.trim($("#on_datePop").val());
				var isSchedule = isCheck("#isSchdulePop");
				var schTime = getTimeStamp($("#on_datePop").val());
				var currentdate = new Date();
				

				if(isPending ==0 && isFail ==0 && isAllCamp == 0)
					{ $(".pendBut .errorMsgPop").html("Please Select any one option"); return false;}
				if(isSchedule ==1 && schDate == "")
				{ $(".errorDatePOP .errorMsgPop").html("Please Select the Schedule Date");  return false;}
				else if( schDate != "" &&  schTime < currentdate)
				{ $(".errorDatePOP .errorMsgPop").html("Please Select the Schedule Date less than the current date");  return false; }	
				$.post(baseurl+"campaign/resendCamp/",{camp_id: campId, is_fail: isFail, is_pending :isPending, is_all_camp:isAllCamp,is_schedule:isSchedule,sch_date:schDate},function(data) {  var dataRow = data;  var error = data.error; if(!error) window.location.href=baseurl+"campaign/viewcampaigns"; else { $(".errorDatePOP .errorMsgPop").html(data.msg); return false;}
},'json');				
				
				
			});

		/*** Show the Date Picker ***/
		$("#isSchdulePop").on("click",function(){
			if($(this).is(":checked"))
			{
				$(".add-pop").removeClass("hide");
				showPicker();
			}
			else{
				$(".add-pop").addClass("hide");
                        }
		});
		}
	function showPicker(){
	 $('#on_datePop').datetimepicker({
     
	dateFormat:"yyyy-MM-dd hh:mm"
    });
	/*$('#datetimepickerPop').datetimepicker({
      dateFormat: 'yyyy-mm-dd HH:MM',
    });*/	

	}
	
	function getTimeStamp(givenDate)
	{
		var resultArray = givenDate.split(" ");
	var dateStr = '';
	var timeStr = '';
	var result = '';
	var year =mon= day = '';
	var dateAry = [];
	if(typeof(resultArray[0]) != "undefined")
		dateStr = resultArray[0];
	if(dateStr != "")
	{
		dateAry = dateStr.split("-")
		if(typeof(dateAry[0]) != "undefined")
			year = dateAry[0];
		if(typeof(dateAry[1]) != "undefined")
			mon = dateAry[1];
		if(typeof(dateAry[2]) != "undefined")
			day = dateAry[2];
	}	
	if(typeof(resultArray[1]) != "undefined")
		timeStr = resultArray[0];
	var h = m=s =0;
	var timeAry = [];
	if(timeStr != "")
	{
		timeAry = timeStr.split(":")
		if(typeof(timeAry[0]) != "undefined")
			h = timeAry[0];
		if(typeof(timeAry[1]) != "undefined")
			m = timeAry[1];
		if(typeof(timeAry[2]) != "undefined")
			s = timeAry[2];
	}
	var test = new Date(year,mon,day,h,m,s);
	return test;
	}

// Handler for STATE_CHANGED event which makes sure checkbox status
      // reflects the transliteration enabled or disabled status.
      function transliterateStateChangeHandler(e) {
        document.getElementById('checkboxId').checked = e.transliterationEnabled;
      }

      // Handler for checkbox's click event.  Calls toggleTransliteration to toggle
      // the transliteration state.
      function checkboxClickHandler() {
		  
        transliterationControl.toggleTransliteration();
      }

      // Handler for dropdown option change event.  Calls setLanguagePair to
      // set the new language.
      function languageChangeHandler() {
        var dropdown = document.getElementById('languageDropDown');
        transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
      }

      // SERVER_UNREACHABLE event handler which displays the error message.
      function serverUnreachableHandler(e) {
        document.getElementById("errorDiv").innerHTML =
            "Transliteration Server unreachable";
      }

      // SERVER_UNREACHABLE event handler which clears the error message.
      function serverReachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "";
      }
  function charcount()
	  {
	     var msg=document.unicodesmsform.sms_text.value;
		 document.getElementById("charactercount").innerHTML=msg.length;
		 document.unicodesmsform.char_count.value=msg.length;
	  }
function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['te','ar','hi','kn','ml','ta'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        // Create an instance on TransliterationControl with the required
        // options.
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = [ "transl1", "sms_text" ];
        transliterationControl.makeTransliteratable(ids);

        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);

        // Add the SERVER_UNREACHABLE event handler to display an error message
        // if unable to reach the server.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
            serverUnreachableHandler);

        // Add the SERVER_REACHABLE event handler to remove the error message
        // once the server becomes reachable.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,
            serverReachableHandler);

        // Set the checkbox to the correct state.
        document.getElementById('checkboxId').checked =
          transliterationControl.isTransliterationEnabled();

        // Populate the language dropdown
        var destinationLanguage =
          transliterationControl.getLanguagePair().destinationLanguage;
        var languageSelect = document.getElementById('languageDropDown');
        var supportedDestinationLanguages =
          google.elements.transliteration.getDestinationLanguages(
            google.elements.transliteration.LanguageCode.ENGLISH);
        for (var lang in supportedDestinationLanguages) {
          var opt = document.createElement('option');
          opt.text = lang;
          opt.value = supportedDestinationLanguages[lang];
          if (destinationLanguage == opt.value) {
            opt.selected = true;
          }
          try {
            languageSelect.add(opt, null);
          } catch (ex) {
            languageSelect.add(opt);
          }
        }
      }

function showRequest(formData, jqForm, options) {
	var fileToUploadValue = $('input[@name=userfile]').fieldValue();
	if (!fileToUploadValue[0]) {
	document.getElementById('form_error').innerHTML = 'Please select a file.';
	return false;
	} 

	return true;
	} 

	function showResponse(data, statusText)  {
	if (statusText == 'success') {
	if (data.img != '') {
	document.getElementById('form_error').innerHTML = '<img src="/upload/thumb/'+data.img+'" />';
	document.getElementById('form_error').innerHTML = data.error;
	} else {
	document.getElementById('form_error').innerHTML = data.error;
	}
	} else {
	document.getElementById('form_error').innerHTML = 'Unknown error!';
	}
	} 

function  dateFormat(givenDate)
{
	var resultArray = givenDate.split(" ");
	var dateStr = '';
	var timeStr = '';
	var result = '';
	if(typeof(resultArray[0]) != "undefined")
		dateStr = resultArray[0];
	if(typeof(resultArray[1]) != "undefined")
		timeStr = resultArray[0];
	var h = m=s =0;
	var timeAry = [];
	if(timeStr != "")
	{
		timeAry = timeStr.split(":")
		if(typeof(timeAry[0]) != "undefined")
			h = timeAry[0];
		if(typeof(timeAry[1]) != "undefined")
			m = timeAry[1];
		if(typeof(timeAry[2]) != "undefined")
			s = timeAry[2];
	}
	return dateStr+ " " +h+":"+m;
}

function submitFile(){
        var formUrl = baseurl+"upload.php";
        var formData = new FormData($('.myForm')[0]);

        $.ajax({
                url: formUrl,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
				dataType: "html",
                cache: false,
                processData: false,
                success: function(data, textSatus, jqXHR){
                         $("#targetLayer").html(data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                        //handle here error returned
                }
        });
}

function fun_passwrod_chk()
{
	
	var txt_password_sales = $("#txt_password_sales").val();
	txt_password_sales=txt_password_sales.trim();
	var longcode_id_pop=$('#txt_code_id').val();
		//alert(longcode_id_pop);
	if(!txt_password_sales=='')
	{
		var data ={passcode:txt_password_sales,longcode_id_pop:longcode_id_pop};
		$.ajax({
				url: baseurl+"longcode/pageAuthenticate.html",
				type: "POST",
				data: data,
				//data: {'passcode': '1'},
				cache: false,
				success: function (callback_data) 
				{
					
					if(callback_data=='1')
					{
						refresh_url=baseurl+'longcode/index.html';
						//alert(refresh_url);
						window.location.href=refresh_url;
						
					}
					else
					{
						//alert("error");
						$( "#txt_password_sales" ).focus();
						$('#div_pass').removeClass('form-group');
						$('#div_pass').addClass('form-group has-error');
						
						$('#div_pass_err').removeClass('form-group');
						$('#div_pass_err').addClass('form-group has-error');
						//$('error').addClass('form-group has-error label');
						
						$("#error").show();
					}
					//$('#dnd_chk_number_result').html(callback_data);
				}
		});
	}
	else
	{
		$( "#txt_password_sales" ).focus();
		$('#div_pass').removeClass('form-group');
		$('#div_pass').addClass('form-group has-error');
	}
}


function fun_open_modal(user_id,code_id)
{
	
	$('#txt_code_id').val(code_id);
	$('#txt_user_id_generate').val(user_id);
$('#txt_password_sales').val('');
	
	$("#error").hide();
	$('#div_pass').removeClass('form-group has-error');
	$('#div_pass').addClass('form-group');
	$('#myModal').modal('show');
}




function validateForm_new()
{
    if($("input#sale_id:checked").length == 0)
    {
        return false;
    }
    else
    {
		return true;
	}
}


    function showInvoice(invoice_id)
    {
        myRef = window.open(baseurl+'/striker_clients/show_invoice/'+invoice_id, 'invoice', 'width=800,height=400,scrollbars=yes,location=no');
        myRef.focus();
    }


