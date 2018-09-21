<?php
error_reporting(0);
?>
<h1>My Profile</h1>
<?php if(isset($edited)): ?>
<div class="valid_box">
	<?php echo $edited; ?>        
</div>
<?php endif; 

$profile_data=$this->User_model->getUserDetails($this->_userId);
		
		foreach($profile_data as $row)
		    {
		     
			 	$profile['username']=$row->username;
				$profile['user_id']= $row->user_id;
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
			$query=$this->db->query("select state from new_citylist where state_id='".$profile['state_id']."'");
			$rec=$query->fetch_array();
			
			$querycity=$this->db->query("select city_name from new_citylist where  city_id='".$profile['city_id']."'");
			$reccity=$querycity->fetch_array();

?>

<div align="right" style="padding-right: 200px;">
	<a href="<?php echo site_url('myaccount/editProfile'); ?>">Edit Profile</a>
</div>
<div class="form">
<h3>Account Details</h3>
         
                <fieldset>
                    <dl>
                        <dt><label for="username">Username:</label></dt>
                        <dd style="margin-top: 10px;">
							<?php echo isset($profile['username']) ? $profile['username'] : "--"; ?>
						</dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<a href="<?php echo site_url('myaccount/changePassword'); ?>"> Change Password </a>
                        </dd>
                    </dl>
              	</fieldset>
    <h3>Contact Details</h3>          	
              	<fieldset>
                    <dl>
                        <dt><label for="first_name">First Name:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['first_name']) ? $profile['first_name'] : "--"; ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="last_name">Last Name:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['last_name']) ? $profile['last_name'] : "--"; ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Email:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['email']) ? $profile['email'] : "--"; ?>
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="mobile">Mobile:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['mobile']) ? $profile['mobile'] : "--"; ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="address1">Address1:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['address1']) ? $profile['address1'] : "--"; ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="address2">Address2:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['address2']) ? $profile['address2'] : "--"; ?>
                        </dd>
                    </dl>
                    

				<dl>
                        <dt><label for="city">State:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($rec['state']) ? $rec['state'] : "--"; ?>
                        </dd>
                    </dl>
                    
                    
                    <dl>
                        <dt><label for="city">City:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($reccity['city_name']) ? $reccity['city_name'] : "--"; ?>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="pincode">Pin/Zip Code:</label></dt>
                        <dd style="margin-top: 10px;">
                        	<?php echo isset($profile['zipcode']) ? $profile['zipcode'] : "--"; ?>
                        </dd>
                    </dl>                                   
                     
                 </fieldset>
		
</div>

<div align="right" style="padding-right: 200px;">
	<a href="<?php echo site_url('myaccount/editProfile'); ?>">Edit Profile</a>
</div>

