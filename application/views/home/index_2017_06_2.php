

<style type="text/css">
.table-nonfluid {
   width: 100% !important;
   margin:0px !important;
}
.panel-heading{margin:0px;}
td.numeric {
    padding: 6px 40px !important;
}
th.numeric {
   
    padding: 6px 40px !important;
}
.form_credits span{float:left;display:inline;margin-right: 20px;}
.pagination a{ padding: 7px 11px;
    background: #fff;}
	.pagination strong{background:#08c;color:#fff;padding: 7px 11px;}
</style>

<body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
     
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
   
        

        <!-- Main content -->
        <section class="" >
          <!-- title row -->
          <div class="">
          
            <div class="col-sm-12 col-md-12 col-xs-12" style="padding: 0px !important;">
            <h2>Added Credits</h2>
<div class="form">
    <form method="post">
        <div class="form_credits" style="height: 40px;"><span><label>Type:</label></span>
            <span><select name="payment_type" class="selectText">
                <option value="-1">--All--</option>
                <option value="1" <?php echo $payment_type == 1 ? "selected" : ""; ?>>Credits Added</option>
                <option value="3" <?php echo $payment_type == 3 ? "selected" : ""; ?>>Credits Deducted</option>
                <?php if($ndnc_return): ?>
                    <option value="0" <?php echo $payment_type == 0 ? "selected" : ""; ?>>Returned DND Credits</option>
                <?php endif; ?>
            </select></span>
            <span><input name="Search" value="Go" class="btn btn-default btn-sm" type="submit"></span>
        </div>
    </form>
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
    <div align='center' class="pagination">
        <?php echo $this->pagination->create_links(); ?>
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