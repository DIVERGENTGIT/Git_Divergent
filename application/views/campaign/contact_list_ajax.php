
<div class="main check_all">
<ul class="scroll_numbar2 append_check_list scroll_num scroll_numbar main check_all gr_check_data">
 <?php

$contacts_count=0;	
foreach($contactdetails as $row =>$contact):

		$contacts_count++;
?>
<li>

<input type="checkbox"  class="checkboxstyle"  value="<?php echo  $contact->mobile_no; ?>" ><span onClick="getGroupContacts(<?php echo  $contact->group_id; ?>,<?php echo  $contact->contact_id; ?>);"> <?php echo  $contact->name; ?>
<span>
</li>
<?php  endforeach;
  
 ?>  
</ul>

</div>
