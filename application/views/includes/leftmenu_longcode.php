
<div class="col-sm-12 padding_zero left_menu01">
<aside class="col-sm-2 main-sidebar padding_zero">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <ul class="sidebar-menu">
<?php if($this->session->userdata('user_id')==3958 || $this->session->userdata('user_id')==4065): ?>
    
		<li  <?php if($this->uri->segment(1) == "api"): ?>class="treeview active "  <?php endif;?> >

             

              <ul class="treeview-menu1">


                <li <?php  if($this->uri->segment(2)=="missedcall"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>missedcall/messages"><i class="fa fa-circle-o"></i>Long Code Messages</a></li>
                
                  <li <?php  if($this->uri->segment(2)=="smsapi_report"){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>missedcall/smsapi_report"><i class="fa fa-circle-o"></i>API Reports</a></li>
            
                
              </ul>

            </li>
                <?php endif;?>
            
 </ul>
             
             
    

   
        </section>

        <!-- /.sidebar -->

      </aside>
      
