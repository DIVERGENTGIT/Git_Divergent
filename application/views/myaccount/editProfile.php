
<script>
  function get_city(state_id)
	{
		

		var data ={state_id:state_id};
		
		
		$.ajax({
			url: "<?php echo site_url(); ?>myaccount/cities_ajaxreg",
			type: "POST",
			data: data,
			//data: {'passcode': '1'},
			cache: false,
			success: function (callback_data) 
			{
				$('#city_id').html(callback_data);
			}
		});
	}
	</script>
<h2>Edit Profile</h2>
<?php if(isset($userExist)): ?>
	<div class="error_box">
	 	<?php echo $userExist; ?>
	</div>
<?php else: ?>
	<div class="warning_box">
	 	All the fields are mandatory
	</div>
<?php endif;


error_reporting(0);
$profile_data=$this->User_model->getUserDetails($this->_userId);
		
		foreach($profile_data as $row)
		    {
		     
			 	$profile['username']=$row->username;
				$profile['user_id']= $row->user_id;
		     	$profile['username']=$row->username;
		     	$profile['first_name']=$row->first_name;
		     	$profile['last_name']=$row->last_name;
		     	$profile['email']=$row->email;
		     	$profile['mobile']=$row->mobile;
		     	$profile['organization']=$row->organization;
		     	$profile['address1']=$row->address1;
		     	$profile['address2']=$row->address2;
		     	$profile['region']=$row->region;
				$profile['zipcode']=$row->zipcode;

				$profile['state_id']=$row->state_id;
				$profile['city_id']=$row->city_id;


        }
			
			$querycity=$this->db->query("select city_name from new_citylist where  city_id='".$profile['city_id']."'");
			$reccity=$querycity->fetch_array();
			 ?>
<div class="form">
	<?php echo form_open('myaccount/editProfile',
					array('id' => 'edit_profile_form', 'name' => 'edit_profile_form', 'method' => 'post')
	); ?>
		<fieldset>
                    <dl>
                        <dt><label for="first_name">First Name:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name') ? set_value('first_name') : (isset($profile['first_name']) ? $profile['first_name']  : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('first_name'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="last_name">Last Name:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name') ? set_value('last_name') : (isset($profile['last_name']) ? $profile['last_name'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('last_name'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Email:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email') ? set_value('email') : (isset($profile['email']) ? $profile['email'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('email'); ?></div>
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="mobile">Mobile:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile') ? set_value('mobile') : (isset($profile['mobile']) ? $profile['mobile'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('mobile'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="address1">Address1:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1') ? set_value('address1') : (isset($profile['address1']) ? $profile['address1']:""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address1'); ?></div>
                        </dd>
                    </dl>
                    
                    
                    <dl>
                        <dt><label for="address2">Address2:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2') ? set_value('address2') : (isset($profile['address2']) ? $profile['address2']:""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address2'); ?></div>
                        </dd>
                    </dl>
                    
 <dl> 
                <dt><label for="state">State:</label></dt>
                <dd>
            <?php
		 		$statesAll = $this->user_model->getNew_StatesList();
		 ?>
         <select name="state_id" id="state_id" onChange="get_city(this.value)"  style="width:45%">
         <option  value=""> --select--</option>
								<?php foreach($statesAll as $key): ?>
								<option value="<?php echo $key->state_id; ?>" <?php if($key->state_id){echo "selected";} ?>><?php echo $key->state; ?></option>
								<?php endforeach; ?>
							</select>
                <div class="form_error"><?php echo form_error('state'); ?></div>
                </dd>
  </dl><dl>                        <dt><label for="pincode">City:</label></dt>

                <dd>  
                                        <span id="city_id"> </span>

               
                            </dd>
                    <dl>
                        <dt><label for="pincode">Pin/Zip Code:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode') ? set_value('pincode') : (isset($profile['zipcode']) ? $profile['zipcode'] : ""), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('pincode'); ?></div>
                        </dd>
                    </dl>
                                        
                     <dl class="submit">
                   		<?php echo form_submit(array('name' => 'edit','value' => 'Edit Profile', 'class' => 'button'));?>
                     </dl>
                     
                     
        </fieldset>   
               
                
        <?php echo form_close(); ?>
 </div>


