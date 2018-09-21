 
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero left_menu01">
<div class="col-sm-3 col-md-3 col-xs-12 menutablft padding_zero">
<nav class="navbar navbar-default custom-menu">
  <div class="container-fluid padding-zero">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>  
        <span class="icon-bar"></span>
      </button>
     
    </div>
                          
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="padding-zero collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      
 <li>
 <span class="submenuli collapsed<?php if($this->uri->segment(2)=='normalSMS' || $this->uri->segment(2)=='fileSMS'  || $this->uri->segment(2)=='newVariableSMS' || $this->uri->segment(2)=='unicodeSMS') { echo 'in leftmenutoggle';}?>" data-toggle="collapse" data-target="#smsmenuacc">
<img src="<?php echo base_url(); ?>images/sms-icon.png" class="nav-menu-icons">SMS Services</span>


	
<div class="collapse <?php if($this->uri->segment(2)=='normalSMS' || $this->uri->segment(2)=='fileSMS'  || $this->uri->segment(2)=='newVariableSMS' || $this->uri->segment(2)=='unicodeSMS') { echo 'collapse in';}?>" id="smsmenuacc">
<ul class="left-submenu"> 
      
<li><a class="<?php if($this->uri->segment(2)=='normalSMS') { echo 'activelink';}?>" href="<?php echo base_url();?>campaign/normalSMS">Normal SMS</a></li>
<li><a class="<?php if($this->uri->segment(2)=='fileSMS') { echo 'activelink';}?>" href="<?php echo base_url();?>campaign/fileSMS">File SMS</a></li> 
<li><a class="<?php if($this->uri->segment(2)=='newVariableSMS') { echo 'activelink';}?>" href="<?php echo base_url();?>campaign/newVariableSMS">Custom SMS</a></li> 
<li><a class="<?php if($this->uri->segment(2)=='unicodeSMS') { echo 'activelink';}?>" href="<?php echo base_url();?>campaign/unicodeSMS">Unicode SMS</a></li>
<!-- ADDED ON 2017-01-30
<li><a href="<?php echo base_url();?>customized/newVariableSMS">Custom</a></li>  -->
</ul>

</div>
</li>


 <li><span class="submenuli collapsed<?php if($this->uri->segment(2)=='dedicated' || $this->uri->segment(2)=='shared') { echo 'in leftmenutoggle';}?>" data-toggle="collapse" data-target="#longmenuacc">
		<img src="<?php echo base_url(); ?>images/longcode-icon.png" class="nav-menu-icons">Long Code</span>
		<div class="collapse <?php if($this->uri->segment(2)=='dedicated' || $this->uri->segment(2)=='shared') { echo 'collapse in';}?>" id="longmenuacc">
<ul class="left-submenu">       

		   <li><a class="<?php if($this->uri->segment(2)=='dedicated') { echo 'activelink';}?>" href="<?php echo base_url();?>longcode/dedicated">Dedicated Number</a></li>

		   <li><a class="<?php if($this->uri->segment(2)=='shared') { echo 'activelink';}?>" href="<?php echo base_url();?>longcode/shared">Shared Number</a></li>
	  </ul>
</div>
</li>

 <li><span class="submenuli collapsed<?php if($this->uri->segment(2)=='bulkShorturl') { echo 'in leftmenutoggle';}?>" data-toggle="collapse" data-target="#shorturlacc">
		<img src="<?php echo base_url(); ?>images/short-url-icon.png" class="nav-menu-icons">Short URL</span>
		
		<div class="collapse <?php if($this->uri->segment(2)=='bulkShorturl') { echo 'collapse in';}?>" id="shorturlacc">
<ul class="left-submenu">       

	<li><a class="<?php if($this->uri->segment(2)=='bulkShorturl') { echo 'activelink';}?>" href="<?php echo base_url();?>campaign/bulkShorturl">Generate URLs</a></li>


	  </ul>
</div>
</li>
<li>

<span class="submenuli collapsed<?php if($this->uri->segment(2)=='viewcampaigns' || $this->uri->segment(2)=='viewReport' || $this->uri->segment(2)=='apiViewReport' || $this->uri->segment(2)=='reports' || $this->uri->segment(2)=='shorturl_allreports' || $this->uri->segment(2)=='bulkurl' || $this->uri->segment(2)=='shortCodeReports'  || $this->uri->segment(2)=='shorturlReports' || $this->uri->segment(2)=='getshortcode_reports' || $this->uri->segment(2)=='viewreports') { echo 'in leftmenutoggle';}?> " data-toggle="collapse" data-target="#ftpcampaign"><img src="<?php echo base_url();?>images/reports-icon.png" class="nav-menu-icons">Service Reports</span>

			<div class="collapse <?php if($this->uri->segment(2)=='viewcampaigns'  || $this->uri->segment(2)=='viewReport' || $this->uri->segment(2)=='apiViewReport'|| $this->uri->segment(2)=='reports' || $this->uri->segment(2)=='shorturl_allreports' || $this->uri->segment(2)=='bulkurl' || $this->uri->segment(2)=='shortCodeReports' || $this->uri->segment(2)=='shorturlReports' || $this->uri->segment(2)=='getshortcode_reports' || $this->uri->segment(2)=='viewreports') { echo 'collapse in';}?>" id="ftpcampaign">
				
				<ul class="left-submenu">
<li><a class="<?php if($this->uri->segment(2)=='viewcampaigns' || $this->uri->segment(2)=='viewReport' || $this->uri->segment(2)=='apiViewReport' ) { echo 'activelink';}?>" href="<?php echo base_url();?>index.php/campaign/viewcampaigns">SMS Reports</a></li>
 <li><a class="<?php if($this->uri->segment(2)=='reports' || $this->uri->segment(2)=='viewreports' ) { echo 'activelink';}?>" href="<?php echo base_url();?>index.php/longcode/reports">LongCode Reports</a></li>
 <li><a class="<?php if($this->uri->segment(2)=='shorturl_allreports' || $this->uri->segment(2)=='bulkurl' || $this->uri->segment(2)=='shortCodeReports' || $this->uri->segment(2)=='shorturlReports' || $this->uri->segment(2)=='getshortcode_reports') { echo 'activelink';}?>" href="<?php echo base_url();?>index.php/campaign/shorturl_allreports">ShortURL Reports</a></li>
<?php if($isftpuser == 1) { ?>
<li><a class="<?php if($this->uri->segment(1)=='ftpcampaign' && $this->uri->segment(2)=='viewcampaigns') { echo 'activelink';}?>" href="<?php echo base_url();?>index.php/ftpcampaign/viewcampaigns">FTP Reports</a></li>
<?php } ?>
 				</ul>
 				  
 			</div>	        
 		</li>

        <li><a href="<?php echo base_url(); ?>index.php/api/index"><img src="<?php echo base_url();?>images/api-integration-icon.png" class="nav-menu-icons">API Integration</a></li>
      
		<li>
	<span class="submenuli collapsed<?php if($this->uri->segment(2)=='templates' || $this->uri->segment(2)=='getRecentTemplate' || ($this->uri->segment(1)=='contacts' && $this->uri->segment(2)=='index') || $this->uri->segment(2)=='sender_names' || $this->uri->segment(2)=='myUsers' || ($this->uri->segment(1)=='home' && $this->uri->segment(2)=='index')) { echo 'in leftmenutoggle';}?>" data-toggle="collapse" data-target="#managemenuacc"><img src="<?php echo base_url();?>images/manage-icon.png" class="nav-menu-icons">Manage</span>

		<div class="collapse <?php if($this->uri->segment(2)=='templates' || $this->uri->segment(2)=='getRecentTemplate' || ($this->uri->segment(1)=='contacts' && $this->uri->segment(2)=='index') || $this->uri->segment(2)=='sender_names' || $this->uri->segment(2)=='myUsers' || ($this->uri->segment(1)=='home' && $this->uri->segment(2)=='index')) { echo 'collapse in';}?>" id="managemenuacc">     
<ul class="left-submenu">
	 <li><a class="<?php if($this->uri->segment(1)=='home' && $this->uri->segment(2)=='index') { echo 'activelink';}?>" href="<?php echo base_url(); ?>home/index">Credits History</a></li>

	  <li><a class="<?php if($this->uri->segment(2)=='templates' || $this->uri->segment(2)=='getRecentTemplate') { echo 'activelink';}?>" href="<?php echo base_url(); ?>mytemplate/templates">Template</a></li>
	   <li><a class="<?php if($this->uri->segment(1)=='contacts' && $this->uri->segment(2)=='index') { echo 'activelink';}?>" href="<?php echo base_url();?>contacts/index">Groups</a></li>
	    <?php if($this->session->userdata('no_ndnc') == 1) {    ?>
	    <li><a class="<?php if($this->uri->segment(2)=='sender_names') { echo 'activelink';}?>" href="<?php echo base_url(); ?>mytemplate/sender_names">Sender ID</a></li>  
		<?php } ?>  
		 <?php if($this->session->userdata('is_reseller') == 1) { ?><li><a class="<?php if($this->uri->segment(2)=='myUsers') { echo 'activelink';}?>" href="<?php echo base_url(); ?>index.php/reseller/myUsers">Users</a></li> <?php } ?>
	  </ul>
</div>
		</li>
		<li><span class="submenuli collapsed<?php if($this->uri->segment(2)=='packages' || ($this->uri->segment(1)=='products' && $this->uri->segment(2)=='index') || $this->uri->segment(2)=='order_history' || $this->uri->segment(2)=='order_details' || $this->uri->segment(2)=='shoppingCartView') { echo 'in leftmenutoggle';}?> " data-toggle="collapse" data-target="#paymentmenuacc"><img src="<?php echo base_url();?>images/payments-icon.png" class="nav-menu-icons">Payments</span>
		<div class="collapse <?php if($this->uri->segment(2)=='packages' || ($this->uri->segment(1)=='products' && $this->uri->segment(2)=='index') || $this->uri->segment(2)=='order_history' || $this->uri->segment(2)=='order_details' || $this->uri->segment(2)=='shoppingCartView') { echo 'collapse in';}?>" id="paymentmenuacc">
<ul class="left-submenu">
<li><a class="<?php if($this->uri->segment(1)=='longcode' || $this->uri->segment(2)=='packages') { echo 'activelink';}?>" href="<?php echo base_url(); ?>longcode/packages">Longcode Package</a></li>  

<li><a class="<?php if($this->uri->segment(1)=='products' || $this->uri->segment(2)=='shoppingCartView') { echo 'activelink';}?>" href="<?php echo base_url(); ?>products/index">My Order</a></li>

<!-- <li><a href="<?php echo base_url(); ?>index.php/myaccount/payments">Balance History</a></li> -->
<li><a class="<?php if($this->uri->segment(2)=='order_history' || $this->uri->segment(2)=='order_details' ) { echo 'activelink';}?>" href="<?php echo base_url(); ?>payment/order_history">Payment History</a></li>
</ul>
</div>  
</li>
  
	<li><span class="submenuli collapsed<?php if($this->uri->segment(2)=='add_credits' || $this->uri->segment(2)=='addShorturlCredits') { echo 'in leftmenutoggle';}?>" data-toggle="collapse" data-target="#balncemenuacc"><img src="<?php echo base_url();?>images/credits-icon.png" class="nav-menu-icons">Add Credits</span>
		<div class="collapse <?php if($this->uri->segment(2)=='add_credits' || $this->uri->segment(2)=='addShorturlCredits') { echo 'collapse in';}?>" id="balncemenuacc">
<ul class="left-submenu">
  <li><a class="<?php if($this->uri->segment(1)=='payment' && $this->uri->segment(2)=='add_credits') { echo 'activelink';}?>" href="<?php echo base_url(); ?>index.php/payment/add_credits">SMS Credits</a></li>
 
  <li><a class="<?php if($this->uri->segment(1)=='longcode' && $this->uri->segment(2)=='add_credits') { echo 'activelink';}?>" href="<?php echo base_url(); ?>longcode/add_credits">LongCode Credits</a></li>
  <li><a class="<?php if($this->uri->segment(1)=='campaign' && $this->uri->segment(2)=='addShorturlCredits') { echo 'activelink';}?>" href="<?php echo base_url(); ?>campaign/addShorturlCredits">ShortURL Credits </a></li>
 
</ul>
</div> 
</li>	
		   
			    
		 
		<!-- ADDED ON 2017-02-13 
		<li><a href="<?php echo base_url(); ?>campaign/bulkShorturl"><img src="<?php echo base_url();?>images/longcode-icon.png" class="nav-menu-icons">Bulk Shorturl</a></li> 
<li><a href="<?php echo base_url(); ?>campaign/shorturlReports"><img src="<?php echo base_url();?>images/reports-icon.png" class="nav-menu-icons">Bulk Shorturl Reports</a></li>
		  -->  
 
		<!-- <li><a href="<?php echo base_url(); ?>analysis/index"><img src="<?php echo base_url();?>images/analytics-icon.png" class="nav-menu-icons">Analytics</a></li> 

		<li><a href="<?php echo base_url(); ?>campaign/myLongcodePackage"><img src="<?php echo base_url();?>images/analytics-icon.png" class="nav-menu-icons">My Longcode Package</a></li>
<li><a href="<?php echo base_url(); ?>campaign/addShorturlCredits"><img src="<?php echo base_url();?>images/analytics-icon.png" class="nav-menu-icons">Add Shorturl Credits</a></li>-->  
			     
       </ul>    
    
    </div>  
  </div>
</nav>     




      </div>
     
	  
