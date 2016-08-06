<?php
if (!defined ('BASEPATH')) exit ('No direct script access allowed');

class Datacenters_model extends MY_Model
{
	private $dc= 'datacenters';
	
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
		$result= $this->db->get($this->dc);
		return $result->row();
	}
	
	  
	function updateDC($data, $params_where)
	{
        $this->db->where($params_where);
		$this->db->update($this->dc, $data);
		
		if ($this->db->affected_rows() == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

    function addDC($data){
        $this->db->insert($this->dc, $data);
        
		if($this->db->affected_rows() == 1)
		{
			return true;
		}	
		else
		{
			return false;
		}
    }
	

    function deleteDC($params_where){
        $this->db->delete($this->dc, $params_where);
		  
		if($this->db->affected_rows() == 1)
		{
			return true;
		}	
		else
		{
			return false;
		}
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