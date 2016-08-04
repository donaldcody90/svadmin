<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
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
    function findUser($params_where)
	{
		
		$this->db->where($params_where);
		$data1= $this->db->get($this->table_users)->result();
		
		$this->db->where($params_where);
		$data2= $this->db->get($this->table_cust)->result();
		
		$result= array_merge($data1, $data2);
		return $result;
	}
	
	  
	function updateUser($data,$params_where){
            $user1 = $this->_save(array(
                                        'table'        => $this->table_users,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
								   
			$user2 = $this->_save(array(
                                        'table'        => $this->table_cust,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
			if ($user1 > 0 or $user2 >0)
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

     function deleteUser($params_where){
        $this->db->delete($this->table_users, $params_where);
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
	  
	 function listUser($filter){
          vst_buildFilter($filter);
          $query1 = $this->db->get($this->table_users)->result();
		  
		  vst_buildFilter($filter);
          $query2 = $this->db->get($this->table_cust)->result();
		  
		  $result= array_merge($query1, $query2);
          return $result;
     }
	 
	 function totalUser($filter){
		vst_buildFilter($filter);
        $query1 = $this->db->get($this->table_users)->result();
		  
		vst_buildFilter($filter);
        $query2 = $this->db->get($this->table_users)->result();
		  
		$result= array_merge($query1, $query2);
		
		return $query->num_rows();
     }

	function add_admin($data)
	{
		return $this->_save(array(
							'table'    => $this->table_users,
							'data'     => $data
						   ));
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