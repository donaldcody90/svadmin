<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Servers extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		vkt_checkAdmin();
		$this->load->model('servers_model');
		$this->load->helper('server_helper');
	}
	
	function index()
	{
		redirect('servers/lists');
	}
	
	function lists()
	{	
		
		$filterData= vst_filterData(
			array('filter_id', 'filter_ip', 'filter_svkey', 'filter_svpass'),
			array(),
			array()
			);
		
		$this->load->library('pagination');
		$total= $this->servers_model->totalSV($filterData);
			
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
			
		$start = $this->input->get('page');
		$limit= $config['per_page'];
			
		$data['result']= $this->servers_model->listSV($filterData, $limit, $start);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		$this->load->view('servers/list', $data);
		
		
	}
	
	
	
	function edit($id)
	{
		
		if($this->input->post('save'))
		{
			
			$params_where= array('id' => $id);
			$data['ip']= $this->input->post('ip');
			$data['label']= $this->input->post('label');
			$data['description'] = $this->input->post('description');
			$data['svkey']= $this->input->post('key');
			$data['svpass']= $this->input->post('password');
			$data['location'] = $this->input->post('location');
			
			$success= $this->servers_model->updateSV($data, $params_where);
			if ($success == 1)
			{
				message_flash('Updated Successfully!','success');
			}
			else
			{
				message_flash('Server update failed.','error');
			}
			redirect('servers/lists');
			
		}
		// get SV info by id
		$datacenter = $this->servers_model->findSV(array('id'=>$id));
		if($datacenter)
		{
			$data['server']=$datacenter;
			$this->load->view('servers/edit',$data);
		}else{
			message_flash('Server not found.','error');
			redirect(site_url('servers/lists'));
		}
	}
	
	
	
	
	function add()
	{
		
		if($this->input->post('save'))
		{
			$data['ip']= $this->input->post('ip');
			$data['label']= $this->input->post('label');
			$data['description'] = $this->input->post('description');
			$data['svkey']= $this->input->post('key');
			$data['svpass']= $this->input->post('password');
			$data['location'] = $this->input->post('location');
			
			$result= $this->servers_model->addSV($data);
			
			if ($result == 1)
			{
				message_flash('Inserted Successfully!');
				redirect('servers/lists');
			}
			else
			{
				message_flash('Server addition failed.','error');
				redirect('servers/add');
			}
		}
		
		$this->load->view('servers/add');
	}
	
	
	function delete($uid)
	{
		
			$params_where= array('id'=> $uid);
			$result= $this->servers_model->deleteSV($params_where);
			
			if ($result == 1)
			{
				message_flash('Deleted Successfully!');
			}
			else
			{
				message_flash('Server delete failed.','error');
			}
			redirect('servers/lists');
	}
	
	
	
	
	
	
	
	
	
	// function restart($id)
	// {
		// $id1= $id;
		// $params_where= array('id' => $id1);
		// $result= $this->servers_model->findSV($params_where, $is_list=false);
		// $ip= $result->ip;
		// $key= $result->svkey;
		// $pass= $result->svpass;
		// $output= sv_restart($ip, $key, $pass);
		// redirect('servers/lists');
	// }
	
	
	// function stop($id)
	// {
		// $id1= $id;
		// $params_where= array('id' => $id1);
		// $result= $this->servers_model->findSV($params_where, $is_list=false);
		// $ip= $result->ip;
		// $key= $result->svkey;
		// $pass= $result->svpass;
		// $output= sv_stop($ip, $key, $pass);
		// redirect('servers/lists');
	// }
	
	
	// function start($id)
	// {
		// $id1= $id;
		// $params_where= array('id' => $id1);
		// $result= $this->servers_model->findSV($params_where, $is_list=false);
		// $ip= $result->ip;
		// $key= $result->svkey;
		// $pass= $result->svpass;
		// $output= sv_start($ip, $key, $pass);
		// redirect('servers/lists');
	// }
	
	// function getlist()
	// {
		// require_once APPPATH.'third_party/virtualizor/sdk/admin.php';
		
		// $key =  'yvpuctwv6sdyymgagxsga4pedom1rwte';
		// $pass = 'igrdzwnadpxzx18xevlmktw178ybrksc';
		// $ip = '46.166.139.241';
		
		// $admin = new Virtualizor_Admin_API($ip, $key, $pass);

		// $output = $admin->status(1002);
		
		// if($output == 1){
			 // echo 'VPS is currently running';
		// }
	// }
	
	// function update($uid)
	// {
		// $this->form_validation->set_rules('ip', 'IP Address', 'valid_ip|is_unique[servers.ip]|trim');
		// $this->form_validation->set_rules('label', 'Label', 'min_length[6]|trim');
		// $this->form_validation->set_rules('key', 'Key', 'min_length[6]|trim');
		// $this->form_validation->set_rules('password', 'Password', 'min_length[6]|trim');
		
		// $this->form_validation->set_message('is_unique', 'This %s is already registered.');
		
		// if ($this->form_validation->run() == false)
		// {
			// $params_where= array('id'=> $uid);
			// $data['value']= $this->servers_model->findSV($params_where);
			// var_dump($data['value']);
			// $this->load->view('servers/edit_view', $data);
		// }
		// if ($this->form_validation->run() == true)
		// {
			// $params_where= array('id' => $uid);
			// $data = array();
			// $ip = $this->input->post('ip');
			// if($ip!='' ){
				// $data['ip'] = $this->input->post('ip');
			// }
			// $svkey = $this->input->post('key');
			// if($svkey!=''){
				// $data['svkey'] = $this->input->post('key');
			// }
			// $password = $this->input->post('password');
			// if($password!=''){
				// $data['svpass'] = $this->input->post('password');
			// }
			// if(count($data)>0 ){
				// $success= $this->servers_model->updateSV($data, $params_where);
				// if ($success == 1)
				// {
					// $this->session->set_flashdata('success', TRUE);
				// }
				// else
				// {
					// $this->session->set_flashdata('error', TRUE);
				// }
				// redirect('servers/lists');
			// }
		// }
		
	// }
	
}