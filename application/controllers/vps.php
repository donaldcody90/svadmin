<?php 
if (!defined ('BASEPATH')) exit('No direct script access allowed');

class Vps extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
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
			$ip = $this->input->post('ip');
			if($ip!='' ){
				$data['vps_ip'] = $this->input->post('ip');
			}
			$label = $this->input->post('label');
			if($label!=''){
				$data['vps_label'] = $this->input->post('label');
			}
			$rootpass = $this->input->post('rootpass');
			if($rootpass!=''){
				$data['rootpass'] = $this->input->post('rootpass');
			}
			if(count($data) == 3 ){
				$success= $this->vps_model->editVps($data, $param_where);
				if ($success == 1)
				{
					$this->session->set_flashdata('success', TRUE);
					redirect('vps/lists');
				}
				else
				{
					$this->session->set_flashdata('error', TRUE);
					redirect('vps/edit/'.$id);
				}
				
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
		$this->form_validation->set_rules('label', 'Label', 'required|trim');
		$this->form_validation->set_rules('vps_ip', 'VPS IP', 'required|trim|valid_ip');
		$this->form_validation->set_rules('space', 'Space', 'required|trim');
		
		if($this->form_validation->run()== false)
		{
			$data['customers']= $this->customers_model->findCustomer();
			$data['servers']= $this->servers_model->findSV(array(),true);
			$this->load->view('vps/add_vps_view', $data);
		}
		
		else 
		{
			require_once APPPATH.'third_party/virtualizor/sdk/admin.php';
				
			$param_where['id']= $this->input->post('datacenter');
			$key= $this->servers_model->findSV($param_where, $is_list=false)->svkey;
			$pass= $this->servers_model->findSV($param_where, $is_list=false)->svpass;
			
			$admin = new Virtualizor_Admin_API($ip, $key, $pass);
			
			$rootpass= RandomString(30);
			$space= $this->input->post('space');
			$ram= $this->input->post('ram');
			$post= APIcreatevps_post($rootpass, $space, $ram);
			
			$output = $admin->addvs($post);
			
			print_r($output);die;
			
			if($output->error=array('') )
			{
				$data2['id']= $output->vs_info->vpsid;
				
				$data2['cid']= $this->input->post('username');
				
				$data2['svid']= $this->input->post('datacenter');
				
				if($this->input->post('label') != ''){
					$data2['vps_label']= $this->input->post('label');
				}
				
				if($this->input->post('vps_ip') != ''){
					$data2['vps_ip']= $this->input->post('vps_ip');
				}
				
				$data2['rootpass']= $rootpass;
				
				$data2['create_date']= date("Y-m-d");
				
				$data2['space']= $output->vs_info->space;
				
				$data2['ram']= $output->vs_info->ram;
				if(count($data2) == 9)
				{
					$insert= $this->vps_model->addVps($data2);
					if($insert == 1)
					{
						$this->session->set_flashdata('success', true);
					}
					else
					{
						$this->session->set_flashdata('error', true);
					}
					redirect('vps/lists');
				}
				else
				{
					redirect('vps/add');
				}
			}
			else
			{
				print_r($output->error);
			}
			
		}
	}
	
	function deletevps($id)
	{
		$params_where= array('id'=> $id);
		$result= $this->vps_model->deleteVps($params_where);
		if ($result == 1)
		{
			$this->session->set_flashdata('success', true);
		}
		else
		{
			$this->session->set_flashdata('error', true);
		}
		redirect('vps/lists');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
