<h2>SMS Alerts</h2>
	<div class="form">	 
	<a href="<?php echo site_url('alerts/add'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Create SMS Alert</strong><span class="bt_green_r"></span></a>	 		 
	<table id="rounded-corner" summary="SMS alerts">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company"></th>
		 <th scope="col" class="rounded">Field</th>
		 <th scope="col" class="rounded">Days Before</th>
		 <th scope="col" class="rounded">On Time</th>
		 <th scope="col" class="rounded">SMS Text</th>
		 <th scope="col" class="rounded">Groups </th>
		 <th scope="col" class="rounded-q4">Actions</th>
		</tr>
	</thead>
	<tfoot>
    	<tr>
        	<td colspan="6" class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
	<tbody>
	<?php 
		$count=1;
		foreach($alerts as $alert):		 
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $alert->field_name; ?></td>
		<td><?php echo $alert->days_before; ?></td>
		<td><?php echo $alert->on_time; ?></td>
		<td><?php echo wordwrap($alert->sms_text,30,"\n",1); ?></td>
		<td> <?php echo $alert->groups; ?> </td>
		<td align='center'>
			<?php if($alert->status == 0): ?>
		 		<a href="<?php echo site_url('alerts/changeStatus/'.$alert->alert_id); ?>" title="Make Active"> Make Active </a>
		 	<?php elseif($alert->status == 1): ?>
		 		<a href="<?php echo site_url('alerts/changeStatus/'.$alert->alert_id); ?>" title="Make Active"> Make InActive </a>
		 	<?php endif;?>
		 		&nbsp; | &nbsp;<a href="<?php echo site_url('alerts/edit/'.$alert->alert_id); ?>" title="Edit">Edit</a>
		 		&nbsp; | &nbsp;<a href="<?php echo site_url('alerts/delete/'.$alert->alert_id); ?>" title="Delete">Delete</a>
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