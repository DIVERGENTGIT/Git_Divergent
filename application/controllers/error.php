<?php
class Error extends CI_Controller
{
	
	 public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
	 $data["heading"] = "404 Page Not Found";
    $data["message"] = "You Requested the page that is no longer There";
        $this->output->set_status_header('404'); 
        $data['content'] = 'error_404'; // View name 
        $this->load->view('error',$data);//loading in my template 
    } /*
function error_404()
{ header("HTTP/1.1 404 Not Found"); 
    $data["heading"] = "404 Page Not Found";
    $data["message"] = "You Requested the page that is no longer There";
      	$this->load->view('includes/header_new',$data);
		//$this->load->view('includes/menu_new');
		   $this->load->view('error',$data);
			
		//$this->load->view('includes/footer_new');
}*/
}
?>