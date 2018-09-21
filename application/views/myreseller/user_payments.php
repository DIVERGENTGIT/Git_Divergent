<h2>User Payments</h2>
<?php if(isset($error)) { ?>
	<div class="error_box">
		<?php echo $error?>
	</div>
<?php }else if(isset($added)) { ?>
	<div class="valid_box">
		<?php echo $added?>
	</div>
<?php } ?>
<div class="form">
<?php echo form_open('reseller/addBalance',array('name' => 'add_sms_form', 'id' => 'add_sms_form')); ?>
	<fieldset>
		<dl>
			<dt><label for="username">No. Of SMS:</label></dt>
			<dd>
				<?php echo form_input(array('name' => 'no_of_sms', 
										  'id' => 'no_of_sms', 
										  'maxlength' => 45, 
										  'value' => set_value('no_of_sms'),
										  'class' => 'inputText'
			 	));?>
				<div class="form_error"><?php echo form_error('no_of_sms'); ?></div>
			</dd>
 		</dl>
		<dl>
			<dt><label for="password">Price:</label></dt>
			<dd>
				<?php echo form_input(array('name' => 'price', 
										  'id' => 'price', 
										  'maxlength' => 45, 
										  'value' => set_value('price'),
										  'class' => 'inputText'	
			 	));?>
            	<div class="form_error"><?php echo form_error('price'); ?></div>
			</dd>
		</dl>
		<dl class="submit">
			<?php echo form_hidden('resellers_user_id',$resellers_user_id);?>
			<?php echo form_submit(array('name' => 'add_balance','value' => 'Add Balance', 'class' => 'button'));?>
		</dl>
	</fieldset>
<?php echo form_close(); ?>	
</div>

<table id="rounded-corner" summary="SMS Campaign's Report">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company">Sl.NO</th>
		 <th scope="col" class="rounded">On Date</th>
		 <th scope="col" class="rounded">No. of SMS</th>
		 <th scope="col" class="rounded">Price/SMS</th>
		 <th scope="col" class="rounded">Total Amount</th>
		</tr>
	</thead>
	<tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
	<tbody>
	<?php 
	$count=0;
	foreach($payments as $payment) :
	$count=$count+1;		 
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $payment->on_date; ?></td>
		<td><?php echo $payment->no_of_sms; ?></td>
		<td><?php echo $payment->price; ?></td>
		<td><?php echo $payment->total_amount; ?></td>				 	
	</tr>
		 
	<?php 
	endforeach;
	?>
	</tbody>
</table>
<div align='center' class="pagination">
	<?php echo $this->pagination->create_links(); ?>
</div>