<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkshop extends CI_Controller {
    function __construct(){
        parent::__construct();
        vkt_checkAuth();
        $this->load->model('orders_model');
    }

    public function index()
    {
        redirect(site_url('checkshop/lists'));

    }

    public function lists(){
        $params_where  = array( 'status'=>2 );
        $arr['data_order_pending']=  $this->orders_model->orderPending($params_where);
        $arr['data_shopid_null']  =   $this->orders_model->listShopNull($shopid=true,$free_shipnd=false);
        $arr['data_freeshipnd_null']  =   $this->orders_model->listShopNull($shopid=false,$free_shipnd=true);
        $arr['data_shipid_null']  =   $this->orders_model->listShipNull();
        $this->load->view('checkshop/list',$arr);
    }

    public function updateShopid()
    {
        $this->form_validation->set_rules('shopid', 'Shopid ', 'required|is_natural');

        if($this->form_validation->run() == TRUE){
            $data = array('shopid'=>$this->input->post('shopid') );
            $param_where = array( 'id' => $this->input->post('id'));
            $result = $this->orders_model->updateFreeship_nd( $data,$param_where );
            if($result >= 1){
                $res=array('Response'=>"Success","Message"=>"Đã cập nhật thành công" );
            }else{
                $res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
            }
        }else{
            $res=array('Response'=>"Error","Error"=>"Mã Shop không được để trống");
        }   
        echo json_encode($res);
    }

    public function updateShipid()
    {
        $this->form_validation->set_rules('shipid', 'Shipid ', 'required|is_natural');

        if($this->form_validation->run() == TRUE){
            $data = array('shipid'=>$this->input->post('shipid') );
            $param_where = array( 'id' => $this->input->post('id'));
            $result = $this->orders_model->updateShipid( $data,$param_where );
            if($result >= 1){
                $res=array('Response'=>"Success","Message"=>"Đã cập nhật thành công" );
            }else{
                $res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
            }
        }else{
            $res=array('Response'=>"Error","Error"=>"Mã Shop không được để trống");
        }   
        echo json_encode($res);
    }

    public function updateFreeShip()
    {
        $this->form_validation->set_rules('fee_shipnd', 'Freeship ', 'is_natural');

        if($this->form_validation->run() == TRUE){
            $check = $this->input->post('check_free_shipnd');
            if( isset($check) ){
                $data = array('fee_shipnd'=>0 );
            }else{
                $data = array('fee_shipnd'=>$this->input->post('fee_shipnd') );
            }
            $param_where = array( 'id' => $this->input->post('id'));
            $result = $this->orders_model->updateFreeship_nd( $data,$param_where );
            if($result >= 1){
                $res=array('Response'=>"Success","Message"=>"Đã cập nhật thành công" );
            }else{
                $res=array('Response'=>"Error","Error"=>"Thao tác không thành công");
            }
        }else{
            $res=array('Response'=>"Error","Error"=>"Phí nội địa phải là số dương");
        }   
        echo json_encode($res);
    }

}

?>