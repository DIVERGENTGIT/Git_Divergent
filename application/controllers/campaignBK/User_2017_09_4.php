<?php
class User extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		/* if(!$this->session->userdata('user_id') )   { 
		  redirect(base_url()); 
		} 
			 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {

			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   */
		
	}

/*
public function paynow()
	{
		$data=array();
		if($this->uri->segment(3)!='')
		{
			//$data['id']=$this->uri->segment(3);
			$data['id']=$this->uri->segment(4);
			$_SESSION['pid']=$this->uri->segment(4);
			$_SESSION['smspriceid']=$this->uri->segment(3);
			$id=$_SESSION['smspriceid'];
			$sql="select * from sms_packages where id=$id";
			$rs=$this->db->query($sql)->result();
			foreach($rs as $key=>$value)
			{
			//print_r($value);
				$st=explode("-",$value->pkg_range);
				$pkg_range=$st[1];
			}
			$pid=base64_decode($_SESSION['pid']);
			$sql="update price_enquery set noofsms=$pkg_range where id=$pid";
			$this->db->query($sql);
		}
		$this->load->view('user/paynow',$data);
	}
*/

	
public function paynow()
	{
	      session_start();
		$data=array();
		//echo $_SESSION['pid'];
		if($this->uri->segment(3)!='')
		{
			//$data['id']=$this->uri->segment(3);
			$data['id']=$this->uri->segment(4);
			
			if(@$_SESSION['pid']!='')
			{
				$_SESSION['pid']=$_SESSION['pid'];
			}
			else
			{
				$_SESSION['pid']=$this->uri->segment(4);
			}
			
			
			$_SESSION['pid']=$this->uri->segment(4);
			
			$_SESSION['smspriceid']=$this->uri->segment(3);
			$id=$_SESSION['smspriceid'];
			$sql="select * from sms_packages where id=$id";
			$rs=$this->db->query($sql)->result();
			
			foreach($rs as $key=>$value)
			{
			
			/*
			     //print_r($value);
				$st=explode("-",$value->pkg_range);
				$pkg_range=$st[1];
			*/
			
			$pkg_range=$value->noofsms;
			
			}
			   $pid=base64_decode($_SESSION['pid']);
			// get user details and insert new record for new package range .
			     $sql1="select * from price_enquery where id=$pid and payment_status=1";
			     $query=$this->db->query($sql1);
			     //echo $query->num_rows();
			   
			     if($query->num_rows()>0)
					{
							$price_enquery=$query->result();
							//print_r($price_enquery);
							foreach($price_enquery as $key => $pvalue)
							{
								$noofsms=$pkg_range;
								$price_per_long_code='';
								$usertype=$pvalue->smstype;
								$subscription=$pvalue->subcription;
								$name=$pvalue->name;
								$mobile=$pvalue->mobile;
								$email=$pvalue->email;
								
								//$user_id=$pvalue->registeruser_id;

								$sql2 = "insert into price_enquery (noofsms,price_per_sms,smstype,subcription,
								servicetype,
								name,mobile,email)
								values ($noofsms,'$price_per_long_code','$usertype',$subscription,'sms','$name',
								'$mobile','$email')";
								
								$query=$this->db->query($sql2);
								$ids = $this->db->insert_id();
								$_SESSION['pid']=base64_encode($ids);
							}
						
					}
					else
					{
			 $sql="update price_enquery set noofsms=$pkg_range where id=$pid";
			$this->db->query($sql);
					}
		}
		$data['id']=@$_SESSION['pid'];
		$this->load->view('user/paynow',$data);
	}
	
public function login()
	{
		$data['page_title'] = "Login Striker";
		$data['page_meta_des'] = "Ever best quality Bulk SMS, Voice & Digital Marketing service provider in India. We are that digital agency that you’ve been looking for";
		$data['page_meta_key'] = "sms, bulk sms, voice sms, bulk voice sms, digital marketing";

		$loginCaptcha =$this->input->post('codetypecopy');
		$validCaptcha =$this->input->post('captch');
		$data['validCaptcha'] = $validCaptcha;
		$id=base64_decode($this->input->post('priceid'));
		
		//echo "test";
		//echo $id=@$_SESSION['pid'];
		//exit;
		if($loginCaptcha == $validCaptcha)
		{
		if($this->input->post('username')!='' && $this->input->post('userpass'))
		{
		
	
			$this->load->model('user_model');
			$rs = $this->user_model->login();  
			if ($rs) 
			{
				foreach($rs as $result)
				{
					$sessionData = array (
							'username' => $result->username,
							'first_name' => $result->first_name,
							'user_id' => $result->user_id,
							'no_ndnc' => $result->no_ndnc,
							'dnd_check' => $result->dnd_check,
							'dlr_enabled' => $result->dlr_enabled,
							'is_reseller' => $result->is_reseller,
							
                            'ndnc_return' => $result->return_ndnc_credits,
                            'template_check' => $result->template_check,
                            'is_longcode' => $result->is_longcode,
                            'is_missedcall' => $result->is_missedcall
					
						);
 
					$is_blocked = $result->is_blocked;
		/*			
		  $sql="update price_enquery set registeruser_id=$result->user_id where id=$id";
	        $this->db->query($sql);
	        */
				}
				
			if(!$is_blocked)
				{
							$this->session->set_userdata($sessionData);
												        $user_id = $this->session->userdata('user_id');
					$this->user_model->updateLoginTime($user_id);
		

					$userarray=array(3907,3958,4065,4066,4084);
					if(in_array($result->user_id,$userarray))
					{
					redirect('missedcall/messages');
					}
					else
					{
						//if($profile['mverify']==0)
						if($result->mverify==0)
						{
						redirect('myaccount/index');
						}
						else
						{
							//redirect('campaign/normalSMS');
							$userexist=$this->user_model->getPriceTableuser($user_id);
							if(count($userexist)>0)
							{
								$paymentstatus=$this->user_model->getpaymentstatus($user_id);
								if(count($paymentstatus)>0)
								{
								$sql="update price_enquery set registeruser_id=$user_id where id=$id";
								$this->db->query($sql);
								redirect('products/index');
								}
								else
								{
							     redirect('sms/pricelist');
								}
							}
							else
							{
							if($id!=''){
							
							      $sql="update price_enquery set registeruser_id=$user_id where id=$id";
								$this->db->query($sql);
								redirect('products/index');
								}else{
								 if($this->session->userdata('user_id') ==  4130 || $this->session->userdata('user_id') ==  4131  || $this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 || $this->session->userdata('user_id') ==  142  || $this->session->userdata('user_id') ==  2917 ) {  redirect(base_url()); } else{  
						     redirect('campaign/normalSMS'); }
						     }
							} 
						}
					}
				}  
				else
				{
					$data['errmsg'] = "User Has Been Blocked. Please Contact Administrator.";				
				
				}
			}
			else
			{
				 $data['errmsg'] = "Invalid User Details";
			
			}
			
		}
		else
			{
				 $data['errmsg'] = " ";
			
			}
	
		}
		  else{
			  
			  $data['errmsg']="Invalid Captcha ";
			
		  }
		  
		
		if($this->uri->segment(3)!='')
	       {
	      	 $data['id']=$id=$this->uri->segment(3);
	       }
	       
		  	$this->load->view('user/login',$data);
		  
		  
		  
		  
	}
	
	
	public function signup()
	{
		$data=array();
		$data['id']='0';
		$data['email']='';
		$data['mobile']='';
		if($this->uri->segment(3)!='')
		{
		$id=$this->uri->segment(3);
		$this->load->model('user_model');
		$id= base64_decode($id);
		$result = $this->user_model->getPriceTable($id);
		//print_r($result);
		foreach($result as $key => $value)
		{
		$data['email']=$value->email;
		$data['mobile']=$value->mobile;
		$data['id']=$this->uri->segment(3);
		}
		
		}
		$this->load->view('user/registration',$data);
	}
	
public function demo()
	{
		$data=array();
		$data['id']='0';
		$data['email']='';
		$data['mobile']='';
		if($this->uri->segment(3)!='')
		{
		$id=$this->uri->segment(3);
		$this->load->model('user_model');
		$id= base64_decode($id);
		$result = $this->user_model->getPriceTable($id);
		//print_r($result);
		foreach($result as $key => $value)
		{
		$data['email']=$value->email;
		$data['mobile']=$value->mobile;
		$data['id']=$this->uri->segment(3);
		}
		
		}
		$this->load->view('user/demo_registration',$data);
	}


	
	
}

