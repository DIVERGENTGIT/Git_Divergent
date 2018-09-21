 <?php 
$real_url=$this->config->item('firstring_url');
$qry_fields =array('getusername'=>'getusername','user_id'=>$this->session->userdata('user_id'));
$did_url = $real_url."API/smsstriker/registration.php";
$qry_fields_string = http_build_query($qry_fields);
$did_conn= curl_init();
//set the url, number of POST vars, POST data
curl_setopt($did_conn,CURLOPT_URL, $did_url);
curl_setopt($did_conn,CURLOPT_POST, count($_POST));
curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
//execute post
$did_result = curl_exec($did_conn);
$getsilver_didlist_api=json_decode($did_result, true);
curl_close($did_conn);
//print_r($getsilver_didlist_api);
 ?> 
 
 <?php 
$user_id=$this->session->userdata('user_id');
$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,
u.mobile,u.address1,u.address2,u.first_name,u.last_name FROM users u WHERE u.user_id = $user_id";
$user=$this->db->query($sql)->result();
//print_r($user);
$usertype='';
foreach($user as $key => $value)
{

if($value->no_ndnc=="0")
{
$usertype="Promotional";
$usertypecol="promotional";
}
if($value->no_ndnc=="1")
{
$usertype="Transactional";
$usertypecol="transactional";
}
if($value->no_ndnc=="1" && $value->dnd_check=='1')
{
$usertype="Semi Trans";
$usertypecol="semitrans";
}


$state_id=$value->state_id;
$city_id=$value->city_id;
$address1=$value->address1;
$address2=$value->address2;
$zipcode=$value->zipcode;
$address1=$value->address1;
$organization=$value->organization;
$email=$value->email;
$mobile=$value->mobile;
$first_name=$value->first_name;
$last_name=$value->last_name;

 $real_url=$this->config->item('firstring_url');
 
}

?>
      
        <div class="col-md-12 col-sm-12 col-xs-12 btnhidebuy padding_zero">
		<input type="button" value="Buy" class="submit_btn buy-btnhide add_mrnumb neworderbtn" style="display:none;" >
		</div>	
		
		<!--- Login Form start--->
		
		<form  class="col-md-12 col-sm-12 col-xs-12  padding_zero userlogin_from" style="display:none;" >
		<div class="col-md-12 col-sm-12 col-xs-12  padding_zero">
		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero text-center">
		<img src="<?php echo base_url(); ?>images_n/firstring-logo.png" width="120px" alt="">
		</div>
		<div class="col-md-8 col-sm-8 col-xs-12 missedcall_allform padding_zero">
		
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		<label>User Name</label>
		</div>
		
		<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<input type="text" name="loginusername"  id="loginusername" readonly>
		</div>
		
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		<label>Mobile</label>
		</div>
		<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<input type="text" name="loginmobile" id="loginmobile" readonly >
		
		</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		<label>Password</label>
		</div>
		<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<input type="password" name="loginpassword" id="loginpassword">
		
		<span  class="loginusernamemsg" style="float:right;"> </span>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<input type="button" name="" value="Order Confirm" class="add_mrnumb submit_btn userlogin">
<input type="button" name="" value="Forgot Password" class="submit_btn forgot_password">
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<span class="forgotpwdmsg"></span>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<span class="servicenummsg"></span>
</div>
		</div>
		</div>
		</div>
		
		</div>
		</div>
		
		
		</form>
		
		
		
		<!--- Login Form End--->
		
		<!--- Registration Form start--->
		
		<form  class="col-md-12 col-sm-12 col-xs-12 buy-divshow padding_zero userregistration_from" style="display:none;" >
		<div class="col-md-12 col-sm-12 col-xs-12 user-dtl-num padding_zero">
		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero text-center">
		<img src="<?php echo base_url(); ?>images_n/firstring-logo.png" width="120px" alt="">
		</div>
		<div class="col-md-8 col-sm-8 col-xs-12 padding_zero">
		
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		<label>User Name</label>
		</div>
		
		<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<input type="text" name="username"  id="username">
	       <span  class="usernamemsg" style="float:right;"> </span>
		</div>
		
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		<label>Mobile</label>
		</div>
		<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<input type="text" name="mobile" id="mobile">
		<span  class="mobilemsg" style="float:right;"> </span>
		</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		<label>Password</label>
		</div>
		<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<input type="password" name="password" id="password">
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		
<input type="button" name="" value="Order Confirm" class="add_mrnumb submit_btn userregistration">
<span class="servicenummsg"></span>
		</div>
		</div>
		</div>
		
		</div>
		</div>
		
		</form>
		
		
		<!--- Registration Form End--->
		<input type="hidden" class="getuserfm" value="<?php echo $getsilver_didlist_api['color'];?>" >
<script>
 $(document).ready(function() {
/*
	 $(".neworderbtn").on("click",function(){
         var getuserfm=$(".getuserfm").val();

         if(getuserfm=='red')
         {
             $(".userlogin_from").show();
             $(".userregistration_from").hide();
         }
         if(getuserfm=='green')
         {
        	 $(".userlogin_from").hide();
        	 $(".userregistration_from").show();
         }
             

		 });*/

 });
 </script>
 
 
<script>
$(document).ready(function(){

	$(".userlogin_from").hide();
	
var urlstr="<?php echo $this->config->item('firstring_url') ?>API/smsstriker/registration.php";
console.log(urlstr);

var user_id = "<?php echo $this->session->userdata('user_id')?>";

		// get firstring user name
		//$(".buy-btnhide").click(function(){

		$(".neworderbtn").click(function(){
		
		if(user_id.length>0)
		{
		$.ajax({
		type:"GET",
		url:urlstr,
		data:{getusername:"getusername",user_id:user_id},
		dataType:"json",
		success:function(response)
		{
		
			console.log(response);
			
			if(response.color=='red')
			{
			
			$("#loginusername").val(response.username);
			$('#loginusername').prop('readonly', true);
			
			$("#loginmobile").val(response.mobile);
			$('#loginmobile').prop('readonly', true);
			
				$(".userlogin_from").show();
				$(".userregistration_from").hide();
			}
			else
			{
				$(".userregistration_from").show();
				$(".userlogin_from").hide();
			}
		
		},
		error:function(error)
		{
		//alert(error);
		console.log(error);
		}
		});

		}

		});
		$(".forgotpwdmsg").html("");
		// user forgot password
		$(".forgot_password").click(function(){
		$(".forgotpwdmsg").html("");
		if(user_id.length>0)
		{
		$.ajax({
		type:"GET",
		url:urlstr,
		data:{forgotpassword:"forgotpassword",user_id:user_id},
		dataType:"json",
		success:function(response)
		{
			console.log(response);
			if(response.color=='green')
			{
			
			$(".forgotpwdmsg").html("Password sent successfully to E-mail & Mobile");
			$(".forgotpwdmsg").css("color","green");
			
                        // send password email
				$.ajax({
				type:"GET",
				url:urlstr,
				data:{forgotpassword_email:"forgotpassword_email",user_id:user_id,'value':response.value},
				dataType:"json",
				success:function(response)
				{
				console.log(response);
				},
				error:function(error)
				{
				//alert(error);
				console.log(error);
				}
				});
			}
			else
			{
		      $(".forgotpwdmsg").html("New Password not send to E-Mail & Mobile!...");
		      $(".forgotpwdmsg").css("color","red");
		    }
			
		
		},
		error:function(error)
		{
		//alert(error);
		console.log(error);
		}
		});

		}

		});								
				

// user registration start

    $(".userregistration").click(function(){
    
    	//window.open("http://www.smsstriker.com/", '_blank'); 
 	var user_id = "<?php echo $this->session->userdata('user_id')?>";
 	console.log(user_id); 
 	var username = $('#username').val();
 	var password = $('#password').val();
 	var mobileno = $('#mobile').val();
 	var firstname = "<?php echo $first_name;?>";
 	var lastname = "<?php echo $last_name;?>";
 	var emailid = "<?php echo $email;?>";
 	var organization = "<?php echo $organization;?>";
 	var state_id ="<?php echo $state_id;?>";
 	var city_id ="<?php echo $city_id;?>";
 	var address1 ="<?php echo $address1;?>";
 	var address2 ="<?php echo $address2;?>";
 	var zipcode = "<?php echo $zipcode;?>";
 	
 	//var did_numbers = $('.append_service_num').val();
 	var did_numbers = "<?php echo @$_SESSION['sel_nos'];?>";
 	var didcost = $("#snos_cost").html();
	console.log(did_numbers);
 	
				if(username.length >=5)
				{
				$(".usernamemsg").html('');
				// calling server side php script start
				
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalidation:"unvalidation",username:username},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						if(response.message!='User Name already in use')
						{
							var mobileno=$("#mobile").val();
							$(".mobilemsg").show();
							$.ajax({
							type:"GET",
							url:urlstr,
							data:{unvalimobile:"unvalimobile",mobileno:mobileno},
							dataType:"json",
							success:function(response)
							{
							console.log(response);
							
							if(response.message!='Mobile number already in use')
						       {
						       
								$.ajax({
								type:"GET",
								url:"<?php echo base_url()?>Payment/userregistration",
								data:{
								registration:"registration",
								user_id:user_id,
								username:username,
								firstname:firstname,
								lastname:lastname,
								password:password,
								emailid:emailid,
								mobileno:mobileno,
								organization:organization,
								address1:address1,
								address2:address2,
								state_id:state_id,
								city_id:city_id,
								pincode:zipcode,
								did_numbers:did_numbers,
								didcost:didcost
								},
								dataType:"json",
								success:function(response)
								{	
								console.log(response);
								console.log(response.status);
								
								if(response.status==2){
								
							//$(".servicenummsg").html('Please select Service Numbers from available Service Numbers list');
								$(".servicenummsg").css('color','red');
								}
								else if(response.status==1){
								$(".usernamemsg").html('');
								
								console.log(response.leadid);

						var otp_url="<?php echo $this->config->item('firstring_url');?>index.php/Striker/otp_smsstriker/"+response.leadid;

						window.open(otp_url, '_blank');
///alert('dfhgfh');
								//window.open("http://www.smsstriker.com/", '_blank');

								}else{
								$(".usernamemsg").html('User Already Exist');
								$(".usernamemsg").css('color','red');
								}


								},
								error:function(error)
								{
								//alert(error);
								console.log(error);
								}

								});
								
							 }
							else
							{
							$(".mobilemsg").html(response.message);
							$(".mobilemsg").css('color',response.color);
							}
							
							},
							error:function(error)
							{
							//alert(error);
							console.log(error);
							}
							});
						
						
						}
						else
						{
						$(".usernamemsg").html(response.message);
						$(".usernamemsg").css('color',response.color);
						}
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});
				
				    
				    
				    
				    
				    
				}
	
	});
	
// user registration end


// user login start

    $(".userlogin").click(function(){
    
    //var did_numbers = $('.append_service_num').val();
 	var did_numbers = "<?php echo @$_SESSION['sel_nos'];?>";
 	
 	var didcost = $("#snos_cost").html();

     $(".forgotpwdmsg").html("");
    	
 	var user_id = "<?php echo $this->session->userdata('user_id')?>";
 	console.log(user_id); 
 	var username = $('#loginusername').val();
 	var password = $('#loginpassword').val();
 	var mobileno = $('#loginmobile').val();
 	
 	//var did_numbers = $('.append_service_num').val();
 	
 	//console.log();
						
							
							$(".mobilemsg").show();
							
							if(password.length>0)
							{
							$.ajax({
							type:"GET",
							url:"<?php echo base_url()?>Payment/userlogin",
							data:{userlogin:"userlogin",username:username,password:password,
							mobileno:mobileno,user_id:user_id,didcost:didcost},
							dataType:"json",
							success:function(response)
							{
							console.log(response);
								console.log(response.status);
								
								if(response.status==2){
								
								$(".loginusernamemsg").html("");
								$(".forgotpwdmsg").html("");
								
							  // $(".servicenummsg").html('Please select Service Numbers from available Service Numbers list');
								$(".servicenummsg").css('color','red');
								}
								else if(response.status==1){
								console.log(response.leadid);
								$(".loginusernamemsg").html(" ");
								
			var otp_url="<?php echo $this->config->item('firstring_url');?>index.php/Striker/otp_smsstriker/"+response.leadid;
							window.open(otp_url, '_blank');
							
								}else{

								$(".loginusernamemsg").html("Invalid Password");
								$(".loginusernamemsg").css('color','red');
								}
							
							},
							error:function(error)
							{
							//alert(error);
							console.log(error);
							}
							});
						      }
						      else
						      {
						            $(".loginusernamemsg").html("Please enter your Password");
								$(".loginusernamemsg").css('color','red');
						      }
						
						
	
	});
	
// user login end
			// user name validation
			$("#username").on("blur",function(){
			
				var username=$("#username").val();
				if(username.length >=5)
				{
				$(".usernamemsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalidation:"unvalidation",username:username},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".usernamemsg").html(response.message);
						$(".usernamemsg").css('color',response.color);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});

				}
				else
				{
				$(".usernamemsg").hide();
				}
				
			});
			
			
			// moblie number validation
			$("#mobile").on("blur",function(){
				var mobileno=$("#mobile").val();
				
				$(".mobilemsg").show();
				
				if(mobileno.length>=10)
				{
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalimobile:"unvalimobile",mobileno:mobileno},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".mobilemsg").html(response.message);
						$(".mobilemsg").css('color',response.color);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});
			    }
			    else
			    {
			              $(".mobilemsg").html("please enter 10 digits number");
					  $(".mobilemsg").css('color',"red");
			    }

				
				
			});
			
			
			//mobile no validation
			$("#mobile").keydown(function (e) {
			       // Allow: backspace, delete, tab, escape, enter and .
			       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			            // Allow: Ctrl+A, Command+A
			           (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
			            // Allow: home, end, left, right, down, up
			           (e.keyCode >= 35 && e.keyCode <= 40)) {
			                // let it happen, don't do anything
			                return;
			       }
			       // Ensure that it is a number and stop the keypress
			       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			           e.preventDefault();
			       }
			   });

	
	
});
</script>
