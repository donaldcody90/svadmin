<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends MY_Model
{
	 private $users = 'users';

     function __construct()
     {
          parent::__construct();
     }
	 
	 
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
    
	function findUser($params_where= null,$is_list=false){
          return  $this->_getwhere(array(
                         'table'        => $this->users,
                         'param_where'  => $params_where,
                         'list'=>$is_list
          ));
    }
	
	  
	function updateUser($data,$params_where){
            return $this->_save(array(
                                        'table'        => $this->users,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
		 
       }
	  
	 
	 function deleteUser($params_where){
          return $this->_del(array(
               'table'        => $this->users,
               'param_where'  => $params_where
          ));
     }
	  
	 function listUser($filter,$limit,$start){
          vst_buildFilter($filter);
          $result = $this->db->get($this->users, $limit, $start);
		  
          return $result->result();
     }
	 
	 function totalUser($filter){
		vst_buildFilter($filter);
        $result = $this->db->get($this->users);
		
		return $result->num_rows();
     }



	function addUser($data)
	{
		return $this->_save(array(
							'table'    => $this->users,
							'data'     => $data
						   ));
	}
	
	
	/*function insertUser($data){
          return $this->_save(array(
               'table' => $this->users,
               'data' => $data
          ));
     }*/

}
?>