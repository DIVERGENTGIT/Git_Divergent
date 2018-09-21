
<div class="col-sm-12 padding_zero left_menu01">
<aside class="col-sm-2 main-sidebar padding_zero">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <ul class="sidebar-menu">
<?php if($this->session->userdata('user_id')==3222||$this->session->userdata('user_id')==3221||$this->session->userdata('user_id')==3216||$this->session->userdata('user_id')==3215): ?>
    
		<li  <?php if($this->uri->segment(1) == "api"): ?>class="treeview active "  <?php endif;?> >

             

              <ul class="treeview-menu1">

                
                  <li <?php  if($this->uri->segment(2)=="smsapi_report"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>index.php/missedcall/smsapi_report"><i class="fa fa-circle-o"></i>API Reports</a></li>
            
                
              </ul>

            </li>
            
            <li <?php if($this->uri->segment(1) =="analysis"): ?>class="treeview active " <?php endif;?>>

              <a href="<?php echo base_url();?>index.php/analysis/index">

                <i class="fa fa-laptop"></i><span>ANALYSIS</span>

               

              </a>

              <ul class="treeview-menu1">

                <li <?php  if($this->uri->segment(2)=="index"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>index.php/analysis/index"><i class="fa fa-circle-o"></i>Over View</a></li>

                <li <?php  if($this->uri->segment(2)=="creditUsage"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>index.php/analysis/creditUsage"><i class="fa fa-circle-o"></i>Credit Usage</a></li>
                
                  <li <?php  if($this->uri->segment(2)=="smsSource"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>index.php/analysis/smsSource"><i class="fa fa-circle-o"></i>SMS Source</a></li>
                  
                  
                    <li <?php  if($this->uri->segment(2)=="creditUsage"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>index.php/analysis/localProviders"><i class="fa fa-circle-o"></i>Location and Providers</a></li>

               
              </ul>

            </li>
            
            
              <li <?php  if($this->uri->segment(2)=="viewcampaigns"){ ?>class="active" <?php }?> >

              <a href="<?php echo base_url();?>index.php/campaign/viewcampaigns">

                <i class="fa fa-th"></i><span>REPORTS</span>

              </a>

            </li>
                <?php endif;?>
            
 </ul>
             
             
    

   
        </section>

        <!-- /.sidebar -->

      </aside>
      