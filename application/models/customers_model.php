<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers_model extends MY_Model
{
     private $table_customers = 'customers';
     private $table_orders = 'orders';
     private $table_items = 'items';
     private $table_users = 'users';

     function __construct()
     {
          parent::__construct();
     }
	  /*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	  */
     function detailCustomer($cid){
          $query = $this->db->select ( '*' );
          $query = $this->db->from('users');
          $query = $this->db->join ( 'customers ', 'customers.uid=users.uid');
          $query = $this->db->where( 'users.role', 3);
          $query = $this->db->get();
          return $query->result_array();
	  }
	  
     function findCustomer($params_where,$is_list=false){
          $user = $this->_getwhere(array(
                         'table'        => $this->table_customers,
                         'param_where'  => $params_where,
                         'list'=>$is_list
          ));
          return $user;
    }
	   
	function updateCustomer($data,$params_where){
           $user = $this->_save(array(
                                        'table'        => $this->table_customers,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
          return $user;
     }

    function deleteCustomer($params_where){
          return $this->_del(array(
               'table'        => $this->table_customers,
               'param_where'  => $params_where
          ));
     }

    function totalCustomers($filter=array()){
		vst_buildFilter($filter);
		$query = $this->db->get($this->table_customers);
		return $query->num_rows();
     }

     function listCustomers($filter=array(),$total=0,$start=0){
          vst_buildFilter($filter);
          $query = $this->db->select ('customers.*,users.username as advisori_username');
          $query = $this->db->from('customers');
          $query = $this->db->join ('users ', 'users.uid = customers.uid','left');
          $query = $this->db->order_by('customers.cid', 'desc'); 
          $query = $this->db->limit($total, $start);
          $query = $this->db->get();
          return $query->result_array();
     }
}

?>