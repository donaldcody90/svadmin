<?php
if (!defined ('BASEPATH')) exit ('No direct script access allowed');

class Plans_model extends MY_Model
{
	private $plans= 'plans';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
	
	
	function findPlan($params_where= null,$is_list=false){
		 return $this->_getwhere(array(
							'table'        => $this->plans,
							'param_where'  => $params_where,
							'list'         => $is_list
				));
		}
	

	
	
	function updatePlan($data,$params_where){
           return $this->_save(array(
                                        'table'        => $this->plans,
                                        'data'         => $data,
                                        'param_where'  => $params_where
                                   ));
       }

    
	
	function addPlan($data){
          return $this->_save(array(
               'table' => $this->plans,
               'data' => $data
          ));
     }
	

	 function deletePlan($params_where){
          return $this->_del(array(
               'table'        => $this->plans,
               'param_where'  => $params_where
          ));
     }
	 
	  
	function listPlan($filterData, $limit, $start){
		vst_buildFilter($filterData);
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->plans);
        return $query->result();
	}
	
	 
	 function totalPlan($filterData){
		vst_buildFilter($filterData);
        $query = $this->db->get($this->plans);
		return $query->num_rows();
     }
	 
	 
	 
	 // function findSV($params_where)
	// {
		// $this->db->where($params_where);
		// $result= $this->db->get($this->plans);
		// return $result->row();
	// }
	
	
	// function updateSV($data, $params_where)
	// {
        // $this->db->where($params_where);
		// $this->db->update($this->plans, $data);
		
		// return $this->db->affected_rows();
    // }
	
	// function addSV($data){
        // $this->db->insert($this->plans, $data);
        
		// return $this->db->affected_rows();
    // }
	
	// function deleteSV($params_where){
        // $this->db->delete($this->plans, $params_where);
		  
		// return $this->db->affected_rows();
     // }

}