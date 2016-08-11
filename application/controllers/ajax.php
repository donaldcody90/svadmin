<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Ajax extends CI_Controller
{
	function __construct()
	{
		parent::__construct;
		$this->load->model('customers_model');
	}
	
	function index()
	{
		redirect('ajax/changepass');
		
	}
	
	function changepass($uid)
	{
		$params= array('id'=>$uid);
		$data= $this->customers_model
	}
}
