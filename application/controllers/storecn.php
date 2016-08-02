<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "/third_party/PHPExcel/IOFactory.php";

class Storecn extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		vkt_checkAuth();
		$this->load->model('store_model');
	}
	
	public function index()
	{
		redirect(site_url('storecn/lists_package'));

	}
	
	public function ships(){

		$this->load->view('storecn/ship');
	}
	
	public function packages(){

		$this->load->view('storecn/package');
	}

	public function send_package(){

		$currentUser=vst_getCurrentUser();
		$data_package = array( 'package_cn_status' =>1,'cn_receive_uid'=>$currentUser['uid'],'cn_package_receive_date	'=> vst_currentDate() );
		$data_ship = array( 'ship_cn_status' =>1,'cn_receive_uid'=>$currentUser['uid'],'cn_ship_receive_date'=> vst_currentDate() );
		$param_where_package = array( 'id' =>$this->input->post('id'));
		$param_where_ship = array( 'pid' =>$this->input->post('id'));

		$result_package = $this->store_model->updatePackage( $data_package ,$param_where_package);
		$result_ship = $this->store_model->updateShip( $data_ship,$param_where_ship );

		if( $result_package >= 1 && $result_ship >= 1 ){
			$res=array('Response'=>"Success","Message"=>"Đã gửi thành công" );
		}else{
			$res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
		}

		echo json_encode($res);
	}

	public function lists_ship(){

		$filter=vst_filterData(array(),array('filter_startdate_cn_ship_receive_date','filter_enddate_cn_ship_receive_date'));
		$config = vst_pagination();
		$arr = array();
		$arr['total_rows'] = $config['total_rows'] = $this->store_model->totalShips($filter);
        $this->pagination->initialize($config);
        $start = $this->input->get('page');
		$arr['data'] =  $this->store_model->listShips($filter,$config['per_page'], $start);
		
		$this->load->view('storecn/lists_ship',$arr);
	}

	public function lists_package(){

		$filter=vst_filterData(array(),array('filter_startdate_cn_package_receive_date','filter_enddate_cn_package_receive_date'));
		$config = vst_pagination();
		$arr = array();
		$arr['total_rows'] = $config['total_rows'] = $this->store_model->totalPackages($filter);
        $this->pagination->initialize($config);
        $start = $this->input->get('page');
		$arr['data'] =  $this->store_model->listPackages($filter,$config['per_page'], $start);
		
		$this->load->view('storecn/lists_package',$arr);
	}

	public function upload_package(){

		if( $this->input->post('upoad_file') ){
			$config['upload_path'] = realpath(APPPATH."../static/uploads_files_excel/files_baodong");
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size'] = '0';
			$this->load->library('upload',$config);
			if( !$this->upload->do_upload('upload') ){
				message_flash('Xin vui lòng nhập file !','error');
				$this->load->view('storecn/package');
			}else{
				//echo 1;die;
				$upload_data = $this->upload->data();
				$file = $_FILES['upload']['tmp_name'];
				$this->load->library('storecn');
				$objPHPstorecn = PHPExcel_IOFactory::load($file);
				$cell_collection = $objPHPstorecn->getActiveSheet()->getCellCollection();

				foreach ($cell_collection as $cell) {
					$column = $objPHPstorecn->getActiveSheet()->getCell($cell)->getColumn();
					$row = $objPHPstorecn->getActiveSheet()->getCell($cell)->getRow();
					$data_value = $objPHPstorecn->getActiveSheet()->getCell($cell)->getValue();
					$arr_data[$row][$column] = $data_value;
				}
				// var_dump($arr_data);die;
				//delete file
				$file = $upload_data['file_name'];
				$path = './static/uploads_files_excel/files_baodong/' . $file;
				unlink($path);

				$arr['status'] = 1;
				$arr['data'] = $arr_data;
				$this->load->view('storecn/package',$arr);
			}
		}elseif(  $this->input->post('save') ){
			
			$currentUser=vst_getCurrentUser();

			 for ($i=1; $i <=3 ; $i++) { 
			 	$weight = $this->input->post('weight_'.$i);
			 	$name = $this->input->post('name_'.$i);
				$data = array(
					'cn_receive_uid' =>  $currentUser['uid'],
					'weight' => $weight,
					'name'   =>$name,
					'cn_package_receive_date	'=>vst_currentDate(),
				);
				$result = $this->store_model->insertPackage($data);
				$insert_id []= $result['insert_id'];
				if($result['list'] >= 1){
					message_flash('Bạn đã Đóng bao thành công !');
				}
			 }
			 //print_r($insert_id);die;
			 $count_shipid = $this->input->post('count_shipid');;
			 for( $i=3; $i <( $count_shipid+3) ; $i++ ){
			 	$label_A[] = $this->input->post('label_A'.$i);
			 	$label_B[] = $this->input->post('label_B'.$i);
			 	$label_C[]= $this->input->post('label_C'.$i);
			 }

			 foreach ($label_A as $value) {
			 	$where = array("shipid"=>$value);
			 	$data  = array( "pid"=> $insert_id[0]);
			 	$this->store_model->updateShip($data,$where);
			 }
			 foreach ($label_B as $value) {
			 	$where = array("shipid"=>$value);
			 	$data  = array( "pid"=> $insert_id[1]);
			 	$this->store_model->updateShip($data,$where);
			 }
			 foreach ($label_C as $value) {
			 	$where = array("shipid"=>$value);
			 	$data  = array( "pid"=> $insert_id[2]);
			 	$this->store_model->updateShip($data,$where);
			 }
			$this->load->view('storecn/package');
		}
	}

	public function upload_ship(){

		if( $this->input->post('upoad_file') ){
			$config['upload_path'] = realpath(APPPATH."../static/uploads_files_excel/files_vandon");
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size'] = '0';
			$this->load->library('upload',$config);
			if( !$this->upload->do_upload('upload') ){
				message_flash('Xin vui lòng nhập file !','error');
				$this->load->view('storecn/ship');
			}else{
				$upload_data = $this->upload->data();
				$file = $_FILES['upload']['tmp_name'];
				$this->load->library('storecn');
				$objPHPstorecn = PHPExcel_IOFactory::load($file);
				$cell_collection = $objPHPstorecn->getActiveSheet()->getCellCollection();

				foreach ($cell_collection as $cell) {
					$column = $objPHPstorecn->getActiveSheet()->getCell($cell)->getColumn();
					$row = $objPHPstorecn->getActiveSheet()->getCell($cell)->getRow();
					$data_value = $objPHPstorecn->getActiveSheet()->getCell($cell)->getValue();
					$arr_data[$row][$column] = $data_value;
				}
				//delete file
				$file = $upload_data['file_name'];
				$path = './static/uploads_files_excel/files_vandon/' . $file;
				unlink($path);
				
				$arr['status'] = 1;
				$arr['data'] = $arr_data;
				$this->load->view('storecn/ship',$arr);
			}
		}elseif(  $this->input->post('save') ){
			$count = $this->input->post('count');
			$currentUser=vst_getCurrentUser();
			for( $i=1;$i<=$count;$i++ ){
			 	 $shipid = $this->input->post('shipid'.$i);
			 	 if( is_numeric($shipid) ){
					$data = array(
						'cn_receive_uid' =>  $currentUser['uid'],
						'shipid' => $shipid,
						'cn_ship_receive_date	'=>vst_currentDate(),
					);
					$result = $this->store_model->insertShipcn($data);
					if($result >= 1){
						message_flash('Bạn đã Nhập kho thành công '.$count.' vận đơn');
					}
			 	 }
			}
			$this->load->view('storecn/ship');
		}
	}

}

?>