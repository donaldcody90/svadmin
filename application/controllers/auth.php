<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('users_model');
	}
     public function index(){
		 
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               $this->load->view('auth/login');
          }
          else
          {
               if ($this->input->post('btn_login'))
               {
				  
                    $data  = $this->users_model->findUser( array('username'=> $username,'password'=> vst_password($password),'isactive' => 1) );
					if(count($data)){
						$this->users_model->lastLogin($data['uid']);
						unset($data['password']);
						$data['roleText']=getRoleText($data['role']);
						$this->session->set_userdata('vkt_currentUser',$data);
						
						redirect(site_url("main"));
					}else{
						message_flash('Tên đăng nhập hoặc mật khẩu không đúng. Xin vui lòng nhập lại !!!','error');
						redirect(site_url('auth/login'));
					}    
              
               }else{
				   redirect(site_url('auth/login'));
			   }
          }
     }

	public function login(){
		$this->load->view('auth/login');
	}

	public function loggout(){
	 
	  if($this->session->userdata('vkt_currentUser')){
		  $this->session->unset_userdata('vkt_currentUser');
	  }
	  $this->session->sess_destroy();
	  redirect(site_url('auth/login'));
	}
}

