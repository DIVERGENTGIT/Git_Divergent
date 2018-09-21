<!--This page css Start -->
<link href="<?php echo base_url();?>assets/css/lib/new-css.css" rel="stylesheet" type="text/css">
<!--This page css End --> 
<body>
<div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
<div class="content-wrapper">
<div class="col-sm-12 col-md-12 col-xs-12">
 <h3 class="panel-heading">
 <strong> <span class="glyphicon glyphicon-th"></span> Long Code - Received SMS</strong>
 </h3>
<div class="content_bg01">
<div class="col-sm-12 col-md-12 col-xs-12">
<div id="basicExample">
<form class="recive_sms_dtpik">
   <label>From Date:</label> <input type="text" class="date start" name="" />
  <label>From Date:</label> <input type="text" class="date end" name="" />
     <input type="submit" class="" name="" value="Go"/>
     </form>
</div>
<div class="code_div">
   <div class="col-sm-6">
    <a href="#" class="chage_code_bt">change Code</a>
     </div>
     <div class="col-sm-6">
      <a href="#" class="export_exel_bt">Export To Excel</a>
     </div>
</div>

     <table class="table_recive">
     <thead>
      <tr>
        <th>S.No.</th>
         <th>On Date</th>
          <th>To</th>
          <th>From</th>
           <th>SMS Text</th>
        </tr>
     </thead>
        <tbody>
         <tr>
        <td>1</td>
         <td>10-9-2015</td>
          <td>9246222290</td>
          <td>8008302211</td>
           <td>Hi how are you</td>
        </tr>
         <tr>
        <td>2</td>
         <td>11-9-2015</td>
         <td>9246222290</td>
          <td>8008302211</td>
           <td>Hi how are you</td>
        </tr>
         <tr>
        <td>3</td>
         <td>11-9-2015</td>
         <td>9246222290</td>
          <td>8008302211</td>
           <td>Hi how are you</td>
        </tr>
        </tbody>
        </table>   
</div>
</div>
</div>
      <div class='control-sidebar-bg'></div> 

    </div><!-- ./wrapper -->


<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
<!--This page js Start -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lib/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lib/jquery.timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lib/datepair.js"></script>
<script>
    // initialize input widgets first
    $('#basicExample .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });

    $('#basicExample .date').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
    });

    // initialize datepair
    var basicExampleEl = document.getElementById('basicExample');
    var datepair = new Datepair(basicExampleEl);
</script>
<!--This page js End -->            
 
  </body>
</html>
