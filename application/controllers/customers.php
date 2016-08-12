<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('customers_model');
		$this->load->helper('server_helper');
	}
	
	
	function index()
	{

		redirect('customers/lists');
	}

	
	
	function lists()
	{
		
		$filterData= vst_filterData(array('filter_id', 'filter_username', 'filter_fullname', 'filter_email'));
		
		$this->load->library('pagination');
		$total= $this->customers_model->totalCustomer($filterData);
		
		$config= vst_Pagination($total);
		$this->pagination->initialize($config);
		
		$start = $this->input->get('page');
		$limit= $config['per_page'];
		
		$data['result']= $this->customers_model->listCustomer($filterData, $limit, $start);
		$data['link']= $this->pagination->create_links();
		$data['total_rows']= $total;
		$this->load->view('customers/list_view', $data);
	
		
	}
	
	public function changepassword()
	{
		vst_authAjaxPost();
		$cid=$this->input->post('cid');
		if(!isset($cid))
			redirect(site_url('404'));
		if(empty($cid) || $cid <=0)
		{
			$res=array('Response'=>"Error","Error"=>"Không tìm thấy khách hàng.");
		}
		else{
			
			$userInfo=$this->customers_model->findCustomer(array('id'=>$cid), $is_list=false);
			if($userInfo){
				$data['user']=$userInfo;
				$content=$this->load->view('customers/ajax_changepassword',$data,true);
				$res=array('Response'=>"Success","Message"=>$content);
			}
			else{
				$res=array('Response'=>"Error","Error"=>"Không tìm thấy khách hàng.");
			}
		}
		echo json_encode($res);
	}
	
	public function resetpassword()
	{
		
		vst_authAjaxPost();
		
		$cid = $this->input->post('cid');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$confirmspassword = $this->input->post('confirmspassword');
		if( empty($cid) || empty($username) || empty($password) || empty($confirmspassword) )
		{
			$res=array('Response'=>"Error","Error"=>"Dữ liệu không hợp lệ.");
		}
		else if( $password != $confirmspassword )
		{
			$res=array('Response'=>"Error","Error"=>"Xác nhận mật khẩu không đúng.");
		}
		else
		{
			$pass = vst_password($this->input->post('password'));
			$params_where = array('id'=>$cid);
			$new_pass = array('password'=> $pass );

			$result = $this->customers_model->updateCustomer($new_pass,$params_where);
			if($result)
			{
				$res=array('Response'=>"Success","Message"=>"Thay đổi mật khẩu thành công.");	
			}else{
				$res=array('Response'=>"Error","Error"=>"Thay đổi mật khẩu không thành công.");	
			}
		
		}
		echo json_encode($res);
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
			$data['row']= $this->customers_model->findCustomer($params_where, $is_list=false);
					
			$this->load->view('customers/profile_view', $data);
		}
	
	}
	
	
	function update($uid)
	{
		
		$this->form_validation->set_rules('username', 'Username', 'alpha_numeric|min_length[3]|max_length[20]|trim|is_unique[users.username]|is_unique[customers.username]');
		$this->form_validation->set_rules('fullname', 'Full name', 'min_length[2]|max_length[20]|trim');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]|trim');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|is_unique[users.email]|is_unique[customers.email]');
		
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');
		$this->form_validation->set_message('matches', 'That is not the same password as the first one.');
		
		if ($this->form_validation->run() == false)
		{
			$params_where= array('id'=> $uid);
			$data['data']= $this->customers_model->findCustomer($params_where, $is_list=false);
			$this->load->view('customers/edit_view', $data);
		}
		if ($this->form_validation->run() == true)
		{
			$params_where= array('id' => $uid);
			$data = array();
			$username = $this->input->post('username');
			if($username!='' ){
				$data['username'] = $this->input->post('username');
			}
			$fullname = $this->input->post('fullname');
			if($fullname!='' ){
				$data['fullname'] = $this->input->post('fullname');
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
				$success= $this->customers_model->updateCustomer($data, $params_where);
				if ($success > 0)
				{
					$this->session->set_flashdata('success', TRUE);
				}
				else
				{
					$this->session->set_flashdata('error', TRUE);
				}
				redirect('customers/lists');
			}
		}
		
		
	}
	
	
	function add()
	{
		$this->form_validation->set_rules('fullname', 'Full name', 'required|min_length[2]|max_length[20]|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[3]|max_length[20]|trim|is_unique[users.username]|is_unique[customers.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[users.email]|is_unique[customers.email]');
		
		$this->form_validation->set_message('is_unique', 'This %s is already registered.');
		$this->form_validation->set_message('matches', 'That is not the same password as the first one.');
		
		if ($this->form_validation->run() == false)
		{
			$this->load->view('customers/add_view');
		}
		else
		{
			$data['fullname']= $_POST['fullname'];
			$data['username']= $_POST['username'];
			$data['password']= hash('sha512', $_POST['password']);
			$data['email']= $_POST['email'];
			
			$result= $this->customers_model->addCustomer($data);
			
			
			if ($result == TRUE)
			{
				$this->session->set_flashdata('success', true);
				redirect('customers/lists');
			}
			if($result == FALSE)
			{
				$this->session->set_flashdata('error', true);
				redirect('customers/add');
			}
		}
		
		
	}
	
	
	function delete_user($uid)
	{
		$params_where= array('id'=> $uid);
		$result= $this->customers_model->deleteCustomer($params_where);
		if ($result > 0)
		{
			$this->session->set_flashdata('success', true);
		}
		else
		{
			$this->session->set_flashdata('error', true);
		}
		redirect('customers/lists');
		
	}
}

