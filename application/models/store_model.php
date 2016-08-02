<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends My_Model
{

     private $store_ships = 'store_ships';
     private $store_packages = 'store_packages';
     private $users = 'users';
     private $ships = 'ships';
     private $items = 'items';
     private $sellers = 'sellers';
     private $orders = 'orders';

     function __construct()
     {
          parent::__construct();
     }

    // public function totalShips($filter){

    //   vst_buildFilter($filter);
    //   $query = $this->db->get($this->store_ships);
    //   return $query->num_rows();
    // }
    public function totalShips($filter){

      vst_buildFilter($filter);
      $query = $this->db->select ($this->store_ships.'.*,u1.username as receive_name_cn,u2.username as receive_name_vn,'.$this->store_packages.'.id,'.$this->store_packages.'.name,'.$this->store_packages.'.weight,'.$this->store_packages.'.cn_package_receive_date');
      $query = $this->db->from($this->store_ships);
      $query = $this->db->join ('users AS u1', 'u1.uid=store_ships.cn_receive_uid', 'left');
      $query = $this->db->join ('users AS u2', 'u2.uid=store_ships.vn_receive_uid', 'left');
      $query = $this->db->join ($this->store_packages, $this->store_packages.'.id ='.$this->store_ships.'.pid','left');
      $query = $this->db->order_by($this->store_ships.'.id', 'desc'); 
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function totalPackages($filter,$status=false){

      vst_buildFilter($filter);
      if( $status == true){
        $query = $this->db->where('package_cn_status',1);
      }
      $query = $this->db->get($this->store_packages);
      return $query->num_rows();
    }

    public function listShips_by_Package($params_where){

      $results = $this->_getwhere(array(
                      'table'        => $this->store_ships,
                      'param_where'  => $params_where,
                      'list'         => true
          ));
      return $results;
    }

    public function listShips($filter,$total,$start){

          vst_buildFilter($filter);
          $query = $this->db->select ($this->store_ships.'.*,u1.username as receive_name_cn,u2.username as receive_name_vn,'.$this->store_packages.'.id,'.$this->store_packages.'.name,'.$this->store_packages.'.weight,'.$this->store_packages.'.cn_package_receive_date');
          $query = $this->db->from($this->store_ships);
          $query = $this->db->join ('users AS u1', 'u1.uid=store_ships.cn_receive_uid', 'left');
          $query = $this->db->join ('users AS u2', 'u2.uid=store_ships.vn_receive_uid', 'left');
          $query = $this->db->join ($this->store_packages, $this->store_packages.'.id ='.$this->store_ships.'.pid','left');
          $query = $this->db->order_by($this->store_ships.'.id', 'desc'); 
          $query = $this->db->limit($total, $start);
          $query = $this->db->get();
          return $query->result_array();
    }

    public function listPackages($filter,$total,$start,$status=false){

          vst_buildFilter($filter);
          $query = $this->db->select ('store_packages.*,u1.username as receive_name_cn,u2.username as receive_name_vn');
          $query = $this->db->from($this->store_packages);
          $query = $this->db->join ('users AS u1', 'u1.uid=store_packages.cn_receive_uid', 'left');
          $query = $this->db->join ('users AS u2', 'u2.uid=store_packages.vn_receive_uid', 'left');
          if( $status == true ){
            $query = $this->db->where($this->store_packages.'.package_cn_status', '1'); 
          }
          $query = $this->db->order_by($this->store_packages.'.id', 'desc');  
          $query = $this->db->limit($total, $start);
          $query = $this->db->get();
          $list  =  $query->result_array();
          if($list)
          {
               foreach($list as $key=>$value){
                 $list[$key]['listShips_by_Package']=$this->listShips_by_Package( array('pid'=>$value['id']) );
               }
          }
          return $list;
    }

    // Lấy thông tin bao đóng theo điều kiện
    public function getPackages($param_where){
          $this->db->select ( '*' );
          $this->db->from( $this->store_packages );
          $this->db->where($param_where);
          $query = $this->db->get();
          return $query->result_array();
    }

    public function insertShipcn($data){

          return $this->_save(array(
               'table' => $this->store_ships,
               'data' => $data
          ));
     }

    //Update dữ liệu của bảng store_ships
    public function updateShip($data,$params_where){
           $user = $this->_save(array(
                                        'table'        => $this->store_ships,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $user;
     }
    public function insertPackage($data){
          $list = $this->_save(array(
               'table' => $this->store_packages,
               'data' => $data
          ));

          $insert_id = $this->db->insert_id();
          $results = array( 'list'=> $list,'insert_id'=> $insert_id );
          
          return $results;
     }

    public function updatePackage($data,$params_where){
           $user = $this->_save(array(
                                        'table'        => $this->store_packages,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $user;
     }

    //Update dữ liệu của bảng ships
    public function update_Ships($data,$params_where){
           $results = $this->_save(array(
                                        'table'        => $this->ships,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $results;
     }

    public function getShipid($params_where){
         $results = $this->_getwhere(array(
                        'table'        => $this->ships,
                        'param_where'  => $params_where,
            ));
         if( $results ){
           $information_by_shipid = $this->information_by_shipid( $results['oid'],$results['sid'] );
           $results['information_by_shipid'] = $information_by_shipid;
           $results['total_real_price'] =   ( $information_by_shipid['item_price']*$information_by_shipid['item_quantity'] );
           $results['total_fee_service'] = (( $information_by_shipid['item_price'] * ($information_by_shipid['fee_service_percent']/100)) *$information_by_shipid['item_quantity'] );
           $results['total_price'] =   $results['total_real_price'] + $results['total_fee_service'];
         }
         return $results;
    }

    public function information_by_shipid( $oid,$sid ){
        $query = $this->db->select ('items.*,orders.*,sellers.*');
        $query = $this->db->from('items');
        $query = $this->db->join ('orders', $this->orders.'.id = '.$this->items.'.oid');
        $query = $this->db->join ('sellers', $this->sellers.'.id = '.$this->items.'.sid');
        $query = $this->db->where( array( 'items.oid'=>$oid,'items.sid'=>$sid ) );
        $query = $this->db->get();
        return $query->row_array();
    }
    

}

?>