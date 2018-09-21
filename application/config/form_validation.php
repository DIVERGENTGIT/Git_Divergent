<?php
$config = array(
				  'login_form' => array(
                                array(
                                            'field' => 'username',
                                            'label' => 'Username',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'userpass',
                                            'label' => 'Password',
                                            'rules' => 'trim|required'
                                         )
                                    ),
                 'register_form' => array(
                                    array(
                                            'field' => 'username',
                                            'label' => 'User Name',
                                            'rules' => 'trim|required|min_length[6]|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'userpass',
                                            'label' => 'Password',
                                            'rules' => 'trim|required|min_length[6]|max_length[45]|alpha_numeric'
                                         ),
                                    array(
                                            'field' => 'first_name',
                                            'label' => 'First Name',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'last_name',
                                            'label' => 'Last Name',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|max_length[60]|valid_email'
                                         ),
                                    array(
                                            'field' => 'mobile',
                                            'label' => 'Mobile',
                                            'rules' => 'trim|required|min_length[10]|max_length[12]|numeric'
                                         ),
                                    array(
                                            'field' => 'address1',
                                            'label' => 'Address1',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'address2',
                                            'label' => 'Address2',
                                            'rules' => 'trim'
                                         ),
                                    array(
                                            'field' => 'city_id',
                                            'label' => 'City',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                   	array(
                                            'field' => 'pincode',
                                            'label' => 'Pincode / Zipcode',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                    array(
                                            'field' => 'tnc',
                                            'label' => 'Terms and Conditions',
                                            'rules' => 'trim|required'
                                         )
                                    ),
                'forgot_form' => array (
                                    array(
	                                    	'field' => 'username',
	                                    	'label' => 'Username',
	                                    	'rules' => 'trim|required'
                                    	)                                    	
                                    ),
                  'add_block_number_form' => array( 
					        array(
					            'field' => 'bNumber',
					            'label' => 'mobile',    
				   		 'rules' => 'trim|required|numeric|min_length[10]|max_length[10]'
					        ) 
						) ,                     
                'single_sms_form' => array(
                                    	array(
                                    		'field' => 'sms_type',
	                                    	'label' => 'SMS Type',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sms_text',
	                                    	'label' => 'SMS Text',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sender',
	                                    	'label' => 'Sender Name',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'to_mobileno',
	                                    	'label' => 'Mobile Nos',
	                                    	'rules' => 'trim|required'

                                    	)
                                    ),
                'file_sms_form' => array(
                                    	array(
                                    		'field' => 'sms_type',
	                                    	'label' => 'SMS Type',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sms_text',
	                                    	'label' => 'SMS Text',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sender',
	                                    	'label' => 'Sender Name',
	                                    	'rules' => 'trim|required'
                                    	)
                                    ),
                'variable_sms_form' => array(
                                    	array(
                                    		'field' => 'sms_type',
	                                    	'label' => 'SMS Type',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sms_text',
	                                    	'label' => 'SMS Text',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sender',
	                                    	'label' => 'Sender Name',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'mobile_column',
	                                    	'label' => 'Mobile Numbers Column',
	                                    	'rules' => 'trim|required'
                                    	)
                                    	/*&array(
                                    		'field' => 'from_row',
	                                    	'label' => 'From Row',
	                                    	'rules' => 'trim|required|numeric'
                                    	),
                                    	array(
                                    		'field' => 'to_row',
	                                    	'label' => 'To Row',
	                                    	'rules' => 'trim|required|numeric'
                                    	) */
                                    ),                     
               'add_user_form' => array(
                                    array(
                                            'field' => 'username',
                                            'label' => 'User Name',
                                            'rules' => 'trim|required|min_length[6]|max_length[45]|alpha_dash'
                                         ),
                                    array(
                                            'field' => 'userpass',
                                            'label' => 'Password',
                                            'rules' => 'trim|required|min_length[6]|max_length[45]|alpha_numeric'
                                         ),
                                    array(
                                            'field' => 'first_name',
                                            'label' => 'First Name',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'last_name',
                                            'label' => 'Last Name',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|max_length[60]|valid_email'
                                         ),
                                    array(
                                            'field' => 'mobile',
                                            'label' => 'Mobile',
                                            'rules' => 'trim|required|min_length[10]|max_length[12]|numeric'
                                         ),
                                    array(
                                            'field' => 'address1',
                                            'label' => 'Address1',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'address2',
                                            'label' => 'Address2',
                                            'rules' => 'trim'
                                         ),
                                    array(
                                            'field' => 'city_id',
                                            'label' => 'City',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                    array(
                                            'field' => 'pincode',
                                            'label' => 'Pincode / Zipcode',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                    array(
                                    		'field' => 'no_of_sms',
                                    		'label' => 'No. of SMS',
                                    		'rules' => 'trim|required|numeric'	
                                         ),
                                    array(
                                    		'field' => 'price',
                                    		'label' => 'Price',
                                    		'rules' => 'trim|required|numeric'                                    		
                                    	)                                    
                                    ),
                'add_sms_form' => array(
                                    array(
                                    		'field' => 'no_of_sms',
                                    		'label' => 'No. of SMS',
                                    		'rules' => 'trim|required|numeric'	
                                         ),
                                    array(
                                    		'field' => 'price',
                                    		'label' => 'Price',
                                    		'rules' => 'trim|required|numeric'                                    		
                                    	)	
                                    ),
                'add_contact_form' => array(
                                    array(
                                    	'field' => 'contcat_mobileno',
                                    	'label' => 'Mobile',
                                    	'rules' => 'trim|required|numeric'
                                    )                                    
                               ),
                'edit_contact_form' => array(
                                    array(
                                    	'field' => 'group',
                                    	'label' => 'Group',
                                    	'rules' => 'trim|required'
                                    ),
                                    array(
                                    	'field' => 'contcat_mobileno',
                                    	'label' => 'Mobile',
                                    	'rules' => 'trim|required|numeric'
                                    )                                    
                               ),                               	               
                'add_group_form' => array(
	                               		array(
	                                    	'field' => 'group_name',
	                                    	'label' => 'Group Name',
	                                    	'rules' => 'trim|required'
	                                    )
                               ),
                'add_multiplegroupcontacts_form' => array(
						        		array(
						            		'field' => 'group',
						            		'label' => 'Group Name',
						            		'rules' => 'trim|required'
					 	        		)
						       
						    ),               
                'edit_group_form' => array(
                               			array(
                               				'field' => 'group_name',
	                                    	'label' => 'Group Name',
	                                    	'rules' => 'trim|required'
                               			)
                               ),               
                'group_sms_form' => array(
                                    	array(
                                    		'field' => 'sms_type',
	                                    	'label' => 'SMS Type',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sms_text',
	                                    	'label' => 'SMS Text',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sender',
	                                    	'label' => 'Sender Name',
	                                    	'rules' => 'trim|required'
                                    	)
                                    ),
                'contact_sms_form' => array(
                                    	array(
                                    		'field' => 'sms_type',
	                                    	'label' => 'SMS Type',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sms_text',
	                                    	'label' => 'SMS Text',
	                                    	'rules' => 'trim|required'
                                    	),
                                    	array(
                                    		'field' => 'sender',
	                                    	'label' => 'Sender Name',
	                                    	'rules' => 'trim|required'
                                    	)
                                    ),                   
                'sms_template' => array (
                                    	array(
                                    	'field' => 'template',
                                    	'label' => 'SMS Template',
                                    	'rules' => 'trim|required'
                                    )
                                    
                                  ),
                'edit_profile_form' => array(
                                    array(
                                            'field' => 'first_name',
                                            'label' => 'First Name',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'last_name',
                                            'label' => 'Last Name',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|max_length[60]|valid_email'
                                         ),
                                    array(
                                            'field' => 'mobile',
                                            'label' => 'Mobile',
                                            'rules' => 'trim|required|min_length[10]|max_length[12]|numeric'
                                         ),
                                    array(
                                            'field' => 'address1',
                                            'label' => 'Address1',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'address2',
                                            'label' => 'Address2',
                                            'rules' => 'trim'
                                         ),
                                    array(
                                            'field' => 'city_id',
                                            'label' => 'City',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                    array(
                                            'field' => 'pincode',
                                            'label' => 'Pincode / Zipcode',
                                            'rules' => 'trim|required|numeric'
                                         )
                                  ),
             'change_password_form' => array(
                                    array(
                                            'field' => 'current_password',
                                            'label' => 'Current Password',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'new_password',
                                            'label' => 'New Password',
                                            'rules' => 'trim|required|max_length[45]'
                                         ),
                                    array(
                                            'field' => 'confirm_password',
                                            'label' => 'Confirm Password',
                                            'rules' => 'trim|required'
                                         )
                                   ),
             'complaint_form' => array(
                                   array(
                                            'field' => 'issue_type',
                                            'label' => 'Complaint For',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'contact_number',
                                            'label' => 'Contact Number',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                    array(
                                            'field' => 'cust_email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|max_length[60]|valid_email'
                                         ),
                                    array(
                                            'field' => 'subject',
                                            'label' => 'Subject',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'complaint_text',
                                            'label' => 'Complaint Text',
                                            'rules' => 'trim|required'
                                         )                                   
                                ),
             'add_alert_form' => array(
                                	
                                    array(
                                            'field' => 'field',
                                            'label' => 'Field',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'days_before',
                                            'label' => 'Days before',
                                            'rules' => 'trim|required|numeric'
                                         ),
                                    array(
                                            'field' => 'hr',
                                            'label' => 'hours',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'min',
                                            'label' => 'minutes',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'sms_txt',
                                            'label' => 'SMS Text',
                                            'rules' => 'trim|required'
                                         )
                                         
                                ) ,
   		 'add_sender_name_form' => array(
							        array(
							            'field' => 'sender_name',
							            'label' => 'Sender Name',
            							    'rules' => 'trim|alpha|required|strtoupper|exact_length[6]'
					  		        )
   	 							) ,
		    'add_template_form' => array(  
							        array(
							            'field' => 'template',
							            'label' => 'Template',
							            'rules' => 'trim|required'
							        ),array(
							            'field' => 'template_name',
							            'label' => 'Template Name',
							            'rules' => 'trim|required'
							        )
   								)                                                                                                     
                                    
      );
