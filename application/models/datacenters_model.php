<?php
if (!defined ('BASEPATH')) exit ('No direct script access allowed');

class Datacenters_model extends CI_Model
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
	  
	 function listDC($filter, $limit, $start){
          vst_buildFilter($filter);
          $query = $this->db->limit($limit, $start);
          $query = $this->db->get($this->dc);
          return $query->result();
     }
	 
	 function totalDC($filter){
		vst_buildFilter($filter);
		$query = $this->db->get($this->dc);
		return $query->num_rows();
     }

}