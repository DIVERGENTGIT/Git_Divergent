<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SMS Striker</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="assets/css/striker.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/jquery.datetimepicker.css" type="text/css" rel="stylesheet">
    <!-- Theme style -->
    <!--<link href="sassets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />-->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/custom-css.css" rel="stylesheet" type="text/css">
<link href="assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
<link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
 <script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
});
</script>
 <script>
 $(document).ready(function(){
  $(function() {
    $( "#datepicker" ).datepicker();
  });
});
 </script>
 
 
 
  </head>
  <body>
    <div class="wrapper">
   <?php require_once('includes/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
            <?php require_once('includes/leftmenu.php');?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>SURENDER</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
		
		
		
        <section class="content">
        <div class="col-md-12 col-sm-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
			
			
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span>Sender ID</strong></div>
                
            </div>
        </div>
        
        </section>
        
      
       
	   
	   
	   
	   
	   
	   
	<section class="content" >
        <div class="col-md-12 col-sm-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl" >
            <div class="panel panel-default col-md-8 " style="margin-top:5px; padding:5px;">
              
               <table class="table table-bordered">
                    <tbody>
					<tr>
                      
                      <th class="sendee-color">S No</th>
					<th class="sendee-color">Sender Name</th>
                      <th class="sendee-color">Status</th>
					    <th class="sendee-color">Action</th>
                    </tr>
					
                    <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Approved</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span class="badge bg-green"  class="btn btn-default" data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;">Delete</span>
				 
				 </td>
				 
                    
                    </tr>
                    
                     <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Approved</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span class="badge bg-green" style="margin-left:10px;">Delete</span>
				 </td>
				 
                    
                    </tr>
                    
                    <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Approved</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span class="badge bg-green" style="margin-left:10px;">Delete</span>
				 </td>
				 
                    
                    </tr>
                   
                    <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Approved</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span class="badge bg-green" style="margin-left:10px;">Delete</span>
				 </td>
				 
                    
                    </tr>
					
					 <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Rejected</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span href="#myModal" class="badge bg-green confirm-delete" data-id=".modal" style="margin-left:10px;">Delete</span>
				 </td>
				 
                    
                    </tr>
                    
                    <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Approved</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span class="badge bg-green" style="margin-left:10px;">Delete</span>
				 </td>
				 
                    
                    </tr>
                   
                    <tr>
                     
                      <td class="sendee-td"  style="width:30px;">1</td>
                 <td class="sendee-td">Susheel 123</td>
				 <td class="sendee-td">Approved</td>
				 
				 <td class="sendee-td">
				 <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span> 
				 <span class="badge bg-green" style="margin-left:10px;">Delete</span>
				 </td>
				 
                    
                    </tr>
                
                  </tbody></table>  

				  
				   
			
      </div>
	  
	  
	   <div class="panel panel-default col-md-4 " style="margin-top:5px; padding:5px; padding-left:5px; ">
	   <h4 > Request For A Sender ID</h4>
	  
<form class="form-inline" role="form" >
  <div class="form-group">
    
    <input type="text" class="form-control" id="text" placeholder=" Enter Sender ID">&nbsp; &nbsp; &nbsp; <i class="fa fa-exclamation-triangle" style="color:#dd4b39; font-size:12px; "> &nbsp; Only Alphabets </i>
  </div>
  
  
  
</form>
	<button type="submit" class="btn btn-info"  style=" margin-top:10px;">Submit</button>				
                
           <div class="direct-chat-messages" style="margin-top:20px;">
                    <!-- Message. Default to the left -->
                  
                      
                      <span class="direct-chat-img"><i class="fa fa-exclamation-triangle" style=" color:#dd4b39; font-size:25px;" >  </i></span>
  
                      <div class="direct-chat-text" >
					  <h5 style="margin:0px !important; color:#dd4b39;">Warning</h5>
                        <p>A Sender ID Must Contain Only Alphabtical Characters. !</p>
                      </div><!-- /.direct-chat-text -->
                    </div><!-- /.direct-chat-msg -->

                 
                                
                  </div>    
                  
	  </div>
	  
        </div>
		
        
        </section>  

		
		
		
		
	   
	    <!-- Delete modal start-->
	   
	  <div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Delete</h3>
    </div>
    <div class="modal-body">
        <p>You are about to delete.</p>
        <p>Do you want to proceed?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn danger">Yes</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>
	   
	   
	   
	   
	  <!-- Edit modal start-->
	   
	   
	    <div id="Edit-Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Template</h4>
                </div>
                <div class="modal-body">
                     <div class="form-group">
                
                    <label for="" class="col-sm-3">Text </label>
                    <div class="col-sm-9">
                        <textarea name="" id="text" class="form-control" rows="4"></textarea>
                        <td> 
                        <h6  class="label label-info" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td><br>
                        <td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
                    </div>
                     
                </div>
                
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
	   
	   
	   
	  <!-- Edit modal end-->  
	   
	   
	   
	    <!-- Delete modal start-->
	   
	   
	  
        
	   
	   
	  <!-- Edit Sender ID modal end-->  
        
        
        <div id="Sender-Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Sender ID</h4>
                </div>
                <div class="modal-body">
                     <div class="form-group">
                
                    <label for="" class="col-sm-3">Edit Sender ID </label>
                    <div class="col-sm-9">
                       <input type="text"  class="form-control col-md-4" > 
                    </div>
                     
                </div>
                
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
        
      
      
   





                   
<div class="clearfix"></div>




           <!--footer starts-->     
		   <?php //require_once('includes/footer');?>


      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-waring pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

   <!-- jQuery 2.1.4 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <!-- SlimScroll 1.3.0 -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
   
    <script src="assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="assets/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script src="http://www.kptemplates.com/preview/unicorn/js/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

<!-- check box event for datepicker-->

<script type='text/javascript'>
     $(document).ready(function() {
 $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 
     });
  </script>   

    <!-- conformation-->
    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>

  

    <!-- text box text count code-->
<script type='text/javascript'>
        
        $(document).ready(function() {
        
       var text_max = 0;
$('#count_message').html(text_max + '');

$('#text').keyup(function() {
  var text_length = $('#text').val().length;
  var text_remaining = text_max + text_length;
  var persms=text_remaining/160;
    var singlecnt=Math.ceil(persms);
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(singlecnt+ '');
});
        });
        
        </script>
		
<script type='text/javascript'>	
 $(document).ready(function() {	
$('[data-toggle=tooltip]').tooltip();
	     });    
        </script>	
		
<script type='text/javascript'>	
 $('#myModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
});
        </script>		
		
</html>