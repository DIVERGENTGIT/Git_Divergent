<?php 

error_reporting(0); 
?>
<div class="col-sm-12 padding_zero left_menu01">
<aside class="col-sm-2 main-sidebar padding_zero">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <ul class="sidebar-menu">
<?php if($this->session->userdata('user_id')==4857 || $this->session->userdata('user_id')==4904): ?>
    
		<li  <?php if($this->uri->segment(1) == "ftpcampaign"): ?>class="treeview active"  <?php endif;?> >
            

              <ul class="treeview-menu1">

                <li <?php  if($this->uri->segment(2)=="viewFtpcampaigns"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>ftpcampaign/viewFtpcampaigns"><i class="fa fa-circle-o"></i>FTP REPORTS</a></li>
                
                      <li <?php  if($this->uri->segment(2)=="misreports"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>ftpcampaign/misreports"><i class="fa fa-circle-o"></i>CONSULATE REPORTS</a></li>
                

               
              </ul>

            </li>
                <?php endif;?>
            
 </ul>
             
             
    

   
        </section>

        <!-- /.sidebar -->

      </aside>
      
