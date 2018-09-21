<h2>Create User</h2>

<table id="rounded-corner" summary="SMS Campaign's Report">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company"></th>
		 <th scope="col" class="rounded">User Name</th>
		 <th scope="col" class="rounded">First Name</th>
		 <th scope="col" class="rounded">Registered On</th>
		 <th scope="col" class="rounded">Last Login</th>
		 <th scope="col" class="rounded">Balance </th>
		 <th scope="col" class="rounded-q4">Add Balance</th>
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
		foreach($users as $user) :		 
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $user->username; ?></td>
		<td><?php echo $user->first_name; ?></td>
		<td><?php echo $user->registered_on; ?></td>
		<td><?php if($user->login_time) { echo $user->login_time; } else { echo "---"; } ?></td>
		<td align='center'><?php echo $user->available_credits; ?></td>
		<td align='center'>
			<a href="<?php echo site_url('reseller/addBalance/'.$user->user_id)?>">Add Balance</a>
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
