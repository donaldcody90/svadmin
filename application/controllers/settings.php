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
			
			$paypal = $this->input->post('paypal_account');
			
			$data1['meta_value'] = $this->input->post('paypal_account');
			$param1= array('id' => $this->input->post('paypal_id'));
			$success1= $this->settings_model->editSettings($data1, $param1);
			if($success1 == 1){	$count += 1; }
			
			$vietcombank = $this->input->post('vietcombank_account');
			
			$data2['meta_value'] = $this->input->post('vietcombank_account');
			$param2= array('id' => $this->input->post('vietcombank_id'));
			$success2= $this->settings_model->editSettings($data2, $param2);
			if($success2 == 1){	$count += 1; }
			
			if ($count > 0)
			{
				message_flash('Updated Successfully!');
			}
			else
			{
				message_flash('Nothing changed at all.','error');
			}
			redirect(site_url('settings/edit'));
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
			message_flash('Not found.','error');
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
