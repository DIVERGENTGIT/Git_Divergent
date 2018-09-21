
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero main-right-div">
      
   <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images-new/welcome-icon.png" class="right-title-img">Profile</h3>
</div>
      <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

        <section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		
          <!-- Info boxes -->
		   <?php if(!empty($file_error)){?>
	   <div class="alert alert-warning" style="background:#ff0000 !important;color:#fff !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;top: 0px;" data-dismiss="alert">×</a>	
		 	<?php echo $file_error; ?>  	</div>
			<?php } ?>

<?php if($this->session->flashdata('success_message')){?> 
<div class="" style="color:green">  <?php echo $this->session->flashdata('success_message')?> 
</div> 
<?php } ?>
				
<section data-ng-view="" id="content" class="animate-fade-up ng-scope "  >
<div class="page page-profile ng-scope">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-8 col-sm-12 col-xs-12 padding_zero profile-page-section">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Name</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont">striker</span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">User Name</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"><?php echo isset($profile['username']) ? $profile['username'] : "--"; ?></span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">User Type</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont">

<?php 
$user_id=$this->session->userdata('user_id');
 $sql="SELECT * FROM users u WHERE u.user_id = $user_id";
$user=$this->db->query($sql)->result();
$usertype='';
foreach($user as $key => $value)
{

if($value->no_ndnc=="0")
{
$usertype="Promotional";
$usertypecol="promotional";
}
if($value->no_ndnc=="1")
{
$usertype="Transactional";
$usertypecol="transactional";
}
if($value->no_ndnc=="1" && $value->dnd_check=='1')
{
$usertype="Semi Trans";
$usertypecol="semitrans";
}


$state=$value->state_id;
$city_name=$value->city_id;
$address=$value->address1;
$zipcode=$value->zipcode;
$organization=$value->organization;
$email=$value->email;
$mobile=$value->mobile;

$username=$value->username;
$first_name=$value->first_name;
$last_name=$value->last_name;
$address1=$value->address1;
$address2=$value->address2;
}
?>
<?php echo isset($usertype) ? $usertype : "--"; ?>
</span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Organization</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"><?php echo isset($profile['organization']) ? $profile['organization'] : "--"; ?></span>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Email</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"> <?php echo isset($profile['email']) ? $profile['email'] : "--"; ?></span>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Mobile</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"> <?php echo isset($profile['mobile']) ? $profile['mobile'] : "--"; ?></span>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">OTP MobileNo</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"> <?php echo isset($profile['otpMobileNo']) ? $profile['otpMobileNo'] : "--"; ?></span>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Address</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"> <?php echo isset($profile['address1']) ? $profile['address1']." ".$profile['address2'] : "--"; ?></span>
</div>

</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
<span class="profilelable-name">Verified</span>
</div>
<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
<span class="profilerightlab-cont"> <?php if($profile['mverify'] == 1) {  echo '<p style="color:green;">verified</p>';}else{ echo '<p style="color:red;">Not verified</p>'; } ?></span>
</div>
  
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-8 col-sm-8 col-sm-offset-4 col-md-offset-4 col-xs-12 sendbtnmrgn padding_zero">
<a href="<?php echo base_url();?>myaccount/editmyprofile" class="submit_btn">Edit Profile</a>
</div>
</div>
</div>
</div>

</section> 

        </section><!-- /.content -->


    </div><!-- ./wrapper -->


    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>assets/js/pages/dashboard2.js" type="text/javascript"></script>
   

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>dist/js/demo.js" type="text/javascript"></script>
   
    <script type="text/javascript">
     $(document).ready(function(){
    
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

   
			});
    </script>
	
    <script>
	function submitFile(){
        var formUrl = "<?php echo base_url(); ?>upload.php";
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
	</script>
    
  </body>
 
</html>
