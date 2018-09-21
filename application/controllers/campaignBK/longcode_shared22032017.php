<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mahesh.lavanam
 * Date: 8/5/12
 * Time: 2:17 AM
 * To change this template use File | Settings | File Templates.
 */
class longcode_shared  extends CI_Controller
{
    protected $_userId;

    protected $_username;

    protected $_credits;

    protected $_international_credits;
    
      protected $_servicetax;
	
	protected $_smsprice;
	
	protected $_longcode;

    protected $_data = array();

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('user_id')) {
            redirect('index/login');
        }

        //user details from session
        $this->_userId = $this->session->userdata('user_id');
        $this->_username = $this->session->userdata('first_name');
        $this->_no_ndnc = $this->session->userdata('no_ndnc');

        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) 
		{
            $this->_credits = $rs->available_credits;
            $this->_international_credits = $rs->international_available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        }

        $this->_data['available_credits'] = $this->_credits;
        $this->_data['international_credits'] = $this->_international_credits;
        
                   //get service tax
                  $gbl_rs = $this->User_model->global_settings();
			foreach ($gbl_rs as $key=>$gblrs) {
			//print_r($gblrs);
			if($gblrs->setting_name=='Service Tax')
			{
			$this->_servicetax = $gblrs->value;
			$tax=$this->data['tax']=$gblrs->value/100;
			$tax_per=$this->data['tax_per']=$gblrs->value;

			$tax=$this->_data['tax']=$gblrs->value/100;
			$tax_per=$this->_data['tax_per']=$gblrs->value;

			}
			
			if($gblrs->setting_name=='smspricevalue')
			{
			$this->_smsprice = $gblrs->value;
			}

			if($gblrs->setting_name=='longcode')
			{
			$this->_longcode = $gblrs->value;
			}

			}

    }

    public function index()
    {
        $this->_data['page_title'] = "Long Code - Inbox";
        $this->load->model('codes_model');
        //get all long codes
        $codes = $this->codes_model->getCodes($this->_userId, "LONG");

		
		if(count($codes)>0) {
            
         
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $code_id = $this->input->post('code');
          	$longcode_keyword=$this->session->userdata('longcode');
            $getTotalRows = $this->codes_model->getReceivedSMS($this->_userId, "LONG", $code_id,$longcode_keyword, $from_date, $to_date);
            $total_rows = count($getTotalRows);
            $off_set = 0;
		   if($this->uri->segment(3)) {
               $off_set = $this->uri->segment(3);
            }
            $limit = 10;
            $receiveSMS = $this->codes_model->getReceivedSMS($this->_userId, "LONG", $code_id,$longcode_keyword, $from_date, $to_date, $off_set, $limit);
            $this->load->library('pagination');
            $config['base_url'] = site_url().'/longcode/index';
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);
            $this->_data['received_sms'] = $receiveSMS;
            $this->_data['from_date'] = $from_date;
            $this->_data['to_date'] = $to_date;
			$this->_data['rownum']=$off_set;
		
       }
				else {
           $this->_data['no_long_code'] = true;
        }

			//2817

        $this->load->view('includes/header',$this->_data);
		if($this->_userId==13||$this->_userId==2817 || $this->_userId==281)
        {
			if($this->session->userdata('longcode')) {
				$this->load->view('includes/leftmenu');
        	   $this->load->view('longcode/index');
			}
        	   else if($this->_userId==13){
				        $this->load->view('includes/leftmenu');
        		        $this->load->view('longcode/index_3345');
				      //$this->load->view('longcode/index_281');
					}
					if($this->_userId==2817){
						$this->load->view('includes/leftmenu');
				        $this->load->view('longcode/index_2817');
					}
					if($this->_userId==281){
					    $this->load->view('includes/leftmenu');
					    $this->load->view('longcode/index_281');
					}
		}
        else{
        $this->load->view('includes/leftmenu');
        $this->load->view('longcode/index');
        $this->load->view('includes/footer');
    }
	}
    public function invalidateLongCodeSession()
	{
		$this->session->unset_userdata('longcode');
		redirect('longcode/index');
	}
	public function pageAuthenticate()
	{
		$passcode = $this->input->post('passcode');
		$longcode = $this->input->post('longcode_id_pop');
    	$passcode=trim($passcode);
    	$passcode=mysql_real_escape_string($passcode);
    	if($longcode=="OFS" && $passcode=="OFS")
    	{
    		$uData = array ('longcode' => "OFS");
			$this->session->set_userdata($uData);	
    		echo 1;
		}
		 elseif($longcode=="HK" && $passcode=="HK"){
    		
    		$uData = array ('longcode' => "HK");
			$this->session->set_userdata($uData);
	
    		echo 1;
		}
		 elseif($longcode=="SAFETY" && $passcode=="SAFETY"){
    		
    		$uData = array ('longcode' => "SAFETY");
			$this->session->set_userdata($uData);	
    		echo 1;
		}
    	elseif($longcode=="BD" && $passcode=="BD")
    	{
    		$uData = array ('longcode' => "BD");
			$this->session->set_userdata($uData);		
    		echo 1;	
		}
		elseif($longcode=="QA" && $passcode=="QA")
    	{
    		$uData = array ('longcode' => "QA");
			$this->session->set_userdata($uData);		
    		echo 1;	
		}
		elseif($longcode=="ALL" && $passcode=="ALL")
    	{
    		$uData = array ('longcode' => "ALL");
			$this->session->set_userdata($uData);		
    		echo 1;	
		}
   		else
		{
    		echo 0;	
		}	
	}
    public function download()
    {
        $from_date = $this->uri->segment(3);
        $to_date = $this->uri->segment(4);
        $longcode_keyword=$this->session->userdata('longcode');
        $code_id = "";
        $this->load->model('codes_model');
        $rs = $this->codes_model->getReceivedSMS($this->_userId, "LONG", $code_id, $longcode_keyword,$from_date, $to_date);
        $string = "S No\tOn Date\tTo\tFrom\tSMS Text\n";
        $sno=1;
        foreach($rs as $row){
        	$sms_text=$row->sms_text;
            $string .=$sno."\t".$row->created_on."\t".$row->code_number."\t".$row->from_number."\t".$sms_text."\n";
            $sno++;
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Received_sms_".uniqid().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $string;
        exit;

    }
    
    public function dedicated()
    {
        $this->_data['page_title'] = "Long Code Dedicated";
         $user_id=$this->session->userdata('user_id');
        $this->load->model('longcode_model');
        //get all long codes
        
        $servicetype="dedicated";
        $longcode_numbers = $this->longcode_model->getlongcode_numbers($servicetype);
        //print_r($longcode_numbers);
        $this->_data['longcode_numbers']=$longcode_numbers;
        
        print_r($_POST);
        
        // insert longcode config
        if(@$_POST['LongcodeSubmit']!='')
        {
        extract($_POST);
        // get longcode_numbers
		  foreach($longcode_numbers as $longcode_number)
		  {
		   // get longcode_keywords
			foreach($getkeywords as $getkeyword)
			{
		      
				$sql1="select * from longcode_config where longcode_number='$longcode_number' and keyword='$getkeyword' 
				and sender_id='$longcode_sender_name' and vender_alert='$vendoralert' and
				customer_alert='$customeralert' and user_id=$user_id and service_type='dedicated'";
				$query=$this->db->query($sql1);
				//echo $query->num_rows();
				if($query->num_rows()==0)
				{
					$sql="insert into longcode_config (service_type,longcode_number,keyword,sender_id,
					vender_alert,vendor_number,customer_alert,user_id)
					values('dedicated','$longcode_number','$getkeyword','$longcode_sender_name',
					'$vendoralert',$vendor_mobileno,'$customeralert',$user_id)";
					$this->db->query($sql);
				}
				else
				{
					$sql2="update longcode_config set status=1 where longcode_number='$longcode_number'
					 and keyword='$getkeyword' 
					and sender_id='$longcode_sender_name' and vender_alert='$vendoralert' and
					customer_alert='$customeralert' and user_id=$user_id";
					$query=$this->db->query($sql2);
				}
			}
		  }
        }
        
       // insert longcode config
       
       if(@$_POST['editlongcode_config']=='Update')
       {
		$longcode_id=trim($_POST['longcode_id']);
		$edit_sender_name=trim($_POST['edit_sender_name'.$longcode_id]);
		$editcustomeralert=trim($_POST['editcustomeralert'.$longcode_id]);
		$editvendoralert=trim($_POST['editvendoralert'.$longcode_id]);
		$sqlupdate="update longcode_config set status=1,vender_alert='$editvendoralert',
		customer_alert='$editcustomeralert',sender_id='$edit_sender_name'
		where longcode_id='$longcode_id' and user_id=$user_id";
		$this->db->query($sqlupdate);
       }
       
       // delete
       
       if(@$this->uri->segment(3)=='delete')
       {
		$longcode_id=trim($this->uri->segment(4));
		
		$sqldelete="update longcode_config set status=0
		where longcode_id=$longcode_id and user_id=$user_id";
		$this->db->query($sqldelete);
		redirect("longcode/dedicated");
       }
       
       
        
	 $sql2="select * from sender_names where user_id=$user_id AND status=1 order by id desc";
	 $this->_data['sender_names']=$this->db->query($sql2)->result();
	 
	 
	 $sql3="select * from longcode_config where user_id=$user_id AND status=1 and service_type='dedicated' order by longcode_id desc";
	 $this->_data['longcode_configdata']=$this->db->query($sql3)->result();
	 
	 
						
        $this->load->view('includes/header',$this->_data);
        $this->load->view('includes/leftmenu');
        $this->load->view('longcode/dedicated',$this->_data);
        $this->load->view('includes/footer');
	}
	
	 
public function shared()
    {
        $this->_data['page_title'] = "Long Code Dedicated";
         $user_id=$this->session->userdata('user_id');
        $this->load->model('longcode_model');
        //get all long codes
        $servicetype="shared";
        $longcode_numbers = $this->longcode_model->getlongcode_numbers($servicetype);
        //print_r($longcode_numbers);
        $this->_data['longcode_numbers']=$longcode_numbers;
        
        print_r($_POST);
        
        // insert longcode config
        if(@$_POST['LongcodeSubmit']!='')
        {
        extract($_POST);
        // get longcode_numbers
		  foreach($longcode_numbers as $longcode_number)
		  {
		   // get longcode_keywords
			foreach($getkeywords as $getkeyword)
			{
		      
				$sql1="select * from longcode_config where longcode_number='$longcode_number' and keyword='$getkeyword' 
				and sender_id='$longcode_sender_name' and vender_alert='$vendoralert' and
				customer_alert='$customeralert' and user_id=$user_id and service_type='shared'";
				$query=$this->db->query($sql1);
				//echo $query->num_rows();
				if($query->num_rows()==0)
				{
					$sql="insert into longcode_config (service_type,longcode_number,keyword,sender_id,
					vender_alert,vendor_number,customer_alert,user_id)
					values('shared','$longcode_number','$getkeyword','$longcode_sender_name',
					'$vendoralert',$vendor_mobileno,'$customeralert',$user_id)";
					$this->db->query($sql);
				}
				else
				{
					$sql2="update longcode_config set status=1 where longcode_number='$longcode_number'
					 and keyword='$getkeyword' 
					and sender_id='$longcode_sender_name' and vender_alert='$vendoralert' and
					customer_alert='$customeralert' and user_id=$user_id";
					$query=$this->db->query($sql2);
				}
			}
		  }
        }
        
       // insert longcode config
       
       if(@$_POST['editlongcode_config']=='Update')
       {
		$longcode_id=trim($_POST['longcode_id']);
		$edit_sender_name=trim($_POST['edit_sender_name'.$longcode_id]);
		$editcustomeralert=trim($_POST['editcustomeralert'.$longcode_id]);
		$editvendoralert=trim($_POST['editvendoralert'.$longcode_id]);
		$sqlupdate="update longcode_config set status=1,vender_alert='$editvendoralert',
		customer_alert='$editcustomeralert',sender_id='$edit_sender_name'
		where longcode_id='$longcode_id' and user_id=$user_id";
		$this->db->query($sqlupdate);
       }
       
       // delete
       
       if(@$this->uri->segment(3)=='delete')
       {
		$longcode_id=trim($this->uri->segment(4));
		
		$sqldelete="update longcode_config set status=0
		where longcode_id=$longcode_id and user_id=$user_id";
		$this->db->query($sqldelete);
		redirect("longcode/shared");
       }
       
       
        
	 $sql2="select * from sender_names where user_id=$user_id AND status=1 order by id desc";
	 $this->_data['sender_names']=$this->db->query($sql2)->result();
	 
	 
	 $sql3="select * from longcode_config where user_id=$user_id AND status=1 and service_type='shared' order by longcode_id desc";
	 $this->_data['longcode_configdata']=$this->db->query($sql3)->result();
	 
	 
						
        $this->load->view('includes/header',$this->_data);
        $this->load->view('includes/leftmenu');
        $this->load->view('longcode/shared',$this->_data);
        $this->load->view('includes/footer');
	}
	
	

public function SelectedNumbers()
    {
     // echo $this->_data['tax'];
     //echo  $this->_data['tax_per'];
      $status=1;
	$user_id=$this->session->userdata('user_id');
	$getlongcode_number=trim($_REQUEST['snosprice'],",");
    

    if($getlongcode_number!='')
    {
    
    $getkeyword=$_REQUEST['getkeyword'];
    $getsubscription=$_REQUEST['getsubscription'];
    $status=$_REQUEST['status'];

   // get keyword cost
    $sql3="select * from  global_settings where setting_name='shared_keyword_amount'";
    $query1=$this->db->query($sql3);
    $longcode_keywords_cost=$query1->result();
   // print_r($longcode_keywords_cost);
    if($query1->num_rows()>0)
	{
	  foreach($longcode_keywords_cost as $key => $longcode_keyword_cost)
		{
	            $keywords_value=$longcode_keyword_cost->value;
	            $keywords_cost=$getkeyword*$keywords_value;
		}
	}
	$sql3="select * from longcode_keyword_price where  subscription_duration='$getsubscription'";
	$longcode_keyword_data=$this->db->query($sql3)->result();
	foreach($longcode_keyword_data as $key => $longcode_keyword)
	{
		$package_cost=$longcode_keyword->amount;
	}
	     
           $nos=explode(",",$getlongcode_number);
           //print_r($nos);
                        foreach($nos as $longcode_number)
                        {
		                       // get amount
		                       
		                       $sql2="select lp.longcode_number,lp.longcode_type,lt.amount from longcode_numbers lp 
						INNER JOIN longcode_plan_price lt
						ON  lp.longcode_type=lt.plan_name where lp.longcode_number='$longcode_number'";
						$query2=$this->db->query($sql2)->result();
						//print_r($query2);
						foreach($query2 as $key => $value1)
						{
							$longcode_number=$value1->longcode_number;
							$longcode_type=$value1->longcode_type;
							$number_cost=$value1->amount;
							if($getsubscription=='1 Month')
							{
							$numberamount=$number_cost*1;
							
							$getkeywords_cost=$keywords_cost*1;
							
							}
							else if($getsubscription=='3 Months')
							{
							$numberamount=$number_cost*3;
							$getkeywords_cost=$keywords_cost*3;
							}
							else if($getsubscription=='6 Months')
							{
							$numberamount=$number_cost*6;
							$getkeywords_cost=$keywords_cost*6;
							}
							else if($getsubscription=='1 Year')
							{
							$numberamount=$number_cost*12;
							$getkeywords_cost=$keywords_cost*12;
							}
						}
						
						$keywords_cost=$getkeywords_cost;
						
						$number_cost=$numberamount;
						$amount=$keywords_cost+$package_cost+$number_cost; // package cost and number cost
						$total_tax=($amount*$this->_data['tax_per'])/100;
						$total_amount=$amount+$total_tax;
		                 $sql1="select * from longcode_tmp where longcode_number='$longcode_number' 
		                 and service_type='shared' and user_id=$user_id";
					$query=$this->db->query($sql1);
					//echo $query->num_rows();
					if($query->num_rows()==0)
					{
		                             $sql="insert into longcode_tmp (service_type,user_id,longcode_number,longcode_type,status,
		                              no_of_keywords,subscription_duration,
		                              keywords_cost,package_cost,amount,total_tax,total_amount,number_cost)
							values('shared',$user_id,'$longcode_number','$longcode_type','$status','$getkeyword',
							'$getsubscription','$keywords_cost','$package_cost','$amount','$total_tax',
							'$total_amount','$number_cost')";
							$this->db->query($sql);	
					}
					else
					{
					
			// update longcode number price		
			$sql3="update  longcode_tmp 
			set  
			service_type='shared',status=$status,no_of_keywords='$getkeyword',subscription_duration='$getsubscription',
			keywords_cost='$keywords_cost',package_cost='$package_cost',amount='$amount',total_tax='$total_tax',
			total_amount='$total_amount',number_cost='$number_cost' 
			where  user_id=$user_id and longcode_number='$longcode_number'";
			$this->db->query($sql3);
			
				
					}
				
				}
				
            // get order numbers
		
		$sql2="select * from longcode_tmp where service_type='shared' and status=1 and user_id=$user_id group by longcode_number";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
	      $_SESSION['sel_nos']=trim($str,',');
		
		$data['result']=$query_result;
		
		//print_r($query_result);
		
       }
       else 
       {
        $data['result']=array();
       }
       //print_r($data['result']);
       
		$this->load->view('longcode/shared/selected_numbers',$data);	
	}
	
public function DisplayNumbers()
    {
     // echo $this->_data['tax'];
     //echo  $this->_data['tax_per'];
      $status=1;
	$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where service_type='shared' and status=1 and user_id=$user_id group by longcode_number";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
	      $_SESSION['sel_nos']=trim($str,',');
		
		$data['result']=$query_result;
           //print_r($data['result']);
		$this->load->view('longcode/shared/selected_numbers',$data);	
	}
	
//http://localhost/smsstriker/longcode/getlongcode_price?getkeyword=30000&getsubscription=1+Month	
public function getlongcode_price()
    {
    
    $user_id=$this->session->userdata('user_id');
    echo  $getlongcode_number=trim($_REQUEST['snosprice'],",");
    
    if($getlongcode_number!='')
    {
    echo  $getkeyword=$_REQUEST['getkeyword'];
    echo  $getsubscription=$_REQUEST['getsubscription'];
    
    echo $sql3="select * from longcode_packages where no_of_sms='$getkeyword' and subscription_duration='$getsubscription'";
	$packages_data=$this->db->query($sql3)->result();
	print_r($packages_data);

	foreach($packages_data as $key => $package)
	{
		$price_per_long_code=$package->price_per_long_code;
		$subscription_duration=$package->subscription_duration;
		$amount=$package->amount;
	}
           echo $sql3="update  longcode_tmp set  status=1,price_per_long_code='$price_per_long_code',
            subscription_duration='$subscription_duration',amount='$amount' 
            where status=1 and user_id=$user_id and longcode_number in ($getlongcode_number)";
		$this->db->query($sql3);
           $nos=explode(",",$getlongcode_number);
     
                        foreach($nos as $longcode_number)
                        {
		                  
		                 echo  $sql1="select * from longcode_tmp where longcode_number='$longcode_number' and user_id=$user_id";
					$query=$this->db->query($sql1);
					echo $query->num_rows();
					if($query->num_rows()==0)
					{
						$status=1;
						
						echo $sql2="select lp.longcode_number,lp.longcode_type,lt.amount from longcode_numbers 
						INNER JOIN longcode_plan_price lt
						ON  pl.longcode_type=lt.amount where lp.longcode_number='$longcode_number'";
						$query2=$this->db->query($sql2)->result();
						//print_r($query2);
						foreach($query2 as $key => $value1)
						{
							$longcode_number=$value1->longcode_number;
							$longcode_type=$value1->longcode_type;
							$longcode_amount=$value1->amount;
							
						}
						echo $sql="insert into longcode_tmp (user_id,longcode_number,longcode_type,status)
							values($user_id,'$longcode_number','$longcode_type','$status')";
							$this->db->query($sql);	
					}
					else
					{
						$sql3="update  longcode_tmp set  status=1 where status=0 and user_id=$user_id and longcode_number='$longcode_number'";
						$this->db->query($sql3);
				
					}
				
				}
				
     // get order numbers
		
		$sql2="select * from longcode_tmp where service_type='shared' and status=1 and user_id=$user_id group by longcode_number";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		$data['result']=$query_result;
		
		//print_r($query_result);
		
       }
       else 
       {
        $data['result']=array();
       }
		
		$this->load->view('longcode/shared/selected_numbers',$data);
		
			
		
	}
	
	
	public function cancel_did_numbers()
	{
	      date_default_timezone_set('Asia/Kolkata');
		$data=array();
		$data['result']=array();
		//print_r($_REQUEST['snosprice']);
		$did_nos=trim($_REQUEST['snosprice'],",");
		
		$status=trim($_REQUEST['status']);
		
		$user_id=$this->session->userdata('user_id');
		$sql3="update  longcode_tmp set  status=$status where status=1 and user_id=$user_id and longcode_number in ($did_nos)";
		$this->db->query($sql3);
		
		 // get order numbers
		$sql2="select * from longcode_tmp where service_type='shared' and status=1 and user_id=$user_id group by longcode_number";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
		$_SESSION['sel_nos']=trim($str,',');
		$data['result']=$query_result;
		//print_r($query_result);
		$this->load->view('longcode/shared/selected_numbers',$data);	
	}
	
	
	
 public function getsilvernos()
    {
        $this->load->model('longcode_model');
        //get all long codes
        $sql2="select * from longcode_numbers where longcode_type like 'SILVER%' and status=0";
		$longcode_numbers=$this->db->query($sql2)->result();
		$this->_data['longcode_numbers']=$longcode_numbers;
         //get all long code packages
        $noofsms_packages = $this->longcode_model->getnoofsms_packages();
       // print_r($noofsms_packages);
         $this->_data['noofsms_packages']=$noofsms_packages;
        //get all long code packages
        $getsubscription_packages = $this->longcode_model->getsubscription_packages();
       // print_r($getsubscription_packages);
         $this->_data['getsubscription_packages']=$getsubscription_packages;
         
         // get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
        $this->load->view('longcode/shared/service_nos/getsilver_nos',$this->_data);
	}
	

public function getsilvernossearch()
    {
		$this->load->model('longcode_model');
		//get all long codes
		$getsilvernumber=$_REQUEST['getsilvernumber'];
		$sql2="select * from longcode_numbers where longcode_type like 'SILVER%' AND longcode_number like '$getsilvernumber%'
		 and status=0";
		$longcode_numbers=$this->db->query($sql2)->result();
		$this->_data['longcode_numbers']=$longcode_numbers;
		$this->_data['getsilvernumber']=$_REQUEST['getsilvernumber'];
		
		// get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
		$this->load->view('longcode/shared/service_nos/getsilver_searchnos',$this->_data);
	}

public function getgoldnossearch()
    {
        $this->load->model('longcode_model');
        //get all long codes
        $getgoldnumber=$_REQUEST['getgoldnumber'];
        $sql2="select * from longcode_numbers where longcode_type like 'GOLD%' AND longcode_number like '$getgoldnumber%'
         and status=0";
	  $longcode_numbers=$this->db->query($sql2)->result();
        $this->_data['longcode_numbers']=$longcode_numbers;
        $this->_data['getgoldnumber']=$_REQUEST['getgoldnumber'];
        // get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		
        $this->load->view('longcode/shared/service_nos/getgold_searchnos',$this->_data);
	}

public function getplatinumnossearch()
    {
		$this->load->model('longcode_model');
		//get all long codes
		$getplatinumnumber=$_REQUEST['getplatinumnumber'];
		$sql2="select * from longcode_numbers where longcode_type like 'PLATINUM%' AND longcode_number like '$getplatinumnumber%'
		 and status=0";
		$longcode_numbers=$this->db->query($sql2)->result();
		$this->_data['longcode_numbers']=$longcode_numbers;
		$this->_data['getplatinumnumber']=$_REQUEST['getplatinumnumber'];
		// get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
		$this->load->view('longcode/shared/service_nos/getplatinum_searchnos',$this->_data);
	}
	
public function getgoldnos()
    {
        $this->load->model('longcode_model');
        //get all long codes
        $sql2="select * from longcode_numbers where longcode_type like 'GOLD%' and status=0";
		$longcode_numbers=$this->db->query($sql2)->result();
		$this->_data['longcode_numbers']=$longcode_numbers;
        
         //get all long code packages
        $noofsms_packages = $this->longcode_model->getnoofsms_packages();
       // print_r($noofsms_packages);
         $this->_data['noofsms_packages']=$noofsms_packages;
        
        
        //get all long code packages
        $getsubscription_packages = $this->longcode_model->getsubscription_packages();
       // print_r($getsubscription_packages);
         $this->_data['getsubscription_packages']=$getsubscription_packages;
       
        // get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
        $this->load->view('longcode/shared/service_nos/getgold_nos',$this->_data);
	}
	
public function getplatinumnos()
    {
        $this->load->model('longcode_model');
        
        //get all long codes
        $sql2="select * from longcode_numbers where longcode_type like 'PLATINUM%' and status=0";
		$longcode_numbers=$this->db->query($sql2)->result();
		$this->_data['longcode_numbers']=$longcode_numbers;
        
         //get all long code packages
        $noofsms_packages = $this->longcode_model->getnoofsms_packages();
       // print_r($noofsms_packages);
         $this->_data['noofsms_packages']=$noofsms_packages;
        
        
        //get all long code packages
        $getsubscription_packages = $this->longcode_model->getsubscription_packages();
       // print_r($getsubscription_packages);
         $this->_data['getsubscription_packages']=$getsubscription_packages;
       
        // get order numbers
		$user_id=$this->session->userdata('user_id');
		$sql2="select * from longcode_tmp where status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
			{
			   $str .= $getnumber['longcode_number'].',';
			}
			
		$_SESSION['sel_nos']=trim($str,',');
        $this->load->view('longcode/shared/service_nos/getplatinum_nos',$this->_data);
	}

	
public function confirm_order()
	{
	//http://10.10.10.199/smsstriker/index.php/
	//Payment/confirm_order/?tn=201701038715622&rm=Transaction%20Successful&user_name=
	session_start();
	$user_id=$this->session->userdata('user_id');
 
	//if(!empty($_POST['service_numbers']) && @$_POST['service_numbers']!='')
	if(!empty($_POST['flag']) && @$_POST['flag']!='')
        {
        	$_SESSION['confirm_nos']= $_POST['service_numbers'];
		$_SESSION['flag_longcode'] = $_POST['flag'];
		$_SESSION['service_type'] = $_POST['service_type'];
		$service_type = $_POST['service_type'];
		// get order numbers
		$sql2="select * from longcode_tmp where service_type='$service_type' and status=1 and user_id=$user_id";
		$query_result=$this->db->query($sql2)->result_array();
		//print_r($query_result);
		$str='';
		foreach($query_result as $key=>$getnumber)
		{
		$str .= $getnumber['longcode_number'].',';
		}
		$_SESSION['confirm_nos']=trim($str,',');
	
        } 
        
     // echo @$_SESSION['confirm_nos'];
	
        if(@$_SESSION['confirm_nos']=='')
        {
        	$this->load->library('cart');
		$user_id=$this->session->userdata('user_id');
		$this->_data['products'] = $this->cart->contents($user_id);

		$this->_data['total'] = $this->cart->total();
		$this->_data['total_items'] = $this->cart->total_items();
		if($this->uri->segment(3)!='')
		{
			  $ids = base64_decode($this->uri->segment(3));
		}
	
	  }
 
if(@$_POST['confirm_order']!='')
	{
		extract($_POST);
		//print_r($_POST);exit;
	        $sql="SELECT state from new_statelist WHERE state_id = $getstate_id";
			$new_statelist=$this->db->query($sql)->result();
			foreach($new_statelist as $key => $svalue)
			{
			$state=$svalue->state;
			}
			$sql="SELECT city_name from new_citylist WHERE city_id = $getcity_id";
			$new_citylist=$this->db->query($sql)->result();
			foreach($new_citylist as $key => $cvalue)
			{
			$city=$cvalue->city_name;
			}
			
          $sql="update users set state_id = $getstate_id,city_id = $getcity_id WHERE user_id = $user_id";
	    $this->db->query($sql);
	    
	    //exit;
	    
		 $this->session->set_userdata('or_state',$state);
		 $this->session->set_userdata('or_city',$city);
		 
		 $this->session->set_userdata('or_zipcode',$zipcode);
		 $this->session->set_userdata('or_address',$address);
		 $this->session->set_userdata('or_organization',$organization);
		// echo $this->session->userdata('or_state');
		$_SESSION['product_id'] = $ids;
		$userid= $this->session->userdata('user_id');
		$val = 'amount='.base64_encode($amount).'&tax_amount='.base64_encode($tax_amount).'&total_amount='.base64_encode($total_amount).'&name='.base64_encode($name).
'&sms_price='.base64_encode($sms_price).'&trnsale='.base64_encode($qty).'&customerid='.base64_encode($userid).
'&address1='.base64_encode($address).'&address2='.base64_encode($address).
'&state='.base64_encode($state).'&city='.base64_encode($city).
'&zip='.base64_encode($zipcode).
'&mobile='.base64_encode($mobile).'&email='.base64_encode($email);
$testssl_url=base_url()."payment/TestSsl.php?ids=".base64_encode($ids)."&".$val;
redirect($testssl_url);
	
	}
	// unset cart
	  //$_REQUEST['tn'] = '435346436';$_REQUEST['rm'] = 'Transaction Successful';$_SESSION['product_id']  = 792;
	 
	if(isset($_REQUEST['tn']))
	{
		//Array ( [tn] => 201703019813478 [rm] => Transaction Successful ) 
//Array ( [confirm_nos] => 8688388672,8688388675,8688388676 [flag_longcode] => longcode [service_type] => dedicated [product_id] => 1 )
		//print_r($_REQUEST);echo "</br>";print_r($_SESSION);exit;   
		if($_REQUEST['rm']=='Transaction Successful')  
		{
			/**  ADDED ON 2017-02-15, by saisandeepthi **/	
			if(isset($_SESSION['flag_longcode']) && $_SESSION['flag_longcode'] == 'longcode' )
			{	
 				
				$getSubscription ="SELECT * FROM longcode_tmp  WHERE user_id = '".$this->session->userdata('user_id')."'  AND  status = 1  AND longcode_number IN (".$_SESSION['confirm_nos'].") ";
				$getSubscription_res = $this->db->query($getSubscription)->result();
				
		   	        //stdClass Object ( [longcode_number] => 8688388675 [subscription_duration] => 1 Month )
				$transaction_id = $_REQUEST['tn'];
				
				 ///print_r($getSubscription_res);exit;
				 
				foreach($getSubscription_res as $userLongcodeNum)
				{
					$endSubscriptionDate = date('Y-m-d H:i:s', strtotime($userLongcodeNum->subscription_duration));
					
					/** Adding user longcode start and end subscription date **/
					
					$sqlsub="INSERT INTO longcode_subscription(service_type,user_id,longcode_number,no_of_keywords,subscription_start,subscription_end,status,transaction_id,longcode_type,no_of_sms,subscription_duration,number_cost,package_cost,amount,total_tax,total_amount,price_per_long_code) values('shared','".$this->session->userdata('user_id')."', '".$userLongcodeNum->longcode_number."','".$userLongcodeNum->no_of_keywords."','".date('Y-m-d H:i:s')."','".$endSubscriptionDate."',1,'".$transaction_id."','".$userLongcodeNum->longcode_type."','".$userLongcodeNum->no_of_sms."','".$userLongcodeNum->subscription_duration."','".$userLongcodeNum->number_cost."','".$userLongcodeNum->package_cost."','".$userLongcodeNum->amount."','".$userLongcodeNum->total_tax."','".$userLongcodeNum->total_amount."','".$userLongcodeNum->price_per_long_code."') ";
					
					  $this->db->query("INSERT INTO longcode_subscription(service_type,user_id,longcode_number,no_of_keywords,subscription_start,subscription_end,status,transaction_id,longcode_type,no_of_sms,subscription_duration,number_cost,package_cost,amount,total_tax,total_amount,price_per_long_code) values('shared','".$this->session->userdata('user_id')."', '".$userLongcodeNum->longcode_number."','".$userLongcodeNum->no_of_keywords."','".date('Y-m-d H:i:s')."','".$endSubscriptionDate."',1,'".$transaction_id."','".$userLongcodeNum->longcode_type."','".$userLongcodeNum->no_of_sms."','".$userLongcodeNum->subscription_duration."','".$userLongcodeNum->number_cost."','".$userLongcodeNum->package_cost."','".$userLongcodeNum->amount."','".$userLongcodeNum->total_tax."','".$userLongcodeNum->total_amount."','".$userLongcodeNum->price_per_long_code."') ");  
					/** Adding user service number details with transaction id **/
					 $this->db->query("INSERT INTO order_details(product_id,description,price,longcode_type,qty_ordered,transaction_id,user_id,longcode_number) values('".$_SESSION['product_id']."','dedicated','".$userLongcodeNum->total_amount."','".$userLongcodeNum->longcode_type."','1','".$transaction_id."','".$this->session->userdata('user_id')."','".$userLongcodeNum->longcode_number."') ");

					  $this->db->query("UPDATE longcode_tmp SET status = 2 WHERE longcode_number = '".$userLongcodeNum->longcode_number."'");
					  $userid= $this->session->userdata('user_id');
					  $this->db->query("UPDATE longcode_numbers SET status=1,user_id=$userid WHERE longcode_number = '".$userLongcodeNum->longcode_number."'");

				}          
	
			} 	
			
		}
	}
  
 

        $this->_data['tax']=$this->_servicetax;
        $this->_data['smsprice']=$this->_smsprice;
        $this->_data['available_credits']=$this->_credits;
        $this->load->view('includes/header',$this->_data);
	  $this->load->view('includes/leftmenu');
		
	 
	if(@$_SESSION['confirm_nos']!='')
	{
 
	 $longcode_numbers=$_SESSION['confirm_nos'];
	 $this->load->view('longcode/shared/confirm_order',$this->_data);
	}
	else
	{
		if(isset($_REQUEST['tn']))
		{
			if($_REQUEST['rm']=='Transaction Successful')
			{
				foreach($this->cart->contents() as $key=>$value)
				{
				$data = array(
				'rowid' => $value['rowid'],
				'qty'   => 0
				);
				$this->cart->update($data);
				$id=$value['id'];     
				$sql="update price_enquery set order_status=1 where id=$id";
				$this->db->query($sql);
				} 
			}
		} 	
	
		//$this->load->view('payments/confirm_order',$this->_data);
		
		 $this->load->view('longcode/shared/confirm_order',$this->_data);
	
	}	
		//$this->load->view('campaign/messages');
	$this->load->view('/includes/footer');
    
	}  
	
public function keywords()
      {	
      
		$userid= $this->session->userdata('user_id');
		$sql2="select * from longcode_keywords where user_id=$userid and status=1 and service_type='shared' order by keyword_id desc";
		$getkeywords=$this->db->query($sql2)->result();
		$this->_data['getkeywords']=$getkeywords;

		$this->load->model('longcode_model');
		//get all long codes
		$sql2="select * from longcode_subscription where user_id=$userid and status=1 and service_type='shared' group by longcode_number order by longcode_id desc";
		$longcode_numbers=$this->db->query($sql2)->result();
		//print_r($longcode_numbers);
		$this->_data['longcode_numbers']=$longcode_numbers;
		$this->load->view('longcode/shared/keywords/keywords',$this->_data);
		//$this->displaykewords();
	}

public function createkeyword()
      {
		if(@$_REQUEST['getkeyword']!='' && @$_REQUEST['longcode_numbers'])
		{
			$keyword=$_REQUEST['getkeyword'];
			$longcode_numbers=$_REQUEST['longcode_numbers'];
			$service_type=$_REQUEST['service_type'];
			$userid= $this->session->userdata('user_id');
			
			    $sql1="select * from longcode_keywords where longcode_number='$longcode_numbers' and keyword_name='$keyword' ";
				$query=$this->db->query($sql1);
				//echo $query->num_rows();
				if($query->num_rows()==0)
				{
					/// subcription count
					$sql1="select * from  longcode_subscription where longcode_number='$longcode_numbers' and user_id='$userid'";
					$query=$this->db->query($sql1);
					$datasubscription=$query->result();
					//print_r($datasubscription);
					foreach($datasubscription as $key => $subval)
					{
						$noofkeywords_sub_tbl=$subval->no_of_keywords; //4
						//$noofkeywords_sub_tbl=2; //4
						$subscription_start=$subval->subscription_start;
						$subscription_end=$subval->subscription_end;
					}
					
					// keywords table count
					$sql1="select * from  longcode_keywords where longcode_number='$longcode_numbers' and user_id='$userid'";
					$query_keywords=$this->db->query($sql1);
					
					//echo $query_keywords->num_rows();//4
					//echo $noofkeywords_sub_tbl;
					$noofkeywords_keywords_tbl=$query_keywords->num_rows();
					
						//check keywords table count
						if($noofkeywords_sub_tbl>$noofkeywords_keywords_tbl)
						{
						// number expired validation
					      //date_default_timezone_set('asia/kolkata');
						$currentdate=date("Y-m-d");
						$sql11="select * from  longcode_subscription where 
						 longcode_number='$longcode_numbers' 
						and date(subscription_end)>=date('$currentdate')";
						$query=$this->db->query($sql11);
						//echo $query->num_rows();
							if($query->num_rows()>0)
							{
							  $sql2="insert into longcode_keywords (service_type,keyword_name,longcode_number,user_id,status) values

								 ('$service_type','$keyword','$longcode_numbers',$userid,1)";
								$this->db->query($sql2);
								$data=array("status"=>"200","message"=>"Keyword create successfully","color"=>"green");
							
							}
							else
							{
							 $data=array("status"=>"200","message"=>"This Number already in use","color"=>"red");	
							}
						
						}
						else
						{
						
						$data=array("status"=>"200","message"=>"This Number exceeded","color"=>"red");
						
						}
				}
				else 
				{
						$data=array("status"=>"200","message"=>"This Keyword not available","color"=>"red");
				}
			
			
		
		}
		
		print_r(json_encode($data));
		
	     //$this->displaykewords();
		
	}
	

public function keywordupdate()
      {
		if(@$_REQUEST['getkeyword']!='' && @$_REQUEST['longcode_numbers'])
		{
			$keyword=$_REQUEST['getkeyword'];
			$updatekeywordid=$_REQUEST['updatekeywordid'];
			$longcode_numbers=$_REQUEST['longcode_numbers'];
			$service_type=$_REQUEST['service_type'];
			$userid= $this->session->userdata('user_id');
			
			      $sql1="select * from longcode_keywords where longcode_number='$longcode_numbers' and keyword_name='$keyword'
			      and service_type='$service_type'";
				$query=$this->db->query($sql1);
				//echo $query->num_rows();
				if($query->num_rows()==0)
				{
					/// subcription count
					$sql1="select * from  longcode_subscription where longcode_number='$longcode_numbers' and user_id='$userid'";
					$query=$this->db->query($sql1);
					$datasubscription=$query->result();
					//print_r($datasubscription);
					foreach($datasubscription as $key => $subval)
					{
						$noofkeywords_sub_tbl=$subval->no_of_keywords; //4
						//$noofkeywords_sub_tbl=2; //4
						$subscription_start=$subval->subscription_start;
						$subscription_end=$subval->subscription_end;
					}
					
					// keywords table count
					$sql1="select * from  longcode_keywords where longcode_number='$longcode_numbers' and user_id='$userid'";
					$query_keywords=$this->db->query($sql1);
					
					//echo $query_keywords->num_rows();//4
					//echo $noofkeywords_sub_tbl;
					$noofkeywords_keywords_tbl=$query_keywords->num_rows();
					
						//check keywords table count
						//if($noofkeywords_sub_tbl>$noofkeywords_keywords_tbl)
						//{
						// number expired validation
					      //date_default_timezone_set('asia/kolkata');
						$currentdate=date("Y-m-d");
						
						/*
						$sql11="select * from  longcode_subscription where  longcode_number='$longcode_numbers'

						and  user_id=$userid and date(subscription_end)>=date('$currentdate')";
						*/
						
						$sql11="select * from  longcode_subscription where  longcode_number='$longcode_numbers'

						and  user_id=$userid and date(subscription_end)>=date('$currentdate')";
						
						$query=$this->db->query($sql11);
						//echo $query->num_rows();
							if($query->num_rows()>0)
							{
								$sql2="update longcode_keywords set service_type='$service_type',
								keyword_name='$keyword',longcode_number='$longcode_numbers',
								user_id=$userid,status=1 where keyword_id=$updatekeywordid";
								$this->db->query($sql2);
								$data=array("status"=>"200","message"=>"Keyword create successfully","color"=>"green");
							
							}
							else
							{
							/*
								$sql2="insert into longcode_keywords (service_type,keyword_name,longcode_number,user_id,status) values

								 ('$service_type','$keyword','$longcode_numbers',$userid,1)";
								$this->db->query($sql2);*/
								$data=array("status"=>"200","message"=>"This Number is Expired","color"=>"green");
							}
						
						/*
						}
						else

						{
						
						$data=array("status"=>"200","message"=>"This Number exceeded","color"=>"red");
						

						}*/
				}
				else 
				{
						$data=array("status"=>"200","message"=>"This Keyword already in use","color"=>"red");
				}
			
			
		
		}
		
		print_r(json_encode($data));
		
	     //$this->displaykewords();
		
	}
	

public function displaykewords()
      {
		$userid= $this->session->userdata('user_id');
		
		$sql2="select * from longcode_keywords where user_id=$userid and status=1 and 
		 service_type='shared' order by keyword_id desc";
		$getkeywords=$this->db->query($sql2)->result();
		
		$this->_data['getkeywords']=$getkeywords;
		
		$this->load->view('longcode/shared/keywords/displaykeywords',$this->_data);
		
	}
	
public function getkewords()
      {
		$userid= $this->session->userdata('user_id');
		$sql2="select * from longcode_keywords where user_id=$userid and status=1 and  service_type='shared' order by keyword_id desc";
		$getkeywords=$this->db->query($sql2)->result();
		//print_r($getkeywords);
		?>
		<option value="">Select Keywords</option>
		<?php
		foreach($getkeywords as $key=>$keyword)
		{
		?>
		<option value="<?php echo $keyword->keyword_name;?>"><?php echo $keyword->keyword_name;?></option>
		<?php	
		}
		?>
		<option value="N/A">Other</option>
		<?php
	}
	
public function updatekeyword()
      {
		$userid= $this->session->userdata('user_id');
		$data=array();
		if(@$_REQUEST['getkeyword']!='')
		{
			$keyword=$_REQUEST['getkeyword'];
			$keyword_id=$_REQUEST['keyword_id'];
			$userid= $this->session->userdata('user_id');
			$sql2="update longcode_keywords set keyword_name='$keyword' where user_id=$userid and keyword_id=$keyword_id";
			if($this->db->query($sql2))
			{
		      $data=array("status"=>"success");
		      }
		      else
		      {
		       $data=array("status"=>"failed");
		      }
		}
		
		print_r(json_encode($data));
	}
	
	public function deletekeyword()
      {
		$userid= $this->session->userdata('user_id');
		$data=array();
		if(@$_REQUEST['keyword_id']!='')
		{
			
			$keyword_id=$_REQUEST['keyword_id'];
			$userid= $this->session->userdata('user_id');
			$sql2="update longcode_keywords set status='1' where user_id=$userid and keyword_id=$keyword_id";
			if($this->db->query($sql2))
			{
		      $data=array("status"=>"success");
		      }
		      else
		      {
		       $data=array("status"=>"failed");
		      }
		}
		
		print_r(json_encode($data));
	}
	
	
	
}
