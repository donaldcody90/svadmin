<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends MY_Model
{
	 private $paymentaccounts = 'paymentaccounts';

     function __construct()
     {
          parent::__construct();
     }
	 
	 
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
    
	
	function getPayment($param_where)
	{
		return $this->_getwhere(array(
				'table'			=>	$this->paymentaccounts,
				'param_where'	=>	$param_where
		));
	}
	
	function editPayment($data, $param_where)
	{
		return $this->_save(array(
				'table'		=>	$this->paymentaccounts,
				'param_where'	=>	$param_where,
				'data'			=>	$data
		));
	}
	
}
?>