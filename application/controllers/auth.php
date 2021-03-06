<?php 
if(!defined ('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth_model');
		$this->load->model('users_model');
	}
	
	
	
	
	function index()
	{
		if(is_logged_in())
		{
			redirect('customers');
		}
		$this->login();
	}
	

	
	//-------------Login------------------
	
	
	function login()
	{
		
		$username = $this->input->post('username');
        $password = $this->input->post('password');
		
		if ($this->input->post('btn_login'))
		{
			
			$data= $this->users_model->findUser( array('username'=> $username, 'password'=> vst_password($password)) );
			$role= $data['role'];
			$user_id= $data['id'];
			if(count($data)){
				$this->session->set_userdata(array(
								'logged_in'=> true,
								'user_id' => $user_id,
								'username' => $username,
								'role'	=>	$role
							));
				
				redirect('customers');
			}
			else{
				message_flash('Username or Password is not correct. Please try again!','error');
				redirect(site_url('auth/login'));
			}    
	  
		}
		else
		{
		   $this->load->view('auth/login');
		}
	
	}
	
	
	//----------------------Logout-------------------
	
	
	function logout()
	{
		
		$this->session->sess_destroy();
		redirect('auth/login');

	}
}