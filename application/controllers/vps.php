<?php 
if (!defined ('BASEPATH')) exit('No direct script access allowed');

class Vps extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		vkt_checkAdmin();
		$this->load->model('vps_model');
		$this->load->model('servers_model');
		$this->load->model('customers_model');
	}
	
	function index()
	{
		redirect('vps/lists');
	}
	
	function lists()
	{
		$filterData= vst_filterData(
					array('filter_username', 'filter_svid', 'filter_vps_label', 'filter_vps_ip', 'filter_create_date', 'filter_space', 'filter_ram' ),
					array(),
					array('username'=>'cu', 'svid'=>'v', 'vps_label'=>'v', 'vps_ip'=>'v', 'create_date'=>'v', 'space'=>'v', 'ram'=>'v')
		);
		
		$this->load->library('pagination');
		$total= $this->vps_model->total($filterData);
		
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
		
		$start= $this->input->get('page');
		$limit= $config['per_page'];
		
		$data['value']= $this->vps_model->getList($filterData, $limit, $start);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		$this->load->view('vps/list', $data);
		
	}
	
	function edit($id)
	{
		
		if($this->input->post('save'))
		{
			$param_where= array('id' => $id);
			$data = array();
			
			$data['vps_ip'] = $this->input->post('ip');
			$data['vps_label'] = $this->input->post('label');
			$data['rootpass'] = $this->input->post('rootpass');
			
			$success= $this->vps_model->editVps($data, $param_where);
			if ($success == 1)
			{
				message_flash('Updated Successfully!');
				redirect('vps/lists');
			}
			else
			{
				message_flash('VPS update failed.', 'error');
				redirect('vps/edit/'.$id);
			}
			
		}
		$param_where= array('id' => $id);
		$value['vps']= $this->vps_model->findVps($param_where);
		if($value['vps'])
		{
			$this->load->view('vps/edit', $value);
		}
		else{
			message_flash("VPS not found.",'error');
			redirect(site_url('vps/lists'));
		}
	}
	
	function add()
	{
		if($this->input->post('save'))
		{
			require_once APPPATH.'third_party/virtualizor/sdk/admin.php';
				
			$param_where['id']= $this->input->post('server');
			$key= $this->servers_model->findSV($param_where, $is_list=false)['svkey'];
			$pass= $this->servers_model->findSV($param_where, $is_list=false)['svpass'];
			$ip= $this->servers_model->findSV($param_where, $is_list=false)['ip'];
			
			$admin = new Virtualizor_Admin_API($ip, $key, $pass);
			
			$rootpass= RandomString(30);
			$space= $this->input->post('space');
			$ram= $this->input->post('ram');
			$post= APIcreatevps_post($rootpass, $space, $ram);
			
			$output = $admin->addvs($post);
			
			print_r($admin);die;
			
			if($output['error']=array('') )
			{
				if($output['vs_info']['vpsid'] != ''){
					$data2['id']= $output['vs_info']['vpsid'];
				}
				if($this->input->post('username') != ''){
					$data2['cid']= $this->input->post('username');
				}
				if($this->input->post('server') != ''){
					$data2['svid']= $this->input->post('server');
				}
				if($this->input->post('label') != ''){
					$data2['vps_label']= $this->input->post('label');
				}
				
				if($this->input->post('vps_ip') != ''){
					$data2['vps_ip']= $this->input->post('vps_ip');
				}
				
				$data2['rootpass']= $rootpass;
				
				$data2['create_date']= date("Y-m-d");
				
				if($output['vs_info']['space'] != ''){
					$data2['space']= $output['vs_info']['space'];
				}
				if($output['vs_info']['ram'] != ''){
					$data2['ram']= $output['vs_info']['ram'];
				}
				if(count($data2) == 9)
				{
					$insert= $this->vps_model->addVps($data2);
					if($insert == 1)
					{
						message_flash('Inserted Successfully!');
					}
					else
					{
						message_flash('VPS addition failed.','error');
					}
					redirect('vps/lists');
				}
				else
				{
					message_flash('VPS addition failed.','error');
					redirect('vps/add');
				}
			}
			else
			{
				print_r($output['error']);
			}
			
		}
		
		$data['customers']= $this->customers_model->findCustomer(null, true);
		$data['servers']= $this->servers_model->findSV(array(),true);
		$this->load->view('vps/add_vps_view', $data);
	}
	
	function delete($id)
	{
		$params_where= array('id'=> $id);
		$result= $this->vps_model->deleteVps($params_where);
		if ($result == 1)
		{
			message_flash('Deleted Successfully!');
		}
		else
		{
			message_flash('VPS delete failed.','error');
		}
		redirect('vps/lists');
	}
	
	
	
	
	
}
