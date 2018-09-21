<?php
class alerts extends CI_Controller
{
	protected $_userId;
	
	protected $_username;
	
	protected $_no_ndnc;
	
	protected $_is_dlr_enabled;
	
	protected $_credits;
	
	protected $_international_credits;
	
	protected $_sms_port;
	
	protected $_priority_sms_count;
	
	protected $_data = array();
	
	public function __construct()
	{
		parent::__construct();
		 if(!$this->session->userdata('user_id') )   { 
			 redirect(base_url()); 
		 } 
		 
		if($this->session->userdata('user_id') ==  4857  || $this->session->userdata('user_id') ==  4904 )   {
 
			 redirect(base_url().'ftpcampaign/viewcampaigns'); 
		 }   
        
        //user details from session
        $this->_userId = $this->session->userdata('user_id');
        $this->_username = $this->session->userdata('first_name');
        $this->_no_ndnc = $this->session->userdata('no_ndnc');
        
        //priority sms count
        $this->_priority_sms_count = 100;
        
        //for the first 100 numbers sending port depenends on the ndnc
        $this->load->model('Campaign_model');
        $this->_sms_port = $this->Campaign_model->getFirstPriorityPort($this->_no_ndnc);
        //echo "sending_port :: ".$this->_sms_port;
        
        $this->_is_dlr_enabled = $this->session->userdata('dlr_enabled');
        $this->load->model('User_model');
        $credits_rs = $this->User_model->getAvailableCredits($this->_userId);
        foreach ($credits_rs as $rs) {
        	$this->_credits = $rs->available_credits;
        	$this->_international_credits = $rs->international_available_credits;
$this->_data['shorturlCredits'] =  $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
        }
        
        $this->_data['available_credits'] = $this->_credits;
        $this->_data['international_credits'] = $this->_international_credits;
        
	}

	public function index()
	{
		$this->_data['page_title'] = "SMS Alerts";
		$this->load->model('alerts_model');
		
		$total_alerts = $this->alerts_model->getAlertsCount($this->_userId);
		$off_set = $this->uri->segment(3);
		$limit = 10;
		
		$alerts_data = $this->alerts_model->getSMSAlerts($this->_userId,$off_set,$limit);
		
		foreach($alerts_data as $alert) {
			$alert_id = $alert->alert_id;
			$groups = $this->alerts_model->getAlertGroups($alert_id);
			if(count($groups) == 0) {
				$alert->groups = "All";
			} else {
				foreach($groups as $grp) {
					$groups .= $grp->group_name. ","; 
				}
				$alert->groups = substr($groups, 0, -1);
			}			
		}
		
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/alerts/index';
		$config['total_rows'] = $total_alerts;
		$config['per_page'] = $limit; 
		$this->pagination->initialize($config);
		 
		$this->_data['alerts'] = $alerts_data;
		
		$this->_data['page_title'] = "SMS Alerts";
		$this->load->view('includes/header',$this->_data);
		$this->load->view('alerts/index');
		$this->load->view('includes/footer');
	}
	
	public function add()
	{
		$this->_data['page_title'] = "Add SMS Alert";
		
		$fields = array("" => '--select--',
			'1' => 'Date of Birth',
			'2' => 'Join Date',
			'3' => 'Relieve Date'
		);
		$this->_data['field'] = $fields;
		
		if($this->input->post('add_alert')){
			$this->load->library('form_validation');			
			if ($this->form_validation->run('add_alert_form') == TRUE) {
				$group_count = $this->input->post("group_count");

                $groups = array();
                for($i=1; $i<=$group_count; $i++) {
                    $group_id = $this->input->post("group_$i");
                    if(strlen($group_id)>0 && $group_id!="") {
                        $groups[] = $group_id;
                    }
                }
                
				$field_id = $this->input->post('field');
				$field_name = $fields[$field_id];
				$days_before = $this->input->post('days_before');
				$on_time = $this->input->post('hr').":".$this->input->post('min').":00";
				$sms_txt = $this->input->post('sms_txt');
				
				$this->load->model('alerts_model');
				$alert_id = $this->alerts_model->addAlert($this->_userId, $field_id, $field_name, $days_before, $on_time, $sms_txt);

				if($alert_id) {
					foreach($groups as $group_id) {
						$this->alerts_model->alertsTo($alert_id,$group_id);
					}
					redirect('alerts/index/added/'.$alert_id);	
				}
				
			}
		}
		
		//get Groups
		$this->load->model('contact_model');
		$group_rs = $this->contact_model->getGroups($this->_userId);
		
		$groups = array();
		foreach ($group_rs as $rs) {
			$groups[$rs->group_id] = $rs->group_name;
		}
		$this->_data['groups'] = $groups;
		

		$hr = array('--select--');
		
		for($i=0; $i<24; $i++) {
			if($i < 10) {
				$j = "0".$i;
			} else {
				$j = $i;
			}
			$hr[$j] = $j;
		}
		
		$min = array('--select--');
		
		for($i=0; $i<60; $i++) {
			if($i < 10) {
				$j = "0".$i;
			} else {
				$j = $i;
			}
			$min[$j] = $j;
		}
		
		$this->_data['hr'] = $hr;
		$this->_data['min'] = $min;
		
		$this->load->view('includes/header',$this->_data);
		$this->load->view('alerts/add');
		$this->load->view('includes/footer');
	}
	
	public function changeStatus()
	{
		$alert_id = $this->uri->segment(3);
		if($alert_id) {
			$this->load->model('alerts_model');
			$alert = $this->alerts_model->getAlertDetails($this->_userId, $alert_id);
			foreach($alert as $row) {
				if($row->status == 0){
					$status = "1";
				} elseif($row->status == 1) {
					$status = "0";
				}
				$this->alerts_model->changeStatus($this->_userId, $row->alert_id, $status);
			}
			redirect("alerts/index/updated");
		}
	}
	
	public function delete()
	{
		$alert_id = $this->uri->segment(3);
		if($alert_id) {
			$this->load->model('alerts_model');
			$alert = $this->alerts_model->getAlertDetails($this->_userId, $alert_id);
			foreach($alert as $row) {
				$status = "2";
				$this->alerts_model->changeStatus($this->_userId, $row->alert_id, $status);
			}
			redirect("alerts/index/deleted");
		}
	}
	
	public function edit()
	{
		$this->_data['page_title'] = "Edit SMS Alert";
		
		$fields = array("" => '--select--',
			'1' => 'Date of Birth',
			'2' => 'Join Date',
			'3' => 'Relieve Date'
		);
		$this->_data['field'] = $fields;
		
		$alert_id = $this->uri->segment(3);
		if($alert_id) {
			
			$this->load->model('alerts_model');
			$alert = $this->alerts_model->getAlertDetails($this->_userId, $alert_id);
			
			if($alert) {
				
				if($this->input->post('edit_alert')){
				$this->load->library('form_validation');			
				if ($this->form_validation->run('add_alert_form') == TRUE) {
					$group_count = $this->input->post("group_count");
	
	                $groups = array();
	                for($i=1; $i<=$group_count; $i++) {
	                    $group_id = $this->input->post("group_$i");
	                    if(strlen($group_id)>0 && $group_id!="") {
	                        $groups[] = $group_id;
	                    }
	                }
	                
					$field_id = $this->input->post('field');
					$field_name = $fields[$field_id];
					$days_before = $this->input->post('days_before');
					$on_time = $this->input->post('hr').":".$this->input->post('min').":00";
					$sms_txt = $this->input->post('sms_txt');
					
					$this->load->model('alerts_model');
					$this->alerts_model->updateAlert($this->_userId, $alert_id, $field_id, $field_name, $days_before, $on_time, $sms_txt);
	
					if($alert_id) {
						//delete groups for a particulat alert id
						$this->alerts_model->deleteAlertsTo($alert_id);
						foreach($groups as $group_id) {
							$this->alerts_model->alertsTo($alert_id,$group_id);
						}
						redirect('alerts/index/edited/'.$alert_id);	
					}
					
				}
				}
				
				
				$this->_data['alert'] = $alert;
				//get alert for groups
				$alert_groups = $this->alerts_model->getAlertGroups($alert_id);
				$alert_grps = array();
				foreach($alert_groups as $rs) {
					$alert_grps[] = $rs->group_id;
				}
				$this->_data['alert_grps'] = $alert_grps;
								
				//get Groups
				$this->load->model('contact_model');
				$group_rs = $this->contact_model->getGroups($this->_userId);
				
				$groups = array();
				foreach ($group_rs as $rs) {
					$groups[$rs->group_id] = $rs->group_name;
				}
				$this->_data['groups'] = $groups;
				
		
				$hr = array('--select--');
				
				for($i=0; $i<24; $i++) {
					if($i < 10) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
					$hr[$j] = $j;
				}
				
				$min = array('--select--');
				
				for($i=0; $i<60; $i++) {
					if($i < 10) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
					$min[$j] = $j;
				}
				
				$this->_data['hr'] = $hr;
				$this->_data['min'] = $min;
				
				$this->load->view('includes/header',$this->_data);
				$this->load->view('alerts/edit');
				$this->load->view('includes/footer');
			}
			
		}
	}
	
}	
