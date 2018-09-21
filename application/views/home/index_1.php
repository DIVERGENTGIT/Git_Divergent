<h2>Added Credits</h2>
<div class="form">
    <form method="post">
        <div style="height: 40px;"><label>Type:</label>
            <select name="payment_type" class="selectText">
                <option value="-1">--All--</option>
                <option value="1" <?php echo $payment_type == 1 ? "selected" : ""; ?>>Credits Added</option>
                <option value="3" <?php echo $payment_type == 3 ? "selected" : ""; ?>>Credits Deducted</option>
                <?php if($ndnc_return): ?>
                    <option value="0" <?php echo $payment_type == 0 ? "selected" : ""; ?>>Returned DND Credits</option>
                <?php endif; ?>
            </select>&nbsp; <input name="Search" value="Go" class="button" type="submit">
        </div>
    </form>
    <table id="rounded-corner" summary="Added Credits">
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