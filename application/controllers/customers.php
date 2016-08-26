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
			$res=array('Response'=>"Error","Error"=>"Can not found any customer.");
		}
		else{
			
			$userInfo=$this->customers_model->findCustomer(array('id'=>$cid), $is_list=false);
			if($userInfo){
				$data['user']=$userInfo;
				$content=$this->load->view('customers/ajax_changepassword',$data,true);
				$res=array('Response'=>"Success","Message"=>$content);
			}
			else{
				$res=array('Response'=>"Error","Error"=>"Can not found any customer.");
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
	
	
	function edit($uid)
	{	
		$customerInfo= $this->customers_model->findCustomer(array('id'=> $uid));
		
		if($customerInfo){
			if($this->input->post('save'))
			{
				// do save
				$data['fullname']=$this->input->post('fullname');
				$data['email']=$this->input->post('email');
				$result= $this->customers_model->updateCustomer($data,array('id'=> $uid));
				if($result)
				{
					message_flash('Updated Successfully!');
					redirect(site_url('customers/lists'));
				}
				else{
					message_flash('Customer update failed.', 'error');
					redirect(site_url('customers/edit/'.$uid));
				}
			}
			$data['customer']=$customerInfo;
			$this->load->view('customers/edit_view', $data);
		}else{
			message_flash('Customer not found.','error');
			redirect(site_url('customers/lists'));
		}
		
	}
	
	
	function add()
	{
		
		if($this->input->post('save'))
		{
			$data['fullname']= $this->input->post('fullname');
			$data['username']= $this->input->post('username');
			$data['password']= vst_password($this->input->post('password'));
			$data['email']= $this->input->post('email');
			
			$params_where= array('username' => $this->input->post('username'));
			$condition= $this->customers_model->findCustomer($params_where);
			
			if($condition)
			{
				message_flash('This username is already registered. Please choose another one!', 'error');
				redirect('customers/add');
			}
			else
			{
				$result= $this->customers_model->addCustomer($data);
			
				if ($result == TRUE)
				{
					message_flash('Inserted Successfully!');
					redirect('customers/lists');
				}
				if($result == FALSE)
				{
					message_flash('Customer addition failed.','error');
					redirect('customers/add');
				}
			}
		}
		
		$this->load->view('customers/add_view');
	}
	
	
	function delete($uid)
	{
		
		$params_where= array('id'=> $uid);
		$result= $this->customers_model->deleteCustomer($params_where);
		if ($result)
		{
			message_flash('Deleted successfully!');
		}
		else
		{
			message_flash('Customer delete failed.','error');
		}
		redirect('customers/lists');
		
	}
}

