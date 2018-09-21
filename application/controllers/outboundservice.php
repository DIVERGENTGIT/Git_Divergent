<?php
session_start();

class outboundservice extends CI_Controller
{
  // var  $ajaxurl;
  var  $real_url;
  var $mainserver_url_clgcrm;
   protected $_credits;
   protected $available_credits;

	public function __construct()
	{
		parent::__construct();
		 if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
		 if(!$this->session->userdata('is_crm')==1) {            
        	redirect('login');
           }
         $real_url=$this->data =$this->config->item('host_api_url1');
         
         //$mainserver_url_clgcrm=$this->config->item('host_url');
    
       
         if($this->session->userdata('user_id')) {            
        	$this->_userId = $this->session->userdata('user_id');
        	$this->load->model('user_model');
		$credits_rs = $this->user_model->getAvailableCredits($this->_userId);
	        foreach ($credits_rs as $rs) {
                $this->_credits = $rs->crm_balance;
                $data['crm_balance'] = $this->_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
	        }
        } 
	  
	}
	
/************* left  menu categories *********************/
public function get_left_menu()
{
                $real_url=$this->data;
	        $url = $real_url."/manage_menus_api.php";
		$menu_ch = curl_init();
		curl_setopt($menu_ch,CURLOPT_URL, $url);
		curl_setopt($menu_ch,CURLOPT_POST, count($_POST));
		curl_setopt($menu_ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($menu_ch, CURLOPT_RETURNTRANSFER, true);
		$menus_result = curl_exec($menu_ch);
                $menu_response = json_decode($menus_result, true);
		//print_r($menu_response);
		curl_close($menu_ch);
            return  $menu_response;
}


public function viewreports()
{
                $data['page_title'] = "Strikersoft | Report";
                $real_url=$this->data;
                $user_id =$this->session->userdata('user_id');
		if($this->uri->segment(3))
		{
		$list_id=$this->uri->segment(3);
		
		$viewreport_fields=array(
		'user_id' => $user_id,'list_id'=>$list_id);
	        $viewreport_url = $real_url."/ivr_voiceapis/campaign_viewreports.php";
		$viewreport_string = http_build_query($viewreport_fields);
                $reportch = curl_init();
	        curl_setopt($reportch,CURLOPT_URL, $viewreport_url);
		curl_setopt($reportch,CURLOPT_POST, count($_POST));
		curl_setopt($reportch,CURLOPT_POSTFIELDS, $viewreport_string);
		curl_setopt($reportch, CURLOPT_FORBID_REUSE, 1);
	        curl_setopt($reportch, CURLOPT_RETURNTRANSFER, true);
	         $viewreport_result = curl_exec($reportch);
		$viewreport_response= json_decode($viewreport_result, true);
		curl_close($reportch);
		$data['viewreport'] = $viewreport_response;
}
       if($this->uri->segment(3))
	{
		$list_id=$this->uri->segment(3);
		$blasterlistidpost_fields=array(
		'user_id' => $user_id,'list_id'=>$list_id);
                $getblasterListid_url = $real_url."/ivr_voiceapis/get_Blaster_listid_status.php";
		$blasterlistid_string = http_build_query($blasterlistidpost_fields);
		$blasterlistid_ch= curl_init();
		curl_setopt($blasterlistid_ch,CURLOPT_URL, $getblasterListid_url);
		curl_setopt($blasterlistid_ch,CURLOPT_POST, count($_POST));
		curl_setopt($blasterlistid_ch,CURLOPT_POSTFIELDS, $blasterlistid_string);
		curl_setopt($blasterlistid_ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($blasterlistid_ch, CURLOPT_RETURNTRANSFER, true);
		$blasterlistid_result = curl_exec($blasterlistid_ch);
		$blasterlistid_result_response =json_decode($blasterlistid_result, true);
		curl_close($blasterlistid_ch);
		$data['blaster_result_response'] = $blasterlistid_result_response;
//print_r($data['blaster_result_response']);
        }
                $data['crm_balance'] = $this->_credits;
	        $data['menu_response'] = $this->get_left_menu();
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/viewreports',$data);
	
}
		


public function viewreportsivrs()
{
                $data['page_title'] = "Strikersoft | Report";
                $real_url=$this->data;
                $user_id =$this->session->userdata('user_id');
		if($this->uri->segment(3))
		{
		$blaster_id=$this->uri->segment(3);
		$viewreport_fields=array(
		'user_id' => $user_id,'blaster_id'=>$blaster_id);
	        $viewreport_url = $real_url."/ivr_voiceapis/campaign_viewreportsivrs.php";
		$viewreport_string = http_build_query($viewreport_fields);
		//print_r($viewreport_string );
                $reportch = curl_init();
	        curl_setopt($reportch,CURLOPT_URL, $viewreport_url);
		curl_setopt($reportch,CURLOPT_POST, count($_POST));
		curl_setopt($reportch,CURLOPT_POSTFIELDS, $viewreport_string);
		curl_setopt($reportch, CURLOPT_FORBID_REUSE, 1);
	        curl_setopt($reportch, CURLOPT_RETURNTRANSFER, true);
	         $viewreport_result = curl_exec($reportch);
		$viewreport_response= json_decode($viewreport_result, true);
	  //print_r($viewreport_response);
		curl_close($reportch);
		$data['viewreport'] = $viewreport_response;
}

   

                $data['crm_balance'] = $this->_credits;
	        $data['menu_response'] = $this->get_left_menu();
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/viewreports_ivrs',$data);
	
}
 


   
    public function delete_audio_file()
		{
			$real_url=$this->data;
		$admin_status='';
		$user_id =$this->session->userdata('user_id');
		$ivr_id = $this->uri->segment(3);
		$admin_status='0';

		$url = $this->config->item('host_api_url')."/audiofile_insertList.php";
		$fields = array(
		'ivr_id' => urlencode($ivr_id),
		'admin_status' => urlencode($admin_status)
		);
		$fields_string = http_build_query($fields);

		//open connection
		//print_r($fields_string);

		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		print_r($result);
		curl_close($ch);
		//$rs = $this->user_model->delete_conf_room($sno,$module_id);
		redirect("outboundservice/audiofile/deleted");
    }
    

   

public function contact_list_ajax()
	{

		$user_id =$this->session->userdata('user_id');
		$this->load->model('Contact_model');
		$group_id=$_REQUEST['group_ids01'];
		$this->_data['groups'] = $group_id;
		//$contactdetails = $this->Contact_model->contact_view_ajax($this->_userId,$group_id);
		$contactdetails = $this->Contact_model->getGroupContacts_ajax($user_id,$group_id);
		//print_r($contactdetails);
		$this->_data['contactdetails'] = $contactdetails;
		    
		$this->load->view('outboundservice/contact_list_ajax_normal',$this->_data);
		
	}
	
	
		
	public function contact_list_ajax2()
	{
		  
		$user_id =$this->session->userdata('user_id');
		$this->load->model('Contact_model');
		$group_id=$_REQUEST['group_ids'];
		$this->_data['groups'] = $group_id;
		$contactdetails = $this->Contact_model->getGroupContacts_ajax($user_id,$group_id);
		$this->_data['contactdetails'] = $contactdetails;
		$this->load->view('outboundservice/contact_list_ajax',$this->_data);
		
	}
	public function contact_list_ajax3()
	{
		  
		$user_id =$this->session->userdata('user_id');
		$this->load->model('Contact_model');
		$group_id=$_REQUEST['group_ids'];
		$this->_data['groups'] = $group_id;
		$contactdetails = $this->Contact_model->getGroupContacts_ajax($user_id,$group_id);
		$this->_data['contactdetails'] = $contactdetails;
		$this->load->view('outboundservice/contact_list_ajax_blaster',$this->_data);
		
	}




/***************************************get audio files api********************************/
public function  get_audio_file_list()
{
		$real_url=$this->data;
		$user_id =$this->session->userdata('user_id');
		$getaudiofile_url = $real_url."/audiofile_insertList_clgcrm.php";
		$audiopost_fields = array(
		'user_id' => $user_id);
		$audio_string = http_build_query($audiopost_fields);
		//print_r($audio_string);
		$audio_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($audio_ch,CURLOPT_URL, $getaudiofile_url);
		curl_setopt($audio_ch,CURLOPT_POST, count($_POST));
		curl_setopt($audio_ch,CURLOPT_POSTFIELDS, $audio_string);
		curl_setopt($audio_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($audio_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$audio_result = curl_exec($audio_ch);
		$audio_result_response =json_decode($audio_result, true);
		//print_r($audio_result_response);
		curl_close($audio_ch);
		$result1=$audio_result_response;


if(count($result1)>0)
{
$result=$result1;
}
else
{
$result=array();
}

return $result;

  
}


public function  get_audio_file_list_ivrs()
{
		$real_url=$this->data;
		$user_id =$this->session->userdata('user_id');
		$getaudiofile_url = $real_url."/ivr_voiceapis/audiofile_insertList_clgcrm_ivr.php";
		$audiopost_fields = array(
		'user_id' => $user_id);
		$audio_string = http_build_query($audiopost_fields);
		//print_r($audio_string);
		$audio_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($audio_ch,CURLOPT_URL, $getaudiofile_url);
		curl_setopt($audio_ch,CURLOPT_POST, count($_POST));
		curl_setopt($audio_ch,CURLOPT_POSTFIELDS, $audio_string);
		curl_setopt($audio_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($audio_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$audio_result = curl_exec($audio_ch);
		$audio_result_response =json_decode($audio_result, true);
		//print_r($audio_result_response);
		curl_close($audio_ch);
		$result1=$audio_result_response;


if(count($result1)>0)
{
$result=$result1;
}
else
{
$result=array();
}

return $result;

  
}




public function audiofile()
{
	$data['page_title'] = "Strikersoft | audiofile";
         $data['real_path'] = $real_url=$this->data;
          //$data['real_path1'] = $audiofile_real_url=$this->data;
         $data['real_path1']=$this->config->item('host_api_url2');
	$real_url=$this->data;
	$user_id =$this->session->userdata('user_id');


/***************************************get audio files api********************************/
                   $data['audio_result_response']=$this->get_audio_file_list();
		

/*********************** insert audio file test mobile number *******************************/

          if($this->input->post('test_call_number'))
		{
                      
         $test_callfields = array('number_call' => urlencode($_POST['call_mob_num']),
		'ivr_id' => urlencode($_POST['ivr_id']),
	        'user_id' => urlencode($user_id));
                $test_call_url = $real_url."/insert_audio_file_mobile_number.php";
		$test_call_string = http_build_query($test_callfields);
//print_r($test_call_string);
		$call_ch = curl_init();
		curl_setopt($call_ch, CURLOPT_URL, $test_call_url);
		curl_setopt($call_ch,CURLOPT_POST, count($_POST));
		curl_setopt($call_ch,CURLOPT_POSTFIELDS, $test_call_string);
		curl_setopt($call_ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($call_ch, CURLOPT_RETURNTRANSFER, true);
		echo $call_result = curl_exec($call_ch);
                curl_close($call_ch);
		}
   $data['menu_response'] = $this->get_left_menu();
     $data['crm_balance'] = $this->_credits;

		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/audiofile',$data);
		//$this->load->view('/includes/footer');
}



public function ivrs_voice()
{
		$data['page_title'] = "Strikersoft | audiofile";
		$data['real_path'] = $real_url=$this->data;
		$real_url=$this->data;
		$user_id =$this->session->userdata('user_id');
		$mainserver_url_clgcrm=$this->config->item('host_url');
                $data['path'] = $this->config->item('host_url1');
            
		$data['crm_balance'] = $this->_credits;
		$price_per_pulse=$this->session->userdata('price_per_pulse');
		$pulse_per_second=$this->session->userdata('pulse_per_second');
                

	/********************insert audio files api *****************************/
		$user_id =$this->session->userdata('user_id');
		//$audiofile=urlencode(@$_REQUEST['audiofile']);
	
		if($this->input->post('audiofiles_upload'))
		{

		if (isset($_FILES['audio_file']['tmp_name'])) 
		{
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		 $mime = @finfo_file($finfo, $_FILES['audio_file']['tmp_name']);

		if ($mime == 'audio/x-wav') 
		{
		 $filename=$_FILES['audio_file']['name'];
		 $file_size=$_FILES['audio_file']['size'];
		 $temp_name=$_FILES['audio_file']['tmp_name'];
		 $host_path=base_url()."audiouploads/";
                 $time=time();
                 $basepath=$this->config->item('createaudiofilepath');
		 $dest = $basepath.$user_id.'_'.$time.'_'.$filename;
		 move_uploaded_file($_FILES['audio_file']['tmp_name'],$dest);

		 $audiofile_url = $real_url."/ivr_voiceapis/audiofile_insertList_clgcrm_ivr.php";
		$filewithid=$user_id.'_'.$time.'_'.$filename;
		$post_fields = array(
		'userid' => $user_id,
		'data' =>'@'. $_FILES['audio_file']['name']
		. ';filename=' . $_FILES['audio_file']['type'],
		'filename' =>$filewithid,
		'temp_name' =>$temp_name,
		'size' =>$file_size,
		'location' =>$host_path.$user_id.$time.$filename,
		'callback_url'=>$mainserver_url_clgcrm
		
		);
		$fields_string = http_build_query($post_fields);
		 // print_r($fields_string);
	 
		$ch_audio = curl_init();
		curl_setopt($ch_audio,CURLOPT_URL, $audiofile_url);
		//curl_setopt($ch_audio, CURLOPT_PROXY, $proxy);
		curl_setopt($ch_audio,CURLOPT_POST, count($_POST));
		curl_setopt($ch_audio,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch_audio, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch_audio, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$result = curl_exec($ch_audio);
		print_r($result);
		

	        curl_close($ch_audio);
	        
	       
		
		}
                else
		{
		echo"<script>alert('In Valid file.Please Upload .wav file');</script>";
		}
		finfo_close($finfo);
		}
		
}





$data['audiofile_id']=$this->uri->segment(3);

		if($this->input->post("submit")){
		
		$audiofile_location=@$_REQUEST['geturl'];
	   	function wavDur($file_path='') {
		$fp = fopen($file_path, 'r');
		if (fread($fp,4) == "RIFF") {
		fseek($fp, 20);
		$rawheader = fread($fp, 16);
		$header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',$rawheader);
		$pos = ftell($fp);
		while (fread($fp,4) != "data" && !feof($fp)) {
		$pos++;
		fseek($fp,$pos);
		}
		$rawheader = fread($fp, 4);
		$data = unpack('Vdatasize',$rawheader);
		$sec = @$data[datasize]/@$header[bytespersec];
		$minutes = intval(($sec / 60) % 60);
		$seconds = intval($sec % 60);
		return str_pad($minutes,2,"0", STR_PAD_LEFT).":".str_pad($seconds,2,"0", STR_PAD_LEFT);
		}
		}
	        $spltpath=str_replace("/var/www/html/","",$audiofile_location);
	        $audiofile_duration=wavDur($spltpath);
		$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $audiofile_duration);
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		$uploadaudiofile_duration = $hours * 3600 + $minutes * 60 + $seconds;
		$filename=@$_FILES['data']['name'];
		$cname=$_REQUEST['cname'];
		$max_ports=$this->session->userdata('max_ports');
		$max_participants=$this->session->userdata('max_participants');
		$no_ndnc=$this->session->userdata('no_ndnc');
		$dnd_check=$this->session->userdata('dnd_check');
		$operator=@$_REQUEST['operator'];
		$bulk_mobile_numbers=@$_REQUEST['bulk_mobile_numbers'];
		$scheduler_time=urlencode($_REQUEST['scheduler_time']);
                $blaster_announcement=@$_REQUEST['blaster_announcement'];
                $manual_bulk_numbers=@$_REQUEST['manual_bulk_numbers'];
                $ivr_options=implode(",",$_POST['ivr_options']);
		
		$basepath=$this->config->item('createcsvfilepath');
		$time=time();
		$host_path=base_url()."csvdata/";
		$dest = $basepath.$user_id.$time.$filename;
		move_uploaded_file(@$_FILES['data']['tmp_name'],$dest);
		
		
		if($filename){
		
		$moblienosfilename  = $host_path.$user_id.$time.$filename;
		$handle = fopen($moblienosfilename, "r");
                while (($data1 = fgetcsv($handle,",")) !== FALSE)
                {
				$num = count($data1);
				for($c = 0; $c<$num; $c++)
				{
				$arr[] = $data1[$c];
				}
                                $mobile_no = array_unique($arr);
		}
                $mob_no=array_unique($arr);
                $totalmobileno=count($mob_no);
                
		}
		
		if($bulk_mobile_numbers)
		{
		$mobile_numbers3=explode("\n",$bulk_mobile_numbers);
                $mobile_numbers1=array_unique($mobile_numbers3);
                $totalmobileno=count($mobile_numbers1);
		}
		if($manual_bulk_numbers)
		{
		$mobile_numbers_3=explode("\n",$manual_bulk_numbers);
                $mobile_numbers_1=array_unique($mobile_numbers_3);
                $totalmobileno=count($mobile_numbers_1);
		}
		
		$total_sce=$uploadaudiofile_duration*$totalmobileno;
              if($total_sce%$pulse_per_second)
		{
		$totalcredits=($total_sce-($total_sce%$pulse_per_second))/$pulse_per_second+1;
		$userdcredits=$totalcredits*$price_per_pulse;
		}
	      else
		{
		$totalcredits=$total_sce/$pulse_per_second;
		$userdcredits=$totalcredits*$price_per_pulse;
		}
		//$total_sce=$uploadaudiofile_duration*$totalmobileno;
		//$totalcredits= $total_sce/$pulse_per_second;
		//$userdcredits=number_format($totalcredits*$price_per_pulse,2);
	
		
		 if($this->_credits>$userdcredits)
               {
                $URL = $real_url."/ivr_voiceapis/insertList_clgcrm_ivr.php";
		$post_fields = array('user_id' => $user_id,'data' => $time.$filename,'host_path'=>$host_path,'cname'=>$cname,'bulk_mobile_numbers'=>$bulk_mobile_numbers,'manual_bulk_numbers'=>$manual_bulk_numbers,'stime'=>$scheduler_time,'max_ports'=>$max_ports,'max_participants'=>$max_participants,'no_ndnc'=>$no_ndnc,'dnd_check'=>$dnd_check,'blaster_announcement'=>$blaster_announcement,'ivr_options'=>$ivr_options,'operator'=>$operator);
		
		$fields_string = http_build_query($post_fields);
		//print_r($fields_string);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
               }
               else
               {
               $data['insuffbal']= "Insufficient Balance";
               }
		
	
		}
		
		
		
		/*************************************** audio recorder****************************/

               if($this->input->post("callrecord"))
               {
		$user_id =$this->session->userdata('user_id');
		$audiofile=urlencode($_REQUEST['audiofile']);
		$mobile=$_REQUEST['mobile'];
		
		$URL = $real_url."/ivr_voiceapis/insertAudioRecorder_clgcrm_ivr.php";
		$post_fields = array('user_id' => $user_id,'audiofile'=>$audiofile,'mobile'=>$mobile,'callback_url'=>$mainserver_url_clgcrm);
		$fields_string = http_build_query($post_fields);
		//print_r($fields_string);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		}

                $this->load->model('contact_model');
		$groups = $this->contact_model->getGroups($user_id);
		$data['groups'] = $groups;
		
		$data['audio_result_response']=$this->get_audio_file_list_ivrs();
		

		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/ivrs_voice',$data);
		//$this->load->view('/includes/footer');
}

/********************* upload audiofiles *********************************************/

public function upload_audio_files()
{
		$data['page_title'] = "Strikersoft | audiofile";
		$data['real_path'] = $real_url=$this->data;
		$data['mainserver_url_clgcrm']=$mainserver_url_clgcrm=$this->data;
		$mainserver_url_clgcrm=$this->data;
		$real_url=$this->data;
	/********************insert audio files api *****************************/
		$user_id =$this->session->userdata('user_id');
		$audiofile=urlencode(@$_REQUEST['audiofile']);
		$mobile=@$_REQUEST['mobile'];
		$filetype=@$_REQUEST['filetype'];
		$check_category=@$_REQUEST['check_category'];
		if($this->input->post('audiofiles_upload'))
		{

		if (isset($_FILES['audio_file']['tmp_name'])) 
		{
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		 $mime = @finfo_file($finfo, $_FILES['audio_file']['tmp_name']);

		if ($mime == 'audio/x-wav') 
		{
		 $filename=$_FILES['audio_file']['name'];
		 $file_size=$_FILES['audio_file']['size'];
		 $temp_name=$_FILES['audio_file']['tmp_name'];
		 $host_path=base_url()."audiouploads/";
                 $time=time();
                 $basepath=$this->config->item('createaudiofilepath');
		  $dest = $basepath.$user_id.'_'.$time.'_'.$filename;
		move_uploaded_file($_FILES['audio_file']['tmp_name'],$dest);

		$audiofile_url = $real_url."/audiofile_insertList_clgcrm.php";
		$filewithid=$user_id.'_'.$time.'_'.$filename;
		$post_fields = array(
		'userid' => $user_id,
		'data' =>'@'. $_FILES['audio_file']['name']
		. ';filename=' . $_FILES['audio_file']['type'],
		'filename' =>$filewithid,
		'temp_name' =>$temp_name,
		'size' =>$file_size,
		'location' =>$host_path.$user_id.$time.$filename,
		'audiofile'=>$audiofile,
		'mobile'=>$mobile,
		'filetype'=>$filetype,
		'callback_url'=>$mainserver_url_clgcrm,
		'check_category'=>$check_category
	
		);
		$fields_string = http_build_query($post_fields);
		
	       // print_r($fields_string);
		$ch_audio = curl_init();
		curl_setopt($ch_audio,CURLOPT_URL, $audiofile_url);
		//curl_setopt($ch_audio, CURLOPT_PROXY, $proxy);
		curl_setopt($ch_audio,CURLOPT_POST, count($_POST));
		curl_setopt($ch_audio,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch_audio, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch_audio, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$result = curl_exec($ch_audio);
		print_r($result);
		

	        curl_close($ch_audio);
	        
	       
		
		}
                else
		{
		echo"<script>alert('In Valid file.Please Upload .wav file');</script>";
		}
		finfo_close($finfo);
		}
		
}
/*************************************** audio recorder****************************/

               if($this->input->post("callrecord"))
               {
		$user_id =$this->session->userdata('user_id');
		$audiofile=urlencode($_REQUEST['audiofile']);
		$mobile=$_REQUEST['mobile'];
		$URL = $real_url."/insertAudioRecorder.php";
		$post_fields = array('user_id' => $user_id,'audiofile'=>$audiofile,'mobile'=>$mobile);
		$fields_string = http_build_query($post_fields);
		//print_r($fields_string);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		}


     $data['crm_balance'] = $this->_credits;

                //$data['menu_response'] = $this->get_left_menu();
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/upload_audio_files',$data);
		//$this->load->view('/includes/footer');
}

		public function _campain()
		{
		$real_url=$this->data;
		$audio_file=$this->uri->segment(3);
		header ("Content-type: octet/stream");
		header ("Content-disposition: attachment; filename=".$audio_file.";");
		header("Content-Length: ".filesize($audio_file));
		readfile($audio_file);
		}

		public function _audiofile()
		{
		$real_url=$this->data;
		$audio_file=$this->uri->segment(3);
		header ("Content-type: octet/stream");
		header ("Content-disposition: attachment; filename=".$audio_file.";");
		header("Content-Length: ".filesize($audio_file));
		readfile($audio_file);
		}
public function blaster()
{	
$data['page_title'] = "Strikersoft | audiofile";
 $data['real_path'] = $real_url=$this->data;
$real_url=$this->data;
$offset=0;
	if($this->uri->segment(3)!='')
	{
	$offset=$this->uri->segment(3);
	}
	$limit=10; 
$max_ports=$this->session->userdata('max_ports');
$max_participants=$this->session->userdata('max_participants');
  $no_ndnc=$this->session->userdata('no_ndnc');
  $dnd_check=$this->session->userdata('dnd_check');
$user_id=$this->session->userdata('user_id');

// get audio list
 	$getaudiofile_url = $real_url."/audiofile_insertList_clgcrm.php";
		$audiopost_fields = array(
		'user_id' => $user_id);
		$audio_string = http_build_query($audiopost_fields);
		//print_r($audio_string);
                $audio_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($audio_ch,CURLOPT_URL, $getaudiofile_url);
		curl_setopt($audio_ch,CURLOPT_POST, count($_POST));
		curl_setopt($audio_ch,CURLOPT_POSTFIELDS, $audio_string);
		curl_setopt($audio_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($audio_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$audio_result = curl_exec($audio_ch);
                $audio_result_response =json_decode($audio_result, true);
        //print_r($audio_result_response);
		curl_close($audio_ch);
		$data['audio_result_response'] = $audio_result_response;

		// campaign list
		$fields = array(
		'user_id' => $user_id		
		);
		$url = $real_url."/getList.php";
		$fields_string = http_build_query($fields);
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
	        $getdata_list = json_decode($result, true);
		curl_close($ch);
		$data['campaigns']=$getdata_list;


//  campaign reports

          $fields = array(
		'user_id' => $user_id		
		);
		$url = $real_url."/ivr_voiceapis/getCampaigns.php";
		$fields_string = http_build_query($fields);
		
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 $result = curl_exec($ch);
		   $getdata = json_decode($result, true);

			curl_close($ch);
          $data['campaignsreports']=$getdata;
	
	
	

// blaster insert


if($this->input->post("blaster")){


$list_id=$_REQUEST['list_id'];
$scheduler_time=urlencode($_REQUEST['scheduler_time']);
$blaster_type=$_REQUEST['blaster_type'];

//$audiofile=$_REQUEST['audio'];
$blaster_announcement=@$_REQUEST['blaster_announcement'];
$blaster_route=@$_REQUEST['blaster_route'];
$blaster_ivers=@$_REQUEST['blaster_ivers'];


$URL = $real_url."/insertBlaster.php";
$post_fields = array('user_id' => $user_id,'list_id' => $list_id,'stime'=>$scheduler_time,'max_ports'=>$max_ports,'max_participants'=>$max_participants,'blaster_type'=>$blaster_type,'no_ndnc'=>$no_ndnc,'dnd_check'=>$dnd_check,'blaster_announcement'=>$blaster_announcement,'blaster_route'=>$blaster_route,'blaster_ivers'=>$blaster_ivers);
//print_r($post_fields);

$fields_string = http_build_query($post_fields);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch,CURLOPT_POST, count($_POST));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
          
}
     


if($this->uri->segment(4))
        {
      $list_id=$this->uri->segment(4);
      $campaign_query=array(
      	'user_id' => $user_id,'list_id'=>$list_id);
		$camapign_download_url=$real_url."/ivr_voiceapis/download_campaign_report.php";
		$campaign_fields_string = http_build_query($campaign_query);
		//print_r($campaign_fields_string);
	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $camapign_download_url);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $campaign_fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$campaign_result = curl_exec($ch);
		//print_r($campaign_result);
		
		$campaigndownload_result= json_decode($campaign_result, true);
		//print_r($campaigndownload_result);
		
		curl_close($ch);

		$fileName = 'campaign_report.csv';
		$headerDisplayed = false;
		header("Cache-Control: must-revalidate, post-check=1, pre-check=1");
		header('Content-Description: File Transfer');
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename={$fileName}");
		header("Expires: 1");
		header("Pragma: private");
		$fh = @fopen( 'php://output', 'w' );
		foreach ($campaigndownload_result as $key => $value) {
		if ( !$headerDisplayed ) {
		fputcsv($fh, array_keys($value));
		$headerDisplayed = true;
		}
		fputcsv($fh, $value);
		}
		fclose($fh);
		exit;
     }


/***********************************get blaster files *****************************/
                $getblaster_url = $real_url."/ivr_voiceapis/get_Blaster_files.php";
		$blasterpost_fields = array(
		'user_id' => $user_id,'offset'=>$offset,'limit'=>$limit);
		$blaster_string = http_build_query($blasterpost_fields);
		//print_r($blaster_string);
                $blaster_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($blaster_ch,CURLOPT_URL, $getblaster_url);
		curl_setopt($blaster_ch,CURLOPT_POST, count($_POST));
		curl_setopt($blaster_ch,CURLOPT_POSTFIELDS, $blaster_string);
		curl_setopt($blaster_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($blaster_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$blaster_result = curl_exec($blaster_ch);
		//print_r($blaster_result);
		$blaster_result_response =json_decode($blaster_result, true);
       		curl_close($blaster_ch);
		$data['blaster_result_response'] = $blaster_result_response['blaster_result'];
        $total_rows=$blaster_result_response['total_rows'];
        
                $this->load->model('contact_model');
		$groups = $this->contact_model->getGroups($user_id);
		$data['groups'] = $groups;
		
		
/***********************************get latest blaster campaign reports *****************************/
                $getblaster_url = $real_url."/ivr_voiceapis/get_latest_blaster_campaign_reports.php";
		$blasterpost_fields = array(
		'user_id' => $user_id);
		$blaster_string = http_build_query($blasterpost_fields);
		//print_r($blaster_string);
                $blaster_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($blaster_ch,CURLOPT_URL, $getblaster_url);
		curl_setopt($blaster_ch,CURLOPT_POST, count($_POST));
		curl_setopt($blaster_ch,CURLOPT_POSTFIELDS, $blaster_string);
		curl_setopt($blaster_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($blaster_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$blaster_result = curl_exec($blaster_ch);
		//print_r($blaster_result);
		$blaster_result_response =json_decode($blaster_result, true);
       		curl_close($blaster_ch);
		$data['get_latest_blaster_campaign_reports'] = $blaster_result_response;
        
                $this->load->model('contact_model');
		$groups = $this->contact_model->getGroups($user_id);
		$data['groups'] = $groups;
		
              $data['audiofilepath']=$audiofilepath = $this->config->item('host_api_url2'); 

             $data['menu_response'] = $this->get_left_menu();   
                  $data['crm_balance'] = $this->_credits;

    $this->load->library('pagination');
	$config['base_url'] = site_url().'/outboundservice/blaster';	
	$config['total_rows'] = @$total_rows;
	$config['per_page'] = $limit; 
	$config['full_tag_open'] = "<ul class='pagination'>";
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


		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/blaster',$data);
	//$this->load->view('/includes/footer');
}





/***************************** blaser campaigns data ***********/
 public function blaster_campaign_data()
{
	
$data['page_title'] = "Strikersoft | audiofile";
$data['real_path'] = $real_url=$this->data;
$real_url=$this->data;
$mainserver_url_clgcrm=$this->config->item('host_url');
$data['path'] = $this->config->item('host_url1');
$data['crm_balance'] = $this->_credits;
 $price_per_pulse=$this->session->userdata('price_per_pulse');
 $pulse_per_second=$this->session->userdata('pulse_per_second');

	/********************insert audio files api *****************************/
		$user_id =$this->session->userdata('user_id');
		//$audiofile=urlencode(@$_REQUEST['audiofile']);
	
		if($this->input->post('audiofiles_upload'))
		{

		if (isset($_FILES['audio_file']['tmp_name'])) 
		{
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		 $mime = @finfo_file($finfo, $_FILES['audio_file']['tmp_name']);

		if ($mime == 'audio/x-wav') 
		{
		 $filename=$_FILES['audio_file']['name'];
		 $file_size=$_FILES['audio_file']['size'];
		 $temp_name=$_FILES['audio_file']['tmp_name'];
		 $host_path=base_url()."audiouploads/";
                 $time=time();
                 $basepath=$this->config->item('createaudiofilepath');
		 $dest = $basepath.$user_id.'_'.$time.'_'.$filename;
		 move_uploaded_file($_FILES['audio_file']['tmp_name'],$dest);

		 $audiofile_url = $real_url."/audiofile_insertList_clgcrm.php";
		$filewithid=$user_id.'_'.$time.'_'.$filename;
		$post_fields = array(
		'userid' => $user_id,
		'data' =>'@'. $_FILES['audio_file']['name']
		. ';filename=' . $_FILES['audio_file']['type'],
		'filename' =>$filewithid,
		'temp_name' =>$temp_name,
		'size' =>$file_size,
		'location' =>$host_path.$user_id.$time.$filename,
		'callback_url'=>$mainserver_url_clgcrm
		
		);
		$fields_string = http_build_query($post_fields);
		 // print_r($fields_string);
	 
		$ch_audio = curl_init();
		curl_setopt($ch_audio,CURLOPT_URL, $audiofile_url);
		//curl_setopt($ch_audio, CURLOPT_PROXY, $proxy);
		curl_setopt($ch_audio,CURLOPT_POST, count($_POST));
		curl_setopt($ch_audio,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch_audio, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch_audio, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$result = curl_exec($ch_audio);
		print_r($result);
		

	        curl_close($ch_audio);
	        
	       
		
		}
                else
		{
		echo"<script>alert('In Valid file.Please Upload .wav file');</script>";
		}
		finfo_close($finfo);
		}
		
}





$data['audiofile_id']=$this->uri->segment(3);

		if($this->input->post("submit")){
		
		
		$audiofile_location=@$_REQUEST['geturl'];
	   	function wavDur($file_path) {
		$fp = fopen($file_path, 'r');
		if (fread($fp,4) == "RIFF") {
		fseek($fp, 20);
		$rawheader = fread($fp, 16);
		$header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',$rawheader);
		$pos = ftell($fp);
		while (fread($fp,4) != "data" && !feof($fp)) {
		$pos++;
		fseek($fp,$pos);
		}
		$rawheader = fread($fp, 4);
		$data = unpack('Vdatasize',$rawheader);
		$sec = @$data[datasize]/@$header[bytespersec];
		$minutes = intval(($sec / 60) % 60);
		$seconds = intval($sec % 60);
		return str_pad($minutes,2,"0", STR_PAD_LEFT).":".str_pad($seconds,2,"0", STR_PAD_LEFT);
		}
		}
	        $spltpath=str_replace("/var/www/html/","",$audiofile_location);
	        $audiofile_duration=wavDur($spltpath);
		$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $audiofile_duration);
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		$uploadaudiofile_duration = $hours * 3600 + $minutes * 60 + $seconds;
		$filename=@$_FILES['data']['name'];
		$cname=$_REQUEST['cname'];
		$max_ports=$this->session->userdata('max_ports');
		$max_participants=$this->session->userdata('max_participants');
		$no_ndnc=$this->session->userdata('no_ndnc');
		$dnd_check=$this->session->userdata('dnd_check');
		$bulk_mobile_numbers=@$_REQUEST['bulk_mobile_numbers'];
		$scheduler_time=urlencode($_REQUEST['scheduler_time']);
                $blaster_announcement=@$_REQUEST['blaster_announcement'];
                $manual_bulk_numbers=@$_REQUEST['manual_bulk_numbers'];
		$basepath=$this->config->item('createcsvfilepath');
		$time=time();
	        $host_path=base_url()."csvdata/";
		$totalmobileno='';
		$dest = $basepath.$user_id.$time.$filename;
		move_uploaded_file(@$_FILES['data']['tmp_name'],$dest);
		
		if($filename){
		
		$moblienosfilename  = $host_path.$user_id.$time.$filename;
		$handle = fopen($moblienosfilename, "r");
                while (($data1 = fgetcsv($handle,",")) !== FALSE)
                {
				$num = count($data1);
				for($c = 0; $c<$num; $c++)
				{
				$arr[] = $data1[$c];
				}
                                $mobile_no = array_unique($arr);
		}
                $mob_no=array_unique($arr);
                $totalmobileno=count($mob_no);
                
		}
		
		if($bulk_mobile_numbers)
		{
		$mobile_numbers3=explode("\n",$bulk_mobile_numbers);
                $mobile_numbers1=array_unique($mobile_numbers3);
                $totalmobileno=count($mobile_numbers1);
		}
		if($manual_bulk_numbers)
		{
		$mobile_numbers_3=explode("\n",$manual_bulk_numbers);
                $mobile_numbers_1=array_unique($mobile_numbers_3);
                $totalmobileno=count($mobile_numbers_1);
		}
		
		$total_sce=$uploadaudiofile_duration*$totalmobileno;
              if($total_sce%$pulse_per_second)
		{
		$totalcredits=($total_sce-($total_sce%$pulse_per_second))/$pulse_per_second+1;
		$userdcredits=$totalcredits*$price_per_pulse;
		}
	else
		{
		$totalcredits=$total_sce/$pulse_per_second;
		$userdcredits=$totalcredits*$price_per_pulse;
		}
		 //$total_sce=$uploadaudiofile_duration*$totalmobileno;
                // $totalcredits= $total_sce/$pulse_per_second;
                 //$userdcredits=number_format($totalcredits*$price_per_pulse,2);
               if($this->_credits>$userdcredits)
               {
                 $URL = $real_url."/insertList.php";
		$post_fields = array('user_id' => $user_id,'data' => $time.$filename,'host_path'=>$host_path,'cname'=>$cname,'bulk_mobile_numbers'=>$bulk_mobile_numbers,
		'manual_bulk_numbers'=>$manual_bulk_numbers,'stime'=>$scheduler_time,'max_ports'=>$max_ports,'max_participants'=>$max_participants,'no_ndnc'=>$no_ndnc,'dnd_check'=>$dnd_check,'blaster_announcement'=>$blaster_announcement);
		
		$fields_string = http_build_query($post_fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		}
              
               else
               {
               $data['insuffbal']= "Insufficient Balance";
               }
		
	}
		
		
		
		
		/*************************************** audio recorder****************************/

               if($this->input->post("callrecord"))
               {
		$user_id =$this->session->userdata('user_id');
		$audiofile=urlencode($_REQUEST['audiofile']);
		$mobile=$_REQUEST['mobile'];
		
		$URL = $real_url."/insertAudioRecorder.php";
		$post_fields = array('user_id' => $user_id,'audiofile'=>$audiofile,'mobile'=>$mobile,'callback_url'=>$mainserver_url_clgcrm);
		$fields_string = http_build_query($post_fields);
		//print_r($fields_string);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		}

                $this->load->model('contact_model');
		$groups = $this->contact_model->getGroups($user_id);
		$data['groups'] = $groups;
                $data['audio_result_response']=$this->get_audio_file_list();
          
               
                
             // $data['menu_response'] = $this->get_left_menu();   
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/blaster_campaign_data',$data);
	//	$this->load->view('/includes/footer');
}






 public function inbound_voice()
{
	
$data['page_title'] = "Strikersoft | audiofile";
$data['real_path'] = $real_url=$this->data;
$real_url=$this->data;

$user_id=$this->session->userdata('user_id');
$data['audiofile_id']=$this->uri->segment(3);

		if($this->input->post("submit")){
		$filename=$_FILES['data']['name'];
		$cname=$_REQUEST['cname'];
		$max_ports=$this->session->userdata('max_ports');
		$max_participants=$this->session->userdata('max_participants');
		$no_ndnc=$this->session->userdata('no_ndnc');
		$dnd_check=$this->session->userdata('dnd_check');
		$bulk_mobile_numbers=@$_REQUEST['bulk_mobile_numbers'];
		$scheduler_time=urlencode($_REQUEST['scheduler_time']);
                $blaster_announcement=@$_REQUEST['blaster_announcement'];
                $manual_bulk_numbers=@$_REQUEST['manual_bulk_numbers'];
		
                 $basepath=$this->config->item('createcsvfilepath');
		$time=time();
		$host_path=base_url()."csvdata/";
		$dest = $basepath.$user_id.$time.$filename;
		move_uploaded_file($_FILES['data']['tmp_name'],$dest);
		$URL = $real_url."/insertList.php";
		$post_fields = array('user_id' => $user_id,'data' => $time.$filename,'host_path'=>$host_path,'cname'=>$cname,'bulk_mobile_numbers'=>$bulk_mobile_numbers,'manual_bulk_numbers'=>$manual_bulk_numbers,'stime'=>$scheduler_time,'max_ports'=>$max_ports,'max_participants'=>$max_participants,'no_ndnc'=>$no_ndnc,'dnd_check'=>$dnd_check,'blaster_announcement'=>$blaster_announcement);
		
		$fields_string = http_build_query($post_fields);
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		}
                $this->load->model('contact_model');
		$groups = $this->contact_model->getGroups($user_id);
		$data['groups'] = $groups;
                $data['audio_result_response']=$this->get_audio_file_list();
                     $data['crm_balance'] = $this->_credits;
             // $data['menu_response'] = $this->get_left_menu();   
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/inbound_voice',$data);
	//	$this->load->view('/includes/footer');
}


 public function inbound_reports()
{
	
$data['page_title'] = "Strikersoft | audiofile";
$data['real_path'] = $real_url=$this->data;
$real_url=$this->data;

$user_id=$this->session->userdata('user_id');
$data['audiofile_id']=$this->uri->segment(3);

		if($this->input->post("submit")){
		
		$filename=$_FILES['data']['name'];
		
		$cname=$_REQUEST['cname'];
$max_ports=$this->session->userdata('max_ports');
$max_participants=$this->session->userdata('max_participants');
$no_ndnc=$this->session->userdata('no_ndnc');
$dnd_check=$this->session->userdata('dnd_check');
		$bulk_mobile_numbers=@$_REQUEST['bulk_mobile_numbers'];
		$scheduler_time=urlencode($_REQUEST['scheduler_time']);
                $blaster_announcement=@$_REQUEST['blaster_announcement'];
                $manual_bulk_numbers=@$_REQUEST['manual_bulk_numbers'];
		
                 $basepath=$this->config->item('createcsvfilepath');
		$time=time();
		$host_path=base_url()."csvdata/";
		$dest = $basepath.$user_id.$time.$filename;
		move_uploaded_file($_FILES['data']['tmp_name'],$dest);
		$URL = $real_url."/insertList.php";
		$post_fields = array('user_id' => $user_id,'data' => $time.$filename,'host_path'=>$host_path,'cname'=>$cname,'bulk_mobile_numbers'=>$bulk_mobile_numbers,'manual_bulk_numbers'=>$manual_bulk_numbers,'stime'=>$scheduler_time,'max_ports'=>$max_ports,'max_participants'=>$max_participants,'no_ndnc'=>$no_ndnc,'dnd_check'=>$dnd_check,'blaster_announcement'=>$blaster_announcement);
		
		$fields_string = http_build_query($post_fields);
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		}
                $this->load->model('contact_model');
		$groups = $this->contact_model->getGroups($user_id);
		$data['groups'] = $groups;
                $data['audio_result_response']=$this->get_audio_file_list();
                     $data['crm_balance'] = $this->_credits;
             // $data['menu_response'] = $this->get_left_menu();   
		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/inbound_reports',$data);
	//	$this->load->view('/includes/footer');
}

/**************** call_blaster ********************************/
/***********************************get blaster files *****************************/
public function getBlasteridCampaignReport()
{
            $this->load->helper('url');
            $data['real_path'] = $real_url=$this->data;
            $real_url=$this->data;
            $user_id=$this->session->userdata('user_id');
          
            $blaster_id=$this->uri->segment(3);
            
        

            $getblaster_url = $real_url."/getBlasteridCampaignReport_api.php";
		$blasterpost_fields = array(
		'user_id' => $user_id,
		'blaster_id' => $blaster_id);
		
		$blaster_string = http_build_query($blasterpost_fields);
		//print_r($blaster_string);
                $blaster_ch= curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($blaster_ch,CURLOPT_URL, $getblaster_url);
		curl_setopt($blaster_ch,CURLOPT_POST, count($_POST));
		curl_setopt($blaster_ch,CURLOPT_POSTFIELDS, $blaster_string);
		curl_setopt($blaster_ch, CURLOPT_FORBID_REUSE, 1);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($blaster_ch, CURLOPT_RETURNTRANSFER, true);
		//execute post
		$blaster_result = curl_exec($blaster_ch);
		$blaster_result_response =json_decode($blaster_result, true);
       		curl_close($blaster_ch);
       		
		$data['get_latest_blaster_campaign_reports'] = $blaster_result_response;
		
	      //print_r($blaster_result_response);
		
	      $this->load->view('outboundservice/getBlasteridCampaignReport',$data);
	     
	     
	     
}

/*******************************getroomconferance****************************/
   public function getcampaign_numbers()
{
	$data['page_title'] = "Strikersoft | Conference Bridge";
	$user_id =$this->session->userdata('user_id');
	$real_url=$this->data;
	$fields = array(
	'user_id' => urlencode($user_id),
	'list_id' => urlencode($_REQUEST['list_id'])
	);
	$url = $real_url."/get_campaign_numbersbasedon_campaignname.php";
	$fields_string = http_build_query($fields);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($_POST));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$result1 = json_decode($result, true);
	curl_close($ch);
	if(count($result1)>0)
	{
	   $result=$result1;
	}
	else
	{
	    $result=array();
	}
	return $result;
}


public function logout()
	{     
        $real_url=$this->data;
	$user_id =$this->session->userdata('user_id');
	

           $this->session->sess_destroy();
		
		//redirect('http://10.10.10.112/sms/login.html');
		redirect('http://'.$_SERVER['SERVER_ADDR'].'/sms/login.html');
		
/*if($_SERVER['SERVER_ADDR']=='10.10.10.*'){
redirect('http://'.$_SERVER['SERVER_NAME'].'/sms/login.html');
}
else{
redirect('http://'.$_SERVER['SERVER_NAME'].'/sms/login.html');
}
*/
	}


/// download_audiofile	
	
public function download_audiofile()
{
$real_url=$this->data;
$download_url=$this->config->item('host_api_url2');
$audio_file_name=$this->uri->segment(8);
 $audio_file=$download_url.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8);

$fh = fopen($audio_file, 'r');   
$typeId = fread($fh, 4); 
$lenP = unpack('V', fread($fh, 4)); 
$len = $lenP[1]; 
$waveId = fread($fh, 4); 
header("Pragma: public"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Cache-Control: private",false); 
header( 'Content-Type: audio/x-wav');
header("Content-Transfer-Encoding: binary"); 
header ("Content-disposition: attachment; filename=".$audio_file_name.";");
header("Content-Length:$len");
readfile($audio_file);



}



public function leadcampaignmissedcallreport()
{
	

	
		$data['page_title'] = "Strikersoft | audiofile";
		$data['real_path'] = $real_url=$this->data;
		$real_url=$this->data;
		$mainserver_url_clgcrm=$this->config->item('host_url');
		$data['path'] = $this->config->item('host_url1');
		$user_id =$this->session->userdata('user_id');
		$data['crm_balance'] = $this->_credits;
		$price_per_pulse=$this->session->userdata('price_per_pulse');
		$pulse_per_second=$this->session->userdata('pulse_per_second');

		if($this->input->post("submit")){
		
		
		$audiofile_location=@$_REQUEST['geturl'];
	   	function wavDur($file_path) {
		$fp = fopen($file_path, 'r');
		if (fread($fp,4) == "RIFF") {
		fseek($fp, 20);
		$rawheader = fread($fp, 16);
		$header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',$rawheader);
		$pos = ftell($fp);
		while (fread($fp,4) != "data" && !feof($fp)) {
		$pos++;
		fseek($fp,$pos);
		}
		$rawheader = fread($fp, 4);
		$data = unpack('Vdatasize',$rawheader);
		$sec = @$data[datasize]/@$header[bytespersec];
		$minutes = intval(($sec / 60) % 60);
		$seconds = intval($sec % 60);
		return str_pad($minutes,2,"0", STR_PAD_LEFT).":".str_pad($seconds,2,"0", STR_PAD_LEFT);
		}
		}
	        $spltpath=str_replace("/var/www/html/","",$audiofile_location);
	        $audiofile_duration=wavDur($spltpath);
		$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $audiofile_duration);
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		$uploadaudiofile_duration = $hours * 3600 + $minutes * 60 + $seconds;
		
		$cname=$_REQUEST['cname'];
		$max_ports=$this->session->userdata('max_ports');
		$max_participants=$this->session->userdata('max_participants');
		$no_ndnc=$this->session->userdata('no_ndnc');
		$dnd_check=$this->session->userdata('dnd_check');
		$scheduler_time=urlencode($_REQUEST['scheduler_time']);
                $blaster_announcement=@$_REQUEST['blaster_announcement'];
                $multi_numbers=$this->input->post('multi_numbers');
                
                if($multi_numbers)
		{
		$mobile_numbers_3=explode(",",$multi_numbers);
                $mobile_numbers_1=array_unique($mobile_numbers_3);
                $totalmobileno=count($mobile_numbers_1);
		}
		else {
		$data['reselectcamp']= "Re Select Campaign";
		}
                 
               $total_sce=$uploadaudiofile_duration*$totalmobileno;
              if($total_sce%$pulse_per_second)
		{
		$totalcredits=($total_sce-($total_sce%$pulse_per_second))/$pulse_per_second+1;
		$userdcredits=$totalcredits*$price_per_pulse;
		}
	else
		{
		$totalcredits=$total_sce/$pulse_per_second;
		$userdcredits=$totalcredits*$price_per_pulse;
		}
		//echo $userdcredits;
                // echo $total_sce=$uploadaudiofile_duration*$totalmobileno;//34
               // echo  $totalcredits= $total_sce/$pulse_per_second;
               // echo  $userdcredits=number_format($totalcredits*$price_per_pulse,2);
        
               if($this->_credits>$userdcredits)
               {
                   
            
		$URL = $real_url."/missedcallcampaignresponse/leadmissedcallinsertlist.php";
		$post_fields = array('user_id' => $user_id,'stime'=>$scheduler_time,'max_ports'=>$max_ports,'max_participants'=>$max_participants,'no_ndnc'=>$no_ndnc,'dnd_check'=>$dnd_check,'blaster_announcement'=>$blaster_announcement,'multi_numbers'=>$multi_numbers,'cname'=>$cname);
		
		$fields_string = http_build_query($post_fields);
		//print_r($fields_string);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch,CURLOPT_POST, count($_POST));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		echo $result = curl_exec($ch);
		} 
		else 
		{
		$data['insuffbal']= "Insufficient Balance";
		
		}
		}
	        $data['audio_result_response']=$this->get_audio_file_list();
       		$this->load->view('includes/header',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/leadmissedcallrepoprt_campaign_data',$data);
	
}

/******************************* outbound survey ****************************/
public function create_voice_survey()
{
	
$data['page_title'] = "Strikersoft | voice survey";

		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/create_voice_survey');
	//	$this->load->view('/includes/footer');
}
public function create_campaign_survey()
{
	
$data['page_title'] = "Strikersoft | voice survey";

		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/create_campaign_survey');
	//	$this->load->view('/includes/footer');
}

public function report_survey()
{
	
$data['page_title'] = "Strikersoft | report";
   
		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/report_survey');
	//	$this->load->view('/includes/footer');
}
public function timeout_announcement()
{
	
$data['page_title'] = "Strikersoft | timeout announcement";
   
		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/timeout_announcement');
	//	$this->load->view('/includes/footer');
}
public function invalid_announcement()
{
	
$data['page_title'] = "Strikersoft | invalid announcement";
   
		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/invalid_announcement');
	//	$this->load->view('/includes/footer');
}
public function end_of_ivr()
{
	
$data['page_title'] = "Strikersoft | end of ivr";
   
		$this->load->view('includes/header');
		$this->load->view('includes/leftmenu');
		$this->load->view('outboundservice/end_of_ivr');
	//	$this->load->view('/includes/footer');
}
	
}
