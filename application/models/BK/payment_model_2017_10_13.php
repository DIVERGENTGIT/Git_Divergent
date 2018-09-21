<?php
class payment_model extends CI_Model{

	private $table;

	function __construct(){
		parent::__construct();
		$this->table='price_enquery';
	}
	
	function order_history($user_id,$from_date,$to_date,$tr_ID,$trn_status,$trn_service,$limit,$offset) {
	    
	  $payment_service='';
	 $payment_status=" AND th.payment_status IN('Transaction Successful','Transaction Cancelled')";
	      if($from_date!='')
	      {
	      $from_date= " AND DATE(th.created_on)>='$from_date'";
	      }
	    if($to_date!='')
	      {
	      $to_date= " AND DATE(th.created_on)<='$to_date'";
	      }
	 if($tr_ID!='')
	      {
	      $tr_ID= " AND th.epg_txnID='$tr_ID'";
	      $payment_status=" ";
	      }
	    if($trn_status!='')
	      {
	      $payment_status= " AND th.payment_status='$trn_status'";
	      }
	      
	      if($trn_service!='')
	      {
	      $payment_service= " AND pe.servicetype='$trn_service'";
	      }
	      
		$sql="select th.payment_id,pe.id,pe.servicetype,th.epg_txnID,th.noofsms,th.longcode_credits,th.shorturl_credits,th.total_amount,th.created_on,th.payment_status from transaction_history th INNER JOIN price_enquery pe on th.epg_txnID=pe.epg_txnID
	where th.user_id=$user_id $payment_status $from_date $to_date $tr_ID  $payment_service  group by th.payment_id order by th.payment_id desc limit $offset,$limit";
		$result=$this->db->query($sql);
		return $result->result_array();
	}
   function order_history_count($user_id,$from_date,$to_date,$tr_ID,$trn_status,$trn_service) {
    $payment_service='';
   $payment_status=" AND th.payment_status IN('Transaction Successful','Transaction Cancelled')";
	      if($from_date!='')
	      {
	      $from_date= " AND DATE(th.created_on)>='$from_date'";
	      }
	    if($to_date!='')
	      {
	      $to_date= " AND DATE(th.created_on)<='$to_date'";
	      }
	 if($tr_ID!='')
	      {
	      $tr_ID= " AND th.epg_txnID='$tr_ID'";
	      $payment_status=" ";
	      }
	    if($trn_status!='')
	      {
	      $payment_status= " AND th.payment_status='$trn_status'";
	      }
	      
	     if($trn_service!='')
	      {
	      $payment_service= " AND pe.servicetype='$trn_service'";
	      }
	      
		$sql="select th.payment_id,pe.id,pe.servicetype,th.epg_txnID,th.noofsms,th.longcode_credits,th.shorturl_credits,
		th.total_amount,th.created_on,th.payment_status from transaction_history th INNER JOIN price_enquery pe on th.epg_txnID=pe.epg_txnID
		 where th.user_id=$user_id $payment_status $from_date $to_date $tr_ID  $payment_service group by th.payment_id order by th.payment_id desc";
		
		$result=$this->db->query($sql);
		return count($result->result_array());
	}
	//5111
    function order_details($user_id,$trnid,$limit,$offset){
    
	$sql="SELECT * FROM `price_enquery` WHERE registeruser_id=$user_id and `epg_txnID` LIKE '$trnid' ORDER BY `id` DESC limit $offset,$limit";
		$result=$this->db->query($sql);
		return $result->result_array();
	}
function order_details_count($user_id,$trnid){
	$sql="SELECT * FROM `price_enquery` WHERE registeruser_id=$user_id and `epg_txnID` LIKE '$trnid' ORDER BY `id` DESC ";
		$result=$this->db->query($sql);
		return count($result->result_array());
	}

function order_details_noofsms($user_id,$trnid){
	    $sql="SELECT sum(noofsms) as noofsms FROM `price_enquery` WHERE registeruser_id=$user_id and `epg_txnID` LIKE '$trnid' ORDER BY `id` DESC ";
		$result=$this->db->query($sql);
		return $result->result();
	}
	
	public function getUserPayments($user_id,$limit,$offset)
	{
	
	$sql3="select * from user_payments where user_id=$user_id
	  order by payment_id desc limit $offset,$limit";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->result_array();
		}
		return array();
	}
	
	public function countUserPayments($user_id)
	{
	
	 $sql3="select * from user_payments where user_id=$user_id
	  order by payment_id desc ";
		$query=$this->db->query($sql3);
		if ($query->num_rows()>0) {
			return $query->num_rows();
		}
		return 0;
	}
	
	
}
