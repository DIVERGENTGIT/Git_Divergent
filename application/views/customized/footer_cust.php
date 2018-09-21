<?php $page = (isset($pageNo))?$pageNo: "";
	
 ?>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js" type="text/javascript"></script>	
	<?php  if($page != "edit-camp") { ?>
 <script src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/loadingoverlay_progress.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.checkAll.js"></script> 
<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
<script src="<?php echo base_url();?>assets/js/wow.min.js" type="text/javascript"></script>  
<?php } else { ?>
<script src="<?php echo  base_url(); ?>assets/js/jquery.datetimepicker.js" type="text/javascript"></script>
<script src="<?php echo  base_url(); ?>assets/js/editCustom.js" type="text/javascript"></script>

<?php 
}

if( isset($js_array) && count($js_array)>0) {
 foreach($js_array as $each){
	echo  '<script type="text/javascript" src="'.$each.'"></script>';
	
   } }
	$page = (isset($pageNo))?$pageNo: "";
 ?>  
<script type="text/javascript" >
var baseurl = "<?php echo base_url(); ?>";
var page = "<?php echo $page ?>";	
</script>  
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js">
    </script>

	<?php if( $page =="unicode"){ ?>
	<script type="text/javascript" src="http://www.google.com/jsapi"> </script>
	
    <script type="text/javascript">
    
      // Load the Google Transliteration API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      google.setOnLoadCallback(onLoad);
	  
	

    </script>
<?php } ?>
  </body>
</html>

