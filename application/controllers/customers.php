<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('customers_model');
	}

	public function index(){
		redirect(site_url('customers/lists'));
	}

	public function lists(){
		$filter=vst_filterData(array('filter_fullname','filter_phone','filter_email','filter_username','filter_yahoo','filter_skype'));
		$config = vst_pagination();
		$arr = array();
		$arr['total_rows'] = $config['total_rows'] = $this->customers_model->totalCustomers($filter);
        $this->pagination->initialize($config);
        $start = $this->input->get('page');
		$arr['data'] =  $this->customers_model->listCustomers($filter,$config['per_page'], $start);
		$this->load->model('users_model');
		$this->load->view('customers/list',$arr);
	}

	public function delete($cid){
		$data = array( 'cid'=>$cid );
		$result = $this->customers_model->deleteCustomer($data);
		if( $result==1 ){
			message_flash('Bạn đã xóa thành công !');
			redirect(site_url('customers/lists'));
		}
	}

	public function edit($cid){
		$arr['data'] = $this->customers_model->findCustomer(array("cid"=>$cid));

		$this->load->model('users_model');
		$arr['advisory']  = $this->users_model->findUser(array("role"=>3),true);
		if($this->input->post('save')){
			$data = vst_postData();
			$params_where = array('cid'=>$cid);
			$flag = $this->customers_model->updateCustomer($data,$params_where);
			if($flag >= 1){
				message_flash('Thay đổi thông tin tài khoản  thành công');
			}
		}
		$this->load->view('customers/edit', $arr);
	}


	public function add(){

		$this->load->model('users_model');
		$arr['advisory']  = $this->users_model->findUser(array("role"=>3),true);
		if($this->input->post('save')){
			$data = vst_postData();
			$flag = $this->customers_model->updateCustomer($data,$params_where=array());
			if($flag >= 1){
				message_flash('Thêm mới khách hàng  thành công');
			}
		}
		$this->load->view('customers/add',$arr);
	}

	public function support()
	{
		vst_authAjaxPost();
		$cid=$this->input->post('cid');
		if(!isset($cid))
			redirect(site_url('404'));
		if(empty($cid) || $cid <=0)
		{
			$res=array('Response'=>"Error","Error"=>"Không tìm thấy khách hàng.");
		}else{
			$this->load->model('users_model');
			$arrAdvisory = $this->users_model->findUser(array("role"=>3),true);
			$userInfo=$this->customers_model->findCustomer(array('cid'=>$cid));
			if($userInfo){
				$data['user']=$userInfo;
				$data['advisory']=$arrAdvisory;
				$content=$this->load->view('customers/ajax_support',$data,true);
				$res=array('Response'=>"Success","Message"=>$content);
			}else{
				$res=array('Response'=>"Error","Error"=>"Không tìm thấy khách hàng.");
			}
		}
		echo json_encode($res); 
	}


	public function changesupport()
	{
		
		$cid = $this->input->post('cid');
		$username = $this->input->post('c_username');
		$uid = $this->input->post('uid');
		if( empty($uid)  )
		{
			$res=array('Response'=>"Error","Error"=>"Dữ liệu không hợp lệ.");
		}else{
			$params_where = array('cid'=>$cid);
			$data = array('uid'=> $uid );

			$result = $this->customers_model->updateCustomer($data,$params_where);
			if($result)
			{
				$res=array('Response'=>"Success","Message"=>"Thay đổi tư vấn thành công.");	
			}else{
				$res=array('Response'=>"Error","Error"=>"Thay đổi tư vấn viên không thành công.");	
			}
		
		}
		echo json_encode($res);
	}
	/*
		Func Change Password
		Ajax Post
		
	*/
	public function changepassword()
	{
		vst_authAjaxPost();
		$cid=$this->input->post('cid');
		if(!isset($cid))
			redirect(site_url('404'));
		if(empty($cid) || $cid <=0)
		{
			$res=array('Response'=>"Error","Error"=>"Không tìm thấy khách hàng.");
		}else{
			
			$userInfo=$this->customers_model->findCustomer(array('cid'=>$cid));
			if($userInfo){
				$data['user']=$userInfo;
				$content=$this->load->view('customers/ajax_changepassword',$data,true);
				$res=array('Response'=>"Success","Message"=>$content);
			}else{
				$res=array('Response'=>"Error","Error"=>"Không tìm thấy khách hàng.");
			}
		}
		echo json_encode($res); 
	}
	
	/*
		Func Change Password
		Ajax Post
		
	*/
	public function resetpassword()
	{
		
		vst_authAjaxPost();
		
		$cid = $this->input->post('cid');
		$username = $this->input->post('c_username');
		$password = $this->input->post('password');
		$confirmspassword = $this->input->post('confirmspassword');
		if( empty($cid) || empty($username) || empty($password) || empty($confirmspassword) )
		{
			$res=array('Response'=>"Error","Error"=>"Dữ liệu không hợp lệ.");
		}else if( $password != $confirmspassword ){
			$res=array('Response'=>"Error","Error"=>"Xác nhận mật khẩu không đúng.");
		}else{
			$pass = vst_password($this->input->post('password'));
			$params_where = array('cid'=>$cid);
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
}

?>