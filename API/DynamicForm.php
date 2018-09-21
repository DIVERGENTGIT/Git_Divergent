<?php 
include("../config/config.php");

//print_r($_REQUEST);

if($_REQUEST['method']=='Insertdynamicform')
{   
		$form_name=$_REQUEST["form_name"];
		$form_id=uniqid();
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$count=$_REQUEST["count"];
		$sub_count=$_REQUEST["sub_count"];
		$label=$_REQUEST["label"];
		$fldname=$_REQUEST["fldname"];
		$opt_lable=$_REQUEST["opt_lable"];
		$Request_data=$_REQUEST["Request_data"];
		//print_r($Request_data);
	// get count of admin activities
	
	$countquery="SELECT form_name  FROM `dynamic_fields` where form_name='$form_name' and user_id=$user_id";
	$getService_info = mysqli_query($link,$countquery) or die("query error".mysqli_error());
	if(mysqli_num_rows($getService_info) == 0)
	{
		for($x=1;$x<=$count;$x++)
		{
	
		$lable = $Request_data['label'.$x];
		$type = $Request_data['fldname'.$x];
	
		$lable = isset($lable)?$lable:'';
		$type = isset($type)?$type:'';
	
			if($lable != "" && $type != "")
			{
		
		
		
				$query = "insert into dynamic_fields(lname,ftype,form_id,form_name,user_service,user_id)
				 values('$lable','$type','$form_id','$form_name','$user_service','$user_id')";
				mysqli_query($link,$query) or die("query error".mysqli_error());
				$last_id=mysqli_insert_id($link); 
				
				if($type == "radio" || $type == "checkbox" || $type == "select") 
				{
					for($y=1;$y<=$sub_count;$y++)
					{
						if($Request_data['opt_lable'.$x.$y] != "")
						{
							$opt_lable = $Request_data['opt_lable'.$x.$y];
							//$opt_value = $this->input->post('opt_lable'.$x.$y);

							$query = "insert into fields_options(test_id,opt_lable,opt_value) 
							values('$last_id','$opt_lable','$opt_lable'
							)"; 
							mysqli_query($link,$query) or die("query error".mysqli_error());
						}
					}
				}
			}
		}
			if($last_id>0)
			{
				$getall['status'] = "200";
				$getall['message'] = "Form Created successfully!..";
			}
			else
			{
				$getall['status'] = "201";
				$getall['message'] = "Form Created Failed!..";
			}
	}
	else
	{
			$getall['status'] = "201";
			$getall['message'] = "Form Name Already in Use!..";
	
	}
		echo json_encode($getall);
}

if($_REQUEST['method']=='Insertdynamicformstructure')
{   

//echo "<pre>";
//print_r($_REQUEST);
//exit;
		$user_id=$_REQUEST["user_id"];
		$form_name=$_REQUEST["form_name"];
		$total_fields=$_REQUEST["total_fields"];
		$form_structure=$_REQUEST["form_structure"];
	$countquery="SELECT form_name  FROM dynamic_form_structure where form_name='$form_name' and user_id=$user_id";
	$getService_info = mysqli_query($link,$countquery) or die("query error".mysqli_error());
	if(mysqli_num_rows($getService_info) == 0)
	{
	
		$query = "insert into dynamic_form_structure(form_name,user_id,total_fields,form_structure)
		values('$form_name',$user_id,'$total_fields','$form_structure')";
		mysqli_query($link,$query) or die("query error".mysqli_error());
		$last_id=mysqli_insert_id($link); 
			if($last_id>0)
			{
				$getall['status'] = "200";
				$getall['message'] = "Form Created successfully!..";
			}
			else
			{
				$getall['status'] = "201";
				$getall['message'] = "Form Created Failed!..";
			}
	}
	else
	{
			$getall['status'] = "201";
			$getall['message'] = "Form Name Already in Use!..";
	
	}
		echo json_encode($getall);
}

if($_REQUEST['method']=='GetAllFormsDropDown')
{
      	$from_date=$_REQUEST["from_date"];
		$to_date=$_REQUEST["to_date"];
		$form_name=$_REQUEST["form_name"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$limit = $_REQUEST["limit"];
		$offset = $_REQUEST["offset"];
		$condition1='';
		$condition2='';
		$condition3='';
		$condition4='';
		if($from_date != '') 
		{
			$condition1 = " and date(created_on) >= '".$from_date."' ";
		}
		if($to_date != '') 
		{
			$condition2 = " and date(created_on) <= '".$to_date."' ";
		}
		if($form_name != '')
		{
			$condition3 = " and form_name='".$form_name."' ";
		}
		if($user_id != '')
		{
			$condition4 = " and user_id='".$user_id."' ";
		}
		if($user_service != '')
		{
			$condition5 = " and user_service='".$user_service."' ";
		}
		
		// get count of admin activities
		$countquery="SELECT form_name  FROM dynamic_form_structure where user_id>0 
		$condition1 $condition2 $condition4  group by form_name order by form_name asc";
		$getall['data'] =array(); 
		$getall['total_rows']=0;
		$getService_info = mysqli_query($link,$countquery) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$formdata=array();
			
			while($getService_info_res = mysqli_fetch_assoc($getService_info)) 
			{
				//$formdata['form_name']=$getService_info_res['form_name'];
				array_push($formdata,array('form_name'=>$getService_info_res['form_name']));
			}
			
			$getall['data'] = $formdata;
			$getall['total_rows'] = $total_rows;
			
		}
		echo json_encode($getall);
}

if($_REQUEST['method']=='GetAllFormsReports')
{
      	$from_date=$_REQUEST["from_date"];
		$to_date=$_REQUEST["to_date"];
		$form_name=$_REQUEST["form_name"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$limit = $_REQUEST["limit"];
		$offset = $_REQUEST["offset"];
		
		$condition1='';
		$condition2='';
		$condition3='';
		$condition4='';
		
		if($from_date != '') 
		{
			$condition1 = " and date(created_on) >= '".$from_date."' ";
		}
		if($to_date != '') 
		{
			$condition2 = " and date(created_on) <= '".$to_date."' ";
		}
		if($form_name != '')
		{
			$condition3 = " and form_name='".$form_name."' ";
		}
		if($user_id != '')
		{
			$condition4 = " and user_id='".$user_id."' ";
		}
		
		$leadscount=array();
		/*
		$sqlquery = "SELECT max(form_count) as form_count,post_data,form_name  FROM dynamic_form_data 
	where  form_name!='' and form_id!='' $condition4 $condition5   group by form_name order by form_count desc";
	      */
	      $sqlquery = "SELECT count(*) as form_count,post_data,form_name  FROM dynamic_form_data 
	where  form_name!='' and form_id!='' $condition4 $condition5   group by form_name order by form_count desc";
		$getService_info = mysqli_query($link,$sqlquery) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($lead = mysqli_fetch_assoc($getService_info)) 
			{
				$form_name=$lead['form_name'];
				$leadscount[$form_name]=$lead['form_count'];
			}
		}
		
		//print_r($leadscount);
		// get forms data
		
	     $sqlquery = "SELECT form_name,form_id ,count(*) as count,created_on FROM `dynamic_fields`
		where  form_name!='' $condition1 $condition2 $condition3 $condition4 $condition5 
	group by form_name order by created_on desc limit $offset ,$limit";
		$getService_info = mysqli_query($link,$sqlquery) or die("query error".mysqli_error());
		$formsdata=array();
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($form = mysqli_fetch_assoc($getService_info)) 
			{
			//$no_of_leads=isset($leadscount[$form['form_name']])?$leadscount[$form['form_name']]/$form['count']:'0';
			$no_of_leads=isset($leadscount[$form['form_name']])?$leadscount[$form['form_name']]:'0';
			array_push($formsdata,array('form_name'=>$form['form_name'],'form_id'=>$form['form_id'],
			'no_of_fields'=>$form['count'],'no_of_leads'=>$no_of_leads
			,'created_on'=>$form['created_on']));
			
			}
		}
		
		//print_r($formsdata);
		// get count of admin activities
		$countquery="SELECT form_name ,count(*) as count,created_on FROM `dynamic_fields`
		where  form_name!='' $condition1 $condition2 $condition3 $condition4 $condition5 
	group by form_name order by created_on desc";
		$getService_info = mysqli_query($link,$countquery) or die("query error".mysqli_error());
		$getall['data'] =array(); 
		$getall['total_rows']=0;
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$getall['data'] = $formsdata;
			$getall['total_rows'] = $total_rows;
		}
		
		echo json_encode($getall);
}


if($_REQUEST['method']=='GetAllFormsList')
{
      	$from_date=$_REQUEST["from_date"];
		$to_date=$_REQUEST["to_date"];
		$form_name=$_REQUEST["form_name"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$limit = $_REQUEST["limit"];
		$offset = $_REQUEST["offset"];
		
		$condition1='';
		$condition2='';
		$condition3='';
		$condition4='';
		
		if($from_date != '') 
		{
			$condition1 = " and date(created_on) >= '".$from_date."' ";
		}
		if($to_date != '') 
		{
			$condition2 = " and date(created_on) <= '".$to_date."' ";
		}
		if($form_name != '')
		{
			$condition3 = " and form_name='".$form_name."' ";
		}
		if($user_id != '')
		{
			$condition4 = " and user_id='".$user_id."' ";
		}
		
		$leadscount=array();
		/*
		$sqlquery = "SELECT max(form_count) as form_count,post_data,form_name  FROM dynamic_form_data 
	where  form_name!='' and form_id!='' $condition4 $condition5   group by form_name order by form_count desc";
	      */
	      $sqlquery = "SELECT count(*) as form_count,post_data,form_name  FROM dynamic_form_data 
	where  form_name!='' and form_id!='' $condition4 $condition5   group by form_name order by form_count desc";
		$getService_info = mysqli_query($link,$sqlquery) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($lead = mysqli_fetch_assoc($getService_info)) 
			{
				$form_name=$lead['form_name'];
				$leadscount[$form_name]=$lead['form_count'];
			}
		}
		
		//print_r($leadscount);
		// get forms data
		
	     	$sqlquery = "SELECT form_name,form_id ,created_on,total_fields FROM  dynamic_form_structure
		where  form_name!='' $condition1 $condition2 $condition3 $condition4 $condition5 
		group by form_name order by created_on desc limit $offset ,$limit";
		$getService_info = mysqli_query($link,$sqlquery) or die("query error".mysqli_error());
		$formsdata=array();
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($form = mysqli_fetch_assoc($getService_info)) 
			{
				$no_of_leads=isset($leadscount[$form['form_name']])?$leadscount[$form['form_name']]:'0';
				
				array_push($formsdata,array('form_name'=>$form['form_name'],'form_id'=>$form['form_id'],
				'no_of_fields'=>$form['total_fields'],'no_of_leads'=>$no_of_leads
				,'created_on'=>$form['created_on']));
			
			}
		}
		
		//print_r($formsdata);
		// get count of admin activities
		$countquery="SELECT form_name,form_id ,created_on,total_fields FROM  dynamic_form_structure
		where  form_name!='' $condition1 $condition2 $condition3 $condition4 $condition5 
		group by form_name order by created_on desc ";
		$getService_info = mysqli_query($link,$countquery) or die("query error".mysqli_error());
		$getall['data'] =array(); 
		$getall['total_rows']=0;
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$getall['data'] = $formsdata;
			$getall['total_rows'] = $total_rows;
		}
		
		echo json_encode($getall);
}


if($_REQUEST['method']=='GetAllFormsLeads')
{
      	$from_date=$_REQUEST["from_date"];
		$to_date=$_REQUEST["to_date"];
		$form_name=$_REQUEST["form_name"];
		$form_id=$_REQUEST["form_id"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$limit = $_REQUEST["limit"];
		$offset = $_REQUEST["offset"];
		
		$condition1='';
		$condition2='';
		$condition3='';
		$condition4='';
		$condition4='';
		
		if($from_date != '') 
		{
			$condition1 = " and date(created_on) >= '".$from_date."' ";
		}
		if($to_date != '') 
		{
			$condition2 = " and date(created_on) <= '".$to_date."' ";
		}
		if($form_name != '')
		{
			$condition3 = " and form_name='".$form_name."' ";
		}
		if($form_id != '')
		{
			$condition4 = " and form_id='".$form_id."' ";
		}
		if($user_id != '')
		{
			$condition5 = " and user_id='".$user_id."' ";
		}
			
			
		
		$data=array();
		$table_name="sms.campaigns_to";
		$sqlquery="SELECT * FROM dynamic_form_data
		where  form_name!='' $condition1 $condition2 $condition3 $condition4 $condition5 
	      order by created_on desc";
		$resultset = mysqli_query($link,$sqlquery) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($resultset);
		if(mysqli_num_rows($resultset) > 0)
		{
			while($lead = mysqli_fetch_assoc($resultset)) 
			{
				$form_name=$lead['form_name'];
				$short_code=$lead['short_code'];
				$date1=$lead['created_on'];
				$date2=date('Y-m-d H:i:s');
				$mobile='';
				if(strlen($short_code)>0)
				{

					$month1 = substr($date1,5,2);
					$day1 = substr($date1,8,2);
					$year1 = substr($date1,0,4);

					$month2 = substr($date2,5,2);
					$day2 = substr($date2,8,2);
					$year2 = substr($date2,0,4);

					$date1 = mktime(0,0,0,$month1,$day1,$year1);
					$date2 = mktime(0,0,0,$month2,$day2,$year2);

					if($date1 > $date2){
						$dateDiff = $date1 - $date2;
					} else {
						$dateDiff = $date2 - $date1;
					}
					$days_diff = floor($dateDiff/(60*60*24));
					
					if($days_diff <= 1) {
						$table_name="sms.campaigns_to";
					}
					else
					{
						$year = substr($lead['created_on'],0,4);
						$month = substr($lead['created_on'],5,2);
						$table_name = "campaigns_backup.campaigns_to_".$month.$year;
					}

					$sqlquery="SELECT to_mobile_no FROM $table_name
					where  short_url='$short_code'   $condition5 limit 1";
					$getService_info = mysqli_query($link,$sqlquery) or die("query error".mysqli_error());
					$total_rows=mysqli_num_rows($getService_info);
					if(mysqli_num_rows($getService_info) > 0)
					{
						while($campaigns_to = mysqli_fetch_assoc($getService_info)) 
						{
							$to_mobile_no=$campaigns_to['to_mobile_no'];
						}
					}
				}
				
				$postdata=array('form_name'=>$lead['form_name'],'to_mobile_no'=>$to_mobile_no,'created_on'=>$lead['created_on'],
				'lead_id'=>$lead['id'],
				);
				// get form post values
				$arr=json_decode($lead['post_data']);
				$field_names=array();
				foreach($arr as $key=>$value)
				{
					$postdata[$value->field_name]=$value->value;
					
					array_push($field_names,array('column'=>$value->field_name));
				}
				array_push($data,$postdata);
			}
		}
		// get count of admin activities
		$countquery="SELECT * FROM dynamic_form_data
		where  form_name!='' $condition1 $condition2 $condition3 $condition4 $condition5 
	      order by created_on desc";
		$getService_info = mysqli_query($link,$countquery) or die("query error".mysqli_error());
		$getall['data'] =array(); 
		$getall['total_rows']=0;
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$getall['data'] = $data;
			$getall['field_names'] = $field_names;
			$getall['form_name'] = $form_name;
			$getall['total_rows'] = $total_rows;
		}
		
		echo json_encode($getall);
}


if($_REQUEST['method']=='getFromResult')
{
   
		$form_id=$_REQUEST["form_id"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		// get result data
		$query = "select * from dynamic_fields where form_id = '$form_id' AND user_id = '$user_id'";
		//$query = "select * from dynamic_fields where form_name = '$formname' AND user_id = '$user_id'";
		$result=array();
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$result=array();
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($form = mysqli_fetch_assoc($getService_info)) 
			{
				array_push($result,$form);
			}
		}
		
		
		// get dynamic_result
		$query = "select form_name from dynamic_fields where user_id = '$user_id' group by form_name";
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$dynamic_result=array();
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($form1 = mysqli_fetch_assoc($getService_info)) 
			{
				array_push($dynamic_result,$form1);
			}
		}
		
		
		$getall['result']=$result;
		$getall['dynamic_result']=$dynamic_result;
		echo json_encode($getall);
}

if($_REQUEST['method']=='getFromStructure')
{
   
		$form_id=$_REQUEST["form_id"];
		$user_id=$_REQUEST["user_id"];
		// get result data
		$query = "select * from  dynamic_form_structure where form_id = '$form_id' AND user_id = '$user_id'";
		$result=array();
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($form = mysqli_fetch_assoc($getService_info)) 
			{
				array_push($result,$form);
			}
			
			$getall['data']=$result;
			$getall['status']=200;
			$getall['msg']="success";
		}
		else
		{
			$getall['data']=$result;
			$getall['status']=201;
			$getall['msg']="failed";
		}
		
		echo json_encode($getall);
}

if($_REQUEST['method']=='getOutFromStructure')
{
   
		$form_id=$_REQUEST["form_id"];
		$user_id=$_REQUEST["user_id"];
		// get result data
		$query = "select * from  dynamic_form_structure where form_id = '$form_id'";
		$result=array();
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($form = mysqli_fetch_assoc($getService_info)) 
			{
				array_push($result,$form);
			}
			
			$getall['data']=$result;
			$getall['status']=200;
			$getall['msg']="success";
		}
		else
		{
			$getall['data']=$result;
			$getall['status']=201;
			$getall['msg']="failed";
		}
		
		echo json_encode($getall);
}

if($_REQUEST['method']=='getFromData')
{
   
		$form_id=$_REQUEST["form_id"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		// get result data
		$query = "select post_data from dynamic_form_data where id = '$form_id' AND user_id = '$user_id' limit 1";
		//$query = "select * from dynamic_fields where form_name = '$formname' AND user_id = '$user_id'";
		$result=array();
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$result=array();
		if(mysqli_num_rows($getService_info) > 0)
		{
			$formdata1=mysqli_fetch_assoc($getService_info);
			
			$formdata=json_decode($formdata1['post_data']);
		}
		$getall['formdata']=$formdata;
		echo json_encode($getall);
}

if($_REQUEST['method']=='getFieldOptions')
{
		$test_id=$_REQUEST["test_id"];
		// get result data
		$query = "select * from fields_options where test_id = '$test_id'";
		$result=array();
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			while($getService_info_res = mysqli_fetch_assoc($getService_info)) 
			{
				//$formdata['form_name']=$getService_info_res['form_name'];
				array_push($result,$getService_info_res);
			}
		}
		
		$getall['result']=$result;
		echo json_encode($getall);
}

if($_REQUEST['method']=='Insertdynamicformdata')
{
		$formname=$_REQUEST["form_name"];
		$short_code=$_REQUEST["short_code"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		$feedback_id='';
		//print_r($Request_data);
		$query = "select * from dynamic_fields where form_name = '$formname' AND user_id = '$user_id'";
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$short_code = isset($short_code)?$short_code:"";
			$feedback_id = uniqid('fbid_');
			$fields = array();
			$xy = 0;
			while($result = mysqli_fetch_assoc($getService_info)) 
			{
				$field_name = str_replace(' ','_',$result['lname']);
				$field_id = $result['test_id'];
				$form_name = $result['form_name'];
				
				if(is_array($Request_data[$field_name]))
				{
					$str='';
					foreach($Request_data[$field_name] as $key=>$value)
					{
						$str .= $value.'|';
					}
						$val = trim($str,"|");
				}
				else
				{
					$val = $Request_data[$field_name];
				}
				
				$fields[$xy] = "'" . $field_id . "'".','."'" . $val . "'".','."'" . $form_name . "'";
				
				$xy++;
			}
			
			//$this->Campaign_model->insert_formdetails($fields,$short_code,$feedback_id,$form_name,$user_service,$user_id);
			
			$last_count = "";
			$sql = "select form_count from dynamic_form_values where short_code = '$short_code' and form_name='$form_name'
			and user_id=$user_id and user_service='$user_service' group by form_count order by form_count desc limit 1";
			$getService_info = mysqli_query($link,$sql) or die("query error".mysqli_error());
			if(mysqli_num_rows($getService_info) == 0)
			{
				$count =1;
				$sql2 = "select form_count from dynamic_form_values where  form_name='$form_name'
				and user_id=$user_id and user_service='$user_service' group by form_count order by form_count desc limit 1";
				$getService_info = mysqli_query($link,$sql) or die("query error".mysqli_error());
				if(mysqli_num_rows($getService_info) > 0)
				{
					while($result2 = mysqli_fetch_assoc($getService_info)) 
					{
						$last_count =$result2['form_count'];
						$count = $last_count + 1;
					}
				}
				for($i=0;$i<=count($fields)-1;$i++)
				{
					$query = "insert into dynamic_form_values(dynamic_id,value,form_name,short_code,form_count,feedback_id,user_service,user_id)
					values($fields[$i],'$short_code','$count','$feedback_id','$user_service',$user_id)";
					mysqli_query($link,$query) or die("query error".mysqli_error());
					$last_id=mysqli_insert_id($link);
				}
				if($last_id>0)
				{
					$getall['status'] = "200";
					$getall['message'] = "Your request proccess successfully Submited!..";
					$getall['feedback_id'] = $feedback_id;
				}
				else
				{
					$getall['status'] = "201";
					$getall['message'] = "Your request proccess failed!..";
					$getall['feedback_id'] = $feedback_id;
				}
				
			}
			else
			{
					$getall['status'] = "201";
					$getall['message'] = "Your details already existed!..";
					$getall['feedback_id'] = $feedback_id;
			}
		}
		
		echo json_encode($getall);
}

if($_REQUEST['method']=='Insertdynamicformwithoutshortcode')
{
//echo "<pre>";
//print_r($_REQUEST);

		$form_name=$_REQUEST["form_name"];
		$form_id=$_REQUEST["form_id"];
		$short_code=$_REQUEST["short_code"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		$feedback_id='';
		$total_fields=0;
		$query = "select * from  dynamic_form_structure where form_name = '$form_name' AND user_id = '$user_id'";
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$short_code = isset($short_code)?$short_code:"";
			$fields = array();
			$data=array();
			while($result = mysqli_fetch_assoc($getService_info)) 
			{
				$form_name=$result['form_name'];
				$form_id=$result['form_id'];
				$user_id=$result['user_id'];
				$total_fields=$result['total_fields'];
				
			      $form_structure=json_decode($result['form_structure']);
			    	$val='';
			    	
				foreach($form_structure as $key=>$form)
				{
					$field_name = str_replace(' ','_',$form->field_name);
					
					if(is_array($Request_data[$field_name]))
					{
						$str='';
						foreach($Request_data[$field_name] as $key=>$value)
						{
						      //echo $value;
							$str .= $value.'|';
						}
							$val = trim($str,"|");
					}
					else
					{
						$val = $Request_data[$field_name];
					}
						array_push($data,array('field_name'=>$field_name,'value'=>$val));
				
				
				}
			}
			//print_r($data);
			//echo $val;
			//exit;
				$last_count = "";
				$form_count =1;
				$sql2 = "select form_count from dynamic_form_data where  form_name='$form_name'
				and user_id=$user_id  group by form_count order by form_count desc limit 1";
				$getService_info = mysqli_query($link,$sql2) or die("query error".mysqli_error());
				if(mysqli_num_rows($getService_info) > 0)
				{
					while($result2 = mysqli_fetch_assoc($getService_info)) 
					{
						$last_count =$result2['form_count'];
						$form_count = $last_count + 1;
					}
				}
				
				$postdata=json_encode($data);
				$feedback_id = uniqid('fbid_');
				$query = "insert into dynamic_form_data(form_name,form_id,short_code,form_count,feedback_id,
				user_id,post_data,total_fields)
				values('$form_name','$form_id','$short_code',$form_count,'$feedback_id',$user_id,'$postdata',$total_fields)";
				mysqli_query($link,$query) or die("query error".mysqli_error());
				$last_id=mysqli_insert_id($link);
				if($last_id>0)
				{
					$getall['status'] = "200";
					$getall['message'] = "Thank you for filling out your information!...";
					$getall['feedback_id'] = $feedback_id;
				}
				else
				{
					$getall['status'] = "201";
					$getall['message'] = "Your request  failed!..";
					$getall['feedback_id'] = $feedback_id;
				}
		}
		else
		{
			$getall['status'] = "201";
			$getall['message'] = "Your request  failed!..";
			$getall['feedback_id'] = $feedback_id;
		}
		echo json_encode($getall);
}

if($_REQUEST['method']=='Insertdynamicformwithshortcode')
{
//echo "<pre>";
//print_r($_REQUEST);

		$form_name=$_REQUEST["form_name"];
		$form_id=$_REQUEST["form_id"];
		$short_code=$_REQUEST["short_code"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		$feedback_id='';
		$total_fields=0;
		$to_mobile_no=0;
		
		$sqlcampaigns_to = "select to_mobile_no from  campaigns_to
		where  user_id = '$user_id' and short_url='$short_code'";
		$getsqlcampaigns_to = mysqli_query($link,$sqlcampaigns_to) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getsqlcampaigns_to);
		if(mysqli_num_rows($getsqlcampaigns_to) > 0)
		{
		
			while($result = mysqli_fetch_assoc($getsqlcampaigns_to)) 
			{
				$to_mobile_no=$result['to_mobile_no'];
			}
			
		$sqlleadexisted = "select * from  dynamic_form_data 
		where form_name = '$form_name' AND user_id = '$user_id' and short_code='$short_code'";
		$getleadresult = mysqli_query($link,$sqlleadexisted) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getleadresult);
		if(mysqli_num_rows($getleadresult) == 0)
		{
		
		$query = "select * from  dynamic_form_structure where form_name = '$form_name' AND user_id = '$user_id'";
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) > 0)
		{
			$short_code = isset($short_code)?$short_code:"";
			$fields = array();
			$data=array();
			while($result = mysqli_fetch_assoc($getService_info)) 
			{
				$form_name=$result['form_name'];
				$form_id=$result['form_id'];
				$user_id=$result['user_id'];
				$total_fields=$result['total_fields'];
				
			      $form_structure=json_decode($result['form_structure']);
			    	$val='';
			    	
				foreach($form_structure as $key=>$form)
				{
					$field_name = str_replace(' ','_',$form->field_name);
					
					if(is_array($Request_data[$field_name]))
					{
						$str='';
						foreach($Request_data[$field_name] as $key=>$value)
						{
						      //echo $value;
							$str .= $value.'|';
						}
							$val = trim($str,"|");
					}
					else
					{
						$val = $Request_data[$field_name];
					}
						array_push($data,array('field_name'=>$field_name,'value'=>$val));
				
				
				}
			}
			//print_r($data);
			//echo $val;
			//exit;
				$last_count = "";
				$form_count =1;
				$sql2 = "select form_count from dynamic_form_data where  form_name='$form_name'
				and user_id=$user_id  group by form_count order by form_count desc limit 1";
				$getService_info = mysqli_query($link,$sql2) or die("query error".mysqli_error());
				if(mysqli_num_rows($getService_info) > 0)
				{
					while($result2 = mysqli_fetch_assoc($getService_info)) 
					{
						$last_count =$result2['form_count'];
						$form_count = $last_count + 1;
					}
				}
				
				$postdata=json_encode($data);
				$feedback_id = uniqid('fbid_');
				$query = "insert into dynamic_form_data(form_name,form_id,short_code,form_count,feedback_id,
				user_id,post_data,total_fields,to_mobile_no)
				values('$form_name','$form_id','$short_code',$form_count,'$feedback_id',$user_id,'$postdata',
				$total_fields,$to_mobile_no)";
				mysqli_query($link,$query) or die("query error".mysqli_error());
				$last_id=mysqli_insert_id($link);
				if($last_id>0)
				{
					$getall['status'] = "200";
					$getall['message'] = "Thank you for filling out your information!...";
					$getall['feedback_id'] = $feedback_id;
				}
				else
				{
					$getall['status'] = "201";
					$getall['message'] = "Your request  failed!..";
					$getall['feedback_id'] = $feedback_id;
				}
		}
		else
		{
			$getall['status'] = "201";
			$getall['message'] = "Your request  failed!..";
			$getall['feedback_id'] = $feedback_id;
		}
	}
	else
	{
		$getall['status'] = "201";
		$getall['message'] = "Your Details Already existed!..";
		$getall['feedback_id'] = $feedback_id;
	}
	
	}
	else
	{
		$getall['status'] = "201";
		$getall['message'] = "Invalid Short Code URL !..";
		$getall['feedback_id'] = $feedback_id;
	}
		echo json_encode($getall);
}

if($_REQUEST['method']=='Insertdynamicformwithshortcodeold')
{

//echo "<pre>";
//print_r($_REQUEST);
		$formname=$_REQUEST["form_name"];
		$form_id=$_REQUEST["form_id"];
		$short_code=$_REQUEST["short_code"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		$feedback_id='';
		//print_r($Request_data);
		
		$query = "select * from dynamic_form_data 
		where form_name = '$formname' AND user_id = '$user_id' and form_id='$form_id' and short_code='$short_code'";
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		$total_rows=mysqli_num_rows($getService_info);
		if(mysqli_num_rows($getService_info) == 0)
		{
		
			$query = "select * from dynamic_fields where form_name = '$formname' AND user_id = '$user_id'";
			$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
			$total_rows=mysqli_num_rows($getService_info);
			if(mysqli_num_rows($getService_info) > 0)
			{
				$short_code = isset($short_code)?$short_code:"";
				$feedback_id = uniqid('fbid_');
				$fields = array();
				$xy = 0;
				$data=array();
				while($result = mysqli_fetch_assoc($getService_info)) 
				{
					$field_name = str_replace(' ','_',$result['lname']);
					$field_id = $result['test_id'];
					$form_name = $result['form_name'];
				
					if(is_array($Request_data[$field_name]))
					{
						$str='';
						foreach($Request_data[$field_name] as $key=>$value)
						{
							$str .= $value.'|';
						}
							$val = trim($str,"|");
					}
					else
					{
						$val = $Request_data[$field_name];
					}
						array_push($data,array('field_name'=>$field_name,'field_id'=>$field_id,'value'=>$val));
					$xy++;
				}
					$last_count = "";
					$form_count =1;
					$sql2 = "select form_count from dynamic_form_data where  form_name='$form_name'
					and user_id=$user_id  group by form_count order by form_count desc limit 1";
					$getService_info = mysqli_query($link,$sql2) or die("query error".mysqli_error());
					if(mysqli_num_rows($getService_info) > 0)
					{
						while($result2 = mysqli_fetch_assoc($getService_info)) 
						{
							$last_count =$result2['form_count'];
							$form_count = $last_count + 1;
						}
					}
				
					$postdata=json_encode($data);
					$query = "insert into dynamic_form_data(form_name,form_id,short_code,form_count,feedback_id,
					user_id,post_data)
					values('$form_name','$form_id','$short_code',$form_count,'$feedback_id',$user_id,'$postdata')";
					mysqli_query($link,$query) or die("query error".mysqli_error());
					$last_id=mysqli_insert_id($link);
					if($last_id>0)
					{
						$getall['status'] = "200";
						$getall['message'] = "Thank you for filling out your information!...";
						$getall['feedback_id'] = $feedback_id;
					}
					else
					{
						$getall['status'] = "201";
						$getall['message'] = "Your request  failed!..";
						$getall['feedback_id'] = $feedback_id;
					}
			}
		
		}
		else
		{
			$getall['status'] = "201";
			$getall['message'] = "Your request  failed!..";
			$getall['feedback_id'] = $feedback_id;
		}
		
		echo json_encode($getall);
}




if($_REQUEST['method']=='getFeedbackFromResult')
{
		$form_id=$_REQUEST["form_id"];
		$short_code=$_REQUEST["short_code"];
		$user_id=$_REQUEST["user_id"];
		$user_service=$_REQUEST["user_service"];
		$Request_data=$_REQUEST["Request_data"];
		//print_r($Request_data);
		// get result data
		$query = "select * from dynamic_form_structure where form_id = '$form_id'";
		$result=array();
		$dynamic_result=array();
		$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
		if(mysqli_num_rows($getService_info) > 0)
		{
				while($row = mysqli_fetch_assoc($getService_info)) 
				{
					$result[] =$row;
				}
					
			$short_url="http://ion.bz/$short_code";
			
			$query = "select * from campaigns_to where  short_url in('$short_code','$short_url') ";
			
			$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
			if(mysqli_num_rows($getService_info) > 0)
			{
				
				// get dynamic_result
				$query = "select form_name from dynamic_fields where  form_id = '$form_id'  group by short_code";
				$getService_info = mysqli_query($link,$query) or die("query error".mysqli_error());
				if(mysqli_num_rows($getService_info) > 0)
				{
					while($result2 = mysqli_fetch_assoc($getService_info)) 
					{
						$dynamic_result[] =$result2;
						
					}
				}
			
				$status="200";
				$message="Valid Short code URL";
			
			}
			else
			{
		
				$status="201";
				$message="Invalid Short code URL";
		
			}
		}
		else
		{
		
			$status="201";
			$message="Invalid Form URL";
		
		}
		
		
		$getall['result']=$result;
		$getall['dynamic_result']=$dynamic_result;
		$getall['status']=$status;
		$getall['message']=$message;
		echo json_encode($getall);
}



?>
