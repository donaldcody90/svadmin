<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends MY_Model
{

     private $table_orders = 'orders';
     private $table_customers = 'customers';
     private $table_items = 'items';
     private $table_sellers = 'sellers';
     private $table_ships = 'ships';
     function __construct()
     {
          parent::__construct();
     }
	
	 /*
		lấy danh sách sản phẩm trong một đơn hàng hoặc người bán
	 */
	 function getItems($oid,$sid=0)
	 {
		$this->db->select ( '*' );
        $this->db->from($this->table_items);
        $this->db->where(array('oid'=>$oid));
		if($sid){
			$this->db->where(array('sid'=>$sid));	
		}
        $query = $this->db->get();
        return $query->result_array();
	 }
	 /*
	  lấy danh sách người bán trong 1 đơn hàng
	 */
	 function getSellers($oid)
	 {
		$this->db->select ( '*' );
        $this->db->from($this->table_sellers);
        $this->db->where(array('oid'=>$oid));
        $query = $this->db->get();
        $sellers =  $query->result_array();
		return $sellers;
	 }
	 
     function getItemSeller($order,$seller){
    		$item_by_seller=$this->getItems($order['id'],$seller['id']);
    		$res=array(
    			'items'=>$item_by_seller,
    			'order_seller_summary'=>$this->get_Order_Seller_Summary($order,$item_by_seller,array($seller)),
    			'ships'=> $this->getShips($seller['oid'],$seller['id'])
    		);
        return $res;
     }
	
	/*
		Lấy thông tin vận đơn của người bán
	*/
    function getShips($oid,$sid=''){
          $this->db->select ( '*' );
          $this->db->from( $this->table_ships );
          $this->db->where( array('oid'=>$oid,'sid'=>$sid));
          $query = $this->db->get();
          return $query->result_array();
     }
	
	/*
		Lấy chi tiết đơn hàng theo từng người bán
	*/
     function getDetailOrderSeller($order,$sellers){
         if( count($sellers )){
               foreach ($sellers as $key => $seller) {
					       $sellers[$key]=array_merge($sellers[$key],$this->getItemSeller($order,$seller));
               }
          }
		return $sellers;
     }
	 
     function getDetailOrder($oid=''){
          $query = $this->db->select ('orders.*,customers.store,customers.address,customers.c_fullname,customers.c_username');
          $query = $this->db->from($this->table_orders);
          $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
          $query = $this->db->where( array('orders.id'=>$oid));
          $query = $this->db->get();
          $order=$query->row_array();
          if($order)
          {
      			  $items=$this->getItems($order['id']);
      			  $sellers=$this->getSellers($order['id']);
              $order['order_summary']=$this->get_Order_Seller_Summary($order,$items,$sellers);
              $order['detail']=$this->getDetailOrderSeller($order,$sellers);
          }
          return $order;
     }
	  /*
		Function findOrder
		param_where = array(fieldName=>fieldValue)
	  */
     function findOrder($params_where,$is_list=false){
        $result = $this->_getwhere(array(
                      'table'        => $this->table_orders,
                      'param_where'  => $params_where,
                      'list'         => $is_list
          ));
        return $result;
     }


     function updateOrder($data,$params_where){
           $result = $this->_save(array(
                                        'table'        => $this->table_orders,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $result;
     }

     function insertShip($data){
          return $this->_save(array(
               'table' => $this->table_ships,
               'data' => $data
          ));
     }

     function updateShopid($data,$params_where){
          return $this->_save(array(
               'table' => $this->table_sellers,
               'data' => $data,
               'param_where'  => $params_where
          ));
     }

     function updateShipid($data,$params_where){
          return $this->_save(array(
               'table' => $this->table_ships,
               'data' => $data,
               'param_where'  => $params_where
          ));
     }

     function updateFreeship_nd($data,$params_where){
          return $this->_save(array(
               'table' => $this->table_sellers,
               'data' => $data,
               'param_where'  => $params_where
          ));
     }

     function updateSeller($data,$params_where){
           $result = $this->_save(array(
                                        'table'        => $this->table_sellers,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $result;
     }

     function updateItem($data,$params_where){
           $result = $this->_save(array(
                                        'table'        => $this->table_items,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $result;
     }

     function deleteOrder($params_where){
          return $this->_del(array(
               'table'        => $this->table_orders,
               'param_where'  => $params_where
          ));
     }

     function deleteShip($params_where){
          return $this->_del(array(
               'table'        => $this->table_ships,
               'param_where'  => $params_where
          ));
     }
	 /*
		Tính tổng số lượng, tổng tiền dịch vụ, tiền thực mua, và tổng tiền 
		cho 1 đơn hàng hoặc theo người bán, phụ thuộc vào Items
	 */
     function get_Order_Seller_Summary($order,$items,$sellers = array())
     {
          $res=array(
        			  'total_quantity'=>0,
        			  'total_price'=>0,
        			  'total_real_price'=>0,
        			  'total_fee_service'=>0,
        			  'total_fee_shipnd'=>0,
        			  'currency_rate'=>$order['currency_rate'],
        			  'fee_service_percent'=>$order['fee_service_percent'],
			         );
		   if(count($items))
		   {
				   foreach($items as $item){
						
						$item_real_price=( $item['item_price']*$item['item_quantity'] );
						$item_fee_service=(( $item['item_price'] * ($order['fee_service_percent']/100)) *$item['item_quantity'] );
						$res['total_quantity'] +=$item['item_quantity'];
						$res['total_real_price'] += $item_real_price;
						$res['total_fee_service'] += $item_fee_service;
						$res['total_price'] += ( $item_real_price + $item_fee_service);
					
				   }
		   }
		   if(count($sellers))
		   {
			   foreach($sellers as $seller)
			   {
					$res['total_fee_shipnd'] +=$seller['fee_shipnd'];
			   }
		   }
		   return $res;
     }
    
     function listOrder($filter=array(),$total=0,$start=0){
          vst_buildFilter($filter);
          $query = $this->db->select ($this->table_orders.'.*,'.$this->table_customers.'.*');
          $query = $this->db->from($this->table_orders);
          $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
          $query = $this->db->order_by($this->table_orders.'.cid', 'desc'); 
          $query = $this->db->limit($total, $start);
          $query = $this->db->get();

          $records = $query->num_rows();
          $list = $query->result_array();
          if($list)
          {
               foreach($list as $key=>$order){
        				 $items=$this->getItems($order['id']);
        				 $sellers=$this->getSellers($order['id']);
                 $list[$key]['order_summary']=$this->get_Order_Seller_Summary($order,$items,$sellers);
               }
          }

          $results = array( 'list'=> $list,'records'=> $records );
          return $results;
     }

    function totalOrder($filter){
        vst_buildFilter($filter);
        $query = $this->db->select ($this->table_orders.'.*,'.$this->table_customers.'.*');
        $query = $this->db->from($this->table_orders);
        $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
        $query = $this->db->order_by($this->table_orders.'.cid', 'desc'); 
        $query = $this->db->get();
		    return $query->num_rows();
    }
	
	function getOrderStatusSummury(){
		
		$order_status_sum=$this->config->item('site')['order_status'];
		$this->db->select ('status, COUNT(*) as total_orders');
		$this->db->from ($this->table_orders);
		$this->db->group_by('status');
		$query = $this->db->get();
		$results=$query->result_array();
		$total_orders=0;
		if($results)
		{	
			foreach($results as $item)
			{
				$order_status_sum[$item['status']]['count']=$item['total_orders'];
				$total_orders +=$item['total_orders'];
			}
		}
		$order_status_sum["-99"]['count']=$total_orders;
		return $order_status_sum;
	}

   function orderPending($params_where=2){

    $query = $this->db->select ($this->table_orders.'.*,'.$this->table_customers.'.store');
    $query = $this->db->from($this->table_orders);
    $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
    $query = $this->db->where ($this->table_orders.'.status', 2);
    $query = $this->db->order_by($this->table_orders.'.id', 'desc'); 
    $query = $this->db->get();
    return  $query->result_array();
   }

   function listShopNull($shopid=false,$free_shipnd=false){

    $query = $this->db->select ($this->table_sellers.'.*,'.$this->table_customers.'.store,'.$this->table_orders.'.invoiceid' );
    $query = $this->db->from($this->table_sellers);
    $query = $this->db->join ($this->table_orders, $this->table_orders.'.id = '.$this->table_sellers.'.oid');
    $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
    if( $shopid==true ){
      $query = $this->db->where ($this->table_sellers.'.shopid', NULL);
    }elseif ($free_shipnd==true) {
      $query = $this->db->where ($this->table_sellers.'.fee_shipnd', NULL);
    }
    $query = $this->db->order_by($this->table_sellers.'.id', 'desc'); 
    $query = $this->db->get();
    return  $query->result_array();
   }

   function listShipNull(){

    $query = $this->db->select ($this->table_ships.'.*,'.$this->table_ships.'.id as id_table_ships,'.$this->table_customers.'.store,'.$this->table_sellers.'.*,'.$this->table_orders.'.invoiceid' );
    $query = $this->db->from($this->table_ships);
    $query = $this->db->join ($this->table_sellers, $this->table_sellers.'.id = '.$this->table_ships.'.sid');
    $query = $this->db->join ($this->table_orders, $this->table_orders.'.id = '.$this->table_ships.'.oid');
    $query = $this->db->join ($this->table_customers, $this->table_customers.'.cid = '.$this->table_orders.'.cid');
    $query = $this->db->where ($this->table_ships.'.shipid', NULL);
    $query = $this->db->order_by($this->table_ships.'.id', 'desc'); 
    $query = $this->db->get();
    return  $query->result_array();
   }

}

?>