<?php
class product_model extends CI_Model{

	private $table;

	function __construct(){
		parent::__construct();
		$this->table='price_enquery';
	}
	
	
	/*
	function get_products($user_id){
		$this->db->where('order_status', 0);
		$this->db->where('payment_status', 0);
		$this->db->where('registeruser_id', $user_id);
		$this->db->where_in('servicetype', 'sms');
		$this->db->order_by("id", "desc");
		$result = $this->db->get($this->table);
		//echo $this->db->last_query();
		//exit;
		return $result->result_array();
	}*/
	
	function get_products($user_id,$offset,$limit){
		$sql="select * from price_enquery where order_status=0 and payment_status=0 and registeruser_id=$user_id and servicetype='sms'
		 order by id desc limit $offset,$limit";
		 $query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return 0;
		}
	}
	
	function get_productscount($user_id){
		$sql="select * from price_enquery where order_status=0 and payment_status=0 and registeruser_id=$user_id and servicetype='sms'
		 order by id desc";
		 $query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}
	
	function save_cart_products($ids,$descriptions,$prices,$qtys){
		$this->db->trans_begin();
		$ndx=0;
		foreach($ids as $id){
			//save product to order_details table.
			$data = array('product_id' => $id,
			'description' => $descriptions[$ndx],
			'price' =>$prices[$ndx],
			'qty_ordered' =>$qtys[$ndx]);
			$this->db->insert("order_details",$data);

			//update product qty on the products table.
			$this->db->where('id',$id);
		//	$this->db->set('noofsms', "noofsms-$qtys[$ndx]", FALSE);
			$this->db->set('order_status', 0, FALSE);
			
			$this->db->update($this->table);
			//echo $this->db->last_query();exit;
			$ndx++;
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}
		else{
			$this->db->trans_commit();
			return TRUE;
		}
	}


	function remove_cart_products($id){
	/*
		$this->db->where('id', $id);
		$this->db->delete('price_enquery');
		echo $this->db->last_query();
	*/
	    $data=array('order_status'=>2,'payment_status'=>2);
	    $this->db->where('id', $id);
		$this->db->update('price_enquery',$data);
	} 
function update_price($rowid,$noofsms,$total_price){
	    $data=array('noofsms'=>$noofsms,'amount'=>$total_price);
	    $this->db->where('id', $rowid); 
		$this->db->update('price_enquery',$data);
		//echo $this->db->last_query();
	}  
	
	function update_price_rowid($pid,$noofsms,$price,$amount,$tax_amount,$total_amount,$rowid,$couponCode){
	    $data=array('noofsms'=>$noofsms,'price_per_sms'=>$price,'amount'=>$amount,'tax_amount'=>$tax_amount,'total_amount'=>$total_amount,'cartid'=>$rowid,'couponCode' => $couponCode);
	    $this->db->where('id', $pid);

		$this->db->update('price_enquery',$data);
		 // echo $this->db->last_query();
	}
}
