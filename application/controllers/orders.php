<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('orders_model');
	}
	
	public function index()
	{
		redirect(site_url('orders/lists'));

	}

	public function deal(){
		$this->load->view('orders/deal');
	}

	public function transport(){
		$this->load->view('orders/transport');
	}

	public function complain(){
		$this->load->view('orders/complain');
	}
	
	public function lists(){
		$filter=vst_filterData(array('filter_fullname','filter_phone','filter_email','filter_username'));
		$config = vst_pagination();
		
        $start = $this->input->get('page');
		$flag=  $this->orders_model->listOrder($filter,$config['per_page'], $start);
		$arr['data']  = $flag['list'];
		$arr['total_rows']  = $config['total_rows']=$this->orders_model->totalOrder($filter);
        $arr['order_status_list']= $this->orders_model->getOrderStatusSummury();
        $this->pagination->initialize($config);
		$this->load->view('orders/list',$arr);
	}

	public function detail($oid){
		$oid = (int)($oid);
		$arr['order'] = $this->orders_model->getDetailOrder($oid);
		$this->load->view('orders/detail',$arr);
	}
	public function updateOrder(){

		$this->form_validation->set_rules('fee_service_percent', 'Fee_service_percent ', 'required|is_natural');

		if($this->form_validation->run() == TRUE){
			$data = array( 'order_note' => htmlspecialchars( $this->input->post('order_note') ),'fee_service_percent'=>$this->input->post('fee_service_percent'),'status'=>$this->input->post('status') );
			$param_where = array( 'id' => $this->input->post('oid'));
			$result = $this->orders_model->updateOrder( $data,$param_where );
			if($result >= 1){
				$res=array('Response'=>"Success","Message"=>"Đã thay đổi thành công" );
			}else{
				$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
			}
		}else{
			$res=array('Response'=>"Error","Error"=>"Phần trăm dịch vụ không được để trống và phải là số dương");
		}	
		echo json_encode($res);
	}

	public function updateSeller(){

		$this->form_validation->set_rules('fee_shipnd', 'Fee_shipnd ', 'is_natural');

		if($this->form_validation->run() == TRUE){
			$data = array( 'fee_shipnd' =>$this->input->post('fee_shipnd'),'shopid'=>$this->input->post('shopid') );
			$param_where = array( 'id' => $this->input->post('id') );
			$result = $this->orders_model->updateSeller( $data,$param_where );
			if($result >= 1){
				$res=array('Response'=>"Success","Message"=>"Đã thay đổi thành công" );
			}else{
				$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
			}
		}else{
			$res=array('Response'=>"Error","Error"=>"Phí nội địa phải là số dương");
		}	
		echo json_encode($res);
	}

	public function insertShip(){

		$this->form_validation->set_rules('shipid', 'Shipid ', 'required');

		if($this->form_validation->run() == TRUE){
			$data = array( 'oid' =>$this->input->post('oid'),'sid'=>$this->input->post('sid'),'shipid'=> $this->input->post('shipid'));
			$result = $this->orders_model->insertShip( $data );
			if($result >= 1){
				$res=array('Response'=>"Success","Message"=>"Đã thêm vận đơn thành công" ,"list_shipid" =>"<li>".$this->input->post('shipid')."</li>","sid" =>$this->input->post('sid') );
			}else{
				$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
			}
		}else{
			$res=array('Response'=>"Error","Error"=>"Vận đơn không được để trống");
		}
	
		echo json_encode($res);
	}

	public function update_item_quantity(){

		$this->form_validation->set_rules('item_quantity', 'Item_quantity ', 'required|is_natural');

		if($this->form_validation->run() == TRUE){
			$data = array( 'item_quantity' => $this->input->post('item_quantity') );
			$param_where = array( 'id' => $this->input->post('id_item'));
			$result = $this->orders_model->updateItem( $data,$param_where );
			if($result >= 1){
				$res=array('Response'=>"Success","Message"=>"Thay đổi thành công" );
			}else{
				$res=array('Response'=>"Error","Error"=>"Giá trị không thay đổi");
			}
		}else{
			$res=array('Response'=>"Error","Error"=>"Số lượng sản phẩm không được để trống và phải là số dương");
		}	
		echo json_encode($res);
	}

	public function hethang(){

		$sid = $this->input->post('sid');

		$data_item_quantity = array( 'item_quantity' => 0 );
		$param_where_item_quantity = array( 'sid' => $sid );
		$result_item_quantity  = $this->orders_model->updateItem( $data_item_quantity,$param_where_item_quantity );

		$data_fee_shipnd = array( 'fee_shipnd' => 0 );
		$param_where_fee_shipnd = array( 'id' => $sid );
		$result_fee_shipnd = $this->orders_model->updateSeller( $data_fee_shipnd,$param_where_fee_shipnd );

		if($result_item_quantity >= 1 || $result_fee_shipnd >= 1){
			$res=array('Response'=>"Success","Message"=>"Cập nhật thành công" );
		}else{
			$res=array('Response'=>"Error","Error"=>"Giá trị không thay đổi");
		}
		echo json_encode($res);
	}

	public function deleteVandon(){

		$param_where = array( 'id' => $this->input->post('shipid'));
		$result = $this->orders_model->deleteShip($param_where );
		if($result >= 1){
			$res=array('Response'=>"Success","Message"=>"Xóa thành công" ,"delete_item_vandon" =>".itemVandon".$this->input->post('shipid'));
		}else{
			$res=array('Response'=>"Error","Error"=>"Thực hiện không thành công");
		}
		echo json_encode($res);
	}

}

?>