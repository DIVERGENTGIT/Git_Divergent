<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready( function(){
	$('input#checkAll').click(function() {
		var checked_status = this.checked;
		$("input#contacts").each(function()
		{
			this.checked = checked_status;
		});	
	});

	$('a#bt_red').click(function(){
		var n = $("input#contacts:checked").length;
		if(n == 0) {
			alert("Please Select Contacts to Send SMS");
			return false;
		}	
		$('form#contacts_sms').submit();
	});
});
</script>

<h2>Contacts</h2>
<form name="contacts_sms" id="contacts_sms" method="post" action="<?php echo site_url('contacts/sendSMS'); ?>">
	<?php if(isset($added)): ?>
		<div class="valid_box">
		 	<?php echo $added; ?>
		</div>
	<?php elseif(isset($edited)): ?>
		<div class="valid_box">
		 	<?php echo $edited; ?>
		</div>
	<?php elseif(isset($deleted)): ?>
		<div class="error_box">
		 	<?php echo $deleted; ?>
		</div>		
	<?php endif; ?>
	<div class="form">
	 		 
	 <a href="#" class="bt_green" id="bt_red"><span class="bt_green_lft"></span><strong>Send SMS</strong><span class="bt_green_r"></span></a>
	 <a href="<?php echo site_url('contacts/addContact'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add Contact</strong><span class="bt_green_r"></span></a>	
	 <a href="<?php echo site_url('contacts/addGroup'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add Group</strong><span class="bt_green_r"></span></a>
     
     
		 
	<table id="rounded-corner" summary="SMS Campaign's Report">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company"><input type="checkbox" name="checkAll" id="checkAll"></input></th>
		 <th scope="col" class="rounded">Name</th>
		 <th scope="col" class="rounded" align="center">Mobile No</th>
		 <th scope="col" class="rounded" align="center">Gender</th>
		 <th scope="col" class="rounded">View</th>
		 <th scope="col" class="rounded">Edit </th>
		 <th scope="col" class="rounded-q4">Delete </th>
		 <!-- <th scope="col" class="rounded-q4">Download</th> -->
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
	$contacts_count=0;	
	foreach($contacts as $row):
		$contacts_count++;
	?>
	<tr>
		<td><input type="checkbox" id="contacts" name="contact_<?php echo $contacts_count; ?>" value="<?php echo $row->contact_id;?>"></input></td>
		<td><?php echo $row->name; ?></td>
		<td align="center"><?php echo $row->mobile_no; ?></td>
		<td align="center"><?php echo $row->gender ? $row->gender : "--"; ?></td>
		<td><a href="<?php echo site_url('contacts/viewContact/contact/'.$row->contact_id); ?>"><img src="<?php echo base_url(); ?>images/notice.png" alt="view" title="View" border="0" /></a></td>
		<td><a href="<?php echo site_url('contacts/editContact/contact/'.$row->contact_id); ?>"><img src="<?php echo base_url(); ?>images/user_edit.png" alt="edit" title="Edit" border="0" /></a></td>
		<td><a href="<?php echo site_url('contacts/deleteContact/contact/'.$row->contact_id); ?>"
			onClick=" return confirm('Are you sure you want to delete this contact?')"
		><img src="<?php echo base_url(); ?>images/trash.png" alt="delete" title="Delete" border="0" /></a></td>
	</tr>
		 
	<?php 
	endforeach;
	?>
	</tbody>
	</table>
	<input type="hidden" name="group" value="<?php echo $group_id; ?>"></input>
	<input type="hidden" name="contacts_count" value="<?php echo $contacts_count; ?>"></input>

    <a href="#" class="bt_green" id="bt_red"><span class="bt_green_lft"></span><strong>Send SMS</strong><span class="bt_green_r"></span></a>
    <a href="<?php echo site_url('contacts/addContact'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add Contact</strong><span class="bt_green_r"></span></a>
    <a href="<?php echo site_url('contacts/addGroup'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add Group</strong><span class="bt_green_r"></span></a>

</div>
</form>