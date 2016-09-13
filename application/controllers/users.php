<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		vkt_checkAuth();
		vkt_checkAdmin();
		$this->load->model('users_model');
		$this->load->helper('server_helper');
	}
	
	
	function index()
	{
		redirect('users/lists');
	}
	
	function lists()
	{
		
		$filterData= vst_filterData(array('filter_id', 'filter_username', 'filter_fullname', 'filter_email'));
		
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
	
	public function changepassword()
	{
		vst_authAjaxPost();
		$cid=$this->input->post('cid');
		if(!isset($cid))
			redirect(site_url('404'));
		if(empty($cid) || $cid <=0)
		{
			$res=array('Response'=>"Error","Error"=>"Can not found user.");
		}
		else{
			
			$userInfo=$this->users_model->findUser(array('id'=>$cid));
			if($userInfo){
				$data['user']=$userInfo;
				$content=$this->load->view('users/ajax_changepassword',$data,true);
				$res=array('Response'=>"Success","Message"=>$content);
			}
			else{
				$res=array('Response'=>"Error","Error"=>"Can not found user.");
			}
		}
		echo json_encode($res);
	}
	
	public function resetpassword()
	{
		
		vst_authAjaxPost();
		
		$cid = $this->input->post('uid');
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

			$result = $this->users_model->updateUser($new_pass,$params_where);
			if($result)
			{
				$res=array('Response'=>"Success","Message"=>"Thay đổi mật khẩu thành công.");	
			}else{
				$res=array('Response'=>"Error","Error"=>"Thay đổi mật khẩu không thành công.");	
			}
		
		}
		echo json_encode($res);
	}
	
	
	function exporttoExcel()
	{
		require APPPATH.'third_party/exportdata/php-export-data.class.php';
		
		$excel = new ExportDataExcel('file');
		$find= array('/', ':', ' ');
		$datetime= str_replace($find, '', vst_currentDate());
		$excel->filename = 'user_list'.$datetime.'.xls';
		$this->exportTo= "browser";
		$excel->initialize();
		
		$title= array('ID', 'Fullname', 'Username', 'Password', 'Email', 'Role');
		$excel->addRow($title);
		$filterData= vst_filterData(array('filter_id', 'filter_username', 'filter_fullname', 'filter_email'));
		$data= $this->users_model->listUser($filterData);
		foreach($data as $row)
		{
			$data_row= array();
			foreach($row as $value){
				$data_row[]= $value;
			}
			$excel->addRow($row);
		}
		$excel->finalize();
		message_flash('Export Successfully!');
		redirect(site_url('users/lists'));
	}
	
	
	function update($uid)
	{
		
		if ($this->input->post('save'))
		{
			$params_where= array('id' => $uid);
			$data = array();
			
			$data['username'] = $this->input->post('username');
			$data['fullname'] = $this->input->post('fullname');
			$data['password'] = vst_password($this->input->post('password'));
			$data['email'] = $this->input->post('email');
			
			$success= $this->users_model->updateUser($data, $params_where);
			if ($success > 0)
			{
				message_flash('Updated Successfully!');
				redirect('users/lists');
			}
			else
			{
				message_flash('User update failed.', 'error');
				redirect('users/edit/'.$uid);
			}
			
		}
		
		$params_where= array('id'=> $uid);
		$data['users']= $this->users_model->findUser($params_where);
		if(count($data['users']))
		{
			$this->load->view('users/edit_view', $data);
		}
		else{
			message_flash('User not found','error');
			redirect(site_url('users/lists'));
		}
	}
	
	
	function add()
	{
		if ($this->input->post('save'))
		{
			$data['fullname']= $this->input->post('fullname');
			$data['username']= $this->input->post('username');
			$data['password']= vst_password($this->input->post('password'));
			$data['email']= $this->input->post('email');
			$data['role']= $this->input->post('role');
			
			$params_where= array('username' => $this->input->post('username'));
			$condition= $this->users_model->findUser($params_where);
			
			if($condition)
			{
				message_flash('This username is already registered. Please choose another one!', 'error');
				redirect('users/add');
			}
			else
			{
				$result= $this->users_model->addUser($data);
				
				if ($result == 1)
				{
					message_flash('Updated Successfully!');
					redirect('users/lists');
				}
				else
				{
					message_flash('User addition failed.', 'error');
					redirect('users/add');
				}
			}
		}
		
		$this->load->view('users/add_user_view');
	}
	
	
	function delete($uid)
	{
		$params_where= array('id'=> $uid);
		$result= $this->users_model->deleteUser($params_where);
		if ($result == 1)
		{
			message_flash('Deleted Successfully!');
		}
		else
		{
			message_flash('User delete failed.', 'error');
		}
		redirect('users/lists');
		
	}
}

