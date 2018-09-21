<?php

function validate_loginid($value) 
	{
	if(strlen($value)>45){return 0;}
        return !(empty($value)) ? (preg_match("/^[a-zA-Z0-9._@]*$/", $value)) ? 1 : 0 : 0;
    	}
function validate_password($value) 
    	{
	if(strlen($value)>64){return 0;}
        return !(empty($value)) ? (preg_match("/^[a-zA-Z0-9._@!$]*$/", $value)) ? 1 : 0 : 0;
    	}
function validate_mobilenumber($value) 
   	{
	if(strlen($value)!=10){return 0;}
   	return !(empty($value)) ? (preg_match("/^[1-9]([0-9]*)$/", $value)) ? 1 : 0 : 0;
 	}
function validate_emailid($value) 
    	{
	if(strlen($value)>45){return 0;}
        return !(empty($value)) ? (filter_var($value, FILTER_VALIDATE_EMAIL)) ? 1 : 0 : 0;
    	}
function validate_boolean($value)
    	{
	$val = trim($value);
        return ($val=='1' || $val=='0') ? 1 : 0;
    	}
function validate_numeric($value) 
    	{
        return (!(empty($value)) || $value=='0') ? (preg_match("/^([0-9]*)$/", $value)) ? 1 : 0 : 0;
    	}
function validate_float($value) 
    	{
        return (!(empty($value)) || $value=='0') ? (preg_match("/^([0-9]*)(.)([0-9]*)$/", $value)) ? 1 : 0 : 0;
    	}
function validate_money($value) 
    	{
        return (!(empty($value)) || $value=='0') ? (preg_match("/^([0-9]*)(.)([0-9]*)$/", $value)) ? 1 : 0 : 0;
    	}
function validate_string_length($value, $length)
    	{
       	return !(empty($value)) ? (strlen($value) == $length) ? 1 : 0 : 0;
    	}
function validate_string_length_between($value, $min_length, $max_length)
    	{
       	return !(empty($value)) ? ($min_length<=strlen($value) && strlen($value)<=$max_length) ? 1 : 0 : 0;
    	}
function validate_alphabet($value) 
 	{
       	return !(empty($value)) ? (preg_match("/^[a-zA-Z]*$/", $value)) ? 1 : 0 : 0;
    	}
function validate_alphanumeric($value) 
    	{
        return (!(empty($value)) || $value=='0') ? (preg_match("/^([a-zA-Z0-9]*)$/", $value)) ? 1 : 0 : 0;
    	}
function validate_string($value) 
 	{
        	return !(empty($value)) ? (preg_match("/^[a-zA-Z0-9 .,_\-+=~!@$*():;?<>|\/{}\[\]\'\"]*$/", $value)) ? 1 : 0 : 0;
    	}
function validate_datetime($value)
	{
	$d = DateTime::createFromFormat('Y-m-d H:i:s', $value);
	return ($d && $d->format('Y-m-d H:i:s') === $value  && (preg_match("/^(19|20)[0-9]{2}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):(0[0-9]|[1-5][0-9]):(0[0-9]|[1-5][0-9])$/",$value))) ? 1 : 0;
    	}
    	
function validate_date($value) 
    	{
        $d = DateTime::createFromFormat('Y-m-d', $value);
	return (($d && $d->format('Y-m-d') === $value) && (preg_match("/^(19|20)[0-9]{2}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value))) ? 1 : 0;
    	}
function validate_time($value) 
    	{
	$d = DateTime::createFromFormat('H:i:s', $value);
	return ($d && $d->format('H:i:s') === $value  && (preg_match("/^(0[0-9]|1[0-9]|2[0-3]):(0[0-9]|[1-5][0-9]):(0[0-9]|[1-5][0-9])$/",$value))) ? 1 : 0;
    	}
?>
