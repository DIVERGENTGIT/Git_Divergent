 <?php
$form_attributes = array(
	'id' => 'add_purchase_form',
	'name' => 'add_purchase_form'
);
?>
  
    <!-- end of left content -->

<td align="left" valign="top"> <div id="explore_hedder">
                <div id="lft_bg"></div>
                <div id="mid_hed_bg">Add Purchase</div>
                <div id="mid_mid_bg"></div>
                <div id="mid_bg"></div>
                <div id="rit_bg"></div>
            </div>
          <div id="explore_content">
		
        <?php echo form_open('businessSMS/add',$form_attributes); ?>
		 <table align="center" class="textsmstd">
		 <tr><td align="left" width="150">Customer ID: </td>
		 <td> <?php echo form_input(array('name' => 'cutomer_id', 'id' => 'cutomer_id', 'class' => 'register_input', 'value' => set_value('cutomer_id')));?></td></tr>
		 <?php if(form_error('cutomer_id')) { ?>
		 <tr><td></td><td><?php echo form_error('cutomer_id','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Name: </td>
		 <td> <?php echo form_input(array('name' => 'name', 'id' => 'name', 'class' => 'register_input', 'value' => set_value('name')));?></td></tr>
		 <?php if(form_error('name')) { ?>
		 <tr><td></td><td><?php echo form_error('name','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Gender: </td>
		 <td width="300"><?php echo form_radio('gender','M',set_radio('gender','M')); ?> Male
			   <?php echo form_radio('gender','F',set_radio('gender','F')); ?> Female
		 </td></tr>
		 <?php if(form_error('gender')) { ?>
		 <tr><td>&nbsp;</td><td><?php echo form_error('gender','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Address:</td>
		 <td> <?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => 5, 'cols' => 30, 'class' => 'register_input', 'value' => set_value('address')));?>
		 </td></tr>
		 <?php if(form_error('address')) { ?>
		 <tr><td></td><td><?php echo form_error('address','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Mobile: </td>
		 <td> <?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'class' => 'register_input', 'value' => set_value('mobile')));?></td></tr>
		 <?php if(form_error('mobile')) { ?>
		 <tr><td></td><td><?php echo form_error('mobile','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Item Code: </td>
		 <td> <?php echo form_input(array('name' => 'item_code', 'id' => 'item_code', 'class' => 'register_input', 'value' => set_value('item_code')));?></td></tr>
		 <?php if(form_error('item_code')) { ?>
		 <tr><td></td><td><?php echo form_error('item_code','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Item Name: </td>
		 <td> <?php echo form_input(array('name' => 'item_name', 'id' => 'item_name', 'class' => 'register_input', 'value' => set_value('item_name')));?></td></tr>
		 <?php if(form_error('item_name')) { ?>
		 <tr><td></td><td><?php echo form_error('item_name','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Price: </td>
		 <td> <?php echo form_input(array('name' => 'price', 'id' => 'price', 'class' => 'register_input', 'value' => set_value('price')));?></td></tr>
		 <?php if(form_error('price')) { ?>
		 <tr><td></td><td><?php echo form_error('price','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Quantity: </td>
		 <td> <?php echo form_input(array('name' => 'quantity', 'id' => 'quantity', 'class' => 'register_input', 'value' => set_value('quantity')));?></td></tr>
		 <?php if(form_error('quantity')) { ?>
		 <tr><td></td><td><?php echo form_error('quantity','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Bill Amount: </td>
		 <td> <?php echo form_input(array('name' => 'bill_amount', 'id' => 'bill_amount', 'class' => 'register_input', 'value' => set_value('bill_amount')));?></td></tr>
		 <?php if(form_error('bill_amount')) { ?>
		 <tr><td></td><td><?php echo form_error('bill_amount','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 
		 <tr><td align="left">Bill Number: </td>
		 <td> <?php echo form_input(array('name' => 'bill_number', 'id' => 'bill_number', 'class' => 'register_input', 'value' => set_value('bill_number')));?></td></tr>
		 <?php if(form_error('bill_number')) { ?>
		 <tr><td></td><td><?php echo form_error('bill_number','<span class="form_error">','</span>') ?></td></tr>
		 <?php } ?>
		 <tr><td height="4"></td></tr>
		 <tr><td></td><td align="left"><?php echo form_submit(array('name' => 'add_purchase','value' => 'Save', 'class' => 'register_button'));?></td></tr>
		 </table>
		 <?php echo form_close(); ?>
		
 </div>
          <div id="explore_content_dwn"></div></td>
  </tr>
</table>

    </td>
  </tr>		


