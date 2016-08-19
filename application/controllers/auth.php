<?php 
if(!defined ('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
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
		$username = $this->input->post("username");
        $password = $this->input->post("password");
		$this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|max_length[50]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('auth/login');
		}
		else
		{
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
					message_flash('Tên đăng nhập hoặc mật khẩu không đúng. Xin vui lòng nhập lại !!!','error');
					redirect(site_url('auth/login'));
				}    
		  
		    }
			else
			{
			   redirect(site_url('auth/login'));
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