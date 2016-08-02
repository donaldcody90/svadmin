<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "/third_party/PHPExcel/IOFactory.php";

class Storevn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('store_model');
	}
	
	public function index()
	{
		redirect(site_url('storevn/lists_package'));

	}
	
	public function ships(){

		$this->load->view('storevn/ship');
	}

	
	public function packages(){

		$this->load->view('storevn/package');
	}

	public function check_order(){

		$shipid = $this->input->get('shipid');
		$param_where = array( 'shipid'=>$shipid );
		$result['data']  = $this->store_model->getShipid($param_where);
		$this->load->view('storevn/check_order',$result);
	}

	public function update_Ships(){

		$this->form_validation->set_rules('weight', 'Cân nặng', 'is_natural');

		if($this->form_validation->run() == TRUE){
			$data = array('is_check'=>$this->input->post('check'),'weight'=>$this->input->post('weight') );
			$param_where = array( 'id' => $this->input->post('id'));
			$result = $this->store_model->update_Ships( $data,$param_where );
			//Nếu tích chọn đã kiêm hàng thì sẽ Update thông tin người nhận hàng, ngày nhận vào bảng store_ships
			if( $this->input->post('check')==1 ){
				$currentUser=vst_getCurrentUser();
				$data_ships = array(
									'vn_receive_uid' =>  $currentUser['uid'],
									'ship_vn_status' => 1,
									'vn_ship_receive_date'=>vst_currentDate(),
								);
				$param_where_ships = array( 'shipid'=>$this->input->post('shipid') );
				$this->store_model->updateShip( $data_ships,$param_where_ships );
			}
			if($result >= 1){
				$res=array('Response'=>"Success","Message"=>"Đã thay đổi thành công" );
			}else{
				$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
			}
		}else{
			$res=array('Response'=>"Error","Error"=>"Cân nặng không được để trống và phải là số dương");
		}	
		echo json_encode($res);
	}

	public function send_package(){

		$currentUser=vst_getCurrentUser();
		$data_package = array('package_vn_status'=>1,'vn_receive_uid'=>$currentUser['uid'],'vn_package_receive_date'=> vst_currentDate() );
		$param_where_package = array( 'id' =>$this->input->post('id'));
		$result_package = $this->store_model->updatePackage( $data_package ,$param_where_package);

		if( $result_package >= 1){
			$res=array('Response'=>"Success","Message"=>"Đã nhận thành công" );
		}else{
			$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
		}

		echo json_encode($res);
	}

	public function lists_ship(){

		$filter=vst_filterData(array(),array('filter_startdate_vn_ship_receive_date','filter_enddate_vn_ship_receive_date'));
		$config = vst_pagination();
		$arr = array();
		$arr['total_rows'] = $config['total_rows'] = $this->store_model->totalShips($filter);
        $this->pagination->initialize($config);
        $start = $this->input->get('page');
		$arr['data'] =  $this->store_model->listShips($filter,$config['per_page'], $start);
		
		$this->load->view('storevn/lists_ship',$arr);
	}

	public function lists_package(){

		$filter=vst_filterData(array(),array('filter_startdate_vn_package_receive_date','filter_enddate_vn_package_receive_date'));
		$config = vst_pagination();
		$arr = array();
		$arr['total_rows'] = $config['total_rows'] = $this->store_model->totalPackages($filter,$status=true);
        $this->pagination->initialize($config);
        $start = $this->input->get('page');
		$arr['data'] =  $this->store_model->listPackages($filter,$config['per_page'], $start,$status=true);
		
		$this->load->view('storevn/lists_package',$arr);
	}

	public function updateNotePackage(){

		$data = array( 'note' => htmlspecialchars( $this->input->post('order_note')) );
		$param_where = array( 'id' => $this->input->post('id'));
		$result = $this->store_model->updatePackage( $data,$param_where );
		if($result >= 1){
			$res=array('Response'=>"Success","Message"=>"Đã thay đổi thành công" );
		}else{
			$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
		}
	
		echo json_encode($res);
	}

	public function updateNoteShip(){

		$data = array( 'note' => htmlspecialchars( $this->input->post('item_note')) );
		$param_where = array( 'shipid' => $this->input->post('shipid'));
		$result = $this->store_model->updateShip( $data,$param_where );
		if($result >= 1){
			$res=array('Response'=>"Success","Message"=>"Đã thay đổi thành công" );
		}else{
			$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
		}
	
		echo json_encode($res);
	}

}

?>