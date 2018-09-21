<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mahesh.lavanam
 * Date: 8/5/12
 * Time: 2:31 AM
 * To change this template use File | Settings | File Templates.
 */
class codes_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function getCodes($user_id,$code_type,$code=NULL)
    {
        $this->db->select('code_id,code_type,code_number')
            ->from('long_short_codes')
            ->where('user_id',$user_id)
            ->where('code_type',$code_type);

        $rs = $this->db->get();
        return $rs->result();
    }

	function getUserCodes($user_id)
	{
		$this->db->select('lsck_id,ls_keyword')
             ->from('long_short_code_keywords')
             ->where('user_id',$user_id);
            

        $rs = $this->db->get();
        return $rs->result();
	}
	
	
/*		function getUserpwd($user_id,$longcode)
	{
		$this->db->select('lsck_id,ls_keyword,code_pwd')
             ->from('long_short_code_keywords')
             ->where('user_id',$user_id)
			 ->where('ls_keyword',$longcode);

        $rs = $this->db->get();
        return $rs->result();
	}*/
    function getReceivedSMS($user_id, $code_type='', $code_id = '', $longcode_keyword='',$from_date = '', $to_date = '', $offset = '', $limit = '')
    {
        $this->db->select()
            ->from('sms_inbox')
            ->join('long_short_codes','sms_inbox.code_id = long_short_codes.code_id')
            ->where('long_short_codes.user_id',$user_id)
            ->where('long_short_codes.code_type','LONG');

        if($code_id){
            $this->db->where('long_short_codes.code_id', $code_id);
        }
        if($longcode_keyword!="ALL"){
            $this->db->where('sms_inbox.key_word', $longcode_keyword);
        }

        if($from_date) {
            $this->db->where('date(sms_inbox.created_on) >=', $from_date);
        }
        if($to_date) {
            $this->db->where('date(sms_inbox.created_on) <=', $to_date);
        }

        $this->db->order_by('sms_inbox.created_on', 'desc');

        if(strlen($limit)>0 && strlen($offset)>0){
            $this->db->limit($limit, $offset);
        }

        $rs = $this->db->get();
       // echo $this->db->last_query();
        return $rs->result();
    }
}
