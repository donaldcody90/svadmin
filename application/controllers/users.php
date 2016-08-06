<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('users_model');
		$this->load->helper('server_helper');
	}
	
	
	function index()
	{

		redirect('users/lists');
	}
	
	function lists()
	{
		
		$filterData= vst_filterData(array('filter_id', 'filter_username', 'filter_firstname', 'filter_lastname', 'filter_email'));
		
		$this->load->library('pagination');
		$total= $this->users_model->totalUser($filterData);
		
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
		
		$start = $this->input->get('page');
		$limit= $config['per_page'];
		
		$data['result']= $this->users_model->listUser($filterData, $limit, $start);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		$this->load->view('users/list_user_view', $data);
	
		
	}
	
	function profile($uid)
	{
		
		if ($this->session->userdata('access') == 'Customer' && $uid != $this->session->userdata('user_id'))
		{
			redirect('auth/login');
		}
		else
		{
			$params_where= array('id'=> $uid);
			$data['row']= $this->users_model->findUser($params_where);
					
			$this->load->view('users/profile_view', $data);
		}
	
	}
	
	
	function update($uid)
	{
		
		$this->form_validation->set_rules('username', 'Username', 'alpha_numeric|min_length[3]|max_length[20]|trim|is_unique[users.username]|is_unique[customers.username]');
		$this->form_validation->set_rules('firstname', 'First name', 'min_length[2]|max_length[20]|trim');
		$this->form_validation->set_rules('lastname', 'Last name', 'min_length[2]|max_length[20]|trim');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]|trim');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|is_unique[users.email]|is_unique[customers.email]');
		
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');
		
		if ($this->form_validation->run() == false)
		{
			$params_where= array('id'=> $uid);
			$data['data']= $this->users_model->findUser($params_where);
			$this->load->view('users/edit_view', $data);
		}
		if ($this->form_validation->run() == true)
		{
			$params_where= array('id' => $uid);
			$data = array();
			$username = $this->input->post('username');
			if($username!='' ){
				$data['username'] = $this->input->post('username');
			}
			$firstname = $this->input->post('firstname');
			if($firstname!='' ){
				$data['firstname'] = $this->input->post('firstname');
			}
			$lastname = $this->input->post('lastname');
			if($lastname!=''){
				$data['lastname'] = $this->input->post('lastname');
			}
			$password = $this->input->post('password');
			if($password!=''){
				$data['password'] = hash('sha512', $this->input->post('password'));
			}
			$email = $this->input->post('email');
			if($email!=''){
				$data['email'] = $this->input->post('email');
			}
			
			if(count($data)>0 ){
				$success= $this->users_model->updateUser($data, $params_where);
				if ($success == TRUE)
				{
					$this->session->set_flashdata('success', TRUE);
				}
				else
				{
					$this->session->set_flashdata('error', TRUE);
				}
				redirect('users/lists');
			}
		}
		
		
	}
	
	
	function add()
	{
		$this->form_validation->set_rules('firstname', 'First name', 'required|min_length[2]|max_length[20]|trim');
		$this->form_validation->set_rules('lastname', 'Last name', 'required|min_length[2]|max_length[20]|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[3]|max_length[20]|trim|is_unique[users.username]|is_unique[customers.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[users.email]|is_unique[customers.email]');
		
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');
		$this->form_validation->set_message('matches', 'That is not the same password as the first one.');
		
		if ($this->form_validation->run() == false)
		{
			$this->load->view('users/add_user_view');
		}
		else
		{
			$data['firstname']= $_POST['firstname'];
			$data['lastname']= $_POST['lastname'];
			$data['username']= $_POST['username'];
			$data['password']= hash('sha512', $_POST['password']);
			$data['email']= $_POST['email'];
			$data['role']= 'Administrator';
			
			$result= $this->users_model->add_admin($data);
			
			
			if ($result == TRUE)
			{
				$this->session->set_flashdata('success', true);
				redirect('users/lists');
			}
			if($result == FALSE)
			{
				$this->session->set_flashdata('error', true);
				redirect('users/add');
			}
		}
		
		
	}
	
	
	function delete_user($uid)
	{
		$params_where= array('id'=> $uid);
		$result= $this->users_model->deleteUser($params_where);
		if ($result == true)
		{
			$this->session->set_flashdata('success', true);
		}
		else
		{
			$this->session->set_flashdata('error', true);
		}
		redirect('users/lists');
		
	}
}

