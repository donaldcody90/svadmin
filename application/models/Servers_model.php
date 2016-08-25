<?php
if (!defined ('BASEPATH')) exit ('No direct script access allowed');

class Servers_model extends MY_Model
{
	private $servers= 'servers';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
	
	
	function findSV($params_where= null,$is_list=false){
		 return $this->_getwhere(array(
							'table'        => $this->servers,
							'param_where'  => $params_where,
							'list'         => $is_list
				));
		}
	

	
	
	function updateSV($data,$params_where){
           return $this->_save(array(
                                        'table'        => $this->servers,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
       }

    
	
	function addSV($data){
          return $this->_save(array(
               'table' => $this->servers,
               'data' => $data
          ));
     }
	

	 function deleteSV($params_where){
          return $this->_del(array(
               'table'        => $this->servers,
               'param_where'  => $params_where
          ));
     }
	 
	  
	function listSV($filterData, $limit, $start){
		vst_buildFilter($filterData);
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->servers);
        return $query->result();
	}
	
	 
	 function totalSV($filterData){
		vst_buildFilter($filterData);
        $query = $this->db->get($this->servers);
		return $query->num_rows();
     }
	 
	 
	 
	 // function findSV($params_where)
	// {
		// $this->db->where($params_where);
		// $result= $this->db->get($this->servers);
		// return $result->row();
	// }
	
	
	// function updateSV($data, $params_where)
	// {
        // $this->db->where($params_where);
		// $this->db->update($this->servers, $data);
		
		// return $this->db->affected_rows();
    // }
	
	// function addSV($data){
        // $this->db->insert($this->servers, $data);
        
		// return $this->db->affected_rows();
    // }
	
	// function deleteSV($params_where){
        // $this->db->delete($this->servers, $params_where);
		  
		// return $this->db->affected_rows();
     // }

}