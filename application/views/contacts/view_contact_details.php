<h2>Contact Details</h2>
<div align="">

</div>
<div class="form">
		<?php foreach($contact_details as $row): ?>
		<fieldset>
			<dl>
		    	<dt><label for="first_name">Group:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $groups ? $groups : "--";?> 
                </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Name:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->name ? $row->name : "--";?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Mobile Number:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->mobile_no ? $row->mobile_no : "--";?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Gender:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->gender ? $row->gender : "--";?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Date Of Birth:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->dob ? $row->dob : "--";?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Address:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->address ? $row->address : "--";?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Join Date:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->join_date ? $row->join_date : "--";?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Relieve Date:</label></dt>
		        <dd style="margin-top:10px;">
		        	<?php echo $row->relieve_date ? $row->relieve_date : "--";?>
		        </dd>
		    </dl>		    
		</fieldset>
	<?php endforeach; ?>
</div>