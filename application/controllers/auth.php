<?php 
if(!defined ('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}
	
	function index()
	{
		if(is_logged_in())
		{
			redirect('users');
		}
		$this->login();
	}
	

	
	//-------------Login------------------
	
	
	function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|max_length[50]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('auth/login');
		}
		else
		{
			extract($_POST);
			// $username= $this->input->post('username');
			// $password= $this->input->post('password');
			$user_id= $this->auth_model->check_login($username, $password)->id;
			$role= $this->auth_model->check_login($username, $password)->role;
			
			if(! $user_id)
			{
				//login failed
				$this->session->set_flashdata('login_error', TRUE);
				redirect('auth/login');
			}
			else
			{
				//$username= $this->Auth_model->check_login($username, $password)->username;
				$this->session->set_userdata(array(
									'logged_in'=> true,
									'user_id' => $user_id,
									'username' => $username,
									'role'=> $role
								));
				redirect('users');
			}
		}
	}
	
	
	
	//----------------------Logout-------------------
	
	
	function logout()
	{
		// $item = array('username' => '', 'logged_in' => '', 'user_id' => '', 'access' => '');
		// $this->session->unset_userdata($items);
		$this->session->sess_destroy();
		redirect('auth/login');

	}
}