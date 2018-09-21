<?php
if( !defined('BASEPATH') ) exit ('No direct script access allowed');
class Products extends CI_Controller{

	protected $_credits;
	protected $_servicetax;
	protected $_smsprice;
	protected $_longcode;
	
public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->library('session');
		$this->load->library('cart');
		if($this->session->userdata('user_id')) {            
        	$this->_userId = $this->session->userdata('user_id');
        	$this->load->model('User_model');
			$credits_rs = $this->User_model->getAvailableCredits($this->_userId);
	        foreach ($credits_rs as $rs) {
	        	$this->_credits = $rs->available_credits;
$this->_data['shorturlCredits'] = $rs->shorturl_credits;
		$this->_data['isftpuser'] = $rs->is_ftp;
	        }
	        
	     // user settings
	     
		$gbl_rs = $this->User_model->global_settings();
	        foreach ($gbl_rs as $key=>$gblrs) {
	      // print_r($gblrs);
	       //var_dump($gblrs->setting_name);
	       
	        if($gblrs->setting_name=='Service Tax')
	        {
	        $this->_servicetax = $gblrs->value;
	        }
	        else if($gblrs->setting_name=='smspricevalue')
	        {
	        $this->_smsprice = $gblrs->value;
	        }
	        else if($gblrs->setting_name=='longcode')
	        {
	        $this->_longcode = $gblrs->value;
	        }
	        
	        
	        }
        }
	}

	function index(){
	
	      $user_id=$this->session->userdata('user_id');
		
		//print_r($this->_data['products']);
		//exit;
		if($this->uri->segment(3)!='')
		$data['rowid']=	$this->uri->segment(3);
		//$this->load->view('products_view',$data);
		
		$limit="15";
		$offset='0';
		if($this->uri->segment(3)!='')
		{
		$offset=$this->uri->segment(3);
		}

		$this->_data['products'] = $this->product->get_products($user_id,$offset,$limit);
		
		$total_rows = $this->product->get_productscount($user_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/products/index';
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
			
		$this->_data['tax']=$this->_servicetax;
		$this->_data['smsprice']=$this->_smsprice;
		$this->_data['available_credits']=$this->_credits;
            $this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		//print_r($this->_data['products']);
		$this->load->view('cart_views/products_view',$this->_data);
		//$this->load->view('campaign/messages');
		$this->load->view('/includes/footer');
		
	}
	function addToCart(){
	
	
		      $user_id=$this->session->userdata('user_id');
			$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
			$user=$this->db->query($sql)->result();
			$usertype='';
			$noofsms=0;
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
			}
			}
			
		    $noofsms=trim($this->input->get('qty'));

					
					if($noofsms>0) 
					{
					$noofsms=$noofsms;
					}
					$pkg_range='';
					$sql="SELECT * FROM `sms_packages` where noofsms<=$noofsms order by id desc limit 1";
					$rs= $this->db->query($sql)->result();
					$sms_price ='';
					foreach($rs as $key=>$pricevalue)
					{
					
						  $sms_price = $pricevalue->$usertypecol;
						
					}
					$price=$sms_price;
				     $tax=$this->input->get('tax');
                           $amount=ceil($noofsms*$price);
                            $tax_amount=ceil(($amount *$tax)/100);
                            $total_amount=ceil($amount+$tax_amount);
                             
         //update_price_rowid($pid,$noofsms,$price,$amount,$tax_amount,$total_amount,$rowid)
      if($this->input->get('qty')>0) 
      {                    
		$this->product->update_price_rowid($this->input->get('id'),$this->input->get('qty'),$price,$amount,$tax_amount,
		$total_amount,$this->input->get('cartid'));

		$data = array(
		'id'      => $this->input->get('id'),
		'qty'     => $this->input->get('qty'),
		'price'   => ceil($this->input->get('qty')*$price),
		'name'    => $this->input->get('description'),
		'user_id'    => $user_id
		);
		//print_r($data);
		
		$this->cart->insert($data);
		
	print_r(json_encode(array("status"=>"success")));
	}
	else
	{
	print_r(json_encode(array("status"=>"failed")));
	}
		
	//redirect(base_url().'index.php/products/shoppingCartView');
		
	}
	
	function removeCart(){
	
	        $this->load->library('cart');
			$id = $this->input->post('pid');
						$rid = $this->input->post('rid');
			
			$this->cart->update(array('rowid'=>$rid,'qty'=>'0'));
			$result = $this->product->remove_cart_products($id);
		if($result){
			return $result;
			//redirect(base_url().'index.php/products/products_view');
		}
	}
	
function deleteCart(){
	
	        $this->load->library('cart');
	        
			//$id = $this->input->post('pid');
			//$rid = $this->input->post('rid');
			
			if($this->uri->segment(4)!='')
			{
				$rid = $this->uri->segment(4);
				$this->cart->update(array('rowid'=>$rid,'qty'=>'0'));
			}
			
			if($this->uri->segment(3)!='')
			{
			$id =$this->uri->segment(3);
			$result = $this->product->remove_cart_products($id);
			}
			
			redirect('products/index');
		
	}
	
function remove_cart_product(){
$this->load->library('cart');
$rowid = $this->input->post('rowid');
$data = array(
'rowid' => $rowid,
'qty'   => 0
);
$this->cart->update($data); 
redirect(base_url().'index.php/products/shoppingCartView');
}

function delete_cart_product(){

$this->load->library('cart');

$rowid = $this->uri->segment(4);

$data = array(
'rowid' => $rowid,
'qty'   => 0
);
$this->cart->update($data); 
redirect(base_url().'index.php/products/shoppingCartView');
}

function updateprice(){

		      $user_id=$this->session->userdata('user_id');
			$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
			$user=$this->db->query($sql)->result();
			$usertype='';
			$noofsms=0;
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
			}
			}
			
		     $noofsms=$this->input->get('noofsms');
		      
					        
							if($noofsms>0) 
							{
							 $noofsms=$noofsms;
							}
						 
					$pkg_range='';
					$sql="SELECT * FROM `sms_packages` where noofsms<=$noofsms order by id desc limit 1";
					$rs= $this->db->query($sql)->result();
					$sms_price ='';
					
					foreach($rs as $key=>$pricevalue)
					{
					
						 $sms_price = $pricevalue->$usertypecol;
						
					}
				     $price=$sms_price;
				     $tax=$this->input->get('tax');

                             /*
                             $amount=ceil($noofsms*$price);
                             $tax_amount=ceil(($amount *$tax)/100);
                             $total_amount=ceil($amount+$tax_amount);*/
                             
                             $amount=$noofsms*$price;
                             $tax_amount=round(($amount *$tax)/100);
                             $total_amount=$amount+$tax_amount;

	$this->product->update_price_rowid($this->input->get('pid'),$noofsms,$price,$amount,$tax_amount,
	$total_amount,$this->input->get('cartid'));

	$data = array(
	'id'      => $this->input->post('id'),
	'qty'     => $this->input->post('qty'),
	'price'   => ($this->input->post('qty')*$price),
	'name'    => $this->input->post('description'),
	'user_id'    => $user_id
	);
	//print_r($data);
	//$this->cart->insert($data);
	//$this->cart->update(array('rowid'=>$rid,'qty'=>'0'));
	$this->cart->update($data);
	print_r(json_encode(array("total_amount"=>$total_amount)));
}
	function shoppingCartView(){
	
		$user_id=$this->session->userdata('user_id');
		
		//print_r($this->cart->contents());
		$data['products'] = $this->cart->contents($user_id);
		//print_r($data['products']);
		
		$this->_data['tax']=$this->_servicetax;
		$this->_data['smsprice']=$this->_smsprice;
		$this->_data['available_credits']=$this->_credits;
            $this->load->view('includes/header',$this->_data);
		$this->load->view('includes/leftmenu');
		$this->load->view('cart_views/shopping-cart-view',$data);
		$this->load->view('/includes/footer');
	}

	function saveCartProducts(){
	
		$ids = Array();
		$descriptions = Array();
		$prices = Array();
		$qtys = Array();
		$ids = $this->input->post('id');
		$descriptions = $this->input->post('name');
		$prices = $this->input->post('price');
		$qtys = $this->input->post('qty');
		$result = $this->product->save_cart_products($ids,$descriptions,$prices,$qtys);
		
		
		if($result){
		
			$msg="Successfully Save...";
			echo $ids=base64_encode(implode(",",$ids));
			redirect(base_url().'index.php/Payment/confirm_order/');
			//$this->cart->destroy();
		}
		else{
			$msg="Save Failed...";
		}

		$data=array('msg' => $msg);
		$this->session->set_userdata('user',$data);
		redirect(base_url().'index.php/products/shoppingCartView');
	}
}
