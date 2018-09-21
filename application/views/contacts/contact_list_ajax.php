
 <input type="hidden" name="group" value="<?php echo $group_id; ?>"> 
	<input type="hidden" name="contacts_count" value="<?php echo count($contactdetails); ?>"> 

<ul class="scroll_numbar2 append_check_list scroll_num scroll_numbar main check_all">
<?php

$contacts_count=0;	
foreach($contactdetails as $row):

		$contacts_count++;
?>
<li>
<div class="all_checkbox model_check">
  <input id="contacts" type="checkbox"   name="contact_<?php echo $contacts_count; ?>" value="<?php echo $row['contact_id'];?>"  />
  <label class="font_normal" for="contacts"><span><span></span></span></label>  
   
  <!-- <a href="javascript:function(e)" onclick="DoActionContact(<?php echo $user_id;?>,<?php echo $row['contact_id']; ?>);"> -->
  <a  onclick="DoActionContact(<?php echo $user_id;?>,<?php echo $row['contact_id']; ?>);" >

 <?php echo $row['name']. ' - ' .$row['mobile_no']; ?>  
  
</a>    
</div>   
  
</li>

<?php  endforeach;  

 ?>
 </ul>
 




 
 

