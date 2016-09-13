<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers_model extends MY_Model
{
	 private $customers = 'customers';

     function __construct()
     {
        parent::__construct();
     }
	 
	 
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
	
    
	
     function findCustomer($params_where=null, $is_list=false){
          return  $this->_getwhere(array(
                         'table'        => $this->customers,
                         'param_where'  => $params_where,
                         'list'			=> $is_list
          ));
    }
	function updateCustomer($data,$params_where){
            return $this->_save(array(
                                        'table'        => $this->customers,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));	
       }
	

	 function deleteCustomer($params_where){
          return $this->_del(array(
               'table'        => $this->customers,
               'param_where'  => $params_where
          ));
     }
	 
	 function listCustomer($filter,$limit=null,$start=null){
          vst_buildFilter($filter);
          $result = $this->db->get($this->customers, $limit, $start);
		  
          return $result->result_array();
     }
	 
	 function totalCustomer($filter){
		vst_buildFilter($filter);
        $result = $this->db->get($this->customers);
		
		return $result->num_rows();
     }

	function addCustomer($data)
	{
		return $this->_save(array(
							'table'    => $this->customers,
							'data'     => $data
						   ));
	}
	
	
	 /*function insertUser($data){
          return $this->_save(array(
               'table' => $this->table_users,
               'data' => $data
          ));
     }*/

     // function deleteCustomer($params_where){
        // $this->db->delete($this->customers, $params_where);
		  
		// return $this->db->affected_rows();
		
     // }
	
}
?>