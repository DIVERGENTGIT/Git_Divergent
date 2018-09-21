
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
     
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
   
        

        <!-- Main content -->
        <section class="" >
          <!-- title row -->
          <div class="">
          
            <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
			<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/sms-icon.png" class="right-title-img">Added Credits</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero form">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
    <form method="post">
	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			<ul class="lable_searchtp">
			<li>Type</li>
			<li>
			<select name="payment_type" class="selectText">
                <option value="-1">--All--</option>
                <option value="1" <?php echo $payment_type == 1 ? "selected" : ""; ?>>Credits Added</option>
                <option value="3" <?php echo $payment_type == 3 ? "selected" : ""; ?>>Credits Deducted</option>
                <?php if($ndnc_return): ?>
                    <option value="0" <?php echo $payment_type == 0 ? "selected" : ""; ?>>Returned DND Credits</option>
                <?php endif; ?>
            </select>
			</li>
			<li><input name="Search" value="Go" class="submit_btn" type="submit"></li>
			</ul>
		
			
                </div>


    </form>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	<div class="table-responsive">
    <table id="rounded-corner" class="table_all" summary="Added Credits">
        <thead>
        <tr>
            <th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded">On Date</th>
            <th scope="col" class="rounded">No of SMS</th>
            <th scope="col" class="rounded">Price</th>
            <th scope="col" class="rounded">Total</th>
            <th scope="col" class="rounded-q4">Type</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="5" class="rounded-foot-left">&nbsp;</td>
            <td class="rounded-foot-right">&nbsp;</td>
        </tr>
        </tfoot>
        <tbody>
        <?php
        $count= $offset + 1;
        foreach($added_credits as $row):
            ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row->on_date; ?></td>
            <td><?php echo $row->no_of_sms; ?></td>
            <td><?php echo $row->price; ?></td>
            <td><?php echo $row->total_amount; ?></td>
            <td>
                <?php if($row->payment_type == 1): ?>
                    Credits Added
                <?php elseif($row->payment_type == 3): ?>
                    Credits Deducted
                <?php elseif($row->payment_type == 0): ?>
                    Returned DND Credits
                <?php endif; ?>
            </td>
        </tr>

            <?php
            $count++;
        endforeach;
        ?>
        </tbody>
    </table>
	</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div>
	</div>
</div>
</div>
</div>
</section></div></div></body>

 <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>