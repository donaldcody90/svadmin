<?php
if (!defined ('BASEPATH')) exit ('No direct script access allowed');

class Datacenters_model extends MY_Model
{
	private $datacenters= 'datacenters';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
		Function findUser
		param_where = array(fieldName=>fieldValue)
	*/
	function findDC($params_where)
	{
		$this->db->where($params_where);
		$result= $this->db->get($this->datacenters);
		return $result->row();
	}
	
	  
	function updateDC($data, $params_where)
	{
        $this->db->where($params_where);
		$this->db->update($this->datacenters, $data);
		
		return $this->db->affected_rows();
    }

    function addDC($data){
        $this->db->insert($this->datacenters, $data);
        
		return $this->db->affected_rows();
    }
	

    function deleteDC($params_where){
        $this->db->delete($this->datacenters, $params_where);
		  
		return $this->db->affected_rows();
     }
	  
	function listDC($filterData, $limit, $start){
		$this->db->select('*');
		$this->db->from('customers as cu');
		$this->db->join('datacenters as d', 'cu.id = d.cuid');
        vst_buildFilter($filterData);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
	}
	 
	 function totalDC($filterData){
		$this->db->select('*');
		$this->db->from('customers as cu');
		$this->db->join('datacenters as d', 'cu.id = d.cuid');
        vst_buildFilter($filterData);
        $query = $this->db->get();
		return $query->num_rows();
     }

}