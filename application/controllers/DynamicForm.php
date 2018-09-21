<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//http://localhost/office24by7/Org/Campaign_reports/Campaign
class DynamicForm extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		 
		if(!$this->session->userdata("user_id")) 
		{
			redirect(base_url(), 'refresh');
			
		} 
	}
	public function Reports()
	{	
		session_start();
		$user_id = $this->session->userdata("user_id");
		$user_service=$this->config->item('user_service');
		$limit=25;
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
		$to_date=date('Y-m-d');
		//$limit=$this->config->item('trn_records_perpage');
		$offset='0';
		$formsdata=array();
		$formsdropdown=array();
		$total_rows=0;
		if($this->uri->segment(3)>0 || $this->uri->segment(3)!='')
		{
			$offset=$this->uri->segment(3);
		}
		$form_name='';
		if(isset($_POST['search']))
		{
			unset($_SESSION['dynamincfrmrpts_from_date']);
			unset($_SESSION['dynamincfrmrpts_to_date']);
			unset($_SESSION['dynamincfrmrpts_from_name']);
			$form_name = $this->input->post('form_name');
			
			if($this->input->post('from_date')!='')
			{
				$from_date=date("Y-m-d", strtotime($this->input->post('from_date')));
			}
			if($this->input->post('to_date')!='')
			{
				$to_date=date("Y-m-d", strtotime($this->input->post('to_date')));
			}
			$_SESSION['dynamincfrmrpts_form_name']    = $form_name;
			$_SESSION['dynamincfrmrpts_from_date'] 	= $from_date;
			$_SESSION['dynamincfrmrpts_to_date']   	= $to_date;
			redirect("/DynamicForm/Reports");
		}
		$form_name		= isset($_SESSION['dynamincfrmrpts_form_name'])?$_SESSION['dynamincfrmrpts_form_name']:$form_name;
		$from_date		= isset($_SESSION['dynamincfrmrpts_from_date'])?$_SESSION['dynamincfrmrpts_from_date']:$from_date;
		$to_date		= isset($_SESSION['dynamincfrmrpts_to_date'])?$_SESSION['dynamincfrmrpts_to_date']:$to_date;
		
			$post_fields = array(
			'method'=>'GetAllFormsList',
			'user_id' => $user_id,
			'user_service'=>$user_service,
			'form_name'=>$form_name,
			'from_date'=>$from_date,
			'to_date'=>$to_date,
			'limit'=>$limit,
			'offset'=>$offset
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);
			if(count(@$result_response['data'])>0)
			{
				$formsdata=$result_response['data'];
				$total_rows=$result_response['total_rows'];
			}
			// get forms dropdown
			$post_fields = array(
			'user_id' => $user_id,
			'user_service'=>$user_service,
			'form_name'=>$form_name,
			'from_date'=>$from_date,
			'to_date'=>$to_date,
			'method'=>'GetAllFormsDropDown'
			);
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);
			if(count(@$result_response['data'])>0)
			{
				$formsdropdown=$result_response['data'];
			}
		      $datares['formnames']=$formsdropdown;
		      
		      if($this->input->post('download')!='') /****  DOWNLOAD ****/
			{
				$post_fields = array(
				'user_id' => $user_id,
				'user_service'=>$user_service,
				'form_name'=>$form_name,
				'from_date'=>$from_date,
				'to_date'=>$to_date,
				'limit'=>$this->config->item('trn_records_download_limit'),
				'offset'=>$offset
				);
				// get form data
				$url = $this->config->item('api_url')."DynamicForm/GetAllFormsReports?";
				$qry_fields_string = http_build_query($post_fields);
				$PostFields =$qry_fields_string;
				include('curl.php');//echo $url.'?'.$PostFields;exit;
				$result_response =json_decode($get_api_response, true);
				//print_r($result_response);
				if(count(@$result_response['data'])>0)
				{
					$formsdata=$result_response['data'];
				}
			
				$reports=array();
				foreach($formsdata as $key=>$value)
				{
					$form_name=isset($value['form_name'])?$value['form_name']:'---';
					$no_of_fields=isset($value['no_of_fields'])?$value['no_of_fields']:'---';
					$no_of_leads=isset($value['no_of_leads'])?$value['no_of_leads']:'0';
					$lead_url=$this->config->item('customform_url').$value['form_name'];
					$created_on=isset($value['created_on'])?$value['created_on']:'---';
				
					array_push($reports,array('Form Name'=>$form_name,'No of Fields'=>$no_of_fields,
					'No of Leads'=>$no_of_leads,'Date & Time'=>$created_on,'Lead URL'=>$lead_url));
				}
				$fileName = 'DynamicFormDetails.csv';
				$headerDisplayed = false;
				header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
				header('Content-Description: File Transfer');
				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename={$fileName}");
				header("Expires: 1");
				header("Pragma: private");
				$fh = @fopen( 'php://output', 'w' );
				foreach ($reports  as $key => $value) {
				if ( !$headerDisplayed ) {
				fputcsv($fh, array_keys($value));
				$headerDisplayed = true;
				}
				fputcsv($fh, $value);
				}
				fclose($fh);
				exit;
			}
		      
		     
		      
		      
			/*** pagination start ***/
			$this->load->library('pagination');
			$config['base_url'] = site_url().'DynamicForm/Reports';
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $limit; 
			$config['full_tag_open'] = "<ul class='paginationlist'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li >';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config);
			/*** pagination end ***/
	
			$datares['form_type']='add';
			$datares['formsdata']=$formsdata;
			$datares['total_rows']=$total_rows;
			$datares['from_date']=$from_date;
			$datares['to_date']=$to_date;
			$datares['form_name']=$form_name;
			//$this->load->view('DynamicForm/reports',$datares);
			$this->load->view('includes/header');
			$this->load->view('includes/leftmenu');
			$this->load->view('DynamicForm/reports',$datares);
			$this->load->view('/includes/footer');
	}
	
	public function Leads()
	{
		session_start();
		$user_id = $this->session->userdata("user_id");
		$user_service=$this->config->item('user_service');
		$limit=25;
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
		$to_date=date('Y-m-d');
		//$limit=$this->config->item('trn_records_perpage');
		$offset='0';
		$formsdata=array();
		$formsdropdown=array();
		$total_rows=0;
		$form_id=0;
		$field_count=0;
		$offset=0;
		if($this->uri->segment(3)>0 || $this->uri->segment(3)!='')
		{
			$form_id=$this->uri->segment(3);
		}
		if($this->uri->segment(4)>0 || $this->uri->segment(4)!='')
		{
			$field_count=$this->uri->segment(4);
		}
		if($this->uri->segment(5)>0 || $this->uri->segment(5)!='')
		{
			$offset=$this->uri->segment(5);
		}
		$form_name='';
		
		if(isset($_POST['search']))
		{
			unset($_SESSION['dynamincfrmrpts_from_date']);
			unset($_SESSION['dynamincfrmrpts_to_date']);
			unset($_SESSION['dynamincfrmrpts_from_name']);
			$form_name = $this->input->post('form_name');
			
			if($this->input->post('from_date')!='')
			{
				$from_date=date("Y-m-d", strtotime($this->input->post('from_date')));
			}
			if($this->input->post('to_date')!='')
			{
				$to_date=date("Y-m-d", strtotime($this->input->post('to_date')));
			}
			$_SESSION['dynamincfrmrpts_form_name']    = $form_name;
			$_SESSION['dynamincfrmrpts_from_date'] 	= $from_date;
			$_SESSION['dynamincfrmrpts_to_date']   	= $to_date;
			redirect("/DynamicForm/Reports");
		}
		$form_name		= isset($_SESSION['dynamincfrmrpts_form_name'])?$_SESSION['dynamincfrmrpts_form_name']:$form_name;
		$from_date		= isset($_SESSION['dynamincfrmrpts_from_date'])?$_SESSION['dynamincfrmrpts_from_date']:$from_date;
		$to_date		= isset($_SESSION['dynamincfrmrpts_to_date'])?$_SESSION['dynamincfrmrpts_to_date']:$to_date;
		
			$post_fields = array(
			'method'=>'GetAllFormsLeads',
			'user_id' => $user_id,
			'user_service'=>$user_service,
			'form_name'=>$form_name,
			'form_id'=>$form_id,
			'from_date'=>$from_date,
			'to_date'=>$to_date,
			'limit'=>$limit,
			'offset'=>$offset
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);
			$field_names=array();
			if(count(@$result_response['data'])>0)
			{
				$formsdata=$result_response['data'];
				$field_names=$result_response['field_names'];
				$form_name=$result_response['form_name'];
				$total_rows=$result_response['total_rows'];
			}
			/*** pagination start ***/
			$this->load->library('pagination');
			$config['base_url'] = site_url().'DynamicForm/Reports';
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $limit; 
			$config['full_tag_open'] = "<ul class='paginationlist'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li >';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config);
			/*** pagination end ***/
	
			$datares['form_type']='add';
			$datares['formsdata']=$formsdata;
			$datares['total_rows']=$total_rows;
			$datares['from_date']=$from_date;
			$datares['to_date']=$to_date;
			$datares['form_name']=$form_name;
			$datares['field_names']=$field_names;
			$datares['form_id']=$form_id;
			$datares['field_count']=$field_count;
		
			//$this->load->view('DynamicForm/reports',$datares);
			$this->load->view('includes/header');
			$this->load->view('includes/leftmenu');
			$this->load->view('DynamicForm/leads',$datares);
			$this->load->view('/includes/footer');
	}
	
	public function lead_download()
	{
		session_start();
		$user_id = $this->session->userdata("user_id");
		$form_name='';
		$from_date=date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
		$to_date=date('Y-m-d');
		$form_name		= isset($_SESSION['dynamincfrmrpts_form_name'])?$_SESSION['dynamincfrmrpts_form_name']:$form_name;
		$from_date		= isset($_SESSION['dynamincfrmrpts_from_date'])?$_SESSION['dynamincfrmrpts_from_date']:$from_date;
		$to_date		= isset($_SESSION['dynamincfrmrpts_to_date'])?$_SESSION['dynamincfrmrpts_to_date']:$to_date;
		
			if($this->input->post('download')!='') /****  DOWNLOAD ****/
				{
				
				$form_id=$_REQUEST['form_id'];
				$field_count=$_REQUEST['field_count'];
				$post_fields = array(
				'user_id' => $user_id,
				'form_name'=>$form_name,
				'form_id'=>$form_id,
				'from_date'=>$from_date,
				'to_date'=>$to_date,
				'method'=>'GetAllFormsLeads',
				'limit'=>50000,
				'offset'=>0
				);
				// get form data
				$url = $this->config->item('api_url')."DynamicForm.php?";
				$qry_fields_string = http_build_query($post_fields);
				$PostFields =$qry_fields_string;
				include('curl.php');//echo $url.'?'.$PostFields;exit;
				$result_response =json_decode($get_api_response, true);
				//print_r($result_response);
				if(count(@$result_response['data'])>0)
				{
					$formsdata=$result_response['data'];
					$field_names=$result_response['field_names'];
				}
			
				$reports=array();
				
				foreach($formsdata as $key=>$value)
				{
					$form_name=isset($value['form_name'])?$value['form_name']:'---';
					$user_mobile=isset($value['to_mobile_no'])?$value['to_mobile_no']:'---';
					$created_on=isset($value['created_on'])?$value['created_on']:'---';
					$postdata=array('Form Name'=>$form_name,'User Mobile'=>$user_mobile,
					'Date & Time'=>$created_on);
					foreach($field_names as $key=>$column)
					{
						$labelname=$column['column'];
						$getvalue=isset($value[$labelname])?$value[$labelname]:'---';
						$postdata[$labelname]=$getvalue;
					}
					array_push($reports,$postdata);
				}
				//echo "<pre>";
				//print_r($reports);
				//exit;
				
				$fileName = 'DynamicFormLeadDetails.csv';
				$headerDisplayed = false;
				header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
				header('Content-Description: File Transfer');
				header("Content-type: text/csv");
				header("Content-Disposition: attachment; filename={$fileName}");
				header("Expires: 1");
				header("Pragma: private");
				$fh = @fopen( 'php://output', 'w' );
				foreach ($reports  as $key => $value) {
				if ( !$headerDisplayed ) {
				fputcsv($fh, array_keys($value));
				$headerDisplayed = true;
				}
				fputcsv($fh, $value);
				}
				fclose($fh);
				exit;
			}
	}
	public function leadinfo()
	{
		//$user_id = $this->_userId;
		$user_id = $this->session->userdata("user_id");
		$user_service='';
		$form_id=isset($_REQUEST['form_id'])?$_REQUEST['form_id']:'';
		$form_name=isset($_REQUEST['form_name'])?$_REQUEST['form_name']:'';
		$formdata=array();
			$post_fields = array(
			'user_id' => $user_id,
			'user_service'=>$user_service,
			'method'=>'getFromData',
			'form_id'=>$form_id
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response)>0)
			{
				$formdata=$result_response['formdata'];
				
			}
		$data['formdata']=$formdata;
		$data['user_id']=$user_id;
		$data['form_id']=$form_id;
		$data['form_name']=$form_name;
		$this->load->view('DynamicForm/view_formdata',$data);
	}
	public function Create()
	{
		//print_r($_POST);
		
		$datares=array();
		$message='';
		$status='';
		if(isset($_POST['submit_form']))
		{
		      //echo "<pre>";
			//print_r($_POST);
			$form_name=$_REQUEST['form_name'];
			$total_fields=count($_REQUEST['element_type']);
			$formstructure=array();
			for($i=1;$i<=count($_REQUEST['element_type']);$i++)
			{
			
			$field_type=$_REQUEST['fldname'.$i];
				
				$field_options=array();
			if($field_type == "radio" || $field_type == "checkbox" || $field_type == "select") 
				{
					$opitons=array();
					for($j=1;$j<=100;$j++)
					{
						if(isset($_REQUEST['opt_lable'.$i.$j]))
						{
							$opitons=array('option'=>$_REQUEST['opt_lable'.$i.$j]);
							array_push($field_options,$opitons);
						}
					}
				}
			$row=array('label_name'=>$_REQUEST['label'.$i],'field_type'=>$_REQUEST['fldname'.$i],
			'field_name'=>$_REQUEST['label'.$i],'field_options'=>$field_options);
			
			array_push($formstructure,$row);
			
			}
			//print_r($formstructure);
			//exit;
			//$user_id=$_POST['Company_ID'];
			$user_id=$this->session->userdata("user_id");
			$form_name = $this->input->post('form_name');
			$form_name = str_replace(" ","-",$form_name);
			$count = $this->input->post('count_val');
			$sub_count = $this->input->post('mainsub_count');
			$user_service = $this->config->item('user_service');
			
			if($sub_count == '')
			{
				$sub_count = $count;
			}
			
			$post_fields = array(
			'user_id' => $user_id,
			'form_name'=>$form_name,
			'total_fields'=>$total_fields,
			'method'=>'Insertdynamicformstructure',
			'form_structure'=>json_encode($formstructure)
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response['status'])>0)
			{
				$status=$result_response['status'];
				$message=$result_response['message'];
				
				if($status=='200')
				{
					$this->session->set_flashdata("success_message",$message);
					redirect("DynamicForm/Reports");
				}
				else
				{
					$this->session->set_flashdata("error_message",$message);
					redirect("DynamicForm/Reports");
				}
				
				//echo $this->session->flashdata("success");
			}
		}
		
		$datares['message']=$message;
		
		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('DynamicForm/createdynamic_form',$datares);
		$this->load->view('/includes/footer');
	}
	
	public function getList()
	{
		//$user_id = $this->_userId;
		$user_id = $this->session->userdata("user_id");
		$user_service=$this->config->item('user_service');
		$form_name=($this->uri->segment(3))?$this->uri->segment(3):'';
		$result=array();
		$dynamic_result=array();
			$post_fields = array(
			'user_id' => $user_id,
			'user_service'=>$user_service,
			'form_name'=>$form_name
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm/getFromResult?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response)>0)
			{
				$result=$result_response['result'];
				$dynamic_result=$result_response['dynamic_result'];
			}
		$data['result']=$result;
		$data['dynamic_result']=$dynamic_result; // get dynamin form links	
		if($this->input->post('dynamic_form'))
		{
			$post_fields = array(
			'user_id' => $user_id,
			'user_service'=>$user_service,
			'form_name'=>$this->uri->segment(3),
			'Request_data'=>$this->input->post()
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm/Insertdynamicformdata?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response['status'])>0)
			{
				$status=$result_response['status'];
				$message=$result_response['message'];
				
				if($status=='200')
				{
					$this->session->set_flashdata("success",$message);
					redirect("DynamicForm/getList/$form_name");
				}
				else
				{
					$this->session->set_flashdata("error",$message);
					redirect("DynamicForm/getList/$form_name");
				}
				
				//echo $this->session->flashdata("success");
			}
		}
		$data['user_id']=$user_id;
		$this->load->view('DynamicForm/dynamic_forms_list',$data);
	}
	
	public function view_form()
	{
		//$user_id = $this->_userId;
		$user_id = $this->session->userdata("user_id");
		$user_service='';
		//$form_name=($this->uri->segment(3))?$this->uri->segment(3):'';
		$form_id=isset($_REQUEST['form_id'])?$_REQUEST['form_id']:'';
		$form_name=isset($_REQUEST['form_name'])?$_REQUEST['form_name']:'';
		$result=array();
		$created_on='';
		$form_structure=array();
		
		$dynamic_result=array();
		$post_fields = array(
		'user_id' => $user_id,
		'user_service'=>$user_service,
		'method'=>'getFromStructure',
		'form_id'=>$form_id
		);
		// get form data
		$url = $this->config->item('api_url')."DynamicForm.php?";
		$qry_fields_string = http_build_query($post_fields);
		$PostFields =$qry_fields_string;
		include('curl.php');//echo $url.'?'.$PostFields;exit;
		$result_response =json_decode($get_api_response, true);
		//print_r($result_response);exit;
		if(count(@$result_response)>0)
		{
			
			foreach($result_response['data'] as $key=>$value)
			{
				$form_id=$value['form_id'];
				$form_name=$value['form_name'];
				$user_id=$value['user_id'];
				$created_on=$value['created_on'];
				$form_structure=json_decode($value['form_structure'], true);;
			}
			
		}
			
		if($this->input->post('dynamic_form'))
		{
		
			//echo "<pre>";
			//print_r($_REQUEST);
			//exit;
			$post_fields = array(
			'user_id' => $user_id,
			'form_name'=>$this->input->post('form_name'),
			'form_id'=>$this->input->post('form_id'),
			'method'=>'Insertdynamicformwithoutshortcode',
			'Request_data'=>$this->input->post()
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response['status'])>0)
			{
				$status=$result_response['status'];
				$message=$result_response['message'];
				
				if($status=='200')
				{
					$this->session->set_flashdata("success_message",$message);
					redirect("DynamicForm/Reports");
				}
				else
				{
					$this->session->set_flashdata("error_message",$message);
					redirect("DynamicForm/Reports");
				}
				
				//echo $this->session->flashdata("success");
			}
		}
		
					
		$data['user_id']=$user_id;
		$data['form_id']=$form_id;
		$data['form_name']=$form_name;
		$data['created_on']=$created_on;
		$data['form_structure']=$form_structure;
		$this->load->view('DynamicForm/form_design',$data);
	}
	
	

	
}
