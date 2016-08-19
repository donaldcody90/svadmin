<?php 
if (!defined ('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('settings_model');
	}
	
	function index()
	{
		redirect('settings/edit');
	}
	
	function edit()
	{
		
		if($this->input->post('save'))
		{
			$count= 0;
			$data = array();
			$paypal = $this->input->post('paypal');
			if($paypal!='' ){
				$data1['account'] = $this->input->post('paypal');
				$param1= array('id' => 1);
				$success1= $this->settings_model->editPayment($data1, $param1);
				if($success1 == 1){	$count += 1; }
			}
			$bank = $this->input->post('bank_account');
			if($bank!=''){
				$data2['account'] = $this->input->post('bank_account');
				$param2= array('id' => 2);
				$success2= $this->settings_model->editPayment($data2, $param2);
				if($success2 == 1){	$count += 1; }
			}
			if ($count > 0)
			{
				redirect(site_url('settings/edit'));
			}
			else
			{
				message_flash("Nothing changed at all.",'error');
				redirect(site_url('settings/edit'));
			}
			
		}
		
		$param_where= array('id' => 1);
		$param_where2= array('id' => 2);
		$value['paypal']= $this->settings_model->getPayment($param_where);
		$value['bank']= $this->settings_model->getPayment($param_where2);
		
		if($value['paypal'] && $value['bank'])
		{
			$this->load->view('settings/edit_view', $value);
		}
		else{
			message_flash("Not found.",'error');
			redirect(site_url('settings/edit'));
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
