<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers_model extends MY_Model
{
	 private $table_users = 'users';
	 private $table_cust = 'customers';

     function __construct()
     {
          parent::__construct();
     }
	 
	 
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
    function findCustomer($params_where)
	{
		
		$this->db->where($params_where);
		$result= $this->db->get($this->table_cust);
		
		return $result->row();
	}
	
	function updateCustomer($data,$params_where){
            $user = $this->_save(array(
                                        'table'        => $this->table_cust,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
			
			if ($user > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
          
       }
	

     /*function insertUser($data){
          return $this->_save(array(
               'table' => $this->table_users,
               'data' => $data
          ));
     }*/

     function deleteCustomer($params_where){
        $this->db->delete($this->table_cust, $params_where);
		  
		if($this->db->affected_rows() == 1)
		{
			return true;
		}	
		else
		{
			return false;
		}
     }
	 
	 function listCustomer($filter,$limit,$start){
          vst_buildFilter($filter);
          $result = $this->db->get($this->table_cust, $limit, $start);
		  
          return $result->result();
     }
	 
	 function totalCustomer($filter){
		vst_buildFilter($filter);
        $result = $this->db->get($this->table_cust);
		
		return $result->num_rows();
     }

	function add_customer($data)
	{
		return $this->_save(array(
							'table'    => $this->table_cust,
							'data'     => $data
						   ));
	}
}
?>