<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		vkt_checkAuth();		
		$this->load->model('users_model');
	}

	public function index(){
		redirect(site_url('users/lists'));
	}

	public function lists(){
		$filter=vst_filterData(array('filter_fullname','filter_phone','filter_email','filter_username'));
		$config = vst_pagination();
		
		$arr = array();
        $arr['total_rows'] = $config['total_rows'] = $this->users_model->totalUser($filter);
		
        $this->pagination->initialize($config);
        $start = $this->input->get('page');
		$arr['data'] =  $this->users_model->listUser($filter,$config['per_page'], $start);
		$this->load->view('users/list',$arr);
	}

	public function edit($id){
		$id = (int)($id);
		$arr['data'] = $this->users_model->findUser(array("uid"=>$id));
		$data = vst_postData();
		if($this->input->post('save')){
			$params_where = array('uid'=>$id);
			$flag = $this->users_model->updateUser($data,$params_where);
			if($flag >= 1){
				message_flash('Thay đổi thông tin tài khoản  thành công');
			}
		}
		$this->load->view('users/edit', $arr);
	}

	public function add(){
		$this->load->view('users/add');
		if ($this->input->post('save')){
			$data = array(
				'username' => $this->input->post("username"),
				'password' => vst_password($this->input->post("password")),
				'fullname' => $this->input->post("fullname"),
				'phone' => $this->input->post("phone"),
				'email' => $this->input->post("email"),
				'location' => $this->input->post("location"),
				'role' => $this->input->post("role"),
			);
			$check  = $this->users_model->findUser( array('username'=> $this->input->post("username")) );
			if ( $check == 0 ){
				$res = $this->users_model->insertUser($data);
				if( $res==1 ){
					message_flash('Bạn đã thêm người dùng thành công !');
				}
			}else{
				message_flash('Tên nhân viên đã tồn tại . Xin vui lòng nhập tên khác','error');
			}
			redirect(site_url('users/add'));
		}
	}

	public function delete($uid){
		$data = array( 'uid'=>$uid );
		$result = $this->users_model->deleteUser($data);
		if( $result==1 ){
			message_flash('Bạn đã xóa thành công !');
			redirect(site_url('users/lists'));
		}
	}
	/*
		Func Change Password
		Ajax Post
		
	*/
	public function changepassword()
	{
		vst_authAjaxPost();
		$uid=$this->input->post('uid');
		if(!isset($uid))
			redirect(site_url('404'));
		if(empty($uid) || $uid <=0)
		{
			$res=array('Response'=>"Error","Error"=>"Không tìm thấy nhân viên.");
		}else{
			
			//$this->load->model("users_model");
			$userInfo=$this->users_model->findUser(array('uid'=>$uid));
			if($userInfo){
				$data['user']=$userInfo;
				$content=$this->load->view('users/ajax_changepassword',$data,true);
				$res=array('Response'=>"Success","Message"=>$content);
			}else{
				$res=array('Response'=>"Error","Error"=>"Không tìm thấy nhân viên.");
			}
		}
		echo json_encode($res); 
	}
	
	/*
		Func Change Password
		Ajax Post
		
	*/
	function resetpassword()
	{
		vst_authAjaxPost();
		
		$uid = $this->input->post('uid');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$confirmspassword = $this->input->post('confirmspassword');
		if( empty($uid) || empty($username) || empty($password) || empty($confirmspassword) )
		{
			$res=array('Response'=>"Error","Error"=>"Dữ liệu không hợp lệ.");
		}else if( $password != $confirmspassword ){
			$res=array('Response'=>"Error","Error"=>"Xác nhận mật khẩu không đúng.");
		}else{
			$pass = vst_password($this->input->post('password'));
			$params_where = array('uid'=>$uid);
			$new_pass = array('password'=> $pass );

			$this->load->model("users_model");
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
}

?>